<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIGAP'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $this->renderSection('style'); ?>
</head>

<body>
    <?php
    $penyakit = session('penyakit') ?? 'pneumonia';
    $menu = $menu ?? '';?>
    <div class="wrapper" id="wrapper">
        <div class="sidebar">

            <div class="logo text-center">

                <?php if (($penyakit ?? '') == 'pneumonia') : ?>

                <img src="<?= base_url('img/pulmora.png') ?>" alt="Pulmora" style="max-width:200px; height:auto;">

                <?php else : ?>

                <img src="<?= base_url('assets/img/logo_nama.svg') ?>" alt="Logo SIGAP"
                    style="max-width:160px; height:auto;">

                <?php endif; ?>

            </div>

            <div class="menu-label">HOME</div>

            <a href="<?= base_url('index.php/' . $penyakit . '/dashboard'. '/admin') ?>"
                class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-house me-2"></i> Dashboard
            </a>

            <div class="menu-label">MENU UTAMA</div>

            <a href="<?= base_url('index.php/' . $penyakit . '/input_data') ?>"
                class="<?= ($menu == 'inputdata') ? 'active' : '' ?>">
                <i class="fa-solid fa-clipboard me-2"></i> Input Data Pasien
            </a>

            <a href="<?= base_url('index.php/' . $penyakit . '/hasil') ?>"
                class="<?= ($menu == 'hasil') ? 'active' : '' ?>">
                <i class="fa-solid fa-folder me-2"></i> Hasil Data Pasien
            </a>

            <a href="<?= base_url( $penyakit . '/rekapskrining/admin') ?>"
                class="<?= ($menu == 'rekapskrining') ? 'active' : '' ?>">
                <i class="fa-solid fa-file-lines me-2"></i> Rekap Skrining
            </a>

            <a href="<?= base_url('index.php/' . $penyakit . '/peta_sebaran') ?>"
                class="<?= ($menu == 'peta') ? 'active' : '' ?>">
                <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
            </a>

            <a href="<?= base_url('index.php/pneumonia/grafik') ?>" class="<?= ($menu == 'export') ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-area me-2"></i> Grafik
            </a>

            <a href="<?= base_url('index.php/' . $penyakit . '/pegawai') ?>"
                class="<?= ($menu == 'pegawai') ? 'active' : '' ?>">
                <i class="fa-solid fa-address-book me-2"></i> Data Pegawai
            </a>

            <!-- <div class="menu-label">Manajemen Data</div>
        <a href="/pasien" class="<?= ($menu == 'pasien') ? 'active' : '' ?>"><i class="fa-solid fa-clipboard-user me-2"></i> Data Pasien</a> -->

            <div class="menu-label">Informasi</div>

            <a href="<?= base_url('/beritapneumonia/admin') ?>"
                class="<?= ($menu == 'beritapneumonia') ? 'active' : '' ?>">
                <i class="fa-solid fa-newspaper me-2"></i> Edit Berita
            </a>

            <a href="<?= base_url('index.php/' . $penyakit . '/funfact') ?>"
                class="<?= ($menu == 'funfact') ? 'active' : '' ?>">
                <i class="fa-solid fa-brain me-2"></i> Edit Funfact
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
                    <div class="notification-bell me-4" id="notification-toggle">
                        <i class="fa-regular fa-bell"></i>
                        <span class="notification-badge">
                        </span>
                    </div>
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
                                <a class="dropdown-item"
                                    href="<?= base_url('index.php/' . $penyakit . '/profil_admin') ?>">
                                    <i class="fa-regular fa-user me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)"
                                    onclick="confirmLogout('<?= base_url('/logout') ?>')">
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


            <!-- FOOTER -->
            <footer class="footer-sigap mt-5">

                <div class="container">

                    <div class="row gy-5">

                        <!-- LOGO & DESKRIPSI -->
                        <div class="col-lg-6" data-aos="fade-up">

                            <div class="footer-brand">

                                <div class="footer-brand-top">

                                    <img src="<?= base_url('img/medixa.png') ?>" alt="Medixa Logo" class="footer-logo">

                                    <img src="<?= base_url('img/cynex.png') ?>" alt="Cynex Logo" class="footer-maskot">

                                </div>

                                <h3 class="footer-title">MEDIXA</h3>

                                <p class="footer-desc">
                                    Medical Innovation & Excellence Alliance
                                </p>

                                <h3 class="footer-title mt-4">CYNEX</h3>

                                <p class="footer-desc">
                                    Clinical System for Next Experience
                                </p>
                            </div>
                            <div class="footer-links mt-5">
                                <a href="/tentang-kami">Tentang Kami</a>
                            </div>

                        </div>

                        <!-- SOSIAL -->
                        <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="100">

                            <h5 class="footer-heading">Media Sosial</h5>

                            <div class="social-item">
                                <i class="bi bi-instagram"></i>
                                <span>@sigap.co.id</span>
                            </div>

                            <div class="social-item">
                                <i class="bi bi-instagram"></i>
                                <span>@cynex.tech</span>
                            </div>

                        </div>

                        <!-- KONTAK -->
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">

                            <h5 class="footer-heading">Informasi Kontak</h5>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>

                                <div>
                                    <h6>Email</h6>
                                    <p>medixatechnology@gmail.com</p>

                                    <p>
                                        cynextechnology.c@gmail.com
                                    </p>
                                </div>
                            </div>

                            <div class="contact-item mt-4">
                                <div class="contact-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>

                                <div>
                                    <h6>Lokasi</h6>
                                    <p>
                                        Jl. Mastrip, Krajan Timur, Sumbersari,
                                        Kec. Sumbersari, Kabupaten Jember,
                                        Jawa Timur 68121
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- GARIS -->
                    <div class="footer-line"></div>

                </div>

            </footer>

            <style>
            .footer-sigap {
                background: #014F4F;
                padding: 80px 0 30px;
                position: relative;
                overflow: hidden;
            }

            /* CONTAINER */
            .footer-sigap .container {
                position: relative;
                z-index: 2;
            }

            .footer-brand-top {
                display: flex;
                align-items: center;
                gap: 40px;
                margin-bottom: 30px;
            }

            .footer-brand-item {
                display: flex;
                flex-direction: column;
                width: 260px;
            }

            /* CYNEX */
            .footer-maskot {
                width: 230px;
                margin-top: 10px;
                margin-left: -20px;
                filter: drop-shadow(0 0 10px rgba(64, 237, 208, 0.35));
            }

            /* LOGO */
            .footer-logo {
                width: 116px;
                margin-bottom: -8px;
                filter: drop-shadow(0 0 10px rgba(64, 237, 208, 0.35));
            }

            /* TITLE */
            .footer-title {
                color: #fff;
                font-weight: 700;
                font-size: 2rem;
                margin-bottom: 12px;
            }

            /* DESC */
            .footer-desc {
                color: #E8FFFF;
                font-size: 1.1rem;
                line-height: 1.8;
                max-width: 500px;
                margin-bottom: 40px;
            }

            /* HEADING */
            .footer-heading {
                color: #fff;
                font-size: 1.4rem;
                font-weight: 700;
                margin-bottom: 25px;
            }

            /* LINKS */
            .footer-links {
                display: flex;
                flex-direction: column;
                gap: 18px;
            }

            .footer-links a {
                color: #fff;
                text-decoration: underline;
                font-size: 1.2rem;
                font-weight: 600;
                transition: 0.3s;
                width: fit-content;
            }

            .footer-links a:hover {
                color: #40EDD0;
                transform: translateX(5px);
            }

            /* SOCIAL */
            .social-item {
                display: flex;
                align-items: center;
                gap: 12px;
                color: #fff;
                font-size: 1.1rem;
            }

            .social-item i {
                font-size: 1.3rem;
            }

            /* CONTACT */
            .contact-item {
                display: flex;
                gap: 18px;
                align-items: flex-start;
            }

            /* ICON */
            .contact-icon {
                width: 55px;
                height: 55px;
                background: #E8FFFF;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .contact-icon i {
                color: #014F4F;
                font-size: 1.3rem;
            }

            /* CONTACT TEXT */
            .contact-item h6 {
                color: #fff;
                font-weight: 700;
                margin-bottom: 6px;
                font-size: 1.1rem;
            }

            .contact-item p {
                color: #E8FFFF;
                line-height: 1.7;
                margin: 0;
                font-size: 1rem;
            }

            /* LINE */
            .footer-line {
                width: 100%;
                height: 2px;
                background: rgba(255, 255, 255, 0.4);
                margin: 30px 0 25px;
            }

            /* COPYRIGHT */
            .footer-bottom {
                display: flex;
                justify-content: flex-end;
            }

            .footer-bottom p {
                color: #fff;
                margin: 0;
                font-size: 1rem;
            }

            /* RESPONSIVE */
            @media(max-width:991px) {

                .footer-bottom {
                    justify-content: center;
                    text-align: center;
                }

                .footer-logo {
                    width: 120px;
                }

            }

            @media(max-width:768px) {

                .footer-sigap {
                    padding: 60px 0 25px;
                }

                .footer-title {
                    font-size: 1.7rem;
                }

                .footer-desc {
                    font-size: 1rem;
                }

                .footer-heading {
                    margin-top: 10px;
                }

            }
            </style>
            <style>
            /* NOTIFICATION */
            .notification-bell {
                position: relative;
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: #F5FBFB;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: 0.3s;
            }

            .notification-bell:hover {
                background: #E9F7F7;
                transform: translateY(-2px);
            }

            /* ICON */
            .notification-bell i {
                font-size: 18px;
                color: #0F6C73;
            }

            /* BADGE */
            .notification-badge {
                position: absolute;
                top: -3px;
                right: -3px;
                background: #FF4D4F;
                color: white;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                font-size: 11px;
                font-weight: 600;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 2px solid white;
            }

            /* FOOTER */
            .notif-footer {
                margin-top: 15px;
                text-align: center;
            }

            /* BUTTON */
            .notif-footer button {
                background: linear-gradient(135deg,
                        #E53935,
                        #FF6B6B);
                color: white;
                border: none;
                padding: 12px 20px;
                border-radius: 14px;
                font-size: 14px;
                font-weight: 600;
                height: 48px;
                cursor: pointer;
                transition: 0.3s;
                width: 100%;
                box-shadow:
                    0 8px 18px rgba(229,
                        57,
                        53,
                        0.18);
            }

            /* HOVER */
            .notif-footer button:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(229,
                        57,
                        53,
                        0.25);
            }

            /* SUMMARY */
            .notif-content {
                text-align: center;
                padding: 5px 0;
            }

            /* ICON */
            .notif-summary-icon {
                width: 62px;
                height: 62px;
                margin: 0 auto 16px;
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 8px 18px rgba(229,
                        57,
                        53,
                        0.12);
            }

            .notif-summary-icon.warning {
                background: linear-gradient(135deg,
                        #FFE5E5,
                        #FFF1F1);
                border: 1px solid #FFD3D3;
            }

            .notif-summary-icon.warning i {
                color: #E53935;
            }

            .notif-summary-icon i {
                font-size: 30px;
                color: #E53935;
            }

            /* TITLE */
            .notif-content h4 {
                font-size: 18px;
                font-weight: 700;
                margin-bottom: 10px;
            }

            /* TEXT */
            .notif-content p {
                font-size: 14px;
                line-height: 1.6;
                margin-bottom: 6px;
            }

            /* SMALL TEXT */
            .notif-content span {
                font-size: 13px;
            }
            </style>
            <style>
            /* POPUP */
            #notification-popup {

                position: fixed;

                top: 85px;

                right: 25px;

                width: 320px;

                background: linear-gradient(180deg,
                        #FFF7F7,
                        #FFFDFD);

                border: 1px solid #FFE1E1;

                border-radius: 24px;

                padding: 22px;

                box-shadow:
                    0 10px 30px rgba(229, 57, 53, 0.08),
                    0 2px 8px rgba(0, 0, 0, 0.04);

                z-index: 9999;

                display: none;

                animation: fadeNotif 0.25s ease;

            }

            /* ITEM */
            .notif-item {
                background: #FFE5E5;
                border-radius: 18px;
                padding: 18px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            /* LEFT */
            .notif-left {
                display: flex;
                gap: 15px;
            }

            /* ICON */
            .notif-icon {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                background: #FFE5E5;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #E53935;
                font-size: 18px;
            }

            /* INFO */
            .notif-info h5 {
                margin: 0;
                font-size: 16px;
                font-weight: 600;
            }

            .notif-info span {
                display: block;
                font-size: 14px;
                color: #444;
            }

            .notif-info small {
                color: #666;
            }

            /* STATUS */
            .notif-status {
                background: #FFB3B3;
                color: #C62828;
                padding: 6px 14px;
                border-radius: 30px;
                font-size: 12px;
                font-weight: 600;
            }

            /* EMPTY */
            .notif-empty {
                text-align: center;
                padding: 30px;
                color: #777;
            }

            /* ANIMATION */
            @keyframes fadeNotif {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }

            }
            </style>
            <style>
            /* =========================
   RISK MODAL
========================= */
            #riskModal {
                position: fixed;
                inset: 0;
                background: rgba(18, 18, 18, 0.38);
                backdrop-filter: blur(4px);
                z-index: 99999;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 30px;
            }

            /* CONTENT */
            .risk-modal-content {
                width: 100%;
                max-width: 1050px;
                max-height: 90vh;
                overflow-y: auto;
                background: white;
                border-radius: 28px;
                padding: 30px;
                animation: modalFade 0.25s ease;
                box-shadow: 0 20px 50px rgba(0,
                        0,
                        0,
                        0.2);
            }

            /* HEADER */
            .risk-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 25px;
            }

            .risk-header h2 {
                font-size: 34px;
                font-weight: 700;
                color: #111;
                margin-bottom: 5px;
            }

            .risk-header p {
                color: #666;
                font-size: 15px;
            }

            /* CLOSE BUTTON */
            #closeRiskModal {
                width: 42px;
                height: 42px;
                border: none;
                border-radius: 12px;
                background: #F5F5F5;
                font-size: 18px;
                cursor: pointer;
                transition: 0.3s;
            }

            #closeRiskModal:hover {
                background: #FFE5E5;
                color: #D32F2F;
            }

            /* SUMMARY */
            .risk-summary {
                margin-bottom: 25px;
            }

            .risk-info-strip {

                display: flex;

                gap: 18px;

                margin-bottom: 28px;

            }

            .risk-info-box {

                flex: 1;

                background: #FFF5F5;

                border: 1px solid #FFE1E1;

                border-radius: 18px;

                padding: 18px;

                display: flex;

                align-items: center;

                gap: 15px;

            }

            .risk-info-box i {

                width: 48px;
                height: 48px;

                border-radius: 14px;

                background: #FFE5E5;

                color: #E53935;

                display: flex;

                align-items: center;
                justify-content: center;

                font-size: 20px;

            }

            .risk-info-box h5 {

                margin: 0;

                font-size: 16px;

                font-weight: 700;

            }

            .risk-info-box span {

                color: #666;

                font-size: 13px;

            }

            /* TABLE */
            .risk-table-wrapper {
                overflow-x: auto;
            }

            .risk-table {
                width: 100%;
                border-collapse: collapse;
            }

            .risk-table thead {
                background: #F7FBFB;
            }

            .risk-table th {
                padding: 16px;
                text-align: left;
                color: #0F172A;
                font-size: 14px;
                font-weight: 700;
            }

            .risk-table td {
                padding: 16px;
                border-top: 1px solid #ECECEC;
                font-size: 14px;
                color: #444;
            }

            /* ROW HOVER */
            .risk-table tbody tr:hover {
                background: #FAFAFA;
            }

            /* BADGE */
            .risk-badge {
                background: #FFE5E5;
                color: #D32F2F;
                padding: 7px 14px;
                border-radius: 30px;
                font-size: 12px;
                font-weight: 600;
            }

            .risk-modal-footer {
                margin-top: 30px;
                display: flex;
                justify-content: flex-end;
            }

            .risk-modal-footer button {
                background: #F5F5F5;
                border: none;
                padding: 12px 26px;
                border-radius: 14px;
                font-weight: 600;
                transition: 0.3s;
            }

            .risk-modal-footer button:hover {
                background: #ECECEC;
            }

            /* ANIMATION */
            @keyframes modalFade {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }

            }
            </style>

            <!-- BOOTSTRAP -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            <!-- BOOTSTRAP ICON -->
            <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

            <!-- LEAFLET -->
            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

            <!-- AOS -->
            <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                AOS.init({
                    duration: 1000,
                    once: true
                });

            });
            </script>
            <!-- NOTIFICATION POPUP -->
            <div id="notification-popup">
                <div class="notif-content">
                    <?php if(isset($notif) && count($notif) > 0): ?>
                    <!-- ADA RISIKO -->
                    <div class="notif-summary-icon warning">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h4>
                        Peringatan Pneumonia
                    </h4>
                    <p>
                        Telah terdeteksi
                        <strong>
                            <?= count($notif) ?>
                        </strong>
                        pasien berisiko pneumonia.
                    </p>
                    <span>
                        Segera lakukan pemeriksaan lebih lanjut.
                    </span>
                    <?php else: ?>
                    <!-- AMAN -->
                    <div class="notif-summary-icon safe">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h4>
                        Tidak Ada Peringatan
                    </h4>
                    <p>
                        Belum ada pasien berisiko pneumonia saat ini 😄
                    </p>
                    <span>
                        Sistem monitoring berjalan normal.
                    </span>
                    <?php endif; ?>
                </div>
                <div class="notif-footer">
                    <button id="openRiskModal">
                        Lihat Semua
                    </button>
                </div>
            </div>
            <script>
            // ELEMENT
            const notifToggle =
                document.getElementById('notification-toggle');
            const notifPopup =
                document.getElementById('notification-popup');
            // TOGGLE POPUP
            notifToggle.addEventListener('click', () => {
                if (
                    notifPopup.style.display === 'block'
                ) {
                    notifPopup.style.display = 'none';
                } else {
                    notifPopup.style.display = 'block';
                }
            });
            // KLIK LUAR = TUTUP
            document.addEventListener('click', (e) => {
                if (
                    !notifToggle.contains(e.target) &&
                    !notifPopup.contains(e.target)
                ) {
                    notifPopup.style.display = 'none';
                }
            });
            </script>
            <!-- MODAL RISIKO PNEUMONIA -->
            <div id="riskModal">
                <div class="risk-modal-content">
                    <!-- HEADER -->
                    <div class="risk-header">
                        <div>
                            <h2>
                                Peringatan Pneumonia
                            </h2>
                        </div>
                        <button id="closeRiskModal">
                            ✕
                        </button>
                    </div>
                    <!-- SUMMARY -->
                    <div class="risk-summary">
                    </div>
                    <p>
                        Daftar pasien berisiko pneumonia
                    </p>
                    <!-- INFO STRIP -->
                    <div class="risk-info-strip">

                        <div class="risk-info-box">

                            <i class="fa-solid fa-lungs"></i>

                            <div>

                                <h5>
                                    <?= isset($notif) ? count($notif) : 0 ?>
                                </h5>

                                <span>
                                    Pasien Berisiko
                                </span>

                            </div>

                        </div>

                        <div class="risk-info-box">

                            <i class="fa-solid fa-clock"></i>

                            <div>

                                <h5>
                                    Monitoring Aktif
                                </h5>

                                <span>
                                    Sistem berjalan normal
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- TABLE -->
                    <div class="risk-table-wrapper">
                        <table class="risk-table">
                            <thead>
                                <tr>
                                    <th>Nama Pasien</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Tanggal Skrining</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($notif) && !empty($notif)): ?>
                                <?php foreach($notif as $n): ?>
                                <tr>
                                    <td>
                                        <?= esc($n['nama_pasien_skrining']) ?>
                                    </td>
                                    <td>
                                        <?= esc($n['jenis_kelamin']) ?>
                                    </td>
                                    <td>
                                        <?= esc($n['usia']) ?> Tahun
                                    </td>
                                    <td>
                                        <?= date(
                                    'd M Y',
                                    strtotime($n['tanggal'])
                                ) ?>
                                    </td>
                                    <td>
                                        <span class="risk-badge">
                                            Berisiko
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="5">
                                        Tidak ada pasien berisiko 😄
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- FOOTER -->
                    <div class="risk-modal-footer">
                        <button id="closeRiskModalFooter">
                            Tutup
                        </button>

                    </div>
                </div>
            </div>
            <script>
            // =========================
            // RISK MODAL
            // =========================

            const openRiskModal =
                document.getElementById('openRiskModal');

            const riskModal =
                document.getElementById('riskModal');

            const closeRiskModal =
                document.getElementById('closeRiskModal');
            const closeRiskModalFooter =
                document.getElementById(
                    'closeRiskModalFooter'
                );

            // OPEN MODAL
            openRiskModal.addEventListener('click', () => {

                riskModal.style.display = 'flex';

            });

            window.addEventListener('load', () => {

                <?php if(
        isset($menu) &&
        $menu == 'dashboard' &&
        isset($notif) &&
        count($notif) > 0
    ): ?>

                setTimeout(() => {

                    riskModal.style.display = 'flex';

                }, 500);

                <?php endif; ?>

            });

            // CLOSE BUTTON
            closeRiskModal.addEventListener('click', () => {
                riskModal.style.display = 'none';
            });
            closeRiskModalFooter.addEventListener(
                'click',
                () => {
                    riskModal.style.display = 'none';
                }
            );
            // CLICK OUTSIDE
            riskModal.addEventListener('click', (e) => {

                if (e.target === riskModal) {

                    riskModal.style.display = 'none';

                }

            });
            </script>
</body>

</html>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById("toggleSidebar");
    const wrapper = document.getElementById("wrapper");

    if (toggle && wrapper) {
        toggle.addEventListener("click", function() {
            wrapper.classList.toggle("hide");
        });
    } else {
        console.log("ERROR: toggle atau wrapper tidak ditemukan");
    }
});
</script>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmLogout(url) {

    Swal.fire({
        title: 'Apakah anda yakin keluar?',
        icon: 'warning',
        showCancelButton: true,

        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'

    }).then((result) => {

        if (result.isConfirmed) {
            window.location.href = url;
        }

    });

}
</script>



</html>