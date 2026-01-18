@extends('layouts.admin')

@section('content')

<div class="p-6 md:p-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-ant-textSecondary text-xs mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-ant-primary transition-colors">Dashboard</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-ant-text">Pembayaran Tertunda</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-ant-text flex items-center gap-3">
                <span class="material-symbols-outlined text-orange-500 text-[32px]">pending_actions</span>
                Pembayaran Tertunda
            </h1>
            <p class="text-sm text-ant-textSecondary mt-1">Daftar bukti transfer yang baru masuk dan butuh verifikasi segera.</p>
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
                    <span class="material-symbols-outlined text-ant-textSecondary text-[48px]">history_toggle_off</span>
                </div>
                <h4 class="text-lg font-bold text-ant-text mb-2">Tidak Ada Antrian</h4>
                <p class="text-ant-textSecondary text-sm mb-0">Semua bukti pembayaran telah diverifikasi dengan rapi.</p>
            </div>
        @else
            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">ID</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Tamu</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Tipe Kamar</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Bukti</th>
                            <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ant-borderSplit">
                        @foreach($payments as $pay)
                            <tr class="hover:bg-ant-bg/30 transition-all duration-200 group">
                                <td class="py-4 px-6">
                                    <span class="font-mono font-bold text-ant-primary text-xs">#{{ $pay->id }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="font-bold text-ant-text">{{ $pay->reservasi->user->name ?? 'N/A' }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="text-ant-textSecondary">{{ $pay->reservasi->kamar->tipe_kamar ?? '-' }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ asset('storage/uploads/bukti/' . $pay->bukti_pembayaran) }}" target="_blank" 
                                       class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-600 text-white text-[12px] font-bold rounded-lg transition-all hover:bg-slate-700 shadow-md hover:shadow-lg group/zoom">
                                        <span class="material-symbols-outlined text-[16px] group-hover/zoom:scale-125 transition-transform">visibility</span>
                                        Preview
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="{{ route('admin.payment.verify', $pay->id) }}" method="POST" class="inline" onsubmit="return confirm('Konfirmasi pembayaran ini?')">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-ant-primary text-white text-[12px] font-bold rounded-lg transition-all hover:bg-ant-primaryHover shadow-sm shadow-ant-primary/20 group/btn">
                                                <span class="material-symbols-outlined text-[16px] group-hover/btn:scale-110 transition-transform">check_circle</span>
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.payment.reject', $pay->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak pembayaran ini?')">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-red-500 text-white text-[12px] font-bold rounded-lg transition-all hover:bg-red-600 shadow-sm shadow-red-500/20 group/btn-reject">
                                                <span class="material-symbols-outlined text-[16px] group-hover/btn-reject:rotate-12 transition-transform">cancel</span>
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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



