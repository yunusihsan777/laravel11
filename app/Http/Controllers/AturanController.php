<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Aturan;

class AturanController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
        
        // $aturan = Aturan::all();
        $aturan = DB::table('sinori_sakip_literasi') // Atau gunakan model jika ada
            ->orderBy('id_tahun', 'desc') // Urutkan berdasarkan kolom 'id_tahun'
            ->get();
        return view('aturan', ['aturan' => $aturan, 'tahun' => $tahun]);
    }
    // Function untuk menampilkan halaman tambah peraturan
    public function create()
    {
         // Cek apakah tahun sudah dipilih
         if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        $tahun = session('tahun_terpilih');
        return view('aturan.create', ['tahun' => $tahun]);
    }
 
    // Function untuk menyimpan peraturan baru
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'id_namaproduk' => 'required|string|max:255',
        'id_produsen'   => 'required|string|max:255',
        'id_tahun'      => 'required|numeric|min:1900|max:' . date('Y'),
        'file'          => 'required|mimes:pdf|max:20480', // Maksimal 20MB (dalam KB)
    ]);

    // Handle file upload
    if ($request->hasFile('file')) {
        $file = $request->file('file');

        // Pastikan folder tujuan ada
        $destinationPath = public_path('uploads/peraturan');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Buat nama file unik: slug_namaproduk_timestamp.pdf
        $filename = Str::slug($request->id_namaproduk, '_') . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Pindahkan file ke folder tujuan
        $file->move($destinationPath, $filename);

        // Simpan data ke database
        Aturan::create([
            'id_namaproduk' => $request->id_namaproduk,
            'id_produsen'   => $request->id_produsen,
            'id_tahun'      => $request->id_tahun,
            'id_filename'   => $filename, // simpan nama file di DB
        ]);
    }

    return redirect()->route('aturan')->with('success', 'Peraturan berhasil ditambahkan');
}

    // Function untuk menampilkan halaman edit
    public function edit($id)
    {
         // Cek apakah tahun sudah dipilih
         if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        $tahun = session('tahun_terpilih');
        $aturan = Aturan::findOrFail($id);
        return view('aturan.edit', ['aturan' => $aturan, 'tahun' => $tahun]);
        
    }

    // Function untuk update peraturan
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_namaproduk' => 'required|string|max:255',
            'id_produsen' => 'required|string|max:255',
            'id_tahun' => 'required|numeric|min:1900|max:' . date('Y'),
            'file' => 'nullable|mimes:pdf|max:20048' // Validasi opsional untuk PDF
        ]);

        $aturan = Aturan::findOrFail($id);

        // Handle file upload jika ada
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::slug($request->id_namaproduk, '_') . '.' . $file->getClientOriginalExtension();// Buat nama unik untuk file
            $file->move(public_path('uploads/peraturan'), $filename); // Simpan file ke folder "uploads"

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
