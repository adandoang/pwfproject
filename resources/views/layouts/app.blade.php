<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PWF Project Articles')</title>
    <!-- Tambahkan Tailwind CSS atau framework CSS lainnya di sini -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-white p-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('articles.index') }}" class="text-xl font-bold text-gray-800">PWF Articles</a>
            <div class="space-x-4">
                {{-- No login/register button for public view --}}
                {{-- Admin can access /login directly --}}
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        @yield('content')
    </div>

    <footer class="mt-12 py-6 bg-gray-800 text-white text-center">
        <p>&copy; {{ date('Y') }} PWF Project. All rights reserved.</p>
    </footer>

</body>
</html> 