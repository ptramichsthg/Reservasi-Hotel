@extends('layouts.admin')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-2">📊 Laporan Kamar</h1>
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
        <h2 class="text-xl font-bold text-gray-800">📄 Daftar Kamar</h2>

        <a href="{{ route('admin.laporan.export.kamar') }}"
           class="px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
            ⬇ Export Laporan
        </a>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-gray-300 text-gray-700">
                <th class="p-3">Tipe Kamar</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Status</th>
                <th class="p-3">Kapasitas</th>
                <th class="p-3">Fasilitas</th>
            </tr>
        </thead>

        <tbody>
            @foreach($kamar_list as $k)
                <tr class="border-b border-gray-200 hover:bg-gray-100/40 transition">

                    <td class="p-3 font-medium">
                        {{ $k->tipe_kamar }}
                    </td>

                    <td class="p-3">
                        Rp {{ number_format($k->harga, 0, ',', '.') }}
                    </td>

                    <td class="p-3">
                        @php
                            $color = match($k->status) {
                                'available'   => 'text-green-600',
                                'booked'      => 'text-orange-500',
                                'maintenance' => 'text-blue-600',
                                'unavailable' => 'text-red-600',
                                default       => 'text-gray-500'
                            };
                        @endphp
                        <span class="font-semibold {{ $color }}">
                            {{ ucfirst($k->status) }}
                        </span>
                    </td>

                    <td class="p-3">
                        {{ $k->kapasitas }} orang
                    </td>

                    <td class="p-3">
                        @if(is_array($k->fasilitas))
                            {{ implode(', ', $k->fasilitas) }}
                        @else
                            -
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
