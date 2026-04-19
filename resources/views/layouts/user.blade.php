<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User - Bicol Tourism')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-blue-700 to-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <span class="text-blue-700 text-xl">🌋</span>
                    </div>
                    <a href="{{ route('user.dashboard') }}" class="text-xl font-bold">Bicol Tourism</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('user.dashboard') }}" class="hover:text-blue-200">Dashboard</a>
                    <a href="{{ route('user.tourist-spots') }}" class="hover:text-blue-200">Tourist Spots</a>
                    <a href="{{ route('user.tour-packages') }}" class="hover:text-blue-200">Tour Packages</a>
                    <a href="{{ route('user.map') }}" class="hover:text-blue-200">Map</a>
                    <a href="{{ route('public.book-tour') }}" class="hover:text-blue-200">Book Tour</a>
                    <a href="{{ route('user.nearby-places-form') }}" class="hover:text-blue-200">Nearby</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                            <span class="text-blue-600 text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-blue-200 text-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto px-4 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} Bicol Tourism. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>