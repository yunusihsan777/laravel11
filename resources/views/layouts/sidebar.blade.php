<!-- Sidebar -->
<div class="sidebar" id="sidebar"><br>
    @php
    $satkernama = session('satkernama', 'Nama Satker');
    $idSatker = session('id_satker', 'ID Satker');
    @endphp
    <img src="{{ asset('gambar/kejaksaan.png') }}" alt="Profile Picture" class="profile-pic">
    <h5 class="text-center text-black">Selamat Datang<br>{{ $satkernama }}<br>ID Satker: {{ $idSatker }}</h5>
    <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> <span class="sidebar-text">Beranda</span></a>
    <a href="#" id="toggle-submenu"><i class="fas fa-tasks"></i> <span class="sidebar-text">Tata Kelola AKIP</span>
        <i class="fas fa-chevron-right arrow-icon"></i>
    </a>
    <div class="submenu" id="submenu" style="display: none;">
        <a href="{{ route('keputusan') }}" class="{{ request()->is('keputusan') ? 'active' : '' }}"><i class="fas fa-users"></i> Kep Tim SAKIP</a>
        <a href="{{ route('perencanaan') }}" class="{{ request()->is('perencanaan') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Perencanaan</a>
        <a href="{{ route('pengukuran') }}" class="{{ request()->is('pengukuran') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Pengukuran</a>
        <a href="{{ route('pelaporan') }}" class="{{ request()->is('pelaporan') ? 'active' : '' }}"><i class="fas fa-file-upload"></i> Pelaporan</a>
        <a href="{{ route('evaluasi') }}" class="{{ request()->is('evaluasi') ? 'active' : '' }}"><i class="fas fa-clipboard-check"></i> Evaluasi</a>
    </div>
    <a href="{{ route('sakipwil') }}" class="{{ request()->is('sakipwil') ? 'active' : '' }}"><i class="fas fa-globe"></i> <span class="sidebar-text">SAKIP Wilayah</span></a>
    <a href="{{ route('sakipvalidasi') }}" class="{{ request()->is('sakipvalidasi') ? 'active' : '' }}"><i class="fas fa-check-circle"></i> <span class="sidebar-text">SAKIP Validasi</span></a>
    <a href="{{ route('kepatuhan') }}" class="{{ request()->is('kepatuhan') ? 'active' : '' }}"><i class="fas fa-shield-alt"></i> <span class="sidebar-text">Kepatuhan AKIP</span></a>
    <a href="{{ route('chatsupport') }}" class="{{ request()->is('chatsupport') ? 'active' : '' }}"><i class="fas fa-comments"></i> <span class="sidebar-text">Chat Support</span></a>
    <a href="#" class="{{ request()->is('pengumuman') ? 'active' : '' }}"><i class="fas fa-envelope"></i> <span class="sidebar-text">Pengumuman</span></a>
    <a href="#" class="{{ request()->is('sumber-aturan') ? 'active' : '' }}"><i class="fas fa-gavel"></i> <span class="sidebar-text">Sumber Aturan</span></a>
    <a href="#" class="{{ request()->is('sumber-literasi') ? 'active' : '' }}"><i class="fas fa-book"></i> <span class="sidebar-text">Sumber Literasi</span></a>
    <a href="#" class="{{ request()->is('faq') ? 'active' : '' }}"><i class="fas fa-question-circle"></i> <span class="sidebar-text">FAQ</span></a>
    <a href="#" class="{{ request()->is('ubah-password') ? 'active' : '' }}"><i class="fas fa-key"></i> <span class="sidebar-text">Ubah Password</span></a>
</div>

<!-- Sidebar Toggler Button -->
<button class="btn btn-primary toggler-btn" id="toggler-btn">
    <i class="fas fa-chevron-left"></i>
</button>


<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
    <div class="container-fluid">
        {{-- <span class="navbar-brand"><br><br>Halaman Saat Ini</span> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link">{{ $satkernama }}</span>
                </li>
                <li class="nav-item">
                    {{-- <a href="#" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i> Sign Out</a> --}}
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleSubmenu = document.getElementById('toggle-submenu');
        const submenu = document.getElementById('submenu');
        const arrowIcon = toggleSubmenu.querySelector('.arrow-icon');
        const togglerBtn = document.getElementById('toggler-btn');
        const sidebar = document.getElementById('sidebar');

        // Handle submenu toggle (open/close)
        toggleSubmenu.addEventListener('click', function (e) {
            e.preventDefault();
            // Toggle the submenu open/close regardless of whether an item is active
            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
                arrowIcon.classList.remove('open');
            } else {
                submenu.style.display = 'block';
                arrowIcon.classList.add('open');
            }
        });

        // Set active state for submenu based on current page and open submenu if any item is active
        const activeLink = document.querySelector('.sidebar a.active');
        if (activeLink && activeLink.closest('.submenu')) {
            submenu.style.display = 'block'; // Show submenu if a submenu item is active
            arrowIcon.classList.add('open');
        }

        // Handle sidebar toggler (collapse sidebar and close all submenus)
        togglerBtn.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            
            // Close all submenus when sidebar is collapsed
            if (sidebar.classList.contains('collapsed')) {
                submenu.style.display = 'none';
                arrowIcon.classList.remove('open');
            }
        });
    });
</script>


<style>
    .sidebar a.active {
        background-color: #f0bb49;
        color: rgb(0, 0, 0);
    }

    .sidebar a {
        text-decoration: none;
        color: black;
    }

    .sidebar a:hover {
        background-color: #f5f370;
    }

    .submenu a {
        padding-left: 30px;
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
</style>
