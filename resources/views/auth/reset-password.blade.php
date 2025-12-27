<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Blue Haven Hotel</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Animated Gradient Background */
        body {
            background: linear-gradient(135deg, #3b82f6, #ffffff, #a855f7);
            background-size: 400% 400%;
            animation: gradientFlow 10s ease infinite;
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism + RGB Border */
        .glass {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .rgb-border {
            position: relative;
        }

        .rgb-border::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 2px;
            border-radius: inherit;
            background: linear-gradient(
                120deg,
                #3b82f6,
                #22d3ee,
                #a855f7,
                #3b82f6
            );
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <!-- RESET PASSWORD CARD -->
    <div class="glass rgb-border w-full max-w-md p-10 shadow-2xl fade-in">

        <h2 class="text-4xl font-extrabold text-center mb-6
                   bg-gradient-to-r from-blue-600 to-cyan-400
                   text-transparent bg-clip-text drop-shadow">
            Reset Password
        </h2>

        <p class="text-center text-gray-700 mb-6 text-sm">
            Masukkan password baru untuk akun Anda
        </p>

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="bg-red-400/60 text-white p-3 rounded-xl mb-4 text-sm shadow">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            {{-- HIDDEN TOKEN --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- EMAIL --}}
            <div>
                <label class="block text-gray-900 font-semibold mb-2">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ $email ?? old('email') }}"
                       required
                       readonly
                       class="w-full p-3 rounded-xl bg-gray-100 border border-gray-300
                              text-gray-700 cursor-not-allowed">
            </div>

            {{-- PASSWORD BARU --}}
            <div>
                <label class="block text-gray-900 font-semibold mb-2">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Password Baru
                </label>
                <div class="relative">
                    <input type="password"
                           name="password"
                           id="password"
                           required
                           minlength="8"
                           placeholder="Minimal 8 karakter"
                           class="w-full p-3 pr-12 rounded-xl bg-white/50 border border-white/70
                                  focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    
                    <button type="button"
                            onclick="togglePassword('password', 'eyeIcon1')"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-600 hover:text-blue-600">
                        <svg id="eyeIcon1" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-600 mt-1">Password harus minimal 8 karakter</p>
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div>
                <label class="block text-gray-900 font-semibold mb-2">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Konfirmasi Password
                </label>
                <div class="relative">
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           required
                           minlength="8"
                           placeholder="Ketik ulang password baru"
                           class="w-full p-3 pr-12 rounded-xl bg-white/50 border border-white/70
                                  focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    
                    <button type="button"
                            onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-600 hover:text-blue-600">
                        <svg id="eyeIcon2" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                    class="w-full py-3 rounded-xl text-white font-bold text-lg
                           bg-gradient-to-r from-blue-600 to-blue-700
                           shadow-md hover:shadow-xl hover:-translate-y-1
                           transition-all duration-200">
                Reset Password Sekarang
            </button>
        </form>

        <p class="text-center mt-6 text-gray-900 font-medium">
            Ingat password?
            <a href="{{ route('login') }}"
               class="text-purple-700 font-bold hover:underline">
                Kembali ke Login
            </a>
        </p>

    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                // Icon mata tertutup
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                `;
            } else {
                input.type = "password";
                // Icon mata terbuka
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                `;
            }
        }

        // Auto-focus on password field
        window.addEventListener('DOMContentLoaded', () => {
            document.getElementById('password').focus();
        });
    </script>

</body>
</html>
