@extends('layouts.app')

@section('title', 'Pelaporan')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <h2>Pelaporan</h2>
    <div class="container mt-5">
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="triwulan1-tab" data-bs-toggle="tab" href="#triwulan1" role="tab" aria-controls="triwulan1" aria-selected="true">Capaian Triwulan I</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="triwulan2-tab" data-bs-toggle="tab" href="#triwulan2" role="tab" aria-controls="triwulan2" aria-selected="false">Capaian Triwulan II</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="triwulan3-tab" data-bs-toggle="tab" href="#triwulan3" role="tab" aria-controls="triwulan3" aria-selected="false">Capaian Triwulan III</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="triwulan4-tab" data-bs-toggle="tab" href="#triwulan4" role="tab" aria-controls="triwulan4" aria-selected="false">Capaian Triwulan IV</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="lhe-akip-tab" data-bs-toggle="tab" href="#lhe-akip" role="tab" aria-controls="lhe-akip" aria-selected="false">LHE AKIP</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="lkjip-tab" data-bs-toggle="tab" href="#lkjip" role="tab" aria-controls="lkjip" aria-selected="false">Laporan Kinerja (LKJiP)</a>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="triwulan1" role="tabpanel" aria-labelledby="triwulan1-tab">
                        <h5>Capaian Triwulan I</h5>
                        <p>Content for Capaian Triwulan I goes here.</p>
                    </div>
                    <div class="tab-pane fade" id="triwulan2" role="tabpanel" aria-labelledby="triwulan2-tab">
                        <h5>Capaian Triwulan II</h5>
                        <p>Content for Capaian Triwulan II goes here.</p>
                    </div>
                    <div class="tab-pane fade" id="triwulan3" role="tabpanel" aria-labelledby="triwulan3-tab">
                        <h5>Capaian Triwulan III</h5>
                        <p>Content for Capaian Triwulan III goes here.</p>
                    </div>
                    <div class="tab-pane fade" id="triwulan4" role="tabpanel" aria-labelledby="triwulan4-tab">
                        <h5>Capaian Triwulan IV</h5>
                        <p>Content for Capaian Triwulan IV goes here.</p>
                    </div>
                    <div class="tab-pane fade" id="lhe-akip" role="tabpanel" aria-labelledby="lhe-akip-tab">
                        <h5>LHE AKIP</h5>
                        <p>Content for LHE AKIP goes here.</p>
                    </div>
                    <div class="tab-pane fade" id="lkjip" role="tabpanel" aria-labelledby="lkjip-tab">
                        <h5>Laporan Kinerja (LKJiP)</h5>
                        <p>Content for Laporan Kinerja (LKJiP) goes here.</p>
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
            min-height: 200px; /* Adjust as needed */
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
