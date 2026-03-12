<!doctype html>
<html class="no-js" lang="zxx">

<head>
    @php
    $phone1 = App\Http\Controllers\HomeController::getphone1();
    $address = App\Http\Controllers\HomeController::getalladdress();
    $email = App\Http\Controllers\HomeController::getemail();
    $email1 = App\Http\Controllers\HomeController::getemail1();
    $socialicons = App\Http\Controllers\HomeController::getsocialicons();
    $getaddress = App\Http\Controllers\HomeController::getaddress();
    $logo = App\Http\Controllers\HomeController::getlogo();
    $servername = request()->getHttpHost();
    @endphp

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        @hasSection('title')
        @yield('title')
        @else
        Fig-The furniture international group
        @endif
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">

    <meta name="description" content="Furniture International Group - Global directory of furniture manufacturers, suppliers, exporters. Find quality furniture companies worldwide for business networking and sourcing.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Furniture International Group | Global Furniture Directory">
    <meta property="og:description" content="Connect with furniture manufacturers worldwide. Browse our comprehensive directory of furniture companies, suppliers, and exporters.">
    @if(isset($logo->image))
    <meta property="og:image" content="{{ asset($logo->image) }}">
    @endif
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Furniture International Group">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Furniture International Group | Global Furniture Directory">
    <meta property="twitter:description" content="Connect with furniture manufacturers worldwide. Browse our comprehensive directory of furniture companies, suppliers, and exporters.">
    @if(isset($logo->image))
    <meta property="twitter:image" content="{{ asset($logo->image) }}">
    @endif

    <!-- Additional Meta Tags -->
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Furniture International Group">
    <meta name="publisher" content="Furniture International Group">

    <!-- Keywords -->
    <meta name="keywords" content="furniture manufacturers, furniture suppliers, furniture exporters, furniture directory, furniture companies, furniture industry, international furniture, furniture business, furniture sourcing, furniture trade, wooden furniture, office furniture, home furniture, furniture manufacturers directory, furniture suppliers directory, furniture exporters directory, global furniture network, furniture marketplace, furniture B2B, furniture manufacturers list">

    <!-- Theme Color -->
    <meta name="theme-color" content="#D0A04F">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/feeds.css') }}">
    <!-- <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}"> -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
    <!-- Custom CSS for dropdown -->
    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* User Dropdown Styles */
        .dropdown.user-menu {
            position: relative;
        }

        .dropdown.user-menu .dropdown-toggle {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 30px;
            transition: all 0.3s ease;
            background: rgba(208, 160, 79, 0.1);
            color: #D0A04F;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        /* .dropdown.user-menu .dropdown-toggle:hover {
                background: rgba(208, 160, 79, 0.2);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(208, 160, 79, 0.15);
            } */

        .dropdown.user-menu .dropdown-toggle i.ti-user {
            margin-right: 8px;
            color: #D0A04F;
        }

        .dropdown.user-menu .dropdown-toggle .fa-chevron-down {
            margin-left: 8px;
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .dropdown.user-menu .dropdown-toggle.show .fa-chevron-down {
            transform: rotate(180deg);
        }

        /* Dropdown Menu */
        .dropdown.user-menu .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            left: auto;
            top: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(208, 160, 79, 0.2);
            border-radius: 12px;
            padding: 10px 0;
            min-width: 220px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            margin-top: 10px;
            z-index: 1000;
            animation: fadeInDown 0.3s ease;
        }

        .dropdown.user-menu .dropdown-menu.show {
            display: block;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Dropdown Items */
        .dropdown.user-menu .dropdown-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #D0A04F;
            transition: all 0.3s ease;
            text-decoration: none;
            border-radius: 6px;
            margin: 2px 10px;
        }

        /*             
            .dropdown.user-menu .dropdown-item:hover {
                background: rgba(208, 160, 79, 0.1);
                color: #D0A04F;
                transform: translateX(5px); 
            }*/

        .dropdown.user-menu .dropdown-item i {
            margin-right: 12px;
            width: 20px;
            color: #D0A04F;
            font-size: 1rem;
        }

        .dropdown.user-menu .dropdown-divider {
            margin: 10px 0;
            border-color: rgba(208, 160, 79, 0.1);
        }

        /* Logout Button */
        .dropdown.user-menu .dropdown-item.logout-btn {
            width: calc(100% - 20px);
            padding: 12px 20px;
            color: #dc3545;
            border: none;
            background: transparent;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
            font-size: inherit;
        }

        .dropdown.user-menu .dropdown-item.logout-btn:hover {
            background: rgba(220, 53, 69, 0.1);
            color: #43dc35;
        }

        /* Sign In & Sign Up Styles */
        .login a {
            display: flex;
            align-items: center;
            padding: 8px 20px;
            color: #333;
            transition: all 0.3s ease;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
        }

        .login a:hover {
            color: #D0A04F;
            background: rgba(208, 160, 79, 0.1);
        }

        .login a i {
            color: #0F3B26;
            margin-right: 8px;
        }

        .signup .btn-signup {
            display: flex;
            align-items: center;
            padding: 8px 20px;
            color: white;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
            text-decoration: none;
        }

        .signup .btn-signup:hover {
            background: #b5893d;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(208, 160, 79, 0.3);
        }

        .signup .btn-signup i {
            margin-right: 8px;
        }

        /* Fix for navigation */
        #navigation {
            display: flex;
            align-items: center;
        }

        #navigation li {
            margin-left: 5px;
        }

      /* Profile Badge */
.profile-badge {
    list-style: none;
}

.profile-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

/* Avatar */
.user-avatar {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    border: 2px solid #d0a04f;
    object-fit: cover;
}

/* Username */
.user-name {
    font-size: 16px;
    font-weight: 600;
    text-transform: lowercase;
}

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .profile-image {
                width: 35px;
                height: 35px;
            }
        }

        /* Mobile Responsive */
        @media (max-width: 991px) {
            .dropdown.user-menu .dropdown-menu {
                position: static;
                width: 100%;
                margin-top: 10px;
                animation: none;
            }

            .dropdown.user-menu .dropdown-item:hover {
                transform: none;
            }


            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                position: relative;
                min-height: 100vh;
            }



            /* Hide anything after footer */
            body>*:last-child:not(footer) {
                display: none !important;
            }
    </style>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZCKKHJ50VT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ZCKKHJ50VT');
    </script>
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset($logo->image) }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header">
                <div class="header-bottom header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                                <div class="logo">
                                    <a href="/"><img width="130px" src="{{ asset($logo->image) }}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-8">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li class="{{ request()->is('/') ? 'active' : '' }}">
                                                <a href="/">
                                                    <i class="ti-home mr-2"></i>Home
                                                </a>
                                            </li>

                                            <li class="{{ request()->is('about') ? 'active' : '' }}">
                                                <a href="/about">
                                                    <i class="ti-info-alt mr-2"></i>About
                                                </a>
                                            </li>

                                            <li class="{{ request()->is('feeds') ? 'active' : '' }}">
                                                <a href="/feeds">
                                                    <i class="ti-info-alt mr-2"></i>Feeds
                                                </a>
                                            </li>

                                            <li class="{{ request()->is('directorylisting') ? 'active' : '' }}">
                                                <a href="{{ route('home.directorylisting') }}">
                                                    <i class="ti-list mr-2"></i>Directory Listing
                                                </a>
                                            </li>

                                            <li class="{{ request()->is('contact') ? 'active' : '' }}">
                                                <a href="/contact">
                                                    <i class="ti-email mr-2"></i>Contact
                                                </a>
                                            </li>

                                            <li class="{{ request()->is('blog') || request()->is('blog/*') ? 'active' : '' }}">
                                                <a href="{{ route('blog.index') }}">
                                                    <i class="ti-write mr-2"></i>Blogs
                                                </a>
                                            </li>

                                            <!-- Auth Buttons -->
                                            @auth
                                            <li class="profile-badge">
                                                <a href="{{ route('profile') }}" class="profile-wrapper">

                                                    @php
                                                    $profileImage = Auth::user()->profile_image ?? 'default-avatar.png';
                                                    @endphp

                                                    <img
                                                        src="{{ Auth::user()->profile_image 
                ? asset(Auth::user()->profile_image) 
                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D0A04F&color=fff' }}"
                                                        class="user-avatar"
                                                        alt="{{ Auth::user()->name }}">

                                                    <span class="user-name">
                                                        {{ Auth::user()->name }}
                                                    </span>

                                                </a>
                                            </li>
                                            @else
                                            <li class="login">
                                                <a href="{{ route('login') }}">
                                                    Sign In
                                                </a>
                                            </li>

                                            <li class="signup">
                                                <a href="{{ route('signup') }}">
                                                    Sign Up
                                                </a>
                                            </li>
                                            @endauth
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    @yield('content')

    <footer>
        <!-- Footer Start-->
        <div class="footer-area">
            <div class="footer-particles" id="footerParticles"></div>
            <div class="container">
                <div class="footer-top ">
                    <div class="row justify-content-between">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                            <div class="single-footer-caption ">
                                <div class="single-footer-caption ">
                                    <!-- logo -->
                                    <div class="footer-logo">
                                        <a href="/"><img width="150px" src="/assets/img/figwhite.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row footer-row">
                            <!-- Quick Links Column -->
                            <div class="col-auto">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <h4 style="color: #6c757d !important;">Quick Link</h4>
                                        <ul>
                                            <li><a href="/about">About Us</a></li>
                                            <li><a href="/directorylisting">Listing</a></li>
                                            <li><a href="/contact">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Follow Us Column -->
                            <div class="col-auto ms-auto text-end">

                                <div class="footer-social-section">
                                    <h4 class="footer-heading mb-4">
                                        Follow Us
                                        <span class="heading-underline"></span>
                                    </h4>

                                    <div class="social-icons-container d-flex flex-wrap">
                                        @foreach($socialicons as $socialicon)
                                        @php
                                        // Detect Facebook by platform name or URL
                                        $platform = strtolower($socialicon->platform ?? '');
                                        $bodyLower = strtolower($socialicon->body ?? '');

                                        $isFacebook = $platform == 'facebook' ||
                                        str_contains($bodyLower, 'facebook.com') ||
                                        str_contains($bodyLower, 'fb.com');

                                        // Detect Instagram
                                        $isInstagram = $platform == 'instagram' ||
                                        str_contains($bodyLower, 'instagram.com');

                                        // Determine if icon needs white filter
                                        $needsWhiteFilter = $isFacebook || $isInstagram;
                                        @endphp

                                        <a href="{{ $socialicon->body }}"
                                            class="social-icon-wrapper"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            aria-label="Follow us on {{ $socialicon->platform ?? 'social media' }}"
                                            title="Follow us on {{ $socialicon->platform ?? 'social media' }}">
                                            <div class="social-icon-circle {{ $isFacebook ? 'facebook-bg' : ($isInstagram ? 'instagram-bg' : '') }}">
                                                <img src="{{ asset($socialicon->image) }}"
                                                    alt="{{ $socialicon->platform ?? 'social media' }} icon"
                                                    class="social-icon-img"
                                                    loading="lazy"
                                                    width="30"
                                                    height="30"
                                                    @if($needsWhiteFilter)
                                                    style="filter: brightness(0) invert(1);"
                                                    @endif>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="footer-bottom">
                        <div class="row d-flex justify-content-between align-items-center">
                            <!-- Left Side: Services -->
                            <div class="col-xl-6 col-lg-6">
                                <div class="footer-services">
                                    <ul>
                                        <li> <a href="https://mdigitz.com/" target="_blank" style="color: #ffffff !important;">Web Development </a><span style="margin: 0 10px;">|</span></li>
                                        <li> <a href="https://mdigitz.com/" target="_blank" style="color: #ffffff !important;">Mobile Application Development </a> <span style="margin: 0 10px;">|</span></li>
                                        <li> <a href="https://mdigitz.com/" target="_blank" style="color: #ffffff !important;">Custom Software Development </a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Right Side: Powered by MDIGITZ -->
                            <div class="col-xl-6 col-lg-6 text-end">
                                <div class="footer-copy-right">
                                    <p>
                                        <a href="https://mdigitz.com/" target="_blank" style="color: #ffffff !important;">
                                            Powered By <img width="150px" src="/assets/img/logomdigitz.png" />
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Footer End-->
    </footer>

    <style>
        /* WhatsApp Floating Button - LEFT SIDE */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            left: 40px;
            /* Changed from right to left */
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #128c7e;
            color: #FFF;
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
        }

        .whatsapp-float .whatsapp-icon {
            width: 35px;
            height: 35px;
            filter: brightness(0) invert(1);
        }

        /* Pulse Animation */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* WhatsApp Tooltip - Left Side */
        .whatsapp-tooltip {
            position: absolute;
            left: 70px;
            /* Changed from right to left */
            top: 50%;
            transform: translateY(-50%);
            background: #25d366;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .whatsapp-tooltip:after {
            content: '';
            position: absolute;
            top: 50%;
            left: -5px;
            /* Changed from right to left */
            margin-top: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent #25d366 transparent transparent;
            /* Changed arrow direction */
        }

        .whatsapp-float:hover .whatsapp-tooltip {
            opacity: 1;
            visibility: visible;
            left: 75px;
            /* Changed from right to left */
        }

        /* WhatsApp Tooltip Text Styles */
        .whatsapp-tooltip-text {
            display: inline-block;
            animation: slideInLeft 0.5s ease forwards;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* WhatsApp Count Animation */
        .whatsapp-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff0000;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Mobile Responsive - Left Side */
        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                left: 20px;
                /* Changed from right to left */
                font-size: 25px;
            }

            .whatsapp-float .whatsapp-icon {
                width: 28px;
                height: 28px;
            }

            .whatsapp-tooltip {
                left: 60px;
                /* Changed from right to left */
                padding: 6px 12px;
                font-size: 12px;
                display: none;
                /* Hide on mobile by default */
            }

            .whatsapp-tooltip:after {
                left: -5px;
                /* Changed from right to left */
                border-color: transparent #25d366 transparent transparent;
            }

            /* Show tooltip on mobile with longer delay */
            .whatsapp-float:active .whatsapp-tooltip {
                display: block;
                opacity: 0.9;
                left: 65px;
                /* Changed from right to left */
            }
        }

        /* Tablet View */
        @media (min-width: 769px) and (max-width: 1024px) {
            .whatsapp-float {
                left: 30px;
                /* Changed from right to left */
                bottom: 30px;
            }

            .whatsapp-tooltip {
                left: 65px;
                /* Changed from right to left */
            }

            .whatsapp-float:hover .whatsapp-tooltip {
                left: 70px;
                /* Changed from right to left */
            }
        }

        /* Optional: WhatsApp button visibility on scroll (Left Side) */
        .whatsapp-float.scroll-hide {
            transform: translateX(-100px);
            opacity: 0;
        }

        .whatsapp-float.scroll-show {
            transform: translateX(0);
            opacity: 1;
        }

        /* Left side bounce animation */
        @keyframes bounceLeft {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(5px);
            }
        }

        .whatsapp-float:hover {
            animation: pulse 2s infinite, bounceLeft 1s ease infinite;
        }

        /* Consistent size for all social icons */
        .social-icon-circle {
            width: 44px;
            /* Fixed width */
            height: 44px;
            /* Fixed height */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        /* Blue background for Facebook */
        .facebook-bg {
            background-color: #1877F2 !important;
        }

        /* Instagram gradient background */
        .instagram-bg {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden !important;
        }

        body.d-flex.flex-column.min-vh-100 {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }

        footer,
        .footer-area,
        .footer-bottom {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
            position: relative !important;
            bottom: 0 !important;
        }

        /* Remove any margin from the very last element */
        body>*:last-child {
            margin-bottom: 0 !important;
        }

        /* If there's a container after footer, remove its margin */
        .container:last-child,
        .row:last-child {
            margin-bottom: 0 !important;
        }


        /* Space between all icons */
        .social-icons-container {
            gap: 15px;
            /* Adjust spacing as needed */
        }

        /* Optional: Different colors for other platforms */
        .social-icon-circle[class*="twitter"] {
            background-color: #1DA1F2;
        }

        .social-icon-circle[class*="linkedin"] {
            background-color: #0077B5;
        }

        /* Hover effects */
        .social-icon-circle:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>

    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script> -->
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/contact.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#location').select2({
                placeholder: "Search Location",
                allowClear: true,
                width: '100%',
                minimumInputLength: 2, // 👈 Important (wait for typing)
                ajax: {
                    url: "{{ route('locations.search') }}",
                    dataType: 'json',
                    delay: 300, // small delay for keyup typing
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#homelocation').select2({
                placeholder: "Search Location",
                allowClear: true,
                width: '100%',
                minimumInputLength: 2, // 👈 Important (wait for typing)
                ajax: {
                    url: "{{ route('locations.search') }}",
                    dataType: 'json',
                    delay: 300, // small delay for keyup typing
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll("#navigation li");

            navLinks.forEach(function(li) {

                const link = li.querySelector("a");
                if (!link) return;

                const linkUrl = link.href;

                // Exact match OR current URL starts with link URL (for subpages)
                if (
                    currentUrl === linkUrl ||
                    currentUrl.startsWith(linkUrl + "/")
                ) {
                    li.classList.add("active");
                } else {
                    li.classList.remove("active");
                }

            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.createElement('div');
            particlesContainer.className = 'footer-particles';
            document.querySelector('.footer-area').prepend(particlesContainer);

            // Create more visible particles
            const particleCount = 40;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'footer-particle';

                // Random size class
                const sizes = ['small', 'medium', 'large'];
                particle.classList.add(sizes[Math.floor(Math.random() * sizes.length)]);

                // Position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';

                // Animation
                const duration = 15 + Math.random() * 15; // 15-30 seconds
                const delay = Math.random() * 5; // 0-5 seconds delay

                particle.style.animation = `floatParticle ${duration}s infinite linear ${delay}s`;

                // Color variation
                const colors = [
                    'rgba(208, 160, 79, 0.7)', // Gold
                    'rgba(255, 255, 255, 0.5)', // White
                    'rgba(66, 153, 225, 0.6)' // Blue
                ];
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];

                particlesContainer.appendChild(particle);
            }
        });
    </script>

    <!-- Custom JavaScript for Dropdown -->
    <script>
        // Toggle user dropdown
        function toggleUserDropdown() {
            const dropdownMenu = document.getElementById('userDropdown');
            const dropdownToggle = document.querySelector('.dropdown.user-menu .dropdown-toggle');

            dropdownMenu.classList.toggle('show');
            dropdownToggle.classList.toggle('show');

            // Close dropdown when clicking outside
            if (dropdownMenu.classList.contains('show')) {
                document.addEventListener('click', closeDropdownOnClickOutside);
            } else {
                document.removeEventListener('click', closeDropdownOnClickOutside);
            }
        }

        // Close dropdown when clicking outside
        function closeDropdownOnClickOutside(event) {
            const dropdownMenu = document.getElementById('userDropdown');
            const dropdownToggle = document.querySelector('.dropdown.user-menu .dropdown-toggle');

            if (!dropdownMenu.contains(event.target) && !dropdownToggle.contains(event.target)) {
                dropdownMenu.classList.remove('show');
                dropdownToggle.classList.remove('show');
                document.removeEventListener('click', closeDropdownOnClickOutside);
            }
        }

        // Close dropdown when clicking on dropdown items (except logout button)
        document.querySelectorAll('.dropdown-item:not(.logout-btn)').forEach(item => {
            item.addEventListener('click', function() {
                const dropdownMenu = document.getElementById('userDropdown');
                const dropdownToggle = document.querySelector('.dropdown.user-menu .dropdown-toggle');

                dropdownMenu.classList.remove('show');
                dropdownToggle.classList.remove('show');
                document.removeEventListener('click', closeDropdownOnClickOutside);
            });
        });

        // Handle logout form submission
        document.getElementById('logout-form')?.addEventListener('submit', function(e) {
            e.preventDefault();

            // Optional: Add a confirmation dialog
            if (confirm('Are you sure you want to logout?')) {
                this.submit();
            }
        });

        // Close dropdown on mobile when clicking menu items
        if (window.innerWidth <= 991) {
            document.querySelectorAll('#navigation li a').forEach(link => {
                link.addEventListener('click', function() {
                    const dropdownMenu = document.getElementById('userDropdown');
                    const dropdownToggle = document.querySelector('.dropdown.user-menu .dropdown-toggle');

                    if (dropdownMenu && dropdownMenu.classList.contains('show')) {
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.classList.remove('show');
                    }
                });
            });
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Add any initialization code here
        });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/68f54a925eca4d194faaba84/1j7v2mjiq';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!-- WhatsApp Floating Button - LEFT SIDE -->
    <a href="https://wa.me/919746484844?text=Hello!%20I'm%20interested%20in%20your%20services.%20Can%20you%20help%20me?" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat with us on WhatsApp" title="Chat with us on WhatsApp">

        <!-- WhatsApp Icon -->
        <svg class="whatsapp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
        </svg>

        <!-- Tooltip with animation -->
        <span class="whatsapp-tooltip">
            <span class="whatsapp-tooltip-text">Chat with us!</span>
        </span>

        <!-- Optional: Uncomment to add notification badge -->
        <!-- 
    <span class="whatsapp-notification">
        1
    </span>
    -->
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Force remove all footer backgrounds
            const footerElements = document.querySelectorAll('footer, .footer-area, .footer-top, .footer-bottom');
            footerElements.forEach(el => {
                el.style.background = 'transparent !important';
                el.style.backgroundColor = 'transparent !important';
                el.style.backgroundImage = 'none !important';
            });

            // Remove any background images from style attribute
            document.querySelectorAll('[style*="background"]').forEach(el => {
                if (el.closest('footer') || el.classList.contains('footer-area')) {
                    el.style.background = 'transparent !important';
                    el.style.backgroundImage = 'none !important';
                }
            });
        });
    </script>



    <script>
        // Debug: Find what's below footer
        document.addEventListener('DOMContentLoaded', function() {
            const bodyRect = document.body.getBoundingClientRect();
            const footer = document.querySelector('footer');
            const footerRect = footer.getBoundingClientRect();

            console.log('Body height:', bodyRect.height);
            console.log('Footer bottom:', footerRect.bottom);
            console.log('Viewport height:', window.innerHeight);

            if (footerRect.bottom < window.innerHeight) {
                console.log('Space below footer:', window.innerHeight - footerRect.bottom, 'px');
            }

            // Force remove space
            document.body.style.marginBottom = '0';
            document.body.style.paddingBottom = '0';
            document.documentElement.style.marginBottom = '0';
            document.documentElement.style.paddingBottom = '0';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
</body>

</html>