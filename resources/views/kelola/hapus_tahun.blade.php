@extends('layouts.app')

@section('title', 'Hapus File & Data Berdasarkan Tahun (Admin)')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <div class="card border-light shadow-sm mb-4">
            <div class="card-header bg-danger text-white py-3 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold"><i class="fas fa-trash-alt me-2"></i> Hapus File & Data Berdasarkan Tahun</h3>
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

                <div class="alert alert-warning border-start border-4 border-warning shadow-sm mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle fa-2x me-3 text-warning"></i>
                        <div>
                            <h5 class="fw-bold mb-1">Perhatian Khusus Admin!</h5>
                            <p class="mb-0">Fitur ini menghapus <strong>seluruh file fisik</strong> (seperti PDF Renstra, Renja, IKU, RKAKL, DIPA, PK, LKJiP, LHE, dll.) dari folder <code>id_satker</code> serta record database terkait untuk tahun & Kejati yang dipilih. Proses ini dijalankan secara <strong>background batch processing</strong> agar tidak melebihi batas waktu eksekusi (30 detik timeout).</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-primary text-white fw-bold">
                                <i class="fas fa-filter me-2"></i> Filter Tahun & Kejati / Satker
                            </div>
                            <div class="card-body">
                                <form id="formPreview" method="POST" action="{{ route('hapustahun.preview') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="tahun_hapus" class="form-label fw-bold">Pilih Tahun Target:</label>
                                        <select name="tahun_hapus" id="tahun_hapus" class="form-select form-select-lg">
                                            <option value="2024" selected>Tahun 2024</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cakupan" class="form-label fw-bold">Pilih Filter Cakupan Penghapusan:</label>
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

                                    <!-- Dropdown Pilihan Kejati -->
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

                                    <!-- Input ID Satker Spesifik -->
                                    <div class="mb-3" id="wrapperSatker" style="display: {{ (isset($cakupan) && $cakupan == 'satker') ? 'block' : 'none' }};">
                                        <label for="id_satker_target" class="form-label fw-bold">Masukkan ID Satker Spesifik:</label>
                                        <input type="text" class="form-control" name="id_satker_target" id="id_satker_target" value="{{ $idSatkerTarget ?? session('id_satker') }}" placeholder="Contoh: 006050">
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="button" id="btnPreview" class="btn btn-info text-white fw-bold">
                                            <i class="fas fa-search me-1"></i> Hitung & Preview Data Tersebut
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-secondary text-white fw-bold">
                                <i class="fas fa-chart-pie me-2"></i> Ringkasan Data Terdeteksi
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <div class="row text-center my-3">
                                        <div class="col-6">
                                            <div class="p-3 bg-light rounded shadow-sm border">
                                                <h6 class="text-muted mb-1">Total File Dokumen</h6>
                                                <h2 class="fw-bold text-danger mb-0" id="previewFileCount">
                                                    {{ $summary['total_files'] ?? 0 }}
                                                </h2>
                                                <small class="text-muted">terdaftar di folder satker</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-3 bg-light rounded shadow-sm border">
                                                <h6 class="text-muted mb-1">Total Record Database</h6>
                                                <h2 class="fw-bold text-warning mb-0" id="previewRecordCount">
                                                    {{ $summary['total_records'] ?? 0 }}
                                                </h2>
                                                <small class="text-muted">baris di database</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-info small mb-0">
                                        <i class="fas fa-bolt me-1"></i> <strong>Sistem Anti-Timeout (Background Chunking):</strong> Proses eksekusi diproses per-batch Satker secara otomatis sehingga terbebas dari kendala batas waktu server (30 Detik Limit Exceeded).
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="button" class="btn btn-danger btn-lg w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                        <i class="fas fa-trash-alt me-2"></i> Eksekusi Hapus Data (Background Batch)
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

<!-- Modal Konfirmasi & Process Progress -->
<div class="modal fade" id="confirmDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="confirmDeleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Penghapusan Background
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="btnCloseModal"></button>
            </div>
            
            <div class="modal-body" id="modalFormBody">
                <p class="fs-6">Anda akan menghapus <strong>SELURUH FILE FISIK & DATA DATABASE</strong> untuk:</p>
                
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tahun Target:
                        <span class="badge bg-danger rounded-pill fs-6" id="modalTextTahun">2024</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Cakupan Target:
                        <span class="badge bg-secondary rounded-pill fs-6" id="modalTextCakupan">
                            {{ $cakupan ?? 'semua' }}
                        </span>
                    </li>
                </ul>

                <div class="mb-3">
                    <label for="konfirmasi" class="form-label text-danger fw-bold">
                        Ketik kata <code>HAPUS</code> di bawah ini untuk mengonfirmasi:
                    </label>
                    <input type="text" class="form-control form-control-lg border-danger text-center font-monospace fw-bold" id="konfirmasi" name="konfirmasi" placeholder="HAPUS" autocomplete="off">
                </div>
            </div>

            <!-- Panel Status Progress Background Processing -->
            <div class="modal-body d-none" id="modalProgressBody">
                <div class="text-center my-3">
                    <div class="spinner-border text-danger mb-2" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="fw-bold text-dark mb-1" id="progressStatusText">Menyiapkan Background Batch Processing...</h5>
                    <p class="text-muted small" id="progressSubText">Mohon jangan menutup halaman ini sampai proses selesai.</p>
                </div>

                <div class="progress mb-3" style="height: 25px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger fw-bold fs-6" role="progressbar" id="progressBar" style="width: 0%;">0%</div>
                </div>

                <div class="p-3 bg-light rounded border text-start">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Status Batch:</span>
                        <strong id="statBatchCount">0 / 0 Batch</strong>
                    </div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Total File Terhapus:</span>
                        <strong class="text-danger" id="statFilesDeleted">0 File</strong>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span>Total Record Terhapus:</span>
                        <strong class="text-warning" id="statRecordsDeleted">0 Record</strong>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light" id="modalFooterBtns">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger fw-bold" id="btnStartProcessing">
                    <i class="fas fa-play me-1"></i> Mulai Eksekusi Background
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const selectCakupan = document.getElementById('cakupan');
    const wrapperKejati = document.getElementById('wrapperKejati');
    const wrapperSatker = document.getElementById('wrapperSatker');
    const selectTahun = document.getElementById('tahun_hapus');
    const selectKejati = document.getElementById('id_kejati');
    const inputSatker = document.getElementById('id_satker_target');
    const btnPreview = document.getElementById('btnPreview');

    const modalTextTahun = document.getElementById('modalTextTahun');
    const modalTextCakupan = document.getElementById('modalTextCakupan');
    const inputKonfirmasi = document.getElementById('konfirmasi');
    const btnStartProcessing = document.getElementById('btnStartProcessing');
    const btnCloseModal = document.getElementById('btnCloseModal');

    const modalFormBody = document.getElementById('modalFormBody');
    const modalProgressBody = document.getElementById('modalProgressBody');
    const modalFooterBtns = document.getElementById('modalFooterBtns');

    const progressBar = document.getElementById('progressBar');
    const progressStatusText = document.getElementById('progressStatusText');
    const progressSubText = document.getElementById('progressSubText');
    const statBatchCount = document.getElementById('statBatchCount');
    const statFilesDeleted = document.getElementById('statFilesDeleted');
    const statRecordsDeleted = document.getElementById('statRecordsDeleted');

    function toggleCakupanFields() {
        const val = selectCakupan.value;
        wrapperKejati.style.display = (val === 'kejati') ? 'block' : 'none';
        wrapperSatker.style.display = (val === 'satker') ? 'block' : 'none';
        syncModalText();
    }

    function syncModalText() {
        modalTextTahun.textContent = selectTahun.value;
        let txt = 'Seluruh Satker (Global)';
        if (selectCakupan.value === 'kejati') {
            const selectedOpt = selectKejati.options[selectKejati.selectedIndex];
            txt = 'Wilayah Kejati: ' + (selectedOpt ? selectedOpt.text : selectKejati.value);
        } else if (selectCakupan.value === 'satker') {
            txt = 'Satker Spesifik ID: ' + inputSatker.value;
        }
        modalTextCakupan.textContent = txt;
    }

    selectCakupan.addEventListener('change', toggleCakupanFields);
    selectTahun.addEventListener('change', syncModalText);
    selectKejati.addEventListener('change', syncModalText);
    inputSatker.addEventListener('input', syncModalText);

    btnPreview.addEventListener('click', function() {
        btnPreview.disabled = true;
        btnPreview.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menghitung...';

        fetch("{{ route('hapustahun.preview') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                tahun_hapus: selectTahun.value,
                cakupan: selectCakupan.value,
                id_kejati: selectKejati.value,
                id_satker_target: inputSatker.value
            })
        })
        .then(res => res.json())
        .then(data => {
            btnPreview.disabled = false;
            btnPreview.innerHTML = '<i class="fas fa-search me-1"></i> Hitung & Preview Data Tersebut';
            if (data.success) {
                document.getElementById('previewFileCount').textContent = data.summary.total_files;
                document.getElementById('previewRecordCount').textContent = data.summary.total_records;
            }
        })
        .catch(err => {
            btnPreview.disabled = false;
            btnPreview.innerHTML = '<i class="fas fa-search me-1"></i> Hitung & Preview Data Tersebut';
            console.error(err);
        });
    });

    // Chunked Background Batch Execution Process
    btnStartProcessing.addEventListener('click', function() {
        if (inputKonfirmasi.value.trim().toUpperCase() !== 'HAPUS') {
            alert('Silakan ketik kata "HAPUS" untuk mengonfirmasi eksekusi penghapusan!');
            return;
        }

        modalFormBody.classList.add('d-none');
        modalFooterBtns.classList.add('d-none');
        modalProgressBody.classList.remove('d-none');
        btnCloseModal.style.display = 'none';

        const tahun = selectTahun.value;
        const cakupan = selectCakupan.value;
        const id_kejati = selectKejati.value;
        const id_satker_target = inputSatker.value;

        let totalFilesDeleted = 0;
        let totalRecordsDeleted = 0;

        fetch("{{ route('hapustahun.batches') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                tahun_hapus: tahun,
                cakupan: cakupan,
                id_kejati: id_kejati,
                id_satker_target: id_satker_target
            })
        })
        .then(res => res.json())
        .then(async data => {
            if (!data.success || !data.batches || data.batches.length === 0) {
                progressStatusText.textContent = "Tidak ada Satker/Data yang diproses.";
                progressBar.classList.replace('bg-danger', 'bg-warning');
                progressBar.style.width = '100%';
                progressBar.textContent = '100%';
                btnCloseModal.style.display = 'block';
                return;
            }

            const totalBatches = data.batches.length;
            
            for (let i = 0; i < totalBatches; i++) {
                const batchSatkers = data.batches[i];
                const currentBatchNum = i + 1;
                const percent = Math.round((currentBatchNum / totalBatches) * 100);

                progressStatusText.textContent = `Memproses Batch ${currentBatchNum} dari ${totalBatches}...`;
                statBatchCount.textContent = `${currentBatchNum} / ${totalBatches} Batch`;

                try {
                    const batchRes = await fetch("{{ route('hapustahun.processBatch') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            tahun_hapus: tahun,
                            satker_ids: batchSatkers
                        })
                    }).then(r => r.json());

                    if (batchRes.success) {
                        totalFilesDeleted += batchRes.files_deleted;
                        totalRecordsDeleted += batchRes.records_deleted;

                        statFilesDeleted.textContent = `${totalFilesDeleted} File`;
                        statRecordsDeleted.textContent = `${totalRecordsDeleted} Record`;
                    }
                } catch (batchErr) {
                    console.error('Error on batch ' + currentBatchNum, batchErr);
                }

                progressBar.style.width = percent + '%';
                progressBar.textContent = percent + '%';
            }

            // Selesai!
            progressStatusText.textContent = "Penghapusan Berhasil Selesai!";
            progressStatusText.className = "fw-bold text-success mb-1";
            progressSubText.textContent = `Selesai memproses seluruh batch data tahun ${tahun}.`;
            progressBar.classList.replace('bg-danger', 'bg-success');
            progressBar.classList.remove('progress-bar-animated', 'progress-bar-striped');
            btnCloseModal.style.display = 'block';

            setTimeout(() => {
                window.location.reload();
            }, 3000);
        })
        .catch(err => {
            progressStatusText.textContent = "Terjadi Kesalahan saat Memulai Processing.";
            progressStatusText.className = "fw-bold text-danger mb-1";
            btnCloseModal.style.display = 'block';
            console.error(err);
        });
    });
});
</script>
@endsection
