@extends('layouts.main')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="container py-4">

    <h2 class="text-center mb-4">Directory Listing</h2>

    <div class="row">

        <!-- ================= LEFT SIDE SEARCH FILTER ================= -->
        <div class="col-md-3 mb-4">

            <div class="card">
                <div class="card-header bg-fig text-white">
                    Search Directory
                </div>

                <div class="card-body">
                    <form method="GET" action="{{ route('home.directorylisting') }}">

                        <!-- Search by Name -->
                        <div class="form-group">
                            <label>Search by Name</label>
                            <input type="text" name="search" class="form-control" placeholder="Enter name" value="{{ request('search') }}">
                        </div>

                        <!-- Location Filter -->
                        <div class="form-group">
                            <label>Select Location</label>
                            <select name="location" id="location" class="form-control">
                                <option value="">All Locations</option>
                            </select>
                        </div>


                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary btn-block btn-fig">
                            Search
                        </button>

                    </form>
                </div>
            </div>

        </div>

        <!-- ================= RIGHT SIDE DIRECTORY LIST ================= -->
        <div class="col-md-9 popular-location">

            <!-- Total Count -->
            <div class="mb-3">
                <strong>{{ $users->total() }}</strong> Profiles found
            </div>

            @if($users->count() > 0)

            <div class="row">
                @foreach($users as $user)

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-location mb-30">
                        <a href="{{ route('userdetails.show', $user) }}">
                            <div class="location-img">


                                <img src="{{ $user->profile_image 
                                ? asset($user->profile_image) 
                                : asset('assets/img/placefurn.jpg') }}" style="height:300px; object-fit:cover;" class="img-fluid rounded" alt="Profile Image">

                            </div>
                        </a>
                        <div class="location-details">
                            <h2 class="mb-2" style="color:white">{{ $user->name }}</h2>
                            @if($user->location)
                            <a href="{{ route('location.show', $user->location->slug) }}" class="location-btn mt-2 d-inline-block">
                                {{ $user->location->name }}
                            </a>
                            @else
                            <span class="location-btn mt-2 d-inline-block">
                                No Location
                            </span>
                            @endif
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

</div>


@endsection