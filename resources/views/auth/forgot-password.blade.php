<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - BlueHaven Hotel</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* 🌈 Animated Gradient Background */
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

        /* 🧊 Glassmorphism + RGB Border */
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
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">

    <!-- FORGOT PASSWORD CARD -->
    <div class="glass rgb-border w-full max-w-md p-10 shadow-2xl
                transition-all transform hover:scale-[1.02]">

        <h2 class="text-4xl font-extrabold text-center mb-6
                   bg-gradient-to-r from-blue-600 to-cyan-400
                   text-transparent bg-clip-text drop-shadow">
            Lupa Password
        </h2>

        <p class="text-center text-gray-700 mb-6 text-sm">
            Masukkan email yang terdaftar. Kami akan mengirimkan link reset password.
        </p>

        {{-- STATUS SUCCESS --}}
        @if (session('status'))
            <div class="bg-green-300/70 text-green-900 p-3 rounded-xl mb-4 text-sm shadow font-semibold">
                {{ session('status') }}
            </div>
        @endif

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="bg-red-400/60 text-white p-3 rounded-xl mb-4 text-sm shadow">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="block text-gray-900 font-semibold mb-2">
                    Email Terdaftar
                </label>
                <input type="email" name="email" required
                       value="{{ old('email') }}"
                       class="w-full p-3 rounded-xl bg-white/50 border border-white/70
                              focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                       placeholder="you@example.com">
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                    class="w-full py-3 rounded-xl text-white font-bold text-lg
                           bg-gradient-to-r from-blue-600 to-blue-700
                           shadow-md hover:shadow-xl hover:-translate-y-1
                           transition-all duration-200">
                Kirim Link Reset 🔐
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

</body>
</html>
