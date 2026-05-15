<?php
$this->setVar('penyakit', 'diare');
?>

<?= $this->include('layout/header') ?>
<style>
body{
    background: linear-gradient(135deg,#dff7f7,#c8f0ef);
    font-family:'Poppins',sans-serif;
}

.detail-wrap{
    max-width:1200px;
    margin:50px auto;
    background:white;
    border:4px solid #1ea7ff;
    padding:50px;
    border-radius:8px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.detail-title{
    font-size:42px;
    font-weight:800;
    color:#111;
    margin-bottom:30px;
    text-transform:uppercase;
}

.detail-image{
    width:500px;
    max-width:100%;
    border-radius:12px;
    display:block;
    margin:0 auto 40px;
    object-fit:cover;
}

.detail-content{
    font-size:18px;
    line-height:2;
    color:#333;
    text-align:justify;
}

.detail-meta{
    margin-top:40px;
    font-size:14px;
    color:#777;
}

.btn-back{
    display:inline-block;
    margin-top:30px;
    padding:14px 50px;
    background:#11c5c9;
    color:white;
    text-decoration:none;
    border-radius:12px;
    font-weight:700;
    float:right;
}
</style>

<div class="detail-wrap">

    <h1 class="detail-title">
        <?= esc($berita['judul_berita']) ?>
    </h1>

    <img
        src="<?= base_url('uploads/berita/' . $berita['gambar_berita']) ?>"
        class="detail-image"
    >

    <div class="detail-content">
        <?= nl2br(esc($berita['isi_berita'])) ?>
    </div>

    <div class="detail-meta">
        Terakhir diperbarui:
        <?= date('d F Y', strtotime($berita['tanggal_berita'])) ?>
        <br>
        Penulis:
        <?= esc($berita['penulis']) ?>
    </div>

    <a href="<?= base_url('diare') ?>" class="btn-back">
        Kembali
    </a>

</div>

<?= $this->include('layout/footer') ?>