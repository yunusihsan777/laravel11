@extends('layouts.app')

@section('title', 'Pengukuran')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <h2>Perencanaan</h2>
    <div class="container mt-5">
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="triwulan-i-tab" data-bs-toggle="tab" href="#triwulan-i" role="tab" aria-controls="triwulan-i" aria-selected="true">Triwulan I</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="triwulan-ii-tab" data-bs-toggle="tab" href="#triwulan-ii" role="tab" aria-controls="triwulan-ii" aria-selected="false">Triwulan II</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="triwulan-iii-tab" data-bs-toggle="tab" href="#triwulan-iii" role="tab" aria-controls="triwulan-iii" aria-selected="false">Triwulan III</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="triwulan-iv-tab" data-bs-toggle="tab" href="#triwulan-iv" role="tab" aria-controls="triwulan-iv" aria-selected="false">Triwulan IV</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="validasi-apip-tab" data-bs-toggle="tab" href="#validasi-apip" role="tab" aria-controls="validasi-apip" aria-selected="false">Validasi APIP</a>
                    </li>
                </ul>
                
                <!-- Tabs Content -->
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="triwulan-i" role="tabpanel" aria-labelledby="triwulan-i-tab">
                        <h2>IKU</h2>
                        <p>Content for IKU goes here...</p>
                    </div>
                    <div class="tab-pane fade" id="triwulan-ii" role="tabpanel" aria-labelledby="triwulan-ii-tab">
                        <h2>IKU</h2>
                        <p>Content for IKU goes here...</p>
                    </div>
                    <div class="tab-pane fade" id="triwulan-iii" role="tabpanel" aria-labelledby="triwulan-iii-tab">
                        <h2>IKU</h2>
                        <p>Content for IKU goes here...</p>
                    </div>
                    <div class="tab-pane fade" id="triwulan-iv" role="tabpanel" aria-labelledby="triwulan-iv-tab">
                        <h2>IKU</h2>
                        <p>Content for IKU goes here...</p>
                    </div>
                    <div class="tab-pane fade" id="validasi-apip" role="tabpanel" aria-labelledby="validasi-apip-tab">
                        <h2>IKU</h2>
                        <p>Content for IKU goes here...</p>
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
