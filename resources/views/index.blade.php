@extends('layouts.main')

@section('content')
    <main>
        <style>


        </style>
        <!-- Hero Area Start - With lazy background -->
        <div class="slider-area hero-overly" data-bg="{{ asset($slider->image) }}">
            <div class="single-slider hero-overly slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-9">

                            <!-- Hero Caption -->
                            <div class="hero__caption">
                                <span>{{ $slider->title }}</span>
                            </div>

                            <!-- Hero form -->
                            <form class="search-box" method="GET" action="{{ route('home.directorylisting') }}">
                                <div class="input-form">
                                    <input name="search" type="text" placeholder="What are you looking for?"
                                        value="{{ request('search') }}">
                                </div>

                                <!-- 🔽 ENHANCED LOCATION SELECT WITH SELECT2 -->
                                <div class="select-form">
                                    <select name="location" id="homelocation" class="form-control">
                                        <option value="">All Locations</option>
                                        <!-- Your location options will go here -->
                                    </select>
                                </div>

                                <div class="search-form">
                                    <input type="submit" class="searchsubmit" value="Search">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->

        <!-- Popular Locations Start -->
        <div class="popular-location section-padding30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center mb-80">
                            <span style="font-size:35px">Recent Profiles</span>
                            <h2 style="font-size:20px">{{ $profiledescription->title }}</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($users->take(6) as $user)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-location mb-30">
                                <a href="{{ route('userdetails.show', $user->slug) }}">
                                    <div class="location-img">
                                        <!-- Lazy loading image with low-quality placeholder -->
                                        <img data-src="{{ asset($user->profile_image) }}" 
                                             src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                                             style="height:300px"
                                             class="img-fluid rounded lazy-image"
                                             alt="{{ $user->name }}">
                                        <!-- Fallback for browsers without JavaScript -->
                                        <noscript>
                                            <img src="{{ asset($user->profile_image) }}" 
                                                 style="height:300px" 
                                                 class="img-fluid rounded" 
                                                 alt="{{ $user->name }}">
                                        </noscript>
                                    </div>
                                </a>
                                <div class="location-details">
                                    <h2 class="mb-2" style="color:white">{{ $user->name }}</h2>
                                    <a href="{{ route('location.show', $user->location->slug) }}"
                                        class="location-btn mt-2 d-inline-block">
                                        {{ $user->location ? $user->location->name : 'No Location' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('home.directorylisting') }}" class="loadmoreprofiles">Load more</a>
        </div>
        <!-- Popular Locations End -->

        <!-- Services Area Start - With lazy background -->
        <div class="services-area pt-150 pb-150 section-bg"
             data-bg="{{ asset('assets/img/gallery/section_bg02.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle section-tittle2 text-center mb-80">
                            <span style="font-size:30px">How It Works</span>
                            <p style="color:white; font-size:20px">{{ $howitworksdescription->title }}</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    @foreach ($howitworks as $howitwork)
                        <div class="col-lg-3 col-md-6">
                            <div class="single-services text-center mb-50">
                                <div class="step-number rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                    style="font-size:24px;color:#4fc3fe;background:#444744;width:60px;height:60px;">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="services-cap">
                                    <h5>{{ $howitwork->title }}</h5>
                                    <p>{{ $howitwork->body }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Services Area End -->

        <!-- Categories Area Start -->
        <div class="categories-area section-padding30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center ">
                            <span>WHY US!</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($faq as $index => $faqs)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-cat text-center mb-50">
                                <div class="cat-cap">
                                    <h5>{{ $faqs->title }}</h5>
                                    <p>{{ $faqs->body }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Categories Area End -->

    </main>

    <!-- jQuery FIRST, then Select2 CSS and JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Lazy Loading JS (add after jQuery) -->
    <script src="{{ asset('assets/js/lazy-loading.js') }}"></script>
@endsection