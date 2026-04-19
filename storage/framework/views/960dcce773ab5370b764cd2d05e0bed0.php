<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Bicol Tourism Guide'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero-bg {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.9), rgba(21, 101, 192, 0.8)), 
                        url('https://images.unsplash.com/photo-1531804055935-76f44d7c3621?w=1920') center/cover;
        }
        .card-hover:hover { transform: translateY(-5px); }
        .gradient-text {
            background: linear-gradient(90deg, #1e40af, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Top Bar -->
    <div class="bg-blue-900 text-white text-sm py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span>📍 Bicol Region, Philippines</span>
                <span>📞 +63 52 123 4567</span>
            </div>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-blue-200">About</a>
                <a href="#" class="hover:text-blue-200">Contact</a>
                <a href="#" class="hover:text-blue-200">Gallery</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-xl">🌋</span>
                    </div>
                    <a href="/" class="text-2xl font-bold text-gray-800">
                        <span class="gradient-text">Bicol</span> Tourism
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                    <a href="<?php echo e(route('public.tourist-spots')); ?>" class="text-gray-700 hover:text-blue-600 font-medium">Destinations</a>
                    <a href="<?php echo e(route('public.tour-packages')); ?>" class="text-gray-700 hover:text-blue-600 font-medium">Packages</a>
                    <a href="<?php echo e(route('public.map')); ?>" class="text-gray-700 hover:text-blue-600 font-medium">Map</a>
                    <a href="<?php echo e(route('public.nearby-places', ['lat' => 13.444, 'lng' => 123.75])); ?>" class="text-gray-700 hover:text-blue-600 font-medium">Nearby</a>
                </div>

                <div class="flex items-center space-x-4">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->role === 'user'): ?>
                            <a href="<?php echo e(route('public.book-tour')); ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 font-medium">Book Now</a>
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-700 hover:text-blue-600 font-medium">Admin Panel</a>
                        <?php endif; ?>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm"><?php echo e(substr(Auth::user()->name, 0, 1)); ?></span>
                            </div>
                            <span class="text-gray-700 text-sm"><?php echo e(Auth::user()->name); ?></span>
                        </div>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-gray-500 hover:text-red-600">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-blue-600 font-medium">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Button -->
    <div class="md:hidden bg-white border-t py-2 px-4 flex justify-around">
        <a href="/" class="text-gray-700 text-sm">Home</a>
        <a href="<?php echo e(route('public.tourist-spots')); ?>" class="text-gray-700 text-sm">Spots</a>
        <a href="<?php echo e(route('public.tour-packages')); ?>" class="text-gray-700 text-sm">Packages</a>
        <a href="<?php echo e(route('public.map')); ?>" class="text-gray-700 text-sm">Map</a>
    </div>

    <main>
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 mx-4 mt-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 mx-4 mt-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl">🌋</span>
                        </div>
                        <span class="text-xl font-bold">Bicol Tourism</span>
                    </div>
                    <p class="text-gray-400 text-sm">Discover the beauty of Bicol Region - from the iconic Mayon Volcano to pristine beaches and rich cultural heritage.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="<?php echo e(route('public.tourist-spots')); ?>" class="hover:text-white">Tourist Spots</a></li>
                        <li><a href="<?php echo e(route('public.tour-packages')); ?>" class="hover:text-white">Tour Packages</a></li>
                        <li><a href="<?php echo e(route('public.map')); ?>" class="hover:text-white">Interactive Map</a></li>
                        <li><a href="#" class="hover:text-white">Gallery</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>📍 Legazpi City, Albay</li>
                        <li>📞 +63 52 123 4567</li>
                        <li>✉️ info@bicoltourism.com</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700">FB</a>
                        <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500">TW</a>
                        <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700">IG</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; <?php echo e(date('Y')); ?> Bicol Tourism Guide. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
</body>
</html><?php /**PATH C:\Users\iamna\bicol-tourism\resources\views/layouts/app.blade.php ENDPATH**/ ?>