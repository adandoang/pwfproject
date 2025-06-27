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

        $articles = $query->latest()->paginate(10)->withQueryString();

        return view('public.articles.index', compact('articles'));
    }

    public function show($id_article)
    {
        $article = Article::with('admin', 'categories')->where('id_article', $id_article)->firstOrFail();
        return view('public.articles.show', compact('article'));
    }
}
