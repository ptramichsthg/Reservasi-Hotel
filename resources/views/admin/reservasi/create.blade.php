@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow">

    <h2 class="text-2xl font-bold text-blue-700 mb-6">
        🛏️ Reservasi Kamar: {{ $kamar->tipe_kamar }}
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
