@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mb-3">New Post</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Highlighted Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>

                {{-- Normal Image --}}
                <td>
                    @if($post->image && file_exists(public_path($post->image)))
                        <img src="{{ asset($post->image) }}" 
                             alt="{{ $post->title }}" 
                             width="80" height="60"
                             style="object-fit: cover; border-radius: 4px;">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>

                {{-- Highlighted Image --}}
                <td>
                    @if($post->highlighted_image && file_exists(public_path($post->highlighted_image)))
                        <img src="{{ asset($post->highlighted_image) }}" 
                             alt="{{ $post->title }} banner" 
                             width="80" height="60"
                             style="object-fit: cover; border-radius: 4px;">
                    @else
                        @if($post->category_slug === 'abouts')
                            <span class="badge bg-warning">About page - No banner</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    @endif
                </td>

                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name ?? '-' }}</td>
                <td>{{ $post->published ? 'Yes' : 'No' }}</td>

                <td>
                    <a href="{{ route('admin.page.show', $post->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.page.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.page.destroy', $post->id) }}" 
                          method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" 
                                onclick="return confirm('Delete?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No posts yet.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection
