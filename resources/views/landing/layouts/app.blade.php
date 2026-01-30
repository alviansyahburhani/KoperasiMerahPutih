<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? 'Sistem Manajemen Koperasi' }} - KoperasiHub</title>
    
    @if(isset($landing))
    <meta name="description" content="{{ $landing->meta_description ?? 'Platform manajemen koperasi modern dan terintegrasi' }}">
    <meta name="keywords" content="{{ $landing->meta_keywords ?? 'koperasi, manajemen koperasi, sistem koperasi' }}">
    @endif

    @if(isset($landing) && $landing->favicon)
    <link rel="icon" href="{{ Storage::url($landing->favicon) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-white">
    
    <!-- Navbar -->
    @include('landing.partials.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('landing.partials.footer')

    <!-- Scripts -->
    @stack('scripts')
    
    <!-- Success/Error Messages -->
    @if(session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
         x-transition
         class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
         x-transition
         class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
        {{ session('error') }}
    </div>
    @endif
</body>
</html>