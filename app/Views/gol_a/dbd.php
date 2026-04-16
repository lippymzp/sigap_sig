<?php $this->setVar('penyakit', 'dbd'); ?>
<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="pneu-hero text-white" data-aos="fade-up" style="background: linear-gradient(135deg,#ff6b6b,#ff8787);">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6">
    <h1>Demam Berdarah Dengue (DBD)</h1>
    <p>
        DBD adalah penyakit akibat virus dengue yang ditularkan melalui gigitan nyamuk Aedes aegypti.
    </p>
    <button class="btn btn-light mt-3">Pelajari Selengkapnya →</button>
</div>

<div class="col-md-6 text-end">
    <img src="<?= base_url('img/dbd.png') ?>" class="img-fluid pneu-img">
</div>

</div>
</div>
</section>

<!-- FITUR -->
<section class="container mt-5 text-center" data-aos="fade-up">

<h4 class="text-danger mb-4">Fitur Monitoring DBD</h4>

<div class="row g-3">
<div class="col-md-3"><div class="fitur-box">Grafik Kasus</div></div>
<div class="col-md-3"><div class="fitur-box">Peta Persebaran</div></div>
<div class="col-md-3"><div class="fitur-box">Data Nyamuk</div></div>
<div class="col-md-3"><div class="fitur-box">Pencegahan</div></div>
</div>

</section>

<!-- GRAFIK -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-danger mb-3">Grafik DBD</h4>

<div class="row mb-3">
<div class="col-md-3"><select class="form-control"><option>Kelurahan</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Kategori</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Tahun</option></select></div>
</div>

<div class="row">
<div class="col-md-9">
<div class="chart-box">
<canvas id="chartDbd"></canvas>
</div>
</div>

<div class="col-md-3">
<div class="legend-box">
<h6>Keterangan</h6>
<p>🟢 Sembuh</p>
<p>🔵 Perawatan</p>
<p>🔴 Meninggal</p>
</div>
</div>
</div>

</section>

<!-- PETA -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-danger mb-3">Peta Persebaran DBD</h4>

<div id="mapDbd"></div>

<div class="map-legend mt-3">
<span style="background:#ffd166">Rendah</span>
<span style="background:#f77f00">Sedang</span>
<span style="background:#d62828">Tinggi</span>
</div>

</section>

<!-- SCRIPT -->
<script>

/* CHART DBD */
const ctx = document.getElementById('chartDbd');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Januari','Februari','Maret','April','Mei'],
        datasets: [
            {
                label: 'Sembuh',
                data: [80,120,90,70,140],
                backgroundColor: '#80ed99'
            },
            {
                label: 'Perawatan',
                data: [100,150,130,90,110],
                backgroundColor: '#00b4d8'
            },
            {
                label: 'Meninggal',
                data: [20,40,30,25,50],
                backgroundColor: '#e63946'
            }
        ]
    }
});

/* MAP */
var map = L.map('mapDbd').setView([-7.9,112.6], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

/* contoh marker */
L.marker([-7.9,112.6]).addTo(map).bindPopup("Kasus Tinggi DBD");
L.marker([-7.85,112.65]).addTo(map).bindPopup("Kasus Sedang DBD");

</script>

<?= $this->include('layout/footer') ?>