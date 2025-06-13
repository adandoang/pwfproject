@extends('layouts.app')

@section('title', 'All Articles')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Latest Articles</h1>

    @if ($articles->isEmpty())
        <p class="text-gray-600">No articles available yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($articles as $article)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $article->title }}</h2>
                        <p class="text-gray-600 text-sm mb-4">By {{ $article->admin->nama_admin }} on {{ $article->created_at->format('M d, Y') }}</p>
                        <p class="text-gray-700 leading-relaxed mb-4">{{ $article->kutipan }}</p>
                        <a href="{{ route('articles.show', $article->id_article) }}" class="text-blue-500 hover:underline">Read More &rarr;</a>
                        @if ($article->categories->isNotEmpty())
                            <div class="mt-3 text-sm text-gray-500">
                                Categories:
                                @foreach ($article->categories as $category)
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2">{{ $category->category_name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @endif
@endsection 