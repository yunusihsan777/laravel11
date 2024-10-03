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
        // dd($kepList);
        // Menyelaraskan urutan kepList dengan satker
        $sortedKepList = $data->pluck('id_satker')->map(function ($id) use ($kepList) {
            return $kepList[$id] ?? null;
        });
        // dd($sortedkepList);
        // Memeriksa tahun dan menentukan id_periode
        if ($tahun == "2024") {
            $id_periode = "P1";
        } else {
            $id_periode = "P2";
        }

        // Mengambil id_filename berdasarkan id_satker
        $renstra = DB::table('sinori_sakip_renstra')
            ->select('id_satker', 'id_perubahan', 'id_filename') // Pilih kolom yang dibutuhkan
            ->whereIn('id_satker', $data->pluck('id_satker')) // Ambil berdasarkan id_satker dari data sebelumnya
            ->where('id_periode', $id_periode)
            ->orderBy(DB::raw('CAST(id_perubahan AS UNSIGNED)'), 'desc') // Urutkan berdasarkan id_perubahan terakhir
            ->get()
            ->groupBy('id_satker'); // Kelompokkan berdasarkan id_satker

        // dd($renstra);
        // Kembalikan view dengan data yang diperlukan
        return view('sakipwil', [
            'data' => $data,
            'tahun' => $tahun,
            'satkernamaList' => $satkernamaList,
            'sortedKepList' => $sortedKepList,
            'renstra' => $renstra,
        ]);
    }
}
