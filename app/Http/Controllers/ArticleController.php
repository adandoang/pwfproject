<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('admin', 'categories')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kutipan' => 'required|string',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'body' => 'required|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id_category',
        ]);

        $article = Auth::guard('admin')->user()->articles()->create($request->only('title', 'kutipan', 'meta_keyword', 'meta_description', 'body'));

        if ($request->has('categories')) {
            $article->categories()->sync($request->categories);
        }

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show($id_article)
    {
        $article = Article::with('admin', 'categories')->where('id_article', $id_article)->firstOrFail();
        return view('public.articles.show', compact('article'));
    }

    public function edit($id_article)
    {
        $article = Article::with('categories')->where('id_article', $id_article)->firstOrFail();
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id_article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'kutipan' => 'required|string',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'body' => 'required|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id_category',
        ]);

        $article = Article::where('id_article', $id_article)->firstOrFail();
        $article->update($request->only('title', 'kutipan', 'meta_keyword', 'meta_description', 'body'));

        if ($request->has('categories')) {
            $article->categories()->sync($request->categories);
        } else {
            $article->categories()->detach();
        }

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy($id_article)
    {
        $article = Article::where('id_article', $id_article)->firstOrFail();
        $article->delete(); // Uses soft deletes

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
