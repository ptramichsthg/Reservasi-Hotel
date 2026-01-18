<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blue Haven Hotel - Hotel modern dengan kenyamanan premium dan desain futuristik">
    <link rel="icon" href="data:,">

    <title>{{ $title ?? 'Blue Haven Hotel' }}</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- AOS (Animate On Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        /* Navbar glass - tema cerah */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        }

        /* Button gradient */
        .btn-nav {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-nav:hover {
            transform: translateY(-2px);
        }

        /* Mobile menu */
        .mobile-menu {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
        }
    </style>
</head>

<body class="text-gray-900 flex flex-col min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">

{{-- NAVBAR --}}
<header class="fixed top-0 w-full z-50 navbar-glass" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- LOGO --}}
        <a href="/" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                <x-heroicon-o-building-office class="w-5 h-5 text-white" />
            </div>
            <span class="text-xl md:text-2xl font-bold bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Blue Haven</span>
        </a>

        {{-- NAVIGATION (Desktop) --}}
        <nav class="hidden md:flex items-center space-x-8">
            <a href="/" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Home</a>
            <a href="#fitur" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Fitur</a>
            <a href="#cta" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Booking</a>
            <a href="#contact" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Contact</a>
        </nav>

        {{-- ACTION BUTTONS (Desktop) --}}
        <div class="hidden md:flex items-center gap-3">
            <a href="{{ route('login') }}"
               class="btn-nav px-6 py-2.5 rounded-xl font-semibold text-blue-600 bg-white hover:bg-blue-50 shadow-md hover:shadow-lg transition-all">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="btn-nav px-6 py-2.5 rounded-xl font-semibold text-white bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 shadow-lg shadow-blue-500/30 transition-all">
                Daftar
            </a>
        </div>

        {{-- MOBILE MENU TOGGLE --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700 p-2">
            <x-heroicon-o-bars-3 x-show="!mobileMenuOpen" class="w-7 h-7" />
            <x-heroicon-o-x-mark x-show="mobileMenuOpen" class="w-7 h-7" style="display: none;" />
        </button>

    </div>

    {{-- MOBILE MENU --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden mobile-menu border-t border-gray-100"
         style="display: none;">
        <nav class="flex flex-col p-6 space-y-4">
            <a href="/" class="text-lg font-medium text-gray-700 hover:text-blue-600" @click="mobileMenuOpen = false">Home</a>
            <a href="#fitur" class="text-lg font-medium text-gray-700 hover:text-blue-600" @click="mobileMenuOpen = false">Fitur</a>
            <a href="#cta" class="text-lg font-medium text-gray-700 hover:text-blue-600" @click="mobileMenuOpen = false">Booking</a>
            <hr class="border-gray-200">
            <div class="flex flex-col gap-3 pt-2">
                <a href="{{ route('login') }}" class="w-full py-3 text-center bg-white text-blue-600 rounded-xl font-semibold shadow-md hover:bg-blue-50 transition-colors">
                    Login
                </a>
                <a href="{{ route('register') }}" class="w-full py-3 text-center bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl font-semibold">
                    Daftar Sekarang
                </a>
            </div>
        </nav>
    </div>
</header>

{{-- PAGE CONTENT --}}
<main class="flex-grow">
    @yield('content')
</main>

{{-- Initialize AOS --}}
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80,
    });
</script>

</body>
</html>
