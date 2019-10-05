<!-- ##### Single Widget Area ##### -->
<div class="single-widget-area">
    <!-- Title -->
    <div class="widget-title">
        <h6>popular tags</h6>
    </div>
    <!-- Tags -->
    <ol class="popular-tags d-flex flex-wrap">
        @foreach($popular_tags as $popular_tag)
            <li><a href="{{ route('blog.tag', $popular_tag->slug) }}">{{ $popular_tag->name }}</a></li>
        @endforeach
    </ol>
</div>
