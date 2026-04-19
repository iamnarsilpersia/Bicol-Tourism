<?php $__env->startSection('title', 'Tourist Spots'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Tourist Spots</h1>
    <a href="<?php echo e(route('admin.tourist-spots.create')); ?>" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add New Spot</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Location</th>
                <th class="px-6 py-3 text-left">Category</th>
                <th class="px-6 py-3 text-left">Contact</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php $__currentLoopData = $spots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="px-6 py-4"><?php echo e($spot->name); ?></td>
                <td class="px-6 py-4"><?php echo e($spot->location); ?></td>
                <td class="px-6 py-4"><?php echo e($spot->category); ?></td>
                <td class="px-6 py-4"><?php echo e($spot->contact_number ?? 'N/A'); ?></td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-sm <?php echo e($spot->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                        <?php echo e($spot->is_active ? 'Active' : 'Inactive'); ?>

                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="<?php echo e(route('admin.tourist-spots.edit', $spot->id)); ?>" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                    <form method="POST" action="<?php echo e(route('admin.tourist-spots.destroy', $spot->id)); ?>" class="inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div class="mt-4">
    <?php echo e($spots->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/admin/tourist-spots/index.blade.php ENDPATH**/ ?>