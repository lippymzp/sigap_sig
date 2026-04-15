<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="pneu-hero text-white" data-aos="fade-up">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6">
    <h1>Pneumonia</h1>
    <p>
        Pneumonia adalah infeksi paru-paru yang menyebabkan kantung udara terisi cairan sehingga mengganggu pernapasan.
    </p>
    <button class="btn btn-light mt-3">Pelajari Selengkapnya →</button>
</div>

<div class="col-md-6 text-end">
    <img src="<?= base_url('img/pneumonia.png') ?>" class="img-fluid pneu-img">
</div>

</div>
</div>
</section>

<!-- FITUR -->
<section class="container mt-5 text-center" data-aos="fade-up">

<h4 class="text-teal mb-4">Fitur Menarik</h4>

<div class="row g-3">
<div class="col-md-3"><div class="fitur-box">Grafik Kesehatan</div></div>
<div class="col-md-3"><div class="fitur-box">Peta Persebaran</div></div>
<div class="col-md-3"><div class="fitur-box">Artikel</div></div>
<div class="col-md-3"><div class="fitur-box">Skrining</div></div>
</div>

</section>

<!-- GRAFIK -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3">Grafik Pneumonia</h4>

<div class="row mb-3">
<div class="col-md-3"><select class="form-control"><option>Kelurahan</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Kategori</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Tahun</option></select></div>
</div>

<div class="row">
<div class="col-md-9">
<div class="chart-box">
<canvas id="chartPneu"></canvas>
</div>
</div>

<div class="col-md-3">
<div class="legend-box">
<h6>Keterangan</h6>
<p>🟩 Sembuh</p>
<p>🟦 Pengobatan</p>
<p>🟨 Meninggal</p>
</div>
</div>
</div>

</section>

<!-- PETA -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3">Peta Persebaran</h4>

<div id="mapPneu"></div>

<div class="map-legend mt-3">
<span style="background:#f4a261">Rendah</span>
<span style="background:#e76f51">Sedang</span>
<span style="background:#d62828">Tinggi</span>
</div>

</section>

<!-- SCRIPT -->
<script>

/* CHART */
const ctx = document.getElementById('chartPneu');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Januari','Februari','Maret','April','Mei'],
        datasets: [
            {
                label: 'Sembuh',
                data: [110,90,70,50,160],
                backgroundColor: '#8ecae6'
            },
            {
                label: 'Pengobatan',
                data: [95,155,120,90,95],
                backgroundColor: '#219ebc'
            },
            {
                label: 'Meninggal',
                data: [40,20,40,40,60],
                backgroundColor: '#90dbf4'
            }
        ]
    }
});

/* MAP */
var map = L.map('mapPneu').setView([-7.9,112.6], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

L.marker([-7.9,112.6]).addTo(map).bindPopup("Kasus Tinggi");
L.marker([-7.8,112.7]).addTo(map).bindPopup("Kasus Sedang");

</script>

<?= $this->include('layout/footer') ?>