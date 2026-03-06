@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>User Detail</h1>

    <div class="mb-3">
        <strong>Profile Image:</strong><br>
        @if($user->profile_image)
        <img src="{{ asset($user->profile_image) }}" alt="Profile Image" class="img-thumbnail mt-2" width="150">
        @else
        <span class="text-muted">No profile image uploaded</span>
        @endif
    </div>

    <div class="mb-3">
        <strong>Cover Image:</strong><br>
        @if($user->cover_image)
        <img src="{{ asset($user->cover_image) }}" alt="Cover Image" class="img-thumbnail mt-2" width="150">
        @else
        <span class="text-muted">No cover image uploaded</span>
        @endif
    </div>

    <div class="mb-3">
        <strong>Multiple Images:</strong><br>
        @if($user->multipleImages->count())
        <div class="d-flex flex-wrap gap-2 mt-2">
            @foreach($user->multipleImages as $img)
            <img src="{{ asset($img->image) }}" alt="Gallery Image" class="img-thumbnail" width="150">
            @endforeach
        </div>
        @else
        <span class="text-muted">No Multiple images uploaded</span>
        @endif
    </div>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Location:</strong> {{ $user->location ?? '-' }}</p>
    <p><strong>Description:</strong> {{ $user->description ?? '-' }}</p>
    <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>

    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection