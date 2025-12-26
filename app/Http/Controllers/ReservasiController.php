<?php

namespace App\Http\Controllers;

use App\Models\Kamars;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotifikasiController;

class ReservasiController extends Controller
{
    // =====================================================
    // 🟢 1. HALAMAN FORM ORDER KAMAR
    // =====================================================
    public function orderPage($id_kamar)
    {
        $kamar = Kamars::findOrFail($id_kamar);

        // ❌ Tidak bisa pesan jika bukan available
        if ($kamar->status !== 'available') {
            return redirect()->back()
                ->with('error', 'Kamar ini tidak tersedia untuk dipesan.');
        }

        return view('tamu.order', compact('kamar'));
    }


    // =====================================================
    // 🟢 2. SIMPAN RESERVASI (FINAL & FIXED)
    // =====================================================
    public function store(Request $request)
    {
        // ===============================
        // VALIDASI INPUT
        // ===============================
        $request->validate([
            'id_kamar'     => 'required|exists:kamars,id_kamar',
            'tgl_checkin'  => 'required|date|after_or_equal:today',
            'tgl_checkout' => 'required|date|after:tgl_checkin',
            'jumlah_tamu'  => 'required|integer|min:1',
        ]);

        $kamar = Kamars::findOrFail($request->id_kamar);

        // ===============================
        // VALIDASI KAPASITAS
        // ===============================
        if ($request->jumlah_tamu > $kamar->kapasitas) {
            return redirect()->back()
                ->with('error', 'Jumlah tamu melebihi kapasitas kamar.');
        }

        // ===============================
        // VALIDASI STATUS KAMAR
        // ===============================
        if ($kamar->status !== 'available') {
            return redirect()->back()
                ->with('error', 'Kamar tidak tersedia untuk dipesan.');
        }

        // ===============================
        // CEK BENTROK TANGGAL
        // ===============================
        // Logika: Overlap terjadi jika:
        // (checkin_baru < checkout_lama) AND (checkout_baru > checkin_lama)
        $bentrok = Reservasi::where('id_kamar', $request->id_kamar)
            ->where('status_reservasi', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->where('tgl_checkin', '<', $request->tgl_checkout)
                      ->where('tgl_checkout', '>', $request->tgl_checkin);
            })
            ->exists();

        if ($bentrok) {
            return redirect()->back()
                ->with('error', '⚠ Tanggal tersebut sudah dipesan oleh tamu lain.');
        }

        // ===============================
        // SIMPAN RESERVASI
        // ===============================
        Reservasi::create([
            'id_user'           => Auth::id(),
            'id_kamar'          => $request->id_kamar,
            'tgl_checkin'       => $request->tgl_checkin,
            'tgl_checkout'      => $request->tgl_checkout,
            'jumlah_tamu'       => $request->jumlah_tamu,
            'status_pembayaran' => 'pending',
            'status_reservasi'  => 'pending',
        ]);

        // ===============================
        // KIRIM NOTIFIKASI
        // ===============================
        NotifikasiController::send(
            Auth::id(),
            '🎉 Reservasi Berhasil Dibuat',
            'Reservasi Anda untuk kamar ' . $kamar->tipe_kamar . ' berhasil dibuat. Silakan lakukan pembayaran.'
        );

        // ===============================
        // REDIRECT BERHASIL
        // ===============================
        return redirect()->route('tamu.orders.history')
            ->with('success', 'Reservasi berhasil dibuat! Silakan lanjutkan pembayaran.');
    }


    // =====================================================
    // 🟢 3. RIWAYAT RESERVASI TAMU
    // =====================================================
    public function riwayat()
    {
        $pemesanan = Reservasi::with('kamar')
            ->where('id_user', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('tamu.riwayat', compact('pemesanan'));
    }
}
