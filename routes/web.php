<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KepController;
use App\Http\Controllers\SakipvalidasiController;
use App\Http\Controllers\SakipwilController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\PengukuranController;
use App\Http\Controllers\KepatuhanController;
use App\Http\Controllers\ChatsupportController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AturanController;
use App\Http\Controllers\LiterasiController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\KeloladataController;
use App\Http\Controllers\UbahpasswordController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DataLke;

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/', function () {
//     return redirect()->away('https://sicana.kejaksaan.go.id/');
// });

// Handle login
Route::get('/login-auto', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login-auto', [LoginController::class, 'login']);


// Handle Logout
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


//Authentikasi Middleware
Route::middleware(['auth'])->group(function () {
//Handle Pilih Tahun
// use App\Http\Controllers\YearSelectionController;
// Route::get('/select-year', [YearSelectionController::class, 'index'])->name('select.year');
// Route::post('/select-year', [YearSelectionController::class, 'store'])->name('store.year');
// Handle pemilihan tahun
Route::get('/pilih-tahun', [TahunController::class, 'showTahunForm'])->name('pilih.tahun');
// Route untuk menangani pemilihan tahun
Route::post('/pilih2-tahun', [TahunController::class, 'setTahun'])->name('set.tahun');

Route::post('/pilih-tahun', [TahunController::class, 'pilihTahun'])->name('pilih_tahun');
// Route untuk dashboard, data berdasarkan tahun yang dipilih
// Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::post('/set-bulan', [TahunController::class, 'setBulan'])->name('set.bulan');

Route::post('kep', [KepController::class, 'store'])->name('kep.store');

Route::post('/perencanaan/upload-renstra', [PerencanaanController::class, 'uploadRenstra'])->name('upload.renstra');
Route::post('/perencanaan/upload-iku', [PerencanaanController::class, 'uploadIku'])->name('upload.iku');
Route::post('/perencanaan/upload-renja', [PerencanaanController::class, 'uploadRenja'])->name('upload.renja');
Route::post('/perencanaan/upload-rkakl', [PerencanaanController::class, 'uploadRkakl'])->name('upload.rkakl');
// Route::post('/perencanaan/upload-dipa', [PerencanaanController::class, 'uploadDipa'])->name('upload.dipa');
Route::post('/perencanaan/upload-renaksi', [PerencanaanController::class, 'uploadRenaksi'])->name('upload.renaksi');

Route::get('/perencanaan/indikator', [PerencanaanController::class, 'showIndikator'])->name('perencanaan.indikator');
Route::post('/perencanaan/store', [PerencanaanController::class, 'store'])->name('perencanaan.store');
Route::post('/target/store', [PerencanaanController::class, 'storetarget'])->name('target.store');
Route::post('/upload-pk', [PerencanaanController::class, 'uploadPK'])->name('upload.pk');

Route::get('/pengukuran', [PengukuranController::class, 'index'])->name('pengukuran');
Route::get('/pengukuran/form/{id}', [PengukuranController::class, 'form'])->name('pengukuran.form');
Route::get('/pengukuran/indikator/{id_bidang}', [PengukuranController::class, 'getIndikatorByBidang'])->name('pengukuran.getIndikatorByBidang');
Route::get('/pengukuran/indikator-nama', [PengukuranController::class, 'getIndikatorNama'])->name('pengukuran.getIndikatorNama');
Route::get('/get-indikator/{id_bidang}', [PengukuranController::class, 'getIndikatorByBidang']);
// Route::get('/get-subindikator/{rumpun}', [PengukuranController::class, 'getSubIndikatorByRumpun']);
Route::get('/pengukuran/{id_bidang}/{sub_indikator}', [PengukuranController::class, 'getDataByBidangAndSubIndikator'])->name('pengukuran.getDataByBidangAndSubIndikator');
Route::get('/get-pengukuran/{indikator_id}', [PengukuranController::class, 'getPengukuran'])->name('pengukuran.getPengukuran');
Route::post('/simpan-pengukuran', [PengukuranController::class, 'store'])->name('pengukuran.store');
Route::post('/pengukuran/update-inline', [PengukuranController::class, 'updateInline'])->name('pengukuran.updateInline');
Route::post('/pengukuran/update-bulanan', [PengukuranController::class, 'updateBulanan'])->name('pengukuran.updateBulanan');
Route::get('/get-subindikator-by-id/{id}', [App\Http\Controllers\PengukuranController::class, 'getIndikatorNama']);

Route::post('/upload/lkjip', [PelaporanController::class, 'uploadLkjip'])->name('upload.lkjip');
Route::delete('/delete/lkjip/{id}', [PelaporanController::class, 'deleteLkjip'])->name('delete.lkjip');
Route::post('/upload/rapat-staff-eka', [PelaporanController::class, 'uploadRapatStaffEka'])->name('upload.rapat_staff_eka');
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan.index');
// Route::get('/get-subindikator/{rumpun}', [PelaporanController::class, 'getSubIndikatorByRumpun']);
Route::get('/get-subindikator/{rumpun}', [PelaporanController::class, 'getSubIndikator']); //milik pengukuran
// Route::get('/pengukuran/subindikator/{rumpun}', [App\Http\Controllers\PelaporanController::class, 'getSubIndikatorByRumpun']);
Route::get('/pelaporan/subindikator/{rumpun}', [PelaporanController::class, 'getSubIndikator2']);
Route::post('/pelaporan/simpan-keterangan', [PelaporanController::class, 'simpanKeterangan']);


Route::post('/upload/lhe-akip', [EvaluasiController::class, 'uploadLheAkip'])->name('upload.lhe_akip');
Route::post('/upload/tl-lhe-akip', [EvaluasiController::class, 'uploadTlLheAkip'])->name('upload.tl_lhe_akip');
Route::post('/upload/monev-renaksi', [EvaluasiController::class, 'uploadMonevRenaksi'])->name('upload.monev_renaksi');
Route::post('/dokumen/verifikasi', [EvaluasiController::class, 'verifikasi'])->name('verifikasi.dokumen');
Route::post('/dokumen/upload', [EvaluasiController::class, 'upload'])->name('upload.dokumen');

Route::get('/sakipwil/search', [SakipwilController::class, 'search'])->name('sakipwil.search');

Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::get('/pengumuman/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

Route::resource('aturan', AturanController::class);
Route::get('/aturan/create', [AturanController::class, 'create'])->name('aturan.create');

Route::post('/keloladata/indikator', [KeloladataController::class, 'indikator'])->name('indikator.store');
Route::post('/keloladata/bidang', [KeloladataController::class, 'Bidang'])->name('bidang.store');
Route::post('/keloladata/saspro', [KeloladataController::class, 'saspro'])->name('saspro.store');
Route::post('/keloladata/storeOrUpdateBidang', [KelolaDataController::class, 'storeOrUpdateBidang'])->name('bidang.storeOrUpdateBidang');
Route::get('/keloladata/edit/{id}', [KelolaDataController::class, 'edit'])->name('bidang.edit');
Route::delete('/keloladata/destroy/{id}', [KelolaDataController::class, 'destroy'])->name('bidang.destroy');
Route::post('/keloladata/update/{id}', [KeloladataController::class, 'sasproUpdate'])->name('saspro.update');
Route::delete('/keloladata/delete/{id}', [KeloladataController::class, 'destroySaspro'])->name('saspro.destroy');
Route::post('/indikator/store', [KelolaDataController::class, 'storeIndikator'])->name('indikator.store');
Route::get('/kelola-data', [KelolaDataController::class, 'index'])->name('kelola_data.index');
Route::post('/indikator/delete/{id}', [KelolaDataController::class, 'deleteIndikator'])->name('indikator.delete');
Route::post('/indikator/update/{id}', [KelolaDataController::class, 'updateIndikator'])->name('indikator.update');

Route::put('/password/update', [UbahpasswordController::class, 'updatePassword'])->name('password.update');

Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
Route::get('/monitoring/search-satker', [MonitoringController::class, 'searchSatker'])->name('monitoring.searchSatker');
Route::get('/monitoring/bidang/{idSatker}', [MonitoringController::class, 'getBidang'])->name('monitoring.getBidang');
Route::get('/monitoring/subindikator/{rumpun}/{id_satker}', [MonitoringController::class, 'getSubIndikator'])->name('monitoring.subindikator');
Route::get('/monitoring/subindikator2/{rumpun}', [MonitoringController::class, 'getSubIndikator2']);
Route::get('/monitoring/capaian-saspro-all', [MonitoringController::class, 'capaianSasproAll'])->name('capaian.saspro.all');
Route::get('/monitoring/capaian-saspro-per-kejati', [MonitoringController::class, 'capaianSasproPerKejati'])->name('capaian.saspro.perkejati');


// Handle Auth
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kep', [KepController::class, 'index'])->name('kep');
    Route::get('/perencanaan', [PerencanaanController::class, 'index'])->name('perencanaan');
    Route::get('/pengukuran', [PengukuranController::class, 'index'])->name('pengukuran');
    Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi');
    Route::get('/sakipwil', [SakipwilController::class, 'index'])->name('sakipwil');
    Route::get('/sakipvalidasi', [SakipvalidasiController::class, 'index'])->name('sakipvalidasi');
    // Route::get('/kepatuhan', [KepatuhanController::class, 'index'])->name('kepatuhan');
    Route::get('/chatsupport', [ChatsupportController::class, 'index'])->name('chatsupport');
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/aturan', [AturanController::class, 'index'])->name('aturan');
    Route::get('/literasi', [LiterasiController::class, 'index'])->name('literasi');
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/keloladata', [KeloladataController::class, 'index'])->name('keloladata');
    Route::get('/ubahpassword', [UbahpasswordController::class, 'index'])->name('ubahpassword');
    Route::post('/upload-dipa', [PerencanaanController::class, 'uploadDipa'])->name('upload.dipa');
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
    Route::get('/satker/search', [MonitoringController::class, 'searchSatker'])->name('satker.search');
    Route::get('/upload/bukti-dukung', [DataLke::class, 'showUploadForm'])->name('upload_buktidukung');
    Route::post('/upload/bukti-dukung', [DataLke::class, 'upload'])->name('upload.store');
    Route::get('/cekbdeval-lke/{kode}', [DataLke::class, 'cekBuktiDukung'])->name('cekbdeval_lke');
    Route::get('/upload/files/{id}', [DataLke::class, 'getUploadedFiles'])->name('upload.files');
});

// use App\Http\Controllers\Auth\SicanaController;
// Route::get('/receive_token', [SicanaController::class, 'receiveToken']);

// Handle file upload menu keputusan
// use App\Http\Controllers\FileUploadController;
// Route::get('/keputusan', [FileUploadController::class, 'index'])->name('keputusan');
// Route::post('/upload-file', [FileUploadController::class, 'upload'])->name('upload.file');


