<?php $__env->startSection('title', 'Edit Tourist Spot'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-6">Edit Tourist Spot</h1>

<form method="POST" action="<?php echo e(route('admin.tourist-spots.update', $spot->id)); ?>" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Name</label>
            <input type="text" name="name" value="<?php echo e($spot->name); ?>" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Category</label>
            <select name="category" required class="w-full px-4 py-2 border rounded-lg">
                <option value="beach" <?php echo e($spot->category == 'beach' ? 'selected' : ''); ?>>Beach</option>
                <option value="mountain" <?php echo e($spot->category == 'mountain' ? 'selected' : ''); ?>>Mountain</option>
                <option value="historical" <?php echo e($spot->category == 'historical' ? 'selected' : ''); ?>>Historical</option>
                <option value="cultural" <?php echo e($spot->category == 'cultural' ? 'selected' : ''); ?>>Cultural</option>
                <option value="waterfall" <?php echo e($spot->category == 'waterfall' ? 'selected' : ''); ?>>Waterfall</option>
                <option value="volcano" <?php echo e($spot->category == 'volcano' ? 'selected' : ''); ?>>Volcano</option>
                <option value="park" <?php echo e($spot->category == 'park' ? 'selected' : ''); ?>>Park</option>
            </select>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Location</label>
            <input type="text" name="location" value="<?php echo e($spot->location); ?>" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Latitude</label>
            <input type="number" step="any" name="latitude" value="<?php echo e($spot->latitude); ?>" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Longitude</label>
            <input type="number" step="any" name="longitude" value="<?php echo e($spot->longitude); ?>" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Contact Number</label>
            <input type="text" name="contact_number" value="<?php echo e($spot->contact_number); ?>" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Image</label>
            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
            <?php if($spot->image): ?>
                <img src="<?php echo e(asset('storage/' . $spot->image)); ?>" class="mt-2 h-20">
            <?php endif; ?>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" required rows="4" class="w-full px-4 py-2 border rounded-lg"><?php echo e($spot->description); ?></textarea>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Basic Information</label>
            <textarea name="basic_info" rows="4" class="w-full px-4 py-2 border rounded-lg"><?php echo e($spot->basic_info); ?></textarea>
        </div>
        
        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" <?php echo e($spot->is_active ? 'checked' : ''); ?> class="mr-2">
                <span>Active</span>
            </label>
        </div>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Update Tourist Spot</button>
        <a href="<?php echo e(route('admin.tourist-spots')); ?>" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/admin/tourist-spots/edit.blade.php ENDPATH**/ ?>