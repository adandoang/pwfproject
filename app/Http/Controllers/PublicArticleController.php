<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query()->with('admin', 'categories');
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        // Ambil 3 artikel terbaru dari hasil pencarian
        $latestArticles = $query->latest()->take(3)->get();
        $latestMain = $latestArticles->first();
        $latestSide = $latestArticles->skip(1);
        // Sisanya untuk list artikel bawah
        $articles = (clone $query)
            ->whereNotIn('id_article', $latestArticles->pluck('id_article'))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        // Jika tidak ada artikel tersisa, pastikan $articles tetap collection kosong
        if (!isset($articles)) {
            $articles = collect();
        }

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
