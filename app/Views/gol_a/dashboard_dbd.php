<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<!-- WELCOME -->
<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai ADMIN</h3>
        <p>Puskesmas Sumbersari, Jember</p>
    </div>

   <div class="welcome-icon">
    <i class="fa-solid fa-map-location-dot"></i>
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
                <select>
                    <option>2025</option>
                </select>
            </div>
        </div>

        <div class="inner-card">
    <div id="map"></div>

    <script>

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        }
    });

});
</script>

</section>

<!-- ARTIKEL -->
<section id="artikel" class="artikel-section my-5">
    <div class="artikel-header">
        <h2 class="section-title">Berita, Artikel & Majalah Kesehatan</h2>
    </div>

    <div id="artikel-scroll" class="artikel-scroll">
        <?php if (!empty($artikels)): ?>
            <?php foreach ($artikels as $artikel): ?>
                <div class="card-artikel">

                    <img src="<?= base_url('img/artikel/' . $artikel['gambar']) ?>" class="artikel-img" alt="<?= esc($artikel['judul']) ?>" />

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

                        <h5><?= esc($artikel['judul']) ?></h5>

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
            <div class="text-muted">Belum ada artikel yang ditambahkan.</div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>