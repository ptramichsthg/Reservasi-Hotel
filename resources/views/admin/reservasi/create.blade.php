@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto py-8 animate-fade-in">
    {{-- BREADCRUMBS --}}
    <div class="flex items-center gap-2 text-ant-textSecondary text-xs mb-4">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-ant-primary transition-colors">Dashboard</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="{{ route('admin.orders.index') }}" class="hover:text-ant-primary transition-colors">Manajemen Reservasi</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-ant-text font-medium">Buat Reservasi</span>
    </div>

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-ant-text flex items-center gap-3">
            <div class="w-10 h-10 bg-ant-primary/10 rounded-xl flex items-center justify-center text-ant-primary shadow-sm">
                <span class="material-symbols-outlined text-[24px]">book_online</span>
            </div>
            Reservasi Kamar
        </h1>
        <p class="text-sm text-ant-textSecondary mt-2">Membuat pesanan baru untuk tipe kamar: <span class="font-bold text-ant-text">{{ $kamar->tipe_kamar }}</span></p>
    </div>

    {{-- FORM CARD --}}
    <div class="ant-card bg-white shadow-sm overflow-hidden">
        <div class="p-8">
            <form action="{{ route('tamu.order.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- ID Kamar --}}
                <input type="hidden" name="id_kamar" value="{{ $kamar->id_kamar }}">

                {{-- Tanggal Check-in --}}
                <div class="space-y-1.5">
                    <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">login</span>
                        Tanggal Check In
                    </label>
                    <input type="date" name="tgl_checkin" required
                           class="w-full px-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
                </div>

                {{-- Tanggal Check-out --}}
                <div class="space-y-1.5">
                    <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">logout</span>
                        Tanggal Check Out
                    </label>
                    <input type="date" name="tgl_checkout" required
                           class="w-full px-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
                </div>

                {{-- Jumlah Tamu --}}
                <div class="space-y-1.5">
                    <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">group</span>
                        Jumlah Tamu
                    </label>
                    <div class="relative">
                        <input type="number" name="jumlah_tamu" value="1" min="1" max="{{ $kamar->kapasitas }}" required
                               class="w-full px-4 py-2.5 border border-ant-border rounded-lg text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-ant-textQuaternary uppercase">Maks: {{ $kamar->kapasitas }}</span>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="pt-6 border-t border-ant-borderSplit">
                    <button type="submit" class="w-full ant-btn-primary h-12 shadow-lg shadow-ant-primary/20">
                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        Konfirmasi Reservasi
                    </button>
                    <a href="{{ route('admin.kamar.index') }}" class="block text-center mt-4 text-ant-textSecondary hover:underline text-xs font-medium">
                        Batal dan kembali ke daftar kamar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
</style>

@endsection



