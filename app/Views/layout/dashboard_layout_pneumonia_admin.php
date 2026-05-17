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

            <a href="#map" class="<?= ($menu == 'peta') ? 'active' : '' ?>">
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
            </style>
            <style>
            /* POPUP */
            #notification-popup {

                position: absolute;

                top: 70px;
                right: 90px;

                width: 420px;

                background: white;

                border-radius: 20px;

                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);

                padding: 22px;

                z-index: 9999;

                display: none;

                animation: fadeNotif 0.25s ease;

            }

            /* HEADER */
            .notif-header h4 {

                font-size: 24px;

                font-weight: 700;

                color: #111;

                margin-bottom: 4px;

            }

            .notif-header p {

                color: #666;

                font-size: 14px;

                margin-bottom: 20px;

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

                background: #fff;

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

                <div class="notif-header">

                    <h4>Pasien Berisiko Pneumonia</h4>

                    <p>
                        Pasien yang memerlukan perhatian lebih lanjut
                    </p>

                </div>
                <div class="notif-content">

                    <?php if(!empty($notif)): ?>

                    <?php foreach($notif as $n): ?>

                    <div class="notif-item">

                        <div class="notif-left">

                            <div class="notif-icon">

                                <i class="fa-solid fa-triangle-exclamation"></i>

                            </div>

                            <div class="notif-info">

                                <h5>
                                    <?= esc($n['nama_pasien_skrining']) ?>
                                </h5>

                                <span>
                                    <?= esc($n['jenis_kelamin']) ?>,
                                    <?= esc($n['usia']) ?> Tahun
                                </span>

                                <small>
                                    Tanggal Skrining:
                                    <?= date('d M Y', strtotime($n['tanggal'])) ?>
                                </small>

                            </div>

                        </div>

                        <div class="notif-status">

                            Berisiko

                        </div>

                    </div>

                    <?php endforeach; ?>

                    <?php else: ?>

                    <div class="notif-empty">

                        Belum ada pasien berisiko pneumonia 😄

                    </div>

                    <?php endif; ?>

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