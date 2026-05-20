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
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">

<!-- CUSTOM CSS -->
<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

<style>
    
/* HEADER */
.navbar-custom{
    background: #ffffff;
    box-shadow: 0 2px 14px rgba(0,0,0,0.06);
    padding: 10px 0;
    border-bottom: 1px solid #f2f2f2;
}

/* ===== HEADER KHUSUS PNEUMONIA ===== */
.pneu-logo{
    width:240px !important;
    height:auto;
    object-fit:contain;
}



.diare-title{
    font-family:'Baloo 2', cursive !important;
    font-size:56px;
    font-weight:700;
    margin:0;
    line-height:0.8;
    letter-spacing:-1px;

    background: linear-gradient(
        180deg,
        #1d2b44 0%,
        #243554 35%,
        #18cdd5 36%,
        #14b9c7 100%
    );

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
    background-clip:text;

    text-shadow:
        0 2px 4px rgba(0,0,0,0.08);
}



.diare-subtitle{
    font-size:19px;
    font-weight:500;
    color:#1e1e1e;
    margin-top:-2px;
    line-height:1.1;
    letter-spacing:-0.2px;
}



/* navbar lebih figma */
body .navbar-custom{
    padding:12px 0;
    border-top:4px solid #0d5b5b;
}

/* tombol login figma */
body .btn-login{
    background:#14c8d0;
    border-radius:14px;
    padding:12px 34px;
    font-weight:700;
    box-shadow:0 6px 14px rgba(0,0,0,0.12);
}

body .btn-login:hover{
    background:#10b7bf;
    transform:translateY(-2px);
}

/* menu spacing */
body .nav-link{
    font-size:16px;
    font-weight:500;
}
/* BRAND */
.brand-wrapper{
    display: flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
}

/* LOGO */
.brand-logo{
    width: 64px;
    height: 64px;
    object-fit: contain;
    flex-shrink: 0;
}

/* TEXT GROUP */
.brand-text{
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.05;
}

/* SIGAP TITLE */
.brand-name{
    font-size: 34px;
    font-weight: 900;
    margin: 0;
    letter-spacing: 1px;
    font-family: 'Poppins', sans-serif;
    line-height: 1;

    background: linear-gradient(
        to bottom,
        #1b747b 0%,
        #1d929c 18%,
        #12bccf 38%,
        #12a4bb 58%,
        #085b6a 78%,
        #043c47 100%
    );

    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;

    text-shadow:
        0 1px 0 rgba(255,255,255,0.55),
        0 2px 4px rgba(0,150,180,0.12);

    filter: saturate(1.08);
}

/* SUBTITLE */
.brand-subtitle{
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    color: #222;
    line-height: 1.25;
    margin-top: 2px;
}

/* NAV */
.nav-link{
    font-weight: 500;
    color: #222 !important;
    margin-left: 16px;
    transition: 0.3s;
    font-size: 15px;
}

.nav-link:hover{
    color: #00C7D3 !important;
}

.active-menu{
    color: #00C7D3 !important;
    font-weight: 700;
}

/* LOGIN */
.btn-login{
    background: linear-gradient(135deg,#00CED1,#40EDD0);
    color: white !important;
    border-radius: 30px;
    padding: 10px 24px;
    border: none;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.btn-login:hover{
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,206,209,0.3);
}

/* DROPDOWN */
.dropdown-menu{
    border-radius: 14px;
    padding: 10px;
}

.dropdown-item{
    border-radius: 10px;
    padding: 10px 14px;
}

.dropdown-item:hover{
    background: #EFFFFF;
    color: #00BFCF;
}

/* MOBILE */
@media(max-width:991px){

    .brand-logo{
        width: 52px;
        height: 52px;
    }

    .brand-name{
        font-size: 26px;
    }

    .brand-subtitle{
        font-size: 11px;
    }

    .navbar-nav{
        margin-top: 18px;
        align-items: flex-start !important;
    }

    .nav-link{
        margin-left: 0;
        padding: 10px 0;
    }

    .btn-login{
        margin-top: 10px;
    }
/* HEADER DIARE */


/* navbar */
.navbar-custom{
    background:#fff;
    box-shadow:0 2px 14px rgba(0,0,0,0.06);
    padding:8px 0 !important;
    border-bottom:1px solid #f2f2f2;
    border-top:4px solid #0d5b5b;
}

/* login */
.btn-login{
    background:#14c8d0 !important;
    color:white !important;
    border-radius:12px !important;
    padding:10px 28px !important;
    font-weight:700;
    border:none;
    text-decoration:none;
}

/* menu */
.nav-link{
    font-size:15px !important;
    font-weight:500;
}

/* navbar lebih ramping */
.navbar-custom{
    padding:8px 0 !important;
    border-top:4px solid #0d5b5b;
}

/* spacing menu */
.nav-link{
    font-size:15px !important;
}

/* tombol login */
.btn-login{
    padding:10px 24px !important;
    border-radius:14px;
}
/* =========================================
   KHUSUS HEADER DIARE SAJA
========================================= */
<?php if ($isDiarePage): ?>

.navbar-custom{
    padding:8px 0 !important;
}

.navbar-custom .container{
    max-width:1200px;
    align-items:center;
}

.brand-diare{
    display:flex !important;
    align-items:center !important;
    gap:10px !important;
}

.brand-diare .diare-logo{
    width:48px !important;
    height:48px !important;
    object-fit:contain;
    flex-shrink:0;
}

.brand-diare .diagis-text-logo{
    width:180px !important;
    height:auto !important;
    object-fit:contain;
    display:block;
}

.navbar-custom .nav-link{
    font-size:15px !important;
}

.navbar-custom .btn-login{
    padding:10px 26px !important;
    border-radius:12px !important;
}

<?php endif; ?>
}
</style>

</head>

<body>

<?php 
$uri = service('uri')->getSegment(1);

/*
|--------------------------------------------------------------------------
| DETEKSI HALAMAN DIARE
|--------------------------------------------------------------------------
*/
$fullUrl = current_url();

$isDiarePage = in_array($uri, [
    'diare',
    'skrining-diare',
    'hasil-diare',
    'diare-detail',
    'berita'
]) || strpos(current_url(), 'diare') !== false;

$isPneumoniaPage = in_array($uri, [
    'pneumonia',
    'pneumonia-funfact',
    'beritapneumonia/viewUser/(:num)',
    'skrining-pneumonia',
    'skriningpneumonia/skriningpneumonia2',
    'skriningpneumonia/skriningpneumonia3',
    'grafik_pneumonia',
    'hasil-pneumonia'
]) || strpos(current_url(), 'pneumonia') !== false;

/*
|--------------------------------------------------------------------------
| LOGIN PAGES
|--------------------------------------------------------------------------
*/
$showLoginPages = [
    'dbd',
    'tbc',
    'skrining-tbc',
    'hasil',
    'pneumonia',
    'diare',
    'skrining-diare',
    'grafik_pneumonia'
];
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">

<div class="container">

    <a href="<?= base_url('/') ?>" class="brand-wrapper <?= (($penyakit ?? '') == 'diare') ? 'brand-diare' : '' ?>">

   <?php if ($isDiarePage): ?>

    <!-- LOGO DIARE TETAP -->
    <img src="<?= base_url('img/logo_diare.png') ?>" 
         alt="diagis"
         class="brand-logo diare-logo">

    <!-- NAMA DIGANTI GAMBAR -->
    <img src="<?= base_url('img/namaa.png') ?>" 
         alt="Diagis Text"  
         class="diagis-text-logo">

<?php elseif ($isPneumoniaPage): ?>

        <img src="<?= base_url('img/pulmora.png') ?>" 
            alt="Pulmora"
            class="brand-logo pneu-logo">

    <?php else: ?>

        <img src="<?= base_url('img/logo_sigap.png') ?>" 
             alt="SIGAP"
             class="brand-logo">

        <div class="brand-text">
            <h1 class="brand-name">SIGAP</h1>
            <p class="brand-subtitle">
                Sistem Informasi, Geografis Analisis & Pemantauan
            </p>
        </div>

    <?php endif; ?>

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

            <li class="nav-item">
                <a class="nav-link <?= ($uri == '' ? 'active-menu' : '') ?>" href="<?= base_url('/') ?>">
                    Beranda
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($uri == 'tentang-kami' ? 'active-menu' : '') ?>" href="<?= base_url('tentang-kami') ?>">
                    Tentang Kami
                </a>
            </li>

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

            <li class="nav-item">
                <a class="nav-link <?= ($uri == 'kontak' ? 'active-menu' : '') ?>" href="<?= base_url('kontak') ?>">
                    Kontak
                </a>
            </li>

            <?php if (in_array($uri, $showLoginPages)): ?>
            <li class="nav-item ms-3">
                <a href="<?= base_url('/login?penyakit=' . ($penyakit ?? '')) ?>" class="btn-login">
                    Login
                </a>
            </li>
            <?php endif; ?>

        </ul>

    </div>

</div>

</nav>

<div style="margin-top:90px;"></div>
