<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController {
    public function index() {

    }

    public function create() {

    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'bail|required|max:600',
        ]);

        $comment = new \App\Comment;
        $comment->user_id = Auth::id();
//        $comment->user_id = 1;
        $comment->post_id = $validatedData['post_id'];
        $comment->body = $validatedData['body'];
        $comment->save();

        return redirect(route('blog.post', $comment->post->id))->with('success', "Comment successfully added");
    }

    public function show(\App\Comment $comment) {

    }

    public function edit(\App\Comment $comment) {

    }

    public function update(\App\Comment $comment, Request $request) {

    }

    public function destroy(\App\Comment $comment) {

    }
}
