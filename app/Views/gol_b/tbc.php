<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="pneu-hero text-white" data-aos="fade-up" style="background: linear-gradient(135deg,#2a9d8f,#52b788);">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6">
    <h1>Tuberkulosis (TBC)</h1>
    <p>
        TBC adalah penyakit infeksi yang disebabkan oleh bakteri Mycobacterium tuberculosis dan menyerang paru-paru.
    </p>
    <button class="btn btn-light mt-3">Pelajari Selengkapnya →</button>
</div>

<div class="col-md-6 text-end">
    <img src="<?= base_url('img/tbc.png') ?>" class="img-fluid pneu-img">
</div>

</div>
</div>
</section>

<!-- FITUR -->
<section class="container mt-5 text-center" data-aos="fade-up">

<h4 class="text-success mb-4">Fitur Monitoring TBC</h4>

<div class="row g-3">
<div class="col-md-3"><div class="fitur-box">Grafik Kasus</div></div>
<div class="col-md-3"><div class="fitur-box">Peta Persebaran</div></div>
<div class="col-md-3"><div class="fitur-box">Data Pasien</div></div>
<div class="col-md-3"><div class="fitur-box">Pengobatan</div></div>
</div>

</section>

<!-- GRAFIK -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-success mb-3">Grafik TBC</h4>

<div class="row mb-3">
<div class="col-md-3"><select class="form-control"><option>Kelurahan</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Kategori</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Tahun</option></select></div>
</div>

<div class="row">
<div class="col-md-9">
<div class="chart-box">
<canvas id="chartTbc"></canvas>
</div>
</div>

<div class="col-md-3">
<div class="legend-box">
<h6>Keterangan</h6>
<p>🟢 Sembuh</p>
<p>🟡 Pengobatan</p>
<p>🔴 Meninggal</p>
</div>
</div>
</div>

</section>

<!-- PETA -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-success mb-3">Peta Persebaran TBC</h4>

<div id="mapTbc"></div>

<div class="map-legend mt-3">
<span style="background:#95d5b2">Rendah</span>
<span style="background:#40916c">Sedang</span>
<span style="background:#1b4332">Tinggi</span>
</div>

</section>

<!-- SCRIPT -->
<script>

/* CHART TBC */
const ctx = document.getElementById('chartTbc');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Januari','Februari','Maret','April','Mei'],
        datasets: [
            {
                label: 'Sembuh',
                data: [70,100,80,60,120],
                backgroundColor: '#95d5b2'
            },
            {
                label: 'Pengobatan',
                data: [120,140,110,90,100],
                backgroundColor: '#52b788'
            },
            {
                label: 'Meninggal',
                data: [15,25,20,15,30],
                backgroundColor: '#1b4332'
            }
        ]
    }
});

/* MAP */
var map = L.map('mapTbc').setView([-7.9,112.6], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

/* marker contoh */
L.marker([-7.9,112.6]).addTo(map).bindPopup("Kasus Tinggi TBC");
L.marker([-7.87,112.63]).addTo(map).bindPopup("Kasus Sedang TBC");

</script>

<?= $this->include('layout/footer') ?>