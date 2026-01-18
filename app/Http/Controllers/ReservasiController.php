<?php

namespace App\Http\Controllers;

use App\Models\Kamars;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NotifikasiController;

class ReservasiController extends Controller
{
    // =====================================================
    // 1. HALAMAN FORM ORDER KAMAR
    // =====================================================
    public function orderPage($id_kamar)
    {
        $kamar = Kamars::findOrFail($id_kamar);

        // Tidak bisa pesan jika bukan available
        if ($kamar->status !== 'available') {
            return redirect()->back()
                ->with('error', 'Kamar ini tidak tersedia untuk dipesan.');
        }

        return view('tamu.order', compact('kamar'));
    }


    // =====================================================
    // 2. SIMPAN RESERVASI (FIXED - NO RACE CONDITION)
    // =====================================================
    public function store(Request $request)
    {
        // ===============================
        // VALIDASI INPUT
        // ===============================
        $request->validate([
            'id_kamar'     => 'required|exists:kamars,id_kamar',
            'tgl_checkin'  => 'required|date|after_or_equal:today',
            'jam_checkin'  => 'required|date_format:H:i',
            'tgl_checkout' => 'required|date|after:tgl_checkin',
            'jam_checkout' => 'required|date_format:H:i',
            'jumlah_tamu'  => 'required|integer|min:1',
        ]);

        try {
            // ===============================
            // DATABASE TRANSACTION + LOCK
            // Mencegah race condition / double booking
            // ===============================
            return DB::transaction(function () use ($request) {
                
                // Lock row kamar untuk mencegah concurrent booking
                $kamar = Kamars::lockForUpdate()->findOrFail($request->id_kamar);

                // ===============================
                // VALIDASI KAPASITAS
                // ===============================
                if ($request->jumlah_tamu > $kamar->kapasitas) {
                    throw new \Exception('Jumlah tamu melebihi kapasitas kamar.');
                }

                // ===============================
                // VALIDASI STATUS KAMAR
                // ===============================
                if ($kamar->status !== 'available') {
                    throw new \Exception('Kamar tidak tersedia untuk dipesan.');
                }

                // ===============================
                // CEK BENTROK TANGGAL (WITH LOCK)
                // ===============================
                $bentrok = Reservasi::where('id_kamar', $request->id_kamar)
                    ->where('status_reservasi', '!=', 'cancelled')
                    ->lockForUpdate() // Lock untuk mencegah race condition
                    ->where(function ($query) use ($request) {
                        $query->where('tgl_checkin', '<', $request->tgl_checkout)
                              ->where('tgl_checkout', '>', $request->tgl_checkin);
                    })
                    ->exists();

                if ($bentrok) {
                    throw new \Exception('Tanggal tersebut sudah dipesan oleh tamu lain.');
                }

                // ===============================
                // SIMPAN RESERVASI (dengan jam)
                // ===============================
                $reservasi = Reservasi::create([
                    'id_user'           => Auth::id(),
                    'id_kamar'          => $request->id_kamar,
                    'tgl_checkin'       => $request->tgl_checkin,
                    'jam_checkin'       => $request->jam_checkin,
                    'tgl_checkout'      => $request->tgl_checkout,
                    'jam_checkout'      => $request->jam_checkout,
                    'jumlah_tamu'       => $request->jumlah_tamu,
                    'status_pembayaran' => 'pending',
                    'status_reservasi'  => 'pending',
                ]);

                // ===============================
                // KIRIM NOTIFIKASI KE TAMU
                // ===============================
                NotifikasiController::send(
                    Auth::id(),
                    'Reservasi Berhasil Dibuat',
                    'Reservasi Anda untuk kamar ' . $kamar->tipe_kamar . ' berhasil dibuat. Silakan lakukan pembayaran.'
                );

                // ===============================
                // KIRIM NOTIFIKASI KE SEMUA ADMIN
                // ===============================
                $admins = \App\Models\User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    NotifikasiController::send(
                        $admin->id_user,
                        '🔔 Reservasi Baru Masuk',
                        'Reservasi baru dari ' . Auth::user()->name . ' untuk kamar ' . $kamar->tipe_kamar . '. Check-in: ' . date('d M Y', strtotime($request->tgl_checkin))
                    );
                }

                // ===============================
                // REDIRECT BERHASIL
                // ===============================
                return redirect()->route('tamu.orders.history')
                    ->with('success', 'Reservasi berhasil dibuat! Silakan lanjutkan pembayaran.');
            });

        } catch (\Exception $e) {
            // Handle error dari transaction
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }


    // =====================================================
    // 3. RIWAYAT RESERVASI TAMU (FIXED - WITH PAGINATION)
    // =====================================================
    public function riwayat()
    {
        $pemesanan = Reservasi::with('kamar')
            ->where('id_user', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(20); // Add pagination untuk performance

        return view('tamu.riwayat', compact('pemesanan'));
    }
}
