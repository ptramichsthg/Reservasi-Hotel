<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class TamuProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil tamu.
     */
    public function edit()
    {
        return view('tamu.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Memperbarui profil tamu.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id_user . ',id_user'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        // Update name and email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password if provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('tamu.profile.edit')
                         ->with('success', 'Profil Anda berhasil diperbarui!');
    }
}
