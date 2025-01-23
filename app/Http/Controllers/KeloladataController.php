<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indikator;
use App\Models\Bidang;
use App\Models\Saspro;

class KeloladataController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');


        // Ambil data dari tabel sinori_sakip_bidang
        $bidangs = Bidang::all();

        // Kirim data ke view
        // return view('keloladata', compact('bidangs'));
        return view('keloladata', ['tahun' => $tahun, 'bidangs' => $bidangs]);
    }

    public function Indikator(Request $request)
    {
        // Validasi data
        // Validasi data
        $validatedData = $request->validate([
            'id_bidang' => 'required|string',
            'tipe' => 'required|in:lag,leg',
            'link' => 'required|numeric',
            'lingkup' => 'required|numeric',
            'indikator_nama' => 'required|string',
            'indikator_pembilang' => 'required|string',
            'indikator_penyebut' => 'required|string',
            'indikator_penjelasan' => 'required|string',
            'matrix' => 'required|string',
        ]);

        // Simpan data ke dalam database (misal ke tabel indikator)
        Indikator::create($validatedData);

        // Redirect atau return response sesuai kebutuhan
        return redirect()->route('keloladata')->with('success', 'Data Indikator berhasil disimpan');
    }


    public function Bidang(Request $request)
    {
        $validatedData = $request->validate([
            'bidang_nama' => 'required|string|max:255',
            'bidang_level' => 'required|integer',
            'bidang_lokasi' => 'required|integer',
            'rumpun' => 'required|integer',
            'hide' => 'required|integer|in:0,1',
        ]);
        // dd($validatedData);
        // Simpan data menggunakan Eloquent
        Bidang::create($validatedData);


        return redirect()->route('keloladata')
            ->with('success', 'Data bidang berhasil disimpan!');
    }

    public function edit($id)
    {// Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');

        $bidang = Bidang::findOrFail($id);
        $bidangs = Bidang::all(); // Tetap kirimkan semua data untuk tabel
        
        return view('keloladata', ['tahun' => $tahun, 'bidang' => $bidangs]);
    }

    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->route('keloladata')->with('success', 'Data bidang berhasil dihapus.');
    }

    public function storeOrUpdateBidang(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'nullable|integer',
            'bidang_nama' => 'required|string|max:255',
            'bidang_level' => 'required|integer',
            'bidang_lokasi' => 'required|integer',
            'rumpun' => 'required|integer',
            'hide' => 'required|boolean',
        ]);

        // Cek apakah data sudah ada
        $bidang = Bidang::find($request->input('id'));

        if ($bidang) {
            // Update data jika ditemukan
            $bidang->update([
                'bidang_nama' => $request->input('bidang_nama'),
                'bidang_level' => $request->input('bidang_level'),
                'bidang_lokasi' => $request->input('bidang_lokasi'),
                'rumpun' => $request->input('rumpun'),
                'hide' => $request->input('hide'),
            ]);

            $message = 'Data berhasil diperbarui!';
        } else {
            // Buat data baru jika belum ada
            Bidang::create([
                'bidang_nama' => $request->input('bidang_nama'),
                'bidang_level' => $request->input('bidang_level'),
                'bidang_lokasi' => $request->input('bidang_lokasi'),
                'rumpun' => $request->input('rumpun'),
                'hide' => $request->input('hide'),
            ]);

            $message = 'Data berhasil disimpan!';
        }

        // Redirect dengan pesan sukses
        return redirect()->route('keloladata')->with('success', $message);
    }

    public function saspro(Request $request)
    {
        // Validasi input
        $request->validate([
            'link' => 'required|string|max:255',
            'saspro_nama' => 'required|string|max:255',
            'penjelasan_saspro' => 'required|string',
            'lingkup' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Saspro::create([
            'link' => $request->input('link'),
            'saspro_nama' => $request->input('saspro_nama'),
            'saspro_penjelasan' => $request->input('penjelasan_saspro'),
            'lingkup' => $request->input('lingkup'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('keloladata')->with('success', 'Data Saspro berhasil disimpan!');
    }
}
