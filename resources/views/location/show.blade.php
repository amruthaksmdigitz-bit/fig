@extends('layouts.main')

@section('content')

@php use Illuminate\Support\Str; @endphp

<style>

</style>

<div class="directory-listing-page">
    <div class="container py-4">

        <h2 class="text-center mb-4">Furniture Shops/Manufactures in {{$location->name}} </h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('home.directorylisting') }}" class="search-form mb-4">
            <div class="row">

                <div class="col-md-5 mb-2">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by name..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-5 mb-2">
                    <select name="location" class="form-control">
                        <option value=""> Select Location</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc->id }}"
                                {{ request('location') == $loc->id ? 'selected' : '' }}>
                                {{ $loc->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-primary w-100 btnnowfig">
                        Search
                    </button>
                </div>

            </div>
        </form>

        <!-- Total Count -->
        <div class="total-count mb-3">
            <strong>{{ $users->total() }}</strong> <span>Profiles found</span>
        </div>

         <!-- Profiles -->
    @if($users->count() > 0)

        <div class="row">
            @foreach($users as $user)

                <div class="col-md-6 mb-4">
                    <div class="card h-100">

                            <img src="{{ $user->profile_image 
                                ? asset($user->profile_image) 
                                : asset('assets/img/placefurn.jpg') }}"
                                style="height:300px; object-fit:cover;"
                                class="img-fluid rounded"
                                alt="Profile Image">
                        <div class="card-body">

                            <h5 class="card-title">
                                <a href="{{ url('userdetails/'.$user->id) }}">
                                    {{ $user->name }}
                                </a>
                            </h5>

                            <p class="text-muted mb-2">
                                {{ optional($user->location)->name ?? 'Location Not Specified' }}
                            </p>

                            <p class="card-text">
                                {{ Str::limit($user->description, 80) }}
                            </p>

                            <a href="{{ route('userdetails.show', $user) }}"
                               class="btn btn-sm btn-outline-primary">
                                View Profile
                            </a>

                        </div>
                    </div>
                </div>

            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>

    @else

        <div class="alert alert-info text-center">
            No Profiles Found
        </div>

    @endif
		
		
    </div>
</div>

@endsection
