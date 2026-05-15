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
                        color: "#2a9d8f",
                        weight: 2,
                        fillColor: warna,
                        fillOpacity: 0.7
                    };
                },

                onEachFeature: function(feature, layer){

                    var namaAsli = feature.properties.NAMOBJ;
                    var item = dataFinal[fixNama(namaAsli)];

var isi = `
<div style="
    width:300px;
    background:white;
    border-radius:18px;
    overflow:hidden;
    font-family:Poppins,sans-serif;
    box-shadow:0 8px 25px rgba(0,0,0,0.15);
">

    <div style="
        padding:14px 18px;
        border-bottom:1px solid #ddd;
        background:#f8f8f8;
    ">
        <div style="
            font-size:22px;
            font-weight:700;
            color:#111;
        ">
            Informasi :
        </div>
    </div>

    <div style="
        padding:18px;
        font-size:15px;
        line-height:1.9;
        color:#333;
    ">
`;

if(item){

    var tingkat = "";
    var warna = "";

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

    isi += `

    <table style="width:100%;">

        <tr>
            <td width="45%">Nama Daerah</td>
            <td width="5%">:</td>
            <td>${namaAsli}</td>
        </tr>

        <tr>
            <td>Jumlah Kasus</td>
            <td>:</td>
            <td><b>${item.total}</b></td>
        </tr>

        <tr>
            <td>Tingkat Kasus</td>
            <td>:</td>
            <td>
                <span style="
                    color:${warna};
                    font-weight:700;
                ">
                    ${tingkat}
                </span>
            </td>
        </tr>

        <tr>
            <td style="padding-top:10px;">
                Rekomendasi
            </td>

            <td style="padding-top:10px;">:</td>

            <td style="
                padding-top:10px;
                font-size:14px;
                color:#666;
            ">
                ${tingkat == 'Tinggi'
                    ? 'Perlu penanganan segera.'
                    : tingkat == 'Sedang'
                    ? 'Lakukan monitoring berkala.'
                    : 'Wilayah masih terkendali.'
                }
            </td>
        </tr>

    </table>
    `;
}
else{

    isi += `
        <div style="
            text-align:center;
            color:red;
            font-weight:600;
        ">
            Data tidak ditemukan
        </div>
    `;
}

isi += `
    </div>
</div>
`;

                    layer.bindPopup(isi);

layer.on('mouseover', function () {
    this.openPopup();
});

layer.on('mouseout', function () {
    this.closePopup();
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

</script>

<script>
var map = L.map('map').setView([-8.1727, 113.7000], 12);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

<?php foreach($tbc as $row): ?>

<?php if($row['latitude'] && $row['longitude']): ?>

L.marker([<?= $row['latitude'] ?>, <?= $row['longitude'] ?>])
    .addTo(map)
.bindPopup(`
    <div style="
        width:260px;
        border-radius:22px;
        overflow:hidden;
        font-family:Poppins;
    ">

        <div style="
            background:#f5f5f5;
            padding:14px 18px;
            font-size:20px;
            font-weight:700;
            border-bottom:2px solid #999;
        ">
            Informasi :
        </div>

        <div style="
            background:white;
            padding:18px;
            font-size:18px;
            line-height:1.8;
        ">

            <b>Jumlah Kasus :</b>
            <?= $row['kasus'] ?><br>

            <b>Tingkat Kasus :</b>

            <?php
                if($row['kasus'] >= 100){
                    echo "<span style='color:red;font-weight:700;'>Tinggi</span>";
                } elseif($row['kasus'] >= 50){
                    echo "<span style='color:orange;font-weight:700;'>Sedang</span>";
                } else {
                    echo "<span style='color:green;font-weight:700;'>Rendah</span>";
                }
            ?>

        </div>

    </div>
`);

<?php endif; ?>

<?php endforeach; ?>
</script>

<?= $this->endSection() ?>