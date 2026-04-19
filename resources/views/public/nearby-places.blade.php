@extends('layouts.app')

@section('title', 'Nearby Places - Bicol Tourism')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Nearby Places</h1>
    
    <form method="GET" class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Latitude</label>
                <input type="text" name="lat" value="{{ $lat }}" class="w-full border rounded px-3 py-2" placeholder="e.g., 13.444">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Longitude</label>
                <input type="text" name="lng" value="{{ $lng }}" class="w-full border rounded px-3 py-2" placeholder="e.g., 123.75">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Radius (km)</label>
                <input type="number" name="radius" value="{{ $radius }}" class="w-full border rounded px-3 py-2" min="1" max="50">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Search</button>
            </div>
        </div>
        <p class="text-sm text-gray-500 mt-2">Tip: Click on a tourist spot to find nearby places.</p>
    </form>
    
    @if($lat && $lng)
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-2xl font-bold mb-4">🏨 Hotels</h2>
            @forelse($hotels as $hotel)
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="font-bold text-lg">{{ $hotel->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $hotel->address }}</p>
                <p class="text-green-600 font-bold">₱{{ number_format($hotel->price_per_night, 0) }}/night</p>
                <p class="text-sm text-gray-500">{{ number_format($hotel->distance, 1) }} km away</p>
            </div>
            @empty
            <p class="text-gray-500">No hotels found nearby.</p>
            @endforelse
        </div>
        
        <div>
            <h2 class="text-2xl font-bold mb-4">🛍️ Shops</h2>
            @forelse($shops as $shop)
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="font-bold text-lg">{{ $shop->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $shop->address }}</p>
                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-sm rounded">{{ $shop->type }}</span>
                <p class="text-sm text-gray-500">{{ number_format($shop->distance, 1) }} km away</p>
            </div>
            @empty
            <p class="text-gray-500">No shops found nearby.</p>
            @endforelse
        </div>
        
        <div>
            <h2 class="text-2xl font-bold mb-4">🍽️ Restaurants</h2>
            @forelse($restaurants as $restaurant)
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="font-bold text-lg">{{ $restaurant->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $restaurant->address }}</p>
                <p class="text-sm">{{ $restaurant->cuisine_type }}</p>
                <p class="text-sm text-gray-500">{{ number_format($restaurant->distance, 1) }} km away</p>
            </div>
            @empty
            <p class="text-gray-500">No restaurants found nearby.</p>
            @endforelse
        </div>
        
        <div>
            <h2 class="text-2xl font-bold mb-4">🎁 Souvenirs</h2>
            @forelse($souvenirs as $souvenir)
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="font-bold text-lg">{{ $souvenir->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $souvenir->shop->name ?? '' }}</p>
                <p class="text-green-600 font-bold">₱{{ number_format($souvenir->price, 2) }}</p>
            </div>
            @empty
            <p class="text-gray-500">No souvenirs found nearby.</p>
            @endforelse
        </div>
    </div>
    @else
    <div class="bg-yellow-50 p-4 rounded-lg">
        <p class="text-yellow-800">Please enter coordinates or click on a tourist spot to find nearby places.</p>
    </div>
    @endif
</div>
@endsection