@php
    use App\Models\Notifikasi;

    $user = auth()->user();

    if ($user && $user->role === 'admin') {
        $notifikasis = Notifikasi::with('user')
            ->latest()
            ->take(10)
            ->get();
        
        $unreadCount = Notifikasi::where('is_read', false)->count();
    } else {
        $notifikasis = $user
            ? Notifikasi::where('id_user', $user->id_user)
                ->latest()
                ->take(5)
                ->get()
            : collect();
        
        $unreadCount = $user
            ? Notifikasi::where('id_user', $user->id_user)
                ->where('is_read', false)
                ->count()
            : 0;
    }
@endphp

<div class="relative" x-data="{ open: false }">
    {{-- NOTIFICATION BELL --}}
    <button @click="open = !open" class="relative focus:outline-none hover:bg-slate-100 p-2 rounded-xl transition-all" aria-label="Notifikasi">
        <x-heroicon-o-bell class="w-6 h-6 text-slate-500" />
        
        {{-- UNREAD BADGE --}}
        @if($unreadCount > 0)
            <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5 min-w-[18px] h-[18px] flex items-center justify-center">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    {{-- DROPDOWN NOTIFIKASI --}}
    <div x-show="open" @click.away="open = false" 
         class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-slate-200 z-50 overflow-hidden"
         style="display: none;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100">
        
        {{-- HEADER --}}
        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between bg-gradient-to-r from-slate-50 to-blue-50">
            <h3 class="text-sm font-bold text-slate-800">Notifikasi</h3>
            @if($unreadCount > 0)
                <form action="{{ $user->role === 'admin' ? route('admin.notifikasi.baca-semua') : route('tamu.notifikasi.baca-semua') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-[11px] font-bold text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-full transition-all shadow-sm">Tandai semua dibaca</button>
                </form>
            @endif
        </div>

        {{-- DAFTAR NOTIFIKASI --}}
        <div class="max-h-96 overflow-y-auto">
            @forelse($notifikasis as $notif)
                <div class="px-4 py-3 border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-pointer {{ $notif->is_read ? '' : 'bg-blue-50/50' }}">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            @if($notif->is_read)
                                <x-heroicon-o-envelope-open class="w-4 h-4 text-blue-600" />
                            @else
                                <x-heroicon-o-envelope class="w-4 h-4 text-blue-600" />
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm {{ $notif->is_read ? 'font-medium text-slate-700' : 'font-bold text-slate-800' }} mb-1">
                                {{ $notif->judul }}
                            </p>
                            <p class="text-xs text-slate-500 line-clamp-2">
                                {{ $notif->pesan }}
                            </p>
                            <p class="text-[10px] text-slate-400 mt-1">
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </div>
                        @if(!$notif->is_read)
                            <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0 mt-1"></div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-4 py-12 text-center">
                    <x-heroicon-o-bell-slash class="w-12 h-12 text-slate-300 mx-auto mb-3" />
                    <p class="text-slate-400 text-xs italic">Tidak ada notifikasi baru</p>
                </div>
            @endforelse
        </div>

        {{-- FOOTER --}}
        @if($notifikasis->isNotEmpty())
            <div class="px-4 py-3 bg-slate-50 border-t border-slate-100 text-center">
                <a href="{{ $user->role === 'admin' ? route('admin.notifikasi.index') : route('tamu.notifikasi.index') }}" class="block w-full text-center py-2.5 text-[12px] font-bold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 rounded-lg transition-all shadow-md">
                    Lihat Semua Notifikasi
                </a>
            </div>
        @endif
    </div>
</div>
