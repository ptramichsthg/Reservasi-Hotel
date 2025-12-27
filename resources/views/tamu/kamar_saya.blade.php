@extends('layouts.app')

@section('content')

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

</div>

@endsection
