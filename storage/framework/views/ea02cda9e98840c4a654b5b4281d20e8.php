<?php $__env->startSection('title', 'Tourist Spots'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-3xl font-bold mb-6">Tourist Spots in Bicol</h1>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form action="<?php echo e(url('/user/tourist-spots')); ?>" method="GET">
        <div class="flex gap-4">
            <input type="text" name="search" placeholder="Search by name, location, or category..." value="<?php echo e(request()->input('search')); ?>" class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Search</button>
            <?php if(request()->input('search')): ?>
            <a href="<?php echo e(url('/user/tourist-spots')); ?>" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Clear</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="grid md:grid-cols-3 gap-6">
    <?php $__empty_1 = true; $__currentLoopData = $spots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <?php if($spot->image): ?>
            <img src="<?php echo e(asset('storage/' . $spot->image)); ?>" class="w-full h-48 object-cover">
        <?php else: ?>
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        <?php endif; ?>
        <div class="p-4">
            <span class="px-2 py-1 rounded text-sm bg-blue-100 text-blue-800"><?php echo e(ucfirst($spot->category)); ?></span>
            <h3 class="font-bold text-lg mt-2"><?php echo e($spot->name); ?></h3>
            <p class="text-gray-600 text-sm mb-2">📍 <?php echo e($spot->location); ?></p>
            <p class="text-gray-600 text-sm mb-3"><?php echo e(Str::limit($spot->description, 100)); ?></p>
            <?php if($spot->contact_number): ?>
                <p class="text-sm mb-2">📱 <?php echo e($spot->contact_number); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-span-3 text-center py-12">
        <p class="text-gray-500 text-lg">No tourist spots found matching your search.</p>
        <a href="<?php echo e(url('/user/tourist-spots')); ?>" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">View all spots</a>
    </div>
    <?php endif; ?>
</div>

<div class="mt-6">
    <?php echo e($spots->appends(request()->all())->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/user/tourist-spots.blade.php ENDPATH**/ ?>