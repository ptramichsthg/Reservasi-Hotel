<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Halaman Upload Bukti Pembayaran (Tamu)
     */
    public function create($reservasi_id)
    {
        return view('payment.upload', compact('reservasi_id'));
    }

    /**
     * Proses Upload Bukti Pembayaran oleh Tamu
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservasi_id'  => 'required',
            'bukti'         => 'required|file|mimes:jpg,jpeg,png|max:5120', // <= UBAH INI
        ]);

        // Upload file
        $file = $request->file('bukti'); // <= UBAH INI
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti'), $namaFile);

        // Simpan ke database
        Payment::create([
            'reservasi_id'      => $request->reservasi_id,
            'bukti_pembayaran'  => $namaFile,
            'status'            => 'pending',
            'tanggal_upload'    => now(),
        ]);

        return redirect()->route('tamu.dashboard')->with(
            'success',
            'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.'
        );
    }
}
