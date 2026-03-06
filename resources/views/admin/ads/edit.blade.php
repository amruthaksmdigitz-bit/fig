@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Ad</h1>

    <form action="{{ route('admin.ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $ad->title) }}" required>
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="image">Image</label>
            @if($ad->image)
            <div class="mb-2">
                <img src="{{ asset($ad->image) }}" alt="Ad Image" width="100">
            </div>
            @endif
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="link">Link (URL)</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ old('link', $ad->link) }}">
            @error('link') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $ad->description) }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection