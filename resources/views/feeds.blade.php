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

                <input type="text" name="title" id="postTitle" placeholder="Enter title...">
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

            <div class="post-image">

                @foreach($feed->images as $image)

                <img src="{{ asset('storage/'.$image->image) }}" alt="Post Image">

                @endforeach

            </div>

            @endif



        </div>

        @endforeach

    </div>
</div>

<script>
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
</script>

@endsection