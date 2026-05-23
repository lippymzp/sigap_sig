<!DOCTYPE html>
<html>
<head>
<title>Rekap PSN</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background:#f8f9fa; }

.card-custom{
    border-radius:15px;
    border:2px solid #00BBC2;
    background:#fff;
    padding:30px;
    margin-top:40px;
}

.title{color:#00BBC2;font-weight:bold;}

.table thead{background:#00BBC2;color:white;}

.sudah{background:#e6fcf5;}
.belum{background:#ffe3e3;}

.btn-tosca{
    background:#00BBC2;
    color:white;
    border-radius:8px;
}

.foto{
    width:70px;
    border-radius:6px;
}

/* --- RESPONSIVE MOBILE FIXES --- */
@media (max-width: 768px) {
    .card-custom { padding: 15px; margin-top: 20px; }
    .row.g-2 > div { margin-bottom: 10px; }
}
</style>
</head>

<body>

<div class="container">
<div class="card-custom">

<h4 class="title">Rekap Laporan PSN 2026</h4>

<a href="/dbd/exportrekappsn" class="btn btn-success mb-3">Export Excel</a>

<form method="GET" class="mb-3 row g-2">

<div class="col-md-2">
<input type="date" name="start" class="form-control" value="<?= $_GET['start'] ?? '' ?>">
</div>

<div class="col-md-2">
<input type="date" name="end" class="form-control" value="<?= $_GET['end'] ?? '' ?>">
</div>

<div class="col-md-2">
<select name="status" class="form-control">
<option value="">Semua</option>
<option value="sudah">Sudah</option>
<option value="belum">Belum</option>
</select>
</div>

<div class="col-md-2">
<input type="text" name="kelurahan" class="form-control" placeholder="Kelurahan">
</div>

<div class="col-md-2">
<input type="text" name="posyandu" class="form-control" placeholder="CATLEYA">
</div>

<div class="col-md-2 d-flex gap-2">
<button class="btn btn-tosca w-100">Filter</button>
<a href="<?= base_url('formkader/rekap') ?>" class="btn btn-secondary w-100">Reset</a>
</div>

</form>

<div class="alert alert-info">
<b>Diperiksa:</b> <span id="diperiksa"><?= $totalDiperiksa ?? 0 ?></span> |
<b>Positif:</b> <span id="positif"><?= $totalPositif ?? 0 ?></span>
</div>

<div class="table-responsive">
    <table class="table table-bordered text-center mb-0">

    <thead>
    <tr>
    <th>No</th>
    <th>Posyandu</th>
    <th>Kelurahan</th>
    <th>Tanggal</th>
    <th>Status</th>
    <th>Diperiksa</th>
    <th>Positif</th>
    <th>Foto</th>
    <th>Aksi</th>
    </tr>
    </thead>

    <tbody>

    <?php 
    $no = 1;

    /* 🔥 INI FIX UTAMA */
    foreach(($laporanpsn ?? []) as $pos => $data):

    $status = $data ? 'sudah' : 'belum';
    ?>

    <tr class="<?= $status ?>">

    <td><?= $no++ ?></td>
    <td><?= $pos ?></td>
    <td><?= $data['kelurahan'] ?? '-' ?></td>
    <td><?= $data['tanggalinput'] ?? '-' ?></td>

    <td>
    <?= $status == 'sudah' ? 'Sudah Isi' : 'Belum Isi' ?>
    </td>

    <td><?= $data['diperiksa'] ?? '-' ?></td>
    <td><?= $data['positif'] ?? '-' ?></td>

    <td>
    <?php if(!empty($data['foto'])): ?>
    <img src="<?= base_url('uploads/'.$data['foto']) ?>" class="foto">
    <?php else: ?> - <?php endif; ?>
    </td>

    <td>
    <?php if($data): ?>
    <a href="<?= base_url('formkader/detail/'.$pos) ?>" class="btn btn-sm btn-info text-white">Detail</a>
    <?php endif; ?>
    </td>

    </tr>

    <?php endforeach; ?>

    </tbody>
    </table>
</div>

</div>
</div>

</body>
</html>