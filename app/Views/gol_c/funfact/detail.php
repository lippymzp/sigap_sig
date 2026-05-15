<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?> 
<?= $this->section('content') ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
.isi-funfact{
    width:100%;
    text-align:justify;
    line-height:1.9;
    font-size:16px;
}

/* 🔥 INI KUNCI UTAMA */
.isi-funfact *{
    max-width:100% !important;
    width:auto !important;
}

/* biar rapi */
.isi-funfact p{
    margin-bottom:14px;
}

*{
    font-family:'Poppins', sans-serif;
}
</style>

<?php 
$funfact = $funfact ?? [];

// 🔥 FIX: paksa jadi string biar ga error
$url = is_array($funfact['url'] ?? null) ? '' : ($funfact['url'] ?? '');
$isi = is_array($funfact['isi_funfact'] ?? null) ? '' : ($funfact['isi_funfact'] ?? '');
$ringkasan = is_array($funfact['deskripsi_funfact'] ?? null) ? '' : ($funfact['deskripsi_funfact'] ?? '');
?>

<div class="card border-0 shadow-sm p-3 rounded-4">

<!-- ATAS -->
<div class="row align-items-center mb-4">

<div class="col-md-5">
<img src="<?= base_url('uploads/funfact/' . (!empty($funfact['gambar_funfact']) ? $funfact['gambar_funfact'] : 'default.jpg')) ?>"
style="width:100%;height:240px;object-fit:cover;border-radius:16px;">
</div>

<div class="col-md-7">
<h2 class="fw-bold mb-2" style="line-height:1.4;">
<?= esc((string)($funfact['judul_funfact'] ?? '')) ?>
</h2>

<p class="text-muted mb-1">
<?= !empty($funfact['tanggal_funfact']) 
? date('d F Y', strtotime($funfact['tanggal_funfact'])) 
: '-' ?>
</p>

<p class="text-muted mb-4">
Penulis: <?= esc($funfact['penulis'] ?? '-') ?>
</p>
</div>

</div>

<!-- BAWAH -->
<div style="line-height:1.9;font-size:16px;">

<?php if (!empty($url) && filter_var($url, FILTER_VALIDATE_URL)): ?>

<div style="
background:#f5f9fa;
padding:18px;
border-radius:12px;
border:1px solid #dbeaea;
">

<p style="margin-bottom:8px;font-weight:600;">
🔗 Sumber Funfact Eksternal
</p>

<a href="<?= esc((string)$url) ?>" target="_blank"
style="
display:inline-block;
background:#11c5d8;
color:#fff;
padding:10px 16px;
border-radius:8px;
text-decoration:none;
font-weight:600;
">
Buka Funfact
</a>

<p style="margin-top:10px;font-size:13px;color:#888;">
<?= esc((string)$url) ?>
</p>

</div>

<?php else: ?>

<div class="isi-funfact">
<?= !empty($isi) ? $isi : $ringkasan ?>
</div>

<?php endif; ?>

</div>

<a href="<?= base_url('pneumonia/funfact') ?>"
class="btn text-white mt-4"
style="
background:#11c5d8;
width:100%;
padding:12px;
border-radius:10px;
font-weight:600;
">
← Kembali
</a>

</div>

<?= $this->endSection() ?>