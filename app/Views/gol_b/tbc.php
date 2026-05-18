<?php helper('text'); ?>
<?php $this->setVar('penyakit', 'tbc'); ?>
<?= $this->include('layout/header') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    html {
        scroll-behavior: smooth;
    }

    :root {
        --primary: #40EDD0;
        --dark: #00CED1;
        --medium: #48D1CC;

        --bg: #F4FEFD;
        --card: #E0F7F6;
        --accent: #2CCFC0;
        --border: #B8ECE8;

        --text-dark: #1F3A3A;
        --text-light: #6B8A8A;
    }

    /* GLOBAL */
    body {
        background: var(--bg);
        color: var(--text-dark);
        font-family: 'Poppins', sans-serif !important;

    }

   /* =========================================================
   HERO SECTION
========================================================= */

.tb-hero{
    position: relative;
    overflow: hidden;

    min-height: 760px;

    display: flex;
    align-items: center;

    background:
    linear-gradient(
        rgba(11, 170, 190, 0.45),
        rgba(11, 170, 190, 0.45)
    ),
    url('<?= base_url("img/tbc-bg.png") ?>');

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* OVERLAY BLUR */
.hero-overlay{
    position: absolute;
    inset: 0;

    background:
    radial-gradient(circle at top right,
    rgba(255,255,255,.35),
    transparent 30%);

    z-index: 1;
}

/* =========================================================
   CONTENT
========================================================= */

.hero-content-box{
    position: relative;
    z-index: 3;

    max-width: 720px;

    padding-top: 20px;
}

.hero-content-box h1{
    font-size: 45px;
    font-weight: 800;

    color: #fff;

    margin-bottom: 25px;

    text-shadow: 0 5px 18px rgba(0,0,0,.18);
}

.hero-sub{
    font-size: 30px;
    font-weight: 700;

    color: #fff;

    margin-bottom: 18px;

    text-shadow: 0 4px 10px rgba(0,0,0,.15);
}

.hero-desc{
    font-size: 20px;
    line-height: 2;

    color: rgba(255,255,255,.95);

    margin-bottom: 40px;

    text-shadow: 0 4px 10px rgba(0,0,0,.12);
}

/* =========================================================
   BUTTON
========================================================= */

.btn-hero{
    display: inline-flex;
    align-items: center;
    gap: 12px;

    background: linear-gradient(135deg,#1fd6df,#24b8e6);

    color: white !important;

    padding: 15px 28px;

    border-radius: 14px;

    font-size: 17px;
    font-weight: 700;

    text-decoration: none;

    box-shadow:
    0 10px 20px rgba(0,0,0,.15),
    inset 0 1px 0 rgba(255,255,255,.25);

    transition: .4s ease;
}

.btn-hero span{
    font-size: 24px;
    transition: .4s;
}

.btn-hero:hover{
    transform: translateY(-6px) scale(1.02);

    box-shadow:
    0 20px 35px rgba(0,0,0,.22),
    inset 0 1px 0 rgba(255,255,255,.3);
}

.btn-hero:hover span{
    transform: translateX(8px);
}

/* =========================================================
   WAVE
========================================================= */

.hero-wave{
    position: absolute;
    bottom: -2px;
    left: 0;

    width: 100%;
    z-index: 2;
}

.hero-wave svg{
    display: block;
    width: 100%;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:992px){

    .tb-hero{
        min-height: auto;
        padding: 130px 0 160px;
        text-align: center;
    }

    .hero-content-box{
        margin: auto;
    }

    .hero-content-box h1{
        font-size: 58px;
    }

    .hero-sub{
        font-size: 24px;
    }

    .hero-desc{
        font-size: 18px;
        line-height: 1.8;
    }

}

@media(max-width:576px){

    .hero-content-box h1{
        font-size: 44px;
    }

    .hero-sub{
        font-size: 20px;
    }

    .hero-desc{
        font-size: 16px;
    }

    .btn-hero{
        width: 100%;
        justify-content: center;

        font-size: 18px;
        padding: 18px 25px;
    }

}

/* =========================================================
   FITUR SECTION
========================================================= */

.fitur-section{
    padding: 80px 0 30px;
    background: #f7fbfb;
}

/* =========================================================
   TITLE
========================================================= */

.fitur-title{
    margin-bottom: 45px;
}

.fitur-title h2{
    font-size: 42px;
    font-weight: 800;

    color: #08b4c6;
}

/* =========================================================
   FITUR BOX
========================================================= */

.fitur-box{
    background: linear-gradient(
        135deg,
        #18c6d1,
        #73dbe4
    );

    border-radius: 14px;

    height: 92px;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;

    padding: 20px;

    color: white;

    font-size: 18px;
    font-weight: 600;

    box-shadow:
    0 8px 20px rgba(0,0,0,.08);

    transition: .35s ease;
}

/* HOVER */
.fitur-box:hover{
    transform: translateY(-6px);

    box-shadow:
    0 18px 30px rgba(0,0,0,.12);

    color: white;
}

/* ICON */
.fitur-icon{
    font-size: 24px;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:992px){

    .fitur-title h2{
        font-size: 34px;
    }

}

@media(max-width:576px){

    .fitur-title h2{
        font-size: 28px;
    }

    .fitur-box{
        font-size: 16px;
        height: auto;
        min-height: 85px;
    }

}

/* =========================================
    INSIGHT SECTION
========================================= */

.insight-section{
    padding:90px 0;
    background:
    linear-gradient(
        180deg,
        #f8ffff 0%,
        #ffffff 100%
    );
    overflow:hidden;
}

.insight-subtitle{
    color:#10B8C7;
    font-weight:700;
    font-size:18px;
}

.insight-title{
    font-size:42px;
    font-weight:800;
    color:#0D5C63;
    margin-top:10px;
}

.insight-desc{
    max-width:700px;
    margin:auto;
    color:#6b7280;
    margin-top:15px;
    line-height:1.8;
}

/* =========================================
    SLIDER
========================================= */

.insight-slider-wrapper{
    position:relative;
}

.insight-slider{
    display:flex;
    gap:25px;
    overflow:hidden;
    scroll-behavior:smooth;
}

/* =========================================
    CARD
========================================= */

.insight-card{
    min-width:100%;
    background:
    linear-gradient(
        135deg,
        #10B8C7 0%,
        #88DCE4 100%
    );

    border-radius:32px;
    padding:50px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:40px;

    position:relative;
    overflow:hidden;

    box-shadow:
    0 15px 40px rgba(0,0,0,0.08);

    transition:0.4s;
}

.insight-card:hover{
    transform:translateY(-8px);
}

.insight-card::before{
    content:'';
    position:absolute;
    width:300px;
    height:300px;
    background:rgba(255,255,255,0.08);
    border-radius:50%;
    top:-120px;
    right:-100px;
}

.insight-content{
    flex:1;
    z-index:2;
}

.insight-badge{
    display:inline-block;
    background:rgba(255,255,255,0.18);
    color:white;
    padding:8px 18px;
    border-radius:50px;
    font-size:14px;
    margin-bottom:20px;
    backdrop-filter:blur(10px);
}

.insight-content h3{
    color:white;
    font-size:40px;
    font-weight:800;
    line-height:1.4;
    margin-bottom:20px;
}

.insight-content p{
    color:rgba(255,255,255,0.95);
    font-size:17px;
    line-height:1.9;
    margin-bottom:25px;
    max-width:650px;
}

.insight-meta{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:30px;
}

.insight-meta span{
    color:white;
    font-size:14px;
}

.insight-meta i{
    margin-right:6px;
}

/* =========================================
    BUTTON
========================================= */

.btn-insight{
    display:inline-flex;
    align-items:center;
    gap:10px;
    background:white;
    color:#10B8C7;
    padding:14px 28px;
    border-radius:50px;
    text-decoration:none;
    font-weight:700;
    transition:0.3s;
}

.btn-insight:hover{
    background:#0D5C63;
    color:white;
    transform:translateX(5px);
}

/* =========================================
    IMAGE
========================================= */

.insight-image{
    width:420px;
    flex-shrink:0;
    z-index:2;
}

.insight-image img{
    width:100%;
    height:280px;
    object-fit:cover;
    border-radius:28px;

    box-shadow:
    0 10px 25px rgba(0,0,0,0.15);

    transition:0.4s;
}

.insight-card:hover img{
    transform:scale(1.03);
}

/* =========================================
    NAVIGATION
========================================= */

.insight-nav{
    position:absolute;
    top:50%;
    transform:translateY(-50%);

    width:62px;
    height:62px;

    border-radius:50%;
    border:4px solid rgba(255,255,255,0.95);

    background:linear-gradient(
        135deg,
        #16C2D5 0%,
        #0EA5B7 100%
    );

    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;
    cursor:pointer;

    z-index:20;

    box-shadow:
    0 10px 25px rgba(0,0,0,0.15);

    transition:all 0.35s ease;
}

.insight-nav:hover{
    transform:translateY(-50%) scale(1.1);

    background:linear-gradient(
        135deg,
        #0EA5B7 0%,
        #0B8FA0 100%
    );

    box-shadow:
    0 15px 35px rgba(0,0,0,0.22);
}

/* posisi kiri */
.prevBtn{
    left:-30px;
}

/* posisi kanan */
.nextBtn{
    right:-30px;
}

/* =========================================
    DOTS
========================================= */

.insight-dots{
    display:flex;
    justify-content:center;
    gap:10px;
    margin-top:30px;
}

.insight-dot{
    width:12px;
    height:12px;
    border-radius:50%;
    background:#cbd5e1;
    transition:0.3s;
}

.insight-dot.active{
    width:35px;
    border-radius:30px;
    background:#10B8C7;
}

/* =========================================
    RESPONSIVE
========================================= */

@media(max-width:992px){

    .insight-card{
        flex-direction:column;
        text-align:center;
        padding:35px;
    }

    .insight-content h3{
        font-size:28px;
    }

    .insight-image{
        width:100%;
    }

    .insight-nav{
        display:none;
    }
}


    /* CTA */
    .btn-teal {
        background: var(--dark);
        color: white;
        border-radius: 30px;
    }

    .btn-teal:hover {
        background: var(--accent);
    }

    .label-desa {
        background: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        padding: 2px 6px;
        font-size: 11px;
        border-radius: 6px;
    }

    .carousel-wrapper {
        position: relative;
        width: 100%;
        overflow: hidden;
        padding: 20px 0;
    }

    .scroll-container {
        display: flex;
        overflow: hidden;
        scroll-behavior: smooth;
    }

    .scroll-item {
        min-width: 100%;
        flex-shrink: 0;

        padding: 35px;
        border-radius: 24px;

        background: linear-gradient(135deg,
                #18d0d7,
                #09bcc5);

        color: white;
    }

    /* isi */
    .scroll-item .d-flex {
        gap: 40px;
    }

    .scroll-item img {
        width: 260px;
        height: 180px;
        object-fit: cover;
        border-radius: 18px;
    }

    /* tombol */
    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);

        width: 48px;
        height: 48px;

        border: none;
        border-radius: 50%;

        background: #10c7cf;
        color: white;

        font-size: 28px;
        z-index: 10;
    }

    .left {
        left: -10px;
    }

    .right {
        right: -10px;
    }

/* =========================================
    GEJALA SECTION
========================================= */

.gejala-section{
    padding:5px 0 55px;
    background:#f8ffff;
}

.gejala-box{
    background:linear-gradient(
        135deg,
        #D4F3F4 0%,
        #BFECEF 100%
    );

    border:2px solid #0DB5C1;

    border-radius:28px;

    padding:38px 50px;

    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:30px;

    transition:0.35s;
}

.gejala-box:hover{
    transform:translateY(-4px);

    box-shadow:
    0 12px 30px rgba(0,0,0,0.08);
}

/* =========================================
    CONTENT
========================================= */

.gejala-content h2{
    font-size:34px;
    font-weight:800;
    color:#08AFBC;
    margin-bottom:18px;
}

.gejala-content p{
    font-size:18px;
    color:#1496A0;
    line-height:1.9;
    max-width:690px;
    margin-bottom:0;
}

.gejala-content span{
    color:#ff2b2b;
    font-weight:800;
}

/* =========================================
    BUTTON
========================================= */

.gejala-btn{
    width:76px;
    height:76px;

    border-radius:50%;

    background:linear-gradient(
        135deg,
        #16C7D8 0%,
        #0EA8B8 100%
    );

    border:7px solid rgba(255,255,255,0.95);

    display:flex;
    align-items:center;
    justify-content:center;

    color:white;
    font-size:30px;
    font-weight:700;

    text-decoration:none;

    flex-shrink:0;

    transition:0.35s;

    box-shadow:
    0 10px 25px rgba(0,0,0,0.12);
}

.gejala-btn:hover{
    transform:scale(1.08);

    color:white;

    box-shadow:
    0 14px 35px rgba(0,0,0,0.18);
}

.gejala-btn i{
    transform:translateX(2px);
}

/* =========================================
    RESPONSIVE
========================================= */

@media(max-width:992px){

    .gejala-box{
        flex-direction:column;
        text-align:center;
        padding:30px;
    }

    .gejala-content h2{
        font-size:28px;
    }

    .gejala-content p{
        font-size:16px;
    }

    .gejala-btn{
        width:68px;
        height:68px;
        font-size:24px;
    }
}

/* =========================================
    SECTION GLOBAL
========================================= */

.grafik-section,
.peta-section{
    padding:80px 0;
    background:#DDF2F2;
}

.peta-section{
    padding-top:20px;
}

.section-header h2{
    font-size:58px;
    font-weight:800;
    color:#08AFBC;
    margin-bottom:10px;
}

.section-header p{
    color:#5f6b6b;
    font-size:18px;
}

/* =========================================
    CARD
========================================= */

.grafik-card,
.peta-card{
    background:white;

    border-radius:32px;

    min-height:520px;

    padding:40px;

    box-shadow:
    0 10px 35px rgba(0,0,0,0.05);
}

/* =========================================
    EMPTY STATE
========================================= */

.empty-box{
    width:100%;
    height:440px;

    border:3px dashed #B9DADA;
    border-radius:25px;

    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;

    text-align:center;
}

.empty-box i{
    font-size:70px;
    color:#0DB5C1;
    margin-bottom:25px;
}

.empty-box h4{
    font-size:30px;
    font-weight:700;
    color:#10939D;
    margin-bottom:10px;
}

.empty-box p{
    color:#7d8b8b;
    font-size:17px;
}

/* =========================================
    RESPONSIVE
========================================= */

@media(max-width:992px){

    .gejala-box{
        flex-direction:column;
        text-align:center;
        padding:35px;
    }

    .gejala-content h2{
        font-size:38px;
    }

    .gejala-content p{
        font-size:18px;
    }

    .section-header h2{
        font-size:38px;
    }

    .grafik-card,
    .peta-card{
        min-height:380px;
    }

    .empty-box{
        height:300px;
    }
}

/* =========================================
    RINGKASAN SECTION
========================================= */

.ringkasan-section{
    padding:50px 0 90px;
    background:#f6f6f6;
}

/* =========================================
    CARD
========================================= */

.ringkasan-card{

    position:relative;

    background:linear-gradient(
        90deg,
        #C8EEF0 0%,
        #BFEAEC 45%,
        #D7F7F8 100%
    );

    border:2px solid #05B7C6;

    border-radius:26px;

    min-height:280px;

    padding:45px 48px;

    overflow:hidden;

    display:flex;
    align-items:center;
    justify-content:space-between;

    gap:30px;

    transition:0.35s ease;
}

.ringkasan-card:hover{
    transform:translateY(-4px);

    box-shadow:
    0 18px 40px rgba(0,0,0,0.08);
}

/* =========================================
    CONTENT
========================================= */

.ringkasan-content{
    position:relative;
    z-index:2;
    width:65%;
}

.ringkasan-content h2{

    color:#03AEBE;

    font-size:50px;
    font-weight:800;

    margin-bottom:28px;
}

.ringkasan-list{
    display:flex;
    flex-direction:column;
    gap:14px;
}

.ringkasan-list p{

    margin:0;

    color:#4C5557;

    font-size:18px;
    line-height:1.8;

    font-weight:500;
}

.ringkasan-list span{

    color:#FF0000;
    font-weight:800;
}

/* =========================================
    IMAGE
========================================= */

.ringkasan-image{

    position:absolute;

    right:20px;
    bottom:0;

    width:540px;

    opacity:0.8;

    pointer-events:none;
}

.ringkasan-image img{
    width:100%;
    object-fit:contain;
}

/* =========================================
    RESPONSIVE
========================================= */

@media(max-width:992px){

    .ringkasan-card{
        padding:35px 28px;
    }

    .ringkasan-content{
        width:100%;
    }

    .ringkasan-content h2{
        font-size:34px;
    }

    .ringkasan-list p{
        font-size:16px;
    }

    .ringkasan-image{
        display:none;
    }
}

</style>


<!-- =========================================================
    HERO SECTION
========================================================= -->

<section class="tb-hero">

    <!-- OVERLAY -->
    <div class="hero-overlay"></div>

    <div class="container">

        <div class="row align-items-center">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6">

                <div class="hero-content-box" data-aos="fade-right">

                    <h1>
                        Tuberkulosis
                    </h1>

                    <p class="hero-sub">
                        Tau ga sih, Apa Itu Tuberkulosis ?
                    </p>

                    <p class="hero-desc">
                        Tuberkulosis adalah suatu penyakit menular yang
                        disebabkan oleh kuman Mycobacterium tuberculosis.
                        Kuman Mycobacterium tuberculosis menular melalui
                        udara (airborne disease) dari penderita sakit
                        tuberkulosis ke orang lain disekitarnya.
                    </p>

                    <a href="<?= base_url('tbc-detail') ?>" class="btn btn-hero">
                        Pelajari selengkapnya
                        <span>→</span>
                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- CURVE -->
    <div class="hero-wave">
        <svg viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,224L80,229.3C160,235,320,245,480,240C640,235,800,213,960,197.3C1120,181,1280,171,1360,165.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
    </div>

</section>

<!-- =========================================================
    FITUR SECTION
========================================================= -->

<section class="fitur-section">

    <div class="container">

        <!-- TITLE -->
        <div class="fitur-title text-center" data-aos="fade-up">

            <h2>
                Fitur Menarik yang Bisa Dimanfaatkan
            </h2>

        </div>


        <!-- FITUR -->
        <div class="row justify-content-center g-4">

            <!-- ITEM -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">

                <a href="#grafik" class="fitur-box text-decoration-none">

                    <div class="fitur-icon">
                        📊
                    </div>

                    <span>
                        Grafik Kesehatan
                    </span>

                </a>

            </div>


            <!-- ITEM -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">

                <a href="#peta" class="fitur-box text-decoration-none">

                    <div class="fitur-icon">
                        🗺️
                    </div>

                    <span>
                        Peta Persebaran Penyakit
                    </span>

                </a>

            </div>


            <!-- ITEM -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">

                <a href="#artikel" class="fitur-box text-decoration-none">

                    <div class="fitur-icon">
                        📄
                    </div>

                    <span>
                        Artikel Kesehatan
                    </span>

                </a>

            </div>


            <!-- ITEM -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">

                <a href="skrining-tbc" class="fitur-box text-decoration-none">

                    <div class="fitur-icon">
                        🩺
                    </div>

                    <span>
                        Skrining Kesehatan
                    </span>

                </a>

            </div>

        </div>

    </div>

</section>

<!-- =========================================
    INSIGHT / ARTIKEL
========================================= -->

<?php
$funfacts = $funfact ?? [];
?>

<section id="artikel" class="insight-section" data-aos="fade-up">

    <div class="container">

        <div class="text-center mb-5">
            <span class="insight-subtitle">
                Insights
            </span>

            <h2 class="insight-title">
                Telusuri Informasi Berikut
            </h2>

            <p class="insight-desc">
                Dapatkan informasi kesehatan terpercaya, edukatif,
                dan mudah dipahami untuk meningkatkan kesadaran masyarakat.
            </p>
        </div>

        <div class="insight-slider-wrapper">

            <!-- BUTTON LEFT -->
            <button class="insight-nav prevBtn">
    ❮
</button>

            <!-- SLIDER -->
            <div class="insight-slider" id="insightSlider">

                <?php foreach($funfacts as $item): ?>

                <div class="insight-card">

                    <div class="insight-content">

    <h3>
        <?= esc($item['judul_funfact']) ?>
    </h3>

    <p class="insight-text">
        <?= character_limiter(strip_tags($item['deskripsi_funfact']), 170) ?>
    </p>

    <div class="insight-meta">

        <span>
            <i class="fas fa-calendar-alt"></i>
            <?= date('d F Y', strtotime($item['tanggal_funfact'])) ?>
        </span>

    </div>

    <a href="<?= base_url('tbc/detail-funfact/' . $item['id_funfact']) ?>" target="_blank" class="btn-insight">
        Klik Selengkapnya
        <span class="arrow-circle">
            <i class="fas fa-arrow-right"></i>
        </span>
    </a>

</div>

                    <div class="insight-image">
                        <img src="<?= base_url('img/' . $item['gambar_funfact']) ?>" alt="">
                    </div>

                </div>

                <?php endforeach; ?>

            </div>

            <!-- BUTTON RIGHT -->
            <button class="insight-nav nextBtn">
    ❯
</button>

        </div>

        <!-- DOTS -->
        <div class="insight-dots" id="insightDots"></div>

    </div>

</section>


<script>

const slider = document.getElementById('insightSlider');
const cards = document.querySelectorAll('.insight-card');
const dotsContainer = document.getElementById('insightDots');

let currentIndex = 0;

/* =========================================
    CREATE DOTS
========================================= */

cards.forEach((_, index)=>{

    const dot = document.createElement('div');
    dot.classList.add('insight-dot');

    if(index === 0){
        dot.classList.add('active');
    }

    dot.addEventListener('click', ()=>{

        currentIndex = index;
        updateSlider();

    });

    dotsContainer.appendChild(dot);

});

const dots = document.querySelectorAll('.insight-dot');

/* =========================================
    UPDATE SLIDER
========================================= */

function updateSlider(){

    slider.scrollTo({
        left: cards[currentIndex].offsetLeft,
        behavior:'smooth'
    });

    dots.forEach(dot=>dot.classList.remove('active'));
    dots[currentIndex].classList.add('active');

}

/* =========================================
    NEXT SLIDE
========================================= */

function nextSlide(){

    currentIndex++;

    if(currentIndex >= cards.length){
        currentIndex = 0;
    }

    updateSlider();

}

/* =========================================
    PREV SLIDE
========================================= */

function prevSlide(){

    currentIndex--;

    if(currentIndex < 0){
        currentIndex = cards.length - 1;
    }

    updateSlider();

}

/* =========================================
    BUTTON
========================================= */

document.querySelector('.nextBtn')
.addEventListener('click', nextSlide);

document.querySelector('.prevBtn')
.addEventListener('click', prevSlide);

/* =========================================
    AUTO SLIDE
========================================= */

setInterval(()=>{

    nextSlide();

}, 5000);

</script>

<section class="gejala-section" data-aos="fade-up">

    <div class="container">

        <div class="gejala-box">

            <div class="gejala-content">

                <h2>
                    Mengalami Gejala?
                </h2>

                <p>
                    Tubuhmu sedang memberi sinyal, jangan diabaikan.
                    Yuk, kenali gejala Tuberkulosis dan lakukan
                    <span>skrining</span>
                    sejak dini!
                </p>

            </div>

            <a href="#" class="gejala-btn">
                <i class="fas fa-arrow-right"></i>
            </a>

        </div>

    </div>

</section>



<!-- =========================================
    GRAFIK SECTION
========================================= -->

<section class="grafik-section">

    <div class="container">

        <div class="section-header mb-4">

            <h2>
                Grafik Tuberkulosis
            </h2>

        </div>

        <div class="grafik-card">

            <!-- KOSONG DULU -->
            <div class="empty-box">

                <i class="fas fa-chart-bar"></i>

                <h4>
                    Grafik Akan Ditampilkan Di Sini
                </h4>

                <p>
                    Data grafik sedang dipersiapkan.
                </p>

            </div>

        </div>

    </div>

</section>



<!-- =========================================
    PETA SECTION
========================================= -->

<section class="peta-section">

    <div class="container">

        <div class="section-header mb-4">

            <h2>
                Peta Sebaran Tuberkulosis
            </h2>

        </div>

        <div class="peta-card">

            <!-- KOSONG DULU -->
            <div class="empty-box">

                <i class="fas fa-map-marked-alt"></i>

                <h4>
                    Peta Akan Ditampilkan Di Sini
                </h4>

                <p>
                    Integrasi peta sedang dipersiapkan.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- =========================================
    RINGKASAN DATA
========================================= -->

<section class="ringkasan-section" data-aos="fade-up">

    <div class="container">

        <div class="ringkasan-card">

            <!-- CONTENT -->
            <div class="ringkasan-content">

                <h2>
                    Ringkasan Data
                </h2>

                <div class="ringkasan-list">

                    <p>
                        Kasus Tuberkulosis tertinggi terjadi di Desa
                        <span>Kebon Agung</span>
                        yang masuk kategori sangat tinggi dibanding wilayah lain
                    </p>

                    <p>
                        Terdapat
                        <span>2 desa</span>
                        dengan kasus di atas rata-rata
                    </p>

                    <p>
                        Rata-rata kasus pneumonia di tiap desa adalah
                        <span>90 kasus</span>
                    </p>

                    <p>
                        Rata-rata kasus pneumonia di kecamatan Kebon Agung adalah
                        <span>120 kasus</span>
                    </p>

                    <p>
                        Wilayah dengan kasus tinggi lainnya adalah
                        <span>Mangli</span>
                    </p>

                </div>

            </div>

            <!-- IMAGE -->
            <div class="ringkasan-image">

                <img src="<?= base_url('img/ilustrasi.png') ?>" alt="">

            </div>

        </div>

    </div>

</section>


<?= $this->include('layout/footer') ?>
