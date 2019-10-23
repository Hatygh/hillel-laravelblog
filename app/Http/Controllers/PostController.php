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

        $client = new \GuzzleHttp\Client();
        $path_to_image = '/var/www/html/public' . \Illuminate\Support\Facades\Storage::url($post->preview_cover);
        $image = fopen($path_to_image, 'r') or die("Unable to open file!");
        $bot_id = '970685947:AAFqhvlKBcKoy0r47TJASTdJMfPHQBmeDLI';
        $chat_id = '493150066';
        $url = 'https://api.telegram.org/bot' . $bot_id . '/sendPhoto';
        $parameters = [
            'chat_id' => $chat_id,
            'photo' => $image,
            'caption' => 'check out new post ',
        ];
        $client->request('POST', $url, [
            'multipart' => [
                [
                    'name' => 'chat_id',
                    'contents' => $chat_id,
                ],
                [
                    'name' => 'photo',
                    'contents' => $image,
                    'filename' => '1.jpg',
                ],
                [
                    'name' => 'caption',
                    'contents' => "<a href='" . route('blog.post', $post->id) . "'> Check out new post " . $post->title . "</a>",
                ],
                [
                    'name' => 'parse_mode',
                    'contents' => 'HTML',
                ],
            ]
        ]);

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
        $processed_date = \Carbon\Carbon::parse($date);
        echo Carbon::parse('2018-07-25 12:45:16')->startOfDay();
        $posts = \App\Post::whereBetween('created_at', [$processed_date->startOfDay(),$processed_date->endOfDay()])->latest()->paginate(10);
        return view('blog', ['posts' => $posts]);
    }

    public function postsByDateAndCategory($date, $category_slug) {
        $processed_date = \Carbon\Carbon::parse($date);
        echo Carbon::parse('2018-07-25 12:45:16')->startOfDay();
        $category = \App\Category::where('slug', '=', $category_slug)->first();
        $posts = \App\Post::whereBetween('created_at', [$processed_date->startOfDay(),$processed_date->endOfDay()])->where('category_id', '=', $category->id)->latest()->paginate(10);
        return view('blog', ['posts' => $posts]);
    }

    public function postsByAuthorAndCategory($user_slug, $category_slug) {
        $category = \App\Category::where('slug', '=', $category_slug)->first();
        $user = \App\User::where('slug', '=', $user_slug)->first();
        $posts = \App\User::posts()->where('category_id', '=', $category->id)->latest()->paginate(10);
        return view('blog', ['posts' => $posts]);
    }
}
