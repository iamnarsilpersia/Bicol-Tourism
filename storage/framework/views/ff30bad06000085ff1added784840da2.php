<?php $__env->startSection('title', 'User Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-3xl font-bold mb-8">Welcome, <?php echo e(Auth::user()->name); ?>!</h1>

<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">My Reservations</h3>
        <p class="text-3xl font-bold"><?php echo e($myReservations->count()); ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">My Appointments</h3>
        <p class="text-3xl font-bold"><?php echo e($myAppointments->count()); ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Tour Guide Bookings</h3>
        <p class="text-3xl font-bold"><?php echo e($myGuideBookings->count()); ?></p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Custom Tours</h3>
        <p class="text-3xl font-bold"><?php echo e($myCustomTours->count()); ?></p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">My Reservations</h2>
            <a href="<?php echo e(route('user.tour-packages')); ?>" class="text-blue-600 hover:text-blue-800">Book New</a>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $myReservations->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="border-b py-3">
            <div class="flex justify-between">
                <span class="font-semibold"><?php echo e($reservation->tourPackage->name); ?></span>
                <span class="px-2 py-1 rounded text-sm 
                    <?php if($reservation->status == 'pending'): ?> bg-yellow-100 text-yellow-800
                    <?php elseif($reservation->status == 'confirmed'): ?> bg-blue-100 text-blue-800
                    <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>">
                    <?php echo e(ucfirst($reservation->status)); ?>

                </span>
            </div>
            <p class="text-sm text-gray-600"><?php echo e($reservation->reservation_date->format('M d, Y')); ?> - <?php echo e($reservation->number_of_people); ?> people</p>
            <p class="text-sm">
                <span class="font-bold">₱<?php echo e(number_format($reservation->total_price, 2)); ?></span>
                <?php if($reservation->payment_method == 'full'): ?>
                    <span class="ml-2 text-green-600">| Full Payment via <?php echo e(strtoupper($reservation->payment_mode)); ?></span>
                <?php elseif($reservation->payment_method == 'downpayment'): ?>
                    <span class="ml-2 text-yellow-600">| Downpayment: ₱<?php echo e(number_format($reservation->downpayment_amount, 2)); ?></span>
                <?php else: ?>
                    <span class="ml-2 text-gray-500">| Pay on Arrival</span>
                <?php endif; ?>
                <span class="ml-2 px-2 py-0.5 rounded text-xs
                    <?php if($reservation->payment_status == 'paid'): ?> bg-green-200 text-green-800
                    <?php elseif($reservation->payment_status == 'partial'): ?> bg-yellow-200 text-yellow-800
                    <?php else: ?> bg-gray-200 text-gray-800 <?php endif; ?>">
                    <?php if($reservation->payment_status == 'paid'): ?> Paid
                    <?php elseif($reservation->payment_status == 'partial'): ?> Partial
                    <?php else: ?> Unpaid <?php endif; ?>
                </span>
            </p>
            <?php if($reservation->status == 'pending'): ?>
                <form action="<?php echo e(route('user.reservations.cancel', $reservation->id)); ?>" method="POST" class="mt-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Cancel</button>
                </form>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-gray-500">No reservations yet.</p>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">My Appointments</h2>
            <a href="<?php echo e(route('user.appointments.create')); ?>" class="text-blue-600 hover:text-blue-800">New Appointment</a>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $myAppointments->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="border-b py-3">
            <div class="flex justify-between">
                <span class="font-semibold"><?php echo e($appointment->title); ?></span>
                <span class="px-2 py-1 rounded text-sm 
                    <?php if($appointment->status == 'pending'): ?> bg-yellow-100 text-yellow-800
                    <?php elseif($appointment->status == 'confirmed'): ?> bg-blue-100 text-blue-800
                    <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>">
                    <?php echo e(ucfirst($appointment->status)); ?>

                </span>
            </div>
            <p class="text-sm text-gray-600"><?php echo e($appointment->appointment_date->format('M d, Y h:i A')); ?></p>
            <?php if($appointment->status == 'pending'): ?>
                <form action="<?php echo e(route('user.appointments.cancel', $appointment->id)); ?>" method="POST" class="mt-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Cancel</button>
                </form>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-gray-500">No appointments yet.</p>
        <?php endif; ?>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Tour Guide Bookings</h2>
        <a href="<?php echo e(route('user.tour-guides')); ?>" class="text-blue-600 hover:text-blue-800">Book Guide</a>
    </div>
    <?php $__empty_1 = true; $__currentLoopData = $myGuideBookings->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="border-b py-3">
        <div class="flex justify-between">
            <span class="font-semibold"><?php echo e($booking->tourGuide->name); ?></span>
            <span class="px-2 py-1 rounded text-sm 
                <?php if($booking->status == 'pending'): ?> bg-yellow-100 text-yellow-800
                <?php elseif($booking->status == 'confirmed'): ?> bg-blue-100 text-blue-800
                <?php else: ?> bg-red-100 text-red-800 <?php endif; ?>">
                <?php echo e(ucfirst($booking->status)); ?>

            </span>
        </div>
        <p class="text-sm text-gray-600"><?php echo e($booking->booking_date->format('M d, Y')); ?> - <?php echo e($booking->days); ?> days</p>
        <p class="text-sm">
            <span class="font-bold">₱<?php echo e(number_format($booking->total_amount, 2)); ?></span>
            <?php if($booking->payment_method == 'full'): ?>
                <span class="ml-2 text-green-600">| Full Payment via <?php echo e(strtoupper($booking->payment_mode)); ?></span>
            <?php elseif($booking->payment_method == 'downpayment'): ?>
                <span class="ml-2 text-yellow-600">| Downpayment: ₱<?php echo e(number_format($booking->downpayment_amount, 2)); ?></span>
            <?php else: ?>
                <span class="ml-2 text-gray-500">| Pay on Arrival</span>
            <?php endif; ?>
            <span class="ml-2 px-2 py-0.5 rounded text-xs
                <?php if($booking->payment_status == 'paid'): ?> bg-green-200 text-green-800
                <?php elseif($booking->payment_status == 'partial'): ?> bg-yellow-200 text-yellow-800
                <?php else: ?> bg-gray-200 text-gray-800 <?php endif; ?>">
                <?php if($booking->payment_status == 'paid'): ?> Paid
                <?php elseif($booking->payment_status == 'partial'): ?> Partial
                <?php else: ?> Unpaid <?php endif; ?>
            </span>
        </p>
        <?php if($booking->status == 'pending'): ?>
            <form action="<?php echo e(route('user.tour-guide-bookings.cancel', $booking->id)); ?>" method="POST" class="mt-2">
                <?php echo csrf_field(); ?>
                <button type="submit" class="text-sm text-red-600 hover:text-red-800">Cancel</button>
            </form>
        <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p class="text-gray-500">No tour guide bookings yet.</p>
    <?php endif; ?>
</div>

<div class="bg-white rounded-lg shadow p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Custom Tours</h2>
        <a href="<?php echo e(route('public.book-tour')); ?>" class="text-blue-600 hover:text-blue-800">Book New Tour</a>
    </div>
<?php $__empty_1 = true; $__currentLoopData = $myCustomTours->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="border-b py-3">
        <div class="flex justify-between items-center">
            <span class="font-semibold"><?php echo e($tour->tour_name); ?></span>
            <div class="flex items-center space-x-2">
                <span class="px-2 py-1 rounded text-sm 
                    <?php if($tour->status == 'pending'): ?> bg-yellow-100 text-yellow-800
                    <?php elseif($tour->status == 'confirmed'): ?> bg-green-100 text-green-800
                    <?php elseif($tour->status == 'reserved'): ?> bg-blue-100 text-blue-800
                    <?php elseif($tour->status == 'cancelled'): ?> bg-red-100 text-red-800
                    <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                    <?php echo e(ucfirst($tour->status)); ?>

                </span>
                <span class="px-2 py-1 rounded text-xs
                    <?php if($tour->payment_status == 'paid'): ?> bg-green-200 text-green-800
                    <?php elseif($tour->payment_status == 'partial'): ?> bg-yellow-200 text-yellow-800
                    <?php else: ?> bg-gray-200 text-gray-800 <?php endif; ?>">
                    <?php if($tour->payment_status == 'paid'): ?> Paid
                    <?php elseif($tour->payment_status == 'partial'): ?> Partial
                    <?php else: ?> Unpaid <?php endif; ?>
                </span>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-1"><?php echo e(\Carbon\Carbon::parse($tour->tour_date)->format('M d, Y')); ?> - <?php echo e($tour->number_of_people); ?> people</p>
        <p class="text-sm text-gray-600">
            <span class="text-green-600 font-bold">Total: ₱<?php echo e(number_format($tour->total_price, 2)); ?></span>
            <?php if($tour->payment_method == 'full'): ?>
                <span class="ml-2 text-blue-600">| Full Payment via <?php echo e(strtoupper($tour->payment_mode)); ?></span>
            <?php elseif($tour->payment_method == 'downpayment'): ?>
                <span class="ml-2 text-yellow-600">| Downpayment: ₱<?php echo e(number_format($tour->downpayment_amount, 2)); ?> (<?php echo e(strtoupper($tour->payment_mode)); ?>)</span>
            <?php else: ?>
                <span class="ml-2 text-gray-500">| Pay on Arrival</span>
            <?php endif; ?>
        </p>
        
        <?php if($tour->payment_method == 'downpayment' && ($tour->payment_status == 'partial' || $tour->status == 'reserved')): ?>
            <div class="mt-2 p-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-yellow-800 font-medium">💰 Balance to pay on arrival: <strong>₱<?php echo e(number_format($tour->total_price - $tour->downpayment_amount, 2)); ?></strong></p>
            </div>
        <?php endif; ?>
        
        <?php if($tour->payment_method == 'on_arrival' && $tour->status == 'pending'): ?>
            <form action="<?php echo e(route('user.custom-tours.cancel', $tour->id)); ?>" method="POST" class="mt-2">
                <?php echo csrf_field(); ?>
                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Are you sure you want to cancel this booking?')">
                    ❌ Cancel Booking
                </button>
            </form>
        <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p class="text-gray-500">No custom tours yet. <a href="<?php echo e(route('public.book-tour')); ?>" class="text-blue-600">Book your first tour!</a></p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/user/dashboard.blade.php ENDPATH**/ ?>