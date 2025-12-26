<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotifikasiController;

class AdminPaymentController extends Controller
{
    /**
     * Menampilkan daftar pembayaran
     */
    public function index()
    {
        $payments = Payment::with(['reservasi.user', 'reservasi.kamar'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pembayaran.index', compact('payments'));
    }

    /**
     * Verifikasi pembayaran (SETUJUI)
     */
    public function verify($id)
    {
        $payment = Payment::findOrFail($id);
        $reservasi = Reservasi::findOrFail($payment->reservasi_id);

        // ✅ UPDATE PAYMENT (PAKAI ENUM VALID)
        $payment->update([
            'status'             => 'confirmed',
            'admin_id'           => Auth::id(),
            'tanggal_verifikasi' => now(),
        ]);

        // ✅ UPDATE RESERVASI (ENUM VALID)
        $reservasi->update([
            'status_pembayaran' => 'confirmed',
            'status_reservasi'  => 'confirmed',
        ]);

        // KIRIM NOTIFIKASI
        NotifikasiController::send(
            $reservasi->id_user,
            '✅ Pembayaran Terverifikasi',
            'Pembayaran Anda untuk reservasi #' . $payment->reservasi_id . ' telah diverifikasi oleh admin.'
        );

        return redirect()
            ->route('admin.payment.index')
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    /**
     * Tolak pembayaran
     */
    public function reject($id)
    {
        $payment = Payment::findOrFail($id);
        $reservasi = Reservasi::findOrFail($payment->reservasi_id);

        $payment->update([
            'status'             => 'rejected',
            'admin_id'           => Auth::id(),
            'tanggal_verifikasi' => now(),
        ]);

        $reservasi->update([
            'status_pembayaran' => 'rejected',
            'status_reservasi'  => 'cancelled',
        ]);

        // KIRIM NOTIFIKASI
        NotifikasiController::send(
            $reservasi->id_user,
            '❌ Pembayaran Ditolak',
            'Pembayaran Anda untuk reservasi #' . $payment->reservasi_id . ' ditolak. Silakan upload ulang bukti pembayaran yang valid.'
        );

        return redirect()
            ->route('admin.payment.index')
            ->with('success', 'Pembayaran berhasil ditolak.');
    }
}
