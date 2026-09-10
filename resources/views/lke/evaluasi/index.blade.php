@extends('layouts.app')

@section('content')
<div class="content" id="content">
<div class="container-fluid py-4 px-4">
    <!-- Header Title -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-clipboard-check-fill text-success me-2"></i>Evaluasi Lembar Kerja Evaluasi (LKE) AKIP
            </h3>
            <p class="text-muted mb-0">
                Penilaian mandiri & evaluasi pengawasan berjenjang berdasarkan parameter kriteria dan bukti dukung satker.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
            @if(session('id_sakip_level') == 99 || in_array(session('id_satker'), ['admin', '999999']))
                <a href="{{ route('lke.evidence_mapping.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    <i class="bi bi-gear-fill me-1"></i> Mapping Bukti Dukung (Admin)
                </a>
            @endif
            <span class="badge bg-success px-3 py-2 fs-6 rounded-pill">
                <i class="bi bi-person-badge-fill me-1"></i> Tim Penilai (WAS & Evaluator)
            </span>
        </div>
    </div>

    <!-- Satker & Tahun Selector Bar -->
    <div class="lke-filter-toolbar mb-4">
        <form method="GET" action="{{ route('lke.evaluasi.index') }}" class="row g-3 align-items-center" id="satkerFilterForm">
            <div class="col-md-7">
                <label class="form-label text-xs fw-semibold text-muted mb-1">Pilih Satuan Kerja (Satker) yang Dinilai</label>
                <select name="id_satker" class="form-select select2" onchange="this.form.submit()">
                    @forelse($satkerList as $stk)
                        <option value="{{ $stk->id_satker }}" {{ $selectedSatker == $stk->id_satker ? 'selected' : '' }}>
                            [{{ $stk->id_satker }}] {{ str_replace('_', ' ', $stk->satkernama) }}
                        </option>
                    @empty
                        <option value="" disabled selected>Tidak ada satuan kerja di bawah wilayah wewenang Anda</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label text-xs fw-semibold text-muted mb-1">Tahun Penilaian</label>
                <select name="tahun" class="form-select" onchange="this.form.submit()">
                    @foreach([2026, 2025, 2024] as $yr)
                        <option value="{{ $yr }}" {{ $tahun == $yr ? 'selected' : '' }}>Tahun {{ $yr }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-emerald w-100">
                    <i class="bi bi-arrow-repeat me-1"></i> Tampilkan
                </button>
            </div>
        </form>
    </div>

    @if($satkerInfo)
        <!-- Satker Info Banner & Hierarchical Score Dashboard -->
        <div class="lke-hero-banner mb-4 p-4">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="d-flex align-items-center mb-2 flex-wrap gap-2">
                        <span class="badge bg-light text-dark px-2 py-1 font-monospace text-xs">ID: {{ $satkerInfo->id_satker }}</span>
                        <span class="badge bg-warning text-dark px-2 py-1 text-xs fw-semibold">Tahun Evaluasi: {{ $tahun }}</span>
                    </div>
                    <h4 class="fw-bold mb-1 text-white">{{ str_replace('_', ' ', $satkerInfo->satkernama) }}</h4>
                    <p class="text-white-50 text-sm mb-3 mb-lg-0">
                        Progres Penilaian: <strong class="text-white" id="progressEvaluated">{{ $scores['evaluated_cnt'] }}</strong> dari <strong class="text-white">{{ $scores['total_cnt'] }}</strong> Kriteria Telah Dinilai.
                    </p>
                </div>
                <div class="col-lg-5 text-lg-end">
                    <div class="d-inline-block lke-score-badge">
                        <div class="text-muted text-xs text-uppercase fw-semibold">Total Nilai LKE</div>
                        <h2 class="fw-bold mb-0 text-success" id="cardGrandTotal">
                            {{ number_format($scores['grand_total'], 2) }}
                        </h2>
                        <div class="text-muted text-xs mt-1">Akumulasi 4 Komponen</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Komponen Summary Cards -->
        <div class="row g-3 mb-4">
            @foreach($komponenList as $komp)
                @php
                    $kScoreData = $scores['komponen'][$komp->id] ?? ['skor' => 0, 'max_skor' => 0, 'persentase' => 0, 'evaluated_cnt' => 0, 'total_cnt' => 0];
                @endphp
                <div class="col-md-3">
                    <div class="lke-komp-card h-100">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success-subtle text-success fw-bold text-xs">Komponen {{ $komp->no }}</span>
                            <span class="fw-bold fs-5 text-dark" id="kompScore-{{ $komp->id }}">
                                {{ number_format($kScoreData['skor'], 2) }}
                            </span>
                        </div>
                        <div class="fw-semibold text-dark mb-2 text-sm" style="min-height: 42px;">
                            {{ $komp->nama }}
                        </div>
                        <div class="progress mb-2" style="height: 6px;">
                            <div class="progress-bar bg-success" id="kompBar-{{ $komp->id }}" role="progressbar" style="width: {{ $kScoreData['persentase'] }}%;"></div>
                        </div>
                        <div class="d-flex justify-content-between text-muted text-xs">
                            <span>Max: {{ $kScoreData['max_skor'] }}</span>
                            <span id="kompPercent-{{ $komp->id }}">{{ $kScoreData['persentase'] }}%</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Hierarchical Evaluation Worksheets (Accordion per Komponen & Subkomponen) -->
        <div class="accordion" id="accordionLkeEvaluasi">
            @foreach($komponenList as $komp)
                <div class="accordion-item border-0 shadow-sm rounded-3 mb-3 overflow-hidden">
                    <h2 class="accordion-header" id="headingKomp-{{ $komp->id }}">
                        <button class="accordion-button bg-light text-dark fw-bold py-3 {{ $loop->first ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseKomp-{{ $komp->id }}"
                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                            <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                <div>
                                    <span class="badge bg-success me-2 text-sm">Komponen {{ $komp->no }}</span>
                                    <span class="text-md">{{ $komp->nama }}</span>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-white text-dark border px-3 py-2 text-sm">
                                        Total Skor: <strong class="text-success" id="headerKompScore-{{ $komp->id }}">{{ number_format($scores['komponen'][$komp->id]['skor'] ?? 0, 2) }}</strong>
                                    </span>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapseKomp-{{ $komp->id }}"
                         class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                         data-bs-parent="#accordionLkeEvaluasi">
                        <div class="accordion-body p-3 bg-white">
                            @foreach($komp->subkomponen as $sub)
                                @php
                                    $subScoreData = $scores['subkomponen'][$sub->kode] ?? ['skor' => 0, 'max_skor' => 0, 'persentase' => 0, 'evaluated_cnt' => 0, 'total_cnt' => 0];
                                @endphp
                                <!-- Subkomponen Header Box -->
                                <div class="lke-subkomp-box mb-3 d-flex flex-wrap justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-dark font-monospace me-2 text-xs">{{ $sub->kode }}</span>
                                        <strong class="text-dark text-sm">{{ $sub->nama }}</strong>
                                    </div>
                                    <div class="mt-2 mt-md-0 d-flex align-items-center gap-2">
                                        <span class="badge bg-secondary-subtle text-secondary text-xs">
                                            {{ $subScoreData['evaluated_cnt'] }} / {{ $subScoreData['total_cnt'] }} Kriteria
                                        </span>
                                        <span class="badge bg-success px-3 py-2 text-xs rounded-pill">
                                            Skor: <span id="subScore-{{ str_replace('.', '-', $sub->kode) }}">{{ number_format($subScoreData['skor'], 2) }}</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Kriteria Cards under this Subkomponen -->
                                <div class="mb-4">
                                    @foreach($sub->kriteria as $cr)
                                        @php
                                            $eval = $existingPenilaian->get($cr->kode);
                                            $evidences = $satkerBukti->get($cr->kode, collect());
                                            $requiredBuktiIds = $cr->bukti_dukung_ids;
                                        @endphp
                                        <div class="card lke-kriteria-card mb-3" id="cardKriteria-{{ str_replace('.', '-', $cr->kode) }}">
                                            <div class="card-body p-3">
                                                <div class="row g-3">
                                                    <!-- Kriteria Description & Evidence Column -->
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-start mb-2">
                                                            <span class="badge bg-dark font-monospace text-xs me-2">{{ $cr->kode }}</span>
                                                            <div class="fw-bold text-dark text-sm">{{ $cr->nama }}</div>
                                                        </div>

                                                        <!-- Required Evidence Badges -->
                                                        <div class="mt-3 p-2 bg-light rounded-2 border">
                                                            <div class="text-xs fw-bold text-muted mb-2">
                                                                <i class="bi bi-file-earmark-check me-1 text-success"></i> Bukti Dukung yang Diperlukan:
                                                            </div>
                                                            @if(!empty($requiredBuktiIds))
                                                                <ul class="list-unstyled mb-0 text-xs">
                                                                    @foreach($requiredBuktiIds as $bId)
                                                                        @php
                                                                            $docName = $masterBukti[$bId] ?? 'Dokumen #'.$bId;
                                                                            // Check if satker has uploaded this evidence
                                                                            $hasUploaded = $evidences->first(function ($item) use ($bId) {
                                                                                return $item->buktidukung_id == $bId || $item->kode_bukti == $bId;
                                                                            });
                                                                        @endphp
                                                                        <li class="mb-1 d-flex align-items-center justify-content-between">
                                                                            <span>
                                                                                <span class="badge bg-secondary me-1">#{{ $bId }}</span>
                                                                                {{ $docName }}
                                                                            </span>
                                                                            @if($hasUploaded)
                                                                                <a href="{{ asset('uploads/repository/'.$hasUploaded->link_bukti_dukung) }}" target="_blank" class="badge bg-success-subtle text-success text-decoration-none">
                                                                                    <i class="bi bi-eye me-1"></i> Ada File
                                                                                </a>
                                                                            @else
                                                                                <span class="badge bg-danger-subtle text-danger">Belum Diupload</span>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <span class="text-muted text-xs fst-italic">Tidak memerlukan bukti dukung khusus.</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Scoring / Parameters Column -->
                                                    <div class="col-lg-6">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <label class="text-xs fw-bold text-muted mb-0">Pilih Parameter Nilai:</label>
                                                            <span class="badge bg-success-subtle text-success current-score-badge text-xs" id="badgeScore-{{ str_replace('.', '-', $cr->kode) }}">
                                                                Nilai: {{ $eval ? $eval->nilai : '-' }} (Skor: {{ $eval ? number_format($eval->skor, 2) : '0.00' }})
                                                            </span>
                                                        </div>

                                                        <!-- Parameter Radio Options -->
                                                        <div class="parameter-options-container mb-3">
                                                            @foreach($cr->parameters as $p)
                                                                @php
                                                                    $isSelected = $eval && $eval->parameter_id == $p->id;
                                                                @endphp
                                                                <div class="form-check lke-param-option mb-2 option-box {{ $isSelected ? 'selected' : '' }}">
                                                                    <input class="form-check-input ms-1 me-2 radio-param" 
                                                                           type="radio" 
                                                                           name="param_{{ str_replace('.', '_', $cr->kode) }}" 
                                                                           id="p_{{ $p->id }}" 
                                                                           value="{{ $p->id }}"
                                                                           data-kriteria="{{ $cr->kode }}"
                                                                           data-skor="{{ $p->skor }}"
                                                                           data-nilai="{{ $p->nilai }}"
                                                                           {{ $isSelected ? 'checked' : '' }}>
                                                                    <label class="form-check-label w-100 cursor-pointer" for="p_{{ $p->id }}">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <strong class="text-dark text-sm">{{ $p->nilai }}</strong>
                                                                            <span class="badge bg-dark rounded-pill text-xs">Skor: {{ $p->skor }}</span>
                                                                        </div>
                                                                        @if($p->keterangan)
                                                                            <div class="text-xs text-muted mt-1">{{ $p->keterangan }}</div>
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <!-- Evaluator Notes -->
                                                        <div class="mb-2">
                                                            <input type="text" 
                                                                   class="form-control form-control-sm input-catatan text-sm" 
                                                                   id="catatan_{{ str_replace('.', '_', $cr->kode) }}" 
                                                                   placeholder="Catatan / rekomendasi evaluasi untuk satker..." 
                                                                   value="{{ $eval ? $eval->catatan : '' }}">
                                                        </div>

                                                        <div class="text-end">
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-emerald px-3 rounded-pill btn-save-kriteria" 
                                                                    data-kriteria="{{ $cr->kode }}">
                                                                <i class="bi bi-save me-1"></i> Simpan Nilai
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-4">
            <div class="mb-3">
                <div class="empty-state-icon-box bg-light p-4 text-warning">
                    <i class="bi bi-building-gear fs-1"></i>
                </div>
            </div>
            <h4 class="fw-bold text-dark mb-2">Pilih Satuan Kerja untuk Memulai</h4>
            <p class="text-muted mx-auto mb-3 max-w-md">
                Silakan pilih Satuan Kerja (Satker) dan Tahun Penilaian pada panel filter di atas untuk memuat lembar kerja evaluasi serta kriteria penilaian SAKIP.
            </p>
        </div>
    @endif
</div>
</div>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3 z-toast">
    <div id="evalToast" class="toast align-items-center text-white bg-success border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body fs-6" id="toastEvalMessage">
                Nilai berhasil disimpan!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toastEl = document.getElementById('evalToast');
    const toast = new bootstrap.Toast(toastEl, { delay: 2500 });

    function showToast(message, isSuccess = true) {
        document.getElementById('toastEvalMessage').innerHTML = message;
        toastEl.className = `toast align-items-center text-white border-0 shadow ${isSuccess ? 'bg-success' : 'bg-danger'}`;
        toast.show();
    }

    // Interactive Option Box Selection styling
    document.querySelectorAll('.radio-param').forEach(radio => {
        radio.addEventListener('change', function () {
            const container = this.closest('.parameter-options-container');
            container.querySelectorAll('.option-box').forEach(box => {
                box.classList.remove('selected', 'border-primary', 'bg-primary-subtle');
            });
            this.closest('.option-box').classList.add('selected');
        });
    });

    // Save Score AJAX Handler
    document.querySelectorAll('.btn-save-kriteria').forEach(btn => {
        btn.addEventListener('click', function () {
            const kriteriaKode = this.getAttribute('data-kriteria');
            const safeName = kriteriaKode.replace(/\./g, '_');
            const selectedRadio = document.querySelector(`input[name="param_${safeName}"]:checked`);

            if (!selectedRadio) {
                showToast('Harap pilih salah satu parameter nilai terlebih dahulu.', false);
                return;
            }

            const parameterId = selectedRadio.value;
            const catatan = document.getElementById(`catatan_${safeName}`).value;
            const idSatker = '{{ $selectedSatker }}';
            const tahun = '{{ $tahun }}';

            const button = this;
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';

            fetch('{{ route("lke.evaluasi.save_score") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id_satker: idSatker,
                    tahun: tahun,
                    kriteria_id: kriteriaKode,
                    parameter_id: parameterId,
                    catatan: catatan
                })
            })
            .then(res => res.json())
            .then(data => {
                button.disabled = false;
                button.innerHTML = '<i class="bi bi-save me-1"></i> Simpan Nilai';

                if (data.success) {
                    showToast(data.message, true);

                    // Update criteria badge
                    const safeKode = kriteriaKode.replace(/\./g, '-');
                    const badge = document.getElementById(`badgeScore-${safeKode}`);
                    if (badge) {
                        badge.innerHTML = `Nilai: ${data.penilaian.nilai} (Skor: ${parseFloat(data.penilaian.skor).toFixed(2)})`;
                    }

                    // Update dynamic hierarchical scores
                    if (data.scores) {
                        // Grand Total
                        const gt = document.getElementById('cardGrandTotal');
                        if (gt) gt.textContent = parseFloat(data.scores.grand_total).toFixed(2);

                        // Evaluated count
                        const evCnt = document.getElementById('progressEvaluated');
                        if (evCnt) evCnt.textContent = data.scores.evaluated_cnt;

                        // Komponen scores
                        for (const [kId, kData] of Object.entries(data.scores.komponen)) {
                            const scoreEl = document.getElementById(`kompScore-${kId}`);
                            const headerScoreEl = document.getElementById(`headerKompScore-${kId}`);
                            const barEl = document.getElementById(`kompBar-${kId}`);
                            const percentEl = document.getElementById(`kompPercent-${kId}`);

                            if (scoreEl) scoreEl.textContent = parseFloat(kData.skor).toFixed(2);
                            if (headerScoreEl) headerScoreEl.textContent = parseFloat(kData.skor).toFixed(2);
                            if (barEl) barEl.style.width = `${kData.persentase}%`;
                            if (percentEl) percentEl.textContent = `${kData.persentase}%`;
                        }

                        // Subkomponen scores
                        for (const [subKode, subData] of Object.entries(data.scores.subkomponen)) {
                            const safeSub = subKode.replace(/\./g, '-');
                            const subScoreEl = document.getElementById(`subScore-${safeSub}`);
                            if (subScoreEl) subScoreEl.textContent = parseFloat(subData.skor).toFixed(2);
                        }
                    }
                } else {
                    showToast(data.message || 'Gagal menyimpan nilai.', false);
                }
            })
            .catch(err => {
                console.error(err);
                button.disabled = false;
                button.innerHTML = '<i class="bi bi-save me-1"></i> Simpan Nilai';
                showToast('Terjadi kesalahan jaringan saat menyimpan nilai.', false);
            });
        });
    });
});
</script>
@endpush
@endsection
