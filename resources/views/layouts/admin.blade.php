<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Admin' }} | Blue Haven</title>

    {{-- Tailwind & Google Fonts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Ant Design Icons & Symbols --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        ant: {
                            primary: '#1677ff',
                            primaryHover: '#4096ff',
                            bg: '#f5f5f5',
                            text: 'rgba(0, 0, 0, 0.88)',
                            textSecondary: 'rgba(0, 0, 0, 0.45)',
                            border: '#d9d9d9',
                            borderSplit: '#f0f0f0',
                        }
                    },
                    borderRadius: {
                        'ant': '6px',
                    }
                }
            }
        }
    </script>

    <style>
<<<<<<< HEAD
=======
        /* ===============================
           BACKGROUND GRADIENT
        =============================== */
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
        body {
            background-color: #f5f5f5;
            color: rgba(0, 0, 0, 0.88);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .ant-sider {
            background: #001529;
            width: 256px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

<<<<<<< HEAD
        @media (max-width: 1024px) {
            .ant-sider {
                transform: translateX(-100%);
            }
            .ant-sider.open {
                transform: translateX(0);
            }
        }

        .ant-menu-item {
            height: 40px;
            line-height: 40px;
            margin-top: 4px;
            margin-bottom: 4px;
            padding: 0 16px;
            border-radius: 8px;
            transition: all 0.2s;
=======
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
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.65);
            margin-left: 4px;
            margin-right: 4px;
        }

        .ant-menu-item:hover {
            color: #fff;
        }

        .ant-menu-item-selected {
            background-color: #1677ff;
            color: #fff !important;
        }

        .ant-menu-group {
            padding: 12px 16px 8px;
            color: rgba(255, 255, 255, 0.45);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .ant-header {
            background: #fff;
            height: 64px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            border-bottom: 1px solid #f0f0f0;
        }

        .ant-layout-content {
            margin-left: 256px;
            padding-top: 64px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 1024px) {
            .ant-layout-content {
                margin-left: 0;
            }
        }

        .ant-card {
            background: #fff;
            border-radius: 8px;
            border: 1px solid #f0f0f0;
            transition: all 0.3s;
        }

        .ant-card:hover {
            box-shadow: 0 1px 2px -2px rgba(0, 0, 0, 0.16), 0 3px 6px 0 rgba(0, 0, 0, 0.12), 0 5px 12px 4px rgba(0, 0, 0, 0.09);
        }

        .ant-btn-primary {
            background-color: #1677ff;
            color: #fff;
            border: 1px solid #1677ff;
            border-radius: 6px;
            height: 32px;
            padding: 4px 15px;
            font-size: 14px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .ant-btn-primary:hover {
            background-color: #4096ff;
            border-color: #4096ff;
        }

        .ant-btn-danger {
            background-color: #ff4d4f;
            color: #fff;
            border: 1px solid #ff4d4f;
            border-radius: 6px;
            height: 32px;
            padding: 4px 15px;
            font-size: 14px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .ant-btn-danger:hover {
            background-color: #ff7875;
            border-color: #ff7875;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 20px;
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }" :class="{ 'overflow-hidden': sidebarOpen }">

<<<<<<< HEAD
    @if(Auth::check() && Auth::user()->role === 'admin')
    
    {{-- BAGIAN SIDEBAR (NAVIGASI SAMPING) --}}
    <aside class="ant-sider shadow-xl" :class="{ 'open': sidebarOpen }">
        <div class="h-16 flex items-center px-6 mb-4 border-b border-white/10">
            <div class="w-8 h-8 bg-ant-primary rounded-lg flex items-center justify-center text-white font-bold mr-3 shadow-lg">
                <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
            </div>
            <span class="text-white font-bold text-lg tracking-tight">Admin Panel</span>
=======
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
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
        </div>

        <nav class="px-3 pb-24">
            <div class="ant-menu-group">Dashboard</div>
            <a href="{{ route('admin.dashboard') }}" 
               class="ant-menu-item {{ request()->routeIs('admin.dashboard') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-medium">Ringkasan</span>
            </a>

            <div class="ant-menu-group mt-6">Operasional</div>
            <a href="{{ route('admin.kamar.index') }}" 
               class="ant-menu-item {{ request()->routeIs('admin.kamar.*') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">hotel</span>
                <span class="text-sm font-medium">Manajemen Kamar</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" 
               class="ant-menu-item {{ request()->routeIs('admin.orders.*') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">receipt_long</span>
                <span class="text-sm font-medium">Data Reservasi</span>
            </a>

<<<<<<< HEAD
            <a href="{{ route('admin.payment.index') }}" 
               class="ant-menu-item {{ request()->routeIs('admin.payment.*') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">payments</span>
                <span class="text-sm font-medium">Pembayaran</span>
            </a>
=======
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span>Dashboard</span>
        </a>
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e

            <a href="{{ route('admin.users.index') }}" 
               class="ant-menu-item {{ request()->routeIs('admin.users.*') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-medium">Manajemen User</span>
            </a>

<<<<<<< HEAD
            <div class="ant-menu-group mt-6">Laporan</div>
            <a href="{{ route('admin.laporan.kamar') }}" 
               class="ant-menu-item {{ request()->routeIs('admin.laporan.kamar') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">analytics</span>
                <span class="text-sm font-medium">Laporan Kamar</span>
            </a>

            <a href="{{ route('admin.laporan.transaksi') }}" 
               class="ant-menu-item {{ request()->routeIs('admin.laporan.transaksi') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">receipt</span>
                <span class="text-sm font-medium">Laporan Transaksi</span>
            </a>
        </nav>

        <div class="absolute bottom-6 left-0 right-0 px-6">
            <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button onclick="confirmLogout('admin')" type="button" class="w-full h-10 flex items-center justify-center gap-2 text-white bg-red-500/80 hover:bg-red-600 rounded-lg transition-all text-sm font-bold">
                <span class="material-symbols-outlined">logout</span>
                Keluar
=======
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
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
            </button>
        </div>
    </aside>

    {{-- MOBILE OVERLAY --}}
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-[999] transition-opacity lg:hidden"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
    </div>

    {{-- BAGIAN HEADER (NAVIGASI ATAS) --}}
    <header class="ant-header">
        <div class="flex items-center gap-3">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-ant-textSecondary p-1 hover:bg-ant-bg rounded-md transition-colors">
                <span class="material-symbols-outlined text-[24px]">menu</span>
            </button>
            <span class="material-symbols-outlined text-ant-textSecondary hidden lg:block">menu</span>
            <h1 class="text-base md:text-lg font-bold text-ant-text truncate max-w-[150px] md:max-w-none">{{ $pageTitle ?? 'Dashboard' }}</h1>
        </div>
        <div class="flex items-center gap-6">
            {{-- NOTIFICATION BELL --}}
            @includeIf('partials.navbar-notification-antd')
            
            {{-- USER DROPDOWN --}}
            <div class="flex items-center gap-4 relative" x-data="{ open: false }">
            <div @click="open = !open" class="flex items-center gap-4 cursor-pointer hover:bg-ant-bg/50 px-3 py-2 rounded-lg transition-all">
                <div class="text-right">
                    <p class="text-sm font-bold text-ant-text leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] uppercase tracking-widest text-ant-textSecondary mt-1">Administrator</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-ant-primary flex items-center justify-center text-white font-bold text-sm shadow-md">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <span class="material-symbols-outlined text-ant-textSecondary text-[16px]" x-show="!open">expand_more</span>
                <span class="material-symbols-outlined text-ant-textSecondary text-[16px]" x-show="open" style="display: none;">expand_less</span>
            </div>

            {{-- DROPDOWN MENU --}}
            <div x-show="open" @click.away="open = false" 
                 class="absolute top-full right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-ant-borderSplit z-50"
                 style="display: none;"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100">
                
                <div class="p-4 border-b border-ant-borderSplit">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-ant-primary flex items-center justify-center text-white font-bold text-lg shadow-md">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-ant-text">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-ant-textSecondary">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-ant-bg transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-ant-textSecondary">dashboard</span>
                        <span class="text-sm text-ant-text">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-ant-bg transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-ant-textSecondary">manage_accounts</span>
                        <span class="text-sm text-ant-text">Pengaturan Profil</span>
                    </a>
                </div>

                <div class="p-2 border-t border-ant-borderSplit">
                    <button onclick="confirmLogout('admin')" type="button" class="w-full flex items-center gap-3 px-3 py-2 rounded-md hover:bg-red-50 transition-colors text-left">
                        <span class="material-symbols-outlined text-[18px] text-red-600">logout</span>
                        <span class="text-sm text-red-600 font-medium">Keluar</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    {{-- BAGIAN KONTEN UTAMA --}}
    <main class="ant-layout-content">
        <div class="p-4 md:p-8">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-xs md:text-sm text-ant-textSecondary mb-6 overflow-x-auto whitespace-nowrap scrollbar-hide">
                <span>Admin</span>
                <span class="text-[10px]">/</span>
                <span class="text-ant-text">{{ Str::title(request()->segment(2) ?? 'Dashboard') }}</span>
            </div>

            @yield('content')
        </div>
    </main>
    @else
        <div class="min-h-screen w-full flex items-center justify-center">
            @yield('content')
        </div>
    @endif

    <script>
        {{-- Logout Confirmation --}}
        function confirmLogout(role) {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1677ff',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form-' + role).submit();
                }
            });
        }

        {{-- Global Success/Error Notifications --}}
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: "{{ session('error') }}",
                showConfirmButton: true,
                confirmButtonColor: '#1677ff'
            });
        @endif
    </script>

</body>
</html>