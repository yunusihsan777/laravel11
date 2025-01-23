@extends('layouts.app')

@section('title', 'Kelola Data')

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card border-light shadow-sm">
                <div class="card border-light shadow-sm" style="background-color: #e3e2e2;">
                    <center>
                        <h2><b>Kelola Data</b></h2>
                    </center>
                </div>
                <div class="card-body">

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="kelolaDataTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="data-bidang-tab" data-bs-toggle="tab" href="#data-bidang"
                                role="tab" aria-controls="data-bidang" aria-selected="true">Data Bidang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="data-indikator-tab" data-bs-toggle="tab" href="#data-indikator"
                                role="tab" aria-controls="data-indikator" aria-selected="false">Data Indikator</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="data-saspro-tab" data-bs-toggle="tab" href="#data-saspro" role="tab"
                                aria-controls="data-saspro" aria-selected="false">Data Saspro</a>
                        </li>
                    </ul>
                    <br>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Tabs Content -->
                    <div class="tab-content" id="kelolaDataTabContent">
                        <!-- Data Bidang -->
                        <div class="tab-pane fade show active" id="data-bidang" role="tabpanel"
                            aria-labelledby="data-bidang-tab">
                            <br>
                            <center>
                                <h4><b>Input Data Bidang</b></h4>
                            </center>

                            {{-- Form Input/Create/Update --}}
                            <form action="{{ route('bidang.storeOrUpdateBidang') }}" method="POST" class="mb-4">
                                @csrf
                                <input type="hidden" name="id" value="{{ $bidang->id ?? '' }}">
                            
                                <div class="mb-3">
                                    <label for="bidang_nama" class="form-label">Nama Bidang</label>
                                    <input type="text" class="form-control" id="bidang_nama" name="bidang_nama"
                                        value="{{ $bidang->bidang_nama ?? '' }}" placeholder="Masukkan nama bidang" required>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="bidang_level" class="form-label">Bidang Level</label>
                                        <input type="number" class="form-control" id="bidang_level" name="bidang_level"
                                            value="{{ $bidang->bidang_level ?? '' }}" placeholder="Masukkan level bidang" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bidang_lokasi" class="form-label">Bidang Lokasi</label>
                                        <input type="number" class="form-control" id="bidang_lokasi" name="bidang_lokasi"
                                            value="{{ $bidang->bidang_lokasi ?? '' }}" placeholder="Masukkan lokasi bidang" required>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="rumpun" class="form-label">Rumpun</label>
                                        <input type="number" class="form-control" id="rumpun" name="rumpun"
                                            value="{{ $bidang->rumpun ?? '' }}" placeholder="Masukkan rumpun" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="hide" class="form-label">Hide</label>
                                        <input type="number" class="form-control" id="hide" name="hide"
                                            value="{{ $bidang->hide ?? '' }}" placeholder="Masukkan status hide (0/1)" required>
                                    </div>
                                </div>
                            
                                <button type="submit" class="btn btn-success">
                                    {{ isset($bidang) ? 'Update' : 'Simpan' }}
                                </button>
                            </form>

    {{-- Tabel Data Bidang --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Bidang</th>
                <th>Level</th>
                <th>Lokasi</th>
                <th>Rumpun</th>
                <th>Hide</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bidangs as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->bidang_nama }}</td>
                <td>{{ $data->bidang_level }}</td>
                <td>{{ $data->bidang_lokasi }}</td>
                <td>{{ $data->rumpun }}</td>
                <td>{{ $data->hide }}</td>
                <td>
                    <button class="btn btn-warning btn-sm edit-button" 
                            data-id="{{ $data->id }}" 
                            data-nama="{{ $data->bidang_nama }}" 
                            data-level="{{ $data->bidang_level }}" 
                            data-lokasi="{{ $data->bidang_lokasi }}" 
                            data-rumpun="{{ $data->rumpun }}" 
                            data-hide="{{ $data->hide }}">
                        Edit
                    </button>
                    <form action="{{ route('bidang.destroy', $data->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('bidang.storeOrUpdateBidang') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="modal_id">
    
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Bidang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
    
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="modal_nama_bidang" class="form-label">Nama Bidang</label>
                            <input type="text" class="form-control" id="modal_nama_bidang" name="bidang_nama" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="modal_bidang_level" class="form-label">Bidang Level</label>
                                <input type="number" class="form-control" id="modal_bidang_level" name="bidang_level" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="modal_bidang_lokasi" class="form-label">Bidang Lokasi</label>
                                <input type="number" class="form-control" id="modal_bidang_lokasi" name="bidang_lokasi" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="modal_rumpun" class="form-label">Rumpun</label>
                                <input type="number" class="form-control" id="modal_rumpun" name="rumpun" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="modal_hide" class="form-label">Hide</label>
                                <input type="number" class="form-control" id="modal_hide" name="hide" required>
                            </div>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<!-- Latar belakang semi-transparan -->
<div class="custom-opacity d-none" id="modalBackground"></div>
    
                        </div>

                        <!-- Data Indikator -->
                        <div class="tab-pane fade" id="data-indikator" role="tabpanel"
                            aria-labelledby="data-indikator-tab">
                            <br>
                            <center>
                                <h4><b>Input Data Indikator</b></h4>
                            </center>

                            <form method="POST" action="{{ route('indikator.store') }}">
                                @csrf

                                <!-- Bidang -->
                                <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                    <input type="text" class="form-control" id="bidang" name="bidang" required>
                                </div>

                                <!-- Row 1 -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipe">Tipe</label>
                                            <select class="form-control" id="tipe" name="tipe" required>
                                                <option value="lag">Lag</option>
                                                <option value="leg">Leg</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input type="number" class="form-control" id="link" name="link"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lingkup">Lingkup</label>
                                            <input type="number" class="form-control" id="lingkup" name="lingkup"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="indikator_nama">Indikator Nama</label>
                                            <input type="text" class="form-control" id="indikator_nama"
                                                name="indikator_nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="indikator_pembilang">Indikator Pembilang</label>
                                            <input type="text" class="form-control" id="indikator_pembilang"
                                                name="indikator_pembilang" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="indikator_penyebut">Indikator Penyebut</label>
                                            <input type="text" class="form-control" id="indikator_penyebut"
                                                name="indikator_penyebut" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Indikator Penjelasan -->
                                <div class="form-group">
                                    <label for="indikator_penjelasan">Indikator Penjelasan</label>
                                    <textarea class="form-control" id="indikator_penjelasan" name="indikator_penjelasan" rows="3" required></textarea>
                                </div>

                                <!-- Matrix -->
                                <div class="form-group">
                                    <label for="matrix">Matrix</label>
                                    <textarea class="form-control" id="matrix" name="matrix" rows="3" required></textarea>
                                </div>
                                <br>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <br>
                        <!-- Data Saspro -->
                        <div class="tab-pane fade" id="data-saspro" role="tabpanel" aria-labelledby="data-saspro-tab">
                            <center>
                                <h4><b>Input Data Saspro</b></h4>
                            </center>

                            <form method="POST" action="{{ route('saspro.store') }}">
                                @csrf

                                <!-- Link -->
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control" id="link" name="link"
                                        placeholder="Masukkan Link" required>
                                </div>

                                <!-- Nama Saspro -->
                                <div class="form-group">
                                    <label for="saspro_nama">Nama Saspro</label>
                                    <input type="text" class="form-control" id="saspro_nama" name="saspro_nama"
                                        placeholder="Masukkan Nama Saspro" required>
                                </div>

                                <!-- Penjelasan Saspro -->
                                <div class="form-group">
                                    <label for="penjelasan_saspro">Penjelasan Saspro</label>
                                    <textarea class="form-control" id="penjelasan_saspro" name="penjelasan_saspro" rows="3"
                                        placeholder="Masukkan Penjelasan Saspro" required></textarea>
                                </div>

                                <!-- Lingkup -->
                                <div class="form-group">
                                    <label for="lingkup">Lingkup</label>
                                    <input type="text" class="form-control" id="lingkup" name="lingkup"
                                        placeholder="Masukkan Lingkup" required>
                                </div>
                                <br>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-button');
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Ambil data dari atribut tombol
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const level = this.dataset.level;
                const lokasi = this.dataset.lokasi;
                const rumpun = this.dataset.rumpun;
                const hide = this.dataset.hide;

                // Set nilai ke dalam form modal
                document.getElementById('modal_id').value = id;
                document.getElementById('modal_nama_bidang').value = nama;
                document.getElementById('modal_bidang_level').value = level;
                document.getElementById('modal_bidang_lokasi').value = lokasi;
                document.getElementById('modal_rumpun').value = rumpun;
                document.getElementById('modal_hide').value = hide;

                // Tampilkan modal
                editModal.show();
            });
        });
        
    });
    

</script>
<style>
  /* CSS untuk modal */
body {
    overflow-x: hidden; /* Pastikan hanya scroll vertikal yang diperbolehkan */
}

/* Latar belakang dengan efek opacity */
.custom-opacity {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang semi-transparan */
    z-index: 1040; /* Pastikan di atas konten halaman */
    pointer-events: none; /* Agar latar belakang tidak menghalangi interaksi dengan modal */
}

/* Pastikan modal berada di atas latar belakang dan konten lain */
.modal {
    z-index: 1050;
}

</style>

{{-- <style>
    .modal-backdrop {
    z-index: 1040 !important;
}

.modal {
    z-index: 1050 !important;
}

</style> --}}