@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Evaluasi LKE') }}</div>

                <div class="card-body">

                    {{-- Tombol kontrol buka/tutup semua --}}
                    <div class="mb-3">
                        <button id="openAll" class="btn btn-success btn-sm">Buka Semua</button>
                        <button id="closeAll" class="btn btn-danger btn-sm">Tutup Semua</button>
                    </div>

                    <div class="accordion" id="accordionExample">
    @foreach($sections as $title => $items)
        @php
            $id = Str::slug($title, '_'); // bikin id unik dari judul
        @endphp
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-{{ $id }}">
                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $id }}"
                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                        aria-controls="collapse-{{ $id }}">
                    {{ $title }}
                </button>
            </h2>
            <div id="collapse-{{ $id }}"
                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                 aria-labelledby="heading-{{ $id }}"
                 data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Kriteria</th>
                                <th>Bukti Dukung</th>
                                <th>Cek Bukti Dukung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->dokumen_bukti }}</td>
                                    <td>
                                        <a href="{{ route('cekbdeval_lke', ['kode' => $item->kode]) }}" class="btn btn-primary btn-sm">
                                            Cek Bukti Dukung
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openAll');
    const closeBtn = document.getElementById('closeAll');

    if (openBtn) {
        openBtn.addEventListener('click', function () {
            document.querySelectorAll('#accordionExample .accordion-collapse').forEach(function (collapse) {
                let bsCollapse = bootstrap.Collapse.getInstance(collapse);
                if (!bsCollapse) {
                    bsCollapse = new bootstrap.Collapse(collapse, { toggle: false });
                }
                bsCollapse.show();
            });
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            document.querySelectorAll('#accordionExample .accordion-collapse').forEach(function (collapse) {
                let bsCollapse = bootstrap.Collapse.getInstance(collapse);
                if (!bsCollapse) {
                    bsCollapse = new bootstrap.Collapse(collapse, { toggle: false });
                }
                bsCollapse.hide();
            });
        });
    }
});
</script>

@endpush
@endsection