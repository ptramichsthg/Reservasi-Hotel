@extends('layouts.admin')

@section('content')

<<<<<<< HEAD
<div class="p-6 md:p-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-ant-text flex items-center gap-3">
                <span class="material-symbols-outlined text-ant-primary text-[32px]">analytics</span>
                Laporan Kamar
            </h1>
            <p class="text-sm text-ant-textSecondary mt-1">Analisis ketersediaan dan status seluruh tipe kamar hotel.</p>
        </div>
        <a href="{{ route('admin.laporan.export.kamar') }}" class="ant-btn-primary h-11 px-6 shadow-lg shadow-ant-primary/20 transition-all hover:scale-105 active:scale-95">
            <span class="material-symbols-outlined text-[20px]">download</span>
            Export Laporan Kamar
=======
<div class="mb-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-2 flex items-center gap-2">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
        <span>Laporan Kamar</span>
    </h1>
    <p class="text-gray-600">Statistik seluruh kamar dalam sistem.</p>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

    <div class="glass p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-600">Total Kamar</p>
        <h2 class="text-3xl font-bold text-blue-700">{{ $stat['total_kamar'] }}</h2>
    </div>

    <div class="glass p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-600">Available</p>
        <h2 class="text-3xl font-bold text-green-600">{{ $stat['available'] }}</h2>
    </div>

    <div class="glass p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-600">Booked</p>
        <h2 class="text-3xl font-bold text-orange-500">{{ $stat['booked'] }}</h2>
    </div>

    <div class="glass p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-600">Maintenance / Unavailable</p>
        <h2 class="text-3xl font-bold text-red-600">
            {{ $stat['maintenance'] + $stat['unavailable'] }}
        </h2>
    </div>

</div>

{{-- TABEL KAMAR --}}
<div class="glass p-6 rounded-3xl shadow">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span>Daftar Kamar</span>
        </h2>

        <a href="{{ route('admin.laporan.export.kamar') }}"
           class="px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
            ⬇ Export Laporan
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up">
        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm group hover:border-ant-primary/30 transition-all">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">hotel</span>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Total Kamar</span>
            </div>
            <div class="text-3xl font-bold text-ant-text">{{ $stat['total_kamar'] }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm group hover:border-green-200 transition-all">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <div class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Available</span>
            </div>
            <div class="text-3xl font-bold text-green-600">{{ $stat['available'] }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm group hover:border-orange-200 transition-all">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center group-hover:bg-orange-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">event_busy</span>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Booked</span>
            </div>
            <div class="text-3xl font-bold text-orange-600">{{ $stat['booked'] }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm group hover:border-red-200 transition-all">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">build</span>
                </div>
                <span class="text-xs font-bold uppercase tracking-widest">Maintenance</span>
            </div>
            <div class="text-3xl font-bold text-red-600">
                {{ $stat['maintenance'] + $stat['unavailable'] }}
            </div>
        </div>
    </div>

    {{-- TABEL KAMAR --}}
    <div class="bg-white rounded-2xl shadow-sm border border-ant-borderSplit overflow-hidden animate-slide-up" style="animation-delay: 0.1s">
        <div class="px-6 py-4 border-b border-ant-borderSplit bg-ant-bg/20">
            <h2 class="text-base font-bold text-ant-text flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-ant-textQuaternary">description</span>
                Daftar Detail Kamar & Fasilitas
            </h2>
        </div>
        <div class="overflow-x-auto text-sm">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Tipe Kamar</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Harga</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Kapasitas</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Status</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Fasilitas Unggulan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ant-borderSplit">
                    @foreach($kamar_list as $k)
                        <tr class="hover:bg-ant-bg/30 transition-all duration-200 group">
                            <td class="py-4 px-6">
                                <span class="font-bold text-ant-text group-hover:text-ant-primary transition-colors text-base">{{ $k->tipe_kamar }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-ant-text">Rp {{ number_format($k->harga, 0, ',', '.') }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2 text-ant-textSecondary">
                                    <span class="material-symbols-outlined text-[16px]">groups</span>
                                    <span class="font-medium">{{ $k->kapasitas }} orang</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @php
                                    $statusConfig = match($k->status) {
                                        'available'   => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200'],
                                        'booked'      => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'border' => 'border-orange-200'],
                                        'maintenance' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'border-blue-200'],
                                        'unavailable' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200'],
                                        default       => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'border' => 'border-gray-200']
                                    };
                                @endphp
                                <span class="inline-flex px-3 py-1 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }} text-[10px] font-bold rounded-full border uppercase tracking-tighter">
                                    {{ ucfirst($k->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-wrap gap-1">
                                    @if(is_array($k->fasilitas))
                                        @foreach(array_slice($k->fasilitas, 0, 4) as $f)
                                            <span class="px-2 py-0.5 bg-ant-bg border border-ant-borderSplit text-ant-textQuaternary text-[10px] rounded-md">{{ $f }}</span>
                                        @endforeach
                                        @if(count($k->fasilitas) > 4)
                                            <span class="text-[10px] text-ant-textQuaternary font-bold">+{{ count($k->fasilitas) - 4 }}</span>
                                        @endif
                                    @else
                                        <span class="text-ant-textQuaternary italic text-xs">-</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
