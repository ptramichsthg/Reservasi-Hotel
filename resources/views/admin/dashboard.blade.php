@extends('layouts.admin')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    </div>

    {{-- STATISTICS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 animate-slide-up">
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

        {{-- Card 4: Kamar Booked --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-blue-600 transition-colors">event_busy</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none text-blue-600/70">Booked</span>
            </div>
            <div class="text-2xl font-bold text-blue-600 leading-none">{{ $kamarBooked }}</div>
        </div>

        {{-- Card 5: Kamar Maintenance --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-orange-600 transition-colors">build</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none text-orange-600/70">Maintenance</span>
            </div>
            <div class="text-2xl font-bold text-orange-600 leading-none">{{ $kamarMaintenance }}</div>
        </div>

        {{-- Card 6: Total Pendapatan --}}
        <div class="bg-white p-5 rounded-2xl border border-ant-borderSplit shadow-sm hover:shadow-md transition-all group">
            <div class="flex items-center gap-3 text-ant-textSecondary mb-3">
                <span class="material-symbols-outlined text-[18px] group-hover:text-green-600 transition-colors">payments</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none text-green-600/70">Pendapatan</span>
            </div>
            <div class="text-lg font-bold text-green-600 leading-none">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>

        {{-- Card 7: Reservasi --}}
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
                <span class="material-symbols-outlined text-[18px] group-hover:text-green-600 transition-colors">verified</span>
                <span class="text-[10px] font-bold uppercase tracking-widest leading-none text-green-600/70">Terverifikasi</span>
            </div>
            <div class="text-2xl font-bold text-green-600 leading-none">{{ $verified }}</div>
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
        </div>
    </div>
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
