@extends('layouts.app')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <h1 class="text-3xl font-extrabold text-gray-700 mb-8 tracking-wide">
        💳 Upload Bukti Pembayaran
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
