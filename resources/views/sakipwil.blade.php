@extends('layouts.app')

@section('title', 'SAKIP Wilayah')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <center>
                        <h2><b>DATA PERENCANAAN AKIP SATUAN KERJA KEJAKSAAN RI</b></h2>
                    </center><br>

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
                                    <th>Dipa</th>
                                    <th>Renaksi</th>
                                    <th>Perjanjian Kinerja</th>
                                    <th>Jumlah Indikator Kinerja</th>
                                    <th>Status Pengukuran Kinerja</th>
                                    <th>LKjIP</th>
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
                                                    <a href="{{ asset('uploads/keputusan/' . $row->id_satker . '_' . $tahun . '.pdf') }}"
                                                       target="_blank" class="text-success">
                                                       &#10003; <!-- Tanda centang -->
                                                    </a>
                                                @else
                                                    <span class="text-danger">-</span>
                                                @endif
                                            </td>
                                            <td>  @if (isset($renstra[$row->id_satker]) && $renstra[$row->id_satker]->isNotEmpty())
                                                <!-- Ambil data renstra pertama (karena sudah dikelompokkan berdasarkan id_satker dan diurutkan) -->
                                                @php
                                                    $latestRenstra = $renstra[$row->id_satker]->first();
                                                @endphp
                                                <a href="{{ asset('uploads/renstra/renstra_' . $latestRenstra->id_perubahan . '_' . $row->id_satker . '_' . $tahun . '.pdf') }}"
                                                   target="_blank" class="text-info">
                                                    &#10003; <!-- Tanda centang -->
                                                </a>
                                            @else
                                                <span class="text-danger">-</span>
                                            @endif</td>
                                            <td>{{ $row->iku ?? '-' }}</td>
                                            <td>{{ $row->renja ?? '-' }}</td>
                                            <td>{{ $row->dipa ?? '-' }}</td>
                                            <td>{{ $row->renaksi ?? '-' }}</td>
                                            <td>{{ $row->perjanjian_kinerja ?? '-' }}</td>
                                            <td>{{ $row->jumlah_indikator_kinerja ?? '-' }}</td>
                                            <td>{{ $row->status_pengukuran_kinerja ?? '-' }}</td>
                                            <td>{{ $row->lkjip ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="13" class="text-center text-danger">Tidak ada data yang tersedia.</td> <!-- Pesan jika tidak ada data -->
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="text-center">Distribusi Keputusan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    @endsection

    @section('style')
        <style>
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
      document.addEventListener('DOMContentLoaded', function () {
        const sortedKepList = @json($sortedKepList); // Mengambil data dari PHP

        // Menghitung jumlah keputusan yang terisi dan belum terisi
        const terisi = sortedKepList.filter(item => item).length; // Menghitung yang terisi
        const belumTerisi = sortedKepList.length - terisi; // Menghitung yang belum terisi

        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Keputusan Terisi', 'Keputusan Belum Terisi'],
                datasets: [{
                    label: 'Jumlah Keputusan',
                    data: [terisi, belumTerisi],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)', // Warna untuk terisi
                        'rgba(255, 99, 132, 0.6)', // Warna untuk belum terisi
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
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
    });
</script>