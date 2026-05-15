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
        tanggal_berita
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

<style>

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

                    <!-- BUTTON -->
                    <div style="text-align:right;">
                    <a 
                        href="<?= base_url('pneumonia') ?>" 
                        class="btn-kembali"
                    >
                        Kembali
                    </a>
                    </div>

                </div>

            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="detail-sidebar">

            <div class="sidebar-card">

                <h4 class="sidebar-title">
                    Berita Lainnya
                </h4>

                <?php foreach($groupBerita as $tahun => $bulanData): ?>

                    <div class="sidebar-year">

                        <h5>
                            <?= $tahun ?>
                        </h5>

                        <?php foreach($bulanData as $bulan => $listBerita): ?>

                            <div class="sidebar-month">

                                <h6>
                                    <?= $bulan ?>
                                </h6>

                                <ul class="berita-list">

                                    <?php foreach($listBerita as $item): ?>

                                        <li>

                                            <a href="<?= base_url('beritapneumonia/viewUser/' . $item['id_berita']) ?>">

                                                • <?= $item['judul_berita'] ?>

                                            </a>

                                        </li>

                                    <?php endforeach; ?>

                                </ul>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>

<?= $this->include('layout/footer') ?>