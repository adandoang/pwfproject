@csrf
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2 space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Title</label>
            <input type="text" id="title" name="title" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" value="{{ old('title', $article->title ?? '') }}" required>
        </div>
        <div>
            <label for="kutipan" class="block text-sm font-medium text-gray-300 mb-2">Kutipan (Excerpt)</label>
            <textarea id="kutipan" name="kutipan" rows="3" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" required>{{ old('kutipan', $article->kutipan ?? '') }}</textarea>
        </div>
        <div>
            <label for="body" class="block text-sm font-medium text-gray-300 mb-2">Body (Content)</label>
            <textarea id="body" name="body" rows="12" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" required>{{ old('body', $article->body ?? '') }}</textarea>
        </div>
    </div>
    <div class="space-y-6">
        <div>
            <label for="thumbnail" class="block text-sm font-medium text-gray-300 mb-2">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-600/50 file:text-purple-300 hover:file:bg-purple-600/70 cursor-pointer">
            @if ($article->thumbnail)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Current Thumbnail" class="w-full rounded-lg shadow-md">
                    <p class="text-xs text-gray-500 mt-2">Current thumbnail. Upload a new one to replace it.</p>
                </div>
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Categories</label>
            <div class="space-y-2 p-4 bg-gray-900/70 border border-gray-700 rounded-lg max-h-60 overflow-y-auto">
                @foreach ($categories as $category)
                    <div class="flex items-center">
                        <input type="checkbox" id="category_{{ $category->id_category }}" name="categories[]" value="{{ $category->id_category }}" 
                               class="h-4 w-4 bg-gray-700 border-gray-600 text-purple-600 focus:ring-purple-500 rounded"
                               @if(in_array($category->id_category, old('categories', $article->categories->pluck('id_category')->toArray() ?? []))) checked @endif>
                        <label for="category_{{ $category->id_category }}" class="ml-3 text-sm text-gray-300">{{ $category->category_name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            <label for="meta_keyword" class="block text-sm font-medium text-gray-300 mb-2">Meta Keyword</label>
            <input type="text" id="meta_keyword" name="meta_keyword" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" value="{{ old('meta_keyword', $article->meta_keyword ?? '') }}">
        </div>
        <div>
            <label for="meta_description" class="block text-sm font-medium text-gray-300 mb-2">Meta Description</label>
            <textarea id="meta_description" name="meta_description" rows="3" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition">{{ old('meta_description', $article->meta_description ?? '') }}</textarea>
        </div>
    </div>
</div>

<div class="mt-8 flex justify-end space-x-4">
    <a href="{{ route('articles.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg transition-colors">
        Cancel
    </a>
    <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
        {{ $submitButtonText ?? 'Create Article' }}
    </button>
</div> 