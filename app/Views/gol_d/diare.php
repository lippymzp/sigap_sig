<?= $this->include('layout/header') ?>

<!-- HERO -->
<section class="pneu-hero text-white" style="background:linear-gradient(135deg,#20c997,#0dcaf0); padding:90px 0;">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6" data-aos="fade-right">
    <h1 class="fw-bold">Diare</h1>
    <p>
        Diare adalah kondisi buang air besar lebih dari 3 kali sehari akibat infeksi makanan atau minuman yang tidak bersih.
    </p>

    <a href="<?= base_url('diare-detail') ?>" class="btn btn-light mt-3 px-4 py-2 rounded-pill shadow">
        Pelajari selengkapnya →
    </a>
</div>

<div class="col-md-6 text-end" data-aos="fade-left">
    <img src="<?= base_url('img/diare.png') ?>" class="img-fluid" style="max-height:300px;">
</div>

</div>
</div>
</section>

<!-- FITUR -->
<section class="container text-center mt-5" data-aos="fade-up">

<h4 class="text-teal mb-4 fw-bold">Fitur Menarik yang Bisa Dimanfaatkan</h4>

<div class="row g-4">

<div class="col-md-3">
<div class="fitur-box shadow-sm">📊 Grafik Kesehatan</div>
</div>

<div class="col-md-3">
<div class="fitur-box shadow-sm">🗺️ Peta Persebaran</div>
</div>

<div class="col-md-3">
<div class="fitur-box shadow-sm">📄 Artikel Kesehatan</div>
</div>

<div class="col-md-3">
<a href="<?= base_url('skrining-diare') ?>" class="fitur-box text-decoration-none shadow-sm">
    🩺 Skrining Kesehatan
</a>
</div>

</div>
</section>

<!-- INSIGHT -->
<section class="container mt-5" data-aos="fade-up">

<h6 class="text-center text-muted">Insights</h6>
<h4 class="text-center mb-4 fw-bold">Telusuri Informasi Berikut</h4>

<div class="card p-4 shadow-lg" style="border-radius:20px; background:linear-gradient(135deg,#20c997,#0dcaf0); color:white;">

<div class="row align-items-center">

<div class="col-md-8">
    <h4>Diare Pada Anak</h4>
    <p>
        Diare pada anak dapat disebabkan oleh infeksi virus, bakteri, atau makanan yang tidak higienis.
        Penting untuk mengetahui gejala dan penanganan sejak dini.
    </p>
</div>

<div class="col-md-4 text-center">
    <img src="<?= base_url('img/diare-artikel.png') ?>" class="img-fluid" style="max-height:150px;">
</div>

</div>
</div>

</section>

<!-- CTA -->
<section class="container mt-5" data-aos="zoom-in">

<div class="p-4 text-center shadow-sm" style="border-radius:20px; border:2px solid #20c997;">

<h5 class="fw-bold">Mengalami Gejala?</h5>
<p>
Tubuhmu memberi sinyal, jangan diabaikan.<br>
Yuk lakukan <span style="color:red;">skrining</span> sejak dini!
</p>

<a href="<?= base_url('skrining-diare') ?>" class="btn btn-teal px-4 py-2 rounded-pill shadow">
    Mulai Skrining →
</a>

</div>

</section>

<!-- GRAFIK -->
<section id="grafik" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3 fw-bold">Grafik Diare</h4>

<div class="row mb-3">
<div class="col-md-3"><select class="form-control shadow-sm"><option>Kelurahan</option></select></div>
<div class="col-md-3"><select class="form-control shadow-sm"><option>Kategori</option></select></div>
<div class="col-md-3"><select class="form-control shadow-sm"><option>Tahun</option></select></div>
</div>

<div class="row">

<div class="col-md-9">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<canvas id="chartDiare"></canvas>
</div>
</div>

<div class="col-md-3">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<h6>Keterangan Grafik</h6>
<p><span style="color:#8ecae6">■</span> Sembuh</p>
<p><span style="color:#219ebc">■</span> Pengobatan</p>
<p><span style="color:#90dbf4">■</span> Meninggal</p>
</div>
</div>

</div>
</section>

<!-- MAP -->
<section class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3 fw-bold">Peta Persebaran Penyakit</h4>

<div id="mapDiare" style="height:400px; border-radius:15px;"></div>

<div class="mt-3 d-flex gap-2">
<span class="badge bg-warning">Rendah</span>
<span class="badge bg-danger">Sedang</span>
<span class="badge bg-dark">Tinggi</span>
</div>

</section>

<!-- RINGKASAN -->
<section class="container mt-5" data-aos="fade-up">

<div class="p-4 shadow-sm" style="border-radius:20px; border:2px solid #20c997;">

<h5 class="text-teal fw-bold">Ringkasan Data</h5>

<p>
Kasus diare tertinggi terjadi di wilayah <b style="color:red;">Kecamatan A</b>.<br>
Wilayah lainnya dengan kasus tinggi yaitu <b style="color:red;">Desa B</b> dan <b style="color:red;">Desa C</b>.
</p>

<p>
Rata-rata kasus diare mencapai <b>60 kasus</b>.
</p>

<div class="text-center mt-3">
<a href="<?= base_url('/') ?>" class="btn btn-teal px-4 rounded-pill">
    Kembali
</a>
</div>

</div>
</section>

<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function(){

/* CHART */
new Chart(document.getElementById('chartDiare'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei'],
        datasets: [
            {
                label:'Sembuh',
                data:[100,80,70,60,150],
                backgroundColor:'#8ecae6'
            },
            {
                label:'Pengobatan',
                data:[90,150,120,90,95],
                backgroundColor:'#219ebc'
            },
            {
                label:'Meninggal',
                data:[40,20,40,40,60],
                backgroundColor:'#90dbf4'
            }
        ]
    }
});

/* ======================
   MAP QGIS 6 DESA 🔥
====================== */
var map = L.map('mapDiare').setView([-8.1,113.5], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

// LOAD GEOJSON
fetch("<?= base_url('assets/peta/panti_6_desa.geojson') ?>")
.then(res => res.json())
.then(data => {

    var geo = L.geoJSON(data, {

        style: function(feature){
            return {
                color: "#00CED1",
                weight: 2,
                fillColor: "#20c997",
                fillOpacity: 0.5
            };
        },

        onEachFeature: function(feature, layer){

            // ambil nama desa dari QGIS (NAMOBJ)
            var nama = feature.properties.NAMOBJ || "Desa";

            // popup
            layer.bindPopup("<b>Desa: " + nama + "</b>");

            // label langsung muncul di map
            layer.bindTooltip(nama, {
                permanent: true,
                direction: "center",
                className: "label-desa"
            });

        }

    }).addTo(map);

    map.fitBounds(geo.getBounds());

});

// refresh map
setTimeout(()=>map.invalidateSize(),300);

});
</script>

<style>
.label-desa{
    background: rgba(0,0,0,0.6);
    color: white;
    border: none;
    padding: 2px 6px;
    font-size: 11px;
    border-radius: 6px;
}
</style>

<?= $this->include('layout/footer') ?>