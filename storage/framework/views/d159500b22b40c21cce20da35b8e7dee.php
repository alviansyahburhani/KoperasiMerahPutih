<nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="<?php echo e(route('landing.index')); ?>" class="flex items-center">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($landing) && $landing->logo): ?>
                        <img src="<?php echo e(Storage::url($landing->logo)); ?>" alt="Logo" class="h-10 w-auto">
                    <?php else: ?>
                        <span class="text-2xl font-bold text-blue-600">KoperasiHub</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="<?php echo e(route('landing.index')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium <?php echo e(request()->routeIs('landing.index') ? 'text-blue-600' : ''); ?>">
                    Beranda
                </a>
                <a href="<?php echo e(route('landing.about')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium <?php echo e(request()->routeIs('landing.about') ? 'text-blue-600' : ''); ?>">
                    Tentang
                </a>
                <a href="<?php echo e(route('landing.features')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium <?php echo e(request()->routeIs('landing.features') ? 'text-blue-600' : ''); ?>">
                    Fitur
                </a>
                <a href="<?php echo e(route('landing.pricing')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium <?php echo e(request()->routeIs('landing.pricing') ? 'text-blue-600' : ''); ?>">
                    Harga
                </a>
                <a href="<?php echo e(route('landing.blog')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium <?php echo e(request()->routeIs('landing.blog*') ? 'text-blue-600' : ''); ?>">
                    Blog
                </a>
                <a href="<?php echo e(route('landing.contact')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium <?php echo e(request()->routeIs('landing.contact') ? 'text-blue-600' : ''); ?>">
                    Kontak
                </a>
            </div>

            <!-- CTA Buttons -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                <a href="/admin/login" class="text-gray-700 hover:text-blue-600 px-4 py-2 text-sm font-medium">
                    Login
                </a>
                <a href="<?php echo e(route('landing.register')); ?>" class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    Daftar Koperasi
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-blue-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="md:hidden bg-white border-t">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="<?php echo e(route('landing.index')); ?>" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Beranda</a>
            <a href="<?php echo e(route('landing.about')); ?>" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Tentang</a>
            <a href="<?php echo e(route('landing.features')); ?>" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Fitur</a>
            <a href="<?php echo e(route('landing.pricing')); ?>" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Harga</a>
            <a href="<?php echo e(route('landing.blog')); ?>" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Blog</a>
            <a href="<?php echo e(route('landing.contact')); ?>" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Kontak</a>
            <a href="/admin/login" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Login</a>
            <a href="<?php echo e(route('landing.register')); ?>" class="block px-3 py-2 bg-blue-600 text-white rounded-md text-center font-medium">Daftar Koperasi</a>
        </div>
    </div>
</nav><?php /**PATH D:\SEMESTER 6\PRJCT-MAGANG\KoperasiMerahPutih\resources\views/landing/partials/navbar.blade.php ENDPATH**/ ?>