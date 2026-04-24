<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="card border-0 shadow-sm p-4 rounded-4">

<img src="<?= base_url('uploads/berita/'.($berita['gambar_berita'] ?: 'default.jpg')) ?>"
style="width:100%;height:350px;object-fit:cover;border-radius:18px;">

<h2 class="fw-bold mt-4 mb-3">
<?= $berita['judul_berita'] ?>
</h2>

<p class="text-muted mb-4">
<?= date('d F Y', strtotime($berita['tanggal_berita'])) ?>
• <?= $berita['penulis'] ?? 'Admin' ?>
</p>

<div style="line-height:1.9;font-size:16px;">

<?= nl2br($berita['isi_berita'] ?? $berita['deskripsi_berita']) ?>

</div>

<a href="<?= base_url('tbc/berita') ?>"
class="btn btn-info text-white mt-4">
← Kembali
</a>

</div>

<?= $this->endSection() ?>