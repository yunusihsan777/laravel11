@extends('layouts.app')

@section('title', 'Sumber Aturan')

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <center>
                        <h2><b>Sumber Aturan</b></h2>
                    </center><br><br>
                    
                    <table class="table table-bordered table-striped">
                        <thead class="table-warning">
                            <tr>
                                <th>No</th> <!-- Kolom nomor -->
                                <th>Nama Peraturan</th>
                                <th>Pemilik</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aturan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->id_namaproduk }}</td>
                                <td>{{ $item->id_produsen }}</td>
                                <td>{{ $item->id_tahun }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .table {
            background-color: white; /* Warna dasar tabel */
        }
        .table-warning {
            background-color: #f0bb49; /* Warna kuning untuk header tabel */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa; /* Warna putih untuk baris genap */
        }
        .table-striped tbody tr:hover {
            background-color: #e2e6ea; /* Warna saat hover */
        }
    </style>
@endsection
