<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Aspirasi; // <-- import model
use App\Models\Feedback;
use App\Models\Progress;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
{
    $query = Aspirasi::with(['user','kategori']);

    // Filter tanggal
    if ($request->tanggal) {
        $query->whereDate('created_at', $request->tanggal);
    }

    // Filter kategori
    if ($request->kategori_id) {
        $query->where('kategori_id', $request->kategori_id);
    }

    // Filter nama siswa (search)
    if ($request->nama_siswa) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->nama_siswa . '%');
        });
    }

    $aspirasi = $query->latest()->get();
    $kategori = Kategori::all();

    return view('admin.dashboard', compact('aspirasi','kategori'));
}

    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::with(['user', 'kategori', 'feedback', 'progress'])->findOrFail($id);
        return view('admin.detail_aspirasi', compact('aspirasi'));
    }

     public function addFeedback(Request $request, $id)
    {
        $request->validate([
            'isi_feedback' => 'required|string',
        ]);

        Feedback::create([
            'aspirasi_id' => $id,
            'admin_id' => Auth::id(),
            'isi_feedback' => $request->isi_feedback,
        ]);

        return back()->with('success_feedback', 'Feedback berhasil ditambahkan.');
    }

    // Tambah progress
    public function addProgress(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:dikirim,diproses,selesai',
    ]);

    // Ambil aspirasi
    $aspirasi = Aspirasi::findOrFail($id);

    // Update status
    $aspirasi->status = $request->status;
    $aspirasi->save();

    // Simpan log progress (optional)
    Progress::create([
        'aspirasi_id' => $aspirasi->id,
        'keterangan' => 'Status diubah menjadi: ' . ucfirst($request->status),
    ]);

    return back()->with('success_progress', 'Status aspirasi berhasil diperbarui.');
}
}