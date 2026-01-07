@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto py-8 animate-fade-in">
    {{-- BREADCRUMBS --}}
    <div class="flex items-center gap-2 text-ant-textSecondary text-xs mb-4">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-ant-primary transition-colors">Dashboard</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="{{ route('admin.kamar.index') }}" class="hover:text-ant-primary transition-colors">Manajemen Kamar</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-ant-text font-medium">Edit Kamar</span>
    </div>

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-ant-text flex items-center gap-3">
            <div class="w-10 h-10 bg-ant-primary/10 rounded-xl flex items-center justify-center text-ant-primary shadow-sm">
                <span class="material-symbols-outlined text-[24px]">edit_square</span>
            </div>
            Edit Data Kamar
        </h1>
        <p class="text-sm text-ant-textSecondary mt-2">Perbarui informasi, status, atau fasilitas untuk tipe kamar ini.</p>
    </div>

    {{-- FORM CARD --}}
    <div class="ant-card bg-white shadow-sm overflow-hidden">
        <div class="p-8">
            {{-- ERROR VALIDATION MESSAGE --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg flex items-start gap-3">
                    <span class="material-symbols-outlined text-red-500 mt-0.5">error</span>
                    <div>
                        <p class="text-sm font-bold text-red-800 mb-1">Terjadi Kesalahan:</p>
                        <p class="text-xs text-red-700 font-medium">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.kamar.update', $kamar->id_kamar) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- TIPE KAMAR --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">bed</span>
                            Tipe Kamar
                        </label>
                        <input type="text" name="tipe_kamar" value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}" required placeholder="Contoh: Deluxe Room"
                               class="w-full px-4 py-2.5 border border-ant-border rounded-lg text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
                    </div>

                    {{-- HARGA --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">payments</span>
                            Harga (Rp)
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-ant-textSecondary">Rp</span>
                            <input type="text" name="harga" id="harga" value="{{ number_format((float)old('harga', $kamar->harga), 0, ',', '.') }}" required
                                   class="w-full pl-11 pr-4 py-2.5 border border-ant-border rounded-lg text-sm font-bold text-ant-primary focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- KAPASITAS --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">group</span>
                            Kapasitas Tamu
                        </label>
                        <input type="number" name="kapasitas" value="{{ old('kapasitas', $kamar->kapasitas) }}" min="1" required
                               class="w-full px-4 py-2.5 border border-ant-border rounded-lg text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
                    </div>

                    {{-- STATUS --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">rule</span>
                            Status Kamar
                        </label>
                        <select name="status" class="w-full px-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all cursor-pointer" required>
                            <option value="available" {{ $kamar->status=='available' ? 'selected' : '' }}>Available</option>
                            <option value="booked" {{ $kamar->status=='booked' ? 'selected' : '' }}>Booked</option>
                            <option value="maintenance" {{ $kamar->status=='maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="unavailable" {{ $kamar->status=='unavailable' ? 'selected' : '' }}>Unavailable</option>
                        </select>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="space-y-1.5">
                    <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">description</span>
                        Deskripsi Kamar
                    </label>
                    <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi lengkap kamar..."
                              class="w-full px-4 py-3 border border-ant-border rounded-lg text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all resize-none">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
                </div>

                {{-- FASILITAS --}}
                <div class="space-y-3 p-5 bg-ant-bg/50 rounded-xl border border-ant-borderSplit">
                    <label class="text-sm font-bold text-ant-text flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-[18px] text-ant-primary">build</span>
                        Fasilitas Kamar
                    </label>
                    @php
                        $listFasilitas = ["WiFi", "AC", "TV", "Sarapan", "Kamar Mandi Dalam", "Air Panas", "Lemari", "Meja Kerja"];
                        $fasilitasTerpilih = $kamar->fasilitas ?? [];
                    @endphp
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($listFasilitas as $f)
                            <label class="flex items-center gap-2 text-xs font-medium text-ant-textSecondary cursor-pointer group">
                                <input type="checkbox" name="fasilitas[]" value="{{ $f }}"
                                       {{ in_array($f, $fasilitasTerpilih) ? 'checked' : '' }}
                                       class="w-4 h-4 rounded border-ant-border text-ant-primary focus:ring-0 cursor-pointer">
                                <span class="group-hover:text-ant-text transition-colors">{{ $f }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- FOTO UTAMA --}}
                <div class="space-y-1.5">
                    <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-ant-textQuaternary">image</span>
                        Perbarui Foto Utama
                    </label>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- CURRENT FOTO --}}
                        @if($kamar->foto_utama)
                            <div class="space-y-2">
                                <p class="text-[10px] uppercase font-bold text-ant-textSecondary tracking-widest">Foto Saat Ini</p>
                                <div class="w-full h-40 rounded-xl overflow-hidden border border-ant-borderSplit shadow-sm">
                                    <img src="{{ asset('uploads/kamar/'.$kamar->foto_utama) }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endif

                        {{-- UPLOAD NEW --}}
                        <div class="space-y-2">
                            <p class="text-[10px] uppercase font-bold text-ant-textSecondary tracking-widest">Ganti Foto Baru</p>
                            <div class="group relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-ant-border rounded-xl bg-ant-bg/5 hover:bg-ant-bg/20 transition-all cursor-pointer overflow-hidden">
                                <input type="file" name="foto_utama" accept="image/*" id="foto_utama_edit"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div id="upload-placeholder-edit" class="flex flex-col items-center justify-center text-center p-6">
                                    <span class="material-symbols-outlined text-[32px] text-ant-textQuaternary mb-2 group-hover:scale-110 transition-transform duration-300">add_a_photo</span>
                                    <p class="text-[10px] font-bold text-ant-textSecondary uppercase tracking-wider">Klik Unggah</p>
                                </div>
                                <img id="preview-edit" class="hidden absolute inset-0 w-full h-full object-cover z-0">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="pt-6 border-t border-ant-borderSplit flex items-center justify-between">
                    <a href="{{ route('admin.kamar.index') }}" class="flex items-center gap-2 text-ant-textSecondary hover:text-ant-text text-sm font-bold transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </a>
                    <button type="submit" class="ant-btn-primary h-11 px-10 shadow-lg shadow-ant-primary/20">
                        <span class="material-symbols-outlined text-[20px]">check</span>
                        Update Kamar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview foto
    document.getElementById("foto_utama_edit").addEventListener("change", function (e) {
        if (e.target.files && e.target.files[0]) {
            const preview = document.getElementById("preview-edit");
            const placeholder = document.getElementById("upload-placeholder-edit");
            preview.src = URL.createObjectURL(e.target.files[0]);
            preview.classList.remove("hidden");
            placeholder.classList.add("opacity-20");
        }
    });

    // Format harga dengan pemisah ribuan
    const hargaInputEdit = document.getElementById('harga');
    hargaInputEdit.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value) {
            value = parseInt(value).toLocaleString('id-ID');
        }
        e.target.value = value;
    });

    // Hapus format sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const hargaRaw = hargaInputEdit.value.replace(/\./g, '');
        hargaInputEdit.value = hargaRaw;
    });
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
</style>

@endsection



