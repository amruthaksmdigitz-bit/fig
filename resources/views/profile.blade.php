<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ Auth::user()->name }} - Profile Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Lightbox for gallery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />

    <style>
        :root {
            --primary-color: #D0A04F;
            --primary-light: #e6b957;
            --primary-dark: #b88c3f;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius-sm: 0.375rem;
            --radius: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: var(--gray-800);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Sidebar */
        .sidebar {
            background: white;
            height: 100vh;
            position: fixed;
            width: 260px;
            border-right: 1px solid var(--gray-200);
            padding: 1.5rem 1rem;
            z-index: 50;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar-header {
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(208, 160, 79, 0.1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.125rem;
        }

        .sidebar-brand i {
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .sidebar-nav {
            flex: 1;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--gray-600);
            text-decoration: none;
            border-radius: var(--radius);
            transition: var(--transition);
            font-weight: 500;
        }

        .nav-link:hover {
            background-color: rgba(208, 160, 79, 0.1);
            color: var(--primary-color);
        }

        .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        .nav-divider {
            height: 1px;
            background-color: var(--gray-200);
            margin: 1rem 0;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid var(--gray-200);
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 100%;
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
        }

        .page-title p {
            color: var(--gray-500);
            font-size: 0.875rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-menu {
            position: relative;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: none;
            border: none;
            padding: 0.5rem;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .user-btn:hover {
            background-color: rgba(208, 160, 79, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }

        .user-info {
            text-align: left;
        }

        .user-name {
            font-weight: 500;
            color: var(--gray-900);
            font-size: 0.875rem;
        }

        .user-role {
            color: var(--primary-color);
            font-size: 0.75rem;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 0.5rem);
            min-width: 200px;
            background: white;
            border-radius: var(--radius-md);
            border: 1px solid rgba(208, 160, 79, 0.2);
            box-shadow: var(--shadow-lg);
            padding: 0.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            z-index: 100;
        }

        .user-menu:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--gray-700);
            text-decoration: none;
            border-radius: var(--radius-sm);
            transition: var(--transition);
            font-size: 0.875rem;
        }

        .dropdown-item:hover {
            background-color: rgba(208, 160, 79, 0.1);
            color: var(--primary-color);
        }

        .dropdown-item i {
            width: 16px;
            color: var(--primary-color);
        }

        /* Content Area */
        .content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Profile Header */
        .profile-header {
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid rgba(208, 160, 79, 0.1);
        }

        .cover-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .cover-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .cover-image:hover .cover-overlay {
            opacity: 1;
        }

        .profile-info {
            padding: 2rem;
            position: relative;
        }

        .profile-avatar {
            position: absolute;
            top: -60px;
            left: 2rem;
            width: 120px;
            height: 120px;
            border-radius: var(--radius-lg);
            border: 4px solid white;
            object-fit: cover;
            box-shadow: var(--shadow-lg);
        }

        .profile-details {
            margin-left: 140px;
        }

        .profile-name {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .profile-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            color: var(--gray-600);
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .profile-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-meta-item i {
            color: var(--primary-color);
        }

        .profile-stats {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--gray-500);
        }

        .profile-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn {
            padding: 0.625rem 1.25rem;
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(208, 160, 79, 0.3);
        }

        .btn-outline {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-outline:hover {
            background-color: rgba(208, 160, 79, 0.1);
            border-color: var(--primary-dark);
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            transition: var(--transition);
            border: 1px solid rgba(208, 160, 79, 0.1);
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(208, 160, 79, 0.1);
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-900);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-title i {
            color: var(--primary-color);
        }

        /* About Section */
        .about-content {
            color: var(--gray-600);
            line-height: 1.7;
            padding: 0.5rem 0;
        }

        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 0.75rem;
        }

        .gallery-item {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 1;
            cursor: pointer;
            border: 1px solid rgba(208, 160, 79, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(208, 160, 79, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .empty-gallery {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--gray-500);
        }

        .empty-gallery i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: rgba(208, 160, 79, 0.3);
        }

        /* Contact Info */
        .contact-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(208, 160, 79, 0.1);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
        }

        .contact-details h4 {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 0.25rem;
        }

        .contact-details p {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                padding: 1.5rem 0.5rem;
            }

            .sidebar-brand span,
            .nav-link span {
                display: none;
            }

            .sidebar-brand i,
            .nav-link i {
                font-size: 1.25rem;
            }

            .main-content {
                margin-left: 80px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .content {
                padding: 1rem;
            }

            .profile-avatar {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 1rem;
            }

            .profile-details {
                margin-left: 0;
            }

            .profile-stats {
                flex-wrap: wrap;
                justify-content: center;
            }

            .profile-actions {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 640px) {
            .header {
                padding: 1rem;
            }

            .user-btn .user-info {
                display: none;
            }

            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Upload button styling */
        .upload-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: var(--radius);
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        .upload-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .profile-avatar-wrapper:hover .profile-edit-icon {
            opacity: 1;
            transform: scale(1);
        }

        .profile-edit-icon {
            position: absolute;
            margin-bottom: 20px;
            margin-right: 6px;
            background: var(--primary-color);
            color: white;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);

            transform: scale(0.8);
            transition: all 0.2s ease;
        }

        .user-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            min-width: 160px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 6px;
            overflow: hidden;
            display: none;
            z-index: 1000;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            width: 100%;
            padding: 10px 15px;
            text-align: left;
            border: none;
            background: none;
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f5f5f5;
        }

        /* Show dropdown on hover */
        .user-dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Custom styles to complement Bootstrap */
        .btn-outline-primary,
        .btn-outline-dark,
        .btn-outline-info,
        .btn-outline-success,
        .btn-outline-danger,
        .btn-outline-secondary {
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover i,
        .btn-outline-dark:hover i,
        .btn-outline-info:hover i,
        .btn-outline-success:hover i,
        .btn-outline-danger:hover i,
        .btn-outline-secondary:hover i {
            transform: scale(1.1);
        }

        .btn i {
            transition: transform 0.2s ease;
        }

        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem;
            }

            .row.g-2 [class*="col-"] {
                padding: 0 4px;
            }

            .btn.w-100.py-3 {
                padding: 0.75rem 0.25rem !important;
                font-size: 0.8rem;
            }
        }

        /* Custom animation for copy button */
        .btn-success {
            transition: all 0.3s ease;
        }

        /* Toast customization */
        .toast-container {
            z-index: 1060;
        }

        .toast {
            background: white;
            border-left: 4px solid #28a745;
        }

        .toast-header {
            border-bottom-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('profile') }}" class="sidebar-brand">
                <i class="fas fa-user-circle"></i>
                <span>Profile</span>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link">
                    <i class="fas fa-user-edit"></i>
                    <span>Edit Profile</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('profile.settings') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>

            <div class="nav-divider"></div>

            <div class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <div class="page-title">
                    <h1>Welcome, {{ Auth::user()->name }}</h1>
                    <p>Manage your profile and account settings</p>
                </div>

                <div class="header-actions">
                    <div class="user-menu">
                        <div class="user-dropdown">
                            <button class="user-btn">
                                <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D0A04F&color=fff' }}"
                                    class="user-avatar"
                                    alt="{{ Auth::user()->name }}">

                                <div class="user-info">
                                    <div class="user-name">{{ Auth::user()->name }}</div>
                                    <div class="user-role">{{ Auth::user()->profession ?? 'User' }}</div>
                                </div>

                                <i class="fas fa-chevron-down"></i>
                            </button>

                            <div class="dropdown-menu">
                                <a href="{{ url('/') }}">🏠 Home</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">🚪 Logout</button>
                                </form>
                            </div>
                        </div>


                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="{{ url('/') }}" class="dropdown-item">
                                <i class="fas fa-home"></i> Home
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="cover-image" style="background-image: url('{{ Auth::user()->cover_image ? asset(Auth::user()->cover_image) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}')">
                    <div class="cover-overlay">
                        <button class="btn btn-outline" id="changeCoverBtn">
                            <i class="fas fa-camera"></i> Change Cover
                        </button>
                        <input type="file" id="coverInput" accept="image/*" hidden>
                    </div>
                </div>

                <div class="profile-info">
                    <input type="file" id="profileInput" accept="image/*" hidden>

                    <img id="profileAvatar" src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D0A04F&color=fff' }}"
                        class="profile-avatar  cursor-pointer"
                        alt="{{ Auth::user()->name }}">
                    <div class="profile-edit-icon">
                        <i class="fas fa-camera"></i>
                    </div>

                    <div class="profile-details">
                        <h1 class="profile-name">{{ Auth::user()->name }}</h1>

                        <div class="profile-meta">
                            <div class="profile-meta-item">
                                <i class="fas fa-briefcase"></i>
                                <span>{{ Auth::user()->profession ?? 'Professional' }}</span>
                            </div>
                            @if(Auth::user()->locationRelation)
                            <div class="profile-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ Auth::user()->locationRelation->name }}</span>
                            </div>
                            @endif
                            <div class="profile-meta-item">
                                <i class="fas fa-envelope"></i>
                                <span>{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                        <div class="profile-stats">
                            <div class="stat">
                                <div class="stat-value">{{ Auth::user()->multipleImages ? count(Auth::user()->multipleImages) : 0 }}</div>
                                <div class="stat-label">Photos</div>
                            </div>
                        </div>

                        <div class="profile-actions">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>

                            <!-- Share Button -->
                            <button class="btn btn-outline" id="shareProfileBtn" data-bs-toggle="modal" data-bs-target="#shareModal">
                                <i class="fas fa-share-alt"></i> Share
                            </button>

                            <!-- Bootstrap Share Modal -->
                            <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="shareModalLabel">
                                                <i class="fas fa-share-alt me-2"></i>Share Profile
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Profile Preview with Actual User Data -->
                                            <div class="card mb-4 border-0 bg-light">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D0A04F&color=fff' }}"
                                                                alt="{{ Auth::user()->name }}"
                                                                class="rounded-circle"
                                                                width="50"
                                                                height="50"
                                                                id="modalProfileAvatar">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1" id="modalProfileName">{{ Auth::user()->name }}</h6>
                                                            <p class="mb-0 text-muted small" id="modalProfileEmail">{{ Auth::user()->email }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Share Via Label -->
                                            <p class="text-muted mb-3">Share via:</p>

                                            <!-- Social Media Grid -->
                                            <div class="row g-2 mb-3">
                                                <div class="col-4 col-md-3">
                                                    <button onclick="shareOnFacebook()" class="btn btn-outline-primary w-100 py-3" data-bs-dismiss="modal">
                                                        <i class="fab fa-facebook-f fa-lg mb-2 d-block"></i>
                                                        <span class="small">Facebook</span>
                                                    </button>
                                                </div>
                                                <div class="col-4 col-md-3">
                                                    <button onclick="shareOnTwitter()" class="btn btn-outline-dark w-100 py-3" data-bs-dismiss="modal">
                                                        <i class="fab fa-twitter fa-lg mb-2 d-block"></i>
                                                        <span class="small">Twitter</span>
                                                    </button>
                                                </div>
                                                <div class="col-4 col-md-3">
                                                    <button onclick="shareOnLinkedIn()" class="btn btn-outline-info w-100 py-3" data-bs-dismiss="modal">
                                                        <i class="fab fa-linkedin-in fa-lg mb-2 d-block"></i>
                                                        <span class="small">LinkedIn</span>
                                                    </button>
                                                </div>
                                                <div class="col-4 col-md-3">
                                                    <button onclick="shareOnWhatsApp()" class="btn btn-outline-success w-100 py-3" data-bs-dismiss="modal">
                                                        <i class="fab fa-whatsapp fa-lg mb-2 d-block"></i>
                                                        <span class="small">WhatsApp</span>
                                                    </button>
                                                </div>
                                                <div class="col-4 col-md-3">
                                                    <button onclick="shareOnTelegram()" class="btn btn-outline-info w-100 py-3" data-bs-dismiss="modal">
                                                        <i class="fab fa-telegram-plane fa-lg mb-2 d-block"></i>
                                                        <span class="small">Telegram</span>
                                                    </button>
                                                </div>
                                                <div class="col-4 col-md-3">
                                                    <button onclick="shareViaEmail()" class="btn btn-outline-danger w-100 py-3" data-bs-dismiss="modal">
                                                        <i class="fas fa-envelope fa-lg mb-2 d-block"></i>
                                                        <span class="small">Email</span>
                                                    </button>
                                                </div>
                                                <div class="col-4 col-md-3">
                                                    <button onclick="copyProfileLink()" class="btn btn-outline-secondary w-100 py-3" id="copyLinkBtn">
                                                        <i class="fas fa-link fa-lg mb-2 d-block"></i>
                                                        <span class="small">Copy Link</span>
                                                    </button>
                                                </div>
                                                <div class="col-4 col-md-3" id="nativeShareContainer">
                                                    <button onclick="shareNative()" class="btn btn-outline-primary w-100 py-3" data-bs-dismiss="modal">
                                                        <i class="fas fa-share-alt fa-lg mb-2 d-block"></i>
                                                        <span class="small">More</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Direct Link Input -->
                                            <div class="mt-4">
                                                <label class="form-label text-muted small mb-2">Or copy direct link:</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control" id="profileLinkInput" value="" readonly>

                                                    <button class="btn btn-outline-primary" type="button" onclick="copyProfileLink()">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Toast Notification (Bootstrap Toast) -->
                            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                                <div id="shareToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <strong class="me-auto">Success</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Link copied to clipboard!
                                    </div>
                                </div>
                            </div>




                        </div>

                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Main Column -->
                <div class="main-column">
                    <!-- About Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-user"></i> About Me
                            </h2>
                        </div>
                        <div class="about-content">
                            <p>{{ Auth::user()->description ?? 'No description available. Add a description to tell people more about yourself.' }}</p>
                        </div>
                    </div>

                    <!-- Gallery Section -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-images"></i> Gallery
                            </h2>
                            <button class="upload-btn" id="galleryUploadBtn">
                                <i class="fas fa-upload"></i> Upload Image
                            </button>
                        </div>

                        @if(Auth::user()->multipleImages && count(Auth::user()->multipleImages) > 0)
                        <div class="gallery-grid">
                            @foreach(Auth::user()->multipleImages->take(9) as $image)
                            <a href="{{ asset($image->image) }}" data-lightbox="gallery" class="gallery-item">
                                <img src="{{ asset($image->image) }}" alt="Gallery Image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search text-white"></i>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @else
                        <div class="empty-gallery">
                            <i class="fas fa-images"></i>
                            <h3>No photos yet</h3>
                            <p>Upload photos to showcase your work or moments</p>
                            <button class="btn btn-primary mt-2">
                                <i class="fas fa-upload"></i> Upload Photos
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="sidebar-column">
                    <!-- Contact Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-address-card"></i> Contact Information
                            </h2>
                        </div>
                        <div class="contact-list">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <h4>Email</h4>
                                    <p>{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            @if(Auth::user()->phone)
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-details">
                                    <h4>Phone</h4>
                                    <p>{{ Auth::user()->phone }}</p>
                                </div>
                            </div>
                            @endif

                            @if(Auth::user()->locationRelation)
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-details">
                                    <h4>Location</h4>
                                    <p>{{ Auth::user()->locationRelation->name }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <input type="file" id="galleryInput" multiple accept="image/*" hidden>
    </div>

    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const csrf = '{{ csrf_token() }}';

        // ===== PROFILE =====
        document.getElementById('profileAvatar').addEventListener('click', () => {
            document.getElementById('profileInput').click();
        });

        document.getElementById('profileInput').addEventListener('change', function() {
            uploadImage(this.files[0], 'profile_image');
        });

        // ===== COVER =====
        document.getElementById('changeCoverBtn').addEventListener('click', () => {
            document.getElementById('coverInput').click();
        });

        document.getElementById('coverInput').addEventListener('change', function() {
            uploadImage(this.files[0], 'cover_image');
        });


        // ===== CORE UPLOAD FUNCTION =====
        function uploadImage(file, type) {

            if (!file) return;

            const formData = new FormData();
            formData.append(type, file);
            formData.append('_token', csrf);

            fetch("{{ route('profile.image.update') }}", {
                    method: "POST",
                    body: formData,
                })
                .then(res => res.json())
                .then(data => {

                    if (data.status) {

                        if (type === 'profile_image') {
                            document.getElementById('profileAvatar').src = data.url;
                            document.querySelector('.user-avatar').src = data.url;
                        }

                        if (type === 'cover_image') {
                            document.querySelector('.cover-image').style.backgroundImage =
                                `url('${data.url}')`;
                        }

                        toast('✅ Image updated');

                    } else {
                        toast(data.message || 'Upload failed');
                    }

                })
                .catch(err => {
                    console.error(err);
                    toast('Server error');
                });
        }


        // ===== SIMPLE TOAST =====
        function toast(msg) {

            const el = document.createElement('div');

            el.innerText = msg;
            el.style.cssText = `
        position:fixed;
        bottom:30px;
        right:30px;
        background:#111;
        color:#fff;
        padding:12px 18px;
        border-radius:8px;
        z-index:9999;
    `;

            document.body.appendChild(el);

            setTimeout(() => el.remove(), 3000);
        }
    </script>

    <script>
        // Initialize Lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Image %1 of %2'
        });

        // Smooth transitions
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to cards
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-4px)';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });

            // Gallery item animations
            const galleryItems = document.querySelectorAll('.gallery-item');
            galleryItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.05}s`;
            });

            // Button interactions
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(btn => {
                btn.addEventListener('mousedown', () => {
                    btn.style.transform = 'scale(0.98)';
                });

                btn.addEventListener('mouseup', () => {
                    btn.style.transform = '';
                });

                btn.addEventListener('mouseleave', () => {
                    btn.style.transform = '';
                });
            });
        });
    </script>
    <script>
        document.getElementById('galleryUploadBtn').addEventListener('click', () => {
            document.getElementById('galleryInput').click();
        });

        document.getElementById('galleryInput').addEventListener('change', function() {

            const files = this.files;
            if (!files.length) return;

            const formData = new FormData();

            for (let i = 0; i < files.length; i++) {
                formData.append('gallery_images[]', files[i]);
            }

            formData.append('_token', '{{ csrf_token() }}');

            fetch("{{ route('profile.gallery.upload') }}", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.json())
                .then(data => {

                    if (!data.status) {
                        toast(data.message || 'Upload failed');
                        return;
                    }

                    const grid = document.querySelector('.gallery-grid');

                    data.images.forEach(img => {

                        const a = document.createElement('a');
                        a.href = img.url;
                        a.setAttribute('data-lightbox', 'gallery');
                        a.className = 'gallery-item';

                        a.innerHTML = `
                <img src="${img.url}">
                <div class="gallery-overlay">
                    <i class="fas fa-search text-white"></i>
                </div>
            `;

                        grid.prepend(a);
                    });

                    toast('✅ Gallery updated');

                    document.getElementById('galleryInput').value = '';

                })
                .catch(err => {
                    console.error(err);
                    toast('Server error');
                });

        });
    </script>
    <script>
        // Initialize Bootstrap components
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize toast
            const toastEl = document.getElementById('shareToast');
            window.shareToast = new bootstrap.Toast(toastEl, {
                animation: true,
                autohide: true,
                delay: 3000
            });

            // Set profile link in input
            document.getElementById('profileLinkInput').value = window.location.href;

            // Check if Web Share API is available
            const nativeShareContainer = document.getElementById('nativeShareContainer');
            if (!navigator.share) {
                nativeShareContainer.style.display = 'none';
            }

            // Handle modal hidden event
            const shareModal = document.getElementById('shareModal');
            shareModal.addEventListener('hidden.bs.modal', function() {
                // Optional: Reset any state when modal is closed
                console.log('Share modal closed');
            });
        });


        // ===== SHARE FUNCTIONALITY =====
        // Profile data from Laravel
        const profileData = {
            id: '{{ Auth::user()->id }}',
            name: '{{ Auth::user()->name }}',
            email: '{{ Auth::user()->email }}',
            url: '{{ route("userdetails.show", Auth::user()->slug) }}',
            title: '{{ Auth::user()->name }} - Profile',
            description: 'Check out {{ Auth::user()->name }}\'s profile on our platform!'
        };

        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing share functionality');

            // Initialize toast
            const toastEl = document.getElementById('shareToast');
            if (toastEl) {
                window.shareToast = new bootstrap.Toast(toastEl, {
                    animation: true,
                    autohide: true,
                    delay: 3000
                });
                console.log('Toast initialized');
            }

            // Check if Web Share API is available
            const nativeShareContainer = document.getElementById('nativeShareContainer');
            if (nativeShareContainer) {
                if (!navigator.share) {
                    nativeShareContainer.style.display = 'none';
                    console.log('Web Share API not available, hiding native button');
                }
            }

            // Set profile link in input
            const linkInput = document.getElementById('profileLinkInput');
            if (linkInput) {
                linkInput.value = profileData.url;
                console.log('Link input set to:', profileData.url);
            }

            // Update modal profile info
            const modalProfileName = document.getElementById('modalProfileName');
            const modalProfileEmail = document.getElementById('modalProfileEmail');
            const modalProfileAvatar = document.getElementById('modalProfileAvatar');

            if (modalProfileName) modalProfileName.textContent = profileData.name;
            if (modalProfileEmail) modalProfileEmail.textContent = profileData.email;
            if (modalProfileAvatar) {
                modalProfileAvatar.src = '{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : "https://ui-avatars.com/api/?name=" . urlencode(Auth::user()->name) . "&background=D0A04F&color=fff" }}';
            }
        });

        // Share functions - make them global
        window.shareOnFacebook = function() {
            const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(profileData.url)}`;
            window.open(url, '_blank', 'width=600,height=400');
            return false;
        }

        window.shareOnTwitter = function() {
            const text = encodeURIComponent(`Check out ${profileData.name}'s profile`);
            const url = `https://twitter.com/intent/tweet?text=${text}&url=${encodeURIComponent(profileData.url)}`;
            window.open(url, '_blank', 'width=600,height=400');
            return false;
        }

        window.shareOnLinkedIn = function() {
            const url = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(profileData.url)}`;
            window.open(url, '_blank', 'width=600,height=400');
            return false;
        }

        window.shareOnWhatsApp = function() {
            const text = encodeURIComponent(`Check out ${profileData.name}'s profile: ${profileData.url}`);
            const url = `https://wa.me/?text=${text}`;
            window.open(url, '_blank');
            return false;
        }

        window.shareOnTelegram = function() {
            const url = `https://t.me/share/url?url=${encodeURIComponent(profileData.url)}&text=${encodeURIComponent(profileData.name)}`;
            window.open(url, '_blank');
            return false;
        }

        window.shareViaEmail = function() {
            const subject = encodeURIComponent(`Check out ${profileData.name}'s profile`);
            const body = encodeURIComponent(`${profileData.name}\n${profileData.email}\n${profileData.url}`);
            window.location.href = `mailto:?subject=${subject}&body=${body}`;
            return false;
        }

        window.copyProfileLink = function() {
            console.log('Copy function called');

            // Try multiple methods to ensure copy works
            const linkInput = document.getElementById('profileLinkInput');
            const urlToCopy = profileData.url;

            console.log('URL to copy:', urlToCopy);

            // Method 1: Modern clipboard API
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(urlToCopy).then(() => {
                    console.log('Copied using clipboard API');
                    showCopySuccess();
                }).catch(err => {
                    console.error('Clipboard API failed:', err);
                    // Fallback to method 2
                    fallbackCopy();
                });
            } else {
                // Method 2: Fallback method
                fallbackCopy();
            }

            function fallbackCopy() {
                if (linkInput) {
                    linkInput.select();
                    linkInput.setSelectionRange(0, 99999);

                    try {
                        const successful = document.execCommand('copy');
                        if (successful) {
                            console.log('Copied using execCommand');
                            showCopySuccess();
                        } else {
                            console.error('execCommand failed');
                            alert('Press Ctrl+C to copy the link');
                        }
                    } catch (err) {
                        console.error('Fallback copy failed:', err);
                        alert('Please manually copy the link');
                    }
                } else {
                    // Last resort - prompt user to copy
                    prompt('Copy this link:', urlToCopy);
                }
            }

            function showCopySuccess() {
                // Show Bootstrap toast
                if (window.shareToast) {
                    window.shareToast.show();
                }

                // Update button temporarily
                const copyBtn = document.getElementById('copyLinkBtn');
                if (copyBtn) {
                    const originalHtml = copyBtn.innerHTML;
                    const originalClasses = copyBtn.className;

                    copyBtn.innerHTML = '<i class="fas fa-check fa-lg mb-2 d-block"></i><span class="small">Copied!</span>';
                    copyBtn.classList.remove('btn-outline-secondary');
                    copyBtn.classList.add('btn-success');

                    setTimeout(() => {
                        copyBtn.innerHTML = originalHtml;
                        copyBtn.className = originalClasses;
                    }, 2000);
                }
            }

            return false;
        }

        window.shareNative = function() {
            if (navigator.share) {
                navigator.share({
                    title: profileData.title,
                    text: profileData.description,
                    url: profileData.url,
                }).then(() => {
                    console.log('Shared successfully');
                }).catch((error) => {
                    if (error.name !== 'AbortError') {
                        console.error('Error sharing:', error);
                    }
                });
            }
            return false;
        }

        // For debugging - log when buttons are clicked
        document.addEventListener('click', function(e) {
            if (e.target.closest('[onclick^="copyProfileLink"]')) {
                console.log('Copy button clicked');
            }
        });


        // Optional: Track shares
        function trackShare(platform) {
            console.log(`Shared on: ${platform}`);

            // You can send analytics here
            if (typeof gtag !== 'undefined') {
                gtag('event', 'share', {
                    'method': platform,
                    'content_type': 'profile',
                    'item_id': 'profile_123' // Replace with actual profile ID
                });
            }

            // Or send to your backend
            // fetch('/api/track-share', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify({ 
            //         platform: platform, 
            //         profileId: 'profile_123',
            //         timestamp: new Date().toISOString()
            //     })
            // });
        }

        // Optional: Update profile data dynamically
        function updateProfileShareInfo(profile) {
            profileData.name = profile.name;
            profileData.username = profile.username;
            profileData.url = profile.profileUrl;

            // Update preview in modal
            const modalPreview = document.querySelector('#shareModal .card-body');
            if (modalPreview) {
                modalPreview.innerHTML = `Fconst
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img src="${profile.avatar || 'https://via.placeholder.com/50'}" alt="${profile.name}" class="rounded-circle" width="50" height="50">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="mb-1">${profile.name}</h6>
                    <p class="mb-0 text-muted small">${profile.username}</p>
                </div>
            </div>
        `;
            }
        }
    </script>
</body>

</html>