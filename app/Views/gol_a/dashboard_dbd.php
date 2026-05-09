<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<?php
$grafik = $grafik ?? [];
$dbd = $dbd ?? [];
$tahunSekarang = date('Y');
?>
<style>.custom-modal {
    display: none;
    position: fixed;
    z-index: 99999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    justify-content: center;
    align-items: center;
}

.custom-modal-content {
    background: #fff;
    width: 85%;
    max-width: 900px;
    border-radius: 20px;
    padding: 30px;
    position: relative;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
}

.close-modal {
    position: absolute;
    right: 25px;
    top: 15px;
    font-size: 30px;
    cursor: pointer;
    font-weight: bold;
}

.info-box {
    margin-top: 20px;
    background: #f8f8f8;
    border-radius: 18px;
    padding: 25px;
    border: 1px solid #ddd;
}

.info-box table tr td {
    padding: 8px 0;
    vertical-align: top;
}</style>

<!-- WELCOME -->
<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai ADMIN</h3>
        <p>Puskesmas Sumbersari, Jember</p>
    </div>

 <div class="welcome-icon">
    <img src="<?= base_url('img/World_Map.png') ?>" 
         alt="map"
         style="width:280px; height:auto;">
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
<div class="section-card">

    <!-- MAP -->
    <div class="section-block">

        <div class="section-header">
            <div>
                <h5>Peta Interaktif Penyebaran</h5>
                <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
            </div>
        <div class="filter">
    <span>Periode:</span>
    <select id="periodeMap" onchange="updateMap()">
        <?php for($t = 2024; $t <= $tahunSekarang; $t++): ?>
            <option value="<?= $t ?>" <?= ($t == $tahunSekarang ? 'selected' : '') ?>>
                <?= $t ?>
            </option>
        <?php endfor; ?>
    </select>
</div>
        </div>

        <div class="inner-card">
    <div id="map"></div>
<div id="detailModal" class="custom-modal">
    <div class="custom-modal-content">

        <span class="close-modal" onclick="closeDetailModal()">
            &times;
        </span>

        <h3>Peta Sebaran Kasus 2025</h3>

        <div class="info-box">

            <h4><b>Informasi :</b></h4>

            <table style="width:100%;">
                <tr>
                    <td>Nama Daerah</td>
                    <td>: <span id="modalNama"></span></td>
                </tr>

                <tr>
                    <td>Jumlah Penduduk</td>
                    <td>: 2900</td>
                </tr>

                <tr>
                    <td>Jumlah Kasus</td>
                    <td>: <span id="modalKasus"></span></td>
                </tr>

                <tr>
                    <td>Kategori Kasus</td>
                    <td>: <span id="modalKategori"></span></td>
                </tr>

                <tr>
                    <td>Rumah Diperiksa</td>
                    <td>: 1200</td>
                </tr>

                <tr>
                    <td>Rumah Positive Jentik</td>
                    <td>: 5</td>
                </tr>
            </table>

        </div>
    </div>
</div>
    <script>

    /* 🔥 FIX NAMA */
   function fixNama(nama){
    return (nama || "")
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9]/g, "");
}

    /* 🔥 OPTIONAL: kalau ada nama beda */
   var aliasDesa = {
    "kemuningsarilor": "kemuning sari lor",
    "tegalgede": "tegal gede"
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

    document.addEventListener("DOMContentLoaded", function() {

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

                    var isi = "<div style='min-width:220px;'>";

isi += "<b>Kelurahan: " + namaAsli + "</b>";

if(item){
    isi += "<br>Total Kasus: " + item.total;
    isi += "<br>Kategori: " + item.kategori;

    isi += `
        <br><br>
        <button 
            onclick="showDetailPopup(
                '${namaAsli}',
                '${item.total}',
                '${item.kategori}'
            )"
            style="
                background:#00CED1;
                color:white;
                border:none;
                padding:8px 14px;
                border-radius:8px;
                cursor:pointer;
                font-weight:600;
            ">
            Selengkapnya
        </button>
    `;
} else {
    isi += "<br><span style='color:red'>Data tidak ditemukan</span>";
}

isi += "</div>";

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
function showDetailPopup(nama, total, kategori)
{
    document.getElementById("modalNama").innerText = nama;
    document.getElementById("modalKasus").innerText = total;
    document.getElementById("modalKategori").innerText = kategori;

    document.getElementById("detailModal").style.display = "flex";
}

function closeDetailModal()
{
    document.getElementById("detailModal").style.display = "none";
}
    </script>
</div>

<!-- 🔥 STYLE LABEL -->
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
        </div>

    </div>

<!-- GRAFIK -->
<section id="grafik" class="container mt-5" data-aos="fade-up">

<h4 class="text-teal mb-3 fw-bold">Grafik DBD</h4>

<form method="get">

<div class="row mb-3">
<!-- USIA -->
<div class="col-md-3">
    <select name="usia" class="form-control shadow-sm" onchange="this.form.submit()">
        <option value="">Semua Usia</option>
        <option value="anak" <?= request()->getGet('usia')=='anak' ? 'selected' : '' ?>>0-14</option>
        <option value="remaja" <?= request()->getGet('usia')=='remaja' ? 'selected' : '' ?>>15-24</option>
        <option value="dewasa" <?= request()->getGet('usia')=='dewasa' ? 'selected' : '' ?>>25-59</option>
        <option value="lansia" <?= request()->getGet('usia')=='lansia' ? 'selected' : '' ?>>60+</option>
    </select>
</div>

<!-- GENDER -->
<div class="col-md-3">
    <select name="jk" class="form-control shadow-sm" onchange="this.form.submit()">
        <option value="">Semua Gender</option>
        <option value="L" <?= request()->getGet('jk')=='L' ? 'selected' : '' ?>>Laki-laki</option>
        <option value="P" <?= request()->getGet('jk')=='P' ? 'selected' : '' ?>>Perempuan</option>
    </select>
</div>

<!-- BULAN -->
<div class="col-md-3">
    <select name="bulan" class="form-control shadow-sm" onchange="this.form.submit()">
        <option value="">Semua Bulan</option>

        <?php
        $bulanList = [
            1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',
            5=>'Mei',6=>'Jun',7=>'Jul',8=>'Ags',
            9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
        ];

        foreach($bulanList as $key => $val):
        ?>
            <option value="<?= $key ?>" <?= request()->getGet('bulan') == $key ? 'selected' : '' ?>>
                <?= $val ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- TAHUN -->
<div class="col-md-3">
    <select name="tahun" class="form-control shadow-sm" onchange="this.form.submit()">
        <option value="">Semua Tahun</option>

        <?php for($t = 2020; $t <= date('Y'); $t++): ?>
            <option value="<?= $t ?>" <?= request()->getGet('tahun') == $t ? 'selected' : '' ?>>
                <?= $t ?>
            </option>
        <?php endfor; ?>
    </select>
</div>
</div>
</form>

<div class="row">

<div class="col-md-9">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<pre>
</pre><canvas id="chartDBD"></canvas>
</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const dataGrafik = <?= json_encode($grafik) ?>;

    let labels = [];
    let totalKasus = [];

    dataGrafik.forEach(function(item){
    labels.push(item.kelurahan);
    totalKasus.push(item.total);
});

    new Chart(document.getElementById('chartDBD'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Kasus',
                data: totalKasus,
                backgroundColor: '#00BBC2'
            }]
        }
    });

});
</script>

</section>

<!-- ARTIKEL -->
<section id="artikel" class="artikel-section my-5">
    <div class="artikel-header">
    </div>

    <div id="artikel-scroll" class="artikel-scroll">
        <?php if (!empty($artikels)): ?>
            <?php foreach ($artikels as $artikel): ?>
                <div class="card-artikel">

                    <img src="<?= base_url('img/artikel/' . (string)$artikel['gambar']) ?>" class="artikel-img" alt="<?= esc((string)$artikel['judul']) ?>" />

                    <div class="artikel-action">
                        <a href="<?= base_url('admin/artikel/edit/' . $artikel['id']) ?>">
                            <img src="<?= base_url('img/edit.png') ?>">
                        </a>

                        <form action="<?= base_url('admin/artikel/delete/' . $artikel['id']) ?>" method="post">
                            <button type="submit">
                                <img src="<?= base_url('img/hapus.png') ?>">
                            </button>
                        </form>
                    </div>

                    <div class="artikel-content">
                        <small><?= date('l, d M Y', strtotime($artikel['tanggal_terbit'])) ?></small>

                        <h5><?= esc((string)$artikel['judul']) ?></h5>

                        <?php
                        $preview = character_limiter(strip_tags($artikel['isi']), 150, '...');
                        ?>

                        <p><?= $preview ?></p>

                        <a href="<?= base_url('admin/artikel/' . $artikel['slug']) ?>" class="custom-link">
                            Baca Selengkapnya →
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>