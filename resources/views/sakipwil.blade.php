@extends('layouts.app')

@section('title', 'SAKIP Wilayah')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card border-light shadow-sm">
                <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                    <center>
                        <h2><b>DATA PERENCANAAN AKIP SATUAN KERJA KEJAKSAAN RI</b></h2>
                    </center>
                </div>
                <div class="card-body">
                    @php
                        $levelSakip = session('id_sakip_level', 0);
                    @endphp
                    <!-- List Pengumuman -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center rounded">
                            <thead class="table-warning">
                                <tr>
                                    <th>No</th>
                                    <th>ID Satker</th>
                                    <th>Nama Satker</th>
                                    <th>Keputusan</th>
                                    <th>Renstra</th>
                                    <th>IKU</th>
                                    <th>Renja</th>
                                    <th>RKAKL</th>
                                    <th>Dipa</th>
                                    <th>Renaksi</th>
                                    <th>LKJIP</th>
                                    <th>Rapat Staff</th>
                                    @if ($levelSakip == 99)
                                        <th>Perjanjian Kinerja</th>
                                        <th>Jumlah Indikator Kinerja</th>
                                        <th>Status Pengukuran Kinerja</th>
                                        <th>LKjIP</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->isNotEmpty())
                                    @foreach ($data as $index => $row)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $row->id_satker }}</td>
                                            <td style="text-align: left;">{{ $satkernamaList[$index] }}</td>
                                            <td>
                                                @if (!empty($sortedKepList[$index]))
                                                    <a href="{{ asset('uploads/KEP/' . $row->id_satker . '.pdf') }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($renstra[$row->id_satker]) && $renstra[$row->id_satker]->isNotEmpty())
                                                    @php
                                                        $latestRenstra = $renstra[$row->id_satker]->first();
                                                    @endphp
                                                    <a href="{{ asset('uploads/repository/' . $latestRenstra->id_satker . '/' . $latestRenstra->id_filename) }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($iku[$row->id_satker]) && $iku[$row->id_satker]->isNotEmpty())
                                                    <!-- Ambil data iku pertama (karena sudah dikelompokkan berdasarkan id_satker dan diurutkan) -->
                                                    @php
                                                        $latestiku = $iku[$row->id_satker]->first();
                                                    @endphp
                                                    <a href="{{ asset('uploads/repository/' . $latestiku->id_satker . '/' . $latestiku->id_filename) }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($renja[$row->id_satker]) && $renja[$row->id_satker]->isNotEmpty())
                                                    <!-- Ambil data renja pertama (karena sudah dikelompokkan berdasarkan id_satker dan diurutkan) -->
                                                    @php
                                                        $latestrenja = $renja[$row->id_satker]->first();
                                                    @endphp
                                                    <a href="{{ asset('uploads/repository/' . $latestrenja->id_satker . '/' . $latestrenja->id_filename) }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($rkakl[$row->id_satker]) && $rkakl[$row->id_satker]->isNotEmpty())
                                                    @php
                                                        $latestRkakl = $rkakl[$row->id_satker]->first();
                                                    @endphp
                                                    <a href="{{ asset('uploads/repository/' . $latestRkakl->id_satker . '/' . $latestRkakl->id_filename) }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($dipa[$row->id_satker]) && $dipa[$row->id_satker]->isNotEmpty())
                                                    @php
                                                        $latestDipa = $dipa[$row->id_satker]->first();
                                                    @endphp
                                                    <a href="{{ asset('uploads/repository/' . $latestDipa->id_satker . '/' . $latestDipa->id_filename) }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($renaksi[$row->id_satker]) && $renaksi[$row->id_satker]->isNotEmpty())
                                                    @php
                                                        // Ambil data renaksi pertama untuk id_satker tertentu
                                                        $latestRenaksi = $renaksi[$row->id_satker]->first();
                                                    @endphp
                                                    <a href="{{ asset('uploads/repository/' . $latestRenaksi->id_satker . '/' . $latestRenaksi->id_filename) }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($lkjip[$row->id_satker]) && $lkjip[$row->id_satker]->isNotEmpty())
                                                    @php
                                                        $latestLkjip = $lkjip[$row->id_satker]->first();
                                                    @endphp
                                                    <a href="{{ asset('uploads/repository/' . $latestLkjip->id_satker . '/' . $latestLkjip->id_filename) }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($rastaff[$row->id_satker]) && $rastaff[$row->id_satker]->isNotEmpty())
                                                    @php
                                                        $latestRastaff = $rastaff[$row->id_satker]->first();
                                                    @endphp
                                                    <a href="{{ asset('uploads/repository/' . $latestRastaff->id_satker . '/' . $latestRastaff->id_filename) }}"
                                                        target="_blank" class="text-success" style="text-decoration: none;">
                                                        &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif

                                            </td>
                                            @if ($levelSakip == 99)
                                                <td>{{ $row->perjanjian_kinerja ?? '-' }}</td>
                                                <td>{{ $row->jumlah_indikator_kinerja ?? '-' }}</td>
                                                <td>{{ $row->status_pengukuran_kinerja ?? '-' }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="13" class="text-center text-danger">Tidak ada data yang tersedia.
                                        </td> <!-- Pesan jika tidak ada data -->
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="card shadow-sm mb-4">
                            <div class="card border-light shadow-sm" style="background-color: #e3e2e2;">
                                <center>
                                    <h2><b>Distribusi Keputusan</b></h2>
                                </center>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><b>Keputusan Terisi</b></h5>
                                            </center>
                                            <canvas id="pieChart1"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><b>Keputusan Belum Terisi</b></h5>
                                            </center>
                                            <canvas id="pieChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center><h5 class="card-title"><b>IKU</b></h5></center>
                                            <canvas id="pieChart3"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><b>Renja</b></h5>
                                            </center>
                                            <canvas id="pieChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><b>RKAKL</b></h5>
                                            </center>
                                            <canvas id="pieChart5"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><b>DIPA</b></h5>
                                            </center>
                                            <canvas id="pieChart6"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><b>Renaksi</b></h5>
                                            </center>
                                            <canvas id="pieChart7"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><b>LKJIP</b></h5>
                                            </center>
                                            <canvas id="pieChart8"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><b>Rapat Staff</b></h5>
                                            </center>
                                            <canvas id="pieChart9"></canvas>
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

    @section('style')
        <style>
            .link-no-underline {
                text-decoration: none;
            }

            .table-hover tbody tr:hover {
                background-color: #f1f1f1;
            }

            .table-bordered {
                border: 1px solid #dee2e6;
            }

            .table thead th {
                border-bottom: 2px solid #ebca37;
            }

            .table td,
            .table th {
                vertical-align: middle;
            }

            .table-center {
                width: 100%;
                /* Opsional: sesuaikan lebar tabel */
                border-collapse: collapse;
                /* Menghilangkan jarak antara border sel */
            }

            .table-center th,
            .table-center td {
                text-align: center;
                /* Mengatur teks di tengah */
                padding: 10px;
                /* Menambahkan padding untuk estetika */
                border: 1px solid #ddd;
                /* Mengatur border pada sel */
            }

            .no-link {
                text-decoration: none;
                /* Menghilangkan garis bawah */
                color: inherit;
                /* Menggunakan warna teks dari elemen induk */
                /* cursor: default; */
                /* Mengubah kursor agar tidak menunjukkan sebagai link */
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // keputusan
                const sortedKepList = @json($sortedKepList); // Mengambil data dari PHP

                // Menghitung jumlah keputusan yang terisi dan belum terisi
                const terisi = sortedKepList.filter(item => item).length; // Menghitung yang terisi
                const belumTerisi = sortedKepList.length - terisi; // Menghitung yang belum terisi

                const ctx = document.getElementById('pieChart1').getContext('2d');
                const pieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Keputusan Terisi', 'Keputusan Belum Terisi'],
                        datasets: [{
                            label: 'Jumlah Keputusan',
                            data: [terisi, belumTerisi],
                            backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return `${tooltipItem.label}: ${tooltipItem.raw}`;
                                    }
                                }
                            }
                        }
                    }
                });
                //renstra
                const sortedRenstraList = @json($sortedRenstraList);
                const terisiRenstra = sortedRenstraList.filter(item => item).length;
                const belumTerisiRenstra = sortedRenstraList.length - terisiRenstra;

                const ctx3 = document.getElementById('pieChart2').getContext('2d');
                new Chart(ctx3, {
                    type: 'pie',
                    data: {
                        labels: ['Terisi', 'Belum Terisi'],
                        datasets: [{
                            data: [terisiRenstra, belumTerisiRenstra],
                             backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                //IKU
                const sortedIkuList = @json($sortedIkuList);
                const terisiIku = sortedIkuList.filter(item => item).length;
                const belumTerisiIku = sortedIkuList.length - terisiIku;

                const ctxIku = document.getElementById('pieChart3').getContext('2d');
                new Chart(ctxIku, {
                    type: 'pie',
                    data: {
                        labels: ['Terisi', 'Belum Terisi'],
                        datasets: [{
                            data: [terisiIku, belumTerisiIku],
                             backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                //renja
                const sortedRenjaList = @json($sortedRenjaList);
                const terisiRenja = sortedRenjaList.filter(item => item).length;
                const belumTerisiRenja = sortedRenjaList.length - terisiRenja;

                const ctxRenja = document.getElementById('pieChart4').getContext('2d');
                new Chart(ctxRenja, {
                    type: 'pie',
                    data: {
                        labels: ['Terisi', 'Belum Terisi'],
                        datasets: [{
                            data: [terisiRenja, belumTerisiRenja],
                             backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                //rkakl
                const sortedRkaklList = @json($sortedRkaklList);
                const terisiRkakl = sortedRkaklList.filter(item => item).length;
                const belumTerisiRkakl = sortedRkaklList.length - terisiRkakl;

                const ctxRkakl = document.getElementById('pieChart5').getContext('2d');
                new Chart(ctxRkakl, {
                    type: 'pie',
                    data: {
                        labels: ['Terisi', 'Belum Terisi'],
                        datasets: [{
                            data: [terisiRkakl, belumTerisiRkakl],
                             backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                //dipa
                const sortedDipaList = @json($sortedDipaList);
                const terisiDipa = sortedDipaList.filter(item => item).length;
                const belumTerisiDipa = sortedDipaList.length - terisiDipa;

                const ctxDipa = document.getElementById('pieChart6').getContext('2d');
                new Chart(ctxDipa, {
                    type: 'pie',
                    data: {
                        labels: ['Terisi', 'Belum Terisi'],
                        datasets: [{
                            data: [terisiDipa, belumTerisiDipa],
                            backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                //renaksi
                const sortedRenaksiList = @json($sortedRenaksiList);
                const terisiRenaksi = sortedRenaksiList.filter(item => item).length;
                const belumTerisiRenaksi = sortedRenaksiList.length - terisiRenaksi;

                const ctxRenaksi = document.getElementById('pieChart7').getContext('2d');
                new Chart(ctxRenaksi, {
                    type: 'pie',
                    data: {
                        labels: ['Terisi', 'Belum Terisi'],
                        datasets: [{
                            data: [terisiRenaksi, belumTerisiRenaksi],
                             backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                //lkjip
                const sortedLkjipList = @json($sortedLkjipList);
                const terisiLkjip = sortedLkjipList.filter(item => item).length;
                const belumTerisiLkjip = sortedLkjipList.length - terisiLkjip;

                const ctxLkjip = document.getElementById('pieChart8').getContext('2d');
                new Chart(ctxLkjip, {
                    type: 'pie',
                    data: {
                        labels: ['Terisi', 'Belum Terisi'],
                        datasets: [{
                            data: [terisiLkjip, belumTerisiLkjip],
                            backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                //rastaff
                const sortedRastaffList = @json($sortedRastaffList);
                const terisiRastaff = sortedRastaffList.filter(item => item).length;
                const belumTerisiRastaff = sortedRastaffList.length - terisiRastaff;

                const ctxRastaff = document.getElementById('pieChart9').getContext('2d');
                new Chart(ctxRastaff, {
                    type: 'pie',
                    data: {
                        labels: ['Terisi', 'Belum Terisi'],
                        datasets: [{
                            data: [terisiRastaff, belumTerisiRastaff],
                             backgroundColor: ['#4CAF50', '#E53935'],
                            borderColor: ['#00838F', '#C62828'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

            });
        </script>
