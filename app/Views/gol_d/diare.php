<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="pneu-hero text-white" data-aos="fade-up" style="background: linear-gradient(135deg,#fcbf49,#f77f00);">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6">
    <h1>Diare</h1>
    <p>
        Diare adalah kondisi buang air besar lebih dari 3 kali sehari akibat infeksi dari makanan atau minuman yang tidak bersih.
    </p>
    <button class="btn btn-light mt-3">Pelajari Selengkapnya →</button>
</div>

<div class="col-md-6 text-end">
    <img src="<?= base_url('img/diare.png') ?>" class="img-fluid pneu-img">
</div>

</div>
</div>
</section>

<!-- FITUR -->
<section class="container mt-5 text-center" data-aos="fade-up">

<h4 class="text-warning mb-4">Fitur Monitoring Diare</h4>

<div class="row g-3">
<div class="col-md-3"><div class="fitur-box">Grafik Kasus</div></div>
<div class="col-md-3"><div class="fitur-box">Peta Persebaran</div></div>
<div class="col-md-3"><div class="fitur-box">Penyebab</div></div>
<div class="col-md-3"><div class="fitur-box">Pencegahan</div></div>
</div>

</section>

<!-- GRAFIK -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-warning mb-3">Grafik Diare</h4>

<div class="row mb-3">
<div class="col-md-3"><select class="form-control"><option>Kelurahan</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Kategori</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Tahun</option></select></div>
</div>

<div class="row">
<div class="col-md-9">
<div class="chart-box">
<canvas id="chartDiare"></canvas>
</div>
</div>

<div class="col-md-3">
<div class="legend-box">
<h6>Keterangan</h6>
<p>🟡 Sembuh</p>
<p>🟠 Perawatan</p>
<p>🔴 Meninggal</p>
</div>
</div>
</div>

</section>

<!-- PETA -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-warning mb-3">Peta Persebaran Diare</h4>

<div id="mapDiare"></div>

<div class="map-legend mt-3">
<span style="background:#ffe066">Rendah</span>
<span style="background:#ff922b">Sedang</span>
<span style="background:#e03131">Tinggi</span>
</div>

</section>

<!-- SCRIPT -->
<script>

/* CHART DIARE */
const ctx = document.getElementById('chartDiare');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Januari','Februari','Maret','April','Mei'],
        datasets: [
            {
                label: 'Sembuh',
                data: [60,90,70,50,100],
                backgroundColor: '#ffe066'
            },
            {
                label: 'Perawatan',
                data: [80,120,100,70,90],
                backgroundColor: '#ff922b'
            },
            {
                label: 'Meninggal',
                data: [10,20,15,10,25],
                backgroundColor: '#e03131'
            }
        ]
    }
});

/* MAP */
var map = L.map('mapDiare').setView([-7.9,112.6], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

/* marker contoh */
L.marker([-7.9,112.6]).addTo(map).bindPopup("Kasus Tinggi Diare");
L.marker([-7.88,112.62]).addTo(map).bindPopup("Kasus Sedang Diare");

</script>

<?= $this->include('layout/footer') ?>