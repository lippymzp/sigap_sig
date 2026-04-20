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
            <div id="map"></div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {

                    const map = L.map('map').setView([-7.9, 112.6], 8);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                    let marker = L.marker([-7.9, 112.6]).addTo(map);

                    map.on('click', function(e) {
                        document.getElementById('lat').innerText = e.latlng.lat.toFixed(6);
                        document.getElementById('lng').innerText = e.latlng.lng.toFixed(6);
                        marker.setLatLng(e.latlng);
                    });

                });

                /* SLIDER */
                function scrollCardLeft() {
                    document.getElementById('cardSlider').scrollBy({
                        left: -400,
                        behavior: 'smooth'
                    });
                }

                function scrollCardRight() {
                    document.getElementById('cardSlider').scrollBy({
                        left: 400,
                        behavior: 'smooth'
                    });
                }
            </script>
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