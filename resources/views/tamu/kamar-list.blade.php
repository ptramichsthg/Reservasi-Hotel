@extends('layouts.app')

@section('content')

<style>
    /* ===============================
       🧊 Glassmorphism Premium
    =============================== */
    .glass {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        transition: all .35s ease;
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

    /* ===============================
       ✨ Animations
    =============================== */
    .fade-up {
        opacity: 0;
        transform: translateY(25px);
        animation: fadeUp .9s ease-out forwards;
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-hover:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,.15);
    }
</style>

<div class="p-10 min-h-screen rounded-2xl
            bg-gradient-to-br from-blue-50 via-white to-purple-100">

    {{-- TITLE --}}
    <div class="mb-10 fade-up">
        <h2 class="text-4xl font-extrabold text-blue-900 tracking-wide">
            🛏️ Pilih Kamar
        </h2>
        <p class="text-gray-600 mt-2">
            Temukan kamar terbaik sesuai kebutuhan Anda
        </p>
    </div>

    {{-- FILTER --}}
    <form method="GET"
          class="mb-12 glass rgb-border p-8 shadow-xl fade-up">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

            {{-- KEYWORD --}}
            <div>
                <label class="font-semibold text-gray-700">Cari Kamar</label>
                <input type="text" name="keyword"
                       value="{{ request('keyword') }}"
                       placeholder="Tipe atau deskripsi kamar"
                       class="w-full mt-2 p-3 rounded-xl border focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- MIN PRICE --}}
            <div>
                <label class="font-semibold text-gray-700">Harga Minimum</label>
                <input type="number" name="min_price"
                       value="{{ request('min_price') }}"
                       placeholder="Rp Min"
                       class="w-full mt-2 p-3 rounded-xl border focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- MAX PRICE --}}
            <div>
                <label class="font-semibold text-gray-700">Harga Maksimum</label>
                <input type="number" name="max_price"
                       value="{{ request('max_price') }}"
                       placeholder="Rp Max"
                       class="w-full mt-2 p-3 rounded-xl border focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- TIPE --}}
            <div>
                <label class="font-semibold text-gray-700">Tipe Kamar</label>
                <select name="tipe_kamar"
                        class="w-full mt-2 p-3 rounded-xl border focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Tipe</option>
                    @foreach([
                        "Standard Room","Superior Room","Deluxe Room",
                        "Junior Suite","Suite Room","Presidential Suite",
                        "Single Room","Double Room","Twin Room",
                        "Family Room","Connecting Room"
                    ] as $t)
                        <option value="{{ $t }}"
                            {{ request('tipe_kamar') == $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- FASILITAS --}}
        <div class="mt-6">
            <label class="font-semibold text-gray-700">Fasilitas</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">
                @foreach(["WiFi","AC","TV","Sarapan","Kamar Mandi Dalam","Air Panas","Lemari","Meja Kerja"] as $fas)
                    <label class="flex items-center gap-2 text-gray-700">
                        <input type="checkbox" name="fasilitas[]"
                               value="{{ $fas }}"
                               class="accent-blue-600"
                               {{ request('fasilitas') && in_array($fas, request('fasilitas')) ? 'checked' : '' }}>
                        {{ $fas }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- SORT --}}
        <div class="mt-6">
            <label class="font-semibold text-gray-700">Urutkan</label>
            <select name="sort"
                    class="mt-2 p-3 rounded-xl border focus:ring-2 focus:ring-blue-500">
                <option value="">Default</option>
                <option value="termurah" {{ request('sort')=='termurah' ? 'selected' : '' }}>Harga Termurah</option>
                <option value="termahal" {{ request('sort')=='termahal' ? 'selected' : '' }}>Harga Termahal</option>
                <option value="terbaru" {{ request('sort')=='terbaru' ? 'selected' : '' }}>Kamar Terbaru</option>
            </select>
        </div>

        {{-- BUTTON --}}
        <div class="mt-8 flex gap-4">
            <button
                class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold
                       shadow-lg hover:bg-blue-700 hover:-translate-y-0.5 transition">
                Terapkan Filter
            </button>

            <a href="{{ route('tamu.kamar.list') }}"
               class="px-8 py-3 bg-gray-300 text-gray-800 rounded-xl
                      hover:bg-gray-400 transition">
                Reset
            </a>
        </div>
    </form>

    {{-- LIST KAMAR --}}
    @if($kamar->isEmpty())
        <div class="glass rgb-border p-8 text-red-600 shadow-xl max-w-xl fade-up">
            Tidak ada kamar yang sesuai filter 😢
        </div>
    @else

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">

        @foreach($kamar as $k)
        <div class="glass rgb-border shadow-xl overflow-hidden
                    card-hover fade-up">

            {{-- FOTO --}}
            <div class="h-52 bg-gray-200 overflow-hidden">
                @if($k->foto_utama)
                    <img src="{{ asset('uploads/kamar/' . $k->foto_utama) }}"
                         class="w-full h-full object-cover hover:scale-110 transition duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-500">
                        Tidak ada foto
                    </div>
                @endif
            </div>

            {{-- DETAIL --}}
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ $k->tipe_kamar }}
                </h3>

                <p class="text-gray-600 mb-4">
                    💰 Harga
                    <span class="text-blue-600 font-extrabold">
                        Rp {{ number_format($k->harga, 0, ',', '.') }}
                    </span>
                </p>

                <a href="{{ route('tamu.order.page', $k->id_kamar) }}"
                   class="inline-block w-full text-center px-6 py-3
                          bg-blue-600 text-white rounded-xl font-semibold
                          shadow-md hover:bg-blue-700 hover:-translate-y-0.5
                          transition">
                    Pesan Sekarang →
                </a>
            </div>

        </div>
        @endforeach

    </div>

    {{-- PAGINATION --}}
    <div class="mt-12">
        {{ $kamar->links() }}
    </div>

    @endif

</div>

@endsection
