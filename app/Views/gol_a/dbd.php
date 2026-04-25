<?php $this->setVar('penyakit', 'dbd'); ?>
<?= $this->include('layout/header') ?>


<!-- HERO -->
<section class="dbd-hero text-white">
    <div class="container">
        <div class="row align-items-center">

            <!-- TEXT -->
            <div class="col-md-6">
                <h1>Demam Berdarah</h1>
                <p>Demam berdarah adalah penyakit yang disebabkan oleh virus dengue dan ditularkan melalui gigitan nyamuk.</p>

                <a href="<?= base_url('dbd-detail') ?>" class="btn btn-hero">
                    Pelajari selengkapnya
                </a>
            </div>

        </div>
    </div>
</section>

<!-- FITUR -->
<section class="container text-center mt-5" data-aos="fade-up">

<h4 class="text-teal mb-4 fw-bold">Fitur Menarik yang Bisa Dimanfaatkan</h4>

<div class="row g-4 justify-content-center">

    <div class="col-lg-3 col-md-6">
        <a href="#grafik" class="text-decoration-none">
            <div class="fitur-box shadow-sm p-3 rounded">
                📊 Grafik Kesehatan
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="#map" class="text-decoration-none">
            <div class="fitur-box shadow-sm p-3 rounded">
                🗺️ Peta Persebaran
            </div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="<?= base_url('artikel') ?>" class="text-decoration-none">
            <div class="fitur-box shadow-sm p-3 rounded">
                📄 Berita Kesehatan
</div>
        </a>
    </div>

    <div class="col-lg-3 col-md-6">
        <a href="<?= base_url('skriningdbd') ?>" class="text-decoration-none">
            <div class="fitur-box shadow-sm p-3 rounded">
                🩺 Skrining Kesehatan
            </div>
        </a>
    </div>

</div>
</div>

</div>
</section>

<!-- INSIGHT -->
<section class="container mt-5">

<h6 class="text-center text-muted">Insights</h6>
<h4 class="text-center mb-4 fw-bold">Telusuri Informasi Berikut</h4>

<div class="slider-wrapper">

    <button class="slider-btn left" onclick="slideScroll(-1)">‹</button>

    <div id="sliderTrack" class="slider-track">

        <div class="slider-item">
            <img src="<?= base_url('img/Mengenal-DBD.png') ?>">
            <div>
                <h5>DBD: Kenali Gejala</h5>
                <p>Demam tinggi dan tanda bahaya.</p>
            </div>
        </div>

        <div class="slider-item">
            <img src="<?= base_url('img/pencegahan-dbd.png') ?>">
            <div>
                <h5>Pencegahan DBD</h5>
                <p>3M Plus cegah nyamuk.</p>
            </div>
        </div>

        <div class="slider-item">
            <img src="<?= base_url('img/Penyebab&Penularan-dbd.png') ?>">
            <div>
                <h5>Penanganan DBD</h5>
                <p>Segera ke fasilitas kesehatan.</p>
            </div>
        </div>

    </div>

    <button class="slider-btn right" onclick="slideScroll(1)">›</button>

</div>

</section>

<!-- CTA -->
<section class="container mt-5" data-aos="zoom-in">

<div class="p-4 text-center shadow-sm cta-box">

<h5 class="fw-bold">Mengalami Gejala?</h5>
<p>
Tubuhmu memberi sinyal, jangan diabaikan.<br>
Yuk lakukan <span style="color:red;">skrining</span> sejak dini!
</p>

<a href="<?= base_url('skriningdbd') ?>" class="btn btn-success px-4 py-2 rounded-pill shadow">
    Mulai Skrining →
</a>

</div>

</section>
<!-- STYLE (LANGSUNG DI FILE INI) -->
<style>
/* HERO BACKGROUND */
.dbd-hero {
    position: relative;
    background: url('<?= base_url("img/dbd.png") ?>') center/cover no-repeat;
    padding: 120px 0;
    border-radius: 0 0 40px 40px;
}

/* TEXT */
.hero-title {
    font-size: 52px;
    font-weight: 800;
    margin-bottom: 15px;
}

.hero-desc {
    font-size: 18px;
    max-width: 420px;
    line-height: 1.6;
}

/* BUTTON */
.btn-hero {
    background: #1b9aaa;
    color: white;
    padding: 14px 30px;
    border-radius: 30px;
    margin-top: 20px;
    display: inline-block;
    text-decoration: none;
    transition: 0.3s;
}

.btn-hero:hover {
    background: #168aad;
    color: white;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .dbd-hero {
        padding: 80px 20px;
        text-align: center;
    }

    .hero-title {
        font-size: 32px;
    }

    .hero-desc {
        margin: auto;
    }
}
</style> 
<!-- GRAFIK -->
<section id="grafik" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3 fw-bold">Grafik DBD</h4>

<div class="row mb-3">
<div class="col-md-3"><select class="form-control shadow-sm"><option>Kelurahan</option></select></div>
<div class="col-md-3"><select class="form-control shadow-sm"><option>Kategori</option></select></div>
<div class="col-md-3"><select class="form-control shadow-sm"><option>Tahun</option></select></div>
</div>

<div class="row">

<div class="col-md-9">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<canvas id="chartDBD"></canvas>
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

<!-- 🔥 FIX: ID TETAP peta -->
<div id="map" style="height:400px; border-radius:15px;"></div>

<div class="mt-3 d-flex gap-2">
<span class="badge bg-warning">Rendah</span>
<span class="badge bg-danger">Sedang</span>
<span class="badge bg-dark">Tinggi</span>
</div>

</section>

<!-- ================= TAMBAHAN DATABASE ================= -->
<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function(){

    new Chart(document.getElementById('chartDBD'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei'],
        datasets: [
            { label:'Sembuh', data:[100,80,70,60,150], backgroundColor:'#8ecae6' },
            { label:'Pengobatan', data:[90,150,120,90,95], backgroundColor:'#219ebc' },
            { label:'Meninggal', data:[40,20,40,40,60], backgroundColor:'#90dbf4' }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false
        },
        plugins: {
            tooltip: {
                enabled: true
            },
            legend: {
                position: 'top'
            }
        },
        animation: {
            duration: 1000
        }
    }
    
});

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

function slideScroll(dir){
    const track = document.getElementById('sliderTrack');

    const card = track.querySelector('.slider-item');
    const width = card.offsetWidth + 20;

    track.scrollBy({
        left: dir * width,
        behavior: 'smooth'
    });
}
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