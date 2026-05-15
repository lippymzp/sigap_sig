<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<style>

/* ================= HEADER ================= */
.header-profil{
    background: linear-gradient(90deg,#4ca1af,#c4d33c);
    border-radius:20px;
    padding:40px;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
}

/* ================= CARD ================= */
.card-profil{
    background:white;
    border-radius:15px;
    padding:35px;
    margin-top:30px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

/* MOBILE */
@media(max-width:768px){
    .header-profil{
        text-align:center;
        justify-content:center;
        gap:20px;
    }
}

</style>

<div class="container-fluid">

<div class="header-profil">
    <div>
        <h2 class="fw-bold">Profil Sistem</h2>
        <p class="mb-0">Menampilkan informasi sistem</p>
    </div>
</div>

<div class="card-profil">

    <h4 class="text-center mb-4 fw-bold">
        Kelola Profil Sistem
    </h4>

    <div class="row">
        <div class="col-12">
            <h5>Nama Sistem</h5>
            <p class="text-justify"><?= $profil_sistem['nama_sistem'] ?? '-' ?></p>

            <hr>

            <h5>Definisi</h5>
            <p class="text-justify"><?= nl2br($profil_sistem['definisi'] ?? '-') ?></p>

            <hr>

            <h5>Visi</h5>
            <p class="text-justify"><?= nl2br($profil_sistem['isi_visi'] ?? '-') ?></p>

            <hr>

            <h5>Misi</h5>
            <p class="text-justify"><?= nl2br($profil_sistem['isi_misi'] ?? '-') ?></p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-end">
            <a href="<?= base_url('profil_sistem/edit') ?>" class="btn btn-success px-4">
                <i class="fa fa-edit"></i> Edit Profil Sistem
            </a>
        </div>
    </div>

</div>

</div>

<?= $this->endSection() ?>