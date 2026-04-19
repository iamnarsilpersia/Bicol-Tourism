@extends('layouts.app')

@section('title', 'Interactive Map - Bicol Tourism')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-green-700 to-green-500 text-white py-12 mb-6">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-2">Interactive Map</h1>
        <p class="text-lg opacity-90">Explore all tourist spots, hotels, restaurants, and shops in Bicol</p>
    </div>
</div>

<div class="container mx-auto px-4 pb-12">
    <!-- Map Controls -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex flex-wrap gap-3">
            <button onclick="filterMarkers('all')" class="px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 flex items-center">
                <span class="mr-2">🗺️</span> Show All
            </button>
            <button onclick="filterMarkers('spot')" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 flex items-center">
                <span class="mr-2">🌋</span> Tourist Spots ({{ $touristSpots->count() }})
            </button>
            <button onclick="filterMarkers('hotel')" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center">
                <span class="mr-2">🏨</span> Hotels ({{ $hotels->count() }})
            </button>
            <button onclick="filterMarkers('shop')" class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 flex items-center">
                <span class="mr-2">🛍️</span> Shops ({{ $shops->count() }})
            </button>
            <button onclick="filterMarkers('restaurant')" class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 flex items-center">
                <span class="mr-2">🍽️</span> Restaurants ({{ $restaurants->count() }})
            </button>
        </div>
    </div>
    
    <!-- Map -->
    <div id="map" class="w-full h-[600px] rounded-xl shadow-lg mb-6"></div>
    
    <!-- Legend -->
    <div class="grid md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl shadow-md flex items-center">
            <div class="w-4 h-4 bg-red-500 rounded-full mr-3"></div>
            <div>
                <p class="font-bold text-gray-800">Tourist Spots</p>
                <p class="text-sm text-gray-500">{{ $touristSpots->count() }} locations</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md flex items-center">
            <div class="w-4 h-4 bg-blue-500 rounded-full mr-3"></div>
            <div>
                <p class="font-bold text-gray-800">Hotels</p>
                <p class="text-sm text-gray-500">{{ $hotels->count() }} locations</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md flex items-center">
            <div class="w-4 h-4 bg-yellow-500 rounded-full mr-3"></div>
            <div>
                <p class="font-bold text-gray-800">Shops</p>
                <p class="text-sm text-gray-500">{{ $shops->count() }} locations</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md flex items-center">
            <div class="w-4 h-4 bg-orange-500 rounded-full mr-3"></div>
            <div>
                <p class="font-bold text-gray-800">Restaurants</p>
                <p class="text-sm text-gray-500">{{ $restaurants->count() }} locations</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([13.2, 123.7], 9);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    var markers = [];
    var currentFilter = 'all';
    
    // Custom icons
    var spotIcon = L.divIcon({className: 'custom-icon', html: '<div style="background:#ef4444;width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:16px;">🌋</div>', iconSize: [30, 30]});
    var hotelIcon = L.divIcon({className: 'custom-icon', html: '<div style="background:#3b82f6;width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:16px;">🏨</div>', iconSize: [30, 30]});
    var shopIcon = L.divIcon({className: 'custom-icon', html: '<div style="background:#eab308;width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:16px;">🛍️</div>', iconSize: [30, 30]});
    var restaurantIcon = L.divIcon({className: 'custom-icon', html: '<div style="background:#f97316;width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:16px;">🍽️</div>', iconSize: [30, 30]});
    
    @foreach($touristSpots as $spot)
    var marker = L.marker([{{ $spot->latitude }}, {{ $spot->longitude }}], {icon: spotIcon, type: 'spot'}).addTo(map);
    marker.bindPopup('<div class="p-2"><h3 class="font-bold text-lg">{{ $spot->name }}</h3><p class="text-sm text-gray-600">{{ $spot->location }}</p><p class="text-sm mt-1">{{ Str::limit($spot->description, 80) }}</p><a href="{{ route('public.tourist-spot-detail', $spot->id) }}" class="text-blue-600 hover:underline text-sm">View Details</a></div>');
    markers.push(marker);
    @endforeach
    
    @foreach($hotels as $hotel)
    var marker = L.marker([{{ $hotel->latitude }}, {{ $hotel->longitude }}], {icon: hotelIcon, type: 'hotel'}).addTo(map);
    marker.bindPopup('<div class="p-2"><h3 class="font-bold text-lg">{{ $hotel->name }}</h3><p class="text-sm text-gray-600">{{ $hotel->address }}</p><p class="text-green-600 font-bold">₱{{ number_format($hotel->price_per_night, 0) }}/night</p></div>');
    markers.push(marker);
    @endforeach
    
    @foreach($shops as $shop)
    var marker = L.marker([{{ $shop->latitude }}, {{ $shop->longitude }}], {icon: shopIcon, type: 'shop'}).addTo(map);
    marker.bindPopup('<div class="p-2"><h3 class="font-bold text-lg">{{ $shop->name }}</h3><p class="text-sm text-gray-600">{{ $shop->address }}</p><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">{{ $shop->type }}</span></div>');
    markers.push(marker);
    @endforeach
    
    @foreach($restaurants as $restaurant)
    var marker = L.marker([{{ $restaurant->latitude }}, {{ $restaurant->longitude }}], {icon: restaurantIcon, type: 'restaurant'}).addTo(map);
    marker.bindPopup('<div class="p-2"><h3 class="font-bold text-lg">{{ $restaurant->name }}</h3><p class="text-sm text-gray-600">{{ $restaurant->address }}</p><p class="text-sm">{{ $restaurant->cuisine_type }}</p><p class="text-green-600 font-bold">₱{{ number_format($restaurant->price_range, 0) }}/person</p></div>');
    markers.push(marker);
    @endforeach
    
    function filterMarkers(type) {
        currentFilter = type;
        markers.forEach(function(m) {
            if (type === 'all' || m.options.type === type) {
                map.addLayer(m);
            } else {
                map.removeLayer(m);
            }
        });
    }
</script>
@endpush

@section('styles')
<style>
    .leaflet-popup-content-wrapper { border-radius: 12px; }
    .leaflet-popup-content { margin: 10px; }
</style>
@endsection
@endsection