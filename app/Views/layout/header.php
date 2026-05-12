<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SIGAP</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- LEAFLET -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- CUSTOM CSS -->
<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

<style>
.navbar-custom{
    background: white;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    padding: 12px 0;
}

.brand-wrapper{
    display: flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
}

.brand-logo{
    width: 60px;
    height: 60px;
    object-fit: contain;
}

.brand-text{
    line-height: 1.25;
}

.brand-title{
    font-size: 14px;
    font-weight: 700;
    color: #00B7C2;
    margin: 0;
}

.nav-link{
    font-weight: 500;
    color: #222 !important;
    margin-left: 10px;
    transition: 0.3s;
}

.nav-link:hover{
    color: #00CED1 !important;
}

.active-menu{
    color: #00CED1 !important;
    font-weight: 700;
}

.btn-login{
    background: linear-gradient(135deg,#00CED1,#40EDD0);
    color: white !important;
    border-radius: 30px;
    padding: 10px 22px;
    border: none;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.btn-login:hover{
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,206,209,0.3);
}

@media(max-width:991px){

    .brand-logo{
        width: 48px;
        height: 48px;
    }

    .brand-title{
        font-size: 12px;
    }

    .navbar-nav{
        margin-top: 20px;
    }

    .nav-link{
        margin-left: 0;
    }

}
</style>

</head>

<body>

<?php 
$uri = service('uri')->getSegment(1);

$showLoginPages = ['dbd','tbc','pneumonia','diare'];
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">

<div class="container">

    <!-- BRAND -->
    <a href="<?= base_url('/') ?>" class="brand-wrapper">

        <img src="<?= base_url('img/logo_sigap.png') ?>" 
             alt="SIGAP"
             class="brand-logo">

        <div class="brand-text">
            <p class="brand-title">
                Sistem Informasi, Geografis<br>
                Analisis & Pemantauan
            </p>
        </div>

    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler" 
            type="button"
            data-bs-toggle="collapse" 
            data-bs-target="#navMenu">

        <span class="navbar-toggler-icon"></span>

    </button>

    <!-- MENU -->
    <div class="collapse navbar-collapse" id="navMenu">

        <ul class="navbar-nav ms-auto align-items-center">

            <!-- BERANDA -->
            <li class="nav-item">
                <a class="nav-link <?= ($uri == '' ? 'active-menu' : '') ?>" 
                   href="<?= base_url('/') ?>">
                    Beranda
                </a>
            </li>

            <!-- TENTANG -->
            <li class="nav-item">
                <a class="nav-link <?= ($uri == 'tentang-kami' ? 'active-menu' : '') ?>" 
                   href="<?= base_url('tentang-kami') ?>">
                    Tentang Kami
                </a>
            </li>

            <!-- PENYAKIT -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= in_array($uri, $showLoginPages) ? 'active-menu' : '' ?>"
                   href="#"
                   data-bs-toggle="dropdown">

                    Penyakit

                </a>

                <ul class="dropdown-menu shadow border-0">
                    <li><a class="dropdown-item" href="<?= base_url('dbd') ?>">Demam Berdarah</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('tbc') ?>">Tuberkulosis</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('pneumonia') ?>">Pneumonia</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('diare') ?>">Diare</a></li>
                </ul>
            </li>

            <!-- KONTAK -->
            <li class="nav-item">
                <a class="nav-link <?= ($uri == 'kontak' ? 'active-menu' : '') ?>" 
                   href="<?= base_url('kontak') ?>">
                    Kontak
                </a>
            </li>

            <!-- LOGIN -->
            <?php if (in_array($uri, $showLoginPages)): ?>
            <li class="nav-item ms-3">
                <a href="<?= base_url('/login?penyakit=' . ($penyakit ?? '')) ?>" 
                   class="btn-login">
                    Login
                </a>
            </li>
            <?php endif; ?>

        </ul>

    </div>

</div>

</nav>

<!-- SPACING -->
<div style="margin-top:110px;"></div>