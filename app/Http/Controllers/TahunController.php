<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TahunController extends Controller
{
    // Menampilkan form pemilihan tahun
    public function showTahunForm()
    {
        return view('pilih_tahun');
    }

    // Menyimpan pilihan tahun ke dalam session
    public function setTahun(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2024', // Validasi minimal tahun 2024
        ]);

        // Simpan tahun ke dalam session
        session(['tahun_terpilih' => $request->tahun]);

        // Redirect ke dashboard
        return redirect()->route('dashboard');
    }

    public function pilihTahun(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        // SIMPAN PILIHAN ASLI (penting!)
        session(['tahun_ui' => $request->tahun]);

        if ($request->tahun == '20254') {
            session([
                'tahun_terpilih' => 2025,
                'triwulan_terpilih' => 4,
                'tw4_khusus' => 1,
            ]);
        } else {
            session([
                'tahun_terpilih' => (int) $request->tahun,
                'triwulan_terpilih' => null,
                'tw4_khusus' => 0,
            ]);

            session()->forget('tw4_khusus');
        }

        return redirect()->back();
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
