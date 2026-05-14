<?= $this->extend('layout/dashboard_layout_pneumonia_admin'); ?>

<?php
$title = 'berita';
?>

<?= $this->section('style'); ?>
<style>

body{
    background:#f4f7f7;
    font-family:'Poppins', sans-serif;
}

/* TITLE */
.page-title{
    font-size:34px;
    font-weight:700;
    margin-bottom:20px;
}

/* CONTAINER */
.berita-container{
    background:#bfe3e5;
    border-radius:28px;
    padding:40px;
    position:relative;
}

/* FRAME */
.berita-frame{
    border:3px solid #009ea3;
    border-radius:22px;
    padding:35px 40px;
}

/* HEADER */
.berita-header-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    margin-bottom:30px;
}

/* JUDUL */
.berita-header{
    flex:1;
    text-align:center;
    font-size:30px;
    font-weight:800;
    color:#111;
}

/* BUTTON BACK */
.back-btn{
    display: flex;
    align-items: center;
    justify-content: center; /* Teks di tengah */
    gap: 10px;
    background: #11c5d8; /* Warna cyan sesuai screenshot */
    color: white;
    width: 100%; /* MEMBUAT FULL WIDTH */
    padding: 15px 0;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    transition: background 0.3s ease;
    border: none;
}

.back-btn:hover{
    background:#00848a;
    color:white;
    text-decoration: none;
    transform:scale(1.03);
}

/* TOP */
.berita-top{
    display:flex;
    gap:40px;
    align-items:stretch;
    flex-wrap:wrap;
}

/* WRAPPER GAMBAR */
.berita-img-wrapper{
    width:300px;
    height:180px;
    background:#fff;
    border-radius:14px;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    margin-left:25px;
    flex-shrink:0;
}

/* GAMBAR */
.berita-img{
    width:100%;
    height:100%;
    object-fit:contain;
}

/* RIGHT */
.berita-right{
    flex:1;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    padding-right:20px;
    min-width:250px;
}

/* RINGKASAN */
.berita-highlight{
    font-size:15px;
    color:#333;
    margin-bottom:15px;
    line-height:1.8;
}

/* META */
.berita-meta{
    display:flex;
    justify-content:space-between;
    gap:20px;
    flex-wrap:wrap;
    font-size:13px;
    color:#666;
    padding-bottom:5px;
}

/* GARIS */
.berita-divider{
    height:2px;
    background:#009ea3;
    margin:25px 0;
}

/* ISI */
.berita-content{
    font-size:18px;
    line-height:2;
    text-align:justify;
    color:#222;
}

/* SUMBER */
.berita-box{
    margin-top:40px;
    font-size:14px;
    line-height:1.8;
    word-break:break-word;
}

.berita-sumber a{
    color:#007bff;
    text-decoration:none;
}

.berita-sumber a:hover{
    text-decoration:underline;
}
.sumber-title{
    font-weight:600;
    margin-bottom:10px;
}
.url-text{
    color:#555;
    margin-top:8px;
    word-break:break-all;
}

/* ICON */
.icon-nyamuk{
    position:absolute;
    top:5px;
    right:15px;
    width:75px;
}

.icon-air{
    position:absolute;
    bottom:5px;
    right:15px;
    width:120px;
}
.btn-sumber{
    display:inline-block;
    background:#11c5d8;
    color:#fff;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
}

/* RESPONSIVE */
@media(max-width:768px){

    .berita-container{
        padding:20px;
    }

    .berita-frame{
        padding:25px 20px;
    }

    .berita-header{
        font-size:22px;
    }

    .berita-top{
        flex-direction:column;
    }

    .berita-img-wrapper{
        width:100%;
        height:220px;
        margin-left:0;
    }

    .berita-right{
        padding-right:0;
    }

    .berita-content{
        font-size:16px;
    }

    .berita-meta{
        flex-direction:column;
        gap:8px;
    }
}

</style>
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<div class="berita-container">

    <!-- ICON -->
    <img src="<?= base_url('img/nyamuk.png') ?>" class="icon-nyamuk">
    <img src="<?= base_url('img/air.png') ?>" class="icon-air">

    <div class="berita-frame">

        <!-- HEADER -->
        <div class="berita-header-wrapper">

            <!-- JUDUL -->
            <div class="berita-header">
                <?= !empty($beritapneumonia['judul_berita']) 
                    ? esc($beritapneumonia['judul_berita']) 
                    : '-' ?>
            </div>


        </div>

        <!-- TOP -->
        <div class="berita-top">

            <!-- GAMBAR -->
            <?php if(!empty($beritapneumonia['gambar_berita'])): ?>

                <div class="berita-img-wrapper">

                    <img src="<?= base_url('uploads/berita/'.$beritapneumonia['gambar_berita']) ?>"
                         class="berita-img">

                </div>

            <?php endif; ?>

            <!-- TEKS -->
            <div class="berita-right">

                <!-- RINGKASAN -->
                <div class="berita-highlight">

                    <?= !empty($beritapneumonia['deskripsi_berita']) 
                        ? esc($beritapneumonia['deskripsi_berita']) 
                        : '-' ?>

                </div>

                <!-- META -->
                <div class="berita-meta">

                    <span>
                        <b>Penulis:</b>
                        <?= !empty($beritapneumonia['penulis']) 
                            ? esc($beritapneumonia['penulis']) 
                            : '-' ?>
                    </span>

                    <span>

<?php
$bulan = [
    1 => 'Januari','Februari','Maret','April','Mei','Juni',
    'Juli','Agustus','September','Oktober','November','Desember'
];
?>

<b>Tanggal:</b>

<?php if(!empty($beritapneumonia['tanggal_berita'])) : ?>

    <?php
        $tanggal = strtotime($beritapneumonia['tanggal_berita']);

        $hari  = date('d', $tanggal);
        $bulanIndo = $bulan[(int)date('m', $tanggal)];
        $tahun = date('Y', $tanggal);

        echo $hari . ' ' . $bulanIndo . ' ' . $tahun;
    ?>

<?php else : ?>

    -

<?php endif; ?>

                    </span>

                </div>

            </div>

        </div>

        <!-- GARIS -->
        <div class="berita-divider"></div>

        <!-- ISI -->
        <div class="berita-content">

            <?= !empty($beritapneumonia['isi_berita']) 
                ? $beritapneumonia['isi_berita'] 
                : '-' ?>

        </div>

        <!-- SUMBER -->
        <!-- SUMBER -->
        <?php $url = $beritapneumonia['url_berita'] ?? ''; ?>

        <?php if (!empty($url)) : ?>

            <div class="sumber-box">

                <div class="sumber-title">
                    <i class="fa-solid fa-link"></i>
                    Sumber Berita Eksternal<br><br>
                </div>

                <a href="<?= esc((string)$url) ?>" 
                   target="_blank"
                   class="btn-sumber">

                    Buka Berita

                </a>

                <div class="url-text">
                    <br><?= esc((string)$url) ?>
                </div>

            </div>

        <?php endif; ?>

        <!-- TOMBOL KEMBALI DI BAWAH -->
        <div class="berita-footer">
            <br><br><a href="<?= base_url('beritapneumonia/admin') ?>" class="back-btn">
                <i class="fa-solid"></i> Kembali
            </a>
        </div>

    </div>

</div>

<script>

window.history.replaceState(
    {},
    '',
    "<?= site_url('berita?status=upload') ?>"
);

</script>

<?= $this->endSection(); ?>