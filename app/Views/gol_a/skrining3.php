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
    "Apakah Anda menguras Tempat Penampungan Air?",
    "Apakah Anda menutup rapat-rapat tempat penampungan air yang berada di dalam rumah?",
    "Apakah Anda menutup rapat-rapat tempat penampungan air yang berada di luar rumah?",
    "Apakah Anda mengubur barang bekas yang dapat menampung air hujan?",
    "Apakah Anda membuang barang bekas yang dapat menampung air hujan?",
    "Apakah Anda mendaur ulang barang bekas yang dapat menampung air hujan?",
    "Apakah Anda menaburkan larvasida seperti abate pada tempat penampungan yang sulit dibersihkan?",
    "Apakah Anda menaburkan abate sesuai dengan aturan pakai?",
    "Apakah Anda menggunakan obat nyamuk atau anti nyamuk?",
    "Apakah Anda menanam tanaman pengusir nyamuk?",
    "Apakah Anda mengatur cahaya dan ventilasi di dalam rumah?",
    "Apakah Anda rutin (minimal 1 minggu sekali) mengecek dan memantau keberadaan jentik di rumah Anda?",
    "Apakah talang air, selokan, atau saluran pembuangan di sekitar rumah Anda rutin dibersihkan agar tidak menjadi tempat genangan air?",
    "Apakah hanya orang-orang tertentu dalam keluarga Anda yang melakukan kegiatan 3M?",
    "Apakah Anda menggantungkan baju di rumah?",
    "Apakah semua anggota keluarga Anda menggantungkan baju di rumah?",
    "Apakah di rumah Anda banyak genangan air?",
    "Apakah saat pagi hari di rumah Anda banyak nyamuk?",
    "Apakah dalam 2 minggu terakhir Anda pernah kontak dekat dengan seseorang yang sedang demam atau diduga menderita DBD?",
    "Apakah dalam 2 minggu terakhir Anda melakukan perjalanan ke daerah lain atau wilayah dengan kasus DBD?",
    "Apakah dalam 2 minggu terakhir Anda sering berkunjung ke tempat umum atau lokasi ramai?"
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

<!-- TIPS / REKOMENDASI BERDASARKAN HASIL -->
<?php if (strpos($hasil, 'Buruk') !== false): ?>

    <div class="tips-card">
    <div class="tips-header-modern bg-danger-modern">
        🚨🦟 Risiko Tinggi Nyamuk Aedes aegypti
    </div>

    <div class="tips-content-modern">
        <p>Lingkungan sangat berisiko terhadap perkembangan nyamuk penyebab DBD.</p>

        <ul>
            <li>🧼 Lakukan 3M Plus secara menyeluruh</li>
            <li>🪣 Bersihkan tempat air minimal 1x seminggu</li>
            <li>💊 Gunakan larvasida (abate)</li>
            <li>👕 Hindari menggantung pakaian</li>
            <li>🔍 Rutin cek jentik di rumah</li>
            <li>🏥 Segera ke fasilitas kesehatan jika ada gejala</li>
        </ul>
    </div>
</div>

<?php elseif (strpos($hasil, 'Cukup') !== false): ?>

    <div class="tips-box">
        <div class="tips-card">
    <div class="tips-header-modern bg-warning-modern">
        ⚡🦟 Lingkungan Perlu Ditingkatkan
    </div>

    <div class="tips-content-modern">
        <p>Pencegahan sudah dilakukan, tetapi belum konsisten.</p>

        <ul>
            <li>🧽 Tingkatkan rutinitas 3M Plus</li>
            <li>👨‍👩‍👧 Libatkan seluruh keluarga</li>
            <li>🔍 Cek jentik setiap minggu</li>
            <li>💡 Perbaiki ventilasi & cahaya rumah</li>
            <li>🌿 Gunakan pengusir nyamuk alami</li>
        </ul>
    </div>
</div>

<?php else: ?>

    <div class="tips-card">
    <div class="tips-header-modern bg-success-modern">
        🎉✨ Lingkungan Sehat & Terjaga
    </div>

    <div class="tips-content-modern">
        <p>Kondisi lingkungan sudah baik dan aman dari risiko tinggi DBD.</p>

        <ul>
            <li>🌟 Pertahankan 3M Plus</li>
            <li>🔍 Tetap rutin cek jentik</li>
            <li>🏘️ Ajak lingkungan sekitar ikut menjaga</li>
            <li>💚 Jaga PHBS keluarga</li>
            <li>🌧️ Tetap waspada musim hujan</li>
        </ul>
    </div>
</div>

<?php endif; ?>
<!-- BUTTON -->

<!-- CETAK (SENDIRI DI ATAS) -->
<div class="cetak-wrapper">
    <button onclick="window.print()" class="btn-cetak-full">
        🖨️ Cetak Hasil
    </button>
</div>

<!-- KEMBALI & SELESAI (DI BAWAH) -->
<div class="btn-wrapper">

    <a href="/skriningdbd" class="btn btn-kembali">
        Kembali
    </a>

   <a href="<?= base_url('/') ?>" class="btn btn-selesai">
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
<?= $this->include('layout/footer') ?>