<footer class="footer">
<div class="container-fluid text-white py-4">

<div class="row text-center text-md-start">

    <!-- LOGO -->
    <div class="col-md-4 mb-3">
        <div class="text-center">
            <img src="<?= base_url('img/Logo_Sigap.png') ?>" style="max-width:55px;">
            <h6 class="fw-bold mt-2 mb-1">SIGAP</h6>
            <p class="small mb-0">
                Sistem Informasi Geografis Analisis & Pemantauan Penyakit
            </p>
        </div>
    </div>

    <!-- SOSIAL -->
    <div class="col-md-4 mb-3">
        <h6 class="fw-bold mb-2">Media Sosial</h6>
        <p class="mb-1 small"><i class="fab fa-instagram me-2"></i>Instagram</p>
        <p class="mb-1 small"><i class="fab fa-facebook me-2"></i>Facebook</p>
        <p class="mb-1 small"><i class="fab fa-twitter me-2"></i>Twitter</p>
    </div>

    <!-- KONTAK -->
    <div class="col-md-4 mb-3">
        <h6 class="fw-bold mb-2">Informasi Kontak</h6>
        <p class="mb-1 small">📧 email@kampus.ac.id</p>
        <p class="mb-1 small">📧 email@puskesmas.ac.id</p>
        <p class="mb-1 small">📍 Jember, Jawa Timur</p>
        <p class="mb-1 small">📞 087851132933</p>
    </div>

</div>

<hr style="opacity:0.3;">
<p class="text-center small mb-0">© 2026 SIGAP</p>

</div>
</footer>

<!-- ✅ SCRIPT WAJIB (JANGAN DIHAPUS) -->

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- CHART JS (buat grafik) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- LEAFLET (buat peta) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- AOS (animasi) -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){
    AOS.init({
        duration: 1000,
        once: true
    });
});
</script>

</body>
</html>