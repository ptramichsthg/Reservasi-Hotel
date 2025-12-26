@extends('layouts.admin')

@section('content')

<div class="min-h-screen p-10 bg-gradient-to-br from-blue-50 via-white to-purple-100">

    <div class="max-w-xl mx-auto glass backdrop-blur-xl p-8 rounded-3xl shadow-2xl">

        <h1 class="text-3xl font-extrabold text-blue-900 mb-6 drop-shadow">
            + Tambah Admin Baru
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-800 font-semibold mb-1">Nama Admin</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-800 font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-800 font-semibold mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-800 font-semibold mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-3 rounded-xl border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('admin.users.index') }}"
                   class="text-gray-600 hover:text-gray-800">
                    ← Kembali
                </a>

                <button type="submit"
                        class="px-5 py-3 bg-blue-600 text-white rounded-xl font-semibold
                               shadow hover:bg-blue-700 hover:-translate-y-0.5 transition-all">
                    Simpan Admin
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
