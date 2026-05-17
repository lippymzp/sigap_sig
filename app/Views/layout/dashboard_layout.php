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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?= $this->renderSection('style'); ?>

    <?php
    $this->setVar('show_footer_maskot', true);
    $this->setVar('footer_maskot', 'logo_tbc.png');
    ?>
</head>

<body>
    <?php
    $penyakit = 'tbc';
    $menu = $menu ?? '';?>
    <div class="wrapper" id="wrapper">
    <div class="sidebar">
        
        <div class="logo text-center">
            <img src="<?= base_url('img/logotbc_navbar.png') ?>"alt="Logo SIGAP" style="max-width: 160px; height: auto;">
        </div>

        <div class="menu-label">HOME</div>

        <a href="<?= base_url($penyakit . '/dashboard') ?>"
            class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <a href="<?= base_url($penyakit . '/hasil') ?>"
            class="<?= ($menu == 'hasil') ? 'active' : '' ?>">
            <i class="fa-regular fa-folder me-2"></i> Data Pasien
        </a>

       <a href="<?= base_url($penyakit . '/grafik') ?>"
            class="<?= ($menu == 'grafik') ? 'active' : '' ?>">
            <i class="fa-regular fa-clipboard me-2"></i> Grafik
        </a>

        <a href="<?= base_url($penyakit . '/skrining_1') ?>"
            class="<?= ($menu == 'skrining') ? 'active' : '' ?>">
            <i class="fa-regular fa-file-lines me-2"></i> Skrining
        </a>

<a href="<?= base_url($penyakit . '/dashboard#peta-sebaran') ?>"
   id="menu-peta">
            <i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran
        </a>

        <a href="<?= base_url($penyakit . '/export') ?>"
            class="<?= ($menu == 'export') ? 'active' : '' ?>">
            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Export Data
        </a>

        <!-- <div class="menu-label">Manajemen Data</div>
        <a href="/pasien" class="<?= ($menu == 'pasien') ? 'active' : '' ?>"><i class="fa-solid fa-clipboard-user me-2"></i> Data Pasien</a> -->

        <div class="menu-label">Informasi</div>

        <a href="<?= base_url($penyakit . '/berita') ?>"
            class="<?= ($menu == 'berita') ? 'active' : '' ?>">
            <i class="fa-regular fa-newspaper me-2"></i> Edit Berita
        </a>

        <a href="<?= base_url($penyakit . '/funfact') ?>"
            class="<?= ($menu == 'funfact') ? 'active' : '' ?>">
            <i class="fa-regular fa-user me-2"></i> Edit Funfact
        </a>
<a href="<?= base_url('tbc/profil_admin') ?>"
    class="<?= ($menu == 'profil') ? 'active' : '' ?>">
     <i class="fa-regular fa-user me-2"></i> Profil Admin
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

<button class="avatar-circle border-0"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        style="cursor:pointer;">

    <i class="fa-regular fa-user text-white"></i>

</button>

    <ul class="dropdown-menu dropdown-menu-end shadow">
        <li>
            <a class="dropdown-item" href="<?= base_url('tbc/profil_admin') ?>">
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
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url('js/script.js') ?>"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <?= $this->renderSection('script'); ?>
    </div> <!-- END WRAPPER -->

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

<script>
document.addEventListener("DOMContentLoaded", function(){

    const footerDesc = document.querySelector(".footer-desc");

    if(footerDesc){

        footerDesc.insertAdjacentHTML("afterend", `
        
            <div class="Bryne Company-info mt-4">

                <h3 style="
                    color:#fff;
                    font-weight:700;
                    font-size:2rem;
                    margin-bottom:12px;
                    line-height:1;
                ">
                    Bryne Company
                </h3>

                <p style="
                    color:#E8FFFF;
                    font-size:1.1rem;
                    line-height:1.8;
                    margin-bottom:0;
                ">
                    Smart Future Tech For Precision Monitoring
                </p>

            </div>

        `);

    }

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const hash = window.location.hash;

    // kalau buka peta sebaran
    if(hash === "#peta-sebaran"){

        // hapus active dashboard
        const dashboardMenu = document.querySelector(
            'a[href*="/dashboard"]'
        );

        dashboardMenu?.classList.remove("active");

        // aktifkan peta
        document
            .getElementById("menu-peta")
            ?.classList.add("active");
    }

});
</script>

</body>