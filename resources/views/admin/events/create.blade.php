@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Create Event</h1>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Date <span class="text-danger">*</span></label>
            <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}" required>
            @error('event_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
            @error('location') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Image Upload Section -->
        <div class="mb-3">
            <label class="form-label">Event Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <!-- Multiple Images Upload Section -->
        <div class="mb-3">
            <label class="form-label">Event Gallery Images</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
            @error('images.*') <div class="text-danger">{{ $message }}</div> @enderror
        </div>


        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection