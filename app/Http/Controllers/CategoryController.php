<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController {
    public function index() {
        return view('admin/categories/category-list', [
            'categories' => \App\Category::all()
        ]);
    }

    public function create() {
        return view('admin/categories/category-create');
    }

    public function store(Request $request) {
        $category = new \App\Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        return redirect(route('categories.index'));
    }

    public function show(\App\Category $category) {

    }

    public function edit(\App\Category $category) {

    }

    public function update(\App\Category $category) {

    }

    public function destroy(\App\Category $category) {
        $category->delete();

        return redirect(route('categories.index'));

    }
}
