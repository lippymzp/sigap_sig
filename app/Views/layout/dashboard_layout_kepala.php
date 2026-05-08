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
/* ===== FIX FOOTER FULL + TIDAK KETUTUP SIDEBAR ===== */
.footer {
    background: #11b5b9;
    color: white;
    padding: 35px 0 15px;
    margin-top: 40px;
    margin-left: 260px;
    width: calc(100% - 260px);
    transition: all 0.3s ease;
}

.wrapper.hide ~ .footer {
    margin-left: 0;
    width: 100%;
}

.footer .container {
    text-align: initial;
}

.footer .row {
    justify-content: space-between;
    align-items: flex-start;
}

.footer .col-md-4 {
    text-align: left;
    margin-bottom: 10px;
}

.footer h6 {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 8px;
    letter-spacing: 0.3px;
}

.footer p {
    font-size: 13px;
    margin-bottom: 4px;
    line-height: 1.4;
    opacity: 0.95;
}

.footer hr {
    border-color: rgba(255,255,255,0.25);
    margin: 12px 0;
}

.footer .copyright,
.footer p.text-center {
    text-align: center;
}

@media (max-width: 768px) {
    .footer {
        margin-left: 0;
        width: 100%;
    }

    .footer .col-md-4 {
        text-align: center;
        margin-bottom: 15px;
    }

    .footer .logo {
        justify-content: center;
    }
}

/* 🔥 FIX 1: jangan kunci halaman */
html,body{
    height:auto;
    margin:0;
    overflow-x:hidden;
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
    overflow-y:auto;
    overflow-x:hidden;
    box-shadow:2px 0 10px rgba(0,0,0,0.05);
}

/* WRAPPER */
.wrapper{
    display:flex;
    min-height:100vh;
}

/* MAIN */
.main-content{
    margin-left:260px;
    width:100%;
    min-height:100vh;
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
    overflow-y:auto;
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

<a href="<?= base_url('dashboard_kepala') ?>#map"
    class="<?= ($menu == 'peta') ? 'active' : '' ?>">
    <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
</a>

<a href="<?= base_url('dashboard_kepala') ?>#grafik"
    class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
    <i class="fa-solid fa-chart-column me-2"></i> Grafik
</a>

<a href="<?= base_url('hasil_data_kepala/hasil') ?>"
    class="<?= ($menu == 'hasil_data_kepala') ? 'active' : '' ?>">
    <i class="fa-regular fa-folder me-2"></i> Hasil Data Pasien
</a>

<a href="<?= base_url('index.php/' . $penyakit . '/skrining_1') ?>"
    class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
    <i class="fa-regular fa-file-lines me-2"></i> Rekap Skrining 
</a>

<a href="<?= base_url('kepala/pelaporan_kader') ?>"
    class="<?= ($menu == 'pelaporan_kader') ? 'active' : '' ?>">
    <i class="fa-regular fa-folder-open me-2"></i> Pelaporan Kader
</a>

<div class="menu-label">Informasi</div>

<a href="<?= base_url('profil_kepala') ?>"
    class="<?= ($menu == 'profil_kepala') ? 'active' : '' ?>">
    <i class="fa-regular fa-user me-2"></i> Profil
</a>

<div class="menu-label">Master Data</div>

<a href="<?= base_url('manajemen_user') ?>"
    class="<?= ($menu == 'manajemen_user') ? 'active' : '' ?>">
    <i class="fa-solid fa-users me-2"></i> Manajemen User
</a>

</div>

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
                    <a class="dropdown-item" href="<?= base_url('profil_kepala') ?>">
                        Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="confirmLogout('<?= base_url('/logout') ?>')">
                        Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>

<div class="content-body">
    <?= $this->renderSection('content'); ?>
</div>

</div>
</div>

<footer class="footer">

<div class="container text-white py-3">
<div class="row align-items-start">

    <div class="col-md-4 text-center mb-2">

         <div class="logo mb-1">
            <img src="<?= base_url('img/Logo_Sigap.png') ?>" 
                 alt="Logo SIGAP" 
                 style="max-width:55px;">
        </div>

        <h6 class="fw-bold mb-1">SIGAP</h6>

        <p class="small mb-0" style="line-height:1.3;">
    Sistem Informasi Geografis Analisis<br>
    & Pemantauan Penyakit
</p>

    </div>


    <div class="col-md-4 mb-2">
        <h6 class="fw-bold mb-1">Media Sosial</h6>

        <p class="mb-0 small"><i class="fab fa-instagram me-2"></i>Instagram</p>
        <p class="mb-0 small"><i class="fab fa-facebook me-2"></i>Facebook</p>
        <p class="mb-0 small"><i class="fab fa-twitter me-2"></i>Twitter</p>
    </div>

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

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 320px;">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.15);">
            <div class="modal-body text-center p-4">
                
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background-color: #ff4d4f; border-radius: 50%;">
                    <i class="fa-solid fa-xmark text-white fs-2"></i>
                </div>
                
                <h5 class="fw-bold mb-4 text-dark" style="font-size: 18px;">Apakah anda yakin<br>keluar?</h5>
                
                <div class="d-grid gap-2">
                    <a href="#" id="btnConfirmLogout" class="btn text-white py-2" style="background-color: #11b5b9; border-radius: 8px; font-weight: 500;">Ya</a>
                    <button type="button" class="btn text-white py-2" data-bs-dismiss="modal" style="background-color: #d1d1d1; border-radius: 8px; font-weight: 500;">Tidak</button>
                </div>

            </div>
        </div>
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
            
            // Trigger resize agar Chart.js ikut menyesuaikan jika disembunyikan/ditampilkan
            setTimeout(() => {
                window.dispatchEvent(new Event('resize'));
            }, 300);
        });
    }
});

// FUNGSI LOGOUT KUSTOM
function confirmLogout(url) {
    // Set link tombol "Ya" ke url logout
    document.getElementById('btnConfirmLogout').href = url;
    // Panggil dan tampilkan modal Bootstrap
    var logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
    logoutModal.show();
}
</script>

<?= $this->renderSection('script'); ?>

</body>
</html>