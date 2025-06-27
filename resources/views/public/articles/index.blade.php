@extends('layouts.app')

@section('title', 'All Articles')

@section('content')
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold font-space mb-2 bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600">
            Latest Articles
        </h1>
        <p class="text-lg text-gray-400">Explore the latest thoughts and ideas from our authors.</p>
    </div>

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

    @if(isset($categories) && $categories->count())
        <div class="mb-8">
            <div class="flex gap-4 overflow-x-auto whitespace-nowrap pb-2 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900 justify-center">
                @foreach($categories as $category)
                    <a href="{{ (isset($activeCategory) && $activeCategory->id_category == $category->id_category) ? route('home') : route('public.articles.byCategory', $category->id_category) }}"
                       class="px-5 py-2 rounded-full font-semibold border transition-colors duration-200 {{ (isset($activeCategory) && $activeCategory->id_category == $category->id_category) ? 'bg-pink-600 text-white border-pink-600' : 'bg-gray-800 text-gray-200 border-gray-700 hover:bg-pink-700 hover:text-white' }}">
                        {{ $category->category_name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if(!isset($activeCategory))
        <!-- Latest Section ala CNBC (max 4 article) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12 items-stretch">
            <!-- Artikel utama besar -->
            <div class="lg:col-span-2 flex flex-col h-full">
                @if(isset($latestMain))
                    <div class="bg-gray-800/70 border border-gray-700 rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row h-full">
                        @if ($latestMain->thumbnail)
                            <div class="w-full md:w-1/2 h-full flex items-center justify-center p-4 pl-4 pr-4">
                                <img src="{{ asset('storage/' . $latestMain->thumbnail) }}" alt="{{ $latestMain->title }}" class="w-full aspect-video max-h-[500px] object-cover rounded-xl shadow-lg">
                            </div>
                        @endif
                        <div class="p-8 flex-1 flex flex-col justify-center pl-6">
                            <div class="mb-3">
                                @if ($latestMain->categories->isNotEmpty())
                                    @foreach ($latestMain->categories as $category)
                                        <span class="inline-block bg-purple-600/50 text-purple-300 rounded-full px-3 py-1 text-xs font-semibold mr-2">{{ $category->category_name }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold font-space text-white mb-2">{{ $latestMain->title }}</h2>
                            <p class="text-gray-400 text-sm mb-4">By {{ $latestMain->admin->nama_admin }} · {{ $latestMain->created_at->format('M d, Y') }}</p>
                            <p class="text-gray-300 leading-relaxed mb-6 line-clamp-3">{{ $latestMain->kutipan }}</p>
                            <a href="{{ route('public.articles.show', $latestMain->id_article) }}" class="font-semibold text-pink-500 hover:text-pink-400 transition-colors duration-300">Read More &rarr;</a>
                        </div>
                    </div>
                @endif
            </div>
            <!-- List artikel kecil di kanan (max 3) -->
            <div class="flex flex-col gap-4 h-full justify-between">
                <h3 class="text-xl font-bold text-white mb-2 border-b border-gray-700 pb-2">Latest News</h3>
                @if(isset($latestSide))
                    @foreach($latestSide as $article)
                        <div class="flex gap-4 items-center bg-gray-800/60 border border-gray-700 rounded-lg overflow-hidden p-3 flex-1 min-h-[88px]">
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-32 h-24 object-cover flex-shrink-0 rounded-md">
                            @endif
                            <div class="flex-1">
                                <a href="{{ route('public.articles.show', $article->id_article) }}" class="font-semibold text-lg text-white hover:text-pink-400 transition-colors duration-300 line-clamp-2">{{ $article->title }}</a>
                                <div class="text-xs text-gray-400 mt-2">{{ $article->created_at->diffForHumans() }}</div>
                                <p class="text-gray-300 text-sm mt-2 line-clamp-3">{{ $article->kutipan }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif
    <!-- END Latest ala CNBC -->

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
        <div class="flex flex-col gap-8 mt-8">
            @foreach ($articles as $article)
                <div class="flex flex-row items-start border-b border-gray-700 pb-6 mb-6 last:mb-0 last:pb-0 last:border-b-0">
                    @if ($article->thumbnail)
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-40 h-28 object-cover rounded-md flex-shrink-0">
                    @endif
                    <div class="flex-1 pl-6">
                        <a href="{{ route('public.articles.show', $article->id_article) }}" class="text-xl md:text-2xl font-bold text-pink-500 hover:text-pink-400 transition-colors duration-300 leading-snug block">{{ $article->title }}</a>
                        <p class="text-gray-300 text-sm mt-2 line-clamp-3">{{ $article->kutipan }}</p>
                        <div class="flex flex-wrap items-center text-xs text-gray-400 mt-2 gap-x-2">
                            <span>{{ $article->created_at->format('jS F, Y') }}</span>
                            <span>&bull;</span>
                            <span>By {{ $article->admin->nama_admin }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    @endif
@endsection 