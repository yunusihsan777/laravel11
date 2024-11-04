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
                                <?php $currentMonth = date('n'); ?>
                                <div class="mb-3">
                                    <label for="bulan">Pilih Bulan</label>
                                    <select name="bulan" class="form-select" required>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $i == $currentMonth ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                        
                                @foreach ($indikators as $indikator)
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">
                <h5>{{ $indikator->indikator }}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('pengukuran.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_indikator" value="{{ $indikator->id }}">

                    <!-- Bulan Selection -->
                    <div class="mb-3">
                        <label for="bulan_{{ $indikator->id }}">Pilih Bulan</label>
                        <select name="bulan" id="bulan_{{ $indikator->id }}" class="form-select" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == $currentMonth ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Matrix before dot -->
                    @if (!empty($indikator->before_dot))
                        <div class="mb-3">
                            <h6>{{ $indikator->before_dot }}</h6>
                            <label for="ditangani_before_{{ $indikator->id }}">Ditangani:</label>
                            <input type="number" class="form-control" name="ditangani_before" id="ditangani_before_{{ $indikator->id }}" placeholder="Jumlah ditangani">
                        </div>
                        <div class="mb-3">
                            <label for="diselesaikan_before_{{ $indikator->id }}">Diselesaikan:</label>
                            <input type="number" class="form-control" name="diselesaikan_before" id="diselesaikan_before_{{ $indikator->id }}" placeholder="Jumlah diselesaikan">
                        </div>
                    @endif

                    <!-- Matrix after dot -->
                    @if (!empty($indikator->after_dot))
                        <div class="mb-3">
                            <h6>{{ $indikator->after_dot }}</h6>
                            <label for="ditangani_after_{{ $indikator->id }}">Ditangani (After):</label>
                            <input type="number" class="form-control" name="ditangani_after" id="ditangani_after_{{ $indikator->id }}" placeholder="Jumlah ditangani (After)">
                        </div>
                        <div class="mb-3">
                            <label for="diselesaikan_after_{{ $indikator->id }}">Diselesaikan (After):</label>
                            <input type="number" class="form-control" name="diselesaikan_after" id="diselesaikan_after_{{ $indikator->id }}" placeholder="Jumlah diselesaikan (After)">
                        </div>
                    @endif

                    <!-- Faktor dan Upaya -->
                    <div class="mb-3">
                        <label for="faktor">Faktor:</label>
                        <textarea class="form-control" name="faktor" rows="3" placeholder="Kendala/Hambatan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="upaya">Upaya:</label>
                        <textarea class="form-control" name="upaya" rows="3" placeholder="Strategi/Optimalisasi"></textarea>
                    </div>

                    <button type="submit" class="btn" style="background-color: #39b65c; color: white;">Simpan</button>
                </form>
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
