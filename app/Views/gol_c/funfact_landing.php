<?php $this->setVar('penyakit', 'pneumonia'); ?>
<?= $this->include('layout/header') ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<?php
$funfact = $funfact ?? null;
?>

<div class="container py-2">

<!-- HEADER -->
<div class="p-4 text-center text-white rounded-4 mb-4"
style="
background:#17c3cf;
box-shadow:0 6px 14px rgba(0,0,0,0.10);
">

<h1 class="fw-bold mb-0" style="font-size:56px;">
Funfact Pneumonia
</h1>

<p class="mb-0" style="font-size:20px;">
Kumpulan informasi menarik seputar pneumonia
</p>

</div>

<?php if($funfact): ?>

<div class="card border-0 shadow rounded-4 overflow-hidden">

<div class="p-4 p-md-5">

<!-- JUDUL -->
<h1 class="fw-bold text-left mb-s"
style="
font-size:30px;
line-height:1.2;
color:#0f172a;
">

<?= $funfact['judul_funfact'] ?>

</h1>

<!-- TANGGAL -->
<p class="text-muted mb-1">
<?= !empty($funfact['tanggal_funfact']) 
? date('d F Y', strtotime($funfact['tanggal_funfact'])) 
: '-' ?>
</p>

<p class="text-muted mb-4">
Penulis: <?= esc($funfact['penulis'] ?? '-') ?>
</p>

<!-- GAMBAR -->
<div class="text-center mb-3">

<img src="<?= base_url('uploads/funfact/' . ($funfact['gambar_funfact'] ?: 'default.jpg')) ?>"
style="
width:100%;
max-width:530px;
max-height:350px;
object-fit:cover;
border-radius:22px;
box-shadow:0 6px 18px rgba(0,0,0,0.12);
">

</div>

<!-- ISI FUNFACT -->
<div style="
font-size:18px;
line-height:2;
color:#333;
text-align:justify;
">

<?= nl2br(strip_tags($funfact['deskripsi_funfact'])) ?>

</div>

<!-- BUTTON -->
<div class="mt-5">

<a href="<?= base_url('pneumonia') ?>"
class="btn w-100 text-white fw-bold py-3"
style="
background:#19c6cf;
border-radius:14px;
font-size:20px;
">

← Kembali

</a>

</div>

</div>

</div>

<?php else: ?>

<div class="text-center py-5">

<h3>Belum ada funfact</h3>

</div>

<?php endif; ?>

</div>

<style>

*{
    font-family:'Poppins', sans-serif;
}

</style>

<?= $this->include('layout/footer') ?>