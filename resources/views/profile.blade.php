<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ Auth::user()->name }} - Profile Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Lightbox for gallery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />

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

        .fancybox__container {
            z-index: 999999 !important;
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

        .cover-edit-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--primary-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid white;
            z-index: 10;
        }

        .cover-edit-icon:hover {
            transform: scale(1.1);
            background: var(--primary-dark);
        }

        .cover-image {
            cursor: pointer;
            position: relative;
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
            margin-bottom: 1.5rem;
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

        /* Posts Section */
        .posts-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .post-item {
            padding: 1rem;
            background: var(--gray-50);
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .post-item:hover {
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .post-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .post-images {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin: 0.75rem 0;
        }

        .post-thumbnail {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--gray-200);
        }

        .post-date {
            font-size: 0.75rem;
            color: var(--gray-500);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .post-date i {
            color: var(--primary-color);
            font-size: 0.625rem;
        }

        .empty-posts {
            text-align: center;
            padding: 2rem;
            color: var(--gray-500);
        }

        .empty-posts i {
            font-size: 2.5rem;
            color: rgba(208, 160, 79, 0.3);
            margin-bottom: 0.5rem;
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

        .profile-edit-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: var(--primary-color);
            color: white;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
            cursor: pointer;
            transition: var(--transition);
        }

        .profile-edit-icon:hover {
            transform: scale(1.1);
        }

        .user-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 6px;
            overflow: hidden;
            display: none;
            z-index: 1000;
            padding: 0.5rem 0;
        }

        .user-dropdown:hover .dropdown-menu {
            display: block;
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
            font-size: 0.875rem;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: rgba(208, 160, 79, 0.1);
            color: var(--primary-color);
        }

        .dropdown-divider {
            height: 1px;
            background-color: var(--gray-200);
            margin: 0.5rem 0;
        }

        .cover-crop-container {
            width: 100%;
            height: 400px;
            overflow: hidden;
            background: #f0f0f0;
            border-radius: 8px;
        }

        .cover-crop-container img {
            max-width: 100%;
            display: block;
        }

        /* Cropper.js custom styles */
        .cropper-view-box,
        .cropper-face {
            border-radius: 8px;
        }

        .cropper-view-box {
            outline: 2px solid var(--primary-color, #D0A04F);
            outline-color: rgba(208, 160, 79, 0.75);
        }

        .cropper-line {
            background-color: var(--primary-color, #D0A04F);
        }

        .cropper-point {
            background-color: var(--primary-color, #D0A04F);
            width: 8px;
            height: 8px;
        }

        /* Crop controls styling */
        .crop-controls .btn {
            width: 40px;
            height: 40px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .crop-controls .btn:hover {
            background-color: var(--primary-color, #D0A04F);
            color: white;
            transform: scale(1.1);
        }

        /* Aspect ratio buttons */
        .aspect-ratio-controls .btn.active {
            background-color: var(--primary-color, #D0A04F);
            color: white;
            border-color: var(--primary-color, #D0A04F);
        }

        /* Modal animation */
        .modal.fade .modal-dialog {
            transform: scale(0.95);
            transition: transform 0.2s ease-out;
        }

        .modal.show .modal-dialog {
            transform: scale(1);
        }

        /* Image preview while loading */
        .cover-crop-container::before {
            content: 'Loading image...';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #999;
            font-size: 14px;
        }

        .cover-crop-container img:not([src=""])+.cover-crop-container::before {
            display: none;
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

            .user-btn .user-info {
                display: none;
            }

            .cropper-view-box,
            .cropper-face {
                border-radius: 12px;
            }

            .cropper-container {
                width: 100%;
                height: 420px !important;
            }

            .cover-crop-container {
                width: 100%;
                height: 400px;
                overflow: hidden;
                background: #000;
            }

            .cover-crop-container img {
                max-width: 100%;
                display: block;
            }

            .cropper-view-box,
            .cropper-face {
                border-radius: 12px;
            }

            .cropper-crop-box {
                width: 100% !important;
                height: 100% !important;
            }
        }

        .profile-crop-container {
            width: 100%;
            height: 350px;
            overflow: hidden;
            background: #f0f0f0;
            border-radius: 12px;
            position: relative;
        }

        .profile-crop-container img {
            max-width: 100%;
            display: block;
        }

        /* Custom cropper styles for profile */
        .profile-crop-container+.cropper-container {
            border-radius: 12px;
        }

        .cropper-view-box {
            border-radius: 12px;
            outline: 2px solid var(--primary-color, #D0A04F);
            outline-color: rgba(208, 160, 79, 0.75);
        }

        .cropper-face {
            background-color: inherit;
            border-radius: 12px;
        }

        .cropper-line {
            background-color: var(--primary-color, #D0A04F);
        }

        .cropper-point {
            background-color: var(--primary-color, #D0A04F);
            width: 8px;
            height: 8px;
            border-radius: 4px;
        }

        .preview-circle img {
            transition: all 0.2s;
        }

        .preview-square img {
            transition: all 0.2s;
        }

        /* Crop controls for profile */
        .crop-controls .btn {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
            background: white;
            border: 1px solid #dee2e6;
        }

        .crop-controls .btn:hover {
            background-color: var(--primary-color, #D0A04F);
            color: white;
            transform: scale(1.1);
            border-color: var(--primary-color, #D0A04F);
        }

        /* Size preset buttons */
        .size-presets .btn.active {
            background-color: var(--primary-color, #D0A04F);
            color: white;
            border-color: var(--primary-color, #D0A04F);
        }

        .size-presets .btn {
            transition: all 0.2s;
        }

        .size-presets .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Preview section */
        .preview-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid rgba(208, 160, 79, 0.2);
        }

        /* Modal animations */
        .modal.fade .modal-dialog {
            transform: scale(0.95);
            transition: transform 0.2s ease-out;
        }

        .modal.show .modal-dialog {
            transform: scale(1);
        }

        /* Loading indicator */
        .profile-crop-container.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            margin: -20px 0 0 -20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-color, #D0A04F);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive design */
        @media (max-width: 576px) {
            .profile-crop-container {
                height: 250px;
            }

            .crop-controls .btn {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .size-presets .btn {
                font-size: 12px;
                padding: 4px 8px;
            }
        }

        /* Tooltip for keyboard shortcuts */
        .keyboard-shortcut {
            position: relative;
            cursor: help;
        }

        .keyboard-shortcut:hover::after {
            content: attr(data-shortcut);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
        }

        /* Success animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .profile-avatar.updated {
            animation: pulse 0.5s ease-in-out;
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
                <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('profile.edit') }}"
                    class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fas fa-user-edit"></i>
                    <span>Edit Profile</span>
                </a>
            </div>
            <!-- Gallery Menu Item -->
            <div class="nav-item">
                <a href="{{ route('profile.gallery') }}"
                    class="nav-link {{ request()->routeIs('profile.gallery') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('profile.settings') }}"
                    class="nav-link {{ request()->routeIs('profile.settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>

            <div class="nav-divider"></div>

            <div class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link"
                        style="width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
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
                                    class="user-avatar" alt="{{ Auth::user()->name }}">

                                <div class="user-info">
                                    <div class="user-name">{{ Auth::user()->name }}</div>
                                    <div class="user-role">{{ Auth::user()->profession ?? 'User' }}</div>
                                </div>

                                <i class="fas fa-chevron-down"></i>
                            </button>

                            <div class="dropdown-menu">
                                <a href="{{ url('/') }}">
                                    <i class="fas fa-home"></i> Home
                                </a>
                                <a href="{{ route('profile') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit"></i> Edit Profile
                                </a>
                                <a href="{{ route('profile.gallery') }}">
                                    <i class="fas fa-images"></i> Gallery
                                </a>
                                <a href="{{ route('profile.settings') }}">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="cover-image"
                    style="background-image: url('{{ Auth::user()->cover_image ? asset(Auth::user()->cover_image) : 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}'); cursor: pointer; position: relative;"
                    id="coverImageContainer" onclick="openOriginalCoverImage()"
                    data-original="{{ Auth::user()->cover_image ? asset(Auth::user()->cover_image) : '' }}">

                    <div class="cover-overlay">
                        <!-- Edit Icon instead of Camera button -->
                        <div class="cover-edit-icon"
                            onclick="event.stopPropagation(); document.getElementById('coverInput').click()"
                            title="Change Cover Image">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <input type="file" id="coverInput" accept="image/*" hidden>
                    </div>
                </div>

                <div class="profile-info">
                    <input type="file" id="profileInput" accept="image/*" hidden>

                    <div style="position: relative; display: inline-block;">
                        <!-- Profile Image (click to view original) -->
                        <img id="profileAvatar"
                            src="{{ Auth::user()->profile_thumbnail ? asset(Auth::user()->profile_thumbnail) : (Auth::user()->profile_image ? asset(Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D0A04F&color=fff') }}"
                            class="profile-avatar cursor-pointer" alt="{{ Auth::user()->name }}"
                            onclick="openOriginalProfileImage()" style="cursor: pointer;"
                            data-original="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : '' }}">

                        <!-- Edit Button instead of Camera Icon -->
                        <div class="profile-edit-icon" title="Change Profile Picture">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                    </div>

                    <div class="profile-details">
                        <h1 class="profile-name">{{ Auth::user()->name }}</h1>

                        <div class="profile-meta">
                            <div class="profile-meta-item">
                                <i class="fas fa-briefcase"></i>
                                <span>{{ Auth::user()->profession ?? 'Professional' }}</span>
                            </div>
                            @if (Auth::user()->locationRelation)
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
                                <div class="stat-value">{{ $feeds->count() }}</div>
                                <div class="stat-label">Posts</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">
                                    {{ Auth::user()->multipleImages ? count(Auth::user()->multipleImages) : 0 }}</div>
                                <div class="stat-label">Photos</div>
                            </div>
                        </div>

                        <div class="profile-actions">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>

                            <!-- Share Button -->
                            <button class="btn btn-outline" id="shareProfileBtn" data-bs-toggle="modal"
                                data-bs-target="#shareModal">
                                <i class="fas fa-share-alt"></i> Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Main Column -->
                <div class="main-column">
                    <!-- About Section -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-user"></i> About Me
                            </h2>
                        </div>
                        <div class="about-content">
                            <p>{{ Auth::user()->description ?? 'No description available. Add a description to tell people more about yourself.' }}
                            </p>
                        </div>
                    </div>

                    <!-- My Posts Section (Under About) -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">
                                <i class="fas fa-images"></i> My Posts
                            </h2>
                        </div>

                        <div class="posts-list">
                            @forelse($feeds as $feed)
                                <div class="post-item" data-post-id="{{ $feed->id }}" style="cursor: pointer;">
                                    <h3 class="post-title">{{ $feed->title }}</h3>

                                    @if ($feed->images && $feed->images->count())
                                        <div class="post-images">
                                            @foreach ($feed->images->take(3) as $image)
                                                <img src="{{ asset('storage/' . $image->image) }}"
                                                    class="post-thumbnail cursor-pointer" alt="Post image"
                                                    onclick="event.stopPropagation(); openPostGallery({{ $feed->id }})">
                                            @endforeach
                                            @if ($feed->images->count() > 3)
                                                <div class="post-thumbnail d-flex align-items-center justify-content-center bg-light cursor-pointer"
                                                    onclick="event.stopPropagation(); openPostGallery({{ $feed->id }})">
                                                    +{{ $feed->images->count() - 3 }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="post-date">
                                        <i class="fas fa-clock"></i>
                                        {{ $feed->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @empty
                                <div class="empty-posts">
                                    <i class="fas fa-images"></i>
                                    <p>No posts yet. Create your first post!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="sidebar-column">
                    <!-- Contact Information -->
                    <div class="card">
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

                            @if (Auth::user()->phone)
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

                            @if (Auth::user()->locationRelation)
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

                            @if (Auth::user()->website)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h4>Website</h4>
                                        <p>{{ Auth::user()->website }}</p>
                                    </div>
                                </div>
                            @endif

                            @if (Auth::user()->profession)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h4>Profession</h4>
                                        <p>{{ Auth::user()->profession }}</p>
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

    <!-- Share Modal -->
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
                    <!-- Profile Preview -->
                    <div class="card mb-4 border-0 bg-light">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D0A04F&color=fff' }}"
                                        alt="{{ Auth::user()->name }}" class="rounded-circle" width="50"
                                        height="50" id="modalProfileAvatar">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1" id="modalProfileName">{{ Auth::user()->name }}</h6>
                                    <p class="mb-0 text-muted small" id="modalProfileEmail">{{ Auth::user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Share Via Label -->
                    <p class="text-muted mb-3">Share via:</p>

                    <!-- Social Media Grid -->
                    <div class="row g-2 mb-3">
                        <div class="col-4 col-md-3">
                            <button onclick="shareOnFacebook()" class="btn btn-outline-primary w-100 py-3"
                                data-bs-dismiss="modal">
                                <i class="fab fa-facebook-f fa-lg mb-2 d-block"></i>
                                <span class="small">Facebook</span>
                            </button>
                        </div>
                        <div class="col-4 col-md-3">
                            <button onclick="shareOnTwitter()" class="btn btn-outline-dark w-100 py-3"
                                data-bs-dismiss="modal">
                                <i class="fab fa-twitter fa-lg mb-2 d-block"></i>
                                <span class="small">Twitter</span>
                            </button>
                        </div>
                        <div class="col-4 col-md-3">
                            <button onclick="shareOnLinkedIn()" class="btn btn-outline-info w-100 py-3"
                                data-bs-dismiss="modal">
                                <i class="fab fa-linkedin-in fa-lg mb-2 d-block"></i>
                                <span class="small">LinkedIn</span>
                            </button>
                        </div>
                        <div class="col-4 col-md-3">
                            <button onclick="shareOnWhatsApp()" class="btn btn-outline-success w-100 py-3"
                                data-bs-dismiss="modal">
                                <i class="fab fa-whatsapp fa-lg mb-2 d-block"></i>
                                <span class="small">WhatsApp</span>
                            </button>
                        </div>
                    </div>

                    <!-- Direct Link Input -->
                    <div class="mt-4">
                        <label class="form-label text-muted small mb-2">Or copy direct link:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="profileLinkInput" value=""
                                readonly>
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

    <!-- Post Images Modal -->
    <div class="modal fade" id="postImagesModal" tabindex="-1" aria-labelledby="postImagesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postImagesModalLabel"> 
                        <i class="fas fa-images me-2"></i>Post Images
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="file" id="modalImageInput" multiple accept="image/*" hidden>
                        <button class="btn btn-primary" onclick="document.getElementById('modalImageInput').click()">
                            <i class="fas fa-plus-circle"></i> Add Images
                        </button> 
                    </div>

                    <div id="postImagesContainer" class="row g-3">
                        <!-- Images will be loaded here dynamically -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     
    <!-- Cover Image Crop Modal -->
    <div class="modal fade" id="coverCropModal" tabindex="-1" aria-labelledby="coverCropModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="coverCropModalLabel">
                        <i class="fas fa-crop me-2"></i>Adjust Cover Image
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cover-crop-container"
                        style="max-height: 500px; overflow: hidden; background: #f5f5f5;">
                        <img id="coverCropImage" src="" alt="Cover image to crop"
                            style="max-width: 100%; display: block;">
                    </div>

                    <!-- Crop Controls -->
                    <div class="crop-controls mt-3 d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="coverCropper.zoom(0.1)">
                            <i class="fas fa-search-plus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="coverCropper.zoom(-0.1)">
                            <i class="fas fa-search-minus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="coverCropper.move(-10, 0)">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="coverCropper.move(10, 0)">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="coverCropper.move(0, -10)">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="coverCropper.move(0, 10)">
                            <i class="fas fa-arrow-down"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="coverCropper.reset()">
                            <i class="fas fa-undo"></i>
                        </button>
                    </div>

                    <!-- Aspect Ratio Options -->
                    <div class="aspect-ratio-controls mt-3">
                        <label class="form-label text-muted small">Aspect Ratio:</label>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-sm btn-outline-primary active"
                                onclick="setCoverAspectRatio(16/5)">
                                16:5 (Current)
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="setCoverAspectRatio(16/9)">
                                16:9
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="setCoverAspectRatio(3/1)">
                                3:1
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="setCoverAspectRatio(4/1)">
                                4:1
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="setCoverAspectRatio(NaN)">
                                Free
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="saveCoverBtn">
                        <i class="fas fa-check me-2"></i>Save Cover
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Picture Crop Modal -->
    <div class="modal fade" id="profileCropModal" tabindex="-1" aria-labelledby="profileCropModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileCropModalLabel">
                        <i class="fas fa-crop me-2"></i>Adjust Profile Picture
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="profile-crop-container"
                        style="max-height: 400px; overflow: hidden; background: #f5f5f5; border-radius: 12px;">
                        <img id="profileCropImage" src="" alt="Profile image to crop"
                            style="max-width: 100%; display: block;">
                    </div>

                    <!-- Crop Controls -->
                    <div class="crop-controls mt-3 d-flex justify-content-center gap-2 flex-wrap">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.zoom(0.1)">
                            <i class="fas fa-search-plus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.zoom(-0.1)">
                            <i class="fas fa-search-minus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.move(-10, 0)">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.move(10, 0)">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.move(0, -10)">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.move(0, 10)">
                            <i class="fas fa-arrow-down"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.rotate(-90)">
                            <i class="fas fa-undo-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.rotate(90)">
                            <i class="fas fa-redo-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="profileCropper.reset()">
                            <i class="fas fa-undo"></i>
                        </button>
                    </div>

                    <!-- Size Presets -->
                    <div class="size-presets mt-3">
                        <label class="form-label text-muted small">Size Presets:</label>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="setProfileSize(300, 300, this)">
                                <i class="fas fa-image me-1"></i>Small (300x300)
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary active"
                                onclick="setProfileSize(512, 512, this)">
                                <i class="fas fa-image me-1"></i>Medium (512x512)
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="setProfileSize(1024, 1024, this)">
                                <i class="fas fa-image me-1"></i>Large (1024x1024)
                            </button>
                        </div>
                    </div>

                    <!-- Preview -->
                    <div class="preview-section mt-3 p-3 bg-light rounded">
                        <label class="form-label text-muted small mb-2">Preview:</label>
                        <div class="d-flex align-items-center gap-3">
                            <div class="preview-circle"
                                style="width: 60px; height: 60px; border-radius: 12px; overflow: hidden; border: 2px solid var(--primary-color);">
                                <img id="profilePreview" src="" alt="Preview"
                                    style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            </div>
                            <div class="preview-square"
                                style="width: 60px; height: 60px; overflow: hidden; border-radius: 8px; border: 2px solid var(--primary-color);">
                                <img id="profilePreviewSquare" src="" alt="Preview square"
                                    style="width: 100%; height: 100%; object-fit: cover; display: none;">
                            </div>
                            <small class="text-muted">Rounded & Square preview</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="saveProfileBtn">
                        <i class="fas fa-check me-2"></i>Save Profile Picture
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
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

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

    <script>
        // CSRF token
        const csrf = '{{ csrf_token() }}';

        // ============================================
        // SHARE FUNCTIONALITY
        // ============================================
        const profileData = {
            id: '{{ Auth::user()->id }}',
            name: '{{ Auth::user()->name }}',
            email: '{{ Auth::user()->email }}',
            url: '{{ route('userdetails.show', Auth::user()->slug) }}',
            title: '{{ Auth::user()->name }} - Profile',
            description: 'Check out {{ Auth::user()->name }}\'s profile on our platform!'
        };

        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('shareToast');
            window.shareToast = new bootstrap.Toast(toastEl, {
                animation: true,
                autohide: true,
                delay: 3000
            });

            document.getElementById('profileLinkInput').value = profileData.url;

            // Initialize post items
            initializePostItems();
            initializeModalHandlers();
        });

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

        window.copyProfileLink = function() {
            const urlToCopy = profileData.url;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(urlToCopy).then(() => {
                    showCopySuccess();
                }).catch(() => {
                    fallbackCopy();
                });
            } else {
                fallbackCopy();
            }

            function fallbackCopy() {
                const linkInput = document.getElementById('profileLinkInput');
                if (linkInput) {
                    linkInput.select();
                    linkInput.setSelectionRange(0, 99999);
                    try {
                        document.execCommand('copy');
                        showCopySuccess();
                    } catch (err) {
                        prompt('Copy this link:', urlToCopy);
                    }
                }
            }

            function showCopySuccess() {
                if (window.shareToast) {
                    window.shareToast.show();
                }
            }

            return false;
        }

        // ============================================
        // POST GALLERY FUNCTIONALITY
        // ============================================
        let currentPostId = null;
        let currentModal = null;

        function initializePostItems() {
            const postItems = document.querySelectorAll('.post-item');
            postItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    // Don't open if clicking on an image (to allow lightbox)
                    if (e.target.classList.contains('post-thumbnail')) {
                        return;
                    }

                    const postId = this.dataset.postId;
                    if (postId) {
                        openPostGallery(postId);
                    }
                });
            });
        }

        function initializeModalHandlers() {
            // Handle modal hidden event to ensure cleanup
            const modalEl = document.getElementById('postImagesModal');
            if (modalEl) {
                modalEl.addEventListener('hidden.bs.modal', function() {
                    cleanupModal();
                });
            }

            // Handle modal close button
            const closeBtn = document.querySelector('#postImagesModal .btn-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    hideModal();
                });
            }

            // Handle modal footer close button
            const footerCloseBtn = document.querySelector('#postImagesModal .modal-footer .btn-light');
            if (footerCloseBtn) {
                footerCloseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    hideModal();
                });
            }

            // Handle escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && currentModal) {
                    hideModal();
                }
            });
        }

        function cleanupModal() {
            // Remove any lingering modal backdrops
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());

            // Reset body classes and styles
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';

            // Reset modal instance
            if (currentModal) {
                currentModal = null;
            }
        }

        function hideModal() {
            if (currentModal) {
                currentModal.hide();
            } else {
                // Fallback cleanup if modal instance is lost
                cleanupModal();
                const modalEl = document.getElementById('postImagesModal');
                if (modalEl) {
                    modalEl.classList.remove('show');
                    modalEl.style.display = 'none';
                }
            }
        }

        function showModal() {
            const modalEl = document.getElementById('postImagesModal');

            // Dispose existing modal instance if any
            if (currentModal) {
                currentModal.dispose();
            }

            // Create new modal instance
            currentModal = new bootstrap.Modal(modalEl, {
                backdrop: 'static',
                keyboard: true
            });

            currentModal.show();
        }

        window.openPostGallery = function(postId) {
            if (!postId) return;

            currentPostId = postId;

            // Show loading state
            const container = document.getElementById('postImagesContainer');
            container.innerHTML =
                '<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Loading images...</p></div>';

            fetch(`/post/${postId}/images`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.status) {
                        displayPostImages(data.images);
                        showModal();
                    } else {
                        throw new Error(data.message || 'Failed to load images');
                    }
                })
                .catch(err => {
                    console.error('Error loading post images:', err);
                    container.innerHTML =
                        '<div class="col-12 text-center py-5"><i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i><p>Failed to load images. Please try again.</p></div>';
                    toast('❌ ' + err.message);
                });
        }

        function displayPostImages(images) {
            const container = document.getElementById('postImagesContainer');
            container.innerHTML = '';

            if (!images || images.length === 0) {
                container.innerHTML =
                    '<div class="col-12 text-center py-5"><i class="fas fa-images fa-3x text-muted mb-3"></i><p>No images in this post</p></div>';
                return;
            }

            images.forEach(image => {
                const col = document.createElement('div');
                col.className = 'col-md-4 col-sm-6 mb-3';

                col.innerHTML = `
                    <div class="position-relative image-card">
                        <a data-fancybox="post-gallery" href="${image.url}">
                            <img src="${image.url}"
                                 class="img-fluid rounded shadow-sm"
                                 style="width:100%; height:150px; object-fit:cover; cursor:pointer"
                                 alt="Post image">
                        </a>
                        <div class="position-absolute top-0 end-0 m-2">
                            <button class="btn btn-sm btn-danger rounded-circle"
                                    onclick="deletePostImage(${image.id}, event)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;

                container.appendChild(col);
            });

            Fancybox.bind("[data-fancybox='post-gallery']", {});
        }

        // Handle adding new images
        document.getElementById('modalImageInput')?.addEventListener('change', function() {
            if (!this.files.length || !currentPostId) {
                toast('❌ No post selected or no files chosen');
                return;
            }

            // Validate file types
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            const files = Array.from(this.files);
            const invalidFiles = files.filter(file => !validTypes.includes(file.type));

            if (invalidFiles.length > 0) {
                toast('❌ Please select only image files (JPEG, PNG, GIF, WEBP)');
                this.value = '';
                return;
            }

            // Show uploading state
            const uploadBtn = document.querySelector(
                '[onclick="document.getElementById(\'modalImageInput\').click()"]');
            const originalText = uploadBtn.innerHTML;
            uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
            uploadBtn.disabled = true;

            const formData = new FormData();
            formData.append('post_id', currentPostId);
            formData.append('_token', csrf);

            files.forEach(file => {
                formData.append('images[]', file);
            });

            fetch('/post/images/add', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Upload failed');
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.status) {
                        toast('✅ Images added successfully');
                        // Refresh the gallery
                        openPostGallery(currentPostId);
                    } else {
                        throw new Error(data.message || 'Upload failed');
                    }
                })
                .catch(err => {
                    console.error('Error uploading images:', err);
                    toast('❌ ' + err.message);
                })
                .finally(() => {
                    // Reset upload button
                    uploadBtn.innerHTML = originalText;
                    uploadBtn.disabled = false;
                    this.value = '';
                });
        });

        // Delete post image
        window.deletePostImage = function(imageId, event) {
            if (event) {
                event.stopPropagation();
            }

            if (!confirm('Are you sure you want to delete this image? This action cannot be undone.')) {
                return;
            }

            // Find and disable the delete button to prevent double clicks
            const deleteBtn = event?.target?.closest('button');
            if (deleteBtn) {
                deleteBtn.disabled = true;
                deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            }

            fetch('/post/images/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        image_id: imageId
                    })
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Delete failed');
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.status) {
                        toast('✅ Image deleted successfully');
                        // Refresh the gallery
                        openPostGallery(currentPostId);
                    } else {
                        throw new Error(data.message || 'Delete failed');
                    }
                })
                .catch(err => {
                    console.error('Error deleting image:', err);
                    toast('❌ ' + err.message);
                    // Re-enable the delete button if there's an error
                    if (deleteBtn) {
                        deleteBtn.disabled = false;
                        deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
                    }
                });
        }

        // ============================================
        // COVER IMAGE CROPPING
        // ============================================
        let coverCropper = null;
        let coverCropModal = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize cover crop modal
            const modalElement = document.getElementById('coverCropModal');
            coverCropModal = new bootstrap.Modal(modalElement);

            // Handle modal hidden event
            modalElement.addEventListener('hidden.bs.modal', function() {
                if (coverCropper) {
                    coverCropper.destroy();
                    coverCropper = null;
                }
                // Clear the file input
                document.getElementById('coverInput').value = '';
            });
        });

        // Set cover aspect ratio
        window.setCoverAspectRatio = function(ratio) {
            if (coverCropper) {
                coverCropper.setAspectRatio(ratio);

                // Update active button state
                document.querySelectorAll('.aspect-ratio-controls .btn').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Find and activate the clicked button
                const buttons = document.querySelectorAll('.aspect-ratio-controls .btn');
                if (isNaN(ratio)) {
                    // Free aspect ratio
                    buttons.forEach(btn => {
                        if (btn.textContent.trim() === 'Free') {
                            btn.classList.add('active');
                        }
                    });
                } else {
                    buttons.forEach(btn => {
                        const btnRatio = btn.getAttribute('onclick')?.match(/[\d.]+/g);
                        if (btnRatio && Math.abs(eval(btnRatio.join('/')) - ratio) < 0.01) {
                            btn.classList.add('active');
                        }
                    });
                }
            }
        };


        // ============================================
// VIEW ORIGINAL COVER IMAGE
// ============================================
window.openOriginalCoverImage = function() {
    const coverContainer = document.getElementById('coverImageContainer');
    const originalSrc = coverContainer.dataset.original;
    
    if (originalSrc && originalSrc !== '') {
        Fancybox.show([{
            src: originalSrc,
            type: 'image',
            caption: '{{ Auth::user()->name }} - Cover Image'
        }]);
    } else {
        // If no custom image, get the background image URL
        const bgImage = coverContainer.style.backgroundImage;
        const url = bgImage.replace(/^url\(['"](.+)['"]\)/, '$1');
        Fancybox.show([{
            src: url,
            type: 'image',
            caption: '{{ Auth::user()->name }} - Cover Image'
        }]);
    }
}

        // Handle cover input change - Show crop modal
       // Remove the old changeCoverBtn handler and add these:

// Handle edit icon click (already handled inline, but we need to ensure file input exists)
document.getElementById('coverInput')?.addEventListener('click', function(e) {
    e.stopPropagation(); // Prevent triggering the cover image click
});

// Keep the existing change handler for when file is selected
document.getElementById('coverInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    // Validate file type
    if (!file.type.match('image.*')) {
        toast('❌ Please select an image file');
        this.value = '';
        return;
    }

    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
        toast('❌ Image size should be less than 5MB');
        this.value = '';
        return;
    }

    const reader = new FileReader();
   
    reader.onload = function(event) {
        // Set the image source
        const cropImage = document.getElementById('coverCropImage');
        cropImage.src = event.target.result;
       
        // Show the modal
        coverCropModal.show();
       
        // Initialize cropper after modal is shown
        setTimeout(() => {
            if (coverCropper) {
                coverCropper.destroy();
            }
           
            coverCropper = new Cropper(cropImage, {
                aspectRatio: 16 / 5,
                viewMode: 1,
                dragMode: 'move',
                cropBoxMovable: true,
                cropBoxResizable: true,
                guides: true,
                center: true,
                highlight: false,
                background: false,
                autoCropArea: 1,
                zoomOnWheel: true,
                minContainerWidth: 600,
                minContainerHeight: 400,
                ready: function() {
                    const containerData = this.cropper.getContainerData();
                    const cropBoxData = {
                        left: 0,
                        top: 0,
                        width: containerData.width,
                        height: containerData.width / (16/5)
                    };
                    if (cropBoxData.height < containerData.height) {
                        cropBoxData.top = (containerData.height - cropBoxData.height) / 2;
                    }
                    this.cropper.setCropBoxData(cropBoxData);
                }
            });
        }, 200);
    };
   
    reader.readAsDataURL(file);
});

        document.getElementById('coverInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate file type
            if (!file.type.match('image.*')) {
                toast('❌ Please select an image file');
                this.value = '';
                return;
            }

            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                toast('❌ Image size should be less than 5MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                // Set the image source
                const cropImage = document.getElementById('coverCropImage');
                cropImage.src = event.target.result;

                // Show the modal
                coverCropModal.show();

                // Initialize cropper after modal is shown
                setTimeout(() => {
                    if (coverCropper) {
                        coverCropper.destroy();
                    }

                    coverCropper = new Cropper(cropImage, {
                        aspectRatio: 16 / 5, // Default aspect ratio
                        viewMode: 1,
                        dragMode: 'move',
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        guides: true,
                        center: true,
                        highlight: false,
                        background: false,
                        autoCropArea: 1,
                        zoomOnWheel: true,
                        minContainerWidth: 600,
                        minContainerHeight: 400,
                        ready: function() {
                            // Set crop box to cover entire image initially
                            const containerData = this.cropper.getContainerData();
                            const cropBoxData = {
                                left: 0,
                                top: 0,
                                width: containerData.width,
                                height: containerData.width / (16 / 5)
                            };
                            // Center vertically if height is less than container
                            if (cropBoxData.height < containerData.height) {
                                cropBoxData.top = (containerData.height - cropBoxData
                                    .height) / 2;
                            }
                            this.cropper.setCropBoxData(cropBoxData);
                        }
                    });
                }, 200);
            };

            reader.readAsDataURL(file);
        });

        // Save cropped cover image
        document.getElementById('saveCoverBtn').addEventListener('click', function() {
            if (!coverCropper) return;

            // Show loading state
            const saveBtn = this;
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
            saveBtn.disabled = true;

            // Get cropped canvas
            const canvas = coverCropper.getCroppedCanvas({
                width: 1920, // Max width
                height: 600, // Max height (maintaining aspect ratio)
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            // Convert canvas to blob
            canvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('cover_image', blob, 'cover-image.jpg');
                formData.append('_token', csrf);

                // Upload the cropped image
                fetch("{{ route('profile.image.update') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => {
                        if (!res.ok) {
                            throw new Error('Upload failed');
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.status) {
                            // Update cover image
                            document.querySelector('.cover-image').style.backgroundImage =
                                `url('${data.url}?t=${Date.now()}')`;

                            // Show success message
                            toast('✅ Cover image updated successfully');

                            // Close modal
                            coverCropModal.hide();

                            // Clear file input
                            document.getElementById('coverInput').value = '';
                        } else {
                            throw new Error(data.message || 'Upload failed');
                        }
                    })
                    .catch(err => {
                        console.error('Error uploading cover:', err);
                        toast('❌ ' + err.message);
                    })
                    .finally(() => {
                        // Reset button
                        saveBtn.innerHTML = originalText;
                        saveBtn.disabled = false;
                    });
            }, 'image/jpeg', 0.95); // High quality JPEG
        });

        // ============================================
        // PROFILE PICTURE CROPPING
        // ============================================
        let profileCropper = null;
        let profileCropModal = null;
        let selectedProfileSize = 512; // Default size

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize profile crop modal
            const modalElement = document.getElementById('profileCropModal');
            profileCropModal = new bootstrap.Modal(modalElement);

            // Handle modal hidden event
            modalElement.addEventListener('hidden.bs.modal', function() {
                if (profileCropper) {
                    profileCropper.destroy();
                    profileCropper = null;
                }
                // Clear preview images
                document.getElementById('profilePreview').style.display = 'none';
                document.getElementById('profilePreviewSquare').style.display = 'none';
                // Clear the file input
                document.getElementById('profileInput').value = '';
            });
        });

        // Set profile image size
        window.setProfileSize = function(width, height, button) {
            selectedProfileSize = width;
            if (profileCropper) {
                // Update active button state
                document.querySelectorAll('.size-presets .btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');

                toast(`ℹ️ Image will be saved as ${width}x${height} pixels`);
            }
        };

        // Handle profile input change - Show crop modal
        // ============================================
        // PROFILE IMAGE CLICK HANDLER - Show original
        // ============================================
        document.getElementById('profileAvatar').addEventListener('click', function(e) {
            // Don't trigger if clicking on the edit icon
            if (e.target.classList.contains('profile-edit-icon') || e.target.closest('.profile-edit-icon')) {
                return;
            }

            // Get the original image URL from data attribute
            const originalSrc = this.dataset.original;

            // If there's an original image, show it
            if (originalSrc && originalSrc !== '') {
                Fancybox.show([{
                    src: originalSrc,
                    type: 'image',
                    caption: '{{ Auth::user()->name }} - Profile Picture'
                }]);
            } else {
                // If no custom image, show the current thumbnail/avatar
                Fancybox.show([{
                    src: this.src,
                    type: 'image',
                    caption: '{{ Auth::user()->name }} - Profile Picture'
                }]);
            }
        });

        // ============================================
        // EDIT ICON CLICK HANDLER - Change profile picture
        // ============================================
        document.querySelector('.profile-edit-icon').addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event from bubbling to parent
            document.getElementById('profileInput').click();
        });

        document.getElementById('profileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate file type
            if (!file.type.match('image.*')) {
                toast('❌ Please select an image file');
                this.value = '';
                return;
            }

            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                toast('❌ Image size should be less than 5MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(event) {
                // Set the image source
                const cropImage = document.getElementById('profileCropImage');
                cropImage.src = event.target.result;

                // Show the modal
                profileCropModal.show();

                // Initialize cropper after modal is shown
                setTimeout(() => {
                    if (profileCropper) {
                        profileCropper.destroy();
                    }

                    profileCropper = new Cropper(cropImage, {
                        aspectRatio: 1 / 1, // 1:1 aspect ratio for profile pictures
                        viewMode: 1,
                        dragMode: 'move',
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        guides: true,
                        center: true,
                        highlight: false,
                        background: false,
                        autoCropArea: 1,
                        zoomOnWheel: true,
                        minContainerWidth: 300,
                        minContainerHeight: 300,
                        crop: function(event) {
                            // Update preview in real-time
                            updateProfilePreview(event.detail);
                        },
                        ready: function() {
                            // Set crop box to square in the center
                            const containerData = this.cropper.getContainerData();
                            const size = Math.min(containerData.width, containerData
                                .height);
                            this.cropper.setCropBoxData({
                                left: (containerData.width - size) / 2,
                                top: (containerData.height - size) / 2,
                                width: size,
                                height: size
                            });
                        }
                    });
                }, 200);
            };

            reader.readAsDataURL(file);
        });

        // Update preview images
        function updateProfilePreview(data) {
            if (!profileCropper) return;

            // Get cropped canvas for preview
            const canvas = profileCropper.getCroppedCanvas({
                width: 100,
                height: 100,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            });

            // Update preview images
            const previewImg = document.getElementById('profilePreview');
            const previewSquareImg = document.getElementById('profilePreviewSquare');

            previewImg.src = canvas.toDataURL('image/jpeg');
            previewSquareImg.src = canvas.toDataURL('image/jpeg');

            previewImg.style.display = 'block';
            previewSquareImg.style.display = 'block';
        }

        // Save cropped profile image
        document.getElementById('saveProfileBtn').addEventListener('click', function() {
            if (!profileCropper) return;

            // Show loading state
            const saveBtn = this;
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
            saveBtn.disabled = true;

            // Get cropped canvas with selected size
            const canvas = profileCropper.getCroppedCanvas({
                width: selectedProfileSize,
                height: selectedProfileSize,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            // Convert canvas to blob
            canvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('profile_image', blob, 'profile-image.jpg');
                formData.append('_token', csrf);

                // Upload the cropped image
                fetch("{{ route('profile.image.update') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => {
                        if (!res.ok) {
                            throw new Error('Upload failed');
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.status) {
                            // Update profile images
                            const newImageUrl = `${data.url}?t=${Date.now()}`;
                            document.getElementById('profileAvatar').src = newImageUrl;
                            document.querySelector('.user-avatar').src = newImageUrl;
                            document.getElementById('modalProfileAvatar').src = newImageUrl;

                            // Show success message
                            toast('✅ Profile picture updated successfully');

                            // Close modal
                            profileCropModal.hide();

                            // Clear file input
                            document.getElementById('profileInput').value = '';
                        } else {
                            throw new Error(data.message || 'Upload failed');
                        }
                    })
                    .catch(err => {
                        console.error('Error uploading profile image:', err);
                        toast('❌ ' + err.message);
                    })
                    .finally(() => {
                        // Reset button
                        saveBtn.innerHTML = originalText;
                        saveBtn.disabled = false;
                    });
            }, 'image/jpeg', 0.95); // High quality JPEG
        });

        // Add keyboard shortcuts for cropping
        document.addEventListener('keydown', function(e) {
            if (!profileCropper || !profileCropModal || !document.getElementById('profileCropModal').classList
                .contains('show')) {
                return;
            }

            switch (e.key) {
                case '+':
                case '=':
                    e.preventDefault();
                    profileCropper.zoom(0.1);
                    break;
                case '-':
                    e.preventDefault();
                    profileCropper.zoom(-0.1);
                    break;
                case 'ArrowLeft':
                    e.preventDefault();
                    profileCropper.move(-10, 0);
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    profileCropper.move(10, 0);
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    profileCropper.move(0, -10);
                    break;
                case 'ArrowDown':
                    e.preventDefault();
                    profileCropper.move(0, 10);
                    break;
                case 'r':
                    e.preventDefault();
                    profileCropper.reset();
                    break;
                case 'Enter':
                    e.preventDefault();
                    document.getElementById('saveProfileBtn').click();
                    break;
            }
        });

        // ============================================
        // TOAST FUNCTION
        // ============================================
        function toast(message, duration = 3000) {
            // Create toast container if it doesn't exist
            let toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
                document.body.appendChild(toastContainer);
            }

            // Determine toast style based on message
            const isSuccess = message.includes('✅');
            const isError = message.includes('❌');
            const isInfo = message.includes('ℹ️');

            const toastEl = document.createElement('div');
            toastEl.className = 'toast show';
            toastEl.setAttribute('role', 'alert');
            toastEl.setAttribute('aria-live', 'assertive');
            toastEl.setAttribute('aria-atomic', 'true');

            let bgClass = '';
            if (isSuccess) bgClass = 'bg-success text-white';
            else if (isError) bgClass = 'bg-danger text-white';
            else if (isInfo) bgClass = 'bg-info text-white';

            toastEl.innerHTML = `
                <div class="toast-header ${bgClass}">
                    <i class="fas ${isSuccess ? 'fa-check-circle' : isError ? 'fa-exclamation-circle' : isInfo ? 'fa-info-circle' : 'fa-bell'} me-2"></i>
                    <strong class="me-auto">${isSuccess ? 'Success' : isError ? 'Error' : isInfo ? 'Info' : 'Notification'}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message.replace(/[✅❌ℹ️]/g, '')}
                </div>
            `;

            toastContainer.appendChild(toastEl);

            const toast = new bootstrap.Toast(toastEl, {
                animation: true,
                autohide: true,
                delay: duration
            });

            toast.show();

            toastEl.addEventListener('hidden.bs.toast', function() {
                this.remove();
            });
        }

        // Make toast globally available
        window.toast = toast;

        // Smooth transitions
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-4px)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });

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

        // Initialize Lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Image %1 of %2'
        });
        // ============================================
        // VIEW ORIGINAL PROFILE IMAGE
        // ============================================


        // Smooth transitions
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-4px)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });

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

        // Initialize Lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Image %1 of %2'
        });
    </script>
</body>

</html>
