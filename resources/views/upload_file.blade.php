@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card ">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Upload Bukti Dukung</h5>
        </div>
        <div class="card-body">
            
            {{-- Notifikasi sukses / error --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Pilihan bukti dukung --}}
                <div class="mb-3">
                        <label for="id_bukti" class="form-label">Pilih Bukti Dukung</label>
                        <select class="form-select" name="id_bukti" id="id_bukti" required>
                            <option value="">-- Pilih Bukti Dukung --</option>
                            @foreach($input as $item)
                                <option value="{{ $item->id }}">{{ $item->dokumen }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="tw-group" style="display:none;">
                        <label for="tw">Triwulan</label>
                        <select name="tw" id="tw" class="form-control">
                            <option value="">-- Pilih TW --</option>
                            <option value="TW I">TW I</option>
                            <option value="TW II">TW II</option>
                            <option value="TW III">TW III</option>
                            <option value="TW IV">TW IV</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Unggah</button>

                    @push('scripts')
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const idBuktiSelect = document.getElementById('id_bukti');
                            const twGroup = document.getElementById('tw-group');

                            const idsWithTw = [10,11,12,13,14,18,19,37,38,39,40];

                            idBuktiSelect.addEventListener('change', function () {
                                const selectedId = parseInt(this.value);
                                if (idsWithTw.includes(selectedId)) {
                                    twGroup.style.display = 'block';
                                    document.getElementById('tw').setAttribute('required', 'required');
                                } else {
                                    twGroup.style.display = 'none';
                                    document.getElementById('tw').removeAttribute('required');
                                }
                            });
                        });
                    </script>
                    @endpush

            </form>

            <hr>
        </div>
    </div>
</div>
@endsection
