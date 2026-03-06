@extends('layouts.main')

@section('content')

<div class="container-fluid p-0 theme-bg-color">
    <div class="d-flex justify-content-center align-items-center" style="height: 40vh;">
        <h1 class="text-white fw-bold display-5 text-shadow">{{ $event->title }}</h1>
    </div>
</div>

<div class="container my-5">
    <div class="event-glass-card mx-auto text-center">
        @if($event->image)
        <div class="image-circle mx-auto mb-4">
            <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
        </div>
        @endif

        @if($event->images->count())
        <div id="eventGalleryCarousel" class="carousel slide mb-4" data-ride="carousel" data-interval="3000">
            <ol class="carousel-indicators">
                @foreach($event->images as $img)
                <li data-target="#eventGalleryCarousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($event->images as $img)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img
                        class="d-block w-100 rounded"
                        src="{{ asset('storage/'.$img->path) }}"
                        alt="Gallery Image"
                        style="height: 500px; object-fit: cover;">
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#eventGalleryCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#eventGalleryCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        @endif

        <div class="event-info">
            <p><i class="far fa-calendar-alt me-2"></i><span>Date:</span> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</p>
            <p><i class="fas fa-map-marker-alt me-2"></i><span>Location:</span> {{ $event->location }}</p>
        </div>

        <div class="event-desc mt-4">
            <p>{{ $event->description }}</p>
        </div>

        <a href="{{ url('/events') }}" class="btn event-btn mt-4">
            <i class="fas fa-arrow-left me-2"></i>Back to Events
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Base theme */

  .theme-bg-color {
    background-color: #D0A04F;
}

 
    
    .theme-color {
        color: #D0A04F !important;
    }
 
    
    .theme-border {
        border-color: #D0A04F !important;
    }
    
    /* Carousel */
    .carousel-indicators li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #fff;
        opacity: 0.5;
        margin: 0 5px;
        border: none;
        transition: all 0.3s ease;
    }

    .carousel-indicators li.active {
        opacity: 1;
        background-color: #D0A04F;
        transform: scale(1.2);
        box-shadow: 0 0 10px rgba(208, 160, 79, 0.5);
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #D0A04F;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        background-size: 60%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    
    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: #b88c3f;
        transform: scale(1.1);
    }

    .text-shadow {
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    /* Main Card */
    .event-glass-card {
        max-width: 820px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 45px 35px;
        color: #fff;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.18);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    
    .event-glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #D0A04F, #FFD54F, #D0A04F);
        z-index: 1;
    }

    .event-glass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
    }

    /* Image Circle */
    .image-circle {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid rgba(208, 160, 79, 0.3);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-block;
        margin-bottom: 20px;
        position: relative;
    }
    
    .image-circle::after {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        border-radius: 50%;
        border: 2px solid rgba(208, 160, 79, 0.5);
        animation: pulse 2s infinite;
    }

    .image-circle:hover {
        transform: scale(1.08) rotate(5deg);
        border-color: rgba(208, 160, 79, 0.7);
    }

    .image-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Event Info */
    .event-info {
        margin-top: 15px;
        font-size: 1.15rem;
        color: #f0f0f0;
    }
    
    .event-info p {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .event-info i {
        color: #D0A04F;
        font-size: 1.2rem;
        width: 24px;
    }

    .event-info span {
        font-weight: 700;
        color: #D0A04F;
        margin-right: 8px;
        min-width: 70px;
        text-align: right;
    }

    /* Description */
    .event-desc {
        background: rgba(255, 255, 255, 0.08);
        padding: 25px;
        border-radius: 15px;
        font-size: 1.15rem;
        color: #f3eae3;
        line-height: 1.7;
        text-align: justify;
        border-left: 4px solid #D0A04F;
        margin-top: 25px;
    }
    
    .event-desc p {
        margin-bottom: 0;
    }

    /* Button */
    .event-btn {
        background: linear-gradient(135deg, #D0A04F, #b88c3f);
        color: #fff;
        font-weight: 600;
        border-radius: 50px;
        padding: 12px 35px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(208, 160, 79, 0.4);
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        position: relative;
        overflow: hidden;
    }
    
    .event-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }
    
    .event-btn:hover {
        background: linear-gradient(135deg, #b88c3f, #D0A04F);
        box-shadow: 0 12px 30px rgba(208, 160, 79, 0.6);
        transform: translateY(-3px);
    }
    
    .event-btn:hover::before {
        left: 100%;
    }
    
    /* Animations */
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.7;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.3;
        }
        100% {
            transform: scale(1);
            opacity: 0.7;
        }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .event-glass-card {
            padding: 30px 20px;
            margin: 0 15px;
        }
        
        .image-circle {
            width: 130px;
            height: 130px;
        }
        
        .carousel-inner img {
            height: 350px !important;
        }
        
        .event-info {
            font-size: 1rem;
        }
        
        .event-desc {
            padding: 20px;
            font-size: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Keeps auto sliding active after manual interaction
    $('#eventGalleryCarousel').on('slide.bs.carousel', function() {
        $(this).carousel('pause');
        setTimeout(() => $(this).carousel('cycle'), 100);
    });
    
    // Add smooth hover effects
    $(document).ready(function() {
        $('.event-btn').hover(
            function() {
                $(this).css('transform', 'translateY(-3px)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
            }
        );
        
        // Add loading animation to image circle
        $('.image-circle img').on('load', function() {
            $(this).parent().addClass('loaded');
        });
    });
</script>
@endpush