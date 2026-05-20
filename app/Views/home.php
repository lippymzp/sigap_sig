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
    <h3 class="text-teal mb-4">Platform Pemetaan Penyakit Berbasis Data</h3>

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

<!-- SLIDER IKLAN FIGMA FIX -->
<section class="figma-slider-section">
    <div class="container">

        <div class="slider-wrapper">

            <button class="slider-btn prev" onclick="scrollCardLeft()">
                <i class="bi bi-arrow-left"></i>
            </button>

            <div class="figma-slider" id="cardSlider">

                <?php if(!empty($iklan)): ?>
                    <?php foreach($iklan as $item): ?>

                        <div class="figma-card">

                            <div class="figma-content">
                                <div class="figma-text">
                                    <h3><?= esc($item['judul']) ?></h3>
                                    <p><?= esc($item['deskripsi']) ?></p>

                                    <div class="figma-meta">
                                        <span>SIGAP</span>
                                        <span><?= date('d M Y') ?></span>
                                    </div>
                                </div>

                                <div class="figma-image">
                                    <img src="<?= base_url('uploads/iklan/' . $item['gambar']) ?>">
                                </div>
                            </div>

                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <button class="slider-btn next" onclick="scrollCardRight()">
                <i class="bi bi-arrow-right"></i>
            </button>

        </div>

    </div>
</section>

<!-- MAP -->
<section class="container mt-5">
<h3 class="text-teal">Peta Sebaran Penyakit</h3>

<div class="map-box">
    <div id="map"></div>

    <div class="map-dropdown">

        <button id="menuToggle" class="menu-btn">
            ☰
        </button>

        <div id="dropdownMenu" class="dropdown-menu-map">

            <div class="dropdown-item" data-value="">
                Semua Penyakit
            </div>

            <div class="dropdown-item" data-value="ajung">
                Pneumonia
            </div>

            <div class="dropdown-item" data-value="panti">
                Diare
            </div>

            <div class="dropdown-item" data-value="sumbersari">
                DBD
            </div>

            <div class="dropdown-item" data-value="kaliwates">
                TBC
            </div>

        </div>

    </div>

    <div class="map-info">
        <div>Longitude : <b id="lng">-</b></div>
        <div>Latitude : <b id="lat">-</b></div>
    </div>

    <img src="<?= base_url('img/compass.png') ?>" class="map-compass">

    <div class="map-legend">

        <div class="legend-title">
            Keterangan<br>
            Penyakit
        </div>

        <div class="legend-items">

            <div class="legend-item">
                <span class="legend-color c1"></span>

                <div class="legend-text">
                    <div class="legend-main">
                        Pneumonia
                    </div>

                    <div class="legend-sub">
                        Kecamatan Ajung
                    </div>
                </div>
            </div>

            <div class="legend-item">
                <span class="legend-color c2"></span>

                <div class="legend-text">
                    <div class="legend-main">
                        Diare
                    </div>

                    <div class="legend-sub">
                        Kecamatan Panti
                    </div>
                </div>
            </div>

            <div class="legend-item">
                <span class="legend-color c3"></span>

                <div class="legend-text">
                    <div class="legend-main">
                        DBD
                    </div>

                    <div class="legend-sub">
                        Kecamatan Sumbersari
                    </div>
                </div>
            </div>

            <div class="legend-item">
                <span class="legend-color c4"></span>

                <div class="legend-text">
                    <div class="legend-main">
                        TBC
                    </div>

                    <div class="legend-sub">
                        Kecamatan Kaliwates
                    </div>
                </div>
            </div>

        </div>

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

    const map = L.map('map').setView([-8.181767836963857, 113.67592325093854], 12);

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

        let geojson = L.geoJSON(data, {
            style:function(feature){

                const nama =
                (feature.properties?.KECAMATAN || '')
                .toLowerCase();

                let warna = '#4BB8C7';

                if(nama.includes('ajung')){
                    warna = '#4BB8C7';
                }
                else if(nama.includes('panti')){
                    warna = '#2AA7B8';
                }
                else if(nama.includes('sumbersari')){
                    warna = '#177C89';
                }
                else if(nama.includes('kaliwates')){
                    warna = '#6CCDD9';
                }

                return{
                    color:'#ffffff',
                    weight:1.5,
                    fillColor:warna,
                    fillOpacity:0.85
                };
            },

            onEachFeature: function(feature, layer){

                const nama = feature.properties?.KECAMATAN || "Tidak diketahui";
                layer.bindPopup(nama);

                // KLIK KECAMATAN
                layer.on('click', function(){

                    // RESET SEMUA DULU
                    geojson.eachLayer(function(l){

                        l.setStyle({
                            fillOpacity:0.15,
                            opacity:0.2,
                            weight:1.5
                        });

                    });

                    // YANG DIKLIK
                    layer.setStyle({
                        fillOpacity:1,
                        opacity:1,
                        weight:3
                    });

                    // ZOOM
                    map.fitBounds(layer.getBounds());

                    // CENTER
                    const center =
                    layer.getBounds().getCenter();

                    // LAT LNG
                    document.getElementById('lat')
                    .innerText =
                    center.lat.toFixed(6);

                    document.getElementById('lng')
                    .innerText =
                    center.lng.toFixed(6);

                });

            }

        }).addTo(map);

        // TOGGLE MENU
        document
        .getElementById('menuToggle')
        .addEventListener('click', function(){

            const menu =
            document.getElementById('dropdownMenu');

            menu.style.display =
            menu.style.display === 'block'
            ? 'none'
            : 'block';

        });


        // FILTER
        document
        .querySelectorAll('.dropdown-item')
        .forEach(item => {

            item.addEventListener('click', function(){

                const value =
                this.dataset.value;

                geojson.eachLayer(function(layer){

                    const nama = (
                        layer.feature.properties?.KECAMATAN || ''
                    ).toLowerCase();

                    // RESET
                    if(value === ''){

                        layer.closePopup();

                        const namaLayer =
                        (layer.feature.properties?.KECAMATAN || '')
                        .toLowerCase();

                        let warna = '#4BB8C7';

                        if(namaLayer.includes('ajung')){
                            warna = '#4BB8C7';
                        }
                        else if(namaLayer.includes('panti')){
                            warna = '#2AA7B8';
                        }
                        else if(namaLayer.includes('sumbersari')){
                            warna = '#177C89';
                        }
                        else if(namaLayer.includes('kaliwates')){
                            warna = '#6CCDD9';
                        }

                        layer.setStyle({
                            fillColor:warna,
                            fillOpacity:0.85,
                            opacity:1,
                            weight:1.5
                        });

                        map.setView(
                            [-8.181767836963857, 113.67592325093854],
                            12
                        );

                    }else{

                        if(nama.includes(value)){

                            layer.setStyle({
                                fillOpacity:1,
                                opacity:1,
                                weight:3
                            });

                            map.fitBounds(layer.getBounds());

                            layer.openPopup();

                        }else{

                            layer.setStyle({
                                fillOpacity:0.15,
                                opacity:0.2
                            });

                        }

                    }

                });

            });

        });
        

    });

});

function scrollCardLeft() {
    const slider = document.getElementById('cardSlider');
    slider.scrollBy({
        left: -slider.offsetWidth,
        behavior: 'smooth'
    });
}

function scrollCardRight() {
    const slider = document.getElementById('cardSlider');
    slider.scrollBy({
        left: slider.offsetWidth,
        behavior: 'smooth'
    });
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
    font-size:46px;
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
    font-size:40px;
    font-weight:900;
    margin-bottom:8px;
}

.sigap-subtitle{
    color:#111;
    font-size:26px;
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
    font-size:40px;
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
    font-size:40px;
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
    font-size:28px;
    font-weight:800;
    line-height:1.2;
    margin-bottom:22px;
}

/* DESC */
.penyakit-figma-card p{
    color:#4C4C4C;
    font-size:16px;
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

#map{
    height:520px;
    border-radius:18px;
    overflow:hidden;
}

.map-box{
    position:relative;
}

.map-info{
    position:absolute;
    bottom:18px;
    left:18px;

    background:white;

    padding:10px 16px;

    border-radius:12px;

    z-index:400;

    box-shadow:0 4px 12px rgba(0,0,0,0.15);

    font-size:14px;
    font-weight:600;
}

.map-legend{
    position:absolute;

    bottom:18px;
    right:18px;

    display:flex;
    align-items:center;

    background:#D8F5F7;

    border:2px solid #047981;

    border-radius:14px;

    overflow:hidden;

    z-index:400;
}

.legend-title{
    background:linear-gradient(135deg,#14B8C8,#5FD7DE);

    color:white;

    padding:10px 16px;

    font-weight:700;

    font-size:14px;
}

.legend-items{
    display:flex;
    align-items:center;

    gap:18px;

    padding:0 16px;

    height:42px;
}

.legend-item{
    display:flex;
    align-items:center;

    gap:6px;

    font-size:14px;
    font-weight:600;

    white-space:nowrap;
}

.legend-color{
    width:15px;
    height:15px;
    border-radius:3px;
}

.c1{ background:#4BB8C7; }
.c2{ background:#2AA7B8; }
.c3{ background:#177C89; }
.c4{ background:#6CCDD9; }

.map-compass{
    position:absolute;

    bottom:90px;
    right:1px;

    width:100px;

    z-index:500;
}

.legend-text{
    display:flex;
    flex-direction:column;
    line-height:1.2;
}

.legend-main{
    font-size:14px;
    font-weight:700;
}

.legend-sub{
    font-size:11px;
    color:#666;
}

.map-dropdown{
    position:absolute;

    top:18px;
    right:18px;

    z-index:400;
}

.menu-btn{
    width:46px;
    height:46px;

    border:none;
    border-radius:12px;

    background:white;

    font-size:22px;
    font-weight:700;

    color:#177C89;

    cursor:pointer;

    box-shadow:0 4px 12px rgba(0,0,0,0.15);
}

.dropdown-menu-map{
    position:absolute;

    top:55px;
    right:0;

    width:180px;

    background:white;

    border-radius:14px;

    overflow:hidden;

    display:none;

    box-shadow:0 6px 16px rgba(0,0,0,0.15);
}

.dropdown-item{
    padding:12px 16px;

    font-size:14px;
    font-weight:600;

    cursor:pointer;

    transition:.2s;
}

.dropdown-item:hover{
    background:#E7F7F9;
    color:#177C89;
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




.figma-card-content h3{
    color:white;
    font-size:18px;
    font-weight:800;
    line-height:1.35;
    margin-bottom:12px;
}

.figma-card-content p{
    color:white;
    font-size:13px;
    line-height:1.6;
    font-weight:500;
    margin:0;
}

.figma-card-content ul{
    padding-left:18px;
}

.figma-card-content li{
    color:white;
    font-size:15px;
    margin-bottom:8px;
}

.figma-card img{
    width: 50%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    flex-shrink: 0;
}

/* =========================
   FIGMA IKLAN SLIDER
========================= */


.figma-card-text{
    width: 52%;
    padding: 36px 30px;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
}


.figma-arrow.left{
    left:-26px;
}

.figma-arrow.right{
    right:-26px;
}




.figma-card-text h3{
    font-size: 48px;
    font-weight: 900;
    line-height: 1.08;
    margin-bottom: 22px;
    text-transform: uppercase;
}

.figma-card-text p{
    font-size: 21px;
    line-height: 1.8;
    font-weight: 500;

    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
}



.figma-card-image img{
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 24px;
    background: #f7f7f7;
}

/* ===============================
   PREMIUM SLIDER
=============================== */


.slider-wrapper{
    position: relative;
    width: 100%;
}

.figma-slider{
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
}

.slider-card{
    min-width: 100%;
    height: 430px;
    display: flex;
    border-radius: 34px;
    overflow: hidden;
    background: linear-gradient(135deg,#18C7D3,#14B8C8);
    box-shadow: 0 18px 45px rgba(0,0,0,.12);
    flex-shrink: 0;
}

/* TEXT */
.slider-text{
    width: 58%;
    padding: 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: white;
}

.slider-text h2{
    font-size: 52px;
    font-weight: 900;
    line-height: 1.05;
    margin-bottom: 20px;
    text-transform: uppercase;
    color: white !important;
}

.slider-text p{
    font-size: 22px;
    line-height: 1.7;
    font-weight: 500;
    color: white !important;

    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* IMAGE */
.slider-image{
    width: 42%;
    background: white;
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.slider-image img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 26px;
}

/* BUTTON */
.slider-btn{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 72px;
    height: 72px;
    border: none;
    border-radius: 50%;
    background: white;
    box-shadow: 0 10px 25px rgba(0,0,0,.15);
    z-index: 999;
    font-size: 28px;
    color: #17C4D2;
    cursor: pointer;
}

.slider-btn.prev{
    left: -35px;
}

.slider-btn.next{
    right: -35px;
}

.slider-btn:hover{
    transform: translateY(-50%) scale(1.08);
}

/* MOBILE */
@media(max-width:992px){
    .slider-card{
        flex-direction: column;
        height: auto;
    }

    .slider-text,
    .slider-image{
        width:100%;
    }

    .slider-text{
        padding:30px;
    }

    .slider-text h2{
        font-size:30px;
    }

    .slider-text p{
        font-size:16px;
    }

    .slider-image{
        height:260px;
    }
}

.figma-arrow.left{
    left: -18px;
}

.figma-arrow.right{
    right: -18px;
}

@media(max-width:992px){


    .figma-card-text h3{
        font-size: 30px;
    }

    .figma-card-text p{
        font-size: 16px;
    }
}

/* =========================
   FIGMA STYLE SLIDER FINAL
========================= */

.figma-slider-section{
    margin: 70px 0;
}

.figma-slider-container{
    position: relative;
    width: 100%;
    padding: 0 70px;
    overflow: hidden;
}

.figma-slider{
    display: flex;
    gap: 30px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
}

.figma-slider::-webkit-scrollbar{
    display:none;
}

/* CARD */
.figma-card{
    flex: 0 0 100%;
    max-width: 100%;
    min-height: 330px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 28px 36px;

    background: linear-gradient(
        90deg,
        #11B9C8 0%,
        #78D8D9 100%
    );

    border-radius: 24px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.08);

    overflow: hidden;
}

/* TEKS */
.figma-card-text{
    width: 55%;
    color: white;
    padding-right: 30px;

    display: flex;
    flex-direction: column;
    justify-content: center;
}

.figma-card-text h3{
    font-size: 46px;
    font-weight: 800;
    line-height: 1.15;
    margin-bottom: 18px;

    word-break: break-word;
    overflow-wrap: break-word;
}

.figma-card-text p{
    font-size: 21px;
    font-weight: 500;
    line-height: 1.7;
    margin: 0;

    word-break: break-word;
    overflow-wrap: break-word;

    max-width: 100%;
}

/* GAMBAR */
.figma-card-image{
    width: 40%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.figma-card-image img{
    width: 100%;
    height: 230px;

    object-fit: cover;
    object-position: center;

    border-radius: 22px;
    display:block;
}

/* ARROW */
.figma-arrow{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 50;

    width: 64px;
    height: 64px;
    border: none;
    border-radius: 50%;

    background: white;
    color: #11B9C8;
    font-size: 26px;

    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.figma-arrow.left{
    left: 10px;
}

.figma-arrow.right{
    right: 10px;
}

.figma-arrow:hover{
    transform: translateY(-50%) scale(1.08);
}

/* RESPONSIVE */
@media(max-width:992px){

    .figma-card{
        flex-direction: column;
        min-height: auto;
        padding: 24px;
    }

    .figma-card-text,
    .figma-card-image{
        width: 100%;
    }

    .figma-card-text{
        padding-right: 0;
        margin-bottom: 20px;
    }

    .figma-card-text h3{
        font-size: 28px;
    }

    .figma-card-text p{
        font-size: 16px;
    }

    .figma-card-image img{
        height: 220px;
    }
}
.figma-arrow.left{
    left: -5px;
}

.figma-arrow.right{
    right: -5px;
}

/* MOBILE */
@media(max-width:991px){

    .figma-card{
        min-width: 92%;
        height: auto;
        flex-direction: column;
    }

   
    .figma-card-text h3{
        font-size: 24px;
    }




}
/* =========================
   SLIDER FIX FIGMA
========================= */

.figma-slider-section{
    margin: 70px 0;
}

.slider-wrapper{
    position: relative;
    padding: 0 50px;
}

.figma-slider{
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
}

.figma-slider::-webkit-scrollbar{
    display:none;
}

.figma-card{
    flex: 0 0 100%;
    background: transparent;
}

.figma-content{
    display: flex;
    align-items: center;
    justify-content: space-between;

    background: linear-gradient(90deg,#0EB8C7,#72D8D8);
    border-radius: 24px;

    padding: 38px;
    min-height: 280px;

    box-shadow: 0 14px 35px rgba(0,0,0,0.08);
}

/* TEKS */
.figma-text{
    width: 58%;
    color: white;
}

.figma-text h3{
    font-size: 34px;
    font-weight: 800;
    line-height: 1.25;
    margin-bottom: 18px;

    word-wrap: break-word;
}

.figma-text p{
    font-size: 15px;
    line-height: 1.8;
    margin-bottom: 25px;

    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* META */
.figma-meta{
    display: flex;
    gap: 24px;
    font-size: 13px;
    opacity: .95;
}

/* IMAGE */
.figma-image{
    width: 38%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.figma-image img{
    width: 100%;
    height: 170px;
    object-fit: cover;
    border-radius: 18px;
}

/* BUTTON */
.slider-btn{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 50;

    width: 58px;
    height: 58px;
    border: none;
    border-radius: 50%;

    background: white;
    color: #10B8C7;
    font-size: 22px;

    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

.slider-btn.prev{
    left: -5px;
}

.slider-btn.next{
    right: -5px;
}

.slider-btn:hover{
    transform: translateY(-50%) scale(1.08);
}

/* MOBILE */
@media(max-width: 992px){

    .figma-content{
        flex-direction: column;
        text-align: center;
    }

    .figma-text,
    .figma-image{
        width: 100%;
    }

    .figma-image{
        margin-top: 25px;
    }

    .figma-text h3{
        font-size: 24px;
    }
}
</style>
</div>
<?= $this->include('layout/footer') ?>