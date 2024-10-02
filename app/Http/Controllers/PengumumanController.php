<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman; // Model tabel Pengumuman

class PengumumanController extends Controller
{
    // Menampilkan halaman pengumuman dengan list pengumuman
    public function index()
    {
         // Cek apakah tahun sudah dipilih
         if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        $tahun = session('tahun_terpilih');
        $pengumuman = Pengumuman::all();
        return view('pengumuman', ['pengumuman' => $pengumuman, 'tahun' => $tahun]);
        
    }

    // Menyimpan pengumuman baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => \Carbon\Carbon::now()->format('d/m/Y h:i A'),
            'tglpost' => \Carbon\Carbon::now()->format('d/m/Y h:i A'),
        ]);

        return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    // Menampilkan form edit pengumuman
    public function edit($id)
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        $tahun = session('tahun_terpilih');
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pengumuman.edit', ['pengumuman' => $pengumuman, 'tahun' => $tahun]);
    }

    // Menyimpan perubahan pengumuman
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
    ]);

    // Ambil pengumuman berdasarkan ID
    $pengumuman = Pengumuman::findOrFail($id);

    // Update data
    $pengumuman->judul = $request->judul;
    $pengumuman->isi = $request->isi;

    // Format tanggal saat ini ke DD/MM/YYYY dan simpan ke kolom tglpost
    $pengumuman->tglpost = \Carbon\Carbon::now()->format('d/m/Y h:i A'); // Menggunakan format DD/MM/YYYY

    // Simpan perubahan
    $pengumuman->save();
    
    return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil diupdate');
}

    // Menghapus pengumuman
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('pengumuman')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
