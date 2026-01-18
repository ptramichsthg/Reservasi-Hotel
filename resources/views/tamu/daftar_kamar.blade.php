@extends('layouts.tamu')

@section('content')

<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Daftar Kamar Tersedia</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Pilih kamar yang sesuai dengan kebutuhan Anda dan lakukan reservasi dengan mudah.</p>
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
                    @if($k->foto_utama)
                        @php
                            // Cek apakah URL external atau file lokal
                            $isUrl = str_starts_with($k->foto_utama, 'http://') || str_starts_with($k->foto_utama, 'https://');
                            $imageUrl = $isUrl ? $k->foto_utama : asset('uploads/kamar/' . $k->foto_utama);
                        @endphp
                        <img src="{{ $imageUrl }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex flex-col items-center justify-center text-ant-textSecondary\'><span class=\'material-symbols-outlined text-[48px]\'>bed</span><span class=\'text-[10px] uppercase font-bold tracking-tighter mt-2\'>{{ $k->tipe_kamar }}</span></div>'">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-ant-textSecondary">
                            <span class="material-symbols-outlined text-[48px]">bed</span>
                            <span class="text-[10px] uppercase font-bold tracking-tighter mt-2">{{ $k->tipe_kamar }}</span>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span class="bg-white/90 backdrop-blur px-2 py-1 rounded text-[10px] font-bold uppercase 
                                     {{ $k->status === 'available' ? 'text-green-600' : 'text-red-600' }} shadow-sm">
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
                           class="inline-flex w-full h-10 items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-500/30 hover:from-blue-600 hover:to-purple-700 transition-all">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection

