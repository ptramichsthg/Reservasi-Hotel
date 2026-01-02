<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Reservasi Hotel' }}</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* ===============================
           BACKGROUND
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

@if(Auth::check())
<!-- ===================== SIDEBAR ===================== -->
<aside class="w-64 h-screen fixed left-0 top-0 z-40
              bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900
              text-slate-200 shadow-2xl">

    {{-- BRAND --}}
    <div class="flex items-center gap-3 px-6 py-6 border-b border-white/10">
        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold">
            <span class="material-symbols-outlined text-[20px]">hotel</span>
        </div>
        <span class="text-lg font-extrabold tracking-wide">Laravel Hotel</span>
    </div>

    {{-- USER INFO --}}
    <div class="px-6 py-4 border-b border-white/10">
        <p class="font-semibold">{{ Auth::user()->name }}</p>
        <p class="text-xs text-slate-400 capitalize">{{ Auth::user()->role }}</p>
    </div>

    {{-- MENU --}}
    <nav class="px-4 py-5 space-y-6 text-sm overflow-y-auto">

        {{-- =====================
            MENU ADMIN
        ===================== --}}
        @if(Auth::user()->role === 'admin')

            <p class="px-3 text-xs text-slate-400 uppercase tracking-wider">
                Ringkasan
            </p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}">
                <span class="material-symbols-outlined text-[18px]">dashboard</span> Dashboard
            </a>

            <p class="px-3 pt-4 text-xs text-slate-400 uppercase tracking-wider">
                Operasional
            </p>

            <a href="{{ route('admin.kamar.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.kamar.*') ? 'sidebar-active' : '' }}">
                <span class="material-symbols-outlined text-[18px]">hotel</span> Manajemen Kamar
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.orders.*') ? 'sidebar-active' : '' }}">
                <span class="material-symbols-outlined text-[18px]">receipt_long</span> Data Reservasi
            </a>

            <a href="{{ route('admin.payment.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.payment.*') ? 'sidebar-active' : '' }}">
                <span class="material-symbols-outlined text-[18px]">payments</span> Pembayaran
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'sidebar-active' : '' }}">
                <span class="material-symbols-outlined text-[18px]">group</span> Manajemen Pengguna
            </a>

        @endif

        {{-- =====================
            MENU TAMU
        ===================== --}}
        @if(Auth::user()->role === 'tamu')

            <p class="px-3 text-xs text-slate-400 uppercase tracking-wider">
                Ringkasan
            </p>

            <a href="{{ route('tamu.dashboard') }}"
               class="sidebar-item {{ request()->routeIs('tamu.dashboard') ? 'sidebar-active' : '' }}">
                <span class="material-symbols-outlined text-[18px]">home</span> Dashboard
            </a>

            <p class="px-3 pt-4 text-xs text-slate-400 uppercase tracking-wider">
                Pemesanan
            </p>

            <a href="{{ route('tamu.kamar.list') }}"
               class="sidebar-item {{ request()->routeIs('tamu.kamar.list') ? 'sidebar-active' : '' }}">
                <span class="material-symbols-outlined text-[18px]">search</span> Cari Kamar
            </a>

            <a href="{{ route('tamu.orders.history') }}"
               class="sidebar-item {{ request()->routeIs('tamu.orders.history') ? 'sidebar-active' : '' }}">
                <span class="material-symbols-outlined text-[18px]">history</span> Riwayat Reservasi
            </a>

        @endif
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
