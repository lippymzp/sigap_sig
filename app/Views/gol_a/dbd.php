<?php $this->setVar('penyakit', 'dbd'); ?>
<?= $this->include('layout/header') ?>


<!-- HERO -->
<section class="pneu-hero text-white" style="background:linear-gradient(135deg,#20c997,#0dcaf0); padding:90px 0;">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6" data-aos="fade-right">
    <h1 class="fw-bold">Demam Berdarah Dengue</h1>
    <p>
    Demam Berdarah Dengue (DBD) merupakan penyakit menular yang disebabkan oleh virus dengue dan ditularkan melalui gigitan nyamuk <i>Aedes aegypti</i> dan <i>Aedes albopictus</i>.
    </p>

    <a href="<?= base_url('dbd-detail') ?>" class="btn btn-light mt-3 px-4 py-2 rounded-pill shadow">
        Pelajari selengkapnya →
    </a>
</div>

<div class="col-md-6 text-end" data-aos="fade-left">
    <img src="<?= base_url('img/dbd.png') ?>" class="img-fluid" style="max-height:300px;">
</div>

</div>
</div>
</section>

<!-- FITUR -->
<section class="container text-center mt-5" data-aos="fade-up">

<h4 class="text-teal mb-4 fw-bold">Fitur Menarik yang Bisa Dimanfaatkan</h4>

<div class="row g-4 justify-content-center">

    <div class="col-lg-3 col-md-6">
        <a href="#grafik" class="text-decoration-none">
            <div class="fitur-box shadow-sm p-3 rounded">
                📊 Grafik Kesehatan
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="#peta" class="text-decoration-none">
            <div class="fitur-box shadow-sm p-3 rounded">
                🗺️ Peta Persebaran
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="<?= base_url('artikel') ?>" class="text-decoration-none">
            <div class="fitur-box shadow-sm p-3 rounded">
                📄 Artikel Kesehatan
</div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="<?= base_url('skriningdbd') ?>" class="text-decoration-none">
            <div class="fitur-box shadow-sm p-3 rounded">
                🩺 Skrining Kesehatan
            </div>
        </a>
    </div>

</div>
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
    <h4>Demam Berdarah Dengue</h4>
    <p>
    Demam Berdarah Dengue (DBD) merupakan penyakit menular yang disebabkan oleh virus dengue dan ditularkan melalui gigitan nyamuk <i>Aedes aegypti</i> dan <i>Aedes albopictus</i>.
    </p>
</div>

</div>
<div class="col-md-4 text-center">
    <img src="<?= base_url('img/dbd-artikel.png') ?>" class="img-fluid" style="max-height:150px;">
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

<a href="<?= base_url('skriningdbd') ?>" class="btn btn-teal px-4 py-2 rounded-pill shadow">
    Mulai Skrining →
</a>

</div>

</section>

<!-- GRAFIK -->
<section id="grafik" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3 fw-bold">Grafik DBD</h4>

<div class="row mb-3">
<div class="col-md-3"><select class="form-control shadow-sm"><option>Kelurahan</option></select></div>
<div class="col-md-3"><select class="form-control shadow-sm"><option>Kategori</option></select></div>
<div class="col-md-3"><select class="form-control shadow-sm"><option>Tahun</option></select></div>
</div>

<div class="row">

<div class="col-md-9">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<canvas id="chartDBD"></canvas>
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

<div id="peta" style="height:400px; border-radius:15px;"></div>

<div class="mt-3 d-flex gap-2">
<span class="badge bg-warning">Rendah</span>
<span class="badge bg-danger">Sedang</span>
<span class="badge bg-dark">Tinggi</span>
</div>

</section>

<!-- ================= TAMBAHAN DATABASE ================= -->
<script>

/* 🔥 FIX UTAMA (TIDAK MENGUBAH KODE LAMA) */
function fixNama(nama){
    return (nama || "")
        .toLowerCase()
        .trim()
        .replace(/\s+/g, " ")
        .replace(/[^a-z0-9 ]/g, "");
}

/* 🔥 PENYELARAS NAMA GEOJSON */
var aliasDesa = {
    "kemuningsarilor": "kemuning sari lor"
};

var dataDBD = <?= json_encode($dbd ?? []) ?>;

var dataFinal = {};

dataDBD.forEach(item => {

    var desa = fixNama(item.desa);

    if(aliasDesa[desa]){
        desa = aliasDesa[desa];
    }

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

console.log("DATA FINAL:", dataFinal);

</script>

<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function(){

new Chart(document.getElementById('chartDBD'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei'],
        datasets: [
            { label:'Sembuh', data:[100,80,70,60,150], backgroundColor:'#8ecae6' },
            { label:'Pengobatan', data:[90,150,120,90,95], backgroundColor:'#219ebc' },
            { label:'Meninggal', data:[40,20,40,40,60], backgroundColor:'#90dbf4' }
        ]
    }
});

var map = L.map('mapDBD').setView([-8.1,113.5], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

fetch("<?= base_url('assets/peta/panti_6_desa.geojson') ?>")
.then(res => res.json())
.then(data => {

    var geo = L.geoJSON(data, {

        style: function(feature){

            var nama = fixNama(feature.properties.NAMOBJ);

            if(aliasDesa[nama]){
                nama = aliasDesa[nama];
            }

            var item = dataFinal[nama];

            var warna = "#cccccc";

            if(item){
                if(item.kategori == "tinggi") warna = "#dc3545";
                else if(item.kategori == "sedang") warna = "#ffc107";
                else if(item.kategori == "rendah") warna = "#28a745";
            }

            return {
                color: "#00CED1",
                weight: 2,
                fillColor: warna,
                fillOpacity: 0.7
            };
        },

        onEachFeature: function(feature, layer){

            var namaAsli = feature.properties.NAMOBJ || "Desa";
            var namaFix  = fixNama(namaAsli);

            if(aliasDesa[namaFix]){
                namaFix = aliasDesa[namaFix];
            }

            var item = dataFinal[namaFix];

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