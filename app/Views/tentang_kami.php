<?= $this->include('layout/header') ?>

<style>

/* =========================================
   ROOT
========================================= */

:root{
    --primary:#12D6D2;
    --dark:#014F4F;
    --bg:#F4FDFC;
    --text:#1B1B1B;
}

/* =========================================
   BODY
========================================= */

body{
    background:var(--bg);
    font-family:'Poppins',sans-serif;
    overflow-x:hidden;
}

/* =========================================
   HERO
========================================= */

.about-hero{
    background:linear-gradient(135deg,#12D6D2,#55E6E2);
    padding:70px 0;
    text-align:center;
    color:white;
}

.breadcrumb-custom{
    font-size:14px;
    margin-bottom:10px;
    opacity:0.9;
}

.about-title{
    font-size:3rem;
    font-weight:700;
}

/* =========================================
   ABOUT SECTION
========================================= */

.about-section{
    padding:90px 0 50px;
}

.logo-box{
    background:#12D6D2;
    border-radius:25px;
    padding:50px;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:320px;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
}

.logo-box img{
    width:100%;
    max-width:250px;
    object-fit:contain;
}

.about-heading{
    color:var(--primary);
    font-size:3rem;
    font-weight:700;
    margin-bottom:20px;
}

.about-desc{
    color:#444;
    line-height:2;
    font-size:1.05rem;
}

.tagline{
    text-align:center;
    margin-top:70px;
}

.tagline h3{
    color:#00BBC2;
    font-weight:700;
    font-size:2rem;
}

/* =========================================
   FILOSOFI
========================================= */

.section-title{
    text-align:center;
    color:var(--primary);
    font-size:2.8rem;
    font-weight:700;
    margin:90px 0 60px;
}

.filosofi-card{
    background:white;
    border-radius:25px;
    padding:35px;
    height:100%;
    position:relative;
    overflow:hidden;
    transition:0.4s;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
}

.filosofi-card::before{
    content:'';
    position:absolute;
    left:0;
    top:0;
    width:8px;
    height:100%;
    background:var(--primary);
}

.filosofi-card:hover{
    transform:translateY(-10px);
}

.icon-box{
    width:55px;
    height:55px;
    background:rgba(18,214,210,0.12);
    border-radius:15px;
    display:flex;
    justify-content:center;
    align-items:center;
    margin-bottom:20px;
}

.icon-box i{
    color:var(--primary);
    font-size:22px;
}

.filosofi-card h4{
    font-size:1.3rem;
    font-weight:700;
    margin-bottom:15px;
    color:#222;
}

.filosofi-card p{
    color:#555;
    line-height:1.9;
}

/* =========================================
   VISI MISI
========================================= */

.visi-misi{
    padding:80px 0;
}

.vm-box{
    background:white;
    padding:40px;
    border-radius:25px;
    box-shadow:0 10px 35px rgba(0,0,0,0.06);
    height:100%;
}

.vm-box h3{
    color:var(--primary);
    font-weight:700;
    margin-bottom:25px;
}

.vm-box p,
.vm-box li{
    line-height:2;
    color:#444;
}

/* =========================================
   MASKOT
========================================= */

.maskot-section{
    padding:80px 0;
}

.maskot-box{
    background:white;
    border-radius:30px;
    padding:40px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
}

.maskot-box img{
    width:100%;
    max-width:800px;
}

.maskot-title{
    color:var(--primary);
    font-size:2.5rem;
    font-weight:700;
    margin-bottom:40px;
}

/* =========================================
   RESPONSIVE
========================================= */

@media(max-width:991px){

    .about-title{
        font-size:2.3rem;
    }

    .about-heading{
        font-size:2.2rem;
        margin-top:40px;
    }

    .section-title{
        font-size:2rem;
    }

}

</style>

<!-- HERO -->
<section class="about-hero">

<div class="container">

    <div class="breadcrumb-custom">
        Beranda &nbsp; > &nbsp; <b>Tentang Kami</b>
    </div>

    <h1 class="about-title">
        Tentang Kami
    </h1>

</div>

</section>

<!-- ABOUT -->
<section class="about-section">

<div class="container">

    <div class="row align-items-center g-5">

        <!-- LOGO -->
        <div class="col-lg-5" data-aos="fade-right">

            <div class="logo-box">

                <img src="<?= base_url('img/medixa.png') ?>" alt="Logo SIGAP">

            </div>

        </div>

        <!-- DESKRIPSI -->
        <div class="col-lg-7" data-aos="fade-left">

            <h2 class="about-heading">
                Apa itu SIGAP
            </h2>

            <p class="about-desc">
                SIGAP (Sistem Informasi Geografi Analisis dan Pemantauan) adalah 
                sistem berbasis geospasial untuk mengumpulkan, menganalisis, 
                dan memantau data kesehatan berdasarkan wilayah. Data ditampilkan 
                dalam bentuk peta dan grafik sehingga memudahkan melihat 
                persebaran penyakit, tren kasus, serta mendukung deteksi dini 
                KLB dan pengambilan keputusan yang cepat.
            </p>

        </div>

    </div>

    <!-- TAGLINE -->
    <div class="tagline" data-aos="zoom-in">

        <h3>
            “Pantau, Analisis, Lindungi”
        </h3>

    </div>

</div>

</section>

<!-- FILOSOFI -->
<section class="container">

<h2 class="section-title" data-aos="fade-up">
    Filosofi Logo
</h2>

<div class="row g-4">

    <!-- CARD 1 -->
    <div class="col-lg-4 col-md-6" data-aos="fade-up">

        <div class="filosofi-card">

            <div class="icon-box">
                <i class="bi bi-geo-alt-fill"></i>
            </div>

            <h4>Bentuk Pin Lokasi</h4>

            <p>
                Melambangkan ketepatan lokasi, SIGAP bekerja tepat sasaran
                dalam memantau persebaran penyakit di kecamatan.
            </p>

        </div>

    </div>

    <!-- CARD 2 -->
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">

        <div class="filosofi-card">

            <div class="icon-box">
                <i class="bi bi-shield-fill-check"></i>
            </div>

            <h4>Bentuk Perisai</h4>

            <p>
                Melambangkan perlindungan, SIGAP hadir untuk melindungi
                dan menjaga kesehatan masyarakat.
            </p>

        </div>

    </div>

    <!-- CARD 3 -->
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">

        <div class="filosofi-card">

            <div class="icon-box">
                <i class="bi bi-plus-circle-fill"></i>
            </div>

            <h4>Simbol Plus</h4>

            <p>
                Melambangkan dunia kesehatan, SIGAP berfokus pada
                penanganan dan pelayanan kesehatan.
            </p>

        </div>

    </div>

    <!-- CARD 4 -->
    <div class="col-lg-6 col-md-6" data-aos="fade-up">

        <div class="filosofi-card">

            <div class="icon-box">
                <i class="bi bi-arrow-repeat"></i>
            </div>

            <h4>Garis Melingkar</h4>

            <p>
                Melambangkan pemantauan yang terus berjalan secara
                real-time dan sigap terhadap kondisi kesehatan.
            </p>

        </div>

    </div>

    <!-- CARD 5 -->
    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">

        <div class="filosofi-card">

            <div class="icon-box">
                <i class="bi bi-palette-fill"></i>
            </div>

            <h4>Warna Biru Tosca</h4>

            <p>
                Perpaduan antara kepercayaan dan kesehatan. Biru
                menunjukkan sistem yang stabil dan dapat diandalkan,
                sedangkan hijau melambangkan kepedulian kesehatan.
            </p>

        </div>

    </div>

</div>

</section>

<!-- VISI MISI -->
<section class="visi-misi">

<div class="container">

    <h2 class="section-title" data-aos="fade-up">
        Visi & Misi
    </h2>

    <div class="row g-4">

        <!-- VISI -->
        <div class="col-lg-5" data-aos="fade-right">

            <div class="vm-box">

                <h3>Visi</h3>

                <p>
                    Menjadi perusahaan teknologi kesehatan terdepan dan terpercaya 
                    dalam pengembangan sistem surveilans dan analitik kesehatan 
                    berbasis sistem informasi geografis untuk mendukung pengendalian 
                    penyakit serta mewujudkan sistem kesehatan yang efektif dan terintegrasi.
                </p>

            </div>

        </div>

        <!-- MISI -->
        <div class="col-lg-7" data-aos="fade-left">

            <div class="vm-box">

                <h3>Misi</h3>

                <ol>

                    <li>
                        Mengimplementasikan sistem surveilans kesehatan berbasis SIG
                        yang akurat, real-time, dan terintegrasi.
                    </li>

                    <li>
                        Menyediakan layanan analitik dan visualisasi data kesehatan
                        yang komprehensif.
                    </li>

                    <li>
                        Mendukung deteksi dini dan pemantauan tren penyebaran penyakit.
                    </li>

                    <li>
                        Mengintegrasikan data kesehatan dari berbagai sumber
                        untuk meningkatkan efektivitas pengendalian penyakit.
                    </li>

                </ol>

            </div>

        </div>

    </div>

</div>

</section>

<!-- MASKOT -->
<section class="maskot-section">

<div class="container">

    <h2 class="section-title" data-aos="fade-up">
        Maskot Medixa Technology
    </h2>

    <div class="maskot-box" data-aos="zoom-in">

        <!-- GANTI DENGAN GAMBAR MASKOT -->
        <img src="<?= base_url('img/mascot.png') ?>" alt="Maskot">

    </div>

</div>

</section>

<?= $this->include('layout/footer') ?>