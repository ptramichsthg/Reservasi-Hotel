<?php

namespace App\Http\Controllers;

use App\Models\Kamars;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLaporanController extends Controller
{
    /**
     * ===============================
     * LAPORAN KAMAR (VIEW HTML)
     * ===============================
     */
    public function kamar()
    {
        $stat = [
            'total_kamar' => Kamars::count(),
            'available'   => Kamars::where('status', 'available')->count(),
            'booked'      => Kamars::where('status', 'booked')->count(),
            'maintenance' => Kamars::where('status', 'maintenance')->count(),
            'unavailable' => Kamars::where('status', 'unavailable')->count(),
        ];

        $kamar_list = Kamars::orderBy('tipe_kamar', 'asc')->get();

        return view('admin.laporan.kamar', compact('stat', 'kamar_list'));
    }


    /**
     * ===============================
     * LAPORAN TRANSAKSI (VIEW HTML)
     * ===============================
     */
    public function transaksi(Request $request)
    {
        $query = Reservasi::with(['kamar', 'user']);

        if ($request->start_date) {
            $query->whereDate('tgl_checkin', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('tgl_checkout', '<=', $request->end_date);
        }

        $reservasi = $query->orderBy('created_at', 'DESC')->get();

        $stat = [
            'total_reservasi' => Reservasi::count(),
            'pending'         => Reservasi::where('status_pembayaran', 'pending')->count(),
            'verifikasi'      => Reservasi::where('status_pembayaran', 'verified')->count(),
            'gagal'           => Reservasi::where('status_pembayaran', 'rejected')->count(),
        ];

        return view('admin.laporan.transaksi', compact('reservasi', 'stat'));
    }


    /**
     * ======================================================
     * EXPORT LAPORAN KAMAR (PDF) FIX
     * ======================================================
     */
    public function exportKamarPDF()
    {
        // =======================
        // STATISTIK KAMAR
        // =======================
        $stat = [
            'total_kamar' => Kamars::count(),
            'available'   => Kamars::where('status', 'available')->count(),
            'booked'      => Kamars::where('status', 'booked')->count(),
            'maintenance' => Kamars::where('status', 'maintenance')->count(),
            'unavailable' => Kamars::where('status', 'unavailable')->count(),
        ];

        // =======================
        // DATA KAMAR (WAJIB ADA)
        // =======================
        $kamar_list = Kamars::orderBy('tipe_kamar', 'asc')->get();

        // =======================
        // GENERATE PDF
        // =======================
        return Pdf::loadView(
            'admin.laporan.pdf.kamar',
            compact('stat', 'kamar_list')
        )
        ->setPaper('A4', 'landscape')
        ->download('laporan_kamar.pdf');
    }


    /**
     * ======================================================
     * 🧾 EXPORT LAPORAN TRANSAKSI (PDF)
     * ======================================================
     */
    public function exportTransaksiPDF()
    {
        $reservasi = Reservasi::with(['user', 'kamar'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return Pdf::loadView(
            'admin.laporan.pdf.transaksi',
            [
                'reservasi' => $reservasi,
                'tanggal'   => now()->format('d M Y')
            ]
        )
        ->setPaper('A4', 'landscape')
        ->download('laporan_transaksi.pdf');
    }

    /**
     * ===============================
     * LAPORAN PENDAPATAN
     * ===============================
     */
    public function pendapatan(Request $request)
    {
        // Total Pendapatan (semua transaksi verified)
        $totalPendapatan = Reservasi::where('status_pembayaran', 'verified')  // FIXED: 'paid' -> 'verified'
            ->sum('total_harga');

        // Pendapatan Bulan Ini
        $pendapatanBulanIni = Reservasi::where('status_pembayaran', 'verified')  // FIXED
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');

        // Rata-rata Pendapatan Per Bulan (12 bulan terakhir)
        $rataRata = Reservasi::where('status_pembayaran', 'verified')  // FIXED
            ->where('created_at', '>=', now()->subMonths(12))
            ->sum('total_harga') / 12;

        // Grafik Pendapatan 12 Bulan Terakhir
        $chartData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $pendapatan = Reservasi::where('status_pembayaran', 'verified')  // FIXED
                ->whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->sum('total_harga');
            
            $chartData[] = [
                'bulan' => $month->format('M Y'),
                'pendapatan' => $pendapatan
            ];
        }

        $chartBulan = collect($chartData)->pluck('bulan');
        $chartPendapatan = collect($chartData)->pluck('pendapatan');

        // Pendapatan Per Tipe Kamar
        $pendapatanPerTipe = Reservasi::where('status_pembayaran', 'verified')  // FIXED
            ->join('kamars', 'reservasis.id_kamar', '=', 'kamars.id_kamar')
            ->selectRaw('kamars.tipe_kamar, SUM(reservasis.total_harga) as total')
            ->groupBy('kamars.tipe_kamar')
            ->orderBy('total', 'DESC')
            ->get();

        return view('admin.laporan.pendapatan', compact(
            'totalPendapatan',
            'pendapatanBulanIni',
            'rataRata',
            'chartBulan',
            'chartPendapatan',
            'pendapatanPerTipe'
        ));
    }
}
