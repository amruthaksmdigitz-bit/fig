@extends('layouts.admin') {{-- adjust if you have another layout --}}

@section('title', 'View Post')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>{{ $post->title }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Category:</strong> {{ $post->category->name ?? '—' }}</p>
            <p><strong>Author:</strong> {{ $post->user->name ?? '—' }}</p>
            <p><strong>Slug:</strong> {{ $post->slug }}</p>
            <p><strong>Created:</strong> {{ $post->created_at->format('d M Y, H:i') }}</p>

            <hr>

            <div class="mb-3">
                <strong>Content:</strong>
                <div class="mt-2">{!! nl2br(e($post->body)) !!}</div>
            </div>

            @if($post->image)
                <div class="mb-3">
                    <strong>Featured Image:</strong><br>
                    <img src="{{ asset( $post->image) }}" alt="Post Image" style="max-width: 300px;">
                </div>
            @endif
        </div>

        @if($post->highlighted_image)
        <div class="highlighted-image">
            <img src="{{ $post->highlighted_image_url }}" alt="{{ $post->title }}" class="img-fluid">
        </div>
    @endif


        <div class="card-footer text-end">
            <a href="{{ route('admin.page.index', $slug) }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('admin.page.edit', $post->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.page.destroy', $post->id) }}"
                  method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this post?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
