@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Locations</h2>
    <a href="{{ route('admin.locations.create') }}" class="btn btn-primary mb-3">Add Location</a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th width="200px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $location)
            <tr>
                <td>{{ $location->id }}</td>
                <td>{{ $location->name }}</td>
                <td>
                    <a href="{{ route('admin.locations.show', $location->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this location?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection