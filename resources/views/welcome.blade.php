@extends('layouts.app')

@section('title', 'Welcome to Bicol Tourism Guide')

@section('content')
<!-- Hero Section -->
<section class="hero-bg h-[500px] flex items-center justify-center text-center text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold mb-4">Discover Bicol's Natural Wonders</h1>
        <p class="text-xl mb-8">Explore the iconic Mayon Volcano, pristine beaches, and rich cultural heritage</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('public.tourist-spots') }}" class="bg-white text-blue-800 px-8 py-3 rounded-full font-semibold hover:bg-gray-100">Explore Now</a>
            <a href="{{ route('public.map') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-800">View Map</a>
        </div>
        
        <!-- Search Box -->
        <div class="mt-8 max-w-2xl mx-auto bg-white rounded-full p-2 flex">
            <form action="{{ route('public.tourist-spots') }}" method="GET" class="flex flex-1">
                <input type="text" name="search" placeholder="Search tourist spots, hotels, restaurants..." class="flex-1 px-6 py-2 rounded-full text-gray-800 outline-none">
                <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-full hover:bg-blue-700">Search</button>
            </form>
        </div>
    </div>
</section>

<!-- Featured Destinations -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Featured Destinations</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Discover the most beautiful tourist spots in Bicol Region</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($spots->take(6) as $spot)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition duration-300">
                <div class="relative h-56">
                    @if($spot->image)
                        <img src="{{ asset('storage/' . $spot->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <span class="text-6xl">🌋</span>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-full text-sm font-medium text-blue-600">
                        {{ ucfirst($spot->category) }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $spot->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3 flex items-center">
                        <span class="mr-2">📍</span> {{ $spot->location }}
                    </p>
                    <p class="text-gray-500 text-sm mb-4">{{ Str::limit($spot->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        @if($spot->entry_fee > 0)
                            <span class="text-green-600 font-bold">₱{{ number_format($spot->entry_fee) }}</span>
                        @else
                            <span class="text-green-600 font-bold">Free</span>
                        @endif
                        <a href="{{ route('public.tourist-spot-detail', $spot->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">View Details →</a>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('public.tourist-spots') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">View All Destinations</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Explore Bicol Your Way</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Choose how you want to experience the beauty of Bicol</p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-md text-center card-hover transition">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">🗺️</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Interactive Map</h3>
                <p class="text-gray-600 text-sm">Navigate through all tourist spots, hotels, and restaurants</p>
                <a href="{{ route('public.map') }}" class="inline-block mt-4 text-blue-600 hover:underline">Open Map →</a>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-md text-center card-hover transition">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">🏨</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Nearby Places</h3>
                <p class="text-gray-600 text-sm">Find hotels, restaurants, shops near your destination</p>
                <a href="{{ route('public.nearby-places', ['lat' => 13.444, 'lng' => 123.75]) }}" class="inline-block mt-4 text-blue-600 hover:underline">Find Nearby →</a>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-md text-center card-hover transition">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">🎁</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Tour Packages</h3>
                <p class="text-gray-600 text-sm">Pre-planned tours for a hassle-free experience</p>
                <a href="{{ route('public.tour-packages') }}" class="inline-block mt-4 text-blue-600 hover:underline">View Packages →</a>
            </div>
            
            <div class="bg-white p-8 rounded-xl shadow-md text-center card-hover transition">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl">🎫</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Custom Tours</h3>
                <p class="text-gray-600 text-sm">Create your own itinerary with selected spots and food</p>
                @auth
                    <a href="{{ route('public.book-tour') }}" class="inline-block mt-4 text-blue-600 hover:underline">Book Now →</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block mt-4 text-blue-600 hover:underline">Login to Book →</a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Featured Packages -->
@if($packages->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Popular Tour Packages</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Choose from our carefully curated tour packages</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($packages->take(3) as $package)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition">
                <div class="relative h-48 bg-gradient-to-r from-blue-500 to-blue-700 flex items-center justify-center">
                    <span class="text-6xl">🚗</span>
                    <div class="absolute bottom-4 right-4 bg-white px-3 py-1 rounded-full text-sm font-bold text-blue-600">
                        {{ $package->duration_days }} Days
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $package->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($package->description, 80) }}</p>
                    <div class="flex items-center mb-4">
                        <span class="text-yellow-500 text-sm mr-2">⭐⭐⭐⭐⭐</span>
                        <span class="text-gray-500 text-sm">Includes {{ $package->touristSpots->count() }} spots</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-green-600">₱{{ number_format($package->price, 0) }}</span>
                        @auth
                            <a href="{{ route('user.book-package', $package->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Book Now</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Login to Book</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Stats Section -->
<section class="py-16 bg-blue-800 text-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">8+</div>
                <div class="text-blue-200">Tourist Spots</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">3+</div>
                <div class="text-blue-200">Tour Packages</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">4+</div>
                <div class="text-blue-200">Restaurants</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">3+</div>
                <div class="text-blue-200">Hotels</div>
            </div>
        </div>
    </div>
</section>
@endsection