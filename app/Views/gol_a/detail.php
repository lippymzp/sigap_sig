<!DOCTYPE html>
<html>
<head>
<title>Detail Posyandu</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f8f9fa;
}

.card-custom {
    border-radius: 15px;
    border: 2px solid #00BBC2;
    background: #ffffff;
    padding: 30px;
    margin-top: 40px;
}

.title {
    color: #00BBC2;
    font-weight: bold;
}

.label {
    font-weight: 600;
}

.value-box {
    background: #f1f3f5;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 15px;
}

/* FOTO */
.foto {
    width: 250px;
    border-radius: 10px;
    border: 1px solid #ddd;
    transition: 0.3s;
}

/* efek hover biar interaktif */
.foto:hover {
    transform: scale(1.05);
    cursor: pointer;
}

.btn-kembali {
    background: #00BBC2;
    color: white;
    border-radius: 10px;
}
</style>
</head>

<body>

<div class="container">

<div class="card-custom">

<h4 class="title">Detail Laporan Posyandu</h4>
<p class="mb-1"><b><?= $pos ?></b></p>

<div class="d-flex">
    <div style="width:120px;"><strong>Kelurahan</strong></div>
    <div>: <?= $data['kelurahan'] ?? '-' ?></div>
</div>

<?php if($data): ?>

<div class="row">

<div class="col-md-6">

    <div class="label">Tanggal Input</div>
    <div class="value-box"><?= $data['tanggalinput'] ?></div>

    <div class="label">Jumlah Diperiksa</div>
    <div class="value-box"><?= $data['diperiksa'] ?></div>

    <div class="label">Jumlah Positif</div>
    <div class="value-box"><?= $data['positif'] ?></div>

    <div class="label">Bagian Positif</div>
    <div class="value-box"><?= $data['bagian'] ?? '-' ?></div>
</div>

<div class="col-md-6 text-center">
    <div class="label mb-2">Foto</div>

    <?php if(!empty($data['foto'])): ?>
        <a href="<?= base_url('uploads/'.$data['foto']) ?>" target="_blank">
            <img src="<?= base_url('uploads/'.$data['foto']) ?>" class="foto">
        </a>
        <small class="d-block mt-2 text-muted">Klik gambar untuk memperbesar</small>
    <?php else: ?>
        <p>- Tidak ada foto -</p>
    <?php endif; ?>
</div>

</div>

<?php else: ?>

<div class="alert alert-danger text-center">
    Data belum tersedia untuk pos ini
</div>

<?php endif; ?>


<a href="/formkader/rekap" class="btn btn-kembali mt-4">Kembali ke Rekap</a> 

</div>
</div>

</body>
</html>