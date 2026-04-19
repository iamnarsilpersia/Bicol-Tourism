<?php $__env->startSection('title', 'Map'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-3xl font-bold mb-6">Tourist Spots Map - Bicol Region</h1>

<div id="map" class="w-full h-[600px] rounded-lg shadow"></div>

<div class="mt-6 bg-white rounded-lg shadow p-4">
    <h3 class="font-bold mb-2">Legend</h3>
    <div class="flex space-x-6">
        <div class="flex items-center">
            <div class="w-4 h-4 rounded-full bg-blue-500 mr-2"></div>
            <span>Tourist Spots</span>
        </div>
    </div>
</div>

<script>
const bicolCenter = [13.6217, 123.9248];
const map = L.map('map').setView(bicolCenter, 9);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

const spots = <?php echo json_encode($touristSpots, 15, 512) ?>;

spots.forEach(spot => {
    const popupContent = `
        <div class="p-2">
            <h3 class="font-bold">${spot.name}</h3>
            <p class="text-sm">${spot.category}</p>
            <p class="text-sm">${spot.location}</p>
            ${spot.description ? `<p class="text-sm mt-2">${spot.description.substring(0, 100)}...</p>` : ''}
        </div>
    `;
    
    L.marker([spot.latitude, spot.longitude])
        .addTo(map)
        .bindPopup(popupContent);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/user/map.blade.php ENDPATH**/ ?>