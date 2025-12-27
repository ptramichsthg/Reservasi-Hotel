@extends('layouts.app')

@section('content')

<style>
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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <span>Form Reservasi Kamar</span>
    </h2>

    <div class="max-w-xl mx-auto glass rgb-border p-8 shadow-xl transition-all">

        {{-- SESSION ERROR --}}
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-200 text-red-800 rounded-xl shadow font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- VALIDATION ERROR --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl shadow">
                <strong class="flex items-center gap-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span>Terjadi kesalahan:</span>
                </strong>
                <ul class="mt-2 ml-4 list-disc">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- INFO KAMAR --}}
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-800">
                {{ $kamar->tipe_kamar }}
            </h3>

            @if($kamar->foto_utama)
                <img src="{{ asset('uploads/kamar/' . $kamar->foto_utama) }}"
                     class="w-full h-48 object-cover rounded-xl shadow mb-3"
                     alt="Foto {{ $kamar->tipe_kamar }}">
            @endif

            <p class="text-gray-600 text-lg mt-1 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Harga per malam:</span>
                <span class="text-blue-600 font-bold">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </span>
            </p>

            <p class="text-sm text-gray-500 mt-1">
                Kapasitas maksimal: {{ $kamar->kapasitas }} orang
            </p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('tamu.order.store') }}">
            @csrf

            <input type="hidden" name="id_kamar" value="{{ $kamar->id_kamar }}">

            {{-- JUMLAH TAMU --}}
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Jumlah Tamu</span>
                </label>

                <input
                    type="number"
                    name="jumlah_tamu"
                    min="1"
                    max="{{ $kamar->kapasitas }}"
                    value="{{ old('jumlah_tamu', 1) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm
                           focus:ring-2 focus:ring-green-400 focus:border-green-400 transition outline-none"
                    required
                >
            </div>

            {{-- CHECK-IN --}}
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Tanggal Check-in</span>
                </label>

                <input
                    type="date"
                    name="tgl_checkin"
                    id="checkin"
                    value="{{ old('tgl_checkin') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm
                           focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition outline-none"
                    required
                >
            </div>

            {{-- CHECK-OUT --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Tanggal Check-out</span>
                </label>

                <input
                    type="date"
                    name="tgl_checkout"
                    id="checkout"
                    value="{{ old('tgl_checkout') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 shadow-sm
                           focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition outline-none"
                    required
                >
            </div>

            {{-- SUBMIT --}}
            <button
                type="submit"
                class="w-full py-3 bg-green-600 text-white font-semibold rounded-xl shadow-md
                       hover:bg-green-700 hover:shadow-lg hover:-translate-y-0.5
                       transition-all duration-300">
                Buat Reservasi
            </button>

        </form>
    </div>
</div>

{{-- VALIDASI TANGGAL --}}
<script>
    const today = new Date().toISOString().split("T")[0];
    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");

    checkin.setAttribute("min", today);

    checkin.addEventListener("change", function () {
        checkout.setAttribute("min", this.value);
    });
</script>

@endsection
