@extends('layouts.app')

@section('content')

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .page-bg {
        background: radial-gradient(1200px 600px at 20% 10%, rgba(59,130,246,0.15), transparent 55%),
                    radial-gradient(900px 500px at 85% 25%, rgba(168,85,247,0.12), transparent 60%),
                    linear-gradient(180deg, #f1f5f9 0%, #eef2ff 60%, #f8fafc 100%);
        min-height: 100vh;
    }

    .card {
        background: rgba(255,255,255,0.95);
        border-radius: 18px;
        box-shadow: 0 12px 32px rgba(0,0,0,.08);
    }

    .card-hover {
        transition: all .25s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(0,0,0,.12);
    }

    .stat {
        border-radius: 18px;
        color: white;
    }

    .stat-inner {
        padding: 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-label {
        font-size: 14px;
        font-weight: 700;
        opacity: .9;
    }

    .stat-num {
        font-size: 44px;
        font-weight: 900;
    }

    .table th {
        font-size: 12px;
        text-transform: uppercase;
        color: #64748b;
        padding: 14px;
        background: #f8fafc;
    }

    .table td {
        padding: 14px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 700;
    }
</style>

<div class="page-bg p-6 md:p-10 rounded-3xl">

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-extrabold text-slate-900">
                Selamat Datang, {{ Auth::user()->name }} 👋
            </h1>
            <p class="text-slate-600 mt-1">
                Berikut ringkasan aktivitas reservasi Anda hari ini
            </p>
        </div>
        <div class="text-right">
            <p class="text-slate-600 text-sm">{{ now()->translatedFormat('l, d F Y') }}</p>
            <p class="text-xl font-extrabold">{{ now()->format('H:i') }} WIB</p>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="stat bg-gradient-to-br from-blue-600 to-blue-500">
            <div class="stat-inner">
                <div>
                    <p class="stat-label">Total Reservasi</p>
                    <p class="stat-num">{{ $totalPemesanan }}</p>
                </div>
            </div>
        </div>

        <div class="stat bg-gradient-to-br from-orange-500 to-amber-500">
            <div class="stat-inner">
                <div>
                    <p class="stat-label">Menunggu Konfirmasi</p>
                    <p class="stat-num">{{ $pending }}</p>
                </div>
            </div>
        </div>

        <div class="stat bg-gradient-to-br from-emerald-600 to-green-500">
            <div class="stat-inner">
                <div>
                    <p class="stat-label">Terkonfirmasi</p>
                    <p class="stat-num">{{ $confirmed }}</p>
                </div>
            </div>
        </div>

        <div class="stat bg-gradient-to-br from-red-600 to-rose-500">
            <div class="stat-inner">
                <div>
                    <p class="stat-label">Dibatalkan</p>
                    <p class="stat-num">{{ $cancelled }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- TOTAL KAMAR --}}
    <div class="card card-hover p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-extrabold">Total Jenis Kamar</h3>
                <p class="text-sm text-slate-600">
                    Jumlah tipe kamar yang pernah Anda pesan
                </p>
            </div>
            <p class="text-6xl font-black text-blue-600">{{ $totalKamar }}</p>
        </div>
    </div>

    {{-- GRID UTAMA --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

        {{-- TABEL --}}
        <div class="card card-hover p-6 xl:col-span-2">
            <h3 class="text-lg font-extrabold mb-4">
                Reservasi Terbaru
            </h3>

            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Kamar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @isset($latestReservasi)
                    @forelse($latestReservasi as $r)
                        @php
                            $warna = match($r->status_reservasi) {
                                'pending' => 'bg-orange-100 text-orange-700',
                                'confirmed' => 'bg-green-100 text-green-700',
                                'completed' => 'bg-blue-100 text-blue-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                        @endphp
                        <tr>
                            <td class="font-semibold">
                                {{ $r->kamar->tipe_kamar ?? '-' }}
                            </td>
                            <td>
                                Check-in: {{ $r->tgl_checkin }} <br>
                                Check-out: {{ $r->tgl_checkout }}
                            </td>
                            <td>
                                <span class="badge {{ $warna }}">
                                    {{ ucfirst($r->status_reservasi) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-slate-500 py-8">
                                Belum ada reservasi
                            </td>
                        </tr>
                    @endforelse
                @endisset
                </tbody>
            </table>

            <div class="text-right mt-4">
                <a href="{{ route('tamu.orders.history') }}"
                   class="font-bold text-blue-600 hover:underline">
                    Lihat Riwayat →
                </a>
            </div>
        </div>

        {{-- CHART --}}
        <div class="card card-hover p-6">
            <h3 class="text-lg font-extrabold mb-4">
                Reservasi 7 Hari Terakhir
            </h3>
            <div style="height:300px">
                <canvas id="chartPemesanan"></canvas>
            </div>
        </div>

    </div>

    {{-- CHART FAVORIT --}}
    <div class="card card-hover p-6 mb-8">
        <h3 class="text-lg font-extrabold mb-4">
            Jenis Kamar Favorit
        </h3>
        <div style="height:320px">
            <canvas id="chartJenisKamar"></canvas>
        </div>
    </div>

</div>

{{-- CHART SCRIPT --}}
<script>
    new Chart(chartPemesanan, {
        type: 'line',
        data: {
            labels: {!! json_encode($tanggal) !!},
            datasets: [{
                label: 'Jumlah Reservasi',
                data: {!! json_encode($total) !!},
                borderColor: 'rgb(37,99,235)',
                backgroundColor: 'rgba(37,99,235,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: { responsive: true }
    });

    new Chart(chartJenisKamar, {
        type: 'bar',
        data: {
            labels: {!! json_encode($tipeKamar) !!},
            datasets: [{
                label: 'Jumlah Pesanan',
                data: {!! json_encode($jumlahTipe) !!},
                backgroundColor: 'rgba(37,99,235,0.7)',
                borderRadius: 12
            }]
        },
        options: { responsive: true }
    });
</script>

@endsection
