@extends('layouts.admin')

@section('content')

<div class="p-6 md:p-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-ant-text flex items-center gap-3">
                <span class="material-symbols-outlined text-ant-primary text-[32px]">payments</span>
                Laporan Transaksi
            </h1>
            <p class="text-sm text-ant-textSecondary mt-1">Riwayat pembayaran & reservasi tamu secara mendalam.</p>
        </div>
        <a href="{{ route('admin.laporan.export.transaksi') }}" class="ant-btn-primary h-11 px-6 shadow-lg shadow-ant-primary/20 transition-all hover:scale-105 active:scale-95">
            <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
            Export Laporan PDF
        </a>
    </div>

    {{-- FILTER TANGGAL --}}
    <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm">
        <form method="GET" class="flex flex-wrap items-end gap-6">
            <div class="space-y-1.5 min-w-[200px]">
                <label class="text-[11px] font-bold text-ant-textSecondary uppercase tracking-wider flex items-center gap-1.5 text-ant-textQuaternary">
                    <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                    Tanggal Mulai
                </label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                       class="w-full bg-ant-bg/50 border border-ant-borderSplit rounded-lg px-4 py-2 text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
            </div>

            <div class="space-y-1.5 min-w-[200px]">
                <label class="text-[11px] font-bold text-ant-textSecondary uppercase tracking-wider flex items-center gap-1.5 text-ant-textQuaternary">
                    <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                    Tanggal Selesai
                </label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                       class="w-full bg-ant-bg/50 border border-ant-borderSplit rounded-lg px-4 py-2 text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
            </div>

            <button type="submit" class="bg-ant-primary text-white h-10 px-8 rounded-lg text-sm font-bold hover:bg-ant-primaryHover transition-all shadow-md active:scale-95">
                Terapkan Filter
            </button>
            <a href="{{ route('admin.laporan.transaksi') }}" class="h-10 px-4 flex items-center text-ant-textSecondary hover:text-ant-text text-sm transition-colors font-medium">
                Reset
            </a>
        </form>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up">
        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Total Reservasi</span>
            </div>
            <div class="text-3xl font-bold text-ant-text">{{ $stat['total_reservasi'] }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center group-hover:bg-orange-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">pending_actions</span>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Pending</span>
            </div>
            <div class="text-3xl font-bold text-orange-600">{{ $stat['pending'] }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <div class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Terverifikasi</span>
            </div>
            <div class="text-3xl font-bold text-green-600">{{ $stat['verifikasi'] }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">cancel</span>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Ditolak</span>
            </div>
            <div class="text-3xl font-bold text-red-600">{{ $stat['gagal'] }}</div>
        </div>
    </div>

    {{-- TABEL TRANSAKSI --}}
    <div class="bg-white rounded-2xl shadow-sm border border-ant-borderSplit overflow-hidden animate-slide-up" style="animation-delay: 0.1s">
        <div class="px-6 py-4 border-b border-ant-borderSplit bg-ant-bg/20 flex items-center justify-between">
            <h2 class="text-base font-bold text-ant-text flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-ant-textQuaternary">list_alt</span>
                Daftar Detail Reservasi
            </h2>
        </div>
        <div class="overflow-x-auto text-sm">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Identitas Tamu</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Kamar</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Durasi Menginap</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Total Harga</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ant-borderSplit">
                    @forelse($reservasi as $r)
                        <tr class="hover:bg-ant-bg/30 transition-all duration-200 group">
                            <td class="py-4 px-6">
                                <p class="font-bold text-ant-text leading-none group-hover:text-ant-primary transition-colors">{{ $r->user->name ?? '-' }}</p>
                                <p class="text-[10px] text-ant-textQuaternary mt-1">Guest ID: #{{ str_pad($r->id_user ?? 0, 4, '0', STR_PAD_LEFT) }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-medium text-ant-text">{{ $r->kamar->tipe_kamar ?? '-' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col text-[12px] text-ant-textSecondary">
                                    <span>{{ \Carbon\Carbon::parse($r->tgl_checkin)->format('d/m/Y') }}</span>
                                    <span class="text-[10px] text-ant-textQuaternary">hingga</span>
                                    <span>{{ \Carbon\Carbon::parse($r->tgl_checkout)->format('d/m/Y') }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-base font-bold text-ant-primary">
                                    Rp {{ number_format($r->total_harga ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @php
                                    $statusConfig = match($r->status_pembayaran) {
                                        'pending'  => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'border' => 'border-orange-200', 'label' => 'Pending'],
                                        'confirmed' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'label' => 'Verified'],
                                        'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'label' => 'Rejected'],
                                        default    => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'border' => 'border-gray-200', 'label' => ucfirst($r->status_pembayaran)]
                                    };
                                @endphp
                                <span class="inline-flex px-3 py-1 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }} text-[10px] font-bold rounded-full border uppercase tracking-tighter">
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-24 text-center">
                                <div class="w-20 h-20 bg-ant-bg rounded-full flex items-center justify-center mx-auto mb-6 border border-ant-borderSplit/50 shadow-inner">
                                    <span class="material-symbols-outlined text-ant-textSecondary text-[48px]">money_off</span>
                                </div>
                                <h4 class="text-lg font-bold text-ant-text mb-2">Tidak Ada Transaksi</h4>
                                <p class="text-ant-textSecondary text-sm">Sesuaikan filter tanggal untuk melihat data transaksi lainnya.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up {
        animation: slide-up 0.4s ease-out forwards;
    }
</style>

@endsection
