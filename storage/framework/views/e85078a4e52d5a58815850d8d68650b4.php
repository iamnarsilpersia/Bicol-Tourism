<?php $__env->startSection('title', 'Shops'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Shops</h1>
    <a href="<?php echo e(route('admin.shops.create')); ?>" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add Shop</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <?php if($shop->image): ?>
            <img src="<?php echo e(asset('storage/' . $shop->image)); ?>" class="w-full h-48 object-cover">
        <?php else: ?>
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        <?php endif; ?>
        <div class="p-4">
            <h3 class="font-bold text-lg"><?php echo e($shop->name); ?></h3>
            <span class="px-2 py-1 rounded text-sm bg-purple-100 text-purple-800"><?php echo e(ucfirst($shop->type)); ?></span>
            <p class="text-gray-600 text-sm mt-2 mb-2"><?php echo e(Str::limit($shop->description, 80)); ?></p>
            <p class="text-sm mb-1">📍 <?php echo e($shop->address); ?></p>
            <p class="text-sm mb-1">📱 <?php echo e($shop->contact_number); ?></p>
            <div class="flex justify-between items-center mt-2">
                <span class="px-2 py-1 rounded text-sm <?php echo e($shop->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                    <?php echo e($shop->is_active ? 'Active' : 'Inactive'); ?>

                </span>
                <div>
                    <a href="<?php echo e(route('admin.shops.edit', $shop->id)); ?>" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.shops.destroy', $shop->id)); ?>" class="inline">
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
    <?php echo e($shops->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/admin/shops/index.blade.php ENDPATH**/ ?>