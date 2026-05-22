<?php

$hasil = $data['hasil'] ?? '';

// 1. Load Logo (Base64)
$pathLogo = FCPATH . 'img/logotbc_navbar.png';
$logo = '';
if (file_exists($pathLogo)) {
    $typeLogo = pathinfo($pathLogo, PATHINFO_EXTENSION);
    $fileLogo = file_get_contents($pathLogo);
    $logo = 'data:image/' . $typeLogo . ';base64,' . base64_encode($fileLogo);
}

// 2. Load Book Icon (Base64)
$pathBook = FCPATH . 'img/book.png';
$bookIcon = '';
if (file_exists($pathBook)) {
    $typeBook = pathinfo($pathBook, PATHINFO_EXTENSION);
    $fileBook = file_get_contents($pathBook);
    $bookIcon = 'data:image/' . $typeBook . ';base64,' . base64_encode($fileBook);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: Arial, sans-serif;
    font-size:12px;
    color:#222;
    padding:28px;
}

/* HEADER */
.logo{
    font-size:20px;
    font-weight:bold;
    color:#1d4ed8;
    margin-bottom:8px;
}

.judul{
    font-size:16px;
    font-weight:bold;
    margin-bottom:18px;
}

/* CARD */
.card{
    border:1px solid #dbeafe;
    border-radius:12px;
    padding:16px;
    margin-bottom:18px;
}

.section-title{
    font-size:13px;
    font-weight:bold;
    margin-bottom:12px;
    color:#111827;
}

/* FORM */
.row{
    width:100%;
}

.col{
    width:48%;
    display:inline-block;
    vertical-align:top;
}

.field{
    margin-bottom:10px;
}

.label{
    font-size:10px;
    font-weight:bold;
    margin-bottom:4px;
    color:#374151;
}

.value{
    background:#f9fafb;
    border:1px solid #d1d5db;
    border-radius:6px;
    padding:7px 10px;
    font-size:11px;
}

.value-blue{
    background:#14b8a6;;
    color:white;
    border:none;
}

/* HASIL */
.hasil-box{
    text-align:center;
    padding:14px;
    border-radius:8px;
    font-weight:bold;
    font-size:14px;
    margin-top:8px;
}

.hasil-aman{
    background:#d1fae5;
    color:#047857;
    border:1px solid #a7f3d0;
}

.hasil-tb{
    background:#fee2e2;
    color:#b91c1c;
    border:1px solid #fecaca;
}

/* REKOMENDASI */
.rekom-box{
    border:1px solid #d1d5db;
    border-radius:8px;
    padding:14px;
    line-height:1.8;
    font-size:11px;
}

/* =========================
   TIPS (OVERLAPPED LIKE HASIL.PHP)
   ========================= */
.tips-wrapper{
    position: relative;
    margin-top: 35px; /* Beri ruang agar ikon meluncur ke atas tanpa tabrakan */
}

.tips-icon{
    position: absolute;
    left: -8px;
    top: -12px;
    z-index: 999;
}

.tips-box{
    margin-left: 24px; /* Geser box ke kanan agar ada ruang untuk ikon melayang */
    border-radius: 16px;
}

.tips-header{
    background:#14b8a6;
    color:white;
    padding:14px 24px;
    padding-left: 28px; /* Ruang ekstra dalam agar tulisan tidak tertutup ikon */
    font-weight:bold;
    font-size:18px;
    border-radius:12px 12px 0 0;
}

.tips-body{
    background:#ccfbf1;
    padding:16px 24px;
    padding-left: 28px;
    border-radius:0 0 12px 12px;
}

.tips-body ul{
    padding-left:18px;
}

.tips-body li{
    margin-bottom:8px;
    font-size:11px;
}

/* FOOTER */
.footer{
    margin-top:20px;
    font-size:10px;
    color:#666;
    border-top:1px solid #ddd;
    padding-top:6px;
}

.footer-left{
    float:left;
}

.footer-right{
    float:right;
}
</style>
</head>

<body>

<?php if(!empty($logo)): ?>
    <img src="<?= $logo ?>" width="150">
<?php endif; ?>


<!-- JUDUL -->
<div class="judul" style="margin-top: 10px;">
    Hasil Skrining Tuberkulosis Anda
</div>

<!-- INFORMASI -->
<div class="card">

    <div class="section-title">
        Informasi Umum
    </div>

    <div class="row">

        <!-- KIRI -->
        <div class="col">

            <div class="field">
                <div class="label">Nama Lengkap</div>
                <div class="value"><?= $data['nama'] ?? '-' ?></div>
            </div>

            <div class="field">
                <div class="label">Nomor Induk Kependudukan</div>
                <div class="value"><?= $data['nik'] ?? '-' ?></div>
            </div>

            <div class="field">
                <div class="label">Jenis Kelamin</div>
                <div class="value">
                    <?= (($data['jenis_kelamin'] ?? '') == 'L') ? 'Laki-laki' : 'Perempuan' ?>
                </div>
            </div>

            <div class="field">
                <div class="label">Tanggal Lahir</div>
                <div class="value"><?= $data['tanggal_lahir'] ?? '-' ?></div>
            </div>

            <div class="field">
                <div class="label">Usia</div>
                <div class="value"><?= $data['usia'] ?? '-' ?></div>
            </div>

        </div>

        <!-- KANAN -->
        <div class="col" style="margin-left:3%;">

            <div class="field">
                <div class="label">Tanggal Skrining</div>
                <div class="value value-blue">
                    <?= $data['tanggal_skrining'] ?? '-' ?>
                </div>
            </div>

            <div class="field">
                <div class="label">Provinsi</div>
                <div class="value"><?= $data['provinsi'] ?? '-' ?></div>
            </div>

            <div class="field">
                <div class="label">Kabupaten</div>
                <div class="value"><?= $data['kabupaten'] ?? '-' ?></div>
            </div>

            <div class="field">
                <div class="label">Kecamatan</div>
                <div class="value"><?= $data['kecamatan'] ?? '-' ?></div>
            </div>

            <div class="field">
                <div class="label">Kelurahan</div>
                <div class="value"><?= $data['kelurahan'] ?? '-' ?></div>
            </div>

        </div>

    </div>

</div>

<!-- HASIL -->
<div class="section-title">
    Hasil
</div>

<div class="hasil-box <?= ($hasil == 'TB') ? 'hasil-tb' : 'hasil-aman' ?>">

    <?= ($hasil == 'TB')
        ? 'Anda Berisiko TB'
        : 'Anda Tidak Berisiko TB'
    ?>

</div>

<!-- REKOMENDASI -->
<div style="margin-top:18px;">

    <div class="section-title">
        Rekomendasi
    </div>

    <div class="rekom-box">

        <?php if($hasil == 'TB'): ?>

            Berdasarkan hasil skrining, Anda memiliki risiko Tuberkulosis (TB).
            Disarankan untuk segera melakukan pemeriksaan lebih lanjut di fasilitas kesehatan terdekat.

        <?php else: ?>

            Berdasarkan hasil skrining, saat ini Anda tidak menunjukkan risiko Tuberkulosis (TB).
            Tetap pertahankan kondisi kesehatan Anda dan lakukan pemantauan mandiri terhadap gejala yang mungkin muncul di kemudian hari.

        <?php endif; ?>

    </div>

</div>

<!-- TIPS BERGAYA OVERLAP -->
<div class="tips-wrapper">

    <!-- Ikon Buku Base64 Overlap -->
    <?php if(!empty($bookIcon)): ?>
        <div class="tips-icon">
            <img src="<?= $bookIcon ?>" width="38" height="38">
        </div>
    <?php endif; ?>

    <div class="tips-box">
        
        <div class="tips-header">
            Tips Sementara Sebelum Pemeriksaan
        </div>

        <div class="tips-body">
            <ul>
                <?php if($hasil == 'TB'): ?>
                    <li>Gunakan masker saat berinteraksi dengan orang lain</li>
                    <li>Terapkan etika batuk dan bersin</li>
                    <li>Hindari kontak dekat dengan kelompok rentan</li>
                    <li>Istirahat cukup dan konsumsi makanan bergizi</li>
                <?php else: ?>
                    <li>Konsumsi makanan bergizi seimbang setiap hari</li>
                    <li>Rutin berolahraga minimal 30 menit</li>
                    <li>Istirahat yang cukup</li>
                    <li>Jaga kebersihan lingkungan dan ventilasi rumah</li>
                <?php endif; ?>
            </ul>
        </div>

    </div>

</div>

<!-- FOOTER -->
<div class="footer">

    <div class="footer-left">
        Laporan ini dihasilkan otomatis dari RESPIORA
    </div>

    <div class="footer-right">
        Halaman 1 dari 1
    </div>

</div>

</body>
</html>