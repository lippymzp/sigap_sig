<?= $this->include('layout/header') ?>
<div class="tentang-page">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
.tentang-page,
.tentang-page *{
    font-family:'Poppins', sans-serif !important;
}
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
    background: transparent;
    border-radius: 0;
    padding: 20px;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:320px;
    box-shadow: none;
}

.logo-box img{
    width:100%;
    max-width:320px;
    object-fit:contain;
    background: transparent;
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

.filosofi-card:hover{
    transform:translateY(-10px);
}



/* =========================================
   FILOSOFI LOGO FIGMA FIX
========================================= */

.section-title{
    text-align:center;
    color:#10C4C8;
    font-size:42px;
    font-weight:700;
    margin:70px 0 45px;
}
/* FILOSOFI FIGMA */
.filosofi-section{
    padding:40px 0 90px;
}

.section-title{
    text-align:center;
    color:#11C5C8;
    font-size:42px;
    font-weight:700;
    margin-bottom:55px;
}

.filosofi-card{
    background:#fff;
    border-radius:14px;
    padding:18px 20px;
    border-left:6px solid #14CACA;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
    min-height:160px;
}

.filosofi-header{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:14px;
}

.icon-box{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#EAF9F9;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.icon-box img{
    width:18px;
    height:18px;
}

.filosofi-card h4{
    font-size:16px;
    font-weight:700;
    color:#111;
    margin:0;
}

.filosofi-card p{
    font-size:13px;
    line-height:1.7;
    color:#333;
    margin:0;
}

/* CARD WARNA */
.warna-card{
    display:flex;
    align-items:flex-start;
    gap:16px;
    position:relative;
}

.warna-kiri{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#63D7E9;
    border:2px solid #1A98C9;
    flex-shrink:0;
}

.warna-kanan{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#0896C7;
    flex-shrink:0;
}

.warna-content{
    flex:1;
}

@media(max-width:991px){
    .warna-card{
        flex-direction:column;
    }

    .warna-kanan{
        display:none;
    }
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

                <img src="<?= base_url('img/sigap_logo.png') ?>" alt="Logo SIGAP">

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
<section class="filosofi-section">
<div class="container">

    <h2 class="section-title">Filosofi Logo</h2>

    <!-- ROW ATAS -->
    <div class="row g-4 mb-4">

        <div class="col-lg-4 col-md-6">
            <div class="filosofi-card">
                <div class="filosofi-header">
                    <div class="icon-box">
                        <img src="<?= base_url('img/perisai.png') ?>">
                    </div>
                    <h4>Bentuk Perisai</h4>
                </div>

                <p>
                    Melambangkan perlindungan SIGAP hadir untuk melindungi
                    dan menjaga kesehatan masyarakat
                </p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="filosofi-card">
                <div class="filosofi-header">
                    <div class="icon-box">
                        <img src="<?= base_url('img/pin.png') ?>">
                    </div>
                    <h4>Bentuk Pin Lokasi</h4>
                </div>

                <p>
                    Melambangkan ketepatan lokasi, SIGAP bekerja tepat
                    sasaran dalam memantau persebaran penyakit di kecamatan
                </p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="filosofi-card">
                <div class="filosofi-header">
                    <div class="icon-box">
                        <img src="<?= base_url('img/plus.png') ?>">
                    </div>
                    <h4>Simbol Plus (Kesehatan)</h4>
                </div>

                <p>
                    Melambangkan dunia kesehatan, SIGAP berfokus
                    pada penanganan dan pelayanan kesehatan
                </p>
            </div>
        </div>

    </div>

    <!-- ROW BAWAH -->
    <div class="row g-4">

        <div class="col-lg-4 col-md-6">
            <div class="filosofi-card">
                <div class="filosofi-header">
                    <div class="icon-box">
                        <img src="<?= base_url('img/melingkar.png') ?>">
                    </div>
                    <h4>Garis Melingkar</h4>
                </div>

                <p>
                    Melambangkan pemantauan yang terus berjalan,
                    SIGAP melakukan monitoring secara terus-menerus
                    (real-time) dan sigap
                </p>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="filosofi-card warna-card">

                <div class="warna-kiri"></div>

                <div class="warna-content">
                    <h4>Warna Biru Tosca Pada Logo SIGAP</h4>

                    <p>
                        Melambangkan perpaduan antara kepercayaan dan kesehatan.
                        Warna biru menunjukkan sistem yang stabil dan dapat diandalkan,
                        sedangkan sentuhan hijau mencerminkan kepedulian terhadap kesehatan.
                    </p>
                </div>

                <div class="warna-kanan"></div>

            </div>
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
</div>
<?= $this->include('layout/footer') ?>