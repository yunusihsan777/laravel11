<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kep;

class kepController extends Controller
{
    public function index()
    {
        // Ambil id_satker dari session
        $idSatker = session('id_satker');

        // Cari kep berdasarkan id_satker
        $kep = kep::where('id_satker', $idSatker)->first();
        // Kirim variabel $kep ke view
        return view('kelola.kep', compact('kep'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nomor_surat' => 'required|string',
            'tanggal_surat' => 'required', // Validasi format tanggal
            'file' => 'required|mimes:pdf|max:2048', // Hanya file PDF
        ]);

        $idSatker = session('id_satker'); // Ambil id_satker dari session

        // Cek apakah satker sudah mengunggah keputusan sebelumnya
        $existing = Kep::where('id_satker', $idSatker)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Satker sudah mengunggah keputusan.');
        }

        // Simpan file ke storage
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $idSatker . '.pdf' ; // Unikkan nama file
            $file->move(public_path('uploads/keputusan'), $fileName); // Simpan di folder 'keputusan' di storage

            // Simpan data ke database
            Kep::create([
                'id_satker' => $idSatker,
                'id_filesurat' => $fileName,
                'id_nomorsurat' => $request->input('nomor_surat'),
                'id_tglsurat' => $request->input('tanggal_surat') // Simpan langsung format d/m/Y
            ]);

            return redirect()->back()->with('success', 'Keputusan berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file.');
    }
}
