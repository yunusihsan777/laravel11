<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Renstra;

class RenstraController extends Controller
{
    // Menampilkan halaman Renstra
    public function index()
    {
        // Mengambil semua data dari tabel sinori_sakip_renstra
        // $renstraFiles = Renstra::all();
        // return view('kelola.perencanaan', compact('renstraFiles'));
    }

    // Fungsi untuk menangani upload file Renstra
    public function uploadRenstra(Request $request)
    {
        // Validasi input
        // $request->validate([
        //     'renstra_file' => 'required|mimes:pdf|max:2048', // File harus PDF dan maksimal 2MB
        // ]);

        // // Simpan file ke dalam storage/renstra
        // $file = $request->file('renstra_file');
        // $fileName = time() . '_' . $file->getClientOriginalName();
        // $filePath = $file->storeAs('renstra', $fileName, 'public');

        // // Simpan data file ke dalam database
        // $renstra = new Renstra();
        // $renstra->filename = $fileName;
        // $renstra->version = '1.0'; // Anda bisa mengatur versi sesuai kebutuhan
        // $renstra->uploaded_at = now();
        // $renstra->save();

        // // Redirect kembali dengan pesan sukses
        // return redirect()->route('kelola.perencanaan')->with('success', 'File Renstra berhasil diupload.');
    }
}
