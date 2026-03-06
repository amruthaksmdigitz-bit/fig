@extends('layouts.admin')

@section('content')
<div class="container card card-primary ">
    <h1>Create Page</h1>

    @php
        $isAboutPage = (isset($slug) && $slug === 'about-s');
    @endphp
    
    <form action="{{ route('admin.page.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="post_category_id" value="{{ $categoryId }}">
        <input type="hidden" name="category_slug" value="{{ $slug }}">

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Highlighted Image ONLY for About page --}}
        @if($isAboutPage)
            <div class="mb-3">
                <label>Highlighted Image</label>
                <input type="file" name="highlighted_image" class="form-control">
                <small class="text-muted">Displayed as banner on the About Us page.</small>
                @error('highlighted_image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        @endif

        <div class="form-check mb-3">
            <input type="checkbox" name="published" class="form-check-input" id="published">
            <label class="form-check-label" for="published">Publish</label>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
