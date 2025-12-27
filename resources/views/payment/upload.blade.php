@extends('layouts.app')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <h1 class="text-3xl font-extrabold text-gray-700 mb-8 tracking-wide flex items-center gap-2">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
        </svg>
        <span>Upload Bukti Pembayaran</span>
    </h1>

    <div class="bg-white rounded-2xl shadow-xl p-6 max-w-xl mx-auto">

        <form action="{{ route('tamu.payment.upload') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="reservasi_id" value="{{ $reservasi_id }}">

            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2">
                    Pilih Gambar Bukti Pembayaran
                </label>
                <input type="file" name="bukti" required
                       class="w-full p-3 border border-gray-300 rounded-xl">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">
                Upload Bukti Pembayaran
            </button>
        </form>

    </div>
</div>

@endsection
