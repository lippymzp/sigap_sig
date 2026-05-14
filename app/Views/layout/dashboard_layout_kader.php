<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIGAP'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        /* 1. Efek scroll mulus dan jarak batas atas */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 180px; 
        }

        /* 2. Pastikan Topbar dan Sidebar selalu berada di lapisan paling atas */
        .topbar {
            z-index: 9990 !important;
            position: relative; 
        }
        .sidebar {
            z-index: 9999 !important;
        }

        /* ===== FIX FOOTER FULL + TIDAK KETUTUP SIDEBAR ===== */
        .footer {
            background: #11b5b9;
            color: white;
            padding: 35px 0 15px;
            margin-top: 40px;
        }

        .main-content .footer { width: 100%; }
        .footer h6 { font-weight: 600; font-size: 15px; margin-bottom: 10px; }
        .footer p { font-size: 13px; margin-bottom: 5px; }
        .footer hr { border-color: rgba(255,255,255,0.2); margin: 15px 0; }

        @media (max-width: 768px) {
            .footer .col-md-4 { text-align: center !important; margin-bottom: 15px; }
        }

        /* =========================================
           STYLE MODAL KONFIRMASI LOGOUT 
           ========================================= */
        .logout-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(2px);
            z-index: 100000; display: none; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.3s ease;
        }
        .logout-overlay.show { opacity: 1; display: flex; }

        .logout-card {
            background: #FFFFFF; width: 100%; max-width: 360px;
            border-radius: 20px; padding: 40px 30px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            text-align: center; transform: scale(0.9); transition: transform 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }
        .logout-overlay.show .logout-card { transform: scale(1); }

        .logout-icon-circle {
            background-color: #F44336; 
            width: 70px; height: 70px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px auto; color: white; font-size: 35px;
        }

        .logout-title {
            font-weight: 700; font-size: 24px; color: #111; 
            margin-bottom: 25px; line-height: 1.3;
        }

        .logout-btn-group {
            display: flex; flex-direction: column; gap: 12px;
        }

        .btn-logout-ya {
            background-color: #00BBC2; color: white; border: none; border-radius: 30px;
            padding: 12px; font-weight: 600; font-size: 18px; text-decoration: none;
            box-shadow: 0 4px 10px rgba(0, 187, 194, 0.3); transition: 0.3s;
        }
        .btn-logout-ya:hover { background-color: #009ca2; color: white; }

        .btn-logout-tidak {
            background-color: #D5D5D5; color: white; border: none; border-radius: 30px;
            padding: 12px; font-weight: 600; font-size: 18px; cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.3s;
        }
        .btn-logout-tidak:hover { background-color: #C0C0C0; color: white; }
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: white;
            font-size: 15px;
            line-height: 1.6;
        }

        .contact-item i {
            width: 20px;
            min-width: 20px;
            font-size: 16px;
            color: #ffffff;
            margin-top: 4px;
        }

        .contact-item span {
            flex: 1;
        }
.sidebar .logo {
    padding: 15px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.sidebar .logo img {
    max-width: 115px;
    height: auto;
    display: block;
    margin: 0 auto;
    object-fit: contain;
}
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $this->renderSection('style'); ?>
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

    <div class="sidebar">
        <div class="logo text-center">
    <img src="<?= base_url('img/logo_denggis.png') ?>" 
         alt="Logo SIGAP">
</div>

        <div class="menu-label">HOME</div>

        <a href="<?= base_url('dbd/dashboard/kader') ?>" id="nav-dashboard" class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <a href="<?= base_url('dbd/dashboard/kader#map') ?>" id="nav-map" class="<?= ($menu == 'peta_sebaran') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
        </a>

        <a href="<?= base_url('dbd/dashboard/kader#grafik') ?>" id="nav-grafik" class="<?= ($menu == 'grafik') ? 'active' : '' ?>">
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

    <div class="main-content">

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
                            <a class="dropdown-item" href="<?= base_url('profil_kader') ?>">
                                <i class="fa-regular fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="showLogoutModal(event)">
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
});
</script>
    <div class="footer-dashboard">
    <?= $this->include('layout/footer', [
        'show_footer_maskot' => true
    ]) ?>
</div>