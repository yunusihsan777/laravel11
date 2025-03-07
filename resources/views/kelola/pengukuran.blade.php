@extends('layouts.app')

@section('title', 'Pengukuran')

@section('content')
    <div class="content" id="content">
        <div class="container-fluid">
            <div class="card border-light shadow-sm">
                <!-- Judul -->
                <div class="card border-light shadow-sm" style="background-color: #e3e2e2;">
                    <center>
                        <h2><b>Pengukuran</b></h2>
                    </center>
                </div><br>
                @php
                    $bulanSekarang = session('bulan_terpilih', date('n')); // Ambil bulan dari session, jika tidak ada gunakan bulan sekarang
                @endphp

                <!-- Row untuk membagi dua kolom (Bidang & Indikator) -->
                <div class="row">
                    <!-- Kolom Kiri (Daftar Bidang) -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-warning">
                                <strong>📌 Daftar Bidang</strong>
                            </div>
                            <div class="card-body">
                                @php
                                    use App\Models\Bidang;
                                    $bidangs =
                                        session('id_sakip_level') == 3 ? Bidang::where('bidang_lokasi', 3)->get() : [];
                                @endphp

                                @foreach ($bidangs as $bidang)
                                    <button class="btn btn-outline-primary w-100 mb-2 bidang-item"
                                        data-id="{{ $bidang->rumpun }}">
                                        {{ $bidang->bidang_nama }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan (Indikator & Sub-Indikator) -->
                    <div class="col-md-9">
                        <div class="card h-100">
                            <div class="card-header bg-warning text-black">
                                <strong>📌 Indikator</strong>
                            </div>
                            @php
                                $bulanSekarang = session('bulan_terpilih', date('n')); // Ambil bulan dari session, default ke bulan sekarang
                                $daftarBulan = [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ];
                            @endphp

                            <!-- Dropdown Pilih Bulan -->
                            <div class="d-flex align-items-center mt-2 ms-3">
                                <strong class="me-3">Pilih Bulan:</strong>
                                <div class="input-group w-auto">
                                    <select id="bulanDropdown" class="form-select">
                                        @foreach ($daftarBulan as $num => $namaBulan)
                                            <option value="{{ $num }}"
                                                {{ $num == $bulanSekarang ? 'selected' : '' }}>
                                                {{ $namaBulan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
<br>


                            <div class="card-body overflow-auto" id="indikator-container" style="max-height: 80vh;">
                                <p class="text-center"><i>Pilih bidang untuk melihat indikator.</i></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- END ROW -->
            </div> <!-- END CARD -->
        </div> <!-- END CONTAINER -->
    </div> <!-- END CONTENT -->

    <!-- AJAX Script -->
    <script>
       document.addEventListener("DOMContentLoaded", function () {
    let bidangButtons = document.querySelectorAll('.bidang-item');
    let indikatorContainer = document.getElementById('indikator-container');
    let bulanDropdown = document.getElementById('bulanDropdown');

    function loadIndikator(bidangId, bulan) {
        fetch(`/pengukuran/indikator?bidang_id=${bidangId}&bulan=${bulan}`)
            .then(response => response.text())
            .then(html => {
                indikatorContainer.innerHTML = html;
            })
            .catch(error => {
                console.error('Error:', error);
                indikatorContainer.innerHTML = '<p class="text-danger">Gagal mengambil data.</p>';
            });
    }

    bidangButtons.forEach(button => {
        button.addEventListener('click', function () {
            let bidangId = this.getAttribute('data-id');
            let selectedBulan = bulanDropdown.value;

            // Hapus kelas 'active' dari semua tombol bidang
            bidangButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active'); // Tandai bidang yang aktif

            loadIndikator(bidangId, selectedBulan);
        });
    });

    bulanDropdown.addEventListener('change', function () {
        let bidangId = document.querySelector('.bidang-item.active')?.getAttribute('data-id');
        if (bidangId) {
            loadIndikator(bidangId, this.value);
        }
    });
});

    </script>
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
    <!-- JavaScript untuk AJAX -->
    
@endsection
