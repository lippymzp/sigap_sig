<?= $this->include('layout/header') ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body{
    font-family:'Poppins',sans-serif;
    background:#f6f8fb;
}

.result-card{
    background:#fff;
    border:2px solid #10c4cf;
    border-radius:24px;
    padding:40px;
    box-shadow:0 15px 40px rgba(0,0,0,.06);
}

.section-title{
    font-size:24px;
    font-weight:700;
    color:#0f172a;
    margin-bottom:25px;
}

.form-box{
    background:#f9fbfc;
    padding:22px;
    border-radius:18px;
    box-shadow:0 5px 20px rgba(0,0,0,.04);
}

.form-label{
    font-weight:500;
    font-size:14px;
    color:#111827;
    margin-bottom:6px;
}

.form-control{
    border-radius:12px;
    height:46px;
    border:1px solid #d8e1e8;
    font-size:15px;
}

.date-highlight{
    background:#10c4cf !important;
    color:white !important;
    font-weight:600;
}

.table-modern{
    border-radius:18px;
    overflow:hidden;
    background:white;
    box-shadow:0 6px 20px rgba(0,0,0,.05);
}

.table-modern thead{
    background:#10c4cf;
    color:white;
}

.table-modern th{
    padding:14px;
    font-weight:600;
    border:none;
}

.table-modern td{
    padding:14px;
    vertical-align:middle;
}

.badge-modern{
    padding:8px 18px;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
}

.badge-yes{
    background:#16a34a;
    color:white;
}

.badge-no{
    background:#ef4444;
    color:white;
}

.result-box{
    background:linear-gradient(135deg,#10c4cf,#0ea5b2);
    color:white;
    padding:22px;
    text-align:center;
    border-radius:16px;
    font-size:24px;
    font-weight:700;
    box-shadow:0 10px 20px rgba(16,196,207,.25);
}

.rekom-card{
    background:white;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.06);
}

.rekom-header{
    background:linear-gradient(135deg,#f5c542,#d4a514);
    color:white;
    padding:18px 24px;
    font-weight:700;
    font-size:18px;
}

.rekom-body{
    padding:24px;
    font-size:17px;
    line-height:1.8;
    color:#374151;
}

.rekom-body ul{
    padding-left:20px;
}

.btn-modern{
    border:none;
    padding:14px 28px;
    border-radius:14px;
    font-weight:600;
    font-size:16px;
    transition:.25s ease;
    text-decoration:none;
    display:inline-block;
}

.btn-print{
    width:100%;
    background:linear-gradient(135deg,#10c4cf,#0ea5b2);
    color:white;
}

.btn-outline-modern{
    background:white;
    border:2px solid #10c4cf;
    color:#10c4cf;
}

.btn-solid-modern{
    background:linear-gradient(135deg,#10c4cf,#0ea5b2);
    color:white;
}

.btn-modern:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 18px rgba(0,0,0,.10);
}

.footer-note{
    text-align:center;
    color:#6b7280;
    font-size:15px;
    margin-top:30px;
}

@media(max-width:768px){
    .result-card{
        padding:20px;
    }

    .section-title{
        font-size:20px;
    }

    .result-box{
        font-size:18px;
    }
}
</style>

<?php
$identitas = $identitas ?? [];
$jawaban   = $jawaban ?? [];

$pertanyaan = [
    "Apakah Anda BAB lebih dari 3 kali sehari?",
    "Apakah konsistensi feses Anda cair?",
    "Apakah konsistensi feses Anda lembek?",
    "Apakah Anda merasa mual?",
    "Apakah Anda muntah?",
    "Apakah Anda demam lebih dari 37°C?",
    "Apakah Anda merasa lemas?",
    "Apakah Anda mengalami disentri?",
    "Apakah bibir Anda kering?",
    "Apakah Anda oliguria / urin sedikit?",
    "Apakah mata Anda cekung?",
    "Apakah turgor kulit menurun?",
    "Apakah nadi Anda cepat?",
    "Apakah nafas Anda terasa cepat?",
    "Apakah ubun-ubun Anda cekung?"
];
?>

<section class="container my-5">

<div class="result-card">

    <h2 class="text-center fw-bold mb-5">Hasil Skrining Kesehatan Anda</h2>

    <!-- INFORMASI UMUM -->
    <h3 class="section-title">Informasi Umum</h3>

    <div class="form-box mb-5">
        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input class="form-control" value="<?= $identitas['nama'] ?? '-' ?>" readonly>

                <label class="form-label mt-3">Nomor Induk Kependudukan</label>
                <input class="form-control" value="<?= $identitas['nik'] ?? '-' ?>" readonly>

                <label class="form-label mt-3">Jenis Kelamin</label>
                <input class="form-control" value="<?= $identitas['jk'] ?? '-' ?>" readonly>

                <label class="form-label mt-3">Tanggal Lahir</label>
                <input class="form-control" value="<?= $identitas['tgl'] ?? '-' ?>" readonly>

                <label class="form-label mt-3">Kategori Usia</label>
                <input class="form-control" value="<?= $identitas['usia'] ?? '-' ?>" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tanggal Skrining</label>
                <input class="form-control date-highlight" value="<?= date('d-m-Y') ?>" readonly>

                <label class="form-label mt-3">Provinsi</label>
                <input class="form-control" value="<?= $identitas['prov'] ?? '-' ?>" readonly>

                <label class="form-label mt-3">Kabupaten</label>
                <input class="form-control" value="<?= $identitas['kab'] ?? '-' ?>" readonly>

                <label class="form-label mt-3">Kecamatan</label>
                <input class="form-control" value="<?= $identitas['kec'] ?? '-' ?>" readonly>

                <label class="form-label mt-3">Kelurahan</label>
                <input class="form-control" value="<?= $identitas['kel'] ?? '-' ?>" readonly>

                <label class="form-label mt-3">Kode Pos</label>
                <input class="form-control" value="<?= $identitas['kodepos'] ?? '-' ?>" readonly>
            </div>

        </div>
    </div>

    <!-- RINCIAN -->
    <h3 class="section-title">Rincian Jawaban</h3>

    <div class="table-responsive table-modern mb-5">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Pertanyaan</th>
                    <th width="140">Jawaban</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($pertanyaan as $i => $p): ?>
            <?php $nilai = isset($jawaban["q".$i]) ? $jawaban["q".$i] : null; ?>

                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= $p ?></td>
                    <td>
                        <span class="badge-modern <?= $nilai === null ? '' : ($nilai ? 'badge-yes' : 'badge-no') ?>">
                       <?= $nilai === null ? '-' : ($nilai ? 'Ya' : 'Tidak') ?>
                        </span>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- HASIL -->
    <h3 class="section-title">Hasil</h3>

    <div class="row g-4 mb-5">

    <div class="col-md-6">
        <div class="result-box">
            Status Diare
            <div style="font-size:30px; margin-top:10px;">
                <?= $statusDiare ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="result-box">
            Status Dehidrasi
            <div style="font-size:30px; margin-top:10px;">
                <?= $statusDehidrasi ?>
            </div>
        </div>
    </div>

</div>

    <!-- REKOMENDASI -->
    <h3 class="section-title">Rekomendasi</h3>

    <div class="rekom-card mb-4">
        <div class="rekom-header">
            ⚡ Rekomendasi Kesehatan
        </div>

        <div class="rekom-body">
            <p><?= $rekomendasi ?></p>

            <ul>
                <li>Konsumsi oralit atau cairan rehidrasi</li>
                <li>Minum air putih yang cukup</li>
                <li>Hindari makanan pedas / tidak higienis</li>
                <li>Istirahat cukup</li>
                <li>Segera ke fasilitas kesehatan jika memburuk</li>
            </ul>
        </div>
    </div>

    <!-- BUTTON -->
    <a href="<?= base_url('pdf-diare') ?>" class="btn-modern btn-print mb-4">
        🖨 Cetak Hasil
    </a>

    <div class="text-center d-flex gap-3 justify-content-center flex-wrap">
        <a href="<?= base_url('skrining-diare') ?>" class="btn-modern btn-outline-modern">
            Kembali
        </a>

        <a href="<?= base_url('/') ?>" class="btn-modern btn-solid-modern">
            Selesai
        </a>
    </div>

    <div class="footer-note">
        Halaman 1 dari 1<br>
        Laporan ini dihasilkan otomatis dari SIGAP
    </div>

</div>

</section>

<?= $this->include('layout/footer') ?>