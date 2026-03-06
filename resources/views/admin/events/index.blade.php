@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Events</h1>

    <a href="{{ route('admin.events.create') }}" class="btn btn-success mb-3">Create New Event</a>

    <!-- Search Form: aligned right -->
    <div class="d-flex justify-content-end mb-4" style="max-width: 100%;">
        <form method="GET" action="{{ route('admin.events.index') }}" class="d-flex align-items-center" style="gap:10px; max-width: 400px;">
            <input
                type="text"
                name="search"
                class="form-control"
                value="{{ request('search') }}"
                placeholder="Search by title, location..."
                style="max-width:260px;"
                autocomplete="off">
            <button type="submit" class="btn btn-outline-primary" style="font-weight:600;">Search</button>
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card-body">
        @if($events->isEmpty())
        <p>No events found.</p>
        @else
        <table class="table table-bordered align-middle table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Gallery</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>
                        @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($event->images->count())
                        <div class="d-flex flex-wrap" style="gap:3px;">
                            @foreach($event->images->take(3) as $img)
                            <img src="{{ asset('storage/' . $img->path) }}" style="width:40px;height:40px;object-fit:cover;" class="img-thumbnail">
                            @endforeach
                        </div>
                        @else
                        <span class="text-muted">No Gallery</span>
                        @endif
                    </td>
                    <td>{{ $event->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</td>
                    <td>{{ $event->location }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection