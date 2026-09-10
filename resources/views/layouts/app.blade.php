<!DOCTYPE html>
<html lang="id">
@include('layouts.head')

<body class="section-with-background d-flex flex-column min-vh-100">
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="three-lines-spinner">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>

    <!-- Sidebar & Top Navbar Component -->
    @include('layouts.sidebar')

    <!-- Main Content Yield Area -->
    <main class="main-body flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer Component -->
    @include('layouts.footer')

    <!-- Page Scripts Hook -->
    @stack('scripts')

    <script>
        window.addEventListener("load", function() {
            const overlay = document.getElementById("loadingOverlay");
            if (overlay) {
                overlay.style.opacity = '0';
                overlay.style.transition = 'opacity 0.25s ease';
                setTimeout(function() {
                    overlay.style.display = "none";
                }, 250);
            }
        });
    </script>
</body>
</html>
