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

        // Ambil nilai dari session
        $id_satker = session('id_satker');
        $tahun = session('tahun_terpilih');

        // Ambil data pengguna
        $id = DB::table('sinori_login')->where('id_satker', $id_satker)->first();

        // Ambil data satkernama dan id_satker sesuai id_kejati
        $data = DB::table('sinori_login')
            ->where('id_kejati', $id->id_kejati)
            ->get();

        // Ganti underscore dengan spasi dan ambil id_satker
        $satkernamaList = $data->pluck('satkernama')->map(function ($satkernama) {
            return str_replace('_', ' ', $satkernama);
        });

        // Ambil keputusan berdasarkan satker dan tahun
        $kepList = DB::table('sinori_sakip_keputusan')
            ->whereIn('id_satker', $data->pluck('id_satker'))
            ->where('id_tahun', $tahun)
            ->pluck('id_filesurat', 'id_satker');

        // Menyelaraskan urutan kepList dengan satker
        $sortedKepList = $data->pluck('id_satker')->map(function ($id) use ($kepList) {
            return $kepList[$id] ?? null;
        });

        // Kembalikan view dengan data yang diperlukan
        return view('sakipwil', [
            'data' => $data,
            'tahun' => $tahun,
            'satkernamaList' => $satkernamaList,
            'sortedKepList' => $sortedKepList,
        ]);
    }
}
