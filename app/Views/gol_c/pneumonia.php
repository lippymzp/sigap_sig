<?php $this->setVar('penyakit', 'pneumonia'); ?>
<?= $this->include('layout/header') ?>

<!-- HERO BANNER -->
<section class="pneu-hero text-white">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6">
    <h1>Pneumonia</h1>
    <p>
    Tau ga sih, Apa Itu Pneumonia?   
</p> 
<p>
        Pneumonia adalah infeksi pada paru-paru yang menyebabkan kantung udara (alveoli) terisi cairan atau nanah, 
        sehingga mengganggu proses pernapasan.
    </p>
   
<!-- BUTTON -->
<a href="#" class="btn-gradient">
    Pelajari selengkapnya →
</a>

<style>
.btn-gradient {
    display: inline-flex;
    align-items: center;
    gap: 10px;

    padding: 14px 28px;
    border-radius: 18px;
    text-decoration: none;

    font-size: 18px;
    font-weight: 600;
    color: #ffffff;

    background: linear-gradient(
        135deg,
        #1fb5a9,   /* kiri (toska) */
        #6fd3d8    /* kanan (biru muda soft) */
    );

    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    transition: all 0.3s ease;
}

/* hover biar hidup */
.btn-gradient:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.3);
}
</style>
</div>

<div class="col-md-6 text-center">
   
</div>
</div>
</div>
</section>


<style>
/* ================= CSS ================= */
.pneu-hero{
    background: linear-gradient(135deg,#00bcd4,#36d1dc,#5b86e5);
    padding: 70px 0;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
}
.pneu-hero h1{ font-size: 58px; font-weight: 700; margin-bottom: 18px;}
.pneu-hero p{font-size: 19px; line-height: 1.8; max-width: 520px; }
.hero-btn{ background: #00a8cc; color: #fff; padding: 14px 30px; border-radius: 50px; font-weight: 600; border: none;}

.hero-btn:hover{
    background:#0088aa;
    color:#fff;
}
.pneu-hero {
    height: 400px; border-radius: 20px; display: flex; align-items: center; padding: 40px 20px; color: white;
    background: 
    linear-gradient(
        to right,
        rgba(0, 206, 209, 0.9) 40%,rgba(0, 206, 209, 0.3) 70%,rgba(0, 206, 209, 0) 100% ), 
        url("<?= base_url('img/pneumonia.png') ?>"); background-size: cover; background-position: right center; background-repeat: no-repeat; }
@keyframes floatHero{ 0%{transform:translateY(0);} 50%{transform:translateY(-10px);} 100%{transform:translateY(0);} }
.grafik-container{ width: 100%; max-width: 1000px; margin: auto }

/* BUTTON POSISI */
.btn-wrapper{ display: flex; justify-content: flex-end; margin-top: 15px; }

/* BUTTON */
.btn-selengkapnya{ background: linear-gradient( 135deg, #14c7cf, #18b7d3 );
color: white; text-decoration: none; padding: 12px 24px; border-radius: 14px;
font-size: 14px; font-weight: 600; box-shadow: 0 4px 12px rgba(0,0,0,0.15); transition: 0.3s; }

.btn-selengkapnya:hover{ transform: translateY(-2px); background: linear-gradient( 135deg, #11b8c0, #149fc0 ); color: white; }
/* ================= FILTER ================= */
.filter-container { display:flex; gap:15px; margin-bottom:20px; flex-wrap:wrap; }

.filter-box { display:flex; align-items:center; gap:8px; background:#f5f5f5; padding:8px 12px; border-radius:10px; }

.filter-box select { border:none; background:transparent; outline:none; }

.main-layout { display:flex; gap:20px; align-items:flex-start; }

.chart-container {
    flex:3;
    height:350px;
}

.side-container {
    flex:1;
    display:flex;
    flex-direction:column;
    gap:20px;
}

.info-box {
    background:#cfe3e3;
    padding:15px;
    border-radius:12px;
}

.info-row {
    display:flex;
    justify-content:space-between;
    margin-bottom:6px;
}

.legend-box {
    border:1px solid #ccc;
    padding:10px;
    border-radius:10px;
}

.legend-item {
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom:5px;
}

.legend-color {
    width:15px;
    height:15px;
    border-radius:3px;
}
/* BOX FITUR */
.fitur-box {
    padding: 15px; border-radius: 20px; text-align: center; color: white;
    background: linear-gradient(135deg, #20c997, #0dcaf0);
    text-decoration: none; box-shadow: 0 6px 15px rgba(0,0,0,0.15); transition: 0.3s;
}
/* HOVER */
.fitur-box:hover {
    transform: translateY(-5px); color: white;
}
/* AKTIF */
.fitur-box.active {
    transform: scale(1.05); box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}
/* ICON GARIS */
.icon {
    margin-bottom: 10px;
}
.icon span {
    display: inline-block; width: 3px; height: 18px; background: white; margin: 0 2px; border-radius: 2px;
}
.icon span:nth-child(2) {
    height: 24px;
}
.icon span:nth-child(3) {height: 14px;}
/* CSS GRAFIK */
body {
  background: #ffffff;
}

.judul-grafik { color: #1aa6a6; font-weight: 600; text-align: left;margin-bottom: 10px; }

/* CARD */
.card-custom { background: #f4f8f8; border-radius: 15px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }

/* FILTER */
.filter {
  border-radius: 10px;
  padding: 10px;
}

/* CHART FULL */
.chart-container {
  position: relative;
  width: 100%;
  height: 260px;
}

canvas {
  width: 100% !important;
  height: 100% !important;
}

h5 {
  font-weight: bold;
}
</style>

<!-- FITUR -->

<section class="container mt-5 text-center" data-aos="fade-up">

<h4 class="mb-4" style="color:#1aa6a6; font-weight:600;">
    Fitur Menarik yang Bisa Dimanfaatkan
</h4>
<div class="row g-4 justify-content-center">

<!-- GRAFIK FITUR -->
<div class="col-md-3">
<a href="#grafik" class="fitur-box d-block" data-target="grafik">
    <div class="icon">
        <span></span><span></span><span></span>
    </div>
    Grafik Kesehatan
</a>
</div>
<!-- MAP FITUR -->
<div class="col-md-3">
<a href="#mapSection" class="fitur-box d-block" data-target="map">
    <div class="icon">
        <span></span><span></span><span></span>
    </div>
    Peta Persebaran
</a>
</div>
<!-- ARTIKEL FITUR-->
<div class="col-md-3">
<a href="#" class="fitur-box d-block" data-target="artikel">
    <div class="icon">
        <span></span><span></span><span></span>
    </div>
    Artikel
</a>
</div>
<!-- SKRINING FITUR -->
<div class="col-md-3">

<a href="<?= base_url('skriningpneumonia') ?>" class="fitur-box d-block" data-target="skrining">
    <div class="icon">
        <span></span><span></span><span></span>
    </div>
    Skrining
</a>
</div>
</div>
</section>
<script>
const fitur = document.querySelectorAll('.fitur-box');

fitur.forEach(btn => {
    btn.addEventListener('click', function(e) {

        // biar yg # gak reload
        if(this.getAttribute("href") === "#"){
            e.preventDefault();
        }

        // aktif efek
        fitur.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>


<!-- INSIGHT -->
<section class="container mt-5" data-aos="fade-up">

<h6 class="text-center text-muted">Insights</h6>
<h4 class="text-center mb-4 fw-bold">Telusuri Informasi Berikut</h4>

<div class="carousel-wrapper">
</div>

</section>
<!-- CTA SKRINING -->
<section class="container mt-5" data-aos="zoom-in">

<div class="cta-box shadow-sm">

    <h5 class="fw-bold">
        Mengalami Gejala?
    </h5>

    <p>
        Tubuhmu sedang memberi sinyal, jangan diabaikan.<br>
        Yuk, kenali gejala pneumonia dan lakukan
        <span style="color:red;">skrining</span> sejak dini!
    </p>

    <a href="<?= base_url('skriningpneumonia') ?>"
       class="btn btn-teal px-4 py-2 shadow">

        Mulai Skrining →

    </a>
</div>

</section>
<style>


/* CTA SKRINING*/
.cta-box{
    border-radius: 20px;
    border: 2px solid #16c7cf;
    background: white;

    padding: 40px;
    text-align: center;
}

</style>

<!-- grafik -->
<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php

$conn = mysqli_connect("localhost","root","","sigap_db");

$bulanLabels = [
    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

$laki = array_fill(0, 12, 0);
$wanita = array_fill(0, 12, 0);


$query = mysqli_query($conn, "
    SELECT 
        MONTH(tgl_kunjungan) as bulan,
        jenis_kelamin,
        COUNT(*) as total
    FROM pasien
    WHERE YEAR(tgl_kunjungan) = 2026
    GROUP BY MONTH(tgl_kunjungan), jenis_kelamin
");

while($row = mysqli_fetch_assoc($query)){

    $index = $row['bulan'] - 1;

    if(
        strtolower($row['jenis_kelamin']) == 'laki-laki'
        || strtolower($row['jenis_kelamin']) == 'laki laki'
    ){

        $laki[$index] = (int)$row['total'];

    }else{

        $wanita[$index] = (int)$row['total'];

    }
}

?>

<style>

#grafik{
    margin-top:40px;
}

.judul-grafik{
    color:#00a8b5;
    font-weight:700;
    font-size:42px;
    margin-bottom:15px;
}

.card-grafik{
    background:#f8f8f8;
    border:4px solid #1e88e5;
    border-radius:25px;
    padding:25px;
}

.chart-container{
    position:relative;
    width:100%;
    height:500px;
}

.btn-wrapper{
    margin-top:20px;
    text-align:right;
}

.btn-selengkapnya{
    background:linear-gradient(to right,#00bcd4,#4dd0e1);
    color:white;
    padding:14px 28px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
    display:inline-block;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
}

.btn-selengkapnya:hover{
    color:white;
    transform:scale(1.03);
}

</style>

<div id="grafik" class="container">

    <h1 class="judul-grafik">
        Grafik Pneumonia
    </h1>

    <div class="card-grafik">

        <div class="chart-container">
            <canvas id="chartKasus"></canvas>
        </div>

    </div>

    <div class="btn-wrapper">

        <a href="<?= base_url('grafik_pneumonia') ?>" class="btn-selengkapnya">
            Lihat selengkapnya →
        </a>

    </div>

</div>

<script>

const labels = <?= json_encode($bulanLabels); ?>;

const dataLaki = <?= json_encode($laki); ?>;
const dataWanita = <?= json_encode($wanita); ?>;

const ctx = document.getElementById('chartKasus');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: labels,

        datasets: [

            {
                label: 'Laki-laki',
                data: dataLaki,
                backgroundColor: '#1f6f78',
                borderRadius: 6
            },

            {
                label: 'Wanita',
                data: dataWanita,
                backgroundColor: '#a7d7d3',
                borderRadius: 6
            }

        ]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        plugins: {

            legend: {
                position: 'top'
            }

        },

        scales: {

            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 10
                }
            }

        }

    }

});

</script>
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