@extends('layouts.app')

@section('title', 'Tambah Aturan')

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                        <h2>Tambah Peraturan</h2>

                        <form action="{{ route('aturan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                
                            <div class="form-group">
                                <label for="id_namaproduk">Nama Peraturan</label>
                                <input type="text" class="form-control" id="id_namaproduk" name="id_namaproduk" required>
                            </div>
                
                            <div class="form-group">
                                <label for="id_produsen">Pemilik</label>
                                <input type="text" class="form-control" id="id_produsen" name="id_produsen" required>
                            </div>
                
                            <div class="form-group">
                                <label for="id_tahun">Tahun</label>
                                <input type="number" class="form-control" id="id_tahun" name="id_tahun" required>
                            </div>
                
                            <div class="form-group">
                                <label for="file">Upload File (PDF)</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>
                
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
