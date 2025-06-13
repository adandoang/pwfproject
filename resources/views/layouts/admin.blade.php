<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-gray-800 p-4 shadow">
        <div class="container mx-auto flex justify-between items-center text-white">
            <a href="/admin/dashboard" class="text-xl font-bold">Admin Panel</a>
            <div class="space-x-4">
                <a href="{{ route('articles.index') }}" class="hover:text-gray-300">Articles</a>
                <a href="{{ route('categories.index') }}" class="hover:text-gray-300">Categories</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        @yield('content')
    </div>

    <footer class="mt-12 py-6 bg-gray-800 text-white text-center">
        <p>&copy; {{ date('Y') }} PWF Project Admin. All rights reserved.</p>
    </footer>

</body>
</html> 