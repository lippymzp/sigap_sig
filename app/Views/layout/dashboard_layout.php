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
            <img src="<?= base_url('img/logotbc_navbar.png') ?>" alt="Logo SIGAP" style="max-width: 160px; height:auto;">
        </div>

        <div class="menu-label">HOME</div>
        <a href="<?= base_url($penyakit . '/dashboard') ?>" id="menu-dashboard"><i class="fa-solid fa-house me-2"></i> Dashboard</a>

        <div class="menu-label">MENU UTAMA</div>
        <a href="<?= base_url($penyakit . '/hasil') ?>" id="menu-hasil"><i class="fa-regular fa-folder me-2"></i> Data Pasien</a>
        <a href="<?= base_url($penyakit . '/dashboard#grafik') ?>" id="menu-grafik"><i class="fa-regular fa-clipboard me-2"></i> Grafik</a>
        <a href="<?= base_url($penyakit . '/dashboard#peta-sebaran') ?>" id="menu-peta"><i class="fa-solid fa-map-location-dot me-2"></i> Peta Sebaran</a>
        <a href="<?= base_url($penyakit . '/export') ?>" id="menu-export"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Export Data</a>

        <div class="menu-label">Informasi</div>
        <a href="<?= base_url($penyakit . '/berita') ?>" id="menu-berita"><i class="fa-regular fa-newspaper me-2"></i> Edit Berita</a>
        <a href="<?= base_url($penyakit . '/funfact') ?>" id="menu-funfact"><i class="fa-regular fa-user me-2"></i> Edit Funfact</a>
        <a href="<?= base_url('tbc/profil_admin') ?>" id="menu-profil"><i class="fa-regular fa-user me-2"></i> Profil Admin</a>

    </div> <!-- END SIDEBAR -->

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- TOPBAR -->
        <div class="topbar d-flex justify-content-between align-items-center p-3 bg-white shadow-sm">

            <div class="d-flex align-items-center">
                <i class="fa-solid fa-bars me-3" id="toggleSidebar" style="cursor:pointer;"></i>
                <div class="fs-4 fw-bold text-dark"><?= $judul ?? 'Dashboard' ?></div>
            </div>

            <div class="d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold text-dark">Profil</div>
                    <small class="admin-text"><?= $role ?? 'Admin' ?></small>
                </div>

                <div class="dropdown avatar-dropdown">
                    <button class="avatar-circle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;">
                        <i class="fa-regular fa-user text-white"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="<?= base_url('tbc/profil_admin') ?>"><i class="fa-regular fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="confirmLogout('<?= base_url('/logout') ?>')">Keluar</a></li>
                    </ul>
                </div>
            </div>

        </div> <!-- END TOPBAR -->

        <div class="content-body">
            <?= $this->renderSection('content'); ?>
        </div>

    </div> <!-- END MAIN CONTENT -->

</div> <!-- END WRAPPER -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url('js/script.js') ?>"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <?= $this->renderSection('script'); ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const wrapper = document.getElementById("wrapper");
    const toggle = document.getElementById("toggleSidebar");
    const sidebarLinks = document.querySelectorAll('.sidebar a');

    // Toggle sidebar
    toggle?.addEventListener("click", () => wrapper.classList.toggle("hide"));

    // Fungsi set active menu
    function setActive(id) {
        sidebarLinks.forEach(l => l.classList.remove('active'));
        document.getElementById(id)?.classList.add('active');
    }

    // =======================
    // DETEKSI MENU AKTIF
    // =======================
    const hash = window.location.hash;
    const pathname = window.location.pathname;

    if(hash === "#grafik") {
        setActive("menu-grafik");
        const el = document.querySelector(hash);
        if(el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    else if(hash === "#peta-sebaran") {
        setActive("menu-peta");
        const el = document.querySelector(hash);
        if(el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    else if(pathname.includes("/export")) setActive("menu-export");
    else if(pathname.includes("/berita")) setActive("menu-berita");
    else if(pathname.includes("/funfact")) setActive("menu-funfact");
    else if(pathname.includes("/hasil")) setActive("menu-hasil");
    else if(pathname.includes("/profil_admin")) setActive("menu-profil");
    else setActive("menu-dashboard"); // fallback

    // Klik manual di sidebar
    sidebarLinks.forEach(link => {
        link.addEventListener("click", function(e) {
            sidebarLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            // Smooth scroll jika ada hash
            const targetHash = this.hash;
            if(targetHash) {
                const targetEl = document.querySelector(targetHash);
                if(targetEl) targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Auto scroll sidebar ke menu aktif
    const activeMenu = document.querySelector('.sidebar a.active');
    if(activeMenu) activeMenu.scrollIntoView({ behavior: 'auto', block: 'center' });
});

// LOGOUT CONFIRM
function confirmLogout(url) {
    Swal.fire({
        title: 'Apakah anda yakin keluar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => { if(result.isConfirmed) window.location.href = url; });
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