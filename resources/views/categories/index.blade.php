@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold font-space text-white">Manage Categories</h1>
        <a href="{{ route('categories.create') }}" class="bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
            Create New Category
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($categories->isEmpty())
        <div class="text-center py-16 bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl">
            <p class="text-xl text-gray-400">No categories available. Create your first one!</p>
        </div>
    @else
        <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-lg overflow-hidden">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Category Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Created At
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                {{ $category->category_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                {{ $category->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('categories.edit', $category->id_category) }}" class="text-blue-400 hover:text-blue-300 mr-4">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id_category) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $categories->links() }}
        </div>
    @endif
@endsection 