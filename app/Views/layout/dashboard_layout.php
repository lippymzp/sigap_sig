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
    <div class="sidebar">
        <div class="logo text-center">
            <img src="/assets/img/logo_nama.svg" alt="Logo SIGAP" style="max-width: 160px; height: auto;">
        </div>

        <div class="menu-label">HOME</div>

        <a href="/dashboard" class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <a href="/input_data" class="<?= ($menu == 'inputdata') ? 'active' : '' ?>">
            <i class="fa-regular fa-clipboard me-2"></i> Input Data Pasien
        </a>

        <a href="/hasil" class="<?= ($menu == 'hasil') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder me-2"></i> Hasil Data Pasien
        </a>

        <a href="/skrining_1" class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
            <i class="fa-regular fa-file-lines me-2"></i> Skrining
        </a>

        <a href="/peta" class="<?= ($menu == 'peta') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
        </a>

        <a href="/export" class="<?= ($menu == 'export') ? 'active' : '' ?>">
            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Export Data
        </a>

        <!-- <div class="menu-label">Manajemen Data</div>
        <a href="/pasien" class="<?= ($menu == 'pasien') ? 'active' : '' ?>"><i class="fa-solid fa-clipboard-user me-2"></i> Data Pasien</a> -->

        <div class="menu-label">Informasi</div>

        <a href="/berita" class="<?= ($menu == 'berita') ? 'active' : '' ?>">
            <i class="fa-regular fa-newspaper me-2"></i> Edit Berita
        </a>

        <a href="/funfact" class="<?= ($menu == 'funfact') ? 'active' : '' ?>">
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
                <div class="avatar-circle">
                    <a href="#">
                        <i class="fa-regular fa-user text-white"></i> </a>
                </div>
            </div>
        </div>

        <div class="content-body">
            <?= $this->renderSection('content'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url('js/script.js') ?>"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <?= $this->renderSection('script'); ?>

</body>

</html>