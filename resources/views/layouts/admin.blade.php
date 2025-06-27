<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - PWF Project</title>
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
<body class="bg-gray-900 text-gray-200 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900/70 backdrop-blur-md border-r border-gray-800 p-6 flex-shrink-0">
            <h1 class="text-2xl font-bold font-space bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600 mb-10">Admin Panel</h1>
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-600/30 text-white' : '' }}">Dashboard</a>
                <a href="{{ route('articles.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors duration-200 {{ request()->routeIs('articles.*') ? 'bg-purple-600/30 text-white' : '' }}">Articles</a>
                <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors duration-200 {{ request()->routeIs('categories.*') ? 'bg-purple-600/30 text-white' : '' }}">Categories</a>
            </nav>
            <div class="mt-auto pt-10">
                 <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center px-4 py-2 rounded-lg hover:bg-red-500/20 hover:text-red-400 transition-colors duration-200">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

</body>
</html> 