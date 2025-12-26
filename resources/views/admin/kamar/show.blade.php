@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto p-8 glass rounded-3xl shadow-xl">

    <h1 class="text-3xl font-bold text-blue-900 mb-6">
        🏨 Detail Kamar: {{ $kamar->tipe_kamar }}
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
        <h2 class="text-xl font-semibold mb-2">📄 Deskripsi</h2>

        <p class="text-gray-800">
            {{ $kamar->deskripsi ?? 'Tidak ada deskripsi.' }}
        </p>
    </div>

    {{-- FASILITAS --}}
    <div class="mt-8 p-5 bg-white/70 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-3">🛠️ Fasilitas</h2>

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
                  rounded-xl hover:bg-blue-700 transition">
           ✏ Edit Kamar
        </a>

    </div>

</div>

@endsection
