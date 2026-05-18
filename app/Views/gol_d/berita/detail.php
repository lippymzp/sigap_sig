<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<div class="container p-4">

    <div class="card shadow border-0 rounded-4 p-4">

        <h1 class="fw-bold mb-4">
            <?= esc($berita['judul_berita']) ?>
        </h1>

        <img
            src="<?= base_url('uploads/berita/' . $berita['gambar_berita']) ?>"
            style="width:100%; max-height:450px; object-fit:cover; border-radius:20px;"
        >

        <div class="mt-4 text-muted">
            Penulis: <?= esc($berita['penulis']) ?>
            |
            <?= date('d F Y', strtotime($berita['tanggal_berita'])) ?>
        </div>

        <div class="mt-4" style="font-size:18px; line-height:1.9;">
            <?= nl2br(esc($berita['isi_berita'])) ?>
        </div>

        <a href="<?= base_url('admind/berita') ?>"
           class="btn btn-info mt-4">
            Kembali
        </a>

    </div>

</div>

<?= $this->endSection() ?>