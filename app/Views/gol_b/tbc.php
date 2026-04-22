<?php $this->setVar('penyakit', 'tbc'); ?>
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

<div id="mapTbc" style="height:400px; border-radius:15px;"></div>

<div class="map-legend mt-3">
<span style="background:#95d5b2">Rendah</span>
<span style="background:#40916c">Sedang</span>
<span style="background:#1b4332">Tinggi</span>
</div>

</section>

<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function(){

/* ================= TAMBAHAN QGIS ================= */
function fixNama(nama){
    return (nama || "")
        .toLowerCase()
        .trim()
        .replace(/\s+/g, " ")
        .replace(/[^a-z0-9 ]/g, "");
}

var dataTbc = <?= json_encode($tbc ?? []) ?>;
console.log("DATA TBC:", dataTbc);

var dataFinal = {};

dataTbc.forEach(item => {

    var desa = fixNama(item.desa);

    if(!dataFinal[desa]){
        dataFinal[desa] = {
            total: 0,
            jumlah: 0
        };
    }

    dataFinal[desa].total += parseInt(item.kasus);
    dataFinal[desa].jumlah++;
});

for(var key in dataFinal){
    var rata = dataFinal[key].total / dataFinal[key].jumlah;

    if(rata >= 20) dataFinal[key].kategori = "tinggi";
    else if(rata >= 10) dataFinal[key].kategori = "sedang";
    else dataFinal[key].kategori = "rendah";
}

console.log("DATA FINAL TBC:", dataFinal);


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
var map = L.map('mapTbc').setView([-8.1,113.5], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

/* 🔥 FIX BIAR LANGSUNG MUNCUL */
setTimeout(() => {
    map.invalidateSize();
}, 200);

/* 🔥 QGIS GEOJSON */
fetch("<?= base_url('assets/peta/tbc.geojson') ?>")
.then(res => res.json())
.then(data => {

    var geo = L.geoJSON(data, {

        style: function(feature){

            var nama = fixNama(feature.properties.NAMOBJ);
            var item = dataFinal[nama];

            var warna = "#cccccc";

            if(item){
                if(item.kategori == "tinggi") warna = "#1b4332";
                else if(item.kategori == "sedang") warna = "#40916c";
                else if(item.kategori == "rendah") warna = "#95d5b2";
            }

            return {
                color: "#2a9d8f",
                weight: 2,
                fillColor: warna,
                fillOpacity: 0.7
            };
        },

        onEachFeature: function(feature, layer){

            var namaAsli = feature.properties.NAMOBJ;
            var item = dataFinal[fixNama(namaAsli)];

            var isi = "<b>Desa: " + namaAsli + "</b>";

            if(item){
                isi += "<br>Total Kasus: " + item.total;
                isi += "<br>Kategori: " + item.kategori;
            } else {
                isi += "<br><span style='color:red'>Data tidak ditemukan</span>";
            }

            layer.bindPopup(isi);

            layer.bindTooltip(namaAsli, {
                permanent: true,
                direction: "center",
                className: "label-desa"
            });

        }

    }).addTo(map);

    map.fitBounds(geo.getBounds());
});

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