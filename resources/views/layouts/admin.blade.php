<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin BlueHaven Hotel' }}</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* ===============================
           BACKGROUND GRADIENT
        =============================== */
        body {
            background: linear-gradient(135deg, #3b82f6, #ffffff, #a855f7);
            background-size: 400% 400%;
            animation: gradientFlow 10s ease infinite;
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ===============================
           GLASS EFFECT
        =============================== */
        .glass {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        /* ===============================
           SIDEBAR STYLE
        =============================== */
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1rem;
            border-radius: .75rem;
            transition: all .25s ease;
            font-weight: 500;
        }

        .sidebar-item:hover {
            background: rgba(59,130,246,.15);
            transform: translateX(6px);
        }

        .sidebar-active {
            background: linear-gradient(135deg,#2563eb,#3b82f6);
            color: #fff;
            box-shadow: 0 10px 25px rgba(37,99,235,.45);
        }
    </style>
</head>

<body class="min-h-screen flex">

@if(Auth::check() && Auth::user()->role === 'admin')
<!-- ===================== SIDEBAR ===================== -->
<aside class="w-64 h-screen fixed left-0 top-0 z-40
              bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900
              text-slate-200 shadow-2xl">

    {{-- BRAND --}}
    <div class="flex items-center gap-3 px-6 py-6 border-b border-white/10">
        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-xs">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <span class="text-lg font-extrabold tracking-wide">Laravel Hotel</span>
    </div>

    {{-- USER INFO --}}
    <div class="px-6 py-4 border-b border-white/10">
        <p class="font-semibold">{{ Auth::user()->name }}</p>
        <p class="text-xs text-slate-400">Administrator</p>
    </div>

    {{-- MENU --}}
    <nav class="px-4 py-5 space-y-6 text-sm overflow-y-auto" style="max-height: calc(100vh - 250px);">

        <p class="px-3 text-xs text-slate-400 uppercase tracking-wider">
            Ringkasan
        </p>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <p class="px-3 pt-4 text-xs text-slate-400 uppercase tracking-wider">
            Manajemen
        </p>

        <a href="{{ route('admin.kamar.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.kamar.*') ? 'sidebar-active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Kelola Kamar</span>
        </a>

        <a href="{{ route('admin.orders.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.orders.*') ? 'sidebar-active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span>Data Reservasi</span>
        </a>

        <a href="{{ route('admin.payment.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.payment.*') ? 'sidebar-active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span>Verifikasi Pembayaran</span>
        </a>

        <a href="{{ route('admin.users.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'sidebar-active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span>Kelola Admin</span>
        </a>

        <p class="px-3 pt-4 text-xs text-slate-400 uppercase tracking-wider">
            Laporan
        </p>

        <a href="{{ route('admin.laporan.transaksi') }}"
           class="sidebar-item {{ request()->routeIs('admin.laporan.transaksi') ? 'sidebar-active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span>Laporan Transaksi</span>
        </a>

        <a href="{{ route('admin.laporan.kamar') }}"
           class="sidebar-item {{ request()->routeIs('admin.laporan.kamar') ? 'sidebar-active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <span>Laporan Kamar</span>
        </a>

    </nav>

    {{-- LOGOUT --}}
    <div class="absolute bottom-6 left-4 right-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                class="w-full py-3 rounded-xl bg-red-600 text-white font-semibold
                       hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
</aside>
@endif

<!-- ===================== MAIN CONTENT ===================== -->
<main class="flex-1 ml-64">

    {{-- TOP BAR --}}
    <div class="flex justify-end items-center px-10 py-6">
        @includeIf('partials.navbar-notification')
    </div>

    {{-- PAGE CONTENT --}}
    <div class="px-10 pb-10">
        @yield('content')
    </div>

</main>

</body>
</html>
