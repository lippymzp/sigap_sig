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

        <!-- 🔥 MAP HASIL PINDAHAN -->
        <div class="inner-card">

            <div id="map" style="height:400px; border-radius:15px;"></div>

            <div class="map-legend mt-3">
                <span style="background:#f4a261">Rendah</span>
                <span style="background:#e76f51">Sedang</span>
                <span style="background:#d62828">Tinggi</span>
            </div>

            <script>
            document.addEventListener("DOMContentLoaded", function () {

                function fixNama(nama){
                    return (nama || "")
                        .toLowerCase()
                        .trim()
                        .replace(/\s+/g, " ")
                        .replace(/[^a-z0-9 ]/g, "");
                }

                var dataPneu = <?= json_encode($pneumonia ?? []) ?>;
                console.log("DATA PNEUMONIA:", dataPneu);

                var dataFinal = {};

                dataPneu.forEach(item => {

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

                console.log("DATA FINAL:", dataFinal);

                const mapElement = document.getElementById('map');

                if (mapElement) {
                    var map = L.map('map').setView([-7.9,112.6], 10);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
                    .addTo(map);

                    // marker lama tetap
                    L.marker([-7.9,112.6]).addTo(map).bindPopup("Kasus Tinggi");
                    L.marker([-7.8,112.7]).addTo(map).bindPopup("Kasus Sedang");

                    fetch("<?= base_url('assets/peta/pneumonia.geojson') ?>")
                    .then(res => res.json())
                    .then(data => {

                        var geo = L.geoJSON(data, {

                            style: function(feature){

                                var nama = fixNama(feature.properties.NAMOBJ);
                                var item = dataFinal[nama];

                                var warna = "#cccccc";

                                if(item){
                                    if(item.kategori == "tinggi") warna = "#d62828";
                                    else if(item.kategori == "sedang") warna = "#e76f51";
                                    else if(item.kategori == "rendah") warna = "#f4a261";
                                }

                                return {
                                    color: "#2a9d8f",
                                    weight: 2,
                                    fillColor: warna,
                                    fillOpacity: 0.7
                                };
                            },

                            onEachFeature: function(feature, layer){

                                var nama = feature.properties.NAMOBJ;
                                var item = dataFinal[fixNama(nama)];

                                var isi = "<b>Desa: " + nama + "</b>";

                                if(item){
                                    isi += "<br>Total Kasus: " + item.total;
                                    isi += "<br>Kategori: " + item.kategori;
                                } else {
                                    isi += "<br><span style='color:red'>Data tidak ditemukan</span>";
                                }

                                layer.bindPopup(isi);

                                layer.bindTooltip(nama, {
                                    permanent: true,
                                    direction: "center",
                                    className: "label-desa"
                                });
                            }

                        }).addTo(map);

                        map.fitBounds(geo.getBounds());
                    });

                    setTimeout(() => map.invalidateSize(), 300);
                }

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

        </div>

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

    <p class="update-text">Diperbarui pada: 11-4-2025</p>

</div>
</div>

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