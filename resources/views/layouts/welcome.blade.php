<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Blue Haven Hotel' }}</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- AOS (Animate On Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    {{-- ===============================
       🎨 GLOBAL STYLE (WELCOME ONLY)
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

        /* Neon Effect */
        .neon-glow {
            box-shadow: 0 0 25px rgba(0, 180, 255, 0.45);
        }
    </style>
</head>

<body class="font-sans text-gray-900 flex flex-col min-h-screen">

{{-- ======================================================
   🔵 NAVBAR (PUBLIC / WELCOME ONLY)
====================================================== --}}
<header class="fixed top-0 w-full z-50 glass rgb-border rounded-b-3xl shadow-2xl">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- LOGO --}}
        <h1 class="text-3xl font-extrabold tracking-wide bg-gradient-to-r
                   from-blue-600 to-cyan-400 bg-clip-text text-transparent drop-shadow">
            Blue Haven Hotel
        </h1>

        {{-- NAVIGATION --}}
        <nav class="hidden md:flex space-x-10 text-lg font-semibold">
            <a href="/" class="hover:text-blue-600 transition">Home</a>
            <a href="#fitur" class="hover:text-blue-600 transition">Fitur</a>
            <a href="#cta" class="hover:text-blue-600 transition">Booking</a>
        </nav>

        {{-- ACTION BUTTON --}}
        <div class="flex space-x-4">
            <a href="{{ route('login') }}"
               class="px-6 py-2 rounded-2xl font-bold text-white
                      bg-gradient-to-r from-blue-600 to-cyan-500
                      shadow-lg hover:scale-105 transition neon-glow">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-6 py-2 rounded-2xl font-bold text-blue-700
                      glass rgb-border shadow-lg hover:scale-105 transition">
                Daftar
            </a>
        </div>

    </div>
</header>

{{-- ======================================================
   🧩 PAGE CONTENT
====================================================== --}}
<main class="flex-grow pt-28">
    @yield('content')
</main>

{{-- ======================================================
   🔻 OPTIONAL FOOTER SLOT
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
