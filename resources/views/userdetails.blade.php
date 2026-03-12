@extends('layouts.main')

@section('content')
<main>
    <!-- Hero Start-->
    <div class="hero-area2 slider-height2 hero-overly2 d-flex align-items-center" style="background-image: url('{{ !empty($user->cover_image) 
            ? asset($user->cover_image) 
            : asset('assets/img/cover-placeholder.jpg') }}'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;">

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center pt-50">
                        <h2 class="text-white mb-2">{{ $user->name }}</h2>
                        <p class="mb-0 text-white fs-5">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ $user->location->name ?? 'No Location' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Hero End -->

    <!-- User Details Section -->
    <section class="user-details-section section-padding">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-body p-4 p-md-5">
                            <!-- Profile Header -->
                            <div class="profile-header text-center mb-5">
                                <div class="profile-image-container position-relative d-inline-block">
                                    <img class="img-fluid rounded-circle border border-4 border-white shadow" src="{{ !empty($user->profile_image) ? asset($user->profile_image) : asset('assets/img/profile-placeholder.png') }}" alt="{{ $user->name }}" style="width: 180px; height: 180px; object-fit: cover;">
                                </div>
                                <h1 class="mt-4 mb-2 fw-bold" style="color: #333;">{{ $user->name }}</h1>

                                <!-- Contact Info -->
                                <div class="contact-info d-flex justify-content-center align-items-center flex-wrap gap-3 mt-3">
                                    <div class="btn btn-outline-#D0A04F d-flex align-items-center gap-2" style="cursor: default;">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $user->location->name ?? 'No Location' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- About Section -->
                            <div class="about-section mb-5">
                                <div class="section-header d-flex align-items-center mb-4">
                                    <div class="section-icon me-3" style="color: #D0A04F;">
                                        <i class="fas fa-user-circle fa-2x"></i>
                                    </div>
                                    <h3 class="section-title mb-0 fw-bold" style="color: #333;">About</h3>
                                </div>
                                <div class="about-content bg-light p-4 rounded mb-4">
                                    <p class="mb-0" style="line-height: 1.8; color: #555;">
                                        {{ $user->description ?? 'No description available.' }}
                                    </p>
                                </div>

                                <!-- Posts Section -->
                                <div class="posts-section mt-5">
                                    <div class="section-header d-flex align-items-center mb-4">
                                        <div class="section-icon me-3" style="color: #D0A04F;">
                                            <i class="fas fa-newspaper fa-2x"></i>
                                        </div>
                                        <h3 class="section-title mb-0 fw-bold" style="color: #333;">
                                            Posts
                                            @if($feeds && $feeds->count() > 0)
                                            <span class="badge bg-#D0A04F ms-2">{{ $feeds->count() }}</span>
                                            @endif
                                        </h3>
                                    </div>

                                    @if($feeds && $feeds->count() > 0)
                                    <div class="posts-list">
                                        @foreach($feeds as $feed)
                                        <div class="post-item mb-5 p-4 bg-light rounded shadow-sm">
                                            <h4 class="post-title fw-bold mb-3" style="color: #333; font-size: 1.5rem;">{{ $feed->title }}</h4>

                                            @if($feed->description)
                                            <p class="post-description mb-4 text-muted" style="font-size: 1.1rem; line-height: 1.8;">{{ $feed->description }}</p>
                                            @endif

                                            @if($feed->images && $feed->images->count())
                                            <!-- Image Grid - Using the same styling as feeds page -->
                                            <div class="post-image-grid mb-4" data-images="{{ $feed->images->count() }}" style="max-width: 100%;">
                                                @foreach ($feed->images as $index => $image)
                                                <a href="{{ asset('storage/' . $image->image) }}" data-lightbox="user-feed-{{ $feed->id }}" data-title="{{ $feed->title }}" class="grid-item {{ $index == 3 && $feed->images->count() > 4 ? 'has-overlay' : '' }}">

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

                                            <div class="post-footer d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                                <div class="post-date d-flex align-items-center gap-2 text-muted">
                                                    <i class="fas fa-clock"></i>
                                                    {{ $feed->created_at->diffForHumans() }}
                                                </div>

                                                @if($feed->images && $feed->images->count())
                                                <div class="image-count text-#D0A04F">
                                                    <i class="fas fa-images me-1"></i>
                                                    {{ $feed->images->count() }} {{ Str::plural('image', $feed->images->count()) }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <!-- Pagination (if needed) -->
                                    @if(method_exists($feeds, 'links'))
                                    <div class="pagination-wrapper mt-4">
                                        {{ $feeds->links() }}
                                    </div>
                                    @endif

                                    @else
                                    <div class="empty-posts text-center py-5 border rounded bg-light">
                                        <div class="empty-icon mb-3" style="color: #D0A04F;">
                                            <i class="fas fa-images fa-4x"></i>
                                        </div>
                                        <h5 class="text-muted mb-2">No posts yet</h5>
                                        <p class="text-muted mb-0">This user hasn't created any posts.</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Profile Stats Card -->
                    <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px;">
                        <div class="card-header bg-#D0A04F text-white py-3" style="border-radius: 15px 15px 0 0;">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-chart-bar me-2"></i>Profile Stats
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="stats-list">
                                <div class="stat-item d-flex align-items-center mb-4 pb-3 border-bottom">
                                    <div class="stat-icon me-3">
                                        <div class="icon-circle bg-#D0A04F bg-opacity-10 text-#D0A04F rounded-circle p-3">
                                            <i class="fas fa-images fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="stat-content">
                                        <h5 class="mb-1 fw-bold">{{ $user->multipleImages ? count($user->multipleImages) : 0 }}</h5>
                                        <p class="mb-0 text-muted">Gallery Images</p>
                                    </div>
                                </div>

                                <div class="stat-item d-flex align-items-center mb-4 pb-3 border-bottom">
                                    <div class="stat-icon me-3">
                                        <div class="icon-circle bg-#D0A04F bg-opacity-10 text-#D0A04F rounded-circle p-3">
                                            <i class="fas fa-newspaper fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="stat-content">
                                        <h5 class="mb-1 fw-bold">{{ $feeds ? $feeds->count() : 0 }}</h5>
                                        <p class="mb-0 text-muted">Total Posts</p>
                                    </div>
                                </div>

                                @if($user->location)
                                <div class="stat-item d-flex align-items-center">
                                    <div class="stat-icon me-3">
                                        <div class="icon-circle bg-#D0A04F bg-opacity-10 text-#D0A04F rounded-circle p-3">
                                            <i class="fas fa-map-marker-alt fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="stat-content">
                                        <h5 class="mb-1 fw-bold">Location</h5>
                                        <p class="mb-0 text-muted">{{ $user->location->name }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Card -->
                    <div class="card border-0 shadow-lg mb-4" style="border-radius: 15px;">
                        <div class="card-header bg-#D0A04F text-white py-3" style="border-radius: 15px 15px 0 0;">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-images me-2"></i>Gallery
                                @if($user->multipleImages && count($user->multipleImages) > 0)
                                <span class="badge bg-white text-#D0A04F ms-2">{{ count($user->multipleImages) }}</span>
                                @endif
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            @if($user->multipleImages && count($user->multipleImages) > 0)
                            <!-- Gallery Grid - Show first 6, with link to view all -->
                            <div class="row g-2">
                                @foreach($user->multipleImages->take(6) as $key => $image)
                                <div class="col-4">
                                    <div class="gallery-card position-relative overflow-hidden rounded shadow-sm">
                                        <a href="{{ asset($image->image) }}" data-lightbox="user-gallery-sidebar" data-title="{{ $user->name }} - Image {{ $key + 1 }}">
                                            <img src="{{ asset($image->image) }}" alt="Gallery Image {{ $key + 1 }}" class="img-fluid" style="width: 100%; height: 100px; object-fit: cover;">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            @if(count($user->multipleImages) > 6)
                            <div class="text-center mt-3">
                                <a href="#" class="text-#D0A04F text-decoration-none" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                    <i class="fas fa-images me-1"></i> View all {{ count($user->multipleImages) }} images
                                </a>
                            </div>
                            @endif
                            @else
                            <div class="empty-gallery text-center py-4">
                                <div class="empty-icon mb-2" style="color: #D0A04F;">
                                    <i class="fas fa-images fa-3x"></i>
                                </div>
                                <p class="text-muted mb-0 small">No images in gallery</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="card border-0 shadow-lg" style="border-radius: 15px;">
                        <div class="card-header bg-#D0A04F text-white py-3" style="border-radius: 15px 15px 0 0;">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-address-card me-2"></i>Contact Info
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="contact-list">
                                <div class="contact-item mb-3">
                                    <div class="contact-icon">
                                        <i class="fas fa-user fa-lg"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">Name</p>
                                        <p class="mb-0 text-muted">{{ $user->name }}</p>
                                    </div>
                                </div>

                                <div class="contact-item mb-3">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope fa-lg"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">Email</p>
                                        <a href="mailto:{{ $user->email }}" class="mb-0 text-muted text-decoration-none text-#D0A04F">
                                            {{ $user->email }}
                                        </a>
                                    </div>
                                </div>

                                @if($user->location)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt fa-lg"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">Location</p>
                                        <p class="mb-0 text-muted">{{ $user->location->name }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="text-center mt-4">
                                <a href="mailto:{{ $user->email }}" class="btn btn-#D0A04F w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-paper-plane"></i>
                                    Send Message
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Gallery Modal (for viewing all images) -->
@if($user->multipleImages && count($user->multipleImages) > 6)
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-#D0A04F text-white">
                <h5 class="modal-title" id="galleryModalLabel">
                    <i class="fas fa-images me-2"></i>{{ $user->name }}'s Gallery
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    @foreach($user->multipleImages as $key => $image)
                    <div class="col-md-4 col-sm-6">
                        <div class="gallery-card position-relative overflow-hidden rounded shadow-sm">
                            <a href="{{ asset($image->image) }}" data-lightbox="user-gallery-full" data-title="{{ $user->name }} - Image {{ $key + 1 }}">
                                <img src="{{ asset($image->image) }}" alt="Gallery Image {{ $key + 1 }}" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    :root {
        --gold-color: #D0A04F;
        --gold-light: rgba(208, 160, 79, 0.1);
        --gold-dark: #b5893d;
    }

    .hero-overly2 {
        position: relative;
    }

    .hero-overly2::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--gold-color) 0%, var(--gold-dark) 100%);
        opacity: 0.9;
    }

    .hero-overly2 .container {
        position: relative;
        z-index: 2;
    }

    .btn-#D0A04F {
        background-color: var(--gold-color);
        border-color: var(--gold-color);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-#D0A04F:hover {
        background-color: var(--gold-dark);
        border-color: var(--gold-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(208, 160, 79, 0.3);
    }

    .btn-outline-#D0A04F {
        color: var(--gold-color);
        border-color: var(--gold-color);
        background: transparent;
    }

    .btn-outline-#D0A04F:hover {
        background-color: var(--gold-color);
        border-color: var(--gold-color);
        color: white;
    }

    .badge.bg-#D0A04F {
        background-color: var(--gold-color) !important;
        color: white;
    }

    .card-header.bg-#D0A04F {
        background-color: var(--gold-color) !important;
    }

    .gallery-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-title {
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 3px;
        background-color: var(--gold-color);
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .contact-icon {
        width: 40px;
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(208, 160, 79, 0.1);
        border-radius: 50%;
        color: #D0A04F;
        font-size: 16px;
    }

    .post-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .post-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .post-image-wrapper {
        transition: transform 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }

    .post-image-wrapper:hover img {
        transform: scale(1.05);
    }

    .post-image-wrapper img {
        transition: transform 0.3s ease;
    }

    @media (max-width: 768px) {
        .profile-header .contact-info {
            flex-direction: column;
            gap: 10px;
        }

        .contact-info .btn {
            width: 100%;
            justify-content: center;
        }

        .post-image-wrapper {
            height: 200px !important;
        }
    }

    @media (max-width: 576px) {
        .profile-image-container img {
            width: 150px !important;
            height: 150px !important;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        .post-image-wrapper {
            height: 180px !important;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .user-details-section .card {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Post Image Grid Styles - Copied from feeds page */
    .post-image-grid {
        display: grid;
        gap: 2px;
        margin: 0.75rem 0;
        border-radius: 12px;
        overflow: hidden;
        width: 100%;
        max-height: 500px;
    }

    /* Grid layouts based on image count */
    .post-image-grid[data-images="1"] {
        grid-template-columns: 1fr;
        aspect-ratio: 16/9;
    }

    .post-image-grid[data-images="2"] {
        grid-template-columns: 1fr 1fr;
        aspect-ratio: 16/9;
    }

    .post-image-grid[data-images="3"] {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
        aspect-ratio: 4/3;
    }

    .post-image-grid[data-images="3"] .grid-item:first-child {
        grid-row: span 2;
    }

    .post-image-grid[data-images="4"] {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
        aspect-ratio: 1/1;
    }

    .post-image-grid[data-images="5"],
    .post-image-grid[data-images="6"],
    .post-image-grid[data-images="7"],
    .post-image-grid[data-images="8"],
    .post-image-grid[data-images="9"],
    .post-image-grid[data-images="10"] {
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(3, 1fr);
        aspect-ratio: 1/1;
    }

    .post-image-grid[data-images="5"] .grid-item:first-child,
    .post-image-grid[data-images="6"] .grid-item:first-child,
    .post-image-grid[data-images="7"] .grid-item:first-child,
    .post-image-grid[data-images="8"] .grid-item:first-child,
    .post-image-grid[data-images="9"] .grid-item:first-child,
    .post-image-grid[data-images="10"] .grid-item:first-child {
        grid-column: span 2;
        grid-row: span 2;
    }

    .post-image-grid .grid-item {
        position: relative;
        cursor: pointer;
        overflow: hidden;
        width: 100%;
        height: 100%;
    }

    .post-image-grid .grid-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .post-image-grid .grid-item:hover img {
        transform: scale(1.05);
    }

    /* More images overlay - only on 4th image */
    .post-image-grid .grid-item.has-overlay {
        position: relative;
    }

    .post-image-grid .more-images-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        font-weight: bold;
        pointer-events: none;
        z-index: 2;
    }

    /* Override Lightbox styles to match your theme */
    .lb-loader .lb-cancel {
        border-color: var(--gold-color) transparent;
    }

    .lb-nav a.lb-prev:hover,
    .lb-nav a.lb-next:hover {
        opacity: 1;
        background-color: rgba(208, 160, 79, 0.3);
    }

    .lb-data .lb-close:hover {
        opacity: 1;
        background-color: var(--gold-color);
    }

    .lb-data .lb-number {
        color: var(--gold-color) !important;
        font-weight: bold;
    }
</style>

<script>
    // Initialize Lightbox with custom options
    lightbox.option({
        'resizeDuration': 300,
        'wrapAround': true,
        'showImageNumberLabel': true,
        'albumLabel': 'Image %1 of %2',
        'fadeDuration': 300,
        'alwaysShowNavOnTouchDevices': true,
        'fitImagesInViewport': true,
        'maxWidth': 1200,
        'maxHeight': 800
    });
</script>
@endsection