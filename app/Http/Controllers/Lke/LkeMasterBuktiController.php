<?php

namespace App\Http\Controllers\Lke;

use App\Http\Controllers\Controller;
use App\Models\LkeBuktidukung;
use Illuminate\Http\Request;

class LkeMasterBuktiController extends Controller
{
    /**
     * Check if current session user is Admin.
     */
    protected function checkAdmin()
    {
        $satker = session('id_satker');
        $level = session('id_sakip_level');
        $nama = strtolower(session('satkernama', ''));

        $isAdmin = in_array($satker, ['admin', '999999', '888881', 'Pengawasan', 'Panev'])
            || $level == '99'
            || str_contains(strtolower((string)$satker), 'admin')
            || str_contains($nama, 'admin')
            || app()->environment('local'); // Allow in local testing if needed

        if (!$isAdmin) {
            abort(403, 'Akses Ditolak: Hanya Administrator yang dapat mengubah Master Bukti Dukung.');
        }
    }

    public function index(Request $request)
    {
        $this->checkAdmin();

        $masterBukti = LkeBuktidukung::orderBy('id')->get();
        
        // Get distinct tabel_sumber from DB
        $tabelSumberList = LkeBuktidukung::select('tabel_sumber')
            ->whereNotNull('tabel_sumber')
            ->where('tabel_sumber', '!=', '')
            ->distinct()
            ->pluck('tabel_sumber')
            ->toArray();

        // Ensure these common tables are at least in the list even if not in DB yet
        $commonTables = [
            'sinori_sakip_renja', 'sinori_sakip_renaksi', 'sinori_sakip_renstra',
            'sinori_sakip_rkakl', 'sinori_sakip_iku', 'sinori_sakip_lakip',
            'sinori_sakip_rastaff', 'sinori_sakip_dipa', 'sinori_sakip_renaksieval'
        ];
        $tabelSumberList = array_unique(array_merge($tabelSumberList, $commonTables));
        sort($tabelSumberList);

        // Generate years list
        $currentYear = (int)date('Y');
        $tahunList = range(2023, $currentYear + 2);

        return view('lke.master_bukti.index', compact('masterBukti', 'tabelSumberList', 'tahunList'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();

        $request->validate([
            'dokumen' => 'required|string|max:500',
            'tabel_sumber' => 'required|string|max:100',
            'tahun' => 'required|integer',
        ]);

        $bukti = LkeBuktidukung::findOrFail($id);
        $bukti->dokumen = $request->input('dokumen');
        $bukti->tabel_sumber = $request->input('tabel_sumber');
        $bukti->tahun = $request->input('tahun');
        $bukti->save();

        return redirect()->route('lke.master_bukti.index')->with('success', 'Master Bukti Dukung berhasil diperbarui!');
    }
}
