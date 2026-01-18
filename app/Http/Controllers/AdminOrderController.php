<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Menampilkan semua data pemesanan
     */
    public function index()
    {
        $orders = Reservasi::with(['kamar', 'user'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail pemesanan
     */
    public function show($id)
    {
        $order = Reservasi::with(['kamar', 'user'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * UPDATE STATUS RESERVASI (FIXED & FINAL)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_reservasi' => 'required|in:pending,confirmed,checked_in,completed,cancelled',
        ]);

        $reservasi = Reservasi::findOrFail($id);

        $reservasi->update([
            'status_reservasi' => $request->status_reservasi,
        ]);

        return redirect()
            ->route('admin.orders.show', $id)
            ->with('success', 'Status reservasi berhasil diperbarui.');
    }

    /**
     * Hapus pemesanan (opsional)
     */
    public function destroy($id)
    {
        Reservasi::findOrFail($id)->delete();

        return back()->with('success', 'Pemesanan berhasil dihapus.');
    }
}
