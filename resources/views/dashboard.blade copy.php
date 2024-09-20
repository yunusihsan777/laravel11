<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fcfdfd;
            overflow-y: auto;
            transition: width 0.3s;
        }
        .sidebar.minimized {
            width: 80px;
        }
        .sidebar a {
            color: rgb(33, 32, 32);
            display: flex;
            align-items: center;
            padding: 15px;
            text-decoration: none;
            white-space: nowrap;
        }
        .sidebar.minimized a {
            justify-content: center;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar.minimized a i {
            margin-right: 0;
        }
        .sidebar a:hover {
            background-color: #f1ef4e;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px auto;
            background-position: center center;
            display: block;
            transition: width 0.3s, height 0.3s;
        }

        .sidebar.minimized .profile-pic {
            width: 40px;
            height: 40px;
        }

        .sidebar h4 {
            text-align: center;
        }
        .sidebar.minimized h4, .sidebar.minimized .sidebar-text {
            display: none;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .content.shrink {
            margin-left: 80px;
        }
        .navbar {
            margin-left: 250px;
            transition: margin-left 0.3s;
        }
        .navbar.shrink {
            margin-left: 80px;
        }
        .submenu {
            display: none;
            padding-left: 20px;
        }
        .submenu a {
            padding: 10px 15px;
            display: block;
        }
        .toggler-btn {
            position: fixed;
            top: 10px;
            left: 250px;
            transition: left 0.3s;
            z-index: 1000;
        }
        .toggler-btn.shrink {
            left: 80px;
        }
        .arrow-icon {
            margin-left: auto;
            transition: transform 0.3s;
        }
        .submenu-open .arrow-icon {
            transform: rotate(90deg);
        }
        .sidebar.minimized .arrow-icon {
            display: none;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .sidebar.minimized {
                width: 60px;
            }
            .content {
                margin-left: 200px;
            }
            .content.shrink {
                margin-left: 60px;
            }
            .toggler-btn {
                left: 200px;
            }
            .toggler-btn.shrink {
                left: 60px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
            .navbar {
                margin-left: 0;
            }
            .toggler-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar"><br>
        <img src="https://reformasibirokrasi.kejaksaan.go.id/assets/media/svg/logos/logo-rb-64.svg" alt="Profile Picture" class="profile-pic">
        <h4 class="text-center text-black">Selamat Datang<br>Nama Satker<br>ID Satker</h4>
        <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span class="sidebar-text">Beranda</span></a>
        <a href="#" id="toggle-submenu"><i class="fas fa-tasks"></i> <span class="sidebar-text">Tata Kelola AKIP</span>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </a>
        <div class="submenu" id="submenu">
            <a href="{{ route('keputusan') }}"><i class="fas fa-users"></i> Kep Tim SAKIP</a>
            <a href="#"><i class="fas fa-file-alt"></i> Perencanaan</a>
            <a href="#"><i class="fas fa-chart-line"></i> Pengukuran</a>
            <a href="#"><i class="fas fa-file-upload"></i> Pelaporan</a>
            <a href="#"><i class="fas fa-clipboard-check"></i> Evaluasi</a>
        </div>
        <a href="#"><i class="fas fa-globe"></i> <span class="sidebar-text">SAKIP Wilayah</span></a>
        <a href="#"><i class="fas fa-check-circle"></i> <span class="sidebar-text">SAKIP Validasi</span></a>
        <a href="#"><i class="fas fa-shield-alt"></i> <span class="sidebar-text">Kepatuhan AKIP</span></a>
        <a href="#"><i class="fas fa-comments"></i> <span class="sidebar-text">Chat Support</span></a>
        <a href="#"><i class="fas fa-envelope"></i> <span class="sidebar-text">Pengumuman</span></a>
        <a href="#"><i class="fas fa-gavel"></i> <span class="sidebar-text">Sumber Aturan</span></a>
        <a href="#"><i class="fas fa-book"></i> <span class="sidebar-text">Sumber Literasi</span></a>
        <a href="#"><i class="fas fa-question-circle"></i> <span class="sidebar-text">FAQ</span></a>
        <a href="#"><i class="fas fa-key"></i> <span class="sidebar-text">Ubah Password</span></a>
    </div>

    <!-- Sidebar Toggler Button -->
    <button class="btn btn-primary toggler-btn" id="toggler-btn">
        <i class="fas fa-chevron-left"></i>
    </button>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
        <div class="container-fluid">
            <span class="navbar-brand"><br><br>Halaman Saat Ini</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Satker 123</span>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content" id="content">
        <div class="container-fluid">
            {{-- <p class="lead">Overview of your account and activities.</p> --}}
    
            <!-- Dashboard Cards -->
            <div class="row">
                <!-- Card Pesan Masuk (1:1) -->
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><b>Pengumuman</b></h5>
                            <p class="card-text" style="color: red;"><b>Batas Waktu Pengisian dan Upload</b><br>
                                Bahwa sehubungan penilaian nasional AKIP satuan kerja di lingkungan Kejaksaan RI diberikan waktu batas pengisian dan upload paling lambat tanggal 28 Juni 2024
                                28/06/2024</p>
                            <a href="#" class="btn btn-primary">Lihat Pesan</a>
                        </div>
                    </div>
                </div>
    
                <!-- Card Sumber Aturan (1:3) -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><b>Sumber Aturan</b></h5>
                                <p class="card-text">Lihat sumber aturan dan referensi hukum yang relevan.</p>
                                <a href="#" class="btn btn-primary">Lihat Sumber Aturan</a>
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
                                <p class="card-text">Pertanyaan yang sering diajukan tentang sistem ini.</p>
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
                                <center><h5 class="card-title"><b>Gambaran Alur SAKIP</b></h5><center>
                                <img src="{{ asset('gambar/sakip.png') }}" class="img-fluid" alt="sakip">
                            </div>
                        </div>
                    </div>
    
                    <!-- Card untuk Gambar 1:2 -->
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <center><h5 class="card-title"><br><b>Gambar SMART Goals for Project Management</b></h5></center>
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
                                    <center><h3><b>SMART Goals for Project Management</b></h3></center>
        
                                    <h4>1. Specific</h4>
                                    <p>Ketika menetapkan tujuan untuk proyek yang akan kamu lakukan, tujuan tersebut harus jelas dan spesifik. Jika tidak, kamu akan kesulitan untuk tetap fokus pada proyek tersebut.</p>
                                    <p>Kamu bisa mempertimbangkan beberapa hal berikut ketika menentukan proyek yang akan dibuat:</p>
                                    <ul>
                                        <li>Tujuan apa yang ingin dicapai.</li>
                                        <li>Apa alasan tujuan tersebut dan mengapa tujuan tersebut penting.</li>
                                        <li>Tentukan siapa saja yang akan terlibat untuk mencapai tujuan tersebut.</li>
                                        <li>Jika membutuhkan lokasi, tentukan lokasi yang relevan dengan tujuan.</li>
                                        <li>Identifikasi persyaratan atau hambatan yang dapat menjadi masalah dalam proses pelaksanaan.</li>
                                    </ul>
                            
                                    <h4>2. Measurable</h4>
                                    <p>Saat menentukan tujuan proyek, kamu harus memastikan bahwa tujuan tersebut dapat diukur. Dengan begitu, kamu dapat melacak progresnya.</p>
                                    <p>Untuk itu, tentukan tugas yang spesifik. Tetapkan apa saja yang harus diselesaikan dan kapan tugas tersebut harus selesai. Ini akan memudahkanmu mengawasi jalannya proyek.</p>
                            
                                    <h4>3. Achievable</h4>
                                    <p>Agar tujuan proyekmu dapat tercapai, tujuan tersebut harus realistis. Kamu boleh membuat proyek yang menantang tetapi tetap memungkinkan.</p>
                                    <p>Perhatikan baik-baik peluang yang sebelumnya terlewatkan. Pikirkan juga sumber daya yang diperlukan untuk menyelesaikan tujuan tersebut.</p>
                                    <p>Kamu bisa melibatkan anggota tim dalam menetapkan tujuan proyek. Dengan begitu, mereka dapat memilih area proyek yang akan dikerjakan sesuai dengan keahlian dan kemampuan mereka.</p>
                            
                                    <h4>4. Relevant</h4>
                                    <p>Tujuan proyek haruslah relevan dengan misi perusahaan. Paling tidak, tujuan tersebut mencerminkan satu atau lebih dari nilai inti perusahaan.</p>
                                    <p>Untuk memastikan proyek memberikan hasil yang diharapkan, kamu harus memastikan bahwa setiap tujuan proyek konsisten dengan tujuan perusahaan secara keseluruhan.</p>
                            
                                    <h4>5. Time-bound</h4>
                                    <p>Kamu perlu memiliki tenggat waktu yang jelas untuk benar-benar fokus dalam mencapai tujuanmu. Tanpa tenggat waktu yang jelas, kamu tidak akan tahu di mana dan kapan harus memulai.</p>
                                    <p>Buatlah kerangka waktu yang realistis untuk dicapai pada setiap tahapan proyek. Untuk menghindari maraton yang tidak pernah berakhir dalam sebuah proyek, setiap tahapan harus memiliki tenggat waktu yang pasti.</p>
                                
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const navbar = document.getElementById('navbar');
        const togglerBtn = document.getElementById('toggler-btn');
        const submenuToggle = document.getElementById('toggle-submenu');
        const submenu = document.getElementById('submenu');
        const arrowIcon = togglerBtn.querySelector('i');
        const submenuArrow = document.querySelector('#toggle-submenu .arrow-icon');

        // Toggle sidebar size
        togglerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('minimized');
            content.classList.toggle('shrink');
            navbar.classList.toggle('shrink');
            togglerBtn.classList.toggle('shrink');

            // Change toggle button arrow direction
            if (sidebar.classList.contains('minimized')) {
                arrowIcon.classList.replace('fa-chevron-left', 'fa-chevron-right');
            } else {
                arrowIcon.classList.replace('fa-chevron-right', 'fa-chevron-left');
            }
        });

        // Toggle submenu visibility and arrow direction
        submenuToggle.addEventListener('click', () => {
            submenu.classList.toggle('d-block');
            submenuToggle.classList.toggle('submenu-open');

            // Change submenu arrow direction
            if (submenu.classList.contains('d-block')) {
                submenuArrow.style.transform = 'rotate(90deg)';
            } else {
                submenuArrow.style.transform = 'rotate(0)';
            }
        });
    </script>
</body>
</html>
