@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Event</h1>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Date <span class="text-danger">*</span></label>
            <input type="date" name="event_date" class="form-control"
                value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d')) }}" required>
            @error('event_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $event->description) }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}">
            @error('location') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Single Cover Image Upload Section -->
        <div class="mb-3">
            <label class="form-label">Event Cover Image</label>
            @if($event->image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-thumbnail" style="max-width: 200px;">
            </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Multiple Gallery Images Upload Section -->
        <div class="mb-3">
            <label class="form-label">Event Gallery Images</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
            @error('images.*') <div class="text-danger">{{ $message }}</div> @enderror
            @if($event->images->count())
            <div class="row mt-3">
                @foreach($event->images as $img)
                <div class="col-auto mb-2">
                    <img src="{{ asset('storage/' . $img->path) }}" class="img-thumbnail" style="max-width: 100px;">
                    <label class="small">
                        <input type="checkbox" name="delete_images[]" value="{{ $img->id }}">
                        Remove
                    </label>
                </div>
                @endforeach
            </div>
            
            @endif


        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection