<?php $__env->startSection('title', 'Interactive Map - Bicol Tourism'); ?>

<?php $__env->startSection('content'); ?>
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
                <span class="mr-2">🌋</span> Tourist Spots (<?php echo e($touristSpots->count()); ?>)
            </button>
            <button onclick="filterMarkers('hotel')" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center">
                <span class="mr-2">🏨</span> Hotels (<?php echo e($hotels->count()); ?>)
            </button>
            <button onclick="filterMarkers('shop')" class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 flex items-center">
                <span class="mr-2">🛍️</span> Shops (<?php echo e($shops->count()); ?>)
            </button>
            <button onclick="filterMarkers('restaurant')" class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 flex items-center">
                <span class="mr-2">🍽️</span> Restaurants (<?php echo e($restaurants->count()); ?>)
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
                <p class="text-sm text-gray-500"><?php echo e($touristSpots->count()); ?> locations</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md flex items-center">
            <div class="w-4 h-4 bg-blue-500 rounded-full mr-3"></div>
            <div>
                <p class="font-bold text-gray-800">Hotels</p>
                <p class="text-sm text-gray-500"><?php echo e($hotels->count()); ?> locations</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md flex items-center">
            <div class="w-4 h-4 bg-yellow-500 rounded-full mr-3"></div>
            <div>
                <p class="font-bold text-gray-800">Shops</p>
                <p class="text-sm text-gray-500"><?php echo e($shops->count()); ?> locations</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md flex items-center">
            <div class="w-4 h-4 bg-orange-500 rounded-full mr-3"></div>
            <div>
                <p class="font-bold text-gray-800">Restaurants</p>
                <p class="text-sm text-gray-500"><?php echo e($restaurants->count()); ?> locations</p>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
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
    
    <?php $__currentLoopData = $touristSpots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    var marker = L.marker([<?php echo e($spot->latitude); ?>, <?php echo e($spot->longitude); ?>], {icon: spotIcon, type: 'spot'}).addTo(map);
    marker.bindPopup('<div class="p-2"><h3 class="font-bold text-lg"><?php echo e($spot->name); ?></h3><p class="text-sm text-gray-600"><?php echo e($spot->location); ?></p><p class="text-sm mt-1"><?php echo e(Str::limit($spot->description, 80)); ?></p><a href="<?php echo e(route('public.tourist-spot-detail', $spot->id)); ?>" class="text-blue-600 hover:underline text-sm">View Details</a></div>');
    markers.push(marker);
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    var marker = L.marker([<?php echo e($hotel->latitude); ?>, <?php echo e($hotel->longitude); ?>], {icon: hotelIcon, type: 'hotel'}).addTo(map);
    marker.bindPopup('<div class="p-2"><h3 class="font-bold text-lg"><?php echo e($hotel->name); ?></h3><p class="text-sm text-gray-600"><?php echo e($hotel->address); ?></p><p class="text-green-600 font-bold">₱<?php echo e(number_format($hotel->price_per_night, 0)); ?>/night</p></div>');
    markers.push(marker);
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    var marker = L.marker([<?php echo e($shop->latitude); ?>, <?php echo e($shop->longitude); ?>], {icon: shopIcon, type: 'shop'}).addTo(map);
    marker.bindPopup('<div class="p-2"><h3 class="font-bold text-lg"><?php echo e($shop->name); ?></h3><p class="text-sm text-gray-600"><?php echo e($shop->address); ?></p><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded"><?php echo e($shop->type); ?></span></div>');
    markers.push(marker);
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    var marker = L.marker([<?php echo e($restaurant->latitude); ?>, <?php echo e($restaurant->longitude); ?>], {icon: restaurantIcon, type: 'restaurant'}).addTo(map);
    marker.bindPopup('<div class="p-2"><h3 class="font-bold text-lg"><?php echo e($restaurant->name); ?></h3><p class="text-sm text-gray-600"><?php echo e($restaurant->address); ?></p><p class="text-sm"><?php echo e($restaurant->cuisine_type); ?></p><p class="text-green-600 font-bold">₱<?php echo e(number_format($restaurant->price_range, 0)); ?>/person</p></div>');
    markers.push(marker);
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .leaflet-popup-content-wrapper { border-radius: 12px; }
    .leaflet-popup-content { margin: 10px; }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/public/map.blade.php ENDPATH**/ ?>