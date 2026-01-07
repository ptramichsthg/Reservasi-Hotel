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
    {{-- NOTIFICATION BELL --}}
    <button @click="open = !open" class="relative focus:outline-none hover:bg-ant-bg/50 p-2 rounded-lg transition-all" aria-label="Notifikasi">
        <span class="material-symbols-outlined text-ant-textSecondary text-[24px]">notifications</span>
        
        {{-- UNREAD BADGE --}}
        @if($unreadCount > 0)
            <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5 min-w-[18px] h-[18px] flex items-center justify-center">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    {{-- DROPDOWN NOTIFIKASI --}}
    <div x-show="open" @click.away="open = false" 
         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-ant-borderSplit z-50 overflow-hidden"
         style="display: none;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100">
        
        {{-- HEADER --}}
        <div class="px-4 py-3 border-b border-ant-borderSplit flex items-center justify-between">
                <h3 class="text-sm font-bold text-ant-text">Notifikasi</h3>
                @if($unreadCount > 0)
                    <form action="{{ route('tamu.notifikasi.baca-semua') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-[11px] font-medium text-ant-primary hover:underline">Tandai semua dibaca</button>
                    </form>
                @endif
            </div>

            {{-- DAFTAR NOTIFIKASI --}}
        <div class="max-h-96 overflow-y-auto">
            @forelse($notifikasis as $notif)
                <div class="px-4 py-3 border-b border-ant-borderSplit hover:bg-ant-bg/50 transition-colors cursor-pointer {{ $notif->is_read ? '' : 'bg-blue-50/30' }}">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-ant-primary/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-ant-primary text-[18px]">
                                {{ $notif->is_read ? 'mail' : 'mark_email_unread' }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-ant-text mb-1 {{ $notif->is_read ? 'font-medium' : 'font-bold' }}">
                                {{ $notif->judul }}
                            </p>
                            <p class="text-xs text-ant-textSecondary line-clamp-2">
                                {{ $notif->pesan }}
                            </p>
                            <p class="text-[10px] text-ant-textSecondary mt-1">
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </div>
                        @if(!$notif->is_read)
                            <div class="w-2 h-2 rounded-full bg-ant-primary flex-shrink-0 mt-1"></div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-4 py-12 text-center">
                    <span class="material-symbols-outlined text-ant-textSecondary text-[48px] mb-3 block">notifications_off</span>
                        <p class="py-6 text-center text-ant-textQuaternary text-xs italic">Tidak ada notifikasi baru</p>
                </div>
            @endforelse
        </div>

        {{-- FOOTER --}}
        @if($notifikasis->isNotEmpty())
            <div class="px-4 py-3 bg-ant-bg border-t border-ant-borderSplit text-center">
                <a href="{{ route('tamu.notifikasi.index') }}" class="block w-full text-center py-2 text-[11px] font-bold text-ant-primary hover:bg-ant-bg transition-colors">
                    Lihat Semua
                </a>
            </div>
        @endif
    </div>
</div>
