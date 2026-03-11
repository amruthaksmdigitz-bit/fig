<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Feed;
use App\Models\User; 
use App\Mail\ReportSubmittedAdmin; 
use App\Mail\ReportSubmittedPostOwner;
use App\Mail\ReportConfirmationReporter; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Log; 

class ReportController extends Controller
{
    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'feed_id' => 'required|exists:feeds,id',
                'message' => 'required|string|min:10|max:1000',
                'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
            ]);

            // Get the feed to find the reported user
            $feed = Feed::with('user')->findOrFail($request->feed_id);

            // Check if user is trying to report their own post
            if ($feed->user_id === Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot report your own post'
                ], 400);
            }

            // Check if user has already reported this post
            $existingReport = Report::where('reporter_id', Auth::id())
                ->where('feed_id', $request->feed_id)
                ->first();

            if ($existingReport) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already reported this post'
                ], 400);
            }

            $reportData = [
                'reporter_id' => Auth::id(),
                'feed_id' => $request->feed_id,
                'reported_user_id' => $feed->user_id,
                'message' => $request->message,
            ];

            // Handle screenshot upload if present
            if ($request->hasFile('screenshot') && $request->file('screenshot')->isValid()) {
                $path = $request->file('screenshot')->store('reports/screenshots', 'public');
                $reportData['screenshot'] = $path;
            }

            $report = Report::create($reportData);
            
            // Load relationships for email
            $report->load(['feed', 'reporter', 'reportedUser']);

            // ========== SEND EMAIL NOTIFICATIONS ==========
            
            // 1. Send to all admins (role_id = 1)
            try {
                $admins = User::where('role_id', 1)->get(); // role_id 1 is admin
                
                if ($admins->count() > 0) {
                    foreach ($admins as $admin) {
                        Mail::to($admin->email)->send(new ReportSubmittedAdmin($report));
                    }
                }
            } catch (\Exception $e) {
                Log::error('Admin email failed: ' . $e->getMessage());
            }

            // 2. Send to post owner
            try {
                Mail::to($feed->user->email)->send(new ReportSubmittedPostOwner($report));
            } catch (\Exception $e) {
                Log::error('Post owner email failed: ' . $e->getMessage());
            }

            // 3. Send confirmation to reporter
            try {
                Mail::to(Auth::user()->email)->send(new ReportConfirmationReporter($report));
            } catch (\Exception $e) {
                Log::error('Reporter email failed: ' . $e->getMessage());
            }
            
            // ========== END EMAIL NOTIFICATIONS ==========

            return response()->json([
                'success' => true,
                'message' => 'Report submitted successfully',
                'data' => $report
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the report',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}