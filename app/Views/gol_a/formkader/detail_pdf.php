<!DOCTYPE html>
<html>
<head>
<style>
body { font-family: Arial; font-size: 12px; }
h2 { color: #00BBC2; }

.box {
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.label {
    font-weight: bold;
}
</style>
</head>

<body>

<h2>Detail Posyandu <?= $pos ?></h2>

<div class="box">
<span class="label">Kelurahan:</span>
<?= $data['kelurahan'] ?? '-' ?>
</div>

<div class="box">
<span class="label">Tanggal:</span>
<?= $data['tanggalinput'] ?? '-' ?>
</div>

<div class="box">
<span class="label">Diperiksa:</span>
<?= $data['diperiksa'] ?? '-' ?>
</div>

<div class="box">
<span class="label">Positif:</span>
<?= $data['positif'] ?? '-' ?>
</div>

<div class="box">
<span class="label">Bagian:</span>
<?= $data['bagian'] ?? '-' ?>
</div>

<?php if(!empty($data['foto'])): ?>
    <div class="box">
        <span class="label">Foto:</span><br>
        <img src="<?= base_url('uploads/'.$data['foto']) ?>" width="200">
    </div>
<?php endif; ?>

</body>
</html>