@extends('layouts.tamu')

@section('content')

{{-- Chart.js with AntD Colors --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-ant-text capitalize">Hi, {{ Auth::user()->name }}!</h1>
    <p class="text-ant-textSecondary text-sm mt-1">Selamat datang kembali di Blue Haven Hotel. Berikut adalah ringkasan akun Anda.</p>
</div>

{{-- METRICS SECTION --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Reservasi --}}
    <div class="ant-card p-5">
        <div class="flex items-center gap-3 text-ant-textSecondary mb-2">
            <span class="material-symbols-outlined text-[18px]">calendar_month</span>
            <span class="text-sm font-medium">Total Reservasi</span>
        </div>
        <div class="text-2xl font-bold text-ant-text leading-none">{{ $totalPemesanan }}</div>
        <div class="mt-3 flex items-center text-[11px] text-green-500 font-bold bg-green-50 w-fit px-2 py-0.5 rounded gap-1">
            <span class="material-symbols-outlined text-[14px]">trending_up</span>
            <span>12% dari bulan lalu</span>
        </div>
    </div>

    {{-- Pending --}}
    <div class="ant-card p-5">
        <div class="flex items-center gap-3 text-ant-textSecondary mb-2">
            <span class="material-symbols-outlined text-[18px]">pending_actions</span>
            <span class="text-sm font-medium">Menunggu Konfirmasi</span>
        </div>
        <div class="text-2xl font-bold text-ant-text leading-none">{{ $pending }}</div>
        <div class="mt-3 text-[11px] text-ant-textSecondary">Perlu perhatian Admin</div>
    </div>

    {{-- Confirmed --}}
    <div class="ant-card p-5">
        <div class="flex items-center gap-3 text-ant-textSecondary mb-2">
            <span class="material-symbols-outlined text-[18px]">task_alt</span>
            <span class="text-sm font-medium">Terkonfirmasi</span>
        </div>
        <div class="text-2xl font-bold text-ant-text leading-none">{{ $confirmed }}</div>
        <div class="mt-3 text-[11px] text-green-600 font-medium">Siap untuk Check-in</div>
    </div>

    {{-- Cancelled --}}
    <div class="ant-card p-5 text-red-500">
        <div class="flex items-center gap-3 text-ant-textSecondary mb-2">
            <span class="material-symbols-outlined text-[18px]">cancel</span>
            <span class="text-sm font-medium">Dibatalkan</span>
        </div>
        <div class="text-2xl font-bold text-ant-text leading-none">{{ $cancelled }}</div>
        <div class="mt-3 text-[11px] text-ant-textSecondary">Reservasi yang tidak dilanjutkan</div>
    </div>
</div>

{{-- SECONDARY SECTION --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    {{-- LATEST RESERVATIONS TABLE --}}
    <div class="ant-card p-6 xl:col-span-2">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-base font-bold text-ant-text">Reservasi Terbaru</h3>
            <a href="{{ route('tamu.orders.history') }}" class="text-ant-primary text-sm hover:underline font-medium">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-ant-bg border-b border-ant-borderSplit">
                        <th class="py-4 px-4 font-bold text-ant-textSecondary">Tipe Kamar</th>
                        <th class="py-4 px-4 font-bold text-ant-textSecondary">Durasi Menginap</th>
                        <th class="py-4 px-4 font-bold text-ant-textSecondary">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ant-borderSplit">
                    @isset($latestReservasi)
                        @forelse($latestReservasi as $r)
                            @php
                                $statusStyle = match($r->status_reservasi) {
                                    'pending' => 'bg-orange-50 text-orange-600 border-orange-200',
                                    'confirmed' => 'bg-blue-50 text-blue-600 border-blue-200',
                                    'completed' => 'bg-green-50 text-green-600 border-green-200',
                                    'cancelled' => 'bg-red-50 text-red-600 border-red-200',
                                    default => 'bg-gray-50 text-gray-600 border-gray-200'
                                };
                            @endphp
                            <tr class="hover:bg-ant-bg/50 transition-colors">
                                <td class="py-4 px-4 font-semibold text-ant-text">{{ $r->kamar->tipe_kamar ?? '-' }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex flex-col">
                                        <span class="text-ant-text">{{ $r->tgl_checkin }}</span>
                                        <span class="text-[11px] text-ant-textSecondary">Checkout: {{ $r->tgl_checkout }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-2 py-1 rounded text-[11px] font-bold uppercase border {{ $statusStyle }}">
                                        {{ $r->status_reservasi }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center text-ant-textSecondary italic">Belum ada aktivitas reservasi saat ini.</td>
                            </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>
    </div>

    {{-- CHART CARD --}}
    <div class="ant-card p-6 flex flex-col">
        <h3 class="text-base font-bold text-ant-text mb-6">Analisis Mingguan</h3>
        <div class="flex-grow flex items-center justify-center">
            <div class="w-full" style="height: 250px">
                <canvas id="chartPemesanan"></canvas>
            </div>
        </div>
        <div class="mt-6 pt-6 border-t border-ant-borderSplit">
            <div class="flex justify-between items-center text-sm">
                <span class="text-ant-textSecondary">Total Favorit:</span>
                <span class="font-bold text-ant-primary capitalize">{{ $tipeKamar[0] ?? '-' }}</span>
            </div>
        </div>
    </div>
</div>

{{-- BOTTOM SECTION --}}
<div class="mt-8 ant-card p-6">
    <h3 class="text-base font-bold text-ant-text mb-6">Perbandingan Tipe Kamar</h3>
    <div style="height: 300px">
        <canvas id="chartJenisKamar"></canvas>
    </div>
</div>

<script>
    // Config Chart Defaults for AntD Look
    Chart.defaults.color = 'rgba(0, 0, 0, 0.45)';
    Chart.defaults.font.family = "'Inter', sans-serif";

    new Chart(document.getElementById('chartPemesanan'), {
        type: 'line',
        data: {
            labels: {!! json_encode($tanggal) !!},
            datasets: [{
                label: 'Jumlah Reservasi',
                data: {!! json_encode($total) !!},
                borderColor: '#1677ff',
                backgroundColor: 'rgba(22, 119, 255, 0.05)',
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#1677ff',
                pointBorderWidth: 2,
                pointHoverRadius: 6,
                tension: 0.2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('chartJenisKamar'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($tipeKamar) !!},
            datasets: [{
                label: 'Jumlah Pesanan',
                data: {!! json_encode($jumlahTipe) !!},
                backgroundColor: '#1677ff',
                borderRadius: 4,
                barThickness: 32
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>

@endsection


