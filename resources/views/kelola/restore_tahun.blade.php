@extends('layouts.app')

@section('title', 'Restore / Sync File Backup dari Komputer (E:\\backup) ke Server (Admin)')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <div class="card border-light shadow-sm mb-4">
            <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold"><i class="fas fa-sync-alt me-2"></i> Restore / Sync File Backup dari Folder Local (E:\backup)</h3>
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
                            <h5 class="fw-bold mb-1">Mekanisme Sync & Restore dari Folder Local (E:\backup)</h5>
                            <p class="mb-0">Fitur ini membaca data folder backup pada server/komputer di <code>E:\backup\{id_satker}\</code>. Sistem akan mencocokkan kode Satker dan nama file fisik dengan catatan database untuk Tahun & Kejati yang dipilih, lalu memindahkannya secara otomatis ke folder web application <code>uploads/repository/{id_satker}/</code> atau <code>uploads/KEP/</code> via **Background Batch Processing** anti-timeout.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Column Left: Filter -->
                    <div class="col-md-5 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-primary text-white fw-bold">
                                <i class="fas fa-filter me-2"></i> Filter Tahun, Kejati & Sumber Folder
                            </div>
                            <div class="card-body">
                                <form id="formCheckMissing" method="POST" action="{{ route('restoretahun.check') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="tahun_restore" class="form-label fw-bold">Pilih Tahun Target:</label>
                                        <select name="tahun_restore" id="tahun_restore" class="form-select form-select-lg">
                                            @for ($i = date('Y'); $i >= 2020; $i--)
                                                <option value="{{ $i }}" {{ (isset($tahunSelected) && $tahunSelected == $i) ? 'selected' : '' }}>
                                                    Tahun {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cakupan" class="form-label fw-bold">Cakupan Wilayah:</label>
                                        <select name="cakupan" id="cakupan" class="form-select">
                                            <option value="semua" {{ (isset($cakupan) && $cakupan == 'semua') ? 'selected' : '' }}>
                                                Seluruh Kejati & Satker (Global)
                                            </option>
                                            <option value="kejati" {{ (isset($cakupan) && $cakupan == 'kejati') ? 'selected' : '' }}>
                                                Berdasarkan Wilayah Kejati
                                            </option>
                                            <option value="satker" {{ (isset($cakupan) && $cakupan == 'satker') ? 'selected' : '' }}>
                                                Satker Spesifik (ID Satker)
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Dropdown Kejati -->
                                    <div class="mb-3" id="wrapperKejati" style="display: {{ (isset($cakupan) && $cakupan == 'kejati') ? 'block' : 'none' }};">
                                        <label for="id_kejati" class="form-label fw-bold">Pilih Wilayah Kejati:</label>
                                        <select name="id_kejati" id="id_kejati" class="form-select">
                                            <option value="">-- Pilih Wilayah Kejati --</option>
                                            @foreach ($kejatiList as $kej)
                                                <option value="{{ $kej->id_kejati }}" {{ (isset($idKejati) && $idKejati == $kej->id_kejati) ? 'selected' : '' }}>
                                                    [{{ $kej->id_kejati }}] {{ $kej->kejati_nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Input Satker Target -->
                                    <div class="mb-3" id="wrapperSatker" style="display: {{ (isset($cakupan) && $cakupan == 'satker') ? 'block' : 'none' }};">
                                        <label for="id_satker_target" class="form-label fw-bold">ID Satker Spesifik:</label>
                                        <input type="text" class="form-control" name="id_satker_target" id="id_satker_target" value="{{ $idSatkerTarget ?? session('id_satker') }}" placeholder="Contoh: 006050">
                                    </div>

                                    <!-- Path Folder Sumber Backup -->
                                    <div class="mb-3">
                                        <label for="source_path" class="form-label fw-bold">Path Folder Sumber Backup:</label>
                                        <input type="text" class="form-control font-monospace" name="source_path" id="source_path" value="{{ $sourcePath ?? 'E:\\backup' }}" placeholder="E:\backup">
                                        <div class="form-text small">Standard folder berisi subfolder Satker: <code>E:\backup\{kode_satker}\</code></div>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="button" id="btnCheckStatus" class="btn btn-info text-white fw-bold">
                                            <i class="fas fa-search me-1"></i> Periksa File di Database vs E:\backup
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Column Right: Summary Status -->
                    <div class="col-md-7 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-secondary text-white fw-bold">
                                <i class="fas fa-chart-pie me-2"></i> Status Ketersediaan File (Tahun <span id="textTahunHeader">{{ $tahunSelected }}</span>)
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <div class="row text-center my-2">
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded border shadow-sm">
                                                <h6 class="text-muted mb-1 small">Total File di DB</h6>
                                                <h3 class="fw-bold text-primary mb-0" id="countTotalExpected">
                                                    {{ $fileStatus['total_expected'] ?? 0 }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded border shadow-sm">
                                                <h6 class="text-muted mb-1 small">Ada di Web App</h6>
                                                <h3 class="fw-bold text-success mb-0" id="countExisting">
                                                    {{ $fileStatus['existing_count'] ?? 0 }}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="p-3 bg-light rounded border shadow-sm">
                                                <h6 class="text-muted mb-1 small">Siap Sync dari Backup</h6>
                                                <h3 class="fw-bold text-warning mb-0" id="countAvailableBackup">
                                                    {{ $fileStatus['available_in_backup_count'] ?? 0 }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Missing Files Preview List -->
                                    <div class="mt-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="fw-bold text-dark mb-0">
                                                <i class="fas fa-list text-primary me-1"></i> Status Detail File (Belum Ada vs Siap di Backup):
                                                <span class="badge bg-danger ms-1" id="badgeMissingCount">{{ !empty($fileStatus['missing_files']) ? count($fileStatus['missing_files']) : 0 }} File</span>
                                            </h6>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" id="btnToggleExpandList" title="Perbesar / Perkecil Tampilan List">
                                                <i class="fas fa-expand-alt me-1"></i> <span id="textToggleExpand">Perbesar</span>
                                            </button>
                                        </div>

                                        <!-- Quick Search Filter for Missing Files -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                            <input type="text" id="filterMissingSearch" class="form-control border-start-0 ps-0" placeholder="Ketik untuk mencari nama file atau kode satker di daftar ini...">
                                            <button class="btn btn-outline-secondary" type="button" id="btnClearSearchMissing" title="Bersihkan pencarian"><i class="fas fa-times"></i></button>
                                        </div>

                                        <div class="border rounded p-2 bg-light shadow-sm" style="min-height: 280px; max-height: 520px; overflow-y: auto; transition: max-height 0.3s ease;" id="boxMissingFiles">
                                            @if(!empty($fileStatus['missing_files']) && count($fileStatus['missing_files']) > 0)
                                                <ul class="list-unstyled mb-0 small" id="listMissingFilesUl">
                                                    @foreach($fileStatus['missing_files'] as $mf)
                                                        <li class="py-2 px-2 border-bottom d-flex justify-content-between align-items-center missing-file-item" data-search="{{ strtolower($mf['filename']) }} {{ strtolower($mf['satker']) }}">
                                                            <span class="text-truncate me-2" title="{{ $mf['filename'] }}">
                                                                <i class="fas fa-file-pdf text-danger me-1"></i> <strong>{{ $mf['filename'] }}</strong>
                                                            </span>
                                                            <div class="flex-shrink-0">
                                                                <span class="badge bg-secondary me-1">Satker: {{ $mf['satker'] }}</span>
                                                                @if($mf['available_in_backup'])
                                                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i> Ada di E:\backup</span>
                                                                @else
                                                                    <span class="badge bg-danger"><i class="fas fa-times me-1"></i> Tidak Ada di Backup</span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <div class="text-center text-muted py-4 small">
                                                    <i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>
                                                    Seluruh file fisik sudah lengkap di server untuk filter ini.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="button" class="btn btn-success btn-lg w-100 fw-bold" id="btnTriggerSync">
                                        <i class="fas fa-sync-alt me-2"></i> Jalankan Sync & Restore dari Folder E:\backup (Background Batch)
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Restore Methods Tabs (Alternatif ZIP & Multi-file) -->
                <div class="card border-0 shadow-sm mt-2">
                    <div class="card-header bg-dark text-white fw-bold">
                        <i class="fas fa-tools me-2"></i> Opsi Alternatif: Restore via Upload Langsung (ZIP / Drag & Drop File)
                    </div>
                    <div class="card-body">
                        
                        <ul class="nav nav-pills nav-fill mb-4" id="restoreTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active fw-bold fs-6" id="zip-tab" data-bs-toggle="pill" data-bs-target="#tab-zip" type="button" role="tab" aria-controls="tab-zip" aria-selected="true">
                                    <i class="fas fa-file-archive me-2"></i> Upload File ZIP Archive
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold fs-6" id="files-tab" data-bs-toggle="pill" data-bs-target="#tab-files" type="button" role="tab" aria-controls="tab-files" aria-selected="false">
                                    <i class="fas fa-folder-open me-2"></i> Upload Multi-File / Drag & Drop PDF
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="restoreTabContent">
                            <!-- Tab 1: ZIP Upload -->
                            <div class="tab-pane fade show active" id="tab-zip" role="tabpanel" aria-labelledby="zip-tab">
                                <div class="border rounded p-4 bg-light">
                                    <form action="{{ route('restoretahun.uploadZip') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="tahun_restore" id="zip_tahun_restore" value="{{ $tahunSelected }}">

                                        <div class="mb-3">
                                            <label for="zip_file" class="form-label fw-bold">Pilih File ZIP Archive dari Komputer Anda:</label>
                                            <input type="file" class="form-control form-control-lg" name="zip_file" id="zip_file" accept=".zip" required>
                                            <div class="form-text mt-2">
                                                <i class="fas fa-info-circle text-primary"></i> ZIP dapat berisi sekumpulan file PDF dokumen (misal <code>renstra_2024_0.pdf</code>) atau struktur folder Satker.
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 mt-4">
                                            <button type="submit" class="btn btn-primary btn-lg fw-bold" onclick="return confirm('Mulai proses ekstraksi dan restore file dari ZIP ke server?');">
                                                <i class="fas fa-cogs me-2"></i> Ekstrak & Restore File ZIP ke Server
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Tab 2: Multi-File AJAX Chunk Upload -->
                            <div class="tab-pane fade" id="tab-files" role="tabpanel" aria-labelledby="files-tab">
                                <div class="border rounded p-4 bg-light">
                                    <div class="mb-3">
                                        <label for="multi_files" class="form-label fw-bold">Pilih Banyak File PDF Sekaligus dari Komputer:</label>
                                        <input type="file" class="form-control form-control-lg" id="multi_files" multiple accept=".pdf" required>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="button" id="btnStartMultiUpload" class="btn btn-primary btn-lg fw-bold">
                                            <i class="fas fa-cloud-upload-alt me-2"></i> Unggah Multi-File via Background Batch
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

<!-- Modal Progress Sync E:\backup Background -->
<div class="modal fade" id="syncProgressModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="syncProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold" id="syncProgressModalLabel">
                    <i class="fas fa-sync-alt fa-spin me-2"></i> Memproses Sync dari E:\backup...
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="btnCloseSyncModal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="spinner-border text-success mb-3" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="fw-bold mb-1" id="syncStatusText">Membaca Folder E:\backup...</h5>
                <p class="text-muted small mb-3" id="syncSubText">Mohon tunggu, memindahkan file dari folder local ke web application...</p>

                <div class="progress mb-3" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success fw-bold fs-6" id="syncProgressBar" style="width: 0%;">0%</div>
                </div>

                <div class="p-3 bg-light rounded border text-start small">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Status Batch Satker:</span>
                        <strong id="syncStatBatch">0 / 0 Batch</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Total File Berhasil Disalin:</span>
                        <strong class="text-success" id="syncStatFiles">0 File</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Background Progress Multi-File Upload -->
<div class="modal fade" id="uploadProgressModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uploadProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="uploadProgressModalLabel">
                    <i class="fas fa-cloud-upload-alt me-2"></i> Background Upload File...
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="btnCloseUploadModal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="fw-bold mb-1" id="uploadStatusText">Mengunggah Batch File...</h5>
                <p class="text-muted small mb-3" id="uploadSubText">Mohon jangan menutup browser sampai pengunggahan selesai.</p>

                <div class="progress mb-3" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary fw-bold fs-6" id="uploadProgressBar" style="width: 0%;">0%</div>
                </div>

                <div class="p-3 bg-light rounded border text-start small">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Status Progres:</span>
                        <strong id="uploadStatBatch">0 / 0 Batch</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Total File Berhasil Ditempatkan:</span>
                        <strong class="text-success" id="uploadStatFiles">0 File</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const selectCakupan = document.getElementById('cakupan');
    const wrapperKejati = document.getElementById('wrapperKejati');
    const wrapperSatker = document.getElementById('wrapperSatker');
    const selectTahun = document.getElementById('tahun_restore');
    const selectKejati = document.getElementById('id_kejati');
    const inputSatker = document.getElementById('id_satker_target');
    const inputSourcePath = document.getElementById('source_path');
    const btnCheckStatus = document.getElementById('btnCheckStatus');
    const zipTahunRestore = document.getElementById('zip_tahun_restore');

    const btnTriggerSync = document.getElementById('btnTriggerSync');
    const syncModal = new bootstrap.Modal(document.getElementById('syncProgressModal'));
    const btnCloseSyncModal = document.getElementById('btnCloseSyncModal');
    const syncStatusText = document.getElementById('syncStatusText');
    const syncSubText = document.getElementById('syncSubText');
    const syncProgressBar = document.getElementById('syncProgressBar');
    const syncStatBatch = document.getElementById('syncStatBatch');
    const syncStatFiles = document.getElementById('syncStatFiles');

    function toggleCakupanFields() {
        const val = selectCakupan.value;
        wrapperKejati.style.display = (val === 'kejati') ? 'block' : 'none';
        wrapperSatker.style.display = (val === 'satker') ? 'block' : 'none';
    }

    const filterMissingSearch = document.getElementById('filterMissingSearch');
    const btnClearSearchMissing = document.getElementById('btnClearSearchMissing');
    const btnToggleExpandList = document.getElementById('btnToggleExpandList');
    const textToggleExpand = document.getElementById('textToggleExpand');
    const boxMissingFiles = document.getElementById('boxMissingFiles');

    // Live search filter across missing files list
    if (filterMissingSearch) {
        filterMissingSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.missing-file-item');
            let visibleCount = 0;
            items.forEach(el => {
                const text = el.getAttribute('data-search') || el.textContent.toLowerCase();
                if (text.includes(query)) {
                    el.style.setProperty('display', 'flex', 'important');
                    visibleCount++;
                } else {
                    el.style.setProperty('display', 'none', 'important');
                }
            });
        });
    }

    if (btnClearSearchMissing) {
        btnClearSearchMissing.addEventListener('click', function() {
            if (filterMissingSearch) {
                filterMissingSearch.value = '';
                filterMissingSearch.dispatchEvent(new Event('input'));
                filterMissingSearch.focus();
            }
        });
    }

    // Toggle expand height of the missing files box
    let isExpanded = false;
    if (btnToggleExpandList) {
        btnToggleExpandList.addEventListener('click', function() {
            isExpanded = !isExpanded;
            if (isExpanded) {
                boxMissingFiles.style.maxHeight = '900px';
                btnToggleExpandList.className = 'btn btn-primary btn-sm';
                btnToggleExpandList.innerHTML = '<i class="fas fa-compress-alt me-1"></i> <span id="textToggleExpand">Perkecil</span>';
            } else {
                boxMissingFiles.style.maxHeight = '520px';
                btnToggleExpandList.className = 'btn btn-outline-secondary btn-sm';
                btnToggleExpandList.innerHTML = '<i class="fas fa-expand-alt me-1"></i> <span id="textToggleExpand">Perbesar</span>';
            }
        });
    }

    selectCakupan.addEventListener('change', toggleCakupanFields);
    selectTahun.addEventListener('change', function() {
        zipTahunRestore.value = selectTahun.value;
    });

    btnCheckStatus.addEventListener('click', function() {
        btnCheckStatus.disabled = true;
        btnCheckStatus.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Memeriksa...';

        fetch("{{ route('restoretahun.check') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                tahun_restore: selectTahun.value,
                cakupan: selectCakupan.value,
                id_kejati: selectKejati.value,
                id_satker_target: inputSatker.value,
                source_path: inputSourcePath.value
            })
        })
        .then(res => res.json())
        .then(data => {
            btnCheckStatus.disabled = false;
            btnCheckStatus.innerHTML = '<i class="fas fa-search me-1"></i> Periksa File di Database vs E:\\backup';

            if (data.success) {
                document.getElementById('textTahunHeader').textContent = data.tahun;
                document.getElementById('countTotalExpected').textContent = data.status.total_expected;
                document.getElementById('countExisting').textContent = data.status.existing_count;
                document.getElementById('countAvailableBackup').textContent = data.status.available_in_backup_count;

                const box = document.getElementById('boxMissingFiles');
                const badgeCount = document.getElementById('badgeMissingCount');
                if (badgeCount) {
                    badgeCount.textContent = (data.status.missing_files ? data.status.missing_files.length : 0) + ' File';
                }

                if (data.status.missing_files && data.status.missing_files.length > 0) {
                    let html = '<ul class="list-unstyled mb-0 small" id="listMissingFilesUl">';
                    data.status.missing_files.forEach(f => {
                        const bgBadge = f.available_in_backup 
                            ? '<span class="badge bg-success"><i class="fas fa-check me-1"></i> Ada di E:\\backup</span>' 
                            : '<span class="badge bg-danger"><i class="fas fa-times me-1"></i> Tidak Ada di Backup</span>';

                        html += `<li class="py-2 px-2 border-bottom d-flex justify-content-between align-items-center missing-file-item" data-search="${(f.filename + ' ' + f.satker).toLowerCase()}">
                            <span class="text-truncate me-2" title="${f.filename}">
                                <i class="fas fa-file-pdf text-danger me-1"></i> <strong>${f.filename}</strong>
                            </span>
                            <div class="flex-shrink-0">
                                <span class="badge bg-secondary me-1">Satker: ${f.satker}</span>
                                ${bgBadge}
                            </div>
                        </li>`;
                    });
                    html += '</ul>';
                    box.innerHTML = html;

                    // Trigger filter jika search input sedang terisi
                    if (filterMissingSearch && filterMissingSearch.value.trim() !== '') {
                        filterMissingSearch.dispatchEvent(new Event('input'));
                    }
                } else {
                    box.innerHTML = '<div class="text-center text-muted py-4 small"><i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>Seluruh file fisik sudah lengkap di server untuk filter ini.</div>';
                }
            }
        })
        .catch(err => {
            btnCheckStatus.disabled = false;
            btnCheckStatus.innerHTML = '<i class="fas fa-search me-1"></i> Periksa File di Database vs E:\\backup';
            console.error(err);
        });
    });

    // Sync Background Batch from E:\backup
    btnTriggerSync.addEventListener('click', function() {
        if (!confirm(`Mulai Sync & Restore file dari folder ${inputSourcePath.value} ke server?`)) {
            return;
        }

        btnCloseSyncModal.style.display = 'none';
        syncModal.show();

        fetch("{{ route('restoretahun.syncBatches') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                tahun_restore: selectTahun.value,
                cakupan: selectCakupan.value,
                id_kejati: selectKejati.value,
                id_satker_target: inputSatker.value,
                source_path: inputSourcePath.value
            })
        })
        .then(res => res.json())
        .then(async data => {
            if (!data.success || !data.batches || data.batches.length === 0) {
                syncStatusText.textContent = "Tidak ada Satker/Batch yang dapat disinkronkan.";
                syncProgressBar.style.width = '100%';
                syncProgressBar.textContent = '100%';
                btnCloseSyncModal.style.display = 'block';
                return;
            }

            const totalBatches = data.batches.length;
            let totalCopied = 0;

            for (let b = 0; b < totalBatches; b++) {
                const currentBatch = b + 1;
                const batchSatkers = data.batches[b];
                const percent = Math.round((currentBatch / totalBatches) * 100);

                syncStatusText.textContent = `Memproses Sync Batch ${currentBatch} dari ${totalBatches}...`;
                syncStatBatch.textContent = `${currentBatch} / ${totalBatches} Batch`;

                try {
                    const batchRes = await fetch("{{ route('restoretahun.processSyncBatch') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            tahun_restore: selectTahun.value,
                            satker_ids: batchSatkers,
                            source_path: inputSourcePath.value
                        })
                    }).then(r => r.json());

                    if (batchRes.success) {
                        totalCopied += batchRes.files_copied;
                        syncStatFiles.textContent = `${totalCopied} File`;
                    }
                } catch (err) {
                    console.error('Sync batch error:', err);
                }

                syncProgressBar.style.width = percent + '%';
                syncProgressBar.textContent = percent + '%';
            }

            syncStatusText.textContent = "Sinkronisasi File dari E:\\backup Selesai!";
            syncStatusText.className = "fw-bold text-success mb-1";
            syncSubText.textContent = `Berhasil menyalin ${totalCopied} file dari ${inputSourcePath.value} ke server.`;
            btnCloseSyncModal.style.display = 'block';

            setTimeout(() => {
                window.location.reload();
            }, 3000);
        })
        .catch(err => {
            syncStatusText.textContent = "Gagal memulai pemrosesan sync.";
            syncStatusText.className = "fw-bold text-danger mb-1";
            btnCloseSyncModal.style.display = 'block';
            console.error(err);
        });
    });

    // Multi-File Background Chunk Upload
    const btnStartMultiUpload = document.getElementById('btnStartMultiUpload');
    const inputMultiFiles = document.getElementById('multi_files');
    const modalUpload = new bootstrap.Modal(document.getElementById('uploadProgressModal'));
    const btnCloseUploadModal = document.getElementById('btnCloseUploadModal');
    const uploadStatusText = document.getElementById('uploadStatusText');
    const uploadSubText = document.getElementById('uploadSubText');
    const uploadProgressBar = document.getElementById('uploadProgressBar');
    const uploadStatBatch = document.getElementById('uploadStatBatch');
    const uploadStatFiles = document.getElementById('uploadStatFiles');

    btnStartMultiUpload.addEventListener('click', async function() {
        const files = inputMultiFiles.files;
        if (!files || files.length === 0) {
            alert('Silakan pilih file PDF yang akan diunggah terlebih dahulu!');
            return;
        }

        btnCloseUploadModal.style.display = 'none';
        modalUpload.show();

        const fileArray = Array.from(files);
        const chunkSize = 5;
        const chunks = [];

        for (let i = 0; i < fileArray.length; i += chunkSize) {
            chunks.push(fileArray.slice(i, i + chunkSize));
        }

        const totalBatches = chunks.length;
        let totalRestored = 0;

        for (let b = 0; b < totalBatches; b++) {
            const currentBatch = b + 1;
            const currentFiles = chunks[b];
            const percent = Math.round((currentBatch / totalBatches) * 100);

            uploadStatusText.textContent = `Mengunggah Batch ${currentBatch} dari ${totalBatches}...`;
            uploadStatBatch.textContent = `${currentBatch} / ${totalBatches} Batch`;

            const formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('tahun_restore', selectTahun.value);

            currentFiles.forEach(f => {
                formData.append('files[]', f);
            });

            try {
                const res = await fetch("{{ route('restoretahun.uploadBatch') }}", {
                    method: "POST",
                    body: formData
                }).then(r => r.json());

                if (res.success) {
                    totalRestored += res.files_restored;
                    uploadStatFiles.textContent = `${totalRestored} File`;
                }
            } catch (err) {
                console.error('Batch upload error:', err);
            }

            uploadProgressBar.style.width = percent + '%';
            uploadProgressBar.textContent = percent + '%';
        }

        uploadStatusText.textContent = "Pengunggahan Seluruh Batch Selesai!";
        uploadStatusText.className = "fw-bold text-success mb-1";
        uploadSubText.textContent = `Berhasil merestore ${totalRestored} file ke server.`;
        btnCloseUploadModal.style.display = 'block';

        setTimeout(() => {
            window.location.reload();
        }, 3000);
    });
});
</script>
@endsection
