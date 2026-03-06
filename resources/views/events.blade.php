@extends('layouts.main')

@section('content')

<main>

        <!-- Hero Start-->
        <div class="hero-area3 hero-overly2 d-flex align-items-center " style="background: url('{{ asset($banner->image) }}')">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9">
                        <div class="hero-cap text-center pt-50 pb-20">
                            <h2>EVENTS</h2>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <!--Hero End -->
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Directory</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        .listing-area {
            padding: 60px 0;
        }
        
        .count {
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            text-align: center;
            font-weight: 500;
        }
        
        .single-listing {
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
            height: 100%;
        }
        
        .single-listing:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
        
        .list-img {
            position: relative;
            overflow: hidden;
            height: 200px;
        }
        
        .list-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .single-listing:hover .list-img img {
            transform: scale(1.05);
        }
        
        .list-caption {
            padding: 20px;
        }
        
        .list-caption span {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 10px;
        }
        
        .list-caption h3 {
            margin-bottom: 10px;
            font-size: 1.3rem;
        }
        
        .list-caption h3 a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .list-caption h3 a:hover {
            color: #007bff;
        }
        
        .list-caption p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        
        .list-footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .list-footer li {
            color: #777;
            font-size: 0.9rem;
        }
        
        .pagination-area {
            margin-top: 40px;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .page-item.active .page-link {
            background-color: #D0A04F;
            border-color: #D0A04F;
        }
        
        .page-link {
            color: #007bff;
            border-radius: 6px;
            margin: 0 5px;
            padding: 8px 15px;
        }
        
        .page-link:hover {
            color: #0056b3;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .list-footer ul {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <!-- listing Area Start -->
    <div class="listing-area pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Right content - centered -->
                <div class="col-xl-10 col-lg-10 col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            
                        </div>
                    </div>
                    <!-- listing Details Start-->
                    <div class="listing-details-area">
                        <div class="container">
                            <div class="row">
                                @foreach($events as $event)
                                <div class="col-lg-6 col-md-6">
                                    <div class="single-listing mb-30">
                                        <div class="event-image">
                                            @if($event->image)
                                            <img src="{{ asset('storage/'.$event->image) }}"  alt="{{ $event->title }}">
                                            @else
                                            <div class="no-img">No Image</div>
                                            @endif
                                        </div>
                                        <div class="list-caption">
                                            <h2>{{ $event->title }}</h2>
                                            <h5><a href="listing_details.html">Date: {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</a></h5>
                                            <p> Location: {{ $event->location }}</p>
                                            <div class="list-footer">
                                                <ul>
                                                    <li><i class="fas fa-phone"></i>{{ \Illuminate\Support\Str::limit($event->description, 80) }}</li>
                                                    <a href="{{ route('events.details', $event->id) }}" class="details-btn btn btn-primary">View Details</a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                                
                               
                               
                            </div>
                        </div>
                    </div>
                    <!-- listing Details End -->
                    <!--Pagination Start  -->
                    <div class="col-12 mt-4 text-center">
        <div class="custom-pagination d-flex justify-content-center align-items-center">
            {{ $events->links('pagination::bootstrap-4') }}
        </div>
    </div>
                    <!--Pagination End  -->
                </div>
            </div>
        </div>
    </div>
    <!-- listing-area Area End -->

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    </main>

@endsection