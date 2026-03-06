@extends('layouts.main')

@section('content')
<div class="blog-detail-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('blog.index') }}">
                                <i class="bi bi-house"></i> Blog
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ Str::limit($blog->title, 50) }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <article class="blog-post">
                    @if($blog->image)
                    <div class="blog-image">
                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                    </div>
                    @endif
                    
                    <h1 class="blog-title">{{ $blog->title }}</h1>
                    
                    <div class="blog-meta">
                        <span>
                            <i class="bi bi-calendar"></i> {{ $blog->created_at->format('F d, Y') }}
                        </span>
                        @if($blog->author)
                        <span>
                            <i class="bi bi-person"></i> {{ $blog->author->name }}
                        </span>
                        @endif
                        <span>
                            <i class="bi bi-clock"></i> {{ ceil(str_word_count(strip_tags($blog->body)) / 200) }} min read
                        </span>
                    </div>
                    
                    <div class="blog-content">
                        {!! $blog->body !!}
                    </div>
                </article>
            </div>
            
            <div class="col-lg-4">
                <div class="sidebar-widget">
                    <h3>Related Posts</h3>
                    @if(isset($relatedBlogs) && $relatedBlogs->count() > 0)
                        @foreach($relatedBlogs as $related)
                        <div class="related-post">
                            <a href="{{ route('blog.show', $related->slug) }}">
                                @if($related->image)
                                <div class="related-post-image">
                                    <img src="{{ asset($related->image) }}" alt="{{ $related->title }}">
                                </div>
                                @endif
                                <div>
                                    <h4>{{ Str::limit($related->title, 50) }}</h4>
                                    <small>
                                        <i class="bi bi-calendar"></i> {{ $related->created_at->format('M d, Y') }}
                                    </small>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <p style="color: #6c757d; margin-bottom: 0;">No related posts found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection