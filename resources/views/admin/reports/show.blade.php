@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Report Details #{{ $report->id }}</h3>

    <a href="{{ url('admin/reports') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Back to Reports
    </a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Report Details -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-flag-fill me-2"></i>Report Information
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 150px;" class="bg-light">Message:</th>
                            <td>{{ $report->message ?? 'No message provided' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status:</th>
                            <td>
                                @if($report->status == 'pending')
                                    <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                @elseif($report->status == 'resolved')
                                    <span class="badge bg-success px-3 py-2">Resolved</span>
                                @elseif($report->status == 'dismissed')
                                    <span class="badge bg-secondary px-3 py-2">Dismissed</span>
                                @elseif($report->status == 'action_taken')
                                    <span class="badge bg-info px-3 py-2">Action Taken</span>
                                @else
                                    <span class="badge bg-dark px-3 py-2">{{ $report->status ?? 'Unknown' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Reported At:</th>
                            <td>
                                @if($report->created_at)
                                    {{ $report->created_at->format('F d, Y h:i A') }}
                                    <small class="text-muted d-block">{{ $report->created_at->diffForHumans() }}</small>
                                @else
                                    <span class="text-muted">Not available</span>
                                @endif
                            </td>
                        </tr>
                        @if($report->reviewed_at)
                        <tr>
                            <th class="bg-light">Reviewed By:</th>
                            <td>
                                {{ $report->reviewer->name ?? 'Unknown' }} 
                                @if($report->reviewed_at)
                                    on {{ $report->reviewed_at->format('F d, Y h:i A') }}
                                    <small class="text-muted d-block">{{ $report->reviewed_at->diffForHumans() }}</small>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @if($report->admin_notes)
                        <tr>
                            <th class="bg-light">Admin Notes:</th>
                            <td>{{ $report->admin_notes }}</td>
                        </tr>
                        @endif
                    </table>

                    @if($report->screenshot)
                    <div class="mt-4">
                        <h5 class="border-bottom pb-2">
                            <i class="bi bi-image me-2"></i>Evidence Screenshot
                        </h5>
                        <div class="text-center">
                            <a href="{{ asset('storage/'.$report->screenshot) }}" target="_blank" class="d-block">
                                <img src="{{ asset('storage/'.$report->screenshot) }}" 
                                     class="img-fluid border rounded shadow-sm" 
                                     style="max-height: 400px; cursor: pointer;"
                                     alt="Report evidence screenshot">
                            </a>
                            <small class="text-muted mt-2 d-block">Click image to view full size</small>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Reporter and Owner Details -->
        <div class="col-md-4">
            <!-- Reporter Card -->
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-person-fill me-2"></i>Reporter
                    </h3>
                </div>
                <div class="card-body">
                    @if($report->reporter)
                        <div class="text-center mb-3">
                            <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-2">
                                <i class="bi bi-person-circle fs-1"></i>
                            </div>
                        </div>
                        <table class="table table-sm">
                            <tr>
                                <th>Name:</th>
                                <td>{{ $report->reporter->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>
                                    <a href="mailto:{{ $report->reporter->email }}">
                                        {{ $report->reporter->email }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>User ID:</th>
                                <td>#{{ $report->reporter->id }}</td>
                            </tr>
                            <tr>
                                <th>Joined:</th>
                                <td>
                                    @if($report->reporter->created_at)
                                        {{ $report->reporter->created_at->format('M d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="bi bi-exclamation-circle fs-1"></i>
                            <p class="mt-2">Reporter information not available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Post Owner Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-warning">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-person-badge-fill me-2"></i>Post Owner
                    </h3>
                </div>
                <div class="card-body">
                    @if($report->reportedUser)
                        <div class="text-center mb-3">
                            <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-2">
                                <i class="bi bi-person-badge fs-1"></i>
                            </div>
                        </div>
                        <table class="table table-sm">
                            <tr>
                                <th>Name:</th>
                                <td>{{ $report->reportedUser->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>
                                    <a href="mailto:{{ $report->reportedUser->email }}">
                                        {{ $report->reportedUser->email }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>User ID:</th>
                                <td>#{{ $report->reportedUser->id }}</td>
                            </tr>
                            <tr>
                                <th>Joined:</th>
                                <td>
                                    @if($report->reportedUser->created_at)
                                        {{ $report->reportedUser->created_at->format('M d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="bi bi-exclamation-circle fs-1"></i>
                            <p class="mt-2">Post owner information not available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reported Post Details -->
    @if($report->feed)
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h3 class="card-title mb-0">
                <i class="bi bi-file-text-fill me-2"></i>Reported Post
                @if($report->feed->is_hidden)
                    <span class="badge bg-warning text-dark ms-2">Hidden</span>
                @endif
                <span class="badge bg-info ms-2">Report Count: {{ $report->feed->report_count ?? 0 }}</span>
                @if($report->feed->created_at)
                <small class="text-white-50 ms-2">Posted {{ $report->feed->created_at->diffForHumans() }}</small>
                @endif
            </h3>
        </div>
        <div class="card-body">
            <h5 class="border-bottom pb-2">{{ $report->feed->title ?? 'Untitled Post' }}</h5>
            
            @if($report->feed->images && $report->feed->images->count() > 0)
                <div class="row mt-3">
                    @foreach($report->feed->images as $image)
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="position-relative">
                            <a href="{{ asset('storage/'.$image->image) }}" target="_blank" class="d-block">
                                <img src="{{ asset('storage/'.$image->image) }}" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="height:150px; width:100%; object-fit:cover;"
                                     alt="Post image">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center py-3">No images attached to this post</p>
            @endif

            @if($report->feed->deleted_at)
                <div class="alert alert-danger mt-3 mb-0">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    This post has been deleted on {{ $report->feed->deleted_at->format('F d, Y h:i A') }}
                </div>
            @endif
        </div>
    </div>
    @else
    <div class="card mt-4 shadow-sm">
        <div class="card-body text-center text-muted py-4">
            <i class="bi bi-file-x fs-1"></i>
            <p class="mt-2">The reported post has been deleted or is no longer available</p>
        </div>
    </div>
    @endif

    <!-- Take Action Form -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">
                <i class="bi bi-lightning-charge-fill me-2"></i>Take Action
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/reports/' . $report->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="dismissed" {{ $report->status == 'dismissed' ? 'selected' : '' }}>Dismissed</option>
                            <option value="action_taken" {{ $report->status == 'action_taken' ? 'selected' : '' }}>Action Taken</option>
                        </select>
                    </div>

                    @if($report->feed)
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Moderation Action</label>
                        <select name="action" class="form-select">
                            <option value="">Select Action (Optional)</option>
                            {{-- <option value="hide_post">Hide Post (Hide from public view)</option> --}}
                            <option value="delete_post">Delete Post (Permanently remove)</option>
                            <option value="ignore">Ignore (No action on post)</option>
                        </select>
                        <small class="text-muted">Choose an action to apply to the reported post</small>
                    </div>
                    @endif

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Admin Notes</label>
                        <textarea name="admin_notes" class="form-control" rows="3" 
                            placeholder="Add notes about your decision...">{{ $report->admin_notes }}</textarea>
                        <small class="text-muted">These notes are internal and won't be visible to users</small>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i> Update Report
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise me-2"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Quick Actions -->
    @if($report->feed)
    <div class="mt-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2" role="group">
                    {{-- <!-- Hide Post Form -->
                    <form action="{{ url('admin/reports/hide-post/' . $report->feed->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to hide this post? It will be hidden from public view.')">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-eye-slash me-2"></i> Hide Post
                        </button>
                    </form> --}}

                    <!-- Delete Post Form -->
                    <form action="{{ url('admin/reports/delete-post/' . $report->feed->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('WARNING: Are you sure you want to permanently delete this post? All images will be removed. This action cannot be undone!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i> Delete Post
                        </button>
                    </form>

                    <!-- Dismiss Report Form -->
                    <form action="{{ url('admin/reports/dismiss/' . $report->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Dismiss this report? The report will be marked as dismissed.')">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-2"></i> Dismiss Report
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Report Metadata -->
    <div class="mt-4 text-muted small">
        <div class="row">
            <div class="col-md-6">
                <p><i class="bi bi-info-circle me-1"></i> Report ID: #{{ $report->id }}</p>
                <p><i class="bi bi-clock me-1"></i> Last Updated: 
                    @if($report->updated_at)
                        {{ $report->updated_at->format('F d, Y h:i A') }}
                    @else
                        Never
                    @endif
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <form action="{{ url('admin/reports/' . $report->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-danger p-0" 
                            onclick="return confirm('Delete this report record? This will not delete the post.')">
                        <i class="bi bi-trash"></i> Delete Report Record
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
    }
    .badge {
        font-size: 0.9rem;
        font-weight: 500;
    }
    .card-header {
        font-weight: 600;
    }
    .d-flex.gap-2 {
        gap: 0.5rem !important;
    }
    .d-flex.gap-2 .btn {
        min-width: 120px;
    }
    @media (max-width: 768px) {
        .d-flex.gap-2 {
            flex-direction: column;
        }
        .d-flex.gap-2 .btn {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500);
        });
    }, 5000);
</script>
@endpush
@endsection