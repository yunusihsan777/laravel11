@extends('layouts.app')

@section('title', 'Evaluasi')

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <h2>Evaluasi</h2>
            <div class="container mt-5">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="evaluasi-internal-tab" data-bs-toggle="tab"
                                    href="#evaluasi-internal" role="tab" aria-controls="evaluasi-internal"
                                    aria-selected="true">Evaluasi Internal</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="evaluasi-rencana-tab" data-bs-toggle="tab" href="#evaluasi-rencana"
                                    role="tab" aria-controls="evaluasi-rencana" aria-selected="false">Evaluasi Rencana
                                    Aksi</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="radar-capaian-tab" data-bs-toggle="tab" href="#radar-capaian"
                                    role="tab" aria-controls="radar-capaian" aria-selected="false">Radar Capaian</a>
                            </li>
                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="evaluasi-internal" role="tabpanel"
                                aria-labelledby="evaluasi-internal-tab">
                                <h5>Evaluasi Internal</h5>
                                <p>Content for Evaluasi Internal goes here.</p>
                            </div>
                            <div class="tab-pane fade" id="evaluasi-rencana" role="tabpanel"
                                aria-labelledby="evaluasi-rencana-tab">
                                <h5>Evaluasi Rencana Aksi</h5>
                                <p>Content for Evaluasi Rencana Aksi goes here.</p>
                            </div>
                            <div class="tab-pane fade" id="radar-capaian" role="tabpanel"
                                aria-labelledby="radar-capaian-tab">
                                <h5>Radar Capaian</h5>
                                <p>Content for Radar Capaian goes here.</p>
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
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            margin-right: -1px;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .nav-tabs {
            border-bottom: 1px solid #ddd;
        }

        .tab-content {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            background-color: #f8f9fa;
        }

        .tab-pane {
            min-height: 200px;
            /* Adjust as needed */
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
