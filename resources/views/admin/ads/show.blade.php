@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Ad Details</h1>

    <p><strong>Title:</strong> {{ $ad->title }}</p>

    <p><strong>Image:</strong><br>
        @if($ad->image)
        <img src="{{ asset($ad->image) }}" width="200" alt="Ad Image">
        @else
        <span>No image uploaded</span>
        @endif
    </p>

    <p><strong>Link:</strong> <a href="{{ $ad->link }}" target="_blank">{{ $ad->link }}</a></p>

    <p><strong>Description:</strong><br>
        {!! nl2br(e($ad->description)) !!}
    </p>

    <p><strong>Status:</strong> {{ $ad->status ? 'Active' : 'Inactive' }}</p>

    <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection