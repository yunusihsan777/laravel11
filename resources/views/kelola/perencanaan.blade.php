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
                            <a class="nav-link {{ $activeTab == 'renstra' ? 'active' : '' }}" id="renstra-tab"
                                data-bs-toggle="tab" href="#renstra" role="tab" aria-controls="renstra"
                                aria-selected="{{ $activeTab == 'renstra' ? 'true' : 'false' }}">Renstra</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'iku' ? 'active' : '' }}" id="iku-tab"
                                data-bs-toggle="tab" href="#iku" role="tab" aria-controls="iku"
                                aria-selected="{{ $activeTab == 'iku' ? 'true' : 'false' }}">IKU</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'renja' ? 'active' : '' }}" id="renja-tab"
                                data-bs-toggle="tab" href="#renja" role="tab" aria-controls="renja"
                                aria-selected="{{ $activeTab == 'renja' ? 'true' : 'false' }}">Renja</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'rkakl' ? 'active' : '' }}" id="rkakl-tab"
                                data-bs-toggle="tab" href="#rkakl" role="tab" aria-controls="rkakl"
                                aria-selected="{{ $activeTab == 'rkakl' ? 'true' : 'false' }}">RKAKL</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'dipa' ? 'active' : '' }}" id="dipa-tab"
                                data-bs-toggle="tab" href="#dipa" role="tab" aria-controls="dipa"
                                aria-selected="{{ $activeTab == 'dipa' ? 'true' : 'false' }}">DIPA</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'renaksi' ? 'active' : '' }}" id="renaksi-tab"
                                data-bs-toggle="tab" href="#renaksi" role="tab"
                                aria-controls="{{ $activeTab == 'renaksi' ? 'true' : 'false' }}"
                                aria-selected="false">Rencana Aksi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab == 'perjanjian-kinerja' ? 'active' : '' }}"
                                id="perjanjian-kinerja-tab" data-bs-toggle="tab" href="#perjanjian-kinerja" role="tab"
                                aria-controls="{{ $activeTab == 'perjanjian-kinerja' ? 'true' : 'false' }}"
                                aria-selected="false">Perjanjian Kinerja</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="cetak-pk-tab" data-bs-toggle="tab" href="#cetak-pk" role="tab"
                                aria-controls="cetak-pk" aria-selected="false">Cetak PK</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade {{ $activeTab == 'renstra' ? 'show active' : '' }}" id="renstra"
                            role="tabpanel" aria-labelledby="renstra-tab">
                            <div class="renstra-content">
                                @php
                                    if ($tahun == '2024') {
                                        $id_tahun = '2019 - 2024';
                                    } else {
                                        $id_tahun = '2025 - 2029';
                                    }
                                @endphp
                                <h3>Rencana Strategis (Renstra) Tahun {{ $id_tahun }}</h3>
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
                                                                    <a href="{{ asset('uploads/renstra/renstra_' . $item->id_perubahan . '_' . $item->id_satker . '_' . $tahun . '.pdf') }}"
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

                        <div class="tab-pane fade {{ $activeTab == 'iku' ? 'show active' : '' }}" id="iku"
                            role="tabpanel" aria-labelledby="iku-tab">
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
                                                                    <a href="{{ asset('uploads/iku/IKU_' . $item->id_perubahan . '_' . $item->id_satker . '_' . $item->id_periode . '.pdf') }}"
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

                        <div class="tab-pane fade {{ $activeTab == 'renja' ? 'show active' : '' }}" id="renja"
                            role="tabpanel" aria-labelledby="renja-tab">
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
                                                    <label for="renja_file" class="form-label">Upload File PDF
                                                        Renja</label>
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
                                                                    <a href="{{ asset('uploads/renja/renja_' . $item->id_perubahan . '_' . $item->id_satker . '_' . $tahun . '.pdf') }}"
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

                        <div class="tab-pane fade {{ $activeTab == 'rkakl' ? 'show active' : '' }}" id="rkakl"
                            role="tabpanel" aria-labelledby="rkakl-tab">
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
                                            <h4 class="mb-0">UPLOAD File RKAKL</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Form Upload File Rkakl -->
                                            <form action="{{ route('upload.rkakl') }}" method="POST"
                                                enctype="multipart/form-data" class="mb-4">
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
                                                                    <a href="{{ asset('uploads/rkakl/rkakl_' . $item->id_perubahan . '_' . $item->id_satker . '_' . $tahun . '.pdf') }}"
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

                        <div class="tab-pane fade {{ $activeTab == 'dipa' ? 'show active' : '' }}" id="dipa"
                            role="tabpanel" aria-labelledby="dipa-tab">
                            <div class="dipa-content">
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
                                            {{-- <form action="{{ route('upload.dipa') }}" method="POST" enctype="multipart/form-data" --}}
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
                                                            <th>Total Pagu</th>
                                                            <th>Program Penegakan dan Pelayanan Hukum</th>
                                                            <th>Program Dukungan Manajemen</th>
                                                            <th>Versi</th>
                                                            <th>Tanggal Upload</th>
                                                            {{-- <th>Aksi</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- @foreach ($dipa as $index => $item)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    <a href="{{ asset('uploads/dipa/dipa_' . $item->id_perubahan . '_' . $item->id_satker . '_' . $tahun . '.pdf') }}"
                                                                        target="_blank"
                                                                        style="text-decoration: none; color: inherit;">
                                                                        {{ $item->id_periode }}
                                                                    </a>
                                                                </td>

                                                                <td>{{ $item->id_pagu }}</td>
                                                                <td>{{ $item->id_gakyakum }}</td>
                                                                <td>{{ $item->id_dukman }}</td>
                                                                <td>{{ $item->id_perubahan }}</td>
                                                                <td>{{ $item->id_tglupload }}</td>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $activeTab == 'renaksi' ? 'show active' : '' }}" id="renaksi"
                            role="tabpanel" aria-labelledby="renaksi-tab">
                            <div class="renaksi-content">
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
                                            <h4 class="mb-0">UPLOAD File RENCANA AKSI</h4>
                                        </div>
                                        <div class="card-body">
                                            <!-- Form Upload File renaksi -->
                                            <form action="{{ route('upload.renaksi') }}" method="POST"
                                                enctype="multipart/form-data" class="mb-4">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="renaksi_file" class="form-label">Upload File PDF
                                                        Rencana Aksi</label>
                                                    <input type="file" class="form-control" id="renaksi_file"
                                                        name="renaksi_file" accept=".pdf" required>
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

                                            <!-- Tabel renaksi -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="table-warning">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>File Rencana Aksi</th>
                                                            <th>Versi</th>
                                                            <th>Tanggal Upload</th>
                                                            {{-- <th>Aksi</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($renaksi as $index => $item)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    <a href="{{ asset('uploads/renaksi/renaksi_' . $item->id_perubahan . '_' . $item->id_satker . '_' . $tahun . '.pdf') }}"
                                                                        target="_blank"
                                                                        style="text-decoration: none; color: inherit;">
                                                                        Renaksi Tahun {{ $item->id_periode }}
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

                        <div class="container mt-4">

                        </div>



                        <div class="tab-pane  fade {{ $activeTab == 'perjanjian-kinerja' ? 'show active' : '' }}"
                            id="perjanjian-kinerja" role="tabpanel" aria-labelledby="perjanjian-kinerja-tab">
                            <!-- Card untuk Bidang Kajari -->
                            <!-- Alert for success -->
                            @if (session('success'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            {{-- <div class="card">
                                <div class="card-header" style="background-color: #e74a4a; color: white;">
                                    Kajari
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title p-2" style="background-color: #f1e022; color: black;">
                                        1. Terwujudnya Upaya
                                        Pencegahan Tindak
                                        Pidana Korupsi</h5>

                                    <div class="row">
                                        <!-- Indikator 2.1 -->
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-header text-dark">
                                                    1.1. Persentase Kegiatan yang Mendukung
                                                    Upaya Pencegahan Tindak Pidana
                                                    Korupsi
                                                </div>
                                                <div class="card-body">
                                                    <input type="number" class="form-control mb-3"
                                                        placeholder="Masukkan target dalam %">
                                                    <button type="submit" class="btn"
                                                        style="background-color: #39b65c; color: white;">Simpan</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <h5 class="card-title p-2" style="background-color: #f1e022; color: black;">2.
                                        Meningkatnya Keberhasilan
                                        Penyelesaian Tindak Pidana</h5>

                                    <div class="row">
                                        <!-- Indikator 2.1 -->
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-header text-dark">
                                                    2.1. Persentase Penyelesaian Tindak Pidana Umum yang Mempunyai
                                                    Kekuatan Hukum Tetap yang Telah Dieksekusi
                                                </div>
                                                <div class="card-body">
                                                    <input type="number" class="form-control mb-3"
                                                        placeholder="Masukkan target dalam %">
                                                    <button type="submit" class="btn"
                                                        style="background-color: #39b65c; color: white;">Simpan</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Indikator 3.2 -->
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-header text-dark">
                                                    2.2. Persentase Penyelesaian Tindak Pidana Khusus yang Mempunyai
                                                    Kekuatan Hukum Tetap yang Telah Dieksekusi
                                                </div>
                                                <div class="card-body">
                                                    <input type="number" class="form-control mb-3"
                                                        placeholder="Masukkan target dalam %">
                                                    <button type="submit" class="btn"
                                                        style="background-color: #39b65c; color: white;">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br> --}}
                            
                            <div class="card">
                                <div class="card-header" style="background-color: #e74a4a; color: white;">
                                    Kasi Pidum
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title p-2" style="background-color: #f1e022; color: black;">2.1.
                                        Persentase Penyelesaian Perkara Tindak Pidana Umum yang Memperoleh Kekuatan Hukum
                                        Tetap dan Dieksekusi</h5>

                                    <div class="row">
                                        @foreach ($indikator as $indikator)
                                            <div class="col-md-6">
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        <h6>{{ $indikator->indikator_nama }}</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <p><strong>Pembilang:</strong>
                                                            {{ $indikator->indikator_pembilang }}</p>
                                                        <p>-------------------------------------------------- x100</p>
                                                        <p><strong>Penyebut:</strong> {{ $indikator->indikator_penyebut }}
                                                        </p>
                                                    </div>

                                                    <div class="card-body">
                                                        <!-- Form untuk submit target_indikator -->
                                                        <form action="{{ route('perencanaan.store') }}" method="POST">
                                                            @csrf
                                                            <!-- Hidden input untuk id_indikator -->
                                                            <input type="hidden" name="id_indikator"
                                                                value="{{ $indikator->id }}">

                                                            <!-- Hidden input untuk indikator_nama (untuk disimpan di database) -->
                                                            <input type="hidden" name="indikator"
                                                                value="{{ $indikator->indikator_nama }}">

                                                            <!-- Input target indikator -->
                                                            <div class="mb-3 w-50">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control"
                                                                        name="target_indikator"
                                                                        placeholder="Masukkan target dalam %"
                                                                        value="{{ isset($indikator_pidum[$indikator->id]) ? $indikator_pidum[$indikator->id]->target_indikator : '' }}">
                                                                    <span class="input-group-text">%</span>
                                                            <button type="submit" class="btn"
                                                                style="background-color: #39b65c; color: white;">
                                                                Simpan
                                                            </button>
                                                                </div>
                                                            </div>


                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
    <!-- Script to Show/Hide Sections Based on Selected Bidang -->
    <script>
        document.getElementById('bidang').addEventListener('change', function() {
            var kajariSection = document.getElementById('kajari-section');
            var pidumSection = document.getElementById('pidum-section');

            if (this.value === 'kajari') {
                kajariSection.style.display = 'block';
                pidumSection.style.display = 'none';
            } else if (this.value === 'pidum') {
                kajariSection.style.display = 'none';
                pidumSection.style.display = 'block';
            } else {
                kajariSection.style.display = 'none';
                pidumSection.style.display = 'none';
            }
        });

        // Initialize the correct section to be displayed
        document.getElementById('bidang').dispatchEvent(new Event('change'));
    </script>
@endsection
