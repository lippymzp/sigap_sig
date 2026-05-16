<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>

<?= $this->section('content') ?>

<div class="section-block">

    <div class="section-header">
        <div>
            <h5>Grafik Interaktif Penyebaran</h5>
            <p class="sub">
                Visualisasi kepadatan kasus berdasarkan grafik
            </p>
        </div>
    </div>

    <iframe 
        src="<?= base_url('grafik_pneumonia?embed=1') ?>" 
        width="100%"
        height="1200"
        frameborder="0"
        scrolling="yes">
    </iframe>

</div>

<?= $this->endSection() ?>