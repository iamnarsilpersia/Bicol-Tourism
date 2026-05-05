@extends('layouts.app')

@section('title', $spot->name . ' - Bicol Tourism')

@section('content')
<!-- Hero Header -->
<div class="relative h-96">
    @if($spot->image)
        <img src="{{ asset('storage/' . $spot->image) }}" class="w-full h-full object-cover">
    @else
        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
            <span class="text-9xl">🏝️</span>
        </div>
    @endif
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute bottom-0 left-0 right-0 p-8">
        <div class="container mx-auto">
            <a href="{{ route('public.tourist-spots') }}" class="text-white/80 hover:text-white mb-4 inline-flex items-center">
                ← Back to Destinations
            </a>
            <span class="bg-white/20 backdrop-blur px-4 py-1 rounded-full text-white text-sm mb-3 inline-block">
                {{ ucfirst($spot->category) }}
            </span>
            <h1 class="text-5xl font-bold text-white mb-2">{{ $spot->name }}</h1>
            <p class="text-white/90 text-xl flex items-center">
                <span class="mr-2">📍</span> {{ $spot->location }}
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Description -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Place</h2>
                <p class="text-gray-600 leading-relaxed text-lg">{{ $spot->description }}</p>
            </div>
            
            <!-- Basic Info -->
            @if($spot->basic_info)
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Visitor Information</h2>
                <div class="space-y-3">
                    @foreach(explode("\n", $spot->basic_info) as $info)
                        @if(trim($info))
                        <div class="flex items-start">
                            <span class="text-blue-600 mr-3 mt-1">•</span>
                            <p class="text-gray-600">{{ trim($info) }}</p>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- Location -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Location</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-500 text-sm">Latitude</p>
                        <p class="font-medium">{{ $spot->latitude }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-500 text-sm">Longitude</p>
                        <p class="font-medium">{{ $spot->longitude }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('public.nearby-places', ['lat' => $spot->latitude, 'lng' => $spot->longitude, 'radius' => 10]) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        Find nearby hotels, restaurants, shops →
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div>
            <!-- Price Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6 sticky top-24">
                @if($spot->entry_fee > 0)
                    <div class="text-center mb-6">
                        <p class="text-gray-500 text-sm">Entry Fee</p>
                        <p class="text-4xl font-bold text-green-600">₱{{ number_format($spot->entry_fee) }}</p>
                        <p class="text-gray-400 text-sm">per person</p>
                    </div>
                @else
                    <div class="text-center mb-6">
                        <p class="text-gray-500 text-sm">Entry Fee</p>
                        <p class="text-4xl font-bold text-blue-600">Free</p>
                        <p class="text-gray-400 text-sm">No entrance fee</p>
                    </div>
                @endif
                
                @if($spot->contact_number)
                <div class="border-t pt-4 mb-4">
                    <p class="text-gray-500 text-sm mb-1">Contact</p>
                    <p class="font-medium flex items-center">
                        <span class="mr-2">📞</span> {{ $spot->contact_number }}
                    </p>
                </div>
                @endif
                
                <div class="flex flex-col gap-3">
                    <a href="{{ route('public.map') }}" class="bg-blue-600 text-white text-center px-4 py-3 rounded-lg hover:bg-blue-700 font-medium">
                        🗺️ View on Map
                    </a>
                    @auth
                    <a href="{{ route('public.book-tour', ['spot_id' => $spot->id]) }}" class="bg-green-600 text-white text-center px-4 py-3 rounded-lg hover:bg-green-700 font-medium">
                        🎫 Book This Spot
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="bg-green-600 text-white text-center px-4 py-3 rounded-lg hover:bg-green-700 font-medium">
                        Login to Book
                    </a>
                    @endauth
                </div>
            </div>
            
            <!-- Quick Info -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6">
                <h3 class="font-bold text-gray-800 mb-4">Quick Facts</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Category</span>
                        <span class="font-medium">{{ ucfirst($spot->category) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Region</span>
                        <span class="font-medium">Bicol</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection