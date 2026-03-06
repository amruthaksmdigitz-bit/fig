@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Location Details</h2>
    <p><strong>ID:</strong> {{ $location->id }}</p>
    <p><strong>Name:</strong> {{ $location->name }}</p>
    <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection