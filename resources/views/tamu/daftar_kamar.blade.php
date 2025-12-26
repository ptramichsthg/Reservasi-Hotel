@extends('layouts.app')

@section('content')

<style>
    /* ===============================
       🧊 Glassmorphism Consistency
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

    <h2 class="text-3xl font-extrabold mb-10 text-gray-800 tracking-wide drop-shadow">
        🛏️ Daftar Kamar Tersedia
    </h2>

    {{-- Jika tidak ada kamar --}}
    @if($kamar->isEmpty())
        <div class="p-6 glass rgb-border text-red-700 shadow-xl max-w-lg">
            Belum ada kamar yang tersedia saat ini 😢
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

                <p class="text-gray-700 mb-1">
                    💰 Harga:
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

</div>

@endsection
