<?= $this->extend('layout/dashboard_layout_admin'); ?>
<?= $this->section('content'); ?>

<style>

body{
    background:#efefef;
    font-family:'Poppins',sans-serif;
}

/* WRAPPER */
.video-wrapper{
    padding:18px 18px;
    background:#f5f5f5;
    min-height:100vh;
}

/* TITLE */
.page-title{
    font-size:34px;
    font-weight:800;
    color:#111;
    margin-bottom:18px;
}

/* SEARCH */
.search-box{
    margin-bottom:20px;
    position:relative;
}

.search-box input{
    width:100%;
    height:56px;
    border-radius:12px;
    border:1.5px solid #bdbdbd;
    background:#fff;
    padding:0 20px 0 62px;
    font-size:16px;
    font-weight:500;
    color:#666;
    outline:none;
    box-shadow:0 3px 8px rgba(0,0,0,.10);
}

/* SEARCH ICON */
.search-box::before{
    content:'';
    position:absolute;
    width:18px;
    height:18px;
    border:3px solid #a4a4a4;
    border-radius:50%;
    left:18px;
    top:16px;
}

.search-box::after{
    content:'';
    position:absolute;
    width:10px;
    height:3px;
    background:#a4a4a4;
    border-radius:10px;
    transform:rotate(45deg);
    left:34px;
    top:37px;
}

/* SUMMARY */
.summary-box{
    background:linear-gradient(90deg,#10bccd,#77d8dc);
    border-radius:12px;
    padding:18px 22px;
    margin-bottom:24px;
    box-shadow:0 3px 8px rgba(0,0,0,.12);
}

.summary-box h2{
    margin:0;
    color:#fff;
    font-size:32px;
    font-weight:800;
    text-align:center;
}

.summary-info{
    display:flex;
    justify-content:center;
    gap:40px;
    margin-top:18px;
    color:#fff;
    font-size:14px;
    font-weight:500;
}

.summary-info span{
    display:flex;
    align-items:center;
    gap:8px;
}

/* FILTER */
.filter-tabs{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:22px;
}

.left-tabs{
    display:flex;
    gap:16px;
}

.tab-btn{
    width:190px;
    height:48px;
    border-radius:10px;
    background:#fff;
    border:1px solid #bcbcbc;
    color:#111;
    text-decoration:none;
    font-size:16px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 3px 8px rgba(0,0,0,.10);
    transition:.2s;
}

.tab-btn.active{
    background:#11bccd;
    color:#fff;
    border:none;
}

.add-btn{
    width:190px;
    height:48px;
    border-radius:10px;
    background:#f0cf52;
    color:#fff;
    text-decoration:none;
    font-size:16px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 3px 8px rgba(0,0,0,.12);
}

/* CARD */
.card-video{
    background:#edf6f7;
    border:1px solid #b7c7c8;
    border-radius:14px;
    padding:18px 22px;
    margin-bottom:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 3px 8px rgba(0,0,0,.08);
}

/* LEFT */
.card-left{
    display:flex;
    align-items:center;
    gap:22px;
    flex:1;
}

/* VIDEO */
.video-thumbnail{
    width:230px;
    height:128px;
    border-radius:14px;
    overflow:hidden;
    position:relative;
    background:#000;
    flex-shrink:0;
}

.video-thumbnail video{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

.video-duration{
    position:absolute;
    right:8px;
    bottom:8px;
    background:rgba(0,0,0,.55);
    color:#fff;
    font-size:11px;
    font-weight:700;
    padding:3px 7px;
    border-radius:6px;
}

/* INFO */
.card-info{
    flex:1;
}

.card-info h4{
    margin:0 0 8px;
    font-size:22px;
    font-weight:800;
    color:#111;
}

.card-info p{
    margin:0 0 12px;
    font-size:14px;
    color:#9a9a9a;
    line-height:1.5;
    max-width:650px;
}

.card-info small{
    font-size:13px;
    color:#8d8d8d;
}

/* RIGHT */
.card-right{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:14px;
}

/* ICON */
.action-icons{
    display:flex;
    gap:12px;
}

.icon-btn{
    width:48px;
    height:48px;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    color:#fff;
    font-size:20px;
    box-shadow:0 3px 8px rgba(0,0,0,.12);
}

.view{
    background:#1f2bf1;
}

.status{
    background:#eadf00;
}

.delete{
    background:#ff1717;
}

/* STATUS */
.upload-status{
    font-size:14px;
    font-weight:700;
    color:#10bccd;
    margin-top:4px;
}

.empty-text{
    text-align:center;
    color:#777;
    font-size:18px;
    margin-top:30px;
}
/* MODAL VIDEO */

.video-modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.85);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
}

.video-content{
    width:90%;
    max-width:900px;
    position:relative;
}

.video-content video{
    width:100%;
    border-radius:16px;
    background:#000;
}

.close-video{
    position:absolute;
    top:-45px;
    right:0;
    color:#fff;
    font-size:40px;
    font-weight:bold;
    cursor:pointer;
}
</style>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="video-wrapper">

    <!-- TITLE -->
    <div class="page-title">
        Video
    </div>

    <!-- SEARCH -->
    <div class="search-box">
        <input
            type="text"
            id="searchInput"
            placeholder="Cari video disini"
        >
    </div>

    <!-- SUMMARY -->
    <div class="summary-box">

        <h2>
            <?= !empty($video) ? count($video) : 0; ?>
            video telah diunggah
        </h2>

        <div class="summary-info">

            <span>
                ⚪ <?= $publish ?? 0; ?> video telah diunggah
            </span>

            <span>
                ⚪ <?= $draft ?? 0; ?> video di draft
            </span>

        </div>

    </div>

    <!-- FILTER -->
    <?php $uri = service('uri')->getSegment(2); ?>

    <div class="filter-tabs">

        <div class="left-tabs">

            <a href="/video/publish"
            class="tab-btn <?= ($uri == 'publish') ? 'active' : '' ?>">
                Terunggah
            </a>

            <a href="/video/draft"
            class="tab-btn <?= ($uri == 'draft') ? 'active' : '' ?>">
                Draft
            </a>

        </div>

        <a href="/video/tambah1" class="add-btn">
            Tambah Video
        </a>

    </div>

    <!-- LIST -->
    <?php if (!empty($video)) : ?>
    <?php foreach ($video as $b): ?>

    <div class="card-video"
    data-search="<?= strtolower((string)($b['judul_video'] ?? '') . ' ' . (string)($b['deskripsi_video'] ?? '')) ?>">

        <!-- LEFT -->
        <div class="card-left">

            <div class="video-thumbnail">

                <video
                    muted
                    autoplay
                    loop
                    playsinline
                >
                    <source
                    src="<?= base_url('uploads/video/' . $b['file_video']); ?>"
                    type="video/mp4">
                </video>

                <div class="video-duration">
                    02:01
                </div>

            </div>

            <div class="card-info">

                <h4>
                    <?= esc((string)($b['judul_video'] ?? '')) ?>
                </h4>

                <p>
                    <?= esc(substr((string)($b['deskripsi_video'] ?? ''), 0, 100)) ?> ?>
                </p>

                <small>

<?php

$tanggal = $b['tanggal_video'] ?? '';

$bulanIndonesia = [
    1 => 'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
];

if(
    !empty($tanggal) &&
    $tanggal != '0000-00-00' &&
    $tanggal != '0000-00-00 00:00:00'
){

    $time = strtotime($tanggal);

}else{

    $time = time();
}

$hari  = date('d', $time);
$bulan = $bulanIndonesia[(int)date('m', $time)];
$tahun = date('Y', $time);

echo $hari . ' ' . $bulan . ' ' . $tahun;

?>

</small>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="card-right">

            <div class="action-icons">

                <!-- VIEW -->
                <button
                    type="button"
                    class="icon-btn view"
                    onclick="playVideo(
                        '<?= base_url('uploads/video/' . $b['file_video']); ?>'
                    )"
                >
                    <i class="fas fa-eye"></i>
                </button>

                <!-- EDIT -->
                <a href="/video/tambah1/<?= $b['id_video']; ?>"
                class="icon-btn status">
                    <i class="fas fa-pen"></i>
                </a>

                <!-- DELETE -->
                <a href="/video/delete/<?= $b['id_video']; ?>"
                class="icon-btn delete"
                onclick="return confirm('Hapus video ini?')">

                    <i class="fas fa-trash"></i>

                </a>

            </div>

            <div class="upload-status">

                <?php
                $status =
                strtolower(trim($b['status_video'] ?? 'draft'));

                if($status == 'publish'){
                    echo 'Telah Diunggah';
                }else{
                    echo 'Draft';
                }
                ?>

            </div>

        </div>

    </div>

    <?php endforeach; ?>

    <?php else : ?>

        <div class="empty-text">
            Tidak ada data video.
        </div>

    <?php endif; ?>

</div>
<!-- MODAL VIDEO -->
<div class="video-modal" id="videoModal">

    <div class="video-content">

        <!-- CLOSE -->
        <span
            class="close-video"
            onclick="closeVideo()"
        >
            &times;
        </span>

        <!-- VIDEO -->
        <video
            id="myVideo"
            controls
        >
            <source
                id="videoSource"
                src=""
                type="video/mp4"
            >
        </video>

    </div>

</div>
<script>

window.onload = function(){

const input =
document.getElementById('searchInput');

input.addEventListener('input', function(){

    let keyword =
    this.value.toLowerCase().trim();

    let found = false;

    document.querySelectorAll('.card-video')
    .forEach(function(item){

        let data =
        item.getAttribute('data-search') || '';

        if(data.includes(keyword)){

            item.style.display = 'flex';

            found = true;

        }else{

            item.style.display = 'none';
        }

    });

});

};

// PLAY VIDEO
function playVideo(videoUrl){

    const modal =
    document.getElementById('videoModal');

    const video =
    document.getElementById('myVideo');

    const source =
    document.getElementById('videoSource');

    source.src = videoUrl;

    video.load();

    modal.style.display = 'flex';

    video.play();

}


// CLOSE VIDEO
function closeVideo(){

    const modal =
    document.getElementById('videoModal');

    const video =
    document.getElementById('myVideo');

    modal.style.display = 'none';

    video.pause();

    video.currentTime = 0;

}


// CLOSE SAAT KLIK BACKGROUND
window.addEventListener('click', function(e){

    const modal =
    document.getElementById('videoModal');

    if(e.target === modal){

        closeVideo();
    }

});

</script>

<?= $this->endSection(); ?>