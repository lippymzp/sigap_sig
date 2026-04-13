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

<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand logo" href="#">LOGO</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item"><a class="nav-link">Beranda</a></li>
        <li class="nav-item"><a class="nav-link">Tentang Kami</a></li>

        <!-- DROPDOWN -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">
            Penyakit
          </a>

          <ul class="dropdown-menu shadow-lg p-2 border-0">
            <li><a class="dropdown-item">Demam Berdarah</a></li>
            <li><a class="dropdown-item">Tuberkulosis</a></li>
            <li><a class="dropdown-item">Pneumonia</a></li>
            <li><a class="dropdown-item">Diare</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link">Kontak</a></li>

      </ul>
    </div>
  </div>
</nav>

<div style="margin-top:80px"></div>