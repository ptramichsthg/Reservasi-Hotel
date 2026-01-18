@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto py-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-ant-text flex items-center gap-3">
            <span class="material-symbols-outlined text-ant-primary text-[32px]">manage_accounts</span>
            Profil Administrator
        </h1>
        <p class="text-sm text-ant-textSecondary mt-1">Kelola informasi identitas dan pengaturan keamanan akun Anda.</p>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="bg-ant-successBg border border-ant-successBorder text-ant-successText px-4 py-3 rounded-lg flex items-center gap-3 animate-slide-up">
            <span class="material-symbols-outlined text-[20px]">verified_user</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-ant-borderSplit overflow-hidden animate-slide-up">
        <div class="p-8">
            {{-- ERROR MESSAGES --}}
            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg flex items-start gap-3">
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

            <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-10">
                @csrf
                @method('PUT')

                {{-- SECTION 1: PERSONAL INFO --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-2 pb-2 border-b border-ant-borderSplit">
                        <span class="material-symbols-outlined text-ant-primary text-[20px]">person</span>
                        <h3 class="text-sm font-bold text-ant-text uppercase tracking-wider">Informasi Dasar</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-ant-text">Nama Lengkap</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">badge</span>
                                <input type="text" name="name" value="{{ old('name', $admin->name) }}" required
                                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-ant-text">Alamat Email</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">mail</span>
                                <input type="email" name="email" value="{{ old('email', $admin->email) }}" required
                                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: SECURITY --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-2 pb-2 border-b border-ant-borderSplit">
                        <span class="material-symbols-outlined text-ant-primary text-[20px]">lock_reset</span>
                        <h3 class="text-sm font-bold text-ant-text uppercase tracking-wider">Keamanan Akun</h3>
                    </div>

                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl flex items-start gap-3">
                        <span class="material-symbols-outlined text-blue-600 mt-0.5">info</span>
                        <p class="text-xs text-blue-800 leading-relaxed font-medium">
                            Biarkan kolom di bawah ini kosong jika Anda tidak berencana untuk mengganti password saat ini.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-ant-text">Password Baru</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">vpn_key</span>
                                <input type="password" name="password" id="password" placeholder="Min. 8 karakter"
                                       class="w-full pl-10 pr-12 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none">
                                <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary hover:text-ant-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]" id="eye-password">visibility</span>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-ant-text">Konfirmasi Password</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">key</span>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ketik ulang password"
                                       class="w-full pl-10 pr-12 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary hover:text-ant-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]" id="eye-password_confirmation">visibility</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center justify-between pt-8 border-t border-ant-borderSplit">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-ant-textSecondary hover:text-ant-text text-sm font-bold transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali ke Dashboard
                    </a>

                    <button type="submit" class="bg-ant-primary text-white h-12 px-10 rounded-xl text-sm font-bold shadow-lg shadow-ant-primary/25 hover:bg-ant-primaryHover active:scale-95 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">save_as</span>
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const eye = document.getElementById('eye-' + fieldId);
        
        if (field.getAttribute('type') === 'password') {
            field.setAttribute('type', 'text');
            eye.textContent = 'visibility_off';
        } else {
            field.setAttribute('type', 'password');
            eye.textContent = 'visibility';
        }
    }
</script>

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
