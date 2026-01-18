@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto py-8">
    {{-- BREADCRUMBS --}}
    <div class="flex items-center gap-2 text-ant-textSecondary text-xs mb-4">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-ant-primary transition-colors">Dashboard</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="{{ route('admin.users.index') }}" class="hover:text-ant-primary transition-colors">Manajemen User</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-ant-text font-medium">Edit User</span>
    </div>

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-ant-text flex items-center gap-3">
            <span class="material-symbols-outlined text-ant-primary text-[28px]">manage_accounts</span>
            Edit Akun Pengguna
        </h1>
        <p class="text-sm text-ant-textSecondary mt-1">Perbarui informasi profil, alamat email, atau role pengguna.</p>
    </div>

    {{-- FORM CARD --}}
    <div class="ant-card bg-white shadow-sm border border-ant-borderSplit overflow-hidden animate-fade-in">
        <div class="p-8">
            {{-- ERROR MESSAGES --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg flex items-start gap-3">
                    <span class="material-symbols-outlined text-red-500 mt-0.5">error</span>
                    <div>
                        <p class="text-sm font-bold text-red-800 mb-1">Terjadi Kesalahan:</p>
                        <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- NAMA --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                            Nama Lengkap
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">person</span>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none">
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                            Alamat Email
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">mail</span>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full pl-10 pr-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-orange-50 border border-orange-200 rounded-xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-orange-600 mt-0.5">info</span>
                    <p class="text-xs text-orange-800 leading-relaxed font-medium">
                        Kosongkan password jika Anda tidak ingin merubahnya. Jika diisi, password lama akan diganti dengan yang baru.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- PASSWORD --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                            Password Baru
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">lock</span>
                            <input type="password" name="password" placeholder="Min 5 karakter"
                                   class="w-full pl-10 pr-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none">
                        </div>
                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-ant-text flex items-center gap-2">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">key</span>
                            <input type="password" name="password_confirmation" placeholder="Ketik ulang password"
                                   class="w-full pl-10 pr-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none">
                        </div>
                    </div>
                </div>

                {{-- ROLE SELECTION --}}
                <div class="space-y-3 p-4 bg-ant-bg/50 rounded-xl border border-ant-borderSplit/50">
                    <label class="text-sm font-bold text-ant-text">Pilih Role Pengguna <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer group">
                            <input type="radio" name="role" value="tamu" class="hidden peer" {{ $user->role === 'tamu' ? 'checked' : '' }}>
                            <div class="p-3 border-2 border-ant-borderSplit bg-white rounded-xl transition-all peer-checked:border-ant-primary peer-checked:bg-ant-primary/5 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[20px]">person</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-ant-text group-hover:text-ant-primary transition-colors">Tamu Member</p>
                                    <p class="text-[10px] text-ant-textSecondary leading-none">Akses pemesanan kamar</p>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer group">
                            <input type="radio" name="role" value="admin" class="hidden peer" {{ $user->role === 'admin' ? 'checked' : '' }}>
                            <div class="p-3 border-2 border-ant-borderSplit bg-white rounded-xl transition-all peer-checked:border-ant-primary peer-checked:bg-ant-primary/5 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-ant-text group-hover:text-ant-primary transition-colors">Administrator</p>
                                    <p class="text-[10px] text-ant-textSecondary leading-none">Akses penuh operasional</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center justify-between pt-6 border-t border-ant-borderSplit">
                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center gap-2 text-ant-textSecondary hover:text-ant-text text-sm font-bold transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </a>

                    <button type="submit" class="ant-btn-primary h-11 px-8 shadow-lg shadow-ant-primary/20">
                        <span class="material-symbols-outlined text-[20px]">check</span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
</style>

@endsection
