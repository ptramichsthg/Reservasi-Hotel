@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto glass p-8 rounded-3xl shadow">

    <h1 class="text-3xl font-bold text-blue-800 mb-6">
        ➕ Tambah Kamar
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
          action="{{ route('admin.kamar.store') }}"
          enctype="multipart/form-data">
        @csrf

        {{-- ============================
             TIPE KAMAR
        ============================ --}}
        <label class="font-semibold">Tipe Kamar</label>
        <select name="tipe_kamar"
                class="w-full p-3 rounded-xl border mb-4"
                required>

            <optgroup label="🏨 Berdasarkan Tingkatan">
                <option value="Standard Room" {{ old('tipe_kamar')=='Standard Room' ? 'selected' : '' }}>
                    Standard Room
                </option>
                <option value="Superior Room" {{ old('tipe_kamar')=='Superior Room' ? 'selected' : '' }}>
                    Superior Room
                </option>
                <option value="Deluxe Room" {{ old('tipe_kamar')=='Deluxe Room' ? 'selected' : '' }}>
                    Deluxe Room
                </option>
                <option value="Junior Suite" {{ old('tipe_kamar')=='Junior Suite' ? 'selected' : '' }}>
                    Junior Suite
                </option>
                <option value="Suite Room" {{ old('tipe_kamar')=='Suite Room' ? 'selected' : '' }}>
                    Suite Room
                </option>
                <option value="Presidential Suite" {{ old('tipe_kamar')=='Presidential Suite' ? 'selected' : '' }}>
                    Presidential Suite
                </option>
            </optgroup>

            <optgroup label="🛏️ Berdasarkan Ranjang">
                <option value="Single Room" {{ old('tipe_kamar')=='Single Room' ? 'selected' : '' }}>
                    Single Room
                </option>
                <option value="Double Room" {{ old('tipe_kamar')=='Double Room' ? 'selected' : '' }}>
                    Double Room
                </option>
                <option value="Twin Room" {{ old('tipe_kamar')=='Twin Room' ? 'selected' : '' }}>
                    Twin Room
                </option>
                <option value="Family Room" {{ old('tipe_kamar')=='Family Room' ? 'selected' : '' }}>
                    Family Room
                </option>
                <option value="Connecting Room" {{ old('tipe_kamar')=='Connecting Room' ? 'selected' : '' }}>
                    Connecting Room
                </option>
            </optgroup>

        </select>

        {{-- ============================
             HARGA
        ============================ --}}
        <label class="font-semibold">Harga (Rp)</label>
        <input type="text"
               name="harga"
               id="harga"
               value="{{ old('harga') }}"
               class="w-full p-3 rounded-xl border mb-4"
               placeholder="Contoh: 1.000.000"
               required>

        {{-- ============================
             KAPASITAS
        ============================ --}}
        <label class="font-semibold">Kapasitas Tamu</label>
        <input type="number"
               name="kapasitas"
               value="{{ old('kapasitas', 1) }}"
               min="1"
               class="w-full p-3 rounded-xl border mb-4"
               required>

        {{-- ============================
             DESKRIPSI
        ============================ --}}
        <label class="font-semibold">Deskripsi</label>
        <textarea name="deskripsi"
                  rows="4"
                  class="w-full p-3 rounded-xl border mb-4"
                  placeholder="Masukkan deskripsi lengkap kamar...">{{ old('deskripsi') }}</textarea>

        {{-- ============================
             FASILITAS
        ============================ --}}
        <label class="font-semibold">Fasilitas</label>
        <div class="grid grid-cols-2 gap-2 mb-4">

            @php
                $listFasilitas = [
                    "WiFi", "AC", "TV", "Sarapan",
                    "Kamar Mandi Dalam", "Air Panas",
                    "Lemari", "Meja Kerja"
                ];
            @endphp

            @foreach($listFasilitas as $f)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox"
                           name="fasilitas[]"
                           value="{{ $f }}"
                           {{ is_array(old('fasilitas')) && in_array($f, old('fasilitas')) ? 'checked' : '' }}>
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
            <option value="available" {{ old('status')=='available' ? 'selected' : '' }}>
                Available
            </option>
            <option value="booked" {{ old('status')=='booked' ? 'selected' : '' }}>
                Booked
            </option>
            <option value="maintenance" {{ old('status')=='maintenance' ? 'selected' : '' }}>
                Maintenance
            </option>
            <option value="unavailable" {{ old('status')=='unavailable' ? 'selected' : '' }}>
                Unavailable
            </option>
        </select>

        {{-- ============================
             FOTO UTAMA
        ============================ --}}
        <label class="font-semibold">Foto Kamar</label>
        <input type="file"
               name="foto_utama"
               accept="image/*"
               class="w-full p-3 rounded-xl border mb-4 bg-white"
               required>

        <img id="preview"
             class="hidden w-40 h-40 object-cover rounded-xl border mb-4">

        <script>
            // Preview foto
            document
                .querySelector("input[name='foto_utama']")
                .addEventListener("change", function (e) {
                    const preview = document.getElementById("preview");
                    preview.src = URL.createObjectURL(e.target.files[0]);
                    preview.classList.remove("hidden");
                });

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

        {{-- ============================
             SUBMIT
        ============================ --}}
        <button
            class="w-full bg-blue-600 text-white py-3 rounded-xl
                   hover:bg-blue-700 transition font-semibold">
            Simpan
        </button>

        <a href="{{ route('admin.kamar.index') }}"
           class="block text-center text-gray-600 hover:underline mt-4">
            ← Kembali ke daftar kamar
        </a>

    </form>
</div>

@endsection
