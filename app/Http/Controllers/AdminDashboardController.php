<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kamars;
use App\Models\Reservasi;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalTamu      = User::where('role', 'tamu')->count();
        $totalKamar     = Kamars::count();
        $kamarTersedia  = Kamars::where('status', 'available')->count();

        $totalReservasi = Reservasi::count();
        $pending        = Reservasi::where('status_pembayaran', 'pending')->count();
        $paid           = Reservasi::where('status_pembayaran', 'paid')->count();
        $cancelled      = Reservasi::where('status_pembayaran', 'cancelled')->count();

        // Grafik — reservasi 7 hari terakhir
        $recentChart = Reservasi::selectRaw("DATE(created_at) AS tgl, COUNT(*) AS total")
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->get();

        $chartTanggal = $recentChart->pluck('tgl')->map(function ($d) {
            return date('d M', strtotime($d));
        });

        $chartTotal   = $recentChart->pluck('total');

        // Grafik — status kamar
        $chartKamar = Kamars::selectRaw("status, COUNT(*) AS total")
            ->groupBy('status')
            ->pluck('total', 'status');

        // Tabel reservasi terbaru
        $recentReservasi = Reservasi::with('user', 'kamar')
            ->latest()
            ->take(6)
            ->get();

        // Tabel pembayaran terbaru
        $recentPayments = Payment::with('reservasi')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalTamu', 'totalKamar', 'kamarTersedia',
            'totalReservasi', 'pending', 'paid', 'cancelled',
            'chartTanggal', 'chartTotal', 'chartKamar',
            'recentReservasi', 'recentPayments'
        ));
    }

    /**
     * Halaman Edit Profile Admin
     */
    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update Profile Admin
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $admin->id_user . ',id_user',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        // Update password jika diisi
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profile berhasil diperbarui!');
    }
}
