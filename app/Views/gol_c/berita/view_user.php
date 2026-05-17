<?php $this->setVar('penyakit', 'pneumonia'); ?>
<?php 
$this->setVar('show_footer_maskot', true);
$this->setVar('footer_maskot', 'cynex.png');
?>
<?= $this->include('layout/header') ?>

<?php

$conn = mysqli_connect("localhost","root","","sigap_db");

/*
|--------------------------------------------------------------------------
| SIDEBAR BERITA
|--------------------------------------------------------------------------
*/

$querySidebar = mysqli_query($conn, "
    SELECT 
    id_berita,
    judul_berita,
    tanggal_berita,
    gambar_berita
FROM berita
    WHERE status_berita = 'publish'
    AND id_penyakit = 3
    ORDER BY tanggal_berita DESC
");

$groupBerita = [];

while($row = mysqli_fetch_assoc($querySidebar)){

    $tahun = date('Y', strtotime($row['tanggal_berita']));
    $bulan = date('F', strtotime($row['tanggal_berita']));

    $groupBerita[$tahun][$bulan][] = $row;
}

/*
|--------------------------------------------------------------------------
| GAMBAR BERITA
|--------------------------------------------------------------------------
*/

$gambar = trim((string)($beritapneumonia['gambar_berita'] ?? ''));

$pathFile = FCPATH . 'uploads/berita/' . $gambar;

$gambarFix = base_url('uploads/berita/default.jpeg');

if(
    $gambar !== '' &&
    strtolower($gambar) !== 'null' &&
    file_exists($pathFile)
){
    $gambarFix = base_url('uploads/berita/' . $gambar);
}

?>
<?= $this->include('layout/header') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins', sans-serif;
}

/* ========================= WRAPPER ========================= */

/* ========================= WRAPPER ========================= */

.detail-wrapper{
    max-width: 1300px;
    margin: 50px auto;
}

/* ========================= LAYOUT ========================= */

.detail-layout{
    display: flex;
    gap: 30px;
    align-items: flex-start;
}

.detail-main{
    flex: 3;
}

.detail-sidebar{
    flex: 1;
    position: sticky;
    top: 20px;
}

/* ========================= CARD ========================= */

.detail-card{
    background: #ffffff;
    border-radius: 24px;
    overflow: hidden;

    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* GAMBAR */
.detail-image img{
    width: 100%;
    height: 450px;
    object-fit: cover;
}

/* CONTENT */
.detail-content{
    padding: 40px;
}

/* BADGE */
.detail-badge{
    display: inline-block;

    background: #dff7f8;
    color: #11aeb7;

    padding: 8px 14px;

    border-radius: 8px;

    font-size: 13px;
    font-weight: 700;

    margin-bottom: 18px;
}

/* JUDUL */
.detail-title{
    font-size: 42px;
    font-weight: 800;

    color: #16384c;

    line-height: 1.3;

    margin-bottom: 18px;
}

/* META */
.detail-meta{
    display: flex;
    flex-wrap: wrap;
    gap: 20px;

    margin-bottom: 28px;

    color: #7a7a7a;
    font-size: 14px;
}

/* DESKRIPSI */
.detail-deskripsi{
    font-size: 18px;
    line-height: 1.9;

    color: #555;

    margin-bottom: 30px;
}

/* ISI */
.detail-isi{
    font-size: 17px;
    line-height: 2;

    color: #333;
}

/* BUTTON */
.btn-kembali{
    display: inline-block;

    margin-top: 40px;

    background: linear-gradient(
        135deg,
        #14c7cf,
        #18b7d3
    );

    color: white;
    text-decoration: none;

    padding: 14px 28px;

    border-radius: 14px;

    font-weight: 700;

    transition: 0.3s;
}

.btn-kembali:hover{
    transform: translateY(-2px);
    color: white;
}

/* ========================= SIDEBAR ========================= */

.sidebar-card{
    background: white;

    border-radius: 20px;

    padding: 24px;

    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}

.sidebar-title{
    font-size: 24px;
    font-weight: 800;

    color: #173b4d;

    margin-bottom: 24px;
}

/* TAHUN */
.sidebar-year{
    margin-bottom: 24px;
}

.sidebar-year h5{
    font-size: 18px;
    font-weight: 700;

    color: #0ea5b7;

    margin-bottom: 12px;
}

/* BULAN */
.sidebar-month{
    margin-bottom: 18px;
}

.sidebar-month h6{
    font-size: 15px;
    font-weight: 700;

    color: #555;

    margin-bottom: 10px;
}

/* LIST */
.berita-list{
    list-style: none;
    padding-left: 0;
    margin: 0;
}

.berita-list li{
    margin-bottom: 10px;
}

.berita-list a{
    text-decoration: none;

    color: #333;

    font-size: 14px;
    line-height: 1.6;

    transition: 0.3s;
}

.berita-list a:hover{
    color: #10b7c5;
    padding-left: 5px;
}
.related-news{
    display:flex;
    flex-direction:column;
    gap:15px;
}

.news-card{
    display:flex;
    gap:12px;

    text-decoration:none;

    background:#f8f9fa;

    padding:10px;

    border-radius:14px;

    overflow:hidden;

    transition:0.3s;
}

.news-card:hover{
    transform:translateY(-3px);

    box-shadow:0 6px 18px rgba(0,0,0,0.08);
}

.news-card img{
    width:90px;
    height:70px;

    object-fit:cover;

    border-radius:10px;

    flex-shrink:0;
}

.news-content{
    flex:1;
}

.news-content h5{
    font-size:13px;
    color:#222;
    margin-bottom:5px;
}

.news-content small{
    color:#888;
    font-size:11px;
}

/* RESPONSIVE */
@media(max-width:992px){

    .detail-layout{
        flex-direction: column;
    }

    .detail-sidebar{
        width: 100%;
        position: static;
    }

}

@media(max-width:768px){

    .detail-content{
        padding: 24px;
    }

    .detail-title{
        font-size: 28px;
    }

    .detail-image img{
        height: 250px;
    }

    .detail-deskripsi,
    .detail-isi{
        font-size: 15px;
    }

}

.footer-maskot{
    width:250px !important;
}

</style>

<div class="container detail-wrapper">

    <div class="detail-layout">

        <!-- MAIN -->
        <div class="detail-main">

            <div class="detail-card">

                <!-- GAMBAR -->
                <div class="detail-image">

                    <img 
                        src="<?= $gambarFix ?>" 
                        alt="<?= $beritapneumonia['judul_berita'] ?>"
                    >

                </div>

                <!-- CONTENT -->
                <div class="detail-content">

                    <span class="detail-badge">
                        Pneumonia
                    </span>

                    <!-- JUDUL -->
                    <h1 class="detail-title">
                        <?= $beritapneumonia['judul_berita'] ?>
                    </h1>

                    <!-- META -->
                    <div class="detail-meta">

                        <span>
                            📅 
                            <?= date('d F Y', strtotime($beritapneumonia['tanggal_berita'])) ?>
                        </span>

                        <span>
                            ✍️ 
                            <?= $beritapneumonia['penulis'] ?? 'Admin' ?>
                        </span>

                    </div>

                    <!-- DESKRIPSI -->
                    <div class="detail-deskripsi">

                        <?= $beritapneumonia['deskripsi_berita'] ?>

                    </div>

                    <!-- ISI -->
                    <div class="detail-isi">

                        <?= $beritapneumonia['isi_berita'] ?>

                    </div>
                  <div style="margin-top:20px;">

<?php if(!empty($beritapneumonia['url_berita'])): ?>

    <a 
        href="<?= $beritapneumonia['url_berita'] ?>" 
        target="_blank"
        class="btn btn-info"
        style="
            background:#11b7c4;
            color:white;
            padding:12px 20px;
            border-radius:10px;
            text-decoration:none;
            font-weight:600;
            display:inline-block;
        "
    >
        Buka Sumber Berita
    </a>

<?php endif; ?>

</div>

                    <!-- BUTTON -->
                    <div style="text-align:right;">
                   <?php
$from = $_GET['from'] ?? '';

$backUrl = ($from == 'admin')
    ? base_url('pneumonia/dashboard/admin')
    : base_url('pneumonia');
?>

<a 
    href="<?= $backUrl ?>" 
    class="btn-kembali"
>
    Kembali
</a>
                    </div>

                </div>

            </div>

        </div>

        <!-- SIDEBAR -->
       <!-- SIDEBAR -->
<div class="detail-sidebar">

    <div class="sidebar-card">

        <h4 class="sidebar-title">
            Berita Terkait
        </h4>

        <div class="related-news">

        <?php foreach($groupBerita as $tahun => $bulanData): ?>

            <?php foreach($bulanData as $bulan => $listBerita): ?>

                <?php foreach($listBerita as $item): ?>

                    <a 
                        href="<?= base_url('beritapneumonia/viewUser/' . $item['id_berita'] . '?from=' . $from) ?>"
                        class="news-card"
                    >

                        <img 
                            src="<?= base_url('uploads/berita/' . $item['gambar_berita']) ?>"
                            alt=""
                        >

                        <div class="news-content">

                            <h5>
                                <?= $item['judul_berita'] ?>
                            </h5>

                            <small>
                                <?= date('d M Y', strtotime($item['tanggal_berita'])) ?>
                            </small>

                        </div>

                    </a>

                <?php endforeach; ?>

            <?php endforeach; ?>

        <?php endforeach; ?>

               </div>

    </div>
                </div>
                </div>
                </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const footerDesc = document.querySelector(".footer-desc");

    if(footerDesc){

        footerDesc.insertAdjacentHTML("afterend", `
        
            <div class="cynex-info mt-4">

                <h3 style="
                    color:#fff;
                    font-weight:700;
                    font-size:2rem;
                    margin-bottom:12px;
                    line-height:1;
                ">
                    CYNEX
                </h3>

                <p style="
                    color:#E8FFFF;
                    font-size:1.1rem;
                    line-height:1.8;
                    margin-bottom:0;
                ">
                    Clinical System for Next Experience
                </p>

            </div>

        `);

    }

});

</script>

<?= $this->include('layout/footer') ?>