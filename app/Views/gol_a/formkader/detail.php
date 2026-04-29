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
    padding: 25px;
    margin-top: 40px;
    background: #fff;
}

.title {
    color: #00BBC2;
    font-weight: bold;
}

.label {
    font-weight: 600;
    color: #555;
}

.value {
    font-weight: 500;
}

.foto {
    width: 220px;
    border-radius: 10px;
    margin-top: 10px;
    cursor: pointer;
    transition: 0.3s;
}

.foto:hover {
    transform: scale(1.05);
}
</style>
</head>

<body>

<div class="container">
<div class="card-custom">

<h4 class="title mb-4">Detail Posyandu <?= $pos ?></h4>

<div class="row mb-3">
    <div class="col-md-4 label">Kelurahan</div>
    <div class="col-md-8 value"><?= $data['kelurahan'] ?? '-' ?></div>
</div>

<div class="row mb-3">
    <div class="col-md-4 label">Tanggal</div>
    <div class="col-md-8 value"><?= $data['tanggalinput'] ?? '-' ?></div>
</div>

<div class="row mb-3">
    <div class="col-md-4 label">Jumlah Diperiksa</div>
    <div class="col-md-8 value"><?= $data['diperiksa'] ?? '-' ?></div>
</div>

<div class="row mb-3">
    <div class="col-md-4 label">Jumlah Positif</div>
    <div class="col-md-8 value"><?= $data['positif'] ?? '-' ?></div>
</div>

<div class="row mb-3">
    <div class="col-md-4 label">Bagian Positif</div>
    <div class="col-md-8 value"><?= $data['bagian'] ?? '-' ?></div>
</div>

<?php if(!empty($data['foto'])): ?>
<div class="row mb-3">
    <div class="col-md-4 label">Foto</div>
    <div class="col-md-8">
        <img src="<?= base_url('uploads/'.$data['foto']) ?>" 
             class="foto"
             data-bs-toggle="modal"
             data-bs-target="#modalFoto">
    </div>
</div>
<?php endif; ?>

<a href="<?= base_url('formkader/rekap') ?>" class="btn btn-secondary mt-3">Kembali</a>

</div>
</div>

<!-- MODAL FOTO -->
<div class="modal fade" id="modalFoto" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Preview Foto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <img src="<?= base_url('uploads/'.$data['foto']) ?>" class="img-fluid">
      </div>

    </div>
  </div>
</div>

<!-- JS BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>