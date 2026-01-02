@extends('layouts.admin')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<<<<<<< HEAD
<div class="p-6 md:p-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-ant-text flex items-center gap-3">
                <span class="material-symbols-outlined text-ant-primary text-[32px]">dashboard</span>
                Dashboard Admin
            </h1>
            <p class="text-sm text-ant-textSecondary mt-1">Ringkasan aktivitas dan performa operasional Blue Haven Hotel.</p>
        </div>
=======
<style>
    /* ===============================
       GLASS PREMIUM
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
       ANIMATIONS
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
       BADGE
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
       TABLE HOVER
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
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span>Dashboard Admin</span>
        </h1>
        <p class="text-gray-600 mt-2">
            Ringkasan aktivitas sistem reservasi hotel
        </p>
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
    </div>

    {{-- STATISTICS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 animate-slide-up">
        {{-- Card 1 --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-ant-primary transition-colors">group</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none">Total Tamu</span>
            </div>
            <div class="text-2xl font-bold text-ant-text leading-none">{{ $totalTamu }}</div>
        </div>

        {{-- Card 2 --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-ant-primary transition-colors">hotel</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none">Total Kamar</span>
            </div>
            <div class="text-2xl font-bold text-ant-text leading-none">{{ $totalKamar }}</div>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-green-600 transition-colors">check_circle</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none text-green-600/70">Tersedia</span>
            </div>
            <div class="text-2xl font-bold text-green-600 leading-none">{{ $kamarTersedia }}</div>
        </div>

        {{-- Card 4 --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-ant-primary transition-colors">receipt_long</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none">Reservasi</span>
            </div>
            <div class="text-2xl font-bold text-ant-primary leading-none">{{ $totalReservasi }}</div>
        </div>

        {{-- Card 5 --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-orange-600 transition-colors">schedule</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none text-orange-600/70">Pending</span>
            </div>
            <div class="text-2xl font-bold text-orange-600 leading-none">{{ $pending }}</div>
        </div>

        {{-- Card 6 --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-blue-600 transition-colors">payments</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none text-blue-600/70">Terbayar</span>
            </div>
            <div class="text-2xl font-bold text-blue-600 leading-none">{{ $paid }}</div>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8 animate-slide-up" style="animation-delay: 0.1s">
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm">
            <h3 class="text-base font-bold text-ant-text mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-ant-primary text-[20px]">show_chart</span>
                Tren Reservasi (7 Hari Terakhir)
            </h3>
            <div style="height: 300px">
                <canvas id="reservasiChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm">
            <h3 class="text-base font-bold text-ant-text mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-ant-primary text-[20px]">pie_chart</span>
                Distribusi Status Kamar
            </h3>
            <div style="height: 300px">
                <canvas id="kamarChart"></canvas>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    {{-- RECENT DATA --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-slide-up" style="animation-delay: 0.2s">
        {{-- RESERVASI TERBARU --}}
        <div class="bg-white rounded-2xl border border-ant-borderSplit shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-ant-borderSplit bg-ant-bg/20 flex items-center justify-between">
                <h3 class="text-sm font-bold text-ant-text flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] text-ant-textQuaternary">history</span>
                    Reservasi Terbaru
                </h3>
                <a href="{{ route('admin.orders.index') }}" class="text-[11px] font-bold text-ant-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                            <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Tamu</th>
                            <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Check-in</th>
                            <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ant-borderSplit">
                        @forelse($recentReservasi as $r)
                            @php
                                $statusConfig = match($r->status_pembayaran) {
                                    'pending' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'border' => 'border-orange-200', 'label' => 'Pending'],
                                    'confirmed' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'label' => 'Lunas'],
                                    default => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'label' => 'Batal']
                                };
                            @endphp
                            <tr class="hover:bg-ant-bg/30 transition-colors group">
                                <td class="py-3 px-6">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-ant-text leading-none group-hover:text-ant-primary transition-colors">{{ $r->user->name }}</span>
                                        <span class="text-[10px] text-ant-textQuaternary mt-1">{{ $r->kamar->tipe_kamar }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 font-medium text-ant-textSecondary">
                                    {{ \Carbon\Carbon::parse($r->tgl_checkin)->format('d/m/Y') }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="px-2 py-0.5 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }} text-[9px] font-bold rounded-full border">
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center text-ant-textQuaternary italic">Belum ada data reservasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PEMBAYARAN TERBARU --}}
        <div class="bg-white rounded-2xl border border-ant-borderSplit shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-ant-borderSplit bg-ant-bg/20 flex items-center justify-between">
                <h3 class="text-sm font-bold text-ant-text flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] text-ant-textQuaternary">how_to_reg</span>
                    Verifikasi Pembayaran
                </h3>
                <a href="{{ route('admin.payment.index') }}" class="text-[11px] font-bold text-ant-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                            <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">ID Reservasi</th>
                            <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Waktu</th>
                            <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ant-borderSplit">
                        @forelse($recentPayments as $p)
                            @php
                                $statusConfig = match($p->status) {
                                    'pending' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'border' => 'border-orange-200', 'label' => 'Pending'],
                                    'confirmed' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'label' => 'Verified'],
                                    default => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'label' => 'Rejected']
                                };
                            @endphp
                            <tr class="hover:bg-ant-bg/30 transition-colors group">
                                <td class="py-3 px-6 font-mono font-bold text-ant-primary">#{{ str_pad($p->reservasi_id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="py-3 px-6 text-ant-textSecondary font-medium">
                                    {{ $p->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="px-2 py-0.5 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }} text-[9px] font-bold rounded-full border">
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center text-ant-textQuaternary italic">Belum ada pembayaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
=======
    {{-- ===================== GRAFIK ===================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16">

        <div class="glass rgb-border p-8 shadow-xl fade-up">
            <h2 class="text-2xl font-bold mb-4 text-blue-900 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Reservasi 7 Hari Terakhir</span>
            </h2>
            <canvas id="reservasiChart"></canvas>
        </div>

        <div class="glass rgb-border p-8 shadow-xl fade-up" style="animation-delay:.2s">
            <h2 class="text-2xl font-bold mb-4 text-blue-900 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span>Status Kamar</span>
            </h2>
            <canvas id="kamarChart"></canvas>
>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
        </div>
    </div>
<<<<<<< HEAD
=======

    {{-- ===================== DATA TERBARU ===================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        {{-- Reservasi --}}
        <div class="glass rgb-border p-8 shadow-xl fade-up">
            <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Reservasi Terbaru</span>
            </h2>

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
                                <span class="badge badge-pending">Pending</span>
                            @elseif($r->status_pembayaran === 'paid')
                                <span class="badge badge-paid">Lunas</span>
                            @else
                                <span class="badge badge-cancel">Batal</span>
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
            <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                <span>Pembayaran Terbaru</span>
            </h2>

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
                                <span class="badge badge-pending">Pending</span>
                            @elseif($p->status === 'confirmed')
                                <span class="badge badge-paid">Terverifikasi</span>
                            @else
                                <span class="badge badge-cancel">Ditolak</span>
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

>>>>>>> ad2b3ff3d6a0fedec6dd0bf27371a8a65b4eae8e
</div>

<script>
    Chart.defaults.color = 'rgba(0, 0, 0, 0.45)';
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.font.size = 11;

    new Chart(document.getElementById('reservasiChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($chartTanggal) !!},
            datasets: [{
                label: 'Total Reservasi',
                data: {!! json_encode($chartTotal) !!},
                borderColor: '#1677ff',
                backgroundColor: 'rgba(22, 119, 255, 0.05)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#1677ff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#1f1f1f',
                    bodyColor: '#595959',
                    borderColor: '#f0f0f0',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 4,
                    usePointStyle: true
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#f5f5f5' },
                    ticks: { precision: 0 }
                },
                x: { 
                    grid: { display: false }
                }
            }
        }
    });

    new Chart(document.getElementById('kamarChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($chartKamar->keys()) !!},
            datasets: [{
                data: {!! json_encode($chartKamar->values()) !!},
                backgroundColor: ['#52c41a', '#faad14', '#ff4d4f'],
                borderWidth: 0,
                cutout: '75%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { weight: 'bold' }
                    }
                }
            }
        }
    });
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up {
        animation: slide-up 0.4s ease-out forwards;
    }
</style>

@endsection
