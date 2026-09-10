@extends('layouts.app')

@section('title', 'Backup File Dokumen Berdasarkan Kejati & Tahun (Admin)')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <div class="card border-light shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold"><i class="fas fa-download me-2"></i> Backup File Dokumen Berdasarkan Wilayah Kejati</h3>
                <span class="badge bg-warning text-dark px-3 py-2 fs-6"><i class="fas fa-user-shield me-1"></i> Khusus Admin</span>
            </div>
            <div class="card-body p-4">
                
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="alert alert-info border-start border-4 border-info shadow-sm mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
                        <div>
                            <h5 class="fw-bold mb-1">Mekanisme Backup File Dokumen per Wilayah Kejati</h5>
                            <p class="mb-0">Fitur ini mengumpulkan seluruh file fisik dokumen (PDF Renstra, Renja, IKU, RKAKL, DIPA, PK, LKJiP, LHE, KEP, dll.) yang terdaftar pada Satker di wilayah Kejati terpilih. Anda dapat menyalinnya ke folder server/komputer (default: <code>E:\backup\{id_satker}\</code>) via **Background Batch Processing** anti-timeout (30 detik limit safe) atau mengunduhnya langsung sebagai arsip **ZIP** ke komputer Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Column Left: Filter -->
                    <div class="col-md-5 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-dark text-white fw-bold">
                                <i class="fas fa-filter me-2"></i> Filter Kejati, Tahun & Folder Tujuan
                            </div>
                            <div class="card-body">
                                <form id="formBackupFilter" method="POST" action="{{ route('backuptahun.preview') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="cakupan" class="form-label fw-bold">Cakupan Wilayah:</label>
                                        <select name="cakupan" id="cakupan" class="form-select">
                                            <option value="kejati" {{ (isset($cakupan) && $cakupan == 'kejati') ? 'selected' : '' }}>
                                                Berdasarkan Wilayah Kejati (Rekomendasi)
                                            </option>
                                            <option value="satker" {{ (isset($cakupan) && $cakupan == 'satker') ? 'selected' : '' }}>
                                                Satker Spesifik (ID Satker)
                                            </option>
                                            <option value="semua" {{ (isset($cakupan) && $cakupan == 'semua') ? 'selected' : '' }}>
                                                Seluruh Kejati & Satker (Global)
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Dropdown Pilihan Kejati -->
                                    <div class="mb-3" id="wrapperKejati" style="display: {{ (!isset($cakupan) || $cakupan == 'kejati') ? 'block' : 'none' }};">
                                        <label for="id_kejati" class="form-label fw-bold">Pilih Wilayah Kejati:</label>
                                        <select name="id_kejati" id="id_kejati" class="form-select form-select-lg">
                                            <option value="">-- Pilih Wilayah Kejati --</option>
                                            @foreach ($kejatiList as $kej)
                                                <option value="{{ $kej->id_kejati }}" {{ (isset($idKejati) && $idKejati == $kej->id_kejati) ? 'selected' : '' }}>
                                                    [{{ $kej->id_kejati }}] {{ $kej->kejati_nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text small">Mencakup seluruh Satker Kejari & Cabjari di bawah wilayah Kejati ini.</div>
                                    </div>

                                    <!-- Input Satker Spesifik -->
                                    <div class="mb-3" id="wrapperSatker" style="display: {{ (isset($cakupan) && $cakupan == 'satker') ? 'block' : 'none' }};">
                                        <label for="id_satker_target" class="form-label fw-bold">Masukkan ID Satker Spesifik:</label>
                                        <input type="text" class="form-control" name="id_satker_target" id="id_satker_target" value="{{ $idSatkerTarget ?? session('id_satker') }}" placeholder="Contoh: 006050">
                                    </div>

                                    <div class="mb-3">
                                        <label for="tahun_backup" class="form-label fw-bold">Pilih Tahun Data:</label>
                                        <select name="tahun_backup" id="tahun_backup" class="form-select">
                                            <option value="semua" {{ (isset($tahunSelected) && $tahunSelected == 'semua') ? 'selected' : '' }}>
                                                -- Semua Tahun (Keseluruhan File) --
                                            </option>
                                            @for ($i = date('Y'); $i >= 2020; $i--)
                                                <option value="{{ $i }}" {{ (isset($tahunSelected) && $tahunSelected == $i) ? 'selected' : '' }}>
                                                    Tahun {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Path Folder Tujuan Backup -->
                                    <div class="mb-3">
                                        <label for="target_path" class="form-label fw-bold">Path Folder Tujuan Backup (Server/Lokal):</label>
                                        <input type="text" class="form-control font-monospace" name="target_path" id="target_path" value="{{ $targetPath ?? 'E:\\backup' }}" placeholder="E:\backup">
                                        <div class="form-text small">
                                            File akan disimpan dalam struktur: <code>{Folder}\{kode_satker}\{nama_file}</code> sehingga langsung kompatibel jika ingin di-restore di masa mendatang.
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="button" id="btnPreviewBackup" class="btn btn-info text-white fw-bold">
                                            <i class="fas fa-search me-1"></i> Hitung & Preview File Terdeteksi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Column Right: Summary Status -->
                    <div class="col-md-7 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-secondary text-white fw-bold d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-chart-pie me-2"></i> Ringkasan File Siap Backup</span>
                                <span class="badge bg-light text-dark" id="badgeTahunLabel">Tahun: {{ $tahunSelected }}</span>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <div class="row text-center my-2">
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded border shadow-sm">
                                                <h6 class="text-muted mb-1 small">Total Satker</h6>
                                                <h3 class="fw-bold text-primary mb-0" id="statTotalSatkers">
                                                    {{ $summary['total_satkers'] ?? 0 }}
                                                </h3>
                                                <small class="text-muted">satker terpilih</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded border shadow-sm">
                                                <h6 class="text-muted mb-1 small">File Terdeteksi</h6>
                                                <h3 class="fw-bold text-success mb-0" id="statFoundServer">
                                                    {{ $summary['found_server_count'] ?? 0 }}
                                                </h3>
                                                <small class="text-muted" id="statSizeLabel">{{ $summary['formatted_size'] ?? '0 B' }}</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded border shadow-sm">
                                                <h6 class="text-muted mb-1 small">Ada di Target Backup</h6>
                                                <h3 class="fw-bold text-info mb-0" id="statAlreadyBackup">
                                                    {{ $summary['already_in_backup_count'] ?? 0 }}
                                                </h3>
                                                <small class="text-muted">sudah dicadangkan</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Detail List File -->
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="fw-bold text-dark mb-0">
                                                <i class="fas fa-list text-primary me-1"></i> Daftar File yang Akan Di-backup:
                                                <span class="badge bg-primary ms-1" id="badgeFileCount">{{ !empty($summary['sample_files']) ? count($summary['sample_files']) : 0 }} File</span>
                                            </h6>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" id="btnToggleExpandList" title="Perbesar / Perkecil Tampilan List">
                                                <i class="fas fa-expand-alt me-1"></i> <span id="textToggleExpand">Perbesar</span>
                                            </button>
                                        </div>

                                        <!-- Quick Search Filter -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                            <input type="text" id="filterFileSearch" class="form-control border-start-0 ps-0" placeholder="Ketik untuk mencari nama file atau ID satker...">
                                            <button class="btn btn-outline-secondary" type="button" id="btnClearSearchFile" title="Bersihkan pencarian"><i class="fas fa-times"></i></button>
                                        </div>

                                        <div class="border rounded p-2 bg-light shadow-sm" style="min-height: 250px; max-height: 450px; overflow-y: auto; transition: max-height 0.3s ease;" id="boxFileList">
                                            @if(!empty($summary['sample_files']) && count($summary['sample_files']) > 0)
                                                <ul class="list-unstyled mb-0 small" id="listBackupFilesUl">
                                                    @foreach($summary['sample_files'] as $f)
                                                        <li class="py-2 px-2 border-bottom d-flex justify-content-between align-items-center backup-file-item" data-search="{{ strtolower($f['filename']) }} {{ strtolower($f['satker']) }}">
                                                            <span class="text-truncate me-2" title="{{ $f['filename'] }}">
                                                                <i class="fas fa-file-pdf text-danger me-1"></i> <strong>{{ $f['filename'] }}</strong>
                                                                @if($f['size'] !== '-')
                                                                    <span class="text-muted">({{ $f['size'] }})</span>
                                                                @endif
                                                            </span>
                                                            <div class="flex-shrink-0">
                                                                <span class="badge bg-secondary me-1">Satker: {{ $f['satker'] }}</span>
                                                                @if($f['in_server'])
                                                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i> Siap</span>
                                                                @else
                                                                    <span class="badge bg-warning text-dark"><i class="fas fa-exclamation-triangle me-1"></i> Fisik Tidak Ada</span>
                                                                @endif
                                                                @if($f['in_target'])
                                                                    <span class="badge bg-info text-dark ms-1"><i class="fas fa-hdd me-1"></i> Ada di Target</span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <div class="text-center text-muted py-4 small" id="emptyFileListMsg">
                                                    <i class="fas fa-folder-open text-secondary fa-2x mb-2 d-block"></i>
                                                    Tidak ada file dokumen terdeteksi untuk filter yang dipilih.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-4 pt-2 border-top">
                                    <div class="row g-2">
                                        <div class="col-md-7">
                                            <button type="button" class="btn btn-primary btn-lg w-100 fw-bold" id="btnTriggerBatchBackup">
                                                <i class="fas fa-hdd me-2"></i> Simpan Backup ke Folder Lokal (Background Batch)
                                            </button>
                                        </div>
                                        <div class="col-md-5">
                                            <button type="button" class="btn btn-success btn-lg w-100 fw-bold" id="btnTriggerDownloadZip">
                                                <i class="fas fa-file-archive me-2"></i> Download ZIP
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Progress Backup Folder Background -->
<div class="modal fade" id="backupProgressModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="backupProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="backupProgressModalLabel">
                    <i class="fas fa-hdd fa-spin me-2"></i> Memproses Backup ke Folder Tujuan...
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="btnCloseBackupModal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="fw-bold mb-1" id="backupStatusText">Menyiapkan Batch Satker...</h5>
                <p class="text-muted small mb-3" id="backupSubText">Mohon tunggu, menyalin file fisik ke folder tujuan backup...</p>

                <div class="progress mb-3" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary fw-bold fs-6" id="backupProgressBar" style="width: 0%;">0%</div>
                </div>

                <div class="p-3 bg-light rounded border text-start small">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Status Batch Satker:</span>
                        <strong id="backupStatBatch">0 / 0 Batch</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Total File Berhasil Disalin:</span>
                        <strong class="text-success" id="backupStatFiles">0 File</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Total Ukuran Data Tersalin:</span>
                        <strong class="text-primary" id="backupStatBytes">0 B</strong>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>

<!-- Modal Progress Pembuatan ZIP (Anti-Timeout) -->
<div class="modal fade" id="zipProgressModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="zipProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold" id="zipProgressModalLabel">
                    <i class="fas fa-file-archive me-2"></i> Mempersiapkan File ZIP Backup...
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="btnCloseZipModal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="spinner-border text-success mb-3" id="zipSpinner" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="fw-bold mb-1" id="zipStatusText">Menyiapkan Arsip ZIP...</h5>
                <p class="text-muted small mb-3" id="zipSubText">Memproses file secara berkala (Batch Anti-Timeout) agar koneksi server tidak terputus...</p>

                <div class="progress mb-3" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success fw-bold fs-6" id="zipProgressBar" style="width: 0%;">0%</div>
                </div>

                <div class="p-3 bg-light rounded border text-start small mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Status Batch Satker:</span>
                        <strong id="zipStatBatch">0 / 0 Batch</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Total File Masuk ZIP:</span>
                        <strong class="text-success" id="zipStatFiles">0 File</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Total Ukuran Terkompresi:</span>
                        <strong class="text-primary" id="zipStatBytes">0 B</strong>
                    </div>
                </div>

                <div id="zipDownloadReadyBox" style="display: none;">
                    <a href="#" id="btnManualDownloadZip" class="btn btn-success fw-bold w-100 py-2 shadow-sm">
                        <i class="fas fa-download me-2"></i> Unduh File ZIP Sekarang
                    </a>
                    <div class="form-text small mt-2 text-muted">
                        Jika unduhan tidak berjalan otomatis dalam beberapa detik, silakan klik tombol di atas.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Form for Direct ZIP Download (Fallback) -->
<form id="formDownloadZipDirect" method="GET" action="{{ route('backuptahun.downloadZip') }}" style="display: none;">
    <input type="hidden" name="tahun_backup" id="zip_param_tahun">
    <input type="hidden" name="cakupan" id="zip_param_cakupan">
    <input type="hidden" name="id_kejati" id="zip_param_id_kejati">
    <input type="hidden" name="id_satker_target" id="zip_param_id_satker">
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const selectCakupan = document.getElementById('cakupan');
    const wrapperKejati = document.getElementById('wrapperKejati');
    const wrapperSatker = document.getElementById('wrapperSatker');
    const selectTahun = document.getElementById('tahun_backup');
    const selectKejati = document.getElementById('id_kejati');
    const inputSatker = document.getElementById('id_satker_target');
    const inputTargetPath = document.getElementById('target_path');
    const btnPreviewBackup = document.getElementById('btnPreviewBackup');

    const statTotalSatkers = document.getElementById('statTotalSatkers');
    const statFoundServer = document.getElementById('statFoundServer');
    const statAlreadyBackup = document.getElementById('statAlreadyBackup');
    const statSizeLabel = document.getElementById('statSizeLabel');
    const badgeTahunLabel = document.getElementById('badgeTahunLabel');
    const badgeFileCount = document.getElementById('badgeFileCount');
    const boxFileList = document.getElementById('boxFileList');

    const btnTriggerBatchBackup = document.getElementById('btnTriggerBatchBackup');
    const btnTriggerDownloadZip = document.getElementById('btnTriggerDownloadZip');

    const backupModalEl = document.getElementById('backupProgressModal');
    const backupModal = new bootstrap.Modal(backupModalEl);
    const btnCloseBackupModal = document.getElementById('btnCloseBackupModal');
    const backupStatusText = document.getElementById('backupStatusText');
    const backupSubText = document.getElementById('backupSubText');
    const backupProgressBar = document.getElementById('backupProgressBar');
    const backupStatBatch = document.getElementById('backupStatBatch');
    const backupStatFiles = document.getElementById('backupStatFiles');
    const backupStatBytes = document.getElementById('backupStatBytes');

    const zipModalEl = document.getElementById('zipProgressModal');
    const zipModal = new bootstrap.Modal(zipModalEl);
    const btnCloseZipModal = document.getElementById('btnCloseZipModal');
    const zipStatusText = document.getElementById('zipStatusText');
    const zipSubText = document.getElementById('zipSubText');
    const zipProgressBar = document.getElementById('zipProgressBar');
    const zipStatBatch = document.getElementById('zipStatBatch');
    const zipStatFiles = document.getElementById('zipStatFiles');
    const zipStatBytes = document.getElementById('zipStatBytes');
    const zipDownloadReadyBox = document.getElementById('zipDownloadReadyBox');
    const btnManualDownloadZip = document.getElementById('btnManualDownloadZip');
    const zipSpinner = document.getElementById('zipSpinner');

    const filterFileSearch = document.getElementById('filterFileSearch');
    const btnClearSearchFile = document.getElementById('btnClearSearchFile');
    const btnToggleExpandList = document.getElementById('btnToggleExpandList');
    const textToggleExpand = document.getElementById('textToggleExpand');

    function toggleCakupanFields() {
        const val = selectCakupan.value;
        wrapperKejati.style.display = (val === 'kejati') ? 'block' : 'none';
        wrapperSatker.style.display = (val === 'satker') ? 'block' : 'none';
    }

    selectCakupan.addEventListener('change', toggleCakupanFields);

    // Live search filter across backup files list
    if (filterFileSearch) {
        filterFileSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.backup-file-item');
            items.forEach(el => {
                const text = el.getAttribute('data-search') || el.textContent.toLowerCase();
                if (text.includes(query)) {
                    el.style.setProperty('display', 'flex', 'important');
                } else {
                    el.style.setProperty('display', 'none', 'important');
                }
            });
        });
    }

    if (btnClearSearchFile) {
        btnClearSearchFile.addEventListener('click', function() {
            if (filterFileSearch) {
                filterFileSearch.value = '';
                document.querySelectorAll('.backup-file-item').forEach(el => {
                    el.style.setProperty('display', 'flex', 'important');
                });
            }
        });
    }

    // Toggle expand height of file preview box
    let isExpanded = false;
    if (btnToggleExpandList && boxFileList) {
        btnToggleExpandList.addEventListener('click', function() {
            isExpanded = !isExpanded;
            if (isExpanded) {
                boxFileList.style.maxHeight = '800px';
                textToggleExpand.textContent = 'Perkecil';
                this.classList.replace('btn-outline-secondary', 'btn-secondary');
            } else {
                boxFileList.style.maxHeight = '450px';
                textToggleExpand.textContent = 'Perbesar';
                this.classList.replace('btn-secondary', 'btn-outline-secondary');
            }
        });
    }

    // Function to render file list
    function renderFileList(files) {
        if (!files || files.length === 0) {
            boxFileList.innerHTML = `
                <div class="text-center text-muted py-4 small" id="emptyFileListMsg">
                    <i class="fas fa-folder-open text-secondary fa-2x mb-2 d-block"></i>
                    Tidak ada file dokumen terdeteksi untuk filter yang dipilih.
                </div>`;
            badgeFileCount.textContent = '0 File';
            return;
        }

        badgeFileCount.textContent = files.length + ' File';
        let html = '<ul class="list-unstyled mb-0 small" id="listBackupFilesUl">';
        files.forEach(f => {
            const searchData = (f.filename + ' ' + f.satker).toLowerCase();
            const inServerBadge = f.in_server 
                ? '<span class="badge bg-success"><i class="fas fa-check me-1"></i> Siap</span>'
                : '<span class="badge bg-warning text-dark"><i class="fas fa-exclamation-triangle me-1"></i> Fisik Tidak Ada</span>';
            const inTargetBadge = f.in_target 
                ? '<span class="badge bg-info text-dark ms-1"><i class="fas fa-hdd me-1"></i> Ada di Target</span>'
                : '';

            html += `
                <li class="py-2 px-2 border-bottom d-flex justify-content-between align-items-center backup-file-item" data-search="${searchData}">
                    <span class="text-truncate me-2" title="${f.filename}">
                        <i class="fas fa-file-pdf text-danger me-1"></i> <strong>${f.filename}</strong>
                        ${f.size !== '-' ? `<span class="text-muted">(${f.size})</span>` : ''}
                    </span>
                    <div class="flex-shrink-0">
                        <span class="badge bg-secondary me-1">Satker: ${f.satker}</span>
                        ${inServerBadge}
                        ${inTargetBadge}
                    </div>
                </li>`;
        });
        html += '</ul>';
        boxFileList.innerHTML = html;
    }

    // Preview Button AJAX
    btnPreviewBackup.addEventListener('click', function() {
        const cakupan = selectCakupan.value;
        const idKejati = selectKejati.value;
        const idSatker = inputSatker.value.trim();
        const tahun = selectTahun.value;
        const targetPath = inputTargetPath.value.trim();

        if (cakupan === 'kejati' && !idKejati) {
            alert('Silakan pilih Wilayah Kejati terlebih dahulu.');
            return;
        }
        if (cakupan === 'satker' && !idSatker) {
            alert('Silakan masukkan ID Satker spesifik.');
            return;
        }

        btnPreviewBackup.disabled = true;
        btnPreviewBackup.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menghitung File...';

        fetch("{{ route('backuptahun.preview') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                tahun_backup: tahun,
                cakupan: cakupan,
                id_kejati: idKejati,
                id_satker_target: idSatker,
                target_path: targetPath
            })
        })
        .then(res => res.json())
        .then(data => {
            btnPreviewBackup.disabled = false;
            btnPreviewBackup.innerHTML = '<i class="fas fa-search me-1"></i> Hitung & Preview File Terdeteksi';

            if (data.success && data.summary) {
                const s = data.summary;
                statTotalSatkers.textContent = s.total_satkers;
                statFoundServer.textContent = s.found_server_count;
                statAlreadyBackup.textContent = s.already_in_backup_count;
                statSizeLabel.textContent = s.formatted_size;
                badgeTahunLabel.textContent = 'Tahun: ' + data.tahun;

                renderFileList(s.sample_files);
            } else {
                alert('Gagal mengambil data preview: ' + (data.message || 'Terjadi kesalahan.'));
            }
        })
        .catch(err => {
            btnPreviewBackup.disabled = false;
            btnPreviewBackup.innerHTML = '<i class="fas fa-search me-1"></i> Hitung & Preview File Terdeteksi';
            console.error(err);
            alert('Terjadi kesalahan jaringan saat memuat preview data backup.');
        });
    });

    // Jalankan Backup ke Folder Lokal (Background Batch Processing)
    btnTriggerBatchBackup.addEventListener('click', function() {
        const cakupan = selectCakupan.value;
        const idKejati = selectKejati.value;
        const idSatker = inputSatker.value.trim();
        const tahun = selectTahun.value;
        const targetPath = inputTargetPath.value.trim() || 'E:\\backup';

        if (cakupan === 'kejati' && !idKejati) {
            alert('Silakan pilih Wilayah Kejati terlebih dahulu sebelum menjalankan backup.');
            return;
        }
        if (cakupan === 'satker' && !idSatker) {
            alert('Silakan masukkan ID Satker spesifik.');
            return;
        }

        const confirmMsg = `Mulai proses backup seluruh file ke folder:\n"${targetPath}"\n\nProses dijalankan secara background batch anti-timeout. Lanjutkan?`;
        if (!confirm(confirmMsg)) {
            return;
        }

        // Tampilkan Modal Progress
        btnCloseBackupModal.style.display = 'none';
        backupStatusText.textContent = 'Mengambil daftar Satker...';
        backupSubText.textContent = 'Menyiapkan batch antrian pemrosesan backup...';
        backupProgressBar.style.width = '0%';
        backupProgressBar.textContent = '0%';
        backupStatBatch.textContent = '0 / 0 Batch';
        backupStatFiles.textContent = '0 File';
        backupStatBytes.textContent = '0 B';

        backupModal.show();

        // 1. Ambil daftar Batch Satker
        fetch("{{ route('backuptahun.batches') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                tahun_backup: tahun,
                cakupan: cakupan,
                id_kejati: idKejati,
                id_satker_target: idSatker,
                target_path: targetPath
            })
        })
        .then(res => res.json())
        .then(async batchData => {
            if (!batchData.success || !batchData.batches || batchData.batches.length === 0) {
                backupStatusText.textContent = 'Tidak Ada Satker Terpilih';
                backupSubText.textContent = 'Tidak ditemukan Satker yang cocok dengan filter yang dipilih.';
                btnCloseBackupModal.style.display = 'block';
                return;
            }

            const batches = batchData.batches;
            const totalBatches = batches.length;
            let currentBatchIdx = 0;
            let totalCopiedFiles = 0;
            let totalCopiedBytes = 0;

            function formatBytesJs(bytes) {
                if (bytes === 0) return '0 B';
                const k = 1024;
                const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Loop batch secara berurutan
            for (let i = 0; i < totalBatches; i++) {
                currentBatchIdx = i + 1;
                const percent = Math.round(((currentBatchIdx - 1) / totalBatches) * 100);

                backupStatusText.textContent = `Memproses Batch ${currentBatchIdx} dari ${totalBatches}...`;
                backupSubText.textContent = `Menyalin file fisik dari ${batches[i].length} satker ke [${targetPath}]...`;
                backupProgressBar.style.width = percent + '%';
                backupProgressBar.textContent = percent + '%';
                backupStatBatch.textContent = `${currentBatchIdx - 1} / ${totalBatches} Batch Selesai`;

                try {
                    const batchRes = await fetch("{{ route('backuptahun.processBatch') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            tahun_backup: tahun,
                            satker_ids: batches[i],
                            target_path: targetPath
                        })
                    });

                    const resJson = await batchRes.json();
                    if (resJson.success) {
                        totalCopiedFiles += (resJson.files_copied || 0);
                        totalCopiedBytes += (resJson.bytes_copied || 0);
                        backupStatFiles.textContent = `${totalCopiedFiles} File`;
                        backupStatBytes.textContent = formatBytesJs(totalCopiedBytes);
                    } else {
                        console.warn('Peringatan Batch:', resJson.message);
                    }
                } catch (batchErr) {
                    console.error('Error saat proses batch ' + currentBatchIdx, batchErr);
                }
            }

            // Selesai Seluruh Batch
            backupProgressBar.style.width = '100%';
            backupProgressBar.textContent = '100%';
            backupProgressBar.classList.replace('bg-primary', 'bg-success');
            backupStatBatch.textContent = `${totalBatches} / ${totalBatches} Batch Selesai`;
            backupStatusText.textContent = 'Proses Backup Selesai!';
            backupSubText.textContent = `Berhasil mencadangkan ${totalCopiedFiles} file (${formatBytesJs(totalCopiedBytes)}) ke folder [${targetPath}].`;
            btnCloseBackupModal.style.display = 'block';

            // Refresh preview
            btnPreviewBackup.click();
        })
        .catch(err => {
            console.error(err);
            backupStatusText.textContent = 'Terjadi Kesalahan!';
            backupSubText.textContent = 'Gagal memproses batch: ' + (err.message || 'Koneksi terputus');
            btnCloseBackupModal.style.display = 'block';
        });
    });

    // Download Backup sebagai File ZIP (Anti-Timeout 504 via Batch Processing)
    btnTriggerDownloadZip.addEventListener('click', function() {
        const cakupan = selectCakupan.value;
        const idKejati = selectKejati.value;
        const idSatker = inputSatker.value.trim();
        const tahun = selectTahun.value;

        if (cakupan === 'kejati' && !idKejati) {
            alert('Silakan pilih Wilayah Kejati terlebih dahulu sebelum mengunduh ZIP.');
            return;
        }
        if (cakupan === 'satker' && !idSatker) {
            alert('Silakan masukkan ID Satker spesifik.');
            return;
        }

        if (!confirm(`Mulai proses pengunduhan seluruh file dokumen dalam bentuk arsip ZIP?\n\nFile akan dirangkai secara bertahap (Anti-Timeout) sebelum otomatis diunduh ke komputer Anda.`)) {
            return;
        }

        // Tampilkan Modal Pembuatan ZIP
        btnCloseZipModal.style.display = 'none';
        zipDownloadReadyBox.style.display = 'none';
        zipSpinner.style.display = 'inline-block';
        zipStatusText.textContent = 'Menginisialisasi File ZIP...';
        zipSubText.textContent = 'Menyiapkan arsip ZIP dan daftar batch satker di server...';
        zipProgressBar.style.width = '0%';
        zipProgressBar.textContent = '0%';
        zipProgressBar.classList.remove('bg-danger');
        zipProgressBar.classList.add('bg-success');
        zipStatBatch.textContent = '0 / 0 Batch';
        zipStatFiles.textContent = '0 File';
        zipStatBytes.textContent = '0 B';

        zipModal.show();

        fetch("{{ route('backuptahun.initZip') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                tahun_backup: tahun,
                cakupan: cakupan,
                id_kejati: idKejati,
                id_satker_target: idSatker
            })
        })
        .then(res => res.json())
        .then(async data => {
            if (!data.success || !data.batches || data.batches.length === 0) {
                zipStatusText.textContent = 'Gagal Inisialisasi';
                zipSubText.textContent = data.message || 'Tidak ada Satker terpilih untuk diproses.';
                zipSpinner.style.display = 'none';
                btnCloseZipModal.style.display = 'block';
                return;
            }

            const batches = data.batches;
            const totalBatches = batches.length;
            const zipToken = data.zip_token;
            let currentBatchIdx = 0;
            let totalZippedFiles = 0;
            let totalZippedBytes = 0;

            function formatBytesJs(bytes) {
                if (bytes === 0) return '0 B';
                const k = 1024;
                const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            for (let i = 0; i < totalBatches; i++) {
                currentBatchIdx = i + 1;
                const percent = Math.round(((currentBatchIdx - 1) / totalBatches) * 100);

                zipStatusText.textContent = `Mengompresi Batch ${currentBatchIdx} dari ${totalBatches}...`;
                zipSubText.textContent = `Menambahkan file dari ${batches[i].length} Satker ke arsip ZIP...`;
                zipProgressBar.style.width = percent + '%';
                zipProgressBar.textContent = percent + '%';
                zipStatBatch.textContent = `${currentBatchIdx - 1} / ${totalBatches} Batch Selesai`;

                try {
                    const batchRes = await fetch("{{ route('backuptahun.addZipBatch') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            zip_token: zipToken,
                            tahun_backup: tahun,
                            satker_ids: batches[i]
                        })
                    });

                    const resJson = await batchRes.json();
                    if (resJson.success) {
                        totalZippedFiles += (resJson.files_added || 0);
                        totalZippedBytes += (resJson.bytes_added || 0);
                        zipStatFiles.textContent = `${totalZippedFiles} File`;
                        zipStatBytes.textContent = formatBytesJs(totalZippedBytes);
                    } else {
                        console.warn('Peringatan Batch ZIP:', resJson.message);
                    }
                } catch (batchErr) {
                    console.error('Error saat proses batch ZIP ' + currentBatchIdx, batchErr);
                }
            }

            // Selesai Kompresi
            zipProgressBar.style.width = '100%';
            zipProgressBar.textContent = '100%';
            zipStatBatch.textContent = `${totalBatches} / ${totalBatches} Batch Selesai`;
            zipSpinner.style.display = 'none';

            const downloadUrl = `{{ route('backuptahun.downloadZipReady') }}?token=${encodeURIComponent(zipToken)}`;
            btnManualDownloadZip.href = downloadUrl;
            zipDownloadReadyBox.style.display = 'block';
            btnCloseZipModal.style.display = 'block';

            if (totalZippedFiles === 0) {
                zipStatusText.textContent = 'Tidak Ada File Ditemukan';
                zipSubText.textContent = 'Tidak ditemukan file dokumen fisik yang cocok dengan filter.';
            } else {
                zipStatusText.textContent = 'Arsip ZIP Siap Diunduh!';
                zipSubText.textContent = `Berhasil mengemas ${totalZippedFiles} file (${formatBytesJs(totalZippedBytes)}). Memulai download ke browser...`;

                // Trigger direct browser download
                window.location.href = downloadUrl;
            }
        })
        .catch(err => {
            console.error(err);
            zipSpinner.style.display = 'none';
            zipStatusText.textContent = 'Terjadi Kesalahan!';
            zipSubText.textContent = 'Gagal memproses pembuatan ZIP: ' + (err.message || 'Koneksi terputus');
            zipProgressBar.classList.replace('bg-success', 'bg-danger');
            btnCloseZipModal.style.display = 'block';
        });
    });

});
</script>
@endsection
