@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow">

    <h2 class="text-2xl font-bold text-blue-700 mb-6 flex items-center gap-2">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <span>Reservasi Kamar: {{ $kamar->tipe_kamar }}</span>
    </h2>

    <form action="{{ route('tamu.order.store') }}" method="POST">
        @csrf

        {{-- ID Kamar --}}
        <input type="hidden" name="id_kamar" value="{{ $kamar->id_kamar }}">

        {{-- Tanggal Check-in --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tanggal Check In</label>
            <input type="date" name="tgl_checkin"
                   class="w-full p-3 border rounded-xl"
                   required>
        </div>

        {{-- Tanggal Check-out --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tanggal Check Out</label>
            <input type="date" name="tgl_checkout"
                   class="w-full p-3 border rounded-xl"
                   required>
        </div>

        {{-- Jumlah Tamu --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Jumlah Tamu</label>
            <input type="number" name="jumlah_tamu"
                   class="w-full p-3 border rounded-xl"
                   min="1"
                   max="{{ $kamar->kapasitas }}"
                   required>
        </div>

        {{-- Tombol --}}
        <button class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition">
            Buat Reservasi
        </button>
    </form>
</div>

@endsection
