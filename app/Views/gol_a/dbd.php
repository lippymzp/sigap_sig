<?php $this->setVar('penyakit', 'dbd'); ?>
<?= $this->include('layout/header') ?>

<style>
/* ================= HERO SLIDER ================= */

.dbd-hero{
    position:relative;
    width:100%;
    height:100vh;
    overflow:hidden;
    border-radius:0 0 40px 40px;
}

/* TRACK SLIDER */
.hero-slider{
    display:flex;
    flex-wrap:nowrap;
    width:100%;
    height:100%;
    transition:transform 0.7s ease-in-out;
}

/* ITEM SLIDE */
.hero-slide{
    min-width:100%;
    width:100%;
    height:100vh;
    flex-shrink:0;
    position:relative;
    display:flex;
    align-items:center;
}

/* OVERLAY */
.overlay{
    position:absolute;
    inset:0;
    z-index:1;
}

/* CONTENT */
.hero-content{
    position:relative;
    z-index:2;
    color:#fff;
}

/* TEXT */
.hero-title{
    font-size:52px;
    font-weight:800;
    margin-bottom:15px;
    max-width:700px;
}

.hero-desc{
    font-size:18px;
    max-width:500px;
    line-height:1.7;
}

/* BUTTON */
.btn-hero{
    background:#1b9aaa;
    color:white;
    padding:14px 30px;
    border-radius:30px;
    margin-top:20px;
    display:inline-block;
    text-decoration:none;
    transition:0.3s;
    border:none;
}

.btn-hero:hover{
    background:#168aad;
    color:white;
}

/* BUTTON NAVIGATION */
.hero-btn{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background:rgba(0,0,0,0.45);
    color:white;
    border:none;
    width:50px;
    height:50px;
    border-radius:50%;
    font-size:30px;
    cursor:pointer;
    z-index:10;
    transition:0.3s;
}

.hero-btn:hover{
    background:#00BBC2;
}

.hero-btn.left{
    left:20px;
}

.hero-btn.right{
    right:20px;
}

/* MOBILE */
@media(max-width:768px){

    .dbd-hero{
        height:85vh;
    }

    .hero-slide{
        height:85vh;
        padding:0 20px;
    }

    .hero-title{
        font-size:34px;
    }

    .hero-desc{
        font-size:15px;
    }

    .hero-content{
        text-align:center;
    }

    .hero-btn{
        width:42px;
        height:42px;
        font-size:24px;
    }
}

/* --- STYLE MAP LABEL --- */
.label-desa{
    background: rgba(0,0,0,0.6);
    color: white;
    border: none;
    padding: 2px 6px;
    font-size: 11px;
    border-radius: 6px;
}

/* =================== MODAL DETAIL DESA =================== */
.custom-modal {
    display: none;
    position: fixed;
    z-index: 99999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    justify-content: center;
    align-items: center;
}

.custom-modal-content {
    background: #fff;
    width: 85%;
    max-width: 760px;
    border-radius: 20px;
    padding: 30px 35px;
    position: relative;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    max-height: 90vh;
    overflow-y: auto;
}

.close-modal {
    position: absolute;
    right: 25px;
    top: 12px;
    font-size: 30px;
    cursor: pointer;
    font-weight: bold;
    color: #444;
}

.close-modal:hover { color: #000; }

.modal-title {
    font-size: 20px;
    font-weight: 700;
    color: #222;
    margin-bottom: 18px;
}

.info-box {
    background: #f8f8f8;
    border-radius: 18px;
    padding: 25px 30px;
    border: 1px solid #e2e2e2;
}

.info-box h4 {
    font-size: 16px;
    margin: 0 0 14px 0;
    color: #222;
    font-weight: 700;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14.5px;
    color: #333;
}

.info-table tr td {
    padding: 6px 0;
    vertical-align: top;
    line-height: 1.6;
}

.info-table tr td.label {
    width: 45%;
    color: #2b2b2b;
}

.info-table tr td.colon {
    width: 18px;
    text-align: center;
    color: #555;
}

.info-table tr td.value {
    color: #111;
    font-weight: 500;
}

.info-table tr.sub td.label {
    padding-left: 28px;
    color: #444;
    font-weight: 400;
}

.kategori-tinggi { color: #dc3545; font-weight: 600; }
.kategori-sedang { color: #d39e00; font-weight: 600; }
.kategori-rendah { color: #28a745; font-weight: 600; }

/* =================== GRAFIK DBD & ABJ =================== */
.slide-toggle-container {
    position: relative;
    display: flex;
    background: #fff;
    border: 1px solid #00BBC2; 
    border-radius: 35px;
    width: 100%;
    max-width: 400px;
    height: 45px;
    overflow: hidden;
    margin: 0 auto;
}
.btn-toggle {
    flex: 1;
    z-index: 2;
    background: transparent;
    border: none;
    font-weight: 800;
    color: #00BBC2;
    cursor: pointer;
    transition: color 0.3s ease;
    font-size: 14px;
}
.btn-toggle.active {
    color: #fff;
}
.slide-indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 50%;
    height: 100%;
    background: #00BBC2;
    border-radius: 30px;
    z-index: 1;
    transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.filter-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
}
.filter-col {
    flex: 1;
    min-width: 140px;
    max-width: 180px;
    text-align: left;
}
.filter-label {
    font-weight: 900;
    color: #000;
    font-size: 14px;
    margin-bottom: 8px;
    display: block;
    margin-left: 5px;
}
.filter-rect {
    background: #ffffff;
    border-radius: 12px;
    padding: 6px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
    width: 100%;
}
.pill-select-wrapper {
    position: relative;
    width: 100%;
}
.pill-select {
    background-color: #00BBC2;
    color: white;
    border-radius: 6px;
    border: none;
    padding: 8px 30px 8px 12px;
    font-weight: bold;
    width: 100%;
    appearance: none;
    cursor: pointer;
    text-align: left;
    font-size: 13px;
}
.pill-select option {
    background: white;
    color: #333;
}
.arrow-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-size: 12px;
    pointer-events: none;
}
#chartWrapper canvas {
    width: 100% !important;
    height: 100% !important;
}
.slider-track {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px 0;
}
.slider-track::-webkit-scrollbar{
    display:none;
}
.video-slider-wrapper{
    position:relative;
    width:100%;
    padding:10px 40px;
}
.video-card-item{
    min-width:400px;
    max-width:400px;
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
    transition:0.3s;
    flex-shrink:0;
    position:relative;
}

.video-card-item:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}
.video-box{
    position:relative;
    width:100%;
    height:230px;
    overflow:hidden;
    background:#000;
}

.video-box video{
    width:100%;
    height:100%;
    object-fit:cover;
    pointer-events:none;
}
.video-content{
    padding:18px;
}

.video-content h5{
    font-size:17px;
    font-weight:700;
    margin-bottom:10px;
    color:#222;
    line-height:1.5;
}
.play-icon{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    width:70px;
    height:70px;
    background:rgba(0,0,0,0.6);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:28px;
    transition:0.3s;
}
.video-card-item:hover .play-icon{
    background:#00BBC2;
    transform:translate(-50%, -50%) scale(1.1);
}
.video-content p{
    font-size:14px;
    color:#666;
    line-height:1.7;
}
.lihat-btn{
    display:inline-block;
    padding:8px 14px;
    background:#00BBC2;
    color:#fff;
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    transition:0.3s;
}

.lihat-btn:hover{
    background:#009da3;
    color:#fff;
}
.slider-btn{
    position:absolute;
    top:45%;
    transform:translateY(-50%);
    width:42px;
    height:42px;
    border:none;
    border-radius:50%;
    background:#00BBC2;
    color:#fff;
    font-size:24px;
    cursor:pointer;
    z-index:10;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
    transition:0.3s;
}
.slider-btn:hover{
    background:#009da3;
}

.slider-btn.left{
    left:0;
}

.slider-btn.right{
    right:0;
}
@media(max-width:768px){

.video-card-item{
    min-width:280px;
    max-width:280px;
}

.video-box{
    height:170px;
}
.fitur-slider-wrapper{
    overflow-x:auto;
    padding:10px 0;
    gap:25px;
}

.fitur-slider{
    display:flex;
    flex-wrap:nowrap;
    gap:70px;
    width:max-content;
}

.fitur-box{
    display:flex;
    align-items:center;
    justify-content:center;
    min-width:220px;
    padding:18px;
    background:#fff;
    border-radius:16px;
    text-decoration:none;
    color:#222;
    font-weight:600;
    white-space:nowrap;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

.fitur-box:hover{
    transform:translateY(-3px);
    background:#00BBC2;
    color:#fff;
}
.hero-slider {
    height: 100%;
    position: relative;
    display: flex;
    align-items: center;
    color: white;
    transition: transform 0.6s ease-in-out;
    width: 100%;
}
.hero-slide{
    min-width: 100%;
    height: 100vh;
    flex-shrink: 0;
    position: relative;
}
.hero-slide.active{
    display: block;
}
.overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
}

.hero-content {
    position: relative;
    z-index: 2;
}

</style>

<section class="dbd-hero">

<?php $banners = $banner ?? []; ?>

<?php if(!empty($banners)) : ?>

<div class="hero-slider" id="heroSlider">

    <?php foreach($banners as $b) : ?>

    <div class="hero-slide"
        style="background:url('<?= base_url('uploads/banner/' . $b['gambar']) ?>') center/cover no-repeat;">

        <div class="overlay"></div>

        <div class="container hero-content">

            <h1 class="hero-title">
                <?= esc((string) ($b['judul_banner'] ?? '')) ?>
            </h1>

            <p class="hero-desc">
                <?= esc((string) ($b['deskripsi'] ?? '')) ?>
            </p>

            <a href="#funfact" class="btn-hero">
                Pelajari Selengkapnya
            </a>

        </div>

    </div>

    <?php endforeach; ?>

</div>

<button class="hero-btn left" onclick="moveSlide(-1)">‹</button>
<button class="hero-btn right" onclick="moveSlide(1)">›</button>

<?php endif; ?>

</section>

<section class="container text-center mt-5" data-aos="fade-up">
    <h4 class="fw-bold mb-4" style="color: var(--primary-teal);">Fitur Menarik yang Bisa Dimanfaatkan</h4>
    <div class="fitur-slider-wrapper">
            <a href="#grafik" class="fitur-box shadow-sm text-decoration-none">
                📊 Grafik Kesehatan</a>
            <a href="#map" class="fitur-box shadow-sm text-decoration-none">
                🗺️ Peta Persebaran</a>
            <a href="<?= base_url('skriningdbd') ?>" class="fitur-box shadow-sm text-decoration-none">
               🩺 Skrining Kesehatan</a>
            <a href="<?= base_url('berita/list_berita') ?>" class="fitur-box shadow-sm text-decoration-none">
                📄 Berita Kesehatan</a>
            <a href="<?= base_url('video/list_video') ?>" class="fitur-box shadow-sm text-decoration-none">
            <i class="fas fa-video me-2"></i> Video</a>
        </div>
</section>

<section id="funfact" class="container mt-5">

<div class="slider-wrapper">

    <button class="slider-btn left" onclick="slideFunfact(-1)">‹</button>

    <div id="funfactTrack" class="slider-track">

        <?php if(!empty($funfact)) : ?>

            <?php foreach($funfact as $f) : ?>

                <div class="slider-item">

                    <img src="<?= !empty($f['gambar_funfact'])
                        ? base_url('uploads/funfact/' . $f['gambar_funfact'])
                        : base_url('img/default.png') ?>">

                    <div>

                        <h5>
                            <?= esc((string) ($f['judul_funfact'] ?? '')) ?>
                        </h5>

                        <p>
                            <?= substr(strip_tags((string)($f['deskripsi_funfact'] ?? '')), 0, 70) ?>...
                        </p>

                        <a href="<?= base_url('berita/funfact_user/' . $f['id_funfact']) ?>"
                           class="text-decoration-none fw-bold"
                           style="color:#00BBC2; font-size:14px;">
                            Baca Selengkapnya →
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <p>Belum ada funfact.</p>

        <?php endif; ?>

    </div>

    <button class="slider-btn right" onclick="slideFunfact(1)">›</button>

</div>

</section>

<section class="container mt-5" data-aos="zoom-in">
    <div class="p-4 text-center shadow-sm cta-box">
        <h5 class="fw-bold">Mengalami Gejala?</h5>
        <p>
            Tubuhmu memberi sinyal, jangan diabaikan.<br>
            Yuk lakukan <span style="color:red;">skrining</span> sejak dini!
        </p>
        <a href="<?= base_url('skriningdbd') ?>" class="btn btn-success px-4 py-2 rounded-pill shadow">
            Mulai Skrining →
        </a>
    </div>
</section>

<section id="grafik" class="container mt-5 mb-5 p-0" data-aos="fade-up">
    <h4 id="titleGrafik" class="text-dark mb-4 fw-bold text-center">Grafik Kasus DBD</h4>
    <div class="bg-white shadow-sm" style="border-radius: 30px; border: 1px solid #eee; padding: 40px 30px;">
        
        <div class="d-flex justify-content-center mb-5">
            <div class="slide-toggle-container">
                <div id="slideIndicator" class="slide-indicator"></div>
                <button type="button" class="btn-toggle active" id="tabKasus" onclick="switchTab('kasus')">KASUS</button>
                <button type="button" class="btn-toggle" id="tabABJ" onclick="switchTab('abj')">ABJ</button>
            </div>
        </div>

        <form method="get" id="filterForm">
            <input type="hidden" name="tab" id="activeTabInput" value="<?= $_GET['tab'] ?? 'kasus' ?>">
            <input type="hidden" name="tahun_map" value="<?= $_GET['tahun_map'] ?? '' ?>">

            <div id="wrapperKasus" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'kasus' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="wilayah" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Antirogo" <?= ($_GET['wilayah'] ?? '') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                    <option value="Sumbersari" <?= ($_GET['wilayah'] ?? '') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                    <option value="Karangrejo" <?= ($_GET['wilayah'] ?? '') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                    <option value="Tegalgede" <?= ($_GET['wilayah'] ?? '') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                    <option value="Wirolegi" <?= ($_GET['wilayah'] ?? '') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">USIA</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="usia" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="anak" <?= ($_GET['usia'] ?? '') == 'anak' ? 'selected' : '' ?>>0-14</option>
                                    <option value="remaja" <?= ($_GET['usia'] ?? '') == 'remaja' ? 'selected' : '' ?>>15-24</option>
                                    <option value="dewasa" <?= ($_GET['usia'] ?? '') == 'dewasa' ? 'selected' : '' ?>>25-59</option>
                                    <option value="lansia" <?= ($_GET['usia'] ?? '') == 'lansia' ? 'selected' : '' ?>>60+</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">JENIS KELAMIN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="jk" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="L" <?= ($_GET['jk'] ?? '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= ($_GET['jk'] ?? '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">BULAN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="bulan" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php 
                                    $bulanList = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                                    foreach($bulanList as $k => $v): ?>
                                        <option value="<?= $k ?>" <?= ($_GET['bulan'] ?? '') == $k ? 'selected' : '' ?>><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="tahun" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                        <option value="<?= $t ?>" <?= ($_GET['tahun'] ?? '') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                    <?php endfor; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="wrapperABJ" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'abj' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="wilayah_abj" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Antirogo" <?= ($_GET['wilayah_abj'] ?? '') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                    <option value="Sumbersari" <?= ($_GET['wilayah_abj'] ?? '') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                    <option value="Karangrejo" <?= ($_GET['wilayah_abj'] ?? '') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                    <option value="Tegal Gede" <?= ($_GET['wilayah_abj'] ?? '') == 'Tegal Gede' ? 'selected' : '' ?>>Tegal Gede</option>
                                    <option value="Wirolegi" <?= ($_GET['wilayah_abj'] ?? '') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">BULAN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="bulan_abj" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php foreach($bulanList as $k => $v): ?>
                                        <option value="<?= $k ?>" <?= ($_GET['bulan_abj'] ?? '') == $k ? 'selected' : '' ?>><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="tahun_abj" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                        <option value="<?= $t ?>" <?= ($_GET['tahun_abj'] ?? '') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                    <?php endfor; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="chartWrapper" style="position: relative; height: 350px;">
                <canvas id="chartKasus" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'kasus' ? 'block' : 'none' ?>;"></canvas>
                <canvas id="chartABJ" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'abj' ? 'block' : 'none' ?>;"></canvas>
            </div>

        </form>
    </div>
</section>
<section class="container mt-5" data-aos="fade-up">
    <h4 class="text-teal mb-3 fw-bold text-center">Peta Persebaran Penyakit</h4>
    <div id="map" style="height:400px; border-radius:15px; z-index: 1;"></div>
    
    <div class="mt-3 d-flex gap-2 justify-content-center">
        <span class="badge bg-success">Rendah</span>
        <span class="badge bg-warning">Sedang</span>
        <span class="badge bg-danger">Tinggi</span>
    </div>
    
    <div id="detailModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-modal" onclick="closeDetailModal()">&times;</span>
            <div class="modal-title">
                Peta Sebaran Kasus <span id="modalTahun"><?= date('Y') ?></span>
            </div>
            <div class="info-box">
                <h4>Informasi :</h4>
                <table class="info-table">
                    <tr><td class="label">Nama Daerah</td><td class="colon">:</td><td class="value" id="modalNama">-</td></tr>
                    <tr><td class="label">Jumlah Penduduk</td><td class="colon">:</td><td class="value" id="modalPenduduk">-</td></tr>
                    <tr><td class="label">Jumlah Kasus</td><td class="colon">:</td><td class="value" id="modalKasus">-</td></tr>
                    <tr><td class="label">Kategori Kasus</td><td class="colon">:</td><td class="value" id="modalKategori">-</td></tr>
                    <tr><td class="label">Rentang usia</td><td class="colon">:</td><td class="value"></td></tr>
                    <tr class="sub"><td class="label">Anak-anak</td><td class="colon">:</td><td class="value" id="modalAnak">0</td></tr>
                    <tr class="sub"><td class="label">Dewasa</td><td class="colon">:</td><td class="value" id="modalDewasa">0</td></tr>
                    <tr class="sub"><td class="label">Lansia</td><td class="colon">:</td><td class="value" id="modalLansia">0</td></tr>
                    <tr><td class="label">Rentang usia dengan kasus tertinggi</td><td class="colon">:</td><td class="value" id="modalUsiaTertinggi">-</td></tr>
                    <tr><td class="label">Desa dengan kasus tertinggi</td><td class="colon">:</td><td class="value" id="modalDesaTertinggi">-</td></tr>
                    <tr><td class="label">Jenis kelamin terinfeksi</td><td class="colon">:</td><td class="value" id="modalJkTotal">0</td></tr>
                    <tr class="sub"><td class="label">Laki-laki</td><td class="colon">:</td><td class="value" id="modalLaki">0</td></tr>
                    <tr class="sub"><td class="label">Perempuan</td><td class="colon">:</td><td class="value" id="modalPerempuan">0</td></tr>
                    <tr><td class="label">Rumah Diperiksa</td><td class="colon">:</td><td class="value" id="modalRumahPeriksa">0</td></tr>
                    <tr><td class="label">Rumah Positive Jentik</td><td class="colon">:</td><td class="value" id="modalRumahJentik">0</td></tr>
                </table>
            </div>
        </div>
    </div>
</section>

<section id="video" class="container mt-5">

<div class="video-slider-wrapper">

    <button class="slider-btn left" onclick="slideVideo(-1)">‹</button>

    <div id="videoTrack" class="slider-track">

        <?php if(!empty($video)) : ?>

            <?php foreach($video as $v) : ?>

                <a href="<?= base_url('video/list_video/' . $v['id_video']) ?>" 
                   class="video-card-item text-decoration-none">

                    <div class="video-box">

                        <video muted>
                            <source src="<?= base_url('uploads/video/' . $v['file_video']) ?>" type="video/mp4">
                        </video>

                        <div class="play-icon">▶</div>

                    </div>

                    <div class="video-content">

                        <h5>
                            <?= esc((string) ($v['judul_video'] ?? '')) ?>
                        </h5>

                        <p>
                            <?= substr(strip_tags((string)($v['deskripsi_video'] ?? '')), 0, 70) ?>...
                        </p>

                    </div>

                </a>

            <?php endforeach; ?>

        <?php else : ?>

            <p>Belum ada video.</p>

        <?php endif; ?>

    </div>

    <button class="slider-btn right" onclick="slideVideo(1)">›</button>

</div>

</section>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<?php
/**
 * @var array $detailDesa
 * @var string $desaTertinggi
 * @var string $tahun_map
 * @var array $grafik
 * @var array $dataFinalABJ
 * @var string $tab_aktif
 */
?>
<script>
// 1. DATA DARI CONTROLLER
var dataFinalMap  = <?= json_encode($detailDesa) ?>; 
var desaTertinggi = "<?= $desaTertinggi ?>";
var tahunMap      = "<?= $tahun_map ?>";

// Data Grafik Kasus
var labelKasus = <?= json_encode(array_column($grafik, 'desa')) ?>;
var dataKasus  = <?= json_encode(array_column($grafik, 'kasus')) ?>;

// Data Grafik ABJ
var dataABJ = <?= json_encode($dataFinalABJ) ?>;

// 2. FUNGSI HELPER
function fixNama(nama) {
    return (nama || "").toLowerCase().trim().replace(/\s/g, "");
}

function showDetailPopup(key, namaAsli) {
    var d = dataFinalMap[key];
    if(!d) return alert("Data tidak tersedia.");

    document.getElementById('modalNama').innerText = d.nama;
    document.getElementById('modalPenduduk').innerText = d.jumlah_penduduk.toLocaleString();
    document.getElementById('modalKasus').innerText = d.jumlah_kasus;
    document.getElementById('modalKategori').innerText = d.kategori.toUpperCase();
    document.getElementById('modalAnak').innerText = d.anak;
    document.getElementById('modalDewasa').innerText = d.dewasa;
    document.getElementById('modalLansia').innerText = d.lansia;
    document.getElementById('modalUsiaTertinggi').innerText = d.usia_tertinggi;
    document.getElementById('modalDesaTertinggi').innerText = desaTertinggi;
    document.getElementById('modalLaki').innerText = d.laki;
    document.getElementById('modalPerempuan').innerText = d.perempuan;
    document.getElementById('modalJkTotal').innerText = (d.laki + d.perempuan);
    document.getElementById('modalTahun').innerText = tahunMap;
    document.getElementById('modalRumahPeriksa').innerText = d.rumah_periksa;
    document.getElementById('modalRumahJentik').innerText = d.rumah_jentik;
    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetailModal() {
    document.getElementById('detailModal').style.display = 'none';
}

// 3. INISIALISASI MAP & CHART
document.addEventListener("DOMContentLoaded", function() {
    // Map
    var map = L.map('map').setView([-8.184486, 113.668076], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    fetch("<?= base_url('assets/peta/db.geojson') ?>")
    .then(res => res.json())
    .then(data => {
        var geo = L.geoJSON(data, {
            style: function(feature) {
                var key = fixNama(feature.properties.NAMOBJ);
                var item = dataFinalMap[key];
                var warna = "#ffc107"; // Default Rendah (Kuning)
                if (item) {
                    if (item.kategori == "tinggi") warna = "#212529"; 
                    else if (item.kategori == "sedang") warna = "#dc3545";
                }
                return { color: "#00BBC2", weight: 1.5, fillColor: warna, fillOpacity: 0.6 };
            },
            onEachFeature: function(feature, layer) {
                var namaAsli = feature.properties.NAMOBJ;
                var key = fixNama(namaAsli);
                var item = dataFinalMap[key];
                var content = `<b>Kelurahan ${namaAsli}</b><br>`;
                if(item) {
                    content += `Kasus: ${item.jumlah_kasus}<br><button onclick="showDetailPopup('${key}','${namaAsli}')" style="background:#00BBC2; color:white; border:none; border-radius:4px; cursor:pointer;">Detail</button>`;
                } else { content += "Data Kosong"; }
                layer.bindPopup(content);
            }
        }).addTo(map);
        map.fitBounds(geo.getBounds());
    });

    // Chart Kasus
    new Chart(document.getElementById('chartKasus'), {
        type: 'bar',
        data: {
            labels: labelKasus,
            datasets: [{ label: 'Jumlah Kasus', data: dataKasus, backgroundColor: '#00BBC2', borderRadius: 10 }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Chart ABJ
    const colors = ['#00BBC2', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'];
    const datasetsABJ = Object.keys(dataABJ).map((kel, i) => ({
        label: kel,
        data: dataABJ[kel],
        borderColor: colors[i % colors.length],
        tension: 0.3
    }));

    new Chart(document.getElementById('chartABJ'), {
        type: 'line',
        data: { labels: ['M1', 'M2', 'M3', 'M4'], datasets: datasetsABJ },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Set awal tab
    switchTab("<?= $tab_aktif ?>");
});

function switchTab(type) {
    const isKasus = (type === 'kasus');
    document.getElementById('activeTabInput').value = type;
    document.getElementById('wrapperKasus').style.display = isKasus ? 'block' : 'none';
    document.getElementById('wrapperABJ').style.display = isKasus ? 'none' : 'block';
    document.getElementById('chartKasus').style.display = isKasus ? 'block' : 'none';
    document.getElementById('chartABJ').style.display = isKasus ? 'none' : 'block';
    
    document.getElementById('tabKasus').classList.toggle('active', isKasus);
    document.getElementById('tabABJ').classList.toggle('active', !isKasus);
    document.getElementById('slideIndicator').style.transform = isKasus ? 'translateX(0)' : 'translateX(100%)';
    document.getElementById('titleGrafik').innerText = isKasus ? 'Grafik Kasus DBD' : 'Grafik Angka Bebas Jentik (ABJ)';
}

let currentSlide = 0;
const slider = document.getElementById("heroSlider");
const slides = document.querySelectorAll(".hero-slide");

function moveSlide(direction){

    const total = slides.length;

    currentSlide += direction;

    if(currentSlide < 0){
        currentSlide = total - 1;
    }

    if(currentSlide >= total){
        currentSlide = 0;
    }

    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
}

/* AUTO SLIDE */
setInterval(() => {
    moveSlide(1);
}, 5000);

/* SWIPE MOBILE */
let startX = 0;

slider.addEventListener("touchstart", (e)=>{
    startX = e.touches[0].clientX;
});

slider.addEventListener("touchend", (e)=>{
    let endX = e.changedTouches[0].clientX;

    if(startX > endX + 50){
        moveSlide(1);
    }else if(startX < endX - 50){
        moveSlide(-1);
    }
});

function slideFunfact(direction){

document.getElementById('funfactTrack')
.scrollBy({
    left: direction * 350,
    behavior:'smooth'
});

}

function slideVideo(direction){

document.getElementById('videoTrack')
.scrollBy({
    left: direction * 350,
    behavior:'smooth'
});

}

</script>
<?= $this->include('layout/footer') ?>