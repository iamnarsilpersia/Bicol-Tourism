<?php $__env->startSection('title', 'Tour Packages - Bicol Tourism'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tour Packages in Bicol</h1>
    
    <div class="grid md:grid-cols-3 gap-6">
        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
            <?php if($package->image): ?>
                <img src="<?php echo e(asset('storage/' . $package->image)); ?>" class="w-full h-48 object-cover">
            <?php else: ?>
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            <?php endif; ?>
            <div class="p-4">
                <h3 class="font-bold text-lg"><?php echo e($package->name); ?></h3>
                <p class="text-gray-600 text-sm mb-2"><?php echo e(Str::limit($package->description, 100)); ?></p>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-green-600 font-bold text-xl">₱<?php echo e(number_format($package->price, 2)); ?></span>
                    <span class="text-gray-500 text-sm"><?php echo e($package->duration_days); ?> days</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Includes <?php echo e($package->touristSpots->count()); ?> spots</p>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('user.book-package', $package->id)); ?>" class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Book Now</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login to Book</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-6">
        <?php echo e($packages->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/public/tour-packages.blade.php ENDPATH**/ ?>