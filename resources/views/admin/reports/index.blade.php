@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Reported Feeds</h3>

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

    <!-- Statistics Cards -->
    <div class="row mt-4">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total'] }}</h3>
                    <p>Total Reports</p>
                </div>
                <div class="icon">
                    <i class="bi bi-flag"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['pending'] }}</h3>
                    <p>Pending</p>
                </div>
                <div class="icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['resolved'] }}</h3>
                    <p>Resolved</p>
                </div>
                <div class="icon">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $stats['dismissed'] }}</h3>
                    <p>Dismissed</p>
                </div>
                <div class="icon">
                    <i class="bi bi-x-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ url('admin/reports') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control" placeholder="Search by title, reporter, or message">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            @if(request()->has('search') || request()->has('status'))
            <div class="col-md-2">
                <a href="{{ url('admin/reports') }}" class="btn btn-secondary">Clear Filters</a>
            </div>
            @endif
        </div>
    </form>

    <!-- Filter Form -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="bi bi-filter me-1"></i>
            Filter Reports
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3">
                @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="dismissed" {{ request('status') == 'dismissed' ? 'selected' : '' }}>Dismissed</option>
                        <option value="action_taken" {{ request('status') == 'action_taken' ? 'selected' : '' }}>Action Taken</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                    <a href="{{ url('admin/reports') }}" class="btn btn-secondary ms-2">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Reported Feeds List</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Post Title</th>
                        <th>Image</th>
                        <th>Report Message</th>
                        <th>Reporter</th>
                        <th>Post Owner</th>
                        <th>Status</th>
                        <th>Reported Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td>#{{ $report->id }}</td>
                        <td>
                            @if($report->feed)
                            <strong>{{ $report->feed->title }}</strong>
                            @if($report->feed->is_hidden)
                            <span class="badge bg-warning">Hidden</span>
                            @endif
                            <br>
                            <small class="text-muted">Reports: {{ $report->feed->report_count ?? 0 }}</small>
                            @else
                            <span class="text-danger">Post Deleted</span>
                            @endif
                        </td>
                        <td>
                            @if($report->feed && $report->feed->images->count())
                            <img src="{{ asset('storage/'.$report->feed->images->first()->image) }}" width="50" height="50" style="object-fit: cover;" class="rounded">
                            @else
                            <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <small>{{ Str::limit($report->message, 50) }}</small>
                            @if($report->screenshot)
                            <br>
                            <a href="{{ asset('storage/'.$report->screenshot) }}" target="_blank" class="badge bg-info">
                                <i class="bi bi-image"></i> Evidence
                            </a>
                            @endif
                        </td>
                        <td>{{ $report->reporter->name ?? 'Unknown' }}</td>
                        <td>{{ $report->reportedUser->name ?? 'Unknown' }}</td>
                        <td>
                            @if($report->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                            @elseif($report->status == 'resolved')
                            <span class="badge bg-success">Resolved</span>
                            @elseif($report->status == 'dismissed')
                            <span class="badge bg-secondary">Dismissed</span>
                            @else
                            <span class="badge bg-info">Action Taken</span>
                            @endif
                        </td>
                        <td>{{ $report->created_at ? $report->created_at->format('Y-m-d') : 'N/A' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ url('admin/reports/' . $report->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> View
                                </a>

                                @if($report->feed)
                                {{-- <!-- Hide Post Form -->
        <form action="{{ url('admin/reports/hide-post/' . $report->feed->id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Hide this post? It will be hidden from public view.')">
                                    <i class="bi bi-eye-slash"></i> Hide
                                </button>
                                </form> --}}

                                <!-- Delete Post Form -->
                                <form action="{{ url('admin/reports/delete-post/' . $report->feed->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this post? All images will be removed. This action cannot be undone!\\n\\nBoth the reporter and post owner will receive email notifications about this deletion.')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                                @endif

                                <!-- Dismiss Report Button with Modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#dismissModal{{ $report->id }}">
                                    <i class="bi bi-check"></i> Dismiss
                                </button>

                                <!-- Dismiss Modal -->
                                <div class="modal fade" id="dismissModal{{ $report->id }}" tabindex="-1" aria-labelledby="dismissModalLabel{{ $report->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('admin/reports/dismiss/' . $report->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="dismissModalLabel{{ $report->id }}">Dismiss Report #{{ $report->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to dismiss this report?</p>
                                                    <p><strong>Post:</strong> {{ $report->feed->title ?? 'Deleted Post' }}</p>
                                                    <p><strong>Reporter:</strong> {{ $report->reporter->name ?? 'Unknown' }}</p>

                                                    <div class="mb-3">
                                                        <label for="admin_notes{{ $report->id }}" class="form-label">Admin Notes (Optional)</label>
                                                        <textarea class="form-control" id="admin_notes{{ $report->id }}" name="admin_notes" rows="3" placeholder="Add any notes about why this report is being dismissed..."></textarea>
                                                        <div class="form-text">These notes will be included in the email notifications.</div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bi bi-check"></i> Confirm Dismiss
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No reports found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $reports->withQueryString()->links() }}
        </div>
    </div>
</div>

@push('styles')
<style>
    .small-box {
        border-radius: 0.25rem;
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        display: block;
        margin-bottom: 20px;
        position: relative;
    }

    .small-box>.inner {
        padding: 10px;
        color: #fff;
    }

    .small-box>.inner h3 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0 0 10px;
        padding: 0;
        white-space: nowrap;
        color: #fff;
    }

    .small-box>.inner p {
        color: #fff;
        font-size: 1rem;
    }

    .small-box .icon {
        color: rgba(0, 0, 0, .15);
        font-size: 70px;
        position: absolute;
        right: 15px;
        top: 15px;
        transition: all .3s linear;
    }

    .small-box .icon i {
        font-size: 70px;
    }

    .small-box.bg-info {
        background-color: #17a2b8;
    }

    .small-box.bg-warning {
        background-color: #ffc107;
    }

    .small-box.bg-success {
        background-color: #28a745;
    }

    .small-box.bg-secondary {
        background-color: #6c757d;
    }

    .btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .btn-group .btn {
        margin-right: 0 !important;
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