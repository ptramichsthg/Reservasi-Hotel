@extends('layouts.admin')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-2">💰 Laporan Transaksi</h1>
    <p class="text-gray-600">Riwayat pembayaran & reservasi tamu.</p>
</div>

{{-- FILTER TANGGAL --}}
<div class="glass p-6 rounded-2xl shadow mb-10">

    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div>
            <label class="font-semibold text-gray-700">Tanggal Mulai</label>
            <input type="date" name="start_date"
                   class="w-full p-3 rounded-xl border mt-1"
                   value="{{ request('start_date') }}">
        </div>

        <div>
            <label class="font-semibold text-gray-700">Tanggal Selesai</label>
            <input type="date" name="end_date"
                   class="w-full p-3 rounded-xl border mt-1"
                   value="{{ request('end_date') }}">
        </div>

        <div class="flex items-end">
            <button class="w-full py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                Terapkan Filter
            </button>
        </div>

    </form>
</div>

{{-- STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

    <div class="glass p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-600">Total Reservasi</p>
        <h2 class="text-3xl font-bold text-blue-700">{{ $stat['total_reservasi'] }}</h2>
    </div>

    <div class="glass p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-600">Pending</p>
        <h2 class="text-3xl font-bold text-orange-500">{{ $stat['pending'] }}</h2>
    </div>

    <div class="glass p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-600">Terverifikasi</p>
        <h2 class="text-3xl font-bold text-green-600">{{ $stat['verifikasi'] }}</h2>
    </div>

    <div class="glass p-6 rounded-2xl shadow hover:shadow-xl transition">
        <p class="text-gray-600">Pembayaran Ditolak</p>
        <h2 class="text-3xl font-bold text-red-600">{{ $stat['gagal'] }}</h2>
    </div>

</div>

{{-- TABEL TRANSAKSI --}}
<div class="glass p-6 rounded-3xl shadow">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">📄 Daftar Reservasi</h2>

        <a href="{{ route('admin.laporan.export.transaksi') }}"
           class="px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
            ⬇ Export Laporan
        </a>
    </div>

    <table class="w-full border-collapse text-left">
        <thead>
            <tr class="border-b border-gray-300 text-gray-700">
                <th class="p-3">Nama Tamu</th>
                <th class="p-3">Kamar</th>
                <th class="p-3">Check-in</th>
                <th class="p-3">Check-out</th>
                <th class="p-3">Total Harga</th>
                <th class="p-3">Status Pembayaran</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reservasi as $r)
                <tr class="border-b border-gray-200 hover:bg-gray-100/40 transition">

                    {{-- Nama User --}}
                    <td class="p-3 font-medium">
                        {{ $r->user->name ?? '-' }}
                    </td>

                    {{-- Tipe Kamar --}}
                    <td class="p-3">
                        {{ $r->kamar->tipe_kamar ?? '-' }}
                    </td>

                    {{-- Check-in --}}
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($r->tgl_checkin)->format('d M Y') }}
                    </td>

                    {{-- Check-out --}}
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($r->tgl_checkout)->format('d M Y') }}
                    </td>

                    {{-- Total Harga --}}
                    <td class="p-3 text-blue-600 font-semibold">
                        Rp {{ number_format($r->total_harga ?? 0, 0, ',', '.') }}
                    </td>

                    {{-- Status Pembayaran --}}
                    <td class="p-3">
                        @php
                            $color = match($r->status_pembayaran) {
                                'pending'  => 'text-orange-500',
                                'verified' => 'text-green-600',
                                'rejected' => 'text-red-600',
                                default    => 'text-gray-500'
                            };
                        @endphp

                        <span class="font-bold {{ $color }}">
                            {{ ucfirst($r->status_pembayaran) }}
                        </span>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
