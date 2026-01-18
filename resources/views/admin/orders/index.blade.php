@extends('layouts.admin')

@section('content')

<div class="p-6 md:p-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-ant-text flex items-center gap-3">
                <span class="material-symbols-outlined text-ant-primary text-[32px]">receipt_long</span>
                Data Reservasi
            </h1>
            <p class="text-sm text-ant-textSecondary mt-1">Daftar lengkap semua pemesanan kamar dari tamu.</p>
        </div>
    </div>

    {{-- ORDERS TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-ant-borderSplit overflow-hidden animate-slide-up">
        @if($orders->isEmpty())
            <div class="p-24 text-center">
                <div class="w-20 h-20 bg-ant-bg rounded-full flex items-center justify-center mx-auto mb-6 border border-ant-borderSplit/50 shadow-inner">
                    <span class="material-symbols-outlined text-ant-textSecondary text-[48px]">inbox</span>
                </div>
                <h4 class="text-lg font-bold text-ant-text mb-2">Belum Ada Data Reservasi</h4>
                <p class="text-ant-textSecondary text-sm mb-0">Saat ini belum ada pemesanan kamar yang tercatat di sistem.</p>
            </div>
        @else
            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">ID Reservasi</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Informasi Tamu</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Pilihan Kamar</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Periode Menginap</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Status</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ant-borderSplit">
                        @foreach($orders as $o)
                            @php
                                $statusConfig = match($o->status_reservasi ?? 'pending') {
                                    'confirmed' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'label' => 'Confirmed', 'icon' => 'check_circle'],
                                    'completed' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'label' => 'Completed', 'icon' => 'task_alt'],
                                    'cancelled' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'label' => 'Cancelled', 'icon' => 'cancel'],
                                    default => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'border' => 'border-orange-200', 'label' => 'Pending', 'icon' => 'schedule'],
                                };
                            @endphp
                            <tr class="hover:bg-ant-bg/30 transition-all duration-200 group">
                                <td class="py-4 px-6 font-mono font-bold text-ant-primary text-xs">
                                    #{{ str_pad($o->id_reservasi, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-ant-bg border border-ant-borderSplit flex items-center justify-center text-ant-textSecondary font-bold text-xs group-hover:bg-ant-primary group-hover:text-white transition-colors">
                                            {{ strtoupper(substr($o->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-ant-text leading-none">{{ $o->user->name }}</p>
                                            <p class="text-[10px] text-ant-textQuaternary mt-1">Guest Member</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-ant-text">{{ $o->kamar->tipe_kamar }}</span>
                                        <span class="text-[11px] text-ant-textQuaternary">Rp {{ number_format($o->kamar->harga, 0, ',', '.') }} / malam</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-4 text-ant-textSecondary">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-ant-textQuaternary">Check-In</span>
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($o->tgl_checkin)->format('d M Y') }}</span>
                                        </div>
                                        <span class="material-symbols-outlined text-[16px] text-ant-textQuaternary">arrow_forward</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-bold uppercase tracking-wider text-ant-textQuaternary">Check-Out</span>
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($o->tgl_checkout)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }} text-[10px] font-bold rounded-full border uppercase tracking-tighter shadow-sm">
                                        <span class="material-symbols-outlined text-[14px]">{{ $statusConfig['icon'] }}</span>
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('admin.orders.show', $o->id_reservasi) }}" 
                                       class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-[13px] font-bold rounded-lg transition-all hover:from-blue-600 hover:to-indigo-700 shadow-md hover:shadow-lg group/btn">
                                        <span class="material-symbols-outlined text-[16px] group-hover/btn:scale-110 transition-transform">visibility</span>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if(method_exists($orders, 'links'))
                <div class="px-6 py-4 bg-ant-bg/10 border-t border-ant-borderSplit">
                    {{ $orders->links() }}
                </div>
            @endif
        @endif
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
