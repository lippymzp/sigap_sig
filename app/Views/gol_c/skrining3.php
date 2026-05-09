<?= $this->include('layout/header') ?>

<?php

$nama = $nama ?? '';
$nik = $nik ?? '';
$jenis_kelamin = $jenis_kelamin ?? '';
$tanggal_lahir = $tanggal_lahir ?? '';
$kategori_usia = $kategori_usia ?? '';
$provinsi = $provinsi ?? '';
$kabupaten = $kabupaten ?? '';
$kecamatan = $kecamatan ?? '';
$kelurahan = $kelurahan ?? '';

$hasil = $hasil ?? 'Prediksi Tidak Diketahui';
$alasan = $alasan ?? '';
?>

<!DOCTYPE html>
<html>
<head>
<title>Hasil Skrining Pneumonia</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f7fa;
}

.card-custom{
    max-width:1000px;
    margin:40px auto;
    background:white;
    border-radius:20px;
    padding:35px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

.section-title{
    font-weight:bold;
    margin-top:30px;
    margin-bottom:15px;
    color:#222;
}

.data-box{
    background:#f8f9fa;
    border-radius:15px;
    padding:25px;
}

.form-control[readonly]{
    background:white;
}

.table th{
    background:#00BBC2;
    color:white;
}

.hasil-box{
    border-radius:15px;
    padding:25px;
    text-align:center;
    color:white;
    font-size:24px;
    font-weight:bold;
}

.hasil-pneumonia{
    background:linear-gradient(135deg,#ff4d4d,#c91818);
}

.hasil-tidak{
    background:linear-gradient(135deg,#00c896,#007f6b);
}

.hasil-tidakdiketahui{
    background:linear-gradient(135deg,#ffb84d,#cc8400);
}

.tips-card{
    border-radius:18px;
    overflow:hidden;
    margin-top:20px;
    box-shadow:0 5px 18px rgba(0,0,0,0.08);
}

.tips-header{
    padding:15px 20px;
    color:white;
    font-weight:bold;
    font-size:17px;
}

.bg-danger-modern{
    background:linear-gradient(135deg,#ff6b6b,#d64545);
}

.bg-success-modern{
    background:linear-gradient(135deg,#00BBC2,#007f6b);
}

.bg-warning-modern{
    background:linear-gradient(135deg,#ffc107,#cc8a00);
}

.tips-content{
    background:#fff;
    padding:20px;
}

.btn-wrapper{
    display:flex;
    justify-content:center;
    gap:15px;
    margin-top:35px;
}

.btn-custom{
    width:180px;
    height:50px;
    border-radius:10px;
    font-weight:600;
}

.footer-text{
    text-align:center;
    margin-top:30px;
    color:gray;
    font-size:14px;
}

</style>
</head>

<body>

<div class="card-custom">

<h3 class="text-center mb-4">
    <b>Hasil Skrining Pneumonia</b>
</h3>

<!-- INFORMASI -->
<div class="section-title">Informasi Pasien</div>

<div class="data-box">

<div class="row">

<div class="col-md-6">

<label>Nama</label>
<input type="text" class="form-control mb-3" value="<?= $nama ?>" readonly>

<label>NIK</label>
<input type="text" class="form-control mb-3" value="<?= $nik ?>" readonly>

<label>Jenis Kelamin</label>
<input type="text" class="form-control mb-3" value="<?= $jenis_kelamin ?>" readonly>

<label>Tanggal Lahir</label>
<input type="text" class="form-control mb-3" value="<?= $tanggal_lahir ?>" readonly>

</div>

<div class="col-md-6">

<label>Provinsi</label>
<input type="text" class="form-control mb-3" value="<?= $provinsi ?>" readonly>

<label>Kabupaten</label>
<input type="text" class="form-control mb-3" value="<?= $kabupaten ?>" readonly>

<label>Kecamatan</label>
<input type="text" class="form-control mb-3" value="<?= $kecamatan ?>" readonly>

<label>Kelurahan</label>
<input type="text" class="form-control mb-3" value="<?= $kelurahan ?>" readonly>

</div>

</div>

</div>

<!-- RINCIAN -->
<div class="section-title">Rincian Jawaban</div>

<table class="table table-bordered">

<thead>
<tr>
    <th width="5%">No</th>
    <th>Pertanyaan</th>
    <th width="15%">Jawaban</th>
</tr>
</thead>

<tbody>

<?php

$pertanyaan = [
    1 => "Apakah Anda mengalami batuk dalam 7 hari terakhir?",
    2 => "Apakah Anda mengeluarkan dahak saat batuk?",
    3 => "Apakah Anda mengalami sesak napas?",
    4 => "Apakah Anda merasakan nyeri dada saat bernapas atau batuk?",
    5 => "Apakah Anda mengalami mual atau muntah?",
    6 => "Apakah Anda merasa lemas?",
    7 => "Apakah nafsu makan Anda menurun?",
    8 => "Apakah Anda mengalami demam?",
    9 => "Apakah napas terasa cepat?",
    10 => "Apakah terdengar bunyi dahak saat bernapas?",
    11 => "Apakah terdengar bunyi mengi?"
];

foreach($pertanyaan as $no => $text):

    $jawaban = ${"p".$no} ?? 0;

?>

<tr>

<td class="text-center"><?= $no ?></td>

<td><?= $text ?></td>

<td class="text-center">

<?php if($jawaban == 1): ?>

<span class="badge bg-success">Ya</span>

<?php else: ?>

<span class="badge bg-danger">Tidak</span>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>
</table>

<!-- HASIL -->
<div class="section-title">Hasil Prediksi</div>

<?php

$classHasil = 'hasil-tidakdiketahui';

if($hasil == 'Risiko Pneumonia'){
    $classHasil = 'hasil-pneumonia';
}
elseif($hasil == 'Tidak Risiko Pneumonia'){
    $classHasil = 'hasil-tidak';
}

?>

<div class="hasil-box <?= $classHasil ?>">
    <?= $hasil ?>
</div>

<p class="text-center mt-3 text-muted">
    <?= $alasan ?>
</p>

<!-- REKOMENDASI -->

<div class="section-title">Rekomendasi</div>

<?php if($hasil == 'Risiko Pneumonia'): ?>

<div class="tips-card">

<div class="tips-header bg-danger-modern">
🚨 Risiko Pneumonia
</div>

<div class="tips-content">

<p>
Berdasarkan hasil skrining C4.5 terdapat indikasi pneumonia.
</p>

<ul>
    <li>Segera lakukan pemeriksaan medis</li>
    <li>Istirahat cukup</li>
    <li>Perbanyak minum air putih</li>
    <li>Gunakan masker bila batuk</li>
    <li>Hindari asap rokok</li>
</ul>

</div>
</div>

<?php elseif($hasil == 'Tidak Risiko Pneumonia'): ?>

<div class="tips-card">

<div class="tips-header bg-success-modern">
✅ Tidak Terindikasi Pneumonia
</div>

<div class="tips-content">

<p>
Hasil skrining menunjukkan risiko pneumonia rendah.
</p>

<ul>
    <li>Tetap menjaga kesehatan</li>
    <li>Konsumsi makanan bergizi</li>
    <li>Olahraga rutin</li>
    <li>Istirahat cukup</li>
    <li>Tetap waspada bila muncul gejala</li>
</ul>

</div>
</div>

<?php else: ?>

<div class="tips-card">

<div class="tips-header bg-warning-modern">
⚠️ Prediksi Tidak Diketahui
</div>

<div class="tips-content">

<p>
Data gejala belum cukup untuk menentukan hasil prediksi.
</p>

<ul>
    <li>Pastikan jawaban sudah benar</li>
    <li>Lakukan skrining ulang</li>
    <li>Konsultasi ke tenaga kesehatan bila perlu</li>
</ul>

</div>
</div>

<?php endif; ?>

<!-- BUTTON -->

<div class="btn-wrapper">

<button onclick="window.print()" class="btn btn-dark btn-custom">
🖨 Cetak
</button>

<a href="<?= base_url('/skriningpneumonia') ?>" class="btn btn-outline-info btn-custom">
Kembali
</a>

<a href="<?= base_url('/') ?>" class="btn btn-info text-white btn-custom">
Selesai
</a>

</div>

<div class="footer-text">
Laporan otomatis SIGAP - Sistem Skrining Pneumonia
</div>

</div>

</body>
</html>

<?= $this->include('layout/footer') ?>