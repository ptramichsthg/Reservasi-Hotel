@extends('layouts.tamu')

@section('content')

<div class="animate-fade-in max-w-2xl mx-auto">
    {{-- BREADCRUMB / BACK --}}
    <div class="mb-6">
        <a href="{{ route('tamu.orders.history') }}" class="inline-flex items-center gap-2 text-ant-textSecondary hover:text-ant-primary transition-colors group">
            <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
            <span class="text-sm font-medium">Kembali ke Riwayat</span>
        </a>
    </div>

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-ant-text flex items-center gap-3">
            <div class="w-10 h-10 bg-ant-primary/10 rounded-xl flex items-center justify-center text-ant-primary shadow-sm shadow-ant-primary/10">
                <span class="material-symbols-outlined text-[24px]">payments</span>
            </div>
            Konfirmasi Pembayaran
        </h1>
        <p class="text-sm text-ant-textSecondary mt-2">
            Unggah bukti transfer Anda untuk diverifikasi oleh tim administrasi kami.
        </p>
    </div>

    {{-- ALERT ERROR --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3 animate-shake">
            <span class="material-symbols-outlined text-red-500 text-[20px]">error</span>
            <ul class="text-xs text-red-700 font-medium list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- UPLOAD CARD --}}
    <div class="ant-card overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
        <div class="p-8">
            <form action="{{ route('tamu.payment.upload') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-8">
                @csrf
                <input type="hidden" name="reservasi_id" value="{{ $reservasi_id }}">

                <div class="space-y-4">
                    <label class="block">
                        <span class="text-sm font-bold text-ant-text mb-1 block">Foto Bukti Transfer</span>
                        <span class="text-[11px] text-ant-textSecondary block mb-3">Pastikan nominal transfer dan nomor rekening terlihat jelas.</span>
                    </label>

                    <div x-data="{ fileName: '' }" class="relative">
                        <div class="group relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-ant-border rounded-xl bg-ant-bg/5 hover:bg-ant-bg/20 transition-all cursor-pointer">
                            <input type="file" name="bukti" required
                                   @change="fileName = $event.target.files[0].name"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="flex flex-col items-center justify-center text-center p-6">
                                <span class="material-symbols-outlined text-[48px] text-ant-textSecondary mb-3 group-hover:scale-110 transition-transform duration-300">add_photo_alternate</span>
                                <p class="text-sm font-medium text-ant-text mb-1" x-text="fileName || 'Klik atau tarik file ke sini'"></p>
                                <p class="text-[11px] text-ant-textSecondary" x-show="!fileName">Format: JPG, PNG, WEBP (Maks. 5MB)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50/50 rounded-xl p-4 border border-blue-100 flex items-start gap-4">
                    <span class="material-symbols-outlined text-blue-500 text-[20px] mt-0.5">info</span>
                    <div>
                        <p class="text-xs font-bold text-blue-700 mb-1">Penting</p>
                        <p class="text-[11px] text-blue-600 leading-relaxed">
                            Verifikasi biasanya membutuhkan waktu 10-30 menit jam kerja. Setelah dikonfirmasi, status reservasi Anda akan berubah menjadi <span class="font-bold">Lunas</span>.
                        </p>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-4 bg-ant-primary text-white rounded-xl font-bold text-sm shadow-lg shadow-ant-primary/25 hover:bg-ant-primaryHover hover:-translate-y-0.5 transition-all duration-300 active:translate-y-0 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">cloud_upload</span>
                        Kirim Bukti Pembayaran
                    </button>
                    <p class="text-[10px] text-ant-textSecondary text-center mt-4">
                        Dengan menekan tombol di atas, Anda menyatakan bahwa data yang dikirim adalah benar.
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-4px); }
        75% { transform: translateX(4px); }
    }
    .animate-shake {
        animation: shake 0.3s ease-in-out;
    }
</style>

@endsection



