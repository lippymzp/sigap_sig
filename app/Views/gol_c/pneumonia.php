<?php $this->setVar('penyakit', 'pneumonia'); ?>
<?= $this->include('layout/header') ?>

<!-- HERO BANNER -->
<section class="pneu-hero text-white mb-4">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6">
    <h1>Pneumonia</h1>
    <p>
    Tau ga sih, Apa Itu Pneumonia ?   
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
/* ================= HERO ================= */
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
    height: 400px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    padding: 40px 20px;
    color: white;

    background: 
    linear-gradient(
        to right,
        rgba(0, 206, 209, 0.9) 40%,   /* Menggunakan Dark Turquoise #00CED1 */
        rgba(0, 206, 209, 0.3) 70%,
        rgba(0, 206, 209, 0) 100%
    ),
    url("<?= base_url('img/pneumonia.png') ?>");

    background-size: cover;
    background-position: right center;
    background-repeat: no-repeat;
}

@keyframes floatHero{
    0%{transform:translateY(0);}
    50%{transform:translateY(-10px);}
    100%{transform:translateY(0);}
}
.grafik-container{
    width: 100%;
    max-width: 1000px;
    margin: auto;
}

/* BUTTON POSISI */
.btn-wrapper{
    display: flex;
    justify-content: flex-end;
    margin-top: 15px;
}

/* BUTTON */
.btn-selengkapnya{
    background: linear-gradient(
        135deg,
        #14c7cf,
        #18b7d3
    );

    color: white;
    text-decoration: none;

    padding: 12px 24px;
    border-radius: 14px;

    font-size: 14px;
    font-weight: 600;

    box-shadow: 0 4px 12px rgba(0,0,0,0.15);

    transition: 0.3s;
}

.btn-selengkapnya:hover{
    transform: translateY(-2px);

    background: linear-gradient(
        135deg,
        #11b8c0,
        #149fc0
    );

    color: white;
}
/* ================= FILTER ================= */
.filter-container {
    display:flex;
    gap:15px;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.filter-box {
    display:flex;
    align-items:center;
    gap:8px;
    background:#f5f5f5;
    padding:8px 12px;
    border-radius:10px;
}

.filter-box select {
    border:none;
    background:transparent;
    outline:none;
}

.main-layout {
    display:flex;
    gap:20px;
    align-items:flex-start;
}

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
</style>

<!-- FITUR -->

<section class="container mt-5 text-center" data-aos="fade-up">

<h4 class="mb-4" style="color:#1aa6a6; font-weight:600;">
    Fitur Menarik yang Bisa Dimanfaatkan
</h4>
<div class="row g-4 justify-content-center">
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<style>
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
</style>

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

<!-- GRAFIK -->
 
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kasus Umum</title>


<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

    WHERE YEAR(tgl_kunjungan) = 2025

    GROUP BY 
        MONTH(tgl_kunjungan),
        jenis_kelamin

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


<!-- Style -->
<style>
body {
  background: #ffffff;
}

.judul-grafik {
  color: #1aa6a6;
  font-weight: 600;
  text-align: left;   /* sesuai gambar (kiri) */
  margin-bottom: 10px; /* biar deket ke card */
}

/* CARD */
.card-custom {
  background: #f4f8f8;
  border-radius: 15px;
  padding: 20px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

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

</head>
<body>

<div id="grafik" class="container mt-4">
<h4 class="judul-grafik">Grafik Pneumonia</h4>
  <div class="card-custom">

    <h5 class="mb-4">Kasus Umum</h5>

    <!-- FILTER -->
    <div class="row mb-4">
      <div class="col-md-4">
        <label>Wilayah</label>
        <select class="form-control filter">
          <option>Ajung</option>
          <option>Wirowongso</option>
          <option>Rowo Indah</option>
          <option>Sukamakmur</option>
          <option>Klompangan</option>
          <option>Mangaran</option>
          <option>Pancakarya</option>
          <option>Pasien Luar Wilayah</option>
          <option>All</option>
        </select>
      </div>

      <div class="col-md-4">
        <label>Bulan</label>
        <select class="form-control filter">
          <option>Januari</option>
          <option>Februari</option>
          <option>Maret</option>
          <option>April</option>
          <option>Mei</option>
          <option>Juni</option>
          <option>Juli</option>
          <option>Agustus</option>
          <option>September</option>
          <option>Oktober</option>
          <option>November</option>
          <option>Desember</option>
          <option>All</option>
        </select>
      </div>

      <div class="col-md-4">
        <label>Tahun</label>
        <select class="form-control filter">
          <option>2025</option>
          <option>2024</option>
          <option>2023</option>
        </select>
      </div>
    </div>

    <!-- GRAFIK FULL -->
    <div class="chart-container">
      <canvas id="chartKasus"></canvas>
    </div>
    
</div>
<!-- BUTTON -->
<div class="btn-wrapper">
    <a href="<?= base_url('grafik_pneumonia') ?>" class="btn-selengkapnya">
        Lihat Selengkapnya →
    </a>
</div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartKasus');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
    datasets: [
      {
        label: 'Laki-laki',
        data: [270,140,60,100,90,75,65,90,100,120,150,90],
        backgroundColor: '#16a085'
      },
      {
        label: 'Wanita',
        data: [240,120,80,60,75,45,40,85,105,160,120,60],
        backgroundColor: '#a3d5d3'
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false, // BIAR FULL
    plugins: {
      legend: {
        position: 'top'
      }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

</script>

</body>
</html>


<!-- PETA -->
<section id="mapSection" class="container mt-5" data-aos="fade-up">

    <div class="section-card">

        <!-- ========================= HALAMAN MAP ========================== -->
        <div id="mapPage">

            <div class="section-block">

                <div class="section-header">
                    <div>
                        <h5>Peta Interaktif Penyebaran</h5>
                        <p class="sub">Visualisasi kepadatan kasus berdasarkan wilayah</p>
                    </div>
                </div>

                <div class="inner-card">

                    <!-- FILTER -->
                    <div class="filter-wrapper">

                        <div class="filter-left">

                            <div class="filter-group">
                                <label>Pilih Bulan</label>
                                <select id="filterBulan">
                                    <option value="">All</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Periode</label>
                                <select id="filterTahun">
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Jenis Kelamin</label>
                                <select id="filterJk">
                                    <option value="">All</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                        </div>

                        <div class="filter-right">
                            <button type="button" id="btnFilter" class="btn-filter">Filter</button>
                            <button type="button" id="btnReset" class="btn-reset">Reset</button>
                        </div>

                    </div>

                    <!-- MAP -->
                    <div class="map-wrapper">

                        <div id="mapPneu"></div>

                        <!-- KETERANGAN -->
                        <div class="map-legend-box">
                            <h6>Keterangan:</h6>

                            <div class="legend-item">
                                <span class="legend-color legend-tinggi"></span>
                                <b>Risiko Tinggi</b>
                            </div>

                            <div class="legend-item">
                                <span class="legend-color legend-sedang"></span>
                                <b>Risiko Sedang</b>
                            </div>

                            <div class="legend-item">
                                <span class="legend-color legend-rendah"></span>
                                <b>Risiko Rendah</b>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- ========================= HALAMAN DETAIL ========================== -->
        <div id="detailPage" style="display:none;">

            <div class="detail-card">

                <div class="detail-header">
                    <h5 id="detailTitleHeader">Peta Sebaran Kasus 2025</h5>
                </div>

                <div class="detail-inner">

                    <div class="detail-top">
                        <div>
                            <h3 id="detailWilayah">Kecamatan Ajung</h3>

                            <p class="detail-label">Total Kasus</p>
                            <h4 id="detailTotal">0 kasus</h4>

                            <p class="detail-label" id="detailBulanLabel">Kasus Baru</p>
                            <h4 id="detailKasusBaru">0 kasus</h4>
                        </div>

                        <span id="detailKategori" class="badge-risk rendah">Rendah</span>
                    </div>

                    <h4 class="chart-title">10 Wilayah dengan Kasus Tertinggi</h4>

                    <div id="rankingChart" class="ranking-chart"></div>

                </div>

                <div class="detail-footer">
                    <button type="button" class="btn-kembali" onclick="backToMap()">Kembali</button>
                </div>

            </div>

        </div>

    </div>

</section>


<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    /* =======================
       DATA PNEUMONIA
    ======================= */
    var dataPneu = <?= json_encode($pneumonia ?? []) ?>;

    var map;
    var geoLayer;
    var geoJsonData;
    var currentDataFinal = {};

    function fixNama(nama){
        return (nama || "")
            .toString()
            .toLowerCase()
            .trim()
            .replace(/desa/g, "")
            .replace(/kelurahan/g, "")
            .replace(/kecamatan/g, "")
            .replace(/\./g, "")
            .replace(/-/g, " ")
            .replace(/_/g, " ")
            .replace(/\s+/g, " ")
            .replace(/[^a-z0-9 ]/g, "")
            .trim();
    }

    function fixKey(nama){
        var key = fixNama(nama).replace(/\s+/g, "");

        var alias = {
            "klompongan": "klompangan",
            "klomplangan": "klompangan",
            "rowoindah": "rowoindah",
            "pancakarya": "pancakarya",
            "sukamakmur": "sukamakmur",
            "wirowongso": "wirowongso",
            "mangaran": "mangaran",
            "ajung": "ajung"
        };

        if(alias[key]){
            return alias[key];
        }

        return key;
    }

    function getDesa(item){
        return item.desa || item.DESA ||
               item.kelurahan || item.KELURAHAN ||
               item.wilayah || item.WILAYAH ||
               item.nama_desa || item.NAMA_DESA ||
               item.nama_kelurahan || item.NAMA_KELURAHAN ||
               item.nama_wilayah || item.NAMA_WILAYAH ||
               item.NAMOBJ || item.namobj ||
               item.WADMKD || item.wadmkd || "";
    }

    function getKasus(item){
        var nilai = item.kasus || item.KASUS ||
                    item.jumlah_kasus || item.JUMLAH_KASUS ||
                    item.total_kasus || item.TOTAL_KASUS ||
                    item.total || item.TOTAL ||
                    item.jumlah || item.JUMLAH ||
                    item.nilai || item.NILAI || 0;

        nilai = nilai.toString().replace(/[^0-9]/g, "");

        return parseInt(nilai || 0);
    }

    function getTahun(item){
        var tahun = item.tahun || item.TAHUN ||
                    item.periode || item.PERIODE ||
                    item.year || item.YEAR || "";

        if(!tahun){
            var tanggal = item.tanggal || item.TANGGAL ||
                          item.tgl || item.TGL ||
                          item.created_at || item.date || "";

            if(tanggal){
                tahun = tanggal.toString().substring(0, 4);
            }
        }

        return tahun;
    }

    function getBulan(item){
        var bulan = item.bulan || item.BULAN ||
                    item.month || item.MONTH || "";

        if(!bulan){
            var tanggal = item.tanggal || item.TANGGAL ||
                          item.tgl || item.TGL ||
                          item.created_at || item.date || "";

            if(tanggal){
                bulan = parseInt(tanggal.toString().substring(5, 7));
            }
        }

        return bulan;
    }

    function getJk(item){
        return item.jenis_kelamin || item.JENIS_KELAMIN ||
               item.jk || item.JK ||
               item.gender || item.GENDER ||
               item.kelamin || item.KELAMIN || "";
    }

    function namaBulan(angka){
        var bulan = {
            "1":"Januari",
            "2":"Februari",
            "3":"Maret",
            "4":"April",
            "5":"Mei",
            "6":"Juni",
            "7":"Juli",
            "8":"Agustus",
            "9":"September",
            "10":"Oktober",
            "11":"November",
            "12":"Desember"
        };

        return bulan[angka] || "Semua Bulan";
    }

    function kategoriKasus(total){
        if(total >= 45){
            return "tinggi";
        }else if(total >= 25){
            return "sedang";
        }else{
            return "rendah";
        }
    }

    function warnaKategori(kategori){
        if(kategori === "tinggi"){
            return "#ff3131";
        }

        if(kategori === "sedang"){
            return "#ffff00";
        }

        return "#42a447";
    }

    function textKategori(kategori){
        if(kategori === "tinggi"){
            return "Tinggi";
        }

        if(kategori === "sedang"){
            return "Sedang";
        }

        return "Rendah";
    }

    function buildDataFinal(){
        var bulan = document.getElementById("filterBulan").value;
        var tahun = document.getElementById("filterTahun").value;
        var jk = document.getElementById("filterJk").value;

        var hasil = {};

        dataPneu.forEach(function(item){

            var itemTahun = getTahun(item).toString();
            var itemBulan = getBulan(item).toString();
            var itemJk = getJk(item).toString().toLowerCase().trim();
            var filterJk = jk.toString().toLowerCase().trim();

            if(tahun && itemTahun && itemTahun !== tahun){
                return;
            }

            if(bulan && itemBulan && itemBulan !== bulan){
                return;
            }

            if(jk && itemJk && itemJk !== filterJk){
                return;
            }

            var desaAsli = getDesa(item);
            var desaKey = fixKey(desaAsli);

            if(!desaKey){
                return;
            }

            if(!hasil[desaKey]){
                hasil[desaKey] = {
                    nama: desaAsli,
                    total: 0,
                    kasusBaru: 0,
                    kategori: "rendah"
                };
            }

            var jumlahKasus = getKasus(item);

            hasil[desaKey].total += jumlahKasus;
            hasil[desaKey].kasusBaru += jumlahKasus;

        });

        for(var key in hasil){
            hasil[key].kategori = kategoriKasus(hasil[key].total);
        }

        currentDataFinal = hasil;

        return hasil;
    }

    function getNamaGeo(feature){
        return feature.properties.NAMOBJ ||
               feature.properties.namobj ||
               feature.properties.nama ||
               feature.properties.name ||
               feature.properties.DESA ||
               feature.properties.desa ||
               feature.properties.WADMKD ||
               feature.properties.wadmkd ||
               feature.properties.KELURAHAN ||
               feature.properties.kelurahan ||
               "Wilayah";
    }

    /* =======================
       CHART LAMA TETAP ADA
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
       MAP BARU
    ======================= */
    function initMap(){
        var mapElement = document.getElementById("mapPneu");

        if(!mapElement){
            return;
        }

        map = L.map("mapPneu", {
            zoomControl: true
        }).setView([-7.9, 112.6], 10);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "Leaflet"
        }).addTo(map);

        fetch("<?= base_url('assets/peta/pneumonia.geojson') ?>")
            .then(function(res){
                return res.json();
            })
            .then(function(data){
                geoJsonData = data;
                renderGeoJson();
            });

        setTimeout(function(){
            map.invalidateSize();
        }, 300);
    }

    function renderGeoJson(){
        var dataFinal = buildDataFinal();

        if(geoLayer){
            map.removeLayer(geoLayer);
        }

        geoLayer = L.geoJSON(geoJsonData, {

            style: function(feature){

                var nama = getNamaGeo(feature);
                var key = fixKey(nama);
                var item = dataFinal[key];

                var kategori = item ? item.kategori : "rendah";
                var warna = item ? warnaKategori(kategori) : "#d9d9d9";

                return {
                    color: "#23a39a",
                    weight: 2,
                    fillColor: warna,
                    fillOpacity: item ? 0.75 : 0.55
                };
            },

            onEachFeature: function(feature, layer){

                var nama = getNamaGeo(feature);
                var key = fixKey(nama);
                var item = dataFinal[key];

                var total = item ? item.total : 0;
                var kategori = item ? item.kategori : "rendah";

                var statusData = item ? "" : `<br><span class="popup-empty">Data tidak ditemukan</span>`;

                var isiPopup = `
                    <div class="popup-informasi" onclick="showDetailWilayah('${key}', decodeURIComponent('${encodeURIComponent(nama)}'))">
                        <b>Informasi :</b><br>
                        <span>Desa : ${nama}</span><br>
                        <span>Jumlah Kasus : ${total}</span><br>
                        <span>
                            Tingkat Kasus :
                            <b class="popup-${kategori}">${textKategori(kategori)}</b>
                        </span>
                        ${statusData}
                        <hr>
                        <small>Klik untuk selengkapnya...</small>
                    </div>
                `;

                layer.bindPopup(isiPopup, {
                    closeButton: true,
                    className: "popup-info-custom"
                });

                layer.bindTooltip(nama, {
                    permanent: true,
                    direction: "center",
                    className: "label-desa"
                });

                layer.on("click", function(){
                    layer.openPopup();
                });

                layer.on("mouseover", function(){
                    layer.setStyle({
                        weight: 4,
                        fillOpacity: 0.85
                    });
                });

                layer.on("mouseout", function(){
                    geoLayer.resetStyle(layer);
                });
            }

        }).addTo(map);

        map.fitBounds(geoLayer.getBounds());
    }

    window.showDetailWilayah = function(key, namaWilayah){

        var item = currentDataFinal[key];

        if(!item){
            item = {
                nama: namaWilayah,
                total: 0,
                kasusBaru: 0,
                kategori: "rendah"
            };
        }

        var tahun = document.getElementById("filterTahun").value || "2025";
        var bulan = document.getElementById("filterBulan").value || "";

        document.getElementById("mapPage").style.display = "none";
        document.getElementById("detailPage").style.display = "block";

        document.getElementById("detailTitleHeader").innerText = "Peta Sebaran Kasus " + tahun;
        document.getElementById("detailWilayah").innerText = "Kecamatan " + namaWilayah;
        document.getElementById("detailTotal").innerText = item.total + " kasus";

        if(bulan){
            document.getElementById("detailBulanLabel").innerText = "Kasus Baru (" + namaBulan(bulan) + " " + tahun + ")";
        }else{
            document.getElementById("detailBulanLabel").innerText = "Kasus Baru (Semua Bulan " + tahun + ")";
        }

        document.getElementById("detailKasusBaru").innerText = item.kasusBaru + " kasus";

        var badge = document.getElementById("detailKategori");
        badge.innerText = textKategori(item.kategori);
        badge.className = "badge-risk " + item.kategori;

        renderRankingChart();
    }

    window.backToMap = function(){
        document.getElementById("detailPage").style.display = "none";
        document.getElementById("mapPage").style.display = "block";

        setTimeout(function(){
            map.invalidateSize();
        }, 300);
    }

    function renderRankingChart(){
        var chart = document.getElementById("rankingChart");

        var ranking = Object.values(currentDataFinal)
            .sort(function(a, b){
                return b.total - a.total;
            })
            .slice(0, 10);

        if(ranking.length === 0){
            chart.innerHTML = `
                <div class="empty-chart">
                    Tidak ada data yang sesuai filter
                </div>
            `;
            return;
        }

        var max = ranking[0].total || 1;
        var html = "";

        ranking.forEach(function(item){

            var width = (item.total / max) * 100;
            var kategori = item.kategori;

            html += `
                <div class="rank-row">
                    <div class="rank-name">${item.nama.toUpperCase()}</div>

                    <div class="rank-bar-area">
                        <div class="rank-bar ${kategori}" style="width:${width}%;">
                            <span>${item.total}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        chart.innerHTML = html;
    }

    document.getElementById("filterTahun").addEventListener("change", function(){
        renderGeoJson();
    });

    document.getElementById("btnFilter").addEventListener("click", function(){
        renderGeoJson();
    });

    document.getElementById("btnReset").addEventListener("click", function(){
        document.getElementById("filterBulan").value = "";
        document.getElementById("filterTahun").value = "2025";
        document.getElementById("filterJk").value = "";

        renderGeoJson();
    });

    initMap();

});
</script>


<style>
/* ========================= CARD UTAMA ========================= */
.section-card{
    background:#eaf9fb;
    padding:18px;
    border-radius:16px;
    width:100%;
    font-family:'Poppins', Arial, sans-serif;
}

.section-block{
    background:#eaf9fb;
    border-radius:16px;
}

/* ========================= HEADER MAP ========================= */
.section-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:22px;
}

.section-header h5{
    font-size:24px;
    font-weight:800;
    color:#0d3440;
    margin:0 0 8px;
}

.section-header .sub{
    font-size:15px;
    color:#60727d;
    margin:0;
}

/* ========================= CARD MAP ========================= */
.inner-card{
    background:#ffffff;
    width:100%;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 2px 9px rgba(0,0,0,0.08);
}

/* ========================= FILTER ========================= */
.filter-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:12px;
    padding:16px 20px 12px;
    background:#ffffff;
}

.filter-left{
    display:flex;
    align-items:flex-end;
    gap:18px;
    flex-wrap:wrap;
}

.filter-group{
    display:flex;
    flex-direction:column;
}

.filter-group label{
    font-size:14px;
    color:#111;
    margin-bottom:8px;
}

.filter-group select{
    width:155px;
    height:40px;
    border:1px solid #b8d0df;
    border-radius:10px;
    padding:0 12px;
    font-size:14px;
    background:#fff;
    outline:none;
}

.filter-right{
    display:flex;
    gap:10px;
    align-items:center;
}

.btn-filter{
    border:none;
    background:#08b7c9;
    color:#fff;
    height:42px;
    padding:0 22px;
    border-radius:10px;
    font-size:16px;
    font-weight:800;
    box-shadow:0 2px 7px rgba(0,0,0,0.22);
    cursor:pointer;
}

.btn-reset{
    border:none;
    background:#ffffff;
    color:#000;
    height:42px;
    padding:0 22px;
    border-radius:10px;
    font-size:16px;
    font-weight:800;
    box-shadow:0 2px 7px rgba(0,0,0,0.22);
    cursor:pointer;
}

/* ========================= MAP ========================= */
.map-wrapper{
    position:relative;
    width:100%;
    border-radius:0;
    overflow:hidden;
}

#mapPneu{
    width:100%;
    height:510px !important;
    border-radius:0;
}

/* ========================= LABEL WILAYAH ========================= */
.label-desa{
    background:rgba(65,65,65,0.88);
    color:white;
    border:none;
    padding:5px 9px;
    font-size:12px;
    font-weight:700;
    border-radius:6px;
    box-shadow:0 2px 6px rgba(0,0,0,0.35);
}

/* ========================= KETERANGAN DI DALAM MAP ========================= */
.map-legend-box{
    position:absolute;
    left:0;
    bottom:0;
    width:175px;
    background:#ffffff;
    padding:12px 14px 8px;
    border-radius:0 8px 0 0;
    box-shadow:0 2px 8px rgba(0,0,0,0.25);
    z-index:999;
}

.map-legend-box h6{
    font-size:14px;
    font-weight:800;
    color:#000;
    margin:0 0 10px;
}

.legend-item{
    display:flex;
    align-items:center;
    gap:9px;
    margin-bottom:10px;
    font-size:11px;
    color:#000;
}

.legend-color{
    width:21px;
    height:21px;
    display:inline-block;
}

.legend-tinggi{
    background:#ff0000;
}

.legend-sedang{
    background:#ffff00;
}

.legend-rendah{
    background:#00ff00;
}

/* ========================= POPUP ========================= */
.popup-informasi{
    min-width:160px;
    font-size:12px;
    line-height:1.5;
    cursor:pointer;
}

.popup-informasi b{
    color:#000;
}

.popup-informasi hr{
    margin:8px -8px 4px;
    border:0;
    border-top:1px solid #ddd;
}

.popup-informasi small{
    display:block;
    text-align:center;
    color:#aaa;
    font-size:10px;
}

.popup-tinggi{
    color:red !important;
}

.popup-sedang{
    color:#d77b00 !important;
}

.popup-rendah{
    color:green !important;
}

.popup-empty{
    color:#d62828;
    font-weight:800;
}

.leaflet-popup-content-wrapper{
    border-radius:8px;
}

.leaflet-popup-content{
    margin:9px 11px;
}

/* ========================= DETAIL PAGE MODERN ========================= */
.detail-card{
    background:#ffffff;
    border:none;
    border-radius:18px;
    padding:24px;
    box-shadow:none;
    width:100%;
    margin:0 auto;
}

.detail-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
    padding:0 2px;
}

.detail-header h5{
    font-size:20px;
    font-weight:700;
    margin:0;
    color:#111827;
}

.detail-inner{
    background:#f8fafc;
    border-radius:18px;
    padding:34px 42px 42px;
    box-shadow:none;
    border:1px solid #eef2f7;
}

.detail-top{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:30px;
    margin-bottom:34px;
}

.detail-top h3{
    font-size:24px;
    font-weight:700;
    margin:0 0 18px;
    color:#111827;
}

.detail-label{
    font-size:17px;
    font-weight:400;
    margin:12px 0 4px;
    color:#374151;
    line-height:1.3;
}

.detail-top h4{
    font-size:18px;
    font-weight:700;
    margin:0 0 8px;
    color:#111827;
}

.badge-risk{
    padding:7px 16px;
    border-radius:10px;
    font-size:16px;
    font-weight:600;
    line-height:1;
    white-space:nowrap;
}

.badge-risk.tinggi{
    background:#fee2e2;
    color:#dc2626;
}

.badge-risk.sedang{
    background:#fef3c7;
    color:#b45309;
}

.badge-risk.rendah{
    background:#dcfce7;
    color:#15803d;
}

.chart-title{
    margin-top:22px;
    margin-bottom:22px;
    font-size:22px;
    font-weight:700;
    color:#111827;
}

/* ========================= CHART BATANG DETAIL ========================= */
.ranking-chart{
    width:72%;
    min-width:560px;
}

.rank-row{
    display:flex;
    align-items:center;
    margin-bottom:7px;
}

.rank-name{
    width:165px;
    text-align:right;
    padding-right:18px;
    letter-spacing:3px;
    font-size:13px;
    font-weight:700;
    color:#6b7280;
}

.rank-bar-area{
    flex:1;
    height:32px;
    border-top:1px solid #d9dee7;
    position:relative;
}

.rank-bar{
    height:23px;
    margin-top:4px;
    color:#ffffff;
    font-weight:700;
    text-align:center;
    line-height:23px;
    min-width:26px;
    border-radius:0 3px 3px 0;
}

.rank-bar.tinggi{
    background:#8b0000;
}

.rank-bar.sedang{
    background:#e76f51;
}

.rank-bar.rendah{
    background:#16a34a;
}

.rank-bar span{
    font-size:13px;
}

.empty-chart{
    padding:18px 30px;
    font-size:16px;
    font-weight:600;
    color:#6b7280;
}

.detail-footer{
    display:flex;
    justify-content:flex-end;
    margin-top:14px;
}

.btn-kembali{
    background:#08b7c9;
    color:#ffffff;
    border:none;
    border-radius:10px;
    padding:9px 42px;
    font-size:16px;
    font-weight:700;
    box-shadow:none;
    cursor:pointer;
}

.btn-kembali:hover{
    background:#079bad;
}

/* ========================= RESPONSIVE ========================= */
@media(max-width:768px){

    .section-card{
        padding:12px;
    }

    .section-header{
        flex-direction:column;
        gap:12px;
    }

    .section-header h5{
        font-size:22px;
    }

    .section-header .sub{
        font-size:14px;
    }

    .filter-wrapper{
        flex-direction:column;
        align-items:flex-start;
    }

    .filter-left{
        width:100%;
        gap:8px;
    }

    .filter-group label{
        font-size:13px;
        margin-bottom:6px;
    }

    .filter-group select{
        width:115px;
        height:34px;
        font-size:13px;
    }

    .filter-right{
        width:100%;
        justify-content:flex-end;
    }

    .btn-filter,
    .btn-reset{
        height:36px;
        font-size:14px;
        padding:0 16px;
    }

    #mapPneu{
        height:330px !important;
    }

    .map-legend-box{
        width:155px;
        padding:10px 12px 6px;
    }

    .map-legend-box h6{
        font-size:13px;
    }

    .legend-item{
        font-size:10px;
        margin-bottom:8px;
    }

    .legend-color{
        width:19px;
        height:19px;
    }

    .label-desa{
        font-size:10px;
        padding:3px 6px;
    }

    .popup-informasi{
        min-width:150px;
        font-size:12px;
    }

    .detail-card{
        padding:14px;
    }

    .detail-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .detail-header h5{
        font-size:18px;
    }

    .detail-inner{
        padding:24px 18px 32px;
    }

    .detail-top{
        flex-direction:column;
        gap:16px;
        margin-bottom:26px;
    }

    .detail-top h3{
        font-size:21px;
    }

    .detail-label{
        font-size:15px;
    }

    .detail-top h4{
        font-size:17px;
    }

    .badge-risk{
        font-size:14px;
        padding:7px 14px;
    }

    .chart-title{
        font-size:19px;
    }

    .ranking-chart{
        width:100%;
        min-width:100%;
    }

    .rank-name{
        width:115px;
        font-size:11px;
        letter-spacing:2px;
        padding-right:10px;
    }

    .rank-bar-area{
        height:30px;
    }

    .rank-bar{
        height:22px;
        line-height:22px;
    }

    .btn-kembali{
        width:100%;
        padding:10px 20px;
    }
}
</style>

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