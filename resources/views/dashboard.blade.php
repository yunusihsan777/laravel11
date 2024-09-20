@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Main Content -->
    <div class="content" id="content">
        <div class="container-fluid">
            <h2>Beranda</h2>
            {{-- <p class="lead">Overview of your account and activities.</p> --}}

            <!-- Dashboard Cards -->
            <div class="row">
                <!-- Card Pesan Masuk (1:1) -->

                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><b>Pengumuman</b></h5>
                            @foreach ($pengumuman as $item)
                                <p class="card-text" style="color: red;">
                                    <b>{{ $item->judul }}</b>
                                </p>
                                <p> {{ $item->isi }}
                                </p>
                            @endforeach

                        </div>
                    </div>
                </div>



                <!-- Card Sumber Aturan (1:3) -->

                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><b>Sumber Aturan</b></h5>
                            <p class="card-text">Lihat sumber aturan dan referensi hukum yang relevan.</p>
                            <p class="card-text"><b>Jumlah Aturan:</b> {{ $jumlahAturan }} Dokumen</p>
                            <!-- Menampilkan jumlah aturan -->
                            <a href="{{ route('aturan') }}" class="btn btn-primary">Lihat Sumber Aturan</a>
                        </div>
                    </div>
                </div>



                <!-- Card Sumber Literasi (1:3) -->
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><b>Sumber Literasi</b></h5>
                            <p class="card-text">Jelajahi sumber literasi dan referensi tambahan.</p>
                            <a href="#" class="btn btn-primary">Lihat Sumber Literasi</a>
                        </div>
                    </div>
                </div>

                <!-- Card FAQ (1:3) -->
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><b>FAQ</b></h5>
                            <p class="card-text">Lihat pertanyaan yang sering diajukan tentang sistem ini.</p>
                            <a href="#" class="btn btn-primary">Lihat FAQ</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Cards Below -->
            <div class="row">
                <!-- Card untuk Gambar 1:1 -->
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title"><b>Gambaran Alur SAKIP</b></h5>
                                <center>
                                    <img src="{{ asset('gambar/sakip.png') }}" class="img-fluid" alt="sakip">
                        </div>
                    </div>
                </div>

                <!-- Card untuk Gambar 1:2 -->
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title"><br><b>Gambar SMART Goals for Project Management</b></h5>
                            </center>
                            <img src="{{ asset('gambar/smart.png') }}" class="img-fluid" alt="smart">
                        </div>
                    </div>
                </div>

                <!-- Card untuk Teks 1:2 -->
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title"><b>Teks 1:2</b></h5> --}}
                            <p class="card-text">
                                <center>
                                    <h3><b>SMART Goals for Project Management</b></h3>
                                </center>

                            <h4>1. Specific</h4>
                            <p>Ketika menetapkan tujuan untuk proyek yang akan kamu lakukan, tujuan tersebut harus jelas
                                dan spesifik. Jika tidak, kamu akan kesulitan untuk tetap fokus pada proyek tersebut.
                            </p>
                            <p>Kamu bisa mempertimbangkan beberapa hal berikut ketika menentukan proyek yang akan
                                dibuat:</p>
                            <ul>
                                <li>Tujuan apa yang ingin dicapai.</li>
                                <li>Apa alasan tujuan tersebut dan mengapa tujuan tersebut penting.</li>
                                <li>Tentukan siapa saja yang akan terlibat untuk mencapai tujuan tersebut.</li>
                                <li>Jika membutuhkan lokasi, tentukan lokasi yang relevan dengan tujuan.</li>
                                <li>Identifikasi persyaratan atau hambatan yang dapat menjadi masalah dalam proses
                                    pelaksanaan.</li>
                            </ul>

                            <h4>2. Measurable</h4>
                            <p>Saat menentukan tujuan proyek, kamu harus memastikan bahwa tujuan tersebut dapat diukur.
                                Dengan begitu, kamu dapat melacak progresnya.</p>
                            <p>Untuk itu, tentukan tugas yang spesifik. Tetapkan apa saja yang harus diselesaikan dan
                                kapan tugas tersebut harus selesai. Ini akan memudahkanmu mengawasi jalannya proyek.</p>

                            <h4>3. Achievable</h4>
                            <p>Agar tujuan proyekmu dapat tercapai, tujuan tersebut harus realistis. Kamu boleh membuat
                                proyek yang menantang tetapi tetap memungkinkan.</p>
                            <p>Perhatikan baik-baik peluang yang sebelumnya terlewatkan. Pikirkan juga sumber daya yang
                                diperlukan untuk menyelesaikan tujuan tersebut.</p>
                            <p>Kamu bisa melibatkan anggota tim dalam menetapkan tujuan proyek. Dengan begitu, mereka
                                dapat memilih area proyek yang akan dikerjakan sesuai dengan keahlian dan kemampuan
                                mereka.</p>

                            <h4>4. Relevant</h4>
                            <p>Tujuan proyek haruslah relevan dengan misi perusahaan. Paling tidak, tujuan tersebut
                                mencerminkan satu atau lebih dari nilai inti perusahaan.</p>
                            <p>Untuk memastikan proyek memberikan hasil yang diharapkan, kamu harus memastikan bahwa
                                setiap tujuan proyek konsisten dengan tujuan perusahaan secara keseluruhan.</p>

                            <h4>5. Time-bound</h4>
                            <p>Kamu perlu memiliki tenggat waktu yang jelas untuk benar-benar fokus dalam mencapai
                                tujuanmu. Tanpa tenggat waktu yang jelas, kamu tidak akan tahu di mana dan kapan harus
                                memulai.</p>
                            <p>Buatlah kerangka waktu yang realistis untuk dicapai pada setiap tahapan proyek. Untuk
                                menghindari maraton yang tidak pernah berakhir dalam sebuah proyek, setiap tahapan harus
                                memiliki tenggat waktu yang pasti.</p>

                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

<style>
    /* Awal card berada di bawah dan tersembunyi */
    .card {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.6s ease-out;
    }

    /* Setelah halaman dimuat, card akan muncul ke posisi semula */
    .card.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pilih semua elemen dengan class 'card'
        const cards = document.querySelectorAll('.card');

        // Tambahkan class 'show' untuk memulai animasi slide up
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('show');
            }, index * 100); // Animasi akan muncul satu per satu dengan delay 100ms
        });
    });
</script>
