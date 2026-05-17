<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<style>
.funfact-wrap{
    background:#f7f7f7;
    border-radius:20px;
    padding:20px;
}

.search-box{
    background:white;
    border-radius:14px;
    padding:14px 20px;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:20px;
}

.search-box input{
    border:none;
    outline:none;
    width:100%;
    font-size:16px;
}

.stat-box{
    background:#12c7cf;
    border-radius:18px;
    padding:22px;
    color:white;
    margin-bottom:20px;
}

.stat-box h2{
    margin:0;
    font-weight:700;
}

.filter-tabs{
    display:flex;
    gap:15px;
    margin-bottom:20px;
}

.filter-btn{
    padding:10px 35px;
    border-radius:12px;
    border:none;
    background:#eee;
    font-weight:600;
    text-decoration:none;
    color:#333;
    display:inline-block;
}

.filter-btn.active{
    background:#12c7cf;
    color:white;
}

.funfact-card{
    background:#eaf7f7;
    border-radius:18px;
    padding:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
    margin-bottom:18px;
}

.funfact-left{
    display:flex;
    gap:18px;
    align-items:center;
    width:75%;
}

.funfact-img{
    width:140px;
    height:90px;
    object-fit:cover;
    border-radius:12px;
}

.funfact-title{
    font-size:26px;
    font-weight:700;
    color:white;
}

.action-group{
    display:flex;
    gap:10px;
}

.btn-action{
    width:46px;
    height:46px;
    border:none;
    border-radius:10px;
    color:white;
    font-size:18px;
}

.btn-view{ background:#1d4ed8; }
.btn-edit{ background:#facc15; color:black; }
.btn-delete{ background:#ef4444; }
.btn-publish{ background:#0891b2; }

.status-text{
    color:#00bcd4;
    font-weight:700;
    margin-top:10px;
}
</style>

<div class="funfact-wrap">
<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold">Kelola Funfact</h1>

        <a href="<?= base_url('admind/funfact/tambah') ?>" class="btn btn-warning px-4 py-2 rounded-pill fw-bold">
            Tambah Funfact
        </a>
    </div>

    <!-- SEARCH -->
   <form method="get" action="<?= base_url('admind/funfact') ?>" class="search-box">
    <input type="hidden" name="status" value="<?= $status ?>">

    🔍
    <input type="text"
           name="keyword"
           value="<?= esc($keyword ?? '') ?>"
           placeholder="Cari funfact disini">
</form>

    <!-- STAT -->
    <div class="stat-box">
        <h2><?= $totalPublish + $totalDraft ?> Funfact Telah Dibuat</h2>
        <small>
            • <?= $totalPublish ?> Funfact telah diunggah
        • <?= $totalDraft ?> Funfact di draft
        </small>
    </div>

    <!-- FILTER -->
    <div class="filter-tabs">

    <a href="<?= base_url('admind/funfact?status=publish') ?>"
       class="filter-btn <?= ($status == 'publish') ? 'active' : '' ?>">
        Terunggah
    </a>

    <a href="<?= base_url('admind/funfact?status=draft') ?>"
       class="filter-btn <?= ($status == 'draft') ? 'active' : '' ?>">
        Draft
    </a>

</div>
    </div>

    <!-- LIST -->
    <?php foreach($funfact as $item): ?>
    <div class="funfact-card">

        <div class="funfact-left">
            <img src="<?= base_url('uploads/funfact/'.$item['gambar_funfact']) ?>"
                 class="funfact-img">

            <div>
                <h4 class="fw-bold mb-1"><?= esc($item['judul_funfact']) ?></h4>

                <p class="text-muted mb-1">
                    <?= character_limiter(strip_tags($item['deskripsi_funfact']), 120) ?>
                </p>

                <small class="text-secondary">
                    <?= date('d M Y', strtotime($item['tanggal_funfact'])) ?>
                </small>
            </div>
        </div>

        <div class="text-end">
            <div class="action-group">

                <a href="<?= base_url('diare-detail/'.$item['id_funfact']) ?>" class="btn-action btn-view d-flex align-items-center justify-content-center text-decoration-none">
                    👁
                </a>

                <a href="<?= base_url('admind/funfact/edit/'.$item['id_funfact']) ?>" class="btn-action btn-edit d-flex align-items-center justify-content-center text-decoration-none">
                    ✏
                </a>

                <a href="<?= base_url('admind/funfact/hapus/'.$item['id_funfact']) ?>" class="btn-action btn-delete d-flex align-items-center justify-content-center text-decoration-none">
                    🗑
                </a>

                <?php if($item['status_funfact'] == 'draft'): ?>
    <a href="<?= base_url('admind/funfact/publish/'.$item['id_funfact']) ?>"
       class="btn-action btn-publish d-flex align-items-center justify-content-center text-decoration-none">
        ⬆
    </a>
<?php else: ?>
    <a href="<?= base_url('admind/funfact/draft/'.$item['id_funfact']) ?>"
       class="btn-action btn-publish d-flex align-items-center justify-content-center text-decoration-none">
        ⬇
    </a>
<?php endif; ?>
                    ⬇
                </a>

            </div>

            <div class="status-text">
                <?= $item['status_funfact'] == 'publish' ? 'Telah Diunggah' : 'Draft' ?>
            </div>
        </div>

    </div>
    <?php endforeach; ?>

</div>

<?= $this->endSection() ?>