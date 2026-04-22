<?php $this->setVar('penyakit', 'diare'); ?>
<?= $this->include('layout/header') ?>

<style>
:root{
    --primary:#40EDD0;
    --dark:#00CED1;
    --medium:#48D1CC;

    --bg:#F4FEFD;
    --card:#E0F7F6;
    --accent:#2CCFC0;
    --border:#B8ECE8;

    --text-dark:#1F3A3A;
    --text-light:#6B8A8A;
}

/* GLOBAL */
body{
    background:var(--bg);
    color:var(--text-dark);
}

/* HERO FIGMA STYLE */
.pneu-hero{
    background: linear-gradient(135deg, rgba(0,206,209,0.9), rgba(64,237,208,0.9)),
                url("<?= base_url('img/bg-hero.png') ?>");
    background-size: cover;
    background-position: center;
    padding:100px 0;
    border-radius:0 0 40px 40px;
}

.hero-content{
    border:2px solid rgba(255,255,255,0.6);
    padding:25px;
    border-radius:15px;
    backdrop-filter: blur(5px);
}

.hero-content h1{
    font-size:42px;
    font-weight:800;
}

.btn-light{
    border-radius:30px;
}

/* FITUR */
.fitur-box{
    background:var(--card);
    padding:18px;
    border-radius:12px;
    font-weight:600;
    color:var(--dark);
    transition:0.3s;
}

.fitur-box:hover{
    background:var(--accent);
    color:white;
    transform:translateY(-5px);
}

/* TITLE */
.text-teal{
    color:var(--dark);
}

/* CARD INSIGHT */
.card{
    border:none !important;
}

.card-gradient{
    background:linear-gradient(135deg,var(--dark),var(--primary));
    color:white;
}

/* CTA */
.btn-teal{
    background:var(--dark);
    color:white;
    border-radius:30px;
}

.btn-teal:hover{
    background:var(--accent);
}
</style>

<!-- HERO (TIDAK DIHAPUS, HANYA DIPERBAIKI STYLE) -->
<section class="hero-figma text-white">
<div class="container">

<div class="hero-content-box" data-aos="fade-right">
    <h1>Diare</h1>

    <p class="mt-3">
        Tau ga sih, Apa itu Diare ? <br>
        Diare adalah infeksi pada sistem pencernaan akibat makanan/minuman tidak higienis.
    </p>

    <a href="<?= base_url('diare-detail') ?>" class="btn btn-hero mt-3">
        Pelajari selanjutnya →
    </a>
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
<a href="<?= base_url('skrining-diare') ?>" class="fitur-box text-decoration-none shadow-sm d-block">
    🩺 Skrining Kesehatan
</a>
</div>

</div>
</section>

<!-- INSIGHT (TETAP ADA, HANYA DIPERCANTIK) -->
<section class="container mt-5" data-aos="fade-up">

<h6 class="text-center text-muted">Insights</h6>
<h4 class="text-center mb-4 fw-bold">Telusuri Informasi Berikut</h4>

<div class="carousel-wrapper">

<button class="nav-btn left" onclick="slide(-1)">‹</button>

<div class="scroll-container" id="slider">

    <!-- CARD 1 -->
    <div class="scroll-item card-gradient shadow">
        <div class="d-flex justify-content-between align-items-center h-100">
            <div>
                <h5>Pengertian, penyebab, gejala, diagnosis, pengobatan, pencegahan, dan komplikasi Diare</h5>
                <p>Informasi lengkap tentang diare</p>
            </div>
            <img src="<?= base_url('img/diare-artikel.png') ?>">
        </div>
    </div>

    <!-- CARD 2 -->
    <div class="scroll-item card-gradient shadow">
        <div class="d-flex justify-content-between align-items-center h-100">
            <div>
                <h5>ISPA dan Diare Penyakit Dominan Pasca Banjir Aceh Tamian</h5>
                <p>Kasus dominan</p>
            </div>
            <img src="<?= base_url('img/dokter.png') ?>">
        </div>
    </div>

    <!-- CARD 3 -->
    <div class="scroll-item card-gradient shadow">
        <div class="d-flex justify-content-between align-items-center h-100">
            <div>
                <h5>DIARE, PANTI PERKUAT KOLABORASI HADAPI ANCAMAN KESEHATAN</h5>
                <p>Panti berkolaborasi untuk menghadapi ancaman kesehatan.</p>
            </div>
            <img src="<?= base_url('img/seminar.png') ?>">
        </div>
    </div>

    <!-- CARD 4 -->
    <div class="scroll-item card-gradient shadow">
        <div class="d-flex justify-content-between align-items-center h-100">
            <div>
                <h5>Variasi Temporal dan Klaster Spasial Penyakit Diare di Provinsi Jakarta, Indonesia</h5>
                <p>Penyakit diare</p>
            </div>
            <img src="<?= base_url('img/riset.png') ?>">
        </div>
    </div>

</div>

<button class="nav-btn right" onclick="slide(1)">›</button>

<!-- DOT -->
<div class="dots" id="dots"></div>

</div>

</section>

<!-- CTA (TIDAK DIHAPUS) -->
<section class="container mt-5" data-aos="zoom-in">

<div class="p-4 text-center shadow-sm" style="border-radius:20px; border:2px solid var(--border); background:white;">

<h5 class="fw-bold">Mengalami Gejala?</h5>
<p>
Tubuhmu memberi sinyal, jangan diabaikan.<br>
Yuk lakukan <span style="color:red;">skrining</span> sejak dini!
</p>

<a href="<?= base_url('skrining-diare') ?>" class="btn btn-teal px-4 py-2 shadow">
    Mulai Skrining →
</a>

</div>

</section>

<!-- ================= KODE LAMA ANDA TIDAK DIUBAH ================= -->

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

<!-- ================= SCRIPT ANDA FULL (TIDAK DISENTUH) ================= -->
<script>

/* 🔥 FIX UTAMA (TIDAK MENGUBAH KODE LAMA) */
function fixNama(nama){
    return (nama || "")
        .toLowerCase()
        .trim()
        .replace(/\s+/g, " ")
        .replace(/[^a-z0-9 ]/g, "");
}

var aliasDesa = {
    "kemuningsarilor": "kemuning sari lor"
};

var dataDiare = <?= json_encode($diare ?? []) ?>;

var dataFinal = {};

dataDiare.forEach(item => {

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

</script>

<script>
document.addEventListener("DOMContentLoaded", function(){

new Chart(document.getElementById('chartDiare'), {
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

var map = L.map('mapDiare').setView([-8.1,113.5], 12);

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
<script>
function scrollInsight(direction){
    const el = document.getElementById('insightScroll');
    const width = el.clientWidth;

    el.scrollBy({
        left: direction * width,
        behavior: 'smooth'
    });
}
</script>
<script>
let index = 0;
const slider = document.getElementById('slider');
const total = slider.children.length;

/* buat dots */
const dotsContainer = document.getElementById('dots');
for(let i=0;i<total;i++){
    let dot = document.createElement('span');
    dot.onclick = () => goTo(i);
    dotsContainer.appendChild(dot);
}
updateDots();

function slide(dir){
    index += dir;
    if(index >= total) index = 0;
    if(index < 0) index = total - 1;
    updateSlide();
}

function goTo(i){
    index = i;
    updateSlide();
}

function updateSlide(){
    slider.scrollTo({
        left: index * slider.clientWidth,
        behavior:'smooth'
    });
    updateDots();
}

function updateDots(){
    const dots = document.querySelectorAll('#dots span');
    dots.forEach((d,i)=>{
        d.classList.toggle('active', i === index);
    });
}

/* auto slide */
setInterval(()=>{
    slide(1);
},4000);

/* swipe mobile */
let startX = 0;
slider.addEventListener("touchstart", e=>{
    startX = e.touches[0].clientX;
});
slider.addEventListener("touchend", e=>{
    let endX = e.changedTouches[0].clientX;
    if(startX - endX > 50) slide(1);
    if(endX - startX > 50) slide(-1);
});
</script>
<!-- RINGKASAN DATA -->
<section class="container mt-5">

<div class="ringkasan-box">

    <h4 class="fw-bold mb-3">Ringkasan Data</h4>

    <p>
        Kasus diare tertinggi terjadi di Desa 
        <span class="highlight-red">Panti</span> 
        yang masuk kategori sangat tinggi dibanding wilayah lain
    </p>

    <p>
        Terdapat <b>2 desa</b> dengan kasus di atas rata-rata
    </p>

    <p>
        Rata-rata kasus diare di tiap desa adalah 
        <span class="highlight-red">60 kasus</span>
    </p>

    <p>
        Rata-rata kasus diare di kecamatan Panti adalah 
        <span class="highlight-red">120 kasus</span>
    </p>

</div>

<div class="text-center mt-4">
    <a href="<?= base_url('home') ?>" class="btn-kembali">
        Kembali
    </a>
</div>

</section>
<?= $this->include('layout/footer') ?>