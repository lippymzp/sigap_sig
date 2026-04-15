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

</head>

<body>

<?php 
$uri = service('uri')->getSegment(1);

// halaman yang BOLEH tampil login
$showLoginPages = ['dbd','tbc','pneumonia','diare'];
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
  <div class="container">

    <!-- LOGO -->
    <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">
      SIGAP
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENU -->
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- BERANDA -->
        <li class="nav-item">
          <a class="nav-link <?= ($uri == '' ? 'active-menu' : '') ?>" href="<?= base_url('/') ?>">
            Beranda
          </a>
        </li>

        <!-- TENTANG -->
        <li class="nav-item">
          <a class="nav-link <?= ($uri == 'tentang' ? 'active-menu' : '') ?>" href="#">
            Tentang Kami
          </a>
        </li>

        <!-- DROPDOWN PENYAKIT -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= in_array($uri, $showLoginPages) ? 'active-menu' : '' ?>" data-bs-toggle="dropdown">
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
          <a class="nav-link <?= ($uri == 'kontak' ? 'active-menu' : '') ?>" href="<?= base_url('kontak') ?>">
            Kontak
          </a>
        </li>

        <!-- 🔥 LOGIN (HANYA DI HALAMAN PENYAKIT) -->
        <?php if (in_array($uri, $showLoginPages)): ?>
        <li class="nav-item ms-3">
          <a href="<?= base_url('/login?penyakit=' . ($penyakit ?? '')) ?>" 
            class="btn btn-login">
            Login
          </a>
        </li>
        <?php endif; ?>

      </ul>
    </div>

  </div>
</nav>

<!-- SPACING NAVBAR -->
<div style="margin-top:90px"></div>