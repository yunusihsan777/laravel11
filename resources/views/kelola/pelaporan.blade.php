@extends('layouts.app')

@section('title', 'Pelaporan')

@section('content')
    @php
        $levelSakip = session('id_sakip_level', 0);
    @endphp
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card border-light shadow-sm">
                <div class="card border-light shadow-sm" style="background-color: #e3e2e2;">
                    <center>
                        <h2><b>Pelaporan</b></h2>
                    </center>
                </div>
                <div class="card-body">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @if ($levelSakip == 99)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="triwulan1-tab" data-bs-toggle="tab" href="#triwulan1" role="tab"
                                    aria-controls="triwulan1" aria-selected="true">Capaian Triwulan I</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="triwulan2-tab" data-bs-toggle="tab" href="#triwulan2" role="tab"
                                    aria-controls="triwulan2" aria-selected="false">Capaian Triwulan II</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="triwulan3-tab" data-bs-toggle="tab" href="#triwulan3" role="tab"
                                    aria-controls="triwulan3" aria-selected="false">Capaian Triwulan III</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="triwulan4-tab" data-bs-toggle="tab" href="#triwulan4" role="tab"
                                    aria-controls="triwulan4" aria-selected="false">Capaian Triwulan IV</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="lhe-akip-tab" data-bs-toggle="tab" href="#lhe-akip" role="tab"
                                    aria-controls="lhe-akip" aria-selected="false">LHE AKIP</a>
                            </li>
                        @endif

                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="lkjip-tab" data-bs-toggle="tab" href="#lkjip" role="tab"
                                aria-controls="lkjip" aria-selected="false">Laporan Kinerja (LKJiP)</a>
                        </li>

                        @if ($levelSakip == 99)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="validasi-apip-tab" data-bs-toggle="tab" href="#validasi-apip"
                                    role="tab" aria-controls="validasi-apip" aria-selected="false">Validasi APIP</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content mt-3" id="myTabContent">
                        @if ($levelSakip == 99)
                            <div class="tab-pane fade" id="triwulan1" role="tabpanel" aria-labelledby="triwulan1-tab">
                                <h5>Capaian Triwulan I</h5>
                                <p>Content for Capaian Triwulan I goes here.</p>
                            </div>
                            <div class="tab-pane fade" id="triwulan2" role="tabpanel" aria-labelledby="triwulan2-tab">
                                <h5>Capaian Triwulan II</h5>
                                <p>Content for Capaian Triwulan II goes here.</p>
                            </div>
                            <div class="tab-pane fade" id="triwulan3" role="tabpanel" aria-labelledby="triwulan3-tab">
                                <h5>Capaian Triwulan III</h5>
                                <p>Content for Capaian Triwulan III goes here.</p>
                            </div>
                            <div class="tab-pane fade" id="triwulan4" role="tabpanel" aria-labelledby="triwulan4-tab">
                                <h5>Capaian Triwulan IV</h5>
                                <p>Content for Capaian Triwulan IV goes here.</p>
                            </div>
                            <div class="tab-pane fade" id="lhe-akip" role="tabpanel" aria-labelledby="lhe-akip-tab">
                                <h5>LHE AKIP</h5>
                                <p>Content for LHE AKIP goes here.</p>
                            </div>
                        @endif

                        <div class="tab-pane fade show active" id="lkjip" role="tabpanel" aria-labelledby="lkjip-tab">
                            <h5>Laporan Kinerja (LKJiP)</h5>

                            <!-- Form Upload File -->
                            <div class="card shadow-sm mb-3">
                                <div class="card-header text-white" style="background-color: #e6bf3e;">
                                    <h6 class="mb-0">Upload Dokumen LKJiP</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('upload.lkjip') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="triwulan" class="form-label">Pilih Triwulan</label>
                                            <select class="form-control" id="triwulan" name="triwulan" required>
                                                <option value="" disabled selected>Pilih Triwulan</option>
                                                <option value="1">Triwulan 1</option>
                                                <option value="2">Triwulan 2</option>
                                                <option value="3">Triwulan 3</option>
                                                <option value="4">Triwulan 4</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lkjip_file" class="form-label">Upload File PDF (Max: 4MB)</label>
                                            <input type="file" class="form-control" id="lkjip_file" name="lkjip_file"
                                                accept=".pdf" required>
                                        </div>
                                        <button type="submit" class="btn btn-block"
                                            style="background-color: #e6bf3e;">Upload File</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Alert jika upload sukses -->
                            @if (session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Tabel Data LKJiP -->
                            <!-- Tabel Data LKJiP -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-warning"> <!-- Mengubah warna header tabel menjadi kuning -->
                                        <tr>
                                            <th>No</th>
                                            <th>Nama File</th>
                                            <th>Triwulan</th>
                                            <th>Versi</th>
                                            <th>Tanggal Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lkjipFiles as $index => $file)
                                            <tr class="bg-warning bg-opacity-25">
                                                <!-- Mengubah warna isi tabel menjadi kuning muda -->
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <a href="{{ asset('uploads/lkjip/' . $file->id_filename) }}"
                                                        target="_blank">
                                                        LKJIP
                                                        ({{ \Carbon\Carbon::parse($file->id_tglupload)->format('Y') }}) -
                                                        Triwulan {{ $file->triwulan }}
                                                    </a>
                                                </td>
                                                <td>Triwulan {{ $file->triwulan }}</td>
                                                <td>{{ $file->id_perubahan }}</td>
                                                <td>{{ \Carbon\Carbon::parse($file->id_tglupload)->format('d M Y H:i') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($levelSakip == 99)
                                <div class="tab-pane fade" id="validasi-apip" role="tabpanel"
                                    aria-labelledby="validasi-apip-tab">
                                    <h2>IKU</h2>
                                    <p>Content for IKU goes here...</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('styles')
        <style>
            .nav-tabs .nav-link {
                border: 1px solid #ddd;
                border-radius: 0.375rem;
                margin-right: -1px;
            }

            .nav-tabs .nav-link.active {
                background-color: #007bff;
                color: white;
                border-color: #007bff;
            }

            .nav-tabs {
                border-bottom: 1px solid #ddd;
            }

            .tab-content {
                padding: 15px;
                border: 1px solid #ddd;
                border-radius: 0.375rem;
                background-color: #f8f9fa;
            }

            .tab-pane {
                min-height: 200px;
                /* Adjust as needed */
            }
        </style>
    @endsection

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
