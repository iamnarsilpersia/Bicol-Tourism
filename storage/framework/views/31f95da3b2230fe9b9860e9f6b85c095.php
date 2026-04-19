<?php $__env->startSection('title', 'Nearby Places - Bicol Tourism'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Nearby Places</h1>
    
    <form method="GET" class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Latitude</label>
                <input type="text" name="lat" value="<?php echo e($lat); ?>" class="w-full border rounded px-3 py-2" placeholder="e.g., 13.444">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Longitude</label>
                <input type="text" name="lng" value="<?php echo e($lng); ?>" class="w-full border rounded px-3 py-2" placeholder="e.g., 123.75">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Radius (km)</label>
                <input type="number" name="radius" value="<?php echo e($radius); ?>" class="w-full border rounded px-3 py-2" min="1" max="50">
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Search</button>
            </div>
        </div>
        <p class="text-sm text-gray-500 mt-2">Tip: Click on a tourist spot to find nearby places.</p>
    </form>
    
    <?php if($lat && $lng): ?>
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-2xl font-bold mb-4">🏨 Hotels</h2>
            <?php $__empty_1 = true; $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="font-bold text-lg"><?php echo e($hotel->name); ?></h3>
                <p class="text-gray-600 text-sm"><?php echo e($hotel->address); ?></p>
                <p class="text-green-600 font-bold">₱<?php echo e(number_format($hotel->price_per_night, 0)); ?>/night</p>
                <p class="text-sm text-gray-500"><?php echo e(number_format($hotel->distance, 1)); ?> km away</p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">No hotels found nearby.</p>
            <?php endif; ?>
        </div>
        
        <div>
            <h2 class="text-2xl font-bold mb-4">🛍️ Shops</h2>
            <?php $__empty_1 = true; $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="font-bold text-lg"><?php echo e($shop->name); ?></h3>
                <p class="text-gray-600 text-sm"><?php echo e($shop->address); ?></p>
                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-sm rounded"><?php echo e($shop->type); ?></span>
                <p class="text-sm text-gray-500"><?php echo e(number_format($shop->distance, 1)); ?> km away</p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">No shops found nearby.</p>
            <?php endif; ?>
        </div>
        
        <div>
            <h2 class="text-2xl font-bold mb-4">🍽️ Restaurants</h2>
            <?php $__empty_1 = true; $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="font-bold text-lg"><?php echo e($restaurant->name); ?></h3>
                <p class="text-gray-600 text-sm"><?php echo e($restaurant->address); ?></p>
                <p class="text-sm"><?php echo e($restaurant->cuisine_type); ?></p>
                <p class="text-sm text-gray-500"><?php echo e(number_format($restaurant->distance, 1)); ?> km away</p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">No restaurants found nearby.</p>
            <?php endif; ?>
        </div>
        
        <div>
            <h2 class="text-2xl font-bold mb-4">🎁 Souvenirs</h2>
            <?php $__empty_1 = true; $__currentLoopData = $souvenirs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $souvenir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <h3 class="font-bold text-lg"><?php echo e($souvenir->name); ?></h3>
                <p class="text-gray-600 text-sm"><?php echo e($souvenir->shop->name ?? ''); ?></p>
                <p class="text-green-600 font-bold">₱<?php echo e(number_format($souvenir->price, 2)); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">No souvenirs found nearby.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php else: ?>
    <div class="bg-yellow-50 p-4 rounded-lg">
        <p class="text-yellow-800">Please enter coordinates or click on a tourist spot to find nearby places.</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/public/nearby-places.blade.php ENDPATH**/ ?>