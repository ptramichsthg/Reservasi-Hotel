@extends('layouts.tamu')

@section('content')

<div class="p-6 md:p-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-ant-textSecondary text-sm mb-1">
                <a href="{{ route('tamu.dashboard') }}" class="hover:text-ant-primary transition-colors">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-ant-text">Notifikasi</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-ant-text flex items-center gap-3">
                <span class="material-symbols-outlined text-ant-primary text-[32px]">notifications</span>
                Notifikasi Saya
            </h1>
        </div>

        @if($notifikasi->where('is_read', false)->count() > 0)
            <div class="flex-shrink-0">
                <form action="{{ route('tamu.notifikasi.baca-semua') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-2 bg-ant-primary text-white text-sm font-bold rounded-full transition-all duration-300 hover:bg-ant-primaryHover shadow-md hover:shadow-lg active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">done_all</span>
                        Tandai Semua Dibaca
                    </button>
                </form>
            </div>
        @endif
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="bg-ant-successBg border border-ant-successBorder text-ant-successText px-4 py-3 rounded-lg flex items-center gap-3 animate-slide-up">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- NOTIFICATION LIST --}}
    <div class="bg-white rounded-2xl shadow-sm border border-ant-borderSplit overflow-hidden">
        <div class="px-6 py-4 border-b border-ant-borderSplit flex items-center justify-between bg-ant-bg/30">
            <h2 class="text-base font-bold text-ant-text flex items-center gap-2">
                Daftar Notifikasi
                @php
                    $unreadCount = $notifikasi->where('is_read', false)->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="bg-ant-primary/10 text-ant-primary text-[11px] px-2 py-0.5 rounded-full">
                        {{ $unreadCount }} Belum Dibaca
                    </span>
                @endif
            </h2>
        </div>

        <div class="divide-y divide-ant-borderSplit">
            @forelse($notifikasi as $notif)
                <div class="group px-6 py-5 transition-all duration-300 {{ $notif->is_read ? 'bg-white' : 'bg-ant-primary/[0.02]' }} hover:bg-ant-bg/50">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="flex gap-4">
                            {{-- ICON --}}
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110 {{ $notif->is_read ? 'bg-ant-bg/50 text-ant-textSecondary' : 'bg-ant-primary/10 text-ant-primary' }}">
                                <span class="material-symbols-outlined text-[20px]">
                                    {{ $notif->is_read ? 'mail' : 'mark_email_unread' }}
                                </span>
                            </div>

                            {{-- CONTENT --}}
                            <div class="space-y-1">
                                <h3 class="text-base font-bold leading-tight transition-colors {{ $notif->is_read ? 'text-ant-text/70' : 'text-ant-text' }}">
                                    {{ $notif->judul }}
                                </h3>
                                <p class="text-sm text-ant-textSecondary leading-relaxed max-w-2xl">
                                    {{ $notif->pesan }}
                                </p>
                                <div class="flex items-center gap-3 pt-1">
                                    <span class="text-[11px] font-medium text-ant-textQuaternary flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[13px]">schedule</span>
                                        {{ $notif->created_at->diffForHumans() }}
                                    </span>
                                    @if(!$notif->is_read)
                                        <span class="w-1.5 h-1.5 rounded-full bg-ant-primary animate-pulse"></span>
                                        <span class="text-[11px] font-bold text-ant-primary uppercase tracking-wider">Baru</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- ACTIONS --}}
                        @if(!$notif->is_read)
                            <div class="flex-shrink-0 self-end md:self-start">
                                <form action="{{ route('tamu.notifikasi.baca', $notif->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-[13px] font-bold rounded-full transition-all duration-300 hover:from-blue-600 hover:to-purple-700 shadow-md hover:shadow-lg group/btn">
                                        <span class="material-symbols-outlined text-[16px] group-hover/btn:rotate-12 transition-transform">done_all</span>
                                        Tandai Dibaca
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="flex-shrink-0 self-end md:self-start opacity-40 group-hover:opacity-100 transition-opacity">
                                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-ant-bg border border-ant-border text-ant-textSecondary text-[13px] font-medium rounded-full cursor-default select-none">
                                    <span class="material-symbols-outlined text-[16px]">check</span>
                                    Sudah Dibaca
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-6 py-20 text-center">
                    <div class="w-20 h-20 bg-ant-bg rounded-full flex items-center justify-center mx-auto mb-4 border border-ant-borderSplit/50 shadow-inner">
                        <span class="material-symbols-outlined text-ant-textQuaternary text-[40px]">notifications_off</span>
                    </div>
                    <h3 class="text-lg font-bold text-ant-textSecondary">Belum Ada Notifikasi</h3>
                    <p class="text-sm text-ant-textQuaternary max-w-xs mx-auto">
                        Anda akan menerima notifikasi di sini ketika ada pembaruan terkait reservasi Anda.
                    </p>
                    <a href="{{ route('tamu.dashboard') }}" class="inline-flex items-center gap-2 mt-6 text-ant-primary font-bold hover:underline transition-all">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali ke Dashboard
                    </a>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($notifikasi->hasPages())
            <div class="px-6 py-4 bg-ant-bg/30 border-t border-ant-borderSplit">
                {{ $notifikasi->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up {
        animation: slide-up 0.4s ease-out forwards;
    }
</style>

@endsection
