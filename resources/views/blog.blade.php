@extends('2col-layout')

@section('container')
    <div class="blog-posts-area">

        <!-- Featured Post Area -->
        <div class="featured-posts">
            <a href="#"><img src="/img/blog-img/1.jpg" alt=""></a>
            <!-- Featured Post Content -->
            <div class="featured-post-content">
                <p>MAY 8, 2018 / foody</p>
                <a href="#" class="post-title">
                    <h2>Quick Vegan Enchiladas with Sweet Potato Sauce</h2>
                </a>
            </div>
        </div>

        <!-- Single Blog Post -->
        @foreach($posts as $post)
        <div class="single-blog-post d-flex flex-wrap mt-50">
            <!-- Thumbnail -->
            <div class="post-thumbnail mb-50">
                <a href="{{ route('blog.post', $post->id) }}"><img src="/storage/{{ $post->preview_image }}" alt=""></a>
            </div>
            <!-- Content -->
            <div class="post-content mb-50">
                <p class="post-date">{{ $post->created_at->format('F d, Y') }} / {{ $post->category->name }}</p>
                <a href="{{ route('blog.post', $post->id) }}" class="post-title">
                    <h4>{{ $post->title }}</h4>
                </a>
                <div class="post-meta">
                    <a href="{{ route('blog.author', $post->user->slug) }}"><span>by</span> {{ $post->user->name }}</a>
                    <a href="#"><i class="fa fa-eye"></i> {{ $post->views }}</a>
                    <a href="#"><i class="fa fa-comments"></i> 08</a>
                </div>
                <p class="post-excerpt">{{ $post->preview_text }}</p>
                <a href="{{ route('blog.post', $post->id) }}" class="read-more-btn">Continue Reading <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>
            <!-- Post Curve Line -->
            <img class="post-curve-line" src="/img/core-img/post-curve-line.png" alt="">
        </div>
        @endforeach

    </div>

    <!-- Pager -->
    <ol class="foode-pager mt-50">
        @if ($posts->currentPage() != 1)
        <li><a href="{{ $posts->previousPageUrl() }}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Newer</a></li>
        @endif
        @if ($posts->currentPage() != $posts->lastPage())
        <li><a href="{{ $posts->nextPageUrl() }}">Older <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
        @endif
    </ol>
@endsection

@section('sidebar')
    @include('widget-search')
    @include('widget-about-me')
    @parent
@endsection
