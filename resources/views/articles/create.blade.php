@extends('layouts.admin')

@section('title', 'Create New Article')

@section('content')
    <h1 class="text-4xl font-bold font-space text-white mb-8">Create New Article</h1>

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

    <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-lg p-8">
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @include('articles._form', ['submitButtonText' => 'Create Article'])
        </form>
    </div>
@endsection 