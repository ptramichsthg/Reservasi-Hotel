@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto p-10">

    <h1 class="text-3xl font-bold text-blue-800 mb-6">
        👤 Edit Profile Admin
    </h1>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-200 text-green-700 rounded-xl">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-200 text-red-700 rounded-xl">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('admin.profile.update') }}" class="glass p-8 rounded-2xl shadow-xl">
        @csrf
        @method('PUT')

        {{-- NAME --}}
        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name', $admin->name) }}"
                   class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        {{-- EMAIL --}}
        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Email</label>
            <input type="email" 
                   name="email" 
                   value="{{ old('email', $admin->email) }}"
                   class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        {{-- DIVIDER --}}
        <hr class="my-6 border-gray-300">

        <p class="text-sm text-gray-600 mb-4">
            💡 <strong>Catatan:</strong> Kosongkan field password jika tidak ingin mengubah password.
        </p>

        {{-- PASSWORD --}}
        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Password Baru (Opsional)</label>
            <div class="relative">
                <input type="password" 
                       name="password" 
                       id="password"
                       class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Minimal 8 karakter">
                <button type="button" 
                        onclick="togglePassword('password')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                    <svg id="eye-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- PASSWORD CONFIRMATION --}}
        <div class="mb-6">
            <label class="block font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
            <div class="relative">
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation"
                       class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Ulangi password baru">
                <button type="button" 
                        onclick="togglePassword('password_confirmation')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                    <svg id="eye-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- SUBMIT BUTTON --}}
        <div class="flex gap-4">
            <button type="submit"
                    class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-semibold
                           hover:bg-blue-700 transition shadow-lg">
                💾 Simpan Perubahan
            </button>

            <a href="{{ route('admin.dashboard') }}"
               class="flex-1 text-center bg-gray-300 text-gray-800 py-3 rounded-xl font-semibold
                      hover:bg-gray-400 transition">
                ← Kembali
            </a>
        </div>

    </form>

</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
    }
</script>

@endsection
