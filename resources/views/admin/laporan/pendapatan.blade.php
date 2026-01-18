@extends('layouts.admin')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Laporan Pendapatan</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Analisis pendapatan hotel dari transaksi yang sudah lunas</p>
</div>

{{-- STATISTICS CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Total Pendapatan --}}
    <div class="ant-card p-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-lg bg-green-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-green-600 text-[28px]">paid</span>
            </div>
            <div class="flex-1">
                <span class="text-xs font-bold uppercase tracking-widest text-ant-textSecondary block">Total Pendapatan</span>
                <span class="text-2xl font-bold text-green-600 block mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Pendapatan Bulan Ini --}}
    <div class="ant-card p-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-lg bg-blue-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-ant-primary text-[28px]">calendar_month</span>
            </div>
            <div class="flex-1">
                <span class="text-xs font-bold uppercase tracking-widest text-ant-textSecondary block">Bulan Ini</span>
                <span class="text-2xl font-bold text-ant-primary block mt-1">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Rata-rata Per Bulan --}}
    <div class="ant-card p-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-lg bg-purple-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-purple-600 text-[28px]">trending_up</span>
            </div>
            <div class="flex-1">
                <span class="text-xs font-bold uppercase tracking-widest text-ant-textSecondary block">Rata-rata/Bulan</span>
                <span class="text-2xl font-bold text-purple-600 block mt-1">Rp {{ number_format($rataRata, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

{{-- CHART PENDAPATAN 12 BULAN --}}
<div class="ant-card p-6 mb-8">
    <h3 class="text-base font-bold text-ant-text mb-6 flex items-center gap-2">
        <span class="material-symbols-outlined text-ant-primary text-[20px]">show_chart</span>
        Grafik Pendapatan 12 Bulan Terakhir
    </h3>
    <div style="height: 350px">
        <canvas id="pendapatanChart"></canvas>
    </div>
</div>

{{-- PENDAPATAN PER TIPE KAMAR --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Tabel --}}
    <div class="ant-card overflow-hidden">
        <div class="px-6 py-4 border-b border-ant-borderSplit bg-ant-bg/20">
            <h3 class="text-sm font-bold text-ant-text flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] text-ant-textQuaternary">hotel</span>
                Pendapatan Per Tipe Kamar
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase">Tipe Kamar</th>
                        <th class="py-3 px-6 font-bold text-ant-textSecondary text-[10px] uppercase text-right">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ant-borderSplit">
                    @forelse($pendapatanPerTipe as $tipe)
                        <tr class="hover:bg-ant-bg/30 transition-colors">
                            <td class="py-3 px-6 font-medium text-ant-text">{{ $tipe->tipe_kamar }}</td>
                            <td class="py-3 px-6 text-right font-bold text-green-600">Rp {{ number_format($tipe->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-12 text-center text-ant-textQuaternary italic">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chart Pie --}}
    <div class="ant-card p-6">
        <h3 class="text-sm font-bold text-ant-text mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-ant-primary text-[20px]">pie_chart</span>
            Distribusi Pendapatan
        </h3>
        <div style="height: 300px">
            <canvas id="tipeKamarChart"></canvas>
        </div>
    </div>
</div>

<script>
    Chart.defaults.color = 'rgba(0, 0, 0, 0.45)';
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.font.size = 11;

    // Chart Pendapatan 12 Bulan
    new Chart(document.getElementById('pendapatanChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartBulan) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($chartPendapatan) !!},
                backgroundColor: 'rgba(22, 119, 255, 0.8)',
                borderColor: '#1677ff',
                borderWidth: 2,
                borderRadius: 6
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
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f5f5f5' },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                        }
                    }
                },
                x: { grid: { display: false } }
            }
        }
    });

    // Chart Pie Tipe Kamar
    new Chart(document.getElementById('tipeKamarChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($pendapatanPerTipe->pluck('tipe_kamar')) !!},
            datasets: [{
                data: {!! json_encode($pendapatanPerTipe->pluck('total')) !!},
                backgroundColor: [
                    '#1677ff', '#52c41a', '#faad14', '#ff4d4f', 
                    '#722ed1', '#13c2c2', '#eb2f96', '#fa8c16'
                ],
                borderWidth: 0,
                cutout: '70%'
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
                        padding: 15,
                        font: { weight: 'bold', size: 10 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed);
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
