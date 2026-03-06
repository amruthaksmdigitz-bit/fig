@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <!--begin::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $totalUsers ?? '0' }}</h3>
                    <p>Total Users</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                </svg>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    View All Users <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 2-->
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $newUsersLastMonth ?? '0' }}</h3>
                    <p>New Users (Last 30 Days)</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122z"></path>
                </svg>
                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    View Details <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 2-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 3-->
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $activeUsers ?? '0' }}</h3>
                    <p>Active Users</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M12 15a3 3 0 100-6 3 3 0 000 6z"></path>
                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                    View Active <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 3-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 4-->
            <div class="small-box text-bg-info">
                <div class="inner">
                    <h3>{{ $usersToday ?? '0' }}</h3>
                    <p>New Users Today</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd"></path>
                </svg>
                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    View Today <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 4-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-8 connectedSortable">
            <!-- User Registration Chart -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">User Registration Statistics</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-calendar"></i> Time Range
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="updateChartData('7days')">Last 7 Days</a>
                                <a class="dropdown-item" href="#" onclick="updateChartData('30days')">Last 30 Days</a>
                                <a class="dropdown-item" href="#" onclick="updateChartData('3months')">Last 3 Months</a>
                                <a class="dropdown-item" href="#" onclick="updateChartData('6months')">Last 6 Months</a>
                                <a class="dropdown-item" href="#" onclick="updateChartData('year')">This Year</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="userRegistrationChart" height="250"></canvas>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-end">
                                <span class="description-percentage text-success"><i class="bi bi-arrow-up"></i> {{ $growthRate ?? '0' }}%</span>
                                <h5 class="description-header">{{ $totalUsers ?? '0' }}</h5>
                                <span class="description-text">TOTAL USERS</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-end">
                                <span class="description-percentage text-warning"><i class="bi bi-arrow-right"></i> {{ $avgMonthly ?? '0' }}</span>
                                <h5 class="description-header">{{ $avgDaily ?? '0' }}</h5>
                                <span class="description-text">AVG DAILY REGISTRATION</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-end">
                                <span class="description-percentage text-success"><i class="bi bi-arrow-up"></i> {{ $monthlyGrowth ?? '0' }}%</span>
                                <h5 class="description-header">{{ $newUsersLastMonth ?? '0' }}</h5>
                                <span class="description-text">LAST MONTH</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <span class="description-percentage text-danger"><i class="bi bi-arrow-down"></i> {{ $churnRate ?? '0' }}%</span>
                                <h5 class="description-header">{{ $inactiveUsers ?? '0' }}</h5>
                                <span class="description-text">INACTIVE USERS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.Start col -->

        <!-- Start col -->
        <div class="col-lg-4 connectedSortable">
            <!-- Recent Users -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Recent Registrations</h3>
                    <div class="card-tools">
                        <span class="badge bg-danger">{{ $recentUsers->count() ?? '0' }} New Users</span>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        @foreach($recentUsers as $user)
                        <li>
                            <img  width="20px"  src="{{ $user->profile_image ?? asset('assets/img/default-avatar.png') }}" alt="User Image">
                            <a class="users-list-name" href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                            <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.users.index') }}">View All Users</a>
                </div>
            </div>
            <!-- /.card -->

            <!-- User Activity -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">User Activity</h3>
                </div>
                <div class="card-body">
                    <div class="progress-group">
                        Active Users
                        <span class="float-end"><b>{{ $activeUsers ?? '0' }}</b>/{{ $totalUsers ?? '0' }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: {{ $totalUsers > 0 ? ($activeUsers / $totalUsers * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="progress-group">
                        Verified Users
                        <span class="float-end"><b>{{ $verifiedUsers ?? '0' }}</b>/{{ $totalUsers ?? '0' }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: {{ $totalUsers > 0 ? ($verifiedUsers / $totalUsers * 100) : 0 }}%"></div>
                        </div>
                    </div>
                   
                    <div class="progress-group">
                        New Users This Month
                        <span class="float-end"><b>{{ $newUsersLastMonth ?? '0' }}</b></span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" style="width: {{ min(100, ($newUsersLastMonth / max(1, $totalUsers)) * 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.Start col -->
    </div>
    <!-- /.row -->

    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            <!-- User List Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Registration List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Registered</th>
                                <th>Last Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->profile_image ?? asset('assets/img/default-avatar.png') }}" width="30px" class="img-circle mr-2" alt="User Image">
                                        <div>
                                            <div class="font-weight-bold">{{ $user->name }}</div>
                                            <small class="text-muted">{{ '@' . $user->username }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                    
                                    @if($user->is_active)
                                        <span class="badge bg-primary">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                               <td>
    @if($user->last_login_at)
        {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}
    @else
        Never
    @endif
</td>
                
                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $user->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $users->links() }}
                    <div class="float-right">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add New User
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection

@push('styles')
<style>
.users-list {
    list-style: none;
    margin: 0;
    padding: 0;
}
.users-list > li {
    width: 25%;
    float: left;
    padding: 10px;
    text-align: center;
}
.users-list > li img {
    border-radius: 50%;
    max-width: 100%;
    height: auto;
}
.users-list-name,
.users-list-date {
    display: block;
}
.users-list-name {
    font-weight: 600;
    color: #495057;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.users-list-date {
    color: #6c757d;
    font-size: 12px;
}
.progress-group {
    margin-bottom: 1rem;
}
.description-block {
    padding: 0 1rem;
}
.description-block .description-header {
    margin: 0;
    padding: 0;
    font-weight: 600;
    font-size: 16px;
}
.description-block .description-text {
    text-transform: uppercase;
    font-size: 12px;
}
.description-block .description-percentage {
    font-size: 12px;
    font-weight: 600;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Initialize user registration chart
let userChart;

function initUserChart() {
    const ctx = document.getElementById('userRegistrationChart').getContext('2d');
    
    // Sample data - Replace with actual data from your controller
    const data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'User Registrations',
            data: [65, 59, 80, 81, 56, 55, 40, 45, 50, 60, 70, 75],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            tension: 0.4,
            fill: true
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 20
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    };

    userChart = new Chart(ctx, config);
}

function updateChartData(range) {
    // Fetch new data based on selected range
    fetch(`/admin/dashboard/user-stats?range=${range}`)
        .then(response => response.json())
        .then(data => {
            userChart.data.labels = data.labels;
            userChart.data.datasets[0].data = data.values;
            userChart.update();
        });
}

function confirmDelete(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Implement delete functionality
        fetch(`/admin/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}

// Initialize chart when page loads
document.addEventListener('DOMContentLoaded', function() {
    initUserChart();
});
</script>
@endpush