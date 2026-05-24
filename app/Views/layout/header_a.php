<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>DENGGIS</title>

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

<!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&display=swap" rel="stylesheet">

<!-- CUSTOM CSS -->
<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

<style>

/* BODY */
body{
    overflow-x: hidden;
}

/* HEADER */
.navbar-custom{
    background: #ffffff;
    box-shadow: 0 2px 14px rgba(0,0,0,0.06);
    padding: 12px 0;
    border-bottom: 1px solid #f2f2f2;
    border-top: 4px solid #0d5b5b;
    z-index: 9999;
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

/* TEXT */
.brand-text{
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.05;
}

/* TITLE */
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

/* NAV LINK */
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
    margin-top: 14px;
    background: white;
    position: relative;
    z-index: 9999;
}

.dropdown-item{
    border-radius: 10px;
    padding: 10px 14px;
}

.dropdown-item:hover{
    background: #EFFFFF;
    color: #00BFCF;
}

/* DROPDOWN DESKTOP KLIK */
@media(min-width:992px){

    .navbar .dropdown-menu{
        display: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .navbar .dropdown-menu.show{
        display: block;
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
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

    .dropdown-menu{
        display: none;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }

    .dropdown-menu.show{
        display: block;
    }
}

</style>

</head>

<body>

<?php 
$uri = service('uri')->getSegment(1);

$showLoginPages = [
    'dbd',
    'tbc',
    'pneumonia',
    'diare',
];
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">

<div class="container">

    <!-- BRAND -->
    <a href="<?= base_url('/') ?>" class="brand-wrapper">

        <img src="<?= base_url('img/denggis.png') ?>" 
             alt="DENGGIS"
             class="brand-logo">

        <div class="brand-text">
            <h1 class="brand-name">DENGGIS</h1>

            <p class="brand-subtitle">
                Deteksi Dini, Cegah DBD
            </p>
        </div>

    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navMenu"
            aria-controls="navMenu"
            aria-expanded="false"
            aria-label="Toggle navigation">

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

            <!-- DROPDOWN PENYAKIT -->
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle <?= in_array($uri, $showLoginPages) ? 'active-menu' : '' ?>"
                   href="#"
                   id="penyakitDropdown"
                   role="button"
                   aria-expanded="false">

                    Penyakit

                </a>

                <ul class="dropdown-menu"
                    aria-labelledby="penyakitDropdown">

                    <li>
                        <a class="dropdown-item"
                           href="<?= base_url('dbd') ?>">
                            Demam Berdarah
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="<?= base_url('tbc') ?>">
                            Tuberkulosis
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="<?= base_url('pneumonia') ?>">
                            Pneumonia
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="<?= base_url('diare') ?>">
                            Diare
                        </a>
                    </li>

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

<script>

const dropdownToggle = document.getElementById('penyakitDropdown');
const dropdownMenu = document.querySelector('.dropdown-menu');

dropdownToggle.addEventListener('click', function(e){

    e.preventDefault();

    dropdownMenu.classList.toggle('show');

});

/* klik luar menutup */
document.addEventListener('click', function(e){

    if(
        !dropdownToggle.contains(e.target) &&
        !dropdownMenu.contains(e.target)
    ){
        dropdownMenu.classList.remove('show');
    }

});

</script>