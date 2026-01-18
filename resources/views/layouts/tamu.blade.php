<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Tamu' }} | Blue Haven</title>
    <link rel="icon" href="data:,">

    {{-- Tailwind & Google Fonts --}}
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
                            primary: '#3b82f6',
                            secondary: '#8b5cf6',
                            accent: '#06b6d4',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #faf5ff 50%, #ecfeff 100%);
            color: #1e293b;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
            border-right: 1px solid #e2e8f0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.03);
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
            background: linear-gradient(135deg, #eff6ff 0%, #f5f3ff 100%);
            color: #3b82f6;
        }

        .menu-item.active {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .menu-group {
            padding: 16px 20px 8px;
            color: #94a3b8;
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
            justify-content: flex-end;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
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
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        }

        .bg-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            pointer-events: none;
            z-index: -1;
        }

        .blob-1 { width: 400px; height: 400px; background: linear-gradient(135deg, #60a5fa, #a78bfa); top: -100px; right: -100px; }
        .blob-2 { width: 300px; height: 300px; background: linear-gradient(135deg, #34d399, #22d3ee); bottom: -50px; left: 20%; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #3b82f6, #8b5cf6); border-radius: 3px; }
    </style>
</head>
<body x-data="{ sidebarOpen: false }" :class="{ 'overflow-hidden': sidebarOpen }">

<div class="bg-blob blob-1"></div>
<div class="bg-blob blob-2"></div>

@if(Auth::check() && Auth::user()->role === 'tamu')

{{-- SIDEBAR --}}
<aside class="sidebar" :class="{ 'open': sidebarOpen }">
    <div class="h-[70px] flex items-center px-5 border-b border-slate-100">
        <div class="w-10 h-10 avatar-gradient rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
            <x-heroicon-o-building-office class="w-5 h-5" />
        </div>
        <span class="ml-3 font-bold text-xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Blue Haven</span>
    </div>

    <nav class="py-4 overflow-y-auto h-[calc(100vh-70px-80px)]">
        <div class="menu-group">Ringkasan</div>
        <a href="{{ route('tamu.dashboard') }}" class="menu-item {{ request()->routeIs('tamu.dashboard') ? 'active' : '' }}">
            <x-heroicon-o-squares-2x2 class="w-5 h-5" />
            <span class="text-sm">Dashboard</span>
        </a>
        
        <div class="menu-group mt-4">Layanan Pemesanan</div>
        <a href="{{ route('tamu.kamar.list') }}" class="menu-item {{ request()->routeIs('tamu.kamar.list') ? 'active' : '' }}">
            <x-heroicon-o-magnifying-glass class="w-5 h-5" />
            <span class="text-sm">Cari Kamar</span>
        </a>

        <a href="{{ route('tamu.kamar.saya') }}" class="menu-item {{ request()->routeIs('tamu.kamar.saya') ? 'active' : '' }}">
            <x-heroicon-o-key class="w-5 h-5" />
            <span class="text-sm">Kamar Saya</span>
        </a>

        <a href="{{ route('tamu.orders.history') }}" class="menu-item {{ request()->routeIs('tamu.orders.history') ? 'active' : '' }}">
            <x-heroicon-o-clock class="w-5 h-5" />
            <span class="text-sm">Riwayat</span>
        </a>

        <a href="{{ route('tamu.notifikasi.index') }}" class="menu-item {{ request()->routeIs('tamu.notifikasi.index') ? 'active' : '' }}">
            <x-heroicon-o-bell class="w-5 h-5" />
            <span class="text-sm">Notifikasi</span>
        </a>

        <div class="menu-group mt-4">Akun & Bantuan</div>
        <a href="{{ route('tamu.profile.edit') }}" class="menu-item {{ request()->routeIs('tamu.profile.edit') ? 'active' : '' }}">
            <x-heroicon-o-user-circle class="w-5 h-5" />
            <span class="text-sm">Pengaturan Profil</span>
        </a>

        <a href="{{ route('tamu.bantuan') }}" class="menu-item {{ request()->routeIs('tamu.bantuan') ? 'active' : '' }}">
            <x-heroicon-o-question-mark-circle class="w-5 h-5" />
            <span class="text-sm">Bantuan</span>
        </a>
    </nav>

    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-100 bg-white">
        <form id="logout-form-tamu" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <button onclick="confirmLogout('tamu')" type="button" class="w-full h-11 flex items-center justify-center gap-2 text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-xl transition-all text-sm font-bold shadow-lg shadow-red-500/20">
            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
            Keluar
        </button>
    </div>
</aside>

<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[999] transition-opacity lg:hidden" x-transition style="display: none;"></div>

{{-- HEADER --}}
<header class="header">
    <div class="flex items-center gap-3 w-full lg:w-auto">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-500 p-2 hover:bg-slate-100 rounded-xl transition-colors">
            <x-heroicon-o-bars-3 class="w-6 h-6" />
        </button>
        
        <div class="hidden md:flex items-center gap-3 px-4 py-2 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-100">
            <x-heroicon-o-clock class="w-5 h-5 text-blue-500" />
            <div class="text-right">
                <p id="clock-time-tamu" class="text-sm font-bold text-slate-800 leading-none">--:--:--</p>
                <p id="clock-date-tamu" class="text-[10px] text-slate-500 mt-0.5">Loading...</p>
            </div>
        </div>
        
        <div class="flex-grow lg:flex-grow-0"></div>
    </div>

    <div class="flex items-center gap-6">
        @includeIf('partials.navbar-notification-antd')
        
        <div class="flex items-center gap-4 relative" x-data="{ open: false }">
            <div @click="open = !open" class="flex items-center gap-4 cursor-pointer hover:bg-slate-50 px-4 py-2 rounded-xl transition-all">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] uppercase tracking-widest text-slate-400 mt-1">Tamu Member</p>
                </div>
                <div class="w-10 h-10 rounded-xl avatar-gradient flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-blue-500/20">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <x-heroicon-o-chevron-down x-show="!open" class="w-4 h-4 text-slate-400 hidden sm:block" />
                <x-heroicon-o-chevron-up x-show="open" class="w-4 h-4 text-slate-400 hidden sm:block" style="display: none;" />
            </div>

            <div x-show="open" @click.away="open = false" class="absolute top-full right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-slate-100 z-50 overflow-hidden" style="display: none;" x-transition>
                <div class="p-4 bg-gradient-to-r from-blue-50 to-purple-50 border-b border-slate-100">
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
                    <a href="{{ route('tamu.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <x-heroicon-o-squares-2x2 class="w-5 h-5 text-blue-500" />
                        <span class="text-sm text-slate-700 font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('tamu.kamar.list') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 text-purple-500" />
                        <span class="text-sm text-slate-700 font-medium">Cari Kamar</span>
                    </a>
                    <a href="{{ route('tamu.orders.history') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <x-heroicon-o-clock class="w-5 h-5 text-cyan-500" />
                        <span class="text-sm text-slate-700 font-medium">Riwayat</span>
                    </a>
                    <a href="{{ route('tamu.profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-50 transition-colors">
                        <x-heroicon-o-user-circle class="w-5 h-5 text-emerald-500" />
                        <span class="text-sm text-slate-700 font-medium">Pengaturan Profil</span>
                    </a>
                </div>

                <div class="p-2 border-t border-slate-100">
                    <button onclick="confirmLogout('tamu')" type="button" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 transition-colors text-left">
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
            <x-heroicon-o-home class="w-4 h-4" />
            <span>App</span>
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
            confirmButtonColor: '#3b82f6',
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
        Swal.fire({ icon: 'error', title: 'Kesalahan', text: "{{ session('error') }}", confirmButtonColor: '#3b82f6' });
    @endif

    function updateClock() {
        const now = new Date();
        const timeElement = document.getElementById('clock-time-tamu');
        const dateElement = document.getElementById('clock-date-tamu');
        
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
    
    updateClock();
    setInterval(updateClock, 1000);
</script>

</body>
</html>
