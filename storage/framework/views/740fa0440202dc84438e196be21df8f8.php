<?php $__env->startSection('title', 'Tour Packages'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Tour Packages</h1>
    <a href="<?php echo e(route('admin.tour-packages.create')); ?>" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add New Package</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-lg shadow overflow-hidden">
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
            <div class="flex justify-between items-center mb-2">
                <span class="text-blue-800 font-bold">₱<?php echo e(number_format($package->price, 2)); ?></span>
                <span class="text-gray-500 text-sm"><?php echo e($package->duration_days); ?> days</span>
            </div>
            <p class="text-sm text-gray-500 mb-2">Spots: <?php echo e($package->touristSpots->count()); ?></p>
            <div class="flex justify-between items-center">
                <span class="px-2 py-1 rounded text-sm <?php echo e($package->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                    <?php echo e($package->is_active ? 'Active' : 'Inactive'); ?>

                </span>
                <div>
                    <a href="<?php echo e(route('admin.tour-packages.edit', $package->id)); ?>" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.tour-packages.destroy', $package->id)); ?>" class="inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="mt-6">
    <?php echo e($packages->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/admin/tour-packages/index.blade.php ENDPATH**/ ?>