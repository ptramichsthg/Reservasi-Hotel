@extends('layouts.tamu')

@section('content')

<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Kamar Saya</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Daftar kamar yang sedang Anda pesan dan kelola reservasi Anda dengan mudah.</p>
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
            
            <div class="ant-card p-0 overflow-hidden">
                {{-- FOTO KAMAR --}}
                <div class="h-40 bg-ant-bg relative overflow-hidden">
                    @if($p->kamar->foto_utama)
                        @php
                            $isUrl = str_starts_with($p->kamar->foto_utama, 'http://') || str_starts_with($p->kamar->foto_utama, 'https://');
                            $imageUrl = $isUrl ? $p->kamar->foto_utama : asset('uploads/kamar/' . $p->kamar->foto_utama);
                        @endphp
                        <img src="{{ $imageUrl }}" 
                             class="w-full h-full object-cover"
                             onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-ant-textSecondary\'><span class=\'material-symbols-outlined text-[48px]\'>bed</span></div>'">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-ant-textSecondary">
                            <span class="material-symbols-outlined text-[48px]">bed</span>
                        </div>
                    @endif
                    
                    {{-- STATUS BADGE --}}
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold uppercase border backdrop-blur-sm
                                     {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                            {{ ucfirst($p->status_pembayaran) }}
                        </span>
                    </div>
                </div>

                {{-- CARD CONTENT --}}
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-base font-bold text-ant-text">{{ $p->kamar->tipe_kamar }}</h3>
                        <p class="text-[10px] text-ant-textSecondary uppercase tracking-wide">Blue Haven Hotel</p>
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
            </div>
        @endforeach
    </div>
@endif

@endsection


