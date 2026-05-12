<?= $this->extend('layout/dashboard_layout_admin'); ?>

<?php
$title = 'FunFact';
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
.funfact-container{
    background:#bfe3e5;
    border-radius:28px;
    padding:40px;
    position:relative;
}

/* FRAME */
.funfact-frame{
    border:3px solid #009ea3;
    border-radius:22px;
    padding:35px 40px;
}

/* HEADER */
.funfact-header-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    margin-bottom:30px;
}

/* JUDUL */
.funfact-header{
    flex:1;
    text-align:center;
    font-size:30px;
    font-weight:800;
    color:#111;
}

/* BUTTON BACK */
.back-btn{
    width:48px;
    height:48px;
    border-radius:12px;
    background:#009ea3;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    font-size:20px;
    transition:.2s;
    flex-shrink:0;
}

.back-btn:hover{
    background:#00848a;
    color:white;
    transform:scale(1.03);
}

/* TOP */
.funfact-top{
    display:flex;
    gap:40px;
    align-items:stretch;
    flex-wrap:wrap;
}

/* WRAPPER GAMBAR */
.funfact-img-wrapper{
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
.funfact-img{
    width:100%;
    height:100%;
    object-fit:contain;
}

/* RIGHT */
.funfact-right{
    flex:1;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    padding-right:20px;
    min-width:250px;
}

/* RINGKASAN */
.funfact-highlight{
    font-size:15px;
    color:#333;
    margin-bottom:15px;
    line-height:1.8;
    text-align:justify;
    word-break:break-word;
}

/* META */
.funfact-meta{
    display:flex;
    justify-content:space-between;
    gap:20px;
    flex-wrap:wrap;
    font-size:13px;
    color:#666;
    padding-bottom:5px;
}

/* GARIS */
.funfact-divider{
    height:2px;
    background:#009ea3;
    margin:25px 0;
}

/* ISI FUNFACT */
.funfact-content{
    font-size:18px;
    line-height:2;
    text-align:justify;
    color:#222;
    display:block;
    width:100%;
    overflow:hidden;
}

/* GAMBAR DI DALAM ISI */
.funfact-content img{
    display:block;
    max-width:100%;
    height:auto;
    margin:25px auto;
    border-radius:12px;
}

/* SUMBER */
.funfact-sumber{
    margin-top:30px;
    padding-top:20px;
    border-top:2px solid #009ea3;
    font-size:15px;
    line-height:1.8;
    word-break:break-word;
    display:block;
    width:100%;
    clear:both;
}

.funfact-sumber b{
    display:block;
    margin-bottom:8px;
    font-size:16px;
    color:#111;
}

.funfact-sumber a{
    display:block;
    color:#007bff;
    text-decoration:none;
    word-break:break-word;
}

.funfact-sumber a:hover{
    text-decoration:underline;
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

/* RESPONSIVE */
@media(max-width:768px){

    .funfact-container{
        padding:20px;
    }

    .funfact-frame{
        padding:25px 20px;
    }

    .funfact-header{
        font-size:22px;
    }

    .funfact-top{
        flex-direction:column;
    }

    .funfact-img-wrapper{
        width:100%;
        height:220px;
        margin-left:0;
    }

    .funfact-right{
        padding-right:0;
    }

    .funfact-content{
        font-size:16px;
    }

    .funfact-meta{
        flex-direction:column;
        gap:8px;
    }

    .funfact-sumber{
        font-size:14px;
    }
}

</style>

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<div class="funfact-container">

    <!-- ICON -->
    <img src="<?= base_url('img/nyamuk.png') ?>" class="icon-nyamuk">
    <img src="<?= base_url('img/air.png') ?>" class="icon-air">

    <div class="funfact-frame">

        <!-- HEADER -->
        <div class="funfact-header-wrapper">

            <!-- JUDUL -->
            <div class="funfact-header">
                <?= !empty($funfact['judul_funfact']) 
                    ? esc($funfact['judul_funfact']) 
                    : '-' ?>
            </div>


        </div>

        <!-- TOP -->
        <div class="funfact-top">

            <!-- GAMBAR -->
            <?php if(!empty($funfact['gambar_funfact'])): ?>

                <div class="funfact-img-wrapper">

                    <img src="<?= base_url('uploads/funfact/'.$funfact['gambar_funfact']) ?>"
                         class="funfact-img">

                </div>

            <?php endif; ?>

            <!-- TEKS -->
            <div class="funfact-right">

                <!-- RINGKASAN -->
                <div class="funfact-highlight">

                    <?= !empty($funfact['deskripsi_funfact']) 
                        ? esc($funfact['deskripsi_funfact']) 
                        : '-' ?>

                </div>

                <!-- META -->
                <div class="funfact-meta">

                <span>
                    <?= !empty($funfact['penulis']) 
                        ? esc($funfact['penulis']) 
                        : '-' ?>
                </span>
                    <span>

<span>

<?php
$bulan = [
    1 => 'Januari','Februari','Maret','April','Mei','Juni',
    'Juli','Agustus','September','Oktober','November','Desember'
];
?>

<?php if(!empty($funfact['tanggal_funfact'])) : ?>

    <?php
        $tanggal = strtotime($funfact['tanggal_funfact']);

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
        <div class="funfact-divider"></div>

        <!-- ISI -->
        <div class="funfact-content">

            <?= !empty($funfact['isi_funfact']) 
                ? $funfact['isi_funfact'] 
                : '-' ?>

        </div>

        <!-- SUMBER -->
        <?php if(!empty($funfact['url'])): ?>

            <div class="funfact-sumber">

                <b>Sumber:</b><br>

                <a href="<?= esc($funfact['url']) ?>" target="_blank">

                    <?= esc($funfact['url']) ?>

                </a>

            </div>

        <?php endif; ?>

    </div>

</div>

<script>

window.history.replaceState(
    {},
    '',
    "<?= site_url('funfact?status=upload') ?>"
);

</script>

<?= $this->endSection(); ?>