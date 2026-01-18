@extends('layouts.tamu')

@section('content')
<div class="max-w-5xl mx-auto">
    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-ant-text mb-2">Pusat Bantuan</h1>
        <p class="text-ant-textSecondary">Temukan jawaban untuk pertanyaan Anda tentang reservasi hotel</p>
    </div>

    {{-- QUICK LINKS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="ant-card p-6 hover:shadow-lg transition-all cursor-pointer" onclick="scrollToSection('booking')">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-ant-primary text-[28px]">hotel</span>
            </div>
            <h3 class="font-bold text-ant-text mb-2">Cara Booking</h3>
            <p class="text-sm text-ant-textSecondary">Panduan lengkap memesan kamar</p>
        </div>

        <div class="ant-card p-6 hover:shadow-lg transition-all cursor-pointer" onclick="scrollToSection('payment')">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-green-600 text-[28px]">payment</span>
            </div>
            <h3 class="font-bold text-ant-text mb-2">Pembayaran</h3>
            <p class="text-sm text-ant-textSecondary">Cara upload bukti transfer</p>
        </div>

        <div class="ant-card p-6 hover:shadow-lg transition-all cursor-pointer" onclick="scrollToSection('contact')">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-purple-600 text-[28px]">support_agent</span>
            </div>
            <h3 class="font-bold text-ant-text mb-2">Hubungi Kami</h3>
            <p class="text-sm text-ant-textSecondary">Butuh bantuan lebih lanjut?</p>
        </div>
    </div>

    {{-- PANDUAN BOOKING --}}
    <div id="booking" class="ant-card p-6 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-ant-primary">hotel</span>
            </div>
            <h2 class="text-xl font-bold text-ant-text">Panduan Booking Kamar</h2>
        </div>

        <div class="space-y-4">
            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-ant-primary text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Cari Kamar yang Tersedia</h4>
                    <p class="text-sm text-ant-textSecondary">Klik menu <strong>"Cari Kamar"</strong> di sidebar untuk melihat daftar kamar yang tersedia. Anda bisa melihat detail kamar, harga, dan fasilitas.</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-ant-primary text-white rounded-full flex items-center justify-center font-bold text-sm">2</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Pilih Kamar dan Isi Data</h4>
                    <p class="text-sm text-ant-textSecondary">Klik tombol <strong>"Pesan Sekarang"</strong> pada kamar yang Anda inginkan. Isi tanggal check-in, check-out, dan jumlah tamu.</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-ant-primary text-white rounded-full flex items-center justify-center font-bold text-sm">3</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Konfirmasi Pemesanan</h4>
                    <p class="text-sm text-ant-textSecondary">Review detail pemesanan Anda dan klik <strong>"Konfirmasi Pemesanan"</strong>. Pemesanan Anda akan tersimpan dengan status "Pending".</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-ant-primary text-white rounded-full flex items-center justify-center font-bold text-sm">4</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Upload Bukti Pembayaran</h4>
                    <p class="text-sm text-ant-textSecondary">Lakukan transfer sesuai total yang tertera, lalu upload bukti pembayaran melalui menu <strong>"Pembayaran"</strong> atau <strong>"Riwayat"</strong>.</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">✓</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Menunggu Verifikasi</h4>
                    <p class="text-sm text-ant-textSecondary">Admin akan memverifikasi pembayaran Anda. Anda akan mendapat notifikasi setelah pembayaran diverifikasi.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- PANDUAN PEMBAYARAN --}}
    <div id="payment" class="ant-card p-6 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-green-600">payment</span>
            </div>
            <h2 class="text-xl font-bold text-ant-text">Cara Upload Bukti Pembayaran</h2>
        </div>

        <div class="space-y-4">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-blue-600">info</span>
                    <div>
                        <p class="text-sm text-blue-900 font-medium mb-1">Informasi Rekening</p>
                        <p class="text-sm text-blue-800">Bank BCA - 1234567890</p>
                        <p class="text-sm text-blue-800">a.n. Blue Haven Hotel</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">1</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Transfer Sesuai Total</h4>
                    <p class="text-sm text-ant-textSecondary">Transfer sejumlah total pembayaran yang tertera di detail pemesanan ke rekening hotel.</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">2</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Buka Menu Riwayat</h4>
                    <p class="text-sm text-ant-textSecondary">Klik menu <strong>"Riwayat"</strong> di sidebar, lalu cari pemesanan yang ingin Anda bayar.</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">3</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Upload Bukti Transfer</h4>
                    <p class="text-sm text-ant-textSecondary">Klik tombol <strong>"Upload Bukti"</strong>, pilih file foto/screenshot bukti transfer, lalu submit.</p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-shrink-0 w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">✓</div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Tunggu Verifikasi</h4>
                    <p class="text-sm text-ant-textSecondary">Admin akan memverifikasi dalam 1x24 jam. Anda akan mendapat notifikasi jika pembayaran diterima atau ditolak.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- FAQ ACCORDION --}}
    <div class="ant-card p-6 mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-yellow-600">quiz</span>
            </div>
            <h2 class="text-xl font-bold text-ant-text">Pertanyaan yang Sering Diajukan (FAQ)</h2>
        </div>

        <div class="space-y-3" x-data="{ open: null }">
            {{-- FAQ 1 --}}
            <div class="border border-ant-border rounded-lg overflow-hidden">
                <button @click="open = open === 1 ? null : 1" class="w-full px-4 py-3 flex items-center justify-between bg-white hover:bg-ant-bg transition-colors text-left">
                    <span class="font-medium text-ant-text">Bagaimana cara membatalkan pemesanan?</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open !== 1">expand_more</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open === 1" style="display: none;">expand_less</span>
                </button>
                <div x-show="open === 1" x-collapse style="display: none;">
                    <div class="px-4 py-3 bg-ant-bg border-t border-ant-borderSplit">
                        <p class="text-sm text-ant-textSecondary">Untuk membatalkan pemesanan, silakan hubungi customer service kami melalui WhatsApp atau email. Pembatalan harus dilakukan minimal 24 jam sebelum check-in.</p>
                    </div>
                </div>
            </div>

            {{-- FAQ 2 --}}
            <div class="border border-ant-border rounded-lg overflow-hidden">
                <button @click="open = open === 2 ? null : 2" class="w-full px-4 py-3 flex items-center justify-between bg-white hover:bg-ant-bg transition-colors text-left">
                    <span class="font-medium text-ant-text">Apakah bisa check-in lebih awal?</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open !== 2">expand_more</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open === 2" style="display: none;">expand_less</span>
                </button>
                <div x-show="open === 2" x-collapse style="display: none;">
                    <div class="px-4 py-3 bg-ant-bg border-t border-ant-borderSplit">
                        <p class="text-sm text-ant-textSecondary">Check-in normal dimulai pukul 14:00. Early check-in dapat diatur tergantung ketersediaan kamar. Silakan hubungi resepsionis untuk konfirmasi.</p>
                    </div>
                </div>
            </div>

            {{-- FAQ 3 --}}
            <div class="border border-ant-border rounded-lg overflow-hidden">
                <button @click="open = open === 3 ? null : 3" class="w-full px-4 py-3 flex items-center justify-between bg-white hover:bg-ant-bg transition-colors text-left">
                    <span class="font-medium text-ant-text">Berapa lama proses verifikasi pembayaran?</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open !== 3">expand_more</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open === 3" style="display: none;">expand_less</span>
                </button>
                <div x-show="open === 3" x-collapse style="display: none;">
                    <div class="px-4 py-3 bg-ant-bg border-t border-ant-borderSplit">
                        <p class="text-sm text-ant-textSecondary">Verifikasi pembayaran biasanya memakan waktu 1-24 jam pada hari kerja. Anda akan mendapat notifikasi setelah pembayaran diverifikasi oleh admin.</p>
                    </div>
                </div>
            </div>

            {{-- FAQ 4 --}}
            <div class="border border-ant-border rounded-lg overflow-hidden">
                <button @click="open = open === 4 ? null : 4" class="w-full px-4 py-3 flex items-center justify-between bg-white hover:bg-ant-bg transition-colors text-left">
                    <span class="font-medium text-ant-text">Apakah ada biaya tambahan selain harga kamar?</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open !== 4">expand_more</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open === 4" style="display: none;">expand_less</span>
                </button>
                <div x-show="open === 4" x-collapse style="display: none;">
                    <div class="px-4 py-3 bg-ant-bg border-t border-ant-borderSplit">
                        <p class="text-sm text-ant-textSecondary">Harga yang tertera sudah termasuk pajak dan service charge. Tidak ada biaya tersembunyi. Biaya tambahan hanya berlaku untuk layanan ekstra seperti room service atau laundry.</p>
                    </div>
                </div>
            </div>

            {{-- FAQ 5 --}}
            <div class="border border-ant-border rounded-lg overflow-hidden">
                <button @click="open = open === 5 ? null : 5" class="w-full px-4 py-3 flex items-center justify-between bg-white hover:bg-ant-bg transition-colors text-left">
                    <span class="font-medium text-ant-text">Bagaimana jika bukti pembayaran ditolak?</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open !== 5">expand_more</span>
                    <span class="material-symbols-outlined text-ant-textSecondary" x-show="open === 5" style="display: none;">expand_less</span>
                </button>
                <div x-show="open === 5" x-collapse style="display: none;">
                    <div class="px-4 py-3 bg-ant-bg border-t border-ant-borderSplit">
                        <p class="text-sm text-ant-textSecondary">Jika bukti pembayaran ditolak, Anda akan mendapat notifikasi dengan alasan penolakan. Anda bisa upload ulang bukti pembayaran yang benar melalui menu Riwayat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTACT INFO --}}
    <div id="contact" class="ant-card p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-purple-600">support_agent</span>
            </div>
            <h2 class="text-xl font-bold text-ant-text">Hubungi Customer Service</h2>
        </div>

        <p class="text-sm text-ant-textSecondary mb-6">Masih ada pertanyaan? Tim kami siap membantu Anda!</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-start gap-4 p-4 bg-ant-bg rounded-lg">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-green-600">phone</span>
                </div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">WhatsApp</h4>
                    <p class="text-sm text-ant-textSecondary mb-2">Hubungi kami via WhatsApp</p>
                    <a href="https://wa.me/628123456789" target="_blank" class="text-sm text-ant-primary hover:underline">+62 812-3456-789</a>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 bg-ant-bg rounded-lg">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-ant-primary">email</span>
                </div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Email</h4>
                    <p class="text-sm text-ant-textSecondary mb-2">Kirim email ke kami</p>
                    <a href="mailto:support@bluehaven.com" class="text-sm text-ant-primary hover:underline">support@bluehaven.com</a>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 bg-ant-bg rounded-lg">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-orange-600">schedule</span>
                </div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Jam Operasional</h4>
                    <p class="text-sm text-ant-textSecondary">Senin - Minggu</p>
                    <p class="text-sm text-ant-text font-medium">08:00 - 22:00 WIB</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-4 bg-ant-bg rounded-lg">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-red-600">location_on</span>
                </div>
                <div>
                    <h4 class="font-semibold text-ant-text mb-1">Alamat Hotel</h4>
                    <p class="text-sm text-ant-textSecondary">Jl. Blue Haven No. 123</p>
                    <p class="text-sm text-ant-textSecondary">Jakarta Selatan, DKI Jakarta</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function scrollToSection(id) {
        const element = document.getElementById(id);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
</script>
@endsection
