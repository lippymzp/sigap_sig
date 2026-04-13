<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SIGAP</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>

<?php $uri = service('uri')->getSegment(1); ?>

<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand logo" href="<?= base_url('/') ?>">LOGO</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

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

        <!-- DROPDOWN -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= ($uri == 'penyakit' ? 'active-menu' : '') ?>" data-bs-toggle="dropdown">
            Penyakit
          </a>

          <ul class="dropdown-menu shadow-lg p-2 border-0">
            <li><a class="dropdown-item" href="#">Demam Berdarah</a></li>
            <li><a class="dropdown-item" href="#">Tuberkulosis</a></li>
            <li><a class="dropdown-item" href="#">Pneumonia</a></li>
            <li><a class="dropdown-item" href="#">Diare</a></li>
          </ul>
        </li>

        <!-- KONTAK -->
        <li class="nav-item">
          <a class="nav-link <?= ($uri == 'kontak' ? 'active-menu' : '') ?>" href="<?= base_url('kontak') ?>">
            Kontak
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<div style="margin-top:80px"></div>