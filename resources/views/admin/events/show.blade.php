@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">{{ $event->title }}</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Event Cover Image -->
            @if($event->image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $event->image) }}"
                    alt="Event Cover Image"
                    class="img-fluid rounded shadow-sm"
                    style="max-width: 600px; height: auto;">
                <span class="d-block mt-1 text-muted" style="font-size:15px;">Cover Image</span>
            </div>
            @else
            <p class="text-muted text-center">No cover image available for this event.</p>
            @endif

            <!-- Event Gallery Images -->
            <div class="mb-3">
                <strong>Gallery Images:</strong>
                <div class="d-flex flex-wrap gap-2 mt-2">
                    @if($event->images->count())
                    @foreach($event->images as $img)
                    <img src="{{ asset('storage/' . $img->path) }}"
                        alt="Gallery Image"
                        class="img-thumbnail shadow-sm"
                        style="width:120px;height:120px;object-fit:cover;">
                    @endforeach
                    @else
                    <span class="text-muted">No gallery images available.</span>
                    @endif
                </div>
            </div>

            <!-- Event Details -->
            <p><strong>Title:</strong> {{ $event->title }}</p>
            <p><strong>Date:</strong>
                {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
            </p>
            <p><strong>Description:</strong><br>
                {!! nl2br(e($event->description)) !!}
            </p>
            <p><strong>Location:</strong> {{ $event->location ?? 'N/A' }}</p>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary mt-3">Back to Events</a>
        </div>
    </div>
</div>
@endsection