<!-- ##### Single Widget Area ##### -->
<div class="single-widget-area">
    <!-- Title -->
    <div class="widget-title">
        <h6>Latest Posts</h6>
    </div>

    <!-- Single Latest Posts -->
    @foreach($latest_posts as $latest_post)
    <div class="single-latest-post d-flex">
        <div class="post-thumb">
            <img src="/img/blog-img/{{ $latest_post->preview_image }}" alt="">
        </div>
        <div class="post-content">
            <a href="{{ route('blog.post', $latest_post->id) }}" class="post-title">
                <h6>{{ $latest_post->title }}</h6>
            </a>
            <a href="{{ route('blog.author', $latest_post->user->slug) }}" class="post-author"><span>by</span> {{ $latest_post->user->name }}</a>
        </div>
    </div>
    @endforeach
</div>
