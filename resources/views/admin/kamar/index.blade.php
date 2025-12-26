@extends('layouts.admin')

@section('content')

<div class="p-10">

    <h1 class="text-3xl font-bold text-blue-800 mb-6">
        🏨 Kelola Kamar
    </h1>

    {{-- BUTTON TAMBAH KAMAR --}}
    <a href="{{ route('admin.kamar.create') }}"
       class="inline-block px-5 py-3 bg-blue-600 text-white rounded-xl shadow
              hover:bg-blue-700 transition">
        ➕ Tambah Kamar
    </a>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mt-4 p-3 bg-green-200 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER --}}
    <form method="GET" class="mt-6 mb-4 flex flex-wrap gap-4 items-center">

        <select name="status" class="p-3 border rounded-xl">
            <option value="">Semua Status</option>
            <option value="available"   {{ request('status')=='available' ? 'selected' : '' }}>Available</option>
            <option value="booked"      {{ request('status')=='booked' ? 'selected' : '' }}>Booked</option>
            <option value="maintenance" {{ request('status')=='maintenance' ? 'selected' : '' }}>Maintenance</option>
            <option value="unavailable" {{ request('status')=='unavailable' ? 'selected' : '' }}>Unavailable</option>
        </select>

        <input type="text"
               name="tipe_kamar"
               value="{{ request('tipe_kamar') }}"
               placeholder="Cari tipe kamar..."
               class="p-3 border rounded-xl w-64">

        <button class="px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
            Filter
        </button>
    </form>

    {{-- TABLE --}}
    <div class="mt-6 glass p-6 rounded-2xl shadow-xl overflow-x-auto">

        @if($kamar->isEmpty())
            <div class="p-6 text-center text-gray-500">
                Tidak ada data kamar
            </div>
        @else

        <table class="w-full border-collapse">
            <thead>
                <tr class="font-semibold text-gray-700 border-b bg-white/40">
                    <th class="py-3 text-left">Foto</th>
                    <th class="py-3 text-left">Tipe</th>
                    <th class="py-3 text-left">Deskripsi</th>
                    <th class="py-3 text-left">Fasilitas</th>
                    <th class="py-3 text-left">Harga</th>
                    <th class="py-3 text-left">Status</th>
                    <th class="py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($kamar as $km)
                <tr class="border-b hover:bg-blue-50 transition">

                    {{-- FOTO --}}
                    <td class="py-3">
                        @php
                            $fotoPath = $km->foto_utama
                                ? public_path('uploads/kamar/' . $km->foto_utama)
                                : null;
                        @endphp

                        @if($fotoPath && file_exists($fotoPath))
                            <img src="{{ asset('uploads/kamar/' . $km->foto_utama) }}"
                                 class="w-20 h-16 object-cover rounded-lg shadow">
                        @else
                            <div class="w-20 h-16 bg-gray-300 rounded-lg
                                        flex items-center justify-center text-gray-600">
                                No Photo
                            </div>
                        @endif
                    </td>

                    {{-- TIPE --}}
                    <td class="py-3 font-semibold text-gray-800">
                        {{ $km->tipe_kamar }}
                    </td>

                    {{-- DESKRIPSI --}}
                    <td class="py-3 text-gray-700 max-w-xs truncate">
                        {{ $km->deskripsi ?: '-' }}
                    </td>

                    {{-- FASILITAS (FINAL FIX) --}}
                    <td class="py-3 text-gray-700 text-sm">
                        @php
                            $fasilitas = is_array($km->fasilitas)
                                ? $km->fasilitas
                                : json_decode($km->fasilitas ?? '[]', true);
                        @endphp

                        @forelse($fasilitas as $f)
                            <span class="px-2 py-1 bg-blue-100 text-blue-700
                                         rounded-lg text-xs mr-1 mb-1 inline-block">
                                {{ $f }}
                            </span>
                        @empty
                            <span class="text-gray-400 italic">Tidak ada</span>
                        @endforelse
                    </td>

                    {{-- HARGA --}}
                    <td class="py-3 text-gray-700">
                        Rp {{ number_format($km->harga, 0, ',', '.') }}
                    </td>

                    {{-- STATUS --}}
                    <td class="py-3">
                        @php
                            $badgeColor = match($km->status) {
                                'available'   => 'bg-green-500',
                                'booked'      => 'bg-yellow-500',
                                'maintenance' => 'bg-red-500',
                                'unavailable' => 'bg-gray-500',
                                default       => 'bg-gray-400',
                            };
                        @endphp

                        <span class="px-3 py-1 text-white text-sm rounded-full {{ $badgeColor }}">
                            {{ ucfirst($km->status) }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="py-3">
                        <div class="flex gap-3 justify-center">

                            <a href="{{ route('admin.kamar.show', $km->id_kamar) }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded-xl shadow hover:bg-blue-600">
                                👁 Detail
                            </a>

                            <a href="{{ route('admin.kamar.edit', $km->id_kamar) }}"
                               class="px-4 py-2 bg-yellow-500 text-white rounded-xl shadow hover:bg-yellow-600">
                                ✏ Edit
                            </a>

                            <form action="{{ route('admin.kamar.delete', $km->id_kamar) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus kamar ini?')"
                                        class="px-4 py-2 bg-red-600 text-white rounded-xl shadow hover:bg-red-700">
                                    🗑 Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $kamar->links() }}
        </div>

        @endif
    </div>

</div>

@endsection
