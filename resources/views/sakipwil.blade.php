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
                    <table class="table table-bordered table-striped">
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
                            
                            @foreach ($kejati as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->id_satker }}</td>
                                    <td>{{ $row->satkernama }}</td>
                                    {{-- <td>{{ $row->keputusan }}</td>
                                    <td>{{ $row->renstra }}</td>
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
        </style>
