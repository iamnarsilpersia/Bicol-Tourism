@extends('layouts.admin')

@section('title', 'Interactive Map - Bicol Region')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Interactive Map - Bicol Region</h1>
    <p class="text-gray-600">View and manage all locations in Bicol</p>
</div>

<div class="grid md:grid-cols-4 gap-6">
    <div class="md:col-span-3">
        <div id="map" class="w-full h-[600px] rounded-lg shadow"></div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="font-bold mb-4">Nearby Places Finder</h3>
        <form id="nearby-form">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Latitude</label>
                <input type="number" step="any" id="search-lat" class="w-full px-3 py-2 border rounded" placeholder="13.6217">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Longitude</label>
                <input type="number" step="any" id="search-lng" class="w-full px-3 py-2 border rounded" placeholder="123.9248">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Radius (km)</label>
                <input type="number" step="any" id="search-radius" value="5" class="w-full px-3 py-2 border rounded">
            </div>
            <button type="button" onclick="findNearby()" class="w-full bg-blue-800 text-white py-2 rounded hover:bg-blue-900">Find Nearby</button>
        </form>
        
        <div id="nearby-results" class="mt-4 max-h-96 overflow-y-auto"></div>
    </div>
</div>

<script>
const bicolCenter = [13.6217, 123.9248];
const map = L.map('map').setView(bicolCenter, 9);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

const spots = @json($touristSpots);
const hotels = @json($hotels);
const shops = @json($shops);

const spotIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
});

const hotelIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
});

const shopIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
});

spots.forEach(spot => {
    L.marker([spot.latitude, spot.longitude], {icon: spotIcon})
        .addTo(map)
        .bindPopup(`<b>${spot.name}</b><br>${spot.category}<br>${spot.location}`);
});

hotels.forEach(hotel => {
    L.marker([hotel.latitude, hotel.longitude], {icon: hotelIcon})
        .addTo(map)
        .bindPopup(`<b>${hotel.name}</b><br>Hotel<br>₱${hotel.price_per_night}/night`);
});

shops.forEach(shop => {
    L.marker([shop.latitude, shop.longitude], {icon: shopIcon})
        .addTo(map)
        .bindPopup(`<b>${shop.name}</b><br>${shop.type}<br>${shop.address}`);
});

function findNearby() {
    const lat = document.getElementById('search-lat').value;
    const lng = document.getElementById('search-lng').value;
    const radius = document.getElementById('search-radius').value;
    
    if (!lat || !lng) {
        alert('Please enter latitude and longitude');
        return;
    }
    
    L.circle([lat, lng], {
        color: 'blue',
        fillColor: '#30f',
        fillOpacity: 0.1,
        radius: radius * 1000
    }).addTo(map);
    
    fetch(`/admin/nearby-places?lat=${lat}&lng=${lng}&radius=${radius}`)
        .then(res => res.json())
        .then(data => {
            let html = '<h4 class="font-bold mt-4 mb-2">Results:</h4>';
            
            html += '<h5 class="font-semibold">Hotels:</h5>';
            if (data.hotels.length === 0) html += '<p class="text-sm text-gray-500">No hotels found</p>';
            data.hotels.forEach(h => {
                html += `<p class="text-sm">${h.name} (${h.distance.toFixed(1)} km)</p>`;
            });
            
            html += '<h5 class="font-semibold mt-2">Shops:</h5>';
            if (data.shops.length === 0) html += '<p class="text-sm text-gray-500">No shops found</p>';
            data.shops.forEach(s => {
                html += `<p class="text-sm">${s.name} - ${s.type} (${s.distance.toFixed(1)} km)</p>`;
            });
            
            document.getElementById('nearby-results').innerHTML = html;
        });
}

map.on('click', function(e) {
    document.getElementById('search-lat').value = e.latlng.lat.toFixed(4);
    document.getElementById('search-lng').value = e.latlng.lng.toFixed(4);
});
</script>

<div class="mt-6 bg-white rounded-lg shadow p-4">
    <h3 class="font-bold mb-2">Legend</h3>
    <div class="flex space-x-6">
        <div class="flex items-center">
            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png" class="w-6 h-8">
            <span class="ml-2">Tourist Spots</span>
        </div>
        <div class="flex items-center">
            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png" class="w-6 h-8">
            <span class="ml-2">Hotels</span>
        </div>
        <div class="flex items-center">
            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png" class="w-6 h-8">
            <span class="ml-2">Shops</span>
        </div>
    </div>
</div>
@endsection
