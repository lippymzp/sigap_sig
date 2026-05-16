<?php $this->setVar('penyakit', 'pneumonia'); ?>
<?php 
$this->setVar('show_footer_maskot', true);
$this->setVar('footer_maskot', 'cynex.png');
?>
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
$rt_rw = $rt_rw ?? '';

$hasil = $hasil ?? '';
$alasan = $alasan ?? '';
$totalSkor = $totalSkor ?? 0;
$kategori = ($kategori_usia <= 19) ? 'Anak-anak' : 'Dewasa';
?>

<!DOCTYPE html>
<html>
<head>
<title>Hasil Skrining</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
body {
    background: #ffffff;
}

/* CARD */
.card-custom {
    border-radius: 15px;
    border: 2px solid #00BBC2;
    background: #f1f3f5;
    padding: 40px;
    max-width: 1000px;
    margin: 40px auto;
}

/* TITLE */
.section-title {
    font-weight: bold;
    margin: 25px 0 15px;
}

/* BOX */
.data-box {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

/* HASIL */
.hasil-box {
    background: #00BBC2;
    color: white;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    font-weight: bold;
    font-size: 18px;
}

/* TABLE */
.table th {
    background: #00BBC2;
    color: white;
}
.badge {
    padding: 8px 15px;
    font-size: 14px;
}

/* TIPS */
.tips-box {
    border-radius: 12px;
    overflow: hidden;
    margin-top: 10px;
}

.tips-header {
    background: #00BBC2;
    color: white;
    padding: 10px 15px;
    font-weight: bold;
}

.tips-content {
    background: #cfe8f3;
    padding: 15px;
}

.tips-content ul {
    margin: 0;
    padding-left: 20px;
}

.form-control[readonly] {
    background-color: #f8f9fa;
    border-radius: 10px;
}

/* FOOTER */
.footer-text {
    text-align: center;
    margin-top: 30px;
    color: gray;
    font-size: 14px;
}
.btn-custom {
    height: 55px;
    border-radius: 12px;
    font-weight: 600;
}


.btn-wrapper {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 40px;
}

.btn-kembali, .btn-selesai, .btn-cetak {
    width: 160px;
    height: 50px;
    border-radius: 10px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

/* warna */
.btn-kembali {
    background: white;
    border: 2px solid #00BBC2;
    color: #00BBC2;
}

.btn-selesai {
    background: #00BBC2;
    color: white;
}

.btn-cetak {
    width: 200px;
    height: 50px;
    background: #555;
    color: white;
    border-radius: 10px;
    font-weight: 600;
    
}
@media print {
    .btn-wrapper, .btn-cetak {
        display: none;
    }
}
.btn-cetak-full {
    width: 100%;                 /* full lebar */
    height: 50px;
    background: #00BBC2;         /* warna tosca */
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
}

.btn-cetak-full:hover {
    opacity: 0.9;
}
/* TABLE ROUNDED */
.table {
    border-radius: 12px;
    overflow: hidden;
}

/* HEADER */
.table thead tr th:first-child {
    border-top-left-radius: 12px;
}

.table thead tr th:last-child {
    border-top-right-radius: 12px;
}

/* FOOTER (baris terakhir) */
.table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

.table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}
/* BUTTON STYLE */ 
.btn-kembali { 
    background: white; 
    color: #00BBC2; 
    box-shadow: 0 2px 8px rgba(0,0,0,0.1); } 

.btn-selesai { 
    background: #00BBC2; 
    color: white; 
    box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

/* SPACING BIAR NGGAK RAPET */
.section-title {
    margin-top: 35px;
}

.data-box {
    margin-bottom: 25px;
}

.table {
    margin-bottom: 25px;
}

.hasil-box {
    margin-bottom: 15px;
}

.tips-box {
    margin-top: 20px;
    margin-bottom: 30px;
}

.cetak-wrapper {
    margin-top: 20px;
}
* {
    font-family: 'Poppins', sans-serif;
}

/* ===== CARD MODERN ===== */
.tips-card {
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    margin-top: 20px;
    animation: fadeUp 0.6s ease-in-out;
    transition: 0.3s;
}

/* animasi masuk */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* HEADER */
.tips-header-modern {
    padding: 18px 20px;
    font-weight: 600;
    color: white;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 16px;
}

/* CONTENT */
.tips-content-modern {
    padding: 18px 22px;
    background: #f9fcfc;
}

.tips-content-modern p {
    margin-bottom: 10px;
    color: #444;
}

.tips-content-modern ul {
    padding-left: 18px;
}

.tips-content-modern li {
    margin-bottom: 8px;
    transition: 0.2s;
}

.tips-content-modern li:hover {
    transform: translateX(5px);
}

/* VARIAN WARNA */
.bg-danger-modern {
    background: linear-gradient(135deg, #ff6b6b, #d64545);
}

.bg-warning-modern {
    background: linear-gradient(135deg,  #ffd86b, #c9a227);
}

.bg-success-modern {
    background: linear-gradient(135deg, #00BBC2, #007f6b);
}

.footer-maskot{
    width:250px !important;
}
</style>


</head>

<body>


<div class="card-custom">

<!-- JUDUL -->
<h4 class="text-center mb-4">
    <b>Hasil Skrining Kesehatan Anda</b>
</h4>

<!-- INFORMASI UMUM -->
<div class="section-title">Informasi Umum</div>


<div class="data-box">
<div class="row g-3">

<div class="col-md-6">
    <label>Nama Lengkap</label>
    <input type="text" class="form-control" value="<?= $nama ?>" readonly>

    <label class="mt-3">Nomor Induk Kependudukan</label>
    <input type="text" class="form-control" value="<?= $nik ?>" readonly>

    <label class="mt-3">Jenis Kelamin</label>
    <input type="text" class="form-control" value="<?= $jenis_kelamin ?>" readonly>

    <label class="mt-3">Tanggal Lahir</label>
    <input type="text" class="form-control" value="<?= $tanggal_lahir ?>" readonly>
<label class="mt-3">Usia</label>
<label class="mt-3">Kategori Usia</label>
<input type="text" class="form-control" value="<?= $kategori ?>" readonly>
    
</div>

<div class="col-md-6">
    <label>Tanggal Skrining</label>
    <input type="text" 
       class="form-control text-white" 
       style="background:#00BBC2;" 
       value="<?= date('d-m-Y') ?>" 
       readonly>

    <label class="mt-3">Provinsi</label>
    <input type="text" class="form-control" value="<?= $provinsi ?>" readonly>

    <label class="mt-3">Kabupaten</label>
    <input type="text" class="form-control" value="<?= $kabupaten ?>" readonly>

    <label class="mt-3">Kecamatan</label>
    <input type="text" class="form-control" value="<?= $kecamatan ?>" readonly>

    <label class="mt-3">Kelurahan</label>
    <input type="text" class="form-control" value="<?= $kelurahan ?>" readonly>

    <label class="mt-3">RT/RW</label>
    <input type="text" class="form-control" value="<?= $rt_rw ?>" readonly>
</div>

</div>
</div>

<!-- RINCIAN JAWABAN -->
<div class="section-title">Rincian Jawaban</div>

<table class="table table-bordered">
<thead>
<tr>
    <th class="text-center">No</th>
    <th class="text-start">Pertanyaan</th>
    <th class="text-center">Jawaban</th>
</tr>
</thead>
<tbody>

<?php 
$pertanyaan = [
    "Apakah Anda mengalami batuk dalam 7 hari terakhir?",
    "Apakah Anda mengeluarkan dahak (sputum) saat batuk?",
    "Apakah Anda mengalami sesak napas?",
    "Apakah Anda merasakan nyeri dada saat bernapas atau batuk?",
    "Apakah Anda mengalami mual atau muntah?",
    "Apakah Anda merasa lemas?",
    "Apakah nafsu makan Anda menurun?",
    "Apakah Anda mengalami demam (≥38 derajat celcius)?",
    "Apakah napas Anda terasa lebih cepat dari biasanya?",
    "Apakah saat bernapas terdengar bunyi seperti mendengkur atau seperti ada dahak di dada?",
    "Apakah saat Anda bernapas terdengar bunyi mengi (seperti siulan)?"
];
?>

<?php foreach($pertanyaan as $i => $text): ?>
<tr>
    <td class="text-center"><?= $i+1 ?></td>
    <td class="text-start"><?= $text ?></td>
    <td class="text-center">

<?php
$value = isset(${"p".($i+1)}) ? ${"p".($i+1)} : 0;

if ($value == 1):
?>
    <span class="badge bg-success">Iya</span>
<?php else: ?>
    <span class="badge bg-danger">Tidak</span>
<?php endif; ?>

</td>
</tr>
<?php endforeach; ?>



</tbody>
</table>

<!-- HASIL -->
<div class="section-title">Hasil</div>
<p class="text-muted">



<div class="hasil-box">
    <?= $hasil ?>
</div>

<p class="text-center mt-2 text-muted">
    <?= $alasan ?>
</p>

<!-- REKOMENDASI -->
<div class="section-title">Rekomendasi</div>

<?php if ($hasil == 'Berisiko Pneumonia'): ?>

    <!-- HASIL BERISIKO -->
    <div class="tips-card">

        <div class="tips-header-modern bg-danger-modern">
            Rekomendasi
        </div>

        <div class="tips-content-modern">

            <ul>
                <li>Segera periksa ke fasilitas kesehatan terdekat.</li>
                <li>Gunakan masker dan pantau gejala.</li>
                <li>Hubungi <b>CHATBOT</b> untuk informasi lebih lanjut.</li>
            </ul>

        </div>

    </div>

<?php else: ?>

    <!-- HASIL TIDAK BERISIKO -->
    <div class="tips-card">

        <div class="tips-header-modern bg-success-modern">
            Rekomendasi
        </div>

        <div class="tips-content-modern">

            <ul>
                <li>Jaga daya tahan tubuh dengan makan bergizi, istirahat cukup, dan minum air yang cukup.</li>
                <li>Hindari asap rokok dan paparan polusi udara.</li>
                <li>Waspadai bila muncul demam tinggi, sesak napas, atau batuk memburuk.</li>
            </ul>

        </div>

    </div>

<?php endif; ?>

<!-- BUTTON -->

<!-- KEMBALI & SELESAI (DI BAWAH) -->
<div class="btn-wrapper">

    <a onclick="window.print()" class="btn btn-kembali">
        Cetak Hasil
    </a>

   <a href="/pneumonia" class="btn btn-selesai">
    Selesai
    </a>

</div>
<!-- FOOTER -->
<div class="footer-text">
    Halaman 1 dari 1 <br>
    Laporan ini dihasilkan otomatis dari SIGAP
</div>

</div>

</div>

</div>

</body>
</html>

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