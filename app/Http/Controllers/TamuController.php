<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kamars;        // sesuaikan jika model kamu bernama Kamars
use App\Models\Reservasi;

class TamuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:tamu']);
    }

    // Daftar kamar tersedia
    public function daftarKamar()
    {
        $kamar = Kamars::where('status', 'available')->get();
        return view('tamu.daftar_kamar', compact('kamar'));
    }

    // Kamar yang sudah dipesan user login
    public function kamarSaya()
    {
        $pemesanan = Reservasi::with('kamar')
            ->where('id_user', Auth::id())
            ->get();

        return view('tamu.kamar_saya', compact('pemesanan'));
    }

    // Dashboard tamu
    public function dashboard()
    {
        $userId = Auth::id();

        // Statistik utama pemesanan user
        $totalPemesanan = Reservasi::where('id_user', $userId)->count();

        // Menggunakan kolom yang benar: status_pembayaran
        $pending = Reservasi::where('id_user', $userId)
            ->where('status_pembayaran', 'pending')
            ->count();

        $confirmed = Reservasi::where('id_user', $userId)
            ->where('status_pembayaran', 'paid')
            ->count();

        $cancelled = Reservasi::where('id_user', $userId)
            ->where('status_pembayaran', 'cancelled')
            ->count();

        // Total kamar berbeda yang pernah dipesan
        $totalKamar = Reservasi::where('id_user', $userId)
            ->distinct('id_kamar')
            ->count('id_kamar');

        // Grafik: 7 hari terakhir
        $chartData = Reservasi::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->where('id_user', $userId)
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $tanggal = [];
        $total = [];

        foreach ($chartData as $row) {
            $tanggal[] = date('d M', strtotime($row->tanggal));
            $total[] = $row->total;
        }

        // Grafik: Jenis kamar
        $chartJenis = Reservasi::where('reservasis.id_user', $userId)
            ->join('kamars', 'reservasis.id_kamar', '=', 'kamars.id_kamar')
            ->selectRaw('kamars.tipe_kamar as tipe, COUNT(*) as total')
            ->groupBy('tipe')
            ->orderBy('total', 'DESC')
            ->get();

        $tipeKamar = $chartJenis->pluck('tipe');
        $jumlahTipe = $chartJenis->pluck('total');

        return view('tamu.dashboard', compact(
            'totalPemesanan',
            'pending',
            'confirmed',
            'cancelled',
            'totalKamar',
            'tanggal',
            'total',
            'tipeKamar',
            'jumlahTipe'
        ));
    }

    // Halaman Bantuan / FAQ
    public function bantuan()
    {
        return view('tamu.bantuan', [
            'title' => 'Pusat Bantuan'
        ]);
    }

    // Halaman Pembayaran (hanya reservasi pending)
    public function pembayaran()
    {
        $pemesanan = Reservasi::with('kamar')
            ->where('id_user', Auth::id())
            ->where('status_pembayaran', 'pending')
            ->orderByDesc('created_at')
            ->get();

        return view('tamu.pembayaran', compact('pemesanan'));
    }
}
