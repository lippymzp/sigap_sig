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
/* ===== FOOTER RESPONSIVE FIX ===== */
/* ===== FOOTER RESPONSIVE FIX (RAPIH UI) ===== */
/* ===== FOOTER RESPONSIVE FIX (RATA KIRI KANAN) ===== */
.footer {
    background: #11b5b9;
    color: white;
    padding: 35px 0 15px;
    margin-top: 40px;

    /* default (sidebar aktif) */
    margin-left: 260px;
    width: calc(100% - 260px);

    transition: all 0.3s ease;
}

/* saat sidebar disembunyikan */
.wrapper.hide ~ .footer {
    margin-left: 0;
    width: 100%;
}

/* container jangan right lagi */
.footer .container {
    text-align: initial;
}

/* bikin row distribusi rata */
.footer .row {
    justify-content: space-between;
    align-items: flex-start;
}

/* tiap kolom rata kiri (biar natural) */
.footer .col-md-4 {
    text-align: left;
    margin-bottom: 10px;
}

/* judul */
.footer h6 {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 8px;
    letter-spacing: 0.3px;
}

/* isi text */
.footer p {
    font-size: 13px;
    margin-bottom: 4px;
    line-height: 1.4;
    opacity: 0.95;
}

/* garis */
.footer hr {
    border-color: rgba(255,255,255,0.25);
    margin: 12px 0;
}

/* copyright tetap center */
.footer .copyright,
.footer p.text-center {
    text-align: center;
}

/* responsive */
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

/* ===== LOGO SIDEBAR FIX ===== */
.logo-sidebar{
    width: 110px;     /* ukuran logo */
    max-width: 100%;
    height: auto;

    display: block;
    margin: 0 auto;   /* center */
}

/* kalau masih terasa besar */
.sidebar .logo{
    padding: 5px 0 10px;
}

</style>
</head>

<body>

<?php
$penyakit = session('penyakit') ?? 'dbd';
$menu = $menu ?? '';
?>

<?php
$db = \Config\Database::connect();

$id_petugas = session()->get('id_petugas');

$profil = $db->table('profil')
    ->where('id_petugas', $id_petugas)
    ->get()
    ->getRowArray();

$fotoNavbar = (!empty($profil['foto_profil']))
    ? base_url('uploads/profil/' . $profil['foto_profil'])
    : 'https://i.ibb.co.com/0jZ7Z7Z/male-avatar.png';
?>

<div class="wrapper" id="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">

<div class="logo text-center mb-3">
    <img src="<?= base_url('img/logo_denggis.png') ?>" 
         alt="Logo DENGGIS" 
         class="logo-sidebar">
</div>
<div class="menu-label">HOME</div>
<a href="<?= base_url('dbd/dashboard') ?>"
            class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

    <div class="menu-label">MENU UTAMA</div>

        <a href="<?= base_url('dbd/input_data') ?>"
            class="<?= ($menu == 'inputdata') ? 'active' : '' ?>">
            <i class="fa-regular fa-clipboard me-2"></i>Input Data Pasien
        </a>

        <a href="<?= base_url('dbd/hasil') ?>"
            class="<?= ($menu == 'hasil') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder me-2"></i>Hasil Data Pasien
        </a>

        <a href="<?= base_url('dbd/rekap_skrining') ?>" 
            class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
            <i class="fa-regular fa-file-lines me-2"></i>Rekap Skrining
        </a>

        <a href="<?= base_url('dbd/dashboard') ?>#map"
            class="<?= ($menu == 'peta') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i>Peta Sebaran
        </a>

        <a href="<?= base_url('dbd/export-hasil-data-pasien') ?>"
            class="<?= ($menu == 'export') ? 'active' : '' ?>">
            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Export Data
        </a>


<div class="menu-label">Informasi</div>

<a href="<?= base_url('berita') ?>">
  <i class="fa-solid fa-newspaper me-2"></i> Berita
</a>

<a href="<?= base_url('Funfact') ?>">
  <i class="fa-solid fa-lightbulb me-2"></i> Fun Fact
</a>

<a href="<?= base_url('video') ?>">
  <i class="fa-solid fa-video me-2"></i> Video
</a>

<a href="<?= base_url('profil_admin') ?>">
  <i class="fa-solid fa-user me-2"></i> Profil User
</a>

<div class="menu-label">Master Data</div>

<a href="<?= base_url('manajemen_user') ?>">
  <i class="fa-solid fa-users me-2"></i> Manajemen User
</a>

<a href="<?= base_url('manajemen_puskesmas') ?>">
  <i class="fa-solid fa-hospital me-2"></i> Manajemen Puskesmas
</a>

<a href="<?= base_url('profil_sistem') ?>">
  <i class="fa-solid fa-gear me-2"></i> Profil Sistem
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
            <div class="avatar-circle"
                data-bs-toggle="dropdown"
                style="
                    cursor:pointer;
                    width:45px;
                    height:45px;
                    border-radius:50%;
                    overflow:hidden;
                ">

                <img src="<?= $fotoNavbar; ?>"
                    style="
                        width:100%;
                        height:100%;
                        object-fit:cover;
                    ">

            </div>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="<?= base_url('profil_admin') ?>">
                        Profile
                    </a>
                </li>
                <li>
<a class="dropdown-item"
   href="javascript:void(0)"
   onclick="confirmLogout('<?= base_url('/logout') ?>')">
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
            <img src="<?= base_url('img/logo_denggis.png') ?>" 
                 alt="Logo DENGGIS" 
                 style="max-width:55px;">
        </div>

        <h6 class="fw-bold mb-1">DENGGIS</h6>

        <p class="small mb-0" style="line-height:1.3;">
    Sistem Informasi Geografis Analisis<br>
    & Pemantauan Penyakit
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

/* LOGOUT */
function confirmLogout(url)
{
    if(confirm('Yakin ingin keluar?'))
    {
        window.location.href = url;
    }
}
</script>

<?= $this->renderSection('script'); ?>

</body>
</html>