<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Blue Haven Hotel' }}</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- AOS (Animate On Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    {{-- ===============================
<<<<<<< HEAD
       GLOBAL STYLE (WELCOME ONLY)
=======
       /* GLOBAL STYLE (WELCOME ONLY) */
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
    =============================== --}}
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background: linear-gradient(130deg, #dff4ff, #cfeaff, #d0e9ff);
            background-size: 300% 300%;
            animation: rgbShift 10s ease infinite;
            overflow-x: hidden;
        }

        @keyframes rgbShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        /* RGB Border */
        .rgb-border {
            border: 2px solid transparent;
            background:
                linear-gradient(#ffffff00, #ffffff00) padding-box,
                linear-gradient(120deg, #00d0ff, #0077ff, #00ffe5, #009dff) border-box;
        }

        /* Soft Colorful Glassmorphism */
        .glass-vibrant {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* Neon Effect (Softer) */
        .neon-glow-soft {
            box-shadow: 0 0 20px rgba(0, 180, 255, 0.25);
        }

        .neon-glow-colorful {
            box-shadow: 0 0 25px rgba(168, 85, 247, 0.2);
        }
    </style>
</head>

<body class="font-sans text-gray-900 flex flex-col min-h-screen">

{{-- ======================================================
<<<<<<< HEAD
   NAVBAR (PUBLIC / WELCOME ONLY)
=======
   /* NAVBAR (PUBLIC / WELCOME ONLY) */
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
====================================================== --}}
<header class="fixed top-0 w-full z-50 glass rgb-border rounded-b-3xl shadow-2xl" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between relative">

        {{-- LOGO --}}
        <h1 class="text-2xl md:text-3xl font-extrabold tracking-wide bg-gradient-to-r
                   from-blue-600 to-cyan-400 bg-clip-text text-transparent drop-shadow">
            Blue Haven Hotel
        </h1>

        {{-- NAVIGATION --}}
        <nav class="hidden md:flex space-x-10 text-lg font-semibold">
            <a href="/" class="hover:text-blue-600 transition">Home</a>
            <a href="#fitur" class="hover:text-blue-600 transition">Fitur</a>
            <a href="#cta" class="hover:text-blue-600 transition">Booking</a>
        </nav>

        {{-- ACTION BUTTON (Desktop) --}}
        <div class="hidden md:flex items-center gap-4">
            <a href="{{ route('login') }}"
               class="px-7 py-2.5 rounded-xl font-bold text-white
                      bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500
                      glass-vibrant shadow-[0_0_20px_rgba(37,99,235,0.3)] hover:scale-105 hover:from-blue-700 hover:to-cyan-600
                      transition-all duration-300 active:scale-95">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-7 py-2.5 rounded-xl font-bold text-white
                      bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-500
                      glass-vibrant shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:scale-105 hover:from-indigo-700 hover:to-purple-700
                      transition-all duration-300 active:scale-95">
                Daftar
            </a>
        </div>

        {{-- MOBILE MENU TOGGLE --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-blue-600 p-2 focus:outline-none">
            <span class="material-symbols-outlined text-[32px]" x-show="!mobileMenuOpen">menu</span>
            <span class="material-symbols-outlined text-[32px]" x-show="mobileMenuOpen" style="display: none;">close</span>
        </button>

    </div>

    {{-- MOBILE MENU OVERLAY --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-full"
         class="md:hidden bg-white/90 backdrop-blur-xl border-t border-blue-100 shadow-2xl absolute top-full left-0 w-full z-40"
         style="display: none;">
        <nav class="flex flex-col p-6 space-y-4 text-center">
            <a href="/" class="text-xl font-bold text-gray-800 hover:text-blue-600" @click="mobileMenuOpen = false">Home</a>
            <a href="#fitur" class="text-xl font-bold text-gray-800 hover:text-blue-600" @click="mobileMenuOpen = false">Fitur</a>
            <a href="#cta" class="text-xl font-bold text-gray-800 hover:text-blue-600" @click="mobileMenuOpen = false">Booking</a>
            <hr class="border-blue-50">
            <div class="flex flex-col gap-3">
                <a href="{{ route('login') }}" class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold text-lg">Login</a>
                <a href="{{ route('register') }}" class="w-full py-3 bg-indigo-600 text-white rounded-xl font-bold text-lg">Daftar</a>
            </div>
        </nav>
    </div>
</header>

{{-- ======================================================
<<<<<<< HEAD
   PAGE CONTENT
=======
   /* PAGE CONTENT */
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
====================================================== --}}
<main class="flex-grow pt-28">
    @yield('content')
</main>

{{-- ======================================================
<<<<<<< HEAD
   OPTIONAL FOOTER SLOT
=======
   /* OPTIONAL FOOTER SLOT */
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
====================================================== --}}
@hasSection('footer')
<footer>
    @yield('footer')
</footer>
@endif

{{-- Initialize AOS --}}
<script>
    AOS.init({
        duration: 1000,
        easing: 'ease-out-cubic',
        once: true,
        offset: 100,
        delay: 100,
    });
</script>

</body>
</html>
