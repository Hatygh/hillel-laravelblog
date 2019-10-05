<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = \App\Post::latest()->paginate(5);
    return view('index', [
        'posts' => $posts,
    ]);
})->name('blog.index');

Route::get('/contact', function () {
    return view('contact');
})->name('blog.contact');

Route::get('/about-us', function () {
    return view('about');
})->name('blog.about');

Route::get('/blog', function () {
    $posts = \App\Post::latest()->paginate(5);
    return view('blog', [
        'posts' => $posts,
    ]);
})->name('blog.blog');

Route::get('/post/{post}', function (\App\Post $post) {
    //$post = \App\Post::find($id);
    $post->increment('views');
    return view('post', ['post' => $post]);
})->name('blog.post');

Route::get('/blog/category/{slug}', function ($slug) {
    $category = \App\Category::where('slug', '=', $slug)->first();
    $posts = $category->posts()->latest()->paginate(5);
    return view('blog', ['posts' => $posts]);
})->name('blog.category');
