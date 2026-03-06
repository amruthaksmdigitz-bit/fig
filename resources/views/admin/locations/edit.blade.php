@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Location</h2>
    <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label>Location Name</label>
            <input type="text" name="name" class="form-control" value="{{ $location->name }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection