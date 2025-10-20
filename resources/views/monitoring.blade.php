@extends('layouts.app')

@section('title', 'SAKIP Wilayah')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    @php
        $levelSakip = session('id_sakip_level', 0);
    @endphp
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card" style="width: 100%;">
                <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                    <center>
                        <h2><b>Monitoring</b></h2>
                    </center>
                </div>
                <div class="card-body">
                    @php
                        use Illuminate\Support\Str;
                    @endphp

                    @if ($levelSakip == 99 || $levelSakip == 0 || !Str::startsWith($id_satker, 'was'))
                        <div class="card mb-4">
                            <div class="card-header" style="background-color: #e6bf3e;">
                                <h5>📊 Capaian Sasaran Program - {{ $tahun }}</h5>
                            </div>
                            <div class="card-body" id="saspro-wrapper">
                                <div class="text-muted">Memuat data...</div>
                            </div>
                        </div>
                        <br>
                    @endif
                    <!-- Form Pencarian -->
                    @if ($levelSakip == 99)
                    <form method="GET" action="{{ route('monitoring') }}" class="row g-2 mb-4">
                        <div class="col-md-5">
                            <select name="satker" id="satkerInput" class="form-select">
                                <option value="">-- Pilih Satker --</option>
                                @foreach ($satkers as $satker)
                                    <option value="{{ $satker->id_satker }}"
                                        {{ $search == $satker->id_satker ? 'selected' : '' }}>
                                        {{ $satker->id_satker }} - {{ $satker->satkernama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">Cari</button>
                        </div>
                    </form>

                    </form>

                    @if ($selectedSatker)
                        <div class="card mt-4">
                            <div class="card-header" style="background-color: #e6bf3e;">
                                <h5>Capaian Kinerja - {{ $selectedSatker->satkernama }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Sidebar Bidang -->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header bg-warning">
                                                <strong>📌 Daftar Bidang</strong>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($bidangs as $bidang)
                                                    <button
                                                        class="btn btn-outline-success text-black w-100 mb-2 bidang-item"
                                                        data-rumpun="{{ $bidang->rumpun }}">
                                                        {{ $bidang->bidang_nama }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Konten Indikator -->
                                    <div class="col-md-9">
                                        <div class="card" id="controls-wrapper" class="mb-3" style="display:none;">

                                            <div class="card-header d-flex align-items-center gap-2">
                                                <span>📋 Indikator</span>
                                                <select id="triwulan" class="form-select w-auto">
                                                    <option value="1" selected>Triwulan 1</option>
                                                    <option value="2">Triwulan 2</option>
                                                    <option value="3">Triwulan 3</option>
                                                    <option value="4">Triwulan 4</option>
                                                </select>
                                                <button id="reloadBtn" class="btn btn-success">Pilih</button>
                                            </div>

                                            <div class="card-body" id="subindikator-wrapper">
                                                <div class="alert alert-info">Pilih Bidang Terlebih dahulu</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- CDN Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#satkerInput').select2({
                placeholder: "Ketik Nama atau Kode Satker...",
                allowClear: true,
                width: '100%'
            });
        });

        $(document).ready(function() {
            let selectedRumpun = null;
            let idSatker = $("#satkerInput").val();

            // Klik bidang
            $(".bidang-item").on("click", function() {
                $(".bidang-item").removeClass("active");
                $(this).addClass("active");

                selectedRumpun = $(this).data("rumpun");

                // tampilkan controls triwulan + tombol reload
                $("#controls-wrapper").show();

                let triwulan = $("#triwulan").val();
                loadSubindikator(selectedRumpun, triwulan);
            });

            // Ganti triwulan langsung load
            $(document).on('change', '#triwulan', function() {
                let triwulan = $(this).val();
                if (selectedRumpun) {
                    loadSubindikator(selectedRumpun, triwulan);
                }
            });

            // Klik tombol reload
            $(document).on('click', '#reloadBtn', function() {

                let triwulan = $("#triwulan").val();
                loadSubindikator(selectedRumpun, triwulan);
            });

            // Fungsi load data subindikator
            function loadSubindikator(rumpun, tw) {
                $("#subindikator-wrapper").html('<div class="text-muted">Memuat data...</div>');
                $.ajax({
                    url: "/monitoring/subindikator2/" + rumpun,
                    data: {
                        triwulan: tw,
                        id_satker: idSatker
                    },
                    success: function(res) {
                        if (!res || res.length === 0) {
                            $("#subindikator-wrapper").html(
                                '<div class="alert alert-warning">Tidak ada data</div>');
                            return;
                        }

                        let html = `
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Indikator</th>
                                <th>Persentase</th>
                                <th>Target</th>
                                <th>Capaian</th>
                                <th>Faktor</th>
                                <th>Langkah</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                        $.each(res, function(i, row) {
                            html += `
                        <tr>
                            <td>${row.indikator_nama}</td>
                            <td>${row.persentase}%</td>
                            <td>${row.target_pk}%</td>
                            <td>${row.capaian_pk}%</td>
                            <td>${row.faktor ?? '-'}</td>
                            <td>${row.langkah ?? '-'}</td>
                        </tr>
                    `;
                        });

                        html += "</tbody></table>";
                        $("#subindikator-wrapper").html(html);
                    },
                    error: function(xhr) {
                        $("#subindikator-wrapper").html(
                            '<div class="alert alert-danger">Terjadi kesalahan mengambil data</div>'
                        );
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Load data capaian saspro semua kejati
            $.ajax({
                url: "{{ route('capaian.saspro.all') }}", // route ke controller baru
                method: "GET",
                success: function(res) {
                    if (!res || res.length === 0) {
                        $("#saspro-wrapper").html(
                            '<div class="alert alert-warning">Tidak ada data</div>');
                        return;
                    }

                    let html = `
                <table class="table table-bordered table-striped">
                    <thead class="table-warning">
                        <tr>
                            <th>ID Saspro</th>
                            <th>Nama Sasaran Program</th>
                            <th>Persentase</th>
                            <th>Target</th>
                            <th>Capaian</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

                   $.each(res, function(i, saspro) {
    html += `
        <tr class="table-warning">
            <td>${saspro.id_saspro}</td>
            <td>${saspro.nama_saspro}</td>
            <td>${saspro.rata_persentase}%</td>
            <td>${saspro.target}%</td>
            <td>${saspro.capaian}%</td>
        </tr>
    `;

    // tampilkan indikator di bawahnya
    if (saspro.indikators && saspro.indikators.length > 0) {
        $.each(saspro.indikators, function(j, ind) {
            html += `
                <tr class="table-light">
                    <td></td>
                    <td style="padding-left: 30px;">${ind.nama}</td>
                    <td>${ind.persentase}%</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            `;
        });
    }
});


                    html += "</tbody></table>";
                    $("#saspro-wrapper").html(html);
                },
                error: function(xhr) {
                    $("#saspro-wrapper").html(
                        '<div class="alert alert-danger">Terjadi kesalahan mengambil data</div>');
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush
