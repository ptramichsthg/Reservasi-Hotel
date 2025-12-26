<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registrasi akun Blue Haven Hotel">
    <title>Register - Blue Haven Hotel</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * { box-sizing: border-box; }

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

        .glass {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
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
            background: linear-gradient(120deg,#3b82f6,#22d3ee,#a855f7,#3b82f6);
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

        .fade-in {
            animation: fadeIn .6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59,130,246,.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(59,130,246,.4);
        }
    </style>
</head>

<body>

<div class="glass rgb-border w-full max-w-md p-10 shadow-2xl fade-in">

    <!-- TITLE -->
    <div class="text-center mb-8">
        <h2 class="text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-cyan-400 text-transparent bg-clip-text">
            Buat Akun
        </h2>
        <p class="text-gray-700 mt-2 font-medium">
            Daftar Akun Blue Haven Hotel
        </p>
    </div>

    {{-- SESSION ERROR --}}
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-4 text-sm font-semibold">
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- NAME --}}
        <div>
            <label class="block font-semibold mb-2 text-gray-800">Nama Lengkap</label>
            <input type="text" name="name" required
                   value="{{ old('name') }}"
                   class="input-field w-full p-3 rounded-xl border border-gray-300
                          focus:ring-2 focus:ring-blue-500 outline-none transition"
                   placeholder="Nama lengkap">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block font-semibold mb-2 text-gray-800">Email</label>
            <input type="email" name="email" required
                   value="{{ old('email') }}"
                   class="input-field w-full p-3 rounded-xl border border-gray-300
                          focus:ring-2 focus:ring-blue-500 outline-none transition"
                   placeholder="you@email.com">
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="block font-semibold mb-2 text-gray-800">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" required
                       class="input-field w-full p-3 pr-12 rounded-xl border border-gray-300
                              focus:ring-2 focus:ring-blue-500 outline-none transition"
                       placeholder="Password">

                <button type="button" onclick="togglePassword('password','eye1')"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-600">
                    <svg id="eye1" class="w-6 h-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5
                                 c4.477 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.065 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div>
            <label class="block font-semibold mb-2 text-gray-800">Konfirmasi Password</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="input-field w-full p-3 pr-12 rounded-xl border border-gray-300
                              focus:ring-2 focus:ring-blue-500 outline-none transition"
                       placeholder="Ulangi password">

                <button type="button" onclick="togglePassword('password_confirmation','eye2')"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-600">
                    <svg id="eye2" class="w-6 h-6" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5
                                 c4.477 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.065 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- SUBMIT --}}
        <button type="submit"
                class="btn-primary w-full py-3 rounded-xl text-white font-bold
                       bg-gradient-to-r from-blue-600 to-blue-700 transition">
            Daftar Sekarang
        </button>
    </form>

    {{-- LINK LOGIN --}}
    <p class="text-center mt-6 font-medium text-gray-700">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-purple-700 font-bold hover:underline">
            Login
        </a>
    </p>
</div>

<script>
    function togglePassword(id, eye) {
        const input = document.getElementById(id);
        const icon = document.getElementById(eye);
        input.type = input.type === "password" ? "text" : "password";
    }
</script>

</body>
</html>
