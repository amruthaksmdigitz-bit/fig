@extends('layouts.main')

@section('content')
<main>
    <!-- Hero Start-->
    <div class="hero-area2 slider-height2 hero-overly2 d-flex align-items-center"
        style="background-image: url('{{ !empty($user->cover_image) 
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
                            {{ $user->location->name ? $user->location->name : 'No Location' }}
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
                                    <div class="profile-image-container position-relative d-inline-block">

                                        <img class="img-fluid rounded-circle border border-4 border-white shadow"
                                            src="{{ !empty($user->profile_image) 
                                                ? asset($user->profile_image) 
                                                : asset('assets/img/profile-placeholder.png') }}"
                                            alt="{{ $user->name }}"
                                            style="width: 180px; height: 180px; object-fit: cover;">

                                    </div>

                                </div>
                                <h1 class="mt-4 mb-2 fw-bold" style="color: #333;">{{ $user->name }}</h1>

                                <!-- Contact Info -->
                                <div class="contact-info d-flex justify-content-center align-items-center flex-wrap gap-3 mt-3">
                                    <a href="mailto:{{ $user->email }}"
                                        class="btn btn-outline-#D0A04F d-flex align-items-center gap-2">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $user->email }}</span>
                                    </a>
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
                                <div class="about-content bg-light p-4 rounded">
                                    <p class="mb-0" style="line-height: 1.8; color: #555;">
                                        {{ $user->description ?? 'No description available.' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Gallery Section -->
                            <div class="gallery-section">
                                <div class="section-header d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="section-icon me-3" style="color: #D0A04F;">
                                            <i class="fas fa-images fa-2x"></i>
                                        </div>
                                        <h3 class="section-title mb-0 fw-bold" style="color: #333;">
                                            Gallery
                                            @if($user->multipleImages && count($user->multipleImages) > 0)
                                            <span class="badge bg-#D0A04F ms-2">{{ count($user->multipleImages) }}</span>
                                            @endif
                                        </h3>
                                    </div>
                                </div>

                                @if($user->multipleImages && count($user->multipleImages) > 0)
                                <!-- Gallery Grid -->
                                <div class="row g-3">
                                    @foreach($user->multipleImages as $key => $image)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="gallery-card position-relative overflow-hidden rounded shadow-sm">
                                            <a href="{{ asset($image->image) }}"
                                                data-lightbox="user-gallery"
                                                data-title="{{ $user->name }} - Image {{ $key + 1 }}">
                                                <img src="{{ asset($image->image) }}"
                                                    alt="Gallery Image {{ $key + 1 }}"
                                                    class="img-fluid"
                                                    style="width: 100%; height: 200px; object-fit: cover;">
                                                <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-0 d-flex align-items-center justify-content-center transition-all">
                                                    <div class="overlay-content text-center opacity-0 transition-all">
                                                        <i class="fas fa-search-plus fa-2x text-white"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <!-- Empty Gallery State -->
                                <div class="empty-gallery text-center py-5 border rounded bg-light">
                                    <div class="empty-icon mb-3" style="color: #D0A04F;">
                                        <i class="fas fa-images fa-4x"></i>
                                    </div>
                                    <h5 class="text-muted mb-2">No images yet</h5>
                                    <p class="text-muted mb-0">This user hasn't uploaded any images to their gallery.</p>
                                </div>
                                @endif
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

                                @if($user->locationRelation)
                                <div class="stat-item d-flex align-items-center">
                                    <div class="stat-icon me-3">
                                        <div class="icon-circle bg-#D0A04F bg-opacity-10 text-#D0A04F rounded-circle p-3">
                                            <i class="fas fa-map-marker-alt fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="stat-content">
                                        <h5 class="mb-1 fw-bold">Location</h5>
                                        <p class="mb-0 text-muted">{{ $user->locationRelation->name }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
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

                                @if($user->locationRelation)
                                <div class="contact-item d-flex align-items-center">
                                    <div class="contact-icon">

                                        <i class="fas fa-map-marker-alt fa-lg"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-bold">Location</p>
                                        <p class="mb-0 text-muted">{{ $user->locationRelation->name }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="text-center mt-4">
                                <a href="mailto:{{ $user->email }}"
                                    class="btn btn-#D0A04F w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
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

<!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* Custom Color Variables */
    :root {

        --gold-light: rgba(208, 160, 79, 0.1);
        --gold-dark: #b5893d;
    }

    /* Global Styles */
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

    /* Custom Button Styles */
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

    /* Badge Styles */
    .badge.bg-#D0A04F {
        background-color: var(--gold-color) !important;
        color: white;
    }

    /* Card Header */
    .card-header.bg-#D0A04F {
        background-color: var(--gold-color) !important;
    }

    /* Gallery Card Styles */
    .gallery-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .gallery-card:hover .gallery-overlay {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .gallery-card:hover .overlay-content {
        opacity: 1;
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    /* Profile Badge */
    .profile-badge {
        width: 40px;
        height: 40px;
        background-color: var(--gold-color);
        border: 3px solid white;
    }

    /* Icon Circle */
    .icon-circle {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Section Titles */
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
        /* Fixed width = perfect alignment */
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

    .contact-item p,
    .contact-item a {
        margin: 0;
        line-height: 1.4;
    }

    .contact-item .fw-bold {
        font-size: 14px;
        margin-bottom: 2px;
    }

    .contact-item .text-muted {
        font-size: 14px;
    }


    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-header .contact-info {
            flex-direction: column;
            gap: 10px;
        }

        .contact-info .btn {
            width: 100%;
            justify-content: center;
        }

        .gallery-card img {
            height: 180px;
        }
    }

    @media (max-width: 576px) {
        .profile-image-container {
            width: 150px;
            height: 150px;
        }

        .profile-image-container img,
        .profile-image-container .rounded-circle {
            width: 150px !important;
            height: 150px !important;
        }

        .card-body {
            padding: 1.5rem !important;
        }
    }

    /* Animation for page load */
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

    /* Lightbox Customization */
    .lb-data .lb-caption {
        font-size: 16px;
        font-weight: 500;
        color: var(--gold-color);
    }

    .lb-nav a.lb-prev,
    .lb-nav a.lb-next {
        background-color: var(--gold-color);
        border-radius: 50%;
    }
</style>

<script>
    // Initialize Lightbox with custom options
    lightbox.option({
        'resizeDuration': 300,
        'wrapAround': true,
        'showImageNumberLabel': true,
        'albumLabel': 'Image %1 of %2',
        'fadeDuration': 300
    });

    // Add hover effects for gallery cards
    document.addEventListener('DOMContentLoaded', function() {
        const galleryCards = document.querySelectorAll('.gallery-card');

        galleryCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.zIndex = '10';
            });

            card.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
            });
        });

        // Add animation delay to gallery items
        const galleryItems = document.querySelectorAll('.gallery-card');
        galleryItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endsection