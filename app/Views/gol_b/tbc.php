
<?php helper('text'); ?>
<?php helper(['url', 'text']); ?>

<?php $this->setVar('penyakit', 'tbc'); ?>
<?php
$this->setVar('custom_logo', 'respiora.png');
$this->setVar('show_footer_maskot', true);
$this->setVar('footer_maskot', 'logo_tbc.png');
?>
<?= $this->include('layout/header') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>

    html {
    scroll-behavior: smooth;
}

#artikel,
#skrining-tbc,
#grafik-tbc,
#peta-tbc {
    scroll-margin-top: 110px;
}


body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: #fff;
    color: #1f3a3a;
}

    :root {
        --primary: #40EDD0;
        --dark: #00CED1;
        --medium: #48D1CC;

        --bg: #F4FEFD;
        --card: #E0F7F6;
        --accent: #2CCFC0;
        --border: #B8ECE8;

        --text-dark: #1F3A3A;
        --text-light: #6B8A8A;
    }

    /* GLOBAL */
    body {
        background: var(--bg);
        color: var(--text-dark);
        font-family: 'Poppins', sans-serif !important;

    }

    /* =========================================================
   HERO SECTION
========================================================= */

    .tb-hero {
        position: relative;
        overflow: hidden;

        min-height: 760px;

        display: flex;
        align-items: center;

        background:
            linear-gradient(rgba(11, 170, 190, 0.45),
                rgba(11, 170, 190, 0.45)),
            url('<?= base_url("img/tbc-bg.png") ?>');

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* OVERLAY BLUR */
    .hero-overlay {
        position: absolute;
        inset: 0;

        background:
            radial-gradient(circle at top right,
                rgba(255, 255, 255, .35),
                transparent 30%);

        z-index: 1;
    }

    /* =========================================================
   CONTENT
========================================================= */

    .hero-content-box {
        position: relative;
        z-index: 3;

        max-width: 720px;

        padding-top: 20px;
    }

    .hero-content-box h1 {
        font-size: 45px;
        font-weight: 800;

        color: #fff;

        margin-bottom: 25px;

        text-shadow: 0 5px 18px rgba(0, 0, 0, .18);
    }

    .hero-sub {
        font-size: 30px;
        font-weight: 700;

        color: #fff;

        margin-bottom: 18px;

        text-shadow: 0 4px 10px rgba(0, 0, 0, .15);
    }

    .hero-desc {
        font-size: 20px;
        line-height: 2;

        color: rgba(255, 255, 255, .95);

        margin-bottom: 40px;

        text-shadow: 0 4px 10px rgba(0, 0, 0, .12);
    }

    /* =========================================================
   BUTTON
========================================================= */

    .btn-hero {
        display: inline-flex;
        align-items: center;
        gap: 12px;

        background: linear-gradient(135deg, #1fd6df, #24b8e6);

        color: white !important;

        padding: 15px 28px;

        border-radius: 14px;

        font-size: 17px;
        font-weight: 700;

        text-decoration: none;

        box-shadow:
            0 10px 20px rgba(0, 0, 0, .15),
            inset 0 1px 0 rgba(255, 255, 255, .25);

        transition: .4s ease;
    }

    .btn-hero span {
        font-size: 24px;
        transition: .4s;
    }

    .btn-hero:hover {
        transform: translateY(-6px) scale(1.02);

        box-shadow:
            0 20px 35px rgba(0, 0, 0, .22),
            inset 0 1px 0 rgba(255, 255, 255, .3);
    }

    .btn-hero:hover span {
        transform: translateX(8px);
    }

    /* =========================================================
   WAVE
========================================================= */

    .hero-wave {
        position: absolute;
        bottom: -2px;
        left: 0;

        width: 100%;
        z-index: 2;
    }

    .hero-wave svg {
        display: block;
        width: 100%;
    }

    /* =========================================================
   RESPONSIVE
========================================================= */

    @media(max-width:992px) {

        .tb-hero {
            min-height: auto;
            padding: 130px 0 160px;
            text-align: center;
        }

        .hero-content-box {
            margin: auto;
        }

        .hero-content-box h1 {
            font-size: 58px;
        }

        .hero-sub {
            font-size: 24px;
        }

        .hero-desc {
            font-size: 18px;
            line-height: 1.8;
        }

    }

    @media(max-width:576px) {

        .hero-content-box h1 {
            font-size: 44px;
        }

        .hero-sub {
            font-size: 20px;
        }

        .hero-desc {
            font-size: 16px;
        }

        .btn-hero {
            width: 100%;
            justify-content: center;

            font-size: 18px;
            padding: 18px 25px;
        }

    }

    /* =========================================================
   FITUR SECTION
========================================================= */

    .fitur-section {
        padding: 80px 0 30px;
        background: #f7fbfb;
    }

    /* =========================================================
   TITLE
========================================================= */

    .fitur-title {
        margin-bottom: 45px;
    }

    .fitur-title h2 {
        font-size: 42px;
        font-weight: 800;

        color: #08b4c6;
    }

    /* =========================================================
   FITUR BOX
========================================================= */

    .fitur-box {
        background: linear-gradient(135deg,
                #18c6d1,
                #73dbe4);

        border-radius: 14px;

        height: 92px;

        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;

        padding: 20px;

        color: white;

        font-size: 18px;
        font-weight: 600;

        box-shadow:
            0 8px 20px rgba(0, 0, 0, .08);

        transition: .35s ease;
    }

    /* HOVER */
    .fitur-box:hover {
        transform: translateY(-6px);

        box-shadow:
            0 18px 30px rgba(0, 0, 0, .12);

        color: white;
    }

    /* ICON */
    .fitur-icon {
        font-size: 24px;
    }

    /* =========================================================
   RESPONSIVE
========================================================= */

    @media(max-width:992px) {

        .fitur-title h2 {
            font-size: 34px;
        }

    }

    @media(max-width:576px) {

        .fitur-title h2 {
            font-size: 28px;
        }

        .fitur-box {
            font-size: 16px;
            height: auto;
            min-height: 85px;
        }

    }

    /* =========================================
    INSIGHT SECTION
========================================= */

    .insight-section {
        padding: 90px 0;
        background:
            linear-gradient(180deg,
                #f8ffff 0%,
                #ffffff 100%);
        overflow: hidden;
    }

    .insight-subtitle {
        color: #10B8C7;
        font-weight: 700;
        font-size: 18px;
    }

    .insight-title {
        font-size: 42px;
        font-weight: 800;
        color: #0D5C63;
        margin-top: 10px;
    }

    .insight-desc {
        max-width: 700px;
        margin: auto;
        color: #6b7280;
        margin-top: 15px;
        line-height: 1.8;
    }

    /* =========================================
    SLIDER
========================================= */

    .insight-slider-wrapper {
        position: relative;
    }

    .insight-slider {
        display: flex;
        gap: 25px;
        overflow: hidden;
        scroll-behavior: smooth;
    }

    /* =========================================
    CARD
========================================= */

    .insight-card {
        min-width: 100%;
        background:
            linear-gradient(135deg,
                #10B8C7 0%,
                #88DCE4 100%);

        border-radius: 32px;
        padding: 50px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;

        position: relative;
        overflow: hidden;

        box-shadow:
            0 15px 40px rgba(0, 0, 0, 0.08);

        transition: 0.4s;
    }

    .insight-card:hover {
        transform: translateY(-8px);
    }

    .insight-card::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        top: -120px;
        right: -100px;
    }

    .insight-content {
        flex: 1;
        z-index: 2;
    }

    .insight-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.18);
        color: white;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 14px;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
    }

    .insight-content h3 {
        color: white;
        font-size: 40px;
        font-weight: 800;
        line-height: 1.4;
        margin-bottom: 20px;
    }

    .insight-content p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 17px;
        line-height: 1.9;
        margin-bottom: 25px;
        max-width: 650px;
    }

    .insight-meta {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .insight-meta span {
        color: white;
        font-size: 14px;
    }

    .insight-meta i {
        margin-right: 6px;
    }

    /* =========================================
    BUTTON
========================================= */

    .btn-insight {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: white;
        color: #10B8C7;
        padding: 14px 28px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-insight:hover {
        background: #0D5C63;
        color: white;
        transform: translateX(5px);
    }

    /* =========================================
    IMAGE
========================================= */

    .insight-image {
        width: 420px;
        flex-shrink: 0;
        z-index: 2;
    }

    .insight-image img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 28px;

        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.15);

        transition: 0.4s;
    }

    .insight-card:hover img {
        transform: scale(1.03);
    }

    /* =========================================
    NAVIGATION
========================================= */

    .insight-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);

        width: 62px;
        height: 62px;

        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.95);

        background: linear-gradient(135deg,
                #16C2D5 0%,
                #0EA5B7 100%);

        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 24px;
        cursor: pointer;

        z-index: 20;

        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.15);

        transition: all 0.35s ease;
    }

    .insight-nav:hover {
        transform: translateY(-50%) scale(1.1);

        background: linear-gradient(135deg,
                #0EA5B7 0%,
                #0B8FA0 100%);

        box-shadow:
            0 15px 35px rgba(0, 0, 0, 0.22);
    }

    /* posisi kiri */
    .prevBtn {
        left: -30px;
    }

    /* posisi kanan */
    .nextBtn {
        right: -30px;
    }

    /* =========================================
    DOTS
========================================= */

    .insight-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
    }

    .insight-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #cbd5e1;
        transition: 0.3s;
    }

    .insight-dot.active {
        width: 35px;
        border-radius: 30px;
        background: #10B8C7;
    }

    /* =========================================
    RESPONSIVE
========================================= */

    @media(max-width:992px) {

        .insight-card {
            flex-direction: column;
            text-align: center;
            padding: 35px;
        }

        .insight-content h3 {
            font-size: 28px;
        }

        .insight-image {
            width: 100%;
        }

        .insight-nav {
            display: none;
        }
    }


    /* CTA */
    .btn-teal {
        background: var(--dark);
        color: white;
        border-radius: 30px;
    }

    .btn-teal:hover {
        background: var(--accent);
    }

    .label-desa {
        background: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        padding: 2px 6px;
        font-size: 11px;
        border-radius: 6px;
    }

    .carousel-wrapper {
        position: relative;
    }

.landing-banner {
    position: relative;
    height: 450px;
    overflow: hidden;
    background: #7fc1c9;
}

.banner-slider {
    display: flex;
    height: 100%;
    transition: transform 0.7s ease-in-out;
}

.banner-slide {
    min-width: 100%;
    height: 100%;
}

.banner-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.banner-dots {
    position: absolute;
    left: 50%;
    bottom: 22px;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    z-index: 15;
}

.banner-dot {
    width: 11px;
    height: 11px;
    border: none;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.75);
    cursor: pointer;
    padding: 0;
    box-shadow: 0 5px 14px rgba(0, 0, 0, 0.16);
    transition: all 0.3s ease;
}

.banner-dot.active {
    width: 32px;
    background: #ebebeb;
}

.banner-dot:hover {
    background: #d3d2d2;
    transform: scale(1.08);
}

.platform-section {
    text-align: center;
    padding: 55px 10% 70px;
    background: url('<?= base_url("img/pattern.png") ?>') repeat;
}

.platform-section h2 {
    font-size: 32px;
    font-weight: 800;
    color: #00545b;
    margin-bottom: 42px;
}

.platform-section h2 span {
    color: #00b7bd;
}

.platform-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 32px;
}

.platform-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    width: 225px;
    padding: 22px 20px;
    border-radius: 18px;
    background: #05bfc3;
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 10px 22px rgba(0, 180, 182, 0.25);
    transition: 0.3s;
}

.platform-btn:hover {
    background: #009aa0;
    color: #fff;
    transform: translateY(-4px);
}

.platform-btn i {
    font-size: 25px;
}

/* =========================================
    INSIGHT SECTION - FIGMA STYLE
========================================= */

.insight-section {
    position: relative;
    padding: 72px 0 42px;
    background-color: #ffffff;
    background: url('<?= base_url("img/pattern.png") ?>') repeat;
    background-position: center;
    overflow: hidden;
}

.insight-container {
    width: min(1100px, 92%);
    margin: 0 auto;
}

.insight-heading {
    text-align: center;
    margin-bottom: 28px;
}

.insight-title {
    margin: 0 0 10px;
    color: #004f58;
    font-size: 27px;
    line-height: 1.25;
    font-weight: 800;
    letter-spacing: -0.3px;
}

.insight-desc {
    max-width: 530px;
    margin: 0 auto;
    color: #4c4c4c;
    font-size: 13.5px;
    line-height: 1.65;
    font-weight: 400;
}

.insight-slider-wrapper {
    position: relative;
}

.insight-viewport {
    width: 100%;
    overflow: hidden;
    padding: 2px 0 10px;
}

.insight-slider {
    display: flex;
    gap: 22px;
    transition: transform 0.55s cubic-bezier(.22,.61,.36,1);
    will-change: transform;
}

.insight-card {
    flex: 0 0 calc((100% - 44px) / 3);
    min-height: 316px;
    background: rgba(255,255,255,0.96);
    border: 1px solid #e6e6e6;
    border-radius: 18px;
    padding: 18px 20px;
    box-sizing: border-box;
    box-shadow: 0 8px 22px rgba(0, 80, 90, 0.04);
    display: flex;
    flex-direction: column;
    transition: 0.28s ease;
}

.insight-card:hover {
    transform: translateY(-5px);
    border-color: rgba(0, 191, 174, 0.35);
    box-shadow: 0 16px 34px rgba(0, 80, 90, 0.10);
}

.insight-image {
    width: 100%;
    height: 130px;
    border-radius: 9px;
    overflow: hidden;
    background: #eefafa;
    margin-bottom: 16px;
}

.insight-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: 0.35s ease;
}

.insight-card:hover .insight-image img {
    transform: scale(1.05);
}

.insight-content {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.insight-content h3 {
    margin: 0 0 8px;
    color: #101010;
    font-size: 16px;
    font-weight: 800;
    line-height: 1.35;
}

.insight-text {
    margin: 0;
    color: #555555;
    font-size: 12.5px;
    line-height: 1.65;
    font-weight: 400;
}

.insight-button-area {
    margin-top: auto;
    padding-top: 18px;
}

.btn-insight {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 10px 18px;
    border-radius: 999px;
    background: #00bfae;
    color: #ffffff;
    font-size: 11.5px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 8px 20px rgba(0, 191, 174, 0.22);
    transition: 0.25s ease;
}

.btn-insight i {
    font-size: 11px;
    transition: 0.25s ease;
}

.btn-insight:hover {
    color: #ffffff;
    background: #009f95;
    transform: translateY(-2px);
    box-shadow: 0 12px 26px rgba(0, 191, 174, 0.34);
}

.btn-insight:hover i {
    transform: translateX(4px);
}

.insight-nav {
    position: absolute;
    top: 50%;
    width: 34px;
    height: 34px;
    border: none;
    border-radius: 50%;
    background: #005b61;
    color: #ffffff;
    font-size: 14px;
    cursor: pointer;
    z-index: 20;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 22px rgba(0, 80, 90, 0.22);
    transition: 0.25s ease;
}

.insight-nav:hover {
    background: #00bfae;
    transform: translateY(-50%) scale(1.08);
    box-shadow: 0 14px 30px rgba(0, 191, 174, 0.35);
}

.prevBtn {
    left: -50px;
    transform: translateY(-50%);
}

.nextBtn {
    right: -50px;
    transform: translateY(-50%);
}

.insight-nav.is-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

.insight-dots {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 9px;
    margin-top: 22px;
}

.insight-dot {
    width: 9px;
    height: 9px;
    border: none;
    border-radius: 999px;
    background: rgba(0, 91, 97, 0.22);
    cursor: pointer;
    padding: 0;
    transition: all 0.28s ease;
}

.insight-dot.active {
    width: 28px;
    background: #005b61;
    box-shadow: 0 8px 18px rgba(0, 91, 97, 0.25);
}

.insight-dot:hover {
    background: #00bfae;
    transform: scale(1.12);
}

@media (max-width: 992px) {
    .insight-container {
        width: min(640px, 92%);
    }

    .insight-card {
        flex: 0 0 calc((100% - 22px) / 2);
    }
}

@media (max-width: 576px) {
    .insight-container {
        width: 86%;
    }

    .insight-card {
        flex: 0 0 100%;
    }

    .prevBtn {
        left: -20px;
    }

    .nextBtn {
        right: -20px;
    }

    .insight-title {
        font-size: 24px;
    }
}

/* =========================================
    SKRINING TBC SECTION
========================================= */

.tb-screening-section {
    position: relative;
    padding: 58px 0 70px;
    background: url('<?= base_url("img/pattern.png") ?>') repeat;
    overflow: hidden;
}

.tb-screening-container {
    width: min(1115px, 92%);
    margin: 0 auto;
}

.tb-screening-card {
    position: relative;
    min-height: 345px;
    padding: 52px 42px;
    border-radius: 24px;
    background:
        radial-gradient(circle at 18% 20%, rgba(255, 255, 255, 0.85) 0%, transparent 26%),
        linear-gradient(135deg, #d9fbfb 0%, #bff1f2 48%, #d8fbfb 100%);
    border: 2px solid #00bbc4;
    box-shadow: 0 24px 65px rgba(0, 91, 99, 0.13);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.tb-screening-card::before {
    content: "";
    position: absolute;
    inset: 14px;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.55);
    pointer-events: none;
}

.tb-screening-decoration {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.42);
    filter: blur(1px);
}

.deco-1 {
    width: 170px;
    height: 170px;
    top: -65px;
    left: -45px;
}

.deco-2 {
    width: 210px;
    height: 210px;
    right: -80px;
    bottom: -90px;
}

.tb-screening-icon {
    position: absolute;
    top: 38px;
    left: 50%;
    transform: translateX(-50%);
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #ffffff;
    color: #00aeb8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 31px;
    box-shadow: 0 15px 30px rgba(0, 91, 99, 0.16);
    z-index: 2;
}

.tb-screening-icon span {
    position: absolute;
    right: 10px;
    bottom: 12px;
    width: 19px;
    height: 19px;
    border-radius: 50%;
    background: #00bfae;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    border: 2px solid #ffffff;
}

.tb-screening-content {
    position: relative;
    z-index: 3;
    max-width: 760px;
    margin-top: 38px;
    text-align: center;
}

.tb-screening-label {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
    padding: 7px 16px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.72);
    color: #007c86;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}

.tb-screening-content h2 {
    margin: 0 0 16px;
    color: #00a7b0;
    font-size: 28px;
    line-height: 1.35;
    font-weight: 900;
    letter-spacing: -0.4px;
}

.tb-screening-content p {
    max-width: 730px;
    margin: 0 auto;
    color: #336a70;
    font-size: 16px;
    line-height: 1.85;
    font-weight: 500;
}

.tb-screening-info {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 24px;
}

.tb-info-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 15px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.72);
    color: #006d75;
    font-size: 13px;
    font-weight: 700;
    box-shadow: 0 8px 18px rgba(0, 91, 99, 0.06);
}

.tb-info-item i {
    color: #00bfae;
    font-size: 13px;
}

.tb-screening-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 11px;
    margin-top: 28px;
    padding: 14px 30px;
    border-radius: 999px;
    background: #ffffff;
    color: #009fa8;
    font-size: 15px;
    font-weight: 850;
    text-decoration: none;
    box-shadow: 0 14px 30px rgba(0, 91, 99, 0.13);
    transition: 0.28s ease;
}

.tb-screening-btn i {
    font-size: 14px;
}

.tb-screening-btn .arrow {
    transition: 0.28s ease;
}

.tb-screening-btn:hover {
    color: #ffffff;
    background: linear-gradient(135deg, #00bfae, #00a7c2);
    transform: translateY(-4px);
    box-shadow: 0 20px 42px rgba(0, 191, 174, 0.30);
}

.tb-screening-btn:hover .arrow {
    transform: translateX(5px);
}

@media (max-width: 768px) {
    .tb-screening-card {
        padding: 48px 24px 42px;
        min-height: auto;
    }

    .tb-screening-content h2 {
        font-size: 23px;
    }

    .tb-screening-content p {
        font-size: 14.5px;
    }

    .tb-screening-icon {
        width: 64px;
        height: 64px;
        font-size: 27px;
    }

    .tb-screening-info {
        gap: 9px;
    }
}

@media (max-width: 480px) {
    .tb-screening-section {
        padding: 45px 0 60px;
    }

    .tb-screening-card {
        border-radius: 20px;
        padding: 46px 18px 36px;
    }

    .tb-screening-content h2 {
        font-size: 21px;
    }

    .tb-screening-content p {
        font-size: 14px;
        line-height: 1.75;
    }

    .tb-info-item {
        font-size: 12px;
        padding: 8px 12px;
    }

    .tb-screening-btn {
        width: 100%;
        padding: 14px 18px;
        font-size: 14px;
    }
}

/* =========================================
   ANIMASI SECTION SKRINING TB
========================================= */

/* Kondisi awal sebelum muncul */
.tb-screening-card,
.tb-screening-icon,
.tb-screening-label,
.tb-screening-content h2,
.tb-screening-content p,
.tb-screening-info,
.tb-screening-btn {
    opacity: 0;
}

/* Saat section terlihat */
.tb-screening-section.show-animate .tb-screening-card {
    animation: tbCardEnter 0.9s cubic-bezier(.2,.8,.2,1) forwards;
}

.tb-screening-section.show-animate .tb-screening-icon {
    animation: tbIconEnter 0.8s cubic-bezier(.2,.8,.2,1) 0.25s forwards,
               tbIconFloat 3s ease-in-out 1.2s infinite;
}

.tb-screening-section.show-animate .tb-screening-label {
    animation: tbFadeDown 0.7s ease 0.45s forwards;
}

.tb-screening-section.show-animate .tb-screening-content h2 {
    animation: tbFadeUp 0.8s ease 0.6s forwards;
}

.tb-screening-section.show-animate .tb-screening-content p {
    animation: tbFadeUp 0.8s ease 0.78s forwards;
}

.tb-screening-section.show-animate .tb-screening-info {
    animation: tbFadeUp 0.8s ease 0.95s forwards;
}

.tb-screening-section.show-animate .tb-screening-btn {
    animation: tbFadeUp 0.8s ease 1.12s forwards,
               tbButtonPulse 2.6s ease-in-out 2s infinite;
}

/* Card masuk halus */
@keyframes tbCardEnter {
    from {
        opacity: 0;
        transform: translateY(45px) scale(0.96);
        filter: blur(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
    }
}

/* Icon muncul dari atas */
@keyframes tbIconEnter {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(-25px) scale(0.5) rotate(-10deg);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0) scale(1) rotate(0);
    }
}

/* Icon mengambang */
@keyframes tbIconFloat {
    0%, 100% {
        transform: translateX(-50%) translateY(0);
    }
    50% {
        transform: translateX(-50%) translateY(-8px);
    }
}

@keyframes tbFadeDown {
    from {
        opacity: 0;
        transform: translateY(-16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes tbFadeUp {
    from {
        opacity: 0;
        transform: translateY(22px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Tombol bernafas halus */
@keyframes tbButtonPulse {
    0%, 100% {
        box-shadow: 0 14px 30px rgba(0, 91, 99, 0.13);
        transform: translateY(0);
    }
    50% {
        box-shadow: 0 18px 40px rgba(0, 191, 174, 0.28);
        transform: translateY(-3px);
    }
}

/* Efek gradient bergerak di card */
.tb-screening-card {
    background-size: 200% 200%;
}

.tb-screening-section.show-animate .tb-screening-card {
    animation-name: tbCardEnter, tbGradientMove;
    animation-duration: 0.9s, 8s;
    animation-delay: 0s, 1s;
    animation-timing-function: cubic-bezier(.2,.8,.2,1), ease-in-out;
    animation-fill-mode: forwards, none;
    animation-iteration-count: 1, infinite;
}

@keyframes tbGradientMove {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

/* Hover profesional */
.tb-screening-card {
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.tb-screening-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 32px 75px rgba(0, 91, 99, 0.18);
}

.tb-info-item {
    transition: 0.28s ease;
}

.tb-info-item:hover {
    transform: translateY(-4px);
    background: rgba(255, 255, 255, 0.95);
}

.tb-screening-btn {
    position: relative;
    overflow: hidden;
}

.tb-screening-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -90%;
    width: 60%;
    height: 100%;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,0.55),
        transparent
    );
    transform: skewX(-20deg);
    transition: 0.65s ease;
}

.tb-screening-btn:hover::before {
    left: 130%;
}

.tb-screening-btn:hover {
    transform: translateY(-5px);
}

/* =========================================================
   PREMIUM TBC CHART SECTION
========================================================= */

.tbc-chart-section {
    position: relative;
    padding: 86px 0 96px;
    background:
        radial-gradient(circle at 12% 20%, rgba(0, 191, 174, 0.10), transparent 28%),
        radial-gradient(circle at 90% 78%, rgba(0, 174, 191, 0.12), transparent 30%),
        linear-gradient(180deg, #ffffff 0%, #f2fbfc 100%);
    overflow: hidden;
}

.tbc-chart-section::before {
    content: "";
    position: absolute;
    width: 520px;
    height: 520px;
    left: -260px;
    top: 80px;
    border-radius: 50%;
    background: rgba(0, 191, 174, 0.08);
    filter: blur(4px);
}

.tbc-chart-section::after {
    content: "";
    position: absolute;
    width: 430px;
    height: 430px;
    right: -220px;
    bottom: -140px;
    border-radius: 50%;
    background: rgba(0, 174, 191, 0.10);
    filter: blur(4px);
}

.tbc-chart-container {
    position: relative;
    z-index: 2;
    width: min(1050px, 92%);
    margin: 0 auto;
}

.tbc-chart-hero {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 28px;
    margin-bottom: 26px;
}

.tbc-chart-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 16px;
    border-radius: 999px;
    background: rgba(0, 191, 174, 0.13);
    color: #008a93;
    font-size: 12px;
    font-weight: 850;
    margin-bottom: 14px;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
}

.tbc-chart-hero h2 {
    margin: 0;
    color: #00aeb8;
    font-size: 35px;
    line-height: 1.2;
    font-weight: 950;
    letter-spacing: -0.8px;
}

.tbc-chart-hero p {
    margin: 10px 0 0;
    max-width: 590px;
    color: #52636b;
    font-size: 15px;
    line-height: 1.75;
}

.tbc-chart-filter {
    min-width: 245px;
}

.tbc-chart-filter label {
    display: block;
    margin-bottom: 9px;
    color: #005b61;
    font-size: 13px;
    font-weight: 850;
}

.tbc-year-control {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px;
    border-radius: 999px;
    background: rgba(255,255,255,0.85);
    border: 1px solid rgba(0, 191, 174, 0.18);
    box-shadow: 0 18px 40px rgba(0, 82, 91, 0.10);
    backdrop-filter: blur(10px);
}

.tbc-year-control select {
    width: 118px;
    border: none;
    outline: none;
    padding: 11px 14px;
    border-radius: 999px;
    background: #f4fbfc;
    color: #005b61;
    font-size: 15px;
    font-weight: 900;
    cursor: pointer;
}

.tbc-year-control button {
    border: none;
    padding: 11px 18px;
    border-radius: 999px;
    background: linear-gradient(135deg, #00bfae, #00aebf);
    color: #ffffff;
    font-size: 13px;
    font-weight: 850;
    cursor: pointer;
    box-shadow: 0 12px 24px rgba(0, 191, 174, 0.25);
    transition: 0.25s ease;
}

.tbc-year-control button:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 30px rgba(0, 191, 174, 0.36);
}

.tbc-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 22px;
}

.tbc-stat-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 18px;
    border-radius: 22px;
    background: rgba(255,255,255,0.86);
    border: 1px solid rgba(0, 130, 140, 0.14);
    box-shadow: 0 16px 38px rgba(0, 82, 91, 0.07);
    transition: 0.28s ease;
}

.tbc-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 22px 48px rgba(0, 82, 91, 0.12);
}

.tbc-stat-card.main {
    background: linear-gradient(135deg, #e4fbfb, #ffffff);
    border-color: rgba(0, 191, 174, 0.25);
}

.tbc-stat-icon {
    width: 46px;
    height: 46px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #00bfae, #00aebf);
    color: #fff;
    font-size: 17px;
    box-shadow: 0 12px 24px rgba(0, 191, 174, 0.22);
    flex: 0 0 auto;
}

.tbc-stat-card span {
    display: block;
    color: #64748b;
    font-size: 12px;
    font-weight: 750;
    margin-bottom: 3px;
}

.tbc-stat-card strong {
    color: #005b61;
    font-size: 28px;
    line-height: 1;
    font-weight: 950;
}

.tbc-chart-card {
    position: relative;
    padding: 28px 28px 32px;
    border-radius: 28px;
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(0, 130, 140, 0.18);
    box-shadow: 0 28px 70px rgba(0, 82, 91, 0.11);
    overflow: hidden;
}

.tbc-chart-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
        linear-gradient(135deg, rgba(255,255,255,0.65), transparent 38%),
        radial-gradient(circle at 86% 12%, rgba(0, 191, 174, 0.10), transparent 24%);
    pointer-events: none;
}

.tbc-chart-card-header {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 22px;
}

.tbc-chart-small-label {
    display: inline-flex;
    margin-bottom: 8px;
    padding: 6px 12px;
    border-radius: 999px;
    background: rgba(0, 191, 174, 0.10);
    color: #008a93;
    font-size: 11px;
    font-weight: 850;
}

.tbc-chart-card-header h3 {
    margin: 0;
    color: #12232d;
    font-size: 21px;
    font-weight: 950;
    letter-spacing: -0.3px;
}

.tbc-chart-card-header p {
    margin: 7px 0 0;
    color: #64748b;
    font-size: 13px;
    line-height: 1.6;
}

.tbc-chart-status {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    border-radius: 999px;
    background: #f2fbfc;
    color: #005b61;
    font-size: 12px;
    font-weight: 850;
    white-space: nowrap;
    border: 1px solid rgba(0, 191, 174, 0.15);
}

.tbc-chart-status span {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #00bfae;
    box-shadow: 0 0 0 6px rgba(0, 191, 174, 0.12);
}

.tbc-chart-canvas {
    position: relative;
    z-index: 2;
    height: 410px;
}

@media (max-width: 992px) {
    .tbc-chart-hero {
        flex-direction: column;
        align-items: flex-start;
    }

    .tbc-chart-filter {

        width: 100%;
    }

    .tbc-year-control {
        width: 100%;
    }

    .tbc-year-control select {
        flex: 1;
        width: auto;
    }

    .tbc-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .tbc-chart-section {
        padding: 60px 0 72px;
    }

    .tbc-chart-hero h2 {
        font-size: 27px;
    }

    .tbc-stats-grid {
        grid-template-columns: 1fr;
    }

    .tbc-chart-card {
        padding: 22px 18px 26px;
        border-radius: 22px;
    }

    .tbc-chart-card-header {
        flex-direction: column;
    }

    .tbc-chart-canvas {
        height: 330px;
    }
}
/* =========================================================
   PREMIUM MAP SECTION TBC
========================================================= */

.tbc-map-section {
    position: relative;
    display: block;
    clear: both;
    padding: 88px 0 105px;
    background:
        radial-gradient(circle at 12% 20%, rgba(0, 191, 174, 0.13), transparent 28%),
        radial-gradient(circle at 88% 74%, rgba(0, 174, 191, 0.14), transparent 30%),
        linear-gradient(180deg, #f3fbfc 0%, #ffffff 100%);
    overflow: hidden;
}

.tbc-map-section::before {
    content: "";
    position: absolute;
    width: 520px;
    height: 520px;
    left: -260px;
    top: 80px;
    border-radius: 50%;
    background: rgba(0, 191, 174, 0.08);
    filter: blur(4px);
}

.tbc-map-section::after {
    content: "";
    position: absolute;
    width: 430px;
    height: 430px;
    right: -220px;
    bottom: -140px;
    border-radius: 50%;
    background: rgba(0, 174, 191, 0.10);
    filter: blur(4px);
}

.tbc-map-container {
    width: min(1050px, 92%);
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.tbc-map-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 28px;
    margin-bottom: 28px;
}

.tbc-map-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 16px;
    border-radius: 999px;
    background: rgba(0, 191, 174, 0.13);
    color: #008a93;
    font-size: 12px;
    font-weight: 850;
    margin-bottom: 14px;
}

.tbc-map-header h2 {
    margin: 0;
    color: #00aeb8;
    font-size: 35px;
    line-height: 1.2;
    font-weight: 950;
    letter-spacing: -0.8px;
}

.tbc-map-header p {
    margin: 10px 0 0;
    max-width: 610px;
    color: #52636b;
    font-size: 15px;
    line-height: 1.75;
}

.tbc-map-summary {
    min-width: 165px;
    padding: 18px 20px;
    border-radius: 22px;
    background: linear-gradient(135deg, #e4fbfb, #ffffff);
    border: 1px solid rgba(0, 191, 174, 0.22);
    text-align: center;
    box-shadow: 0 18px 40px rgba(0, 82, 91, 0.08);
}

.tbc-map-summary span {
    display: block;
    color: #64748b;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 6px;
}

.tbc-map-summary strong {
    color: #005b61;
    font-size: 32px;
    font-weight: 950;
}

.tbc-map-card {
    position: relative;
    padding: 28px;
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.94);
    border: 1px solid rgba(0, 130, 140, 0.18);
    box-shadow: 0 30px 75px rgba(0, 82, 91, 0.12);
    overflow: hidden;
}

.tbc-map-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
        linear-gradient(135deg, rgba(255,255,255,0.62), transparent 40%),
        radial-gradient(circle at 88% 10%, rgba(0, 191, 174, 0.10), transparent 24%);
    pointer-events: none;
}

.tbc-map-top {
    position: relative;
    z-index: 2;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    margin-bottom: 20px;
}

.tbc-map-top h3 {
    margin: 0;
    color: #12232d;
    font-size: 22px;
    font-weight: 950;
}

.tbc-map-top p {
    margin: 7px 0 0;
    color: #64748b;
    font-size: 13px;
    line-height: 1.6;
}

.tbc-map-year {
    display: inline-flex;
    padding: 10px 15px;
    border-radius: 999px;
    background: #f2fbfc;
    color: #005b61;
    font-size: 12px;
    font-weight: 850;
    border: 1px solid rgba(0, 191, 174, 0.15);
    white-space: nowrap;
}

#mapTbc {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 480px;
    min-height: 480px;
    border-radius: 24px;
    overflow: hidden;
    border: 1px solid rgba(0, 130, 140, 0.16);
    box-shadow:
        inset 0 0 0 1px rgba(255,255,255,0.45),
        0 18px 45px rgba(0, 82, 91, 0.08);
}

.leaflet-container {
    font-family: 'Poppins', sans-serif;
}

.leaflet-popup-content-wrapper {
    border-radius: 20px;
    box-shadow: 0 20px 55px rgba(0, 82, 91, 0.20);
    overflow: hidden;
}

.leaflet-popup-content {
    margin: 0;
}

.map-popup-tbc {
    width: 250px;
    padding: 17px;
    background: #ffffff;
}

.map-popup-tbc .popup-badge {
    display: inline-flex;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 850;
    margin-bottom: 10px;
}

.map-popup-tbc h4 {
    margin: 0 0 10px;
    color: #12232d;
    font-size: 17px;
    font-weight: 950;
}

.map-popup-row {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 8px 0;
    border-bottom: 1px solid #eef2f7;
    color: #475569;
    font-size: 13px;
}

.map-popup-row:last-child {
    border-bottom: none;
}

.map-popup-row strong {
    color: #005b61;
    font-weight: 900;
}

.map-label-wilayah {
    color: #123;
    font-size: 12px;
    font-weight: 850;
    text-shadow:
        0 1px 0 #fff,
        0 -1px 0 #fff,
        1px 0 0 #fff,
        -1px 0 0 #fff;
    white-space: nowrap;
}

.custom-map-legend {
    background: rgba(255,255,255,0.94);
    padding: 12px 14px;
    border-radius: 16px;
    box-shadow: 0 14px 34px rgba(0, 82, 91, 0.18);
    border: 1px solid rgba(0, 130, 140, 0.12);
    font-family: 'Poppins', sans-serif;
    min-width: 170px;
}

.custom-map-legend h4 {
    margin: 0 0 9px;
    color: #12232d;
    font-size: 13px;
    font-weight: 950;
}

.custom-map-legend div {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 7px 0;
    color: #334155;
    font-size: 12px;
    font-weight: 700;
}

.custom-map-legend i {
    width: 17px;
    height: 17px;
    display: inline-block;
    border-radius: 5px;
}

.mouse-coords-premium {
    background: rgba(255,255,255,0.92);
    padding: 8px 11px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 82, 91, 0.16);
    border: 1px solid rgba(0, 130, 140, 0.12);
    color: #334155;
    font-size: 12px;
    font-weight: 800;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .tbc-map-header,
    .tbc-map-top {
        flex-direction: column;
        align-items: flex-start;
    }

    .tbc-map-summary {
        width: 100%;
    }

    .tbc-map-header h2 {
        font-size: 27px;
    }

    .tbc-map-card {
        padding: 20px;
        border-radius: 24px;
    }

    #mapTbc {
        height: 370px;
        min-height: 370px;
    }
}

/* =========================================================
   PUBLIC FRIENDLY SUMMARY SECTION
========================================================= */

.public-summary-section {
    position: relative;
    padding: 85px 0 100px;
    background:
    url('<?= base_url("img/pattern.png") ?>') repeat,
        radial-gradient(circle at 14% 18%, rgba(0, 191, 174, 0.11), transparent 30%),
        radial-gradient(circle at 86% 70%, rgba(0, 174, 191, 0.13), transparent 32%),
        linear-gradient(180deg, #ffffff 0%, #f0fbfc 50%, #ffffff 100%);
    overflow: hidden;
}

.public-summary-container {
    width: min(1080px, 92%);
    margin: 0 auto;
}

.public-summary-card {
    position: relative;
    display: grid;
    grid-template-columns: 1.35fr 0.8fr;
    gap: 34px;
    padding: 48px;
    border-radius: 32px;
    background:
        linear-gradient(135deg, rgba(223, 255, 255, 0.92), rgba(190, 246, 247, 0.88)),
        radial-gradient(circle at 18% 18%, rgba(255,255,255,0.95), transparent 34%);
    border: 2px solid rgba(0, 188, 201, 0.75);
    box-shadow:
        0 32px 85px rgba(0, 82, 91, 0.15),
        inset 0 1px 0 rgba(255,255,255,0.72);
    overflow: hidden;
}

.public-summary-card::before {
    content: "";
    position: absolute;
    inset: 15px;
    border-radius: 25px;
    border: 1px solid rgba(255,255,255,0.58);
    pointer-events: none;
}

.summary-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(3px);
    pointer-events: none;
}

.summary-glow-1 {
    width: 230px;
    height: 230px;
    top: -90px;
    left: -70px;
    background: rgba(255,255,255,0.50);
}

.summary-glow-2 {
    width: 310px;
    height: 310px;
    right: -130px;
    bottom: -130px;
    background: rgba(0, 191, 174, 0.14);
}

.public-summary-left,
.public-summary-right {
    position: relative;
    z-index: 3;
}

.public-summary-badge {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 9px 16px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.76);
    color: #007c86;
    font-size: 12px;
    font-weight: 900;
    margin-bottom: 15px;
    box-shadow: 0 12px 26px rgba(0, 82, 91, 0.06);
}

.public-summary-left h2 {
    margin: 0;
    color: #00aeb8;
    font-size: 34px;
    line-height: 1.2;
    font-weight: 950;
    letter-spacing: -0.7px;
}

.summary-lead {
    max-width: 690px;
    margin: 14px 0 24px;
    color: #315e64;
    font-size: 15.5px;
    line-height: 1.85;
    font-weight: 500;
}

.summary-lead strong {
    color: #004f58;
    font-weight: 950;
}

.summary-highlight {
    display: grid;
    grid-template-columns: 58px 1fr;
    gap: 17px;
    align-items: center;
    padding: 20px;
    border-radius: 24px;
    background: rgba(255,255,255,0.74);
    border: 1px solid rgba(0, 191, 174, 0.16);
    box-shadow: 0 16px 36px rgba(0, 82, 91, 0.08);
    margin-bottom: 20px;
}

.highlight-icon {
    width: 58px;
    height: 58px;
    border-radius: 20px;
    background: linear-gradient(135deg, #00bfae, #00aebf);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    box-shadow: 0 16px 30px rgba(0, 191, 174, 0.25);
}

.summary-highlight span {
    display: block;
    color: #64748b;
    font-size: 12px;
    font-weight: 850;
    margin-bottom: 4px;
}

.summary-highlight h3 {
    margin: 0;
    color: #004f58;
    font-size: 27px;
    font-weight: 950;
}

.summary-highlight p {
    margin: 5px 0 0;
    color: #52636b;
    font-size: 14px;
}

.summary-highlight strong {
    color: #00a3ac;
    font-weight: 950;
}

.summary-insight-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}

.summary-insight-item {
    padding: 18px;
    border-radius: 22px;
    background: rgba(255,255,255,0.72);
    border: 1px solid rgba(0, 191, 174, 0.14);
    box-shadow: 0 14px 30px rgba(0, 82, 91, 0.06);
    transition: 0.28s ease;
}

.summary-insight-item:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 42px rgba(0, 82, 91, 0.12);
}

.insight-icon {
    width: 42px;
    height: 42px;
    margin-bottom: 12px;
    border-radius: 15px;
    background: rgba(0, 191, 174, 0.12);
    color: #00aeb8;
    display: flex;
    align-items: center;
    justify-content: center;
}

.summary-insight-item span {
    display: block;
    color: #64748b;
    font-size: 11.5px;
    font-weight: 850;
    margin-bottom: 5px;
}

.summary-insight-item strong {
    display: block;
    color: #005b61;
    font-size: 25px;
    font-weight: 950;
    line-height: 1.15;
}

.summary-insight-item strong.text-long {
    font-size: 18px;
}

.summary-insight-item small {
    display: block;
    margin-top: 4px;
    color: #64748b;
    font-size: 11.5px;
    font-weight: 700;
}

.summary-message-box {
    display: grid;
    grid-template-columns: 38px 1fr;
    gap: 12px;
    align-items: flex-start;
    padding: 16px 18px;
    border-radius: 20px;
    background: rgba(0, 91, 99, 0.08);
    border: 1px solid rgba(0, 91, 99, 0.10);
}

.summary-message-box i {
    width: 38px;
    height: 38px;
    border-radius: 14px;
    background: rgba(255,255,255,0.72);
    color: #00aeb8;
    display: flex;
    align-items: center;
    justify-content: center;
}

.summary-message-box p {
    margin: 0;
    color: #315e64;
    font-size: 14px;
    line-height: 1.7;
    font-weight: 600;
}

.public-summary-right {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 22px;
}

.community-illustration {
    position: relative;
    width: 320px;
    height: 255px;
    opacity: 0.82;
}

.sun-orbit {
    position: absolute;
    width: 210px;
    height: 210px;
    right: 26px;
    top: 18px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255,255,255,0.72), rgba(0,191,174,0.10));
    animation: pulseSummary 4s ease-in-out infinite;
}

@keyframes pulseSummary {
    0%, 100% {
        transform: scale(1);
        opacity: 0.7;
    }
    50% {
        transform: scale(1.08);
        opacity: 1;
    }
}

.building {
    position: absolute;
    bottom: 72px;
    border-radius: 16px 16px 5px 5px;
    background: linear-gradient(180deg, rgba(0, 174, 191, 0.38), rgba(0, 174, 191, 0.14));
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.45);
}

.building-a {
    width: 58px;
    height: 128px;
    left: 58px;
}

.building-b {
    width: 78px;
    height: 166px;
    left: 124px;
    background: linear-gradient(180deg, rgba(0, 191, 174, 0.40), rgba(0, 191, 174, 0.14));
}

.building-c {
    width: 48px;
    height: 108px;
    left: 210px;
}

.building::before {
    content: "";
    position: absolute;
    width: 18px;
    height: 45px;
    left: 50%;
    bottom: 0;
    transform: translateX(-50%);
    border-radius: 10px 10px 0 0;
    background: rgba(255,255,255,0.50);
}

.health-pin {
    position: absolute;
    top: 28px;
    right: 68px;
    width: 62px;
    height: 62px;
    border-radius: 50% 50% 50% 12px;
    transform: rotate(-45deg);
    background: linear-gradient(135deg, #00bfae, #00aebf);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 18px 38px rgba(0, 191, 174, 0.30);
}

.health-pin i {
    transform: rotate(45deg);
    color: #fff;
    font-size: 23px;
}

.road-shape {
    position: absolute;
    left: 28px;
    right: 18px;
    bottom: 38px;
    height: 64px;
    border-radius: 50%;
    background: rgba(0,174,191,0.15);
    box-shadow: inset 0 0 0 9px rgba(255,255,255,0.28);
}

.tree {
    position: absolute;
    bottom: 84px;
    width: 32px;
    height: 58px;
    border-radius: 20px 20px 9px 9px;
    background: rgba(0,191,174,0.30);
}

.tree-a {
    right: 28px;
}

.tree-b {
    right: 78px;
    bottom: 75px;
    transform: scale(0.82);
}

.person {
    position: absolute;
    bottom: 58px;
    width: 18px;
    height: 35px;
    border-radius: 999px;
    background: rgba(0, 91, 99, 0.22);
}

.person::before {
    content: "";
    position: absolute;
    top: -13px;
    left: 50%;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    transform: translateX(-50%);
    background: rgba(0, 91, 99, 0.26);
}

.person-1 {
    left: 70px;
}

.person-2 {
    left: 238px;
    transform: scale(0.88);
}

.summary-year-card {
    width: 210px;
    padding: 19px 20px;
    border-radius: 24px;
    text-align: center;
    background: rgba(255,255,255,0.78);
    border: 1px solid rgba(0, 191, 174, 0.18);
    box-shadow: 0 18px 40px rgba(0, 82, 91, 0.08);
}

.summary-year-card span {
    display: block;
    color: #64748b;
    font-size: 12px;
    font-weight: 850;
    margin-bottom: 6px;
}

.summary-year-card strong {
    color: #005b61;
    font-size: 31px;
    font-weight: 950;
}

@media (max-width: 980px) {
    .public-summary-card {
        grid-template-columns: 1fr;
        padding: 38px 30px;
    }

    .public-summary-right {
        display: none;
    }
}

@media (max-width: 700px) {
    .summary-insight-grid {
        grid-template-columns: 1fr;
    }

    .summary-highlight {
        grid-template-columns: 1fr;
    }

    .public-summary-left h2 {
        font-size: 28px;

        z-index: 10;
    }

    .left {
        left: -10px;
    }

    .right {
        right: -10px;
    }

    /* =========================================
    GEJALA SECTION
========================================= */

    .gejala-section {
        padding: 5px 0 55px;
        background: #f8ffff;
    }

    .gejala-box {
        background: linear-gradient(135deg,
                #D4F3F4 0%,
                #BFECEF 100%);

        border: 2px solid #0DB5C1;

        border-radius: 28px;

        padding: 38px 50px;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;

        transition: 0.35s;
    }

    .gejala-box:hover {
        transform: translateY(-4px);

        box-shadow:
            0 12px 30px rgba(0, 0, 0, 0.08);
    }

    /* =========================================
    CONTENT
========================================= */

    .gejala-content h2 {
        font-size: 34px;
        font-weight: 800;
        color: #08AFBC;
        margin-bottom: 18px;
    }

    .gejala-content p {
        font-size: 18px;
        color: #1496A0;
        line-height: 1.9;
        max-width: 690px;
        margin-bottom: 0;
    }

    .gejala-content span {
        color: #ff2b2b;
        font-weight: 800;
    }

    /* =========================================
    BUTTON
========================================= */

    .gejala-btn {
        width: 76px;
        height: 76px;

        border-radius: 50%;

        background: linear-gradient(135deg,
                #16C7D8 0%,
                #0EA8B8 100%);

        border: 7px solid rgba(255, 255, 255, 0.95);

        display: flex;
        align-items: center;
        justify-content: center;

        color: white;
        font-size: 30px;
        font-weight: 700;

        text-decoration: none;

        flex-shrink: 0;

        transition: 0.35s;

        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .gejala-btn:hover {
        transform: scale(1.08);

        color: white;

        box-shadow:
            0 14px 35px rgba(0, 0, 0, 0.18);
    }

    .gejala-btn i {
        transform: translateX(2px);
    }

    /* =========================================
    RESPONSIVE
========================================= */

    @media(max-width:992px) {

        .gejala-box {
            flex-direction: column;
            text-align: center;
            padding: 30px;
        }

        .gejala-content h2 {
            font-size: 28px;
        }

        .gejala-content p {
            font-size: 16px;
        }

        .gejala-btn {
            width: 68px;
            height: 68px;
            font-size: 24px;
        }
    }

    /* =========================================
    SECTION GLOBAL
========================================= */

    .grafik-section,
    .peta-section {
        padding: 80px 0;
        background: #DDF2F2;
    }

    .peta-section {
        padding-top: 20px;
    }

    .section-header h2 {
        font-size: 58px;
        font-weight: 800;
        color: #08AFBC;
        margin-bottom: 10px;
    }

    .section-header p {
        color: #5f6b6b;
        font-size: 18px;
    }

    /* =========================================
    CARD
========================================= */

    .grafik-card,
    .peta-card {
        background: white;

        border-radius: 32px;

        min-height: 520px;

        padding: 40px;

        box-shadow:
            0 10px 35px rgba(0, 0, 0, 0.05);
    }

    /* =========================================
    EMPTY STATE
========================================= */

    .empty-box {
        width: 100%;
        height: 440px;

        border: 3px dashed #B9DADA;
        border-radius: 25px;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        text-align: center;
    }

    .empty-box i {
        font-size: 70px;
        color: #0DB5C1;
        margin-bottom: 25px;
    }

    .empty-box h4 {
        font-size: 30px;
        font-weight: 700;
        color: #10939D;
        margin-bottom: 10px;
    }

    .empty-box p {
        color: #7d8b8b;
        font-size: 17px;
    }

    /* =========================================
    RESPONSIVE
========================================= */

    @media(max-width:992px) {

        .gejala-box {
            flex-direction: column;
            text-align: center;
            padding: 35px;
        }

        .gejala-content h2 {
            font-size: 38px;
        }

        .gejala-content p {
            font-size: 18px;
        }

        .section-header h2 {
            font-size: 38px;
        }

        .grafik-card,
        .peta-card {
            min-height: 380px;
        }

        .empty-box {
            height: 300px;
        }
    }

    /* =========================================
    RINGKASAN SECTION
========================================= */

    .ringkasan-section {
        padding: 50px 0 90px;
        background: #f6f6f6;
    }

    /* =========================================
    CARD
========================================= */

    .ringkasan-card {

        position: relative;

        background: linear-gradient(90deg,
                #C8EEF0 0%,
                #BFEAEC 45%,
                #D7F7F8 100%);

        border: 2px solid #05B7C6;

        border-radius: 26px;

        min-height: 280px;

        padding: 45px 48px;

        overflow: hidden;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 30px;

        transition: 0.35s ease;
    }

    .ringkasan-card:hover {
        transform: translateY(-4px);

        box-shadow:
            0 18px 40px rgba(0, 0, 0, 0.08);
    }

    /* =========================================
    CONTENT
========================================= */

    .ringkasan-content {
        position: relative;
        z-index: 2;
        width: 65%;
    }

    .ringkasan-content h2 {

        color: #03AEBE;

        font-size: 50px;
        font-weight: 800;

        margin-bottom: 28px;
    }

    .ringkasan-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .ringkasan-list p {

        margin: 0;

        color: #4C5557;

        font-size: 18px;
        line-height: 1.8;

        font-weight: 500;
    }

    .ringkasan-list span {

        color: #FF0000;
        font-weight: 800;
    }

    /* =========================================
    IMAGE
========================================= */

    .ringkasan-image {

        position: absolute;

        right: 20px;
        bottom: 0;

        width: 540px;

        opacity: 0.8;

        pointer-events: none;
    }

    .ringkasan-image img {
        width: 100%;
        object-fit: contain;
    }

    /* =========================================
    RESPONSIVE
========================================= */

    @media(max-width:992px) {

        .ringkasan-card {
            padding: 35px 28px;
        }

        .ringkasan-content {
            width: 100%;
        }

        .ringkasan-content h2 {
            font-size: 34px;
        }

        .ringkasan-list p {
            font-size: 16px;
        }

        .ringkasan-image {
            display: none;
        }
    }

    #rora-chatbot {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        font-family: 'Poppins', sans-serif;
    }

    #rora-icon img {
        width: 60px;
        cursor: pointer;
        border-radius: 50%;
        transition: transform 0.2s;
    }

    #rora-icon img:hover {
        transform: scale(1.1);
    }

    #rora-box {
        width: 320px;
        max-height: 450px;
        background: linear-gradient(to bottom, #00c4cc, #00a5b5);
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    #rora-header {
        display: flex;
        align-items: center;
        padding: 10px;
        background: #00a5b5;
        color: #fff;
        position: relative;
    }

    #rora-header img {
        width: 40px;
        margin-right: 10px;
    }

    #rora-header button {
        position: absolute;
        right: 10px;
        top: 10px;
        border: none;
        background: transparent;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    #rora-messages {
        flex: 1;
        padding: 10px;
        overflow-y: auto;
    }

    .rora-msg-bot,
    .rora-msg-user {
        margin-bottom: 10px;
        padding: 6px 10px;
        border-radius: 10px;
        max-width: 80%;
        display: flex;
        align-items: center;
    }

    .rora-msg-bot img {
        width: 30px;
        margin-right: 6px;
    }

    .rora-msg-bot {
        background: #ffffff30;
        color: #fff;
        margin-right: auto;
    }

    .rora-msg-user {
        background: #00fff2;
        color: #000;
        margin-left: auto;
        text-align: right;
    }

    #rora-input {
        display: flex;
        padding: 5px;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    #rora-input input {
        flex: 1;
        padding: 6px;
        border-radius: 20px;
        border: none;
        outline: none;
    }

    #rora-input button {
        background: transparent;
        border: none;
        cursor: pointer;
        margin-left: 5px;
    }

    .tbc-logo {
        width: 300px;
        height: auto;
    }

    @keyframes shake {
    0% { transform: rotate(0deg) translateX(0); }
    10% { transform: rotate(-15deg) translateX(-2px); }
    20% { transform: rotate(15deg) translateX(2px); }
    30% { transform: rotate(-10deg) translateX(-2px); }
    40% { transform: rotate(10deg) translateX(2px); }
    50% { transform: rotate(-5deg) translateX(-1px); }
    60% { transform: rotate(5deg) translateX(1px); }
    70% { transform: rotate(-2deg) translateX(0); }
    80% { transform: rotate(2deg) translateX(0); }
    90% { transform: rotate(1deg) translateX(0); }
    100% { transform: rotate(0deg) translateX(0); }
    }
}

@media (max-width: 576px) {
    .public-summary-section {
        padding: 62px 0 78px;
    }

    .public-summary-card {
        padding: 28px 20px;
        border-radius: 24px;
    }

    .summary-lead,
    .summary-message-box p {
        font-size: 13.5px;
    }

    .summary-highlight h3 {
        font-size: 23px;
    }
}

/* =========================================================
   BERITA & INFORMASI TBC
========================================================= */

.tbc-news-section {
    position: relative;
    padding: 90px 0 105px;
    background:
        url('<?= base_url("img/pattern.png") ?>') repeat,
        radial-gradient(circle at 12% 20%, rgba(0, 191, 174, 0.08), transparent 30%),
        radial-gradient(circle at 88% 70%, rgba(0, 174, 191, 0.10), transparent 32%),
        linear-gradient(180deg, #ffffff 0%, #f7ffff 100%);
    overflow: hidden;
}

.tbc-news-container {
    width: min(1080px, 92%);
    margin: 0 auto;
    display: grid;
    grid-template-columns: 0.85fr 1.6fr;
    gap: 54px;
    align-items: center;
}

.tbc-news-left {
    position: relative;
}

.news-source-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 190px;
    padding: 13px 25px;
    border-radius: 999px 999px 999px 20px;
    background: linear-gradient(135deg, #00bfae, #00aebf);
    color: #ffffff;
    font-size: 18px;
    font-weight: 850;
    box-shadow: 0 18px 38px rgba(0, 191, 174, 0.25);
    margin-bottom: 28px;
}

.tbc-news-left h2 {
    margin: 0;
    color: #004f58;
    font-size: 33px;
    line-height: 1.32;
    font-weight: 950;
    letter-spacing: -0.5px;
}

.tbc-news-left p {
    margin: 20px 0 0;
    color: #4f5f67;
    font-size: 16px;
    line-height: 1.75;
    max-width: 360px;
    font-weight: 500;
}

.tbc-news-right {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 34px;
    align-items: end;
}

/* FIX BERITA SLIDER RESPONSIVE */
.tbc-news-right {
    position: relative;
    min-width: 0;
    overflow: hidden;
}

.tbc-news-viewport {
    width: 100%;
    overflow: hidden;
    padding: 8px 2px 18px;
}

.tbc-news-track {
    display: flex;
    gap: 34px;
    transition: transform 0.65s cubic-bezier(.22,.61,.36,1);
    will-change: transform;

}

.tbc-news-card {
    flex: 0 0 calc((100% - 68px) / 3);
    min-width: 0;
    display: flex;
    flex-direction: column;
}

.news-card-text {
    height: 112px;
    min-height: 112px;
    margin-bottom: 16px;
}

.news-card-text h3 {
    min-height: 72px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card-text span {
    margin-top: 4px;
}

.news-image-wrap {
    height: 142px;
    flex-shrink: 0;
}

@media (max-width: 992px) {
    .tbc-news-container {
        grid-template-columns: 1fr;
        gap: 38px;
    }

    .tbc-news-left p {
        max-width: 600px;
    }

    .tbc-news-card {
        flex: 0 0 calc((100% - 34px) / 2);
    }
}

@media (max-width: 768px) {
    .tbc-news-card {
        flex: 0 0 100%;
    }

    .news-card-text {
        height: auto;
        min-height: 96px;
    }

    .news-image-wrap {
        height: 210px;
    }

    .tbc-news-left h2 {
        font-size: 28px;
    }
}
.tbc-news-viewport {
    width: 100%;
    overflow: hidden;
    padding: 8px 2px 18px;
}

.tbc-news-track {
    display: flex;
    gap: 34px;
    transition: transform 0.65s cubic-bezier(.22,.61,.36,1);
    will-change: transform;
}

.tbc-news-card {
    position: relative;
    flex: 0 0 calc((100% - 68px) / 3);
}

.tbc-news-nav {
    position: absolute;
    top: 63%;
    transform: translateY(-50%);
    width: 42px;
    height: 42px;
    border: none;
    border-radius: 50%;
    background: #ffffff;
    color: #00aeb8;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    box-shadow: 0 14px 32px rgba(0, 82, 91, 0.16);
    transition: 0.28s ease;
}

.tbc-news-nav:hover {
    background: #00bfae;
    color: #ffffff;
    transform: translateY(-50%) scale(1.08);
}

.newsPrevBtn {
    left: -22px;
}

.newsNextBtn {
    right: -22px;
}

.tbc-news-nav.is-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

.tbc-news-viewport {
    width: 100%;
    overflow: hidden;
    padding: 8px 2px 18px;
}

.tbc-news-track {
    display: flex;
    gap: 34px;
    transition: transform 0.65s cubic-bezier(.22,.61,.36,1);
    will-change: transform;
}

.tbc-news-card {
    position: relative;
    flex: 0 0 calc((100% - 68px) / 3);
}

.tbc-news-card {
    position: relative;
}

.news-card-text {
    margin-bottom: 20px;
}

.news-card-text h3 {
    margin: 0 0 14px;
    color: #111827;
    font-size: 18px;
    line-height: 1.35;
    font-weight: 900;
}

.news-card-text span {
    display: block;
    color: #5f6368;
    font-size: 14px;
    font-weight: 500;
}

.news-image-wrap {
    position: relative;
    display: block;
    height: 142px;
    border-radius: 16px;
    overflow: hidden;
    background: #e7f8f8;
    box-shadow: 0 20px 42px rgba(0, 82, 91, 0.12);
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-decoration: none;
    transition: transform 0.3s ease, filter 0.3s ease;
}

.news-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.45s ease;
}

.news-image-overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(180deg, rgba(0,0,0,0.08) 0%, rgba(0, 82, 91, 0.45) 100%);
    opacity: 0.75;
    transition: 0.3s ease;
}

.news-category {
    position: absolute;
    top: 18px;
    right: 18px;
    color: #ffffff;
    font-size: 12px;
    font-weight: 800;
    z-index: 2;
}

.news-arrow {
    position: absolute;
    left: 22px;
    bottom: 20px;
    width: 43px;
    height: 43px;
    border-radius: 50%;
    background: rgba(255,255,255,0.92);
    color: #00aeb8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    z-index: 2;
    box-shadow: 0 12px 26px rgba(0, 82, 91, 0.16);
    transition: 0.3s ease;
}

.tbc-news-card:hover .news-image-wrap {
    transform: translateY(-8px);
    box-shadow: 0 30px 56px rgba(0, 82, 91, 0.18);
    box-shadow: 0 12px 26px rgba(0, 82, 91, 0.06) !important;
    filter: brightness(1.03);
}

.tbc-news-card:hover .news-image-wrap img {
    transform: scale(1.08);
}

.tbc-news-card:hover .news-image-overlay {
    opacity: 0.92;
}

.tbc-news-card:hover .news-arrow {
    background: #00bfae;
    color: #ffffff;
    transform: rotate(-35deg) scale(1.08);
}

.news-empty-state {
    grid-column: 1 / -1;
    padding: 44px 30px;
    border-radius: 26px;
    background: rgba(255,255,255,0.88);
    border: 1px dashed rgba(0, 191, 174, 0.35);
    text-align: center;
    color: #52636b;
}

.news-empty-state i {
    font-size: 38px;
    color: #00aeb8;
    margin-bottom: 14px;
}

.news-empty-state h3 {
    margin: 0 0 8px;
    color: #004f58;
    font-size: 22px;
    font-weight: 900;
}

.news-empty-state p {
    margin: 0;
    font-size: 14px;
}

@media (max-width: 992px) {
    .tbc-news-container {
        grid-template-columns: 1fr;
        gap: 38px;
    }

    .tbc-news-left p {
        max-width: 600px;
    }

    #rora-header {
        display: flex;
        align-items: center;
        padding: 10px;
        background: #00a5b5;
        color: #fff;
        position: relative;
    }

    #rora-header img {
        width: 40px;
        margin-right: 10px;
    }

    #rora-header button {
        position: absolute;
        right: 10px;
        top: 10px;
        border: none;
        background: transparent;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    #rora-messages {
        flex: 1;
        padding: 10px;
        overflow-y: auto;
    }

    .rora-msg-bot,
    .rora-msg-user {
        margin-bottom: 10px;
        padding: 6px 10px;
        border-radius: 10px;
        max-width: 80%;
        display: flex;
        align-items: center;
    }

    .rora-msg-bot img {
        width: 30px;
        margin-right: 6px;
    }

    .rora-msg-bot {
        background: #ffffff30;
        color: #fff;
        margin-right: auto;
    }

    .rora-msg-user {
        background: #00fff2;
        color: #000;
        margin-left: auto;
        text-align: right;
    }

    #rora-input {
        display: flex;
        padding: 5px;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    #rora-input input {
        flex: 1;
        padding: 6px;
        border-radius: 20px;
        border: none;
        outline: none;
    }

    #rora-input button {
        background: transparent;
        border: none;
        cursor: pointer;
        margin-left: 5px;
    }

    .tbc-logo {
        width: 300px;
        height: auto;
    }

}



    .news-image-wrap {
        height: 210px;
    }

    .tbc-news-left h2 {
        font-size: 28px;
    }

    .tbc-logo {
        width: 250px;
        height: auto;
    }
    
    @keyframes shake {
    0% { transform: rotate(0deg) translateX(0); }
    10% { transform: rotate(-15deg) translateX(-2px); }
    20% { transform: rotate(15deg) translateX(2px); }
    30% { transform: rotate(-10deg) translateX(-2px); }
    40% { transform: rotate(10deg) translateX(2px); }
    50% { transform: rotate(-5deg) translateX(-1px); }
    60% { transform: rotate(5deg) translateX(1px); }
    70% { transform: rotate(-2deg) translateX(0); }
    80% { transform: rotate(2deg) translateX(0); }
    90% { transform: rotate(1deg) translateX(0); }
    100% { transform: rotate(0deg) translateX(0); }
}

.chatbot-animate {
    animation: shake 1.5s infinite;
    transform-origin: center bottom;
}
@media (max-width: 768px) {
    .tbc-news-right {
        grid-template-columns: 1fr;
        gap: 28px;
    }

    .news-image-wrap {
        height: 210px;
    }

    .tbc-news-left h2 {
        font-size: 28px;
    }

</style>

<section class="landing-banner">
    <div class="banner-slider" id="bannerSlider">
        <?php foreach ($slider_images as $index => $img): ?>

.chatbot-animate {
    animation: shake 4s infinite;
    transform-origin: center bottom;
}


@media (max-width: 992px) {
    .tbc-news-card {
        flex: 0 0 calc((100% - 34px) / 2);
    }
}

@media (max-width: 768px) {
    .tbc-news-card {
        flex: 0 0 100%;
    } 
}

</style>

<?php $slider_images = [
    base_url('img/banner1.png'),
    base_url('img/banner2.png'),
    base_url('img/banner3.png'),
]; ?>

<section class="landing-banner">
    <div class="banner-slider" id="bannerSlider">
        <?php foreach ($slider_images as $img): ?>

            <div class="banner-slide">
                <img src="<?= esc($img) ?>" alt="Banner">
            </div>
        <?php endforeach; ?>
    </div>

    <div class="banner-dots" id="bannerDots">
        <?php foreach ($slider_images as $index => $img): ?>
            <button type="button" class="banner-dot <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>"></button>
        <?php endforeach; ?>
    </div>

</section>

<section class="platform-section">
    <h2><span>Platform Pemetaan</span> Tuberkulosis <span>Berbasis Data.</span></h2>

    <div class="platform-buttons">
        <a href="<?= base_url('peta') ?>" class="platform-btn">
            <i class="fa fa-map"></i>
            <span>Peta Sebaran</span>
        </a>

        <a href="<?= base_url('grafik') ?>" class="platform-btn">
            <i class="fa fa-chart-line"></i>
            <span>Grafik Kasus</span>
        </a>

        <a href="<?= base_url('artikel') ?>" class="platform-btn">
            <i class="fa fa-book"></i>
            <span>Artikel Kesehatan</span>
        </a>

        <a href="<?= base_url('skrining') ?>" class="platform-btn">
            <i class="fa fa-file-alt"></i>
            <span>Skrining TB</span>
        </a>
    </div>

    <a href="#peta-tbc" class="platform-btn">
        <i class="fa fa-map"></i>
        <span>Peta Sebaran</span>
    </a>

    <a href="#grafik-tbc" class="platform-btn">
        <i class="fa fa-chart-line"></i>
        <span>Grafik Kasus</span>
    </a>

    <a href="#artikel" class="platform-btn">
        <i class="fa fa-book"></i>
        <span>Artikel Kesehatan</span>
    </a>

    <a href="#skrining-tbc" class="platform-btn">
        <i class="fa fa-file-alt"></i>
        <span>Skrining TB</span>
    </a>
</div>
</section>

<!-- =========================================
    INSIGHT / ARTIKEL - FIGMA STYLE
========================================= -->

<?php
$cleanText = static function ($value) {
    return trim(html_entity_decode(strip_tags((string) $value), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
};

$getImageUrl = static function ($gambar) {
    $gambar = trim((string) $gambar);

    if ($gambar === '') {
        return base_url('img/default-funfact.png');
    }

    if (filter_var($gambar, FILTER_VALIDATE_URL)) {
        return $gambar;
    }

    if (strpos($gambar, '/') !== false) {
        return base_url($gambar);
    }

    return base_url('img/' . $gambar);
};
?>

<section id="artikel" class="insight-section">
    <div class="insight-container">

        <div class="insight-heading">
            <h2 class="insight-title">Telusuri Informasi Berikut</h2>

            <p class="insight-desc">
                Dapatkan informasi kesehatan terpercaya, edukatif dan mudah
                dipahami untuk meningkatkan kesadaran masyarakat.
            </p>
        </div>

        <div class="insight-slider-wrapper">

            <!-- BUTTON LEFT -->

            <button type="button" class="insight-nav prevBtn" id="funfactPrev" aria-label="Sebelumnya">
                <i class="fas fa-arrow-left"></i>
            </button>

            <div class="insight-viewport">

                <div class="insight-slider" id="insightSlider">

                    <?php if (!empty($funfact)): ?>
                        <?php foreach ($funfact as $item): ?>

                            <?php
                                $judul = $cleanText($item['judul_funfact'] ?? 'Informasi TBC');
                                $deskripsi = $cleanText($item['deskripsi_funfact'] ?? $item['isi_funfact'] ?? '');
                                $gambarUrl = $getImageUrl($item['gambar_funfact'] ?? '');
                            ?>

                            <article class="insight-card">

                                <div class="insight-image">
                                    <img src="<?= esc($gambarUrl) ?>" alt="<?= esc($judul) ?>">
                                </div>

                                <div class="insight-content">

                                    <h3>
                                        <?= esc(character_limiter($judul, 34, '...')) ?>
                                    </h3>

                                    <p class="insight-text">
                                        <?= esc(character_limiter($deskripsi, 94, '...')) ?>
                                    </p>

                                    <div class="insight-button-area">
                                        <a href="<?= base_url('tbc/detail_funfact/' . $item['id_funfact']) ?>" class="btn-insight">
                                            Selengkapnya
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>

                                </div>

                            </article>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="empty-box">
                            <i class="fas fa-info-circle"></i>
                            <h4>Data Funfact TBC Belum Tersedia</h4>
                            <p>Informasi akan ditampilkan setelah data ditambahkan.</p>
                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <!-- BUTTON RIGHT -->
            <button type="button" class="insight-nav nextBtn" id="funfactNext" aria-label="Selanjutnya">
                <i class="fas fa-arrow-right"></i>
            </button>

        </div>

    </div>
</section>
                    <?php if (!empty($funfact)): ?>
                        <?php foreach ($funfact as $item): ?>

                            <?php
                                $judul = $cleanText($item['judul_funfact'] ?? 'Informasi TBC');
                                $deskripsi = $cleanText($item['deskripsi_funfact'] ?? $item['isi_funfact'] ?? '');
                                $gambarUrl = $getImageUrl($item['gambar_funfact'] ?? '');
                            ?>

                            <article class="insight-card">
                                <div class="insight-image">
                                    <img src="<?= esc($gambarUrl) ?>" alt="<?= esc($judul) ?>">
                                </div>

                                <div class="insight-content">
                                    <h3>
                                        <?= esc(character_limiter($judul, 34, '...')) ?>
                                    </h3>

                                    <p class="insight-text">
                                        <?= esc(character_limiter($deskripsi, 94, '...')) ?>
                                    </p>

                                    <div class="insight-button-area">
                                        <a href="<?= base_url('tbc/detail_funfact/' . $item['id_funfact']) ?>" class="btn-insight">
                                            Selengkapnya
                                            <i class="fas fa-arrow-right"></i>
                                        </a>

                                        <?php
$linkArtikel = trim($item['url'] ?? '');

if ($linkArtikel === '') {
    $linkArtikel = '#';
} elseif (!filter_var($linkArtikel, FILTER_VALIDATE_URL)) {
    $linkArtikel = base_url($linkArtikel);
}
?>

<a href="<?= esc($linkArtikel) ?>" class="btn-insight" target="_blank" rel="noopener">
    Selengkapnya
    <i class="fas fa-arrow-right"></i>
</a>

                                    </div>
                                </div>
                            </article>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-box">
                            <i class="fas fa-info-circle"></i>
                            <h4>Data Funfact TBC Belum Tersedia</h4>
                            <p>Informasi akan ditampilkan setelah data ditambahkan.</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

<div class="insight-dots" id="insightDots"></div>
            <button type="button" class="insight-nav nextBtn" id="funfactNext" aria-label="Selanjutnya">
                <i class="fas fa-arrow-right"></i>
            </button>

        </div>
    </div>
</section>


<!-- =========================================
    SKRINING TBC SECTION
========================================= -->

<section class="tb-screening-section">

<section class="tb-screening-section" id="skrining-tbc">

    <div class="tb-screening-container">

        <div class="tb-screening-card">

            <div class="tb-screening-decoration deco-1"></div>
            <div class="tb-screening-decoration deco-2"></div>

            <div class="tb-screening-icon">
                <i class="fas fa-lungs"></i>
                <span>
                    <i class="fas fa-check"></i>
                </span>
            </div>

            <div class="tb-screening-content">
                <span class="tb-screening-label">Skrining Mandiri Tuberkulosis</span>

                <h2>
                    Sudahkah Anda Mengenali Risiko Gejala Tuberkulosis Sejak Dini?
                </h2>

                <p>
                    Lakukan skrining TBC secara mandiri untuk membantu mengenali potensi gejala,
                    meningkatkan kewaspadaan, dan mendukung pencegahan penularan sejak awal.
                </p>

                <div class="tb-screening-info">
                    <div class="tb-info-item">
                        <i class="fas fa-clock"></i>
                        <span>Cepat & mudah</span>
                    </div>

                    <div class="tb-info-item">
                        <i class="fas fa-shield-heart"></i>
                        <span>Edukasi kesehatan</span>
                    </div>

                    <div class="tb-info-item">
                        <i class="fas fa-user-check"></i>
                        <span>Mandiri</span>
                    </div>
                </div>

                <a href="<?= base_url('skrining-tbc') ?>" class="tb-screening-btn">
                    <i class="fas fa-stethoscope"></i>
                    Mulai Skrining TBC
                    <i class="fas fa-arrow-right arrow"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- =========================================
    GRAFIK TUBERKULOSIS SECTION
========================================= -->
<?php
$kasusData = $grafikTbc['kasus'] ?? [];
$totalKasus = (int) ($totalKasusTbc ?? 0);

$bulanAdaData = 0;
foreach ($kasusData as $nilai) {
    if ((int) $nilai > 0) {
        $bulanAdaData++;
    }
}

$rataRataKasus = $bulanAdaData > 0 ? round($totalKasus / $bulanAdaData, 1) : 0;
$kasusTertinggi = !empty($kasusData) ? max($kasusData) : 0;
?>

<section class="tbc-chart-section" id="grafik-tbc">
    <div class="tbc-chart-container">

        <div class="tbc-chart-hero">
            <div class="tbc-chart-hero-content">


                <h2>Grafik Kasus Tuberkulosis</h2>

                <p>
                    Visualisasi jumlah kasus Tuberkulosis berdasarkan bulan kunjungan pasien
                    pada tahun yang dipilih.
                </p>
            </div>

            <form action="<?= base_url('tbc') ?>" method="get" class="tbc-chart-filter">
    <label for="tahun">Pilih Tahun</label>

    <div class="tbc-year-control">
        <select name="tahun" id="tahun">
            <?php if (!empty($tahunTersedia)): ?>
                <?php foreach ($tahunTersedia as $tahun): ?>
                    <option value="<?= esc($tahun) ?>" <?= ((int) $tahun === (int) $tahunAktif) ? 'selected' : '' ?>>
                        <?= esc($tahun) ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
            <?php endif; ?>
        </select>

        <button type="submit">Tampilkan</button>
    </div>
</form>
        </div>

        <div class="tbc-stats-grid">
            <div class="tbc-stat-card main">
                <div class="tbc-stat-icon">
                    <i class="fas fa-virus"></i>
                </div>
                <div>
                    <span>Total Kasus</span>
                    <strong><?= esc($totalKasus) ?></strong>
                </div>
            </div>

            <div class="tbc-stat-card">
                <div class="tbc-stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <span> Bulan Terisi </span>
                    <strong><?= esc($bulanAdaData) ?></strong>
                </div>
            </div>

            <div class="tbc-stat-card">
                <div class="tbc-stat-icon">
                    <i class="fas fa-arrow-trend-up"></i>
                </div>
                <div>
                    <span>Kasus Tertinggi</span>
                    <strong><?= esc($kasusTertinggi) ?></strong>
                </div>
            </div>

            <div class="tbc-stat-card">
                <div class="tbc-stat-icon">
                    <i class="fas fa-chart-simple"></i>
                </div>
                <div>
                    <span>Rata-rata</span>
                    <strong><?= esc($rataRataKasus) ?></strong>
                </div>
            </div>
        </div>

        <div class="tbc-chart-card">
            <div class="tbc-chart-card-header">
                <div>
                    <span class="tbc-chart-small-label">Tahun <?= esc($tahunAktif ?? date('Y')) ?></span>
                    <h3>Jumlah Kasus Tuberkulosis per Bulan</h3>
                </div>

                <div class="tbc-chart-status">
                    <span></span>
                    Data Aktual
                </div>
            </div>

            <div class="tbc-chart-canvas">
                <canvas id="tbcMonthlyChart"></canvas>
            </div>
        </div>

    </div>
</section>

<!-- =========================================
    PETA TUBERKULOSIS SECTION
========================================= -->
<section class="tbc-map-section" id="peta-tbc">
    <div class="tbc-map-container">

        <div class="tbc-map-header">
            <div>

                <h2>Peta Sebaran Kasus Tuberkulosis</h2>

                <p>
                    Visualisasi persebaran kasus TBC berdasarkan wilayah pasien
                    pada tahun <?= esc($tahunAktif ?? date('Y')) ?>.
                </p>
            </div>

            <div class="tbc-map-summary">
                <span>Wilayah Terdampak</span>
                <strong><?= esc($totalWilayahTerdampak ?? 0) ?></strong>
            </div>
        </div>

        <div class="tbc-map-card">
            <div class="tbc-map-top">
                <div>
                    <h3>Peta Interaktif Penyebaran</h3>
                    <p>Warna wilayah ditentukan berdasarkan interval kasus rendah, sedang, dan tinggi.</p>
                </div>

                <div class="tbc-map-year">
                    Tahun <?= esc($tahunAktif ?? date('Y')) ?>
                </div>
            </div>

            <div id="mapTbc"></div>
        </div>

    </div>
</section>


<!-- =========================================
    RINGKASAN DATA SECTION
========================================= -->
<?php
$wilayahTertinggi = $ringkasanTbc['wilayah_tertinggi'] ?? null;
$kecamatanTertinggi = $ringkasanTbc['kecamatan_tertinggi'] ?? null;

$namaWilayahTertinggi = $wilayahTertinggi['kelurahan'] ?? 'Belum ada data';
$kasusWilayahTertinggi = $wilayahTertinggi['kasus'] ?? 0;

$namaKecamatanTertinggi = $kecamatanTertinggi['kecamatan'] ?? 'Belum ada data';
$totalKecamatanTertinggi = $kecamatanTertinggi['total_kasus'] ?? 0;

$rataRataPerWilayah = $ringkasanTbc['rata_rata_per_wilayah'] ?? 0;
$rataRataKecamatanTertinggi = $ringkasanTbc['rata_rata_kecamatan_tertinggi'] ?? 0;
$jumlahWilayahTerdampak = $ringkasanTbc['jumlah_wilayah_terdampak'] ?? 0;
?>

<section class="public-summary-section" id="ringkasan-tbc">
    <div class="public-summary-container">

        <div class="public-summary-card">

            <div class="summary-glow summary-glow-1"></div>
            <div class="summary-glow summary-glow-2"></div>

            <div class="public-summary-left">
                <span class="public-summary-badge">
                    <i class="fas fa-clipboard-check"></i>
                    Ringkasan Data TBC
                </span>

                <h2>Ringkasan Situasi Tuberkulosis</h2>

                <p class="summary-lead">
                    Informasi berikut merangkum wilayah dengan kasus Tuberkulosis tertinggi,
                    rata-rata kasus, dan area yang perlu mendapatkan perhatian lebih pada tahun
                    <strong><?= esc($tahunAktif ?? date('Y')) ?></strong>.
                </p>

                <div class="summary-highlight">
                    <div class="highlight-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>

                    <div>
                        <span>Wilayah dengan kasus tertinggi</span>
                        <h3><?= esc($namaWilayahTertinggi) ?></h3>
                        <p>
                            Tercatat sebanyak <strong><?= esc($kasusWilayahTertinggi) ?> kasus</strong>
                            pada tahun <?= esc($tahunAktif ?? date('Y')) ?>.
                        </p>
                    </div>
                </div>

                <div class="summary-insight-grid">
                    <div class="summary-insight-item">
                        <div class="insight-icon">
                            <i class="fas fa-map"></i>
                        </div>
                        <span>Wilayah Terdampak</span>
                        <strong><?= esc($jumlahWilayahTerdampak) ?></strong>
                        <small>desa/kelurahan</small>
                    </div>

                    <div class="summary-insight-item">
                        <div class="insight-icon">
                            <i class="fas fa-chart-simple"></i>
                        </div>
                        <span>Rata-rata Kasus</span>
                        <strong><?= esc($rataRataPerWilayah) ?></strong>
                        <small>per wilayah</small>
                    </div>

                    <div class="summary-insight-item">
                        <div class="insight-icon">
                            <i class="fas fa-city"></i>
                        </div>
                        <span>Kecamatan</span>
                        <strong class="text-long"><?= esc($namaKecamatanTertinggi) ?></strong>
                        <small><?= esc($totalKecamatanTertinggi) ?> kasus</small>
                    </div>
                </div>

                <div class="summary-message-box">
                    <i class="fas fa-circle-info"></i>
                    <p>
                        Data ini dapat membantu masyarakat dan petugas kesehatan untuk memahami
                        area prioritas pemantauan, edukasi, dan pencegahan Tuberkulosis.
                    </p>
                </div>
            </div>

            <div class="public-summary-right">
                <div class="community-illustration">
                    <div class="sun-orbit"></div>

                    <div class="building building-a"></div>
                    <div class="building building-b"></div>
                    <div class="building building-c"></div>

                    <div class="health-pin">
                        <i class="fas fa-lungs"></i>
                    </div>

                    <div class="person person-1"></div>
                    <div class="person person-2"></div>
                    <div class="tree tree-a"></div>
                    <div class="tree tree-b"></div>

                    <div class="road-shape"></div>
                </div>

                <div class="summary-year-card">
                    <span>Periode Data</span>
                    <strong><?= esc($tahunAktif ?? date('Y')) ?></strong>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- =========================================
    BERITA SECTION
========================================= -->
<?php
$formatTanggalBerita = static function ($tanggal) {
    if (empty($tanggal) || $tanggal === '0000-00-00 00:00:00') {
        return 'Tanggal belum tersedia';
    }

    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $time = strtotime($tanggal);

    if (!$time) {
        return 'Tanggal belum tersedia';
    }

    return date('d', $time) . ' ' . $bulan[(int) date('m', $time)] . ' ' . date('Y', $time);
};

$getBeritaImage = static function ($gambar) {
    $gambar = trim((string) $gambar);

    if ($gambar === '') {
        return base_url('img/default-berita.jpg');
    }

    if (filter_var($gambar, FILTER_VALIDATE_URL)) {
        return $gambar;
    }

    if (strpos($gambar, '/') !== false) {
        return base_url($gambar);
    }

    return base_url('img/' . $gambar);
};

$getBeritaLink = static function ($berita) {
    $url = trim((string) ($berita['url_berita'] ?? ''));

    if ($url !== '') {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }

        return base_url($url);
    }

    return '#';
};
?>

<section class="tbc-news-section" id="berita-tbc">
    <div class="tbc-news-container">

        <div class="tbc-news-left">
            <span class="news-source-badge">
                Dari RESPIORA
            </span>

            <h2>
                Berita & Informasi<br>
                Tuberkulosis Terkini
            </h2>

            <p>
                Dapatkan update terbaru terkait perkembangan kasus, program kesehatan wilayah,
                edukasi pencegahan, dan kegiatan layanan kesehatan masyarakat.
            </p>
        </div>

        <div class="tbc-news-right">

    <div class="tbc-news-viewport">
        <div class="tbc-news-track" id="newsSlider">
            <?php if (!empty($beritaTbc)): ?>
                <?php foreach ($beritaTbc as $berita): ?>
                    <?php
                        $judulBerita = trim(strip_tags($berita['judul_berita'] ?? 'Berita Tuberkulosis'));
                        $deskripsiBerita = trim(strip_tags($berita['deskripsi_berita'] ?? $berita['isi_berita'] ?? ''));
                        $gambarBerita = $getBeritaImage($berita['gambar_berita'] ?? '');
                        $tanggalBerita = $formatTanggalBerita($berita['tanggal_berita'] ?? '');
                        $linkBerita = $getBeritaLink($berita);
                    ?>

                    <article class="tbc-news-card">
                        <div class="news-card-text">
                            <h3><?= esc(character_limiter($judulBerita, 46, '...')) ?></h3>
                            <span><?= esc($tanggalBerita) ?></span>
                        </div>

                        <a href="<?= esc($linkBerita) ?>" class="news-image-wrap">
                            <img src="<?= esc($gambarBerita) ?>" alt="<?= esc($judulBerita) ?>">

                            <div class="news-image-overlay"></div>

                            <span class="news-category">
                                Berita
                            </span>

                            <span class="news-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="news-empty-state">
                    <i class="fas fa-newspaper"></i>
                    <h3>Berita TBC belum tersedia</h3>
                    <p>Data berita akan tampil setelah ditambahkan pada tabel berita.</p>
                </div>
            <?php endif; ?>

        </div>

        </div>
    </div>
</div>


    </div>
</section>

<script>
    const slider = document.getElementById('insightSlider');
    const cards = document.querySelectorAll('.insight-card');
    const dotsContainer = document.getElementById('insightDots');

    const slider = document.getElementById('insightSlider');
    const cards = document.querySelectorAll('.insight-card');
    const dotsContainer = document.getElementById('insightDots');

    let currentIndex = 0;

    /* =========================================
        CREATE DOTS
    ========================================= */

    cards.forEach((_, index) => {

        const dot = document.createElement('div');
        dot.classList.add('insight-dot');

    let currentIndex = 0;

    /* =========================================
        CREATE DOTS
    ========================================= */

    cards.forEach((_, index) => {

        const dot = document.createElement('div');
        dot.classList.add('insight-dot');

        if (index === 0) {
            dot.classList.add('active');
        }

        dot.addEventListener('click', () => {

            currentIndex = index;
            updateSlider();

        });

        dotsContainer.appendChild(dot);

    });

    const dots = document.querySelectorAll('.insight-dot');

    /* =========================================
        UPDATE SLIDER
    ========================================= */

    function updateSlider() {

        slider.scrollTo({
            left: cards[currentIndex].offsetLeft,
            behavior: 'smooth'
        });

        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');

    }

    /* =========================================
        NEXT SLIDE
    ========================================= */

    function nextSlide() {

        currentIndex++;

        if (currentIndex >= cards.length) {
            currentIndex = 0;
        }

document.addEventListener('DOMContentLoaded', function () {
    const insightSlider = document.getElementById('insightSlider');
    const prevBtn = document.getElementById('funfactPrev');
    const nextBtn = document.getElementById('funfactNext');

    if (!insightSlider || !prevBtn || !nextBtn) return;

    let currentPage = 0;
    let autoplay = null;

    function cardsPerView() {
        if (window.innerWidth <= 576) return 1;
        if (window.innerWidth <= 992) return 2;
        return 3;
    }

    function getTotalCards() {
        return insightSlider.children.length;
    }

    function getTotalPages() {
        return Math.ceil(getTotalCards() / cardsPerView());
    }

    function updateNav() {
        if (getTotalCards() <= cardsPerView()) {
            prevBtn.classList.add('is-hidden');
            nextBtn.classList.add('is-hidden');
        } else {
            prevBtn.classList.remove('is-hidden');
            nextBtn.classList.remove('is-hidden');
        }
    }

    function updateSlider() {
        const cards = insightSlider.children;
        if (!cards.length) return;

        const perView = cardsPerView();
        const totalCards = getTotalCards();
        const totalPages = getTotalPages();

        if (currentPage >= totalPages) {
            currentPage = 0;
        }

        const cardWidth = cards[0].getBoundingClientRect().width;
        const gap = parseFloat(getComputedStyle(insightSlider).gap) || 0;

        const requestedStartIndex = currentPage * perView;
        const maxStartIndex = Math.max(0, totalCards - perView);
        const startIndex = Math.min(requestedStartIndex, maxStartIndex);

        const moveX = startIndex * (cardWidth + gap);

        insightSlider.style.transform = `translateX(-${moveX}px)`;

        updateNav();
    }

    function nextPage() {
        const totalPages = getTotalPages();

        if (totalPages <= 1) return;

        currentPage = currentPage >= totalPages - 1 ? 0 : currentPage + 1;
        updateSlider();
    }

    }

    /* =========================================
        PREV SLIDE
    ========================================= */

    function prevSlide() {

        currentIndex--;

        if (currentIndex < 0) {
            currentIndex = cards.length - 1;
        }
        updateSlider();

    }

    /* =========================================
        PREV SLIDE
    ========================================= */

    function prevSlide() {

        currentIndex--;

        if (currentIndex < 0) {
            currentIndex = cards.length - 1;
        }

        updateSlider();

    }


    document.querySelector('.nextBtn')
        .addEventListener('click', nextSlide);

    document.querySelector('.prevBtn')
        .addEventListener('click', prevSlide);

    /* =========================================
        AUTO SLIDE
    ========================================= */

    setInterval(() => {

        nextSlide();

    }, 5000);
    function prevPage() {
        const totalPages = getTotalPages();

        if (totalPages <= 1) return;

        currentPage = currentPage <= 0 ? totalPages - 1 : currentPage - 1;
        updateSlider();
    }

    function startAutoplay() {
        stopAutoplay();
        autoplay = setInterval(nextPage, 7000);
    }

    function stopAutoplay() {
        if (autoplay) {
            clearInterval(autoplay);
            autoplay = null;
        }
    }

    nextBtn.addEventListener('click', function () {
        nextPage();
        startAutoplay();
    });

    prevBtn.addEventListener('click', function () {
        prevPage();
        startAutoplay();
    });

    insightSlider.addEventListener('mouseenter', stopAutoplay);
    insightSlider.addEventListener('mouseleave', startAutoplay);

    window.addEventListener('resize', function () {
        currentPage = 0;
        updateSlider();
    });

    updateSlider();
    startAutoplay();
});

</script>

<script>
const bannerSlider = document.querySelector('.slider');
const bannerSlides = document.querySelectorAll('.slide');
let bannerIndex = 0;
const bannerTotal = bannerSlides.length;

function nextBannerSlide() {
    if (!bannerSlider || bannerTotal === 0) return;

    bannerIndex = (bannerIndex + 1) % bannerTotal;
    bannerSlider.style.transform = `translateX(-${bannerIndex * 100}%)`;
}

setInterval(nextBannerSlide, 5000);
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tbSection = document.querySelector('.tb-screening-section');

    if (!tbSection) return;

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                tbSection.classList.add('show-animate');
                observer.unobserve(tbSection);
            }
        });
    }, {
        threshold: 0.35
    });

    observer.observe(tbSection);
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('tbcMonthlyChart');

    if (!canvas) return;

    const ctx = canvas.getContext('2d');

    const grafikTbc = <?= json_encode($grafikTbc ?? [
        'labels' => [],
        'kasus' => [],
    ], JSON_NUMERIC_CHECK) ?>;

    const gradient = ctx.createLinearGradient(0, 0, 0, 420);
    gradient.addColorStop(0, '#00bfae');
    gradient.addColorStop(0.55, '#008f99');
    gradient.addColorStop(1, '#005b61');

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: grafikTbc.labels,
            datasets: [
                {
                    label: 'Jumlah Kasus',
                    data: grafikTbc.kasus,
                    backgroundColor: gradient,
                    borderRadius: 12,
                    borderSkipped: false,
                    maxBarThickness: 42,
                    hoverBackgroundColor: '#00bfae'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    position: 'top',
                    align: 'center',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        boxWidth: 9,
                        boxHeight: 9,
                        color: '#334155',
                        padding: 18,
                        font: {
                            family: 'Poppins',
                            size: 13,
                            weight: '800'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#ffffff',
                    titleColor: '#0f172a',
                    bodyColor: '#334155',
                    borderColor: 'rgba(0, 91, 99, 0.16)',
                    borderWidth: 1,
                    padding: 13,
                    cornerRadius: 12,
                    displayColors: false,
                    titleFont: {
                        family: 'Poppins',
                        size: 13,
                        weight: '800'
                    },
                    bodyFont: {
                        family: 'Poppins',
                        size: 12,
                        weight: '600'
                    },
                    callbacks: {
                        title: function (items) {
                            return 'Bulan ' + items[0].label;
                        },
                        label: function (context) {
                            return context.raw + ' kasus TBC';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#475569',
                        font: {
                            family: 'Poppins',
                            size: 12,
                            weight: '700'
                        }
                    },
                    border: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        color: '#475569',
                        font: {
                            family: 'Poppins',
                            size: 12,
                            weight: '600'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Kasus',
                        color: '#334155',
                        font: {
                            family: 'Poppins',
                            size: 13,
                            weight: '800'
                        }
                    },
                    grid: {
                        color: 'rgba(15, 23, 42, 0.08)',
                        drawBorder: false
                    },
                    border: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tahunSelect = document.getElementById('tahun');

    if (tahunSelect) {
        tahunSelect.addEventListener('change', function () {
            this.form.submit();
        });
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mapElement = document.getElementById('mapTbc');

    if (!mapElement) return;

    const petaTbc = <?= json_encode($petaTbc ?? [], JSON_NUMERIC_CHECK) ?>;

    const kasusByWilayah = {};

    petaTbc.forEach(function (item) {
        kasusByWilayah[String(item.id_wilayah)] = {
            id_wilayah: String(item.id_wilayah),
            kasus: Number(item.kasus || 0)
        };
    });

    const values = Object.values(kasusByWilayah).map(function (item) {
        return Number(item.kasus || 0);
    });

    const minVal = values.length ? Math.min(...values) : 0;
    const maxVal = values.length ? Math.max(...values) : 0;
    const interval = (maxVal - minVal) / 3;

    function getKategori(kasus) {
        kasus = Number(kasus || 0);

        if (kasus === 0) {
            return {
                label: 'Tidak Ada',
                color: '#999999',
                bg: 'rgba(153,153,153,0.12)',
                range: '0 kasus'
            };
        }

        if (kasus <= minVal + interval) {
            return {
                label: 'Rendah',
                color: '#2a9d8f',
                bg: 'rgba(42,157,143,0.13)',
                range: `${Math.ceil(minVal)} - ${Math.floor(minVal + interval)} kasus`
            };
        }

        if (kasus <= minVal + 2 * interval) {
            return {
                label: 'Sedang',
                color: '#ff9800',
                bg: 'rgba(255,152,0,0.14)',
                range: `${Math.floor(minVal + interval) + 1} - ${Math.floor(minVal + 2 * interval)} kasus`
            };
        }

        return {
            label: 'Tinggi',
            color: '#e63946',
            bg: 'rgba(230,57,70,0.13)',
            range: `> ${Math.floor(minVal + 2 * interval)} kasus`
        };
    }

    function getIdWilayah(feature) {
        return String(
            feature.properties.id_wilayah ||
            feature.properties.ID_WILAYAH ||
            feature.properties.ID ||
            feature.properties.id ||
            ''
        );
    }

    function getNamaWilayah(feature) {
        return (
            feature.properties.NAMOBJ ||
            feature.properties.nama ||
            feature.properties.name ||
            feature.properties.kelurahan ||
            'Wilayah'
        );
    }

    const map = L.map('mapTbc', {
        scrollWheelZoom: false,
        minZoom: 11,
        maxZoom: 16,
        zoomControl: true
    }).setView([-8.1724, 113.7000], 12);

    setTimeout(function () {
        map.invalidateSize();
    }, 300);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    const coordDiv = L.control({
        position: 'bottomleft'
    });

    coordDiv.onAdd = function () {
        this._div = L.DomUtil.create('div', 'mouse-coords-premium');
        this._div.innerHTML = 'Lat : -<br>Lng : -';
        return this._div;
    };

    coordDiv.addTo(map);

    map.on('mousemove', function (e) {
        coordDiv._div.innerHTML = `Lat : ${e.latlng.lat.toFixed(5)}<br>Lng : ${e.latlng.lng.toFixed(5)}`;
    });

    map.on('mouseout', function () {
        coordDiv._div.innerHTML = 'Lat : -<br>Lng : -';
    });

    const legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function () {
        const div = L.DomUtil.create('div', 'custom-map-legend');

        const rendah = getKategori(minVal);
        const sedang = getKategori(minVal + interval + 1);
        const tinggi = getKategori(maxVal);

        div.innerHTML = `
            <h4>Kategori Kasus</h4>
            <div><i style="background:#999999"></i>Tidak Ada</div>
            <div><i style="background:#2a9d8f"></i>Rendah</div>
            <div><i style="background:#ff9800"></i>Sedang</div>
            <div><i style="background:#e63946"></i>Tinggi</div>
            <hr style="border:none;border-top:1px solid #e2e8f0;margin:9px 0;">
            <div style="font-size:11px;color:#64748b;display:block;line-height:1.5;">
                Min: <b>${minVal}</b><br>
                Max: <b>${maxVal}</b><br>
                Interval: <b>${interval.toFixed(1)}</b>
            </div>
        `;
            <a href="skrining-tbc" class="gejala-btn">
                <i class="fas fa-arrow-right"></i>
            </a>
        return div;
    };


    legend.addTo(map);

    let geoLayer = null;
    let labelLayer = L.layerGroup().addTo(map);

    fetch("<?= base_url('assets/peta/tbc.geojson') ?>")
        .then(function (response) {
            if (!response.ok) {
                throw new Error('File GeoJSON tidak ditemukan');
            }

            return response.json();
        })
        .then(function (geojson) {
            if (geoLayer) {
                geoLayer.remove();
            }

            labelLayer.clearLayers();

            geoLayer = L.geoJSON(geojson, {
                style: function (feature) {
                    const idWilayah = getIdWilayah(feature);
                    const item = kasusByWilayah[idWilayah] || { kasus: 0 };
                    const kasus = Number(item.kasus || 0);
                    const kategori = getKategori(kasus);

                    return {
                        color: '#00bcd4',
                        weight: 2,
                        fillColor: kategori.color,
                        fillOpacity: kasus > 0 ? 0.58 : 0.30
                    };
                },

                onEachFeature: function (feature, layer) {
                    const idWilayah = getIdWilayah(feature);
                    const namaWilayah = getNamaWilayah(feature);
                    const item = kasusByWilayah[idWilayah] || { kasus: 0 };
                    const kasus = Number(item.kasus || 0);
                    const kategori = getKategori(kasus);

                    if (layer.getBounds && layer.getBounds().isValid()) {
                        const center = layer.getBounds().getCenter();

                        L.marker(center, {
                            icon: L.divIcon({
                                className: 'map-label-wilayah',
                                html: namaWilayah,
                                iconSize: [120, 20]
                            }),
                            interactive: false
                        }).addTo(labelLayer);
                    }

                    const popupContent = `
                        <div class="map-popup-tbc">
                            <span class="popup-badge" style="background:${kategori.bg};color:${kategori.color};">
                                ${kategori.label}
                            </span>

                            <h4>${namaWilayah}</h4>

                            <div class="map-popup-row">
                                <span>Jumlah Kasus</span>
                                <strong>${kasus}</strong>
                            </div>

                            <div class="map-popup-row">
                                <span>Kategori</span>
                                <strong style="color:${kategori.color};">${kategori.label}</strong>
                            </div>

                            <div class="map-popup-row">
                                <span>Rentang</span>
                                <strong>${kategori.range}</strong>
                            </div>

                            <div class="map-popup-row">
                                <span>Tahun</span>
                                <strong><?= esc($tahunAktif ?? date('Y')) ?></strong>
                            </div>
                        </div>
                    `;

                    layer.bindPopup(popupContent, {
                        closeButton: false
                    });

                    layer.on('mouseover', function () {
                        layer.openPopup();
                        layer.setStyle({
                            weight: 3.4,
                            fillOpacity: kasus > 0 ? 0.82 : 0.45
                        });
                    });

                    layer.on('mouseout', function () {
                        const popup = layer.getPopup();

                        setTimeout(function () {
                            const popupEl = popup ? popup.getElement() : null;

                            if (!popupEl || !popupEl.matches(':hover')) {
                                layer.closePopup();
                                layer.setStyle({
                                    weight: 2,
                                    fillOpacity: kasus > 0 ? 0.58 : 0.30
                                });
                            }
                        }, 180);
                    });

                    layer.on('click', function () {
                        map.fitBounds(layer.getBounds(), {
                            padding: [40, 40],
                            maxZoom: 14
                        });
                    });
                }
            }).addTo(map);

            if (geoLayer.getBounds().isValid()) {
                map.fitBounds(geoLayer.getBounds(), {
                    padding: [20, 20]
                });
            }

            setTimeout(function () {
                map.invalidateSize();
            }, 500);
        })
        .catch(function () {
            mapElement.innerHTML = `
                <div style="height:100%;display:flex;align-items:center;justify-content:center;text-align:center;padding:25px;color:#64748b;background:#f8ffff;">
                    <div>
                        <i class="fas fa-map-location-dot" style="font-size:38px;color:#00aeb8;margin-bottom:12px;"></i>
                        <h3 style="margin:0 0 8px;color:#12232d;">File Peta Belum Ditemukan</h3>
                        <p style="margin:0;">Pastikan file GeoJSON ada di <b>public/assets/peta/tbc.geojson</b>.</p>
                    </div>
                </div>
            `;
        });
});
</script>


            </div>

            <!-- IMAGE -->
            <div class="ringkasan-image">

                <img src="<?= base_url('img/ilustrasi.png') ?>" alt="">

            </div>

        </div>

    </div>

</section>

<!-- Chatbot -->



<!-- Tombol Chatbot -->
<img id="chatbot-btn" src="/assets/icon/Rora_chatbot.svg"
     alt="Chat Rora"
     style="position: fixed; bottom: 20px; right: 20px; width: 150px; height: 150px; cursor: pointer; z-index: 9999;"
     class="chatbot-animate">

<!-- Chatbot Box -->
<div id="chatbot-box" style="
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 360px; /* lebih lebar */
    height: 450px; /* lebih tinggi */
    border-radius: 35px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    font-family: Poppins, sans-serif;
    z-index: 9999;
    flex-direction: column;
">

    <!-- Header -->
    <div style="
        background: linear-gradient(to bottom, #00BBC2, #43DAE0);
        color: #fff;
        padding: 10px 15px; /* dikurangi padding supaya rapat */
        display:flex;
        align-items:center;
        gap:8px;
        line-height:1.1; /* rapatkan teks */
    ">
        <img src="/assets/icon/Rora_chat.svg" alt="Rora" style="width:40px;height:40px;">
        <div style="display:flex; flex-direction:column;">
            <strong style="margin:0; font-size:16px;">Tanya Rora</strong>
            <span style="margin:0; font-size:12px; font-weight:400;">Saya siap membantu kamu kapan saja!</span>
        </div>
        <button id="close-chat" style="margin-left:auto; background:none; border:none; color:#fff; font-size:18px; cursor:pointer;">×</button>
    </div>

    <!-- Messages -->
    <div id="chatbot-messages" style="
        flex:1;
        padding:15px;
        overflow-y:auto;
        display:flex;
        flex-direction:column;
        gap:10px;
        background: #D5F9FF;
    ">
        <!-- Chat muncul di sini -->
    </div>

    <!-- Input -->
    <div style="padding:15px; display:flex; gap:12px; background: #FEFEFE;">
        <input type="text" id="input-msg" placeholder="Tulis pesan." style="flex:1; padding:5px 10px; border-radius:50px; border:1px solid #00BBC2; outline:none; font-size:13px">
        <button id="send-msg" style="background:linear-gradient(to bottom, #00BBC2, #43DAE0); border:none; border-radius:50%; width:50px; height:50px; display:flex; justify-content:center; align-items:center; cursor:pointer;">
            <img src="/assets/icon/voice_note.svg" style="width:30px;height:30px;">
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('chatbot-btn');
        const box = document.getElementById('chatbot-box');
        const close = document.getElementById('close-chat');
        const sendBtn = document.getElementById('send-msg');
        const input = document.getElementById('input-msg');
        const messages = document.getElementById('chatbot-messages');
        const sendIcon = sendBtn.querySelector('img');

        // Variabel Audio State
        let audioContext = null;
        let audioProcessor = null;
        let audioStream = null;
        let inputSource = null;
        let audioBuffers = []; // Menampung raw data audio
        let isRecording = false;
        let transcriptLoadingMessage = null;
        let recordingMessage = null;

        function updateButtonIcon() {
            if (input.value.trim() !== "") {
                sendIcon.src = "/assets/icon/kirim.svg";
            } else {
                if (isRecording) {
                    sendIcon.src = "/assets/icon/recording.svg";
                } else {
                    sendIcon.src = "/assets/icon/voice_note.svg";
                }
            }
        }

        input.addEventListener('input', updateButtonIcon);

        btn.addEventListener('click', () => {
            box.style.display = 'flex';
            if (!messages.hasChildNodes()) {
                const aiBubble = document.createElement('div');
                aiBubble.style.display = 'flex';
                aiBubble.style.alignItems = 'flex-start';
                aiBubble.style.gap = '10px';
                aiBubble.innerHTML = `
                <img src="/assets/icon/Rora_chat.svg" style="width:30px;height:30px;border-radius:50%;">
                <div style="background:#fff;padding:10px 12px;border-radius:15px;max-width:70%;">
                    Hai! <strong>Aku Rora</strong><br>Ada yang bisa aku bantu seputar Tuberkulosis?
                </div>
            `;
                messages.appendChild(aiBubble);
                messages.scrollTop = messages.scrollHeight;
            }
        });

        close.addEventListener('click', () => {
            box.style.display = 'none';
            if (isRecording) stopVoiceNote();
        });

        // Mulai Rekam Audio Murni (WAV)
       async function startVoiceNote() {
    audioBuffers = [];
    isRecording = true;
    updateButtonIcon();

    audioStream = await navigator.mediaDevices.getUserMedia({ audio: true });
    audioContext = new (window.AudioContext || window.webkitAudioContext)({ sampleRate: 16000 });

    inputSource = audioContext.createMediaStreamSource(audioStream);
    audioProcessor = audioContext.createScriptProcessor(4096, 1, 1);

    audioProcessor.onaudioprocess = (e) => {
        if (!isRecording) return;
        const channelData = e.inputBuffer.getChannelData(0);
        audioBuffers.push(new Float32Array(channelData));
    };

    inputSource.connect(audioProcessor);
    audioProcessor.connect(audioContext.destination);

    // Tambahkan UI "Rora sedang mendengarkan"
}

        // Stop Rekam & Rakit menjadi File format .WAV
        async function stopVoiceNote() {
    if (!isRecording) return;
    isRecording = false;
    updateButtonIcon();

    // Hapus indikator rekaman
    if (recordingMessage) {
        recordingMessage.remove();
        recordingMessage = null;
    }

    try {
        // Putus semua koneksi audio
        if (audioProcessor) audioProcessor.disconnect();
        if (inputSource) inputSource.disconnect();
        if (audioStream) audioStream.getTracks().forEach(track => track.stop());
        if (audioContext) await audioContext.close();

        // Gabungkan buffer menjadi WAV
        const totalLength = audioBuffers.reduce((acc, buf) => acc + buf.length, 0);
        const resultBuffer = new Float32Array(totalLength);
        let offset = 0;
        for (const buf of audioBuffers) {
            resultBuffer.set(buf, offset);
            offset += buf.length;
        }

        const wavBuffer = createWavBlob(resultBuffer, 16000);
        const audioBlob = new Blob([wavBuffer], { type: 'audio/wav' });

        // Tampilkan loading
        transcriptLoadingMessage = document.createElement('div');
        transcriptLoadingMessage.style.alignSelf = 'center';
        transcriptLoadingMessage.style.padding = '5px 10px';
        transcriptLoadingMessage.style.background = '#E0E0E0';
        transcriptLoadingMessage.style.borderRadius = '15px';
        transcriptLoadingMessage.style.fontSize = '12px';
        transcriptLoadingMessage.textContent = '⏳ Menafsirkan ucapanmu...';
        messages.appendChild(transcriptLoadingMessage);
        messages.scrollTop = messages.scrollHeight;

        // Kirim audio ke backend
        const formData = new FormData();
        formData.append('audio', audioBlob, 'voice.wav');

        const res = await fetch('<?= base_url("api/rora/voiceToText") ?>', {
            method: 'POST',
            body: formData
        });

        if (!res.ok) throw new Error(`Server error: ${res.status}`);

        const data = await res.json();

        if (transcriptLoadingMessage) transcriptLoadingMessage.remove();

        // Jika backend berhasil mengubah suara menjadi teks
        if (data.text && data.text.trim() !== "") {
            sendMessage(data.text);
        } else {
            // fallback: beri pesan di chat
            sendMessage("Maaf, aku tidak bisa menangkap kata dengan jelas. Coba ulangi ya!");
            console.warn("VoiceToText kosong atau tidak valid:", data);
        }
    } catch (err) {
        if (transcriptLoadingMessage) transcriptLoadingMessage.remove();
        console.error("Error stopVoiceNote:", err);
sendMessage("Maaf, Rora tidak bisa mendeteksi suara. Coba ulangi ya!");    } finally {
        // reset audio buffer
        audioBuffers = [];
        isRecording = false;
        updateButtonIcon();
    }
}

        // Fungsi Pembentuk File WAV Murni
        function createWavBlob(samples, sampleRate) {
            const buffer = new ArrayBuffer(44 + samples.length * 2);
            const view = new DataView(buffer);

            /* RIFF identifier */
            writeString(view, 0, 'RIFF');
            /* file length */
            view.setUint32(4, 36 + samples.length * 2, true);
            /* RIFF type */
            writeString(view, 8, 'WAVE');
            /* format chunk identifier */
            writeString(view, 12, 'fmt ');
            /* format chunk length */
            view.setUint32(16, 16, true);
            /* sample format (raw PCM) */
            view.setUint16(20, 1, true);
            /* channel count (Mono) */
            view.setUint16(22, 1, true);
            /* sample rate */
            view.setUint32(24, sampleRate, true);
            /* byte rate (sample rate * block align) */
            view.setUint32(28, sampleRate * 2, true);
            /* block align (channel count * bytes per sample) */
            view.setUint16(32, 2, true);
            /* bits per sample */
            view.setUint16(34, 16, true);
            /* data chunk identifier */
            writeString(view, 36, 'data');
            /* data chunk length */
            view.setUint32(40, samples.length * 2, true);

            // Tulis Amplitudo Suara ke 16-bit PCM
            let index = 44;
            for (let i = 0; i < samples.length; i++) {
                let s = Math.max(-1, Math.min(1, samples[i]));
                view.setInt16(index, s < 0 ? s * 0x8000 : s * 0x7FFF, true);
                index += 2;
            }
            return buffer;
        }

        function writeString(view, offset, string) {
            for (let i = 0; i < string.length; i++) {
                view.setUint8(offset + i, string.charCodeAt(i));
            }
        }

        // Fungsi kirim teks ke Gemini
        async function sendMessage(textToSend = null) {
            const text = textToSend || input.value.trim();
            if (!text) return;

            if (!textToSend) input.value = '';
            updateButtonIcon();

            const userMsg = document.createElement('div');
            userMsg.style.alignSelf = 'flex-end';
            userMsg.style.background = 'linear-gradient(to bottom, #00BBC2, #43DAE0)';
            userMsg.style.color = '#fff';
            userMsg.style.padding = '8px 12px';
            userMsg.style.borderRadius = '25px 25px 2px 25px';
            userMsg.style.maxWidth = '70%';
            userMsg.textContent = text;
            messages.appendChild(userMsg);
            messages.scrollTop = messages.scrollHeight;

            const aiBubble = document.createElement('div');
            aiBubble.style.display = 'flex';
            aiBubble.style.alignItems = 'flex-end';
            aiBubble.style.gap = '10px';
            aiBubble.innerHTML = `
            <img src="/assets/icon/Rora_kepala.svg" style="width:40px;height:40px;border-radius:50%;">
            <div style="background: #fff;padding:10px 12px;border-radius:25px 25px 25px 2px;max-width:70%;">
                <span class="gradient-text">Rora sedang berpikir...</span>
            </div>
        `;
            messages.appendChild(aiBubble);
            messages.scrollTop = messages.scrollHeight;

            try {
                const response = await fetch('<?= base_url("api/gemini") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        message: text
                    })
                });

                const data = await response.json();
                const aiDiv = aiBubble.querySelector('div');
                aiDiv.innerHTML = `<span class="gradient-text">${data.reply || 'Rora tidak menerima respon valid.'}</span>`;
            } catch (err) {
                const aiDiv = aiBubble.querySelector('div');
                aiDiv.innerHTML = `<span class="gradient-text">Maaf, ada masalah koneksi ke server.</span>`;
            }
            messages.scrollTop = messages.scrollHeight;
        }

        // Pengendali klik tombol tunggal
        sendBtn.addEventListener('click', () => {
            const text = input.value.trim();
            if (text !== "") {
                sendMessage();
            } else {
                if (!isRecording) {
                    startVoiceNote();
                } else {
                    stopVoiceNote();
                }
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
        });
    });
</script>



<style>
    .gradient-text {
        background: linear-gradient(to bottom, #00BBC2, #43DAE0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 500;
        display: inline-block;
    }


    #input-msg {
        color: #00BBC2;
        /* warna teks user */
        font-weight: 500;
    }

    input::placeholder {
        background: linear-gradient(to bottom, #00BBC2, #43DAE0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 500;
    }
</style>


<!-- Chatbot -->


</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const footerDesc = document.querySelector(".footer-desc");

        if (footerDesc) {

            footerDesc.insertAdjacentHTML("afterend", `
        
            <div class="cynex-info mt-4">

                <h3 style="
                    color:#fff;
                    font-weight:700;
                    font-size:2rem;
                    margin-bottom:12px;
                    line-height:1;
                ">
                    RESPIORA
                </h3>

                <p style="
                    color:#E8FFFF;
                    font-size:1.1rem;
                    line-height:1.8;
                    margin-bottom:0;
                ">
                    Regional Early Detection Screening Platform Intelligent Observation Response Awareness
                </p>

            </div>

        `);

        }

    });
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const newsSlider = document.getElementById('newsSlider');

    if (!newsSlider) return;

    let currentPage = 0;
    let autoplay = null;

    function cardsPerView() {
        if (window.innerWidth <= 768) return 1;
        if (window.innerWidth <= 992) return 2;
        return 3;
    }

    function getCards() {
        return Array.from(newsSlider.querySelectorAll('.tbc-news-card'));
    }

    function totalPages() {
        return Math.ceil(getCards().length / cardsPerView());
    }

    function showNewsPage(page) {
        const cards = getCards();
        const totalCards = cards.length;
        const perView = cardsPerView();
        const pages = totalPages();

        if (!totalCards || pages <= 1) {
            newsSlider.style.transform = 'translateX(0)';
            return;
        }

        if (page >= pages) {
            currentPage = 0;
        } else if (page < 0) {
            currentPage = pages - 1;
        } else {
            currentPage = page;
        }

        let startIndex = currentPage * perView;

        const maxStartIndex = Math.max(0, totalCards - perView);
        startIndex = Math.min(startIndex, maxStartIndex);

        const cardWidth = cards[0].getBoundingClientRect().width;
        const gap = parseFloat(getComputedStyle(newsSlider).gap) || 0;
        const moveX = startIndex * (cardWidth + gap);

        newsSlider.style.transform = `translateX(-${moveX}px)`;
    }

    function nextNewsPage() {
        showNewsPage(currentPage + 1);
    }

    function startAutoplay() {
        stopAutoplay();

        if (totalPages() > 1) {
            autoplay = setInterval(nextNewsPage, 4500);
        }
    }

    function stopAutoplay() {
        if (autoplay) {
            clearInterval(autoplay);
            autoplay = null;
        }
    }

    newsSlider.addEventListener('mouseenter', stopAutoplay);
    newsSlider.addEventListener('mouseleave', startAutoplay);

    window.addEventListener('resize', function () {
        currentPage = 0;
        showNewsPage(0);
        startAutoplay();
    });

    showNewsPage(0);
    startAutoplay();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const insightSlider = document.getElementById('insightSlider');
    const prevBtn = document.getElementById('funfactPrev');
    const nextBtn = document.getElementById('funfactNext');
    const dotsContainer = document.getElementById('insightDots');

    if (!insightSlider || !prevBtn || !nextBtn || !dotsContainer) return;

    let currentPage = 0;
    let autoplay = null;

    function cardsPerView() {
        if (window.innerWidth <= 576) return 1;
        if (window.innerWidth <= 992) return 2;
        return 3;
    }

    function getCards() {
        return Array.from(insightSlider.querySelectorAll('.insight-card'));
    }

    function totalPages() {
        const totalCards = getCards().length;
        return Math.ceil(totalCards / cardsPerView());
    }

    function buildDots() {
        const pages = totalPages();
        dotsContainer.innerHTML = '';

        if (pages <= 1) {
            dotsContainer.style.display = 'none';
            return;
        }

        dotsContainer.style.display = 'flex';

        for (let i = 0; i < pages; i++) {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'insight-dot';
            dot.dataset.page = i;
            dot.setAttribute('aria-label', 'Slide artikel ' + (i + 1));

            dot.addEventListener('click', function () {
                showPage(i);
                startAutoplay();
            });

            dotsContainer.appendChild(dot);
        }
    }

    function updateDots() {
        const dots = dotsContainer.querySelectorAll('.insight-dot');

        dots.forEach(function (dot, index) {
            dot.classList.toggle('active', index === currentPage);
        });
    }

    function updateNav() {
        if (totalPages() <= 1) {
            prevBtn.classList.add('is-hidden');
            nextBtn.classList.add('is-hidden');
        } else {
            prevBtn.classList.remove('is-hidden');
            nextBtn.classList.remove('is-hidden');
        }
    }

    function showPage(page) {
        const cards = getCards();
        const totalCards = cards.length;
        const perView = cardsPerView();
        const pages = totalPages();

        if (!totalCards) return;

        if (page >= pages) {
            currentPage = 0;
        } else if (page < 0) {
            currentPage = pages - 1;
        } else {
            currentPage = page;
        }

        let startIndex = currentPage * perView;

        if (currentPage === pages - 1) {
            startIndex = Math.max(0, totalCards - perView);
        }

        const cardWidth = cards[0].getBoundingClientRect().width;
        const gap = parseFloat(getComputedStyle(insightSlider).gap) || 0;
        const moveX = startIndex * (cardWidth + gap);

        insightSlider.style.transform = `translateX(-${moveX}px)`;

        updateDots();
        updateNav();
    }

    function nextPage() {
        showPage(currentPage + 1);
    }

    function prevPage() {
        showPage(currentPage - 1);
    }

    function startAutoplay() {
        stopAutoplay();

        autoplay = setInterval(function () {
            nextPage();
        }, 5000);
    }

    function stopAutoplay() {
        if (autoplay) {
            clearInterval(autoplay);
            autoplay = null;
        }
    }

    nextBtn.addEventListener('click', function () {
        nextPage();
        startAutoplay();
    });

    prevBtn.addEventListener('click', function () {
        prevPage();
        startAutoplay();
    });

    insightSlider.addEventListener('mouseenter', stopAutoplay);
    insightSlider.addEventListener('mouseleave', startAutoplay);

    window.addEventListener('resize', function () {
        buildDots();

        if (currentPage >= totalPages()) {
            currentPage = 0;
        }

        showPage(currentPage);
    });

    buildDots();
    showPage(0);
    startAutoplay();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const bannerSlider = document.getElementById('bannerSlider');
    const bannerSlides = document.querySelectorAll('.banner-slide');
    const bannerDots = document.querySelectorAll('.banner-dot');

    if (!bannerSlider || bannerSlides.length <= 1) return;

    let bannerIndex = 0;
    let bannerInterval = null;

    function updateDots() {
        bannerDots.forEach(function (dot, index) {
            dot.classList.toggle('active', index === bannerIndex);
        });
    }

    function showBanner(index) {
        bannerIndex = index;

        if (bannerIndex >= bannerSlides.length) {
            bannerIndex = 0;
        }

        if (bannerIndex < 0) {
            bannerIndex = bannerSlides.length - 1;
        }

        bannerSlider.style.transform = `translateX(-${bannerIndex * 100}%)`;
        updateDots();
    }

    function startBannerAutoSlide() {
        stopBannerAutoSlide();

        bannerInterval = setInterval(function () {
            showBanner(bannerIndex + 1);
        }, 4000);
    }

    function stopBannerAutoSlide() {
        if (bannerInterval) {
            clearInterval(bannerInterval);
            bannerInterval = null;
        }
    }

    bannerDots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            const index = Number(this.dataset.index);
            showBanner(index);
            startBannerAutoSlide();
        });
    });

    showBanner(0);
    startBannerAutoSlide();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tbSection = document.querySelector('.tb-screening-section');

    if (!tbSection) return;

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                tbSection.classList.add('show-animate');
                observer.unobserve(tbSection);
            }
        });
    }, {
        threshold: 0.35
    });

    observer.observe(tbSection);
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('tbcMonthlyChart');

    if (!canvas) return;

    const ctx = canvas.getContext('2d');

    const grafikTbc = <?= json_encode($grafikTbc ?? [
        'labels' => [],
        'kasus' => [],
    ], JSON_NUMERIC_CHECK) ?>;

    console.log(grafikTbc);

    const gradient = ctx.createLinearGradient(0, 0, 0, 420);
    gradient.addColorStop(0, '#00bfae');
    gradient.addColorStop(0.55, '#008f99');
    gradient.addColorStop(1, '#005b61');

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: grafikTbc.labels,
            datasets: [
                {
                    label: 'Jumlah Kasus',
                    data: grafikTbc.kasus,
                    backgroundColor: gradient,
                    borderRadius: 12,
                    borderSkipped: false,
                    maxBarThickness: 42,
                    hoverBackgroundColor: '#00bfae'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    position: 'top',
                    align: 'center',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        boxWidth: 9,
                        boxHeight: 9,
                        color: '#334155',
                        padding: 18,
                        font: {
                            family: 'Poppins',
                            size: 13,
                            weight: '800'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#ffffff',
                    titleColor: '#0f172a',
                    bodyColor: '#334155',
                    borderColor: 'rgba(0, 91, 99, 0.16)',
                    borderWidth: 1,
                    padding: 13,
                    cornerRadius: 12,
                    displayColors: false,
                    titleFont: {
                        family: 'Poppins',
                        size: 13,
                        weight: '800'
                    },
                    bodyFont: {
                        family: 'Poppins',
                        size: 12,
                        weight: '600'
                    },
                    callbacks: {
                        title: function (items) {
                            return 'Bulan ' + items[0].label;
                        },
                        label: function (context) {
                            return context.raw + ' kasus TBC';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#475569',
                        font: {
                            family: 'Poppins',
                            size: 12,
                            weight: '700'
                        }
                    },
                    border: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        color: '#475569',
                        font: {
                            family: 'Poppins',
                            size: 12,
                            weight: '600'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Kasus',
                        color: '#334155',
                        font: {
                            family: 'Poppins',
                            size: 13,
                            weight: '800'
                        }
                    },
                    grid: {
                        color: 'rgba(15, 23, 42, 0.08)',
                        drawBorder: false
                    },
                    border: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tahunSelect = document.getElementById('tahun');

    if (tahunSelect) {
        tahunSelect.addEventListener('change', function () {
            this.form.submit();
        });
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mapElement = document.getElementById('mapTbc');

    if (!mapElement) return;

    const petaTbc = <?= json_encode($petaTbc ?? [], JSON_NUMERIC_CHECK) ?>;

    const wilayahKaliwates = {
        "2001": "Jember Kidul",
        "2002": "Kepatihan",
        "2003": "Sempusari",
        "2004": "Mangli",
        "2005": "Kebon Agung",
        "2006": "Kaliwates",
        "2007": "Tegal Besar"
    };

    function normalisasiNama(value) {
        return String(value || '')
            .toLowerCase()
            .replace(/[^a-z0-9]/g, '')
            .trim();
    }

    const kasusById = {};
    const idByNama = {
        'jemberkidul': '2001',
        'kepatihan': '2002',
        'sempusari': '2003',
        'mangli': '2004',
        'kebonagung': '2005',
        'kebongagung': '2005',
        'kaliwates': '2006',
        'tegalbesar': '2007'
    };

    petaTbc.forEach(function (item) {
        const id = String(item.id_wilayah);
        const nama = item.kelurahan || wilayahKaliwates[id];

        kasusById[id] = Number(item.kasus || 0);

        if (nama) {
            idByNama[normalisasiNama(nama)] = id;
        }
    });

    const values = Object.values(kasusById).filter(function (value) {
        return value > 0;
    });

    const minVal = values.length ? Math.min(...values) : 0;
    const maxVal = values.length ? Math.max(...values) : 0;
    const interval = maxVal > minVal ? (maxVal - minVal) / 3 : 1;

    function getKategori(kasus) {
        kasus = Number(kasus || 0);

        if (kasus === 0) {
            return {
                label: 'Tidak Ada',
                color: '#999999',
                bg: 'rgba(153,153,153,0.12)',
                range: '0 kasus'
            };
        }

        if (kasus <= minVal + interval) {
            return {
                label: 'Rendah',
                color: '#2a9d8f',
                bg: 'rgba(42,157,143,0.13)',
                range: `${Math.ceil(minVal)} - ${Math.floor(minVal + interval)} kasus`
            };
        }

        if (kasus <= minVal + 2 * interval) {
            return {
                label: 'Sedang',
                color: '#ff9800',
                bg: 'rgba(255,152,0,0.14)',
                range: `${Math.floor(minVal + interval) + 1} - ${Math.floor(minVal + 2 * interval)} kasus`
            };
        }

        return {
            label: 'Tinggi',
            color: '#e63946',
            bg: 'rgba(230,57,70,0.13)',
            range: `> ${Math.floor(minVal + 2 * interval)} kasus`
        };
    }

    function getNamaWilayah(feature) {
        const props = feature.properties || {};

        return (
            props.kelurahan ||
            props.KELURAHAN ||
            props.nama ||
            props.NAMA ||
            props.name ||
            props.NAMOBJ ||
            props.DESA ||
            props.desa ||
            'Wilayah'
        );
    }

    function getIdWilayah(feature) {
        const props = feature.properties || {};

        const idDariGeojson = String(
            props.id_wilayah ||
            props.ID_WILAYAH ||
            props.id ||
            props.ID ||
            ''
        );

        if (idDariGeojson && wilayahKaliwates[idDariGeojson]) {
            return idDariGeojson;
        }

        const namaGeojson = normalisasiNama(getNamaWilayah(feature));

        return idByNama[namaGeojson] || '';
    }

    const map = L.map('mapTbc', {
        scrollWheelZoom: false,
        zoomControl: true,
        attributionControl: false,
    }).setView([-8.1724, 113.7000], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: ''
}).addTo(map);

/* KOORDINAT LATITUDE & LONGITUDE */
const coordDiv = L.control({
    position: 'bottomleft'
});

coordDiv.onAdd = function () {
    this._div = L.DomUtil.create('div', 'mouse-coords-premium');
    this._div.innerHTML = 'Lat : -<br>Lng : -';
    return this._div;
};

coordDiv.addTo(map);

map.on('mousemove', function (e) {
    coordDiv._div.innerHTML = `
        Lat : ${e.latlng.lat.toFixed(5)}<br>
        Lng : ${e.latlng.lng.toFixed(5)}
    `;
});

map.on('mouseout', function () {
    coordDiv._div.innerHTML = 'Lat : -<br>Lng : -';
});

setTimeout(function () {
    map.invalidateSize();
}, 300);

    const legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function () {
        const div = L.DomUtil.create('div', 'custom-map-legend');

        div.innerHTML = `
            <h4>Kategori Kasus</h4>
            <div><i style="background:#999999"></i>Tidak Ada</div>
            <div><i style="background:#2a9d8f"></i>Rendah</div>
            <div><i style="background:#ff9800"></i>Sedang</div>
            <div><i style="background:#e63946"></i>Tinggi</div>
            </div>
        `;

        return div;
    };

    legend.addTo(map);

    fetch("<?= base_url('assets/peta/tbc.geojson') ?>")
        .then(function (response) {
            if (!response.ok) {
                throw new Error('File GeoJSON tidak ditemukan');
            }

            return response.json();
        })
        .then(function (geojson) {
            const geoLayer = L.geoJSON(geojson, {
                filter: function (feature) {
                    const idWilayah = getIdWilayah(feature);
                    return wilayahKaliwates[idWilayah] !== undefined;
                },

                style: function (feature) {
                    const idWilayah = getIdWilayah(feature);
                    const kasus = kasusById[idWilayah] || 0;
                    const kategori = getKategori(kasus);

                    return {
                        color: '#00bcd4',
                        weight: 2,
                        fillColor: kategori.color,
                        fillOpacity: kasus > 0 ? 0.65 : 0.30
                    };
                },

                onEachFeature: function (feature, layer) {
                    const idWilayah = getIdWilayah(feature);
                    const namaWilayah = wilayahKaliwates[idWilayah] || getNamaWilayah(feature);
                    const kasus = kasusById[idWilayah] || 0;
                    const kategori = getKategori(kasus);

                    layer.bindPopup(`
                        <div class="map-popup-tbc">
                            <span class="popup-badge" style="background:${kategori.bg};color:${kategori.color};">
                                ${kategori.label}
                            </span>

                            <h4>${namaWilayah}</h4>

                            <div class="map-popup-row">
                                <span>Jumlah Kasus</span>
                                <strong>${kasus}</strong>
                            </div>

                            <div class="map-popup-row">
                                <span>Kategori</span>
                                <strong style="color:${kategori.color};">${kategori.label}</strong>
                            </div>

                            <div class="map-popup-row">
                                <span>Rentang</span>
                                <strong>${kategori.range}</strong>
                            </div>

                            <div class="map-popup-row">
                                <span>Tahun</span>
                                <strong><?= esc($tahunAktif ?? date('Y')) ?></strong>
                            </div>
                        </div>
                    `, {
                        closeButton: false
                    });

                    layer.on('mouseover', function () {
                        layer.openPopup();
                        layer.setStyle({
                            weight: 3.5,
                            fillOpacity: kasus > 0 ? 0.85 : 0.45
                        });
                    });

                    layer.on('mouseout', function () {
                        layer.closePopup();
                        layer.setStyle({
                            weight: 2,
                            fillOpacity: kasus > 0 ? 0.65 : 0.30
                        });
                    });

                    layer.on('click', function () {
                        map.fitBounds(layer.getBounds(), {
                            padding: [40, 40],
                            maxZoom: 15
                        });
                    });
                }
            }).addTo(map);

            if (geoLayer.getLayers().length === 0) {
                mapElement.innerHTML = `
                    <div style="height:100%;display:flex;align-items:center;justify-content:center;text-align:center;padding:25px;color:#64748b;background:#f8ffff;">
                        <div>
                            <i class="fas fa-map-location-dot" style="font-size:38px;color:#00aeb8;margin-bottom:12px;"></i>
                            <h3 style="margin:0 0 8px;color:#12232d;">Wilayah Kaliwates Tidak Cocok</h3>
                            <p style="margin:0;">Cek nama kelurahan atau id_wilayah pada file GeoJSON.</p>
                        </div>
                    </div>
                `;
                return;
            }

            map.fitBounds(geoLayer.getBounds(), {
                padding: [24, 24]
            });

            setTimeout(function () {
                map.invalidateSize();
            }, 500);
        })
        .catch(function (error) {
            console.error(error);

            mapElement.innerHTML = `
                <div style="height:100%;display:flex;align-items:center;justify-content:center;text-align:center;padding:25px;color:#64748b;background:#f8ffff;">
                    <div>
                        <i class="fas fa-map-location-dot" style="font-size:38px;color:#00aeb8;margin-bottom:12px;"></i>
                        <h3 style="margin:0 0 8px;color:#12232d;">File Peta Belum Ditemukan</h3>
                        <p style="margin:0;">Pastikan file ada di <b>public/assets/peta/tbc.geojson</b>.</p>
                    </div>
                </div>
            `;
        });
});
</script>

<?= $this->include('layout/footer') ?>