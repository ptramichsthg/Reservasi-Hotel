@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto glass p-8 rounded-3xl shadow">

    <h1 class="text-3xl font-bold text-blue-800 mb-6">
        ✏ Edit Kamar
    </h1>

    {{-- =============================
         ERROR VALIDATION MESSAGE
    ============================== --}}
    @if ($errors->any())
        <div class="bg-red-200 text-red-700 p-3 rounded-xl mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.kamar.update', $kamar->id_kamar) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ============================
             TIPE KAMAR
        ============================ --}}
        <label class="font-semibold">Tipe Kamar</label>
        <input type="text"
               name="tipe_kamar"
               class="w-full p-3 rounded-xl border mb-4"
               value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}"
               required>

        {{-- ============================
             HARGA
        ============================ --}}
        <label class="font-semibold">Harga (Rp)</label>
        <input type="text"
               name="harga"
               id="harga"
               class="w-full p-3 rounded-xl border mb-4"
               value="{{ number_format((float)old('harga', $kamar->harga), 0, ',', '.') }}"
               placeholder="Contoh: 1.000.000"
               required>

        {{-- ============================
             KAPASITAS TAMU
        ============================ --}}
        <label class="font-semibold">Kapasitas Tamu</label>
        <input type="number"
               name="kapasitas"
               min="1"
               class="w-full p-3 rounded-xl border mb-4"
               value="{{ old('kapasitas', $kamar->kapasitas) }}"
               required>

        {{-- ============================
             DESKRIPSI
        ============================ --}}
        <label class="font-semibold">Deskripsi</label>
        <textarea name="deskripsi"
                  rows="4"
                  class="w-full p-3 rounded-xl border mb-4"
                  placeholder="Masukkan deskripsi lengkap kamar...">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>

        {{-- ============================
             FASILITAS
        ============================ --}}
        <label class="font-semibold">Fasilitas</label>

        @php
            $listFasilitas = [
                "WiFi", "AC", "TV", "Sarapan",
                "Kamar Mandi Dalam", "Air Panas",
                "Lemari", "Meja Kerja",
            ];

            // Accessor getFasilitasAttribute() sudah mengembalikan array
            $fasilitasTerpilih = $kamar->fasilitas ?? [];
        @endphp

        <div class="grid grid-cols-2 gap-2 mb-4">
            @foreach($listFasilitas as $f)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox"
                           name="fasilitas[]"
                           value="{{ $f }}"
                           {{ in_array($f, $fasilitasTerpilih) ? 'checked' : '' }}>
                    {{ $f }}
                </label>
            @endforeach
        </div>

        {{-- ============================
             STATUS
        ============================ --}}
        <label class="font-semibold">Status</label>
        <select name="status"
                class="w-full p-3 rounded-xl border mb-6"
                required>

            <option value="available" {{ $kamar->status=='available' ? 'selected' : '' }}>
                Available — Kamar siap dipesan
            </option>

            <option value="booked" {{ $kamar->status=='booked' ? 'selected' : '' }}>
                Booked — Sudah dipesan
            </option>

            <option value="maintenance" {{ $kamar->status=='maintenance' ? 'selected' : '' }}>
                Maintenance — Sedang perbaikan
            </option>

            <option value="unavailable" {{ $kamar->status=='unavailable' ? 'selected' : '' }}>
                Unavailable — Tidak tersedia
            </option>

        </select>

        {{-- ============================
             FOTO UTAMA
        ============================ --}}
        <label class="font-semibold">Foto Utama (Opsional)</label>
        <input type="file"
               name="foto_utama"
               accept="image/*"
               class="w-full p-3 rounded-xl border mb-4 bg-white">

        @if($kamar->foto_utama)
            <p class="mb-2 text-gray-700 font-medium">Foto Saat Ini:</p>
            <img src="{{ asset('uploads/kamar/'.$kamar->foto_utama) }}"
                 class="w-40 h-40 object-cover rounded-xl border mb-4">
        @endif

        {{-- Preview Foto Baru --}}
        <img id="preview"
             class="hidden w-40 h-40 object-cover rounded-xl border mb-4">

        <script>
            document
                .querySelector("input[name='foto_utama']")
                .addEventListener("change", function (e) {
                    const preview = document.getElementById("preview");
                    preview.src = URL.createObjectURL(e.target.files[0]);
                    preview.classList.remove("hidden");
                });
        </script>

        {{-- ============================
             SUBMIT
        ============================ --}}
        <button
            class="w-full bg-blue-600 text-white py-3 rounded-xl
                   hover:bg-blue-700 transition font-semibold">
            Update
        </button>

        {{-- ============================
             BACK
        ============================ --}}
        <a href="{{ route('admin.kamar.index') }}"
           class="block text-center mt-4 text-gray-600 hover:underline">
            ← Kembali ke daftar kamar
        </a>

    </form>

    <script>
        // Format harga dengan pemisah ribuan
        const hargaInput = document.getElementById('harga');
        
        hargaInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Hapus non-digit
            if (value) {
                // Format dengan titik pemisah ribuan
                value = parseInt(value).toLocaleString('id-ID');
            }
            e.target.value = value;
        });

        // Hapus format sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const hargaValue = hargaInput.value.replace(/\./g, ''); // Hapus titik
            hargaInput.value = hargaValue;
        });
    </script>
</div>

@endsection
