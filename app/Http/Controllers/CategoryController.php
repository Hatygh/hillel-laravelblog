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
        $validatedData = $request->validate([
            'name' => 'bail|required|unique:categories,name|max:255',
            'slug' => 'bail|required|unique:categories,slug|max:255',
        ]);

        $category = new \App\Category;
        $category->name = $validatedData['name'];
        $category->slug = $validatedData['slug'];
        $category->save();

        return redirect(route('categories.index'))->with('success', "Category '{$category->name}' successfully created");
    }

    public function show(\App\Category $category) {

    }

    public function edit(\App\Category $category) {
        return view('admin/categories/category-update', [
            'category' => $category,
        ]);
    }

    public function update(\App\Category $category, Request $request) {
        $validatedData = $request->validate([
            'name' => 'bail|required|max:255|unique:categories,name,' . $category->id,
            'slug' => 'bail|required|max:255|unique:categories,slug,' . $category->id,
        ]);

        $category->name = $validatedData['name'];
        $category->slug = $validatedData['slug'];
        $category->updated_at = \Carbon\Carbon::now();
        $category->save();

        return redirect(route('categories.index'))->with('success', "Category '{$category->name}' successfully updated");
    }

    public function destroy(\App\Category $category) {
        $category->delete();

        return redirect(route('categories.index'))->with('success', "Category '{$category->name}' successfully deleted");
    }
}
