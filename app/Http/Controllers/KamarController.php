<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamars;

class KamarController extends Controller
{
    // =====================================================
    // 🟢 1. LIST KAMAR UNTUK TAMU (FILTER + SEARCH)
    // =====================================================
    public function listKamarTamu(Request $request)
    {
        $query = Kamars::where('status', 'available');

        // 🔍 Search keyword
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('tipe_kamar', 'like', '%' . $request->keyword . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->keyword . '%');
            });
        }

        // 🎚️ Filter harga
        if ($request->min_price) {
            $query->where('harga', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('harga', '<=', $request->max_price);
        }

        // 🏷️ Filter tipe kamar
        if ($request->tipe_kamar) {
            $query->where('tipe_kamar', $request->tipe_kamar);
        }

        // 🛠️ Filter fasilitas (JSON)
        if ($request->fasilitas && is_array($request->fasilitas)) {
            foreach ($request->fasilitas as $f) {
                $query->whereJsonContains('fasilitas', $f);
            }
        }

        // 📌 Sorting
        match ($request->sort) {
            'termurah' => $query->orderBy('harga', 'asc'),
            'termahal' => $query->orderBy('harga', 'desc'),
            'terbaru'  => $query->orderBy('created_at', 'desc'),
            default    => null,
        };

        $kamar = $query->paginate(12)->appends($request->query());

        return view('tamu.kamar-list', compact('kamar'));
    }

    // =====================================================
    // 🟢 2. LIST KAMAR ADMIN
    // =====================================================
    public function index(Request $request)
    {
        $query = Kamars::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->tipe_kamar) {
            $query->where('tipe_kamar', 'like', '%' . $request->tipe_kamar . '%');
        }

        $kamar = $query->paginate(10)->appends($request->query());

        return view('admin.kamar.index', compact('kamar'));
    }

    // =====================================================
    // 🟢 3. FORM TAMBAH KAMAR
    // =====================================================
    public function create()
    {
        return view('admin.kamar.create');
    }

    // =====================================================
    // 🟢 4. SIMPAN KAMAR BARU (FIX TOTAL)
    // =====================================================
    public function store(Request $request)
    {
        // Hapus format titik dari harga sebelum validasi
        if ($request->has('harga')) {
            $request->merge([
                'harga' => str_replace('.', '', $request->harga)
            ]);
        }

        $request->validate([
            'tipe_kamar' => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'kapasitas'  => 'required|integer|min:1',
            'status'     => 'required|in:available,booked,maintenance,unavailable',
            'deskripsi'  => 'nullable|string',
            'fasilitas'  => 'nullable|array',
            'foto_utama' => 'required|image|mimes:jpg,jpeg,png,webp,avif|max:8192',
        ]);

        // Upload foto
        $file = $request->file('foto_utama');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/kamar'), $namaFile);

        Kamars::create([
            'tipe_kamar' => $request->tipe_kamar,
            'harga'      => $request->harga,
            'kapasitas'  => $request->kapasitas,
            'status'     => $request->status,
            'foto_utama' => $namaFile,
            'deskripsi'  => $request->deskripsi,
            'fasilitas'  => $request->fasilitas ?? [], // ✅ TANPA json_encode
        ]);

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    // =====================================================
    // 🟢 5. FORM EDIT KAMAR
    // =====================================================
    public function edit($id)
    {
        $kamar = Kamars::findOrFail($id);
        return view('admin.kamar.edit', compact('kamar'));
    }

    // =====================================================
    // 🟢 6. UPDATE KAMAR (FIX TOTAL)
    // =====================================================
    public function update(Request $request, $id)
    {
        // Hapus format titik dari harga sebelum validasi
        if ($request->has('harga')) {
            $request->merge([
                'harga' => str_replace('.', '', $request->harga)
            ]);
        }

        $request->validate([
            'tipe_kamar' => 'required|string|max:255',
            'harga'      => 'required|numeric|min:0',
            'kapasitas'  => 'required|integer|min:1',
            'status'     => 'required|in:available,booked,maintenance,unavailable',
            'deskripsi'  => 'nullable|string',
            'fasilitas'  => 'nullable|array',
            'foto_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:8192',
        ]);

        $kamar = Kamars::findOrFail($id);

        if ($request->hasFile('foto_utama')) {
            if ($kamar->foto_utama && file_exists(public_path('uploads/kamar/' . $kamar->foto_utama))) {
                unlink(public_path('uploads/kamar/' . $kamar->foto_utama));
            }

            $file = $request->file('foto_utama');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kamar'), $namaFile);
            $kamar->foto_utama = $namaFile;
        }

        $kamar->update([
            'tipe_kamar' => $request->tipe_kamar,
            'harga'      => $request->harga,
            'kapasitas'  => $request->kapasitas,
            'status'     => $request->status,
            'deskripsi'  => $request->deskripsi,
            'fasilitas'  => $request->fasilitas ?? [],
        ]);

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    // =====================================================
    // 🟢 7. HAPUS KAMAR
    // =====================================================
    public function destroy($id)
    {
        $kamar = Kamars::findOrFail($id);

        if ($kamar->foto_utama && file_exists(public_path('uploads/kamar/' . $kamar->foto_utama))) {
            unlink(public_path('uploads/kamar/' . $kamar->foto_utama));
        }

        $kamar->delete();

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }

    // =====================================================
    // 🟢 8. DETAIL KAMAR ADMIN
    // =====================================================
    public function show($id)
    {
        $kamar = Kamars::findOrFail($id);
        return view('admin.kamar.show', compact('kamar'));
    }
}
