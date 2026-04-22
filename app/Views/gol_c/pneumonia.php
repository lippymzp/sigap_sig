<?php $this->setVar('penyakit', 'pneumonia'); ?>
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
    <a href="#grafik" class="btn btn-light mt-3">
        Pelajari Selengkapnya →
    </a>
</div>

<div class="col-md-6 text-end">
    <img src="<?= base_url('img/pneumonia.png') ?>" 
         class="img-fluid pneu-img"
         onerror="this.style.display='none'">
</div>

</div>
</div>
</section>

<!-- FITUR -->
<section class="container mt-5 text-center" data-aos="fade-up">

<h4 class="text-teal mb-4">Fitur Menarik</h4>

<div class="row g-3 justify-content-center">

<div class="col-md-3">
<a href="#grafik" class="fitur-box text-decoration-none d-block">
    Grafik Kesehatan
</a>
</div>

<div class="col-md-3">
<a href="#mapSection" class="fitur-box text-decoration-none d-block">
    Peta Persebaran
</a>
</div>

<div class="col-md-3">
<a href="#" class="fitur-box text-decoration-none d-block">
    Artikel
</a>
</div>

<div class="col-md-3">
<a href="<?= base_url('skrining') ?>" class="fitur-box text-decoration-none d-block">
    Skrining
</a>
</div>

</div>

</section>

<!-- GRAFIK -->
<section id="grafik" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3">Grafik Pneumonia</h4>

<div class="row mb-3">
<div class="col-md-3"><select class="form-control"><option>Kelurahan</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Kategori</option></select></div>
<div class="col-md-3"><select class="form-control"><option>Tahun</option></select></div>
</div>

<div class="row">
<div class="col-md-9">
<div class="chart-box p-3 shadow rounded">
<canvas id="chartPneu"></canvas>
</div>
</div>

<div class="col-md-3">
<div class="legend-box p-3 shadow rounded">
<h6>Keterangan</h6>
<p>🟩 Sembuh</p>
<p>🟦 Pengobatan</p>
<p>🟨 Meninggal</p>
</div>
</div>
</div>

</section>

<!-- PETA -->
<section id="mapSection" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3">Peta Persebaran</h4>

<div id="mapPneu" style="height:400px; border-radius:15px;"></div>

<div class="map-legend mt-3">
<span style="background:#f4a261">Rendah</span>
<span style="background:#e76f51">Sedang</span>
<span style="background:#d62828">Tinggi</span>
</div>

</section>

<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    /* =======================
       TAMBAHAN QGIS + DATA
    ======================= */
    function fixNama(nama){
        return (nama || "")
            .toLowerCase()
            .trim()
            .replace(/\s+/g, " ")
            .replace(/[^a-z0-9 ]/g, "");
    }

    var dataPneu = <?= json_encode($pneumonia ?? []) ?>;
    console.log("DATA PNEUMONIA:", dataPneu);

    var dataFinal = {};

    dataPneu.forEach(item => {

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

    console.log("DATA FINAL:", dataFinal);

    /* =======================
       CHART
    ======================= */
    const ctx = document.getElementById('chartPneu');

    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari','Februari','Maret','April','Mei'],
                datasets: [
                    {
                        label: 'Sembuh',
                        data: [110,90,70,50,160]
                    },
                    {
                        label: 'Pengobatan',
                        data: [95,155,120,90,95]
                    },
                    {
                        label: 'Meninggal',
                        data: [40,20,40,40,60]
                    }
                ]
            }
        });
    }

    /* =======================
       MAP
    ======================= */
    const mapElement = document.getElementById('mapPneu');

    if (mapElement) {
        var map = L.map('mapPneu').setView([-7.9,112.6], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
        .addTo(map);

        /* marker lama (tidak dihapus) */
        L.marker([-7.9,112.6]).addTo(map).bindPopup("Kasus Tinggi");
        L.marker([-7.8,112.7]).addTo(map).bindPopup("Kasus Sedang");

        /* 🔥 QGIS GEOJSON */
        fetch("<?= base_url('assets/peta/pneumonia.geojson') ?>")
        .then(res => res.json())
        .then(data => {

            var geo = L.geoJSON(data, {

                style: function(feature){

                    var nama = fixNama(feature.properties.NAMOBJ);
                    var item = dataFinal[nama];

                    var warna = "#cccccc";

                    if(item){
                        if(item.kategori == "tinggi") warna = "#d62828";
                        else if(item.kategori == "sedang") warna = "#e76f51";
                        else if(item.kategori == "rendah") warna = "#f4a261";
                    }

                    return {
                        color: "#2a9d8f",
                        weight: 2,
                        fillColor: warna,
                        fillOpacity: 0.7
                    };
                },

                onEachFeature: function(feature, layer){

                    var nama = feature.properties.NAMOBJ;
                    var item = dataFinal[fixNama(nama)];

                    var isi = "<b>Desa: " + nama + "</b>";

                    if(item){
                        isi += "<br>Total Kasus: " + item.total;
                        isi += "<br>Kategori: " + item.kategori;
                    } else {
                        isi += "<br><span style='color:red'>Data tidak ditemukan</span>";
                    }

                    layer.bindPopup(isi);

                    layer.bindTooltip(nama, {
                        permanent: true,
                        direction: "center",
                        className: "label-desa"
                    });
                }

            }).addTo(map);

            map.fitBounds(geo.getBounds());
        });

        setTimeout(() => map.invalidateSize(), 300);
    }

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