<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Hasil Data Pasien</h4>

    <!-- 🔥 TOMBOL EXPORT -->
    <a href="<?= base_url('dbd/export') ?>" 
       class="btn"
       style="background:#00BBC2; color:white; border-radius:10px;">
        📤 Export Data
    </a>
</div>

<div class="card shadow-sm p-3" style="border-radius:15px;">

<table class="table table-bordered align-middle">
<tr style="background:#00BBC2; color:white;">
<th>No</th>
<th>Kecamatan</th>
<th>Desa</th>
<th>JK</th>
<th>Usia</th>
<th>Kasus</th>
</tr>

<?php if(!empty($pasien)): ?>
<?php $no=1; foreach($pasien as $p): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $p['kecamatan'] ?></td>
<td><?= $p['desa'] ?></td>
<td><?= $p['jk'] ?></td>
<td><?= $p['usia'] ?></td>
<td>1</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
<td colspan="6" class="text-center">Belum ada data</td>
</tr>
<?php endif; ?>

</table>

</div>

<?= $this->endSection() ?>