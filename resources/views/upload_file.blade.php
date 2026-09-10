@extends('layouts.app')

@section('title', 'Upload Bukti Dukung')

@section('content')
<div class="content" id="content">
    <div class="container-fluid px-0">

        <!-- Header Card -->
        <div class="card page-hero-card mb-4 border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-warning text-dark px-2 py-1 fw-bold">
                                <i class="bi bi-cloud-arrow-up-fill me-1"></i>Modul Input File
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1 text-white">Unggah Bukti Dukung SAKIP</h3>
                        <p class="text-white-50 mb-0 small">
                            Silakan pilih kategori bukti dukung dan lampirkan berkas dokumen resmi dalam format PDF (maks. 2MB).
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dataLke') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-list-check me-1"></i> Lihat Bukti Dukung
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-3 p-2 text-white" style="background: var(--kj-emerald);">
                                <i class="bi bi-file-earmark-arrow-up-fill fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Form Pengunggahan Dokumen</h5>
                                <small class="text-muted">Pastikan dokumen telah ditandatangani dan valid</small>
                            </div>
                        </div>
                        <span class="badge bg-light text-secondary border">Format: PDF</span>
                    </div>

                    <div class="card-body p-4">
                        {{-- Notifikasi Sukses --}}
                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center gap-2 py-3 px-4 rounded-3 border-0 shadow-sm mb-4">
                                <i class="bi bi-check-circle-fill fs-4 text-success flex-shrink-0"></i>
                                <div>
                                    <div class="fw-bold">Unggah Berhasil!</div>
                                    <small>{{ session('success') }}</small>
                                </div>
                            </div>
                        @endif

                        {{-- Notifikasi Error --}}
                        @if($errors->any())
                            <div class="alert alert-danger py-3 px-4 rounded-3 border-0 shadow-sm mb-4">
                                <div class="d-flex align-items-center gap-2 fw-bold mb-1 text-danger">
                                    <i class="bi bi-exclamation-triangle-fill"></i> Terjadi Kesalahan
                                </div>
                                <ul class="mb-0 ps-3 small">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" id="uploadBuktiForm">
                            @csrf

                            <!-- Step 1: Pilihan Bukti Dukung -->
                            <div class="mb-4">
                                <label for="id_bukti" class="form-label">
                                    <i class="bi bi-tag-fill text-warning me-1"></i>1. Pilih Kategori Bukti Dukung
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select select2" name="id_bukti" id="id_bukti" required>
                                    <option value="">-- Cari atau Pilih Kategori Bukti Dukung --</option>
                                    @foreach($input as $item)
                                        <option value="{{ $item->id }}" {{ old('id_bukti') == $item->id ? 'selected' : '' }}>
                                            {{ $item->dokumen }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text small text-muted mt-1">
                                    Ketik nama dokumen untuk memfilter pilihan secara cepat.
                                </div>
                            </div>

                            <!-- Step 2: Triwulan (Dinamis) -->
                            <div class="mb-4 p-3 rounded-3 border" id="tw-group" style="display:none; background-color: #fefce8; border-color: #fef08a !important;">
                                <label for="tw" class="form-label text-warning-emphasis">
                                    <i class="bi bi-calendar3 me-1 text-warning"></i>2. Pilih Periode Triwulan
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="tw" id="tw" class="form-select">
                                    <option value="">-- Pilih Triwulan --</option>
                                    <option value="TW I" {{ old('tw') == 'TW I' ? 'selected' : '' }}>Triwulan I (TW I)</option>
                                    <option value="TW II" {{ old('tw') == 'TW II' ? 'selected' : '' }}>Triwulan II (TW II)</option>
                                    <option value="TW III" {{ old('tw') == 'TW III' ? 'selected' : '' }}>Triwulan III (TW III)</option>
                                    <option value="TW IV" {{ old('tw') == 'TW IV' ? 'selected' : '' }}>Triwulan IV (TW IV)</option>
                                </select>
                                <div class="small text-muted mt-1">
                                    Dokumen ini memerlukan spesifikasi periode triwulan pelaksanaan.
                                </div>
                            </div>

                            <!-- Step 3: Area Unggah File (Dropzone Modern) -->
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="bi bi-file-earmark-pdf-fill text-warning me-1"></i>3. Lampirkan Berkas PDF
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="custom-file-dropzone" id="dropzoneBox">
                                    <input type="file" id="file" name="file" accept=".pdf" required>
                                    <div class="dropzone-default-content" id="dropzoneDefault">
                                        <div class="dropzone-icon">
                                            <i class="bi bi-cloud-arrow-up"></i>
                                        </div>
                                        <h6 class="fw-bold mb-1 text-dark">Tarik & Letakkan Berkas PDF di Sini</h6>
                                        <p class="text-muted small mb-2">atau <span class="text-primary fw-semibold text-decoration-underline">klik untuk memilih berkas dari komputer</span></p>
                                        <span class="badge bg-light text-muted border">Maksimal Ukuran File: 2 MB</span>
                                    </div>
                                    <div class="dropzone-selected-content d-none" id="dropzoneSelected">
                                        <div class="file-selected-pill mb-2">
                                            <i class="bi bi-file-earmark-check-fill fs-5 text-success"></i>
                                            <span id="selectedFileName">Nama File.pdf</span>
                                            <span class="badge bg-white text-success border ms-1" id="selectedFileSize">0 KB</span>
                                        </div>
                                        <div class="small text-muted">Klik kembali pada area ini jika ingin mengganti berkas</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-emerald py-3 fw-bold shadow-sm" id="btnSubmitUpload">
                                    <i class="bi bi-cloud-upload-fill fs-5 me-2"></i>
                                    <span>Unggah Dokumen Bukti Dukung</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const idBuktiSelect = document.getElementById('id_bukti');
        const twGroup = document.getElementById('tw-group');
        const twSelect = document.getElementById('tw');
        const fileInput = document.getElementById('file');
        const dropzoneDefault = document.getElementById('dropzoneDefault');
        const dropzoneSelected = document.getElementById('dropzoneSelected');
        const selectedFileName = document.getElementById('selectedFileName');
        const selectedFileSize = document.getElementById('selectedFileSize');

        const idsWithTw = [10, 11, 12, 13, 14, 18, 19, 37, 38, 39, 40];

        function checkTwRequirement(selectedId) {
            if (idsWithTw.includes(selectedId)) {
                twGroup.style.display = 'block';
                twSelect.setAttribute('required', 'required');
            } else {
                twGroup.style.display = 'none';
                twSelect.removeAttribute('required');
            }
        }

        // Check on change
        idBuktiSelect.addEventListener('change', function () {
            const selectedId = parseInt(this.value);
            checkTwRequirement(selectedId);
        });

        // Check on initial load if old value exists
        if (idBuktiSelect.value) {
            checkTwRequirement(parseInt(idBuktiSelect.value));
        }

        // File selection detection
        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                selectedFileName.textContent = file.name;
                const sizeInKb = Math.round(file.size / 1024);
                selectedFileSize.textContent = sizeInKb > 1024 ? (sizeInKb / 1024).toFixed(1) + ' MB' : sizeInKb + ' KB';
                dropzoneDefault.classList.add('d-none');
                dropzoneSelected.classList.remove('d-none');
            } else {
                dropzoneDefault.classList.remove('d-none');
                dropzoneSelected.classList.add('d-none');
            }
        });
    });
</script>
@endpush
@endsection
