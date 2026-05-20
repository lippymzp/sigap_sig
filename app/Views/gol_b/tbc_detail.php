<?php $this->setVar('penyakit', 'tbc'); ?>
<?= $this->include('layout/header') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>

:root{
    --primary:#0d2b5c;
    --secondary:#0ea5e9;
    --soft:#ecfeff;
    --mint:#b8f3dc;
    --text:#334155;
    --white:#ffffff;
}

body{
    font-family:'Poppins',sans-serif !important;
    background:#f5fbff;
    overflow-x:hidden;
}

/* =========================================================
   HERO SECTION
========================================================= */

.hero-detail{
    position:relative;
    overflow:hidden;

    padding:70px 0 90px;

    background:
    linear-gradient(
        135deg,
        #e9fff7 0%,
        #dffcf5 35%,
        #d8f8ff 100%
    );
}

/* =========================================================
   BREADCRUMB
========================================================= */

.breadcrumb-modern{
    display:inline-flex;
    align-items:center;
    gap:12px;

    background:rgba(255,255,255,.35);
    backdrop-filter:blur(12px);

    padding:14px 22px;

    border:1px solid rgba(255,255,255,.4);
    border-radius:100px;

    margin-bottom:35px;

    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.breadcrumb-modern a{
    text-decoration:none;
    color:var(--primary);
    font-weight:600;
    transition:.3s;
}

.breadcrumb-modern a:hover{
    color:var(--secondary);
}

.breadcrumb-modern span{
    color:#64748b;
}

.breadcrumb-modern p{
    margin:0;
    font-weight:700;
    color:#111827;
}

/* =========================================================
   HERO CONTENT
========================================================= */

.hero-content-detail{
    position:relative;
    z-index:2;
    max-width:760px;
}

.hero-badge{
    display:inline-block;

    background:rgba(255,255,255,.45);

    color:var(--primary);
    font-weight:700;
    font-size:14px;

    padding:10px 18px;
    border-radius:999px;

    margin-bottom:25px;
}

.hero-content-detail h1{
    font-size:58px;
    font-weight:900;
    line-height:1.15;

    color:var(--primary);

    margin-bottom:25px;
}

.hero-content-detail p{
    font-size:17px;
    line-height:1.9;

    color:#334155;
}

/* =========================================================
   CONTENT CARD
========================================================= */

.detail-wrapper{
    margin-top:-40px;
    position:relative;
    z-index:10;
}

.detail-card{
    background:#fff;

    border-radius:35px;

    padding:50px;

    box-shadow:
    0 20px 60px rgba(15,23,42,.08),
    0 5px 20px rgba(15,23,42,.05);

    border:1px solid rgba(255,255,255,.5);
}

.detail-title{
    font-size:40px;
    font-weight:800;
    color:var(--primary);

    margin-bottom:25px;
}

.detail-card p{
    color:var(--text);
    line-height:2;
    font-size:16px;
}

/* =========================================================
   IMAGE
========================================================= */

.image-wrapper{
    position:relative;
    overflow:hidden;

    border-radius:28px;

    margin:40px 0;
}

.image-wrapper img{
    width:100%;
    max-height:420px;
    object-fit:cover;

    transition:1s;
}

.image-wrapper:hover img{
    transform:scale(1.05);
}

.image-wrapper::after{
    content:'';
    position:absolute;
    inset:0;

    background:linear-gradient(to top, rgba(0,0,0,.15), transparent);
}

/* =========================================================
   INFO BOX
========================================================= */

.info-box{
    background:linear-gradient(135deg,#f0fdff,#f8fffe);

    border:1px solid #dff7ff;

    border-radius:25px;

    padding:30px;

    margin-top:35px;
    margin-bottom:35px;

    transition:.4s;
}

.info-box:hover{
    transform:translateY(-6px);

    box-shadow:0 15px 35px rgba(14,165,233,.12);
}

.info-box h5{
    color:var(--primary);
    font-size:24px;
    font-weight:800;

    margin-bottom:20px;
}

.info-box ul{
    margin:0;
    padding-left:20px;
}

.info-box li{
    margin-bottom:14px;
    line-height:1.8;
    color:#475569;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    .hero-detail{
        padding:90px 20px 80px;
    }

    .hero-content-detail h1{
        font-size:38px;
    }

    .detail-card{
        padding:30px 22px;
        border-radius:25px;
    }

    .detail-title{
        font-size:30px;
    }

    .breadcrumb-modern{
        flex-wrap:wrap;
        border-radius:20px;
    }

}

</style>


<!-- =========================================================
    HERO
========================================================= -->

<section class="hero-detail">

    <div class="container">

        <!-- BREADCRUMB -->
        <div class="breadcrumb-modern" data-aos="fade-down">
            <a href="<?= base_url('/') ?>">Portal</a>
            <span>/</span>
            <a href="<?= base_url('/tbc') ?>">Tuberkulosis</a>
            <span>/</span>
            <p>Detail Penyakit</p>
        </div>

        <!-- HERO CONTENT -->
        <div class="hero-content-detail" data-aos="fade-up">

            <span class="hero-badge">
                INFORMASI KESEHATAN
            </span>

            <h1>
                Edukasi Tuberkulosis <br>
                Untuk Masyarakat
            </h1>

            <p>
                Pelajari penyebab, gejala, faktor risiko, hingga langkah
                pencegahan penyakit Tuberkulosis secara lengkap untuk meningkatkan
                kesadaran dan kualitas kesehatan masyarakat.
            </p>

        </div>

    </div>

</section>


<!-- =========================================================
    CONTENT
========================================================= -->

<section class="detail-wrapper pb-5">

    <div class="container">

        <div class="detail-card" data-aos="zoom-in">

            <h2 class="detail-title">
                Apa Itu Tuberkulosis?
            </h2>

            <p>
                Tuberkulosis atau TB adalah penyakit yang disebabkan oleh infeksi
                bakteri Mycobacterium tuberculosis. Bakteri tersebut dapat masuk ke
                dalam paru-paru dan mengakibatkan pengidapnya mengalami sesak napas
                disertai batuk kronis.
            </p>

            <!-- IMAGE -->
            <div class="image-wrapper" data-aos="fade-up">
                <img src="<?= base_url('img/tbc_detail.png') ?>" alt="Tuberkulosis">
            </div>

            <p>
                Walaupun TBC mudah menular dan menyebabkan kematian, namun penyakit ini
                dapat disembuhkan dengan meminum obat secara teratur sampai benar-benar
                dinyatakan sembuh oleh dokter sehingga bisa memutus rantai penularan.
            </p>


            <!-- PENYEBAB -->
            <div class="info-box" data-aos="fade-up">
                <h5>📝 Penyebab Tuberkulosis</h5>

                <ul>
                    <li>Bakteri Mycobacterium tuberculosis yang menyerang paru-paru.</li>
                    <li>Penularan melalui udara saat penderita batuk atau bersin.</li>
                    <li>Lingkungan dengan ventilasi buruk meningkatkan risiko penyebaran.</li>
                </ul>
            </div>


            <!-- FAKTOR RISIKO -->
            <div class="info-box" data-aos="fade-up" data-aos-delay="100">
                <h5>⚠️ Faktor Risiko</h5>

                <ul>
                    <li>Sistem imun lemah.</li>
                    <li>Kebiasaan merokok.</li>
                    <li>Tinggal serumah dengan penderita TBC.</li>
                    <li>Lingkungan padat dan kurang sehat.</li>
                </ul>
            </div>


            <!-- GEJALA -->
            <div class="info-box" data-aos="fade-up" data-aos-delay="150">
                <h5>🤒 Gejala Tuberkulosis</h5>

                <ul>
                    <li>Batuk lebih dari 2 minggu.</li>
                    <li>Batuk darah.</li>
                    <li>Demam berkepanjangan.</li>
                    <li>Berat badan turun drastis.</li>
                    <li>Berkeringat di malam hari.</li>
                </ul>
            </div>


            <!-- PENGOBATAN -->
            <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                <h5>💊 Pengobatan</h5>

                <ul>
                    <li>Konsumsi OAT secara rutin selama 6–9 bulan.</li>
                    <li>Pemeriksaan rutin ke fasilitas kesehatan.</li>
                    <li>Menjaga pola makan dan istirahat.</li>
                    <li>Menggunakan masker untuk mencegah penularan.</li>
                </ul>
            </div>


            <!-- PENCEGAHAN -->
            <div class="info-box" data-aos="fade-up" data-aos-delay="250">
                <h5>🛡️ Pencegahan</h5>

                <ul>
                    <li>Imunisasi BCG sejak dini.</li>
                    <li>Menerapkan pola hidup bersih dan sehat.</li>
                    <li>Menghindari kontak erat dengan penderita TBC.</li>
                    <li>Menjaga sirkulasi udara rumah tetap baik.</li>
                </ul>
            </div>

        </div>

    </div>

</section>


<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({
    duration:1000,
    once:true
});
</script>

<?= $this->include('layout/footer') ?>