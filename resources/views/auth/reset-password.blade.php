<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reset password Blue Haven Hotel">
    <title>Reset Password - Blue Haven Hotel</title>
    <link rel="icon" href="data:,">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = { theme: { extend: { fontFamily: { 'inter': ['Inter', 'sans-serif'] } } } }
    </script>

    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        .gradient-bright {
            background: linear-gradient(135deg, #d1fae5 0%, #dbeafe 25%, #a7f3d0 50%, #e0f2fe 75%, #bbf7d0 100%);
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
        }
        @keyframes gradientShift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .blob { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.6; animation: blobFloat 15s infinite ease-in-out; pointer-events: none; }
        .blob-1 { width: 350px; height: 350px; background: linear-gradient(135deg, #10b981, #06b6d4); top: -100px; left: -100px; }
        .blob-2 { width: 300px; height: 300px; background: linear-gradient(135deg, #60a5fa, #34d399); bottom: -80px; right: -80px; animation-delay: -5s; }
        @keyframes blobFloat { 0%, 100% { transform: translate(0, 0) scale(1); } 33% { transform: translate(30px, -40px) scale(1.1); } 66% { transform: translate(-20px, 20px) scale(0.9); } }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.1); }
        .input-modern { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .input-modern:focus { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.2); }
        .btn-gradient { background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .btn-gradient:hover { transform: translateY(-3px); box-shadow: 0 20px 40px -10px rgba(16, 185, 129, 0.4); }
        .fade-up { animation: fadeUp 0.8s ease-out forwards; opacity: 0; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .delay-1 { animation-delay: 0.1s; } .delay-2 { animation-delay: 0.2s; } .delay-3 { animation-delay: 0.3s; } .delay-4 { animation-delay: 0.4s; }
        .eye-btn:hover { color: #10b981; transform: scale(1.1); }
    </style>
</head>

<body class="min-h-screen gradient-bright overflow-hidden">

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<div class="min-h-screen flex items-center justify-center p-4 relative z-10">
    <div class="glass-card w-full max-w-md p-8 md:p-10 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500"></div>

        <div class="text-center mb-8 fade-up">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-400 rounded-2xl mb-4 shadow-lg shadow-emerald-500/30">
                <x-heroicon-o-key class="w-8 h-8 text-white" />
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Reset Password</h1>
            <p class="text-gray-500 text-sm">Buat password baru untuk akun Anda</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 fade-up">
                <x-heroicon-o-exclamation-circle class="w-5 h-5 text-red-500 flex-shrink-0" />
                <span class="text-sm font-medium">{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="fade-up delay-1">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <x-heroicon-o-envelope class="w-5 h-5" />
                    </span>
                    <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" required readonly
                           class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 bg-gray-100 text-gray-500 cursor-not-allowed">
                </div>
            </div>

            <div class="fade-up delay-2">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <x-heroicon-o-lock-closed class="w-5 h-5" />
                    </span>
                    <input type="password" name="password" id="password" required minlength="8" placeholder="Minimal 8 karakter"
                           class="input-modern w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none text-gray-700 placeholder-gray-400 bg-white/50">
                    <button type="button" onclick="togglePassword('password')" class="eye-btn absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all">
                        <x-heroicon-o-eye class="w-5 h-5" />
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1.5">Password harus minimal 8 karakter</p>
            </div>

            <div class="fade-up delay-3">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <x-heroicon-o-key class="w-5 h-5" />
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8" placeholder="Ketik ulang password baru"
                           class="input-modern w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none text-gray-700 placeholder-gray-400 bg-white/50">
                    <button type="button" onclick="togglePassword('password_confirmation')" class="eye-btn absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all">
                        <x-heroicon-o-eye class="w-5 h-5" />
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-gradient w-full py-4 rounded-xl text-white font-bold text-base tracking-wide fade-up delay-4 flex items-center justify-center gap-2">
                <x-heroicon-o-check-circle class="w-5 h-5" />
                Reset Password Sekarang
            </button>
        </form>

        <div class="relative my-8 fade-up">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
            <div class="relative flex justify-center"><span class="px-4 bg-white/80 text-gray-400 text-sm">atau</span></div>
        </div>

        <p class="text-center text-gray-600 fade-up">
            Ingat password Anda?
            <a href="{{ route('login') }}" class="font-bold text-emerald-600 ml-1 hover:underline">Kembali ke Login</a>
        </p>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === "password" ? "text" : "password";
    }
    window.addEventListener('DOMContentLoaded', () => { document.getElementById('password').focus(); });
</script>

</body>
</html>
