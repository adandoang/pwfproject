@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-4xl font-bold font-space text-white mb-8">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Manage Articles Card -->
        <a href="{{ route('articles.index') }}" class="block group">
            <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-lg p-6 text-center h-full flex flex-col justify-between transform hover:-translate-y-2 transition-transform duration-300 ease-in-out group-hover:border-purple-500">
                <div>
                    <h2 class="text-2xl font-bold font-space text-white mb-3">Manage Articles</h2>
                    <p class="text-gray-400 mb-4">Create, edit, and delete articles.</p>
                </div>
                <div class="mt-4">
                    <span class="font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600 group-hover:from-purple-500 group-hover:to-pink-700">
                        Go to Articles &rarr;
                    </span>
                </div>
            </div>
        </a>

        <!-- Manage Categories Card -->
        <a href="{{ route('categories.index') }}" class="block group">
            <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-lg p-6 text-center h-full flex flex-col justify-between transform hover:-translate-y-2 transition-transform duration-300 ease-in-out group-hover:border-blue-500">
                <div>
                    <h2 class="text-2xl font-bold font-space text-white mb-3">Manage Categories</h2>
                    <p class="text-gray-400 mb-4">Add, edit, and delete article categories.</p>
                </div>
                <div class="mt-4">
                     <span class="font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-teal-500 group-hover:from-blue-500 group-hover:to-teal-600">
                        Go to Categories &rarr;
                    </span>
                </div>
            </div>
        </a>
    </div>
@endsection 