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

.header-profil img{
    width:140px;
}

/* ================= CARD ================= */
.card-profil{
    background:white;
    border-radius:15px;
    padding:35px;
    margin-top:30px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.logo-sistem{
    width:240px;
    max-width:100%;
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

<!-- ================= HEADER ================= -->
<div class="header-profil">

    <div>
        <h2 class="fw-bold">Profil Sistem</h2>
        <p class="mb-0">Menampilkan informasi sistem</p>
    </div>

</div>


<!-- ================= CARD ================= -->
<div class="card-profil">

<h4 class="text-center mb-4 fw-bold">
Kelola Profil Sistem
</h4>

<div class="row align-items-center">

<!-- ================= KIRI ================= -->
<div class="col-md-7">

<h5>Nama Sistem</h5>
<p><?= $profil_sistem['nama_sistem'] ?? '-' ?></p>

<hr>

<h5>Alamat</h5>
<p><?= $profil_sistem['alamat'] ?? '-' ?></p>

<hr>

<h5>Email</h5>
<p><?= $profil_sistem['email'] ?? '-' ?></p>

<hr>

<h5>Instagram</h5>
<p><?= $profil_sistem['instagram'] ?? '-' ?></p>

</div>


<!-- ================= KANAN ================= -->
<div class="col-md-5 text-center">

<?php if(!empty($profil_sistem['logo'])) : ?>

    <img src="<?= base_url('uploads/logo/'.$profil_sistem['logo']) ?>"
         class="logo-sistem mb-3"
         alt="Logo Sistem">

<?php else : ?>

    <!-- LOGO DEFAULT -->
    <img src="<?= base_url('img/logo_default.png') ?>"
         class="logo-sistem mb-3"
         alt="Logo Default">

<?php endif; ?>

<br>

<a href="<?= base_url('profil_sistem/edit') ?>"
class="btn btn-success px-4">
<i class="fa fa-edit"></i> Edit Profil Sistem
</a>

</div>

</div>
</div>

</div>

<?= $this->endSection() ?>