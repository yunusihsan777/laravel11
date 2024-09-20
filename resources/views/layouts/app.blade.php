<style>
    .min-vh-100 {
        min-height: 100vh;
    }

    .custom-card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: #f8f9fa;
        padding: 20px;
        max-width: 100%;
    }

    .custom-card .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    .custom-card .card-text {
        font-size: 1rem;
        color: #555;
        margin-bottom: 20px;
    }

    .custom-card .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: bold;
    }

    .custom-card .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
    @if (!auth()->check())
    
<div class="container mt-5">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <h5 class="card-title">Akses Ditolak</h5>
                    <p class="card-text">Silakan login terlebih dahulu untuk mengakses halaman ini.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </div>
            </div>
        </div>
    @else
<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body class="section-with-background" style="background-image: url('{{ asset('gambar/background.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 400px;">
    
    {{-- <div class="container-fluid"> --}}
        {{-- <div class="row"> --}}
            @include('layouts.sidebar')
            {{-- <main class="col-md-9 ms-sm-auto col-lg-10 px-4"> --}}
                @yield('content')
            {{-- </main> --}}
        {{-- </div> --}}
    {{-- </div> --}}
    @include('layouts.footer')
</body>
</html>

    
@endif
