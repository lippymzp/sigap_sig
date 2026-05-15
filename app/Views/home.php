<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
.map-box {
    position: relative;
}

.map-info {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background: white;
    padding: 8px 12px;
    border-radius: 8px;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

.map-info {
    z-index: 9999;
}
</style>

<?= $this->include('layout/header') ?>
<div class="home-page">

<!-- HERO -->
<section class="hero">
<div class="container">
  <div class="row align-items-center">

    <div class="col-md-6">
      <h5 class="text-teal">Satu Peta, Satu Data</h5>
      <h2>Apa itu Penyakit Menular?</h2>
      <p>
        Penyakit menular adalah penyakit yang dapat berpindah dari satu orang ke orang lain, baik melalui udara, air, makanan, maupun kontak langsung. Penyebabnya bisa berupa bakteri, virus, parasit, atau jamur yang masuk ke dalam tubuh dan mengganggu kesehatan.
      </p>
    </div>

    <div class="col-md-6 text-center">
      <img src="<?= base_url('img/dokterportal.png') ?>" class="img-fluid hero-img">
    </div>

  </div>
</div>
</section>

<!-- MENU -->
<section class="container text-center mt-5">
    <h4 class="text-teal mb-4">Platform Pemetaan Penyakit Berbasis Data</h4>

    <div class="disease-menu">

        <a href="<?= base_url('dbd') ?>" class="menu-box text-decoration-none">
            <i class="bi bi-map"></i>
            <span>Demam Berdarah<br>Dengue</span>
        </a>

        <a href="<?= base_url('tbc') ?>" class="menu-box text-decoration-none">
            <i class="bi bi-map"></i>
            <span>Tuberkulosis</span>
        </a>

        <a href="<?= base_url('pneumonia') ?>" class="menu-box text-decoration-none">
            <i class="bi bi-map"></i>
            <span>Pneumonia</span>
        </a>

        <a href="<?= base_url('diare') ?>" class="menu-box text-decoration-none">
            <i class="bi bi-map"></i>
            <span>Diare</span>
        </a>

    </div>
</section>

<!-- SLIDER PREMIUM -->
<section class="container mt-5">
<div class="position-relative">

<button class="scroll-btn left" onclick="scrollCardLeft()">‹</button>
<button class="scroll-btn right" onclick="scrollCardRight()">›</button>

<div class="card-slider" id="cardSlider">

    <div class="card-item">
        <div class="card-content">
            <h5>Satu Platform Untuk Memantau, Memetakan, dan Mendeteksi Penyakit</h5>
            <p>SIGAP membantu pemantauan penyakit secara terintegrasi.</p>
        </div>
        <img src="<?= base_url('img/foto3.png') ?>">
    </div>

    <div class="card-item">
        <div class="card-content">
            <h5>SIGAP: Cepat Deteksi, Tepat Informasi</h5>
            <p>Mendukung akses data kesehatan yang cepat dan akurat.</p>
        </div>
        <img src="<?= base_url('img/foto1.png') ?>">
    </div>

    <div class="card-item">
        <div class="card-content">
            <h5>Interaktif dan Berbasis Data Wilayah</h5>
            <ul>
                <li>Peta persebaran penyakit</li>
                <li>Dashboard interaktif</li>
                <li>Visualisasi wilayah</li>
            </ul>
        </div>
        <img src="<?= base_url('img/foto2.png') ?>">
    </div>

</div>
</div>
</section>

<!-- MAP -->
<section class="container mt-5">
<h4 class="text-teal">Peta Interaktif Puskesmas</h4>

<div class="map-box">
    <div id="map"></div>

    <div class="map-info">
        <span>Lat: <b id="lat">-</b></span>
        <span>Lng: <b id="lng">-</b></span>
    </div>
</div>
</section>

<!-- ABOUT FIGMA -->
<section class="about-figma">
    <div class="container">

        <h2 class="about-heading">Tentang Kami</h2>

        <!-- BARIS ATAS -->
        <div class="row align-items-center about-row-top">

            <!-- IMAGE -->
            <div class="col-lg-5">
                <div class="about-image-wrap">
                    <img src="<?= base_url('img/prof.png') ?>" class="about-main-img">

                    <div class="shield-card">
                        <i class="bi bi-shield-check"></i>
                    </div>
                </div>
            </div>

            <!-- TEXT -->
            <div class="col-lg-7">
                <div class="about-content">
                    <h3 class="sigap-title">SIGAP</h3>

                    <h5 class="sigap-subtitle">
                        Sistem Informasi Geografis Analisis & Pemantauan
                    </h5>

                    <p class="sigap-desc">
                        Platform berbasis Sistem Informasi Geografis yang menghadirkan
                        pemetaan dan visualisasi data penyakit Demam Berdarah Dengue,
                        Tuberkulosis, Pneumonia, dan Diare dalam satu sistem terintegrasi.
                        Dikembangkan untuk mendukung transparansi dan akses data
                        kesehatan masyarakat secara menyeluruh dan akurat.
                    </p>

                    <a href="<?= base_url('tentang-kami') ?>" class="about-btn">
                        Selengkapnya
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- BARIS BAWAH -->
        <div class="row align-items-center about-row-bottom">

            <!-- TEXT -->
            <div class="col-lg-6">
                <div class="about-bottom-text">
                    <h3>
                        Mengapa Pemantauan <br>
                        Berbasis Peta Itu Penting?
                    </h3>

                    <p>
                        Penyakit menular masih menjadi tantangan di berbagai wilayah,
                        termasuk Kabupaten Jember. Penyajian data dalam bentuk peta
                        membantu menampilkan distribusi kasus secara lebih jelas,
                        sehingga SIGAP hadir untuk menghadirkan gambaran kondisi
                        kesehatan wilayah yang informatif dan mudah dipahami oleh
                        semua pihak.
                    </p>
                </div>
            </div>

            <!-- IMAGE -->
            <div class="col-lg-6 text-center">
                <img src="<?= base_url('img/batuk.png') ?>" class="about-circle-img">
            </div>

        </div>

    </div>
</section>

<!-- PENYAKIT FIGMA -->
<section class="penyakit-figma">
    <div class="container">

        <h2 class="penyakit-heading">
            Penyakit yang dipantau di SIGAP
        </h2>

        <div class="penyakit-grid">

            <!-- CARD 1 -->
            <div class="penyakit-figma-card">
                <div class="icon-box">
                    <i class="bi bi-map"></i>
                </div>

                <h3>Demam Berdarah<br>Dengue</h3>

                <p>
                    Penyakit yang disebabkan oleh virus dengue dan
                    ditularkan lewat gigitan nyamuk Aedes aegypti.
                </p>
            </div>

            <!-- CARD 2 -->
            <div class="penyakit-figma-card">
                <div class="icon-box">
                    <i class="bi bi-map"></i>
                </div>

                <h3>Tuberkulosis</h3>

                <p>
                    Infeksi bakteri yang menyerang paru-paru dan
                    menular lewat udara saat penderita batuk
                    atau bersin.
                </p>
            </div>

            <!-- CARD 3 -->
            <div class="penyakit-figma-card">
                <div class="icon-box">
                    <i class="bi bi-map"></i>
                </div>

                <h3>Pneumonia</h3>

                <p>
                    Peradangan pada paru-paru akibat infeksi bakteri
                    atau virus yang menyebabkan kantung udara
                    terisi cairan.
                </p>
            </div>

            <!-- CARD 4 -->
            <div class="penyakit-figma-card">
                <div class="icon-box">
                    <i class="bi bi-map"></i>
                </div>

                <h3>Diare</h3>

                <p>
                    Kondisi buang air besar lebih dari 3 kali sehari
                    akibat infeksi dari makanan atau minuman
                    yang tidak bersih.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const map = L.map('map').setView([-8.17, 113.70], 10.5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    fetch('/assets/peta/jember_kecamatan.geojson')
    .then(res => res.json())
    .then(data => {

        function getColor(nama) {
            nama = (nama || "").toLowerCase().trim();

            return nama.includes("sumbersari") ? "red" :
                   nama.includes("kaliwates") ? "blue" :
                   nama.includes("ajung") ? "green" :
                   nama.includes("panti") ? "orange" :
                   "gray";
        }

        const geojson = L.geoJSON(data, {
            style: function(feature){
                const nama = feature.properties?.KECAMATAN || "";

                return {
                    color: "black",
                    weight: 2,
                    fillColor: getColor(nama),
                    fillOpacity: 0.6
                }
            },

            onEachFeature: function(feature, layer){

                const nama = feature.properties?.KECAMATAN || "Tidak diketahui";
                layer.bindPopup(nama);

                // KLIK KECAMATAN
                layer.on('click', function(){

                    // 1. Zoom ke kecamatan
                    map.fitBounds(layer.getBounds());

                    // 2. Ambil titik tengah
                    const center = layer.getBounds().getCenter();

                    // 3. Tampilkan Lat Lng
                    document.getElementById('lat').innerText = center.lat.toFixed(6);
                    document.getElementById('lng').innerText = center.lng.toFixed(6);

                });

            }

        }).addTo(map);

    });

});

/* SLIDER */
function scrollCardLeft() {
    document.getElementById('cardSlider').scrollBy({ left: -400, behavior: 'smooth' });
}

function scrollCardRight() {
    document.getElementById('cardSlider').scrollBy({ left: 400, behavior: 'smooth' });
}
</script>



<style>
.home-page *,
.home-page{
    font-family:'Poppins', sans-serif !important;
}
/* =================================
   FIX READABILITY (TANPA MERUSAK UI)
================================= */

/* HERO */
.hero{
    position: relative;
    background: linear-gradient(
        135deg,
        rgba(184, 255, 243, 0.88),
        rgba(0,206,209,0.82)
    );
    border-radius: 0 0 30px 30px;
}

.hero::before{
    content:'';
    position:absolute;
    inset:0;
    background: rgba(255,255,255,0.18);
    border-radius: inherit;
}

.hero .container{
    position: relative;
    z-index: 2;
}

/* TEXT HERO */
.hero h2{
    color:#083B3B !important;
    font-weight:800;
    text-shadow: 0 2px 8px rgba(255,255,255,0.55);
}

.hero p{
    color:#1E4E4E !important;
    font-weight:500;
}
.disease-menu{
    display:flex;
    justify-content:center;
    align-items:center;
    flex-wrap:wrap;
    gap:26px;
    margin-top:35px;
}

.menu-box{
    width:178px;
    height:56px;
    border-radius:14px;
    background: linear-gradient(135deg,#14B8C8,#5FD7DE);

    display:flex;
    align-items:center;
    gap:12px;

    padding:0 18px;
    color:white !important;
    font-size:15px;
    font-weight:500;
    text-align:left;

    box-shadow: 0 10px 22px rgba(19,183,200,0.20);
    transition:.3s;
}

.menu-box i{
    font-size:20px;
    color:white;
}

.menu-box span{
    line-height:1.2;
}

.menu-box:hover{
    transform:translateY(-4px);
}
/* SECTION TITLE */
.text-teal{
    color:#008A8E !important;
    font-weight:700;
    text-shadow: 0 1px 4px rgba(255,255,255,0.35);
}


/* SLIDER */
.card-item{
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

.card-content h5{
    text-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

/* MAP */
#map{
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.10);
}

.map-info{
    background: rgba(255,255,255,0.95);
    box-shadow: 0 6px 18px rgba(0,0,0,0.18);
    font-weight:600;
    color:#234;
}

/* ABOUT IMAGE */
.about-img{
    border-radius:18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

/* BUTTON */
.btn-teal{
    box-shadow: 0 8px 18px rgba(0,206,209,0.28);
    font-weight:600;
}

/* PENYAKIT CARD */
.penyakit-card{
    box-shadow: 0 10px 22px rgba(0,0,0,0.10);
}

/* CONTACT */
.contact-modern{
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    border-radius: 18px;
}
/* ABOUT TITLE */
.about-title{
    color:#14B8C8;
    font-size:48px;
    font-weight:900;
    margin-bottom:8px;
    line-height:1;
    letter-spacing:0.5px;
}

/* ABOUT SUBTITLE */
.about-subtitle{
    color:#111;
    font-size:30px;
    font-weight:700;
    line-height:1.2;
    margin-bottom:18px;
}

/* ABOUT DESC */
.about-desc{
    color:#333;
    font-size:18px;
    line-height:1.8;
    font-weight:400;
}

/* MOBILE */
@media(max-width:768px){
    .about-title{
        font-size:34px;
        text-align:center;
    }

    .about-subtitle{
        font-size:20px;
        text-align:center;
    }

    .about-desc{
        font-size:15px;
        text-align:center;
    }
}
/* ABOUT FIGMA */
.about-figma{
    background:#DDF2F2;
    padding:80px 0;
    border-radius:30px;
    margin-top:70px;
}

.about-heading{
    text-align:center;
    font-size:56px;
    font-weight:800;
    color:#11B7C7;
    margin-bottom:70px;
}

/* TOP */
.about-row-top{
    margin-bottom:80px;
}

.about-image-wrap{
    position:relative;
    display:inline-block;
}

.about-main-img{
    width:100%;
    max-width:470px;
    border-radius:34px;
    object-fit:cover;
    box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

.shield-card{
    position:absolute;
    bottom:-18px;
    right:-18px;
    width:90px;
    height:90px;
    background:#32D1D5;
    border-radius:24px;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 10px 25px rgba(50,209,213,0.35);
}

.shield-card i{
    color:white;
    font-size:40px;
}

/* TEXT */
.about-content{
    padding-left:30px;
}

.sigap-title{
    color:#11B7C7;
    font-size:54px;
    font-weight:900;
    margin-bottom:8px;
}

.sigap-subtitle{
    color:#111;
    font-size:28px;
    font-weight:700;
    margin-bottom:22px;
}

.sigap-desc{
    font-size:18px;
    line-height:1.9;
    color:#2E2E2E;
    max-width:680px;
}

/* BUTTON */
.about-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    margin-top:24px;
    background:linear-gradient(135deg,#1BC8D3,#5BE2E4);
    color:white;
    text-decoration:none;
    padding:16px 34px;
    border-radius:14px;
    font-weight:700;
    transition:.3s;
}

.about-btn:hover{
    transform:translateY(-4px);
    color:white;
}

/* BOTTOM */
.about-bottom-text h3{
    font-size:46px;
    font-weight:800;
    color:#0B2141;
    line-height:1.3;
    margin-bottom:28px;
}

.about-bottom-text p{
    font-size:18px;
    line-height:2;
    color:#253858;
    max-width:620px;
}

.about-circle-img{
    width:100%;
    max-width:520px;
}

/* MOBILE */
@media(max-width:991px){

    .about-heading{
        font-size:38px;
    }

    .about-content{
        padding-left:0;
        margin-top:40px;
        text-align:center;
    }

    .sigap-title{
        font-size:38px;
    }

    .sigap-subtitle{
        font-size:20px;
    }

    .sigap-desc{
        font-size:15px;
    }

    .about-bottom-text{
        text-align:center;
        margin-bottom:40px;
    }

    .about-bottom-text h3{
        font-size:30px;
    }

    .about-bottom-text p{
        font-size:15px;
    }

    .shield-card{
        width:70px;
        height:70px;
        right:0;
    }

    .shield-card i{
        font-size:28px;
    }
}
/* PENYAKIT FIGMA */
.penyakit-figma{
    margin-top:80px;
    padding:85px 0 95px;
    background: linear-gradient(135deg,#08B7C5 0%, #66DDE2 100%);
    border-radius: 0;
    position: relative;
    overflow: hidden;
}

.penyakit-heading{
    text-align:center;
    color:white;
    font-size:48px;
    font-weight:800;
    margin-bottom:65px;
}

/* GRID */
.penyakit-grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:28px;
}

/* CARD */
.penyakit-figma-card{
    background:#DDF2F2;
    border-radius:26px;
    padding:24px 26px 30px;
    min-height:400px;

    box-shadow:
        0 10px 28px rgba(0,0,0,0.08),
        inset 0 1px 0 rgba(255,255,255,0.65);

    transition:.3s;
}

.penyakit-figma-card:hover{
    transform:translateY(-8px);
}

/* ICON */
.icon-box{
    width:54px;
    height:54px;
    border-radius:14px;
    background:#EDF8F8;

    display:flex;
    align-items:center;
    justify-content:center;

    margin-bottom:22px;
}

.icon-box i{
    font-size:24px;
    color:#0EB8C8;
}

/* TITLE */
.penyakit-figma-card h3{
    color:#08B7C5;
    font-size:34px;
    font-weight:800;
    line-height:1.2;
    margin-bottom:22px;
}

/* DESC */
.penyakit-figma-card p{
    color:#4C4C4C;
    font-size:19px;
    line-height:1.9;
    font-weight:500;
    text-align:justify;
}

/* RESPONSIVE */
@media(max-width:1200px){
    .penyakit-grid{
        grid-template-columns: repeat(2,1fr);
    }
}

@media(max-width:768px){

    .penyakit-heading{
        font-size:32px;
    }

    .penyakit-grid{
        grid-template-columns:1fr;
    }

    .penyakit-figma-card{
        min-height:auto;
    }

    .penyakit-figma-card h3{
        font-size:26px;
    }

    .penyakit-figma-card p{
        font-size:15px;
    }
}
</style>
</div>
<?= $this->include('layout/footer') ?>