<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function __construct()
    {
        // Hanya admin yang boleh akses
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * ============================
     * Daftar semua user (Admin & Tamu)
     * ============================
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role jika ada
        if ($request->has('role') && in_array($request->role, ['admin', 'tamu'])) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * ============================
     * Form tambah user baru
     * ============================
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * ============================
     * Simpan user baru
     * ============================
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
            'role'     => 'required|in:admin,tamu',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User ' . ucfirst($request->role) . ' berhasil ditambahkan.');
    }

    /**
     * ============================
     * Form edit user
     * ============================
     */
    public function edit(int $id)
    {
        $user = User::where('id_user', $id)->firstOrFail();
        return view('admin.users.edit', compact('user'));
    }

    /**
     * ============================
     * Update data user
     * ============================
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::where('id_user', $id)->firstOrFail();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id_user, 'id_user')],
            'role'     => 'required|in:admin,tamu',
            'password' => 'nullable|min:5|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun ' . $user->name . ' berhasil diperbarui.');
    }

    /**
     * ============================
     * Hapus user
     * ============================
     */
    public function destroy(int $id): RedirectResponse
    {
        $user = User::where('id_user', $id)->firstOrFail();

        // Cegah hapus akun sendiri jika dia admin
        if ($user->id_user === Auth::user()->id_user) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $role = $user->role;
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun ' . ucfirst($role) . ' berhasil dihapus.');
    }
}
