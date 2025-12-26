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
        <h1 class="text-5xl md:text-7xl font-black bg-gradient-to-r from-blue-300 to-cyan-200 bg-clip-text text-transparent leading-tight">
            Blue Haven Hotel
        </h1>
        <p class="text-2xl md:text-4xl font-bold text-white mt-4">
            Modern • Premium • Futuristik
        </p>

        <p class="mt-6 text-lg md:text-2xl max-w-3xl mx-auto text-blue-100">
            Rasakan pengalaman menginap modern dengan kenyamanan maksimal dan desain futuristik yang memukau.
        </p>

        <a href="{{ route('login') }}"
           class="btn-primary mt-10 inline-block px-12 py-4 bg-blue-600 text-white rounded-2xl font-bold text-lg shadow-xl relative z-10"
           aria-label="Mulai booking hotel sekarang">
            Mulai Booking Sekarang
        </a>

        {{-- Scroll Indicator --}}
        <div class="mt-16 animate-bounce">
            <a href="#fitur" aria-label="Scroll ke fitur">
                <svg class="w-6 h-6 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
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
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-blue-900 mb-3">Kenyamanan Premium</h3>
            <p class="text-gray-700 leading-relaxed">
                Lingkungan hotel modern dan elegan dengan fasilitas bintang 5 yang dirancang untuk kenyamanan maksimal Anda.
            </p>
        </article>

        {{-- Card 2 --}}
        <article class="p-10 glass shadow-xl group" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-container">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-blue-900 mb-3">Keamanan Tinggi</h3>
            <p class="text-gray-700 leading-relaxed">
                Sistem keamanan 24/7 dengan teknologi smart lock dan surveillance modern untuk melindungi privasi Anda.
            </p>
        </article>

        {{-- Card 3 --}}
        <article class="p-10 glass shadow-xl group" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-container">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-blue-900 mb-3">Desain Futuristik</h3>
            <p class="text-gray-700 leading-relaxed">
                Interior modern bernuansa blue-glass dengan teknologi smart room yang dapat dikontrol melalui smartphone.
            </p>
        </article>
    </div>
</section>

{{-- STATS SECTION --}}
<section class="max-w-7xl mx-auto px-6 py-20">
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
                <div class="text-4xl font-black text-blue-700">4.9★</div>
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
       class="pulse-btn mt-8 inline-block px-14 py-4 bg-white text-blue-800 font-bold text-xl rounded-3xl hover:scale-110 transition shadow-2xl"
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
                <a href="#" aria-label="Facebook" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" aria-label="Instagram" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" aria-label="Twitter" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
            </div>
        </div>

        <div data-aos="fade-right" data-aos-delay="200">
            <h3 class="text-lg font-semibold mb-4 text-cyan-300">Navigasi</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="/">Home</a></li>
                <li><a href="#fitur">Features</a></li>
                <li><a href="#cta">Reservation</a></li>
            </ul>
        </div>

        <div data-aos="fade-right" data-aos-delay="300">
            <h3 class="text-lg font-semibold mb-4 text-cyan-300">Layanan</h3>
            <ul class="space-y-2 text-sm">
                <li>Premium Room</li>
                <li>24/7 Security</li>
                <li>Smart Technology</li>
                <li>Room Service</li>
                <li>Concierge</li>
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

    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-8 py-6 flex flex-col md:flex-row justify-between items-center text-sm">
            <span>© {{ date('Y') }} Blue Haven Hotel. All rights reserved.</span>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-cyan-300">Privacy Policy</a>
                <span>•</span>
                <a href="#" class="hover:text-cyan-300">Terms of Service</a>
                <span>•</span>
                <a href="#" class="hover:text-cyan-300">Help Center</a>
            </div>
        </div>
    </div>

</footer>

@endsection
