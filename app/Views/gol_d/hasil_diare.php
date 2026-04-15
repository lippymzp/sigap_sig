<?= $this->include('layout/header') ?>

<section class="container mt-5">

<h4 class="fw-bold mb-4">
Hasil Skrining Diare Anda
</h4>

<!-- =========================
   CARD UTAMA
========================= -->
<div class="card shadow-lg p-4" style="border-radius:20px; border:2px solid #40EDD0;">

<!-- =========================
   INFORMASI UMUM
========================= -->
<h6 class="fw-bold mb-3">Informasi Umum</h6>

<div class="row g-3 mb-4">

<div class="col-md-6">
<input class="form-control mb-2" value="<?= $data['nama'] ?>" readonly>
<input class="form-control mb-2" value="<?= $data['nik'] ?>" readonly>
<input class="form-control mb-2" value="<?= $data['jk'] ?>" readonly>
<input class="form-control mb-2" value="<?= $data['tgl'] ?>" readonly>
<input class="form-control mb-2" value="<?= $data['usia'] ?>" readonly>
</div>

<div class="col-md-6">
<input class="form-control mb-2 bg-info text-white" value="<?= date('d-m-Y') ?>" readonly>
<input class="form-control mb-2" value="<?= $data['prov'] ?>" readonly>
<input class="form-control mb-2" value="<?= $data['kab'] ?>" readonly>
<input class="form-control mb-2" value="<?= $data['kec'] ?>" readonly>
<input class="form-control mb-2" value="<?= $data['kel'] ?>" readonly>
<input class="form-control mb-2" value="<?= $data['kodepos'] ?>" readonly>
</div>

</div>

<!-- =========================
   RINCIAN JAWABAN
========================= -->
<h6 class="fw-bold mb-2">Rincian Jawaban</h6>

<table class="table table-bordered text-center">
<thead style="background:#2CCFC0; color:white;">
<tr>
<th>No</th>
<th>Pertanyaan</th>
<th>Jawaban</th>
</tr>
</thead>

<tbody>

<?php
$pertanyaan = [
"Frekuensi BAB > 3x?",
"Tinja cair?",
"Nyeri perut?",
"Ada darah/lendir?",
"Mual/muntah?",
"Lemas/dehidrasi?",
"Demam?",
"Makan tidak higienis?",
"Air tidak matang?",
"Kontak penderita?"
];

foreach($pertanyaan as $i => $p):
$jawaban = $data["q".$i] ?? 0;
?>

<tr>
<td><?= $i+1 ?></td>
<td class="text-start"><?= $p ?></td>
<td>
<span class="badge <?= $jawaban ? 'bg-danger' : 'bg-success' ?>">
<?= $jawaban ? 'Ya' : 'Tidak' ?>
</span>
</td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<!-- =========================
   HASIL
========================= -->
<div class="mt-4">

<h6 class="fw-bold">Hasil</h6>

<div class="alert alert-success text-center fw-bold" style="border-radius:10px;">
<?= $hasil ?>
</div>

</div>

<!-- =========================
   REKOMENDASI
========================= -->
<div class="mt-3">

<h6 class="fw-bold">Rekomendasi</h6>

<div class="p-3" style="border:1px solid #ccc; border-radius:10px;">
<?php if($skor >= 7): ?>
Segera periksakan ke fasilitas kesehatan. Minum oralit dan hindari makanan kotor.
<?php elseif($skor >= 4): ?>
Perbanyak cairan dan jaga kebersihan makanan.
<?php else: ?>
Kondisi relatif aman, tetap jaga pola hidup sehat.
<?php endif; ?>
</div>

</div>

<!-- =========================
   TIPS KESEHATAN
========================= -->
<div class="mt-4">

<div style="background:#2CCFC0; color:white; padding:10px; border-radius:10px 10px 0 0;">
<b>Tips Kesehatan</b>
</div>

<div style="background:#e9f5ff; padding:15px; border-radius:0 0 10px 10px;">
<ul>
<li>Konsumsi makanan bersih dan matang</li>
<li>Minum air yang cukup</li>
<li>Istirahat yang cukup</li>
<li>Jaga kebersihan lingkungan</li>
</ul>
</div>

</div>

<!-- =========================
   BUTTON
========================= -->
<div class="mt-4 text-center">
<a href="<?= base_url('pdf-diare') ?>" class="btn btn-teal px-4 py-2">
🖨 Cetak Hasil
</a>
</div>

</div>

</section>

<?= $this->include('layout/footer') ?>