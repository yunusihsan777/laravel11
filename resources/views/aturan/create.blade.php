@extends('layouts.app')

@section('title', 'Tambah Aturan')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <div class="card border-light shadow-sm">
            <div class="card-body">
    <div class="container">
        <h2>Tambah Peraturan</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('aturan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_namaproduk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="id_namaproduk" name="id_namaproduk" required>
            </div>
            <div class="mb-3">
                <label for="id_produsen" class="form-label">Produsen</label>
                <input type="text" class="form-control" id="id_produsen" name="id_produsen" required>
            </div>
            <div class="mb-3">
                <label for="id_tahun" class="form-label">Tahun</label>
                <input type="text" class="form-control" id="id_tahun" name="id_tahun" required>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Upload File (PDF)</label>
                <input type="file" class="form-control" id="file" name="file" accept="application/pdf" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            
        </form>
    </div>
</div>
</div>
</div>
</div>
@endsection
