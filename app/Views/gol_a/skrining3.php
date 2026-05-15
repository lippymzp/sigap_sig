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
body{
    background: linear-gradient(135deg,#e9fbfc,#f7ffff);
    min-height:100vh;
    font-family:'Poppins',sans-serif;
}

/* CARD */
.card-custom{
    max-width:1000px;
    margin:40px auto;
    padding:40px;
    border-radius:15px;
    border:2px solid #00BBC2;
    background:#f1f3f5;
}

/* SECTION */
.section-title{
    font-weight:bold;
    margin:35px 0 15px;
}

.data-box{
    background:white;
    border-radius:10px;
    padding:20px;
    margin-bottom:25px;
    box-shadow:0 2px 6px rgba(0,0,0,.08);
}

.hasil-box{
    background:#00BBC2;
    color:white;
    border-radius:12px;
    padding:20px;
    margin-bottom:15px;
    text-align:center;
    font-size:18px;
    font-weight:bold;
}

/* FORM */
.form-control[readonly]{
    background:#f8f9fa;
    border-radius:10px;
}

/* TABLE */
.table{
    margin-bottom:25px;
    border-radius:12px;
    overflow:hidden;
}

.table th{
    background:#00BBC2;
    color:white;
}

.table thead tr th:first-child{
    border-top-left-radius:12px;
}

.table thead tr th:last-child{
    border-top-right-radius:12px;
}

.table tbody tr:last-child td:first-child{
    border-bottom-left-radius:12px;
}

.table tbody tr:last-child td:last-child{
    border-bottom-right-radius:12px;
}

/* Badge */
.badge{
    padding:8px 15px;
    font-size:14px;
}

/* TIPS CARD */
.tips-box{
    margin:20px 0 30px;
    border-radius:12px;
    overflow:hidden;
}

.tips-card{
    margin-top:20px;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    animation:fadeUp .6s ease-in-out;
}

.tips-header-modern{
    padding:18px 20px;
    font-size:16px;
    font-weight:600;
    color:white;
    display:flex;
    align-items:center;
    gap:10px;
}

.tips-content-modern{
    background:#f9fcfc;
    padding:18px 22px;
}

.tips-content-modern p{
    color:#444;
    margin-bottom:10px;
}

.tips-content-modern ul{
    padding-left:18px;
}

.tips-content-modern li{
    margin-bottom:8px;
    transition:.2s;
}

.tips-content-modern li:hover{
    transform:translateX(5px);
}

/* HEADER COLOR */
.bg-danger-modern{
    background:linear-gradient(135deg,#ff6b6b,#d64545);
}

.bg-warning-modern{
    background:linear-gradient(135deg,#ffd86b,#c9a227);
}

.bg-success-modern{
    background:linear-gradient(135deg,#00BBC2,#007f6b);
}

/* BUTTON */
.btn-wrapper{
    display:flex;
    justify-content:center;
    gap:15px;
    margin-top:40px;
}

.btn-kembali,
.btn-selesai,
.btn-cetak{
    width:160px;
    height:50px;
    border-radius:10px;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
}

.btn-kembali{
    background:white;
    color:#00BBC2;
    border:2px solid #00BBC2;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}

.btn-selesai{
    background:#00BBC2;
    color:white;
    box-shadow:0 4px 12px rgba(0,0,0,.2);
}

.btn-cetak-full{
    width:100%;
    height:50px;
    border:none;
    border-radius:10px;
    background:#00BBC2;
    color:white;
    font-size:16px;
    font-weight:600;
}

.btn-cetak-full:hover{
    opacity:.9;
}

.cetak-wrapper{
    margin-top:20px;
}

/* FOOTER */
.footer-text{
    margin-top:30px;
    text-align:center;
    color:gray;
    font-size:14px;
}

/* PRINT */
@media print {

    /* Sembunyikan tombol */
    .btn-wrapper,
    .btn-cetak,
    .cetak-wrapper{
        display:none !important;
    }

    body{
        background:white !important;
        margin:0 !important;
        padding:0 !important;

        /* ganti zoom */
        transform:scale(.95);
        transform-origin:top left;
        width:105%;
    }

    .card-custom{
        width:100% !important;
        max-width:100% !important;
        margin:0 !important;
        padding:10px !important;
        border:none !important;
        box-shadow:none !important;
    }

    /* Hindari section penting pecah */
    .data-box,
    .hasil-box,
    .tips-card{
        page-break-inside:avoid !important;
        break-inside:avoid !important;
    }

    /* Informasi umum tetap 2 kolom */
    .row{
        display:flex !important;
        flex-wrap:wrap !important;
    }

    .col-md-6{
        width:50% !important;
    }

    .form-control{
        height:auto !important;
        min-height:35px;
        font-size:12px;
        padding:6px 10px;

        white-space:normal !important;
        overflow:visible !important;
    }

    /* ===== TABEL ===== */

    .table,
    table{
        width:100% !important;
        font-size:12px;
        border-collapse:collapse !important;
    }

    thead{
        display:table-header-group !important;
    }

    tfoot{
        display:table-footer-group !important;
    }

    tbody{
        display:table-row-group !important;
    }

    tbody tr{
        page-break-inside:auto !important;
        break-inside:auto !important;
    }

    th,
    td{
        padding:6px !important;
        vertical-align:middle !important;
        white-space:normal !important;
        overflow-wrap:break-word !important;
        word-break:break-word !important;
    }

    /* lebar kolom */
    td:nth-child(1),
    th:nth-child(1){
        width:8%;
    }

    td:nth-child(2),
    th:nth-child(2){
        width:72%;
    }

    td:nth-child(3),
    th:nth-child(3){
        width:20%;
    }

    /* Footer */
    .footer-text{
        margin-top:20px;
    }
/* HASIL pindah ke halaman baru */
.section-title:nth-of-type(3){
    page-break-before: always !important;
    break-before: page !important;
}

/* REKOMENDASI pindah ke halaman baru */
.section-title:nth-of-type(4){
    page-break-before: always !important;
    break-before: page !important;
}

/* Isi card jangan terpotong */
.hasil-box,
.tips-card{
    page-break-inside: avoid !important;
    break-inside: avoid !important;
}
    @page{
        size:A4;
        margin:10mm;
    }
}

/* ANIMATION */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
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
    "Apakah Anda rutin mengecek keberadaan jentik di rumah?",
    "Apakah talang air dan saluran pembuangan rutin dibersihkan?",
    "Apakah hanya orang tertentu dalam keluarga yang melakukan 3M?",
    "Apakah Anda menggantungkan baju di rumah?"
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

   <button type="button" onclick="confirmBack(event)" class="btn btn-kembali">
    Kembali
</button>


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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script>
function confirmBack(event) {
    event.preventDefault();

    Swal.fire({
        icon: 'question',
        title: 'Yakin mau kembali?',
        text: 'Kamu akan kembali ke halaman skrining.',
        showCancelButton: true,
        confirmButtonText: 'Iya, kembali',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#00BBC2',
        cancelButtonColor: '#6c757d',
    }).then((result) => {

        if (result.isConfirmed) {
            window.location.href = "<?= base_url('skriningdbd') ?>";
        }

        // kalau cancel → diam saja (tetap di halaman)
    });
}
</script>
</body>
</html>
<?= $this->include('layout/footer') ?>