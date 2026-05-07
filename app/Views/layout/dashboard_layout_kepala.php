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
   .footer {
    background: #11b5b9;
    color: white;
    padding: 35px 0 15px;
    margin-top: 40px;
}

/* penting: ikut main-content */
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

/* responsive */
@media (max-width: 768px) {
    .footer .col-md-4 {
        text-align: center !important;
        margin-bottom: 15px;
    }
}

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
$penyakit = session('penyakit') ?? 'dbd';
$menu = $menu ?? '';
?>

<div class="wrapper" id="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">

<div class="logo text-center mb-3">
    <img src="<?= base_url('img/Logo_Sigap.png') ?>" 
         alt="Logo SIGAP" 
         class="logo-sidebar">
</div>
<div class="menu-label">HOME</div>
<a href="<?= base_url('dashboard_kepala') ?>"
            class="<?= ($menu == 'dashboard_kepala') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

    <div class="menu-label">MENU UTAMA</div>


        <a href="<?= base_url('peta_sebaran/kepala') ?>"
            class="<?= ($menu == 'peta_sebaran') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
        </a>

        <a href="<?= base_url('dashboard_kepala') ?>#grafik"
            class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-chart-column me-2"></i> Grafik
        </a>

        <a href="<?= base_url('data_kepala/hasil') ?>"
            class="<?= ($menu == 'hasil_data_kepala') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder me-2"></i> Hasil Data Pasien
        </a>

        <a href="<?= base_url('index.php/' . $penyakit . '/skrining_1') ?>"
            class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
            <i class="fa-regular fa-file-lines me-2"></i> Rekap Skrining 
        </a>

       <a href="<?= base_url('kepala/pelaporan_kader') ?>"
            class="<?= ($menu == 'pelaporan_kader') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder-open me-2"></i>Pelaporan Kader
        </a>
        

        <div class="menu-label">Informasi </div>
        <a href="<?= base_url('profil_kepala') ?>"
            class="<?= ($menu == 'profil_kepala') ? 'active' : '' ?>">
            <i class="fa-regular fa-user me-2"></i>
            Profil
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
            <small class="admin-text">Kepala Puskesmas</small>
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

</div>
</div>
<!-- FOOTER -->
<footer class="footer">

<div class="container text-white py-3">
<div class="row align-items-start">

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