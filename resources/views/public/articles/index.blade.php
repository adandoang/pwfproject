@extends('layouts.app')

@section('title', 'All Articles')

@section('content')
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold font-space mb-2 bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600">
            Latest Articles
        </h1>
        <p class="text-lg text-gray-400">Explore the latest thoughts and ideas from our authors.</p>
    </div>

    <!-- Search Form -->
    <div class="mb-8 max-w-lg mx-auto">
        <form action="{{ route('home') }}" method="GET">
            <div class="relative">
                <input type="search" name="search" placeholder="Search for articles by title..." value="{{ request('search') }}"
                       class="w-full bg-gray-800/50 border border-gray-700 rounded-lg shadow-sm py-3 px-4 pr-10 focus:ring-purple-500 focus:border-purple-500 transition">
                <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    @if ($articles->isEmpty())
        <div class="text-center py-16">
            @if (request('search'))
                <h2 class="text-2xl font-bold text-white mb-2">No results found for "{{ request('search') }}"</h2>
                <p class="text-gray-400">Please try another keyword.</p>
            @else
                <p class="text-xl text-gray-500">No articles available yet. Stay tuned!</p>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($articles as $article)
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 ease-in-out">
                    @if ($article->thumbnail)
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="mb-3">
                            @if ($article->categories->isNotEmpty())
                                @foreach ($article->categories as $category)
                                    <span class="inline-block bg-purple-600/50 text-purple-300 rounded-full px-3 py-1 text-xs font-semibold mr-2">{{ $category->category_name }}</span>
                                @endforeach
                            @endif
                        </div>
                        <h2 class="text-2xl font-bold font-space text-gray-100 mb-2">{{ $article->title }}</h2>
                        <p class="text-gray-400 text-sm mb-4">By {{ $article->admin->nama_admin }} · {{ $article->created_at->format('M d, Y') }}</p>
                        <p class="text-gray-300 leading-relaxed mb-6">{{ $article->kutipan }}</p>
                        <a href="{{ route('public.articles.show', $article->id_article) }}" class="font-semibold text-pink-500 hover:text-pink-400 transition-colors duration-300">Read More &rarr;</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    @endif
@endsection 