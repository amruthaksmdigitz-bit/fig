@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ old('name') }}" type="text" name="name" id="name"
                class="form-control @error('name') is-invalid @enderror" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="{{ old('email') }}" type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="profile_image" class="form-label">Profile Image</label>
            <input type="file" name="profile_image" id="profile_image"
                class="form-control @error('profile_image') is-invalid @enderror" accept="image/*">
            @error('profile_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>

            <select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
                <option value=""> Select one</option>
                @foreach($locations as $location)
                <option value="{{$location->id}}"> {{$location->name}}</option>
                @endforeach

            </select>

            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="3"
                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            <input type="file" name="cover_image" id="cover_image"
                class="form-control @error('cover_image') is-invalid @enderror" accept="image/*">
            @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="multiple_images" class="form-label">Multiple Images</label>
            <input type="file" name="multiple_images[]" id="multiple_images"
                class="form-control @error('multiple_images.*') is-invalid @enderror"
                accept="image/*" multiple>
            @error('multiple_images.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary" type="submit">Create</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection