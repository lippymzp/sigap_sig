<?php /** @var array $video */ ?>
<?= $this->include('layout/header_a') ?>

<?php
$status = $_GET['status'] ?? '';
?>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>

/* ================= GLOBAL ================= */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f5f5f5;
}

/* ================= WRAPPER ================= */
.video-page{
    max-width:1280px;
    margin:auto;
    padding:0 16px 40px;
}

/* ================= HERO (INI YANG KAMU KIRA HILANG) ================= */
.hero-video{
    background:linear-gradient(90deg,#18b8be,#9ad6d2);
    padding:38px 20px;
    text-align:center;
    color:#fff;
    margin-bottom:16px;
}

.hero-video h2{
    font-size:28px;
    font-weight:700;
    margin-bottom:6px;
}

.hero-video p{
    font-size:14px;
    opacity:.95;
    margin-bottom:14px;
}

.breadcrumb{
    display:flex;
    justify-content:center;
    gap:10px;
    font-size:13px;
}

/* ================= FILTER (INI YANG HILANG DI KAMU) ================= */
.filter-tabs{
    display:flex;
    margin-bottom:20px;
}

.tab-btn{
    min-width:170px;
    text-align:center;
    padding:10px 20px;
    border:1px solid #00BBC2;
    color:#00BBC2;
    text-decoration:none;
    font-size:12px;
    font-weight:600;
    background:#fff;
    transition:.2s;
}

.tab-btn:first-child{
    border-radius:8px 0 0 8px;
}

.tab-btn:last-child{
    border-radius:0 8px 8px 0;
}

.tab-btn.active{
    background:#00BBC2;
    color:#fff;
}

/* ================= CARD ================= */
.video-card{
    position:relative;
    display:flex;
    gap:16px;
    background:#edf7f7;
    border:1px solid #cfdede;
    border-radius:8px;
    padding:10px;
    margin-bottom:18px;
    box-shadow:0 2px 5px rgba(0,0,0,.08);
}

/* AREA LINK VIDEO */
.video-main{
    display:flex;
    gap:16px;
    flex:1;
    text-decoration:none;
    color:inherit;
}

/* THUMB */
.video-thumb{
    width:210px;
    height:118px;
    border-radius:10px;
    overflow:hidden;
    background:#000;
}

.video-thumb video{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* CONTENT */
.video-content{
    flex:1;
}

.video-title{
    font-size:15px;
    font-weight:700;
}

.video-desc{
    font-size:12px;
    color:#888;
}

/* ================= HAMBURGER ================= */
.menu-toggle{
    position:absolute;
    right:12px;
    top:12px;
    cursor:pointer;
    font-size:20px;
    background:#fff;
    padding:8px 10px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,.12);
}

/* ================= MENU ================= */
.video-menu{
    display:none;
    position:absolute;
    right:12px;
    top:50px;
    width:160px;
    background:#fff;
    border-radius:12px;
    padding:10px;
    box-shadow:0 10px 25px rgba(0,0,0,.18);
    z-index:50;
}

.video-menu.active{
    display:block;
}

/* ITEM */
.menu-item{
    display:flex;
    gap:10px;
    padding:10px;
    font-size:13px;
    cursor:pointer;
}

/* DATE */
.video-date{
    position:absolute;
    right:14px;
    bottom:12px;
    font-size:10px;
    color:#999;
}

/* EMPTY */
.empty-data{
    background:#fff;
    padding:60px;
    text-align:center;
    border-radius:10px;
}

</style>

<div class="video-page">

    <!-- HERO (SUDAH BALIK LAGI) -->
    <div class="hero-video">

        <h2>Video Edukasi</h2>

        <p>Temukan video edukasi yang menarik dan bermanfaat</p>

        <div class="breadcrumb">
            <span>Beranda</span>
            <span>›</span>
            <span>Video</span>
        </div>

    </div>

    <!-- FILTER (SUDAH BALIK LAGI) -->
    <div class="filter-tabs">

        <a href="<?= current_url() ?>"
           class="tab-btn <?= ($status=='') ? 'active' : '' ?>">
            Semua
        </a>

        <a href="<?= current_url() ?>?status=belum"
           class="tab-btn <?= ($status=='belum') ? 'active' : '' ?>">
            Belum Ditonton
        </a>

        <a href="<?= current_url() ?>?status=sudah"
           class="tab-btn <?= ($status=='sudah') ? 'active' : '' ?>">
            Sudah Ditonton
        </a>

        <a href="<?= current_url() ?>?status=baru"
           class="tab-btn <?= ($status=='baru') ? 'active' : '' ?>">
            Baru Diupload
        </a>

    </div>

    <!-- LIST VIDEO -->
    <?php if(!empty($video)) : ?>

        <?php foreach($video as $v) : ?>

        <div class="video-card">

            <!-- LINK VIDEO -->
            <a href="<?= base_url('video/video_dbd/' . $v['id_video']) ?>" class="video-main">

                <div class="video-thumb">
                    <video muted autoplay loop playsinline>
                        <source src="<?= base_url('uploads/video/' . ($v['file_video'] ?? '')) ?>" type="video/mp4">
                    </video>
                </div>

                <div class="video-content">
                    <div class="video-title">
                        <?= esc($v['judul_video'] ?? '') ?>
                    </div>

                    <div class="video-desc">
                        <?= substr(strip_tags($v['deskripsi_video'] ?? ''),0,85) ?>...
                    </div>
                </div>

            </a>

            <!-- HAMBURGER -->
            <div class="menu-toggle"
                 onclick="event.stopPropagation(); toggleMenu(this)">
                <i class="fa fa-ellipsis-vertical"></i>
            </div>

            <!-- MENU -->
            <div class="video-menu">

                <div class="menu-item"
                     onclick="event.stopPropagation(); downloadVideo('<?= base_url('uploads/video/' . ($v['file_video'] ?? '')) ?>')">
                    <i class="fa fa-download"></i> Download
                </div>

                <div class="menu-item"
                     onclick="event.stopPropagation(); shareVideo('<?= base_url('VideoDbd/view/' . $v['id_video']) ?>')">
                    <i class="fa fa-share"></i> Bagikan
                </div>

            </div>

            <!-- DATE -->
            <div class="video-date">
                <?= esc($v['tanggal_video'] ?? '02 Maret 2026') ?>
            </div>

        </div>

        <?php endforeach; ?>

    <?php else : ?>

        <div class="empty-data">
            Tidak ada video tersedia.
        </div>

    <?php endif; ?>

</div>

<script>

function toggleMenu(el){

    const menu = el.parentElement.querySelector('.video-menu');

    document.querySelectorAll('.video-menu').forEach(m=>{
        if(m!==menu) m.classList.remove('active');
    });

    menu.classList.toggle('active');
}

document.addEventListener('click', function(){
    document.querySelectorAll('.video-menu')
    .forEach(m=>m.classList.remove('active'));
});

function downloadVideo(url){
    const a=document.createElement('a');
    a.href=url;
    a.download='';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

function shareVideo(url){
    navigator.clipboard.writeText(url);
    alert('Link berhasil disalin');
}

</script>

<?= $this->include('layout/footer_a') ?>