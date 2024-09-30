<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <br>
    @php
        $satkernama = session('satkernama', 'Nama Satker');
        $idSatker = session('id_satker', 'ID Satker');
    @endphp
    <img src="{{ asset('gambar/kejaksaan.png') }}" alt="Profile Picture" class="profile-pic">
    <h5 class="text-center text-dark">Selamat Datang<br>{{ $satkernama }}<br>ID Satker: {{ $idSatker }}</h5>

    <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i> <span class="sidebar-text">Beranda</span>
    </a>

    <a href="#" id="toggle-submenu">
        <i class="fas fa-tasks"></i> <span class="sidebar-text">Tata Kelola AKIP</span>
        <i class="fas fa-chevron-right arrow-icon"></i>
    </a>

    <div class="submenu" id="submenu" style="display: none;">
        <a href="{{ route('kep') }}" class="{{ request()->is('kep') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Kep Tim SAKIP
        </a>
        <a href="{{ route('perencanaan') }}" class="{{ request()->is('perencanaan') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i> Perencanaan
        </a>
        <a href="{{ route('pengukuran') }}" class="{{ request()->is('pengukuran') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Pengukuran
        </a>
        <a href="{{ route('pelaporan') }}" class="{{ request()->is('pelaporan') ? 'active' : '' }}">
            <i class="fas fa-file-upload"></i> Pelaporan
        </a>
        <a href="{{ route('evaluasi') }}" class="{{ request()->is('evaluasi') ? 'active' : '' }}">
            <i class="fas fa-clipboard-check"></i> Evaluasi
        </a>
    </div>

    <a href="{{ route('sakipwil') }}" class="{{ request()->is('sakipwil') ? 'active' : '' }}">
        <i class="fas fa-globe"></i> <span class="sidebar-text">SAKIP Wilayah</span>
    </a>
    <a href="{{ route('sakipvalidasi') }}" class="{{ request()->is('sakipvalidasi') ? 'active' : '' }}">
        <i class="fas fa-check-circle"></i> <span class="sidebar-text">SAKIP Validasi</span>
    </a>
    <a href="{{ route('kepatuhan') }}" class="{{ request()->is('kepatuhan') ? 'active' : '' }}">
        <i class="fas fa-shield-alt"></i> <span class="sidebar-text">Kepatuhan AKIP</span>
    </a>
    <a href="{{ route('chatsupport') }}" class="{{ request()->is('chatsupport') ? 'active' : '' }}">
        <i class="fas fa-comments"></i> <span class="sidebar-text">Chat Support</span>
    </a>
    <a href="{{ route('pengumuman') }}" class="{{ request()->is('pengumuman') ? 'active' : '' }}">
        <i class="fas fa-envelope"></i> <span class="sidebar-text">Pengumuman</span>
    </a>
    <a href="{{ route('aturan') }}" class="{{ request()->is('aturan') ? 'active' : '' }}">
        <i class="fas fa-gavel"></i> <span class="sidebar-text">Sumber Aturan</span>
    </a>
    <a href="{{ route('literasi') }}" class="{{ request()->is('literasi') ? 'active' : '' }}">
        <i class="fas fa-book"></i> <span class="sidebar-text">Sumber Literasi</span>
    </a>
    <a href="{{ route('faq') }}" class="{{ request()->is('faq') ? 'active' : '' }}">
        <i class="fas fa-question-circle"></i> <span class="sidebar-text">FAQ</span>
    </a>
    <a href="{{ route('ubahpassword') }}" class="{{ request()->is('ubahpassword') ? 'active' : '' }}">
        <i class="fas fa-key"></i> <span class="sidebar-text">Ubah Password</span>
    </a>

    <div>
        <br><br>
        <center>
            <p class="text-dark">Panev BiroCana Kejaksaan RI @2024</p>
        </center>
    </div>
</div>

<!-- Sidebar Toggler Button -->
<button class="btn btn-yellow toggler-btn" id="toggler-btn">
    <i class="fas fa-chevron-left"></i>
</button>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" id="navbar"
    style="background-color: #ffffff; border-bottom: 1px solid #e0e0e0;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link text-dark">
                        {{-- {{ $satkernama }} {{ $tahun }} --}}
                        
                        <form action="{{ route('pilih.tahun') }}" method="POST" id="tahunForm" class="d-flex align-items-center">
                            @csrf
                            <label for="tahun" class="me-2 mb-0">{{ $satkernama }} Tahun: </label>
                            
                            <select name="tahun" id="tahun" class="form-select w-auto" onchange="document.getElementById('tahunForm').submit();">
                                @for ($i = 2024; $i <= date('Y') + 5; $i++)
                                    <option value="{{ $i }}" {{ $i == $tahun ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </form>
                    </span>
                    
                </li>
                <li class="nav-item">
                    <span class="nav-link text-dark">
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </span>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function () {
    $('#toggle-submenu').on('click', function (e) {
        e.preventDefault(); // Mencegah link default action
        $('#submenu').toggleClass('open'); // Toggle kelas "open" untuk submenu
        $(this).find('.arrow-icon').toggleClass('fa-chevron-right fa-chevron-down'); // Ganti ikon
    });

    // Mencegah penutupan toggle jika submenu diklik
    $('#submenu a').on('click', function (e) {
        $('#submenu').addClass('open'); // Pastikan submenu tetap terbuka
    });
});

</script>

<style>
    .sidebar {
        background-color: #ffffff;
        /* Background putih */
        color: #343a40;
        /* Teks gelap */
        height: 100vh;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        /* Bayangan lembut */
        transition: width 0.3s ease;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 10px;
        color: #343a40;
        /* Teks gelap */
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .sidebar a:hover {
        background-color: #e2df8b;
        /* Warna lebih terang pada hover */
    }

    .sidebar a.active {
        background-color: #e6bf3e;
        /* Warna biru untuk aktif */
        color: #ffffff;
        /* Teks putih untuk aktif */
    }

    .submenu {
        transition: max-height 0.3s ease, opacity 0.3s ease;
        overflow: hidden;
        /* Mencegah overflow */
    }

    .submenu a {
        padding-left: 30px;
        background-color: #f8f9fa;
        /* Warna submenu */
    }

    .submenu a:hover {
        background-color: #e2df8b;
        /* Warna lebih terang saat hover pada submenu */
    }

    .arrow-icon {
        margin-left: auto;
        transition: transform 0.3s;
    }

    .arrow-icon.open {
        transform: rotate(90deg);
    }

    .collapsed {
        width: 80px;
        transition: width 0.3s ease;
    }

    .collapsed .sidebar-text {
        display: none;
    }

    .collapsed .submenu {
        display: none;
    }

    .collapsed .profile-pic {
        width: 50px;
        height: 50px;
    }

    .profile-pic {
        border-radius: 50%;
        /* Gambar profil bulat */
        margin-bottom: 15px;
    }
</style>
