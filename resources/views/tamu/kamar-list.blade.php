@extends('layouts.tamu')

@section('content')

<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Pilih Kamar</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Gunakan filter di bawah ini untuk menemukan kamar yang tepat untuk Anda.</p>
</div>

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
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text">Harga Min</label>
                <input type="text" id="minPriceDisplay" value="{{ request('min_price') ? number_format(request('min_price'), 0, ',', '.') : '' }}" 
                       placeholder="Contoh: 100.000"
                       class="h-8 border border-ant-border rounded-ant px-3 text-sm focus:border-ant-primary focus:outline-none transition-all">
                <input type="hidden" name="min_price" id="minPriceValue" value="{{ request('min_price') }}">
            </div>

             {{-- MAX PRICE --}}
             <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text">Harga Max</label>
                <input type="text" id="maxPriceDisplay" value="{{ request('max_price') ? number_format(request('max_price'), 0, ',', '.') : '' }}" 
                       placeholder="Contoh: 1.000.000"
                       class="h-8 border border-ant-border rounded-ant px-3 text-sm focus:border-ant-primary focus:outline-none transition-all">
                <input type="hidden" name="max_price" id="maxPriceValue" value="{{ request('max_price') }}">
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
            <a href="{{ route('tamu.kamar.list') }}" class="h-8 px-4 bg-slate-100 text-slate-600 rounded-ant flex items-center justify-center text-sm font-medium hover:bg-slate-200 hover:text-slate-800 transition-all shadow-sm">
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

{{-- ROOMS LIST --}}
@if($kamar->isEmpty())
    <div class="ant-card p-12 text-center">
        <span class="material-symbols-outlined text- ant-textSecondary text-[64px] mb-4">search_off</span>
        <h4 class="text-lg font-bold text-ant-text">Kamar Tidak Ditemukan</h4>
        <p class="text-ant-textSecondary text-sm mt-1">Coba sesuaikan filter pencarian Anda.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($kamar as $k)
            <div class="ant-card overflow-hidden h-full flex flex-col group">
                {{-- FOTO --}}
                <div class="h-44 bg-ant-bg relative overflow-hidden">
                    @if($k->foto_utama)
                        @php
                            $isUrl = str_starts_with($k->foto_utama, 'http://') || str_starts_with($k->foto_utama, 'https://');
                            $imageUrl = $isUrl ? $k->foto_utama : asset('uploads/kamar/' . $k->foto_utama);
                        @endphp
                        <img src="{{ $imageUrl }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center text-ant-textSecondary\'><span class=\'material-symbols-outlined text-[32px]\'>image</span><span class=\'text-[10px] uppercase font-bold tracking-tighter mt-1\'>No Photo</span></div>'">
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
                           class="inline-flex w-full h-10 items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-500/30 hover:from-blue-600 hover:to-purple-700 transition-all">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="mt-12 flex justify-center">
        {{ $kamar->links() }}
    </div>
@endif

<script>
    // Format input harga dengan pemisah ribuan
    document.addEventListener('DOMContentLoaded', function() {
        function formatRupiah(input, hiddenInput) {
            input.addEventListener('input', function(e) {
                // Hapus semua karakter non-digit
                let value = this.value.replace(/\D/g, '');
                
                // Update hidden input dengan nilai asli (tanpa format)
                hiddenInput.value = value;
                
                // Format dengan pemisah ribuan
                if (value) {
                    this.value = new Intl.NumberFormat('id-ID').format(value);
                } else {
                    this.value = '';
                }
            });
            
            // Trigger format saat halaman dimuat (jika ada nilai)
            if (input.value) {
                let value = input.value.replace(/\D/g, '');
                hiddenInput.value = value;
                if (value) {
                    input.value = new Intl.NumberFormat('id-ID').format(value);
                }
            }
        }
        
        // Apply formatter ke input harga min dan max
        const minPriceDisplay = document.getElementById('minPriceDisplay');
        const minPriceValue = document.getElementById('minPriceValue');
        const maxPriceDisplay = document.getElementById('maxPriceDisplay');
        const maxPriceValue = document.getElementById('maxPriceValue');
        
        if (minPriceDisplay && minPriceValue) {
            formatRupiah(minPriceDisplay, minPriceValue);
        }
        
        if (maxPriceDisplay && maxPriceValue) {
            formatRupiah(maxPriceDisplay, maxPriceValue);
        }
    });
</script>

@endsection
