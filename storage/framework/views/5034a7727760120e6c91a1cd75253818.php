<?php $__env->startSection('title', 'Create Tourist Spot'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-6">Add New Tourist Spot</h1>

<form method="POST" action="<?php echo e(route('admin.tourist-spots.store')); ?>" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    <?php echo csrf_field(); ?>
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Name</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Category</label>
            <select name="category" required class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select Category</option>
                <option value="beach">Beach</option>
                <option value="mountain">Mountain</option>
                <option value="volcano">Volcano</option>
                <option value="marine">Marine</option>
                <option value="historical">Historical</option>
                <option value="cultural">Cultural</option>
                <option value="waterfall">Waterfall</option>
                <option value="nature">Nature</option>
                <option value="park">Park</option>
            </select>
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Entry Fee (PHP)</label>
            <input type="number" step="0.01" name="entry_fee" class="w-full px-4 py-2 border rounded-lg" placeholder="0.00">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Location</label>
            <input type="text" name="location" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Latitude</label>
            <input type="number" step="any" name="latitude" required class="w-full px-4 py-2 border rounded-lg" placeholder="13.6217">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Longitude</label>
            <input type="number" step="any" name="longitude" required class="w-full px-4 py-2 border rounded-lg" placeholder="123.9248">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Contact Number</label>
            <input type="text" name="contact_number" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Image</label>
            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" required rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Basic Information</label>
            <textarea name="basic_info" rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Save Tourist Spot</button>
        <a href="<?php echo e(route('admin.tourist-spots')); ?>" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/admin/tourist-spots/create.blade.php ENDPATH**/ ?>