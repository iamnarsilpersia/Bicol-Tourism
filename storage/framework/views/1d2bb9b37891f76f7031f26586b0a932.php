<?php $__env->startSection('title', 'Custom Tours'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-2xl font-bold mb-6">Custom Tour Bookings</h1>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">Tour Name</th>
                <th class="px-6 py-3 text-left">User</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">People</th>
                <th class="px-6 py-3 text-left">Total</th>
                <th class="px-6 py-3 text-left">Payment</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-t">
                <td class="px-6 py-4">
                    <div class="font-semibold"><?php echo e($tour->tour_name); ?></div>
                    <div class="text-xs text-gray-500"><?php echo e($tour->number_of_people); ?> people</div>
                </td>
                <td class="px-6 py-4"><?php echo e($tour->user->name ?? 'N/A'); ?></td>
                <td class="px-6 py-4"><?php echo e(\Carbon\Carbon::parse($tour->tour_date)->format('M d, Y')); ?></td>
                <td class="px-6 py-4">₱<?php echo e(number_format($tour->total_price, 2)); ?></td>
                <td class="px-6 py-4">
                    <div class="text-xs">
                        <span class="<?php if($tour->payment_method == 'full'): ?> text-green-600 <?php elseif($tour->payment_method == 'downpayment'): ?> text-yellow-600 <?php else: ?> text-gray-600 <?php endif; ?>">
                            <?php if($tour->payment_method == 'full'): ?> Full Payment
                            <?php elseif($tour->payment_method == 'downpayment'): ?> Downpayment
                            <?php else: ?> Pay on Arrival <?php endif; ?>
                        </span>
                        <?php if($tour->payment_mode): ?>
                        <span class="block text-gray-500"><?php echo e(strtoupper($tour->payment_mode)); ?></span>
                        <?php endif; ?>
                        <span class="block <?php if($tour->payment_status == 'paid'): ?> text-green-500 <?php elseif($tour->payment_status == 'partial'): ?> text-yellow-500 <?php else: ?> text-red-500 <?php endif; ?>">
                            <?php if($tour->payment_status == 'paid'): ?> ✅ Paid
                            <?php elseif($tour->payment_status == 'partial'): ?> 💰 Partial (<?php echo e(number_format($tour->downpayment_amount, 2)); ?>)
                            <?php else: ?> ⏳ Unpaid <?php endif; ?>
                        </span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-sm 
                        <?php if($tour->status == 'confirmed'): ?> bg-green-100 text-green-800
                        <?php elseif($tour->status == 'reserved'): ?> bg-blue-100 text-blue-800
                        <?php elseif($tour->status == 'cancelled'): ?> bg-red-100 text-red-800
                        <?php else: ?> bg-yellow-100 text-yellow-800 <?php endif; ?>">
                        <?php if($tour->status == 'confirmed'): ?> Confirmed (Paid)
                        <?php elseif($tour->status == 'reserved'): ?> Reserved (Partial)
                        <?php elseif($tour->status == 'cancelled'): ?> Cancelled
                        <?php else: ?> Pending <?php endif; ?>
                    </span>
                </td>
                <td class="px-6 py-4">
                    <?php
                        $paymentMethod = $tour->payment_method ?? 'on_arrival';
                        $canTakeAction = in_array($paymentMethod, ['on_arrival', 'downpayment']) || $paymentMethod === null;
                    ?>
                    <?php if($canTakeAction && ($tour->status == 'pending' || $tour->status == 'reserved')): ?>
                    <form method="POST" action="<?php echo e(route('admin.custom-tours.update-status', $tour->id)); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                            <option value="pending" <?php echo e($tour->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="confirmed" <?php echo e($tour->status == 'confirmed' ? 'selected' : ''); ?>>✅ Approve</option>
                            <option value="cancelled" <?php echo e($tour->status == 'cancelled' ? 'selected' : ''); ?>>❌ Decline</option>
                        </select>
                    </form>
                    <?php elseif($tour->status == 'pending'): ?>
                    <form method="POST" action="<?php echo e(route('admin.custom-tours.update-status', $tour->id)); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                            <option value="confirmed" <?php echo e($tour->status == 'confirmed' ? 'selected' : ''); ?>>✅ Approve</option>
                            <option value="cancelled" <?php echo e($tour->status == 'cancelled' ? 'selected' : ''); ?>>❌ Decline</option>
                        </select>
                    </form>
                    <?php else: ?>
                    <span class="text-gray-500">
                        <?php if($tour->status == 'confirmed'): ?> ✅ Approved
                        <?php elseif($tour->status == 'cancelled'): ?> ❌ Declined
                        <?php endif; ?>
                    </span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div class="mt-4">
    <?php echo e($tours->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/admin/custom-tours/index.blade.php ENDPATH**/ ?>