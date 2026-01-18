@extends('layouts.admin')

@section('content')

<div class="p-6 md:p-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-ant-text flex items-center gap-3">
                <span class="material-symbols-outlined text-ant-primary text-[32px]">hotel</span>
                Manajemen Kamar
            </h1>
            <p class="text-sm text-ant-textSecondary mt-1">Kelola ketersediaan, harga, dan fasilitas kamar hotel.</p>
        </div>
        <a href="{{ route('admin.kamar.create') }}" class="ant-btn-primary h-11 px-6 shadow-lg shadow-ant-primary/20 transition-all hover:scale-105 active:scale-95">
            <span class="material-symbols-outlined text-[20px]">add_circle</span>
            Tambah Kamar Baru
        </a>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="bg-ant-successBg border border-ant-successBorder text-ant-successText px-4 py-3 rounded-lg flex items-center gap-3 animate-slide-up">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- FILTERS --}}
    <div class="bg-white p-6 rounded-2xl border border-ant-borderSplit shadow-sm">
        <form method="GET" class="flex flex-wrap items-end gap-6">
            <div class="space-y-1.5 min-w-[200px]">
                <label class="text-[11px] font-bold text-ant-textSecondary uppercase tracking-wider flex items-center gap-1.5 text-ant-textQuaternary">
                    <span class="material-symbols-outlined text-[14px]">filter_list</span>
                    Filter Status
                </label>
                <select name="status" class="w-full bg-ant-bg/50 border border-ant-borderSplit rounded-lg px-4 py-2.5 text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
                    <option value="">Semua Status</option>
                    <option value="available"   {{ request('status')=='available' ? 'selected' : '' }}>Available</option>
                    <option value="booked"      {{ request('status')=='booked' ? 'selected' : '' }}>Booked</option>
                    <option value="maintenance" {{ request('status')=='maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="unavailable" {{ request('status')=='unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <div class="space-y-1.5 flex-1 min-w-[250px]">
                <label class="text-[11px] font-bold text-ant-textSecondary uppercase tracking-wider flex items-center gap-1.5 text-ant-textQuaternary">
                    <span class="material-symbols-outlined text-[14px]">search</span>
                    Cari Tipe Kamar
                </label>
                <input type="text" name="tipe_kamar" value="{{ request('tipe_kamar') }}" placeholder="Contoh: Deluxe, Suite..."
                       class="w-full bg-ant-bg/50 border border-ant-borderSplit rounded-lg px-4 py-2.5 text-sm focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none transition-all">
            </div>

            <button type="submit" class="bg-ant-primary text-white h-11 px-8 rounded-lg text-sm font-bold hover:bg-ant-primaryHover transition-all flex items-center gap-2">
                Terapkan Filter
            </button>
            <a href="{{ route('admin.kamar.index') }}" class="h-11 px-4 flex items-center text-ant-textSecondary hover:text-ant-text text-sm transition-colors">
                Reset
            </a>
        </form>
    </div>

    {{-- KAMAR TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-ant-borderSplit overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Info Kamar</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Fasilitas</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Harga/Malam</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Status</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ant-borderSplit">
                    @forelse($kamar as $km)
                        <tr class="hover:bg-ant-bg/30 transition-all duration-200 group">
                            {{-- INFO KAMAR --}}
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    <div class="relative w-20 h-16 flex-shrink-0">
                                        @if($km->foto_utama)
                                            @php
                                                // Cek apakah URL external atau file lokal
                                                $isUrl = str_starts_with($km->foto_utama, 'http://') || str_starts_with($km->foto_utama, 'https://');
                                                $imageUrl = $isUrl ? $km->foto_utama : asset('uploads/kamar/' . $km->foto_utama);
                                            @endphp
                                            <img src="{{ $imageUrl }}"
                                                 class="w-full h-full object-cover rounded-xl shadow-sm group-hover:shadow-md transition-shadow"
                                                 onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-ant-bg border border-ant-borderSplit rounded-xl flex flex-col items-center justify-center text-ant-textQuaternary\'><span class=\'material-symbols-outlined text-[20px]\'>no_photography</span><span class=\'text-[8px] font-bold uppercase mt-1\'>No Image</span></div>'">
                                        @else
                                            <div class="w-full h-full bg-ant-bg border border-ant-borderSplit rounded-xl flex flex-col items-center justify-center text-ant-textQuaternary">
                                                <span class="material-symbols-outlined text-[20px]">no_photography</span>
                                                <span class="text-[8px] font-bold uppercase mt-1">No Image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-ant-text group-hover:text-ant-primary transition-colors text-base">{{ $km->tipe_kamar }}</p>
                                        <p class="text-[11px] text-ant-textQuaternary mt-0.5 line-clamp-1 max-w-[150px]">{{ $km->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- FASILITAS --}}
                            <td class="py-4 px-6">
                                <div class="flex flex-wrap gap-1 max-w-[200px]">
                                    @php
                                        $fasilitas = is_array($km->fasilitas) ? $km->fasilitas : json_decode($km->fasilitas ?? '[]', true);
                                    @endphp
                                    @forelse(array_slice($fasilitas, 0, 3) as $f)
                                        <span class="px-2 py-0.5 bg-ant-bg border border-ant-borderSplit text-ant-textSecondary text-[10px] rounded-md font-medium">
                                            {{ $f }}
                                        </span>
                                    @empty
                                        <span class="text-ant-textQuaternary italic text-xs">Tidak ada</span>
                                    @endforelse
                                    @if(count($fasilitas) > 3)
                                        <span class="px-2 py-0.5 bg-ant-primary/5 text-ant-primary text-[10px] rounded-md font-bold">
                                            +{{ count($fasilitas) - 3 }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            {{-- HARGA --}}
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="text-base font-bold text-ant-text">
                                        Rp {{ number_format($km->harga, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[10px] text-ant-textQuaternary font-medium">dibayar per malam</span>
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td class="py-4 px-6 text-center">
                                @php
                                    $statusConfig = match($km->status) {
                                        'available'   => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'label' => 'Available', 'icon' => 'check_circle'],
                                        'booked'      => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'label' => 'Booked', 'icon' => 'event_busy'],
                                        'maintenance' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'border' => 'border-orange-200', 'label' => 'Maintenance', 'icon' => 'build'],
                                        'unavailable' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'border' => 'border-red-200', 'label' => 'Unavailable', 'icon' => 'cancel'],
                                        default       => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'border' => 'border-gray-200', 'label' => ucfirst($km->status), 'icon' => 'help'],
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }} text-[11px] font-bold rounded-full border uppercase tracking-tighter">
                                    <span class="material-symbols-outlined text-[14px]">{{ $statusConfig['icon'] }}</span>
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.kamar.show', $km->id_kamar) }}" 
                                       class="w-9 h-9 flex items-center justify-center bg-blue-500 text-white hover:bg-blue-600 rounded-lg transition-all shadow-md hover:shadow-lg">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    </a>
                                    <a href="{{ route('admin.kamar.edit', $km->id_kamar) }}" 
                                       class="w-9 h-9 flex items-center justify-center bg-amber-500 text-white hover:bg-amber-600 rounded-lg transition-all shadow-md hover:shadow-lg">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <form action="{{ route('admin.kamar.delete', $km->id_kamar) }}" method="POST" class="inline-block" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar {{ $km->tipe_kamar }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-9 h-9 flex items-center justify-center bg-red-500 text-white hover:bg-red-600 rounded-lg transition-all shadow-md hover:shadow-lg">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-24 text-center">
                                <div class="w-20 h-20 bg-ant-bg rounded-full flex items-center justify-center mx-auto mb-6 border border-ant-borderSplit/50 shadow-inner">
                                    <span class="material-symbols-outlined text-ant-textSecondary text-[48px]">hotel_class</span>
                                </div>
                                <h4 class="text-lg font-bold text-ant-text mb-2">Data Kamar Tidak Ditemukan</h4>
                                <p class="text-ant-textSecondary text-sm mb-0">Silakan sesuaikan filter atau tambah kamar baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($kamar->hasPages())
            <div class="px-6 py-4 bg-ant-bg/10 border-t border-ant-borderSplit">
                {{ $kamar->links() }}
            </div>
        @endif
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
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up {
        animation: slide-up 0.4s ease-out forwards;
    }
</style>

@endsection
