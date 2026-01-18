@extends('layouts.welcome')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
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

    /* Colorful floating blobs */
    .blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.6;
        animation: blobFloat 15s infinite ease-in-out;
        pointer-events: none;
    }

    .blob-1 {
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, #60a5fa, #a78bfa);
        top: -100px;
        left: -100px;
    }

    .blob-2 {
        width: 350px;
        height: 350px;
        background: linear-gradient(135deg, #34d399, #22d3ee);
        bottom: -80px;
        right: -80px;
        animation-delay: -5s;
    }

    .blob-3 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #f472b6, #fb923c);
        top: 50%;
        left: 60%;
        animation-delay: -10s;
    }

    @keyframes blobFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -40px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    /* Glass card - bright theme */
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.15);
    }

    /* Fade animations */
    .fade-up {
        animation: fadeUp 0.8s ease-out forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }

    /* Button gradient */
    .btn-gradient {
        background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-gradient:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.5);
    }

    .btn-gradient-purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-gradient-purple:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 20px 40px -10px rgba(139, 92, 246, 0.5);
    }

    /* Icon box with gradient */
    .icon-box {
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .glass-card:hover .icon-box {
        transform: rotate(10deg) scale(1.1);
    }

    /* Pulse animation */
    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
        50% { box-shadow: 0 0 0 20px rgba(59, 130, 246, 0); }
    }

    .pulse-ring {
        animation: pulse 2s infinite;
    }

    /* Link hover effect */
    .link-hover {
        position: relative;
    }

    .link-hover::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background: linear-gradient(90deg, #3b82f6, #06b6d4);
        transition: width 0.3s ease;
    }

    .link-hover:hover::after {
        width: 100%;
    }
</style>

{{-- HERO SECTION --}}
<section class="relative w-full min-h-screen flex items-center justify-center overflow-hidden gradient-bright" role="banner">

    {{-- Colorful Blobs --}}
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    {{-- Hero Content --}}
    <div class="relative z-10 text-center px-6 py-20">
        
        {{-- Logo --}}
        <div class="fade-up mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-3xl shadow-2xl shadow-blue-500/40">
                <x-heroicon-o-building-office class="w-12 h-12 text-white" />
            </div>
        </div>

        {{-- Title --}}
        <h1 class="fade-up delay-1 text-5xl md:text-7xl font-black leading-tight">
            <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-500 bg-clip-text text-transparent">
                Blue Haven Hotel
            </span>
        </h1>

        {{-- Tagline --}}
        <p class="fade-up delay-2 text-xl md:text-3xl font-semibold text-gray-700 mt-6 flex items-center justify-center gap-4 flex-wrap">
            <span class="text-blue-600">Modern</span>
            <span class="w-2 h-2 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-full"></span>
            <span class="text-purple-600">Premium</span>
            <span class="w-2 h-2 bg-gradient-to-r from-purple-500 to-pink-400 rounded-full"></span>
            <span class="text-pink-600">Futuristik</span>
        </p>

        {{-- Description --}}
        <p class="fade-up delay-3 mt-8 text-lg md:text-xl max-w-3xl mx-auto text-gray-600 leading-relaxed">
            Rasakan pengalaman menginap modern dengan kenyamanan maksimal dan desain futuristik yang memukau
        </p>

        {{-- CTA Buttons --}}
        <div class="fade-up delay-4 mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('login') }}"
               class="btn-gradient pulse-ring px-10 py-4 rounded-2xl text-white font-bold text-lg shadow-xl inline-flex items-center gap-3">
                <x-heroicon-o-arrow-left-on-rectangle class="w-6 h-6" />
                Mulai Booking
            </a>
            <a href="{{ route('register') }}"
               class="btn-gradient-purple px-10 py-4 rounded-2xl text-white font-bold text-lg shadow-xl inline-flex items-center gap-3">
                <x-heroicon-o-user-plus class="w-6 h-6" />
                Daftar Gratis
            </a>
        </div>

        {{-- Scroll Indicator --}}
        <div class="fade-up delay-5 mt-16">
            <a href="#fitur" class="inline-flex flex-col items-center text-gray-500 hover:text-blue-600 transition-colors">
                <span class="text-sm font-medium mb-2">Scroll</span>
                <x-heroicon-o-chevron-down class="w-8 h-8 animate-bounce" />
            </a>
        </div>
    </div>
</section>

{{-- FITUR SECTION --}}
<section id="fitur" class="relative py-24 bg-white overflow-hidden">
    {{-- Decorative elements --}}
    <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-blue-50/50 to-transparent"></div>
    <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-purple-100 rounded-full blur-3xl opacity-50"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        {{-- Section Header --}}
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-gradient-to-r from-blue-100 to-cyan-100 rounded-full text-blue-600 text-sm font-semibold mb-4">
                KEUNGGULAN KAMI
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900">
                Mengapa Memilih <span class="text-blue-600">Blue Haven</span>?
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Kami menawarkan pengalaman menginap terbaik dengan fasilitas modern dan pelayanan premium
            </p>
        </div>

        {{-- Feature Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Card 1 --}}
            <article class="glass-card p-8 border-t-4 border-blue-500" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box mb-6 bg-gradient-to-br from-blue-500 to-cyan-400 shadow-lg shadow-blue-500/30">
                    <x-heroicon-o-sparkles class="w-8 h-8 text-white" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Kenyamanan Premium</h3>
                <p class="text-gray-600 leading-relaxed">
                    Lingkungan hotel modern dan elegan dengan fasilitas bintang 5 yang dirancang untuk kenyamanan maksimal Anda.
                </p>
            </article>

            {{-- Card 2 --}}
            <article class="glass-card p-8 border-t-4 border-purple-500" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box mb-6 bg-gradient-to-br from-purple-500 to-pink-400 shadow-lg shadow-purple-500/30">
                    <x-heroicon-o-shield-check class="w-8 h-8 text-white" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Keamanan Tinggi</h3>
                <p class="text-gray-600 leading-relaxed">
                    Sistem keamanan 24/7 dengan teknologi smart lock dan surveillance modern untuk melindungi privasi Anda.
                </p>
            </article>

            {{-- Card 3 --}}
            <article class="glass-card p-8 border-t-4 border-emerald-500" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box mb-6 bg-gradient-to-br from-emerald-500 to-teal-400 shadow-lg shadow-emerald-500/30">
                    <x-heroicon-o-cpu-chip class="w-8 h-8 text-white" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Teknologi Smart</h3>
                <p class="text-gray-600 leading-relaxed">
                    Interior modern dengan teknologi smart room yang dapat dikontrol melalui smartphone Anda.
                </p>
            </article>
        </div>
    </div>
</section>

{{-- STATS SECTION --}}
<section class="relative py-20 gradient-bright overflow-hidden">
    {{-- Blobs --}}
    <div class="absolute w-80 h-80 bg-cyan-200/50 rounded-full blur-[80px] top-0 left-1/4"></div>
    <div class="absolute w-80 h-80 bg-purple-200/50 rounded-full blur-[80px] bottom-0 right-1/4"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6">
        <div class="glass-card p-12" data-aos="zoom-in">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="text-5xl font-black bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">500+</div>
                    <div class="text-gray-600 mt-2 font-medium">Tamu Puas</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="text-5xl font-black bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">50+</div>
                    <div class="text-gray-600 mt-2 font-medium">Kamar Premium</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="text-5xl font-black bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent">24/7</div>
                    <div class="text-gray-600 mt-2 font-medium">Layanan</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <div class="text-5xl font-black bg-gradient-to-r from-amber-500 to-orange-500 bg-clip-text text-transparent flex items-center justify-center gap-2">
                        4.9
                        <x-heroicon-s-star class="w-10 h-10 text-yellow-500" />
                    </div>
                    <div class="text-gray-600 mt-2 font-medium">Rating</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section id="cta" class="relative py-24 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-500 overflow-hidden">
    {{-- Decorative circles --}}
    <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl top-0 right-0"></div>
    <div class="absolute w-96 h-96 bg-white/10 rounded-full blur-3xl bottom-0 left-0"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center" data-aos="fade-up">
        <span class="inline-block px-4 py-2 bg-white/20 rounded-full text-white text-sm font-semibold mb-6">
            SIAP MENGINAP?
        </span>
        
        <h2 class="text-4xl md:text-6xl font-bold text-white leading-tight">
            Mulai Pengalaman<br>
            <span class="text-cyan-200">Menginap Premium</span>
        </h2>
        
        <p class="mt-6 text-xl text-white/80 max-w-2xl mx-auto">
            Booking cepat dan aman dengan sistem reservasi online yang mudah digunakan. Daftar sekarang dan dapatkan penawaran spesial!
        </p>

        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('register') }}"
               class="px-12 py-5 rounded-2xl text-blue-600 font-bold text-xl bg-white hover:bg-gray-100 shadow-xl inline-flex items-center gap-3 transition-all hover:scale-105">
                <x-heroicon-o-rocket-launch class="w-6 h-6" />
                Daftar Sekarang
            </a>
        </div>

        <p class="mt-8 text-white/70">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="link-hover text-cyan-200 font-semibold">Login di sini</a>
        </p>
    </div>
</section>

{{-- CONTACT SECTION --}}
<section id="contact" class="relative py-24 bg-gradient-to-br from-slate-50 to-blue-50 overflow-hidden">
    {{-- Decorative elements --}}
    <div class="absolute -top-20 -left-20 w-64 h-64 bg-blue-200 rounded-full blur-3xl opacity-40"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-purple-200 rounded-full blur-3xl opacity-40"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        {{-- Section Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full text-blue-600 text-sm font-semibold mb-4">
                HUBUNGI KAMI
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900">
                Ada <span class="text-blue-600">Pertanyaan</span>?
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Tim kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami!
            </p>
        </div>

        {{-- Contact Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            {{-- Card: Location --}}
            <div class="glass-card p-8 text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box mx-auto mb-6 bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/30">
                    <x-heroicon-o-map-pin class="w-8 h-8 text-white" />
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Alamat</h3>
                <p class="text-gray-600">
                    Jl. Sudirman No. 123<br>
                    Jakarta Pusat, 10220<br>
                    Indonesia
                </p>
            </div>

            {{-- Card: Phone --}}
            <div class="glass-card p-8 text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box mx-auto mb-6 bg-gradient-to-br from-purple-500 to-pink-500 shadow-lg shadow-purple-500/30">
                    <x-heroicon-o-phone class="w-8 h-8 text-white" />
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Telepon</h3>
                <p class="text-gray-600">
                    +62 21 1234 5678<br>
                    +62 812 3456 7890<br>
                    (24/7 Available)
                </p>
            </div>

            {{-- Card: Email --}}
            <div class="glass-card p-8 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box mx-auto mb-6 bg-gradient-to-br from-cyan-500 to-emerald-500 shadow-lg shadow-cyan-500/30">
                    <x-heroicon-o-envelope class="w-8 h-8 text-white" />
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600">
                    info@bluehavenhotel.com<br>
                    support@bluehavenhotel.com<br>
                    reservation@bluehavenhotel.com
                </p>
            </div>
        </div>

        {{-- Map & Quick Contact --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8" data-aos="fade-up" data-aos-delay="400">
            {{-- Map Placeholder --}}
            <div class="glass-card overflow-hidden">
                <div class="bg-gradient-to-br from-blue-100 to-purple-100 h-80 flex items-center justify-center">
                    <div class="text-center">
                        <x-heroicon-o-map class="w-16 h-16 text-blue-500 mx-auto mb-4" />
                        <p class="text-gray-600 font-medium">Lokasi Blue Haven Hotel</p>
                        <p class="text-sm text-gray-500 mt-2">Jakarta Pusat, Indonesia</p>
                    </div>
                </div>
            </div>

            {{-- Quick Info --}}
            <div class="glass-card p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Jam Operasional</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="font-medium text-gray-700">Front Desk</span>
                        <span class="text-blue-600 font-semibold">24 Jam</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="font-medium text-gray-700">Restoran</span>
                        <span class="text-gray-600">06:00 - 22:00</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="font-medium text-gray-700">Gym & Spa</span>
                        <span class="text-gray-600">06:00 - 21:00</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-gray-100">
                        <span class="font-medium text-gray-700">Swimming Pool</span>
                        <span class="text-gray-600">07:00 - 20:00</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="font-medium text-gray-700">Check-in / Check-out</span>
                        <span class="text-gray-600">14:00 / 12:00</span>
                    </div>
                </div>

                <a href="{{ route('login') }}" 
                   class="mt-8 w-full btn-gradient py-4 rounded-xl text-white font-bold text-center inline-flex items-center justify-center gap-2 shadow-lg">
                    <x-heroicon-o-calendar-days class="w-5 h-5" />
                    Reservasi Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer class="relative bg-gray-900 text-gray-300 overflow-hidden">
    
    {{-- Top gradient line --}}
    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>

    <div class="max-w-7xl mx-auto px-8 pt-20 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

            {{-- Brand --}}
            <div data-aos="fade-right" data-aos-delay="100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-building-office class="w-6 h-6 text-white" />
                    </div>
                    <span class="text-2xl font-bold text-white">Blue Haven</span>
                </div>
                <p class="text-sm leading-relaxed text-gray-400">
                    Hotel futuristik dengan kenyamanan premium dan layanan profesional yang siap melayani Anda 24/7.
                </p>
                <div class="flex gap-3 mt-6">
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-xl flex items-center justify-center transition-colors">
                        <span class="text-sm font-bold">f</span>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-pink-600 rounded-xl flex items-center justify-center transition-colors">
                        <x-heroicon-o-camera class="w-5 h-5" />
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-sky-500 rounded-xl flex items-center justify-center transition-colors">
                        <span class="text-sm font-bold">X</span>
                    </a>
                </div>
            </div>

            {{-- Navigation --}}
            <div data-aos="fade-right" data-aos-delay="200">
                <h3 class="text-lg font-semibold text-white mb-4">Navigasi</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="/" class="hover:text-cyan-400 transition-colors">Beranda</a></li>
                    <li><a href="#fitur" class="hover:text-cyan-400 transition-colors">Fitur</a></li>
                    <li><a href="#cta" class="hover:text-cyan-400 transition-colors">Reservasi</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-cyan-400 transition-colors">Login</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div data-aos="fade-right" data-aos-delay="300">
                <h3 class="text-lg font-semibold text-white mb-4">Layanan</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li>Kamar Premium</li>
                    <li>Keamanan 24/7</li>
                    <li>Teknologi Pintar</li>
                    <li>Layanan Kamar</li>
                    <li>Resepsionis</li>
                </ul>
            </div>

            {{-- Contact --}}
            <div data-aos="fade-right" data-aos-delay="400">
                <h3 class="text-lg font-semibold text-white mb-4">Kontak</h3>
                <div class="space-y-4 text-sm">
                    <div class="flex items-start gap-3">
                        <x-heroicon-o-map-pin class="w-5 h-5 text-cyan-400 flex-shrink-0" />
                        <span class="text-gray-400">Jl. Sudirman No. 123<br>Jakarta Pusat, 10220</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <x-heroicon-o-envelope class="w-5 h-5 text-cyan-400 flex-shrink-0" />
                        <span class="text-gray-400">support@bluehavenhotel.com</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <x-heroicon-o-phone class="w-5 h-5 text-cyan-400 flex-shrink-0" />
                        <span class="text-gray-400">+62 21 1234 5678</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-8 py-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <span>&copy; {{ date('Y') }} Blue Haven Hotel. Hak cipta dilindungi undang-undang.</span>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-cyan-400 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">Pusat Bantuan</a>
            </div>
        </div>
    </div>
</footer>

@endsection