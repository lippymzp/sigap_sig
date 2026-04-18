<?php $this->setVar('penyakit', 'dbd'); ?>
<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="pneu-hero text-white" style="background: linear-gradient(135deg,#ff6b6b,#ff8787);">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-md-6">
        <h1>Demam Berdarah Dengue (DBD)</h1>
        <p>
          DBD adalah penyakit infeksi yang disebabkan oleh virus dengue 
          dan ditularkan melalui gigitan nyamuk <i>Aedes aegypti</i>.
        </p>
        <a href="#" class="btn btn-light mt-3">Pelajari Selengkapnya →</a>
      </div>

      <div class="col-md-6 text-end">
        <img src="<?= base_url('img/dbd.png') ?>" class="img-fluid" alt="DBD">
      </div>

    </div>
  </div>
</section>

<!-- FITUR -->
<section class="container mt-5 text-center">

  <h4 class="text-danger mb-4">Fitur Monitoring DBD</h4>

  <div class="row g-3">

    <div class="col-6 col-md-3">
      <a href="<?= base_url('grafik') ?>" class="fitur-box d-block text-center text-decoration-none">
        Grafik Kasus
      </a>
    </div>

    <div class="col-6 col-md-3">
      <a href="<?= base_url('peta') ?>" class="fitur-box d-block text-center text-decoration-none">
        Peta Persebaran
      </a>
    </div>

    <div class="col-6 col-md-3">
      <a href="<?= base_url('nyamuk') ?>" class="fitur-box d-block text-center text-decoration-none">
        Data Nyamuk
      </a>
    </div>

    <div class="col-6 col-md-3">
      <a href="<?= base_url('skriningdbd') ?>" class="fitur-box d-block text-center text-decoration-none">
        Skrining
      </a>
    </div>

  </div>

</section>

<?= $this->include('layout/footer') ?>