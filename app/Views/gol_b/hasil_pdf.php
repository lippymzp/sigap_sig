<?php
$d = $data;

$pertanyaan = [

"Apakah Anda mengalami batuk dan berdahak terus-menerus selama dua minggu?",

"Apakah Anda mengalami batuk bercampur darah?",

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

$jawaban = [
    $d['var1'],  $d['var2'],  $d['var3'],  $d['var4'],
    $d['var5'],  $d['var6'],  $d['var7'],  $d['var8'],
    $d['var9'],  $d['var10'], $d['var11']
];

$hasil = $d['hasil'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
* { margin:0; padding:0; box-sizing:border-box; }

body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    color: #111;
    padding: 28px;
    background: white;
}

/* LOGO */
.logo {
    background: red;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: bold;
    display: inline-block;
    margin-bottom: 8px;
}

/* JUDUL */
.judul {
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 14px;
}

/* INFO BOX */
.info-box {
    border: 1.5px solid #9de2ec;
    border-radius: 10px;
    padding: 14px;
    margin-bottom: 16px;
}

.info-title {
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 10px;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
}

.info-table td {
    padding: 4px 6px;
    font-size: 11px;
    vertical-align: middle;
}

.info-table td.label {
    font-weight: bold;
    width: 22%;
    color: #333;
}

.info-table td.value {
    width: 28%;
    background: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 4px 8px;
}

.info-table td.value-blue {
    width: 28%;
    background: #67d4dc;
    color: white;
    border-radius: 5px;
    padding: 4px 8px;
    font-weight: bold;
}

.rt-table { border-collapse: collapse; margin-top: 4px; }
.rt-table td {
    width: 36px;
    height: 28px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
    background: #f5f5f5;
    font-size: 11px;
    padding: 0;
}
.rt-label { font-size: 10px; font-weight: bold; margin-bottom: 2px; }

/* SECTION TITLE */
.section-title {
    font-size: 12px;
    font-weight: bold;
    margin: 14px 0 6px;
}

/* RINCIAN TABLE */
.rincian-table {
    width: 100%;
    border-collapse: collapse;
}

.rincian-table th {
    background: #1ecad3;
    color: white;
    padding: 8px 10px;
    font-size: 11px;
    text-align: center;
}

.rincian-table td {
    padding: 6px 10px;
    border-bottom: 1px solid #eee;
    font-size: 11px;
    vertical-align: middle;
}

.rincian-table td:nth-child(1) { text-align: center; width: 32px; }
.rincian-table td:nth-child(3) { text-align: center; width: 65px; }

.badge-ya {
    background: #ffe2e2;
    color: #c40000;
    border: 1px solid #f87171;
    border-radius: 20px;
    padding: 2px 10px;
    font-size: 10px;
    font-weight: bold;
}

.badge-tidak {
    background: #dcfce7;
    color: #008000;
    border: 1px solid #4ade80;
    border-radius: 20px;
    padding: 2px 10px;
    font-size: 10px;
    font-weight: bold;
}

/* HASIL */
.hasil-box {
    text-align: center;
    padding: 11px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 8px;
    margin: 6px 0 14px;
}
.hasil-tb   { background: #ffe2e2; color: #c40000; border: 1px solid #f87171; }
.hasil-aman { background: #dcfce7; color: #008000; border: 1px solid #4ade80; }

/* REKOMENDASI */
.rekom-box {
    border: 1px solid #bfd3ff;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 11px;
    line-height: 1.7;
    margin-bottom: 14px;
}

/* TIPS */
.tips-wrapper {
    page-break-inside: avoid;
    position: relative;
    margin-top: 14px;
}

.tips-icon {
    font-size: 28px;
    position: absolute;
    top: -8px;
    left: 6px;
    z-index: 2;
}

.tips-header {
    background: #1ecad3;
    color: white;
    padding: 8px 16px 8px 44px;
    font-size: 13px;
    font-weight: bold;
    border-radius: 20px;
    margin-bottom: -12px;
    position: relative;
    z-index: 1;
    width: 92%;
    margin-left: 20px;
}

.tips-body {
    background: #cfe0ff;
    padding: 20px 24px 14px 34px;
    border-radius: 14px;
    width: 88%;
    margin-left: 28px;
}

.tips-body li {
    margin-bottom: 5px;
    font-size: 11px;
    color: #1f2937;
}

/* FOOTER */
.footer {
    margin-top: 20px;
    font-size: 10px;
    color: #888;
    border-top: 1px solid #ddd;
    padding-top: 6px;
    display: table;
    width: 100%;
}
.footer-left  { display: table-cell; text-align: left; }
.footer-right { display: table-cell; text-align: right; }

/* FIELD LABEL & VALUE */
.field-label {
    font-size: 11px;
    font-weight: bold;
    color: #333;
    margin-bottom: 3px;
    margin-top: 8px;
}

.field-value {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 7px 10px;
    font-size: 11px;
    color: #333;
    width: 100%;
}

.field-blue {
    background: #67d4dc;
    color: white;
    border: none;
    font-weight: bold;
}

</style>
</head>
<body>

<!-- LOGO -->
<div class="logo">LOGO</div>

<!-- JUDUL -->
<div class="judul">Hasil Skrining [Nama Penyakit] Anda</div>

<!-- INFORMASI UMUM -->
<div class="info-box">
    <div class="info-title">Informasi Umum</div>

    <table class="info-table">
        <tr>
            <!-- KIRI -->
            <td style="width:48%; vertical-align:top; padding-right:16px;">

                <div class="field-label">Nama Lengkap</div>
                <div class="field-value"><?= $d['nama'] ?></div>

                <div class="field-label">Nomor Induk Kependudukan</div>
                <div class="field-value"><?= $d['nik'] ?></div>

                <div class="field-label">Jenis Kelamin</div>
                <div class="field-value"><?= ($d['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></div>

                <div class="field-label">Tanggal Lahir</div>
                <div class="field-value"><?= $d['tanggal_lahir'] ?></div>

                <div class="field-label">Kategori Usia</div>
                <div class="field-value"><?= $d['kategori_usia'] ?></div>

            </td>

            <!-- KANAN -->
            <td style="width:48%; vertical-align:top;">

                <div class="field-label">Tanggal Skrining</div>
                <div class="field-value field-blue"><?= $d['tanggal_skrining'] ?></div>

                <div class="field-label">Provinsi</div>
                <div class="field-value"><?= $d['provinsi'] ?></div>

                <div class="field-label">Kabupaten</div>
                <div class="field-value"><?= $d['kabupaten'] ?></div>

                <div class="field-label">Kecamatan</div>
                <div class="field-value"><?= $d['kecamatan'] ?></div>

                <div class="field-label">Kelurahan</div>
                <div class="field-value"><?= $d['kelurahan'] ?></div>

                <!-- RT RW -->
                <table style="margin-top:6px; border-collapse:collapse;">
                    <tr>
                        <td style="font-size:10px; font-weight:bold; padding-right:4px;">RT</td>
                        <td style="width:32px; height:26px; text-align:center; border:1px solid #ddd; border-radius:5px; background:#f5f5f5; font-size:11px;"><?= $d['rt'] ?? '-' ?></td>
                        <td style="font-size:10px; font-weight:bold; padding:0 4px;">RW</td>
                        <td style="width:32px; height:26px; text-align:center; border:1px solid #ddd; border-radius:5px; background:#f5f5f5; font-size:11px;"><?= $d['rw'] ?? '-' ?></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</div>

<!-- RINCIAN JAWABAN -->
<div class="section-title">Rincian Jawaban</div>

<table class="rincian-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($pertanyaan as $i => $tanya): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $tanya ?></td>
            <td>
                <?php if(($jawaban[$i] ?? '') == 'Iya'): ?>
                    <span class="badge-ya">Ya</span>
                <?php else: ?>
                    <span class="badge-tidak">Tidak</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- HASIL -->
<div class="section-title">Hasil</div>
<div class="hasil-box <?= ($hasil == 'TB') ? 'hasil-tb' : 'hasil-aman' ?>">
    <?= ($hasil == 'TB') ? 'Anda Berisiko TB' : 'Anda Tidak Berisiko TB' ?>
</div>

<!-- REKOMENDASI -->
<div class="section-title">Rekomendasi</div>
<div class="rekom-box">
    <?php if($hasil == 'TB'): ?>
        Berdasarkan hasil skrining, Anda memiliki risiko Tuberkulosis (TB). Disarankan untuk segera melakukan pemeriksaan lebih lanjut di fasilitas pelayanan kesehatan terdekat.
    <?php else: ?>
        Berdasarkan hasil skrining, saat ini Anda tidak menunjukkan risiko Tuberkulosis (TB). Tetap pertahankan kondisi kesehatan Anda dan lakukan pemantauan mandiri terhadap gejala yang mungkin muncul.
    <?php endif; ?>
</div>

<!-- TIPS -->
<div class="tips-wrapper">
    <div class="tips-icon">📖</div>
    <div class="tips-header">
        <?= ($hasil == 'TB') ? 'Tips Sementara Sebelum Pemeriksaan' : 'Tips Kesehatan' ?>
    </div>
    <div class="tips-body">
        <ul>
        <?php if($hasil == 'TB'): ?>
            <li>Gunakan masker saat berinteraksi dengan orang lain</li>
            <li>Terapkan etika batuk (menutup mulut dan hidung saat batuk/bersin)</li>
            <li>Hindari kontak dekat dengan anak-anak, lansia, atau orang dengan daya tahan tubuh rendah</li>
            <li>Jaga daya tahan tubuh dengan makan bergizi dan istirahat cukup</li>
        <?php else: ?>
            <li>Konsumsi makanan bergizi seimbang setiap hari</li>
            <li>Rutin berolahraga minimal 30 menit</li>
            <li>Istirahat yang cukup</li>
            <li>Jaga kebersihan lingkungan dan ventilasi rumah</li>
        <?php endif; ?>
        </ul>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    <div class="footer-left">Laporan ini dihasilkan otomatis dari SIGAP</div>
    <div class="footer-right">Halaman 1 dari 1</div>
</div>

</body>
</html>