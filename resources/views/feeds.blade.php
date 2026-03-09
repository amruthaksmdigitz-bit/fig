@extends('layouts.main')

@section('content')
<!-- Main Content -->
<div class="feed-container"><br><br><br><br><br>
    <!-- Post Form Section - Smaller and Vertical -->
    <div class="post-form-container">
        <form class="post-form" id="postForm" action="{{ route('feeds.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="postTitle">Post Title</label>
                <input type="text" name="title" id="postTitle" placeholder="Enter title..." required>
            </div>

            <div class="image-upload-section">
                <div class="image-upload-area" onclick="document.getElementById('imageInput').click()">
                    <i>📷</i>
                    <span>Click to upload images</span>
                    <small>PNG, JPG (max 2MB)</small>
                </div>

                <input type="file" id="imageInput" class="file-input" name="images[]" accept="image/*" multiple hidden>

                <div class="image-preview" id="imagePreview"></div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="clearForm()">Clear</button>
                <button type="submit" class="btn btn-primary">Post</button>
            </div>
        </form>
    </div>

    <!-- Posts Feed -->
    <div class="feed">
        <div class="sample-post-badge">
            📱 Recent Posts
        </div>

        @foreach($feeds as $feed)
        <div class="post-card">
            <div class="post-header">
                <div class="post-author-avatar">
                    {{ strtoupper(substr($feed->user->name,0,2)) }}
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

            @if($feed->images->count())
            <div class="post-image-grid" data-images="{{ $feed->images->count() }}">
                @foreach($feed->images as $index => $image)
                <div class="grid-item {{ $index == 3 && $feed->images->count() > 4 ? 'has-overlay' : '' }}" 
                     onclick="openLightbox({{ $feed->id }}, {{ $index }})">
                    <img src="{{ asset('storage/'.$image->image) }}" alt="Post Image">
                    @if($index == 3 && $feed->images->count() > 4)
                    <div class="more-images-overlay">
                        <span>+{{ $feed->images->count() - 4 }}</span>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="lightbox-modal" onclick="closeLightboxOnOutsideClick(event)">
    <div class="lightbox-content">
        <div class="lightbox-image-container" id="lightboxImageContainer">
            <img id="lightboxImage" src="" alt="Lightbox Image">
            <button class="lightbox-close" onclick="closeLightbox()" title="Close (Esc)">✕</button>
        </div>
        <button class="lightbox-prev" onclick="changeImage(-1)" title="Previous (←)">❮</button>
        <button class="lightbox-next" onclick="changeImage(1)" title="Next (→)">❯</button>
        <div class="lightbox-counter" id="lightboxCounter"></div>
    </div>
</div>

<script>
    // Image preview functionality for form 
    let imageInput = document.getElementById("imageInput");
    let preview = document.getElementById("imagePreview");

    imageInput.addEventListener("change", function(e) {
        preview.innerHTML = "";
        let files = e.target.files;

        Array.from(files).forEach(file => {
            let reader = new FileReader();
            reader.onload = function(event) {
                let container = document.createElement("div");
                container.classList.add("preview-item");

                let img = document.createElement("img");
                img.src = event.target.result;

                container.appendChild(img);
                preview.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    });

    function clearForm() {
        document.getElementById("postForm").reset();
        preview.innerHTML = "";
    }

    // Lightbox functionality
    let currentFeedId = null;
    let currentImageIndex = 0;
    let feedImages = {};

    // Store images data for each feed
    @foreach($feeds as $feed)
    feedImages[{{ $feed->id }}] = [
        @foreach($feed->images as $image)
        '{{ asset('storage/'.$image->image) }}',
        @endforeach
    ];
    @endforeach

    function openLightbox(feedId, imageIndex) {
        currentFeedId = feedId;
        currentImageIndex = imageIndex;
        updateLightboxImage();
        document.getElementById('lightboxModal').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    function closeLightbox() {
        document.getElementById('lightboxModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore scrolling
    }

    function closeLightboxOnOutsideClick(event) {
        // Close only if clicking on the modal background (not on the image container or buttons)
        if (event.target === document.getElementById('lightboxModal')) {
            closeLightbox();
        }
    }

    function changeImage(direction) {
        if (!currentFeedId) return;
        
        const images = feedImages[currentFeedId];
        if (!images || images.length === 0) return;
        
        currentImageIndex = (currentImageIndex + direction + images.length) % images.length;
        updateLightboxImage();
    }

    function updateLightboxImage() {
        if (!currentFeedId) return;
        
        const images = feedImages[currentFeedId];
        if (!images || images.length === 0) return;
        
        document.getElementById('lightboxImage').src = images[currentImageIndex];
        document.getElementById('lightboxCounter').textContent = 
            `${currentImageIndex + 1} / ${images.length}`;
    }

    // Keyboard navigation for lightbox
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('lightboxModal').style.display === 'flex') {
            if (e.key === 'ArrowLeft') {
                changeImage(-1);
                e.preventDefault();
            } else if (e.key === 'ArrowRight') {
                changeImage(1);
                e.preventDefault();
            } else if (e.key === 'Escape') {
                closeLightbox();
                e.preventDefault();
            }
        }
    });

    // Prevent clicks on the image container from closing the lightbox
    document.getElementById('lightboxImageContainer').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>

@endsection