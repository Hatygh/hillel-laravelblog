<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class PostController {
    public function index() {
        return view('admin/posts/post-list', [
            'posts' => \App\Post::all(),
        ]);
    }

    public function create() {
        return view('admin/posts/post-create', [
            'users' => \App\User::all(),
            'categories' => \App\Category::all(),
            'tags' => \App\Tag::all(),
        ]);
    }

    public function store(Request $request) {
        $tags_id = \App\Tag::all()->pluck('id')->toArray();

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'preview_text' => 'required|max:255',
            'body' => 'required|max:10000',
            'tags.*' => 'in:' . implode(',', $tags_id),
            'preview_image' => 'image',
            'preview_cover' => 'image',
        ]);

        $post = new \App\Post;
        $post->user_id = $validatedData['user_id'];
        $post->category_id = $validatedData['category_id'];
        $post->title = $validatedData['title'];
        $post->preview_text = $validatedData['preview_text'];
        $post->body = $validatedData['body'];
        $post->preview_image = $request->file('preview_image')->store('preview_images', 'public');
        $post->preview_cover = $request->file('preview_cover')->store('cover_images', 'public');
        $post->save();

        return redirect(route('posts.index'))->with('success', "Post '{$post->title}' successfully created");
    }

    public function show(\App\Post $post) {

    }

    public function edit(\App\Post $post) {
        return view('admin/posts/post-update', [
            'post' => $post,
            'users' => \App\User::all(),
            'categories' => \App\Category::all(),
            'tags' => \App\Tag::all(),
        ]);
    }

    public function update(\App\Post $post, Request $request) {
        $tags_id = \App\Tag::all()->pluck('id')->toArray();

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'preview_text' => 'required|max:255',
            'body' => 'required|max:10000',
            'tags.*' => 'in:' . implode(',', $tags_id),
            'preview_image' => 'image',
            'preview_cover' => 'image',
        ]);

        $post = new \App\Post;
        $post->user_id = $validatedData['user_id'];
        $post->category_id = $validatedData['category_id'];
        $post->title = $validatedData['title'];
        $post->preview_text = $validatedData['preview_text'];
        $post->body = $validatedData['body'];
        $post->preview_image = $request->file('preview_image')->store('preview_images', 'public');
        $post->preview_cover = $request->file('preview_cover')->store('cover_images', 'public');
        $post->updated_at = \Carbon\Carbon::now();
        $post->save();

        return redirect(route('posts.index'))->with('success', "Post '{$post->title}' successfully updated");
    }

    public function destroy(\App\Post $post) {
        $post->delete();

        return redirect(route('posts.index'))->with('success', "Post '{$post->title}' successfully deleted");
    }

    public function postsByDate($date) {

    }

    public function postsByDateAndCategory($date, $category) {

    }

    public function postsByAuthorAndCategory($user, $category) {

    }
}
