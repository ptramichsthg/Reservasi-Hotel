@extends('layouts.app')

@section('content')

<style>
    /* ===============================
       🧊 Glassmorphism Premium
    =============================== */
    .glass {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        transition: all .35s ease;
    }

    .rgb-border {
        position: relative;
    }

    .rgb-border::before {
        content: "";
        position: absolute;
        inset: 0;
        padding: 2px;
        border-radius: inherit;
        background: linear-gradient(
            120deg,
            #3b82f6,
            #22d3ee,
            #a855f7,
            #3b82f6
        );
        background-size: 300% 300%;
        animation: rgbFlow 6s linear infinite;
        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }

    @keyframes rgbFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ===============================
       ✨ Animations
    =============================== */
    .fade-up {
        opacity: 0;
        transform: translateY(25px);
        animation: fadeUp .9s ease-out forwards;
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===============================
       🔔 Status Badge
    =============================== */
    .badge {
        padding: .4rem .9rem;
        border-radius: 9999px;
        font-size: .8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
    }

    .badge-pending {
        background: rgba(234,179,8,.2);
        color: #a16207;
    }

    .badge-paid {
        background: rgba(34,197,94,.2);
        color: #15803d;
    }

    .badge-cancelled {
        background: rgba(239,68,68,.2);
        color: #b91c1c;
    }

    /* ===============================
       📊 Table Hover
    =============================== */
    .table-row:hover {
        background: rgba(168,85,247,.08);
        transform: scale(1.01);
    }
</style>

<div class="min-h-screen p-10
            bg-gradient-to-br from-blue-50 via-white to-purple-100">

    {{-- TITLE --}}
    <div class="mb-10 fade-up">
        <h1 class="text-4xl font-extrabold text-blue-900 tracking-wide">
            📜 Riwayat Reservasi
        </h1>
        <p class="text-gray-600 mt-2">
            Daftar semua pemesanan kamar yang pernah Anda lakukan
        </p>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="mb-8 glass rgb-border p-4 text-green-700 shadow-lg fade-up">
            {{ session('success') }}
        </div>
    @endif

    {{-- EMPTY STATE --}}
    @if($pemesanan->isEmpty())
        <div class="glass rgb-border p-8 text-red-600 shadow-xl max-w-xl fade-up">
            Kamu belum memiliki riwayat pemesanan 😢
        </div>
    @else

        {{-- TABLE CARD --}}
        <div class="glass rgb-border shadow-xl p-8 overflow-x-auto fade-up">

            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-gray-600 text-sm uppercase tracking-wide border-b">
                        <th class="py-4 text-left">Kamar</th>
                        <th class="py-4 text-left">Check-In</th>
                        <th class="py-4 text-left">Check-Out</th>
                        <th class="py-4 text-left">Status</th>
                        <th class="py-4 text-left">Pembayaran</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pemesanan as $psn)
                    <tr class="border-b border-gray-200 transition-all table-row">

                        {{-- TIPE KAMAR --}}
                        <td class="py-4 font-semibold text-gray-800">
                            {{ $psn->kamar->tipe_kamar ?? 'Tidak Diketahui' }}
                        </td>

                        {{-- CHECK-IN --}}
                        <td class="py-4 text-gray-600">
                            📅 {{ \Carbon\Carbon::parse($psn->tgl_checkin)->format('d M Y') }}
                        </td>

                        {{-- CHECK-OUT --}}
                        <td class="py-4 text-gray-600">
                            📅 {{ \Carbon\Carbon::parse($psn->tgl_checkout)->format('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="py-4">
                            @if($psn->status_pembayaran === 'pending')
                                <span class="badge badge-pending">
                                    ⏳ Pending
                                </span>
                            @elseif($psn->status_pembayaran === 'paid')
                                <span class="badge badge-paid">
                                    ✔ Lunas
                                </span>
                            @elseif($psn->status_pembayaran === 'cancelled')
                                <span class="badge badge-cancelled">
                                    ✖ Dibatalkan
                                </span>
                            @else
                                <span class="badge bg-gray-300 text-gray-700">
                                    Tidak Diketahui
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="py-4">

                            @if($psn->status_pembayaran === 'pending')
                                <a href="{{ route('tamu.payment.upload.form', ['reservasi_id' => $psn->id_reservasi]) }}"
                                   class="inline-block px-5 py-2
                                          bg-blue-600 text-white rounded-xl font-semibold
                                          shadow-md hover:bg-blue-700 hover:-translate-y-0.5
                                          transition">
                                    Upload Bukti
                                </a>

                            @elseif($psn->status_pembayaran === 'paid')
                                <span class="text-green-700 font-semibold">
                                    ✔ Sudah Lunas
                                </span>

                            @elseif($psn->status_pembayaran === 'cancelled')
                                <span class="text-red-700 font-semibold">
                                    ✖ Dibatalkan
                                </span>
                            @endif

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

</div>

@endsection
