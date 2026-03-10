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

                <div class="row">

@foreach ($feed->images as $image)

<div class="col-md-3 mb-3">

<div class="position-relative">

<a data-fancybox="gallery" href="{{ asset('storage/'.$image->image) }}">
    <img src="{{ asset('storage/'.$image->image) }}"
         class="img-fluid rounded"
         style="height:150px;width:100%;object-fit:cover;">
</a>

<!-- Delete Icon -->
<form action="{{ route('admin.feed-images.delete',$image->id) }}"
      method="POST">

@csrf
@method('DELETE')

<button type="submit"
        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle">

<i class="bi bi-trash"></i>

</button>

</form>

</div>

</div>

@endforeach

</div>
        </div>

    </div>
@endsection
