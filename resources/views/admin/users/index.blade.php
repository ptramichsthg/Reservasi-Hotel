@extends('layouts.admin')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-blue-900 drop-shadow flex items-center gap-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span>Kelola Admin</span>
        </h1>

        <a href="{{ route('admin.users.create') }}"
           class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow
                  hover:bg-blue-700 hover:-translate-y-0.5 transition-all">
            + Tambah Admin
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 px-4 py-3 bg-green-200 text-green-800 rounded-xl shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white/90 backdrop-blur-xl border border-white/30 rounded-2xl shadow-xl p-6">

        @if($admins->isEmpty())
            <p class="text-gray-600 text-center py-6">
                Belum ada admin yang terdaftar.
            </p>
        @else
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 uppercase tracking-wide border-b">
                        <th class="py-3 text-left">Nama</th>
                        <th class="py-3 text-left">Email</th>
                        <th class="py-3 text-left">Dibuat</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($admins as $admin)
                        <tr class="border-b hover:bg-blue-50 transition">

                            <td class="py-3 font-semibold">
                                {{ $admin->name }}
                            </td>

                            <td class="py-3">
                                {{ $admin->email }}
                            </td>

                            <td class="py-3 text-gray-500">
                                {{ $admin->created_at?->format('d M Y H:i') }}
                            </td>

                            <td class="py-3">
                                <div class="flex gap-2 justify-center">
                                    {{-- TOMBOL HAPUS --}}
                                    @if(auth()->user()->id_user !== $admin->id_user)
                                        <form method="POST"
                                              action="{{ route('admin.users.destroy', $admin->id_user) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus admin ini?')"
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-2 bg-red-600 text-white rounded-lg text-sm
                                                       hover:bg-red-700 transition flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @else
                                        <button disabled
                                            class="px-3 py-2 bg-gray-300 text-gray-500 rounded-lg text-sm cursor-not-allowed flex items-center gap-1"
                                            title="Tidak bisa menghapus akun sendiri">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            <span>Hapus</span>
                                        </button>
                                    @endif

                                    {{-- TOMBOL EDIT PROFILE --}}
                                    @if(auth()->user()->id_user === $admin->id_user)
                                        <a href="{{ route('admin.profile.edit') }}"
                                           class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm
                                                  hover:bg-blue-700 transition flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span>Edit Profile</span>
                                        </a>
                                    @else
                                        <button disabled
                                            class="px-3 py-2 bg-gray-300 text-gray-500 rounded-lg text-sm cursor-not-allowed flex items-center gap-1"
                                            title="Tidak bisa edit profile admin lain">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span>Edit Profile</span>
                                        </button>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
