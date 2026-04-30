<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<style>
.main-content {
  padding: 30px 35px;
}

.title {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 30px;
}

.card-wrapper {
  position: relative;
  margin-bottom: 40px;
  overflow: visible;
}

.card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: linear-gradient(135deg, #4bb6b7, #1ea896);
  border-radius: 18px;
  padding: 20px;
  color: white;
  position: relative;
  min-height: 130px;
}

.card-text {
  max-width: 55%;
  z-index: 2;
}

.card-text h2 {
  font-size: 26px;
  margin-bottom: 12px;
}

.card-text p {
  font-size: 15px;
  margin-bottom: 20px;
}

.card-text button {
  background: #e6f0f0;
  border: none;
  padding: 12px 20px;
  border-radius: 25px;
  font-weight: 600;
  color: #1ea896;
}

.card-image {
  position: absolute;
  right: 25px;
  bottom: 0;
}

.card-image img {
  width: 230px;
}

.card-image.gejala-img img {
  width: 170px;
}
</style>

<div class="main-content">
  <h1 class="title">Rekap Skrining</h1>

  <div class="card-wrapper">
    <div class="card">
      <div class="card-text">
        <h2>Skrining Lingkungan</h2>
        <p>Fitur Skrining Lingkungan menilai risiko DBD berdasarkan kondisi lingkungan.</p>
        <button>Lihat Rekapan</button>
      </div>
      <div class="card-image">
        <img src="<?= base_url('img/dbd_skrining_l.png') ?>">
      </div>
    </div>
  </div>

  <div class="card-wrapper">
    <div class="card">
      <div class="card-text">
        <h2>Skrining Gejala</h2>
        <p>Fitur Skrining Gejala digunakan untuk menilai kemungkinan DBD berdasarkan gejala.</p>
        <button>Lihat Rekapan</button>
      </div>
      <div class="card-image gejala-img">
        <img src="<?= base_url('img/dbd_skrining_g.png') ?>">
      </div>
    </div>
  </div>

</div>

<?= $this->endSection() ?>