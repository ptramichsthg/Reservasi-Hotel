@extends('layouts.tamu')

@section('content')

<div class="mb-10">
    <h2 class="text-2xl font-bold text-ant-text">Form<span class="material-symbols-outlined text-[18px]">bed</span> Reservasi Kamar</h2>
    <p class="text-sm text-ant-textSecondary mt-1">Lengkapi formulir di bawah ini untuk melakukan<span class="material-symbols-outlined text-[18px]">bed</span> Reservasi Kamar.</p>
</div>

<div class="max-w-3xl mx-auto">
    {{-- ERROR NOTIFICATIONS --}}
    @if(session('error'))
        <div class="ant-card p-4 mb-8 border-l-4 border-red-500 bg-red-50">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-red-600">error</span>
                <span class="text-sm font-medium text-red-800">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="ant-card p-4 mb-8 border-l-4 border-red-500 bg-red-50">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-red-600">error</span>
                <div class="flex-1">
                    <p class="text-sm font-bold text-red-800 mb-2">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- ROOM INFO CARD --}}
    <div class="ant-card p-6 mb-8">
        <div class="flex items-start gap-6">
            @if($kamar->foto_utama)
                @php
                    $isUrl = str_starts_with($kamar->foto_utama, 'http://') || str_starts_with($kamar->foto_utama, 'https://');
                    $imageUrl = $isUrl ? $kamar->foto_utama : asset('uploads/kamar/' . $kamar->foto_utama);
                @endphp
                <div class="w-48 h-32 rounded-lg overflow-hidden flex-shrink-0">
                    <img src="{{ $imageUrl }}" 
                         class="w-full h-full object-cover"
                         alt="Foto {{ $kamar->tipe_kamar }}"
                         onerror="this.parentElement.innerHTML='<div class=\'w-48 h-32 rounded-lg bg-ant-bg flex items-center justify-center flex-shrink-0\'><span class=\'material-symbols-outlined text-ant-textSecondary text-[48px]\'>bed</span></div>'">
                </div>
            @else
                <div class="w-48 h-32 rounded-lg bg-ant-bg flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-ant-textSecondary text-[48px]">bed</span>
                </div>
            @endif

            <div class="flex-1">
                <h3 class="text-xl font-bold text-ant-text mb-2">{{ $kamar->tipe_kamar }}</h3>
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-ant-textSecondary text-[18px]">payments</span>
                        <span class="text-sm text-ant-textSecondary">Harga per malam:</span>
                        <span class="text-lg font-bold text-ant-primary">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-ant-textSecondary text-[18px]">groups</span>
                        <span class="text-sm text-ant-textSecondary">Kapasitas maksimal:</span>
                        <span class="text-sm font-bold text-ant-text">{{ $kamar->kapasitas }} orang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RESERVATION FORM --}}
    <div class="ant-card p-8">
        <h4 class="text-base font-bold text-ant-text mb-6 pb-4 border-b border-ant-borderSplit">Detail Reservasi</h4>
        
        <form method="POST" action="{{ route('tamu.order.store') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="id_kamar" value="{{ $kamar->id_kamar }}">

            {{-- JUMLAH TAMU --}}
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">groups</span>
                    Jumlah Tamu
                </label>
                <input type="number" name="jumlah_tamu" 
                       min="1" max="{{ $kamar->kapasitas }}" 
                       value="{{ old('jumlah_tamu', 1) }}"
                       class="h-10 border border-ant-border rounded-ant px-3 text-sm focus:border-ant-primary focus:outline-none transition-all"
                       required>
                <span class="text-[11px] text-ant-textSecondary">Maksimal {{ $kamar->kapasitas }} orang</span>
            </div>

            {{-- CHECK-IN --}}
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">login</span>
                    Tanggal & Jam Check-in
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <input type="date" name="tgl_checkin" id="checkin"
                           value="{{ old('tgl_checkin') }}"
                           class="h-10 border border-ant-border rounded-xl px-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all"
                           required>
                    <input type="time" name="jam_checkin" id="jam_checkin"
                           value="{{ old('jam_checkin', '14:00') }}"
                           class="h-10 border border-ant-border rounded-xl px-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all"
                           required>
                </div>
                <span class="text-[11px] text-ant-textSecondary">Standar check-in hotel: 14:00 WIB</span>
            </div>

            {{-- CHECK-OUT --}}
            <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-ant-text flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    Tanggal & Jam Check-out
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <input type="date" name="tgl_checkout" id="checkout"
                           value="{{ old('tgl_checkout') }}"
                           class="h-10 border border-ant-border rounded-xl px-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all"
                           required>
                    <input type="time" name="jam_checkout" id="jam_checkout"
                           value="{{ old('jam_checkout', '12:00') }}"
                           class="h-10 border border-ant-border rounded-xl px-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all"
                           required>
                </div>
                <span class="text-[11px] text-ant-textSecondary">Standar check-out hotel: 12:00 WIB</span>
            </div>

            {{-- RINGKASAN PEMBAYARAN --}}
            <div id="paymentSummary" class="hidden p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border-2 border-ant-primary/20">
                <h5 class="text-sm font-bold text-ant-text mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-ant-primary text-[18px]">receipt</span>
                    Ringkasan Pembayaran
                </h5>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-ant-textSecondary">Harga per malam</span>
                        <span class="text-sm font-bold text-ant-text">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-ant-textSecondary">Jumlah malam</span>
                        <span id="nightCount" class="text-sm font-bold text-ant-text">0 malam</span>
                    </div>
                    <div class="h-px bg-ant-border my-2"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-base font-bold text-ant-text">Total Pembayaran</span>
                        <span id="totalPayment" class="text-lg font-black text-ant-primary">Rp 0</span>
                    </div>
                </div>
            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="pt-6 border-t border-ant-borderSplit">
                <button type="submit" class="ant-btn-primary w-full h-12 text-base flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    Buat Reservasi Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

{{-- DATE VALIDATION SCRIPT --}}
<script>
    const today = new Date().toISOString().split("T")[0];
    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");
    const hargaPerMalam = {{ $kamar->harga }};

    checkin.setAttribute("min", today);

    checkin.addEventListener("change", function () {
        checkout.setAttribute("min", this.value);
        calculateTotal();
    });

    checkout.addEventListener("change", function () {
        calculateTotal();
    });

    function calculateTotal() {
        const checkinDate = new Date(checkin.value);
        const checkoutDate = new Date(checkout.value);
        
        if (checkin.value && checkout.value && checkoutDate > checkinDate) {
            // Hitung durasi dalam malam
            const diffTime = Math.abs(checkoutDate - checkinDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            // Hitung total
            const total = hargaPerMalam * diffDays;
            
            // Format dengan pemisah ribuan
            const formattedTotal = new Intl.NumberFormat('id-ID').format(total);
            
            // Update tampilan
            document.getElementById('nightCount').textContent = diffDays + ' malam';
            document.getElementById('totalPayment').textContent = 'Rp ' + formattedTotal;
            document.getElementById('paymentSummary').classList.remove('hidden');
        } else {
            document.getElementById('paymentSummary').classList.add('hidden');
        }
    }
</script>

@endsection


