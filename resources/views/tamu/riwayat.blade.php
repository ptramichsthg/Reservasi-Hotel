@extends('layouts.tamu')

@section('content')

<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Riwayat Reservasi</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Daftar lengkap semua pemesanan kamar yang pernah Anda lakukan di Blue Haven Hotel.</p>
</div>

{{-- SUCCESS NOTIFICATION --}}
@if(session('success'))
    <div class="ant-card p-4 mb-8 border-l-4 border-green-500 bg-green-50">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <span class="text-sm font-medium text-green-800">{{ session('success') }}</span>
        </div>
    </div>
@endif

{{-- EMPTY STATE --}}
@if($pemesanan->isEmpty())
    <div class="ant-card p-16 text-center">
        <span class="material-symbols-outlined text-ant-textSecondary text-[80px] mb-6 block">receipt_long</span>
        <h4 class="text-lg font-bold text-ant-text mb-2">Belum Ada Riwayat Reservasi</h4>
        <p class="text-ant-textSecondary text-sm mb-8">Anda belum pernah melakukan pemesanan kamar. Mulai petualangan Anda sekarang!</p>
        <a href="{{ route('tamu.kamar.list') }}" class="ant-btn-primary inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-[16px]">search</span>
            Cari Kamar Sekarang
        </a>
    </div>
@else
    {{-- TABLE CARD --}}
    <div class="ant-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-ant-bg border-b border-ant-borderSplit">
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">ID Reservasi</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Tipe Kamar</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Check-In</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Check-Out</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Total Harga</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Status</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ant-borderSplit">
                    @foreach($pemesanan as $psn)
                        @php
                            $statusConfig = match($psn->status_pembayaran) {
                                'pending' => [
                                    'bg' => 'bg-orange-50',
                                    'text' => 'text-orange-600',
                                    'border' => 'border-orange-200',
                                    'icon' => 'schedule',
                                    'label' => 'Pending'
                                ],
                                'paid' => [
                                    'bg' => 'bg-green-50',
                                    'text' => 'text-green-600',
                                    'border' => 'border-green-200',
                                    'icon' => 'check_circle',
                                    'label' => 'Lunas'
                                ],
                                'cancelled' => [
                                    'bg' => 'bg-red-50',
                                    'text' => 'text-red-600',
                                    'border' => 'border-red-200',
                                    'icon' => 'cancel',
                                    'label' => 'Dibatalkan'
                                ],
                                default => [
                                    'bg' => 'bg-gray-50',
                                    'text' => 'text-gray-600',
                                    'border' => 'border-gray-200',
                                    'icon' => 'help',
                                    'label' => 'Unknown'
                                ]
                            };
                        @endphp
                        <tr class="hover:bg-ant-bg/50 transition-colors">
                            {{-- ID RESERVASI --}}
                            <td class="py-5 px-6">
                                <span class="font-mono text-ant-primary font-bold text-xs">#{{ str_pad($psn->id_reservasi, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>

                            {{-- TIPE KAMAR --}}
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded bg-ant-bg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-ant-primary text-[18px]">bed</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-ant-text">{{ $psn->kamar->tipe_kamar ?? 'N/A' }}</p>
                                        <p class="text-[10px] text-ant-textSecondary uppercase tracking-wide">Blue Haven</p>
                                    </div>
                                </div>
                            </td>

                            {{-- CHECK-IN --}}
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-2 text-ant-textSecondary">
                                    <span class="material-symbols-outlined text-[16px]">login</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($psn->tgl_checkin)->format('d M Y') }}</span>
                                </div>
                            </td>

                            {{-- CHECK-OUT --}}
                            <td class="py-5 px-6">
                                <div class="flex items-center gap-2 text-ant-textSecondary">
                                    <span class="material-symbols-outlined text-[16px]">logout</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($psn->tgl_checkout)->format('d M Y') }}</span>
                                </div>
                            </td>

                            {{-- TOTAL HARGA --}}
                            <td class="py-5 px-6">
                                @php
                                    $durasi = \Carbon\Carbon::parse($psn->tgl_checkout)->diffInDays(\Carbon\Carbon::parse($psn->tgl_checkin));
                                    $totalHarga = $psn->total_harga ?? ($psn->kamar->harga * $durasi);
                                @endphp
                                <div class="flex flex-col">
                                    <span class="font-bold text-ant-primary text-base">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                                    <span class="text-[10px] text-ant-textSecondary mt-0.5">{{ $durasi }} malam</span>
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td class="py-5 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-bold uppercase border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                                    <span class="material-symbols-outlined text-[14px]">{{ $statusConfig['icon'] }}</span>
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="py-5 px-6">
                                @if($psn->status_pembayaran === 'pending')
                                    <a href="{{ route('tamu.payment.upload.form', ['reservasi_id' => $psn->id_reservasi]) }}" 
                                       class="ant-btn-primary inline-flex items-center gap-2 text-xs">
                                        <span class="material-symbols-outlined text-[14px]">upload</span>
                                        Upload Bukti
                                    </a>
                                @elseif($psn->status_pembayaran === 'paid')
                                    <div class="flex items-center gap-2 text-green-600 text-xs font-bold">
                                        <span class="material-symbols-outlined text-[16px]">verified</span>
                                        Terkonfirmasi
                                    </div>
                                @elseif($psn->status_pembayaran === 'cancelled')
                                    <div class="flex items-center gap-2 text-red-600 text-xs font-bold">
                                        <span class="material-symbols-outlined text-[16px]">block</span>
                                        Tidak Aktif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION (if exists) --}}
        @if(method_exists($pemesanan, 'links'))
            <div class="px-6 py-4 border-t border-ant-borderSplit">
                {{ $pemesanan->links() }}
            </div>
        @endif
    </div>

    {{-- SUMMARY CARD --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="ant-card p-6 text-center">
            <span class="material-symbols-outlined text-ant-primary text-[32px] mb-3 block">pending_actions</span>
            <div class="text-2xl font-bold text-ant-text">{{ $pemesanan->where('status_pembayaran', 'pending')->count() }}</div>
            <div class="text-[11px] text-ant-textSecondary uppercase tracking-wider mt-1">Menunggu Pembayaran</div>
        </div>

        <div class="ant-card p-6 text-center">
            <span class="material-symbols-outlined text-green-600 text-[32px] mb-3 block">task_alt</span>
            <div class="text-2xl font-bold text-ant-text">{{ $pemesanan->where('status_pembayaran', 'paid')->count() }}</div>
            <div class="text-[11px] text-ant-textSecondary uppercase tracking-wider mt-1">Sudah Lunas</div>
        </div>

        <div class="ant-card p-6 text-center">
            <span class="material-symbols-outlined text-red-600 text-[32px] mb-3 block">cancel</span>
            <div class="text-2xl font-bold text-ant-text">{{ $pemesanan->where('status_pembayaran', 'cancelled')->count() }}</div>
            <div class="text-[11px] text-ant-textSecondary uppercase tracking-wider mt-1">Dibatalkan</div>
        </div>
    </div>
@endif

@endsection

