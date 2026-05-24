<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $title ?? 'SIGAP' ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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

<!-- Sidebar Kepala Puskesmas -->
<div class="sidebar">
    <div class="logo text-center">
        <img src="<?= base_url('img/logotbc_navbar.png') ?>" alt="Logo SIGAP" style="max-width: 160px; height:auto;">
    </div>

    <!-- HOME Section -->
    <div class="sidebar-section-title text-uppercase mt-3 mb-2 ps-3">Home</div>
    <ul class="list-unstyled">
        <li class="<?= ($menu=='dashboard')?'active':'' ?>">
            <a href="<?= base_url('kepalatbc/dashboard') ?>">
                <i class="fa-solid fa-house me-2"></i> Dashboard
            </a>
        </li>
        <li class="<?= ($menu=='export')?'active':'' ?>">
            <a href="<?= base_url('kepalatbc/export') ?>">
                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Export Data
            </a>
        </li>
        <li class="<?= ($menu=='profil')?'active':'' ?>">
            <a href="<?= base_url('kepalatbc/profil') ?>">
                <i class="fa-regular fa-user me-2"></i> Profil User
            </a>
        </li>
    </ul>
</div>

<style>
/* Style sidebar section title */
.sidebar-section-title {
    font-size: 0.75rem;
    font-weight: 700;
    color: #6c757d;
}

/* Style active menu */
.sidebar li.active > a {
    background-color: #06b6d4;
    color: #fff;
    border-radius: 8px;
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    transition: background 0.2s;
}

.sidebar li.active > a i {
    color: #fff;
    margin-right: 0.5rem;
}
</style>

<!-- Main Content -->
<div class="main-content">
    <!-- Topbar Kepala Puskesmas -->
<div class="topbar d-flex justify-content-between align-items-center p-3 bg-white shadow-sm">

    <!-- Strip 3 + Judul -->
    <div class="d-flex align-items-center gap-3">
        <!-- Strip 3 ikon -->
        <i class="fa-solid fa-bars fs-4 text-dark" id="toggleSidebar" style="cursor:pointer;"></i>
        <div class="fs-4 fw-bold text-dark"><?= $judul ?? 'Dashboard Kepala Puskesmas' ?></div>
    </div>

    <!-- Profil Bulatan -->
    <div class="d-flex align-items-center">
        <div class="text-end me-2">
            <div class="fw-bold text-dark" style="font-size: 0.95rem; line-height:1.2;">Profil</div>
            <small class="admin-text"><?= $role ?? 'Kepala Puskesmas' ?></small>
        </div>

        <div class="dropdown">
            <button class="avatar-circle border-0"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    style="cursor:pointer; width:45px; height:45px; border-radius:50%; background:#FFD64D; display:flex; justify-content:center; align-items:center;">
                <i class="fa-regular fa-user text-white"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="<?= base_url('kepalatbc/profil') ?>">
                        <i class="fa-regular fa-user me-2"></i> Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0)"
                       onclick="confirmLogout('<?= base_url('/logout') ?>')">
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

</div> <!-- END WRAPPER -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->renderSection('script'); ?>

<!-- Script Toggle Sidebar -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById("toggleSidebar");
    const wrapper = document.getElementById("wrapper");

    toggle.addEventListener("click", function() {
        wrapper.classList.toggle("hide"); // hide/show sidebar
    });
});
</script>

</body>
</html> 