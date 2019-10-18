<!-- ##### Single Widget Area ##### -->
<div class="single-widget-area mt-0">
    <!-- Title -->
    <div class="widget-title">
        <h6>Categories</h6>
    </div>
    <ol class="foode-catagories">
        @foreach($categories as $category)
            <li><a href="{{ route('blog.category', $category->slug) }}"><span><i class="fa fa-stop" aria-hidden="true"></i> {{ $category->name }}</span> <span>({{ $category->posts()->count() }})</span></a></li>
        @endforeach
    </ol>
</div>
