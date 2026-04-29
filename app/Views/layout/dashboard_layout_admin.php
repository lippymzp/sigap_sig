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

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?= $this->renderSection('style'); ?>

<style>

/* 🔥 FIX 1: jangan kunci halaman */
html,body{
    height:auto;              /* FIX */
    margin:0;
    overflow-x:hidden;        /* FIX (hapus hidden total) */
    font-family:'Poppins',sans-serif;
}


/* 🔥 SIDEBAR FIX SCROLL */
.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;

    padding:20px 15px;

    overflow-y:auto;   /* ✅ INI KUNCI */
    overflow-x:hidden;

    box-shadow:2px 0 10px rgba(0,0,0,0.05);
}

/* WRAPPER */
.wrapper{
    display:flex;
    min-height:100vh;         /* FIX (bukan height) */
}



/* MAIN */
.main-content{
    margin-left:260px;
    width:100%;
    min-height:100vh;         /* FIX */
    display:flex;
    flex-direction:column;
}

/* TOPBAR */
.topbar{
    background:#fff;
    padding:15px 25px;
    border-bottom:1px solid #eee;
}

/* CONTENT */
.content-body{
    flex:1;
    overflow-y:auto;          /* penting */
    padding:25px;
    background:#f8f9fc;
}



/* TOGGLE */
.wrapper.hide .sidebar{
    left:-260px;
}
.wrapper.hide .main-content{
    margin-left:0;
}

</style>
</head>

<body>

<?php
$penyakit = session('penyakit') ?? 'tbc';
$menu = $menu ?? '';
?>

<div class="wrapper" id="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">

<div class="logo text-center mb-3">
<img src="/assets/img/logo_nama.svg" style="max-width:160px;">
</div>

<div class="menu-label">HOME</div>
<a href="<?= base_url('dbd/dashboard') ?>"
            class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

    <div class="menu-label">MENU UTAMA</div>

        <a href="<?= base_url('dbd/input_data') ?>"
            class="<?= ($menu == 'inputdata') ? 'active' : '' ?>">
            <i class="fa-regular fa-clipboard me-2"></i> Input Data Pasien
        </a>

        <a href="<?= base_url('dbd/hasil') ?>"
            class="<?= ($menu == 'hasil') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder me-2"></i> Hasil Data Pasien
        </a>

        <a href="<?= base_url('/rekap_skrining_dbd') ?>"
            class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
            <i class="fa-regular fa-file-lines me-2"></i> Skrining
        </a>

        <a href="<?= base_url('dbd/dashboard') ?>#map"
            class="<?= ($menu == 'peta') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
        </a>

        <a href="<?= base_url('dbd/export') ?>"
            class="<?= ($menu == 'export') ? 'active' : '' ?>">
            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Export Data
        </a>


<div class="menu-label">Informasi</div>

<a href="<?= base_url('Berita') ?>">
<i class="fa-regular fa-user me-2"></i>Berita
</a>

<a href="<?= base_url('Fun Fact') ?>">
<i class="fa-regular fa-user me-2"></i>Fun Fact
</a>

<a href="<?= base_url('Video') ?>">
<i class="fa-regular fa-user me-2"></i>Video
</a>

<a href="<?= base_url('profil_admin') ?>">
<i class="fa-regular fa-user me-2"></i>Profil User
</a>

<div class="menu-label">Master Data</div>

<a href="<?= base_url('manajemen_user') ?>">
<i class="fa-regular fa-user me-2"></i>Manajemen User
</a>

<a href="<?= base_url('manajemen_puskesmas') ?>">
<i class="fa-regular fa-user me-2"></i>Manajemen Puskesmas
</a>

<a href="<?= base_url('profil_sistem') ?>">
<i class="fa-regular fa-user me-2"></i>Profil Sistem
</a>

</div>

<!-- MAIN -->
<div class="main-content">

<div class="topbar d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">
        <i class="fa-solid fa-bars me-3" id="toggleSidebar" style="cursor:pointer;"></i>

        <div class="fs-4 fw-bold text-dark">
            <?= $judul ?? 'Dashboard' ?>
        </div>
    </div>

    <div class="d-flex align-items-center">
        <div class="text-end me-3">
            <div class="fw-bold text-dark">Profil</div>
            <small class="admin-text">Admin</small>
        </div>

        <div class="dropdown avatar-dropdown">
            <div class="avatar-circle" data-bs-toggle="dropdown" style="cursor:pointer;">
                <i class="fa-regular fa-user text-white"></i>
            </div>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="<?= base_url('profil_admin') ?>">
                        Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="<?= base_url('/logout') ?>"
                       onclick="return confirm('Yakin mau keluar?')">
                        Keluar
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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

<?= $this->renderSection('script'); ?>

</body>
</html>