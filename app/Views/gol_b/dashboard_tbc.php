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
        <div class="berita-slider">
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

                <?php if ($b['deskripsi_berita'] != 'Kutip berita luar') : ?>

    <p>
        <?= word_limiter(strip_tags($b['deskripsi_berita']), 20) ?>
    </p>

<?php endif; ?>

                    <small>
                        <?= date('d M Y', strtotime($b['tanggal_berita'])) ?>
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
    <?php endif ?>

</div>

<!-- SECTION FUNFACT -->
<div class="content-section">

    <h4 class="section-title">Funfact</h4>

    <p class="section-sub">
        Fakta menarik dan edukasi singkat seputar penyakit TBC.
    </p>

    <?php if (!empty($funfact)) : ?>

        <div class="info-card small">

            <div class="info-text">

                <h5>
                    <?= esc($funfact['judul_funfact']) ?>
                </h5>

                <p>
                    <?= esc($funfact['deskripsi_funfact']) ?>
                </p>

            </div>

            <div class="info-image">
                <img src="<?= base_url('uploads/funfact/' . $funfact['gambar_funfact']) ?>">
            </div>

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
    display:flex !important;
    flex-wrap:nowrap !important;
    overflow-x:auto !important;
    gap:25px;
    padding-bottom:15px;
}

.berita-slider .berita-card{
    min-width:850px !important;
    max-width:850px !important;

    flex:0 0 auto !important;

    display:flex !important;
    flex-direction:row !important;

    align-items:center;
    justify-content:space-between;

    border-radius:25px;
    padding:35px;

    text-decoration:none;
}

.berita-slider .berita-card .info-text{
    width:65%;
}

.berita-slider .berita-card .info-image{
    width:30%;
    display:flex;
    justify-content:flex-end;
}

.berita-slider .berita-card .info-image img{
    width:220px !important;
    height:160px !important;
    object-fit:cover;
    border-radius:20px;
}

</style>

<?= $this->endSection() ?>
<style>

.berita-slider{
    display: flex;
    gap: 25px;
    overflow-x: auto;
    padding-bottom: 10px;
    scroll-behavior: smooth;
}

.berita-slider::-webkit-scrollbar{
    height: 8px;
}

.berita-slider::-webkit-scrollbar-thumb{
    background: #14c7d4;
    border-radius: 20px;
}

.berita-card{
    min-width: 850px;
    flex-shrink: 0;
}

</style>
.berita-slider{
    display:flex !important;
    flex-wrap:nowrap !important;
    overflow-x:auto;
}

.berita-card{
    min-width:850px;
    max-width:850px;
    flex:0 0 auto;

    display:flex !important;
    flex-direction:row !important;
    align-items:center;
    justify-content:space-between;
}
.berita-card .info-text{
    width:65%;
}

.berita-card .info-image{
    width:30%;
    display:flex;
    justify-content:flex-end;
}

.berita-card .info-image img{
    width:220px;
    height:150px;
    object-fit:cover;
    border-radius:20px;
}
