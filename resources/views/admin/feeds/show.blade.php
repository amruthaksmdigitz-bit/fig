@extends('layouts.admin')

@section('content')
    <div class="container">

        <h3>Feed Details</h3>

        <a href="{{ route('admin.feeds.index') }}" class="btn btn-secondary mb-3">
            Back
        </a>

        <div class="card">
            <div class="card-body">

                <p><strong>User :</strong> {{ $feed->user->name ?? '' }}</p>

                <p><strong>Title :</strong> {{ $feed->title }}</p>

                <hr>

                <h5>Images</h5>

                @foreach ($feed->images as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" width="150" style="margin:5px">
                @endforeach

            </div>
        </div>

    </div>
@endsection
