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
    <link rel="stylesheet" href="<?= base_url('css/responsive-fix.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $this->renderSection('style'); ?>
</head>

<body>
    <?php
    $penyakit = session('penyakit') ?? 'diare';
    $menu = $menu ?? '';?>
    <div class="wrapper" id="wrapper">
    <div class="sidebar">
        
        <div class="logo text-center">
            <img src="/img/logodsing.png" alt="Logo dsing" style="max-width: 160px; height: auto;">
        </div>

        <div class="menu-label">HOME</div>

        <a href="<?= base_url('diare/dashboardd') ?>"
            class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <a href="<?= base_url('diare/input_d') ?>"
            class="<?= ($menu == 'inputdata') ? 'active' : '' ?>">
            <i class="fa-regular fa-clipboard me-2"></i> Input Data Pasien
        </a>

        <a href="<?= base_url('diare/hasil_d') ?>"
            class="<?= ($menu == 'hasil') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder me-2"></i> Hasil Data Pasien
        </a>

        <a href="<?= base_url('admind/skrining') ?>"
            class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
            <i class="fa-regular fa-file-lines me-2"></i> Skrining
        </a>

        <a href="#map"
            class="<?= ($menu == 'peta') ? 'active' : '' ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
        </a>

      

        <!-- <div class="menu-label">Manajemen Data</div>
        <a href="/pasien" class="<?= ($menu == 'pasien') ? 'active' : '' ?>"><i class="fa-solid fa-clipboard-user me-2"></i> Data Pasien</a> -->

        <div class="menu-label">Informasi</div>

        <a href="<?= base_url('admind/berita') ?>"
            class="<?= ($menu == 'berita') ? 'active' : '' ?>">
            <i class="fa-regular fa-newspaper me-2"></i> Edit Berita
        </a>

        <a href="<?= base_url('admind/funfact') ?>"
            class="<?= ($menu == 'funfact') ? 'active' : '' ?>">
            <i class="fa-regular fa-user me-2"></i> Edit Funfact
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
                    <div class="fw-bold text-dark" style="font-size: 0.95rem; line-height: 1.2;">Profil</div>
                    <small class="admin-text">Admin</small>
                </div>
                <div class="dropdown avatar-dropdown">
    <div class="avatar-circle" data-bs-toggle="dropdown" style="cursor:pointer;">
        <i class="fa-regular fa-user text-white"></i>
    </div>

    <ul class="dropdown-menu dropdown-menu-end shadow">
        <li>
            <a class="dropdown-item" href="<?= base_url('admind/profil') ?>">
                <i class="fa-regular fa-user me-2"></i> Profile
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

        <div class="content-body">
    <?= $this->renderSection('content'); ?>
</div> <!-- main-content -->

<div class="footer-dashboard">
    <?php 
        $show_footer_maskot = true;
        $footer_maskot = 'logodsing.png';

        echo view('layout/footer', [
            'penyakit' => 'diare',
            'show_footer_maskot' => $show_footer_maskot,
            'footer_maskot' => $footer_maskot
        ]);
    ?>
</div>

</div> <!-- wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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