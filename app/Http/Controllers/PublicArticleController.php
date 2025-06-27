<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query()->with('admin', 'categories');

        // Ambil 3 artikel terbaru
        $latestArticles = $query->latest()->take(3)->get();
        $latestMain = $latestArticles->first();
        $latestSide = $latestArticles->skip(1);

        // Sisanya untuk list artikel bawah
        $articles = Article::with('admin', 'categories')
            ->when($request->has('search') && $request->search != '', function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            })
            ->whereNotIn('id_article', $latestArticles->pluck('id_article'))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = \App\Models\Category::all();
        return view('public.articles.index', compact('latestMain', 'latestSide', 'articles', 'categories'));
    }

    public function show($id_article)
    {
        $article = Article::with('admin', 'categories')->where('id_article', $id_article)->firstOrFail();
        return view('public.articles.show', compact('article'));
    }

    public function byCategory($id_category, Request $request)
    {
        $categories = \App\Models\Category::all();
        $activeCategory = \App\Models\Category::findOrFail($id_category);
        $articles = \App\Models\Article::with('admin', 'categories')
            ->whereHas('categories', function($q) use ($id_category) {
                $q->where('categories.id_category', $id_category);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();
        return view('public.articles.index', compact('articles', 'categories', 'activeCategory'));
    }
}
