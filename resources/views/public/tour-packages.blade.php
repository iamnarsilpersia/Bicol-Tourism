@extends('layouts.app')

@section('title', 'Tour Packages - Bicol Tourism')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tour Packages in Bicol</h1>
    
    <div class="grid md:grid-cols-3 gap-6">
        @foreach($packages as $package)
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
            @if($package->image)
                <img src="{{ asset('storage/' . $package->image) }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif
            <div class="p-4">
                <h3 class="font-bold text-lg">{{ $package->name }}</h3>
                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($package->description, 100) }}</p>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-green-600 font-bold text-xl">₱{{ number_format($package->price, 2) }}</span>
                    <span class="text-gray-500 text-sm">{{ $package->duration_days }} days</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Includes {{ $package->touristSpots->count() }} spots</p>
                @auth
                    <a href="{{ route('user.book-package', $package->id) }}" class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Book Now</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login to Book</a>
                @endauth
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $packages->links() }}
    </div>
</div>
@endsection