@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">💳 Verifikasi Pembayaran</h1>

<div class="bg-white rounded-xl shadow p-6">

    <table class="w-full">
        <thead>
            <tr class="text-left border-b">
                <th class="py-3">Reservasi</th>
                <th class="py-3">Bukti</th>
                <th class="py-3">Status</th>
                <th class="py-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($payments as $pay)
            <tr class="border-b hover:bg-gray-100">

                <td class="py-3">{{ $pay->reservasi_id }}</td>

                <td class="py-3">
                    <a href="{{ asset('uploads/bukti/'.$pay->bukti_pembayaran) }}"
                       target="_blank" class="text-blue-600 underline">
                        Lihat Bukti
                    </a>
                </td>

                <td class="py-3">
                    <span class="px-3 py-1 rounded text-white
                        {{ $pay->status == 'pending' ? 'bg-yellow-500' : 'bg-green-600' }}">
                        {{ ucfirst($pay->status) }}
                    </span>
                </td>

                <td class="py-3">
                    @if($pay->status == 'pending')
                    <form action="{{ route('admin.payment.verify', $pay->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                            Verifikasi
                        </button>
                    </form>
                    @else
                    ✔ Sudah Diverifikasi
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
