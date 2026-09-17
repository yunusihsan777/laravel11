@extends('layouts.app')

@section('content')
<div class="content" id="content">
<div class="container-fluid py-4 px-4">
    <!-- Header Page -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-file-earmark-text text-primary me-2"></i>Master Bukti Dukung
            </h3>
            <p class="text-muted mb-0 text-sm">
                Kelola daftar master bukti dukung LKE yang tersedia dalam sistem.
            </p>
        </div>
        <div class="mt-2 mt-md-0">
            <span class="badge bg-primary px-3 py-2 text-xs rounded-pill">
                <i class="bi bi-shield-lock-fill me-1"></i> Mode Administrator
            </span>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Gagal menyimpan data:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tableMasterBukti">
                    <thead class="table-light text-secondary text-xs text-uppercase">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 45%">Nama Dokumen</th>
                            <th style="width: 25%">Tabel Sumber</th>
                            <th style="width: 10%" class="text-center">Tahun</th>
                            <th style="width: 15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($masterBukti as $index => $bukti)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="fw-medium text-dark">{{ $bukti->dokumen }}</td>
                                <td>
                                    @if($bukti->tabel_sumber)
                                        <span class="badge bg-light text-dark border"><i class="bi bi-database me-1 text-muted"></i>{{ $bukti->tabel_sumber }}</span>
                                    @else
                                        <span class="badge bg-light text-muted border fst-italic">Kosong</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info bg-opacity-10 text-info">{{ $bukti->tahun ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 edit-btn"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal"
                                        data-id="{{ $bukti->id }}"
                                        data-dokumen="{{ $bukti->dokumen }}"
                                        data-tabel="{{ $bukti->tabel_sumber }}"
                                        data-tahun="{{ $bukti->tahun }}">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header bg-light border-bottom-0 rounded-top-4 pb-3">
                <h5 class="modal-title fw-bold text-dark" id="editModalLabel"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Bukti Dukung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="editForm">
                @csrf
                <div class="modal-body px-4 py-4">
                    <div class="mb-3">
                        <label for="dokumen" class="form-label fw-medium text-secondary text-sm">Nama Dokumen</label>
                        <input type="text" class="form-control rounded-3" id="dokumen" name="dokumen" placeholder="Nama bukti dukung..." required>
                        <div class="form-text mt-1 text-muted">
                            <i class="bi bi-info-circle me-1"></i>Isi sebelumnya: <span id="prev_dokumen" class="fw-semibold text-dark"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tabel_sumber" class="form-label fw-medium text-secondary text-sm">Tabel Sumber</label>
                        <select class="form-select rounded-3 select2" id="tabel_sumber" name="tabel_sumber" required>
                            <option value="">-- Pilih Tabel Sumber --</option>
                            @foreach($tabelSumberList as $tabel)
                                <option value="{{ $tabel }}">{{ $tabel }}</option>
                            @endforeach
                        </select>
                        <div class="form-text mt-1 text-muted">
                            <i class="bi bi-info-circle me-1"></i>Tabel sumber sebelumnya: <span id="prev_tabel" class="fw-semibold text-dark"></span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="tahun" class="form-label fw-medium text-secondary text-sm">Tahun</label>
                        <select class="form-select rounded-3" id="tahun" name="tahun" required>
                            <option value="">-- Pilih Tahun --</option>
                            @foreach($tahunList as $thn)
                                <option value="{{ $thn }}">{{ $thn }}</option>
                            @endforeach
                        </select>
                        <div class="form-text mt-1 text-muted">
                            <i class="bi bi-info-circle me-1"></i>Tahun sebelumnya: <span id="prev_tahun" class="fw-semibold text-dark"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 rounded-bottom-4 pt-2 pb-3 px-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        if ($.fn.DataTable) {
            $('#tableMasterBukti').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                "pageLength": 25
            });
        }

        // Event listener saat modal akan ditampilkan (Bootstrap 5 native event)
        const editModalEl = document.getElementById('editModal');
        if (editModalEl) {
            editModalEl.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                if (!button) return;

                const id = button.getAttribute('data-id') || '';
                const dokumen = button.getAttribute('data-dokumen') || '';
                const tabel = button.getAttribute('data-tabel') || '';
                const tahun = button.getAttribute('data-tahun') || '';

                // Set action URL pada form
                $('#editForm').attr('action', `/lke/master-bukti/update/${id}`);

                // Isi nilai input form
                $('#dokumen').val(dokumen).attr('placeholder', dokumen || 'Nama bukti dukung...');
                $('#tabel_sumber').val(tabel);
                $('#tahun').val(tahun);

                // Tampilkan info teks sebelumnya
                $('#prev_dokumen').text(dokumen || '-');
                $('#prev_tabel').text(tabel || '-');
                $('#prev_tahun').text(tahun || '-');
            });
        }

        // Backup event handler dengan delegated click jQuery
        $(document).on('click', '.edit-btn', function() {
            const id = $(this).attr('data-id');
            const dokumen = $(this).attr('data-dokumen') || '';
            const tabel = $(this).attr('data-tabel') || '';
            const tahun = $(this).attr('data-tahun') || '';

            $('#editForm').attr('action', `/lke/master-bukti/update/${id}`);

            $('#dokumen').val(dokumen).attr('placeholder', dokumen || 'Nama bukti dukung...');
            $('#tabel_sumber').val(tabel);
            $('#tahun').val(tahun);

            $('#prev_dokumen').text(dokumen || '-');
            $('#prev_tabel').text(tabel || '-');
            $('#prev_tahun').text(tahun || '-');
        });
    });
</script>
@endpush
@endsection
