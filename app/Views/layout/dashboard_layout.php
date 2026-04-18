<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIGAP'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $this->renderSection('style'); ?>
</head>

<body>
    <?php $penyakit = session('penyakit') ?? 'tbc'; ?>
    <div class="sidebar">
        <div class="logo text-center">
            <img src="/assets/img/logo_nama.svg" alt="Logo SIGAP" style="max-width: 160px; height: auto;">
        </div>

        <div class="menu-label">HOME</div>

        <a href="<?= base_url('index.php/' . $penyakit . '/dashboard') ?>"
            class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <a href="<?= base_url('index.php/' . $penyakit . '/input_data') ?>"
            class="<?= ($menu == 'inputdata') ? 'active' : '' ?>">
            <i class="fa-regular fa-clipboard me-2"></i> Input Data Pasien
        </a>

        <a href="<?= base_url('index.php/' . $penyakit . '/hasil') ?>"
            class="<?= ($menu == 'hasil') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder me-2"></i> Hasil Data Pasien
        </a>

        <a href="<?= base_url('index.php/' . $penyakit . '/skrining_1') ?>"
            class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
            <i class="fa-regular fa-file-lines me-2"></i> Skrining
        </a>

        <a href="<?= base_url('index.php/' . $penyakit . '/peta') ?>"
            class="<?= ($menu == 'peta') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
        </a>

        <a href="<?= base_url('index.php/' . $penyakit . '/export') ?>"
            class="<?= ($menu == 'export') ? 'active' : '' ?>">
            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Export Data
        </a>

        <!-- <div class="menu-label">Manajemen Data</div>
        <a href="/pasien" class="<?= ($menu == 'pasien') ? 'active' : '' ?>"><i class="fa-solid fa-clipboard-user me-2"></i> Data Pasien</a> -->

        <div class="menu-label">Informasi</div>

        <a href="<?= base_url('index.php/' . $penyakit . '/berita') ?>"
            class="<?= ($menu == 'berita') ? 'active' : '' ?>">
            <i class="fa-regular fa-newspaper me-2"></i> Edit Berita
        </a>

        <a href="<?= base_url('index.php/' . $penyakit . '/funfact') ?>"
            class="<?= ($menu == 'funfact') ? 'active' : '' ?>">
            <i class="fa-regular fa-user me-2"></i> Edit Funfact
        </a>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="fs-5 fw-bold text-dark">Dashboard</div>
            <div class="d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold text-dark" style="font-size: 0.95rem; line-height: 1.2;">Profil</div>
                    <small class="admin-text">Admin</small>
                </div>
                <div class="dropdown avatar-dropdown">
    <div class="avatar-circle" data-bs-toggle="dropdown" style="cursor:pointer;">
        <i class="fa-regular fa-user text-white"></i>
    </div>

    <ul class="dropdown-menu dropdown-menu-end shadow">
        <li>
            <a class="dropdown-item" href="<?= base_url('profil_admin') ?>">
                <i class="fa-regular fa-user me-2"></i> Profile
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="<?= base_url('/logout') ?>">
                <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
            </a>
        </li>
    </ul>
</div>
            </div>
        </div>

        <div class="content-body">
            <?= $this->renderSection('content'); ?>
        </div>

        <footer class="footer mt-5" style="width:100%;">

            <div class="container text-white py-5">

                <div class="row">

                    <div class="col-md-4 mb-4">
                        <h5 class="fw-bold">LOGO</h5>
                        <p>
                            SIGAP<br>
                            Sistem Informasi Geografis Analisis & Pemantauan Penyakit
                        </p>
                    </div>

                    <div class="col-md-4 mb-4">
                        <h6 class="fw-bold mb-3">Media Sosial</h6>
                        <p>📷 Instagram</p>
                        <p>📘 Facebook</p>
                        <p>🐦 Twitter</p>
                    </div>

                    <div class="col-md-4 mb-4">
                        <h6 class="fw-bold mb-3">Informasi Kontak</h6>
                        <p>📧 Email: email@kampus.ac.id</p>
                        <p>📍 Jember, Jawa Timur</p>
                    </div>

                </div>

                <hr style="border-color: rgba(255,255,255,0.3)">

                <p class="text-center mb-0">
                    Hak Cipta © 2026 SIGAP
                </p>

            </div>

        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url('js/script.js') ?>"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <?= $this->renderSection('script'); ?>
</body>

</html>