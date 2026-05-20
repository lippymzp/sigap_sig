<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SIGAP Super Admin'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>

<div class="wrapper" id="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo text-center">
            <img src="<?= base_url('img/logo_sigap.png') ?>" style="max-width:100px;">
        </div>

        <div class="menu-label">HOME</div>

        <a href="<?= base_url('superadmin') ?>"
           class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>

        <a href="<?= base_url('superadmin/iklan') ?>"
           class="<?= ($menu == 'iklan') ? 'active' : '' ?>">
            <i class="fa-regular fa-newspaper me-2"></i> Manajemen Iklan
        </a>

        <a href="<?= base_url('superadmin/manajemen_admin') ?>"
            class="<?= ($menu == 'manajemen_admin') ? 'active' : '' ?>">
                <i class="fa-solid fa-users me-2"></i>
                Manajemen Admin
        </a>

        <a href="<?= base_url('superadmin/puskesmas') ?>"
           class="<?= ($menu == 'puskesmas') ? 'active' : '' ?>">
            <i class="fa-solid fa-heart-pulse me-2"></i> Manajemen Puskesmas
        </a>

        <a href="<?= base_url('superadmin/profil_sistem') ?>"
           class="<?= ($menu == 'profil') ? 'active' : '' ?>">
            <i class="fa-regular fa-user me-2"></i> Profil Sistem
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
                    <div class="fw-bold">Profil</div>
                    <small>Super Admin</small>
                </div>

                <div class="avatar-circle">
                    <i class="fa-regular fa-user text-white"></i>
                </div>
            </div>

        </div>

        <div class="content-body">
            <?= $this->renderSection('content') ?>
        </div>

    </div>

</div>

<script>
document.getElementById("toggleSidebar").addEventListener("click", function() {
    document.getElementById("wrapper").classList.toggle("hide");
});
</script>

</body>
</html>