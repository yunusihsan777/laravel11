@extends('layouts.app')

@section('title', 'Perencanaan')

@section('content')
    @php
        $levelSakip = session('id_sakip_level', 0);
    @endphp
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card" style="width: 100%;">
                <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                    <center>
                        <h2><b>Perencanaan</b></h2>
                    </center>
                </div>
                <div class="card-body">
                    <!-- Cek tab aktif dari session atau default ke renstra -->
                    @php
                        $activeTab = session('active_tab', 'renstra'); // Default ke renstra
                    @endphp
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-orange-600 {{ $activeTab == 'renstra' ? 'active' : '' }}"
                                id="renstra-tab" data-bs-toggle="tab" href="#renstra" role="tab" aria-controls="renstra"
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
                        @if ($tahun != 2024)
                            <!--|| $levelSakip == 2 || $levelSakip == 3 -->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $activeTab == 'perjanjian-kinerja' ? 'active' : '' }}"
                                    id="perjanjian-kinerja-tab" data-bs-toggle="tab" href="#perjanjian-kinerja"
                                    role="tab"
                                    aria-controls="{{ $activeTab == 'perjanjian-kinerja' ? 'true' : 'false' }}"
                                    aria-selected="false">Perjanjian Kinerja</a>
                            </li>
                            {{-- @endif --}}
                            @if ($levelSakip == 99)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="cetak-pk-tab" data-bs-toggle="tab" href="#cetak-pk"
                                        role="tab" aria-controls="cetak-pk" aria-selected="false">Cetak PK</a>
                                </li>
                            @endif
                        @endif
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
                                <h3><strong>Rencana Strategis (Renstra) Tahun {{ $id_tahun }}</strong></h3>
                                <p class="card-title p-2" style="background-color: #f1e022; color: black;">Rencana Strategis
                                    (Renstra) merupakan dokumen perencanaan yang menetapkan tujuan, sasaran, strategi,
                                    kebijakan, program, dan kegiatan pembangunan dalam jangka waktu lima tahun.</p>

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
                                            @if (session('success-renstra'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success-renstra') }}
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
                                                                    <a href="{{ asset('uploads/repository/' . $item->id_satker . '/renstra_' . $tahun . '_' . $item->id_perubahan . '.pdf') }}"
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
                                <h3><strong>Indikator Kinerja Utama (IKU)</strong></h3>
                                <p class="card-title p-2" style="background-color: #f1e022; color: black;">Indikator
                                    Kinerja Utama (IKU) Kejaksaan adalah ukuran keberhasilan dalam mencapai tujuan dan
                                    sasaran strategis Kejaksaan, yang digunakan sebagai acuan untuk menyusun rencana
                                    kinerja, kerja, anggaran, dan evaluasi kinerja</p>

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
                                            @if (session('success-iku'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success-iku') }}
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
                                                                    <a href="{{ asset('uploads/repository/' . $item->id_satker . '/IKU_' . $tahun . '_' . $item->id_perubahan . '.pdf') }}"
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
                                <h3><strong>Rencana Kerja Tahunan</strong></h3>
                                <p class="card-title p-2" style="background-color: #f1e022; color: black;">Rencana Kinerja
                                    Tahunan (RKT) merupakan penjabaran dari sasaran dan program yang telah
                                    ditetapkan dalam Iku, dan akan dilaksanakan oleh satuan organisasi/kerja melalui
                                    berbagai kegiatan tahunan. <br> Rencana Kinerja Tahunan (RKT) adalah dokumen perencanaan
                                    untuk periode 1 (satu) tahun
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
                                            @if (session('success-renja'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success-renja') }}
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
                                                                    <a href="{{ asset('uploads/repository/' . $item->id_satker . '/renja_' . $tahun . '_' . $item->id_perubahan . '.pdf') }}"
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
                                <h3><strong>Rencana Kerja Anggaran Kementerian atau Lembaga</strong></h3>
                                <p class="card-title p-2" style="background-color: #f1e022; color: black;">Data Kebutuhan
                                    Riil (Periode Awal tahun dengan rumus -1 TA) silahkan masukkan data
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
                                            @if (session('success-rkakl'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success-rkakl') }}
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
                                                                    <a href="{{ asset('uploads/repository/' . $item->id_satker . '/rkakl_' . $tahun . '_' . $item->id_perubahan . '.pdf') }}"
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

                        <div class="tab-pane fade {{ session('active_tab') == 'dipa' ? 'show active' : '' }}"
                            id="dipa" role="tabpanel" aria-labelledby="dipa-tab">
                            <div class="dipa-content">
                                <h3><strong>Daftar Isian Pelaksanaan Anggaran (DIPA)</strong></h3>
                                <p class="card-title p-2" style="background-color: #f1e022; color: black;">
                                    Daftar Isian Pelaksanaan Anggaran (DIPA) Kejaksaan menjadi dasar bagi Satuan Kerja
                                    (Satker) Kejaksaan untuk melaksanakan kegiatan yang telah direncanakan.
                                </p>

                                <!-- Alert Notifikasi -->
                                @if (session('success-dipa'))
                                    <div class="alert alert-success">{{ session('success-dipa') }}</div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <!-- Form Upload File -->
                                <div class="card shadow-sm">
                                    <div class="card-header text-white" style="background-color: #e6bf3e;">
                                        <h4 class="mb-0">UPLOAD DIPA SATKER ANDA</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('upload.dipa') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="dipa_file" class="form-label">Upload File PDF DIPA</label>
                                                <input type="file" class="form-control" id="dipa_file"
                                                    name="dipa_file" accept=".pdf" required>
                                                @error('dipa_file')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="id_pagu" class="form-label">Total Pagu</label>
                                                <input type="text" class="form-control format-number" id="id_pagu"
                                                    name="id_pagu_formatted" required>
                                                <input type="hidden" id="id_pagu_hidden" name="id_pagu">
                                            </div>

                                            <div class="mb-3">
                                                <label for="id_gakyankum" class="form-label">Program Penegakan dan
                                                    Pelayanan Hukum</label>
                                                <input type="text" class="form-control format-number"
                                                    id="id_gakyankum" name="id_gakyankum_formatted" required>
                                                <input type="hidden" id="id_gakyankum_hidden" name="id_gakyankum">
                                            </div>

                                            <div class="mb-3">
                                                <label for="id_dukman" class="form-label">Program Dukungan
                                                    Manajemen</label>
                                                <input type="text" class="form-control format-number" id="id_dukman"
                                                    name="id_dukman_formatted" required>
                                                <input type="hidden" id="id_dukman_hidden" name="id_dukman">
                                            </div>

                                            <button type="submit" class="btn btn-warning btn-block">Upload File</button>
                                        </form>
                                    </div>

                                    <!-- Tabel DIPA -->
                                    <div class="card-body">
                                        <div class="table-responsive mt-4">
                                            <table class="table table-bordered table-striped">
                                                <thead class="table-warning">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>File DIPA</th>
                                                        <th>Total Pagu</th>
                                                        <th>Program Penegakan dan Pelayanan Hukum</th>
                                                        <th>Program Dukungan Manajemen</th>
                                                        <th>Versi</th>
                                                        <th>Tanggal Upload</th>
                                                        {{-- <th>Aksi</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($dipa as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>
                                                                <a href="{{ asset('uploads/repository/' . $item->id_satker . '/dipa_' . $tahun . '_' . $item->id_perubahan . '.pdf') }}"
                                                                    target="_blank"
                                                                    style="text-decoration: none; color: inherit;">
                                                                    {{ $item->id_periode }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                Rp.
                                                                @if (strpos($item->id_pagu, '.') === false)
                                                                    {{ number_format((float) $item->id_pagu, 0, ',', '.') }}
                                                                @else
                                                                    {{ $item->id_pagu }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                Rp.
                                                                @if (strpos($item->id_gakyankum, '.') === false)
                                                                    {{ number_format((float) $item->id_gakyankum, 0, ',', '.') }}
                                                                @else
                                                                    {{ $item->id_gakyankum }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                Rp.
                                                                @if (strpos($item->id_dukman, '.') === false)
                                                                    {{ number_format((float) $item->id_dukman, 0, ',', '.') }}
                                                                @else
                                                                    {{ $item->id_dukman }}
                                                                @endif
                                                            </td>

                                                            <td>{{ $item->id_perubahan }}</td>
                                                            <td>{{ $item->id_tglupload }}</td>
                                                            {{-- <td>
                                @if (!empty($item->id_filename) && file_exists(public_path('uploads/repository/dipa/' . $item->id_filename)))
                                    <a href="{{ asset('uploads/repository/dipa/' . $item->id_filename) }}" class="btn btn-primary btn-sm" target="_blank">Download</a>
                                @else
                                    <span class="text-danger">Tidak Ada File</span>
                                @endif
                            </td> --}}
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8" class="text-center">Belum ada data DIPA
                                                                yang
                                                                diunggah.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript untuk memformat input angka -->
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                let inputs = document.querySelectorAll('.format-number');

                                inputs.forEach(function(input) {
                                    input.addEventListener('input', function() {
                                        let value = this.value.replace(/\D/g, ''); // Hapus semua karakter non-angka
                                        let formattedValue = new Intl.NumberFormat('id-ID').format(value);

                                        this.value = formattedValue; // Tampilkan format dengan titik
                                        document.getElementById(this.id + "_hidden").value =
                                            value; // Simpan nilai asli tanpa titik
                                    });
                                });
                            });
                        </script>


                        <div class="tab-pane fade {{ $activeTab == 'renaksi' ? 'show active' : '' }}" id="renaksi"
                            role="tabpanel" aria-labelledby="renaksi-tab">
                            <div class="renaksi-content">
                                <h3><strong>Rencana Kerja Anggaran Kementerian atau Lembaga</strong></h3>
                                <p class="card-title p-2" style="background-color: #f1e022; color: black;">Data Kebutuhan
                                    Riil (Periode Awal tahun dengan rumus -1 TA) silahkan masukkan data
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
                                            @if (session('success-renaksi'))
                                                <div class="alert alert-success" id="success-alert">
                                                    {{ session('success-renaksi') }}
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
                                                                    <a href="{{ asset('uploads/repository/' . $item->id_satker . '/renaksi_' . $tahun . '_' . $item->id_perubahan . '.pdf') }}"
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

                        <div class="container mt-4"></div>

                        <div class="tab-pane  fade {{ $activeTab == 'perjanjian-kinerja' ? 'show active' : '' }}"
                            id="perjanjian-kinerja" role="tabpanel" aria-labelledby="perjanjian-kinerja-tab">
                            <!-- Card untuk Bidang Kajari -->
                            <!-- Alert for success -->
                            @if (session('success-pk'))
                                <div class="alert alert-success" id="success-alert">
                                    {{ session('success-pk') }}
                                </div>
                            @endif
                            <h3><strong>Perjanjian Kinerja</strong></h3>
                            <p class="card-title p-2" style="background-color: #f1e022; color: black;">Pengisian Target
                                Perjanjian Kinerja</p>

                            @php
                                $level = session('id_sakip_level');
                                $satkernama = session('satkernama') ?? '';
                                $kataTerakhir = strtolower(strrchr(' ' . $satkernama, ' '));

                                if ($level == 0) {
                                    // Admin atau superuser: ambil semua bidang
                                    $bidangs = \App\Models\Bidang::whereNotNull('bidang_level')
                                        ->where('hide', 0)
                                        ->orderBy('bidang_lokasi', 'asc')
                                        ->orderBy('bidang_level', 'asc')
                                        ->get();
                                } elseif ($level == 1) {
                                    $bidangs = \App\Models\Bidang::where('bidang_lokasi', $level)
                                        ->where('hide', 0)
                                        ->where('bidang_nama', 'LIKE', '%' . trim($kataTerakhir))
                                        ->whereNotNull('bidang_level')
                                        ->orderBy('bidang_level', 'asc')
                                        ->get();
                                } elseif (str_starts_with(strtoupper($satkernama), 'CABJARI')) {
                                    $bidangs = \App\Models\Bidang::where('bidang_lokasi', $level)
                                        ->whereNotNull('bidang_level')
                                        ->orderBy('bidang_level', 'asc')
                                        ->get();

                                    if ($bidangs->isNotEmpty() && stripos($bidangs[0]->bidang_nama, 'kepala') === 0) {
                                        $bidangs[0]->bidang_nama = 'Kepala Cabang Kejaksaan Negeri';
                                    }
                                } elseif ($level > 1) {
                                    $bidangs = \App\Models\Bidang::where('bidang_lokasi', $level)
                                        ->whereNotNull('bidang_level')
                                        ->orderBy('bidang_level', 'asc')
                                        ->get();
                                }

                                //kurang rumah sakit dan atase where $level=5

                            @endphp

                            @foreach ($bidangs as $index => $bidang)
                                @php

                                    $indikators = \App\Models\Indikator::where('link', $bidang->rumpun)
                                        ->where(function ($query) use ($tahun) {
                                            $query->where('tahun', 'LIKE', "%$tahun%"); // cocokkan sebagian tahun
                                        })
                                        ->where(function ($query) use ($level) {
                                            if ($level == 1) {
                                                $query->whereIn('lingkup', [0, 1]);
                                            } elseif ($level == 2) {
                                                $query->whereIn('lingkup', [0, 2, 5]);
                                            } elseif ($level == 3) {
                                                $query->whereIn('lingkup', [0, 3, 5, 6]);
                                            } elseif ($level == 4) {
                                                $query->whereIn('lingkup', [0, 4, 6]);
                                            }
                                        })
                                        ->get();
                                @endphp


                                <div class="card mb-2">
                                    <div class="card-header d-flex justify-content-between align-items-center"
                                        style="background-color: #e6bf3e; color: white;">
                                        {{ $bidang->bidang_nama }}
                                        <a data-bs-toggle="collapse" href="#collapseBidang{{ $index }}"
                                            role="button" aria-expanded="false"
                                            aria-controls="collapseBidang{{ $index }}"
                                            class="collapse-toggle d-flex align-items-center">
                                            <i class="bi bi-chevron-down text-white rotate-icon"></i>
                                        </a>
                                    </div>

                                    <div class="collapse" id="collapseBidang{{ $index }}">
                                        <div class="card-body">
                                            @if ($indikators->isNotEmpty())
                                                <div class="row">
                                                    @foreach ($indikators as $key => $indikator)
                                                        <div class="col-md-6">
                                                            <div class="card mb-2">
                                                                <div class="card-body">
                                                                    <!-- Indikator Nama -->
                                                                    <h5 class="text-center"
                                                                        style="font-weight: bold; color: black;">
                                                                        {{ $indikator->indikator_nama }}
                                                                    </h5>

                                                                    <!-- Form Target -->
                                                                    <form method="POST"
                                                                        action="{{ route('target.store') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="indikator_id"
                                                                            value="{{ $indikator->id }}">

                                                                        <div class="mb-2">
                                                                            <label class="form-label">Target Pertahun
                                                                                (%)
                                                                            </label>
                                                                            <input type="number" class="form-control"
                                                                                name="target_tahun"
                                                                                value="{{ $target[$indikator->id]->target_tahun ?? '' }}">
                                                                        </div>

                                                                        <div class="row">
                                                                            @for ($i = 1; $i <= 4; $i++)
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Triwulan
                                                                                        {{ $i }} (%)</label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="target_triwulan_{{ $i }}"
                                                                                        value="{{ $target[$indikator->id]->{"target_triwulan_{$i}"} ?? '' }}">
                                                                                </div>
                                                                            @endfor
                                                                        </div>

                                                                        <br>
                                                                        <button type="submit"
                                                                            class="btn btn-success w-100">Simpan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @if (($key + 1) % 2 == 0 && !$loop->last)
                                                </div>
                                                <div class="row">
                                            @endif
                            @endforeach
                        </div>
                    @else
                        <p><i>Tidak ada indikator terkait</i></p>
                        @endif
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
    <style>
        .rotate-icon {
            transition: transform 0.3s ease;
        }

        .rotate-icon.rotate {
            transform: rotate(180deg);
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
        // document.getElementById('bidang').addEventListener('change', function() {
        //     var kajariSection = document.getElementById('kajari-section');
        //     var pidumSection = document.getElementById('pidum-section');

        //     if (this.value === 'kajari') {
        //         kajariSection.style.display = 'block';
        //         pidumSection.style.display = 'none';
        //     } else if (this.value === 'pidum') {
        //         kajariSection.style.display = 'none';
        //         pidumSection.style.display = 'block';
        //     } else {
        //         kajariSection.style.display = 'none';
        //         pidumSection.style.display = 'none';
        //     }
        // });

        // // Initialize the correct section to be displayed
        // document.getElementById('bidang').dispatchEvent(new Event('change'));
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event ketika collapse dibuka
            document.querySelectorAll('.collapse').forEach(function(collapse) {
                collapse.addEventListener('show.bs.collapse', function() {
                    const icon = this.previousElementSibling.querySelector('.rotate-icon');
                    if (icon) icon.classList.add('rotate');
                });

                // Event ketika collapse ditutup
                collapse.addEventListener('hide.bs.collapse', function() {
                    const icon = this.previousElementSibling.querySelector('.rotate-icon');
                    if (icon) icon.classList.remove('rotate');
                });
            });
        });
    </script>


@endsection
