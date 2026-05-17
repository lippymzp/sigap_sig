<?php $this->setVar('penyakit', 'tbc'); ?>
<?= $this->include('layout/header') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Skrining</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

    body{
        background:#eef1f3;
        font-family:Poppins;
    }

    .box{
        width:900px;
        margin:40px auto;
        background:white;
        border-radius:15px;
        padding:30px;
    }

    .hasil{
        width:100%;
        padding:18px;
        border-radius:12px;
        text-align:center;
        font-size:20px;
        font-weight:700;
        margin:25px 0;
    }

    .tb{
        background:#ffdada;
        color:#c40000;
    }

    .aman{
        background:#d8ffd8;
        color:#008000;
    }

/* =========================
TABLE RINCIAN
========================= */

.table-rincian{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:10px;
    background:white;
}

.table-rincian thead th{
    background:#1fc7d4;
    color:white;
    font-size:14px;
    font-weight:600;
    padding:14px 16px;
    text-align:center;
    border-right:1px solid rgba(255,255,255,0.2);
}

.table-rincian thead th:last-child{
    border-right:none;
}

.table-rincian tbody td{
    padding:14px 18px;
    border:1px solid #e5e7eb;
    font-size:14px;
    color:#374151;
    vertical-align:middle;
    background:white;
}

/* KOLOM NO */
.table-rincian tbody td:nth-child(1){
    width:45px;
    text-align:center;
}

/* KOLOM PERTANYAAN */
.table-rincian tbody td:nth-child(2){
    text-align:left;
}

/* KOLOM JAWABAN */
.table-rincian tbody td:nth-child(3){
    width:120px;
    text-align:center;
}

/* BADGE YA */
.badge-yes{
    display:inline-block;
    min-width:68px;
    padding:4px 16px;
    border-radius:30px;
    background:#ffe2e2;
    color:#ef4444;
    font-size:13px;
    font-weight:500;
    border:1px solid #f87171;
    text-align:center;
}

/* BADGE TIDAK */
.badge-no{
    display:inline-block;
    min-width:68px;
    padding:4px 16px;
    border-radius:30px;
    background:#dcfce7;
    color:#16a34a;
    font-size:13px;
    font-weight:500;
    border:1px solid #4ade80;
    text-align:center;
}

    /* INFO BOX */
.info-box{
    background:#f8fafc;
    border:1px solid #dbeafe;
    border-radius:16px;
    padding:18px 22px;
    margin:20px 0;
    box-shadow:0 2px 8px rgba(0,0,0,0.03);
}

.info-box h4{
    font-size:18px;
    margin-bottom:18px;
}

.info-box label{
    font-size:12px;
    font-weight:600;
    color:#374151;
    margin-bottom:5px;
    display:block;
}

.info-input{
    background:white;
    border:1px solid #dbeafe;
    border-radius:10px;
    padding:8px 12px;
    margin-bottom:12px;
    min-height:38px;
    font-size:13px;
    color:#374151;
    display:flex;
    align-items:center;
}

.info-highlight{
    background:#67d4dc;
    color:white;
    border:none;
}

.rt-box{
    width:38px;
    height:38px;
    justify-content:center;
    padding:0;
    text-align:center;
}

.info-box .row{
    row-gap:0px;
}

.box{
    width:900px;
    margin:40px auto;
    background:white;
    border-radius:18px;
    padding:30px;
    overflow:hidden;
}

/* =========================
SECTION TITLE
========================= */

.section-title{
    font-size:16px;
    font-weight:700;
    margin-bottom:10px;
    display:block;
    color:#111827;
}

/* =========================
HASIL
========================= */

.hasil-section{
    margin-top:35px;
}

.hasil-box{
    width:100%;
    padding:18px;
    border-radius:14px;
    text-align:center;
    font-size:28px;
    font-weight:700;
}

.hasil-tb{
    background:#ffe2e2;
    border:1px solid #ef4444;
    color:#dc2626;
}

.hasil-aman{
    background:#dcfce7;
    border:1px solid #22c55e;
    color:#16a34a;
}

/* =========================
REKOMENDASI
========================= */

.rekomendasi-section{
    margin-top:25px;
}

.rekomendasi-box{
    background:white;
    border:1px solid #bfd3ff;
    border-radius:14px;
    padding:24px;
    min-height:90px;
    font-size:15px;
    color:#374151;
    line-height:1.7;
}

/* =========================
TIPS
========================= */

.tips-wrapper{
    position:relative;
    margin-top:35px;
}

.tips-icon{
    position:absolute;
    left:-5px;
    top:-8px;
    font-size:42px;
    z-index:2;
}

.tips-box{
    background:#cfe0ff;
    border-radius:16px;
    overflow:hidden;
    margin-left:28px;
}

.tips-header{
    background:#12c8d4;
    color:white;
    font-size:24px;
    font-weight:700;
    padding:14px 24px;
}

.tips-body{
    padding:20px 28px;
}

.tips-body ul{
    margin:0;
    padding-left:20px;
}

.tips-body li{
    margin-bottom:10px;
    color:#1f2937;
    font-size:15px;
}

/* =========================
BUTTON CETAK
========================= */

.btn-cetak{
    display:block;
    width:100%;
    background:#12c8d4;
    color:white;
    text-decoration:none;
    padding:12px;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    transition:0.2s;
}

.btn-cetak:hover{
    background:#0fb2bd;
    color:white;
}

/* ================= NAVBAR ================= */

.navbar{
    background:white !important;
    padding:18px 70px !important;
    border-bottom:1px solid #e9f4f4;
    box-shadow:0 2px 10px rgba(0,0,0,.03);
}

.navbar-brand{
    font-size:18px;
    font-weight:800;
    color:#111 !important;
}

.navbar-nav .nav-link{
    color:#1F3A3A !important;
    font-weight:500;
    margin:0 10px;
    position:relative;
    transition:.2s;
}

.navbar-nav .nav-link:hover{
    color:#00CED1 !important;
}

/* ACTIVE MENU */
.navbar-nav .nav-link.active-menu{
    color:#00CED1 !important;
    font-weight:700;
}

.navbar-nav .nav-link.active-menu::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-8px;
    width:100%;
    height:3px;
    border-radius:10px;
    background:#00CED1;
}

/* BUTTON LOGIN */
.btn-login{
    background:linear-gradient(
        135deg,
        #00CED1,
        #40EDD0
    ) !important;

    color:white !important;
    border:none !important;

    padding:10px 24px !important;
    border-radius:999px !important;

    font-weight:600;
    transition:.25s;
}

.btn-login:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(0,206,209,.25);
}

    </style>

</head>

<body>

<div class="box">

    <h2>Hasil Skrining Anda</h2>

    <?php

    $nama = session()->get('nama');
    $nik = session()->get('nik');
    $jenis_kelamin = session()->get('jenis_kelamin');
    $tanggal_lahir = session()->get('tanggal_lahir');
    $usia = session()->get('usia');

    $provinsi = session()->get('provinsi');
    $kabupaten = session()->get('kabupaten');
    $kecamatan = session()->get('kecamatan');
    $kelurahan = session()->get('kelurahan');

    $rt = session()->get('rt');
    $rw = session()->get('rw');

    ?>

    <!-- INFO -->

    <div class="info-box">

        <h4 class="mb-4"><b>Informasi Umum</b></h4>

        <div class="row">

            <!-- KIRI -->
            <div class="col-md-6">

                <label>Nama Lengkap</label>
                <div class="info-input"><?= $nama ?></div>

                <label>NIK</label>
                <div class="info-input"><?= $nik ?></div>

                <label>Jenis Kelamin</label>
                <div class="info-input"><?= $jenis_kelamin ?></div>

                <label>Tanggal Lahir</label>
                <div class="info-input"><?= $tanggal_lahir ?></div>

                <label>Usia</label>
                <div class="info-input"><?= $usia ?></div>

            </div>

            <!-- KANAN -->
            <div class="col-md-6">

                <label>Tanggal Skrining</label>
                <div class="info-input info-highlight">
                    <?= date('d-m-Y') ?>
                </div>

                <label>Provinsi</label>
                <div class="info-input"><?= $provinsi ?></div>

                <label>Kabupaten</label>
                <div class="info-input"><?= $kabupaten ?></div>

                <label>Kecamatan</label>
                <div class="info-input"><?= $kecamatan ?></div>

                <label>Kelurahan</label>
                <div class="info-input"><?= $kelurahan ?></div>

                <!-- RT RW -->
                <div class="d-flex gap-4 mt-2">

                    <div>
                        <label>RT</label>
                        <div class="info-input rt-box">
                            <?= $rt ?>
                        </div>
                    </div>

                    <div>
                        <label>RW</label>
                        <div class="info-input rt-box">
                            <?= $rw ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

                
    <?php

    $pertanyaan = [

    "Apakah Anda mengalami batuk dan berdahak terus-menerus selama dua minggu?",

    "Apakah Anda mengalami batuk bercampur darahh?",

    "Apakah Anda mengalami demam yang berlangsung selama 2 minggu?",

    "Apakah Anda sering berkeringat pada malam hari tanpa aktivitas fisik?",

    "Apakah Anda mengalami penurunan berat badan tanpa sebab yang jelas dalam waktu selama 2 bulan?",

    "Apakah Anda memiliki kondisi yang melemahkan sistem imun, seperti pembesaran kelenjar getah bening, HIV/AIDS, dan diabetes melitus?",

    "Apakah Anda mengalami sesak napas?",

    "Apakah Anda mengalami penurunan nafsu makan dalam beberapa minggu terakhir?",

    "Apakah Anda sering merasa lelah atau tidak bertenaga?",

    "Apakah terdapat benjolan yang muncul di sekitar ketiak dan leher?",

    "Apakah Anda mengalami nyeri pada dada?",
    ];

    $jawaban = session()->get('jawaban') ?? [];

    // LOGIC TB
$hasil = session()->get('hasil');

// ==========================
// PENURUNAN BERAT BADAN = TIDAK
// ==========================

if($jawaban[4] == 0){

    // BENJOLAN = TIDAK
    if($jawaban[9] == 0){

        // DEMAM = YA
        if($jawaban[2] == 1){

            // PEMBESARAN KELENJAR = YA
            if($jawaban[5] == 1){

                // KERINGAT MALAM = YA
                if($jawaban[3] == 1){

                    $hasil = "TB";
                }

                // BATUK + BATUK DARAH
                if(
                    $jawaban[0] == 1 &&
                    $jawaban[1] == 1
                ){
                    $hasil = "TB";
                }
            }
        }
    }

    // BENJOLAN = YA
    if($jawaban[9] == 1){

        // SESAK + LEMAS
        if(
            $jawaban[6] == 1 &&
            $jawaban[8] == 1
        ){
            $hasil = "TB";
        }

        // KERINGAT MALAM + NYERI DADA
        if(
            $jawaban[3] == 1 &&
            $jawaban[10] == 1
        ){
            $hasil = "TB";
        }
    }
}


// ==========================
// PENURUNAN BERAT BADAN = YA
// ==========================

if($jawaban[4] == 1){

    // NAFSU MAKAN = TIDAK
    if($jawaban[7] == 0){

        // BATUK DARAH + DEMAM
        if(
            $jawaban[1] == 1 &&
            $jawaban[2] == 1
        ){
            $hasil = "TB";
        }

        // LEMAS + SESAK
        if(
            $jawaban[8] == 1 &&
            $jawaban[6] == 1
        ){
            $hasil = "TB";
        }
    }

    // NAFSU MAKAN = YA
    if($jawaban[7] == 1){

        // LEMAS
        if($jawaban[8] == 1){
            $hasil = "TB";
        }

        // BATUK
        if($jawaban[0] == 1){
            $hasil = "TB";
        }

        // BATUK DARAH
        if($jawaban[1] == 1){
            $hasil = "TB";
        }
    }

        $hasil = "TB";
    }

    ?>

    <!-- HASIL -->

    <br><br>

    <h5 class="mb-3"><b>Rincian Jawaban</b></h5>

<table class="table-rincian">

    <thead>
        <tr>
            <th>No</th>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($pertanyaan as $i => $p): ?>

        <tr>

            <td><?= $i + 1 ?></td>

            <td><?= $p ?></td>

            <td>

                <?php if(($jawaban[$i] ?? 0) == 1): ?>

                    <span class="badge-yes">
                        Ya
                    </span>

                <?php else: ?>

                    <span class="badge-no">
                        Tidak
                    </span>

                <?php endif; ?>

            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

<!-- HASIL -->
<div class="hasil-section">

    <label class="section-title">
        Hasil
    </label>

    <div class="hasil-box <?= ($hasil == 'TB') ? 'hasil-tb' : 'hasil-aman' ?>">

        <?= ($hasil == 'TB')
            ? 'Anda Berisiko TB'
            : 'Anda Tidak Berisiko TB'
        ?>

    </div>

</div>

<!-- REKOMENDASI -->
<div class="rekomendasi-section">

    <label class="section-title">
        Rekomendasi
    </label>

    <div class="rekomendasi-box">

        <?php if($hasil == 'TB'): ?>

            Segera lakukan pemeriksaan lebih lanjut ke fasilitas kesehatan terdekat dan konsultasikan kondisi Anda kepada tenaga kesehatan.

        <?php else: ?>

            Pertahankan pola hidup sehat dan lakukan pemeriksaan rutin apabila mengalami gejala tertentu.

        <?php endif; ?>

    </div>

</div>

<!-- TIPS -->
<div class="tips-wrapper">

    <div class="tips-icon">
        📖
    </div>

    <div class="tips-box">

        <div class="tips-header">
            Tips Kesehatan
        </div>

        <div class="tips-body">

            <ul>
                <li>Konsumsi makanan bergizi seimbang setiap hari</li>
                <li>Rutin berolahraga minimal 30 menit</li>
                <li>Istirahat yang cukup</li>
                <li>Jaga kebersihan lingkungan dan ventilasi rumah</li>
            </ul>

        </div>

    </div>

    <div class="text-center mt-4">

<a href="/dashboard/cetak/<?= session()->get('id_pasien_skrining') ?>" 
   class="btn-cetak">

        🖨 Cetak Hasil

    </a>

</div>

</div>

</div>
</div>

</body>
</html>

<?= $this->include('layout/footer') ?>