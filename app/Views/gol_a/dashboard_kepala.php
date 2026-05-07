<?= $this->extend('layout/dashboard_layout_kepala'); ?>

<?= $this->section('style'); ?>
<style>
.main-content {
    margin-left: 250px;
}
#chartDBD {
    height: 300px !important;
}
</style>
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<!-- WELCOME -->
<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai Kepala Puskesmas</h3>
        <p>Puskesmas Sumbersari, Jember</p>
    </div>
     <div class="welcome-icon">
    <img src="<?= base_url('img/World_Map.png') ?>" 
         alt="map"
         style="width:280px; height:auto;">
</div>
</div>

<!-- STAT -->
<div class="stat-row">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-chart-column"></i>
        </div>
        <div class="stat-info">
            <h3 class="red">20</h3>
            <p>Total Kasus Aktif Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-arrow-up"></i>
            <i class="fa-solid fa-arrow-down"></i>
        </div>
        <div class="stat-info">
            <h3 class="green">2</h3>
            <p>Kasus Baru Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-map"></i>
        </div>
        <div class="stat-info">
            <h3 class="blue">6</h3>
            <p>Kelurahan Terdampak</p>
        </div>
    </div>
</div>
<!-- MAP -->
<div class="section-card">
<div class="section-block">
<div class="section-header">
    <div>
        <h5>Peta Interaktif Penyebaran</h5>
        <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
    </div>

    <div class="filter">
        <span>Periode:</span>
            <?php $tahunMap = $_GET['tahun_map'] ?? date('Y'); ?>

<select id="periodeMap" onchange="updateMap()">
    <?php for($t = 2024; $t <= date('Y'); $t++): ?>
        <option value="<?= $t ?>" <?= ($t == $tahunMap ? 'selected' : '') ?>>
            <?= $t ?>
        </option>
    <?php endfor; ?>
</select>
    </div>
</div>

<div class="inner-card">
    <div id="map"></div>

<script>
function updateMap(){
    let tahun = document.getElementById("periodeMap").value;

    let url = new URL(window.location.href);
    url.searchParams.set('tahun_map', tahun);

    window.location.href = url.toString();
}
    /* 🔥 FIX NAMA */
    function fixNama(nama){
        return (nama || "")
            .toLowerCase()
            .trim()
            .replace(/\s+/g, " ")
            .replace(/[^a-z0-9 ]/g, "");
    }

    /* 🔥 OPTIONAL: kalau ada nama beda */
    var aliasDesa = {
        "kemuningsarilor": "kemuning sari lor"
    };

    var dataDBD = <?= json_encode($dbd ?? []) ?>;
    var dataFinal = {};

    /* 🔥 OLAH DATA */
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

    /* 🔥 KATEGORI */
    for(var key in dataFinal){
        var rata = dataFinal[key].total / dataFinal[key].jumlah;

        if(rata >= 20) dataFinal[key].kategori = "tinggi";
        else if(rata >= 10) dataFinal[key].kategori = "sedang";
        else dataFinal[key].kategori = "rendah";
    }

    document.addEventListener("DOMContentLoaded", function() {

        /* 🔥 INIT MAP */
        var map = L.map('map').setView([-8.1,113.5], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
        .addTo(map);

        /* 🔥 GEOJSON */
        fetch("<?= base_url('assets/peta/db.geojson') ?>")
        .then(res => res.json())
        .then(data => {

            var geo = L.geoJSON(data, {

                /* 🔥 WARNA */
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

                /* 🔥 INTERAKSI */
                onEachFeature: function(feature, layer){

                    var namaAsli = feature.properties.NAMOBJ || "Kelurahan";
                    var namaFix  = fixNama(namaAsli);

                    if(aliasDesa[namaFix]){
                        namaFix = aliasDesa[namaFix];
                    }

                    var item = dataFinal[namaFix];

                    var isi = "<b>Kelurahan: " + namaAsli + "</b>";

                    if(item){
                        isi += "<br>Total Kasus: " + item.total;
                        isi += "<br>Kategori: " + item.kategori;
                    } else {
                        isi += "<br><span style='color:red'>Data tidak ditemukan</span>";
                    }

                    /* 🔥 POPUP */
                    layer.bindPopup(isi);

                    /* 🔥 LABEL NAMA DI PETA */
                    layer.bindTooltip(namaAsli, {
                        permanent: true,
                        direction: "center",
                        className: "label-desa"
                    });

                    /* 🔥 HOVER EFFECT */
                    layer.on({
                        mouseover: function(e){
                            e.target.setStyle({
                                weight: 3,
                                color: '#000'
                            });
                        },
                        mouseout: function(e){
                            geo.resetStyle(e.target);
                        }
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
<section id="grafik" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3 fw-bold">Grafik DBD</h4>

<?php
$bulan = $_GET['bulan'] ?? '';
$tahun = $_GET['tahun'] ?? '';
$usia  = $_GET['usia'] ?? '';
$jk    = $_GET['jk'] ?? '';
?>

<form method="get">

<div class="row mb-3">

<!-- USIA -->
<div class="col-md-3">
    <select name="usia" class="form-control" onchange="this.form.submit()">
    <option value="">Semua Usia</option>
    <option value="anak" <?= ($usia=='anak' ? 'selected' : '') ?>>0-14</option>
    <option value="remaja" <?= ($usia=='remaja' ? 'selected' : '') ?>>15-24</option>
    <option value="dewasa" <?= ($usia=='dewasa' ? 'selected' : '') ?>>25-59</option>
    <option value="lansia" <?= ($usia=='lansia' ? 'selected' : '') ?>>60+</option>
</select>
</div>

<!-- GENDER -->
<div class="col-md-3">
    <select name="jk" class="form-control" onchange="this.form.submit()">
    <option value="">Semua Gender</option>
    <option value="L" <?= ($jk=='L' ? 'selected' : '') ?>>Laki-laki</option>
    <option value="P" <?= ($jk=='P' ? 'selected' : '') ?>>Perempuan</option>
</select>
</div>

<!-- BULAN -->
<div class="col-md-3">
    <select name="bulan" class="form-control shadow-sm" onchange="this.form.submit()">
        <option value="">Semua Bulan</option>

        <?php
        $bulanList = [
            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
            5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
            9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
        ];

        foreach($bulanList as $key => $val):
        ?>
            <option value="<?= $key ?>" <?= request()->getGet('bulan') == $key ? 'selected' : '' ?>>
                <?= $val ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- TAHUN -->
<div class="col-md-3">
    <select name="tahun" class="form-control" onchange="this.form.submit()">
    <option value="">Semua Tahun</option>
    <?php for($t=2020;$t<=date('Y');$t++): ?>
        <option value="<?= $t ?>" <?= ($tahun==$t ? 'selected' : '') ?>>
            <?= $t ?>
        </option>
    <?php endfor; ?>
</select>
</div>

</div>
<input type="hidden" name="tahun_map" value="<?= $_GET['tahun_map'] ?? '' ?>">
</form>

<div class="row">

<div class="col-md-9">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<canvas id="chartDBD"></canvas>
</div>
</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const dataGrafik = <?= json_encode($grafik ?? []) ?>;

    let labels = [];
    let total = [];

    dataGrafik.forEach(item => {
        labels.push(item.kelurahan);
        total.push(item.total);
    });

    new Chart(document.getElementById('chartDBD'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label:'Total Kasus',
                data: total,
                backgroundColor:'#00BBC2'
            }]
        }
    });

});
</script>
<?= $this->endSection(); ?>