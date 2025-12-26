<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Blue Haven Hotel - Hotel modern dengan kenyamanan premium">
    <title>Login - Blue Haven Hotel</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #3b82f6, #ffffff, #a855f7);
            background-size: 400% 400%;
            animation: gradientFlow 10s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
        }

        /* RGB animated border */
        .rgb-border {
            position: relative;
        }

        .rgb-border::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 2px;
            border-radius: inherit;
            background: linear-gradient(120deg, #3b82f6, #22d3ee, #a855f7, #3b82f6);
            background-size: 300% 300%;
            animation: rgbFlow 6s linear infinite;
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        @keyframes rgbFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Fade in animation */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Input focus effects */
        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Button hover effect */
        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        /* Eye icon animation */
        .eye-icon {
            transition: transform 0.2s ease;
            cursor: pointer;
        }

        .eye-icon:hover {
            transform: scale(1.1);
        }

        /* Error alert animation */
        .alert {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Link hover effect */
        .link-hover {
            position: relative;
            display: inline-block;
        }

        .link-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: currentColor;
            transition: width 0.3s ease;
        }

        .link-hover:hover::after {
            width: 100%;
        }

        /* Logo pulse */
        .logo-pulse {
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
    </style>
</head>

<body>

<!-- Main Login Container -->
<div class="glass rgb-border w-full max-w-md p-10 shadow-2xl fade-in relative z-10">

    <!-- Logo/Title -->
    <div class="text-center mb-8">
        <div class="logo-pulse inline-block">
            <svg class="w-16 h-16 mx-auto mb-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </div>
        <h2 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-cyan-400 text-transparent bg-clip-text">
            Selamat Datang
        </h2>
        <p class="text-gray-700 mt-2 font-medium">Login ke Blue Haven Hotel</p>
    </div>

    {{-- ERROR SESSION --}}
    @if (session('error'))
        <div class="alert bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-4 text-sm font-semibold flex items-start" role="alert">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="alert bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-4 text-sm flex items-start" role="alert">
            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- EMAIL FIELD --}}
        <div>
            <label for="email" class="block font-semibold mb-2 text-gray-800">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Email Address
            </label>
            <input type="email"
                   name="email"
                   id="email"
                   required
                   autocomplete="email"
                   value="{{ old('email') }}"
                   placeholder="nama@email.com"
                   class="input-field w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                   aria-label="Email address">
        </div>

        {{-- PASSWORD FIELD --}}
        <div>
            <label for="password" class="block font-semibold mb-2 text-gray-800">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Password
            </label>
            <div class="relative">
                <input type="password"
                       name="password"
                       id="password"
                       required
                       autocomplete="current-password"
                       placeholder="Masukkan password"
                       class="input-field w-full p-3 pr-12 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                       aria-label="Password">

                <button type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-600 hover:text-blue-600 eye-icon"
                        aria-label="Toggle password visibility">
                    <svg id="eyeIcon"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- REMEMBER ME & FORGOT PASSWORD --}}
        <div class="flex items-center justify-between">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox"
                       name="remember"
                       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm font-medium text-gray-700">Ingat Saya</span>
            </label>

            <a href="{{ route('password.request') }}"
               class="link-hover text-sm text-blue-600 font-semibold"
               aria-label="Lupa password">
                Lupa Password?
            </a>
        </div>

        {{-- SUBMIT BUTTON --}}
        <button type="submit"
                class="btn-primary w-full py-3 rounded-xl text-white font-bold text-lg bg-gradient-to-r from-blue-600 to-blue-700 relative z-10"
                aria-label="Login ke akun">
            <span class="relative z-10">Login Sekarang</span>
        </button>
    </form>

    {{-- DIVIDER --}}
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white/50 text-gray-600 font-medium">Atau</span>
        </div>
    </div>

    {{-- REGISTER LINK --}}
    <p class="text-center font-medium text-gray-700">
        Belum punya akun?
        <a href="{{ route('register') }}"
           class="link-hover text-purple-700 font-bold ml-1"
           aria-label="Daftar akun baru">
            Daftar Sekarang
        </a>
    </p>

    {{-- BACK TO HOME --}}
    <div class="text-center mt-6">
        <a href="/"
           class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 font-medium"
           aria-label="Kembali ke halaman utama">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Home
        </a>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');

        if (input.type === "password") {
            input.type = "text";
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
            `;
        } else {
            input.type = "password";
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            `;
        }
    }

    // Auto-focus on email field when page loads
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('email').focus();
    });

    // Add enter key support
    document.getElementById('email').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            document.getElementById('password').focus();
        }
    });
</script>

</body>
</html>
