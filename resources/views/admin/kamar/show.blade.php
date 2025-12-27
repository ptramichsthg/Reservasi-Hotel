@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto p-8 glass rounded-3xl shadow-xl">

    <h1 class="text-3xl font-bold text-blue-900 mb-6 flex items-center gap-2">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <span>Detail Kamar: {{ $kamar->tipe_kamar }}</span>
    </h1>

    {{-- FOTO UTAMA --}}
    <div class="mb-6">
        @if($kamar->foto_utama && file_exists(public_path('uploads/kamar/' . $kamar->foto_utama)))
            <img src="{{ asset('uploads/kamar/' . $kamar->foto_utama) }}"
                 class="w-full max-h-80 object-cover rounded-xl shadow">
        @else
            <div class="w-full h-64 bg-gray-300 rounded-xl
                        flex items-center justify-center text-gray-600">
                No Photo Available
            </div>
        @endif
    </div>

    {{-- INFORMASI UTAMA --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="p-4 bg-white/60 rounded-xl shadow">
            <p class="font-semibold text-gray-700">Tipe Kamar</p>
            <p class="text-lg">{{ $kamar->tipe_kamar }}</p>
        </div>

        <div class="p-4 bg-white/60 rounded-xl shadow">
            <p class="font-semibold text-gray-700">Harga</p>
            <p class="text-lg">
                Rp {{ number_format($kamar->harga, 0, ',', '.') }}
            </p>
        </div>

        <div class="p-4 bg-white/60 rounded-xl shadow">
            <p class="font-semibold text-gray-700">Status</p>

            @php
                $badgeColor = match($kamar->status) {
                    'available'   => 'bg-green-500',
                    'booked'      => 'bg-yellow-500',
                    'maintenance' => 'bg-red-500',
                    'unavailable' => 'bg-gray-500',
                    default       => 'bg-gray-400',
                };
            @endphp

            <span class="px-4 py-1 text-white rounded-full {{ $badgeColor }}">
                {{ ucfirst($kamar->status) }}
            </span>
        </div>

    </div>

    {{-- DESKRIPSI --}}
    <div class="mt-8 p-5 bg-white/70 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-2 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span>Deskripsi</span>
        </h2>

        <p class="text-gray-800">
            {{ $kamar->deskripsi ?? 'Tidak ada deskripsi.' }}
        </p>
    </div>

    {{-- FASILITAS --}}
    <div class="mt-8 p-5 bg-white/70 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-3 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            <span>Fasilitas</span>
        </h2>

        @php
            // Accessor getFasilitasAttribute() sudah mengembalikan array
            $fasilitas = $kamar->fasilitas ?? [];
        @endphp

        @if(count($fasilitas) > 0)
            <ul class="list-disc pl-6 text-gray-800 space-y-1">
                @foreach($fasilitas as $f)
                    <li>{{ $f }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">Tidak ada fasilitas dicantumkan.</p>
        @endif
    </div>

    {{-- TOMBOL AKSI --}}
    <div class="mt-10 flex justify-between">

        <a href="{{ route('admin.kamar.index') }}"
           class="px-5 py-3 bg-gray-300 text-gray-800
                  rounded-xl hover:bg-gray-400 transition">
           ← Kembali
        </a>

        <a href="{{ route('admin.kamar.edit', $kamar->id_kamar) }}"
           class="px-5 py-3 bg-blue-600 text-white
                  rounded-xl hover:bg-blue-700 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span>Edit Kamar</span>
        </a>

    </div>

</div>

@endsection
