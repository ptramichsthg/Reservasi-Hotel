@extends('layouts.tamu')

@section('content')

<div class="max-w-2xl mx-auto py-8 space-y-8 animate-fade-in">
    {{-- HEADER --}}
    <div class="mb-4 text-center md:text-left">
        <h1 class="text-2xl font-bold text-ant-text flex items-center justify-center md:justify-start gap-3">
            <span class="material-symbols-outlined text-ant-primary text-[32px]">person_edit</span>
            Pengaturan Profil
        </h1>
        <p class="text-sm text-ant-textSecondary mt-1">Perbarui informasi akun dan kata sandi Anda di sini.</p>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="bg-ant-successBg border border-ant-successBorder text-ant-successText px-4 py-3 rounded-lg flex items-center gap-3 animate-slide-up">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-ant-borderSplit overflow-hidden animate-slide-up">
        <div class="p-8">
            {{-- ERROR MESSAGES --}}
            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg flex items-start gap-3">
                    <span class="material-symbols-outlined text-red-500 mt-0.5">error_outline</span>
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

            <form method="POST" action="{{ route('tamu.profile.update') }}" class="space-y-10">
                @csrf
                @method('PUT')

                {{-- SECTION 1: PERSONAL INFO --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-2 pb-2 border-b border-ant-borderSplit">
                        <span class="material-symbols-outlined text-ant-primary text-[20px]">contact_page</span>
                        <h3 class="text-sm font-bold text-ant-text">Informasi Pribadi</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-ant-text">Nama Lengkap</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">person</span>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none"
                                       placeholder="Nama Anda">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-ant-text">Email</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">alternate_email</span>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none"
                                       placeholder="email@contoh.com">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2: SECURITY --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-2 pb-2 border-b border-ant-borderSplit">
                        <span class="material-symbols-outlined text-ant-primary text-[20px]">security</span>
                        <h3 class="text-sm font-bold text-ant-text">Keamanan Kata Sandi</h3>
                    </div>

                    <div class="p-4 bg-ant-bg rounded-xl flex items-start gap-3">
                        <span class="material-symbols-outlined text-ant-textQuaternary mt-0.5">info</span>
                        <p class="text-xs text-ant-textSecondary leading-relaxed">
                            Kosongkan kolom kata sandi jika tidak ingin mengubahnya. Gunakan minimal 8 karakter.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-ant-text">Kata Sandi Baru</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">lock</span>
                                <input type="password" name="password" id="password"
                                       class="w-full pl-10 pr-12 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none"
                                       placeholder="••••••••">
                                <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary hover:text-ant-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]" id="eye-password">visibility</span>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-ant-text">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary text-[18px]">verified</span>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="w-full pl-10 pr-12 py-2.5 bg-white border border-ant-border rounded-lg text-sm transition-all focus:border-ant-primary focus:ring-4 focus:ring-ant-primary/10 outline-none"
                                       placeholder="••••••••">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-ant-textQuaternary hover:text-ant-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]" id="eye-password_confirmation">visibility</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-8 border-t border-ant-borderSplit">
                    <a href="{{ route('tamu.dashboard') }}" class="flex items-center gap-2 text-ant-textSecondary hover:text-ant-primary text-sm font-bold transition-colors">
                        <span class="material-symbols-outlined text-[18px]">west</span>
                        Batal
                    </a>

                    <button type="submit" class="w-full md:w-auto bg-ant-primary text-white h-12 px-10 rounded-xl text-sm font-bold shadow-lg shadow-ant-primary/25 hover:bg-ant-primaryHover active:scale-95 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Simpan Profil
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
