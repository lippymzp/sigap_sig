<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rekap Skrining</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f5f6f8;
    }

    .main-content {
      padding: 30px 35px;
    }

    .title {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 30px;
    }

    /* WRAPPER (biar gambar bisa keluar) */
    .card-wrapper {
      position: relative;
      margin-bottom: 40px;
      overflow: visible;
    }

    /* CARD */
    .card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: linear-gradient(135deg, #4bb6b7, #1ea896);
      border-radius: 18px;
      padding: 20px 20px;
      color: white;
      position: relative;
      min-height: 130px;
    }

    /* TEXT */
    .card-text {
      max-width: 55%;
      z-index: 2;
    }

    .card-text h2 {
      font-size: 26px;
      margin-bottom: 12px;
    }

    .card-text p {
      font-size: 15px;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .card-text button {
      background: #e6f0f0;
      border: none;
      padding: 12px 20px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: 600;
      color: #1ea896;
    }

    /* IMAGE */
    .card-image {
      position: absolute;
      right: 25px;
      bottom: 0;
      z-index: 1;
    }

    .card-image img {
      width: 230px;
      position: relative;
      top: 0px; /* keluar ke atas tapi aman */
    }

    /* IMAGE 2 */
    .card-image.gejala-img img {
      width: 170px;
      top: 0px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .card {
        flex-direction: column;
        text-align: center;
        padding: 25px;
      }

      .card-text {
        max-width: 100%;
        margin-bottom: 20px;
      }

      .card-image {
        position: static;
      }

      .card-image img {
        width: 100px;
        top: 0;
      }
    }
  </style>
</head>
<body>

  <div class="main-content">
    <h1 class="title">Rekap Skrining</h1>

    <!-- Card 1 -->
    <div class="card-wrapper">
      <div class="card">
        <div class="card-text">
          <h2>Skrining Lingkungan</h2>
          <p>
            Fitur Skrining Lingkungan menilai risiko DBD berdasarkan kondisi lingkungan.
          </p>
          <button>Lihat Rekapan</button>
        </div>
        <div class="card-image">
          <img src="img/dbd_skrining_l.png" alt="Lingkungan">
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="card-wrapper">
      <div class="card">
        <div class="card-text">
          <h2>Skrining Gejala</h2>
          <p>
            Fitur Skrining Gejala digunakan untuk menilai kemungkinan DBD berdasarkan gejala yang dialami.
          </p>
          <button>Lihat Rekapan</button>
        </div>
        <div class="card-image gejala-img">
          <img src="img/dbd_skrining_g.png" alt="Gejala">
        </div>
      </div>
    </div>

  </div>

</body>
</html>