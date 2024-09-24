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
    // Function untuk menampilkan halaman tambah peraturan
    public function create()
    {
        return view('aturan.create');
    }

    // Function untuk menyimpan peraturan baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_namaproduk' => 'required|string|max:255',
            'id_produsen' => 'required|string|max:255',
            'id_tahun' => 'required|numeric|min:1900|max:' . date('Y'),
            'file' => 'required|mimes:pdf|max:2048' // Validasi hanya menerima file PDF dengan ukuran maksimal 2MB
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName(); // Buat nama unik untuk file
            $file->move(public_path('uploads/peraturan'), $filename); // Simpan file ke folder "uploads"

            // Simpan data ke database
            Aturan::create([
                'id_namaproduk' => $request->id_namaproduk,
                'id_produsen' => $request->id_produsen,
                'id_tahun' => $request->id_tahun,
                'id_filename' => $filename // Simpan nama file ke dalam database
            ]);
        }

        return redirect()->route('aturan')->with('success', 'Peraturan berhasil ditambahkan');
    }

    // Function untuk menampilkan halaman edit
    public function edit($id)
    {
        $aturan = Aturan::findOrFail($id);
        return view('aturan.edit', compact('aturan'));
    }

    // Function untuk update peraturan
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_namaproduk' => 'required|string|max:255',
            'id_produsen' => 'required|string|max:255',
            'id_tahun' => 'required|numeric|min:1900|max:' . date('Y'),
            'file' => 'nullable|mimes:pdf|max:2048' // Validasi opsional untuk PDF
        ]);

        $aturan = Aturan::findOrFail($id);

        // Handle file upload jika ada
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName(); // Buat nama unik untuk file
            $file->move(public_path('uploads'), $filename); // Simpan file ke folder "uploads"

            // Update nama file di database
            $aturan->update([
                'id_filename' => $filename
            ]);
        }

        // Update data lainnya
        $aturan->update([
            'id_namaproduk' => $request->id_namaproduk,
            'id_produsen' => $request->id_produsen,
            'id_tahun' => $request->id_tahun
        ]);

        return redirect()->route('aturan')->with('success', 'Peraturan berhasil diperbarui');
    }
    // Menghapus aturan dari database
    public function destroy($id)
    {
        $aturan = Aturan::findOrFail($id);
        $aturan->delete();

        return redirect()->route('aturan')->with('success', 'Peraturan berhasil dihapus.');
    }
}
