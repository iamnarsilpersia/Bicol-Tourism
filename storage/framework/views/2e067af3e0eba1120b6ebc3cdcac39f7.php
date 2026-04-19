<?php $__env->startSection('title', 'Restaurants'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Restaurants</h1>
    <a href="<?php echo e(route('admin.restaurants.create')); ?>" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add Restaurant</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Address</th>
                <th class="px-6 py-3 text-left">Cuisine</th>
                <th class="px-6 py-3 text-left">Price Range</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-t">
                <td class="px-6 py-4"><?php echo e($restaurant->name); ?></td>
                <td class="px-6 py-4"><?php echo e($restaurant->address); ?></td>
                <td class="px-6 py-4"><?php echo e($restaurant->cuisine_type); ?></td>
                <td class="px-6 py-4">₱<?php echo e(number_format($restaurant->price_range, 0)); ?></td>
                <td class="px-6 py-4">
                    <a href="<?php echo e(route('admin.restaurants.edit', $restaurant->id)); ?>" class="text-blue-600 hover:underline mr-3">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.restaurants.destroy', $restaurant->id)); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div class="mt-4">
    <?php echo e($restaurants->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/admin/restaurants/index.blade.php ENDPATH**/ ?>