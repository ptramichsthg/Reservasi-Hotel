<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Blue Haven Hotel - Hotel modern dengan kenyamanan premium">
    <title>Masuk - Blue Haven Hotel</title>
    <link rel="icon" href="data:,">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        /* Bright gradient background */
        .gradient-bright {
            background: linear-gradient(135deg, #dbeafe 0%, #fae8ff 25%, #e0f2fe 50%, #f3e8ff 75%, #e0f7fa 100%);
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Colorful blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.6;
            animation: blobFloat 15s infinite ease-in-out;
            pointer-events: none;
        }

        .blob-1 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            top: -100px;
            left: -100px;
        }

        .blob-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #34d399, #22d3ee);
            bottom: -80px;
            right: -80px;
            animation-delay: -5s;
        }

        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -40px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        /* Glass card */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.1);
        }

        /* Input styling */
        .input-modern {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-modern:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.2);
        }

        /* Button styling */
        .btn-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.4);
        }

        /* Link animation */
        .link-animated {
            position: relative;
            transition: color 0.3s ease;
        }

        .link-animated::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            transition: all 0.3s ease;
        }

        .link-animated:hover::after {
            width: 100%;
            left: 0;
        }

        /* Fade animations */
        .fade-up {
            animation: fadeUp 0.8s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }

        /* Checkbox custom */
        .checkbox-custom {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .checkbox-custom:checked {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            border-color: transparent;
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
        }

        /* Eye icon hover */
        .eye-btn:hover {
            color: #3b82f6;
            transform: scale(1.1);
        }
    </style>
</head>

<body class="min-h-screen gradient-bright overflow-hidden">

<!-- Colorful Blobs -->
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<!-- Main Container -->
<div class="min-h-screen flex items-center justify-center p-4 relative z-10">
    
    <!-- Login Card -->
    <div class="glass-card w-full max-w-md p-8 md:p-10 relative overflow-hidden">
        
        <!-- Decorative top gradient line -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-cyan-500"></div>

        <!-- Logo & Title -->
        <div class="text-center mb-8 fade-up">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-2xl mb-4 shadow-lg shadow-blue-500/30">
                <x-heroicon-o-building-office class="w-8 h-8 text-white" />
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang</h1>
            <p class="text-gray-500 text-sm">Masuk ke akun Blue Haven Hotel Anda</p>
        </div>

        {{-- ERROR ALERTS --}}
        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 fade-up" role="alert">
                <x-heroicon-o-exclamation-circle class="w-5 h-5 text-red-500 flex-shrink-0" />
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 fade-up" role="alert">
                <x-heroicon-o-exclamation-circle class="w-5 h-5 text-red-500 flex-shrink-0" />
                <span class="text-sm font-medium">{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- EMAIL --}}
            <div class="fade-up delay-1">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <x-heroicon-o-envelope class="w-5 h-5" />
                    </span>
                    <input type="email"
                           name="email"
                           id="email"
                           required
                           autocomplete="email"
                           value="{{ old('email') }}"
                           placeholder="nama@email.com"
                           class="input-modern w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none text-gray-700 placeholder-gray-400 bg-white/50">
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="fade-up delay-2">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Password
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <x-heroicon-o-lock-closed class="w-5 h-5" />
                    </span>
                    <input type="password"
                           name="password"
                           id="password"
                           required
                           autocomplete="current-password"
                           placeholder="Masukkan password"
                           class="input-modern w-full pl-12 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none text-gray-700 placeholder-gray-400 bg-white/50">
                    <button type="button"
                            onclick="togglePassword()"
                            class="eye-btn absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 transition-all">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- REMEMBER & FORGOT --}}
            <div class="flex items-center justify-between fade-up delay-3">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="checkbox-custom">
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="link-animated text-sm font-semibold text-blue-600">
                    Lupa Password?
                </a>
            </div>

            {{-- SUBMIT --}}
            <button type="submit" class="btn-gradient w-full py-4 rounded-xl text-white font-bold text-base tracking-wide fade-up delay-4">
                Masuk ke Akun
            </button>
        </form>

        {{-- DIVIDER --}}
        <div class="relative my-8 fade-up delay-5">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="px-4 bg-white/80 text-gray-400 text-sm">atau</span>
            </div>
        </div>

        {{-- REGISTER LINK --}}
        <p class="text-center text-gray-600 fade-up delay-5">
            Belum punya akun?
            <a href="{{ route('register') }}" class="link-animated font-bold text-purple-600 ml-1">
                Daftar Sekarang
            </a>
        </p>

        {{-- BACK TO HOME --}}
        <div class="text-center mt-6 fade-up delay-5">
            <a href="/" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 transition-colors">
                <x-heroicon-o-arrow-left class="w-4 h-4" />
                Kembali ke Home
            </a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        
        if (input.type === "password") {
            input.type = "text";
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
        } else {
            input.type = "password";
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
        }
    }

    // Auto-focus email
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('email').focus();
    });

    // Success message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3b82f6',
            timer: 3000,
            timerProgressBar: true
        });
    @endif
</script>

</body>
</html>
