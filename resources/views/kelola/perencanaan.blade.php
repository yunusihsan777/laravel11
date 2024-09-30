@extends('layouts.app')

@section('title', 'Perencanaan')

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <h2>Perencanaan</h2>
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <!-- Cek tab aktif dari session atau default ke renstra -->
                    @php
                        $activeTab = session('active_tab', 'renstra'); // Default ke renstra
                    @endphp
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'renstra' ? 'active' : '' }}" id="renstra-tab" data-bs-toggle="tab" href="#renstra" role="tab" aria-controls="renstra" aria-selected="{{ $activeTab == 'renstra' ? 'true' : 'false' }}">Renstra</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'iku' ? 'active' : '' }}" id="iku-tab" data-bs-toggle="tab" href="#iku" role="tab" aria-controls="iku" aria-selected="{{ $activeTab == 'iku' ? 'true' : 'false' }}">IKU</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'renja' ? 'active' : '' }}" id="renja-tab" data-bs-toggle="tab" href="#renja" role="tab"
                                aria-controls="renja" aria-selected="{{ $activeTab == 'renja' ? 'true' : 'false' }}">Renja</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="rkakl-tab" data-bs-toggle="tab" href="#rkakl" role="tab"
                                aria-controls="rkakl" aria-selected="false">RKAKL</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="dipa-tab" data-bs-toggle="tab" href="#dipa" role="tab"
                                aria-controls="dipa" aria-selected="false">DIPA</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="rencana-aksi-tab" data-bs-toggle="tab" href="#rencana-aksi"
                                role="tab" aria-controls="rencana-aksi" aria-selected="false">Rencana Aksi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="perjanjian-kinerja-tab" data-bs-toggle="tab" href="#perjanjian-kinerja"
                                role="tab" aria-controls="perjanjian-kinerja" aria-selected="false">Perjanjian
                                Kinerja</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="cetak-pk-tab" data-bs-toggle="tab" href="#cetak-pk" role="tab"
                                aria-controls="cetak-pk" aria-selected="false">Cetak PK</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade {{ $activeTab == 'renstra' ? 'show active' : '' }}" id="renstra" role="tabpanel" aria-labelledby="renstra-tab">
                            <div class="renstra-content">
                                <h3>Rencana Strategis (Renstra) Tahun 2024 - 2029</h3>
                                <p>Rencana Strategis (Renstra) merupakan dokumen perencanaan yang menetapkan tujuan,
                                    sasaran, strategi, kebijakan, program, dan kegiatan pembangunan dalam jangka waktu
                                    lima tahun.</p>

                                <!-- Form Upload File -->
                                <div>
                                    <div class="card shadow-sm">
                                        <div class="card-header text-white" style="background-color: #e6bf3e;">
                                            <h4 class="mb-0">Upload File Renstra</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Form Upload File Renstra -->
                                            <form action="{{ route('upload.renstra') }}" method="POST"
                                                enctype="multipart/form-data" class="mb-4">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="renstra_file" class="form-label">Upload File PDF
                                                        Renstra</label>
                                                    <input type="file" class="form-control" id="renstra_file"
                                                        name="renstra_file" accept=".pdf" required>
                                                </div>
                                                <button type="submit" class="btn btn-warning btn-block">Upload
                                                    File</button>
                                            </form>

                                            <!-- Alert for success -->
                                            @if (session('success'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <!-- Tabel Renstra -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>File Renstra</th>
                                                            <th>Versi</th>
                                                            <th>Tanggal Upload</th>
                                                            {{-- <th>Aksi</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($renstra as $index => $item)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    <a href="{{ asset('uploads/renstra/renstra_' . $item->id_perubahan . '_' . $item->id_satker . '_' .$tahun . '.pdf') }}"
                                                                        target="_blank"
                                                                        style="text-decoration: none; color: inherit;">
                                                                        {{ $item->id_periode == 'P1' ? 'Periode 2020 - 2024' : 'Periode 2025 - 2029' }}
                                                                    </a>
                                                                </td>

                                                                <td>{{ $item->id_perubahan }}</td>
                                                                <td>{{ $item->id_tglupload }}</td>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $activeTab == 'iku' ? 'show active' : '' }}" id="iku" role="tabpanel" aria-labelledby="iku-tab">
                            <div class="iku-content">
                                <h3>Indikator Kinerja Utama (IKU)</h3>
                                <p>Indikator Kinerja Utama (IKU) merupakan dokumen ....</p>

                                <!-- Form Upload File -->
                                <div>
                                    <div class="card shadow-sm">
                                        <div class="card-header text-white" style="background-color: #e6bf3e;">
                                            <h4 class="mb-0">Upload File IKU</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Form Upload File IKU -->
                                            <form action="{{ route('upload.iku') }}" method="POST"
                                                enctype="multipart/form-data" class="mb-4">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="iku_file" class="form-label">Upload File PDF Iku</label>
                                                    <input type="file" class="form-control" id="iku_file"
                                                        name="iku_file" accept=".pdf" required>
                                                </div>
                                                <button type="submit" class="btn btn-warning btn-block">Upload
                                                    File</button>
                                            </form>

                                            <!-- Alert for success -->
                                            @if (session('success'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <!-- Tabel iku -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>File Iku</th>
                                                            <th>Versi</th>
                                                            <th>Tanggal Upload</th>
                                                            {{-- <th>Aksi</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($iku as $index => $item)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    <a href="{{ asset('uploads/iku/IKU_' . $item->id_perubahan . '_' . $item->id_satker .'_'.$item->id_periode.'.pdf') }}"
                                                                        target="_blank"
                                                                        style="text-decoration: none; color: inherit;">
                                                                        {{ $item->id_periode }}
                                                                    </a>
                                                                </td>

                                                                <td>{{ $item->id_perubahan }}</td>
                                                                <td>{{ $item->id_tglupload }}</td>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $activeTab == 'renja' ? 'show active' : '' }}" id="renja" role="tabpanel" aria-labelledby="renja-tab">
                            <div class="renja-content">
                                <h3>Rencana Kerja Tahunan</h3>
                                <p>Rencana Kinerja Tahunan (RKT) merupakan penjabaran dari sasaran dan program yang telah
                                    ditetapkan dalam Iku, dan akan dilaksanakan oleh satuan organisasi/kerja melalui
                                    berbagai kegiatan tahunan.</p>

                                <p>Rencana Kinerja Tahunan (RKT) adalah dokumen perencanaan untuk periode 1 (satu) tahun
                                    sebagai penjabaran dari sasaran dan program yang telah ditetapkan dalam Rencana
                                    Startegis (Iku) mencangkup periode tahunan yang sifatnya sangat strategis karena
                                    menjembatani perencanaan strategis jangka menengah dengan perencanaan tahunan. Dengan
                                    demikian, RKT berperan memelihara konsistensi antara capaian tujuan perencanaan
                                    strategis jangka menengah yang tercantum dalam Iku dengan tujuan perencanaan tahunan
                                    pembangunan. Penyusunan rencana kinerja dilakukan seiring dengan agenda penyusunan dan
                                    kebijakan anggaran, serta merupakan komitmen bagi instansi untuk mencapainya dalam tahun
                                    tertentu.</p>

                                <!-- Form Upload File -->
                                <div>
                                    <div class="card shadow-sm">
                                        <div class="card-header text-white" style="background-color: #e6bf3e;">
                                            <h4 class="mb-0">Upload File Renja</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Form Upload File Renja -->
                                            <form action="{{ route('upload.renja') }}" method="POST"
                                                enctype="multipart/form-data" class="mb-4">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="renja_file" class="form-label">Upload File PDF Renja</label>
                                                    <input type="file" class="form-control" id="renja_file"
                                                        name="renja_file" accept=".pdf" required>
                                                </div>
                                                <button type="submit" class="btn btn-warning btn-block">Upload
                                                    File</button>
                                            </form>

                                            <!-- Alert for success -->
                                            @if (session('success'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <!-- Tabel renja -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>File Renja</th>
                                                            <th>Versi</th>
                                                            <th>Tanggal Upload</th>
                                                            {{-- <th>Aksi</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($renja as $index => $item)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    <a href="{{ asset('uploads/renja/renja_' . $item->id_perubahan . '_' . $item->id_satker .'_'. $tahun.'.pdf') }}"
                                                                        target="_blank"
                                                                        style="text-decoration: none; color: inherit;">
                                                                        {{ $item->id_periode }}
                                                                    </a>
                                                                </td>

                                                                <td>{{ $item->id_perubahan }}</td>
                                                                <td>{{ $item->id_tglupload }}</td>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="rkakl" role="tabpanel" aria-labelledby="rkakl-tab">
                            <div class="rkakl-content">
                                <h3>Rencana Kerja Anggaran Kementerian atau Lembaga</h3>
                                <p>Data Kebutuhan Riil (Periode Awal tahun dengan rumus -1 TA) silahkan masukkan data
                                    kebutuhan RIIL satker anda.
                                    Rencana Kerja Anggaran (RKA) bertujuan untuk merencanakan penganggaran kebutuhan dana
                                    dari berbagai program dan kegiatan di masa yang akan datang. Dengan Penyusunan RKA dapat
                                    merencanakan penggunaan dana agar bisa seefisien mungkin. program-program yang
                                    direncanakan dan akan dilaksanakan menghasilkan output dan outcome yang bermanfaat bagi
                                    kepentingan publik </p>

                                <!-- Form Upload File -->
                                <div>
                                    <div class="card shadow-sm">
                                        <div class="card-header text-white" style="background-color: #e6bf3e;">
                                            <h4 class="mb-0">UPLOAD Rencana Kerja Anggaran Kementerian atau Lembaga SATKER ANDA</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Form Upload File Rkakl -->
                                            <form action="" method="POST" enctype="multipart/form-data"
                                                class="mb-4">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="rkakl_file" class="form-label">Upload File PDF
                                                        RKAKL</label>
                                                    <input type="file" class="form-control" id="rkakl_file"
                                                        name="rkakl_file" accept=".pdf" required>
                                                </div>
                                                <button type="submit" class="btn btn-warning btn-block">Upload
                                                    File</button>
                                            </form>

                                            <!-- Alert for success -->
                                            @if (session('success'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <!-- Tabel rkakl -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>File RKAKL</th>
                                                            <th>Versi</th>
                                                            <th>Tanggal Upload</th>
                                                            {{-- <th>Aksi</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($rkakl as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>
                                                                <a href="{{ asset('uploads/rkakl/rkakl_' . $item->id_perubahan . '_' . $item->id_satker .'_'. $tahun.'.pdf') }}"
                                                                    target="_blank"
                                                                    style="text-decoration: none; color: inherit;">
                                                                    {{ $item->id_periode }}
                                                                </a>
                                                            </td>

                                                            <td>{{ $item->id_perubahan }}</td>
                                                            <td>{{ $item->id_tglupload }}</td>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="dipa" role="tabpanel" aria-labelledby="dipa-tab">
                            <div class="rkakl-content">
                                <h3>Daftar Isian Pelaksanaan Anggaran (DIPA)</h3>
                                <p>Daftar Isian Pelaksanaan Anggaran (DIPA) ...</p>

                                <!-- Form Upload File -->
                                <div>
                                    <div class="card shadow-sm">
                                        <div class="card-header text-white" style="background-color: #e6bf3e;">
                                            <h4 class="mb-0">UPLOAD DIPA SATKER ANDA</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Form Upload File Dipa -->
                                            <form action="" method="POST" enctype="multipart/form-data"
                                                class="mb-4">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="dipa_file" class="form-label">Upload File PDF
                                                        Dipa</label>
                                                    <input type="file" class="form-control" id="dipa_file"
                                                        name="dipa_file" accept=".pdf" required>
                                                </div>
                                                <button type="submit" class="btn btn-warning btn-block">Upload
                                                    File</button>
                                            </form>

                                            <!-- Alert for success -->
                                            @if (session('success'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <!-- Tabel dipa -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>File Dipa</th>
                                                            <th>Versi</th>
                                                            <th>Tanggal Upload</th>
                                                            {{-- <th>Aksi</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dipa as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>
                                                                <a href="{{ asset('uploads/dipa/dipa_' . $item->id_perubahan . '_' . $item->id_satker .'_'. $tahun.'.pdf') }}"
                                                                    target="_blank"
                                                                    style="text-decoration: none; color: inherit;">
                                                                    {{ $item->id_periode }}
                                                                </a>
                                                            </td>

                                                            <td>{{ $item->id_perubahan }}</td>
                                                            <td>{{ $item->id_tglupload }}</td>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="rencana-aksi" role="tabpanel" aria-labelledby="rencana-aksi-tab">
                            <h2>Rencana Aksi</h2>
                            <p>Content for Rencana Aksi goes here...</p>
                        </div>

                        <div class="tab-pane fade" id="perjanjian-kinerja" role="tabpanel"
                            aria-labelledby="perjanjian-kinerja-tab">
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
            width: 12.5%;
            /* Make each tab take equal space */
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

        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Menghilangkan alert setelah 5 detik
        setTimeout(function() {
            let successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s ease';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500); // Hapus elemen setelah transisi selesai
            }
        }, 5000); // 5 detik
    </script>
@endsection
