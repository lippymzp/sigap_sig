<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php $profil = $profil ?? []; ?>

<style>
/* ==========================================================================
   🎨 READ-ONLY RESULT VIEW MANAGEMENT
   ========================================================================== */
.main-wrapper-view {
    max-width: 850px;
    margin: 10px auto;
    padding: 0 10px;
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
}

/* 1. Header Gradasi */
.view-jumbotron-header {
    background: linear-gradient(135deg, #00BBC2 0%, #00d2da 100%);
    border-radius: 15px;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    color: #ffffff;
    box-shadow: 0 4px 15px rgba(0, 187, 194, 0.15);
}

.view-jumbotron-header .icon-box {
    background: rgba(255, 255, 255, 0.2);
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    backdrop-filter: blur(4px);
}

.view-jumbotron-header .text-box h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
}

.view-jumbotron-header .text-box p {
    margin: 2px 0 0 0;
    font-size: 12px;
    opacity: 0.9;
}





/* 3. Card Konten Utama */
.card-view-body {
    background: #ffffff;
    border-radius: 15px;
    padding: 25px 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
    border: 1px solid #edf2f7;
}

/* Grouping Row Item */
.view-section-group {
    margin-bottom: 25px;
}

/* Header kecil tiap section */
.view-section-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 6px;
}

.view-section-title i {
    color: #00BBC2;
    font-size: 16px;
}

/* Teks Judul Dalam / Subjudul */
.view-subtitle {
    font-size: 13px;
    font-weight: 700;
    color: #4b5563;
    margin-left: 26px; /* Sejajar dengan teks setelah ikon */
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Area Isi Konten */
.view-content-text {
    font-size: 14px;
    color: #4b5563;
    line-height: 1.6;
    margin-left: 26px;
    text-align: justify;
}

/* Gambar Logo Tengah di Profil */
.center-logo-container {
    text-align: center;
    margin: 20px 0;
}
.center-logo-container img {
    max-width: 140px;
    height: auto;
}

/* Garis Pembatas Horisontal Rapi */
.view-divider {
    height: 1px;
    background: #e5e7eb;
    margin: 20px 0 20px 26px;
}

/* Layout Khusus List Filosofi Logo */
.filosofi-view-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-left: 26px;
}

.filosofi-view-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.filosofi-view-item .logo-marker-icon {
    color: #00a3a3;
    font-size: 18px;
    margin-top: 2px;
}

.filosofi-view-item .filosofi-text-box h5 {
    margin: 0 0 4px 0;
    font-size: 14px;
    font-weight: 700;
    color: #111827;
}

.filosofi-view-item .filosofi-text-box p {
    margin: 0;
    font-size: 13px;
    color: #6b7280;
    line-height: 1.5;
}

/* Area Tampilan Maskot */
.maskot-view-container {
    text-align: center;
    margin-top: 15px;
    margin-left: 26px;
}

.maskot-view-container img {
    max-width: 280px;
    height: auto;
}

/* Footer Action Button */
.view-footer-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 30px;
}

.btn-edit-profil {
    background-color: #00BBC2;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 10px 24px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0, 187, 194, 0.2);
    transition: 0.2s;
}

.btn-edit-profil:hover {
    background-color: #009fa5;
    color: #ffffff;
}
</style>

<div class="main-wrapper-view">

    <div class="view-jumbotron-header">
        <div class="icon-box">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div class="text-box">
            <h4>Edit Profil Sistem</h4>
            <p>Menampilkan edit profil sistem</p>
        </div>
    </div>

    <div class="card-view-body">

        <div class="view-section-group">
            <div class="view-section-title">
                <i class="fa-regular fa-circle-user"></i> Profil
            </div>
            <?php if (!empty($profil['profil'])): ?>
                <div class="view-subtitle"><?= htmlspecialchars($profil['profil']) ?></div>
            <?php endif; ?>
            <div class="view-content-text">
                <?= $profil['deskripsi_profil'] ?? 'Belum ada data profil.' ?>
            </div>
            
            <div class="center-logo-container">
                <?php if(!empty($profil['logo'])) : ?>
                    <img src="<?= base_url('uploads/profil_sistem/'.$profil['logo']) ?>" alt="Logo Aplikasi">
                <?php else: ?>
                    <img src="<?= base_url('assets/img/default-logo.png') ?>" alt="Default Logo">
                <?php endif; ?>
            </div>
        </div>

        <div class="view-divider"></div>

        <div class="view-section-group">
            <div class="view-section-title">
                <i class="fa-solid fa-tags"></i> Tagline
            </div>
            <div class="view-content-text" style="font-style: italic; color: #6b7280;">
                <?= !empty($profil['tagline']) ? strip_tags($profil['tagline']) : 'Belum ada tagline.' ?>
            </div>
        </div>

        <div class="view-divider"></div>

        <div class="view-section-group">
            <div class="view-section-title">
                <i class="fa-regular fa-eye"></i> Visi
            </div>
            <div class="view-content-text">
                <?= $profil['isi_visi'] ?? 'Belum ada visi.' ?>
            </div>
        </div>

        <div class="view-divider"></div>

        <div class="view-section-group">
            <div class="view-section-title">
                <i class="fa-solid fa-bullseye"></i> Misi
            </div>
            <div class="view-content-text">
                <?= $profil['isi_misi'] ?? 'Belum ada misi.' ?>
            </div>
        </div>

        <div class="view-divider"></div>

        <div class="view-section-group">
            <div class="view-section-title">
                <i class="fa-solid fa-ban"></i> Filosofi Logo
            </div>
            
<div class="view-grid-filosofi">
    <?php 
    if (!empty($filosofi)): 
        foreach ($filosofi as $item): 
    ?>
        <div class="filosofi-card-item">
            <div class="filosofi-img-box">
                <?php if(!empty($item['komponen_logo'])) : ?>
                    <img src="<?= base_url('uploads/profil_sistem/'.$item['komponen_logo']) ?>" alt="Logo Filosofi">
                <?php else: ?>
                    <img src="<?= base_url('assets/img/default-logo.png') ?>" alt="Default Logo">
                <?php endif; ?>
            </div>
            <div class="filosofi-text-box">
                <h5><?= htmlspecialchars($item['nama_logo'] ?? 'Judul Logo') ?></h5>
                
                <p><?= ($item['deskripsi_logo'] ?? 'Deskripsi filosofi logo.') ?></p>
            </div>
        </div>
    <?php 
        endforeach; 
    else: 
    ?>
        <p class="text-muted font-size-13">Belum ada data filosofi logo.</p>
    <?php endif; ?>
</div>

        </div>

        <div class="view-divider"></div>

        <div class="view-section-group">
            <div class="view-section-title">
                <i class="fa-solid fa-shapes"></i> Maskot
            </div>
            <div class="maskot-view-container">
                <?php if(!empty($profil['maskot'])) : ?>
                    <img src="<?= base_url('uploads/profil_sistem/'.$profil['maskot']) ?>" alt="Maskot Sistem">
                <?php else: ?>
                    <img src="<?= base_url('assets/img/default-maskot.png') ?>" alt="Default Maskot">
                <?php endif; ?>
            </div>
        </div>

        <div class="view-footer-actions">
            <a href="<?= base_url('superadmin/profil_sistem/edit') ?>" class="btn-edit-profil">
                Edit Profil Sistem
            </a>
        </div>

    </div>
</div>

<?= $this->endSection() ?>