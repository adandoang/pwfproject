@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <article class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-lg p-8 md:p-12">
        
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                @if ($article->categories->isNotEmpty())
                    @foreach ($article->categories as $category)
                        <span class="inline-block bg-purple-600/50 text-purple-300 rounded-full px-3 py-1 text-xs font-semibold mr-2">{{ $category->category_name }}</span>
                    @endforeach
                @endif
            </div>

            @if ($article->thumbnail)
                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full rounded-xl shadow-lg mb-8">
            @endif

            <h1 class="text-4xl md:text-5xl font-bold font-space text-gray-100 mb-4 leading-tight">{{ $article->title }}</h1>
            <p class="text-gray-400 text-lg mb-8">By {{ $article->admin->nama_admin }} · {{ $article->created_at->format('M d, Y') }}</p>

            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed text-lg mb-8">
                {!! $article->body !!}
            </div>

            <a href="{{ route('home') }}" class="font-semibold text-pink-500 hover:text-pink-400 transition-colors duration-300">&larr; Back to Articles</a>
        </div>
        
    </article>
@endsection 