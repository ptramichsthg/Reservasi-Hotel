@extends('layouts.admin')

@section('content')

<div class="p-6 md:p-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-ant-text flex items-center gap-3">
                <span class="material-symbols-outlined text-ant-primary text-[32px]">payments</span>
                Verifikasi Pembayaran
            </h1>
            <p class="text-sm text-ant-textSecondary mt-1">Konfirmasi bukti transfer yang diunggah oleh tamu.</p>
        </div>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="bg-ant-successBg border border-ant-successBorder text-ant-successText px-4 py-3 rounded-lg flex items-center gap-3 animate-slide-up">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- PAYMENTS TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-ant-borderSplit overflow-hidden animate-slide-up">
        @if($payments->isEmpty())
            <div class="p-24 text-center">
                <div class="w-20 h-20 bg-ant-bg rounded-full flex items-center justify-center mx-auto mb-6 border border-ant-borderSplit/50 shadow-inner">
                    <span class="material-symbols-outlined text-ant-textSecondary text-[48px]">receipt</span>
                </div>
                <h4 class="text-lg font-bold text-ant-text mb-2">Belum Ada Pembayaran</h4>
                <p class="text-ant-textSecondary text-sm mb-0">Saat ini belum ada bukti pembayaran yang perlu diverifikasi.</p>
            </div>
        @else
            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">ID Reservasi</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Informasi Tamu</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Bukti Transfer</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Status</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ant-borderSplit">
                        @foreach($payments as $pay)
                            @php
                                $statusConfig = match($pay->status) {
                                    'confirmed' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'label' => 'Terverifikasi', 'icon' => 'verified'],
                                    'rejected'  => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'label' => 'Ditolak', 'icon' => 'block'],
                                    default     => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'border' => 'border-orange-200', 'label' => 'Pending', 'icon' => 'schedule'],
                                };
                            @endphp
                            <tr class="hover:bg-ant-bg/30 transition-all duration-200 group">
                                <td class="py-4 px-6 font-mono font-bold text-ant-primary text-xs">
                                    #{{ str_pad($pay->reservasi_id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex flex-col">
                                        <p class="font-bold text-ant-text">{{ $pay->reservasi->user->name ?? 'N/A' }}</p>
                                        <p class="text-[11px] text-ant-textQuaternary italic">{{ $pay->reservasi->kamar->tipe_kamar ?? '-' }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ asset('storage/uploads/bukti/'.$pay->bukti_pembayaran) }}" target="_blank" 
                                       class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-600 text-white text-[12px] font-bold rounded-lg transition-all hover:bg-slate-700 shadow-md hover:shadow-lg group/zoom">
                                        <span class="material-symbols-outlined text-[16px] group-hover/zoom:scale-125 transition-transform">zoom_in</span>
                                        Lihat Bukti
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }} text-[10px] font-bold rounded-full border uppercase tracking-tighter">
                                        <span class="material-symbols-outlined text-[14px]">{{ $statusConfig['icon'] }}</span>
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if($pay->status === 'pending')
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('admin.payment.verify', $pay->id) }}" method="POST" class="inline-block"
                                                  onsubmit="return confirm('Konfirmasi pembayaran ini?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-ant-primary text-white text-[12px] font-bold rounded-lg transition-all hover:bg-ant-primaryHover shadow-sm shadow-ant-primary/20 group/btn">
                                                    <span class="material-symbols-outlined text-[16px] group-hover/btn:scale-110 transition-transform">check_circle</span>
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.payment.reject', $pay->id) }}" method="POST" class="inline-block"
                                                  onsubmit="return confirm('Tolak pembayaran ini?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-red-500 text-white text-[12px] font-bold rounded-lg transition-all hover:bg-red-600 shadow-sm shadow-red-500/20 group/btn-reject">
                                                    <span class="material-symbols-outlined text-[16px] group-hover/btn-reject:rotate-12 transition-transform">cancel</span>
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="flex flex-col items-center opacity-60">
                                            <span class="text-[10px] text-ant-textQuaternary font-bold uppercase tracking-widest mb-1">Diverifikasi oleh</span>
                                            <p class="text-xs font-bold text-ant-text">{{ $pay->admin->name ?? 'System' }}</p>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if(method_exists($payments, 'links'))
                <div class="px-6 py-4 bg-ant-bg/10 border-t border-ant-borderSplit">
                    {{ $payments->links() }}
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
