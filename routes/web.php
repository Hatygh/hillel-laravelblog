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

Route::get('/blog/tag/{slug}', function ($slug) {
    $tag = \App\Tag::where('slug', '=', $slug)->first();
    $posts = $tag->posts()->latest()->paginate(5);
    return view('blog', ['posts' => $posts]);
})->name('blog.tag');

Route::get('/blog/author/{slug}', function ($slug) {
    $user = \App\User::where('slug', '=', $slug)->first();
    $posts = $user->posts()->latest()->paginate(5);
    return view('blog', ['posts' => $posts]);
})->name('blog.author');

Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories', 'CategoryController@store')->name('categories.store');
Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');
Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
Route::put('/categories/{category}', 'CategoryController@put')->name('categories.put');
Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

Route::get('/tags', 'TagController@index')->name('tags.index');
Route::get('/tags/create', 'TagController@create')->name('tags.create');
Route::post('/tags', 'TagController@store')->name('tags.store');
Route::get('/tags/{tag}', 'TagController@show')->name('tags.show');
Route::get('/tags/{tag}/edit', 'TagController@edit')->name('tags.edit');
Route::put('/tags/{tag}', 'TagController@put')->name('tags.put');
Route::delete('/tags/{tag}', 'TagController@destroy')->name('tags.destroy');
