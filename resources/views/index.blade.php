@extends('layouts.main')

@section('content')
    <main>
        <style>


        </style>
        <!-- Hero Area Start-->
        <div class="slider-area hero-overly" style="background-image: url('{{ asset($slider->image) }}');">
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
                                        <img src="{{ asset($user->profile_image) }}" style="height:300px"
                                            class="img-fluid rounded">
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

        <!-- Services Area Start -->
        <div class="services-area pt-150 pb-150 section-bg"
            style="background-image: url('{{ asset('assets/img/gallery/section_bg02.jpg') }}');">

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


<div class="feeds-section section-padding30" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center mb-80">
                    <span style="font-size:35px">Community Posts</span>
                    <h2 style="font-size:20px">What our community is sharing</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($feeds as $feed)
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="post-card" id="post-{{ $feed->id }}">
                        <div class="post-header">
                            <div class="post-author-avatar">
                                {{ strtoupper(substr($feed->user->name, 0, 2)) }}
                            </div>
                            <div class="post-author-info">
                                <div class="post-author-name">
                                    {{ $feed->user->name }}
                                </div>
                                <div class="post-time">
                                    {{ $feed->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        <div class="post-title">
                            {{ $feed->title }}
                        </div>

                        @if ($feed->images->count())
                            <div class="post-image-grid" data-images="{{ $feed->images->count() }}">
                                @foreach ($feed->images as $index => $image)
                                    <a data-fancybox="home-feed-{{ $feed->id }}"
                                       href="{{ asset('storage/' . $image->image) }}"
                                       class="grid-item {{ $index == 3 && $feed->images->count() > 4 ? 'has-overlay' : '' }}">
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="Post Image">
                                        @if ($index == 3 && $feed->images->count() > 4)
                                            <div class="more-images-overlay">
                                                <span>+{{ $feed->images->count() - 4 }}</span>
                                            </div>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No posts yet. Be the first to share something!</p>
                </div>
            @endforelse
        </div>
        
        @if($feeds->count() > 0)
            <div class="row mt-50">
                <div class="col-12 text-center">
                    <a href="{{ route('feeds') }}" class="loadmoreprofiles">View All Community Posts</a>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- Community Posts Section End -->

<!-- Add Fancybox CSS and JS for image gallery -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<!-- jQuery FIRST, then Select2 CSS and JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Initialize Fancybox
    Fancybox.bind('[data-fancybox]', {
        // Your options here
    });
</script>
@endsection