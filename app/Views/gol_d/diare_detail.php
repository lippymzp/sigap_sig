    <?= $this->include('layout/header') ?>

<section style="background:linear-gradient(135deg,#20c997,#0dcaf0); padding:60px 0;">

<div class="container">

<div class="card p-4 shadow-lg" style="border-radius:20px; max-width:900px; margin:auto;">

<?php if (!empty($funfact)): ?>

<h4 class="fw-bold mb-3">
    <?= esc($funfact['judul_funfact']) ?>
</h4>

<p>
    <?= nl2br(esc($funfact['deskripsi_funfact'])) ?>
</p>

<div class="text-center my-4">
    <img src="<?= base_url('uploads/funfact/' . $funfact['gambar_funfact']) ?>"
         class="img-fluid rounded"
         style="max-height:350px; width:100%; object-fit:cover;">
</div>

<div style="line-height:1.9; font-size:16px;">
    <?= nl2br($funfact['isi_funfact']) ?>
</div>

<div class="text-end mt-4">
    <a href="<?= base_url('diare') ?>" class="btn btn-teal px-4">
        Kembali
    </a>
</div>

<?php else: ?>

<h4>Funfact belum tersedia</h4>

<div class="text-end mt-4">
    <a href="<?= base_url('diare') ?>" class="btn btn-teal px-4">
        Kembali
    </a>
</div>

<?php endif; ?>

</div>

</div>
</section>

<?= $this->include('layout/footer') ?>