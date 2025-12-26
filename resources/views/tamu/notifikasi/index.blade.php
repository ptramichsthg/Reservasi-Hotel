@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-3xl font-bold text-blue-800 mb-6">
        🔔 Notifikasi Saya
    </h1>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mt-4 p-3 bg-green-200 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- NOTIFIKASI LIST --}}
    <div class="glass p-6 rounded-2xl shadow-xl">

        @forelse($notifikasi as $notif)
            <div class="p-4 mb-3 rounded-xl border transition
                        {{ $notif->is_read ? 'bg-white border-gray-200' : 'bg-blue-50 border-blue-300' }}
                        hover:shadow-md">
                
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h3 class="font-bold text-lg {{ $notif->is_read ? 'text-gray-700' : 'text-blue-800' }}">
                            {{ $notif->judul }}
                        </h3>
                        <p class="text-gray-600 mt-1">
                            {{ $notif->pesan }}
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            {{ $notif->created_at->diffForHumans() }}
                        </p>
                    </div>

                    @if(!$notif->is_read)
                        <form action="{{ route('tamu.notifikasi.baca', $notif->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="ml-4 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg
                                           hover:bg-blue-700 transition">
                                Tandai Dibaca
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <p class="text-gray-500 text-lg">Tidak ada notifikasi</p>
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    @if($notifikasi->hasPages())
        <div class="mt-6">
            {{ $notifikasi->links() }}
        </div>
    @endif

</div>

@endsection
