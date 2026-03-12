<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostDeletedMail;
use App\Mail\ReportDismissedMail;

class AdminReportController extends Controller
{
    /**
     * Display a listing of reported feeds.
     */
    public function index(Request $request)
    {
        // Get search and status parameters
        $search = $request->search;
        $status = $request->status;

        // Build query with relationships
        $query = Report::with(['feed.images', 'reporter', 'reportedUser']);

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('feed', function ($feedQuery) use ($search) {
                    $feedQuery->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('reporter', function ($reporterQuery) use ($search) {
                    $reporterQuery->where('name', 'like', '%' . $search . '%')
                                  ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->orWhereHas('reportedUser', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->orWhere('message', 'like', '%' . $search . '%');
            });
        }

        // Apply status filter - FIXED: Added status filtering
        if ($status) {
            $query->where('status', $status);
        }

        // Get paginated results
        $reports = $query->latest()
                        ->paginate(10)
                        ->withQueryString(); // Preserve query parameters in pagination links

        // Get statistics for cards
        $stats = [
            'total' => Report::count(),
            'pending' => Report::where('status', 'pending')->count(),
            'resolved' => Report::where('status', 'resolved')->count(),
            'dismissed' => Report::where('status', 'dismissed')->count(),
        ];

        return view('admin.reports.index', compact('reports', 'search', 'stats', 'status'));
    }

    /**
     * Display the specified report.
     */
    public function show($id)
    {
        $report = Report::with([
            'feed.images', 
            'reporter', 
            'reportedUser', 
            'reviewer'
        ])->findOrFail($id);

        return view('admin.reports.show', compact('report'));
    }

    /**
     * Update the report status.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,dismissed,resolved,action_taken',
            'admin_notes' => 'nullable|string|max:1000',
            'action' => 'nullable|in:hide_post,delete_post,ignore'
        ]);

        $report = Report::with('feed')->findOrFail($id);

        DB::transaction(function () use ($request, $report) {
            // Update report
            $report->update([
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now()
            ]);

            // Handle actions if post exists
            if ($request->filled('action') && $report->feed) {
                switch ($request->action) {
                    case 'hide_post':
                        $report->feed->update([
                            'is_hidden' => true,
                            'hidden_at' => now(),
                            'hidden_by' => auth()->id()
                        ]);
                        
                        // Update related pending reports
                        Report::where('feed_id', $report->feed->id)
                            ->where('id', '!=', $report->id)
                            ->where('status', 'pending')
                            ->update([
                                'status' => 'action_taken',
                                'admin_notes' => 'Post hidden by admin',
                                'reviewed_by' => auth()->id(),
                                'reviewed_at' => now()
                            ]);
                        break;
                        
                    case 'delete_post':
                        // Delete images first
                        $report->feed->images()->delete();
                        // Delete feed
                        $report->feed->delete();
                        
                        // Update related reports
                        Report::where('feed_id', $report->feed->id)
                            ->where('id', '!=', $report->id)
                            ->update([
                                'status' => 'action_taken',
                                'admin_notes' => 'Post deleted by admin',
                                'reviewed_by' => auth()->id(),
                                'reviewed_at' => now()
                            ]);
                        break;
                        
                    case 'ignore':
                        // No action on post
                        break;
                }
            }
        });

        return redirect()->route('admin.reports.show', $id)
            ->with('success', 'Report updated successfully');
    }

    /**
     * Remove the specified report.
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report record deleted successfully');
    }

    /**
     * Delete the reported post.
     */
    public function deletePost($id)
    {
        $feed = Feed::with('images')->findOrFail($id);
        
        // Get all reports for this feed before deletion
        $reports = Report::where('feed_id', $feed->id)
                         ->with(['reporter', 'reportedUser'])
                         ->get();

        DB::transaction(function () use ($feed, $reports) {
            // Update related reports
            Report::where('feed_id', $feed->id)
                ->update([
                    'status' => 'action_taken',
                    'admin_notes' => 'Post deleted by admin',
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now()
                ]);

            // Delete images first
            foreach ($feed->images as $image) {
                // Delete file from storage
                if (file_exists(storage_path('app/public/' . $image->image))) {
                    unlink(storage_path('app/public/' . $image->image));
                }
                $image->delete();
            }

            // Delete feed
            $feed->delete();
        });

        // Send emails after successful deletion
        foreach ($reports as $report) {
            try {
                // Send email to reporter
                if ($report->reporter) {
                    Mail::to($report->reporter->email)
                        ->send(new PostDeletedMail(
                            $report->reporter, 
                            $feed, 
                            $report, 
                            'reporter'
                        ));
                }

                // Send email to post owner (if not already sent as reporter)
                if ($report->reportedUser && 
                    (!$report->reporter || $report->reporter->id !== $report->reportedUser->id)) {
                    Mail::to($report->reportedUser->email)
                        ->send(new PostDeletedMail(
                            $report->reportedUser, 
                            $feed, 
                            $report, 
                            'owner'
                        ));
                }
            } catch (\Exception $e) {
                // Log email error but don't stop the process
                \Log::error('Failed to send post deletion email: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.reports.index')
            ->with('success', 'Post deleted successfully and notifications sent to reporter(s) and post owner.');
    }

    /**
     * Hide the reported post.
     */
    public function hidePost($id)
    {
        $feed = Feed::findOrFail($id);

        DB::transaction(function () use ($feed) {
            $feed->update([
                'is_hidden' => true,
                'hidden_at' => now(),
                'hidden_by' => auth()->id()
            ]);

            // Update all pending reports for this feed
            Report::where('feed_id', $feed->id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'action_taken',
                    'admin_notes' => 'Post hidden by admin',
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now()
                ]);
        });

        return redirect()->route('admin.reports.index')
            ->with('success', 'Post hidden successfully');
    }

    /**
     * Dismiss the report.
     */
    public function dismissReport($id)
    {
        $report = Report::with(['feed', 'reporter', 'reportedUser'])->findOrFail($id);
        
        // Store data before updating for email
        $reporter = $report->reporter;
        $owner = $report->reportedUser;
        $feed = $report->feed;
        $adminNotes = request()->input('admin_notes', 'Report dismissed by admin');

        DB::transaction(function () use ($report, $adminNotes) {
            $report->update([
                'status' => 'dismissed',
                'admin_notes' => $adminNotes,
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now()
            ]);
        });

        // Send email notifications
        $emailErrors = [];
        
        try {
            // Send email to reporter
            if ($reporter && $reporter->email) {
                Mail::to($reporter->email)
                    ->send(new ReportDismissedMail(
                        $reporter,
                        $report,
                        'reporter',
                        $adminNotes
                    ));
                \Log::info('Dismissal email sent to reporter: ' . $reporter->email);
            }

            // Send email to post owner
            if ($owner && $owner->email && (!$reporter || $reporter->id !== $owner->id)) {
                Mail::to($owner->email)
                    ->send(new ReportDismissedMail(
                        $owner,
                        $report,
                        'owner',
                        $adminNotes
                    ));
                \Log::info('Dismissal email sent to owner: ' . $owner->email);
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send dismissal email: ' . $e->getMessage());
            $emailErrors[] = $e->getMessage();
        }

        $message = 'Report dismissed successfully.';
        if (!empty($emailErrors)) {
            $message .= ' However, there were issues sending email notifications.';
        } else {
            $message .= ' Notifications sent to reporter and post owner.';
        }

        // Redirect back to previous page (show page or index)
        return back()->with('success', $message);
    }

    /**
     * Get report statistics (API endpoint or for dashboard)
     */
    public function getStatistics()
    {
        $stats = [
            'total' => Report::count(),
            'pending' => Report::where('status', 'pending')->count(),
            'resolved' => Report::where('status', 'resolved')->count(),
            'dismissed' => Report::where('status', 'dismissed')->count(),
            'action_taken' => Report::where('status', 'action_taken')->count(),
            'today' => Report::whereDate('created_at', today())->count(),
            'this_week' => Report::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Report::whereMonth('created_at', now()->month)->count()
        ];

        return response()->json($stats);
    }

    /**
     * Bulk update reports status
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'report_ids' => 'required|array',
            'report_ids.*' => 'exists:reports,id',
            'status' => 'required|in:pending,dismissed,resolved,action_taken'
        ]);

        DB::transaction(function () use ($request) {
            Report::whereIn('id', $request->report_ids)
                ->update([
                    'status' => $request->status,
                    'admin_notes' => $request->admin_notes ?? 'Bulk status update',
                    'reviewed_by' => auth()->id(),
                    'reviewed_at' => now()
                ]);
        });

        return redirect()->route('admin.reports.index')
            ->with('success', count($request->report_ids) . ' reports updated successfully');
    }

    /**
     * Export reports to CSV
     */
    public function export(Request $request)
    {
        $query = Report::with(['reporter', 'reportedUser', 'feed']);

        // Apply filters if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $reports = $query->get();

        // Generate CSV
        $filename = 'reports_export_' . now()->format('Y-m-d_His') . '.csv';
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Add headers
        fputcsv($handle, [
            'Report ID',
            'Status',
            'Message',
            'Reporter Name',
            'Reporter Email',
            'Post Owner Name',
            'Post Owner Email',
            'Post Title',
            'Reported Date',
            'Reviewed By',
            'Reviewed Date',
            'Admin Notes'
        ]);

        // Add data rows
        foreach ($reports as $report) {
            fputcsv($handle, [
                $report->id,
                $report->status,
                $report->message,
                $report->reporter->name ?? 'Unknown',
                $report->reporter->email ?? 'Unknown',
                $report->reportedUser->name ?? 'Unknown',
                $report->reportedUser->email ?? 'Unknown',
                $report->feed->title ?? 'Deleted Post',
                $report->created_at ? $report->created_at->format('Y-m-d H:i:s') : 'N/A',
                $report->reviewer->name ?? 'Not Reviewed',
                $report->reviewed_at ? $report->reviewed_at->format('Y-m-d H:i:s') : 'N/A',
                $report->admin_notes ?? ''
            ]);
        }

        fclose($handle);
        exit;
    }
}