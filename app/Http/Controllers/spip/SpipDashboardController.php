<?php
namespace App\Http\Controllers\Spip;
use App\Models\spip\SpipParameter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpipDashboardController extends Controller
{
    public function index()
    {
        // Pastikan nama variabel di sini adalah 'parameters'
        $parameters = SpipParameter::all();

    // Pastikan progressCount didefinisikan (agar tidak error juga nanti)
    $progressCount = 0;

    // Kirim ke view 'dashboard_spip' dengan nama 'parameters'
    return view('spip/dashboard_spip', compact('parameters', 'progressCount'));
}

public function simpanParameter(Request $request)
{
    $parameter = SpipParameter::find($request->parameter_id);

    // Update data berdasarkan input dari modal
    $parameter->update([
        'spip' => $request->grade, // Atau logika lain sesuai kebutuhan
        // Simpan juga uraian ke tabel terkait jika ada
    ]);

    return back()->with('success', 'Data berhasil disimpan!');
}
}
