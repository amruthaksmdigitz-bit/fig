@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Analytics Dashboard</h1>
        <div class="btn-group">
            <a href="?days=7" class="btn btn-outline-primary {{ $selectedDays == 7 ? 'active' : '' }}">7 Days</a>
            <a href="?days=30" class="btn btn-outline-primary {{ $selectedDays == 30 ? 'active' : '' }}">30 Days</a>
            <a href="?days=90" class="btn btn-outline-primary {{ $selectedDays == 90 ? 'active' : '' }}">90 Days</a>
        </div>
    </div>

    <!-- Realtime Counter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="text-white">Active Users Right Now</h5>
                            <h2 class="text-white">{{ $realtimeUsers }}</h2>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-white opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="row mb-4">
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Sessions</h6>
                    <h3>{{ number_format($metrics['sessions']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Users</h6>
                    <h3>{{ number_format($metrics['users']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Page Views</h6>
                    <h3>{{ number_format($metrics['pageviews']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Bounce Rate</h6>
                    <h3>{{ $metrics['bounce_rate'] }}%</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Avg. Session</h6>
                    <h3>{{ $metrics['avg_session_duration'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="text-muted">Pages/Session</h6>
                    <h3>{{ $metrics['pages_per_session'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Visitors & Page Views</h5>
                </div>
                <div class="card-body">
                    <canvas id="analyticsChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Most Visited Pages</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th class="text-end">Pageviews</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mostVisitedPages as $page)
                                <tr>
                                    <td>{{ Str::limit($page['pageTitle'], 50) }}</td>
                                    <td class="text-end">{{ number_format($page['pageViews']) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Top Browsers</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Browser</th>
                                    <th class="text-end">Sessions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topBrowsers as $browser)
                                <tr>
                                    <td>{{ $browser['browser'] }}</td>
                                    <td class="text-end">{{ number_format($browser['sessions']) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('analyticsChart').getContext('2d');
    
    fetch('{{ route("admin.analytics.chart") }}?days={{ $selectedDays }}')
        .then(response => response.json())
        .then(data => {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
});
</script>
@endpush