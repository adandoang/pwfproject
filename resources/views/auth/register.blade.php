@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center py-12">
    <div class="w-full max-w-md">
        <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl shadow-lg p-8">
            <h1 class="text-4xl font-bold font-space text-center text-white mb-2">Create Admin Account</h1>
            <p class="text-center text-gray-400 mb-8">Join the ranks of administrators.</p>

            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg relative mb-6" role="alert">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="nama_admin" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                    <input type="text" id="nama_admin" name="nama_admin" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" value="{{ old('nama_admin') }}" required autofocus>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                    <input type="text" id="username" name="username" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" value="{{ old('username') }}" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" required>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-gray-900/70 border border-gray-700 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition" required>
                </div>
                <div>
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        Register
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a class="font-medium text-sm text-purple-400 hover:text-purple-300" href="{{ route('login') }}">
                    Already have an account? Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 