@extends('layouts.tamu')

@section('content')

<<<<<<< HEAD
<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Pilih Kamar</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Gunakan filter di bawah ini untuk menemukan kamar yang tepat untuk Anda.</p>
</div>
=======
<style>
    /* ===============================
       GLASSMORPHISM PREMIUM
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
       ANIMATIONS
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
        <h2 class="text-4xl font-extrabold text-blue-900 tracking-wide flex items-center gap-2">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span>Pilih Kamar</span>
        </h2>
        <p class="text-gray-600 mt-2">
            Temukan kamar terbaik sesuai kebutuhan Anda
        </p>
    </div>

    {{-- FILTER --}}
    <form method="GET"
          class="mb-12 glass rgb-border p-8 shadow-xl fade-up">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e

{{-- FILTER SECTION --}}
<div class="ant-card p-8 mb-10">
    <form method="GET" action="{{ route('tamu.kamar.list') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- KEYWORD --}}
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text">Cari Kamar</label>
                <input type="text" name="keyword" value="{{ request('keyword') }}" 
                       placeholder="Contoh: Deluxe"
                       class="h-8 border border-ant-border rounded-ant px-3 text-sm focus:border-ant-primary focus:outline-none transition-all">
            </div>

            {{-- MIN PRICE --}}
<<<<<<< HEAD
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text">Harga Min</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}" 
                       placeholder="Rp min"
                       class="h-8 border border-ant-border rounded-ant px-3 text-sm focus:border-ant-primary focus:outline-none transition-all">
            </div>

             {{-- MAX PRICE --}}
             <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text">Harga Max</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" 
                       placeholder="Rp max"
                       class="h-8 border border-ant-border rounded-ant px-3 text-sm focus:border-ant-primary focus:outline-none transition-all">
=======
            <div>
                <label class="font-semibold text-gray-700">Harga Minimum</label>
                <input type="text" name="min_price" id="min_price"
                       value="{{ request('min_price') }}"
                       placeholder="Contoh: 1.000.000"
                       class="w-full mt-2 p-3 rounded-xl border focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Format otomatis akan ditambahkan saat mengetik</p>
            </div>

            {{-- MAX PRICE --}}
            <div>
                <label class="font-semibold text-gray-700">Harga Maksimum</label>
                <input type="text" name="max_price" id="max_price"
                       value="{{ request('max_price') }}"
                       placeholder="Contoh: 2.000.000"
                       class="w-full mt-2 p-3 rounded-xl border focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Format otomatis akan ditambahkan saat mengetik</p>
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
            </div>

            {{-- TIPE --}}
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text">Tipe Kamar</label>
                <select name="tipe_kamar" class="h-8 border border-ant-border rounded-ant px-3 text-sm focus:border-ant-primary focus:outline-none bg-white transition-all">
                    <option value="">Semua Tipe</option>
                    @foreach([
                        "Standard Room","Superior Room","Deluxe Room",
                        "Junior Suite","Suite Room","Presidential Suite",
                        "Single Room","Double Room","Twin Room",
                        "Family Room","Connecting Room"
                    ] as $t)
                        <option value="{{ $t }}" {{ request('tipe_kamar') == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{--<span class="material-symbols-outlined text-[18px]">build</span> Fasilitas --}}
        <div class="mt-8">
            <label class="text-sm font-medium text-ant-text block mb-4">Fasilitas Tambahan</label>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                @foreach(["WiFi","AC","TV","Sarapan","Kamar Mandi Dalam","Air Panas","Lemari","Meja Kerja"] as $fas)
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="fasilitas[]" value="{{ $fas }}" class="w-4 h-4 border-ant-border rounded-sm text-ant-primary focus:ring-0"
                               {{ request('fasilitas') && in_array($fas, request('fasilitas')) ? 'checked' : '' }}>
                        <span class="text-sm text-ant-textSecondary group-hover:text-ant-text transition-colors">{{ $fas }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- BUTTONS --}}
        <div class="mt-8 flex items-center gap-3 pt-6 border-t border-ant-borderSplit">
            <button type="submit" class="ant-btn-primary flex items-center gap-2">
                <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                Terapkan Filter
            </button>
            <a href="{{ route('tamu.kamar.list') }}" class="h-8 px-4 border border-ant-border rounded-ant flex items-center justify-center text-sm font-medium hover:text-ant-primary hover:border-ant-primary transition-all">
                Reset
            </a>
            <div class="ml-auto">
                <select name="sort" onchange="this.form.submit()" class="h-8 border border-ant-border rounded-ant px-3 text-sm focus:border-ant-primary focus:outline-none bg-white transition-all text-ant-textSecondary">
                    <option value="">Default Urutan</option>
                    <option value="termurah" {{ request('sort')=='termurah' ? 'selected' : '' }}>Harga Termurah</option>
                    <option value="termahal" {{ request('sort')=='termahal' ? 'selected' : '' }}>Harga Termahal</option>
                    <option value="terbaru" {{ request('sort')=='terbaru' ? 'selected' : '' }}>Kamar Terbaru</option>
                </select>
            </div>
        </div>
    </form>
</div>

<<<<<<< HEAD
{{-- ROOMS LIST --}}
@if($kamar->isEmpty())
    <div class="ant-card p-12 text-center">
        <span class="material-symbols-outlined text- ant-textSecondary text-[64px] mb-4">search_off</span>
        <h4 class="text-lg font-bold text-ant-text">Kamar Tidak Ditemukan</h4>
        <p class="text-ant-textSecondary text-sm mt-1">Coba sesuaikan filter pencarian Anda.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
=======
    {{-- LIST KAMAR --}}
    @if($kamar->isEmpty())
        <div class="glass rgb-border p-8 shadow-xl max-w-2xl fade-up">
            <p class="text-red-600 font-semibold text-lg mb-3">Tidak ada kamar yang sesuai filter</p>
            
            {{-- Info filter aktif --}}
            @if(request()->hasAny(['keyword', 'min_price', 'max_price', 'tipe_kamar', 'fasilitas', 'sort']))
                <div class="mt-4 p-4 bg-blue-50 rounded-xl">
                    <p class="font-semibold text-gray-700 mb-2">Filter yang aktif:</p>
                    <ul class="list-disc ml-5 text-sm text-gray-600 space-y-1">
                        @if(request('keyword')) 
                            <li>Pencarian: <strong>{{ request('keyword') }}</strong></li> 
                        @endif
                        @if(request('min_price')) 
                            <li>Harga Minimum: <strong>Rp {{ number_format(request('min_price'), 0, ',', '.') }}</strong></li> 
                        @endif
                        @if(request('max_price')) 
                            <li>Harga Maksimum: <strong>Rp {{ number_format(request('max_price'), 0, ',', '.') }}</strong></li> 
                        @endif
                        @if(request('tipe_kamar')) 
                            <li>Tipe Kamar: <strong>{{ request('tipe_kamar') }}</strong></li> 
                        @endif
                        @if(request('fasilitas')) 
                            <li>Fasilitas: <strong>{{ count(request('fasilitas')) }} dipilih</strong> ({{ implode(', ', request('fasilitas')) }})</li> 
                        @endif
                        @if(request('sort')) 
                            <li>Urutan: <strong>{{ ucfirst(request('sort')) }}</strong></li> 
                        @endif
                    </ul>
                    <p class="mt-3 text-sm text-gray-600">
                        💡 <strong>Tip:</strong> Coba kurangi filter atau gunakan tombol <strong>Reset</strong> untuk melihat semua kamar.
                    </p>
                </div>
            @endif
        </div>
    @else

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">

>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
        @foreach($kamar as $k)
            <div class="ant-card overflow-hidden h-full flex flex-col group">
                {{-- FOTO --}}
                <div class="h-44 bg-ant-bg relative overflow-hidden">
                    @if($k->foto_utama)
                        <img src="{{ asset('uploads/kamar/' . $k->foto_utama) }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-ant-textSecondary">
                            <span class="material-symbols-outlined text-[32px]">image</span>
                            <span class="text-[10px] uppercase font-bold tracking-tighter mt-1">No Photo</span>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/90 backdrop-blur px-2 py-1 rounded text-[10px] font-bold uppercase text-ant-primary shadow-sm">
                            Blue Haven Choice
                        </span>
                    </div>
                </div>

                {{-- DETAIL --}}
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-base font-bold text-ant-text mb-1 truncate">{{ $k->tipe_kamar }}</h3>
                    <p class="text-[11px] text-ant-textSecondary flex items-center gap-1 mb-4">
                        <span class="material-symbols-outlined text-[14px]">location_on</span>
                        Blue Haven Utama
                    </p>
                    
                    <div class="mt-auto">
                        <div class="flex flex-col mb-4">
                            <span class="text-[10px] text-ant-textSecondary font-medium">Harga Per Malam</span>
                            <span class="text-lg font-black text-ant-primary">Rp {{ number_format($k->harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <a href="{{ route('tamu.order.page', $k->id_kamar) }}" 
                           class="inline-flex w-full h-10 items-center justify-center bg-ant-primary text-white rounded-ant text-sm font-bold shadow-sm hover:bg-ant-primaryHover transition-all">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
=======

            {{-- DETAIL --}}
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ $k->tipe_kamar }}
                </h3>

                <p class="text-gray-600 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Harga</span>
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
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="mt-12 flex justify-center">
        {{ $kamar->links() }}
    </div>
@endif

<script>
// Auto-format input harga dengan pemisah ribuan (titik)
function formatRupiah(input) {
    // Ambil value dan hapus semua karakter non-digit
    let value = input.value.replace(/\D/g, '');
    
    // Format dengan pemisah ribuan (titik)
    if (value) {
        value = parseInt(value).toLocaleString('id-ID');
    }
    
    // Set kembali ke input
    input.value = value;
}

// Event listener untuk input harga minimum
const minPriceInput = document.getElementById('min_price');
if (minPriceInput) {
    minPriceInput.addEventListener('input', function(e) {
        formatRupiah(e.target);
    });
}

// Event listener untuk input harga maksimum
const maxPriceInput = document.getElementById('max_price');
if (maxPriceInput) {
    maxPriceInput.addEventListener('input', function(e) {
        formatRupiah(e.target);
    });
}
</script>

@endsection


