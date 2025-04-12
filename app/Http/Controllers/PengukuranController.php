<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indikator;
use App\Models\Pengukuran;

class PengukuranController extends Controller
{
    public function index()
    {
        // Cek apakah tahun sudah dipilih
        if (!session()->has('tahun_terpilih')) {
            return redirect()->route('pilih.tahun');
        }

        return view('kelola.pengukuran', [
            'tahun' => session('tahun_terpilih')
        ]);
    }

   // Fungsi untuk mendapatkan indikator berdasarkan bidang (AJAX)
   public function getIndikator(Request $request)
   {
       $bidang_id = $request->bidang_id;
       $indikators = Indikator::where('link', $bidang_id)
           ->whereNotNull('sub_indikator')
           ->where('sub_indikator', '!=', '')
           ->get();
   
       if ($indikators->isEmpty()) {
           return '<p class="text-center"><i>Tidak ada indikator tersedia.</i></p>';
       }
   
       $html = '';
   
       foreach ($indikators as $indikator) {
           $sub_indikators = explode(',', $indikator->sub_indikator);
           $html .= "<h5 class='mt-4 p-2 bg-warning text-dark'><strong>📌 Indikator: {$indikator->indikator_nama}</strong></h5>";
   
           // Form untuk menyimpan data
           $html .= "<form action='" . route('pengukuran.store') . "' method='POST'>";
           $html .= csrf_field();
           $html .= "<input type='hidden' name='indikator_id' value='{$indikator->id}'>";
   
           // Tabel Sub Indikator & Input Data
           $html .= "<div class='row'>
                       <div class='col-md-6'>
                           <table class='table table-bordered'>
                               <thead class='table-dark'>
                                   <tr>
                                       <th>Sub Indikator</th>
                                       <th>Ditangani</th>
                                       <th>Diselesaikan</th>
                                   </tr>
                               </thead>
                               <tbody>";
   
           foreach ($sub_indikators as $index => $sub) {
               $html .= "<tr>
                           <td>{$sub}</td>
                           <td><input type='number' name='ditangani[{$index}]' class='form-control' style='width:100px'></td>
                           <td><input type='number' name='diselesaikan[{$index}]' class='form-control' style='width:100px'></td>
                       </tr>";
           }
   
           $html .= "</tbody></table></div>";
   
           // **Kolom kanan** -> Input Ditangani & Diselesaikan per Bulan
           $html .= "<div class='col-md-6'>
                       <table class='table table-bordered'>
                           <thead class='table-dark'>
                               <tr>
                                   <th>Bulan</th>
                                   <th>Ditangani</th>
                                   <th>Diselesaikan</th>
                               </tr>
                           </thead>
                           <tbody>";
   
           for ($bulan = 1; $bulan <= 12; $bulan++) {
               $html .= "<tr>
                           <td>" . date('F', mktime(0, 0, 0, $bulan, 1)) . "</td>
                           <td><input type='number' name='bulan_ditangani[{$bulan}]' class='form-control' style='width:100px'></td>
                           <td><input type='number' name='bulan_diselesaikan[{$bulan}]' class='form-control' style='width:100px'></td>
                       </tr>";
           }
   
           $html .= "</tbody></table></div></div>"; // **Tutup row dan col-md-6**
   
           // Tombol Simpan
           $html .= "<button type='submit' class='btn btn-success mt-2'>Simpan</button>";
           $html .= "</form>";
       }
   
       return $html;
   }
   

   // Fungsi untuk menyimpan data
   public function store(Request $request)
   {
    
       $request->validate([
           'indikator_id' => 'required|exists:sinori_sakip_indikator,id',
           'bulan' => 'required|integer|min:1|max:12', // Pastikan bulan disertakan dan valid
           'ditangani.*' => 'nullable|numeric',
           'diselesaikan.*' => 'nullable|numeric',
           'uraian_capaian.*' => 'nullable|string',
           'faktor.*' => 'nullable|string',
           'langkah_optimalisasi.*' => 'nullable|string',
       ]);
    //    dd($request->bulan);
       $indikator = Indikator::findOrFail($request->indikator_id);
       $sub_indikators = explode(',', $indikator->sub_indikator);
       $bulanDipilih = $request->bulan;
       
       foreach ($sub_indikators as $index => $sub) {
           Pengukuran::updateOrCreate(
               [
                   'indikator_id' => $request->indikator_id,
                   'id_satker' => session('id_satker'),
                   'tahun' => session('tahun_terpilih'),
                   'bulan' => $bulanDipilih, // Simpan bulan yang dipilih
                   'sub_indikator' => trim($sub),
               ],
               [
                   'ditangani' => $request->ditangani[$index] ?? null,
                   'diselesaikan' => $request->diselesaikan[$index] ?? null,
                   'uraian_capaian' => $request->uraian_capaian[$index] ?? '-',
                   'faktor' => $request->faktor[$index] ?? '-',
                   'langkah_optimalisasi' => $request->langkah_optimalisasi[$index] ?? '-',
               ]
           );
           
       }
    //    dd($bulanDipilih);
       return redirect()->back()->with('success', 'Data berhasil disimpan!');
   }
   
        
}