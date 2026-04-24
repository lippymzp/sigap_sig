<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

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
    <p class="section-sub">Informasi dan Edukasi tentang Pencegahan serta Penanganan</p>

    <div class="info-card">

        <div class="info-text">
            <h5>Pneumonia Pada Anak: <br> Pahami Penyebab dan Cara Mengatasinya</h5>
            <p>
                Pneumonia pada anak adalah infeksi paru serius yang dapat menyebabkan gangguan pernapasan.
                Ketahui gejala, penyebab dan cara mengatasinya.
            </p>
            <small>Medis • 10 Jan 2025</small>
        </div>

        <div class="info-image">
            <img src="<?= base_url('img/pneumonia.png') ?>">
        </div>

    </div>

</div>


<!-- SECTION FUNFACT -->
<div class="content-section">

    <h4 class="section-title">Funfact</h4>
    <p class="section-sub">Informasi dan Edukasi berdasarkan sumber terpercaya</p>

    <div class="info-card small">

        <div class="info-text">
            <h5>Pneumonia</h5>
            <p>
                Pneumonia adalah infeksi pada paru-paru yang menyebabkan kantung udara terisi cairan,
                sehingga mengganggu proses pernapasan.
            </p>
        </div>

        <div class="info-image">
            <img src="<?= base_url('img/pneumonia2.png') ?>">
        </div>

    </div>

</div>



<?= $this->endSection() ?>