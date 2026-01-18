<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Controllers\NotifikasiController;

class PaymentController extends Controller
{
    /**
     * Halaman Upload Bukti Pembayaran (Tamu)
     */
    public function create($reservasi_id)
    {
        // Validasi ownership - hanya bisa upload untuk reservasi sendiri
        $reservasi = Reservasi::where('id_reservasi', $reservasi_id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // Cek apakah sudah ada payment
        if ($reservasi->pembayaran()->exists()) {
            return redirect()->route('tamu.dashboard')
                ->with('error', 'Pembayaran untuk reservasi ini sudah pernah diupload.');
        }

        return view('payment.upload', compact('reservasi_id'));
    }

    /**
     * Proses Upload Bukti Pembayaran oleh Tamu (FIXED - SECURE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservasi_id'  => 'required|exists:reservasis,id_reservasi',
            'bukti'         => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // 5MB max
        ]);

        // ===============================
        // VALIDASI OWNERSHIP
        // ===============================
        $reservasi = Reservasi::where('id_reservasi', $request->reservasi_id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // ===============================
        // CEK DUPLIKASI PAYMENT
        // ===============================
        if ($reservasi->pembayaran()->exists()) {
            return redirect()->back()
                ->with('error', 'Pembayaran untuk reservasi ini sudah pernah diupload.');
        }

        // ===============================
        // UPLOAD FILE (SECURE)
        // ===============================
        $file = $request->file('bukti');

        // Validasi MIME type dari content (double check)
        $mimeType = $file->getMimeType();
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($mimeType, $allowedMimes)) {
            return redirect()->back()
                ->with('error', 'Tipe file tidak valid. Hanya JPG, PNG, dan WEBP yang diperbolehkan.');
        }

        // Generate nama file yang aman (prevent collision & spaces)
        $extension = $file->extension();
        $safeOriginalName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $namaFile = time() . '_' . $safeOriginalName . '.' . $extension;

        // Pindahkan file dengan Storage Disk (lebih aman)
        try {
            $file->storeAs('uploads/bukti', $namaFile, 'public');
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal mengupload file. Silakan coba lagi.');
        }

        // ===============================
        // SIMPAN KE DATABASE
        // ===============================
        Payment::create([
            'reservasi_id'      => $request->reservasi_id,
            'bukti_pembayaran'  => $namaFile,
            'status'            => 'pending',
            'tanggal_upload'    => now(),
        ]);

        // ===============================
        // KIRIM NOTIFIKASI KE SEMUA ADMIN
        // ===============================
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            NotifikasiController::send(
                $admin->id_user,
                '💳 Pembayaran Baru Perlu Verifikasi',
                'Bukti pembayaran baru dari ' . Auth::user()->name . ' untuk reservasi #' . $request->reservasi_id . '. Silakan verifikasi segera.'
            );
        }

        return redirect()->route('tamu.dashboard')->with(
            'success',
            'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.'
        );
    }
}
