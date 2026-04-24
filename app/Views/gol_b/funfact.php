<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<h2 class="mb-4">Funfact TBC</h2>

<?php foreach($artikel as $a): ?>
<div class="card shadow-sm p-3 mb-3 border-0 rounded-4">
    <h4><?= esc($a['judul_artikel']) ?></h4>
    <p><?= substr(strip_tags($a['deskripsi_artikel']),0,150) ?>...</p>
    <small class="text-muted"><?= $a['tanggal_artikel'] ?></small>
</div>
<?php endforeach; ?>

<?= $this->endSection() ?>