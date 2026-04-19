@extends('layouts.app')

@section('title', 'Tourist Destinations - Bicol Tourism')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white py-16 mb-8">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Tourist Destinations in Bicol</h1>
        <p class="text-xl opacity-90">Discover the natural wonders and cultural heritage of Bicol Region</p>
    </div>
</div>

<div class="container mx-auto px-4 pb-16">
    <!-- Filter/Search -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select class="w-full border rounded-lg px-4 py-2">
                    <option value="">All Categories</option>
                    <option value="volcano">Volcano</option>
                    <option value="beach">Beach</option>
                    <option value="historical">Historical</option>
                    <option value="marine">Marine</option>
                    <option value="nature">Nature</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <select class="w-full border rounded-lg px-4 py-2">
                    <option value="">All Locations</option>
                    <option value="albay">Albay</option>
                    <option value="sorsogon">Sorsogon</option>
                    <option value="camiguin">Camiguin</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                <select class="w-full border rounded-lg px-4 py-2">
                    <option value="">Any Price</option>
                    <option value="free">Free</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Filter</button>
            </div>
        </div>
    </div>

    <!-- Results -->
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($spots as $spot)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition duration-300">
            <div class="relative h-64">
                @if($spot->image)
                    <img src="{{ asset('storage/' . $spot->image) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <span class="text-8xl">🏝️</span>
                    </div>
                @endif
                <div class="absolute top-4 left-4">
                    <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-sm font-medium text-blue-600">
                        {{ ucfirst($spot->category) }}
                    </span>
                </div>
                @if($spot->entry_fee > 0)
                    <div class="absolute top-4 right-4 bg-green-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                        ₱{{ number_format($spot->entry_fee) }}
                    </div>
                @else
                    <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                        Free
                    </div>
                @endif
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $spot->name }}</h3>
                <p class="text-gray-600 text-sm mb-3 flex items-center">
                    <span class="mr-2">📍</span> {{ $spot->location }}
                </p>
                <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $spot->description }}</p>
                <div class="flex justify-between items-center pt-4 border-t">
                    <a href="{{ route('public.tourist-spot-detail', $spot->id) }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        View Details <span class="ml-1">→</span>
                    </a>
                    <button class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-sm hover:bg-blue-200">
                        📍 Map
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $spots->links() }}
    </div>
</div>
@endsection

@section('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
</style>
@endsection