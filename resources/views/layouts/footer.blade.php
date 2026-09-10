<footer class="footer py-3 text-center border-top">
    <div class="container-fluid px-3">
        <p class="mb-0 text-muted text-sm">
            <b>Panev BiroCana Kejaksaan RI</b> &copy; {{ date('Y') }}
        </p>
    </div>
</footer>

<!-- Bootstrap 5.3 Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth card fade-in animation
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('show');
            }, Math.min(index * 60, 400));
        });
    });
</script>