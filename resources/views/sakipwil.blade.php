@extends('layouts.app')

@section('title', 'SAKIP Wilayah')

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <center>
                        <h2><b>DATA PERENCANAAN AKIP SATUAN KERJA KEJAKSAAN RI</b></h2>
                    </center><br>

                    <!-- List Pengumuman -->
                    <table class="table table-bordered table-striped table-center">
                        <thead class="table-warning">
                            <tr>
                                <th>No</th>
                                <th>ID Satker</th>
                                <th>Nama Satker</th>
                                <th>Keputusan</th>
                                <th>Renstra</th>
                                <th>Renja</th>
                                <th>Perjanjian Kinerja</th>
                                <th>Jumlah Indikator Kinerja</th>
                                <th>Status Pengukuran Kinerja</th>
                                <th>IKU</th>
                                <th>Dipa</th>
                                <th>Renaksi</th>
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
                                                    target="_blank" class="no-link">
                                                    &#10003; <!-- Tanda centang -->
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        {{-- <td>{{ $row->renstra }}</td>
                                    <td>{{ $row->renja }}</td>
                                    <td>{{ $row->perjanjian_kinerja }}</td>
                                    <td>{{ $row->jumlah_indikator_kinerja }}</td>
                                    <td>{{ $row->status_pengukuran_kinerja }}</td>
                                    <td>{{ $row->iku }}</td>
                                    <td>{{ $row->dipa }}</td>
                                    <td>{{ $row->renaksi }}</td>
                                    <td>{{ $row->lkjip }}</td> --}}
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">Tidak ada data yang tersedia.</td> <!-- Pesan jika tidak ada data -->
                                </tr>
                            @endif
                        </tbody>
                    </table>
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
                border-bottom: 2px solid #dee2e6;
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
