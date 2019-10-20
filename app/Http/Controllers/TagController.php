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
        $validatedData = $request->validate([
            'name' => 'bail|required|unique:tags,name|max:100',
            'slug' => 'bail|required|unique:tags,slug|max:100',
        ]);

        $tag = new \App\Tag;
        $tag->name = $validatedData['name'];
        $tag->slug = $validatedData['slug'];
        $tag->save();

        return redirect(route('tags.index'))->with('success', "Tag '{$tag->name}' successfully created");
    }

    public function show() {

    }

    public function edit(\App\Tag $tag) {
        return view('admin/tags/tag-update', [
            'tag' => $tag,
        ]);
    }

    public function update(\App\Tag $tag, Request $request) {
        $validatedData = $request->validate([
            'name' => 'bail|required|max:100|unique:tags,name,' . $tag->id,
            'slug' => 'bail|required|max:100|unique:tags,slug,' . $tag->id,
        ]);

        $tag->name = $validatedData['name'];
        $tag->slug = $validatedData['slug'];
        $tag->updated_at = \Carbon\Carbon::now();
        $tag->save();

        return redirect(route('tags.index'))->with('success', "Tag '{$tag->name}' successfully updated");
    }

    public function destroy(\App\Tag $tag) {
        $tag->delete();

        return redirect(route('tags.index'))->with('success', "Tag '{$tag->name}' successfully deleted");
    }
}
