@extends('layouts.tamu')

@section('content')

<<<<<<< HEAD
<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Kamar Saya</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Daftar kamar yang sedang Anda pesan dan kelola reservasi Anda dengan mudah.</p>
=======
<style>
    /* ===============================
       GLASSMORPHISM CONSISTENCY
    =============================== */
    .glass {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.35);
    }

    .rgb-border {
        position: relative;
    }

    .rgb-border::before {
        content: "";
        position: absolute;
        inset: 0;
        padding: 2px;
        border-radius: inherit;
        background: linear-gradient(
            120deg,
            #3b82f6,
            #22d3ee,
            #a855f7,
            #3b82f6
        );
        background-size: 300% 300%;
        animation: rgbFlow 6s linear infinite;
        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }

    @keyframes rgbFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <h2 class="text-3xl font-extrabold mb-10 text-gray-700 tracking-wide drop-shadow flex items-center gap-2">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <span>Kamar Saya</span>
    </h2>

    {{-- Jika kosong --}}
    @if($pemesanan->isEmpty())
        <div class="p-6 glass rgb-border text-red-700 shadow-xl max-w-lg">
            Kamu belum memiliki kamar yang dipesan
        </div>

    @else

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @foreach($pemesanan as $p)
            <div class="glass rgb-border p-6 shadow-xl
                        hover:shadow-2xl hover:-translate-y-1
                        transition-all duration-300">

                {{-- Nama kamar --}}
                <h3 class="font-bold text-xl text-gray-800">
                    {{ $p->kamar->tipe_kamar }}
                </h3>

                {{-- Harga --}}
                <p class="text-gray-700 mt-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Harga:</span>
                    <span class="font-semibold text-blue-600">
                        Rp {{ number_format($p->kamar->harga, 0, ',', '.') }}
                    </span>
                </p>

                {{-- Status Pembayaran --}}
                <p class="mt-4">
                    <span class="font-semibold text-gray-700">Status Pembayaran:</span>
                    <span class="
                        inline-block mt-1 px-4 py-1 rounded-full
                        text-white text-sm font-bold
                        @if($p->status_pembayaran == 'pending') bg-yellow-500
                        @elseif($p->status_pembayaran == 'paid') bg-green-600
                        @elseif($p->status_pembayaran == 'cancelled') bg-red-600
                        @else bg-gray-500 @endif
                    ">
                        {{ ucfirst($p->status_pembayaran) }}
                    </span>
                </p>

                {{-- Tanggal --}}
                <div class="mt-4 text-gray-600 text-sm space-y-1">
                    <p>Check-in:
                        <span class="font-semibold">{{ $p->tgl_checkin }}</span>
                    </p>
                    <p>Check-out:
                        <span class="font-semibold">{{ $p->tgl_checkout }}</span>
                    </p>
                </div>

            </div>
        @endforeach

    </div>

    @endif

>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
</div>

@if($pemesanan->isEmpty())
    <div class="ant-card p-16 text-center">
        <span class="material-symbols-outlined text-ant-textSecondary text-[80px] mb-6 block">hotel</span>
        <h4 class="text-lg font-bold text-ant-text mb-2">Belum Ada Kamar yang Dipesan</h4>
        <p class="text-ant-textSecondary text-sm mb-8">Anda belum memiliki<span class="material-symbols-outlined text-[18px]">bed</span> Reservasi Kamar aktif saat ini.</p>
        <a href="{{ route('tamu.kamar.list') }}" class="ant-btn-primary inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-[16px]">search</span>
            Cari Kamar Sekarang
        </a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pemesanan as $p)
            @php
                $statusConfig = match($p->status_pembayaran) {
                    'pending' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600', 'border' => 'border-orange-200'],
                    'paid' => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'border' => 'border-green-200'],
                    'cancelled' => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'border' => 'border-red-200'],
                    default => ['bg' => 'bg-gray-50', 'text' => 'text-gray-600', 'border' => 'border-gray-200']
                };
            @endphp
            
            <div class="ant-card p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded bg-ant-bg flex items-center justify-center">
                            <span class="material-symbols-outlined text-ant-primary text-[24px]">bed</span>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-ant-text">{{ $p->kamar->tipe_kamar }}</h3>
                            <p class="text-[10px] text-ant-textSecondary uppercase tracking-wide">Blue Haven</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 mb-5">
                    <div class="flex items-center justify-between py-2 border-b border-ant-borderSplit">
                        <span class="text-xs text-ant-textSecondary">Harga Per Malam</span>
                        <span class="text-sm font-bold text-ant-primary">Rp {{ number_format($p->kamar->harga, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex items-center justify-between py-2 border-b border-ant-borderSplit">
                        <span class="text-xs text-ant-textSecondary flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">login</span>
                            Check-in
                        </span>
                        <span class="text-sm font-medium text-ant-text">{{ $p->tgl_checkin }}</span>
                    </div>

                    <div class="flex items-center justify-between py-2 border-b border-ant-borderSplit">
                        <span class="text-xs text-ant-textSecondary flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">logout</span>
                            Check-out
                        </span>
                        <span class="text-sm font-medium text-ant-text">{{ $p->tgl_checkout }}</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-ant-borderSplit">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold uppercase border w-full justify-center
                                 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                        {{ ucfirst($p->status_pembayaran) }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection


