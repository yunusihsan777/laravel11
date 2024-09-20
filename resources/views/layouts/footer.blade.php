
</html>


{{-- <footer>
    <center><p>Powered by Kejaksaan @2024</p></center>
</footer> --}}

<!-- Bootstrap JS and Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
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