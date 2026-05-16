<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>
<?php helper('text'); ?>

<!-- WELCOME -->
<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai ADMIN</h3>
        <p>Puskesmas Kaliwates, Jember</p>
    </div>

    <div class="welcome-icon">
        <i class="fa-solid fa-map"></i>
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
<div class="section-block" id="peta-sebaran">

    <!-- MAP -->
    <div class="section-block">

        <div class="section-header">
            <div>
                <h5>Peta Interaktif Penyebaran</h5>
                <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
            </div>

            <div class="filter">
                <span>Periode:</span>
                <select>
                    <option>2025</option>
                </select>
            </div>
        </div>

        <div class="inner-card">
    <div id="map" style="height:400px; border-radius:15px;"></div>

    <script>
    document.addEventListener("DOMContentLoaded", function(){

        function fixNama(nama){
            return (nama || "")
                .toLowerCase()
                .trim()
                .replace(/\s+/g, " ")
                .replace(/[^a-z0-9 ]/g, "");
        }

        /* AMBIL DATA DARI PHP */
        var dataTbc = <?= json_encode($tbc ?? []) ?>;
        console.log(dataTbc);
        var dataFinal = {};

        dataTbc.forEach(item => {

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

        /* INIT MAP */
        var map = L.map('map').setView([-8.1,113.5], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
        .addTo(map);

        setTimeout(() => {
            map.invalidateSize();
        }, 200);

        /* LOAD GEOJSON */
        fetch("<?= base_url('assets/peta/tbc.geojson') ?>")
        .then(res => res.json())
        .then(data => {

            var geo = L.geoJSON(data, {

                style: function(feature){

                    var nama = fixNama(feature.properties.NAMOBJ);
                    var item = dataFinal[nama];

                    var warna = "#cccccc";

                    if(item){
                        if(item.kategori == "tinggi") warna = "#1b4332";
                        else if(item.kategori == "sedang") warna = "#40916c";
                        else if(item.kategori == "rendah") warna = "#95d5b2";
                    }

                    return {
    color: "#00bcd4",
    weight: 2,
    fillColor: warna,
    fillOpacity: 0.55
};
                },

                onEachFeature: function(feature, layer){

                    var namaAsli = feature.properties.NAMOBJ;
var item = dataFinal[fixNama(namaAsli)];

var tingkat = "Tidak Ada";
var warna = "#999";

if(item){

    if(item.total >= 100){
        tingkat = "Tinggi";
        warna = "#e63946";
    }
    else if(item.total >= 50){
        tingkat = "Sedang";
        warna = "#ff9800";
    }
    else{
        tingkat = "Rendah";
        warna = "#2a9d8f";
    }
}

var isi = `

<div style="
    width:240px;
    font-family:Poppins,sans-serif;
">

    <div style="
        font-size:18px;
        font-weight:700;
        margin-bottom:8px;
        color:#222;
    ">
        Kelurahan: ${namaAsli}
    </div>

    <div style="
        font-size:14px;
        color:#444;
        margin-bottom:4px;
    ">
        Total Kasus: <b>${item ? item.total : 0}</b>
    </div>

    <div style="
        font-size:14px;
        color:#444;
        margin-bottom:14px;
    ">
        Kategori:
        <b style="color:${warna}">
            ${tingkat}
        </b>
    </div>

<button
    type="button"

    onclick="
        event.stopPropagation();

        window.openModal(
            '${namaAsli}',
            '${item ? item.total : 0}',
            '${tingkat}',
            '0',
            '0',
            '0',
            '0',
            '0'
        );
    "

    style="
        background:#14c7d4;
        color:white;
        border:none;
        padding:10px 18px;
        border-radius:10px;
        font-weight:600;
        cursor:pointer;
        width:100%;
    "
>
    Selengkapnya
</button>

</div>
`;

layer.on({
    mouseover: function(e){

        e.target.setStyle({
            weight:3,
            color:'#111',
            fillOpacity:0.8
        });

        this.openPopup();

    },

    mouseout: function(e){

        geo.resetStyle(e.target);

    }
});

layer.bindPopup(isi);

layer.on('popupopen', function(e){

    const popup = e.popup.getElement();

    L.DomEvent.disableClickPropagation(popup);
    L.DomEvent.disableScrollPropagation(popup);

});

layer.on('mouseout', function () {

    setTimeout(() => {

        if(!this.isInsidePopup){
            this.closePopup();
        }

    }, 1200);

});

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
</div>

   <!-- CHART -->
<div class="section-block">

    <div class="section-header">
        <div>
            <h5>Grafik Interaktif Penyebaran</h5>
            <p class="sub">Visualisasi kepadatan kasus berdasarkan grafik</p>
        </div>

        <div class="filter-group">
            <select>
                <option>Semua Wilayah Desa</option>
            </select>

            <select>
                <option>Semua Kategori</option>
            </select>

            <select>
                <option>7 Hari Terbaru</option>
            </select>
        </div>
    </div>

    <div class="inner-card">
    
    <div class="chart-box">
        <canvas id="chartTbc"></canvas>
    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const ctx = document.getElementById('chartTbc');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari','Februari','Maret','April','Mei'],
            datasets: [
                {
                    label: 'Sembuh',
                    data: [70,100,80,60,120],
                    backgroundColor: '#95d5b2'
                },
                {
                    label: 'Pengobatan',
                    data: [120,140,110,90,100],
                    backgroundColor: '#52b788'
                },
                {
                    label: 'Meninggal',
                    data: [15,25,20,15,30],
                    backgroundColor: '#1b4332'
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
                    beginAtZero: true
                }
            }
        }
    });

});
</script>

<style>
.chart-box {
    height: 350px;
    background: white;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}
</style>

    <p class="update-text">Diperbarui pada: 11-4-2025</p>

</div>
</div>
</div>

<!-- SECTION BERITA -->
<div class="content-section">

    <h4 class="section-title">Berita</h4>
    <p class="section-sub">
        Informasi terkini seputar pencegahan, penanganan, dan edukasi penyakit TBC.
    </p>

    <?php if (!empty($berita)) : ?>

    <div class="carousel-wrapper">

    <button class="nav-btn left" onclick="slide(-1)">‹</button>

    <div class="berita-slider" id="slider">

        <?php foreach ($berita as $b) : ?>

            <?php
            $link = !empty($b['url_berita'])
                ? $b['url_berita']
                : base_url('tbc/berita/detail/' . $b['id_berita']);
            ?>

            <a href="<?= $link ?>"
            class="info-card berita-card"
            <?= !empty($b['url_berita']) ? 'target="_blank"' : '' ?>>

                <div class="info-text">

                    <h5><?= esc($b['judul_berita']) ?></h5>

                    <?php if (!empty($b['deskripsi_berita'])) : ?>
                        <p>
                            <?= !empty($b['deskripsi_berita'])
    ? substr(strip_tags($b['deskripsi_berita']), 0, 120) . '...'
    : 'Tidak ada deskripsi' ?>
                        </p>
                    <?php endif; ?>

                    <small>
                        <?= !empty($b['tanggal_berita']) && $b['tanggal_berita'] != '0000-00-00'
    ? date('d M Y', strtotime($b['tanggal_berita']))
    : '-' ?>
                    </small>

                </div>

                <div class="info-image">

                    <?php if (!empty($b['gambar_berita'])) : ?>

                        <img src="<?= base_url('uploads/berita/' . $b['gambar_berita']) ?>">

                    <?php else : ?>

                        <img src="<?= base_url('img/default-news.png') ?>">

                    <?php endif; ?>

                </div>

            </a>

        <?php endforeach ?>

        </div>

    <button class="nav-btn right" onclick="slide(1)">›</button>

    <div class="dots" id="dots"></div>

</div>

<?php endif ?>

</div>

<!-- SECTION FUNFACT -->
<div class="content-section">

    <h4 class="section-title">Funfact</h4>

    <p class="section-sub">
        Fakta menarik dan edukasi singkat seputar penyakit TBC.
    </p>

    <?php if (!empty($funfact)) : ?>

    <div class="funfact-wrapper">

<button class="nav-btn left" onclick="slideFunfact(-1)">‹</button>

<div class="funfact-slider" id="funfactSlider">

        <?php foreach ($funfact as $f) : ?>

            <div class="funfact-card">

                <div class="info-text">

                    <h5>
                        <?= esc($f['judul_funfact']) ?>
                    </h5>

                    <p>
                        <?= esc($f['deskripsi_funfact']) ?>
                    </p>

                </div>

                <div class="info-image">
                    <img src="<?= base_url('uploads/funfact/' . $f['gambar_funfact']) ?>">
                </div>

            </div>

        <?php endforeach; ?>

    </div>

<button class="nav-btn right" onclick="slideFunfact(1)">›</button>

<div class="funfact-dots" id="funfactDots"></div>

</div>

<?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmLogout(url) {

    Swal.fire({
        title: 'Apakah anda yakin keluar?',
        icon: 'warning',
        showCancelButton: true,

        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'

    }).then((result) => {

        if (result.isConfirmed) {
            window.location.href = url;
        }

    });

}
</script>

<style>

.berita-slider{
    display:flex;
    gap:25px;

    overflow-x:auto;    
    scroll-behavior:smooth;

    padding-bottom:15px;
}

.berita-slider::-webkit-scrollbar{
    height:8px;
}

.berita-slider::-webkit-scrollbar-thumb{
    background:#14c7d4;
    border-radius:20px;
}

.berita-card{
    min-width:850px;

    flex:0 0 auto;

    display:flex;
    flex-direction:row;

    align-items:center;
    justify-content:space-between;

    border-radius:25px;
    padding:35px;

    text-decoration:none;

    background:linear-gradient(135deg,#1ecad3,#14b8c4);

    color:white;
}

.berita-card .info-text{
    width:65%;
}

.berita-card .info-text h5{
    font-size:28px;
    font-weight:700;
    margin-bottom:18px;
    color:white;
}

.berita-card .info-text p{
    font-size:16px;
    line-height:1.8;
    color:white;
}

.berita-card .info-text small{
    font-size:15px;
    color:#eafcff;
}

.berita-card .info-image{
    width:30%;
    display:flex;
    justify-content:flex-end;
}

.berita-card .info-image img{
    width:220px;
    height:160px;

    object-fit:cover;

    border-radius:20px;
}

.carousel-wrapper{
    position:relative;
}

.nav-btn{
    position:absolute;
    top:50%;
    transform:translateY(-50%);

    width:45px;
    height:45px;

    border:none;
    border-radius:50%;

    background:white;
    color:#14b8c4;

    font-size:28px;
    font-weight:bold;

    box-shadow:0 5px 15px rgba(0,0,0,0.15);

    cursor:pointer;
    z-index:10;
}

.nav-btn.left{
    left:-20px;
}

.nav-btn.right{
    right:-20px;
}

.dots{
    margin-top:15px;
    text-align:center;
}

.dots span{
    display:inline-block;

    width:10px;
    height:10px;

    margin:0 5px;

    border-radius:50%;

    background:#cfd8dc;

    cursor:pointer;
}

.dots span.active{
    background:#14b8c4;
}

.funfact-card{
    display:flex !important;
    justify-content:space-between !important;
    align-items:center !important;

    background:linear-gradient(135deg,#1ecad3,#14b8c4) !important;

    border-radius:28px !important;

    padding:35px !important;

    margin-bottom:25px !important;

    color:white !important;
}

.funfact-card .info-text{
    width:70% !important;
}

.funfact-card .info-text h5{
    font-size:26px !important;
    font-weight:700 !important;
    margin-bottom:18px !important;
    color:white !important;
}

.funfact-card .info-text p{
    font-size:17px !important;
    line-height:1.8 !important;
    color:white !important;
}

.funfact-card .info-image{
    width:25% !important;
    display:flex !important;
    justify-content:flex-end !important;
}

.funfact-card .info-image img{
    width:230px !important;
    height:160px !important;

    object-fit:cover !important;

    border-radius:22px !important;
}

.funfact-wrapper{
    overflow:hidden;
    position:relative;
}

.funfact-dots{
    margin-top:15px;
    text-align:center;
}

.funfact-dots span{
    display:inline-block;

    width:10px;
    height:10px;

    margin:0 5px;

    border-radius:50%;

    background:#cfd8dc;
}

.funfact-dots span.active{
    background:#14b8c4;
}

.funfact-slider{
    display:flex;
    gap:25px;

    overflow-x:auto;

    padding-bottom:15px;
}

.funfact-slider::-webkit-scrollbar{
    height:8px;
}

.funfact-slider::-webkit-scrollbar-thumb{
    background:#14c7d4;
    border-radius:20px;
}

.funfact-card{
    min-width:850px;

    flex:0 0 auto;

    display:flex;
    justify-content:space-between;
    align-items:center;

    background:linear-gradient(135deg,#1ecad3,#14b8c4);

    border-radius:28px;

    padding:35px;

    color:white;
}

.funfact-card .info-text{
    width:70%;
}

.funfact-card .info-text h5{
    font-size:26px;
    font-weight:700;
    margin-bottom:18px;
    color:white;
}

.funfact-card .info-text p{
    font-size:17px;
    line-height:1.8;
    color:white;
}

.funfact-card .info-image{
    width:25%;
    display:flex;
    justify-content:flex-end;
}

.funfact-card .info-image img{
    width:230px;
    height:160px;

    object-fit:cover;

    border-radius:22px;
}

</style>

<script>
document.addEventListener("DOMContentLoaded", function(){

    let index = 0;

    const slider = document.getElementById('slider');

    if(!slider) return;

    const total = slider.children.length;

    const dotsContainer = document.getElementById('dots');

    // BUAT DOTS
    for(let i = 0; i < total; i++){

        let dot = document.createElement('span');

        dot.onclick = () => goTo(i);

        dotsContainer.appendChild(dot);
    }

    updateDots();

    // BUTTON
    window.slide = function(dir){

        index += dir;

        if(index >= total) index = 0;
        if(index < 0) index = total - 1;

        updateSlide();
    }

    // DOT CLICK
    function goTo(i){

        index = i;

        updateSlide();
    }

    // UPDATE SLIDE
    function updateSlide(){

        slider.scrollTo({
            left: index * 875,
            behavior: 'smooth'
        });

        updateDots();
    }

    // UPDATE DOT
    function updateDots(){

        const dots = document.querySelectorAll('#dots span');

        dots.forEach((d, i) => {
            d.classList.toggle('active', i === index);
        });
    }

    window.slideFunfact = function(dir){

    indexFunfact += dir;

    if(indexFunfact >= totalFunfact){
        indexFunfact = 0;
    }

    if(indexFunfact < 0){
        indexFunfact = totalFunfact - 1;
    }

    funfactSlider.scrollTo({
        left: indexFunfact * 875,
        behavior:'smooth'
    });

    dots.forEach((d,i)=>{
        d.classList.toggle('active', i === indexFunfact);
    });

}

    // AUTO SLIDE
    setInterval(() => {

        slide(1);

    }, 4000);

});
</script>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const funfactSlider = document.getElementById('funfactSlider');

    if(!funfactSlider) return;

    let indexFunfact = 0;

    const totalFunfact = funfactSlider.children.length;

    const dotsContainer = document.getElementById('funfactDots');

    for(let i = 0; i < totalFunfact; i++){

        let dot = document.createElement('span');

        if(i == 0){
            dot.classList.add('active');
        }

        dotsContainer.appendChild(dot);
    }

    const dots = dotsContainer.querySelectorAll('span');

    setInterval(() => {

        indexFunfact++;

        if(indexFunfact >= totalFunfact){
            indexFunfact = 0;
        }

        funfactSlider.scrollTo({
            left: indexFunfact * 875,
            behavior: 'smooth'
        });

        dots.forEach((d,i)=>{
            d.classList.toggle('active', i === indexFunfact);
        });

    }, 3500);

});

.leaflet-popup-content-wrapper{
    pointer-events:auto !important;
}

.leaflet-popup-content{
    pointer-events:auto !important;
}

.leaflet-popup-tip-container{
    pointer-events:auto !important;
}

#map{
    overflow:hidden;
}

</script>

<!-- MODAL DETAIL -->
<div id="modalTbc" class="modal-tbc">

    <div class="modal-content-tbc">

        <span class="close-modal" onclick="closeModal()">
            &times;
        </span>

        <h2>Peta Sebaran Kasus 2025</h2>

        <div class="modal-body">

            <div class="detail-list">

                <div class="detail-title">
                    Informasi :
                </div>

                <div class="detail-row">
                    <span>Nama Daerah</span>
                    <p id="mdNama">: -</p>
                </div>

                <div class="detail-row">
                    <span>Jumlah Penduduk</span>
                    <p id="mdPenduduk">: 0</p>
                </div>

                <div class="detail-row">
                    <span>Jumlah Kasus</span>
                    <p id="mdKasus">: 0</p>
                </div>

                <div class="detail-row">
                    <span>Kategori Kasus</span>
                    <p id="mdKategori">: -</p>
                </div>

                <div class="detail-row">
                    <span>Rentang usia</span>
                    <p>: </p>
                </div>

                <div class="detail-sub">

                    <div class="detail-row">
                        <span>Anak-anak</span>
                        <p id="mdAnak">: 0</p>
                    </div>

                    <div class="detail-row">
                        <span>Dewasa</span>
                        <p id="mdDewasa">: 0</p>
                    </div>

                    <div class="detail-row">
                        <span>Lansia</span>
                        <p id="mdLansia">: 0</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

.modal-tbc{
    display:none;

    position:fixed;
    z-index:9999;

    left:0;
    top:0;

    width:100%;
    height:100%;

    background:rgba(0,0,0,0.45);

    justify-content:center;
    align-items:center;

    padding:20px;
    box-sizing:border-box;
}

.modal-content-tbc{
    width:760px;
    background:#fff;
    border-radius:28px;
    padding:38px;
    position:relative;
    font-family:'Poppins',sans-serif;
    box-shadow:0 10px 35px rgba(0,0,0,0.12);

    max-height:90vh;
    overflow-y:auto;

}

.modal-content-tbc h2{
    font-size:24px;
    font-weight:700;
    color:#1f2937;
    margin-bottom:28px;
}

.close-modal{
    position:absolute;
    top:18px;
    right:24px;
    font-size:34px;
    font-weight:bold;
    cursor:pointer;
    color:#444;
}

.detail-list{
    border:1px solid #e5e7eb;
    border-radius:24px;
    padding:32px;
    background:#fafafa;
}

.detail-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:30px;
    color:#222;
}

.detail-row{
    display:flex;
    align-items:flex-start;
    margin-bottom:22px;
}

/* KIRI */
.detail-row span{
    width:380px;
    font-size:17px;
    color:#444;
    font-weight:500;
    line-height:1.7;
}

/* KANAN */
.detail-row p{
    margin:0;
    font-size:17px;
    color:#222;
    font-weight:600;
    line-height:1.7;
}

.detail-sub{
    margin-left:40px;
    margin-top:-8px;
    margin-bottom:22px;
}

.detail-sub .detail-row{
    margin-bottom:14px;
}

.detail-sub .detail-row span{
    width:340px;
    font-size:15px;
    color:#666;
    font-weight:400;
}

.detail-sub .detail-row p{
    font-size:15px;
    font-weight:500;
}

.leaflet-popup-content button{
    position:relative;
    z-index:99999;
    pointer-events:auto;
}

.leaflet-popup-content{
    pointer-events:auto !important;
}

.leaflet-popup{
    pointer-events:auto !important;
}

.leaflet-container{
    z-index:1;
}

.modal-tbc{
    z-index:999999 !important;
}

</style>

<script>

function openModal(
    nama,
    kasus,
    kategori,
    anak = 0,
    dewasa = 0,
    lansia = 0,
    laki = 0,
    perempuan = 0
){

    document.getElementById('modalTbc').style.display = 'flex';

    document.getElementById('mdNama').innerHTML =
        ': ' + nama;

    document.getElementById('mdKasus').innerHTML =
        ': ' + kasus;

    document.getElementById('mdKategori').innerHTML =
        ': ' + kategori;

    document.getElementById('mdAnak').innerHTML =
        ': ' + anak;

    document.getElementById('mdDewasa').innerHTML =
        ': ' + dewasa;

    document.getElementById('mdLansia').innerHTML =
        ': ' + lansia;

    document.getElementById('mdLaki').innerHTML =
        ': ' + laki;

    document.getElementById('mdPerempuan').innerHTML =
        ': ' + perempuan;
}

window.openModal = openModal;

function closeModal(){

    document.getElementById('modalTbc').style.display = 'none';
}

window.onclick = function(e){

    const modal = document.getElementById('modalTbc');

    if(e.target == modal){
        closeModal();
    }
}

</script>

<?= $this->endSection() ?>