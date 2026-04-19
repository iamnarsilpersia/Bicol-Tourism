@extends('layouts.user')

@section('title', 'Nearby Places')

@section('content')
<h1 class="text-3xl font-bold mb-6">Find Nearby Places</h1>

<div class="grid md:grid-cols-4 gap-6">
    <div class="md:col-span-1 bg-white rounded-lg shadow p-4">
        <h3 class="font-bold mb-4">Enter Location</h3>
        <form action="{{ route('user.nearby-places') }}" method="GET">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Latitude</label>
                <input type="number" step="any" name="lat" required class="w-full px-3 py-2 border rounded" placeholder="13.6217">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Longitude</label>
                <input type="number" step="any" name="lng" required class="w-full px-3 py-2 border rounded" placeholder="123.9248">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Radius (km)</label>
                <input type="number" step="any" name="radius" value="5" class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-900">Find Places</button>
        </form>
        <p class="text-sm text-gray-500 mt-4">Tip: Click on the map to get coordinates</p>
    </div>
    
    <div class="md:col-span-3">
        <div id="map" class="w-full h-[500px] rounded-lg shadow mb-6"></div>
        
        @if(isset($hotels) || isset($shops))
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-bold text-lg mb-4">🏨 Hotels</h3>
                @forelse($hotels as $hotel)
                <div class="border-b py-3">
                    <h4 class="font-semibold">{{ $hotel->name }}</h4>
                    <p class="text-sm text-gray-600">{{ $hotel->address }}</p>
                    <p class="text-sm">📱 {{ $hotel->contact_number }}</p>
                    <p class="text-blue-800 font-bold">₱{{ number_format($hotel->price_per_night, 2) }}/night</p>
                    @if(isset($hotel->distance))
                        <p class="text-xs text-gray-500">{{ number_format($hotel->distance, 1) }} km away</p>
                    @endif
                </div>
                @empty
                <p class="text-gray-500">No hotels found nearby</p>
                @endforelse
            </div>
            
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-bold text-lg mb-4">🛍️ Shops & Souvenirs</h3>
                @forelse($shops as $shop)
                <div class="border-b py-3">
                    <h4 class="font-semibold">{{ $shop->name }}</h4>
                    <span class="px-2 py-1 rounded text-xs bg-purple-100 text-purple-800">{{ ucfirst($shop->type) }}</span>
                    <p class="text-sm text-gray-600">{{ $shop->address }}</p>
                    <p class="text-sm">📱 {{ $shop->contact_number }}</p>
                    @if(isset($shop->distance))
                        <p class="text-xs text-gray-500">{{ number_format($shop->distance, 1) }} km away</p>
                    @endif
                </div>
                @empty
                <p class="text-gray-500">No shops found nearby</p>
                @endforelse
            </div>
        </div>
        @endif
    </div>
</div>

<script>
const map = L.map('map').setView([13.6217, 123.9248], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

map.on('click', function(e) {
    const lat = e.latlng.lat.toFixed(4);
    const lng = e.latlng.lng.toFixed(4);
    const form = document.querySelector('form');
    form.querySelector('input[name="lat"]').value = lat;
    form.querySelector('input[name="lng"]').value = lng;
});
</script>
@endsection
