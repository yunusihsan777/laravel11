@extends('layouts.app')

@section('title', 'Pengukuran')

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <h2>Pengukuran</h2>
            <div class="card border-light shadow-sm">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background-color: #e74a4a; color: white;">
                        <h4>Bidang Pidum</h4>
                        <!-- Panah untuk buka tutup -->
                        <a data-bs-toggle="collapse" href="#collapseBidangPidum" role="button" aria-expanded="false"
                            aria-controls="collapseBidangPidum">
                            <i class="bi bi-chevron-down text-white"></i> <!-- Menggunakan ikon Bootstrap -->
                        </a>
                    </div>

                    {{-- <div id="collapseBidangPidum" class="collapse"> --}}
                    <div class="card-body">
                        <div class="row">

                            <div class="mb-3">
                                <?php
                                $currentMonth = date('n'); // Mengambil bulan saat ini (1-12)
                                ?>

                                <div class="mb-3">
                                    <label for="bulan">Pilih Bulan</label>
                                    <select name="bulan" class="form-select">
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $i == $currentMonth ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            @foreach ($indikator_pidum as $singleIndikator)
                                <div class="col-md-6">
                                    <!-- Setiap card akan berada di dalam kolom yang lebarnya 6 (1/2 dari 12) -->
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h5>{{ $singleIndikator->indikator }}</h5>
                                        </div>

                                        <div class="card-body">
                                            <form action="{{ route('pengukuran.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_indikator"
                                                    value="{{ $singleIndikator->id }}">

                                                <!-- Ditangani dan Diselesaikan dalam satu deret -->
                                                @foreach ($indikators as $indikator)
                                                    @if ($singleIndikator->id_indikator == $indikator->id_indikator)
                                                        <!-- Cocokkan id_indikator dengan singleIndikator -->
                                                        <!-- Proses before_dot jika ada -->
                                                        @if (!empty($indikator->before_dot))
                                                            <tr>
                                                                <td><b>{{ $indikator->before_dot }}</b></td>
                                                                <td>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                for="ditangani_before_{{ $indikator->id }}">Ditangani:</label>
                                                                            <input type="number" class="form-control"
                                                                                name="ditangani_before[{{ $indikator->id }}]"
                                                                                id="ditangani_before_{{ $indikator->id }}"
                                                                                placeholder="Jumlah ditangani"
                                                                                value="{{ isset($singleIndikator) && $singleIndikator->id === $indikator->id ? $singleIndikator->ditangani : '' }}">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                for="diselesaikan_before_{{ $indikator->id }}">Diselesaikan:</label>
                                                                            <input type="number" class="form-control"
                                                                                name="diselesaikan_before[{{ $indikator->id }}]"
                                                                                id="diselesaikan_before_{{ $indikator->id }}"
                                                                                placeholder="Jumlah diselesaikan"
                                                                                value="{{ isset($singleIndikator) && $singleIndikator->id === $indikator->id ? $singleIndikator->diselesaikan : '' }}">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif

                                                        <!-- Proses after_dot jika ada -->
                                                        @if (!empty($indikator->after_dot))
                                                            <tr>
                                                                <td><b>{{ $indikator->after_dot }}</b></td>
                                                                <td>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                for="ditangani_after_{{ $indikator->id }}">Ditangani:</label>
                                                                            <input type="number" class="form-control"
                                                                                name="ditangani_after[{{ $indikator->id }}]"
                                                                                id="ditangani_after_{{ $indikator->id }}"
                                                                                placeholder="Jumlah ditangani"
                                                                                value="{{ isset($singleIndikator) && $singleIndikator->id === $indikator->id ? $singleIndikator->ditangani : '' }}">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                for="diselesaikan_after_{{ $indikator->id }}">Diselesaikan:</label>
                                                                            <input type="number" class="form-control"
                                                                                name="diselesaikan_after[{{ $indikator->id }}]"
                                                                                id="diselesaikan_after_{{ $indikator->id }}"
                                                                                placeholder="Jumlah diselesaikan"
                                                                                value="{{ isset($singleIndikator) && $singleIndikator->id === $indikator->id ? $singleIndikator->diselesaikan : '' }}">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach

                                                <!-- Input Faktor sebagai textarea -->
                                                <div class="mb-3">
                                                    <label for="faktor">Faktor:</label>
                                                    <textarea class="form-control" name="faktor"
                                                        placeholder="Faktor apa saja yang menjadi Kendala/Hambatan anda hingga saat ini" rows="3">{{ isset($singleIndikator->id) ? $singleIndikator->faktor : '' }}</textarea>
                                                </div>

                                                <!-- Input Upaya sebagai textarea -->
                                                <div class="mb-3">
                                                    <label for="upaya">Upaya:</label>
                                                    <textarea class="form-control" name="upaya"
                                                        placeholder="Upaya strategi/optimalisasi kinerja anda untuk menangani Kendala/Hambatan saat ini" rows="3">{{ isset($singleIndikator->id) ? $singleIndikator->upaya : '' }}</textarea>
                                                </div>

                                                <button type="submit" class="btn"
                                                    style="background-color: #39b65c; color: white;">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @if ($loop->iteration % 2 == 0)
                        </div>
                        <div class="row"> <!-- Menutup dan membuka row baru setiap dua card -->
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
@endsection

@section('styles')
    <style>
        .nav-tabs .nav-link {
            border-radius: 0;
            border: 1px solid #dee2e6;
        }

        .nav-tabs .nav-link.active {
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        .card-body {
            padding: 1.5rem;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
