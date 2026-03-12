@extends('layouts.main')

@section('content')
<main>
    <!-- Hero Start -->
    @if(isset($abouts->highlighted_image) && $abouts->highlighted_image)
    <div class="hero-area2 hero-overly2 d-flex align-items-center" 
         data-bg="{{ asset($abouts->highlighted_image) }}"
         style="height: 50%; width: 100%; margin: 0 auto; border-radius: 10px;">
    @elseif(isset($banner->image) && $banner->image)
    <div class="hero-area2 hero-overly2 d-flex align-items-center" 
         data-bg="{{ asset($banner->image) }}"
         style="height: 50%; width: 100%; margin: 0 auto; border-radius: 10px;">
    @else
    <div class="hero-area2 hero-overly2 d-flex align-items-center" 
         style="background: #D0A04F; height: 50%; width: 100%; margin: 0 auto; border-radius: 10px;">
    @endif
        <div class="container">
            <div class="hero-cap text-center pt-50 pb-50" style="position: relative; z-index: 2;">
                <h2 style="color:#FFFFFF;">About us</h2>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- About Details -->
    <div class="about-details section-padding2" style="padding: 40px 0 20px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="section-tittle section-tittle5 mb-50">
                        <span>{{ $abouts->title }}</span>
                        <p>{!! nl2br(e($abouts->body)) !!}</p>
                    </div>
                </div>

                <div class="col-lg-5 text-center">
                    @if(isset($abouts->image) && $abouts->image)
                        <!-- Lazy loading about image -->
                        <img data-src="{{ asset($abouts->image) }}" 
                             src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                             class="img-fluid about-image lazy-image"
                             alt="About Us Image"
                             loading="lazy">
                        <noscript>
                            <img src="{{ asset($abouts->image) }}" class="img-fluid about-image" alt="About Us Image">
                        </noscript>
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:300px;">
                            <p class="text-muted">No image available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Founder Section -->
    <div class="founder-section" style="padding: 40px 0 60px 0; background:#FFFFFF;">
        <div class="container">
            <!-- Founder Heading -->
            <div class="section-tittle text-center mb-40">
                <h2 style="color:#D0A04F; font-size:50px; font-weight:700;">
                    About the Founder
                </h2>
            </div>

            <!-- Founder Card -->
            <div class="founder-card-wrapper">
                <div class="card founder-card border-0 shadow" style="border-radius:15px; overflow:hidden; margin:auto; max-width:1000px;">
                    <div class="row g-0 align-items-stretch">
                        <div class="col-lg-4 d-flex">
                            <div class="founder-img-container text-center p-4 d-flex flex-column justify-content-center align-items-center w-100" 
                                 style="background: linear-gradient(135deg,#D0A04F,#b5893d); min-height:350px;">
                                
                                <!-- Lazy loading founder image -->
                                <img data-src="{{ asset('assets/img/founder1.jpg') }}" 
                                     src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                                     class="rounded-circle img-fluid founder-image lazy-image"
                                     style="width:200px;height:200px;object-fit:cover;"
                                     alt="Ance O. Reji - Founder"
                                     loading="lazy">
                                <noscript>
                                    <img src="{{ asset('assets/img/founder1.jpg') }}" 
                                         class="rounded-circle img-fluid founder-image" 
                                         style="width:200px;height:200px;object-fit:cover;" 
                                         alt="Ance O. Reji - Founder">
                                </noscript>

                                <h3 class="mt-4 text-white">Ance O. Reji</h3>
                                <p style="color:rgba(255,255,255,0.9);">Founder</p>
                            </div>
                        </div>

                        <div class="col-lg-8 d-flex">
                            <div class="card-body p-5 d-flex flex-column justify-content-center w-100" style="min-height:350px;">
                                <h4 class="mb-3" style="border-left:4px solid #D0A04F; padding-left:15px;">
                                    Leadership & Experience
                                </h4>
                                <p>Ance O. Reji is the founder of Furniture International Group and brings over 25 years of rich experience in the furniture manufacturing industry.</p>
                                <p>With an unwavering commitment to quality and craftsmanship, he supplies premium products to major furniture trading showrooms across the region.</p>
                                <p>Recognized as one of the finest manufacturers in South India, he continues to lead the industry with innovative designs and strong customer focus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEW HEADING -->
            <div class="section-tittle text-center mb-40" style="margin-top:50px;">
                <h2 style="color:#D0A04F; font-size:50px; font-weight:700;">
                    Our Software Development Partner
                </h2>
            </div>

            <!-- MDIGITZ CARD -->
            <div class="founder-card-wrapper">
                <div class="card founder-card border-0 shadow" style="border-radius:15px; overflow:hidden; margin:auto; max-width:1000px;">
                    <div class="row g-0 align-items-stretch">
                        <div class="col-lg-4 d-flex">
                            <div class="founder-img-container text-center p-4 d-flex flex-column justify-content-center align-items-center w-100" 
                                 style="background: linear-gradient(135deg,#D0A04F,#b5893d); min-height:350px;">
                                
                                <!-- Lazy loading Mlogo image -->
                                <img data-src="{{ asset('img/Mlogo.png') }}" 
                                     src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                                     style="width:250px;height:200px;"
                                     class="lazy-image"
                                     alt="MDigitz Logo"
                                     loading="lazy">
                                <noscript>
                                    <img src="{{ asset('img/Mlogo.png') }}" style="width:250px;height:200px;" alt="MDigitz Logo">
                                </noscript>
                                
                                <p style="color:rgba(255,255,255,0.9);">Technology Solutions Provider</p>
                            </div>
                        </div>

                        <div class="col-lg-8 d-flex">
                            <div class="card-body p-5 d-flex flex-column justify-content-center w-100" style="min-height:350px;">
                                <h4 class="mb-3" style="border-left:4px solid #b5893d; padding-left:15px;">
                                    MDigitz Soft Solutions
                                </h4>

                                <div class="tech-partner-wrapper">
                                    <div class="tech-card">
                                        <p>We are proud to have MDigitz Soft Solutions as our official technology partner, delivering end-to-end digital solutions that support our vision and growth.</p>
                                    </div>

                                    <div class="tech-card">
                                        <p>This website has been professionally designed and developed by MDigitz Soft Solutions for Furniture International Group (FIG).</p>
                                    </div>

                                    <div class="tech-card">
                                        <p class="tech-heading">MDigitz Soft Solutions empowers furniture manufacturers with</p>
                                        <ul class="tech-list premium-list">
                                            <li>Advanced Websites</li>
                                            <li>ERP Systems</li>
                                            <li>CRM Solutions</li>
                                            <li>Mobile Applications</li>
                                            <li>Custom-Built Software</li>
                                        </ul>
                                    </div>

                                    <div class="tech-card">
                                        <p>MDigitz Soft Solutions provides premium, high-quality development services to all FIG members at competitive costs — driving efficiency, innovation, and sustainable growth.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection