@php
    use App\Models\Notifikasi;

    $user = auth()->user();

    // Ambil 5 notifikasi terbaru milik user
    $notifikasis = $user
        ? Notifikasi::where('id_user', $user->id_user)
            ->latest()
            ->take(5)
            ->get()
        : collect();

    // Hitung notifikasi yang belum dibaca
    $unreadCount = $user
        ? Notifikasi::where('id_user', $user->id_user)
            ->where('is_read', false)
            ->count()
        : 0;
@endphp

<div class="relative" x-data="{ open: false }">

    {{-- 🔔 ICON NOTIFIKASI --}}
    <button
        @click="open = !open"
        class="relative focus:outline-none"
        aria-label="Notifikasi"
    >
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-7 w-7 text-gray-700 hover:text-blue-600 transition"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405
                     A2.032 2.032 0 0118 14.158V11
                     a6.002 6.002 0 00-4-5.659V4
                     a2 2 0 10-4 0v1.341
                     C7.67 6.165 6 8.388 6 11v3.159
                     c0 .538-.214 1.055-.595 1.436L4 17h5
                     m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>

        {{-- 🔴 BADGE JUMLAH BELUM DIBACA --}}
        @if($unreadCount > 0)
            <span
                class="absolute -top-1 -right-1 bg-red-500 text-white
                       text-xs font-bold rounded-full px-1.5 min-w-[18px]
                       text-center leading-tight">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    {{-- 📥 DROPDOWN NOTIFIKASI --}}
    <div
        x-show="open"
        x-transition
        @click.outside="open = false"
        class="absolute right-0 mt-3 w-80 bg-white rounded-xl
               shadow-xl border overflow-hidden z-50"
        style="display: none;"
    >

        {{-- HEADER --}}
        <div class="px-4 py-3 font-bold text-gray-700 border-b">
            Notifikasi
        </div>

        {{-- LIST NOTIFIKASI --}}
        @forelse($notifikasis as $notif)
            <div
                class="px-4 py-3 text-sm border-b hover:bg-blue-50 transition
                       {{ $notif->is_read ? 'text-gray-600' : 'font-semibold text-gray-800' }}"
            >
                <p class="text-blue-700 font-semibold">
                    {{ $notif->judul }}
                </p>
                <p class="text-xs mt-1">
                    {{ $notif->pesan }}
                </p>
            </div>
        @empty
            <div class="px-4 py-6 text-center text-gray-500 text-sm">
                Tidak ada notifikasi
            </div>
        @endforelse

        {{-- FOOTER --}}
        <div class="px-4 py-2 text-center bg-gray-50">
            <a href="{{ route('tamu.notifikasi.index') }}"
               class="text-sm text-blue-600 hover:underline">
                Lihat semua
            </a>
        </div>

    </div>
</div>
