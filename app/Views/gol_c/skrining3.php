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

*{
    font-family:'Poppins',sans-serif;
}

body{
    background:#ffffff;
}

/* CARD */
.card-custom{
    border-radius:20px;
    border:2px solid #00BBC2;
    background:#f8fbfc;
    padding:40px;
    max-width:1000px;
    margin:40px auto;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

/* TITLE */
.section-title{
    font-weight:700;
    font-size:20px;
    margin:35px 0 18px;
    color:#222;
}

/* BOX */
.data-box{
    background:white;
    border-radius:16px;
    padding:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

/* INPUT */
.form-control[readonly]{
    background:#f8f9fa;
    border-radius:10px;
    border:1px solid #dee2e6;
}

/* TABLE */
.table{
    border-radius:15px;
    overflow:hidden;
    margin-bottom:25px;
}

.table th{
    background:#00BBC2;
    color:white;
    border:none;
}

.table td{
    vertical-align:middle;
}

/* BADGE */
.badge{
    padding:8px 15px;
    font-size:14px;
    border-radius:8px;
}

/* HASIL */
.hasil-box{
    color:white;
    border-radius:18px;
    padding:28px;
    text-align:center;
    font-weight:700;
    font-size:22px;
    margin-bottom:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.hasil-danger{
    background:#dc3545;
}

.hasil-success{
    background:#198754;
}

/* REKOMENDASI */
.tips-card{
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    margin-top:20px;
}

.tips-header-modern{
    padding:18px 20px;
    font-weight:600;
    color:white;
    display:flex;
    align-items:center;
    gap:10px;
    font-size:16px;
}

/* WARNA TOSCA */
.bg-info-modern{
    background:#00BBC2;
}

.tips-content-modern{
    padding:22px;
    background:#f9fcfc;
}

.tips-content-modern ul{
    padding-left:20px;
}

.tips-content-modern li{
    margin-bottom:10px;
    color:#444;
}

/* BUTTON CHATBOT */
.btn-chatbot{
    width:100%;
    background:#00BBC2;
    color:white;
    border-radius:12px;
    padding:14px 20px;
    font-weight:600;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    transition:0.3s ease;
    border:none;
}

.btn-chatbot:hover{
    background:#00a7ad;
    color:white;
}

/* BUTTON */
.btn-wrapper{
    display:flex;
    justify-content:center;
    gap:15px;
    margin-top:40px;
}

.btn-kembali,
.btn-selesai{
    width:180px;
    height:52px;
    border-radius:12px;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
}

.btn-kembali{
    background:white;
    border:2px solid #00BBC2;
    color:#00BBC2;
}

.btn-selesai{
    background:#00BBC2;
    color:white;
}

/* FOOTER */
.footer-text{
    text-align:center;
    margin-top:35px;
    color:gray;
    font-size:14px;
}

.footer-maskot{
    width:250px !important;
}

@media print{
    .btn-wrapper,
    .btn-chatbot{
        display:none;
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

    <!-- RINCIAN -->
    <div class="section-title">Rincian Jawaban</div>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Pertanyaan</th>
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

            <td><?= $text ?></td>

            <td class="text-center">

                <?php
                $value = isset(${"p".($i+1)}) ? ${"p".($i+1)} : 0;
                ?>

                <?php if($value == 1): ?>

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

    <div class="hasil-box <?= ($hasil == 'Berisiko Pneumonia') ? 'hasil-danger' : 'hasil-success' ?>">
        <?= $hasil ?>
    </div>

    <p class="text-center mt-2 text-muted">
        <?= $alasan ?>
    </p>

    <!-- REKOMENDASI -->
    <div class="section-title">Rekomendasi</div>

    <div class="tips-card">

        <div class="tips-header-modern bg-info-modern">
            <i class="fa-solid fa-notes-medical"></i>
            Rekomendasi
        </div>

        <div class="tips-content-modern">

            <?php if ($hasil == 'Berisiko Pneumonia'): ?>

                <ul>
                    <li>Segera periksa ke fasilitas kesehatan terdekat.</li>
                    <li>Gunakan masker dan pantau gejala secara berkala.</li>
                    <li>Kurangi aktivitas berat dan perbanyak istirahat.</li>
                    <li>Perbanyak minum air putih dan konsumsi makanan bergizi.</li>
                    <li>Segera konsultasikan kondisi Anda melalui chatbot kesehatan.</li>
                </ul>

                <div class="mt-4">

                    <a href="http://localhost:8080/chat-pneumonia" class="btn-chatbot">
                        <i class="fa-solid fa-robot"></i>
                        Menuju Chatbot Pneumonia
                    </a>

                </div>

            <?php else: ?>

                <ul>
                    <li>Jaga daya tahan tubuh dengan pola hidup sehat.</li>
                    <li>Hindari asap rokok dan paparan polusi udara.</li>
                    <li>Istirahat yang cukup dan konsumsi makanan bergizi.</li>
                    <li>Perbanyak minum air putih dan olahraga ringan.</li>
                    <li>Tetap waspada bila muncul demam, sesak napas, atau batuk berat.</li>
                </ul>

            <?php endif; ?>

        </div>

    </div>

    <!-- BUTTON -->
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

</body>
</html>

<?= $this->include('layout/footer') ?>