@extends('layouts.admin')

@section('content')
<div class="container card card-primary ">
    <h1>Edit Page</h1>

    @php
        $isAboutPage = ($page->category_slug === 'about-s');
    @endphp

    <form action="{{ route('admin.page.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control">
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ old('body', $page->body) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            @if($page->image)
                <img src="{{ asset($page->image) }}" class="img-thumbnail mb-2" style="max-height: 150px;">
            @endif
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Highlighted image ONLY for About page --}}
        @if($isAboutPage)
            <div class="mb-3">
                <label>Highlighted Image (About Page Only)</label><br>

                @if($page->highlighted_image)
                    <img src="{{ asset($page->highlighted_image) }}" class="img-thumbnail mb-2" style="max-height: 150px;">
                @endif

                <input type="file" name="highlighted_image" class="form-control">
                <small class="text-muted">This image appears as the banner on the About Us page.</small>
                @error('highlighted_image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @else
            {{-- Make sure highlighted_image is cleared for non-about pages --}}
            <input type="hidden" name="highlighted_image" value="">
        @endif

        <div class="form-check mb-3">
            <input type="checkbox" name="published" class="form-check-input" id="published" {{ $page->published ? 'checked' : '' }}>
            <label class="form-check-label" for="published">Publish</label>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
