<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon bi bi-box-arrow-in-right"></i>
        <p>
            Feeds
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.feeds.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Manage Feeds</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.reports.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>
                    Reported Feeds
                    @php
                        $pendingCount = \App\Models\Report::where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="badge bg-danger right">{{ $pendingCount }}</span>
                    @endif
                </p>
            </a>
        </li>
    </ul>
</li>