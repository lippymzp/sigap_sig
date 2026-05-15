<?php $this->setVar('penyakit', 'diare'); ?>
<?php 
$this->setVar('penyakit', 'diare');
$this->setVar('show_footer_maskot', true);
?>
<?= $this->include('layout/header') ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<div class="diare-page">
<style>
.diare-page,
.diare-page *{
    font-family:'Poppins', sans-serif !important;
}
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

.fitur-box{
    background: var(--card);
    border-radius: 14px;
    font-weight: 600;
    color: var(--dark);
    transition: 0.3s;

    width: 100%;
    height: 86px;

    display: flex !important;
    align-items: center;
    justify-content: center;

    text-align: center;
    padding: 12px 16px;
    line-height: 1.4;

    box-shadow: 0 6px 18px rgba(0,0,0,0.08);

    text-decoration: none;
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
/* ==================================
   AI BUTTON
================================== */

/* ======================================
   AI FLOATING MASCOT
====================================== */

/* ======================================
   DOXY FLOATING AI
====================================== */

/* ======================================
   DOXY FLOATING ASSISTANT
====================================== */
.ai-button{
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    cursor: pointer;

    display: flex;
    flex-direction: column;
    align-items: center;

    background: transparent;
    border: none;
    box-shadow: none;

    animation: floatDoxy 3s ease-in-out infinite;
    transition: 0.3s ease;
}

/* WRAPPER */
.ai-wrap{
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* MASKOT */
.ai-mascot{
    width: 120px;
    height: 120px;
    object-fit: contain;
    filter: drop-shadow(0 10px 20px rgba(143, 76, 255, 0.25));
    transition: 0.3s ease;
}

/* LABEL MENYATU */
.ai-label{
    position: absolute;
    top: -8px;
    left: 50%;
    transform: translateX(-50%);

    background: linear-gradient(135deg, #ff6fd8, #c44dff);
    color: white;

    padding: 6px 16px;
    border-radius: 999px;

    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 1px;
    white-space: nowrap;

    box-shadow:
        0 8px 20px rgba(196,77,255,0.35),
        inset 0 1px 0 rgba(255,255,255,0.4);

    border: 2px solid rgba(255,255,255,0.35);
}

/* HOVER */
.ai-button:hover .ai-mascot{
    transform: scale(1.08) rotate(3deg);
}

.ai-button:hover .ai-label{
    transform: translateX(-50%) scale(1.05);
}

/* FLOAT */
@keyframes floatDoxy{
    0%,100%{
        transform: translateY(0);
    }
    50%{
        transform: translateY(-10px);
    }
}

/* MOBILE */
@media(max-width:768px){
    .ai-mascot{
        width: 100px;
        height: 100px;
    }

    .ai-label{
        font-size: 12px;
        padding: 5px 13px;
        top: -6px;
    }

    .ai-button{
        bottom: 15px;
        right: 10px;
    }
}

/* ======================================
   AI FLOATING BUTTON
====================================== */


.ai-button:hover{

    transform: scale(1.1);

}

@keyframes pulseAI{

    0%{
        box-shadow: 0 0 0 0 rgba(64,237,208,0.5);
    }

    70%{
        box-shadow: 0 0 0 20px rgba(64,237,208,0);
    }

    100%{
        box-shadow: 0 0 0 0 rgba(64,237,208,0);
    }

}

/* ======================================
   CHAT BOX
====================================== */

.ai-chat-box{
    position: fixed;
    bottom: 130px;
    right: 30px;
    width: 380px;
    height: 570px;

    background: linear-gradient(
        180deg,
        #fff7ff 0%,
        #f8f2ff 35%,
        #f3f6ff 100%
    );

    border-radius: 28px;
    overflow: hidden;
    z-index: 9999;
    display: none;
    flex-direction: column;

    border: 2px solid rgba(255,255,255,0.7);

    box-shadow:
        0 25px 60px rgba(155, 81, 224, 0.25),
        0 10px 25px rgba(255, 105, 180, 0.18);

    animation: showChat 0.3s ease;
}

@keyframes showChat{

    from{
        opacity: 0;
        transform: translateY(30px);
    }

    to{
        opacity: 1;
        transform: translateY(0);
    }

}

/* HEADER */

.ai-header{
    background: linear-gradient(
        135deg,
        #ff6fd8 0%,
        #d946ef 35%,
        #8b5cf6 70%,
        #6366f1 100%
    );

    color: white;
    padding: 18px 20px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    box-shadow: 0 6px 20px rgba(168,85,247,0.25);
}

.ai-header b{

    font-size: 18px;

}

.ai-header small{

    opacity: 0.9;

}

.ai-header button{
    background: rgba(255,255,255,0.22);
    backdrop-filter: blur(8px);

    border: 1px solid rgba(255,255,255,0.25);

    width: 38px;
    height: 38px;
    border-radius: 50%;

    color: white;
    font-size: 16px;
    transition: 0.3s ease;
}

.ai-header button:hover{
    transform: rotate(90deg);
    background: rgba(255,255,255,0.35);
}

/* BODY */

.ai-body{
    flex: 1;
    padding: 20px;
    overflow-y: auto;

    background: linear-gradient(
        180deg,
        #fff8ff 0%,
        #f9f3ff 50%,
        #f3f8ff 100%
    );

    display: flex;
    flex-direction: column;
}

/* MESSAGE */

.bot-message,
.user-message{

    padding: 14px 18px;

    border-radius: 18px;

    margin-bottom: 15px;

    max-width: 80%;

    line-height: 1.7;

    font-size: 14px;

    animation: fadeChat 0.3s ease;

}

@keyframes fadeChat{

    from{
        opacity: 0;
        transform: translateY(10px);
    }

    to{
        opacity: 1;
        transform: translateY(0);
    }

}

/* BOT */

.bot-message{
    background: linear-gradient(
        135deg,
        #ffe8ff 0%,
        #f4d8ff 45%,
        #e4e7ff 100%
    );

    color: #4b2d73;

    padding: 15px 18px;
    border-radius: 22px;
    margin-bottom: 15px;
    max-width: 82%;
    line-height: 1.7;
    font-size: 14px;

    box-shadow:
        0 8px 20px rgba(196,77,255,0.08);

    align-self: flex-start;
}

/* USER */

.user-message{
    background: linear-gradient(
        135deg,
        #ff6fd8 0%,
        #c44dff 45%,
        #6366f1 100%
    );

    color: white;

    padding: 14px 18px;
    border-radius: 22px;
    margin-bottom: 15px;
    max-width: 82%;
    line-height: 1.7;
    font-size: 14px;

    box-shadow:
        0 10px 20px rgba(168,85,247,0.2);

    align-self: flex-end;
}

/* INPUT */

.ai-input{
    display: flex;
    padding: 15px;
    gap: 10px;

    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);

    border-top: 1px solid rgba(220,200,255,0.6);
}

.ai-input input{
    flex: 1;
    border: none;

    background: linear-gradient(
        135deg,
        #f7f1ff,
        #eef3ff
    );

    border-radius: 18px;
    padding: 14px 16px;
    outline: none;
    font-size: 14px;

    color: #4b2d73;
}

.ai-input button{
    border: none;

    background: linear-gradient(
        135deg,
        #ff6fd8,
        #c44dff,
        #6366f1
    );

    color: white;
    border-radius: 18px;
    padding: 0 22px;
    font-weight: 700;

    box-shadow: 0 10px 20px rgba(168,85,247,0.2);
}

/* TYPING */

.typing{
    display: flex;
    gap: 6px;
    padding: 12px 16px;

    background: linear-gradient(
        135deg,
        #ffe8ff,
        #eef2ff
    );

    border-radius: 18px;
    width: fit-content;
    margin-bottom: 15px;
}

.typing span{
    width: 8px;
    height: 8px;
    background: #c44dff;
    border-radius: 50%;
    animation: bounce 1.4s infinite;
}

.typing span:nth-child(2){

    animation-delay: 0.2s;

}

.typing span:nth-child(3){

    animation-delay: 0.4s;

}

@keyframes bounce{

    0%,80%,100%{
        transform: scale(0);
    }

    40%{
        transform: scale(1);
    }

}

/* MOBILE */

@media(max-width:768px){

    .ai-chat-box{

        width: 92%;

        right: 4%;

        height: 80vh;

    }
.ai-button{
    width: 80px;
    height: 80px;
    bottom: 20px;
    right: 20px;
}
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

<div class="row g-4 justify-content-center">

    <div class="col-lg col-md-4 col-6">
        <div class="fitur-box shadow-sm">
            📊 Grafik Kesehatan
        </div>
    </div>

    <div class="col-lg col-md-4 col-6">
        <div class="fitur-box shadow-sm">
            🗺️ Peta Persebaran
        </div>
    </div>

    <div class="col-lg col-md-4 col-6">
        <div class="fitur-box shadow-sm">
            📄 Artikel Kesehatan
        </div>
    </div>

    <div class="col-lg col-md-4 col-6">
        <a href="<?= base_url('skrining-diare') ?>"
           class="fitur-box text-decoration-none shadow-sm d-block">
            🩺 Skrining Kesehatan
        </a>
    </div>

    <div class="col-lg col-md-4 col-6">
        <a href="<?= base_url('diare/kalkulator-air') ?>"
           class="fitur-box text-decoration-none shadow-sm d-block">
            💧 Kalkulator Air
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
</section>
<!-- TOMBOL AI -->
<!-- TOMBOL AI -->
<div class="ai-button" onclick="toggleChat()">
    <div class="ai-wrap">
        <div class="ai-label">DOXY AI</div>
        <img src="<?= base_url('img/maskotdsing.png') ?>" alt="DOXY AI" class="ai-mascot">
    </div>
</div>
<!-- CHAT BOX -->
<div class="ai-chat-box" id="aiChatBox">

    <!-- HEADER -->
    <div class="ai-header">

        <div>
            <b>DOXY AI</b><br>
            <small>Asisten Diare</small>
        </div>

        <button onclick="toggleChat()">
            ✖
        </button>

    </div>

    <!-- ISI CHAT -->
    <div class="ai-body" id="aiBody">

        <div class="bot-message">
            Halo 👋<br>
            Saya DOXY AI.<br><br>

            Silakan tanyakan tentang:
            <br>• Penyakit Diare
            <br>• Gejala Diare
            <br>• Pencegahan Diare
        </div>

    </div>

    <!-- INPUT -->
    <div class="ai-input">

        <input 
            type="text"
            id="aiInput"
            placeholder="Tulis pertanyaan..."
        >

        <button onclick="sendMessage()">
            Kirim
        </button>

    </div>

</div>
<script>

/* KLIK TOMBOL 🤖 */
document.querySelector('.ai-button').onclick = toggleChat;

/* BUKA TUTUP CHAT */
function toggleChat(){

    let chat = document.getElementById('aiChatBox');

    if(chat.style.display == 'flex'){

        chat.style.display = 'none';

    }else{

        chat.style.display = 'flex';

    }

}

/* KLIK TOMBOL AI */
document.querySelector('.ai-button').onclick = toggleChat;

/* ENTER */
document.getElementById('aiInput').addEventListener('keypress', function(e){

    if(e.key === 'Enter'){

        sendMessage();

    }

});

async function sendMessage(){

    let input = document.getElementById('aiInput');

    let body = document.getElementById('aiBody');

    let text = input.value.trim();

    if(text == '') return;

    /*
    =====================================
    USER MESSAGE
    =====================================
    */

    body.innerHTML += `
        <div class="user-message">
            ${text}
        </div>
    `;

    input.value = '';

    body.scrollTop = body.scrollHeight;

    /*
    =====================================
    TYPING
    =====================================
    */

    body.innerHTML += `
        <div class="typing" id="typingAI">
            <span></span>
            <span></span>
            <span></span>
        </div>
    `;

    body.scrollTop = body.scrollHeight;

    try {

        /*
        =====================================
        FETCH API
        =====================================
        */

        const response = await fetch("<?= base_url('ai/chat') ?>", {

            method: 'POST',

            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },

            body: new URLSearchParams({
                message: text
            })

        });

        /*
        =====================================
        GET RESULT
        =====================================
        */

        const result = await response.text();

        console.log(result);

        const data = JSON.parse(result);

        /*
        =====================================
        REMOVE TYPING
        =====================================
        */

        document.getElementById('typingAI').remove();

        /*
        =====================================
        BOT MESSAGE
        =====================================
        */

        body.innerHTML += `
            <div class="bot-message">
                ${data.answer}
            </div>
        `;

        body.scrollTop = body.scrollHeight;

    } catch(error){

        document.getElementById('typingAI').remove();

        body.innerHTML += `
            <div class="bot-message">
                Error: ${error}
            </div>
        `;

    }

}

</script>
</div>
<?= $this->include('layout/footer') ?>