<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Bicol Tourism')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <span class="text-blue-800 text-xl">🌋</span>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">Bicol Tourism Admin</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.dashboard') ? 'text-yellow-400' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.tourist-spots') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.tourist-spots*') ? 'text-yellow-400' : '' }}">Tourist Spots</a>
                    <a href="{{ route('admin.tour-packages') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.tour-packages*') ? 'text-yellow-400' : '' }}">Packages</a>
                    <a href="{{ route('admin.hotels') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.hotels*') ? 'text-yellow-400' : '' }}">Hotels</a>
                    <a href="{{ route('admin.restaurants') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.restaurants*') ? 'text-yellow-400' : '' }}">Restaurants</a>
                    <a href="{{ route('admin.shops') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.shops*') ? 'text-yellow-400' : '' }}">Shops</a>
                    <a href="{{ route('admin.custom-tours') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.custom-tours*') ? 'text-yellow-400' : '' }}">Bookings</a>
                    <a href="{{ route('admin.tour-guide-bookings') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.tour-guide-bookings*') ? 'text-yellow-400' : '' }}">Guide Bookings</a>
                    <a href="{{ route('admin.map') }}" class="hover:text-blue-200 {{ request()->routeIs('admin.map*') ? 'text-yellow-400' : '' }}">Map</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="/" target="_blank" class="bg-blue-600 px-3 py-1 rounded text-sm hover:bg-blue-700">View Site</a>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                            <span class="text-blue-900 text-sm font-bold">A</span>
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

    <!-- Mobile Menu -->
    <div class="md:hidden bg-blue-900 text-white py-2 px-4 flex justify-around text-sm">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.tourist-spots') }}">Spots</a>
        <a href="{{ route('admin.hotels') }}">Hotels</a>
        <a href="{{ route('admin.map') }}">Map</a>
    </div>

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
            <p>&copy; {{ date('Y') }} Bicol Tourism Admin Panel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>