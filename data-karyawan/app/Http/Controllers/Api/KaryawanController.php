<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::with('pekerjaan')->get();
        return response()->json($karyawans);
    }

    public function store(Request $request)
    {
        // Validasi data karyawan
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'pekerjaan' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
        ]);

        // Cari atau buat pekerjaan
        $pekerjaan = Pekerjaan::firstOrCreate(
            ['pekerjaan' => $validated['pekerjaan'], 'divisi' => $validated['divisi']]
        );

        // Simpan karyawan
        $karyawan = Karyawan::create([
            'nama' => $validated['nama'],
            'status' => $validated['status'],
            'pekerjaan_id' => $pekerjaan->id,
        ]);

        return response()->json($karyawan, 201);
    }

    public function show($id)
    {
        $karyawan = Karyawan::with('pekerjaan')->findOrFail($id);
        return response()->json($karyawan);
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'pekerjaan' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
        ]);

        // Cari karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);

        // Cari atau buat pekerjaan berdasarkan nama pekerjaan dan divisi
        $pekerjaan = Pekerjaan::firstOrCreate(
            ['pekerjaan' => $validated['pekerjaan'], 'divisi' => $validated['divisi']]
        );

        // Update data karyawan
        $karyawan->update([
            'nama' => $validated['nama'],
            'status' => $validated['status'],
            'pekerjaan_id' => $pekerjaan->id, // Hubungkan ke pekerjaan baru/yang sudah ada
        ]);

        return response()->json($karyawan, 200);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return response()->json(null, 204);
    }
    public function statistics(Request $request)
    {
        // Ambil parameter divisi (opsional)
        $divisi = $request->input('divisi');
    
        // Query karyawan
        $query = Karyawan::query()->with('pekerjaan');
    
        // Filter berdasarkan divisi jika ada
        if ($divisi) {
            $query->whereHas('pekerjaan', function ($q) use ($divisi) {
                $q->where('divisi', $divisi);
            });
        }
    
        // Hitung statistik
        $totalKaryawan = $query->count(); // Semua karyawan sesuai filter
        $aktif = $query->clone()->where('status', 'aktif')->count(); // Status aktif
        $nonaktif = $query->clone()->where('status', 'nonaktif')->count(); // Status nonaktif
    
        // Ambil daftar divisi dari tabel pekerjaan
        $divisis = Pekerjaan::distinct('divisi')->pluck('divisi');
    
        return response()->json([
            'total' => $totalKaryawan,
            'aktif' => $aktif,
            'nonaktif' => $nonaktif,
            'divisis' => $divisis,
        ]);
    }
}