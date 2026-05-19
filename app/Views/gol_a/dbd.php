<?php $this->setVar('penyakit', 'dbd'); ?>
<?= $this->include('layout/header_a') ?>

<style>
/* ================= HERO SLIDER ================= */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}
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
    .slider-item{
        min-width:100%;
        flex-direction:column;
        text-align:center;
        padding:24px;
    }

    .slider-item img{
        width:100%;
        height:220px;
    }

    .funfact-content h5{
        font-size:22px;
    }

    .funfact-content p{
        font-size:15px;
    }

    .slider-btn{
        width:48px;
        height:48px;
        font-size:28px;
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
    inset:0;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    justify-content: center;
    align-items: center;
    padding:20px;
    overflow-y:auto;
}

.custom-modal-content {
    background: #fff;
    width: 85%;
    max-width: 760px;
    border-radius: 24px;
    padding: 30px 35px;
    position: relative;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    max-height: 90vh;
    overflow-y: auto;
    margin:auto;
    animation:modalFade .25s ease;
}
@keyframes modalFade{
    from{
        opacity:0;
        transform:translateY(20px) scale(.96);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}

.close-modal {
    position: absolute;
    right: 25px;
    top:14px;
    font-size: 30px;
    cursor: pointer;
    font-weight: bold;
    color: #444;
    transition:.2s;
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

/* =================== MAP CARD STYLING =================== */
.section-card {
    background: #fff;
    border-radius: 30px;
    padding: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: 1px solid #eee;
}

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
    width: 33.33%;
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

/* =================== SLIDER & FUNFACT =================== */
.slider-wrapper{
    position:relative;
    display:flex;
    align-items:center;
    gap:20px;
}
.slider-track {
    display:flex;
    gap:24px;
    overflow:hidden;
    scroll-behavior:smooth;
    width:100%;
    padding:10px 5px;
}
.slider-track::-webkit-scrollbar{
    display:none;
}
.slider-item{
    min-width:420px;
    min-height:220px;
    background:#00BBC2;
    border-radius:24px;
    padding:22px;
    display:flex;
    gap:22px;
    align-items:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    transition:0.3s ease;
    border:1px solid rgba(0,187,194,0.12);
}
.slider-item:hover{
    transform:translateY(-5px);
    box-shadow:0 16px 35px rgba(0,187,194,0.16);
}

.slider-item img{
    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:18px;
    flex-shrink:0;
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
    .fitur-box{
        width:100%;
        min-height:120px;
        font-size:16px;
    }
    .fitur-box i{
        font-size:36px;
    }
}

.funfact-content{
    display:flex;
    flex-direction:column;
    justify-content:center;
}
.funfact-content h5{
    font-size:20px;
    font-weight:700;
    color:white;
    margin-bottom:12px;
    line-height:1.4;
}
.funfact-content p{
    font-size:14px;
    line-height:1.8;
    color:white;
    margin-bottom:16px;
}
.funfact-link{
    color:#fff;
    font-size:14px;
    font-weight:700;
    text-decoration:none;
    transition:0.25s ease;
}
.funfact-link:hover{
    color:#009ca3;
    letter-spacing:0.5px;
}
.slider-btn{
    width:58px;
    height:58px;
    border:none;
    border-radius:50%;
    background:#00BBC2;
    color:white;
    font-size:34px;
    font-weight:bold;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    box-shadow:0 8px 20px rgba(0,187,194,0.25);
    transition:0.25s ease;
}
.slider-btn:hover{
    transform:scale(1.08);
    background:#009ca3;
}
.video-box{
    height:170px;
}
.fitur-slider-wrapper{
    display:flex;
    justify-content:center;
    align-items:stretch;
    flex-wrap:nowrap;
    gap:18px;
    margin-top:20px;
    overflow-x:auto;
    padding-bottom:10px;
}
.fitur-slider-wrapper::-webkit-scrollbar{
    height:6px;
}
.fitur-slider-wrapper::-webkit-scrollbar-thumb{
    background:#00BBC2;
    border-radius:10px;
}
.fitur-slider{
    display:flex;
    flex-wrap:nowrap;
    gap:70px;
    width:max-content;
}
.fitur-box{
    flex:1;
    min-width:190px;
    max-width:220px;
    min-height:160px;
    padding:26px 18px;
    background:#00BBC2;
    border-radius:24px;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:16px;
    text-align:center;
    color:#fff;
    font-size:16px;
    font-weight:700;
    border:1px solid rgba(0,187,194,.15);
    transition:.3s ease;
}
.fitur-box i{
    font-size:42px;
    transition:.3s ease;
}
.fitur-box span{
    line-height:1.5;
}
.fitur-box:hover{
    transform:translateY(-6px);
    background:#fff;
    color:#00BBC2;
    box-shadow:0 15px 35px rgba(0,187,194,.25);
}
.fitur-box:hover i{
    transform:scale(1.1);
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
}
.hero-content {
    position: relative;
    z-index: 2;
}

/* CTA BOX */
.cta-box{
    background: #bfeff2;
    border-radius:24px;
    padding:38px 28px;
    text-align:center;
    position:relative;
    overflow:hidden;
    font-family:'Poppins',sans-serif;
    border: 2px solid #00BBC2;
    box-shadow: 0 8px 25px rgba(0,187,194,0.08);
    transition: all 0.35s ease;
}
.cta-box:hover{
    transform: translateY(-4px);
    background: #bfeff2;
    box-shadow: 0 14px 35px rgba(0,187,194,0.16);
    border-color: #00aeb5;
}
.cta-icon{
    width:72px;
    height:72px;
    margin:auto auto 18px;
    border-radius:50%;
    background:white;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}
.cta-icon i{
    font-size:30px;
    color:#00BBC2;
}
.cta-title{
    font-size:24px;
    font-weight:700;
    color:#00aeb5;
    margin-bottom:14px;
    line-height:1.4;
}
.cta-desc{
    max-width:700px;
    margin:auto auto 24px;
    font-size:16px;
    line-height:1.9;
    color:#2f6f73;
}
.cta-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:13px 26px;
    border-radius:50px;
    background:white;
    color:#00a3a9;
    text-decoration:none;
    font-size:15px;
    font-weight:700;
    transition:0.3s ease;
    box-shadow:0 8px 20px rgba(0,187,194,0.18);
}
.cta-btn:hover{
    transform:translateY(-3px);
    background:#00aab0;
    color:white;
}

.ringkasan-card{
    background: #d8f7f7;
    border: 2px solid #00BBC2;
    border-radius: 22px;
    padding: 35px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
    overflow: hidden;
}
.ringkasan-left{
    flex: 1;
}
.ringkasan-left h3{
    color: #00aeb5;
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 20px;
}
.ringkasan-left p{
    color: #4b4b4b;
    font-size: 17px;
    line-height: 1.9;
    margin-bottom: 10px;
}
.ringkasan-left span{
    color: #e53935;
    font-weight: 700;
}
.ringkasan-right img{
    width: 260px;
    max-width: 100%;
}

/* RESPONSIVE */
@media(max-width:768px){
    .fitur-slider-wrapper{ justify-content:flex-start; gap:14px; }
    .fitur-box{ min-width:180px; max-width:180px; min-height:140px; font-size:15px; }
    .fitur-box i{ font-size:34px; }
    .cta-box{ padding:30px 20px; }
    .cta-title{ font-size:22px; }
    .cta-desc{ font-size:14px; }
    .cta-btn{ width:100%; font-size:14px; padding:12px 20px; }
    .ringkasan-card{ flex-direction: column; text-align: left; padding: 25px; }
    .ringkasan-left h3{ font-size: 26px; }
    .ringkasan-left p{ font-size: 15px; }
    .ringkasan-right img{ width: 180px; }
}

/* ================= CHATBOT FAB & WINDOW ================= */
@keyframes floatBobbing { 0% { transform: translateY(0px); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0px); } }
@keyframes chatFadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

.chatbot-fab { position: fixed; bottom: 30px; right: 30px; z-index: 9999; cursor: pointer; background: transparent; border: none; box-shadow: none; padding: 0; }
.fab-content { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; animation: floatBobbing 3s ease-in-out infinite; filter: drop-shadow(0px 8px 10px rgba(0,0,0,0.25)); transition: transform 0.3s ease; }
.fab-logo { width: 85px; height: auto; object-fit: contain; margin-bottom: 8px; transition: none; }
.fab-text { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 15px; color: #00BBC2; text-transform: uppercase; letter-spacing: 1px; display: block; background: rgba(255,255,255,0.8); padding: 2px 8px; border-radius: 10px; }
.chatbot-fab:hover .fab-content { transform: scale(1.1); }

.chatbot-window { position: fixed; bottom: 130px; right: 30px; width: 350px; height: 480px; max-height: calc(100vh - 150px); background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); display: none; flex-direction: column; z-index: 9999; overflow: hidden; border: 1px solid #eee; font-family: 'Poppins', sans-serif; animation: chatFadeIn 0.3s ease; }
.chat-header { background: #00BBC2; color: white; padding: 18px 20px; font-weight: 700; font-size: 16px; display: flex; justify-content: space-between; align-items: center; }
.header-logo { width: 35px; height: 35px; object-fit: contain; background-color: white; border-radius: 50%; padding: 3px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
.close-chat { cursor: pointer; font-size: 22px; }
.chat-body { flex: 1; padding: 15px; overflow-y: auto; background: #f8f9fa; display: flex; flex-direction: column; gap: 12px; scroll-behavior: smooth; }
.chat-body::-webkit-scrollbar { width: 5px; }
.chat-body::-webkit-scrollbar-thumb { background: #00BBC2; border-radius: 10px; }
.chat-msg { max-width: 85%; padding: 12px 16px; border-radius: 15px; font-size: 14px; line-height: 1.6; word-wrap: break-word; white-space: pre-wrap; }
.msg-bot { background: #ffffff; color: #333; border: 1px solid #e0e0e0; align-self: flex-start; border-bottom-left-radius: 4px; }
.msg-user { background: #00BBC2; color: white; align-self: flex-end; border-bottom-right-radius: 4px; }
.chat-footer { padding: 12px 15px; background: white; border-top: 1px solid #eee; display: flex; gap: 10px; align-items: center; }
.chat-input { flex: 1; border: 1px solid #ddd; border-radius: 20px; padding: 10px 15px; outline: none; font-size: 14px; transition: 0.3s; }
.chat-input:focus { border-color: #00BBC2; }
.chat-send { background: #00BBC2; color: white; border: none; border-radius: 50%; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; font-size: 16px; }
.chat-send:hover { background: #009ca3; }

@media (max-width: 400px) {
    .chatbot-window { width: calc(100% - 40px); right: 20px; left: 20px; bottom: 130px; height: 400px; max-height: calc(100vh - 150px); }
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

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<section class="container text-center mt-5" data-aos="fade-up">

    <h4 class="fw-bold mb-4"
        style="color: var(--primary-teal);">
        Fitur Menarik yang Bisa Dimanfaatkan<br><br>
    </h4>

    <div class="fitur-slider-wrapper">
        <a href="#grafik" class="fitur-box shadow-sm text-decoration-none">
            <i class="fas fa-chart-line"></i><span>Grafik Kesehatan</span>
        </a>
        <a href="#map" class="fitur-box shadow-sm text-decoration-none">
            <i class="fas fa-map-location-dot"></i><span>Peta Persebaran</span>
        </a>
        <a href="<?= base_url('skriningdbd') ?>" class="fitur-box shadow-sm text-decoration-none">
            <i class="fas fa-stethoscope"></i><span>Skrining Lingkungan</span>
        </a>
        <a href="<?= base_url('berita/list_berita') ?>" class="fitur-box shadow-sm text-decoration-none">
            <i class="fas fa-newspaper"></i><span>Berita Kesehatan</span>
        </a>
        <a href="<?= base_url('video/list_video') ?>" class="fitur-box shadow-sm text-decoration-none">
            <i class="fas fa-circle-play"></i><span>Video Edukasi</span>
        </a>
    </div>

</section>

<section id="funfact" class="container mt-5">
    <div class="text-center mb-4">
        <span class="funfact-badge">Insight Kesehatan</span>
        <h4 class="fw-bold mb-4" style="color: var(--primary-teal);">
            Telusuri Informasi Berikut
        </h4>
    </div>

<div class="slider-wrapper">

    <button class="slider-btn left" onclick="slideFunfact(-1)">‹</button>

    <div id="funfactTrack" class="slider-track">

        <?php if(!empty($funfact)) : ?>
            <?php foreach($funfact as $f) : ?>
                <div class="slider-item">
                    <img src="<?= !empty($f['gambar_funfact'])
                        ? base_url('uploads/funfact/' . $f['gambar_funfact'])
                        : base_url('img/default.png') ?>">

                    <div class="funfact-content">
                        <h5><?= esc((string) ($f['judul_funfact'] ?? '')) ?></h5>
                        <p><?= substr(strip_tags((string)($f['deskripsi_funfact'] ?? '')), 0, 120) ?>...</p>
                        <a href="<?= base_url('berita/funfact_user/' . $f['id_funfact']) ?>" class="funfact-link">
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
    <div class="cta-box shadow-lg">
        <div class="cta-icon"><i class="fas fa-house-circle-check"></i></div>
        <h2 class="cta-title">Sudahkah Lingkungan Anda Aman dari Jentik Nyamuk?</h2>
        <p class="cta-desc">
            Lakukan skrining lingkungan secara mandiri untuk membantu
            mendeteksi potensi perkembangbiakan nyamuk DBD
            dan menjaga kesehatan keluarga sejak dini.
        </p>
        <a href="<?= base_url('skriningdbd') ?>" class="cta-btn">
            <i class="fas fa-stethoscope me-2"></i> Mulai Skrining Lingkungan
        </a>
    </div>
</section>

<section class="container mt-5 mb-5" data-aos="fade-up">
    <div class="section-card">
        <div class="section-block">
            <div class="section-header d-flex justify-content-between align-items-center flex-wrap mb-4">
                <div>
                    <h4 class="fw-bold mb-1" style="color: #222;">Peta Interaktif Penyebaran</h4>
                    <p class="sub text-muted" style="font-size: 14px; margin-bottom: 0;">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
                </div>
                <div class="filter mt-2 mt-md-0 d-flex align-items-center">
                <span class="me-2" style="color: #007680; font-size: 16px; font-weight: 500;">Periode:</span>
    <?php $tahunMap = $_GET['tahun_map'] ?? date('Y'); ?>
    <select id="periodeMap" class="form-select d-inline-block w-auto" style="border-radius: 20px; border: 1px solid #d1d5db; padding: 4px 32px 4px 16px; font-size: 15px; cursor: pointer; box-shadow: none; background-color: #fff;" onchange="updateMap()">
        <?php for($t = 2024; $t <= date('Y'); $t++): ?>
            <option value="<?= $t ?>" <?= ($t == $tahunMap ? 'selected' : '') ?>><?= $t ?></option>
        <?php endfor; ?>
    </select>
</div>
            </div>
            
            <div class="inner-card position-relative">
                <div id="map" style="height: 450px; border-radius: 20px; z-index: 1;"></div>
                
                <div id="detailModal" class="custom-modal">
                    <div class="custom-modal-content">
                        <span class="close-modal" onclick="closeDetailModal()">&times;</span>
                        <div class="modal-title">
                            Peta Sebaran Kasus <span id="modalTahun"><?= $tahunMap ?></span>
                        </div>
                        <div class="info-box">
                            <h4>Informasi :</h4>
                            <table class="info-table">
                                <tr><td class="label">Nama Daerah</td><td class="colon">:</td><td class="value" id="modalNama">-</td></tr>
                                <tr><td class="label">Jumlah Penduduk</td><td class="colon">:</td><td class="value" id="modalPenduduk">-</td></tr>
                                <tr><td class="label">Jumlah Kasus</td><td class="colon">:</td><td class="value" id="modalKasus">-</td></tr>
                                <tr class="sub"><td class="label">Sembuh</td><td class="colon">:</td><td class="value" id="modalSembuh">0</td></tr>
                                <tr class="sub"><td class="label">Meninggal</td><td class="colon">:</td><td class="value" id="modalMeninggal">0</td></tr>
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
                                <tr class="sub"><td class="label">ABJ</td><td class="colon">:</td><td class="value" id="modalAbj">0%</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="grafik" class="container mt-5 mb-5 p-0" data-aos="fade-up">
    <h4 id="titleGrafik" class="text-dark mb-4 fw-bold text-center">Grafik Kasus DBD</h4>
    <div class="bg-white shadow-sm" style="border-radius: 30px; border: 1px solid #eee; padding: 40px 30px;">
        
        <div class="d-flex justify-content-center mb-5">
            <div class="slide-toggle-container">
                <div id="slideIndicator" class="slide-indicator"></div>
                <button type="button" class="btn-toggle active" id="tabKasus" onclick="switchTab('kasus')">KASUS</button>
                <button type="button" class="btn-toggle" id="tabMortalitas" onclick="switchTab('mortalitas')">MORTALITAS</button>
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
                                    <option value="Antirogo" <?= request()->getGet('wilayah') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                    <option value="Sumbersari" <?= request()->getGet('wilayah') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                    <option value="Karangrejo" <?= request()->getGet('wilayah') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                    <option value="Tegalgede" <?= request()->getGet('wilayah') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                    <option value="Wirolegi" <?= request()->getGet('wilayah') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
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
                                    <option value="anak" <?= request()->getGet('usia') == 'anak' ? 'selected' : '' ?>>0-14</option>
                                    <option value="remaja" <?= request()->getGet('usia') == 'remaja' ? 'selected' : '' ?>>15-24</option>
                                    <option value="dewasa" <?= request()->getGet('usia') == 'dewasa' ? 'selected' : '' ?>>25-59</option>
                                    <option value="lansia" <?= request()->getGet('usia') == 'lansia' ? 'selected' : '' ?>>60+</option>
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
                                    <option value="L" <?= request()->getGet('jk') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= request()->getGet('jk') == 'P' ? 'selected' : '' ?>>Perempuan</option>
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
                                        <option value="<?= $k ?>" <?= request()->getGet('bulan') == $k ? 'selected' : '' ?>><?= $v ?></option>
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
                                        <option value="<?= $t ?>" <?= request()->getGet('tahun') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                    <?php endfor; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="wrapperMortalitas" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'mortalitas' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="wilayah_mort" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Antirogo" <?= request()->getGet('wilayah_mort') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                    <option value="Sumbersari" <?= request()->getGet('wilayah_mort') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                    <option value="Karangrejo" <?= request()->getGet('wilayah_mort') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                    <option value="Tegalgede" <?= request()->getGet('wilayah_mort') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                    <option value="Wirolegi" <?= request()->getGet('wilayah_mort') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">JENIS KELAMIN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="jk_mort" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="L" <?= request()->getGet('jk_mort') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= request()->getGet('jk_mort') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="tahun_mort" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                        <option value="<?= $t ?>" <?= request()->getGet('tahun_mort') == $t ? 'selected' : '' ?>><?= $t ?></option>
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
                                    <option value="Antirogo" <?= request()->getGet('wilayah_abj') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                    <option value="Sumbersari" <?= request()->getGet('wilayah_abj') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                    <option value="Karangrejo" <?= request()->getGet('wilayah_abj') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                    <option value="Tegalgede" <?= request()->getGet('wilayah_abj') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                    <option value="Wirolegi" <?= request()->getGet('wilayah_abj') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
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
                                        <option value="<?= $k ?>" <?= request()->getGet('bulan_abj') == $k ? 'selected' : '' ?>><?= $v ?></option>
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
                                        <option value="<?= $t ?>" <?= request()->getGet('tahun_abj') == $t ? 'selected' : '' ?>><?= $t ?></option>
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
                <canvas id="chartMortalitas" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'mortalitas' ? 'block' : 'none' ?>;"></canvas>
                <canvas id="chartABJ" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'abj' ? 'block' : 'none' ?>;"></canvas>
            </div>
        </form>
    </div>
</section>

<?php
    $db = \Config\Database::connect();
    // ================= DATA GRAFIK ABJ =================
    $builderABJ = $db->table('rekap_pelaporan_kader'); 
    $reqBulanABJ = $_GET['bulan_abj'] ?? '';
    $reqTahunABJ = $_GET['tahun_abj'] ?? '';
    $reqWilayahABJ = $_GET['wilayah_abj'] ?? '';
    $bulanMapArr = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];
    if (!empty($reqBulanABJ) && isset($bulanMapArr[$reqBulanABJ])) { $builderABJ->where('bulan', $bulanMapArr[$reqBulanABJ]); }
    if (!empty($reqTahunABJ)) { $builderABJ->like('periode_lengkap', $reqTahunABJ); }
    $builderABJ->select('id_kelurahan, minggu, AVG(abj) as avg_abj');
    $builderABJ->groupBy('id_kelurahan, minggu');
    $rawDB_ABJ = $builderABJ->get()->getResultArray();
    $kelMap = [1 => 'Sumbersari', 2 => 'Wirolegi', 3 => 'Antirogo', 4 => 'Tegalgede', 5 => 'Karangrejo'];
    $dataFinalABJ = [];
    foreach ($kelMap as $id => $nama) { $dataFinalABJ[$nama] = [null, null, null, null]; }
    foreach ($rawDB_ABJ as $row) {
        $namaKel = $kelMap[$row['id_kelurahan']] ?? '';
        if ($namaKel && preg_match('/(\d+)/', $row['minggu'], $matches)) {
            $idx = intval($matches[1]) - 1;
            if ($idx >= 0 && $idx <= 3) { $dataFinalABJ[$namaKel][$idx] = round($row['avg_abj'], 2); }
        }
    }
    if (!empty($reqWilayahABJ)) { foreach ($dataFinalABJ as $nama => $val) { if ($nama !== $reqWilayahABJ) unset($dataFinalABJ[$nama]); } }

    // ================= DATA GRAFIK MORTALITAS =================
    $builderMort = $db->table('pasien');
    $builderMort->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah');
    $builderMort->where('pasien.status_akhir', 'Meninggal');
    
    $reqWilayahMort = $_GET['wilayah_mort'] ?? '';
    $reqTahunMort = $_GET['tahun_mort'] ?? '';
    $reqJkMort = $_GET['jk_mort'] ?? '';

    if (!empty($reqTahunMort)) { 
        $builderMort->where('YEAR(pasien.tgl_kunjungan)', $reqTahunMort); 
    }
    if (!empty($reqJkMort)) { 
        $builderMort->where('pasien.jenis_kelamin', $reqJkMort == 'L' ? 'Laki-laki' : 'Perempuan'); 
    }
    
    $builderMort->select('wilayah.kelurahan, MONTH(pasien.tgl_kunjungan) as bulan, COUNT(pasien.id_pasien) as total_meninggal');
    $builderMort->groupBy('wilayah.kelurahan, MONTH(pasien.tgl_kunjungan)');
    $rawDB_Mort = $builderMort->get()->getResultArray();

    $kelMapMort = ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegalgede', 'Karangrejo'];
    $dataFinalMort = [];
    
    foreach ($kelMapMort as $nama) { 
        $dataFinalMort[$nama] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; 
    }

    foreach ($rawDB_Mort as $row) {
        $namaKel = ucwords(strtolower(trim($row['kelurahan'])));
        if ($namaKel == 'Tegal Gede') $namaKel = 'Tegalgede';

        if (in_array($namaKel, $kelMapMort)) {
            $blnIdx = intval($row['bulan']) - 1; 
            if ($blnIdx >= 0 && $blnIdx <= 11) { 
                $dataFinalMort[$namaKel][$blnIdx] = (int)$row['total_meninggal']; 
            }
        }
    }

    if (!empty($reqWilayahMort)) { 
        foreach ($dataFinalMort as $nama => $val) { 
            if ($nama !== $reqWilayahMort) unset($dataFinalMort[$nama]); 
        } 
    }

    // =========================================================================
    // LOGIKA PENARIKAN DATA PETA DARI DATABASE (Tabel: pasien & wilayah)
    // =========================================================================
    $dbMap = \Config\Database::connect();
    $tahunMapFilter = $_GET['tahun_map'] ?? date('Y');

    // 1. Ambil Pasien (Usia, Gender, Daerah, Status Akhir)
    $bPasien = $dbMap->table('pasien');
    $bPasien->select('pasien.umur, pasien.jenis_kelamin, pasien.status_akhir, wilayah.kelurahan as nama_kelurahan');
    $bPasien->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah', 'left');
    $bPasien->where('YEAR(pasien.tgl_kunjungan)', $tahunMapFilter);
    $pasienDetail = $bPasien->get()->getResultArray();

    // 2. Ambil Rekap Jentik
    $bJentik = $dbMap->table('rekap_pelaporan_kader');
    $bJentik->select('kelurahan, SUM(diperiksa) as total_diperiksa, SUM(positif) as total_positif');
    $bJentik->like('periode_lengkap', $tahunMapFilter);
    $bJentik->groupBy('kelurahan');
    $jentikDetail = $bJentik->get()->getResultArray();

    // Variabel untuk menampung olahan
    $detailMap = [];
    $dbdMap = [];
    
    // (Dummy Penduduk karena tabel wilayah tidak mempunyai jumlah_penduduk)
    $dummyPenduduk = [
        'sumbersari' => 35000, 'wirolegi' => 25000, 
        'antirogo' => 20000, 'tegalgede' => 22000, 'karangrejo' => 28000
    ];

    foreach($pasienDetail as $row) {
        $nKel = trim($row['nama_kelurahan'] ?? '');
        if($nKel == '') continue;

        // Data utama map pin
        $dbdMap[] = ['desa' => $nKel, 'kasus' => 1];

        $kKel = strtolower(str_replace(' ', '', $nKel));

        if (!isset($detailMap[$kKel])) {
            $detailMap[$kKel] = [
                'nama' => $nKel,
                'jumlah_penduduk' => $dummyPenduduk[$kKel] ?? 20000,
                'jumlah_kasus' => 0,
                'sembuh' => 0,
                'meninggal' => 0,
                'abj' => 0,
                'anak' => 0, 'dewasa' => 0, 'lansia' => 0,
                'laki' => 0, 'perempuan' => 0,
                'kategori' => 'rendah', 'usia_tertinggi' => '-',
                'rumah_diperiksa' => 0, 'rumah_positif' => 0
            ];
        }

        // Tambah kasus
        $detailMap[$kKel]['jumlah_kasus'] += 1;
        
        // Klasifikasi Sembuh & Meninggal
        $status = strtolower(trim($row['status_akhir'] ?? ''));
        if ($status == 'sembuh') $detailMap[$kKel]['sembuh'] += 1;
        if ($status == 'meninggal') $detailMap[$kKel]['meninggal'] += 1;

        // Klasifikasi Usia
        $u = (int)$row['umur'];
        if ($u <= 14) $detailMap[$kKel]['anak'] += 1;
        else if ($u <= 59) $detailMap[$kKel]['dewasa'] += 1;
        else $detailMap[$kKel]['lansia'] += 1;

        // Klasifikasi Gender
        if (strtolower($row['jenis_kelamin']) == 'laki-laki') $detailMap[$kKel]['laki'] += 1;
        else $detailMap[$kKel]['perempuan'] += 1;
    }

    // Gabung data Pemeriksaan Jentik & Hitung ABJ
    foreach($jentikDetail as $j) {
        $kKel = strtolower(str_replace(' ', '', $j['kelurahan']));
        if (isset($detailMap[$kKel])) {
            $detailMap[$kKel]['rumah_diperiksa'] += $j['total_diperiksa'];
            $detailMap[$kKel]['rumah_positif'] += $j['total_positif'];
            
            $diperiksa = $detailMap[$kKel]['rumah_diperiksa'];
            $positif = $detailMap[$kKel]['rumah_positif'];
            if ($diperiksa > 0) {
                $negatif = $diperiksa - $positif;
                $detailMap[$kKel]['abj'] = round(($negatif / $diperiksa) * 100, 2);
            }
        }
    }

<?php

$db = \Config\Database::connect();

$id_penyakit = 1;
$idPetugas = session()->get('id_petugas');

$desa_diizinkan = [
    'sumbersari',
    'antirogo',
    'karangrejo',
    'wirolegi',
    'tegalgede'
];

/*
|--------------------------------------------------------------------------
| AMBIL DATA LANGSUNG DARI DATABASE
|--------------------------------------------------------------------------
*/
$dataDesa = $db->table('pasien')
    ->select('LOWER(REPLACE(kelurahan," ","")) as nama_desa, COUNT(*) as jumlah')
    ->where('id_petugas', $idPetugas)
    ->where('id_penyakit', $id_penyakit)
    ->whereIn('LOWER(REPLACE(kelurahan," ",""))', $desa_diizinkan)
    ->groupBy('nama_desa')
    ->get()
    ->getResultArray();

/*
|--------------------------------------------------------------------------
| INISIALISASI
|--------------------------------------------------------------------------
*/
$totalKasusRingkasan = 0;
$maxKasusRingkasan = 0;
$desaTertinggiVal = '-';
$totalDesaValid = 0;
$totalDesaTinggi = 0;

$rekapDesa = [];

/*
|--------------------------------------------------------------------------
| LOOP DATA
|--------------------------------------------------------------------------
*/
foreach ($dataDesa as $d) {

    $namaDesa = ucfirst($d['nama_desa']);
    $jumlah = (int)$d['jumlah'];

    $rekapDesa[$namaDesa] = $jumlah;

    $totalKasusRingkasan += $jumlah;
    $totalDesaValid++;

    if ($jumlah > $maxKasusRingkasan) {
        $maxKasusRingkasan = $jumlah;
        $desaTertinggiVal = $namaDesa;
    }
}

/*
|--------------------------------------------------------------------------
| RATA-RATA
|--------------------------------------------------------------------------
*/
$rataDesa = $totalDesaValid > 0
    ? round($totalKasusRingkasan / $totalDesaValid)
    : 0;

/*
|--------------------------------------------------------------------------
| DESA DI ATAS RATA-RATA
|--------------------------------------------------------------------------
*/
foreach ($rekapDesa as $jumlah) {
    if ($jumlah > $rataDesa) {
        $totalDesaTinggi++;
    }
}

?>

<section class="container mt-5 mb-5">
    <div class="ringkasan-card">
        <div class="ringkasan-left">
            <h3>Ringkasan Data</h3>
            <p>
                Kasus Demam Berdarah (DBD) tertinggi terjadi di Desa
                <span><?= esc((string)$desaTertinggiVal) ?> </span>
                yang masuk kategori sangat tinggi dibanding wilayah lain
            </p>
            <p>
                Terdapat
                <span><?= $totalDesaTinggi ?></span>
                desa dengan kasus di atas rata-rata
            </p>
            <p>
                Rata-rata kasus demam berdarah di tiap desa adalah
                <span><?= $rataDesa ?> kasus</span>
            </p>
            <p>
                Total kasus demam berdarah di kecamatan Sumbersari adalah
                <span><?= $totalKasusRingkasan ?> kasus</span>
            </p>
            <p>
                Wilayah dengan kasus tinggi lainnya adalah
                <span><?= esc((string)$desaTertinggiVal) ?></span>
            </p>
        </div>
    </div>
</section>

<div class="chatbot-fab" id="chatbotFab" onclick="toggleChat()">
    <div class="fab-content">
        <img src="<?= base_url('img/figoodpn.png') ?>" alt="ChaGoo" class="fab-logo" onerror="this.src='https://cdn-icons-png.flaticon.com/512/4712/4712010.png'">
        <span class="fab-text">ChaGoo Bot</span>
    </div>
</div>

<div class="chatbot-window" id="chatbotWindow">
    <div class="chat-header">
        <span style="display: flex; align-items: center; gap: 10px;">
            <img src="<?= base_url('img/figoo.png') ?>" alt="ChaGoo" class="header-logo" onerror="this.src='https://cdn-icons-png.flaticon.com/512/4712/4712010.png'"> 
            ChaGoo Bot
        </span>
        <span class="close-chat" onclick="toggleChat()">&times;</span>
    </div>
    <div class="chat-body" id="chatBody">
        <div class="chat-msg msg-bot">Halo! Saya ChaGoo, asisten edukasi Demam Berdarah Dengue Anda. Ada yang ingin ditanyakan seputar DBD?</div>
    </div>
    <div class="chat-footer">
        <input type="text" id="chatInput" class="chat-input" placeholder="Ketik pertanyaan..." onkeypress="handleChatEnter(event)">
        <button class="chat-send" onclick="sendMessage()"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
// --- VARIABEL GLOBAL MAP DARI OLAHAN DATABASE ---
var dataDBD = <?= json_encode($dbdMap) ?>;
var detailDesa = <?= json_encode($detailMap) ?>;
var desaTertinggi = "<?= $desaTertinggiVal ?>";
var tahunSekarang = "<?= $tahunMapFilter ?>";

/* =========================
   KATEGORI RISIKO DBD (Menyesuaikan standar)
========================= */
for (var key in detailDesa) {
    let d = detailDesa[key];
    let kasus = parseInt(d.jumlah_kasus ?? 0);
    let penduduk = parseInt(d.jumlah_penduduk ?? 0);
    let meninggal = parseInt(d.meninggal ?? 0);
    let abj = parseFloat(d.abj ?? 0);

    let ir = 0;
    if (penduduk > 0) ir = (kasus / penduduk) * 100000;

    let cfr = 0;
    if (kasus > 0) cfr = (meninggal / kasus) * 100;

    let indikatorBaik = 0;
    if (ir <= 10) indikatorBaik++;
    if (cfr < 1) indikatorBaik++;
    if (abj >= 95) indikatorBaik++;

    if (indikatorBaik === 3) {
        detailDesa[key].kategori = "rendah"; // hijau
    } else if (indikatorBaik >= 1) {
        detailDesa[key].kategori = "sedang"; // kuning
    } else {
        detailDesa[key].kategori = "tinggi"; // merah
    }

    detailDesa[key].ir = ir.toFixed(2);
    detailDesa[key].cfr = cfr.toFixed(2);
}

// --- FUNGSI GLOBAL MAP ---
function fixNama(nama){ return (nama || "").toLowerCase().trim().replace(/[^a-z0-9]/g, ""); }
var aliasDesa = { "kemuningsarilor": "kemuning sari lor", "tegalgede": "tegalgede", "tegalgedei": "tegalgede" };

function showDetailPopup(namaFix, namaAsli){
    var d = detailDesa[namaFix] || detailDesa[namaAsli.toLowerCase().replace(/\s/g,'')] || {};

    if(!d || Object.keys(d).length === 0){
        for(let key in detailDesa){
            if(key.includes(namaFix) || namaFix.includes(key)){
                d = detailDesa[key]; break;
            }
        }
    }
    d = d || {};

    var kategori = d.kategori || '-';
    var kategoriCls = '';
    if(kategori.toLowerCase() === 'tinggi') kategoriCls = 'kategori-tinggi';
    else if(kategori.toLowerCase() === 'sedang') kategoriCls = 'kategori-sedang';
    else if(kategori.toLowerCase() === 'rendah') kategoriCls = 'kategori-rendah';

    document.getElementById("modalTahun").innerText        = tahunSekarang;
    document.getElementById("modalNama").innerText         = d.nama || namaAsli;
    document.getElementById("modalPenduduk").innerText     = d.jumlah_penduduk ?? 0;
    document.getElementById("modalKasus").innerText        = d.jumlah_kasus    ?? 0;
    document.getElementById("modalSembuh").innerText       = d.sembuh ?? 0;
    document.getElementById("modalMeninggal").innerText    = d.meninggal ?? 0;

    var elKat = document.getElementById("modalKategori");
    elKat.innerText = (kategori.charAt(0).toUpperCase() + kategori.slice(1));
    elKat.className = 'value ' + kategoriCls;

    document.getElementById("modalAnak").innerText         = d.anak    ?? 0;
    document.getElementById("modalDewasa").innerText       = d.dewasa  ?? 0;
    document.getElementById("modalLansia").innerText       = d.lansia  ?? 0;
    document.getElementById("modalUsiaTertinggi").innerText = d.usia_tertinggi || '-';
    document.getElementById("modalDesaTertinggi").innerText = desaTertinggi    || '-';

    var lk = parseInt(d.laki ?? 0);
    var pr = parseInt(d.perempuan ?? 0);
    var jkUnik = (lk > 0 ? 1 : 0) + (pr > 0 ? 1 : 0);

    document.getElementById("modalJkTotal").innerText      = jkUnik;
    document.getElementById("modalLaki").innerText         = lk;
    document.getElementById("modalPerempuan").innerText    = pr;
    document.getElementById("modalRumahPeriksa").innerText = d.rumah_diperiksa ?? 0;
    document.getElementById("modalRumahJentik").innerText  = d.rumah_positif ?? 0;
    document.getElementById('modalAbj').innerText          = (d.abj ?? 0) + '%';

    document.getElementById("detailModal").style.display = "flex";
}

function closeDetailModal(){ document.getElementById("detailModal").style.display = "none"; }

window.addEventListener('click', function(e){
    var modal = document.getElementById('detailModal');
    if(e.target === modal) closeDetailModal();
});

function updateMap(){
    let tahun = document.getElementById("periodeMap").value;
    let url = new URL(window.location.href);
    url.searchParams.set('tahun_map', tahun);
    window.location.href = url.toString();
}

function switchTab(type) {
    const indicator = document.getElementById('slideIndicator');
    const tabKasus = document.getElementById('tabKasus');
    const tabMortalitas = document.getElementById('tabMortalitas');
    const tabABJ = document.getElementById('tabABJ');
    const title = document.getElementById('titleGrafik');
    const input = document.getElementById('activeTabInput');
    
    const wrapKasus = document.getElementById('wrapperKasus');
    const wrapMortalitas = document.getElementById('wrapperMortalitas');
    const wrapABJ = document.getElementById('wrapperABJ');
    
    const chartK = document.getElementById('chartKasus');
    const chartM = document.getElementById('chartMortalitas');
    const chartA = document.getElementById('chartABJ');

    input.value = type;

    // Reset Class & Display
    tabKasus.classList.remove('active');
    tabMortalitas.classList.remove('active');
    tabABJ.classList.remove('active');
    wrapKasus.style.display = 'none';
    wrapMortalitas.style.display = 'none';
    wrapABJ.style.display = 'none';
    chartK.style.display = 'none';
    chartM.style.display = 'none';
    chartA.style.display = 'none';

    if (type === 'kasus') {
        title.innerText = 'Grafik Kasus DBD';
        indicator.style.transform = 'translateX(0%)';
        tabKasus.classList.add('active');
        wrapKasus.style.display = 'block';
        chartK.style.display = 'block';
    } else if (type === 'mortalitas') {
        title.innerText = 'Grafik Kematian / Mortalitas DBD';
        indicator.style.transform = 'translateX(100%)';
        tabMortalitas.classList.add('active');
        wrapMortalitas.style.display = 'block';
        chartM.style.display = 'block';
    } else {
        title.innerText = 'Grafik Angka Bebas Jentik (ABJ)';
        indicator.style.transform = 'translateX(200%)';
        tabABJ.classList.add('active');
        wrapABJ.style.display = 'block';
        chartA.style.display = 'block';
    }
}

document.addEventListener("DOMContentLoaded", function() {

    // --- LOGIKA AUTO SCROLL SETELAH REFRESH/FILTER ---
    const urlParams = new URLSearchParams(window.location.search);
    const hasFilter = urlParams.has('wilayah') || urlParams.has('usia') || urlParams.has('jk') || 
                      urlParams.has('bulan') || urlParams.has('tahun') || urlParams.has('tab') ||
                      urlParams.has('wilayah_abj') || urlParams.has('bulan_abj') || urlParams.has('tahun_abj') ||
                      urlParams.has('wilayah_mort') || urlParams.has('tahun_mort') || urlParams.has('jk_mort');

    if (hasFilter) {
        const grafikSection = document.getElementById('grafik');
        if (grafikSection) {
            grafikSection.scrollIntoView({ behavior: 'auto', block: 'start' });
        }
    }

    // --- INISIALISASI PETA ---
    var dataFinal = {};
    dataDBD.forEach(item => {
        var desa = fixNama(item.desa); if(aliasDesa[desa]) desa = aliasDesa[desa];
        if(!dataFinal[desa]) dataFinal[desa] = { total: 0, jumlah: 0 };
        dataFinal[desa].total += parseInt(item.kasus); dataFinal[desa].jumlah++;
    });

    var map = L.map('map').setView([-8.1,113.5], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
    fetch("<?= base_url('assets/peta/db.geojson') ?>").then(res => res.json()).then(data => {
        var geo = L.geoJSON(data, {
            style: function(feature){
                var nama = fixNama(feature.properties.NAMOBJ); if(aliasDesa[nama]) nama = aliasDesa[nama];
                
                var detail = detailDesa[nama] || {};
                var warna = "#cccccc";

                if(detail.kategori == "tinggi"){ warna = "#dc3545"; }
                else if(detail.kategori == "sedang"){ warna = "#ffc107"; }
                else if(detail.kategori == "rendah"){ warna = "#28a745"; }

                return { color: "#00CED1", weight: 2, fillColor: warna, fillOpacity: 0.7 };
            },
            onEachFeature: function(feature, layer){
                var namaAsli = feature.properties.NAMOBJ || "Kelurahan";
                var namaFix  = fixNama(namaAsli); if(aliasDesa[namaFix]) namaFix = aliasDesa[namaFix];
                var item = dataFinal[namaFix];
                
                var isi = "<div style='min-width:220px;'>";
                isi += "<b>Kelurahan: " + namaAsli + "</b>";

                if(item){
                    var detail = detailDesa[namaFix] || {};
                    var kategori = detail.kategori || '-';
                    isi += "<br>Total Kasus: " + item.total;
                    isi += "<br>Kategori: " + kategori;
                    isi += `<br><br><button onclick="showDetailPopup('${namaFix}','${namaAsli}')" style="background:#00CED1;color:white;border:none;padding:8px 14px;border-radius:8px;cursor:pointer;font-weight:600;width:100%;">Selengkapnya</button>`;
                } 
                else { 
                    isi += "<br><span style='color:red'>Data tidak ditemukan</span>"; 
                }
                
                isi += "</div>";
                
                layer.bindPopup(isi); 
                layer.bindTooltip(namaAsli, { permanent: true, direction: "center", className: "label-desa" });
                layer.on({ mouseover: function(e){ e.target.setStyle({ weight: 3, color: '#000' }); }, mouseout: function(e){ geo.resetStyle(e.target); } });
            }
        }).addTo(map); 
        map.fitBounds(geo.getBounds());
    });

    // --- INISIALISASI SLIDING TAB ---
    const currentTab = "<?= $_GET['tab'] ?? 'kasus' ?>";
    switchTab(currentTab);

    // --- GRAFIK KASUS ---
    const dataGrafikKasus = <?= json_encode($grafik ?? []) ?>;
    let labelsKasus = []; let totalKasus = [];
    dataGrafikKasus.forEach(item => { 
        labelsKasus.push(item.kelurahan || item.desa); 
        totalKasus.push(item.total || item.kasus); 
    });
    new Chart(document.getElementById('chartKasus').getContext('2d'), {
        type: 'bar', data: { labels: labelsKasus, datasets: [{ label: 'Total Kasus', data: totalKasus, backgroundColor: '#00BBC2', borderRadius: 8 }] },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // --- GRAFIK MORTALITAS ---
    const rawDataMort = <?= json_encode($dataFinalMort) ?>;
    const colorMapping = { 'Antirogo': '#1f4e5b', 'Sumbersari': '#00BBC2', 'Karangrejo': '#b2dfdb', 'Tegalgede': '#5cb85c', 'Wirolegi': '#4fc3f7' };
    let datasetsMort = [];
    
    for (const kelurahan in rawDataMort) {
        datasetsMort.push({ 
            label: kelurahan, 
            data: rawDataMort[kelurahan], 
            borderColor: colorMapping[kelurahan] || '#333', 
            backgroundColor: colorMapping[kelurahan] || '#333', 
            fill: false, tension: 0, pointRadius: 4, pointHoverRadius: 6, borderWidth: 2, spanGaps: true 
        });
    }

    new Chart(document.getElementById('chartMortalitas').getContext('2d'), {
        type: 'line', 
        data: { 
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], 
            datasets: datasetsMort 
        },
        options: { 
            responsive: true, maintainAspectRatio: false, 
            plugins: { legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } } },
            scales: { 
                y: { min: 0, ticks: { stepSize: 1 }, grid: { borderDash: [5, 5] } }, 
                x: { grid: { display: false } } 
            }
        }
    });

    // --- GRAFIK ABJ ---
    const rawDataABJ = <?= json_encode($dataFinalABJ) ?>;
    let datasetsABJ = [];
    for (const kelurahan in rawDataABJ) {
        datasetsABJ.push({ label: kelurahan, data: rawDataABJ[kelurahan], borderColor: colorMapping[kelurahan] || '#333', backgroundColor: colorMapping[kelurahan] || '#333', fill: false, tension: 0.2, pointRadius: 4, pointHoverRadius: 6, borderWidth: 2, spanGaps: true });
    }
    new Chart(document.getElementById('chartABJ').getContext('2d'), {
        type: 'line', data: { labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'], datasets: datasetsABJ },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } } },
            scales: { y: { min: 0, max: 100, ticks: { stepSize: 25, callback: function(value) { return value + '%'; } }, grid: { borderDash: [5, 5] } }, x: { grid: { display: false } } }
        }
    });
});

// ================= HERO & FUNFACT SLIDER LOGIC =================
let currentSlide = 0;
const slider = document.getElementById("heroSlider");
const slides = document.querySelectorAll(".hero-slide");

if (slider && slides.length > 0) {
    function moveSlide(direction){
        const total = slides.length;
        currentSlide += direction;
        if(currentSlide < 0){ currentSlide = total - 1; }
        if(currentSlide >= total){ currentSlide = 0; }
        slider.style.transform = `translateX(-${currentSlide * 100}%)`;
    }

    setInterval(() => { moveSlide(1); }, 5000);

    let startX = 0;
    slider.addEventListener("touchstart", (e)=>{ startX = e.touches[0].clientX; });
    slider.addEventListener("touchend", (e)=>{
        let endX = e.changedTouches[0].clientX;
        if(startX > endX + 50){ moveSlide(1); }
        else if(startX < endX - 50){ moveSlide(-1); }
    });
}

function slideFunfact(direction){
    let track = document.getElementById('funfactTrack');
    if (track) track.scrollBy({ left: direction * 350, behavior:'smooth' });
}

function slideVideo(direction){
    let track = document.getElementById('videoTrack');
    if (track) track.scrollBy({ left: direction * 350, behavior:'smooth' });
}

// ================= JAVASCRIPT CHATBOT CHAGOO (FIXED CSRF) =================
let csrfTokenName = '<?= csrf_token() ?>';
let csrfTokenHash = '<?= csrf_hash() ?>';

function toggleChat() {
    var chatWindow = document.getElementById('chatbotWindow');
    if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
        chatWindow.style.display = 'flex';
        document.getElementById('chatInput').focus();
    } else {
        chatWindow.style.display = 'none';
    }
}

function handleChatEnter(event) {
    if (event.key === 'Enter') sendMessage();
}

function appendMessage(sender, text, id = null) {
    var chatBody = document.getElementById('chatBody');
    var msgDiv = document.createElement('div');
    msgDiv.className = 'chat-msg ' + (sender === 'user' ? 'msg-user' : 'msg-bot');
    if (id) msgDiv.id = id;
    msgDiv.textContent = text;
    chatBody.appendChild(msgDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function sendMessage() {
    var input = document.getElementById('chatInput');
    var message = input.value.trim();
    if (message === '') return;

    appendMessage('user', message);
    input.value = '';

    var loadingId = 'loading-' + Date.now();
    appendMessage('bot', 'Mengetik...', loadingId);

    var formData = new URLSearchParams();
    formData.append('message', message);
    formData.append(csrfTokenName, csrfTokenHash);

    fetch("<?= base_url('chagoo/send') ?>", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData.toString()
    })
    .then(response => response.json())
    .then(data => {
        var loadingEl = document.getElementById(loadingId);
        if (loadingEl) loadingEl.remove();

        if (data.csrf_token) {
            csrfTokenHash = data.csrf_token;
        }

        if (data.reply) {
            appendMessage('bot', data.reply.trim());
        } else if (data.messages && data.messages.error) {
            appendMessage('bot', 'Sistem keamanan memblokir pesan. Silakan muat ulang (Refresh) halaman ini.');
        } else {
            appendMessage('bot', 'Maaf, sistem tidak dapat memproses jawaban saat ini.');
            console.log('Isi error dari server:', data);
        }
    })
    .catch(error => {
        var loadingEl = document.getElementById(loadingId);
        if (loadingEl) loadingEl.remove();
        appendMessage('bot', 'Gagal terhubung ke server. Silakan coba lagi.');
        console.error('Error:', error);
    });
}
// =======================================================================
</script>

<?= $this->include('layout/footer') ?>