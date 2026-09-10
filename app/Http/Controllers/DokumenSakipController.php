<?php

namespace App\Http\Controllers;

use App\Models\DokumenSakip;
use Illuminate\Http\Request;

class DokumenSakipController extends Controller
{
    public function index()
    {
        $dokumen = DokumenSakip::orderBy('kategori')->orderBy('urutan')->get();
        return view('dokumensakip.index', compact('dokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
            'judul' => 'required|string',
            'url' => 'required|url',
            'icon' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        DokumenSakip::create([
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'url' => $request->url,
            'icon' => $request->icon ?? 'bi-file-earmark-text',
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string',
            'judul' => 'required|string',
            'url' => 'required|url',
            'icon' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $dokumen = DokumenSakip::findOrFail($id);
        $dokumen->update([
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'url' => $request->url,
            'icon' => $request->icon ?? 'bi-file-earmark-text',
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dokumen = DokumenSakip::findOrFail($id);
        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus');
    }
}
