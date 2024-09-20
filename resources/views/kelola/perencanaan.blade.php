@extends('layouts.app')

@section('title', 'Perencanaan')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <h2>Perencanaan</h2>
    <div class="container mt-5">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="renstra-tab" data-bs-toggle="tab" href="#renstra" role="tab" aria-controls="renstra" aria-selected="true">Renstra</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="iku-tab" data-bs-toggle="tab" href="#iku" role="tab" aria-controls="iku" aria-selected="false">IKU</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="renja-tab" data-bs-toggle="tab" href="#renja" role="tab" aria-controls="renja" aria-selected="false">Renja</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="rkakl-tab" data-bs-toggle="tab" href="#rkakl" role="tab" aria-controls="rkakl" aria-selected="false">RKAKL</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="dipa-tab" data-bs-toggle="tab" href="#dipa" role="tab" aria-controls="dipa" aria-selected="false">DIPA</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="rencana-aksi-tab" data-bs-toggle="tab" href="#rencana-aksi" role="tab" aria-controls="rencana-aksi" aria-selected="false">Rencana Aksi</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="perjanjian-kinerja-tab" data-bs-toggle="tab" href="#perjanjian-kinerja" role="tab" aria-controls="perjanjian-kinerja" aria-selected="false">Perjanjian Kinerja</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="cetak-pk-tab" data-bs-toggle="tab" href="#cetak-pk" role="tab" aria-controls="cetak-pk" aria-selected="false">Cetak PK</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="renstra" role="tabpanel" aria-labelledby="renstra-tab">
                        <h2>Renstra</h2>
                        <div class="renstra-content">
                            <h3>Rencana Strategis (Renstra) Tahun 2024 - 2029</h3>
                            <p>Rencana Strategis (Renstra) merupakan dokumen perencanaan yang menetapkan tujuan, sasaran, strategi, kebijakan, program, dan kegiatan pembangunan dalam jangka waktu lima tahun.</p>
                        
                            <!-- Form Upload File -->
                            <div class="container mt-5">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="mb-0">Upload File Renstra</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- Form Upload File Renstra -->
                                        <form action="" method="POST" enctype="multipart/form-data" class="mb-4">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="renstra_file" class="form-label">Upload File PDF Renstra</label>
                                                <input type="file" class="form-control" id="renstra_file" name="renstra_file" accept=".pdf" required>
                                            </div>
                                            <button type="submit" class="btn btn-warning btn-block">Upload File</button>
                                        </form>
                        
                                        <!-- Alert for success -->
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                        
                                        <!-- Tabel Renstra -->
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered align-middle">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>File Renstra</th>
                                                        <th>Versi</th>
                                                        <th>Tanggal Upload</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="iku" role="tabpanel" aria-labelledby="iku-tab">
                        <h2>IKU</h2>
                        <p>Content for IKU goes here...</p>
                    </div>

                    <div class="tab-pane fade" id="renja" role="tabpanel" aria-labelledby="renja-tab">
                        <h2>Renja</h2>
                        <p>Content for Renja goes here...</p>
                    </div>

                    <div class="tab-pane fade" id="rkakl" role="tabpanel" aria-labelledby="rkakl-tab">
                        <h2>RKAKL</h2>
                        <p>Content for RKAKL goes here...</p>
                    </div>

                    <div class="tab-pane fade" id="dipa" role="tabpanel" aria-labelledby="dipa-tab">
                        <h2>DIPA</h2>
                        <p>Content for DIPA goes here...</p>
                    </div>

                    <div class="tab-pane fade" id="rencana-aksi" role="tabpanel" aria-labelledby="rencana-aksi-tab">
                        <h2>Rencana Aksi</h2>
                        <p>Content for Rencana Aksi goes here...</p>
                    </div>

                    <div class="tab-pane fade" id="perjanjian-kinerja" role="tabpanel" aria-labelledby="perjanjian-kinerja-tab">
                        <h2>Perjanjian Kinerja</h2>
                        <p>Content for Perjanjian Kinerja goes here...</p>
                    </div>

                    <div class="tab-pane fade" id="cetak-pk" role="tabpanel" aria-labelledby="cetak-pk-tab">
                        <h2>Cetak PK</h2>
                        <p>Content for Cetak PK goes here...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
        /* Ensure the container and card take full width */
        .container {
            max-width: 100%;
        }

        /* Full-width tabs with 100% width card */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        /* Styling for the tabs */
        .nav-tabs .nav-link {
            width: 12.5%; /* Make each tab take equal space */
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
        }

        /* Active tab styling */
        .nav-tabs .nav-link.active {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Hover effect for the tabs */
        .nav-tabs .nav-link:hover {
            border-color: #007bff;
        }

        /* Styling for tab content */
        .tab-content {
            border-top: 1px solid #ddd;
            padding: 15px;
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
        }

        .table td, .table th {
            vertical-align: middle;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
