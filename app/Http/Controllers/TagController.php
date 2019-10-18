<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController {

    public function index() {
        return view('admin/tags/tag-list', [
            'tags' => \App\Tag::all()
        ]);
    }

    public function create() {
        return view('admin/tags/tag-create');
    }

    public function store(Request $request) {
        $tag = new \App\Tag;
        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->save();

        return redirect(route('tags.index'));
    }

    public function show() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy(\App\Tag $tag) {
        $tag->delete();

        return redirect(route('tags.index'));
    }
}
