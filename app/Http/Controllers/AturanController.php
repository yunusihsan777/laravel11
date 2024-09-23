<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aturan;

class AturanController extends Controller
{
    public function index()
    {
        // $aturan = Aturan::all();
        $aturan = DB::table('sinori_sakip_literasi') // Atau gunakan model jika ada
        ->orderBy('id_tahun', 'asc') // Urutkan berdasarkan kolom 'id_tahun'
        ->get();
        return view('aturan', compact('aturan'));
        
    }
    // Menampilkan form untuk menambah aturan baru
    public function create()
    {
        return view('aturan.create');
    }

    // Menyimpan aturan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_namaproduk' => 'required',
            'id_produsen' => 'required',
            'id_tahun' => 'required|digits:4|numeric',
            'file' => 'required|mimes:pdf|max:2048', // Validasi untuk file PDF
        ]);

        // Proses upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename); // Simpan file di folder uploads

            // Simpan data aturan termasuk nama file
            Aturan::create([
                'id_namaproduk' => $request->id_namaproduk,
                'id_produsen' => $request->id_produsen,
                'id_tahun' => $request->id_tahun,
                'id_filename' => $filename, // Simpan nama file di kolom id_filename
            ]);
        }
        return redirect()->route('aturan')->with('success', 'Peraturan berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit aturan
    public function edit($id)
    {
        $aturan = Aturan::findOrFail($id);
        return view('aturan.edit', compact('aturan'));
    }

    // Memperbarui aturan di database
    public function update(Request $request, $id)
    {
        // Validasi data input termasuk file
        $request->validate([
            'id_namaproduk' => 'required',
            'id_produsen' => 'required',
            'id_tahun' => 'required|numeric',
            'file' => 'nullable|mimes:pdf|max:2048', // Validasi untuk file PDF
        ]);

        // Mengambil data aturan yang akan diupdate
        $aturan = Aturan::findOrFail($id);

        // Proses upload file jika ada file baru
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename); // Simpan file baru di folder uploads
            $aturan->id_filename = $filename; // Update nama file di kolom id_filename
        }

        // Update data lainnya
        $aturan->update([
            'id_namaproduk' => $request->id_namaproduk,
            'id_produsen' => $request->id_produsen,
            'id_tahun' => $request->id_tahun,
        ]);

        return redirect()->route('aturan')->with('success', 'Peraturan berhasil diupdate.');
    }

    // Menghapus aturan dari database
    public function destroy($id)
    {
        $aturan = Aturan::findOrFail($id);
        $aturan->delete();

        return redirect()->route('aturan')->with('success', 'Peraturan berhasil dihapus.');
    }
}
