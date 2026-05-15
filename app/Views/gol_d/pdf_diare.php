<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Hasil Skrining Diare</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    background:#f4f8fb;
    font-size:12px;
    color:#1b1b1b;
    margin:20px;
}

.wrapper{
    border:2px solid #10c6d1;
    border-radius:18px;
    padding:25px;
    background:#ffffff;
}

.title{
    text-align:center;
    font-size:24px;
    font-weight:bold;
    margin-bottom:30px;
}

.section-title{
    font-size:18px;
    font-weight:bold;
    margin-bottom:15px;
    color:#0f2230;
}

.info-box{
    background:#f8fbfd;
    border:1px solid #dbe8ef;
    border-radius:14px;
    padding:18px;
    margin-bottom:25px;
}

.info-table{
    width:100%;
    border-collapse:collapse;
}

.info-table td{
    padding:8px;
    vertical-align:top;
    width:50%;
}

.label{
    font-size:11px;
    color:#444;
    margin-bottom:4px;
}

.input-box{
    border:1px solid #cfd8dc;
    border-radius:8px;
    padding:8px 10px;
    background:#fff;
}

.input-date{
    background:#11bfc8;
    color:white;
    font-weight:bold;
}

.answer-table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

.answer-table th{
    background:#11bfc8;
    color:white;
    padding:10px;
    border:1px solid #d5d5d5;
    font-size:12px;
}

.answer-table td{
    border:1px solid #d5d5d5;
    padding:10px;
    font-size:11px;
}

.center{
    text-align:center;
}

.badge-yes{
    background:#198754;
    color:white;
    padding:5px 12px;
    border-radius:6px;
    font-weight:bold;
    display:inline-block;
}

.badge-no{
    background:#dc3545;
    color:white;
    padding:5px 12px;
    border-radius:6px;
    font-weight:bold;
    display:inline-block;
}

.result-box{
    background:#11bfc8;
    color:white;
    text-align:center;
    font-size:18px;
    font-weight:bold;
    padding:18px;
    border-radius:12px;
    margin-top:15px;
}

.recommend-box{
    margin-top:15px;
    border:1px solid #e3e3e3;
    border-radius:14px;
    overflow:hidden;
}

.recommend-header{
    background:#f0c541;
    color:white;
    font-weight:bold;
    padding:14px;
    font-size:14px;
}

.recommend-body{
    padding:18px;
    background:#fff;
    line-height:1.8;
}

.footer{
    text-align:center;
    margin-top:30px;
    color:#777;
    font-size:11px;
}
</style>
</head>

<body>

<?php
$identitas = $identitas ?? [];
$jawaban   = $jawaban ?? [];

$pertanyaan = [
    "Apakah Anda BAB lebih dari 5 kali sehari?",
    "Apakah konsistensi feses Anda cair?",
    "Apakah konsistensi feses Anda lembek?",
    "Apakah Anda merasa lemas?",
    "Apakah ubun-ubun Anda cekung?",
    "Apakah mulut / bibir Anda kering?",
    "Apakah turgor kulit menurun?",
    "Apakah denyut nadi cepat?",
    "Apakah mata terlihat cekung?",
    "Apakah nafas cepat?",
    "Apakah produksi urin sedikit?",
    "Apakah feses bercampur darah?",
    "Apakah Anda merasa mual?",
    "Apakah Anda muntah?",
    "Apakah Anda mengalami demam?"
];
?>

<div class="wrapper">

    <div class="title">Hasil Skrining Kesehatan Anda</div>

    <!-- INFORMASI UMUM -->
    <div class="section-title">Informasi Umum</div>

    <div class="info-box">
        <table class="info-table">
            <tr>
                <td>
                    <div class="label">Nama Lengkap</div>
                    <div class="input-box"><?= $identitas['nama'] ?? '-' ?></div>
                </td>
                <td>
                    <div class="label">Tanggal Skrining</div>
                    <div class="input-box input-date"><?= date('d-m-Y') ?></div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="label">Nomor Induk Kependudukan</div>
                    <div class="input-box"><?= $identitas['nik'] ?? '-' ?></div>
                </td>
                <td>
                    <div class="label">Provinsi</div>
                    <div class="input-box"><?= $identitas['prov'] ?? '-' ?></div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="label">Jenis Kelamin</div>
                    <div class="input-box"><?= $identitas['jk'] ?? '-' ?></div>
                </td>
                <td>
                    <div class="label">Kabupaten</div>
                    <div class="input-box"><?= $identitas['kab'] ?? '-' ?></div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="label">Tanggal Lahir</div>
                    <div class="input-box"><?= $identitas['tgl'] ?? '-' ?></div>
                </td>
                <td>
                    <div class="label">Kecamatan</div>
                    <div class="input-box"><?= $identitas['kec'] ?? '-' ?></div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="label">Kategori Usia</div>
                    <div class="input-box"><?= $identitas['usia'] ?? '-' ?></div>
                </td>
                <td>
                    <div class="label">Kelurahan</div>
                    <div class="input-box"><?= $identitas['kel'] ?? '-' ?></div>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <div class="label">RT/RW / Kode Pos</div>
                    <div class="input-box"><?= $identitas['kodepos'] ?? '-' ?></div>
                </td>
            </tr>
        </table>
    </div>

    <!-- RINCIAN -->
    <div class="section-title">Rincian Jawaban</div>

    <table class="answer-table">
        <tr>
            <th width="6%">No</th>
            <th>Pertanyaan</th>
            <th width="15%">Jawaban</th>
        </tr>

        <?php foreach($pertanyaan as $i => $p): ?>
            <?php $nilai = $jawaban["q".$i] ?? 0; ?>
            <tr>
                <td class="center"><?= $i + 1 ?></td>
                <td><?= $p ?></td>
                <td class="center">
                    <span class="<?= $nilai ? 'badge-yes' : 'badge-no' ?>">
                        <?= $nilai ? 'Ya' : 'Tidak' ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- HASIL -->
    <div class="section-title" style="margin-top:30px;">Hasil</div>

    <div class="result-box">
        <?= $hasil ?>
    </div>

    <!-- REKOMENDASI -->
    <div class="section-title" style="margin-top:30px;">Rekomendasi</div>

    <div class="recommend-box">
        <div class="recommend-header">
            Rekomendasi Penanganan
        </div>

        <div class="recommend-body">
            <?= $rekomendasi ?>
        </div>
    </div>

    <div class="footer">
        Halaman 1 dari 1<br>
        Laporan ini dihasilkan otomatis dari SIGAP
    </div>

</div>

</body>
</html>