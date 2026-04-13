<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<title>SIG Penyakit Influenza</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<style>

body{
font-family:Segoe UI;
background:#f5f7fb;
}

/* NAVBAR */

.navbar{
background:linear-gradient(90deg,#2c5aa0,#ff8c00);
padding:12px;
}

.navbar-brand{
color:white;
font-weight:600;
}

.nav-link{
color:white !important;
margin-left:15px;
font-weight:500;
}

.btn-admin{
background:#ffa726;
border-radius:20px;
padding:6px 16px;
color:white !important;
}

/* HERO */

.hero{
position:relative;
padding:110px 0;
color:white;
background:url("<?= base_url('img/puskesmas.png') ?>");
background-size:cover;
background-position:center;
}

.hero::before{
content:"";
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.45);
}

.hero .container{
position:relative;
z-index:2;
}

.hero-title{
font-size:42px;
font-weight:800;
color:#2d6cdf;
}

.hero-sub{
font-size:36px;
font-weight:800;
color:#ff8c00;
margin-bottom:15px;
}

.hero-img{
width:260px;
border-radius:20px;
}

/* STAT */

.stats{
padding:50px 0;
}

.stat-box{
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* MAP */

.map-section{
padding:40px 0;
text-align:center;
}

.map-box{
width:750px;
margin:auto;
}

#map{
height:450px;
width:100%;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

/* ARTIKEL */

.artikel{
padding:70px 0;
}

.artikel-card{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 10px 25px rgba(0,0,0,0.08);
display:flex;
gap:15px;
align-items:center;
}

.artikel-card img{
width:70px;
border-radius:10px;
}

/* PARTNER */

.partner{
text-align:center;
padding:40px 0;
}

.partner img{
width:120px;
margin:10px;
}

/* FOOTER */

footer{
background:#1f4b87;
color:white;
padding:50px 0;
}

footer img{
width:150px;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand" href="<?= base_url('/') ?>">
SIG Influenza
</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="#dashboard">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#map">Peta Sebaran</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?= base_url('data_kasus') ?>">Data Kasus</a>
</li>

<li class="nav-item">
<a class="nav-link" href="<?= base_url('screening') ?>">Skrining</a>
</li>

<li class="nav-item">
<a class="nav-link btn-admin" href="<?= base_url('login') ?>">Admin</a>
</li>

</ul>

</div>

</nav>

<!-- HERO -->

<section class="hero" id="dashboard">

<div class="container">

<div class="row align-items-center">

<div class="col-md-7">

<h1 class="hero-title">
SURVEILENS PENYAKIT MENULAR
</h1>

<h2 class="hero-sub">
KABUPATEN JEMBER
</h2>

<p>
Sistem Informasi Geografis untuk pemantauan penyebaran influenza secara real-time. Membantu pengambilan keputusan berbasis data untuk penanganan kesehatan masyarakat
</p>

<a href="#map" class="btn btn-primary">
Eksplorasi Peta
</a>

</div>

<div class="col-md-5 text-center">

<img src="<?= base_url('img/paru.png') ?>" class="hero-img">

</div>

</div>

</div>

</section>

<!-- STATISTIK -->

<section class="stats">

<div class="container">

<div class="row text-center">

<div class="col-md-4">
<div class="stat-box">
<h2>20</h2>
<p>Total Kasus Aktif</p>
</div>
</div>

<div class="col-md-4">
<div class="stat-box">
<h2>2</h2>
<p>Kasus Baru</p>
</div>
</div>

<div class="col-md-4">
<div class="stat-box">
<h2>6</h2>
<p>Kelurahan Terdampak</p>
</div>
</div>

</div>

</div>

</section>

<!-- MAP -->

<section class="map-section" id="map">

<div class="container text-center">

<h3>Peta Interaktif Penyebaran</h3>

<div class="map-box">
<div id="map"></div>
</div>

</div>

</section>

<!-- ARTIKEL -->

<section class="artikel">

<div class="container">

<h3>Artikel</h3>

<div class="row g-4">

<div class="col-md-4">
<div class="artikel-card">
<img src="<?= base_url('img/edukasi.png') ?>">
<div>
<b>Edukasi</b><br>
Cara Efektif Mencegah Penularan Influenza
</div>
</div>
</div>

<div class="col-md-4">
<div class="artikel-card">
<img src="<?= base_url('img/vaksin.png') ?>">
<div>
<b>Vaksinasi</b><br>
Pentingnya Vaksin Influenza Tahunan
</div>
</div>
</div>

<div class="col-md-4">
<div class="artikel-card">
<img src="<?= base_url('img/tips.png') ?>">
<div>
<b>Tips Kesehatan</b><br>
Kapan Harus ke Puskesmas Jika Terkena Flu
</div>
</div>
</div>

</div>

</div>

</section>

<!-- PARTNER -->

<section class="partner">

<div class="container">

<h3>Rekanan Kami</h3>

<img src="<?= base_url('img/dinkes.png') ?>">
<img src="<?= base_url('img/ijo.png') ?>">

</div>

</section>

<!-- FOOTER -->

<footer>

<div class="container">

<div class="row">

<div class="col-md-4">

<img src="<?= base_url('img/logo.png') ?>">

<p>
"Kesehatan masyarakat adalah prioritas kami"
</p>

</div>

<div class="col-md-4">

<h5>Hubungi Kami</h5>

<p>Dsync@gmail.com</p>
<p>Instagram</p>
<p>Tiktok</p>
<p>Faizal wkwkw</p>

</div>

<div class="col-md-4">

<h5>Lokasi Kami</h5>

<p>
Jl. Kaca Piring No.5, Gebang Tengah, Patrang
Kabupaten Jember
</p>

<img src="<?= base_url('img/maps.png') ?>" width="200">

</div>

</div>

</div>

</footer>

<!-- LEAFLET -->

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

var map = L.map('map').setView([-8.168,113.702],13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
attribution:'© OpenStreetMap'
}).addTo(map);


/* WARNA KELURAHAN */

function getColor(nama){

switch(nama){

case "Patrang": return "#6f2cff";
case "Slawu": return "#ff2d8f";
case "Gebang": return "#ff7f50";
case "Baratan": return "#00b894";
case "Bintoro": return "#f1c40f";
case "Banjarsengon": return "#9b59b6";
case "Jember Lor": return "#3498db";
case "Jumerto": return "#e74c3c";

default: return "#6f2cff";

}

}


/* LOAD GEOJSON */

fetch("<?= base_url('data/kelurahan_patrang.geojson') ?>")

.then(res => res.json())

.then(data => {

var kelurahanLayer = L.geoJSON(data,{

style:function(feature){

return{

color:"#ffffff",
weight:2,
fillColor:getColor(feature.properties.NAMOBJ),
fillOpacity:0.75

}

},

onEachFeature:function(feature,layer){

layer.bindPopup(
"<b>Kelurahan "+feature.properties.NAMOBJ+"</b><br>Kecamatan Patrang"
)

}

}).addTo(map)

map.fitBounds(kelurahanLayer.getBounds())

})

</script>

</body>
</html>