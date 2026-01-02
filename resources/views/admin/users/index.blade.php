@extends('layouts.admin')

@section('content')

<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
    <div>
        <h2 class="text-2xl font-bold text-ant-text flex items-center gap-3">
            <span class="material-symbols-outlined text-[28px] text-ant-primary">group</span>
            Manajemen User
        </h2>
        <p class="text-sm text-ant-textSecondary mt-1">Kelola akun administrator dan tamu member di sistem.</p>
    </div>
    <div class="flex items-center gap-4">
        {{-- FILTER TABS --}}
        <div class="bg-ant-bg p-1 rounded-lg flex items-center border border-ant-borderSplit shadow-inner">
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-1.5 text-xs font-bold rounded-md transition-all {{ !request()->has('role') ? 'bg-white text-ant-primary shadow-sm' : 'text-ant-textSecondary hover:text-ant-text' }}">
                Semua
            </a>
            <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" 
               class="px-4 py-1.5 text-xs font-bold rounded-md transition-all {{ request()->role === 'admin' ? 'bg-white text-ant-primary shadow-sm' : 'text-ant-textSecondary hover:text-ant-text' }}">
                Admin
            </a>
            <a href="{{ route('admin.users.index', ['role' => 'tamu']) }}" 
               class="px-4 py-1.5 text-xs font-bold rounded-md transition-all {{ request()->role === 'tamu' ? 'bg-white text-ant-primary shadow-sm' : 'text-ant-textSecondary hover:text-ant-text' }}">
                Tamu
            </a>
        </div>

        <a href="{{ route('admin.users.create') }}" class="ant-btn-primary h-10 px-6">
            <span class="material-symbols-outlined text-[18px]">person_add</span>
            Tambah User Baru
        </a>
    </div>
</div>

{{-- SUCCESS/ERROR MESSAGE --}}
@if(session('success'))
    <div class="ant-card p-4 mb-8 border-l-4 border-ant-primary bg-blue-50/30 animate-slide-up">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-ant-primary">check_circle</span>
            <span class="text-sm font-bold text-ant-text">{{ session('success') }}</span>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="ant-card p-4 mb-8 border-l-4 border-red-500 bg-red-50/30 animate-slide-up">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-red-500">error</span>
            <span class="text-sm font-bold text-ant-text">{{ session('error') }}</span>
        </div>
    </div>
@endif

<div class="ant-card overflow-hidden shadow-sm animate-fade-in">
    @if($users->isEmpty())
        <div class="p-24 text-center">
            <div class="w-20 h-20 bg-ant-bg rounded-full flex items-center justify-center mx-auto mb-6 border border-ant-borderSplit/50 shadow-inner">
                <span class="material-symbols-outlined text-ant-textSecondary text-[48px]">no_accounts</span>
            </div>
            <h4 class="text-lg font-bold text-ant-text mb-2">Tidak Ada Data User</h4>
            <p class="text-ant-textSecondary text-sm mb-8 max-w-xs mx-auto">
                {{ request()->has('role') ? 'Tidak ditemukan user dengan role ' . ucfirst(request()->role) : 'Belum ada user yang terdaftar di sistem.' }}
            </p>
            <a href="{{ route('admin.users.create') }}" class="ant-btn-primary">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Tambah User Pertama
            </a>
        </div>
    @else
        <div class="overflow-x-auto text-sm">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-ant-bg/50 border-b border-ant-borderSplit">
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Identitas Pengguna</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Email</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Role</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider">Tgl Terdaftar</th>
                        <th class="py-4 px-6 font-bold text-ant-textSecondary uppercase text-[11px] tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ant-borderSplit">
                    @foreach($users as $user)
                        <tr class="hover:bg-ant-bg/30 transition-all duration-200 group">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-ant-primary/10 flex items-center justify-center text-ant-primary font-bold text-base transition-transform group-hover:scale-110">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-ant-text group-hover:text-ant-primary transition-colors">{{ $user->name }}</p>
                                        <p class="text-[11px] text-ant-textSecondary">ID: USR-{{ str_pad($user->id_user, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2 text-ant-text">
                                    <span class="material-symbols-outlined text-[16px] text-ant-textQuaternary">mail</span>
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 text-[11px] font-bold rounded-full border border-blue-200 uppercase tracking-tighter">
                                        <span class="material-symbols-outlined text-[14px]">admin_panel_settings</span>
                                        Administrator
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-orange-100 text-orange-700 text-[11px] font-bold rounded-full border border-orange-200 uppercase tracking-tighter">
                                        <span class="material-symbols-outlined text-[14px]">person</span>
                                        Tamu Member
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-ant-textSecondary font-medium">
                                {{ $user->created_at ? $user->created_at->translatedFormat('d F Y') : 'Tidak Tersedia' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id_user) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 text-ant-primary hover:bg-ant-primary/5 rounded-lg transition-all font-bold text-[12px]">
                                        <span class="material-symbols-outlined text-[16px]">edit</span>
                                        Edit
                                    </a>

                                    @if($user->id_user !== Auth::user()->id_user)
                                        <form action="{{ route('admin.users.destroy', $user->id_user) }}" method="POST" class="inline-block" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors font-bold text-[12px]">
                                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-3 py-1.5 bg-ant-bg text-ant-textQuaternary text-[11px] font-bold rounded-lg border border-ant-borderSplit/50 uppercase">
                                            Akun Anda
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($users->hasPages())
            <div class="px-6 py-4 bg-ant-bg/10 border-t border-ant-borderSplit">
                {{ $users->links() }}
            </div>
        @endif
    @endif
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
