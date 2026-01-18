<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Admin' }} | Blue Haven</title>
    <link rel="icon" href="data:,">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Material Symbols (untuk backward compatibility) --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            primary: '#8b5cf6',
                            secondary: '#3b82f6',
                            accent: '#06b6d4',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: linear-gradient(135deg, #faf5ff 0%, #f0f9ff 50%, #fdf4ff 100%);
            color: #1e293b;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #faf5ff 100%);
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
            border-right: 1px solid #e9d5ff;
            box-shadow: 4px 0 20px rgba(139, 92, 246, 0.05);
        }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
        }

        .menu-item {
            height: 44px;
            padding: 0 16px;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #64748b;
            margin: 4px 12px;
            font-weight: 500;
        }

        .menu-item:hover {
            background: linear-gradient(135deg, #faf5ff 0%, #f0f9ff 100%);
            color: #8b5cf6;
        }

        .menu-item.active {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.35);
        }

        .menu-group {
            padding: 16px 20px 8px;
            color: #a78bfa;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            height: 70px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            border-bottom: 1px solid rgba(233, 213, 255, 0.8);
        }

        .main-content {
            margin-left: 260px;
            padding-top: 70px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 1024px) {
            .main-content { margin-left: 0; }
        }

        .avatar-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }

        .bg-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            pointer-events: none;
            z-index: -1;
        }

        .blob-1 { width: 400px; height: 400px; background: linear-gradient(135deg, #a78bfa, #f472b6); top: -100px; right: -100px; }
        .blob-2 { width: 300px; height: 300px; background: linear-gradient(135deg, #60a5fa, #a78bfa); bottom: -50px; left: 20%; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #faf5ff; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #8b5cf6, #a78bfa); border-radius: 3px; }

        .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }" :class="{ 'overflow-hidden': sidebarOpen }">

<div class="bg-blob blob-1"></div>
<div class="bg-blob blob-2"></div>

@if(Auth::check() && Auth::user()->role === 'admin')

<aside class="sidebar" :class="{ 'open': sidebarOpen }">
    <div class="h-[70px] flex items-center px-5 border-b border-purple-100">
        <div class="w-10 h-10 avatar-gradient rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-500/30">
            <x-heroicon-o-shield-check class="w-5 h-5" />
        </div>
        <span class="ml-3 font-bold text-xl bg-gradient-to-r from-purple-600 to-violet-600 bg-clip-text text-transparent">Admin Panel</span>
    </div>

    <nav class="py-4 overflow-y-auto h-[calc(100vh-70px-80px)]">
        <div class="menu-group">Dashboard</div>
        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <x-heroicon-o-squares-2x2 class="w-5 h-5" />
            <span class="text-sm">Ringkasan</span>
        </a>

        <div class="menu-group mt-4">Operasional</div>
        <a href="{{ route('admin.kamar.index') }}" class="menu-item {{ request()->routeIs('admin.kamar.*') ? 'active' : '' }}">
            <x-heroicon-o-building-office class="w-5 h-5" />
            <span class="text-sm">Manajemen Kamar</span>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <x-heroicon-o-document-text class="w-5 h-5" />
            <span class="text-sm">Data Reservasi</span>
        </a>

        @php
            $pembayaranPending = \App\Models\Payment::where('status', 'pending')->count();
        @endphp
        <a href="{{ route('admin.payment.index') }}" class="menu-item {{ request()->routeIs('admin.payment.*') ? 'active' : '' }}">
            <x-heroicon-o-credit-card class="w-5 h-5" />
            <span class="text-sm">Pembayaran</span>
            @if($pembayaranPending > 0)
                <span class="ml-auto badge-danger">{{ $pembayaranPending }}</span>
            @endif
        </a>

        <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <x-heroicon-o-users class="w-5 h-5" />
            <span class="text-sm">Manajemen User</span>
        </a>

        <div class="menu-group mt-4">Laporan</div>
        <a href="{{ route('admin.laporan.kamar') }}" class="menu-item {{ request()->routeIs('admin.laporan.kamar') ? 'active' : '' }}">
            <x-heroicon-o-chart-bar class="w-5 h-5" />
            <span class="text-sm">Laporan Kamar</span>
        </a>

        <a href="{{ route('admin.laporan.transaksi') }}" class="menu-item {{ request()->routeIs('admin.laporan.transaksi') ? 'active' : '' }}">
            <x-heroicon-o-clipboard-document-list class="w-5 h-5" />
            <span class="text-sm">Laporan Transaksi</span>
        </a>

        <a href="{{ route('admin.laporan.pendapatan') }}" class="menu-item {{ request()->routeIs('admin.laporan.pendapatan') ? 'active' : '' }}">
            <x-heroicon-o-arrow-trending-up class="w-5 h-5" />
            <span class="text-sm">Laporan Pendapatan</span>
        </a>

        <div class="menu-group mt-4">Akun & Pengaturan</div>
        <a href="{{ route('admin.profile.edit') }}" class="menu-item {{ request()->routeIs('admin.profile.edit') ? 'active' : '' }}">
            <x-heroicon-o-user-circle class="w-5 h-5" />
            <span class="text-sm">Pengaturan Profil</span>
        </a>
    </nav>

    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-purple-100 bg-white">
        <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <button onclick="confirmLogout('admin')" type="button" class="w-full h-11 flex items-center justify-center gap-2 text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-xl transition-all text-sm font-bold shadow-lg shadow-red-500/20">
            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
            Keluar
        </button>
    </div>
</aside>

<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[999] transition-opacity lg:hidden" x-transition style="display: none;"></div>

<header class="header">
    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-500 p-2 hover:bg-purple-50 rounded-xl transition-colors">
            <x-heroicon-o-bars-3 class="w-6 h-6" />
        </button>
        <x-heroicon-o-bars-3 class="w-5 h-5 text-purple-400 hidden lg:block" />
        <h1 class="text-base md:text-lg font-bold text-slate-800 truncate max-w-[150px] md:max-w-none">{{ $pageTitle ?? 'Dashboard' }}</h1>
        
        <div class="hidden lg:flex items-center gap-3 px-4 py-2 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-100 ml-4">
            <x-heroicon-o-clock class="w-5 h-5 text-purple-500" />
            <div class="text-right">
                <p id="clock-time-admin" class="text-sm font-bold text-slate-800 leading-none">--:--:--</p>
                <p id="clock-date-admin" class="text-[10px] text-slate-500 mt-0.5">Loading...</p>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-6">
        @includeIf('partials.navbar-notification-antd')
        
        <div class="flex items-center gap-4 relative" x-data="{ open: false }">
            <div @click="open = !open" class="flex items-center gap-4 cursor-pointer hover:bg-purple-50 px-4 py-2 rounded-xl transition-all">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] uppercase tracking-widest text-purple-500 mt-1">Administrator</p>
                </div>
                <div class="w-10 h-10 rounded-xl avatar-gradient flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-purple-500/20">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <x-heroicon-o-chevron-down x-show="!open" class="w-4 h-4 text-slate-400 hidden sm:block" />
                <x-heroicon-o-chevron-up x-show="open" class="w-4 h-4 text-slate-400 hidden sm:block" style="display: none;" />
            </div>

            <div x-show="open" @click.away="open = false" class="absolute top-full right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-purple-100 z-50 overflow-hidden" style="display: none;" x-transition>
                <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-xl avatar-gradient flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-purple-50 transition-colors">
                        <x-heroicon-o-squares-2x2 class="w-5 h-5 text-purple-500" />
                        <span class="text-sm text-slate-700 font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-purple-50 transition-colors">
                        <x-heroicon-o-user-circle class="w-5 h-5 text-violet-500" />
                        <span class="text-sm text-slate-700 font-medium">Pengaturan Profil</span>
                    </a>
                </div>

                <div class="p-2 border-t border-purple-100">
                    <button onclick="confirmLogout('admin')" type="button" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 transition-colors text-left">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5 text-red-500" />
                        <span class="text-sm text-red-600 font-medium">Keluar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="main-content">
    <div class="p-4 md:p-8">
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
            <x-heroicon-o-shield-check class="w-4 h-4" />
            <span>Admin</span>
            <x-heroicon-o-chevron-right class="w-4 h-4" />
            <span class="text-slate-700 font-medium">{{ Str::title(request()->segment(2) ?? 'Dashboard') }}</span>
        </div>

        @yield('content')
    </div>
</main>

@else
    <div class="min-h-screen w-full flex items-center justify-center">@yield('content')</div>
@endif

<script>
    function confirmLogout(role) {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8b5cf6',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form-' + role).submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", showConfirmButton: false, timer: 3000, toast: true, position: 'top-end' });
    @endif

    @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Kesalahan', text: "{{ session('error') }}", confirmButtonColor: '#8b5cf6' });
    @endif

    function updateClockAdmin() {
        const now = new Date();
        const timeElement = document.getElementById('clock-time-admin');
        const dateElement = document.getElementById('clock-date-admin');
        
        if (timeElement && dateElement) {
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            timeElement.textContent = `${hours}:${minutes}:${seconds}`;
            
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            dateElement.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        }
    }
    
    updateClockAdmin();
    setInterval(updateClockAdmin, 1000);
</script>

</body>
</html>