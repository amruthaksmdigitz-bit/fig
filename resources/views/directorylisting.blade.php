@extends('layouts.main')

@section('content')

<main>
        <!-- Hero Start-->
        <div class="hero-area3 hero-overly2 d-flex align-items-center " style="background: url('{{ asset($banner->image ?? 'assets/img/hero/default.jpg') }}')">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9">
                        <div class="hero-cap text-center pt-50 pb-20">
                            <h2>Directory Listing</h2>
                        </div>
                        <!--Hero form -->
                        <form method="GET" action="{{ route('home.directorylisting') }}" class="search-box search-box2">
    <div class="input-form">
        <input name="search" type="text"
               value="{{ request('search') }}"
               placeholder="Search by name..."
               autocomplete="off"
               class="form-control">
    </div>
    
    <div class="select-form">
        <div class="select-itms">
            <select name="location" id="select1">
                <option value="">All Locations</option>
                @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                    {{ $location->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="search-form">
        <input type="submit" class="searchsubmit" value="Search">
    </div>	
</form>
                    
                    </div>
                </div>
            </div>
        </div>
        <!--Hero End -->
        
                    <!-- Right content -->
                    <div class="row d-flex justify-content-center text-center">
                       
                        <!-- listing Details Stat-->
                        <div class="listing-details-area">
                            <div class="container">
                                    @foreach($users as $user)
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="single-listing mb-30">
                <div class="list-img">
                    <img src="{{ asset($user->profile_image ?? 'images/default.png') }}" alt="{{ $user->name }}">
                </div>
                <div class="list-caption">
                    <h3>
                        <a href="{{ url('userdetails/' . $user->id) }}">
                            {{ $user->name }}
                        </a>
                    </h3>
                    <p>
                        {{ $user->locationRelation ? $user->locationRelation->name : 'No Location' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- ✅ Pagination -->
<div class="row">
    <div class="col-12 d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>
                            </div>
                        </div>
                        <!-- listing Details End -->
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- listing-area Area End -->

    </main>
    
@endsection