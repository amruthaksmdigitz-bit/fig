<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $user->name }} - Gallery</title>
      
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
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Gallery Styles */
        .gallery-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .gallery-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .gallery-title i {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .upload-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .upload-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(208, 160, 79, 0.3);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            aspect-ratio: 1;
            cursor: pointer;
            border: 1px solid rgba(208, 160, 79, 0.1);
            box-shadow: var(--shadow);
            transition: var(--transition);
            display: block;
            text-decoration: none;
        }

        .gallery-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
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
            background: rgba(208, 160, 79, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            opacity: 0;
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay i {
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.75rem;
            border-radius: 50%;
            transition: var(--transition);
        }

        .gallery-overlay i:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .empty-gallery {
            text-align: center;
            padding: 5rem 2rem;
            background: white;
            border-radius: var(--radius-lg);
            border: 2px dashed rgba(208, 160, 79, 0.3);
            color: var(--gray-500);
        }

        .empty-gallery i {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            color: rgba(208, 160, 79, 0.3);
        }

        .empty-gallery h3 {
            font-size: 1.5rem;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .empty-gallery p {
            margin-bottom: 1.5rem;
        }

        /* Delete Modal */
        .delete-modal .modal-content {
            border-radius: var(--radius-lg);
            border: none;
        }

        .delete-modal .modal-header {
            border-bottom: 1px solid rgba(208, 160, 79, 0.1);
            padding: 1.5rem;
        }

        .delete-modal .modal-body {
            padding: 1.5rem;
            text-align: center;
        }

        .delete-modal .modal-footer {
            border-top: 1px solid rgba(208, 160, 79, 0.1);
            padding: 1.5rem;
        }

        #deleteImagePreview {
            max-width: 100%;
            max-height: 200px;
            border-radius: var(--radius);
            margin-top: 1rem;
            border: 1px solid var(--gray-200);
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .btn-danger:hover {
            background-color: #b91c1c;
            transform: translateY(-1px);
        }

        /* Toast */
        .toast-container {
            z-index: 1060;
        }

        .toast {
            background: white;
            border-left: 4px solid var(--primary-color);
            border-radius: var(--radius);
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

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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

            .user-btn .user-info {
                display: none;
            }

            .gallery-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
            }
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
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fas fa-user-edit"></i>
                    <span>Edit Profile</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('profile.gallery') }}" class="nav-link {{ request()->routeIs('profile.gallery') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('profile.settings') }}" class="nav-link {{ request()->routeIs('profile.settings') ? 'active' : '' }}">
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
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <div class="page-title">
                    <h1>My Gallery</h1>
                    <p>Manage and view your photos</p>
                </div>

                <div class="header-actions">
                    <div class="user-menu">
                        <div class="user-dropdown">
                            <button class="user-btn">
                                <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=D0A04F&color=fff' }}" class="user-avatar" alt="{{ Auth::user()->name }}">

                                <div class="user-info">
                                    <div class="user-name">{{ Auth::user()->name }}</div>
                                    <div class="user-role">{{ Auth::user()->profession ?? 'User' }}</div>
                                </div>

                                <i class="fas fa-chevron-down"></i>
                            </button>

                            <div class="dropdown-menu">
                                <a href="{{ route('profile') }}" class="dropdown-item">
                                    <i class="fas fa-home"></i> Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <i class="fas fa-user-edit"></i> Edit Profile
                                </a>
                                <a href="{{ route('profile.gallery') }}" class="dropdown-item">
                                    <i class="fas fa-images"></i> Gallery
                                </a>
                                <a href="{{ route('profile.settings') }}" class="dropdown-item">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; background: none; border: none;">
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
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

           <!-- Gallery Header -->
<div class="gallery-header">
    <h1 class="gallery-title">
        <i class="fas fa-images"></i>
        My Photos ({{ count($galleryImages) }})
    </h1>
    <button class="upload-btn" id="galleryUploadBtn">
        <i class="fas fa-upload"></i> Upload Photos
    </button>
</div>

<!-- Gallery Grid -->
@if(count($galleryImages) > 0)
<div class="gallery-grid" id="galleryGrid">
    @foreach($galleryImages as $index => $image)
    <div class="gallery-item">
        <a href="{{ asset($image->image) }}" data-lightbox="gallery" data-title="Gallery Image {{ $index + 1 }}">
           <img src="{{ asset($image->thumbnail) }}" alt="Gallery Image">
        </a>
       <div class="gallery-overlay">
    <i class="fas fa-search" onclick="this.closest('.gallery-item').querySelector('a').click();"></i>
</div> 
    </div>
    @endforeach
</div>
@else
<div class="empty-gallery">
    <i class="fas fa-images"></i>
    <h3>No Photos Yet</h3>
    <p>Upload your first photo to get started</p>
    <button class="upload-btn" id="emptyGalleryUploadBtn">
        <i class="fas fa-upload"></i> Upload Photos
    </button>
</div>
@endif
            <!-- Hidden file input -->
            <input type="file" id="galleryInput" multiple accept="image/*" style="display: none;">

            <!-- Delete Confirmation Modal -->
            <div class="modal fade delete-modal" id="deleteModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-trash text-danger me-2"></i>
                                Delete Image
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this image?</p>
                            <img id="deleteImagePreview" src="" alt="Image to delete">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toast Notification -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="galleryToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Operation completed successfully!
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // CSRF token
        const csrf = '{{ csrf_token() }}';

        // Initialize toast
        const toastEl = document.getElementById('galleryToast');
        const toast = new bootstrap.Toast(toastEl, {
            animation: true,
            autohide: true,
            delay: 3000
        });

        // Upload button click handlers
        // Make sure both upload buttons trigger the file input
document.getElementById('galleryUploadBtn')?.addEventListener('click', () => {
    document.getElementById('galleryInput').click();
});

document.getElementById('emptyGalleryUploadBtn')?.addEventListener('click', () => {
    document.getElementById('galleryInput').click();
});

        // Handle file selection - USING YOUR EXISTING ajaxGalleryUpload METHOD
      // Handle file selection
document.getElementById('galleryInput').addEventListener('change', function() {
    const files = this.files;
    if (!files.length) return;

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('gallery_images[]', files[i]);
    }
    formData.append('_token', csrf);

    // Show loading state
    const uploadBtn = document.getElementById('galleryUploadBtn') || document.getElementById('emptyGalleryUploadBtn');
    const originalText = uploadBtn.innerHTML;
    uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
    uploadBtn.disabled = true;

    fetch("{{ route('profile.gallery.upload') }}", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status) {
            showToast('Images uploaded successfully!');
            // Reload to show new images
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showToast(data.message || 'Upload failed', 'error');
            uploadBtn.innerHTML = originalText;
            uploadBtn.disabled = false;
        }
    })
    .catch(err => {
        console.error(err);
        showToast('Server error', 'error');
        uploadBtn.innerHTML = originalText;
        uploadBtn.disabled = false;
    });
});

        // Delete functionality
        let deleteImageId = null;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

        window.confirmDelete = function(id, imageUrl) {
            deleteImageId = id;
            document.getElementById('deleteImagePreview').src = imageUrl;
            deleteModal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (!deleteImageId) return;

            // You'll need to add a delete route for this to work
            // For now, we'll just show a message
            showToast('Delete functionality - Add route first', 'error');
            deleteModal.hide();

            // When you add the delete route, use this:
            /*
            fetch(`/profile/gallery/${deleteImageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    deleteModal.hide();
                    showToast('Image deleted successfully');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showToast(data.message || 'Delete failed', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Server error', 'error');
            });
            */
        });

        // Toast helper
        function showToast(message, type = 'success') {
            const toastBody = toastEl.querySelector('.toast-body');
            const toastIcon = toastEl.querySelector('.toast-header i');

            toastBody.textContent = message;

            if (type === 'success') {
                toastIcon.className = 'fas fa-check-circle text-success me-2';
                toastEl.style.borderLeftColor = 'var(--primary-color)';
            } else {
                toastIcon.className = 'fas fa-exclamation-circle text-danger me-2';
                toastEl.style.borderLeftColor = '#dc2626';
            }

            toast.show();
        }

        // Lightbox configuration
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Image %1 of %2',
            'fadeDuration': 300
        });
    </script>
</body>

</html>