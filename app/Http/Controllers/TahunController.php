<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


class TahunController extends Controller
{
    // Menampilkan form pemilihan tahun
    public function showTahunForm()
    {
        return Inertia::render('PilihTahun');
    }

    // Menyimpan pilihan tahun ke dalam session
    public function setTahun(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2024|max:' . (date('Y') + 5),
        ]);

        // Simpan tahun ke session
        Session::put('tahun', $request->tahun);

        return back()->with('success', 'Tahun berhasil diperbarui!');

    }

    public function pilihTahun(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2024|max:' . (date('Y') + 5),
        ]);

                // Simpan tahun ke session atau database
                Session::put('tahun', $request->tahun);

                return redirect()->route('dashboard')->with('success', 'Tahun berhasil disimpan!');
    }

    public function setBulan(Request $request)
{
    $request->validate([
        'bulan' => 'required|integer|min:1|max:12',
    ]);

    session(['bulan_terpilih' => $request->bulan]); // Simpan bulan ke session

    return response()->json(['success' => true, 'bulan' => $request->bulan]);
}

}
