@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <article class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
        <p class="text-gray-600 text-sm mb-6">By {{ $article->admin->nama_admin }} on {{ $article->created_at->format('M d, Y') }}</p>

        @if ($article->categories->isNotEmpty())
            <div class="mb-6 text-sm text-gray-500">
                Categories:
                @foreach ($article->categories as $category)
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2">{{ $category->category_name }}</span>
                @endforeach
            </div>
        @endif

        <div class="prose max-w-none text-gray-800 leading-relaxed mb-8">
            {!! $article->body !!}
        </div>

        <a href="{{ route('articles.index') }}" class="text-blue-500 hover:underline">&larr; Back to Articles</a>
    </article>
@endsection 