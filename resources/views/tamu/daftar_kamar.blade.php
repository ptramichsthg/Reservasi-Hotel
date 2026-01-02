@extends('layouts.tamu')

@section('content')

<<<<<<< HEAD
<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Daftar Kamar Tersedia</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Pilih kamar yang sesuai dengan kebutuhan Anda dan lakukan reservasi dengan mudah.</p>
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

    <h2 class="text-3xl font-extrabold mb-10 text-gray-800 tracking-wide drop-shadow flex items-center gap-3">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <span>Daftar Kamar Tersedia</span>
    </h2>

    {{-- Jika tidak ada kamar --}}
    @if($kamar->isEmpty())
        <div class="p-6 glass rgb-border text-red-700 shadow-xl max-w-lg">
            Belum ada kamar yang tersedia saat ini
        </div>
    @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($kamar as $k)
            <div class="glass rgb-border p-6 shadow-xl
                        hover:shadow-2xl hover:-translate-y-1
                        transition-all duration-300">

                <h3 class="font-bold text-xl text-blue-900 mb-2">
                    {{ $k->tipe_kamar }}
                </h3>

                <p class="text-gray-700 mb-1 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold">Harga:</span>
                    <span class="font-semibold text-blue-600">
                        Rp {{ number_format($k->harga, 0, ',', '.') }}
                    </span>
                </p>

                <p class="text-gray-600 mb-5">
                    Status:
                    <span class="font-semibold">
                        {{ ucfirst($k->status) }}
                    </span>
                </p>

                {{-- Tombol Pesan --}}
                <a href="{{ route('order.page', $k->id_kamar) }}"
                   class="block w-full text-center py-3
                          bg-blue-600 hover:bg-blue-700
                          text-white font-semibold rounded-xl
                          shadow-md hover:shadow-lg
                          hover:-translate-y-0.5
                          transition-all duration-300">
                    Pesan Sekarang →
                </a>

            </div>
            @endforeach

        </div>

    @endif

>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
</div>

@if($kamar->isEmpty())
    <div class="ant-card p-16 text-center">
        <span class="material-symbols-outlined text-ant-textSecondary text-[80px] mb-6 block">hotel</span>
        <h4 class="text-lg font-bold text-ant-text mb-2">Belum Ada Kamar Tersedia</h4>
        <p class="text-ant-textSecondary text-sm">Saat ini tidak ada kamar yang tersedia. Silakan cek kembali nanti.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($kamar as $k)
            <div class="ant-card overflow-hidden h-full flex flex-col group">
                <div class="h-44 bg-ant-bg relative overflow-hidden">
                    <div class="w-full h-full flex flex-col items-center justify-center text-ant-textSecondary">
                        <span class="material-symbols-outlined text-[48px]">bed</span>
                        <span class="text-[10px] uppercase font-bold tracking-tighter mt-2">{{ $k->tipe_kamar }}</span>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span class="bg-white/90 backdrop-blur px-2 py-1 rounded text-[10px] font-bold uppercase 
                                     {{ $k->status === 'tersedia' ? 'text-green-600' : 'text-red-600' }} shadow-sm">
                            {{ ucfirst($k->status) }}
                        </span>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-base font-bold text-ant-text mb-1">{{ $k->tipe_kamar }}</h3>
                    <p class="text-[11px] text-ant-textSecondary flex items-center gap-1 mb-4">
                        <span class="material-symbols-outlined text-[14px]">location_on</span>
                        Blue Haven Hotel
                    </p>
                    
                    <div class="mt-auto">
                        <div class="flex flex-col mb-4">
                            <span class="text-[10px] text-ant-textSecondary font-medium">Harga Per Malam</span>
                            <span class="text-lg font-black text-ant-primary">Rp {{ number_format($k->harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <a href="{{ route('order.page', $k->id_kamar) }}" 
                           class="inline-flex w-full h-10 items-center justify-center bg-ant-primary text-white rounded-ant text-sm font-bold shadow-sm hover:bg-ant-primaryHover transition-all">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection

