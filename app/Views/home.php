<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="hero">
<div class="container">
  <div class="row align-items-center">

    <div class="col-md-6">
      <h5 class="text-teal">Satu Peta, Satu Data</h5>
      <h2>Apa itu Penyakit Menular?</h2>
      <p>
        Penyakit menular adalah penyakit yang dapat berpindah dari satu orang ke orang lain melalui udara, air, makanan, maupun kontak langsung.
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

<!-- 🔥 SLIDER PREMIUM -->
<section class="container mt-5">

<div class="position-relative">

<button class="scroll-btn left" onclick="scrollCardLeft()">‹</button>
<button class="scroll-btn right" onclick="scrollCardRight()">›</button>

<div class="card-slider" id="cardSlider">

    <div class="card-item">
        <div class="card-content">
            <h5>Satu Platform Untuk Memantau, Memetakan, dan Mendeteksi Penyakit</h5>
            <p>
                SIGAP membantu pemantauan penyakit secara terintegrasi.
            </p>
        </div>
        <img src="<?= base_url('img/foto.png') ?>">
    </div>

    <div class="card-item">
        <div class="card-content">
            <h5>SIGAP: Cepat Deteksi, Tepat Informasi</h5>
            <p>
                Mendukung akses data kesehatan yang cepat dan akurat.
            </p>
        </div>
        <img src="<?= base_url('img/foto1.png') ?>">
    </div>

    <div class="card-item">
        <div class="card-content">
            <h5>Interaktif dan Berbasis Data Wilayah</h5>
            <ul>
                <li>Peta persebaran penyakit</li>
                <li>Dashboard interaktif</li>
                <li>Visualisasi wilayah</li>
            </ul>
        </div>
        <img src="<?= base_url('img/foto2.png') ?>">
    </div>

</div>
</div>
</section>

<!-- MAP -->
<section class="container mt-5">
<h4 class="text-teal">Peta Interaktif Puskesmas</h4>

<div class="map-box">
    <div id="map"></div>

    <div class="map-info">
        <span>Lat: <b id="lat">-</b></span>
        <span>Lng: <b id="lng">-</b></span>
    </div>
</div>
</section>

<!-- ABOUT -->
<section class="about mt-5">
<div class="container">

<h4 class="text-teal text-center mb-4">Tentang Kami</h4>

<div class="row align-items-center mb-5">

    <div class="col-md-6">
        <img src="<?= base_url('img/prof.png') ?>" class="img-fluid about-img">
    </div>

    <div class="col-md-6">
        <h5 class="text-teal">SIGAP</h5>
        <p>
            Platform berbasis Sistem Informasi Geografis yang menghadirkan pemetaan dan visualisasi data penyakit Demam Berdarah Dengue, Tuberkulosis, Pneumonia, dan Diare dalam satu sistem terintegrasi. Dikembangkan untuk mendukung transparansi dan akses data kesehatan masyarakat secara menyeluruh dan akurat.
        </p>
        <button class="btn btn-teal">Selengkapnya</button>
    </div>

</div>

<div class="row align-items-center">

    <div class="col-md-6">
        <h5>Mengapa Pemantauan Penting?</h5>
        <p>
            Penyakit menular masih menjadi tantangan di berbagai wilayah, termasuk Kabupaten Jember. Penyajian data dalam bentuk peta membantu menampilkan distribusi kasus secara lebih jelas, sehingga SIGAP hadir untuk menghadirkan gambaran kondisi kesehatan wilayah yang informatif dan mudah dipahami oleh semua pihak.
        </p>
    </div>

    <div class="col-md-6 text-center">
        <img src="<?= base_url('img/batuk.png') ?>" class="img-fluid about-img">
    </div>

</div>

</div>
</section>

<!-- PENYAKIT -->
<section class="penyakit-section text-center mt-5">
<div class="container">

<h4 class="text-white mb-5">Penyakit yang dipantau di SIGAP</h4>

<div class="row g-4 justify-content-center">

<div class="col-md-3"><div class="penyakit-card"><h6>DBD</h6><p>Penyakit yang disebabkan oleh virus dengue dan ditularkan lewat gigitan nyamuk Aedes aegypti. </p></div></div>
<div class="col-md-3"><div class="penyakit-card"><h6>TBC</h6><p>Infeksi bakteri yang menyerang paru-paru dan menular lewat udara saat penderita batuk atau bersin.</p></div></div>
<div class="col-md-3"><div class="penyakit-card"><h6>Pneumonia</h6><p>Peradangan pada paru-paru akibat infeksi bakteri atau virus yang menyebabkan kantung udara terisi cairan</p></div></div>
<div class="col-md-3"><div class="penyakit-card"><h6>Diare</h6><p>Kondisi buang air besar lebih dari 3 kali sehari akibat infeksi dari makanan atau minuman yang tidak bersih.</p></div></div>

</div>
</div>
</section>

<!-- CONTACT -->
<section class="contact-section mt-5">
<div class="container">

<div class="contact-modern">

    <h4>Hubungi kami</h4>
    <p>Punya pertanyaan? Kami di sini untuk membantu.</p>

    <div class="contact-form">
        <input type="text" placeholder="email angkatan">
        <button>Hubungi Kami</button>
    </div>

</div>

</div>
</section>

<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const map = L.map('map').setView([-7.9, 112.6], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    let marker = L.marker([-7.9,112.6]).addTo(map);

    map.on('click', function(e){
        document.getElementById('lat').innerText = e.latlng.lat.toFixed(6);
        document.getElementById('lng').innerText = e.latlng.lng.toFixed(6);
        marker.setLatLng(e.latlng);
    });

});

/* SLIDER PREMIUM */
function scrollCardLeft() {
    document.getElementById('cardSlider').scrollBy({ left: -400, behavior: 'smooth' });
}

function scrollCardRight() {
    document.getElementById('cardSlider').scrollBy({ left: 400, behavior: 'smooth' });
}
</script>

<?= $this->include('layout/footer') ?>