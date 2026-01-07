@extends('layouts.welcome')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }

    body {
        background: linear-gradient(135deg, #3b82f6, #ffffff, #a855f7);
        background-size: 400% 400%;
        animation: gradientFlow 12s ease infinite;
    }

    @keyframes gradientFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Glassmorphism dengan shadow lebih tajam */
    .glass {
        background: rgba(255, 255, 255, 0.55);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 48px rgba(31, 38, 135, 0.25);
        background: rgba(255, 255, 255, 0.65);
    }

    .fade-slide {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeSlideIn 1.2s ease-out forwards;
    }

    @keyframes fadeSlideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .float-blob {
        will-change: transform;
        animation: floatBlob 10s infinite ease-in-out alternate;
    }

    @keyframes floatBlob {
        0% { transform: translate(0,0) scale(1); }
        50% { transform: translate(15px,-25px) scale(1.1); }
        100% { transform: translate(-15px,20px) scale(0.95); }
    }

    /* AOS animations are handled by the library */

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
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-primary:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
    }

    /* Icon animation */
    .icon-container {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #3b82f6, #06b6d4);
        border-radius: 16px;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .glass:hover .icon-container {
        transform: rotate(10deg) scale(1.1);
    }

    /* Parallax effect */
    .parallax-layer {
        transition: transform 0.3s ease-out;
    }

    /* Footer link hover */
    footer a {
        transition: color 0.3s ease, transform 0.3s ease;
        display: inline-block;
    }

    footer a:hover {
        color: #22d3ee;
        transform: translateX(4px);
    }

    /* Loading optimization */
    .bg-hero {
        background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
    }

    /* Pulse animation for CTA */
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
        }
        50% {
            box-shadow: 0 0 0 15px rgba(255, 255, 255, 0);
        }
    }

    .pulse-btn {
        animation: pulse 2s infinite;
    }
</style>

{{-- HERO SECTION --}}
<section class="relative w-full h-[90vh] flex items-center justify-center overflow-hidden" role="banner">

    {{-- Background Image with Lazy Loading --}}
    <div class="absolute inset-0 bg-hero brightness-[0.55]" loading="lazy"></div>

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-blue-700/30 via-cyan-500/20 to-blue-800/30 backdrop-blur-[3px]"></div>

    {{-- Floating Blobs --}}
    <div class="absolute w-80 h-80 bg-blue-400/30 rounded-full blur-[120px] -top-10 -left-10 float-blob" aria-hidden="true"></div>
    <div class="absolute w-[500px] h-[500px] bg-cyan-300/25 rounded-full blur-[140px] bottom-0 right-10 float-blob" style="animation-delay: 1s;" aria-hidden="true"></div>
    <div class="absolute w-72 h-72 bg-blue-500/20 rounded-full blur-[100px] top-32 right-1/3 float-blob" style="animation-delay: 2s;" aria-hidden="true"></div>

    {{-- Hero Content --}}
    <div class="relative z-10 text-center text-white px-6 fade-slide">
        <h1 class="text-4xl md:text-7xl font-black bg-gradient-to-r from-blue-300 to-cyan-200 bg-clip-text text-transparent leading-tight">
            Blue Haven Hotel
        </h1>
        <p class="text-xl md:text-4xl font-bold text-white mt-4 flex items-center justify-center gap-3">
            <span>Modern</span>
            <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full"></span>
            <span>Premium</span>
            <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full"></span>
            <span>Futuristik</span>
        </p>

        <p class="mt-6 text-lg md:text-2xl max-w-3xl mx-auto text-blue-100">
            Rasakan pengalaman menginap modern dengan kenyamanan maksimal dan desain futuristik yang memukau.
        </p>

        <a href="{{ route('login') }}"
           class="mt-10 inline-block px-8 md:px-12 py-4 bg-gradient-to-r from-ant-primary to-blue-600 text-white rounded-xl font-bold text-base md:text-lg glass-vibrant shadow-2xl shadow-blue-500/20 hover:scale-105 hover:from-blue-700 hover:to-blue-800 transition-all duration-300 active:scale-95 relative z-10"
           aria-label="Mulai booking hotel sekarang">
            Mulai Booking Sekarang
        </a>

        {{-- Scroll Indicator --}}
        <div class="mt-16 animate-bounce">
            <a href="#fitur" aria-label="Scroll ke fitur">
                <span class="material-symbols-outlined text-white text-[24px]">keyboard_arrow_down</span>
            </a>
        </div>
    </div>
</section>

{{-- FITUR SECTION --}}
<section id="fitur" class="max-w-7xl mx-auto px-6 py-24">
    <div class="text-center mb-20" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-extrabold text-blue-900">
            Keunggulan Blue Haven Hotel
        </h2>
        <p class="mt-4 text-lg text-gray-700 max-w-2xl mx-auto">
            Kami menawarkan pengalaman menginap terbaik dengan fasilitas modern dan pelayanan premium
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        {{-- Card 1 --}}
        <article class="p-10 glass shadow-xl group" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-container">
                <span class="material-symbols-outlined text-white text-[32px]">auto_awesome</span>
            </div>
            <h3 class="text-2xl font-bold text-blue-900 mb-3">Kenyamanan Premium</h3>
            <p class="text-gray-700 leading-relaxed">
                Lingkungan hotel modern dan elegan dengan fasilitas bintang 5 yang dirancang untuk kenyamanan maksimal Anda.
            </p>
        </article>

        {{-- Card 2 --}}
        <article class="p-10 glass shadow-xl group" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-container">
                <span class="material-symbols-outlined text-white text-[32px]">lock</span>
            </div>
            <h3 class="text-2xl font-bold text-blue-900 mb-3">Keamanan Tinggi</h3>
            <p class="text-gray-700 leading-relaxed">
                Sistem keamanan 24/7 dengan teknologi smart lock dan surveillance modern untuk melindungi privasi Anda.
            </p>
        </article>

        {{-- Card 3 --}}
        <article class="p-10 glass shadow-xl group" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-container">
                <span class="material-symbols-outlined text-white text-[32px]">lightbulb</span>
            </div>
            <h3 class="text-2xl font-bold text-blue-900 mb-3">Desain Futuristik</h3>
            <p class="text-gray-700 leading-relaxed">
                Interior modern bernuansa blue-glass dengan teknologi smart room yang dapat dikontrol melalui smartphone.
            </p>
        </article>
    </div>
</section>

{{-- STATS SECTION --}}
<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="glass p-12 rounded-3xl" data-aos="zoom-in">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-4xl font-black text-blue-700">500+</div>
                <div class="text-gray-700 mt-2">Tamu Puas</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="text-4xl font-black text-blue-700">50+</div>
                <div class="text-gray-700 mt-2">Kamar Premium</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl font-black text-blue-700">24/7</div>
                <div class="text-gray-700 mt-2">Layanan</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="400">
                <div class="text-4xl font-black text-blue-700 flex items-center justify-center gap-1">
                    4.9
                    <span class="material-symbols-outlined text-yellow-500 text-[32px] font-black">grade</span>
                </div>
                <div class="text-gray-700 mt-2">Rating</div>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section id="cta" class="w-full py-20 bg-gradient-to-r from-blue-700 to-blue-900 text-white text-center rounded-t-3xl" data-aos="fade-up">
    <h2 class="text-4xl md:text-5xl font-extrabold">Siap Menginap dengan Nyaman?</h2>
    <p class="mt-4 text-xl text-blue-100 max-w-2xl mx-auto">
        Booking cepat dan aman dengan sistem reservasi online yang mudah digunakan
    </p>

    <a href="{{ route('register') }}"
       class="pulse-btn mt-8 inline-block px-10 md:px-14 py-4 bg-gradient-to-r from-cyan-400 to-blue-500 text-white font-bold text-lg md:text-xl rounded-xl glass-vibrant border-white/40 hover:scale-110 active:scale-95 transition-all shadow-xl shadow-cyan-500/20"
       aria-label="Daftar untuk membuat reservasi">
        Daftar Sekarang
    </a>

    <p class="mt-6 text-sm text-blue-200">
        Sudah punya akun? <a href="{{ route('login') }}" class="underline hover:text-white">Login di sini</a>
    </p>
</section>

{{-- FOOTER --}}
<footer class="bg-gradient-to-b from-blue-900 to-indigo-950 text-blue-100" role="contentinfo">

    <div class="max-w-7xl mx-auto px-8 pt-24 pb-16 grid grid-cols-1 md:grid-cols-4 gap-14">

        <div data-aos="fade-right" data-aos-delay="100">
            <h2 class="text-3xl font-extrabold text-cyan-300 mb-4">Blue Haven Hotel</h2>
            <p class="mt-5 text-sm leading-relaxed">
                Hotel futuristik dengan kenyamanan premium dan layanan profesional yang siap melayani Anda 24/7.
            </p>
            <div class="flex gap-4 mt-6">
                <a href="#" aria-label="Facebook" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition text-sm font-bold">
                    f
                </a>
                <a href="#" aria-label="Instagram" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                    <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                </a>
                <a href="#" aria-label="Twitter" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition text-sm font-bold">
                    X
                </a>
            </div>
        </div>

        <div data-aos="fade-right" data-aos-delay="200">
            <h3 class="text-lg font-semibold mb-4 text-cyan-300">Navigasi</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="/">Beranda</a></li>
                <li><a href="#fitur">Fitur</a></li>
                <li><a href="#cta">Reservasi</a></li>
            </ul>
        </div>

        <div data-aos="fade-right" data-aos-delay="300">
            <h3 class="text-lg font-semibold mb-4 text-cyan-300">Layanan</h3>
            <ul class="space-y-2 text-sm">
                <li>Kamar Premium</li>
                <li>Keamanan 24/7</li>
                <li>Teknologi Pintar</li>
                <li>Layanan Kamar</li>
                <li>Resepsionis</li>
            </ul>
        </div>

        <div data-aos="fade-right" data-aos-delay="400">
            <h3 class="text-lg font-semibold mb-4 text-cyan-300">Kontak</h3>
            <p class="text-sm leading-relaxed">
                <strong>Alamat:</strong><br>
                Jl. Sudirman No. 123<br>
                Jakarta Pusat, 10220<br>
                Indonesia
            </p>
            <p class="text-sm mt-4">
                <strong>Email:</strong><br>
                support@bluehavenhotel.com
            </p>
            <p class="text-sm mt-4">
                <strong>Phone:</strong><br>
                +62 21 1234 5678
            </p>
        </div>
    </div>

    {{-- Copyright and Legal Links --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-8 py-6 flex flex-col md:flex-row justify-between items-center text-sm">
            <span>© {{ date('Y') }} Blue Haven Hotel. Hak cipta dilindungi undang-undang.</span>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-cyan-300">Kebijakan Privasi</a>
                <span>•</span>
                <a href="#" class="hover:text-cyan-300">Syarat & Ketentuan</a>
                <span>•</span>
                <a href="#" class="hover:text-cyan-300">Pusat Bantuan</a>
            </div>
        </div>
    </div>

</footer>

@endsection