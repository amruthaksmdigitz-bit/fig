<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feeds - Share Your Content</title>
    <link rel="stylesheet" href="{{ asset('assets/css/feeds.css') }}">
    <style>
        
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="container">
        <!-- Post Form Section - Smaller and Vertical -->
        <div class="post-form-container">
            <form class="post-form" id="postForm">
                <div class="form-group">
                    <label for="postTitle">Post Title</label>
                    <input type="text" id="postTitle" placeholder="Enter title..." required>
                </div>

                <div class="image-upload-section">
                    <div class="image-upload-area" onclick="document.getElementById('imageInput').click()">
                        <i>📷</i>
                        <span>Click to upload image</span>
                        <small>PNG, JPG, GIF (max 10MB)</small>
                    </div>
                    <input type="file" id="imageInput" class="file-input" accept="image/*">
                    <div class="image-preview" id="imagePreview">
                        <img id="previewImage" src="" alt="Preview">
                        <button class="remove-image" onclick="removeImage()" type="button">×</button>
                    </div>
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

            <!-- Post 1 -->
            <div class="post-card">
                <div class="post-header">
                    <div class="post-author-avatar">JD</div>
                    <div class="post-author-info">
                        <div class="post-author-name">John Doe</div>
                        <div class="post-time">2 hours ago</div>
                    </div>
                </div>
                <div class="post-title">Beautiful Sunset Photography</div>
                <div class="post-image">
                    <img src="https://images.unsplash.com/photo-1495616811223-4d98c6e9c869?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Sunset">
                </div>
                <div class="post-stats">
                    <span class="stat-item">❤️ 234</span>
                    <span class="stat-item">💬 45</span>
                    <span class="stat-item">↗️ 12</span>
                </div>
                <div class="post-actions">
                    <button class="action-btn">❤️ Like</button>
                    <button class="action-btn">💬 Comment</button>
                    <button class="action-btn">↗️ Share</button>
                </div>
            </div>

            <!-- Post 2 -->
            <div class="post-card">
                <div class="post-header">
                    <div class="post-author-avatar">JS</div>
                    <div class="post-author-info">
                        <div class="post-author-name">Jane Smith</div>
                        <div class="post-time">5 hours ago</div>
                    </div>
                </div>
                <div class="post-title">New Recipe Alert! 🍳</div>
                <div class="post-image">
                    <img src="https://images.unsplash.com/photo-1473093295043-cdd812d0e601?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Pasta">
                </div>
                <div class="post-stats">
                    <span class="stat-item">❤️ 567</span>
                    <span class="stat-item">💬 89</span>
                    <span class="stat-item">↗️ 34</span>
                </div>
                <div class="post-actions">
                    <button class="action-btn">❤️ Like</button>
                    <button class="action-btn">💬 Comment</button>
                    <button class="action-btn">↗️ Share</button>
                </div>
            </div>

            <!-- Post 3 -->
            <div class="post-card">
                <div class="post-header">
                    <div class="post-author-avatar">MC</div>
                    <div class="post-author-info">
                        <div class="post-author-name">Mike Chen</div>
                        <div class="post-time">1 day ago</div>
                    </div>
                </div>
                <div class="post-title">Tech News: Latest Gadgets</div>
                <div class="post-image">
                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Smartphone">
                </div>
                <div class="post-stats">
                    <span class="stat-item">❤️ 892</span>
                    <span class="stat-item">💬 156</span>
                    <span class="stat-item">↗️ 67</span>
                </div>
                <div class="post-actions">
                    <button class="action-btn">❤️ Like</button>
                    <button class="action-btn">💬 Comment</button>
                    <button class="action-btn">↗️ Share</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                    document.querySelector('.image-upload-area').style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });

        function removeImage() {
            document.getElementById('imageInput').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.querySelector('.image-upload-area').style.display = 'block';
        }

        function clearForm() {
            document.getElementById('postForm').reset();
            removeImage();
        }

        // Form submission
        document.getElementById('postForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const title = document.getElementById('postTitle').value;
            
            alert(`Post created successfully!\n\nTitle: ${title}\n\nNote: This is a static demo.`);
            
            clearForm();
        });
    </script>
</body>
</html>