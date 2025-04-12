<?php

use Illuminate\Support\Facades\Route;

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth/login');
});

// Handle login
use App\Http\Controllers\Auth\LoginController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Handle Logout
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//Handle Pilih Tahun
// use App\Http\Controllers\YearSelectionController;
// Route::get('/select-year', [YearSelectionController::class, 'index'])->name('select.year');
// Route::post('/select-year', [YearSelectionController::class, 'store'])->name('store.year');
use App\Http\Controllers\TahunController;
// Handle pemilihan tahun
Route::get('/pilih-tahun', [TahunController::class, 'showTahunForm'])->name('pilih.tahun');
// Route untuk menangani pemilihan tahun
Route::post('/pilih2-tahun', [TahunController::class, 'setTahun'])->name('set.tahun');

Route::post('/pilih-tahun', [TahunController::class, 'pilihTahun'])->name('pilih_tahun');
// Route untuk dashboard, data berdasarkan tahun yang dipilih
// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::post('/set-bulan', [TahunController::class, 'setBulan'])->name('set.bulan');

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\KepController;
Route::post('kep', [KepController::class, 'store'])->name('kep.store');

use App\Http\Controllers\PerencanaanController;
Route::post('/perencanaan/upload-renstra', [PerencanaanController::class, 'uploadRenstra'])->name('upload.renstra');
Route::post('/perencanaan/upload-iku', [PerencanaanController::class, 'uploadIku'])->name('upload.iku');
Route::post('/perencanaan/upload-renja', [PerencanaanController::class, 'uploadRenja'])->name('upload.renja');
Route::post('/perencanaan/upload-rkakl', [PerencanaanController::class, 'uploadRkakl'])->name('upload.rkakl');
// Route::post('/perencanaan/upload-dipa', [PerencanaanController::class, 'uploadDipa'])->name('upload.dipa');
Route::post('/perencanaan/upload-renaksi', [PerencanaanController::class, 'uploadRenaksi'])->name('upload.renaksi');

Route::get('/perencanaan/indikator', [PerencanaanController::class, 'showIndikator'])->name('perencanaan.indikator');
Route::post('/perencanaan/store', [PerencanaanController::class, 'store'])->name('perencanaan.store');
Route::post('/target/store', [PerencanaanController::class, 'storetarget'])->name('target.store');

use App\Http\Controllers\PengukuranController;
Route::post('/pengukuran/store', [PengukuranController::class, 'store'])->name('pengukuran.store');
Route::get('/pengukuran/indikator', [PengukuranController::class, 'getIndikator'])->name('pengukuran.getIndikator');
Route::get('/pengukuran/get-indikator', [PengukuranController::class, 'getIndikator'])->name('pengukuran.getIndikator');
Route::get('/pengukuran/{id}', [PengukuranController::class, 'showPengukuran'])->name('pengukuran.show');

use App\Http\Controllers\PelaporanController;
Route::post('/upload/lkjip', [PelaporanController::class, 'uploadLkjip'])->name('upload.lkjip');
Route::delete('/delete/lkjip/{id}', [PelaporanController::class, 'deleteLkjip'])->name('delete.lkjip');

use App\Http\Controllers\EvaluasiController;

use App\Http\Controllers\SakipwilController;

use App\Http\Controllers\SakipvalidasiController;

use App\Http\Controllers\KepatuhanController;

use App\Http\Controllers\ChatsupportController;

use App\Http\Controllers\PengumumanController;
Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

use App\Http\Controllers\AturanController;
Route::resource('aturan', AturanController::class);
Route::get('/aturan/create', [AturanController::class, 'create'])->name('aturan.create');

use App\Http\Controllers\LiterasiController;

use App\Http\Controllers\FaqController;

use App\Http\Controllers\KeloladataController;
Route::post('/keloladata/indikator', [KeloladataController::class, 'indikator'])->name('indikator.store');
Route::post('/keloladata/bidang', [KeloladataController::class, 'Bidang'])->name('bidang.store');
Route::post('/keloladata/saspro', [KeloladataController::class, 'saspro'])->name('saspro.store');
Route::post('/keloladata/storeOrUpdateBidang', [KelolaDataController::class, 'storeOrUpdateBidang'])->name('bidang.storeOrUpdateBidang');
// Route::get('/keloladata', [KelolaDataController::class, 'search'])->name('keloladata');
Route::get('/keloladata/edit/{id}', [KelolaDataController::class, 'edit'])->name('bidang.edit');
Route::delete('/keloladata/destroy/{id}', [KelolaDataController::class, 'destroy'])->name('bidang.destroy');
// Route::delete('/saspro/{id}', [KelolaDataController::class, 'destroySaspro'])->name('saspro.destroy');
// Route::put('/saspro/{id}', [KeloladataController::class, 'sasproUpdate'])->name('saspro.update');
// Route::put('/keloladata/{id}', [KeloladataController::class, 'sasproUpdate'])->name('saspro.update');
Route::post('/keloladata/update/{id}', [KeloladataController::class, 'sasproUpdate'])->name('saspro.update');
Route::delete('/keloladata/delete/{id}', [KeloladataController::class, 'destroySaspro'])->name('saspro.destroy');
Route::post('/indikator/store', [KelolaDataController::class, 'storeIndikator'])->name('indikator.store');
Route::get('/kelola-data', [KelolaDataController::class, 'index'])->name('kelola_data.index');
Route::post('/indikator/delete/{id}', [KelolaDataController::class, 'deleteIndikator'])->name('indikator.delete');
Route::post('/indikator/update/{id}', [KelolaDataController::class, 'updateIndikator'])->name('indikator.update');


use App\Http\Controllers\UbahpasswordController;
Route::put('/password/update', [UbahpasswordController::class, 'updatePassword'])->name('password.update');

// Handle Auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kep', [KepController::class, 'index'])->name('kep');
    Route::get('/perencanaan', [PerencanaanController::class, 'index'])->name('perencanaan');
    Route::get('/pengukuran', [PengukuranController::class, 'index'])->name('pengukuran');
    Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi');
    Route::get('/sakipwil', [SakipwilController::class, 'index'])->name('sakipwil');
    Route::get('/sakipvalidasi', [SakipvalidasiController::class, 'index'])->name('sakipvalidasi');
    Route::get('/kepatuhan', [KepatuhanController::class, 'index'])->name('kepatuhan');
    Route::get('/chatsupport', [ChatsupportController::class, 'index'])->name('chatsupport');
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/aturan', [AturanController::class, 'index'])->name('aturan');
    Route::get('/literasi', [LiterasiController::class, 'index'])->name('literasi');
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/keloladata', [KeloladataController::class, 'index'])->name('keloladata');
    Route::get('/ubahpassword', [UbahpasswordController::class, 'index'])->name('ubahpassword');
    Route::post('/upload-dipa', [PerencanaanController::class, 'uploadDipa'])->name('upload.dipa');
});

// Handle file upload menu keputusan
// use App\Http\Controllers\FileUploadController;
// Route::get('/keputusan', [FileUploadController::class, 'index'])->name('keputusan');
// Route::post('/upload-file', [FileUploadController::class, 'upload'])->name('upload.file');

// Handle file upload menu Renstra
// use App\Http\Controllers\RenstraController;
// Route::get('/kelola.perencanaan', [RenstraController::class, 'index'])->name('kelola.perencanaan');

// Route::post('/upload-renstra', [RenstraController::class, 'uploadRenstra'])->name('upload.renstra');

