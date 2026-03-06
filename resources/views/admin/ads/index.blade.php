@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Ads List</h1>
    <a href="{{ route('admin.ads.create') }}" class="btn btn-primary mb-3">Create New Ad</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Link</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ads as $ad)
            <tr>
                <td>{{ $ad->id }}</td>
                <td>{{ $ad->title }}</td>
                <td>
                    @if($ad->image)
                    <img src="{{ asset($ad->image) }}" alt="Ad Image" width="80">
                    @endif
                </td>
                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    @if($ad->link)
                    <a href="{{ $ad->link }}" target="_blank">{{ $ad->link }}</a>
                    @endif
                </td>

                <td>{{ $ad->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('admin.ads.show', $ad) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('admin.ads.edit', $ad) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $ads->links() }}
</div>
@endsection