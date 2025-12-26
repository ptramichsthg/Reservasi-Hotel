@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">⏳ Pembayaran Pending</h1>

<div class="bg-white rounded-xl shadow p-6">

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-200 text-green-800 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full">
        <thead>
            <tr class="text-left border-b">
                <th class="py-3">ID</th>
                <th class="py-3">User</th>
                <th class="py-3">Kamar</th>
                <th class="py-3">Bukti Pembayaran</th>
                <th class="py-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($payments as $pay)
            <tr class="border-b hover:bg-gray-100">

                <td class="py-3">{{ $pay->id }}</td>

                <td class="py-3">
                    {{ $pay->reservasi->user->name ?? 'Tidak Diketahui' }}
                </td>

                <td class="py-3">
                    {{ $pay->reservasi->kamar->tipe_kamar ?? 'Tidak Ada' }}
                </td>

                <td class="py-3">
                    <a href="{{ asset('uploads/bukti/' . $pay->bukti_pembayaran) }}"
                       target="_blank"
                       class="text-blue-600 underline">
                        Lihat Bukti
                    </a>
                </td>

                <td class="py-3 flex gap-3">

                    <form action="{{ route('admin.payment.verify', $pay->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg">
                            ✔ Konfirmasi
                        </button>
                    </form>

                    <form action="{{ route('admin.payment.reject', $pay->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg">
                            ✖ Tolak
                        </button>
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
