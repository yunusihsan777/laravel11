<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SakipwilController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil nilai id_satker dari session
        // $id_satker = session('id_satker');
        // Ambil nilai id_satker dari session
        $id_satker = session('id_satker'); // Mengambil id_kejati dari session
        $tahun = session('tahun_terpilih'); // Ambil tahun yang dipilih dari session

        // Pastikan $id_kejati tidak null atau tidak kosong sebelum digunakan dalam query
        $id = DB::table('sinori_login')
            ->where('id_satker', $id_satker)
            ->first();


        $kejati = DB::table('sinori_login')
            ->where('id_kejati', $id->id_kejati) // Gunakan nilai id_kejati yang diambil
            ->get();

        // Ambil semua data satkernama yang sesuai dengan id_kejati
        $satkernamaList = DB::table('sinori_login')
            ->where('id_kejati', $id->id_kejati)
            ->pluck('satkernama'); // pluck mengambil semua nilai dari kolom yang ditentukan

        // Ganti underscore dengan spasi untuk setiap satkernama
        $satkernamaList = $satkernamaList->map(function ($satkernama) {
            return str_replace('_', ' ', $satkernama);
        });

        // Debug untuk melihat semua satkernama
        // dd($satkernamaList);
        // dd(session()->all());
        return view('sakipwil', ['kejati' => $kejati, 'tahun' => $tahun, 'satkernamaList' => $satkernamaList]);
    }
}
