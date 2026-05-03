<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIGAP'; ?></title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- FOOTER STYLE -->
    <style>
    /* ===== FOOTER FINAL (SESUAI GAMBAR) ===== */
.footer {
    position: relative;
    left: -260px; /* tarik ke kiri sebesar sidebar */
    width: calc(100% + 260px); /* tambah lebar supaya full */
    
    background: #11b5b9;
    color: white;
    padding: 35px 0 15px;
    margin-top: 40px;
}

/* biar ngikut konten (bukan sidebar) */
.main-content .footer {
    width: 100%;
}

/* text */
.footer h6 {
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 10px;
}

.footer p {
    font-size: 13px;
    margin-bottom: 5px;
}

/* garis */
.footer hr {
    border-color: rgba(255,255,255,0.2);
    margin: 15px 0;
}

/* logo */
.footer img {
    margin-bottom: 8px;
}

/* responsive */
@media (max-width: 768px) {
    .footer .col-md-4 {
        text-align: center !important;
        margin-bottom: 15px;
    }
}
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $this->renderSection('style'); ?>
</head>

<body>
<body>

<?php
$penyakit = session('penyakit') ?? 'dbd';
$menu = $menu ?? '';
?>

<div class="wrapper" id="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo text-center">
            <img src="/assets/img/logo_nama.svg" alt="Logo SIGAP" style="max-width: 160px;">
        </div>

        <div class="menu-label">HOME</div>

        <a href="<?= base_url('kader/dashboard') ?>" class="<?= ($menu == 'dashboard_kader') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <a href="<?= base_url('peta_sebaran') ?>" class="<?= ($menu == 'peta_sebaran') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
        </a>

        <a href="<?= base_url('kader/dashboard#grafik') ?>" class="<?= ($menu == 'grafik') ? 'active' : '' ?>">
            <i class="fa-solid fa-chart-column me-2"></i> Grafik
        </a>

        <a href="<?= base_url('formkader/riwayat_lapor_jentik') ?>" class="<?= ($menu == 'riwayat_jentik') ? 'active' : '' ?>">
            <i class="fa-solid fa-file-lines me-2"></i> Pelaporan Kader
        </a>

        <div class="menu-label">Informasi</div>

        <a href="<?= base_url('profil_kader') ?>" class="<?= ($menu == 'profil') ? 'active' : '' ?>">
            <i class="fa-regular fa-user me-2"></i> Profil Kader
        </a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- TOPBAR -->
        <div class="topbar d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center">
                <i class="fa-solid fa-bars me-3" id="toggleSidebar" style="cursor:pointer;"></i>
                <div class="fs-4 fw-bold text-dark">
                    <?= $judul ?? 'Dashboard Kader' ?>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold text-dark" style="font-size: 0.95rem;">Profil</div>
                    <small>Kader</small>
                </div>

                <div class="dropdown avatar-dropdown">
                    <div class="avatar-circle" data-bs-toggle="dropdown" style="cursor:pointer;">
                        <i class="fa-regular fa-user text-white"></i>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="<?= base_url('profil_kader') ?>">
                                <i class="fa-regular fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('/logout') ?>" onclick="return confirm('Yakin mau keluar?')">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content-body">
            <?= $this->renderSection('content'); ?>
        </div>

        <!-- FOOTER -->
        <footer class="footer mt-4">
            <div class="container-fluid py-4 px-4">
                <div class="row">

                    <!-- LOGO -->
    <div class="col-md-4 text-center mb-2">

        <div class="logo mb-1">
            <img src="<?= base_url('img/Logo_Sigap.png') ?>" 
                 alt="Logo SIGAP" 
                 style="max-width:55px;">
        </div>

        <h6 class="fw-bold mb-1">SIGAP</h6>

        <p class="small mb-0" style="line-height:1.3;">
            Sistem Informasi Geografis Analisis & Pemantauan Penyakit
        </p>

    </div>

                     <!-- SOSIAL -->
    <div class="col-md-4 mb-2">
        <h6 class="fw-bold mb-1">Media Sosial</h6>

        <p class="mb-0 small"><i class="fab fa-instagram me-2"></i>Instagram</p>
        <p class="mb-0 small"><i class="fab fa-facebook me-2"></i>Facebook</p>
        <p class="mb-0 small"><i class="fab fa-twitter me-2"></i>Twitter</p>
    </div>

    <!-- KONTAK -->
    <div class="col-md-4 mb-2">
        <h6 class="fw-bold mb-1">Informasi Kontak</h6>

        <p class="mb-0 small">📧 email@kampus.ac.id</p>
        <p class="mb-0 small">📧 email@puskesmas.ac.id</p>
        <p class="mb-0 small">📍 Jember, Jawa Timur</p>
        <p class="mb-0 small">📞 087851132933</p>
    </div>

</div>

<hr class="my-2" style="border-color: rgba(255,255,255,0.2)">

<p class="text-center small mb-0">
    © 2026 SIGAP
</p>

</div>
</footer>

    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('js/script.js') ?>"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<?= $this->renderSection('script'); ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById("toggleSidebar");
    const wrapper = document.getElementById("wrapper");

    if (toggle && wrapper) {
        toggle.addEventListener("click", function() {
            wrapper.classList.toggle("hide");
        });
    }
});
</script>

</body>
</html>