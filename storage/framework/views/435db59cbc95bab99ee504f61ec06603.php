

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                    <?php echo e($landing->hero_title ?? 'Sistem Manajemen Koperasi Terintegrasi'); ?>

                </h1>
                <p class="text-xl text-red-100 mb-8">
                    <?php echo e($landing->hero_subtitle ?? 'Platform modern untuk mengelola koperasi Anda dengan mudah, cepat, dan efisien'); ?>

                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo e(route('landing.register')); ?>" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        <?php echo e($landing->hero_cta_text ?? 'Daftar Sekarang'); ?>

                    </a>
                    <a href="<?php echo e(route('landing.features')); ?>" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                        Lihat Fitur
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($landing) && $landing->hero_image): ?>
                    <img src="<?php echo e(Storage::url($landing->hero_image)); ?>" alt="Hero" class="rounded-lg shadow-2xl">
                <?php else: ?>
                    <img src="https://via.placeholder.com/600x400/3B82F6/FFFFFF?text=Koperasi+Management" alt="Hero" class="rounded-lg shadow-2xl">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Wave Bottom -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#F9FAFB"/>
        </svg>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <div class="text-4xl font-bold text-blue-600 mb-2"><?php echo e($landing->stat_koperasi ?? 0); ?>+</div>
                <div class="text-gray-600">Koperasi Terdaftar</div>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <div class="text-4xl font-bold text-blue-600 mb-2"><?php echo e(number_format($landing->stat_anggota ?? 0)); ?>+</div>
                <div class="text-gray-600">Anggota Aktif</div>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <div class="text-4xl font-bold text-blue-600 mb-2">Rp <?php echo e(number_format($landing->stat_transaksi ?? 0)); ?></div>
                <div class="text-gray-600">Total Transaksi</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                <?php echo e($landing->features_title ?? 'Fitur Unggulan'); ?>

            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                <?php echo e($landing->features_subtitle ?? 'Solusi lengkap untuk kebutuhan manajemen koperasi modern'); ?>

            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Manajemen Anggota</h3>
                <p class="text-gray-600">Kelola data anggota, pengurus, dan pengawas dengan mudah dan terstruktur</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Simpan & Pinjam</h3>
                <p class="text-gray-600">Sistem simpanan dan pinjaman yang terintegrasi dengan perhitungan bunga otomatis</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Laporan & Notulen</h3>
                <p class="text-gray-600">Buat laporan keuangan dan notulen rapat dengan format yang rapi dan profesional</p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Inventaris</h3>
                <p class="text-gray-600">Catat dan monitor aset inventaris koperasi secara digital</p>
            </div>

            <!-- Feature 5 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Keamanan Data</h3>
                <p class="text-gray-600">Data koperasi terlindungi dengan enkripsi dan backup otomatis</p>
            </div>

            <!-- Feature 6 -->
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Multi-Tenant</h3>
                <p class="text-gray-600">Setiap koperasi memiliki database dan sistem terpisah yang aman</p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="<?php echo e(route('landing.features')); ?>" class="text-blue-600 font-semibold hover:text-blue-700 inline-flex items-center">
                Lihat Semua Fitur
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonials->count() > 0): ?>
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Testimoni Pengguna
            </h2>
            <p class="text-xl text-gray-600">
                Apa kata mereka tentang platform kami
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <div class="flex items-center mb-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < 5; $i++): ?>
                        <svg class="w-5 h-5 <?php echo e($i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-300'); ?>" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <p class="text-gray-600 mb-6"><?php echo e($testimonial->content); ?></p>
                <div class="flex items-center">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonial->avatar): ?>
                        <img src="<?php echo e(Storage::url($testimonial->avatar)); ?>" alt="<?php echo e($testimonial->name); ?>" class="w-12 h-12 rounded-full mr-4">
                    <?php else: ?>
                        <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center mr-4 font-semibold">
                            <?php echo e(substr($testimonial->name, 0, 1)); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div>
                        <div class="font-semibold text-gray-900"><?php echo e($testimonial->name); ?></div>
                        <div class="text-sm text-gray-600"><?php echo e($testimonial->position); ?> - <?php echo e($testimonial->koperasi); ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<!-- CTA Section -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            Siap Transformasi Digital Koperasi Anda?
        </h2>
        <p class="text-xl text-red-100 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan ratusan koperasi yang telah merasakan kemudahan mengelola koperasi secara digital
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?php echo e(route('landing.register')); ?>" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Daftar Gratis Sekarang
            </a>
            <a href="<?php echo e(route('landing.contact')); ?>" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('landing.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SEMESTER 6\PRJCT-MAGANG\KoperasiMerahPutih\resources\views/landing/index.blade.php ENDPATH**/ ?>