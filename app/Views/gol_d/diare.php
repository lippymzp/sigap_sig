<?php $this->setVar('penyakit', 'diare'); ?>
<?php 
$this->setVar('penyakit', 'diare');
$this->setVar('show_footer_maskot', true);
?>
<?= $this->include('layout/header') ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<div class="diare-page">
    
<style>
.diare-page,
.diare-page *{
    font-family:'Poppins', sans-serif !important;
}
:root{
    --primary:#40EDD0;
    --dark:#00CED1;
    --medium:#48D1CC;

    --bg:#F4FEFD;
    --card:#E0F7F6;
    --accent:#2CCFC0;
    --border:#B8ECE8;

    --text-dark:#1F3A3A;
    --text-light:#6B8A8A;
}

/* GLOBAL */
body{
    background:var(--bg);
    color:var(--text-dark);
}

/* HERO FIGMA STYLE */
.pneu-hero{
    background: linear-gradient(135deg, rgba(0,206,209,0.9), rgba(64,237,208,0.9)),
                url("<?= base_url('img/bg-hero.png') ?>");
    background-size: cover;
    background-position: center;
    padding:100px 0;
    border-radius:0 0 40px 40px;
}

.hero-content{
    border:2px solid rgba(255,255,255,0.6);
    padding:25px;
    border-radius:15px;
    backdrop-filter: blur(5px);
}

.hero-content h1{
    font-size:42px;
    font-weight:800;
}

.btn-light{
    border-radius:30px;
}

.fitur-box{
    background: var(--card);
    border-radius: 14px;
    font-weight: 600;
    color: var(--dark);
    transition: 0.3s;

    width: 100%;
    height: 86px;

    display: flex !important;
    align-items: center;
    justify-content: center;

    text-align: center;
    padding: 12px 16px;
    line-height: 1.4;

    box-shadow: 0 6px 18px rgba(0,0,0,0.08);

    text-decoration: none;
}

.fitur-box:hover{
    background:var(--accent);
    color:white;
    transform:translateY(-5px);
}

/* TITLE */
.text-teal{
    color:var(--dark);
}

.insight-premium{
    padding:70px 0;
}

.section-head{
    text-align:center;
    margin-bottom:45px;
}

.section-head span{
    color:#00c7d2;
    font-size:13px;
    font-weight:700;
    letter-spacing:2px;
}

.section-head h2{
    font-size:56px;
    font-weight:800;
    color:#20353d;
    margin-top:10px;
}

.section-head p{
    max-width:650px;
    margin:14px auto 0;
    color:#6f8188;
    font-size:17px;
    line-height:1.7;
}

.slider-shell{
    position:relative;
    max-width:1300px;
    margin:auto;
}

.premium-slider{
    display:flex;
    overflow:hidden;
    scroll-behavior:smooth;
}

.premium-slide{
    min-width:100%;
    padding:20px;
}

.premium-card{
    background:linear-gradient(135deg,#08cdd1,#05b3bf);
    border-radius:34px;

    min-height:420px;
    max-height:420px;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:45px 50px;
    overflow:hidden;
    box-shadow:0 25px 50px rgba(0,0,0,0.12);
}

.premium-left{
    width:48%;
    color:white;
    z-index:2;

    display:flex;
    flex-direction:column;
    justify-content:center;
}

.badge-artikel{
    display:inline-block;
    background:rgba(0,0,0,0.15);
    padding:12px 22px;
    border-radius:999px;
    font-size:14px;
    font-weight:700;
    margin-bottom:28px;
}

.premium-left h3{
    font-size:34px;
    font-weight:800;
    line-height:1.25;
    margin-bottom:18px;

    max-height:170px;
    overflow:hidden;
}

.premium-left p{
    font-size:16px;
    line-height:1.8;
    opacity:0.95;
    margin-bottom:20px;

    max-height:120px;
    overflow:hidden;
}

.meta-row{
    display:flex;
    gap:25px;
    margin-bottom:30px;
    font-size:15px;
}

.btn-premium{
    background:white;
    color:#00b8c3;
    text-decoration:none;
    padding:14px 28px;
    border-radius:16px;
    font-weight:800;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:220px;
}

.btn-premium:hover{
    transform:translateY(-3px);
    color:#00b8c3;
}

.premium-right{
    width:44%;
    height:100%;
    display:flex;
    justify-content:center;
    align-items:center;
}

.premium-right img{
    width:100%;
    max-width:420px;
    height:250px;
    object-fit:cover;
    border-radius:24px;
}

.slider-arrow{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:68px;
    height:68px;
    border:none;
    border-radius:50%;
    background:white;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    color:#00bfc8;
    font-size:22px;
    z-index:99;
}

.slider-arrow.left{
    left:-10px;
}

.slider-arrow.right{
    right:-10px;
}

.premium-dots{
    display:flex;
    justify-content:center;
    gap:12px;
    margin-top:25px;
}

.premium-dots span{
    width:12px;
    height:12px;
    border-radius:50%;
    background:#d5d5d5;
    cursor:pointer;
}

.premium-dots span.active{
    background:#00bfc8;
}

@media(max-width:768px){

    .premium-card{
        flex-direction:column-reverse;
        padding:30px;
        min-height:auto;
    }

    .premium-left,
    .premium-right{
        width:100%;
    }

    .premium-left h3{
        font-size:28px;
    }

    .premium-left p{
        font-size:15px;
    }

    .premium-right img{
        height:220px;
        margin-bottom:25px;
    }

    .section-head h2{
        font-size:34px;
    }

    .slider-arrow{
        display:none;
    }
}

/* CTA */
.btn-teal{
    background:var(--dark);
    color:white;
    border-radius:30px;
}

.btn-teal:hover{
    background:var(--accent);
}
/* ==================================
   AI BUTTON
================================== */

/* ======================================
   AI FLOATING MASCOT
====================================== */

/* ======================================
   DOXY FLOATING AI
====================================== */

/* ======================================
   DOXY FLOATING ASSISTANT
====================================== */
.ai-button{
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    cursor: pointer;

    display: flex;
    flex-direction: column;
    align-items: center;

    background: transparent;
    border: none;
    box-shadow: none;

    animation: floatDoxy 3s ease-in-out infinite;
    transition: 0.3s ease;
}

/* WRAPPER */
.ai-wrap{
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* MASKOT */
.ai-mascot{
    width: 120px;
    height: 120px;
    object-fit: contain;
    filter: drop-shadow(0 10px 20px rgba(143, 76, 255, 0.25));
    transition: 0.3s ease;
}

/* LABEL MENYATU */
.ai-label{
    position: absolute;
    top: -8px;
    left: 50%;
    transform: translateX(-50%);

    background: linear-gradient(135deg, #ff6fd8, #c44dff);
    color: white;

    padding: 6px 16px;
    border-radius: 999px;

    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 1px;
    white-space: nowrap;

    box-shadow:
        0 8px 20px rgba(196,77,255,0.35),
        inset 0 1px 0 rgba(255,255,255,0.4);

    border: 2px solid rgba(255,255,255,0.35);
}

/* HOVER */
.ai-button:hover .ai-mascot{
    transform: scale(1.08) rotate(3deg);
}

.ai-button:hover .ai-label{
    transform: translateX(-50%) scale(1.05);
}

/* FLOAT */
@keyframes floatDoxy{
    0%,100%{
        transform: translateY(0);
    }
    50%{
        transform: translateY(-10px);
    }
}

/* MOBILE */
@media(max-width:768px){
    .ai-mascot{
        width: 100px;
        height: 100px;
    }

    .ai-label{
        font-size: 12px;
        padding: 5px 13px;
        top: -6px;
    }

    .ai-button{
        bottom: 15px;
        right: 10px;
    }
}

/* ======================================
   AI FLOATING BUTTON
====================================== */


.ai-button:hover{

    transform: scale(1.1);

}

@keyframes pulseAI{

    0%{
        box-shadow: 0 0 0 0 rgba(64,237,208,0.5);
    }

    70%{
        box-shadow: 0 0 0 20px rgba(64,237,208,0);
    }

    100%{
        box-shadow: 0 0 0 0 rgba(64,237,208,0);
    }

}

/* ======================================
   CHAT BOX
====================================== */

.ai-chat-box{
    position: fixed;
    bottom: 130px;
    right: 30px;
    width: 380px;
    height: 570px;

    background: linear-gradient(
        180deg,
        #fff7ff 0%,
        #f8f2ff 35%,
        #f3f6ff 100%
    );

    border-radius: 28px;
    overflow: hidden;
    z-index: 9999;
    display: none;
    flex-direction: column;

    border: 2px solid rgba(255,255,255,0.7);

    box-shadow:
        0 25px 60px rgba(155, 81, 224, 0.25),
        0 10px 25px rgba(255, 105, 180, 0.18);

    animation: showChat 0.3s ease;
}

@keyframes showChat{

    from{
        opacity: 0;
        transform: translateY(30px);
    }

    to{
        opacity: 1;
        transform: translateY(0);
    }

}

/* HEADER */

.ai-header{
    background: linear-gradient(
        135deg,
        #ff6fd8 0%,
        #d946ef 35%,
        #8b5cf6 70%,
        #6366f1 100%
    );

    color: white;
    padding: 18px 20px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    box-shadow: 0 6px 20px rgba(168,85,247,0.25);
}

.ai-header b{

    font-size: 18px;

}

.ai-header small{

    opacity: 0.9;

}

.ai-header button{
    background: rgba(255,255,255,0.22);
    backdrop-filter: blur(8px);

    border: 1px solid rgba(255,255,255,0.25);

    width: 38px;
    height: 38px;
    border-radius: 50%;

    color: white;
    font-size: 16px;
    transition: 0.3s ease;
}

.ai-header button:hover{
    transform: rotate(90deg);
    background: rgba(255,255,255,0.35);
}

/* BODY */

.ai-body{
    flex: 1;
    padding: 20px;
    overflow-y: auto;

    background: linear-gradient(
        180deg,
        #fff8ff 0%,
        #f9f3ff 50%,
        #f3f8ff 100%
    );

    display: flex;
    flex-direction: column;
}

/* MESSAGE */

.bot-message,
.user-message{

    padding: 14px 18px;

    border-radius: 18px;

    margin-bottom: 15px;

    max-width: 80%;

    line-height: 1.7;

    font-size: 14px;

    animation: fadeChat 0.3s ease;

}

@keyframes fadeChat{

    from{
        opacity: 0;
        transform: translateY(10px);
    }

    to{
        opacity: 1;
        transform: translateY(0);
    }

}

/* BOT */

.bot-message{
    background: linear-gradient(
        135deg,
        #ffe8ff 0%,
        #f4d8ff 45%,
        #e4e7ff 100%
    );

    color: #4b2d73;

    padding: 15px 18px;
    border-radius: 22px;
    margin-bottom: 15px;
    max-width: 82%;
    line-height: 1.7;
    font-size: 14px;

    box-shadow:
        0 8px 20px rgba(196,77,255,0.08);

    align-self: flex-start;
}

/* USER */

.user-message{
    background: linear-gradient(
        135deg,
        #ff6fd8 0%,
        #c44dff 45%,
        #6366f1 100%
    );

    color: white;

    padding: 14px 18px;
    border-radius: 22px;
    margin-bottom: 15px;
    max-width: 82%;
    line-height: 1.7;
    font-size: 14px;

    box-shadow:
        0 10px 20px rgba(168,85,247,0.2);

    align-self: flex-end;
}

/* INPUT */

.ai-input{
    display: flex;
    padding: 15px;
    gap: 10px;

    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);

    border-top: 1px solid rgba(220,200,255,0.6);
}

.ai-input input{
    flex: 1;
    border: none;

    background: linear-gradient(
        135deg,
        #f7f1ff,
        #eef3ff
    );

    border-radius: 18px;
    padding: 14px 16px;
    outline: none;
    font-size: 14px;

    color: #4b2d73;
}

.ai-input button{
    border: none;

    background: linear-gradient(
        135deg,
        #ff6fd8,
        #c44dff,
        #6366f1
    );

    color: white;
    border-radius: 18px;
    padding: 0 22px;
    font-weight: 700;

    box-shadow: 0 10px 20px rgba(168,85,247,0.2);
}

/* TYPING */

.typing{
    display: flex;
    gap: 6px;
    padding: 12px 16px;

    background: linear-gradient(
        135deg,
        #ffe8ff,
        #eef2ff
    );

    border-radius: 18px;
    width: fit-content;
    margin-bottom: 15px;
}

.typing span{
    width: 8px;
    height: 8px;
    background: #c44dff;
    border-radius: 50%;
    animation: bounce 1.4s infinite;
}

.typing span:nth-child(2){

    animation-delay: 0.2s;

}

.typing span:nth-child(3){

    animation-delay: 0.4s;

}

@keyframes bounce{

    0%,80%,100%{
        transform: scale(0);
    }

    40%{
        transform: scale(1);
    }

}

/* MOBILE */

@media(max-width:768px){

    .ai-chat-box{

        width: 92%;

        right: 4%;

        height: 80vh;

    }
.ai-button{
    width: 80px;
    height: 80px;
    bottom: 20px;
    right: 20px;
}
.funfact-highlight{
    background:#f4fefd;
}

.funfact-card{
    background:white;
    border-radius:28px;
    padding:35px;
    box-shadow:0 15px 35px rgba(0,0,0,0.08);
}

.funfact-img{
    width:100%;
    height:320px;
    object-fit:cover;
    border-radius:20px;
}

.funfact-badge{
    display:inline-block;
    background:#e0f7f6;
    color:#00bfc8;
    padding:8px 18px;
    border-radius:30px;
    font-weight:700;
    margin-bottom:15px;
}

.funfact-card h2{
    font-size:34px;
    font-weight:800;
    color:#1f3a3a;
}

.funfact-card p{
    color:#6b8a8a;
    line-height:1.8;
    margin:20px 0;
}

.btn-funfact{
    background:#00c4c7;
    color:white;
    padding:14px 26px;
    border-radius:14px;
    font-weight:700;
    text-decoration:none;
}

.btn-funfact:hover{
    color:white;
    background:#00aeb0;
}
}
</style>

<!-- HERO (TIDAK DIHAPUS, HANYA DIPERBAIKI STYLE) -->
<section class="hero-figma text-white">
<div class="container">

<div class="hero-content-box" data-aos="fade-right">
    <h1>Diare</h1>

    <p class="mt-3">
        Tau ga sih, Apa itu Diare ? <br>
        Diare adalah infeksi pada sistem pencernaan akibat makanan/minuman tidak higienis.
    </p>

    <a href="<?= base_url('diare-detail') ?>" class="btn btn-hero mt-3">
        Pelajari selanjutnya →
    </a>
</div>

</div>

</section>
<section class="funfact-highlight py-5">
<div class="container">

    <?php if (!empty($funfact)): ?>
    <?php $f = $funfact[0]; ?>

    <div class="funfact-card row align-items-center">

        <div class="col-md-6">
            <img src="<?= base_url('uploads/funfact/' . $f['gambar_funfact']) ?>"
                 class="img-fluid funfact-img">
        </div>

        <div class="col-md-6">
            <span class="funfact-badge">FUNFACT DIARE</span>

            <h2><?= esc($f['judul_funfact']) ?></h2>

            <p>
                <?= word_limiter(strip_tags($f['deskripsi_funfact']), 30) ?>
            </p>

            <a href="<?= base_url('diare-detail') ?>" class="btn btn-funfact">
                Baca Selengkapnya →
            </a>
        </div>

    </div>

    <?php endif; ?>

</div>
</section>
<!-- FITUR -->
<section class="container text-center mt-5" data-aos="fade-up">

<h4 class="text-teal mb-4 fw-bold">Fitur Menarik yang Bisa Dimanfaatkan</h4>

<div class="row g-4 justify-content-center">

    <div class="col-lg col-md-4 col-6">
    <a href="#grafik" class="fitur-box shadow-sm">
        📊 Grafik Kesehatan
    </a>
</div>

    <div class="col-lg col-md-4 col-6">
    <a href="#peta" class="fitur-box shadow-sm">
        🗺️ Peta Persebaran
    </a>
</div>

    <div class="col-lg col-md-4 col-6">
    <a href="#artikel" class="fitur-box shadow-sm">
        📄 Artikel Kesehatan
    </a>
</div>

    <div class="col-lg col-md-4 col-6">
        <a href="<?= base_url('skrining-diare') ?>"
           class="fitur-box text-decoration-none shadow-sm d-block">
            🩺 Skrining Kesehatan
        </a>
    </div>

    <div class="col-lg col-md-4 col-6">
        <a href="<?= base_url('diare/kalkulator-air') ?>"
           class="fitur-box text-decoration-none shadow-sm d-block">
            💧 Kalkulator Air
        </a>
    </div>

</div>
</section>
<section id="artikel" class="container mt-5 insight-premium" data-aos="fade-up">

    <div class="section-head">
        <span>INSIGHTS</span>
        <h2>Telusuri Informasi Kesehatan</h2>
        <p>
            Artikel dan informasi terpercaya seputar diare untuk edukasi kesehatan masyarakat.
        </p>
    </div>

    <div class="slider-shell">

        <button class="slider-arrow left" onclick="slide(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>

        <div class="premium-slider" id="slider">

            <?php foreach($berita as $b): ?>
            <div class="premium-slide">

                <div class="premium-card">

                    <div class="premium-left">
                        <div class="badge-artikel">
                            ARTIKEL KESEHATAN
                        </div>

                        <h3><?= esc($b['judul_berita']) ?></h3>

                        <p>
                            <?= word_limiter(strip_tags($b['deskripsi_berita'] ?? ''), 18) ?>
                        </p>

                        <div class="meta-row">
                            <span>
                                <i class="fas fa-user"></i> dsync.id
                            </span>

                            <span>
                                <i class="far fa-calendar"></i>
                                <?= !empty($b['tanggal_berita']) 
    ? date('d M Y', strtotime($b['tanggal_berita'])) 
    : '-' ?>
                            </span>
                        </div>

                        <a href="<?= base_url('berita/' . $b['id_berita']) ?>" class="btn-premium">
    Selengkapnya →
</a>
                    </div>

                    <div class="premium-right">
                        <img src="<?= base_url('uploads/berita/' . $b['gambar_berita']) ?>">
                    </div>

                </div>

            </div>
            <?php endforeach; ?>

        </div>

        <button class="slider-arrow right" onclick="slide(1)">
            <i class="fas fa-chevron-right"></i>
        </button>

    </div>

    <div class="premium-dots" id="dots"></div>

</section>

<!-- CTA (TIDAK DIHAPUS) -->
<section class="container mt-5" data-aos="zoom-in">

<div class="p-4 text-center shadow-sm" style="border-radius:20px; border:2px solid var(--border); background:white;">

<h5 class="fw-bold">Mengalami Gejala?</h5>
<p>
Tubuhmu memberi sinyal, jangan diabaikan.<br>
Yuk lakukan <span style="color:red;">skrining</span> sejak dini!
</p>

<a href="<?= base_url('skrining-diare') ?>" class="btn btn-teal px-4 py-2 shadow">
    Mulai Skrining →
</a>

</div>

</section>

<!-- ================= KODE LAMA ANDA TIDAK DIUBAH ================= -->

<!-- GRAFIK -->
<section id="grafik" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3 fw-bold">Grafik Diare</h4>

<div class="row mb-3">

<div class="col-md-4">
    <select id="filterDesa" class="form-control shadow-sm">
        <option value="">Semua Desa</option>
    </select>
</div>

<div class="col-md-4">
    <select id="filterDiagnosis" class="form-control shadow-sm">
        <option value="">Semua Diagnosis</option>
    </select>
</div>

<div class="col-md-4">
    <select id="filterTahun" class="form-control shadow-sm">
        <option value="">Semua Tahun</option>
    </select>
</div>

</div>

<div class="row">

<div class="col-md-9">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<canvas id="chartDiare"></canvas>
</div>
</div>

<div class="col-md-3">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<h6>Keterangan Grafik</h6>
<p><span style="color:#8ecae6">■</span> Sembuh</p>
<p><span style="color:#219ebc">■</span> Pengobatan</p>
<p><span style="color:#90dbf4">■</span> Meninggal</p>
</div>
</div>

</div>
</section>

<!-- MAP -->
<section id="peta" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3 fw-bold">Peta Persebaran Penyakit</h4>

<div id="mapDiare" style="height:400px; border-radius:15px;"></div>

<div class="mt-3 d-flex gap-2">
<span class="badge bg-warning">Rendah</span>
<span class="badge bg-danger">Sedang</span>
<span class="badge bg-dark">Tinggi</span>
</div>

</section>

<!-- ================= SCRIPT ANDA FULL (TIDAK DISENTUH) ================= -->
<script>

/* 🔥 FIX UTAMA (TIDAK MENGUBAH KODE LAMA) */
function fixNama(nama){
    return (nama || "")
        .toLowerCase()
        .trim()
        .replace(/\s+/g, " ")
        .replace(/[^a-z0-9 ]/g, "");
}

var aliasDesa = {
    "kemuningsarilor": "kemuning sari lor"
};

console.log(<?= json_encode($diare ?? []) ?>);
var dataDiare = <?= json_encode($diare ?? []) ?>;
function populateFilters(){

    let desaSet = new Set();
    let diagnosisSet = new Set();
    let tahunSet = new Set();

    dataDiare.forEach(item => {
        desaSet.add(item.desa);
        diagnosisSet.add(item.diagnosis);

        let tahun = item.tanggal_kunjungan.substring(0,4);
        tahunSet.add(tahun);
    });

    desaSet.forEach(d => {
        filterDesa.innerHTML += `<option value="${d}">${d}</option>`;
    });

    diagnosisSet.forEach(d => {
        filterDiagnosis.innerHTML += `<option value="${d}">${d}</option>`;
    });

    tahunSet.forEach(t => {
        filterTahun.innerHTML += `<option value="${t}">${t}</option>`;
    });
}
function applyFilters(){

    let desa = document.getElementById('filterDesa').value;
    let diagnosis = document.getElementById('filterDiagnosis').value;
    let tahun = document.getElementById('filterTahun').value;

    let filtered = dataDiare.filter(item => {

        let cocokDesa =
            !desa || item.desa === desa;

        let cocokDiagnosis =
            !diagnosis || item.diagnosis === diagnosis;

        let cocokTahun =
            !tahun || item.tanggal_kunjungan.startsWith(tahun);

        return cocokDesa && cocokDiagnosis && cocokTahun;
    });

    buildMap(filtered);
    renderChart(filtered);
}

var dataFinal = {};

dataDiare.forEach(item => {

    var desa = fixNama(item.desa);

    if(aliasDesa[desa]){
        desa = aliasDesa[desa];
    }

    if(!dataFinal[desa]){
        dataFinal[desa] = {
            total: 0,
            jumlah: 0
        };
    }

   dataFinal[desa].total += 1;
    dataFinal[desa].jumlah++;
});

for(var key in dataFinal){
    var rata = dataFinal[key].total / dataFinal[key].jumlah;

    if(rata >= 20) dataFinal[key].kategori = "tinggi";
    else if(rata >= 10) dataFinal[key].kategori = "sedang";
    else dataFinal[key].kategori = "rendah";
}
// =========================
// RINGKASAN DINAMIS
// =========================
var desaTertinggi = '-';
var kasusTertinggi = 0;
var totalSemuaKasus = 0;
var jumlahDesa = 0;
var desaDiAtasRata = 0;

for(var key in dataFinal){
    totalSemuaKasus += dataFinal[key].total;
    jumlahDesa++;

    if(dataFinal[key].total > kasusTertinggi){
        kasusTertinggi = dataFinal[key].total;
        desaTertinggi = key;
    }
}

var rataKasus = jumlahDesa > 0
    ? Math.round(totalSemuaKasus / jumlahDesa)
    : 0;

for(var key in dataFinal){
    if(dataFinal[key].total > rataKasus){
        desaDiAtasRata++;
    }
}

</script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const filterDesa = document.getElementById('filterDesa');
    const filterDiagnosis = document.getElementById('filterDiagnosis');
    const filterTahun = document.getElementById('filterTahun');

    let chartDiare;
    let map = L.map('mapDiare').setView([-8.1,113.5], 12);
    let geoLayer;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
    .addTo(map);

    function populateFilters(){
        let desaSet = new Set();
        let diagnosisSet = new Set();
        let tahunSet = new Set();

        dataDiare.forEach(item => {
            desaSet.add(item.desa);
            diagnosisSet.add(item.diagnosis);

            let tahun = item.tanggal_kunjungan.substring(0,4);
            tahunSet.add(tahun);
        });

        desaSet.forEach(d => {
            filterDesa.innerHTML += `<option value="${d}">${d}</option>`;
        });

        diagnosisSet.forEach(d => {
            filterDiagnosis.innerHTML += `<option value="${d}">${d}</option>`;
        });

        tahunSet.forEach(t => {
            filterTahun.innerHTML += `<option value="${t}">${t}</option>`;
        });
    }

    function renderChart(filteredData){

        let bulanan = {};

        filteredData.forEach(item => {
            let bulan = new Date(item.tanggal_kunjungan)
                .toLocaleString('id-ID', { month: 'short' });

            if(!bulanan[bulan]){
                bulanan[bulan] = 0;
            }

            bulanan[bulan]++;
        });

        if(chartDiare){
            chartDiare.destroy();
        }

        chartDiare = new Chart(document.getElementById('chartDiare'), {
            type: 'bar',
            data: {
                labels: Object.keys(bulanan),
                datasets: [{
                    label: 'Kasus Diare',
                    data: Object.values(bulanan),
                    backgroundColor: '#219ebc'
                }]
            }
        });
    }

    function buildMap(filteredData){

        let finalData = {};

        filteredData.forEach(item => {

            let desa = fixNama(item.desa);

            if(aliasDesa[desa]){
                desa = aliasDesa[desa];
            }

            if(!finalData[desa]){
                finalData[desa] = 0;
            }

            finalData[desa]++;
        });

        if(geoLayer){
            map.removeLayer(geoLayer);
        }

        fetch("<?= base_url('assets/peta/panti_6_desa.geojson') ?>")
        .then(res => res.json())
        .then(data => {

            geoLayer = L.geoJSON(data, {

                style: function(feature){

                    let nama = fixNama(feature.properties.NAMOBJ);

                    if(aliasDesa[nama]){
                        nama = aliasDesa[nama];
                    }

                    let total = finalData[nama] || 0;

                    let warna = "#28a745";

                    if(total >= 20){
                        warna = "#dc3545";
                    } else if(total >= 10){
                        warna = "#ffc107";
                    }

                    return {
                        color:"#00CED1",
                        weight:2,
                        fillColor:warna,
                        fillOpacity:0.7
                    };
                },

                onEachFeature: function(feature, layer){

                    let nama = fixNama(feature.properties.NAMOBJ);

                    if(aliasDesa[nama]){
                        nama = aliasDesa[nama];
                    }

                    let total = finalData[nama] || 0;

                    layer.bindPopup(`
                        <b>${feature.properties.NAMOBJ}</b>
                        <br>Total Kasus: ${total}
                    `);
                }

            }).addTo(map);

            map.fitBounds(geoLayer.getBounds());
        });
    }

    function applyFilters(){

        let desa = filterDesa.value;
        let diagnosis = filterDiagnosis.value;
        let tahun = filterTahun.value;

        let filtered = dataDiare.filter(item => {

            let cocokDesa =
                !desa || item.desa === desa;

            let cocokDiagnosis =
                !diagnosis || item.diagnosis === diagnosis;

            let cocokTahun =
                !tahun || item.tanggal_kunjungan.startsWith(tahun);

            return cocokDesa && cocokDiagnosis && cocokTahun;
        });

        renderChart(filtered);
        buildMap(filtered);
    }

    filterDesa.addEventListener('change', applyFilters);
    filterDiagnosis.addEventListener('change', applyFilters);
    filterTahun.addEventListener('change', applyFilters);

    populateFilters();
    renderChart(dataDiare);
    buildMap(dataDiare);
});
</script>

<style>
.label-desa{
    background: rgba(0,0,0,0.6);
    color: white;
    border: none;
    padding: 2px 6px;
    font-size: 11px;
    border-radius: 6px;
}
</style>
<script>
function scrollInsight(direction){
    const el = document.getElementById('insightScroll');
    const width = el.clientWidth;

    el.scrollBy({
        left: direction * width,
        behavior: 'smooth'
    });
}
</script>
<script>
let index = 0;
const slider = document.getElementById('slider');
const total = slider.children.length;

/* buat dots */
const dotsContainer = document.getElementById('dots');
for(let i=0;i<total;i++){
    let dot = document.createElement('span');
    dot.onclick = () => goTo(i);
    dotsContainer.appendChild(dot);
}
updateDots();

function slide(dir){
    index += dir;
    if(index >= total) index = 0;
    if(index < 0) index = total - 1;
    updateSlide();
}

function goTo(i){
    index = i;
    updateSlide();
}

function updateSlide(){
    slider.scrollTo({
        left: index * slider.clientWidth,
        behavior:'smooth'
    });
    updateDots();
}

function updateDots(){
    const dots = document.querySelectorAll('#dots span');
    dots.forEach((d,i)=>{
        d.classList.toggle('active', i === index);
    });
}

/* auto slide */
setInterval(()=>{
    slide(1);
},4000);

/* swipe mobile */
let startX = 0;
slider.addEventListener("touchstart", e=>{
    startX = e.touches[0].clientX;
});
slider.addEventListener("touchend", e=>{
    let endX = e.changedTouches[0].clientX;
    if(startX - endX > 50) slide(1);
    if(endX - startX > 50) slide(-1);
});
</script>
<!-- RINGKASAN DATA -->
<section class="container mt-5">

<div class="ringkasan-box">

    <h4 class="fw-bold mb-3">Ringkasan Data</h4>

    <p id="ringkasan1">
        Memuat data...
    </p>

    <p id="ringkasan2">
        Memuat data...
    </p>

    <p id="ringkasan3">
        Memuat data...
    </p>

    <p id="ringkasan4">
        Memuat data...
    </p>

</div>

</section>
<!-- TOMBOL AI -->
<!-- TOMBOL AI -->
<div class="ai-button" onclick="toggleChat()">
    <div class="ai-wrap">
        <div class="ai-label">DOXY AI</div>
        <img src="<?= base_url('img/maskotdsing.png') ?>" alt="DOXY AI" class="ai-mascot">
    </div>
</div>
<!-- CHAT BOX -->
<div class="ai-chat-box" id="aiChatBox">

    <!-- HEADER -->
    <div class="ai-header">

        <div>
            <b>DOXY AI</b><br>
            <small>Asisten Diare</small>
        </div>

        <button onclick="toggleChat()">
            ✖
        </button>

    </div>

    <!-- ISI CHAT -->
    <div class="ai-body" id="aiBody">

        <div class="bot-message">
            Halo 👋<br>
            Saya DOXY AI.<br><br>

            Silakan tanyakan tentang:
            <br>• Penyakit Diare
            <br>• Gejala Diare
            <br>• Pencegahan Diare
        </div>

    </div>

    <!-- INPUT -->
    <div class="ai-input">

        <input 
            type="text"
            id="aiInput"
            placeholder="Tulis pertanyaan..."
        >

        <button onclick="sendMessage()">
            Kirim
        </button>

    </div>

</div>
<script>

/* KLIK TOMBOL 🤖 */
document.querySelector('.ai-button').onclick = toggleChat;

/* BUKA TUTUP CHAT */
function toggleChat(){

    let chat = document.getElementById('aiChatBox');

    if(chat.style.display == 'flex'){

        chat.style.display = 'none';

    }else{

        chat.style.display = 'flex';

    }

}

/* KLIK TOMBOL AI */
document.querySelector('.ai-button').onclick = toggleChat;

/* ENTER */
document.getElementById('aiInput').addEventListener('keypress', function(e){

    if(e.key === 'Enter'){

        sendMessage();

    }

});

async function sendMessage(){

    let input = document.getElementById('aiInput');

    let body = document.getElementById('aiBody');

    let text = input.value.trim();

    if(text == '') return;

    /*
    =====================================
    USER MESSAGE
    =====================================
    */

    body.innerHTML += `
        <div class="user-message">
            ${text}
        </div>
    `;

    input.value = '';

    body.scrollTop = body.scrollHeight;

    /*
    =====================================
    TYPING
    =====================================
    */

    body.innerHTML += `
        <div class="typing" id="typingAI">
            <span></span>
            <span></span>
            <span></span>
        </div>
    `;

    body.scrollTop = body.scrollHeight;

    try {

        /*
        =====================================
        FETCH API
        =====================================
        */

        const response = await fetch("<?= base_url('ai/chat') ?>", {

            method: 'POST',

            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },

            body: new URLSearchParams({
                message: text
            })

        });

        /*
        =====================================
        GET RESULT
        =====================================
        */

        const result = await response.text();

        console.log(result);

        const data = JSON.parse(result);

        /*
        =====================================
        REMOVE TYPING
        =====================================
        */

        document.getElementById('typingAI').remove();

        /*
        =====================================
        BOT MESSAGE
        =====================================
        */

        body.innerHTML += `
            <div class="bot-message">
                ${data.answer}
            </div>
        `;

        body.scrollTop = body.scrollHeight;

    } catch(error){

        document.getElementById('typingAI').remove();

        body.innerHTML += `
            <div class="bot-message">
                Error: ${error}
            </div>
        `;

    }

}

</script>

</div>
<section class="container mt-5" data-aos="fade-up">

    <h4 class="fw-bold text-center mb-4">
        Berita Kesehatan Diare
    </h4>

    <div class="row">
        <?php foreach($berita as $b): ?>
        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0 rounded-4 h-100">

                <img src="<?= base_url('uploads/berita/' . $b['gambar_berita']) ?>"
                     style="height:220px; object-fit:cover;"
                     class="card-img-top">

                <div class="card-body">

                    <h5><?= esc($b['judul_berita']) ?></h5>

                    <p>
                        <?= esc($b['deskripsi_berita']) ?>
                    </p>

                    <small class="text-muted">
                        <?= date('d M Y', strtotime($b['tanggal_berita'])) ?>
                    </small>

                </div>

            </div>

        </div>
        <?php endforeach; ?>
    </div>

</section>
<script>
setInterval(function() {
    fetch("<?= base_url('ping') ?>")
        .then(res => res.json())
        .then(data => console.log('DOXY keep alive:', data.status))
        .catch(err => console.log('Ping error:', err));
}, 300000);
</script>


<script>
document.addEventListener("DOMContentLoaded", function(){

    document.getElementById('ringkasan1').innerHTML =
        `Kasus diare tertinggi terjadi di Desa 
        <span class="highlight-red">${desaTertinggi}</span> 
        dengan total <b>${kasusTertinggi}</b> kasus`;

    document.getElementById('ringkasan2').innerHTML =
        `Terdapat <b>${desaDiAtasRata}</b> desa dengan kasus di atas rata-rata`;

    document.getElementById('ringkasan3').innerHTML =
        `Rata-rata kasus diare tiap desa adalah 
        <span class="highlight-red">${rataKasus} kasus</span>`;

    document.getElementById('ringkasan4').innerHTML =
        `Total seluruh kasus diare tercatat sebanyak 
        <span class="highlight-red">${totalSemuaKasus} kasus</span>`;
});
</script>

<?= $this->include('layout/footer') ?>