<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // 🟦 Show register page
    public function registerView() {
        return view('auth.register');
    }

    // 🟩 Process register
    public function register(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        // Buat user baru
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'tamu', // default role tamu
        ]);

        // ❌ HAPUS login otomatis
        // Auth::login($user);

        // Redirect ke login agar user login sendiri
        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }

    // 🟦 Show login page
    public function loginView() {
        return view('auth.login');
    }

    // 🟥 Process login
    public function login(Request $request) {

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // 🟢 Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            if (Auth::user()->role === 'tamu') {
                return redirect('/tamu/dashboard');
            }

            // 🛑 Jika role tidak valid → logout
            Auth::logout();
            return redirect('/login')->with('error', 'Role akun tidak valid!');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    // 🔵 Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
