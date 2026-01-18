@extends('layouts.tamu')

@section('content')

<div class="mb-8">
    <h2 class="text-2xl font-bold text-ant-text">Pembayaran</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Kelola pembayaran reservasi Anda yang menunggu pembayaran</p>
</div>

@if($pemesanan->isEmpty())
    {{-- EMPTY STATE --}}
    <div class="ant-card p-12 text-center">
        <span class="material-symbols-outlined text-ant-textSecondary text-[64px] mb-4 block">payments</span>
        <h3 class="text-lg font-bold text-ant-text mb-2">Tidak Ada Pembayaran Pending</h3>
        <p class="text-sm text-ant-textSecondary mb-6">Semua pembayaran Anda sudah lunas atau belum ada reservasi.</p>
        <a href="{{ route('tamu.kamar.list') }}" class="ant-btn-primary inline-flex">
            <span class="material-symbols-outlined text-[18px]">search</span>
            Cari Kamar
        </a>
    </div>
@else
    {{-- TABLE PEMBAYARAN --}}
    <div class="ant-card overflow-hidden">
        <div class="px-6 py-4 border-b border-ant-borderSplit bg-ant-bg/20">
            <h3 class="text-sm font-bold text-ant-text flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-ant-textQuaternary">pending_actions</span>
                Reservasi Menunggu Pembayaran
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">ID</th>
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Tipe Kamar</th>
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Check-in</th>
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Check-out</th>
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Durasi</th>
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Total Harga</th>
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Status</th>
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ant-borderSplit">
                    @foreach($pemesanan as $p)
                        @php
                            $checkin = \Carbon\Carbon::parse($p->tgl_checkin);
                            $checkout = \Carbon\Carbon::parse($p->tgl_checkout);
                            $durasi = $checkin->diffInDays($checkout);
                            $totalHarga = $p->kamar->harga * $durasi;
                        @endphp
                        <tr class="hover:bg-ant-bg/30 transition-colors">
                            <td class="py-3 px-6 font-mono text-xs text-ant-textSecondary">#{{ $p->id_reservasi }}</td>
                            <td class="py-3 px-6">
                                <div class="font-medium text-ant-text">{{ $p->kamar->tipe_kamar }}</div>
                                <div class="text-xs text-ant-textSecondary">{{ $p->kamar->nomor_kamar }}</div>
                            </td>
                            <td class="py-3 px-6 text-ant-text">{{ date('d M Y', strtotime($p->tgl_checkin)) }}</td>
                            <td class="py-3 px-6 text-ant-text">{{ date('d M Y', strtotime($p->tgl_checkout)) }}</td>
                            <td class="py-3 px-6 text-ant-text">{{ $durasi }} malam</td>
                            <td class="py-3 px-6 font-bold text-green-600">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                            <td class="py-3 px-6">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-bold bg-orange-100 text-orange-700">
                                    <span class="material-symbols-outlined text-[14px]">pending</span>
                                    PENDING
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if($p->pembayaran()->exists())
                                    <span class="text-xs text-ant-textSecondary italic">Menunggu Verifikasi</span>
                                @else
                                    <a href="{{ route('tamu.payment.upload.form', $p->id_reservasi) }}" 
                                       class="ant-btn-primary text-xs">
                                        <span class="material-symbols-outlined text-[16px]">upload</span>
                                        Upload Bukti
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- INFO PEMBAYARAN --}}
    <div class="ant-card p-6 mt-6">
        <h3 class="text-sm font-bold text-ant-text mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px] text-ant-primary">info</span>
            Informasi Pembayaran
        </h3>
        <div class="space-y-3 text-sm text-ant-text">
            <div class="flex items-start gap-2">
                <span class="material-symbols-outlined text-[18px] text-ant-textSecondary mt-0.5">check_circle</span>
                <p>Silakan transfer sesuai total harga ke rekening hotel</p>
            </div>
            <div class="flex items-start gap-2">
                <span class="material-symbols-outlined text-[18px] text-ant-textSecondary mt-0.5">check_circle</span>
                <p>Upload bukti pembayaran dengan klik tombol "Upload Bukti"</p>
            </div>
            <div class="flex items-start gap-2">
                <span class="material-symbols-outlined text-[18px] text-ant-textSecondary mt-0.5">check_circle</span>
                <p>Tunggu verifikasi dari admin (maksimal 1x24 jam)</p>
            </div>
        </div>
    </div>
@endif

@endsection
