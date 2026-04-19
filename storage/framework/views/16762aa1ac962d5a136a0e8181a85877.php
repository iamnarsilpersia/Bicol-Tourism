<?php $__env->startSection('title', 'Hotels'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Hotels</h1>
    <a href="<?php echo e(route('admin.hotels.create')); ?>" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add Hotel</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <?php if($hotel->image): ?>
            <img src="<?php echo e(asset('storage/' . $hotel->image)); ?>" class="w-full h-48 object-cover">
        <?php else: ?>
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        <?php endif; ?>
        <div class="p-4">
            <h3 class="font-bold text-lg"><?php echo e($hotel->name); ?></h3>
            <p class="text-gray-600 text-sm mb-2"><?php echo e(Str::limit($hotel->description, 80)); ?></p>
            <p class="text-sm mb-1">📍 <?php echo e($hotel->address); ?></p>
            <p class="text-sm mb-1">📱 <?php echo e($hotel->contact_number); ?></p>
            <p class="text-blue-800 font-bold">₱<?php echo e(number_format($hotel->price_per_night, 2)); ?>/night</p>
            <div class="flex justify-between items-center mt-2">
                <span class="px-2 py-1 rounded text-sm <?php echo e($hotel->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                    <?php echo e($hotel->is_active ? 'Active' : 'Inactive'); ?>

                </span>
                <div>
                    <a href="<?php echo e(route('admin.hotels.edit', $hotel->id)); ?>" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.hotels.destroy', $hotel->id)); ?>" class="inline">
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
    <?php echo e($hotels->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/admin/hotels/index.blade.php ENDPATH**/ ?>