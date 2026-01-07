<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Tamu' }} | Blue Haven</title>

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
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

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
            padding: 14px 16px 6px;
            color: rgba(255, 255, 255, 0.45);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .ant-header {
            background: #fff;
            height: 64px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
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
        }

        .ant-btn-primary:hover {
            background-color: #4096ff;
            border-color: #4096ff;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 20px;
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }" :class="{ 'overflow-hidden': sidebarOpen }">

    @if(Auth::check() && Auth::user()->role === 'tamu')
    {{-- BAGIAN SIDEBAR (NAVIGASI SAMPING) --}}
    <aside class="ant-sider shadow-xl" :class="{ 'open': sidebarOpen }">
        <div class="h-16 flex items-center px-6 mb-4">
            <div class="w-8 h-8 bg-ant-primary rounded-lg flex items-center justify-center text-white font-bold mr-3 shadow-lg">
                <span class="material-symbols-outlined">hotel</span>
            </div>
            <span class="text-white font-bold text-lg tracking-tight">Blue Haven</span>
        </div>

        <nav class="px-3">
            {{-- SEKSI: RINGKASAN --}}
            <div class="ant-menu-group">Ringkasan</div>
            <a href="{{ route('tamu.dashboard') }}" 
               class="ant-menu-item {{ request()->routeIs('tamu.dashboard') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            
            {{-- SEKSI: LAYANAN PEMESANAN --}}
            <div class="ant-menu-group mt-4">Layanan Pemesanan</div>
            <a href="{{ route('tamu.kamar.list') }}" 
               class="ant-menu-item {{ request()->routeIs('tamu.kamar.list') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">search</span>
                <span class="text-sm font-medium">Cari Kamar</span>
            </a>

            <a href="{{ route('tamu.kamar.saya') }}" 
               class="ant-menu-item {{ request()->routeIs('tamu.kamar.saya') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">meeting_room</span>
                <span class="text-sm font-medium">Kamar Saya</span>
            </a>

            <a href="{{ route('tamu.orders.history') }}" 
               class="ant-menu-item {{ request()->routeIs('tamu.orders.history') ? 'ant-menu-item-selected' : '' }}">
                <span class="material-symbols-outlined">history</span>
                <span class="text-sm font-medium">Riwayat</span>
            </a>

        </nav>

        <div class="absolute bottom-6 left-0 right-0 px-6">
            <form id="logout-form-tamu" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button onclick="confirmLogout('tamu')" type="button" class="w-full h-10 flex items-center justify-center gap-2 text-white bg-red-500/80 hover:bg-red-600 rounded-lg transition-all text-sm font-bold">
                <span class="material-symbols-outlined">logout</span>
                Keluar
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
        <div class="flex items-center gap-3 w-full lg:w-auto">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-ant-textSecondary p-1 hover:bg-ant-bg rounded-md transition-colors mr-2">
                <span class="material-symbols-outlined text-[24px]">menu</span>
            </button>
            <div class="flex-grow lg:flex-grow-0"></div>
        </div>
        <div class="flex items-center gap-6">
            {{-- NOTIFICATION BELL --}}
            @includeIf('partials.navbar-notification-antd')
            
            {{-- USER DROPDOWN --}}
            <div class="flex items-center gap-4 relative" x-data="{ open: false }">
            <div @click="open = !open" class="flex items-center gap-4 cursor-pointer hover:bg-ant-bg/50 px-3 py-2 rounded-lg transition-all">
                <div class="text-right">
                    <p class="text-sm font-bold text-ant-text leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] uppercase tracking-widest text-ant-textSecondary mt-1">Tamu Member</p>
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
                    <a href="{{ route('tamu.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-ant-bg transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-ant-textSecondary">dashboard</span>
                        <span class="text-sm text-ant-text">Dashboard</span>
                    </a>
                    <a href="{{ route('tamu.kamar.list') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-ant-bg transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-ant-textSecondary">search</span>
                        <span class="text-sm text-ant-text">Cari Kamar</span>
                    </a>
                    <a href="{{ route('tamu.orders.history') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-ant-bg transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-ant-textSecondary">history</span>
                        <span class="text-sm text-ant-text">Riwayat</span>
                    </a>
                    <a href="{{ route('tamu.profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-ant-bg transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-ant-textSecondary">manage_accounts</span>
                        <span class="text-sm text-ant-text">Pengaturan Profil</span>
                    </a>
                </div>

                <div class="p-2 border-t border-ant-borderSplit">
                    <button onclick="confirmLogout('tamu')" type="button" class="w-full flex items-center gap-3 px-3 py-2 rounded-md hover:bg-red-50 transition-colors text-left">
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
            {{-- Breadcrumb (Static example for AntD Look) --}}
            <div class="flex items-center gap-2 text-xs md:text-sm text-ant-textSecondary mb-6 overflow-x-auto whitespace-nowrap scrollbar-hide">
                <span>App</span>
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

