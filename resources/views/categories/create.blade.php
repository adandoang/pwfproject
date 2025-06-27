@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
    <h1 class="text-4xl font-bold font-space text-white mb-8">Create New Category</h1>

    @if ($errors->any())
        <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-lg p-8 max-w-lg mx-auto">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="category_name" class="block text-sm font-medium text-gray-300 mb-2">Category Name</label>
                <input type="text" id="category_name" name="category_name" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" value="{{ old('category_name') }}" required>
            </div>
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('categories.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Create Category
                </button>
            </div>
        </form>
    </div>
@endsection 