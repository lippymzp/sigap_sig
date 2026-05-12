<?= $this->extend('layout/main_layout') ?>
<?= $this->section('content') ?>

<style>

.hero-tentang{
    background: linear-gradient(rgba(0,150,136,.85),
                rgba(0,150,136,.85)),
                url("<?= base_url('img/bg-kesehatan.jpg') ?>");
    background-size:cover;
    background-position:center;
    color:white;
    padding:90px 0;
    text-align:center;
}

.section{
    padding:70px 0;
}

.toska{
    color:#009688;
}

.card-custom{
    border:none;
    border-radius:15px;
    box-shadow:0 4px 20px rgba(0,0,0,.08);
}

.logo-profil{
    max-width:200px;
}
/* =============================
   ANIMASI VISI MISI
============================= */

.card-custom{
    border:none;
    border-radius:15px;
    box-shadow:0 4px 20px rgba(0,0,0,.08);
    transition: all .35s ease;
    cursor:pointer;
}

/* hover naik */
.card-custom:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 30px rgba(0,150,136,.25);
}

/* efek goyang */
.goyang{
    animation:goyang 0.4s ease;
}

@keyframes goyang{
    0%{transform:translateX(0)}
    25%{transform:translateX(-6px)}
    50%{transform:translateX(6px)}
    75%{transform:translateX(-4px)}
    100%{transform:translateX(0)}
}
</style>

<!-- HERO -->
<section class="hero-tentang">
    <div class="container">
        <h2 class="fw-bold">Tentang Kami</h2>
        <p><?= $profil['nama_sistem'] ?? 'SIGAP' ?></p>
    </div>
</section>

<!-- PROFIL -->
<section class="section">
<div class="container">

<div class="row align-items-center">

    <div class="col-md-5 text-center">
        <img src="<?= base_url('uploads/logo/'.($profil['logo'] ?? 'default.png')) ?>"
             class="logo-profil mb-3">
    </div>

    <div class="col-md-7">
        <h3 class="fw-bold toska">
            Apa itu <?= $profil['nama_sistem'] ?? '' ?>
        </h3>

        <p class="text-muted">
            <?= $profil['deskripsi'] ?? '' ?>
        </p>
    </div>

</div>

</div>
</section>

<!-- VISI MISI -->
<section class="section bg-light">
<div class="container">

<h3 class="text-center fw-bold toska mb-5">Visi & Misi</h3>

<div class="row">

<div class="col-md-6">
<div class="card card-custom p-4 h-100 klik-card">
<h5 class="fw-bold toska">Visi</h5>
<p><?= $profil['visi'] ?? '' ?></p>
</div>
</div>

<div class="col-md-6">
<div class="card card-custom p-4 h-100 klik-card">
<h5 class="fw-bold toska">Misi</h5>
<p><?= $profil['misi'] ?? '' ?></p>
</div>
</div>

</div>

</div>
</section>
<script>
document.querySelectorAll('.klik-card').forEach(card => {
    card.addEventListener('click', function(){

        this.classList.remove('goyang');

        // reset animasi supaya bisa diklik berkali2
        void this.offsetWidth;

        this.classList.add('goyang');
    });
});
</script>
<?= $this->endSection() ?>