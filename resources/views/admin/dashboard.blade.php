@extends('layouts.admin')

@section('content')

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* ===============================
       🧊 Glass Premium
    =============================== */
    .glass {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.35);
        transition: all .35s ease;
    }

    .glass:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(37,99,235,.15);
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
       🔔 Badge
    =============================== */
    .badge {
        padding: .35rem .9rem;
        border-radius: 9999px;
        font-size: .75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
    }

    .badge-pending { background: rgba(234,179,8,.2); color: #a16207; }
    .badge-paid    { background: rgba(34,197,94,.2); color: #15803d; }
    .badge-cancel  { background: rgba(239,68,68,.2); color: #b91c1c; }

    /* ===============================
       📊 Table Hover
    =============================== */
    .table-row:hover {
        background: rgba(59,130,246,.08);
        transform: scale(1.01);
    }
</style>

<div class="min-h-screen p-10
            bg-gradient-to-br from-blue-50 via-white to-purple-100">

    {{-- TITLE --}}
    <div class="mb-12 fade-up">
        <h1 class="text-4xl font-extrabold text-blue-900 flex items-center gap-3">
            📊 Dashboard Admin
        </h1>
        <p class="text-gray-600 mt-2">
            Ringkasan aktivitas sistem reservasi hotel
        </p>
    </div>

    {{-- ===================== STATISTIK ===================== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="p-6 glass rgb-border shadow-xl fade-up">
            <p class="text-gray-600">Total Tamu</p>
            <h3 class="text-4xl font-extrabold text-blue-700 mt-2">
                {{ $totalTamu }}
            </h3>
        </div>

        <div class="p-6 glass rgb-border shadow-xl fade-up" style="animation-delay:.1s">
            <p class="text-gray-600">Total Kamar</p>
            <h3 class="text-4xl font-extrabold text-purple-700 mt-2">
                {{ $totalKamar }}
            </h3>
        </div>

        <div class="p-6 glass rgb-border shadow-xl fade-up" style="animation-delay:.2s">
            <p class="text-gray-600">Kamar Tersedia</p>
            <h3 class="text-4xl font-extrabold text-green-700 mt-2">
                {{ $kamarTersedia }}
            </h3>
        </div>

    </div>

    {{-- ROW KE-2 --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">

        <div class="p-6 glass rgb-border shadow-xl fade-up">
            <p class="text-gray-600">Total Reservasi</p>
            <h3 class="text-4xl font-extrabold text-blue-600 mt-2">
                {{ $totalReservasi }}
            </h3>
        </div>

        <div class="p-6 glass rgb-border shadow-xl fade-up" style="animation-delay:.1s">
            <p class="text-gray-600">Menunggu Pembayaran</p>
            <h3 class="text-4xl font-extrabold text-yellow-600 mt-2">
                {{ $pending }}
            </h3>
        </div>

        <div class="p-6 glass rgb-border shadow-xl fade-up" style="animation-delay:.2s">
            <p class="text-gray-600">Pembayaran Lunas</p>
            <h3 class="text-4xl font-extrabold text-green-600 mt-2">
                {{ $paid }}
            </h3>
        </div>

    </div>

    {{-- ===================== GRAFIK ===================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16">

        <div class="glass rgb-border p-8 shadow-xl fade-up">
            <h2 class="text-2xl font-bold mb-4 text-blue-900">
                📅 Reservasi 7 Hari Terakhir
            </h2>
            <canvas id="reservasiChart"></canvas>
        </div>

        <div class="glass rgb-border p-8 shadow-xl fade-up" style="animation-delay:.2s">
            <h2 class="text-2xl font-bold mb-4 text-blue-900">
                🏨 Status Kamar
            </h2>
            <canvas id="kamarChart"></canvas>
        </div>

    </div>

    {{-- ===================== DATA TERBARU ===================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        {{-- Reservasi --}}
        <div class="glass rgb-border p-8 shadow-xl fade-up">
            <h2 class="text-2xl font-bold mb-4">📝 Reservasi Terbaru</h2>

            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2 text-left">Tamu</th>
                        <th class="py-2 text-left">Kamar</th>
                        <th class="py-2 text-left">Check-in</th>
                        <th class="py-2 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentReservasi as $r)
                    <tr class="border-b table-row transition">
                        <td class="py-2">{{ $r->user->name }}</td>
                        <td class="py-2">{{ $r->kamar->tipe_kamar }}</td>
                        <td class="py-2">
                            {{ \Carbon\Carbon::parse($r->tgl_checkin)->format('d M Y') }}
                        </td>
                        <td class="py-2">
                            @if($r->status_pembayaran === 'pending')
                                <span class="badge badge-pending">⏳ Pending</span>
                            @elseif($r->status_pembayaran === 'paid')
                                <span class="badge badge-paid">✔ Lunas</span>
                            @else
                                <span class="badge badge-cancel">✖ Batal</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">
                            Belum ada data reservasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pembayaran --}}
        <div class="glass rgb-border p-8 shadow-xl fade-up">
            <h2 class="text-2xl font-bold mb-4">💳 Pembayaran Terbaru</h2>

            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2 text-left">ID Reservasi</th>
                        <th class="py-2 text-left">Status</th>
                        <th class="py-2 text-left">Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentPayments as $p)
                    <tr class="border-b table-row transition">
                        <td class="py-2">#{{ $p->reservasi_id }}</td>
                        <td class="py-2">
                            @if($p->status === 'pending')
                                <span class="badge badge-pending">⏳ Pending</span>
                            @elseif($p->status === 'confirmed')
                                <span class="badge badge-paid">✔ Terverifikasi</span>
                            @else
                                <span class="badge badge-cancel">✖ Ditolak</span>
                            @endif
                        </td>
                        <td class="py-2">
                            {{ $p->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">
                            Belum ada pembayaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

{{-- ======================= CHART SCRIPT ======================= --}}
<script>
    new Chart(document.getElementById('reservasiChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($chartTanggal) !!},
            datasets: [{
                label: 'Total Reservasi',
                data: {!! json_encode($chartTotal) !!},
                borderWidth: 3,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.25)',
                tension: 0.4,
                fill: true
            }]
        }
    });

    new Chart(document.getElementById('kamarChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($chartKamar->keys()) !!},
            datasets: [{
                data: {!! json_encode($chartKamar->values()) !!},
                backgroundColor: ['#22c55e', '#facc15', '#ef4444']
            }]
        }
    });
</script>

@endsection
