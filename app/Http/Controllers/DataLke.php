<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataLke1;
use App\Models\lke_subkomponens;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;

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
