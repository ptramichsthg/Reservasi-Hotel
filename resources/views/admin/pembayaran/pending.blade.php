@extends('layouts.admin')

@section('content')

<<<<<<< HEAD
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
=======
<h1 class="text-3xl font-bold mb-6 flex items-center gap-2">
    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <span>Pembayaran Pending</span>
</h1>

<div class="bg-white rounded-xl shadow p-6">
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="bg-ant-successBg border border-ant-successBorder text-ant-successText px-4 py-3 rounded-lg flex items-center gap-3 animate-slide-up">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

<<<<<<< HEAD
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
                                       class="inline-flex items-center gap-2 px-3 py-1.5 bg-ant-bg border border-ant-borderSplit text-ant-textSecondary text-[12px] font-bold rounded-lg transition-all hover:bg-white hover:text-ant-primary hover:border-ant-primary shadow-sm group/zoom">
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
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-white border border-red-500 text-red-500 text-[12px] font-bold rounded-lg transition-all hover:bg-red-50 group/btn-reject">
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
=======
    <table class="w-full">
        <thead>
            <tr class="text-left border-b">
                <th class="py-3">ID</th>
                <th class="py-3">User</th>
                <th class="py-3">Kamar</th>
                <th class="py-3">Bukti Pembayaran</th>
                <th class="py-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($payments as $pay)
            <tr class="border-b hover:bg-gray-100">

                <td class="py-3">{{ $pay->id }}</td>

                <td class="py-3">
                    {{ $pay->reservasi->user->name ?? 'Tidak Diketahui' }}
                </td>

                <td class="py-3">
                    {{ $pay->reservasi->kamar->tipe_kamar ?? 'Tidak Ada' }}
                </td>

                <td class="py-3">
                    <a href="{{ asset('uploads/bukti/' . $pay->bukti_pembayaran) }}"
                       target="_blank"
                       class="text-blue-600 underline">
                        Lihat Bukti
                    </a>
                </td>

                <td class="py-3 flex gap-3">

                    <form action="{{ route('admin.payment.verify', $pay->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Konfirmasi</span>
                        </button>
                    </form>

                    <form action="{{ route('admin.payment.reject', $pay->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Tolak</span>
                        </button>
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
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



