@extends('layouts.main')

@section('content')
<div class="blog-page">
    <div class="container">

        <form method="GET" action="{{ route('blog.index') }}">

            <div class="row mb-4 mt-4">

                <div class="col-lg-6 mx-auto">

                    <div class="input-group shadow-sm">

                        <input type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search articles..."
                            value="{{ request('search') }}">

                        <button class="btn btn-primary">
                            Search
                            <i class="bi bi-search"></i>

                        </button>

                    </div>

                </div>

            </div>

        </form>
        <div class="row">
            <div class="col-12">
                <h1 class="page-title" style="margin-top: 50px;">Latest from Our Blog</h1>
            </div>
        </div>

        <div class="row">
            @forelse($blogs as $blog)
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card-link" style="text-decoration: none; color: inherit;">
                    <div class="blog-card">
                        @if($blog->image)
                        <!-- Lazy loading blog image -->
                        <img data-src="{{ asset($blog->image) }}" 
                             src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                             alt="{{ $blog->title }}" 
                             class="img-fluid lazy-image"
                             loading="lazy">
                        <noscript>
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                        </noscript>
                        @else
                        <!-- Placeholder when no image exists -->
                        <div class="blog-image-placeholder lazy-bg" 
                             data-bg="linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%)"
                             style="height: 200px; width: 100%; background: #f0f0f0;">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        @endif
                        <div class="blog-content">
                            <h3>{{ $blog->title }}</h3>
                            <div class="blog-meta">
                                <span>
                                    <i class="bi bi-calendar"></i> {{ $blog->created_at->format('M d, Y') }}
                                </span>
                                @if($blog->author)
                                <span>
                                    <i class="bi bi-person"></i> {{ Str::limit($blog->author->name, 15) }}
                                </span>
                                @endif
                            </div>
                            <p>{{ Str::limit(strip_tags($blog->body), 120) }}</p>
                            <span class="btn-primary">
                                Read More <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> No blog posts found. Check back soon!
                </div>
            </div>
            @endforelse
        </div>

        @if($blogs->hasPages())
        <div class="row">
            <div class="col-12">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection