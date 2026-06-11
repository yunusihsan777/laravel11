@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="content" id="content">
        <div class="container-fluid">

            <!-- Baris Utama (Dibagi menjadi 2 kolom besar: Kiri dan Kanan) -->
            <div class="row">

                <!-- ========================================== -->
                <!-- KOLOM KIRI (Berisi Pengumuman, Kepatuhan, Aturan, Gambar) -->
                <!-- ========================================== -->
                <div class="col-md-6">

                    <!-- 1. Card Pengumuman -->
                    <div class="card shadow-sm mb-4">
                        <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                            <center>
                                <h3><b>Pengumuman</b></h3>
                            </center>
                        </div>
                        <div class="card-body">
                            @foreach ($pengumuman as $item)
                                <div class="card shadow-sm mb-4">
                                    <div class="card-body">
                                        <p class="card-text" style="color: red;">
                                            <b>{{ $item->judul }}</b>
                                        </p>
                                        <p>{{ $item->isi }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Card Kepatuhan -->
                    @php
                        $satkernama = session('satkernama', 'Nama Satker');
                        $idSatker = session('id_satker', 'ID Satker');
                        $levelSakip = session('id_sakip_level', 0);
                    @endphp

                    @if ($levelSakip != 0)
                        <div class="card shadow-sm mb-4">
                            <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                                <center>
                                    <h3><b>Kepatuhan</b></h3>
                                </center>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Renstra -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $renstraTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian Renstra</b></h5>
                                                <p class="card-text">
                                                    {{ $renstraTerisi ? 'Pengisian Renstra sudah dilakukan' : 'Pengisian Renstra belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- IKU -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $ikuTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian IKU</b></h5>
                                                <p class="card-text">
                                                    {{ $ikuTerisi ? 'Pengisian IKU sudah dilakukan' : 'Pengisian IKU belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Renja -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $renjaTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian Renja</b></h5>
                                                <p class="card-text">
                                                    {{ $renjaTerisi ? 'Pengisian Renja sudah dilakukan' : 'Pengisian Renja belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RKAKL -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $rkaklTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian RKAKL</b></h5>
                                                <p class="card-text">
                                                    {{ $rkaklTerisi ? 'Pengisian RKAKL sudah dilakukan' : 'Pengisian RKAKL belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DIPA -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $dipaTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian DIPA</b></h5>
                                                <p class="card-text">
                                                    {{ $dipaTerisi ? 'Pengisian DIPA sudah dilakukan' : 'Pengisian DIPA belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rencana Aksi -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $rencanaAksiTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian Rencana Aksi</b></h5>
                                                <p class="card-text">
                                                    {{ $rencanaAksiTerisi ? 'Pengisian Rencana Aksi sudah dilakukan' : 'Pengisian Rencana Aksi belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 3. Card Sumber Aturan & FAQ (Disusun Bersebelahan) -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Sumber Aturan</b></h5>
                                    <p class="card-text">Lihat sumber aturan dan referensi hukum yang relevan.</p>
                                    <a href="{{ route('aturan') }}" class="btn btn-yellow">Lihat Sumber Aturan</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><b>FAQ</b></h5>
                                    <p class="card-text">Lihat pertanyaan yang sering diajukan tentang sistem ini.</p>
                                    <a href="{{ route('faq') }}" class="btn btn-yellow">Lihat FAQ</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Card Gambaran Alur SAKIP -->
                    <div class="card shadow-sm mb-4">
                        <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                            <center>
                                <h3><b>Gambaran Alur SAKIP</b></h3>
                            </center>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('gambar/sakip.png') }}" class="img-fluid" alt="sakip"
                                style="cursor: pointer; transition: transform 0.2s;" data-bs-toggle="modal"
                                data-bs-target="#imageModal" onmouseover="this.style.transform='scale(1.02)'"
                                onmouseout="this.style.transform='scale(1)'">
                        </div>
                    </div>

                </div>
                <!-- AKHIR KOLOM KIRI -->


                <!-- ========================================== -->
                <!-- KOLOM KANAN (Khusus untuk Dokumen SAKIP / Linktree) -->
                <!-- ========================================== -->
                <!-- ========================================== -->
                <!-- KOLOM KANAN (Khusus untuk Dokumen SAKIP) -->
                <!-- ========================================== -->
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                            <center>
                                <h3><b>Dokumen SAKIP</b></h3>
                            </center>
                        </div>

                        <div class="card-body">

                            <div class="mb-4">
                                <a href="https://drive.google.com/file/d/1Hm8d_Cvk_h9aA8rIYb1XyJO6C1WTwjAs/view"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Pedoman JA Nomor 4 Tahun 2025 tentang Evaluasi Akuntabilitas Kinerja Instansi Pemerintah
                                    di Lingkungan Kejaksaan Republik Indonesia.pdf
                                </a>
                                <a href="https://drive.google.com/file/d/1mNb9htgVw1ClP_0eHWAwBjYp6ygIG9-m/view?usp=drive_link"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PEDOMAN JA NOMOR 4 TAHUN 2024_PENYELENGGARAAN SAKIP
                                </a>
                                <a href="https://drive.google.com/drive/u/0/folders/1lRlkVrXcECSfNdzoGpPpsftYrWHN2ddn"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Peraturan SAKIP
                                </a>
                            </div>

                            <h5 class="text-center mb-3" style="font-weight: 600; color: #333;">Template Dokumen SAKIP Tahun
                                2026</h5>
                            <div class="mb-4">
                                <a href="https://drive.google.com/drive/folders/16jJkdH1mW-h4CSKQn2Jgg4suwG86ocvg?usp=drive_link"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    FORMAT RENCANA AKSI KINERJA DAN LAPORAN MONEV RENAKSI KINERJA ES I TW I 2026
                                </a>
                                <a href="https://drive.google.com/drive/folders/1e-f1ElSCYFGOPQvvxti3Je0q_vnpCFY8?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    LKJ TW I Tahun 2026 - KEJATI, KEJARI DAN CABJARI
                                </a>
                                <a href="https://drive.google.com/drive/folders/1gldPqRO1rTIbeNY8P5eEarnhl1b_PypE?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Rencana Aksi Kinerja Tahun 2026
                                </a>
                                <a href="https://drive.google.com/drive/folders/1lzttjDxiYNoAKSS0ZNCFbLZIpQ-SuA89?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Monev Renaksi Kinerja TW I Tahun 2026
                                </a>
                                <a href="https://drive.google.com/drive/folders/1I6UQ5UizAHDwAL8UPcq9Oqo9SHo7rUtX?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    RASTAFF EKA Tahun 2026
                                </a>
                            </div>

                            <h5 class="text-center mb-3" style="font-weight: 600; color: #333;">Template Dokumen SAKIP
                                Tahun 2025</h5>
                            <div>
                                <a href="https://drive.google.com/drive/folders/1bAzTx5kaIJvP8jnAA5RZqGGA5hWxbevR?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template LKjIP Satuan Kerja Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1_9_N5Ax5eIhLIUTYG3_4L6pZgqm9uKR_?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Cover LKjIP Satuan Kerja Tahun 2025
                                </a>
                                <a href="https://docs.google.com/document/d/14HkvvEJmGyPo0QfhPElCxwVhC5Ri6q2s/edit?usp=sharing&ouid=109556050232324402632&rtpof=true&sd=true"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template LKJ Triwulan III Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1WdulmYbNpOzFCCathQhJ1W_7IVwdFOHi?usp=drive_link"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Pohon Kinerja Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1Do5DZKQI-mNWfpT9jpMs0Tp8zOx7BD3d?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Format Rencana Aksi Kinerja Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1uHlIHeS44wRVsPBWiY0sOG7Ha5TFerP1?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Format Laporan Monev Rencana Aksi Kinerja Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1KlMJCKb8mmDlvPiYkjkuWNXyrRsQtfMB?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    IKU / Penetapan Target Kinerja 2025
                                </a>
                                <a href="https://drive.google.com/file/d/1xxiHanwuk8Cpqn2i9noXKGiCO3iSSKMy/view?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Rencana Kerja Kejaksaan RI Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1_9fQmMKStFHbmFHQ9wQSrJu_1hIk04YL?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    FORMAT RANWAL RENSTRA (SATKER DAERAH) - Google Drive
                                </a>
                                <a href="https://drive.google.com/drive/folders/1Vvw2zC17nN3Q7KqWiHy4WrxSatIm68_O?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PK 2025 RANWAL ESELON III KEJATI - Google Drive
                                </a>
                                <a href="https://drive.google.com/drive/folders/1fFETnMV0DSH0Bpo8sv1A8HMfoJ8evO9i?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PK 2025 RANWAL ESELON IV KEJARI - Google Drive
                                </a>
                                <a href="https://drive.google.com/drive/folders/1UuRUanPDHpQu-rcfiwS7lWSVyuvT4lhW?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PK 2025 RANWAL ESELON V CABJARI - Google Drive
                                </a>
                                <a href="https://drive.google.com/drive/folders/1AlxsuXxMVW9FDCJWhUjrovXsHoMQ3eFP?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PK 2025 RANWAL ESELON PEJABAT STRUKTURAL LAINNYA - Google Drive
                                </a>
                                <a href="https://docs.google.com/document/d/15oy4mfmFbGb81Bnwz5PPpXs1zN_anokd/edit?usp=sharing&ouid=109556050232324402632&rtpof=true&sd=true"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template LKJ Triwulan II Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/u/0/folders/1JAD4l9KZA7d4ANKmexS3rrID3DrPekD1"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template LKJ Triwulan I Tahun 2025
                                </a>
                                <a href="https://docs.google.com/document/d/12waQaX6lK8NjGzHBCk5fOaetXSzEcwxe/edit?usp=sharing&ouid=109556050232324402632&rtpof=true&sd=true"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template RAPAT STAFF EKA Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1sDIeMaE1gnVn3pkyI5qBcOaEv_qg8h1f?usp=drive_link"
                                    target="_blank" class="btn shadow-sm w-100 btn-linktree">
                                    Template PK Ranwal_Kasatker Tahun 2025
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- AKHIR KOLOM KANAN -->
                <!-- AKHIR KOLOM KANAN -->

            </div> <!-- Akhir Baris Utama -->

        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #e6bf3e;">
                    <h5 class="modal-title" id="imageModalLabel"><b>Gambaran Alur SAKIP</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" style="padding: 0;">
                    <img src="{{ asset('gambar/sakip.png') }}" class="img-fluid w-100" alt="sakip_besar"
                        style="border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Awal card berada di bawah dan tersembunyi */
    .card {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.6s ease-out;
    }

    /* Setelah halaman dimuat, card akan muncul ke posisi semula */
    .card.show {
        opacity: 1;
        transform: translateY(0);
    }

    /* Class untuk tombol ala Linktree */
    .btn-linktree {
        background-color: #ffffff;
        color: #000000;
        border-radius: 12px;
        white-space: normal;
        text-align: center;
        padding: 15px;
        font-weight: 500;
        word-wrap: break-word;
        hyphens: none;
        /* Aturan agar kata tidak terpotong strip */
        border: 1px solid transparent;
        transition: background-color 0.3s ease;
    }

    /* Efek hover dengan !important agar warna tidak tertimpa Bootstrap */
    .btn-linktree:hover {
        background-color: #e9ecef !important;
        color: #000000 !important;
    }
</style>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush@extends('layouts.app')

    @section('title', 'Dashboard')

@section('content')
    <!-- Main Content -->
    <div class="content" id="content">
        <div class="container-fluid">

            <!-- Baris Utama (Dibagi menjadi 2 kolom besar: Kiri dan Kanan) -->
            <div class="row">

                <!-- ========================================== -->
                <!-- KOLOM KIRI (Berisi Pengumuman, Kepatuhan, Aturan, Gambar) -->
                <!-- ========================================== -->
                <div class="col-md-6">

                    <!-- 1. Card Pengumuman -->
                    <div class="card shadow-sm mb-4">
                        <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                            <center>
                                <h3><b>Pengumuman</b></h3>
                            </center>
                        </div>
                        <div class="card-body">
                            @foreach ($pengumuman as $item)
                                <div class="card shadow-sm mb-4">
                                    <div class="card-body">
                                        <p class="card-text" style="color: red;">
                                            <b>{{ $item->judul }}</b>
                                        </p>
                                        <p>{{ $item->isi }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Card Kepatuhan -->
                    @php
                        $satkernama = session('satkernama', 'Nama Satker');
                        $idSatker = session('id_satker', 'ID Satker');
                        $levelSakip = session('id_sakip_level', 0);
                    @endphp

                    @if ($levelSakip != 0)
                        <div class="card shadow-sm mb-4">
                            <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                                <center>
                                    <h3><b>Kepatuhan</b></h3>
                                </center>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Renstra -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $renstraTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian Renstra</b></h5>
                                                <p class="card-text">
                                                    {{ $renstraTerisi ? 'Pengisian Renstra sudah dilakukan' : 'Pengisian Renstra belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- IKU -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $ikuTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian IKU</b></h5>
                                                <p class="card-text">
                                                    {{ $ikuTerisi ? 'Pengisian IKU sudah dilakukan' : 'Pengisian IKU belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Renja -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $renjaTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian Renja</b></h5>
                                                <p class="card-text">
                                                    {{ $renjaTerisi ? 'Pengisian Renja sudah dilakukan' : 'Pengisian Renja belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- RKAKL -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $rkaklTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian RKAKL</b></h5>
                                                <p class="card-text">
                                                    {{ $rkaklTerisi ? 'Pengisian RKAKL sudah dilakukan' : 'Pengisian RKAKL belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DIPA -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $dipaTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian DIPA</b></h5>
                                                <p class="card-text">
                                                    {{ $dipaTerisi ? 'Pengisian DIPA sudah dilakukan' : 'Pengisian DIPA belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rencana Aksi -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm mb-4"
                                            style="background-color: {{ $rencanaAksiTerisi ? '#28a745' : '#dc3545' }}; color: white;">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Pengisian Rencana Aksi</b></h5>
                                                <p class="card-text">
                                                    {{ $rencanaAksiTerisi ? 'Pengisian Rencana Aksi sudah dilakukan' : 'Pengisian Rencana Aksi belum dilakukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 3. Card Sumber Aturan & FAQ (Disusun Bersebelahan) -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Sumber Aturan</b></h5>
                                    <p class="card-text">Lihat sumber aturan dan referensi hukum yang relevan.</p>
                                    <a href="{{ route('aturan') }}" class="btn btn-yellow">Lihat Sumber Aturan</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><b>FAQ</b></h5>
                                    <p class="card-text">Lihat pertanyaan yang sering diajukan tentang sistem ini.</p>
                                    <a href="{{ route('faq') }}" class="btn btn-yellow">Lihat FAQ</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Card Gambaran Alur SAKIP -->
                    <div class="card shadow-sm mb-4">
                        <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                            <center>
                                <h3><b>Gambaran Alur SAKIP</b></h3>
                            </center>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('gambar/sakip.png') }}" class="img-fluid" alt="sakip"
                                style="cursor: pointer; transition: transform 0.2s;" data-bs-toggle="modal"
                                data-bs-target="#imageModal" onmouseover="this.style.transform='scale(1.02)'"
                                onmouseout="this.style.transform='scale(1)'">
                        </div>
                    </div>

                </div>
                <!-- AKHIR KOLOM KIRI -->


                <!-- ========================================== -->
                <!-- KOLOM KANAN (Khusus untuk Dokumen SAKIP / Linktree) -->
                <!-- ========================================== -->
                <!-- ========================================== -->
                <!-- KOLOM KANAN (Khusus untuk Dokumen SAKIP) -->
                <!-- ========================================== -->
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                            <center>
                                <h3><b>Dokumen SAKIP</b></h3>
                            </center>
                        </div>

                        <div class="card-body">

                            <div class="mb-4">
                                <a href="https://drive.google.com/file/d/1Hm8d_Cvk_h9aA8rIYb1XyJO6C1WTwjAs/view"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Pedoman JA Nomor 4 Tahun 2025 tentang Evaluasi Akuntabilitas Kinerja Instansi Pemerintah
                                    di Lingkungan Kejaksaan Republik Indonesia.pdf
                                </a>
                                <a href="https://drive.google.com/file/d/1mNb9htgVw1ClP_0eHWAwBjYp6ygIG9-m/view?usp=drive_link"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PEDOMAN JA NOMOR 4 TAHUN 2024_PENYELENGGARAAN SAKIP
                                </a>
                                <a href="https://drive.google.com/drive/u/0/folders/1lRlkVrXcECSfNdzoGpPpsftYrWHN2ddn"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Peraturan SAKIP
                                </a>
                            </div>

                            <h5 class="text-center mb-3" style="font-weight: 600; color: #333;">Template Dokumen SAKIP
                                Tahun 2026</h5>
                            <div class="mb-4">
                                <a href="https://drive.google.com/drive/folders/16jJkdH1mW-h4CSKQn2Jgg4suwG86ocvg?usp=drive_link"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    FORMAT RENCANA AKSI KINERJA DAN LAPORAN MONEV RENAKSI KINERJA ES I TW I 2026
                                </a>
                                <a href="https://drive.google.com/drive/folders/1e-f1ElSCYFGOPQvvxti3Je0q_vnpCFY8?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    LKJ TW I Tahun 2026 - KEJATI, KEJARI DAN CABJARI
                                </a>
                                <a href="https://drive.google.com/drive/folders/1gldPqRO1rTIbeNY8P5eEarnhl1b_PypE?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Rencana Aksi Kinerja Tahun 2026
                                </a>
                                <a href="https://drive.google.com/drive/folders/1lzttjDxiYNoAKSS0ZNCFbLZIpQ-SuA89?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Monev Renaksi Kinerja TW I Tahun 2026
                                </a>
                                <a href="https://drive.google.com/drive/folders/1I6UQ5UizAHDwAL8UPcq9Oqo9SHo7rUtX?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    RASTAFF EKA Tahun 2026
                                </a>
                            </div>

                            <h5 class="text-center mb-3" style="font-weight: 600; color: #333;">Template Dokumen SAKIP
                                Tahun 2025</h5>
                            <div>
                                <a href="https://drive.google.com/drive/folders/1bAzTx5kaIJvP8jnAA5RZqGGA5hWxbevR?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template LKjIP Satuan Kerja Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1_9_N5Ax5eIhLIUTYG3_4L6pZgqm9uKR_?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Cover LKjIP Satuan Kerja Tahun 2025
                                </a>
                                <a href="https://docs.google.com/document/d/14HkvvEJmGyPo0QfhPElCxwVhC5Ri6q2s/edit?usp=sharing&ouid=109556050232324402632&rtpof=true&sd=true"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template LKJ Triwulan III Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1WdulmYbNpOzFCCathQhJ1W_7IVwdFOHi?usp=drive_link"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Pohon Kinerja Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1Do5DZKQI-mNWfpT9jpMs0Tp8zOx7BD3d?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Format Rencana Aksi Kinerja Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1uHlIHeS44wRVsPBWiY0sOG7Ha5TFerP1?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Format Laporan Monev Rencana Aksi Kinerja Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1KlMJCKb8mmDlvPiYkjkuWNXyrRsQtfMB?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    IKU / Penetapan Target Kinerja 2025
                                </a>
                                <a href="https://drive.google.com/file/d/1xxiHanwuk8Cpqn2i9noXKGiCO3iSSKMy/view?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Rencana Kerja Kejaksaan RI Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1_9fQmMKStFHbmFHQ9wQSrJu_1hIk04YL?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    FORMAT RANWAL RENSTRA (SATKER DAERAH) - Google Drive
                                </a>
                                <a href="https://drive.google.com/drive/folders/1Vvw2zC17nN3Q7KqWiHy4WrxSatIm68_O?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PK 2025 RANWAL ESELON III KEJATI - Google Drive
                                </a>
                                <a href="https://drive.google.com/drive/folders/1fFETnMV0DSH0Bpo8sv1A8HMfoJ8evO9i?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PK 2025 RANWAL ESELON IV KEJARI - Google Drive
                                </a>
                                <a href="https://drive.google.com/drive/folders/1UuRUanPDHpQu-rcfiwS7lWSVyuvT4lhW?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PK 2025 RANWAL ESELON V CABJARI - Google Drive
                                </a>
                                <a href="https://drive.google.com/drive/folders/1AlxsuXxMVW9FDCJWhUjrovXsHoMQ3eFP?usp=sharing"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    PK 2025 RANWAL ESELON PEJABAT STRUKTURAL LAINNYA - Google Drive
                                </a>
                                <a href="https://docs.google.com/document/d/15oy4mfmFbGb81Bnwz5PPpXs1zN_anokd/edit?usp=sharing&ouid=109556050232324402632&rtpof=true&sd=true"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template LKJ Triwulan II Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/u/0/folders/1JAD4l9KZA7d4ANKmexS3rrID3DrPekD1"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template LKJ Triwulan I Tahun 2025
                                </a>
                                <a href="https://docs.google.com/document/d/12waQaX6lK8NjGzHBCk5fOaetXSzEcwxe/edit?usp=sharing&ouid=109556050232324402632&rtpof=true&sd=true"
                                    target="_blank" class="btn shadow-sm mb-3 w-100 btn-linktree">
                                    Template RAPAT STAFF EKA Tahun 2025
                                </a>
                                <a href="https://drive.google.com/drive/folders/1sDIeMaE1gnVn3pkyI5qBcOaEv_qg8h1f?usp=drive_link"
                                    target="_blank" class="btn shadow-sm w-100 btn-linktree">
                                    Template PK Ranwal_Kasatker Tahun 2025
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- AKHIR KOLOM KANAN -->
                <!-- AKHIR KOLOM KANAN -->

            </div> <!-- Akhir Baris Utama -->

        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #e6bf3e;">
                    <h5 class="modal-title" id="imageModalLabel"><b>Gambaran Alur SAKIP</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" style="padding: 0;">
                    <img src="{{ asset('gambar/sakip.png') }}" class="img-fluid w-100" alt="sakip_besar"
                        style="border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Awal card berada di bawah dan tersembunyi */
    .card {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.6s ease-out;
    }

    /* Setelah halaman dimuat, card akan muncul ke posisi semula */
    .card.show {
        opacity: 1;
        transform: translateY(0);
    }

    /* Class untuk tombol ala Linktree */
    .btn-linktree {
        background-color: #ffffff;
        color: #000000;
        border-radius: 12px;
        white-space: normal;
        text-align: center;
        padding: 15px;
        font-weight: 500;
        word-wrap: break-word;
        hyphens: none;
        /* Aturan agar kata tidak terpotong strip */
        border: 1px solid transparent;
        transition: background-color 0.3s ease;
    }

    /* Efek hover dengan !important agar warna tidak tertimpa Bootstrap */
    .btn-linktree:hover {
        background-color: #e9ecef !important;
        color: #000000 !important;
    }
</style>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
