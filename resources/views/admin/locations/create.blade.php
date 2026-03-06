@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Add Location</h2>
    <form action="{{ route('admin.locations.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Location Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection