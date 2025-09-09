<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataLke1;
use App\Models\lke_subkomponens;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use App\Models\lke_buktidukung;
use App\Models\Renstra;

class DataLke extends Controller
{
   public function index(){
      if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }
        // Ambil tahun yang dipilih dari session
        $tahun = session('tahun_terpilih');
      $data1 = DataLke1::whereIn('subkomponen_id', [1, 2, 3])->get();
      
       return view('kelola.components.evaluasi_lke', compact('data1', 'tahun'));
   }
   public function cekBuktiDukung($kode){
      $data1 = DataLke1::where('kode', $kode)->get();
// Ambil semua kode_bukti, pecah jadi array angka
    $kodeBuktiIds = [];
    foreach ($data1 as $item) {
        $ids = explode(',', $item->kode_bukti);
        foreach ($ids as $id) {
            $kodeBuktiIds[] = (int)trim($id);
        }
    }
   $bukti_dukung_nama = lke_buktidukung::whereIn('id', $kodeBuktiIds)->pluck('dokumen', 'id');
    $bukti_dukung = null;
    if (in_array(1, $kodeBuktiIds)) {
        $bukti_dukung = lke_buktidukung::where('id', 1)->get(); 
        $bukti_dukung = Renstra::where('id_satker', '006050')->get();
    }
    return view('kelola.components.cekbdeval_lke', compact('data1', 'bukti_dukung', 'bukti_dukung_nama'));
   }

   public function lke2(){
      $data2 = DataLke1::where('subkomponen_id', [4, 5, 6])->get();
      return view('lke2', compact('data2'));
   }
   public function lke3(){
      $data3 = DataLke1::where('subkomponen_id', [7, 8, 9])->get();
      return view('lke3', compact('data3'));
   }
   public function lke4(){
      $data4 = DataLke1::where('subkomponen_id', [10, 11, 12])->get();
      return view('lke4', compact('data4'));
   }


}
