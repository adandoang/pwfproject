<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id_category)
    {
        $category = Category::where('id_category', $id_category)->firstOrFail();
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id_category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $id_category . ',id_category',
        ]);

        $category = Category::where('id_category', $id_category)->firstOrFail();
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id_category)
    {
        $category = Category::where('id_category', $id_category)->firstOrFail();
        $category->delete(); // Uses soft deletes

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
