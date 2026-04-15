<?= $this->include('layout/header') ?>

<section class="container mt-5">

<h4 class="fw-bold mb-4">Hasil Skrining Diare</h4>

<?php
$skor = array_sum(array_filter($data, fn($k)=>str_starts_with($k,'q'), ARRAY_FILTER_USE_KEY));

if($skor >= 7){
    $hasil = "Risiko Tinggi Diare";
    $warna = "danger";
} elseif($skor >= 4){
    $hasil = "Risiko Sedang";
    $warna = "warning";
} else {
    $hasil = "Risiko Rendah";
    $warna = "success";
}
?>

<div class="alert alert-<?= $warna ?> text-center fw-bold">
<?= $hasil ?>
</div>

<h5>Rekomendasi:</h5>

<ul>
<li>Minum air oralit</li>
<li>Hindari makanan pedas & kotor</li>
<li>Jaga kebersihan tangan</li>
<li>Segera ke fasilitas kesehatan jika parah</li>
</ul>

<a href="<?= base_url('pdf-diare') ?>" class="btn btn-teal">
Cetak PDF
</a>

</section>

<?= $this->include('layout/footer') ?>