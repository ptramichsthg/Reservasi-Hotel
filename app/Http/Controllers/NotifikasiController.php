<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * 🟢 Menampilkan semua notifikasi untuk user login
     */
    public function index()
    {
        $notifikasi = Notifikasi::where('id_user', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('tamu.notifikasi.index', compact('notifikasi'));
    }

    /**
     * 🟢 Tandai notifikasi sebagai telah dibaca
     */
    public function markRead($id)
    {
        $notif = Notifikasi::where('id_user', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $notif->update([
            'is_read' => true
        ]);

        return redirect()->back()->with('success', 'Notifikasi sudah dibaca.');
    }

    /**
     * 🟢 Fungsi helper untuk membuat notifikasi baru
     */
    public static function send($id_user, $judul, $pesan)
    {
        Notifikasi::create([
            'id_user' => $id_user,
            'judul'   => $judul,
            'pesan'   => $pesan,
            'is_read' => false
        ]);
    }
}
