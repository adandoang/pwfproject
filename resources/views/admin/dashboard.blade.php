@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Manage Articles</h2>
            <p class="text-gray-600 mb-4">Create, edit, and delete articles.</p>
            <a href="{{ route('articles.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Go to Articles</a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Manage Categories</h2>
            <p class="text-gray-600 mb-4">Add, edit, and delete article categories.</p>
            <a href="{{ route('categories.index') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Go to Categories</a>
        </div>
    </div>
@endsection 