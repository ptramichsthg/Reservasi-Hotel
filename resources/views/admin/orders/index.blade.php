@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-5">📑 Data Pemesanan</h1>

<div class="bg-white p-5 rounded-xl shadow">
    <table class="w-full">
        <thead>
            <tr class="text-gray-600 uppercase text-sm border-b">
                <th class="py-2 text-left">User</th>
                <th class="py-2 text-left">Kamar</th>
                <th class="py-2 text-left">Check-In</th>
                <th class="py-2 text-left">Check-Out</th>
                <th class="py-2 text-left">Status</th>
                <th class="py-2 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $o)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-2">{{ $o->user->name }}</td>
                <td class="py-2">{{ $o->kamar->tipe_kamar }}</td>
                <td class="py-2">{{ $o->tgl_checkin }}</td>
                <td class="py-2">{{ $o->tgl_checkout }}</td>
                <td class="py-2 capitalize">{{ $o->status_reservasi ?? 'pending' }}</td>

                <td class="py-2">
                    <a href="{{ route('admin.orders.show', $o->id_reservasi) }}"
                       class="px-3 py-1 bg-blue-600 text-white rounded">
                        Detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
