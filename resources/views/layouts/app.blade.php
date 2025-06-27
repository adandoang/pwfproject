<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PWF Project Articles')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .font-space {
            font-family: 'Space Grotesk', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    <nav class="bg-gray-900/70 backdrop-blur-md p-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold font-space bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600">Business Articles</a>
            <div class="space-x-4">
                {{-- Login button removed from public view --}}
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-12 px-4 flex-grow">
        @yield('content')
    </main>

    <footer class="mt-20 py-8 bg-gray-900 border-t border-gray-800 text-center">
        <p class="text-gray-500">&copy; {{ date('Y') }} PWF Project. All rights reserved.</p>
    </footer>

</body>
</html> 