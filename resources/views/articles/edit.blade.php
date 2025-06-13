@extends('layouts.admin')

@section('title', 'Edit Article')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Article</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('articles.update', $article->id_article) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('title', $article->title) }}" required>
            </div>
            <div class="mb-4">
                <label for="kutipan" class="block text-gray-700 text-sm font-bold mb-2">Kutipan (Excerpt):</label>
                <textarea id="kutipan" name="kutipan" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('kutipan', $article->kutipan) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="meta_keyword" class="block text-gray-700 text-sm font-bold mb-2">Meta Keyword:</label>
                <input type="text" id="meta_keyword" name="meta_keyword" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('meta_keyword', $article->meta_keyword) }}">
            </div>
            <div class="mb-4">
                <label for="meta_description" class="block text-gray-700 text-sm font-bold mb-2">Meta Description:</label>
                <textarea id="meta_description" name="meta_description" rows="2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('meta_description', $article->meta_description) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body (Content):</label>
                <textarea id="body" name="body" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('body', $article->body) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Categories:</label>
                @foreach ($categories as $category)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="category_{{ $category->id_category }}" name="categories[]" value="{{ $category->id_category }}" class="mr-2" {{ in_array($category->id_category, $article->categories->pluck('id_category')->toArray()) ? 'checked' : '' }}>
                        <label for="category_{{ $category->id_category }}" class="text-gray-700">{{ $category->category_name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Article
                </button>
                <a href="{{ route('articles.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection 