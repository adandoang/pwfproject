<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('admin', 'categories')->latest()->paginate(10);
        return view('public.articles.index', compact('articles'));
    }

    public function show($id_article)
    {
        $article = Article::with('admin', 'categories')->where('id_article', $id_article)->firstOrFail();
        return view('public.articles.show', compact('article'));
    }
}
