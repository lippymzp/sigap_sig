<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

.footer{
    background:#22c1c9;
    color:#fff;
    padding:55px 0 20px;
    font-family:'Poppins', sans-serif;
}

.footer-container{
    width:90%;
    max-width:1200px;
    margin:auto;
}

.footer-content{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:40px;
    flex-wrap:wrap;
}

.footer-box{
    flex:1;
    min-width:250px;
}

/* logo */
.footer-brand{
    text-align:center;
}

.footer-logo{
    width:90px;
    margin-bottom:10px;
}

.footer-brand p{
    font-size:14px;
    line-height:1.7;
    margin:0;
}

/* judul */
.footer-title{
    font-weight:700;
    margin-bottom:8px;
}

/* teks kecil */
.footer-box p{
    font-size:14px;
}

/* icon jarak */
.footer-box i{
    margin-right:8px;
}

/* copyright */
.footer-bottom{
    text-align:center;
    margin-top:40px;
    font-size:14px;
    opacity:.9;
}

/* responsive */
@media(max-width:768px){
    .footer-content{
        flex-direction:column;
        text-align:center;
    }
}

</style>

<footer class="footer">

<div class="footer-container">

<div class="footer-content">

    <!-- BRAND -->
    <div class="footer-box footer-brand">
        <img src="<?= base_url('img/logo_denggis.png') ?>" class="footer-logo">
        <p>
            Dengue Geographic <br> Information System
        </p>
    </div>

    <!-- SOSIAL -->
    <div class="footer-box">
        <h6 class="footer-title">Media Sosial</h6>

        <p class="mb-0 small"><i class="fab fa-instagram"></i>Instagram</p>
        <p class="mb-0 small"><i class="fab fa-facebook"></i>Facebook</p>
        <p class="mb-0 small"><i class="fab fa-twitter"></i>Twitter</p>
    </div>

    <!-- KONTAK -->
    <div class="footer-box">
        <h6 class="footer-title">Informasi Kontak</h6>

        <p class="mb-0 small">📧 email@kampus.ac.id</p>
        <p class="mb-0 small">📧 email@puskesmas.ac.id</p>
        <p class="mb-0 small">📍 Jember, Jawa Timur</p>
        <p class="mb-0 small">📞 087851132933</p>
    </div>

</div>

<div class="footer-bottom">
    © 2026 SIGAP
</div>

</div>

</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){
    // Inisialisasi AOS
    AOS.init({
        duration: 1000,
        once: true
    });
});
</script>

</body>
</html>