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
    padding: 20px 0 10px;
    margin-top: 30px;
    margin-left: 260px;
    width: calc(100% - 260px);
}

.wrapper.hide ~ .footer {
    margin-left: 0;
    width: 100%;
}

.footer .container { text-align: initial; }
.footer .row { justify-content: space-between; align-items: flex-start; }
.footer .col-md-4 { text-align: left; margin-bottom: 10px; }
.footer h6 { font-weight: 600; font-size: 14px; margin-bottom: 8px; letter-spacing: 0.3px; }
.footer p { font-size: 13px; margin-bottom: 4px; line-height: 1.4; opacity: 0.95; }
.footer hr { border-color: rgba(255,255,255,0.25); margin: 12px 0; }
.footer .copyright, .footer p.text-center { text-align: center; }

@media (max-width: 768px) {
    .footer { margin-left: 0; width: 100%; }
    .footer .col-md-4 { text-align: center; margin-bottom: 15px; }
    .footer .logo { justify-content: center; }
}

/* 🔥 FIX 1: JANGAN KUNCI HALAMAN & TAMBAHAN SCROLL MULUS */
html,body{
    height:auto;              
    margin:0;
    overflow-x:hidden;        
    font-family:'Poppins',sans-serif;
    scroll-behavior: smooth; 
    scroll-padding-top: 100px; 
}

/* 🔥 SIDEBAR FIX SCROLL */
.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    padding:20px 15px;
    overflow-y:auto;   /* Ini memastikan sidebar bisa discroll */
    overflow-x:hidden;
    box-shadow:2px 0 10px rgba(0,0,0,0.05);
}

.wrapper{ display:flex; min-height:100vh; }

/* MAIN */
.main-content{
    margin-left:260px;
    width:calc(100% - 260px);
    min-height:100vh;
}

/* TOPBAR */
.topbar{
    background:#fff;
    padding:15px 25px;
    border-bottom:1px solid #eee;
    z-index: 9990 !important; 
    position: sticky;
    top: 0;
}

/* CONTENT */
.content-body{
    flex:1;
    overflow-y:auto;          
    padding:25px;
    background:#f8f9fc;
}

/* TOGGLE */
.wrapper.hide .sidebar{ left:-260px; }
.wrapper.hide .main-content{
    margin-left:0;
    width:100%;
}

/* ===== LOGO SIDEBAR FIX ===== */
.logo-sidebar{
    width: 110px;     
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;   
}

.sidebar .logo{ padding: 5px 0 10px; }

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    color: white;
    font-size: 15px;
    line-height: 1.6;
}

.contact-item i { width: 20px; min-width: 20px; font-size: 16px; color: #ffffff; margin-top: 4px; }
.contact-item span { flex: 1; }
</style>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>

<?php
$penyakit = session('penyakit') ?? 'dbd';
$menu = $menu ?? '';

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

<div class="sidebar">

<div class="logo text-center mb-3">
    <img src="<?= base_url('img/logo_denggis.png') ?>" alt="Logo DENGGIS" class="logo-sidebar">
</div>

<div class="menu-label">HOME</div>
<a href="<?= base_url('dbd/dashboard/admin') ?>" id="nav-dashboard" class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
    <i class="fa-solid fa-house me-2"></i> Dashboard
</a>

<div class="menu-label">MENU UTAMA</div>

<a href="<?= base_url('dbd/dashboard/admin') ?>#map" id="nav-map"
            class="<?= ($menu == 'peta') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i>Peta Sebaran
        </a>

<a href="<?= base_url('dbd/dashboard/admin#grafik') ?>" id="nav-grafik" class="<?= ($menu == 'grafik') ? 'active' : '' ?>">
            <i class="fa-solid fa-chart-column me-2"></i> Grafik
        </a>

<a href="<?= base_url('dbd/input_data') ?>" class="<?= ($menu == 'inputdata') ? 'active' : '' ?>">
    <i class="fa-regular fa-clipboard me-2"></i>Input Data Pasien
</a>

<a href="<?= base_url('dbd/hasil') ?>" class="<?= ($menu == 'hasil') ? 'active' : '' ?>">
    <i class="fa-regular fa-folder me-2"></i>Hasil Data Pasien
</a>

<a href="<?= base_url('dbd/rekap_skrining') ?>" class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
    <i class="fa-regular fa-file-lines me-2"></i>Rekap Skrining
</a>

        <a href="<?= base_url('dbd/pelaporan') ?>"
            class="<?= ($menu == 'pelaporan_kader') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder-open me-2"></i> Pelaporan Kader
        </a>

        <a href="<?= base_url('dbd/export-hasil-data-pasien') ?>"
            class="<?= ($menu == 'export') ? 'active' : '' ?>">
            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Export Data
        </a>

<div class="menu-label">Informasi</div>

<a href="<?= base_url('berita') ?>" class="<?= ($menu == 'berita') ? 'active' : '' ?>">
  <i class="fa-solid fa-newspaper me-2"></i> Berita
</a>

<a href="<?= base_url('funfact') ?>" class="<?= ($menu == 'funfact') ? 'active' : '' ?>">
  <i class="fa-solid fa-lightbulb me-2"></i> Fun Fact
</a>

<a href="<?= base_url('video') ?>" class="<?= ($menu == 'video') ? 'active' : '' ?>">
  <i class="fa-solid fa-video me-2"></i> Video
</a>

<a href="<?= base_url('profil_admin') ?>" class="<?= ($menu == 'profil') ? 'active' : '' ?>">
  <i class="fa-solid fa-user me-2"></i> Profil User
</a>

<div class="menu-label">Master Data</div>

<a href="<?= base_url('manajemen-user') ?>" class="<?= ($menu == 'manajemen_user') ? 'active' : '' ?>">
    <i class="fa-solid fa-users me-2"></i> Manajemen User
</a>

<a href="<?= base_url('dbd/admin/manajemen_puskesmas') ?>" class="<?= ($menu == 'puskesmas') ? 'active' : '' ?>">
  <i class="fa-solid fa-hospital me-2"></i> Manajemen Puskesmas
</a>

<a href="<?= base_url('bannerDbd') ?>" class="<?= ($menu == 'manajemen_banner') ? 'active' : '' ?>">
  <i class="fa-solid fa-hospital me-2"></i> Manajemen Banner
</a>

<a href="<?= base_url('profil_sistem') ?>" class="<?= ($menu == 'sistem') ? 'active' : '' ?>">
  <i class="fa-solid fa-gear me-2"></i> Profil Sistem
</a>

</div>

<div class="main-content">

    <div class="topbar">

    <div style="display:flex; justify-content:space-between; align-items:center; width:100%;">

        <div class="d-flex align-items-center">
            <i class="fa-solid fa-bars me-3" id="toggleSidebar" style="cursor:pointer;"></i>

            <div class="fs-4 fw-bold text-dark">
                <?= $judul ?? 'Dashboard' ?>
            </div>
        </div>

        <div style="display:flex; align-items:center; flex-shrink:0;">

            <div class="text-end me-3">
                <div class="fw-bold text-dark">Profil</div>
                <small class="admin-text">Admin</small>
            </div>

            <div class="dropdown avatar-dropdown">
                <div class="avatar-circle"
                    data-bs-toggle="dropdown"
                    style="cursor:pointer; width:45px; height:45px; border-radius:50%; overflow:hidden;">
                    <img src="<?= $fotoNavbar; ?>" style="width:100%; height:100%; object-fit:cover;">
                </div>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item" href="<?= base_url('profil_admin') ?>">
                            <i class="fa-regular fa-user me-2"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item"
                           href="javascript:void(0)"
                           onclick="confirmLogout('<?= base_url('logout') ?>')">
                           <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                        </a>
                    </li>
                </ul>
            </div>

        </div>

    </div>

</div>

<div class="content-body">
    <?= $this->renderSection('content'); ?>
</div>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("toggleSidebar");
    const wrapper = document.getElementById("wrapper");

    if (toggle && wrapper) {
        toggle.addEventListener("click", function () {
            wrapper.classList.toggle("hide");
        });
    }
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    const currentUrl = window.location.href;
    const currentPath = currentUrl.split('?')[0].split('#')[0]; // URL murni tanpa parameter dan hash
    const currentHash = window.location.hash;

    // ============================================================
    // 2. LOGIKA ACTIVE MENU (Otomatis memperbaiki PHP yang kosong)
    // ============================================================
    // Jika kita mengklik Peta Sebaran
    if (currentHash === '#map') {
        sidebarLinks.forEach(l => l.classList.remove('active'));
        const navMap = document.getElementById('nav-map');
        if (navMap) navMap.classList.add('active');
    } 
    else {
        // Cek apakah ada menu yang sudah diwarnai oleh Controller PHP
        let isAnyActive = document.querySelector('.sidebar a.active');
        
        // Jika PHP lupa mewarnai (misal controller berita tidak mengirim $menu), 
        // JS ini akan otomatis mendeteksi URL dan mewarnai menu yang tepat
        if (!isAnyActive) {
            sidebarLinks.forEach(link => {
                const linkPath = link.href.split('?')[0].split('#')[0];
                if (linkPath === currentPath && link.id !== 'nav-map') {
                    link.classList.add('active');
                }
            });
        }
    }

    // ============================================================
    // 3. AUTO SCROLL SIDEBAR KE MENU YANG AKTIF
    // ============================================================
    const activeMenu = document.querySelector('.sidebar a.active');
    if (activeMenu) {
        // Sidebar akan otomatis menggulung agar menu aktif tampil di tengah
        activeMenu.scrollIntoView({ behavior: 'auto', block: 'center' });
    }

    // ============================================================
    // 4. EFEK WARNA INSTAN SAAT MENU APAPUN DIKLIK
    // ============================================================
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Hapus blok warna dari semua menu
            sidebarLinks.forEach(l => l.classList.remove('active'));
            // Berikan blok warna pada menu yang baru saja diklik
            this.classList.add('active');
        });
    });
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
<div class="footer-dashboard">
    <?= $this->include('layout/footer') ?>
</div>
<script>
function confirmLogout(url) {
    Swal.fire({
        title: 'Yakin ingin keluar?',
        text: "Sesi login akan diakhiri",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Keluar!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>