
<footer class="footer-sigap mt-5">

<div class="container">

    <div class="row gy-3">

        <!-- LOGO & DESKRIPSI -->
        <div class="col-lg-6" data-aos="fade-up">

            <div class="footer-brand">

    <div class="footer-brand-top">

        <img src="<?= base_url('img/medixa.png') ?>" alt="SIGAP Logo" class="footer-logo">

        <?php if (!empty($show_footer_maskot)): ?>
           <img src="<?= base_url('img/' . ($footer_maskot ?? 'maskotdsing.png')) ?>"
     alt="Maskot AI"
     class="footer-maskot">
        <?php endif; ?>

    </div>

    <h3 class="footer-title">SIGAP</h3>

    <p class="footer-desc">
        Sistem Informasi, Geografis Analisis & Pemantauan
    </p>
  <div class="footer-links mt-2">
                <a href="#">Bantuan</a>
                <a href="#">Tentang Kami</a>
            </div>
</div>

            <div class="footer-links mt-2">
                <a href="#">Bantuan</a>
                <a href="#">Tentang Kami</a>
            </div>

        </div>

        <!-- SOSIAL -->
        <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="100">

            <h5 class="footer-heading">Media Sosial</h5>

            <div class="social-item">
                <i class="bi bi-instagram"></i>
                <span>sigap.co.id</span>
            </div>

        </div>

        <!-- KONTAK -->
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">

            <h5 class="footer-heading">Informasi Kontak</h5>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class="bi bi-envelope-fill"></i>
                </div>

                <div>
                    <h6>Email</h6>
                    <p>medixatechnology@gmail.com</p>
                </div>
            </div>

            <div class="contact-item mt-4">
                <div class="contact-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>

                <div>
                    <h6>Lokasi</h6>
                    <p>
                        Jl. Mastrip, Krajan Timur, Sumbersari,
                        Kec. Sumbersari, Kabupaten Jember,
                        Jawa Timur 68121
                    </p>
                </div>
            </div>

        </div>

    </div>

    <!-- GARIS -->
    <div class="footer-line"></div>

    <!-- COPYRIGHT -->
    <div class="footer-bottom">
        <p>Hak Cipta © 2026 SIGAP</p>
    </div>

</div>

</footer>

<style>

/* =========================================
   FOOTER SIGAP
========================================= */

.footer-sigap{
    background:#014F4F;
    padding:25px 0 15px;
    position:relative;
    overflow:hidden;
}
.footer-dashboard .footer-sigap{
    margin-left:260px;
    width:calc(100% - 260px);
    transition: all 0.3s ease;
}
/* SAAT SIDEBAR DITUTUP */
.wrapper.hide ~ .footer-dashboard .footer-sigap{
    margin-left:0;
    width:100%;
}
@media (max-width:768px){
    .footer-dashboard .footer-sigap{
        margin-left:0;
        width:100%;
    }
}
/* CONTAINER */
.footer-sigap .container{
    position:relative;
    z-index:2;
}

/* LOGO */
.footer-brand-top {
    display: flex;
    align-items: center;
    gap: 28px;
    margin-bottom: 28px;
}
.footer-brand {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.footer-logo {
    width: 140px;
    height: auto;
    object-fit: contain;
    display: block;
}

.footer-maskot {
    width: 95px;
    height: auto;
    object-fit: contain;
    display: block;
    filter: none;
    box-shadow: none;
    animation: none;
    transform: none;
}

/* TITLE */
.footer-title {
    color: #fff;
    font-weight: 700;
    font-size: 3.2rem;
    margin-bottom: 14px;
    line-height: 1;
}

/* DESC */
.footer-desc {
    color: #E8FFFF;
    font-size: 1.2rem;
    line-height: 1.8;
    max-width: 520px;
    margin-bottom: 28px;
}

/* HEADING */
.footer-heading{
    color:#fff;
    font-size:1.4rem;
    font-weight:700;
    margin-bottom:25px;
}

/* LINKS */
.footer-links {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.footer-links a {
    color: #fff;
    text-decoration: underline;
    font-size: 1.3rem;
    font-weight: 600;
    transition: 0.3s;
    width: fit-content;
}

.footer-links a:hover{
    color:#40EDD0;
    transform:translateX(5px);
}

/* SOCIAL */
.social-item{
    display:flex;
    align-items:center;
    gap:12px;
    color:#fff;
    font-size:1.1rem;
}

.social-item i{
    font-size:1.3rem;
}

/* CONTACT */
.contact-item{
    display:flex;
    gap:18px;
    align-items:flex-start;
}

/* ICON */
.contact-icon{
    width:55px;
    height:55px;
    background:#E8FFFF;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.contact-icon i{
    color:#014F4F;
    font-size:1.3rem;
}

/* CONTACT TEXT */
.contact-item h6{
    color:#fff;
    font-weight:700;
    margin-bottom:6px;
    font-size:1.1rem;
}

.contact-item p{
    color:#E8FFFF;
    line-height:1.7;
    margin:0;
    font-size:1rem;
}

/* LINE */
.footer-line{
    width:100%;
    height:1px;
    background:rgba(255,255,255,0.4);
    margin:30px 0 15px;
}

/* COPYRIGHT */
.footer-bottom{
    display:flex;
    justify-content:flex-end;
}

.footer-bottom p{
    color:#fff;
    margin:0;
    font-size:1rem;
}

/* RESPONSIVE */
@media(max-width:991px){

    .footer-bottom{
        justify-content:center;
        text-align:center;
    }

    .footer-logo{
        width:120px;
    }

}

@media(max-width:768px){

    .footer-sigap{
        padding:60px 0 25px;
    }

    .footer-title{
        font-size:1.7rem;
    }

    .footer-desc{
        font-size:1rem;
    }

    .footer-heading{
        margin-top:10px;
    }
.footer-brand-top{
    justify-content:center;
    flex-wrap:wrap;
    text-align:center;
}

.footer-maskot{
    width:90px;
}
}

</style>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- BOOTSTRAP ICON -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- LEAFLET -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    AOS.init({
        duration:1000,
        once:true
    });

});
</script>

</body>
</html>