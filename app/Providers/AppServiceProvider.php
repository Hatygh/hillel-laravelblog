<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('categories', \App\Category::all());
        View::share('latest_posts', \App\Post::orderBy('created_at', 'DESC')->take(5)->get());
        View::share('popular_tags', \App\Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(9)->get());
    }
}
