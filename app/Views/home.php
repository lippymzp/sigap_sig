<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="hero">
<div class="container">
  <div class="row align-items-center">

    <div class="col-md-6">
      <h5 class="text-teal">Satu Peta, Satu Data</h5>
      <h2>Apa itu Penyakit Menular?</h2>
      <p>
        Penyakit menular adalah penyakit yang dapat berpindah dari satu orang ke orang lain melalui udara, makanan, atau kontak langsung.
      </p>
    </div>

    <div class="col-md-6 text-center">
      <img src="https://img.freepik.com/free-vector/doctor-character-background_1270-84.jpg" class="img-fluid hero-img">
    </div>

  </div>
</div>
</section>

<!-- MENU -->
<section class="container text-center mt-5">
<h4 class="text-teal mb-4">Platform Pemetaan Penyakit Berbasis Data</h4>

<div class="d-flex justify-content-center flex-wrap gap-3">

<div class="menu-box">Demam Berdarah</div>
<div class="menu-box">Tuberkulosis</div>
<div class="menu-box">Pneumonia</div>
<div class="menu-box">Diare</div>

</div>
</section>

<!-- SLIDER CARD -->
<section class="container mt-5">
<div class="card big-card p-4">

<div class="row align-items-center">
  <div class="col-md-6">
    <h4>Satu Platform Untuk Memantau Penyakit</h4>
    <p>SIGAP membantu pemantauan DBD, TBC, Pneumonia, dan Diare.</p>
  </div>

  <div class="col-md-6 text-center">
    <img src="https://img.freepik.com/free-vector/medical-team-concept-illustration_114360-1540.jpg" class="img-fluid">
  </div>
</div>

</div>
</section>

<!-- MAP -->
<section class="container mt-5">
<h4 class="text-teal">Peta Interaktif Puskesmas</h4>

<div id="map"></div>
</section>

<!-- ABOUT -->
<section class="about mt-5">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6">
<img src="https://img.freepik.com/free-photo/doctor-touching-virtual-screen_53876-93721.jpg" class="img-fluid rounded">
</div>

<div class="col-md-6">
<h4 class="text-teal">SIGAP</h4>
<p>Sistem informasi geografis analisis dan pemantauan penyakit.</p>
<button class="btn btn-teal">Selengkapnya</button>
</div>

</div>
</div>
</section>

<!-- PENYAKIT -->
<section class="penyakit text-center mt-5">
<div class="container">

<h4 class="mb-4">Penyakit yang dipantau di SIGAP</h4>

<div class="row g-3">

<div class="col-md-3">
<div class="card p-3">DBD</div>
</div>

<div class="col-md-3">
<div class="card p-3">TBC</div>
</div>

<div class="col-md-3">
<div class="card p-3">Pneumonia</div>
</div>

<div class="col-md-3">
<div class="card p-3">Diare</div>
</div>

</div>
</div>
</section>

<!-- CONTACT -->
<section class="container mt-5">
<div class="contact-box p-4">

<h5>Hubungi kami</h5>

<div class="d-flex gap-2">
<input type="text" class="form-control" placeholder="email anda">
<button class="btn btn-teal">Hubungi</button>
</div>

</div>
</section>

<!-- MAP SCRIPT -->
<script>
var map = L.map('map').setView([-7.9, 112.6], 8);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

L.marker([-7.9,112.6])
.addTo(map)
.bindPopup("Puskesmas")
.openPopup();
</script>

<?= $this->include('layout/footer') ?>