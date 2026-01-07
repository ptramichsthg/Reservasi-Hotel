<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil admin.
     */
    public function edit()
    {
        return view('admin.profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Memperbarui profil admin.
     */
    public function update(Request $request)
    {
        $admin = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $admin->id_user . ',id_user'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        // Update name and email
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        // Update password if provided
        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.profile.edit')
                         ->with('success', 'Profile berhasil diperbarui!');
    }
}
