<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Hasil Diare</title>

<style>
body {
    font-family: Arial;
    font-size: 12px;
}

h2 {
    text-align: center;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.table th, .table td {
    border: 1px solid #000;
    padding: 5px;
}

.badge-yes {
    color: red;
    font-weight: bold;
}

.badge-no {
    color: green;
    font-weight: bold;
}
</style>
</head>

<body>

<?php
$identitas = $identitas ?? [];
$jawaban   = $jawaban ?? [];
?>

<h2>Hasil Skrining Diare</h2>

<p><b>Nama:</b> <?= $identitas['nama'] ?? '-' ?></p>
<p><b>NIK:</b> <?= $identitas['nik'] ?? '-' ?></p>
<p><b>Tanggal:</b> <?= date('d-m-Y') ?></p>

<hr>

<h3><?= $hasil ?></h3>
<p><b>Skor:</b> <?= $skor ?></p>

<h4>Rincian Jawaban</h4>

<table class="table">
<tr>
<th>No</th>
<th>Pertanyaan</th>
<th>Jawaban</th>
</tr>

<?php
$pertanyaan = [
"Frekuensi BAB > 3x?",
"Tinja cair?",
"Nyeri perut?",
"Ada darah/lendir?",
"Mual/muntah?",
"Lemas/dehidrasi?",
"Demam?",
"Makan tidak higienis?",
"Air tidak matang?",
"Kontak penderita?"
];

foreach($pertanyaan as $i => $p):
$nilai = $jawaban["q".$i] ?? 0;
?>

<tr>
<td><?= $i+1 ?></td>
<td><?= $p ?></td>
<td class="<?= $nilai ? 'badge-yes' : 'badge-no' ?>">
<?= $nilai ? 'Ya' : 'Tidak' ?>
</td>
</tr>

<?php endforeach; ?>

</table>

<h4>Rekomendasi</h4>
<p><?= $rekomendasi ?? '-' ?></p>

</body>
</html>