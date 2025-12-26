@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-5">Detail Pemesanan</h1>

<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="font-bold text-lg mb-2">Informasi Pelanggan</h2>
    <p>Nama: {{ $order->user->name }}</p>
    <p>Email: {{ $order->user->email }}</p>

    <hr class="my-4">

    <h2 class="font-bold text-lg mb-2">Informasi Kamar</h2>
    <p>Tipe: {{ $order->kamar->tipe_kamar }}</p>
    <p>Harga: Rp {{ number_format($order->kamar->harga, 0, ',', '.') }}</p>

    <hr class="my-4">

    <h2 class="font-bold text-lg mb-2">Detail Reservasi</h2>
    <p>Check-in: {{ $order->tgl_checkin }}</p>
    <p>Check-out: {{ $order->tgl_checkout }}</p>
    <p>Status Reservasi:
        <strong class="capitalize">
            {{ $order->status_reservasi }}
        </strong>
    </p>

    {{-- UPDATE STATUS --}}
    <form action="{{ route('admin.orders.updateStatus', $order->id_reservasi) }}"
          method="POST"
          class="mt-6 flex items-center gap-3">
        @csrf

        <label class="font-semibold">Ubah Status:</label>

        <select name="status_reservasi" class="p-2 border rounded">
            <option value="pending" {{ $order->status_reservasi=='pending'?'selected':'' }}>Pending</option>
            <option value="confirmed" {{ $order->status_reservasi=='confirmed'?'selected':'' }}>Dikonfirmasi</option>
            <option value="cancelled" {{ $order->status_reservasi=='cancelled'?'selected':'' }}>Dibatalkan</option>
        </select>

        <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Update
        </button>
    </form>

</div>

@endsection
