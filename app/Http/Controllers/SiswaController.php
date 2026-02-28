<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    // Dashboard siswa
    public function dashboard()
    {
        // Ambil aspirasi milik siswa ini
        $aspirasi = Aspirasi::with('kategori')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.dashboard', compact('aspirasi'));
    }

    // Form tambah aspirasi
    public function createAspirasi()
    {
        $kategori = Kategori::all(); // semua kategori
        return view('siswa.create_aspirasi', compact('kategori'));
    }

    // Simpan aspirasi baru
    public function storeAspirasi(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'judul' => 'required|string|max:150',
            'isi' => 'required|string',
        ]);

        Aspirasi::create([
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => 'dikirim',
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Aspirasi berhasil dikirim.');
    }

    // Detail aspirasi
    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::with(['kategori', 'feedback', 'progress'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('siswa.detail_aspirasi', compact('aspirasi'));
    }
}