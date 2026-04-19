@extends('layouts.admin')

@section('title', 'Admin Dashboard - Bicol Tourism')

@section('content')
<!-- Dashboard Header -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500">Welcome back! Here's what's happening today.</p>
    </div>
    <div class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        {{ date('F d, Y') }}
    </div>
</div>

<!-- Stats Cards -->
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Tourist Spots</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['tourist_spots'] }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <span class="text-2xl">🌋</span>
            </div>
        </div>
        <a href="{{ route('admin.tourist-spots') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">View all →</a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Tour Packages</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['tour_packages'] }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <span class="text-2xl">🎁</span>
            </div>
        </div>
        <a href="{{ route('admin.tour-packages') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">View all →</a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Reservations</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['reservations'] }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <span class="text-2xl">📅</span>
            </div>
        </div>
        <a href="{{ route('admin.reservations') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">View all →</a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Custom Tours</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['custom_tours'] ?? 0 }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <span class="text-2xl">🚗</span>
            </div>
        </div>
        <a href="{{ route('admin.custom-tours') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">View all →</a>
    </div>
</div>

<!-- Second Row -->
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Hotels</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['hotels'] }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <span class="text-2xl">🏨</span>
            </div>
        </div>
        <a href="{{ route('admin.hotels') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">Manage →</a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Restaurants</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['restaurants'] ?? 0 }}</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                <span class="text-2xl">🍽️</span>
            </div>
        </div>
        <a href="{{ route('admin.restaurants') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">Manage →</a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-pink-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Shops</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['shops'] }}</p>
            </div>
            <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center">
                <span class="text-2xl">🛍️</span>
            </div>
        </div>
        <a href="{{ route('admin.shops') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">Manage →</a>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-cyan-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Tour Guides</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['tour_guides'] }}</p>
            </div>
            <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center">
                <span class="text-2xl">👤</span>
            </div>
        </div>
        <a href="{{ route('admin.tour-guides') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">Manage →</a>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-xl shadow-md p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
    <div class="grid md:grid-cols-6 gap-4">
        <a href="{{ route('admin.tourist-spots.create') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
            <span class="text-3xl mb-2">➕</span>
            <span class="text-sm text-gray-600">Add Spot</span>
        </a>
        <a href="{{ route('admin.tour-packages.create') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
            <span class="text-3xl mb-2">🎁</span>
            <span class="text-sm text-gray-600">Add Package</span>
        </a>
        <a href="{{ route('admin.hotels.create') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
            <span class="text-3xl mb-2">🏨</span>
            <span class="text-sm text-gray-600">Add Hotel</span>
        </a>
        <a href="{{ route('admin.restaurants.create') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition">
            <span class="text-3xl mb-2">🍽️</span>
            <span class="text-sm text-gray-600">Add Restaurant</span>
        </a>
        <a href="{{ route('admin.custom-tours') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:border-yellow-500 hover:bg-yellow-50 transition">
            <span class="text-3xl mb-2">📋</span>
            <span class="text-sm text-gray-600">Tour Bookings</span>
        </a>
        <a href="{{ route('admin.map') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-200 rounded-lg hover:border-cyan-500 hover:bg-cyan-50 transition">
            <span class="text-3xl mb-2">🗺️</span>
            <span class="text-sm text-gray-600">View Map</span>
        </a>
    </div>
</div>
@endsection