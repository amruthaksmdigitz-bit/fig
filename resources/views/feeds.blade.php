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
        <div class="post-card" id="post-{{ $feed->id }}">
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
                
                <!-- Three Dots Menu -->
                <div class="post-menu-container">
                    <button class="post-menu-btn" onclick="toggleMenu({{ $feed->id }})">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <circle cx="10" cy="4" r="2"/>
                            <circle cx="10" cy="10" r="2"/>
                            <circle cx="10" cy="16" r="2"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="post-menu-dropdown" id="menu-{{ $feed->id }}">
                        <div class="menu-item" onclick="openReportModal({{ $feed->id }})">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <circle cx="12" cy="12" r="1.5" fill="currentColor"/>
                                <circle cx="12" cy="8" r="1.5" fill="currentColor"/>
                                <circle cx="12" cy="16" r="1.5" fill="currentColor"/>
                            </svg>
                            <span>Report Post</span>
                        </div>
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

<!-- Report Modal -->
<div id="reportModal" class="report-modal" onclick="closeReportModalOnOutsideClick(event)">
    <div class="report-modal-content">
        <div class="report-modal-header">
            <h3>Report Post</h3>
            <button class="report-modal-close" onclick="closeReportModal()">✕</button>
        </div>
        <div class="report-modal-body">
            <p>Why are you reporting this post?</p>
            
            <form id="reportForm">
                <input type="hidden" id="reportPostId" value="">
                
                <div class="report-option">
                    <input type="radio" name="reportReason" id="reason1" value="spam" required>
                    <label for="reason1">It's spam</label>
                </div>
                
                <div class="report-option">
                    <input type="radio" name="reportReason" id="reason2" value="nudity">
                    <label for="reason2">Nudity or sexual activity</label>
                </div>
                
                <div class="report-option">
                    <input type="radio" name="reportReason" id="reason3" value="hate">
                    <label for="reason3">Hate speech or symbols</label>
                </div>
                
                <div class="report-option">
                    <input type="radio" name="reportReason" id="reason4" value="violence">
                    <label for="reason4">Violence or dangerous organizations</label>
                </div>
                
                <div class="report-option">
                    <input type="radio" name="reportReason" id="reason5" value="bullying">
                    <label for="reason5">Bullying or harassment</label>
                </div>
                
                <div class="report-option">
                    <input type="radio" name="reportReason" id="reason6" value="false">
                    <label for="reason6">False information</label>
                </div>
                
                <div class="report-option">
                    <input type="radio" name="reportReason" id="reason7" value="other">
                    <label for="reason7">Other</label>
                </div>
                
                <div class="form-group" id="otherReasonGroup" style="display: none;">
                    <textarea name="otherReason" id="otherReason" placeholder="Please specify your reason..." rows="3"></textarea>
                </div>
            </form>
        </div>
        <div class="report-modal-footer">
            <button class="btn btn-secondary" onclick="closeReportModal()">Cancel</button>
            <button class="btn btn-primary" onclick="submitReport()">Submit Report</button>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toastNotification" class="toast-notification">
    Report submitted successfully. Thank you for helping keep our community safe!
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

    // Three Dots Menu Functionality
    function toggleMenu(postId) {
        const menu = document.getElementById(`menu-${postId}`);
        const isVisible = menu.style.display === 'block';
        
        // Close all other menus
        document.querySelectorAll('.post-menu-dropdown').forEach(m => {
            m.style.display = 'none';
        });
        
        // Toggle current menu
        menu.style.display = isVisible ? 'none' : 'block';
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.post-menu-container')) {
            document.querySelectorAll('.post-menu-dropdown').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });

    // Report Modal Functionality
    function openReportModal(postId) {
        document.getElementById('reportPostId').value = postId;
        document.getElementById('reportModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Close the menu
        document.querySelectorAll('.post-menu-dropdown').forEach(menu => {
            menu.style.display = 'none';
        });
    }

    function closeReportModal() {
        document.getElementById('reportModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Reset form
        document.getElementById('reportForm').reset();
        document.getElementById('otherReasonGroup').style.display = 'none';
    }

    function closeReportModalOnOutsideClick(event) {
        if (event.target === document.getElementById('reportModal')) {
            closeReportModal();
        }
    }

    // Show/hide other reason field
    document.querySelectorAll('input[name="reportReason"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'other') {
                document.getElementById('otherReasonGroup').style.display = 'block';
            } else {
                document.getElementById('otherReasonGroup').style.display = 'none';
            }
        });
    });

    function submitReport() {
        const reason = document.querySelector('input[name="reportReason"]:checked');
        
        if (!reason) {
            alert('Please select a reason for reporting');
            return;
        }
        
        const postId = document.getElementById('reportPostId').value;
        const otherReason = document.getElementById('otherReason').value;
        
        // Here you would typically send this to your server
        console.log('Report submitted:', {
            postId: postId,
            reason: reason.value,
            otherReason: reason.value === 'other' ? otherReason : null
        });
        
        closeReportModal();
        
        // Show toast notification
        const toast = document.getElementById('toastNotification');
        toast.classList.add('show');
        
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }
</script>

@endsection