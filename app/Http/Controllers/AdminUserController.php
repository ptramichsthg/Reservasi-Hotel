<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        // 🔐 Hanya admin yang boleh akses
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * ============================
     * 📋 Daftar semua admin
     * ============================
     */
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('admins'));
    }

    /**
     * ============================
     * ➕ Form tambah admin
     * ============================
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * ============================
     * 💾 Simpan admin baru
     * ============================
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin', // selalu admin
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin baru berhasil ditambahkan.');
    }

    /**
     * ============================
     * 🗑️ Hapus admin
     * ============================
     */
    public function destroy(int $id): RedirectResponse
    {
        $admin = User::where('role', 'admin')
            ->where('id_user', $id)
            ->firstOrFail();

        // ❗ Cegah hapus akun sendiri
        if ($admin->id_user === Auth::user()->id_user) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun admin yang sedang digunakan.');
        }

        $admin->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin berhasil dihapus.');
    }
}
