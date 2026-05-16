<?php $this->setVar('penyakit', 'pneumonia'); ?>
<?php 
$this->setVar('show_footer_maskot', true);
$this->setVar('footer_maskot', 'cynex.png');
?>
<?= $this->include('layout/header') ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- HERO BANNER -->
<section class="pneu-hero text-white mb-4">
<div class="container">
<div class="row align-items-center">

<div class="col-md-6">
    <h1>Pneumonia</h1>
    <p>
    Tau ga sih, Apa Itu Pneumonia ?   
</p> 
<p>
        Pneumonia adalah infeksi pada paru-paru yang menyebabkan kantung udara (alveoli) terisi cairan atau nanah, 
        sehingga mengganggu proses pernapasan.
    </p>
   
<!-- BUTTON -->
<a href="<?= base_url('pneumonia-funfact') ?>" class="btn-gradient">
    Pelajari selengkapnya →
</a>

<style>
.btn-gradient {
    display: inline-flex;
    align-items: center;
    gap: 10px;

    padding: 14px 28px;
    border-radius: 18px;
    text-decoration: none;

    font-size: 18px;
    font-weight: 600;
    color: #ffffff;

    background: linear-gradient(
        135deg,
        #1fb5a9,   /* kiri (toska) */
        #6fd3d8    /* kanan (biru muda soft) */
    );

    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    transition: all 0.3s ease;
}

/* hover biar hidup */
.btn-gradient:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.3);
}
</style>
</div>

<div class="col-md-6 text-center">
   
</div>
</div>
</div>
</section>


<style>
/* ================= HERO ================= */
.pneu-hero{
    background: linear-gradient(135deg,#00bcd4,#36d1dc,#5b86e5);
    padding: 70px 0;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
}
.pneu-hero h1{ font-size: 58px; font-weight: 700; margin-bottom: 18px;}
.pneu-hero p{font-size: 16px; line-height: 1.8; max-width: 520px; }
.hero-btn{ background: #00a8cc; color: #fff; padding: 14px 30px; border-radius: 50px; font-weight: 600; border: none;}

.hero-btn:hover{
    background:#0088aa;
    color:#fff;
}

.pneu-hero {
    height: 400px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    padding: 40px 20px;
    color: white;

    background: 
    linear-gradient(
        to right,
        rgba(0, 206, 209, 0.9) 40%,   /* Menggunakan Dark Turquoise #00CED1 */
        rgba(0, 206, 209, 0.3) 70%,
        rgba(0, 206, 209, 0) 100%
    ),
    url("<?= base_url('img/pneumonia.png') ?>");

    background-size: cover;
    background-position: right center;
    background-repeat: no-repeat;
}

@keyframes floatHero{
    0%{transform:translateY(0);}
    50%{transform:translateY(-10px);}
    100%{transform:translateY(0);}
}
.grafik-container{
    width: 100%;
    max-width: 1000px;
    margin: auto;
}

/* BUTTON POSISI */
.btn-wrapper{
    display: flex;
    justify-content: flex-end;
    margin-top: 15px;
}

/* BUTTON */
.btn-selengkapnya{
    background: linear-gradient(
        135deg,
        #14c7cf,
        #18b7d3
    );

    color: white;
    text-decoration: none;

    padding: 12px 24px;
    border-radius: 14px;

    font-size: 14px;
    font-weight: 600;

    box-shadow: 0 4px 12px rgba(0,0,0,0.15);

    transition: 0.3s;
}

.btn-selengkapnya:hover{
    transform: translateY(-2px);

    background: linear-gradient(
        135deg,
        #11b8c0,
        #149fc0
    );

    color: white;
}
/* ================= FILTER ================= */
.filter-container {
    display:flex;
    gap:15px;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.filter-box {
    display:flex;
    align-items:center;
    gap:8px;
    background:#f5f5f5;
    padding:8px 12px;
    border-radius:10px;
}

.filter-box select {
    border:none;
    background:transparent;
    outline:none;
}

.main-layout {
    display:flex;
    gap:20px;
    align-items:flex-start;
}

.chart-container {
    flex:3;
    height:350px;
}

.side-container {
    flex:1;
    display:flex;
    flex-direction:column;
    gap:20px;
}

.info-box {
    background:#cfe3e3;
    padding:15px;
    border-radius:12px;
}

.info-row {
    display:flex;
    justify-content:space-between;
    margin-bottom:6px;
}

.legend-box {
    border:1px solid #ccc;
    padding:10px;
    border-radius:10px;
}

.legend-item {
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom:5px;
}

.legend-color {
    width:15px;
    height:15px;
    border-radius:3px;
}
</style>

<!-- FITUR -->

<section class="container mt-5 text-center" data-aos="fade-up">

<h4 class="mb-4" style="color:#1aa6a6; font-weight:600;">
    Fitur Menarik yang Bisa Dimanfaatkan
</h4>
<div class="row g-4 justify-content-center">
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- GRAFIK FITUR -->
<div class="col-md-3">
<a href="#grafik" class="fitur-box d-block" data-target="grafik">
    <div class="icon">
        <span></span><span></span><span></span>
    </div>
    Grafik Kesehatan
</a>
</div>
<!-- MAP FITUR -->
<div class="col-md-3">
<a href="#mapSection" class="fitur-box d-block" data-target="map">
    <div class="icon">
        <span></span><span></span><span></span>
    </div>
    Peta Persebaran
</a>
</div>
<!-- ARTIKEL FITUR-->
<div class="col-md-3">
<a href="#artikelSection" class="fitur-box d-block" data-target="artikel">
    <div class="icon">
        <span></span><span></span><span></span>
    </div>
    Artikel
</a>
</div>
<!-- SKRINING FITUR -->
<div class="col-md-3">

<a href="#skriningSection" class="fitur-box d-block" data-target="skrining">
    <div class="icon">
        <span></span><span></span><span></span>
    </div>
    Skrining
</a>
</div>
</div>
</section>
<style>
/* BOX FITUR */
.fitur-box {
    padding: 15px; border-radius: 20px; text-align: center; color: white;
    background: linear-gradient(135deg, #20c997, #0dcaf0);
    text-decoration: none; box-shadow: 0 6px 15px rgba(0,0,0,0.15); transition: 0.3s;
}
/* HOVER */
.fitur-box:hover {
    transform: translateY(-5px); color: white;
}
/* AKTIF */
.fitur-box.active {
    transform: scale(1.05); box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}
/* ICON GARIS */
.icon {
    margin-bottom: 10px;
}
.icon span {
    display: inline-block; width: 3px; height: 18px; background: white; margin: 0 2px; border-radius: 2px;
}
.icon span:nth-child(2) {
    height: 24px;
}
.icon span:nth-child(3) {height: 14px;}
</style>

<script>
const fitur = document.querySelectorAll('.fitur-box');

fitur.forEach(btn => {
    btn.addEventListener('click', function(e) {

        if(this.getAttribute("href") === "#"){
            e.preventDefault();
        }

        // aktif efek
        fitur.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>


<!-- INSIGHT -->
<section id="artikelSection" class="container mt-5" data-aos="fade-up">

<h6 class="text-center text-muted">Insights</h6>
<h4 class="text-center mb-4 fw-bold">Telusuri Informasi Berikut</h4>

<?php
$conn = mysqli_connect("localhost","root","","sigap_db");

$queryBerita = mysqli_query($conn, "
    SELECT *
    FROM berita
    WHERE id_penyakit = 3
    ORDER BY tanggal_berita DESC
");

$totalBerita = mysqli_num_rows($queryBerita);
?>

<div class="news-slider">

    <button class="slide-btn prev-btn">
        &#10094;
    </button>

    <div class="news-track">

        <?php if($totalBerita > 0): ?>

            <?php while($berita = mysqli_fetch_assoc($queryBerita)): ?>

                <?php
                // CEK GAMBAR
                $gambar = trim((string)($berita['gambar_berita'] ?? ''));

                // FILE ASLI
                $pathFile = FCPATH . 'uploads/berita/' . $gambar;

                // DEFAULT DUMMY
                $gambarFix = base_url('uploads/berita/default.jpeg');

                // CEK GAMBAR VALID
                if(
                    $gambar !== '' &&
                    strtolower($gambar) !== 'null' &&
                    file_exists($pathFile)
                ){
                    $gambarFix = base_url('uploads/berita/' . $gambar);
                }

                // CEK URL
                $urlBerita = !empty($berita['url_berita'])
                    ? $berita['url_berita']
                    : '#';
                ?>

                <!-- CARD BERITA -->
                <div class="news-card">

                    <img 
                        src="<?= $gambarFix ?>" 
                        alt="<?= $berita['judul_berita'] ?>"
                    >

                    <div class="news-content">

                        <span class="news-badge">
                            Pneumonia
                        </span>

                        <h5>
                            <?= $berita['judul_berita'] ?>
                        </h5>

                        <p>
                            <?= substr(strip_tags($berita['deskripsi_berita']),0,100) ?>...
                        </p>

                        <?php
                        $urlBerita = base_url('beritapneumonia/viewUser/' . $berita['id_berita']);
                        ?>

                        <a 
                            href="<?= $urlBerita ?>" 
                            class="news-link"
                        >
                            Baca Selengkapnya
                        </a>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <!-- DUMMY CARD 1 -->
            <div class="news-card">

                <img 
                    src="<?= base_url('uploads/berita/default.jpeg') ?>" 
                    alt=""
                >

                <div class="news-content">

                    <span class="news-badge">
                        Informasi
                    </span>

                    <h5>
                        Belum Ada Berita Pneumonia
                    </h5>

                    <p>
                        Saat ini belum tersedia artikel atau berita terbaru mengenai pneumonia.
                    </p>

                    <a href="#" class="news-link">
                        Nantikan Update
                    </a>

                </div>

            </div>

            <!-- DUMMY CARD 2 -->
            <div class="news-card">

                <img 
                    src="<?= base_url('uploads/berita/default.jpeg') ?>" 
                    alt=""
                >

                <div class="news-content">

                    <span class="news-badge">
                        Edukasi
                    </span>

                    <h5>
                        Informasi Akan Segera Ditambahkan
                    </h5>

                    <p>
                        Tim kami sedang menyiapkan informasi kesehatan pneumonia terbaru.
                    </p>

                    <a href="#" class="news-link">
                        Segera Hadir
                    </a>

                </div>

            </div>

            <!-- DUMMY CARD 3 -->
            <div class="news-card">

                <img 
                    src="<?= base_url('uploads/berita/default.jpeg') ?>" 
                    alt=""
                >

                <div class="news-content">

                    <span class="news-badge">
                        Kesehatan
                    </span>

                    <h5>
                        Tetap Jaga Kesehatan Paru-Paru
                    </h5>

                    <p>
                        Hindari asap rokok dan jaga daya tahan tubuh untuk mencegah pneumonia.
                    </p>

                    <a href="#" class="news-link">
                        Pelajari
                    </a>

                </div>

            </div>

        <?php endif; ?>

    </div>

    <button class="slide-btn next-btn">
        &#10095;
    </button>

</div>

</section>

<style>

/* ========================= NEWS SLIDER ========================= */

.news-slider{
    position: relative;
    overflow: hidden;
    padding: 10px 45px;
}

.news-track{
    display: flex;
    gap: 20px;

    overflow-x: auto;
    scroll-behavior: smooth;

    scrollbar-width: none;
}

.news-track::-webkit-scrollbar{
    display: none;
}

/* CARD */
.news-card{
    min-width: 380px;
    max-width: 380px;
    min-height: 470px;

    background: white;
    border-radius: 22px;

    overflow: hidden;

    box-shadow: 0 8px 22px rgba(0,0,0,0.12);

    transition: 0.3s;
    flex-shrink: 0;

    display: flex;
    flex-direction: column;
}

/* IMAGE */
.news-card img{
    width: 100%;
    height: 220px;
    object-fit: cover;
    background: #f1f1f1;
}

/* CONTENT */
.news-content{
    padding: 20px;
    flex: 1;

    display: flex;
    flex-direction: column;
}

/* LINK DI BAWAH */
.news-link{
    margin-top: auto;

    text-decoration: none;

    color: #11b7c4;
    font-weight: 700;

    transition: 0.3s;
}

.news-card:hover{
    transform: translateY(-6px);
}

/* IMAGE */
.news-card img{
    width: 100%;
    height: 210px;
    object-fit: cover;
    background: #f1f1f1;
}

/* CONTENT */
.news-content{
    padding: 20px;
}

/* BADGE */
.news-badge{
    display: inline-block;

    background: #dff7f8;
    color: #13aab5;

    font-size: 12px;
    font-weight: 700;

    padding: 6px 12px;

    border-radius: 6px; /* sebelumnya 50px */

    margin-bottom: 14px;
}

.news-content h5{
    font-size: 20px;
    font-weight: 700;

    margin-bottom: 12px;
    color: #173b4d;
}

.news-content p{
    font-size: 14px;
    color: #6c757d;

    line-height: 1.7;
    margin-bottom: 18px;
}

/* LINK */
.news-link{
    text-decoration: none;

    color: #11b7c4;
    font-weight: 700;

    transition: 0.3s;
}

.news-link:hover{
    color: #0a8d98;
}

/* BUTTON */
.slide-btn{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);

    width: 42px;
    height: 42px;

    border: none;
    border-radius: 50%;

    background: white;
    color: #14b9c8;

    font-size: 20px;
    font-weight: bold;

    box-shadow: 0 4px 12px rgba(0,0,0,0.15);

    z-index: 10;

    cursor: pointer;
    transition: 0.3s;
}

.slide-btn:hover{
    background: #14b9c8;
    color: white;
}

.prev-btn{
    left: 0;
}

.next-btn{
    right: 0;
}

/* RESPONSIVE */
@media(max-width:768px){

    .news-card{
        min-width: 270px;
        max-width: 270px;
    }

    .news-card img{
        height: 180px;
    }

    .news-content h5{
        font-size: 18px;
    }

}
 /* CSS GRAFIK */
#grafik{
    margin-top:40px;
}

.judul-grafik{
    color:#00a8b5;
    font-weight:700;
    font-size:42px;
    margin-bottom:15px;
}
 
.card-grafik{
    background:#f8f8f8;
    border:4px solid #1e88e5;
    border-radius:25px;
    padding:25px;
}

.chart-container{
    position:relative;
    width:100%;
    height:500px;
}

.btn-wrapper{
    margin-top:20px;
    text-align:right;
}

.btn-selengkapnya{
    background:linear-gradient(to right,#00bcd4,#4dd0e1);
    color:white;
    padding:14px 28px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
    display:inline-block;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
}

.btn-selengkapnya:hover{
    color:white;
    transform:scale(1.03);
}
 /* CSS RINGKASAN DATA PNEUMONIA */
.ringkasan-box{
    background: linear-gradient(135deg,#c9f5f7,#e8ffff);
    border:2px solid #12c4d3;
    border-radius:20px;
    padding:35px;
}

.ringkasan-content{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:30px;
}

.ringkasan-text h2{
    color:#0aa9b5;
    font-weight:700;
    margin-bottom:20px;
}

.ringkasan-text p{
    font-size:16px;
    color:#555;
    margin-bottom:12px;
}

.highlight-red{
    color:red;
    font-weight:700;
}

.highlight-blue{
    color:#11b7c4;
    font-weight:700;
}

.ringkasan-image img{
    width:220px;
    opacity:0.9;
}

@media(max-width:768px){

    .ringkasan-content{
        flex-direction:column;
        text-align:center;
    }

    .ringkasan-image img{
        width:160px;
    }

}
</style>

<script>

const newsTrack = document.querySelector('.news-track');
const nextBtn = document.querySelector('.next-btn');
const prevBtn = document.querySelector('.prev-btn');

nextBtn.addEventListener('click', () => {

    newsTrack.scrollBy({
        left: 340,
        behavior: 'smooth'
    });

});

prevBtn.addEventListener('click', () => {

    newsTrack.scrollBy({
        left: -340,
        behavior: 'smooth'
    });

});

</script>

<div class="carousel-wrapper">
</div>

</section>
<!-- CTA SKRINING -->
<section id="skriningSection" class="container mt-5" data-aos="zoom-in">

<div class="cta-box shadow-sm">

    <h5 class="fw-bold">
        Mengalami Gejala?
    </h5>

    <p>
        Tubuhmu sedang memberi sinyal, jangan diabaikan.<br>
        Yuk, kenali gejala pneumonia dan lakukan
        <span style="color:red;">skrining</span> sejak dini!
    </p>

    <a href="<?= base_url('skriningpneumonia') ?>"
       class="btn btn-teal px-4 py-2 shadow">

        Mulai Skrining

    </a>
</div>

</section>
<style>


/* CTA SKRINING*/
.cta-box{
    border-radius: 20px;
    border: 2px solid #16c7cf;
    background: white;

    padding: 40px;
    text-align: center;
}

</style>

<!-- GRAFIK -->
<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php

$conn = mysqli_connect("localhost","root","","sigap_db");

$bulanLabels = [
    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

$laki = array_fill(0, 12, 0);
$wanita = array_fill(0, 12, 0);

$query = mysqli_query($conn, "

    SELECT 
        MONTH(tgl_kunjungan) as bulan,
        jenis_kelamin,
        COUNT(*) as total

    FROM pasien

    WHERE YEAR(tgl_kunjungan) = 2025

    GROUP BY 
        MONTH(tgl_kunjungan),
        jenis_kelamin

");

while($row = mysqli_fetch_assoc($query)){

    $index = $row['bulan'] - 1;

    if(
        strtolower($row['jenis_kelamin']) == 'laki-laki'
        || strtolower($row['jenis_kelamin']) == 'laki laki'
    ){

        $laki[$index] = (int)$row['total'];

    }else{

        $wanita[$index] = (int)$row['total'];

    }
}

?>


<div id="grafik" class="container">

    <h1 class="judul-grafik">
        Grafik Pneumonia
    </h1>

    <div class="card-grafik">

        <div class="chart-container">
            <canvas id="chartKasus"></canvas>
        </div>

    </div>

    <div class="btn-wrapper">

        <a href="<?= base_url('grafik_pneumonia') ?>" class="btn-selengkapnya">
            Lihat selengkapnya →
        </a>

    </div>

</div>

<script>

const labels = <?= json_encode($bulanLabels); ?>;

const dataLaki = <?= json_encode($laki); ?>;
const dataWanita = <?= json_encode($wanita); ?>;

const ctx = document.getElementById('chartKasus');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: labels,

        datasets: [

            {
                label: 'Laki-laki',
                data: dataLaki,
                backgroundColor: '#1f6f78',
                borderRadius: 6
            },

            {
                label: 'Wanita',
                data: dataWanita,
                backgroundColor: '#a7d7d3',
                borderRadius: 6
            }

        ]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        plugins: {

            legend: {
                position: 'top'
            }

        },

        scales: {

            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 10
                }
            }

        }

    }

});
</script>


</script>

<!-- PETA -->
<section id="mapSection" class="container mt-5" data-aos="fade-up">

    <div class="section-card">

        <!-- ========================= HALAMAN MAP ========================== -->
        <div id="mapPage">

            <div class="section-block">

                <div class="section-header">
                    <div>
                        <h5>Peta Interaktif Penyebaran</h5>
                        <p class="sub">Visualisasi kepadatan kasus berdasarkan wilayah</p>
                    </div>
                </div>

                <div class="inner-card">

                    <!-- FILTER -->
                    <div class="filter-wrapper">

                        <div class="filter-left">

                            <div class="filter-group">
                                <label>Pilih Bulan</label>
                                <select id="filterBulan">
                                    <option value="">All</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Periode</label>
                                <select id="filterTahun">
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Jenis Kelamin</label>
                                <select id="filterJk">
                                    <option value="">All</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                        </div>

                        <div class="filter-right">
                            <button type="button" id="btnFilter" class="btn-filter">Filter</button>
                            <button type="button" id="btnReset" class="btn-reset">Reset</button>
                        </div>

                    </div>

                    <!-- MAP -->
                    <div class="map-wrapper">

    <div id="mapPneu"></div>

    <!-- KETERANGAN -->
    <div class="map-legend-box">
        <h6>Keterangan:</h6>

        <div class="legend-item">
            <span class="legend-color legend-tinggi"></span>
            <b>Risiko Tinggi</b>
        </div>

        <div class="legend-item">
            <span class="legend-color legend-sedang"></span>
            <b>Risiko Sedang</b>
        </div>

        <div class="legend-item">
            <span class="legend-color legend-rendah"></span>
            <b>Risiko Rendah</b>
        </div>
    </div>

    <!-- BOX MINI AIR QUALITY -->
    <div class="aqi-mini-box" id="aqiMiniBox">
        <div class="aqi-mini-main">
            <span class="aqi-mini-icon">AQI</span> :
            <span id="aqiMiniValue">...</span>
        </div>
        <div class="aqi-mini-status" id="aqiMiniStatus">
            Memuat...
        </div>
    </div>

    <!-- POPUP DETAIL AIR QUALITY -->
    <div class="aqi-popup-box" id="aqiPopupBox">
        <div class="aqi-popup-title" id="aqiPopupTitle">
            Kualitas Udara Jember
        </div>

        <div class="aqi-popup-card">

            <div class="aqi-popup-main">
                <span class="aqi-popup-icon">AQI</span> :
                <span id="aqiPopupValue">...</span>
            </div>

            <span class="aqi-popup-status" id="aqiPopupStatus">
                Memuat...
            </span>

            <div class="aqi-popup-info">
                <p>📍 <span id="aqiLocation">Jember, East Java, Indonesia</span></p>
                <p>🌡 Suhu : <span id="aqiTemp">-</span>°C</p>
                <p>💧 Kelembaban : <span id="aqiHumidity">-</span>%</p>
                <p>🌬 Tekanan : <span id="aqiPressure">-</span> hPa</p>
                <p>⏱ Diperbarui : <span id="aqiUpdated">-</span></p>
            </div>

            <div class="aqi-index-list">
                <b>Indeks Kualitas Udara (AQI)</b>

                <p class="aqi-good">0 - 50 : Baik</p>
                <p class="aqi-moderate">51 - 100 : Sedang</p>
                <p class="aqi-sensitive">101 - 150 : Tidak Sehat (Sensitif)</p>
                <p class="aqi-unhealthy">151 - 200 : Tidak Sehat</p>
                <p class="aqi-very">201 - 300 : Sangat Tidak Sehat</p>
                <p class="aqi-hazard">301+ : Berbahaya</p>
            </div>

        </div>
    </div>
    <!-- END AIR QUALITY -->

</div>

                </div>

            </div>

        </div>

        <!-- ========================= HALAMAN DETAIL ========================== -->
        <div id="detailPage" style="display:none;">

            <div class="detail-card">

                <div class="detail-header">
                    <h5 id="detailTitleHeader">Peta Sebaran Kasus 2025</h5>
                </div>

                <div class="detail-inner">

                    <div class="detail-top">
                        <div>
                            <h3 id="detailWilayah">Kecamatan Ajung</h3>

                            <p class="detail-label">Total Kasus</p>
                            <h4 id="detailTotal">0 kasus</h4>

                            <p class="detail-label" id="detailBulanLabel">Kasus Baru</p>
                            <h4 id="detailKasusBaru">0 kasus</h4>
                        </div>

                        <span id="detailKategori" class="badge-risk rendah">Rendah</span>
                    </div>

                    <h4 class="chart-title">10 Wilayah dengan Kasus Tertinggi</h4>

                    <div id="rankingChart" class="ranking-chart"></div>

                </div>

                <div class="detail-footer">
                    <button type="button" class="btn-kembali" onclick="backToMap()">Kembali</button>
                </div>

            </div>

        </div>

    </div>

</section>


<!-- SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    /* =======================
       DATA PNEUMONIA
    ======================= */
    var dataPneu = <?= json_encode($pneumonia ?? []) ?>;

    var map;
    var geoLayer;
    var geoJsonData;
    var currentDataFinal = {};

    function fixNama(nama){
        return (nama || "")
            .toString()
            .toLowerCase()
            .trim()
            .replace(/desa/g, "")
            .replace(/kelurahan/g, "")
            .replace(/kecamatan/g, "")
            .replace(/\./g, "")
            .replace(/-/g, " ")
            .replace(/_/g, " ")
            .replace(/\s+/g, " ")
            .replace(/[^a-z0-9 ]/g, "")
            .trim();
    }

    function fixKey(nama){
        var key = fixNama(nama).replace(/\s+/g, "");

        var alias = {
            "klompongan": "klompangan",
            "klomplangan": "klompangan",
            "rowoindah": "rowoindah",
            "pancakarya": "pancakarya",
            "sukamakmur": "sukamakmur",
            "wirowongso": "wirowongso",
            "mangaran": "mangaran",
            "ajung": "ajung"
        };

        if(alias[key]){
            return alias[key];
        }

        return key;
    }

    function getDesa(item){
        return item.desa || item.DESA ||
               item.kelurahan || item.KELURAHAN ||
               item.wilayah || item.WILAYAH ||
               item.nama_desa || item.NAMA_DESA ||
               item.nama_kelurahan || item.NAMA_KELURAHAN ||
               item.nama_wilayah || item.NAMA_WILAYAH ||
               item.NAMOBJ || item.namobj ||
               item.WADMKD || item.wadmkd || "";
    }

    function getKasus(item){
        var nilai = item.kasus || item.KASUS ||
                    item.jumlah_kasus || item.JUMLAH_KASUS ||
                    item.total_kasus || item.TOTAL_KASUS ||
                    item.total || item.TOTAL ||
                    item.jumlah || item.JUMLAH ||
                    item.nilai || item.NILAI || 0;

        nilai = nilai.toString().replace(/[^0-9]/g, "");

        return parseInt(nilai || 0);
    }

    function getTahun(item){
        var tahun = item.tahun || item.TAHUN ||
                    item.periode || item.PERIODE ||
                    item.year || item.YEAR || "";

        if(!tahun){
            var tanggal = item.tanggal || item.TANGGAL ||
                          item.tgl || item.TGL ||
                          item.created_at || item.date || "";

            if(tanggal){
                tahun = tanggal.toString().substring(0, 4);
            }
        }

        return tahun;
    }

    function getBulan(item){
        var bulan = item.bulan || item.BULAN ||
                    item.month || item.MONTH || "";

        if(!bulan){
            var tanggal = item.tanggal || item.TANGGAL ||
                          item.tgl || item.TGL ||
                          item.created_at || item.date || "";

            if(tanggal){
                bulan = parseInt(tanggal.toString().substring(5, 7));
            }
        }

        return bulan;
    }

    function getJk(item){
        return item.jenis_kelamin || item.JENIS_KELAMIN ||
               item.jk || item.JK ||
               item.gender || item.GENDER ||
               item.kelamin || item.KELAMIN || "";
    }

    function namaBulan(angka){
        var bulan = {
            "1":"Januari",
            "2":"Februari",
            "3":"Maret",
            "4":"April",
            "5":"Mei",
            "6":"Juni",
            "7":"Juli",
            "8":"Agustus",
            "9":"September",
            "10":"Oktober",
            "11":"November",
            "12":"Desember"
        };

        return bulan[angka] || "Semua Bulan";
    }

    function kategoriKasus(total){
        if(total >= 45){
            return "tinggi";
        }else if(total >= 25){
            return "sedang";
        }else{
            return "rendah";
        }
    }

    function warnaKategori(kategori){
        if(kategori === "tinggi"){
            return "#ff3131";
        }

        if(kategori === "sedang"){
            return "#ffff00";
        }

        return "#42a447";
    }

    function textKategori(kategori){
        if(kategori === "tinggi"){
            return "Tinggi";
        }

        if(kategori === "sedang"){
            return "Sedang";
        }

        return "Rendah";
    }

    function buildDataFinal(){
        var bulan = document.getElementById("filterBulan").value;
        var tahun = document.getElementById("filterTahun").value;
        var jk = document.getElementById("filterJk").value;

        var hasil = {};

        dataPneu.forEach(function(item){

            var itemTahun = getTahun(item).toString();
            var itemBulan = getBulan(item).toString();
            var itemJk = getJk(item).toString().toLowerCase().trim();
            var filterJk = jk.toString().toLowerCase().trim();

            if(tahun && itemTahun && itemTahun !== tahun){
                return;
            }

            if(bulan && itemBulan && itemBulan !== bulan){
                return;
            }

            if(jk && itemJk && itemJk !== filterJk){
                return;
            }

            var desaAsli = getDesa(item);
            var desaKey = fixKey(desaAsli);

            if(!desaKey){
                return;
            }

            if(!hasil[desaKey]){
                hasil[desaKey] = {
                    nama: desaAsli,
                    total: 0,
                    kasusBaru: 0,
                    kategori: "rendah"
                };
            }

            var jumlahKasus = getKasus(item);

            hasil[desaKey].total += jumlahKasus;
            hasil[desaKey].kasusBaru += jumlahKasus;

        });

        for(var key in hasil){
            hasil[key].kategori = kategoriKasus(hasil[key].total);
        }

        currentDataFinal = hasil;

        return hasil;
    }

    function getNamaGeo(feature){
        return feature.properties.NAMOBJ ||
               feature.properties.namobj ||
               feature.properties.nama ||
               feature.properties.name ||
               feature.properties.DESA ||
               feature.properties.desa ||
               feature.properties.WADMKD ||
               feature.properties.wadmkd ||
               feature.properties.KELURAHAN ||
               feature.properties.kelurahan ||
               "Wilayah";
    }

    /* =======================
       CHART LAMA TETAP ADA
    ======================= */
    const ctx = document.getElementById('chartPneu');

    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari','Februari','Maret','April','Mei'],
                datasets: [
                    {
                        label: 'Sembuh',
                        data: [110,90,70,50,160]
                    },
                    {
                        label: 'Pengobatan',
                        data: [95,155,120,90,95]
                    },
                    {
                        label: 'Meninggal',
                        data: [40,20,40,40,60]
                    }
                ]
            }
        });
    }

/* =======================
   AIR QUALITY INDEX - IQAIR API
======================= */

var IQAIR_API_KEY = "d1160a02-9aa4-4404-86cd-4514f1e18d18";

/*
    Koordinat ini bisa kamu ubah.
    Saat ini saya pakai area Jember.
*/
var AQI_LAT = -8.1724;
var AQI_LON = 113.6425;

var AQI_NAMA_LOKASI = "Kecamatan Ajung, Kabupaten Jember, Jawa Timur, Indonesia";
var AQI_JUDUL_POPUP = "Kualitas Udara Kecamatan Ajung";

function getKategoriAQI(aqi){
    aqi = parseInt(aqi || 0);

    if(aqi <= 50){
        return {
            teks: "Baik",
            className: "aqi-status-baik"
        };
    }

    if(aqi <= 100){
        return {
            teks: "Sedang",
            className: "aqi-status-sedang"
        };
    }

    if(aqi <= 150){
        return {
            teks: "Tidak Sehat (Sensitif)",
            className: "aqi-status-sensitif"
        };
    }

    if(aqi <= 200){
        return {
            teks: "Tidak Sehat",
            className: "aqi-status-tidak-sehat"
        };
    }

    if(aqi <= 300){
        return {
            teks: "Sangat Tidak Sehat",
            className: "aqi-status-sangat-tidak-sehat"
        };
    }

    return {
        teks: "Berbahaya",
        className: "aqi-status-berbahaya"
    };
}

function formatTanggalAQI(tanggalApi){
    if(!tanggalApi){
        return "-";
    }

    var tanggal = new Date(tanggalApi);

    if(isNaN(tanggal.getTime())){
        return tanggalApi;
    }

    return tanggal.toLocaleString("id-ID", {
        day: "2-digit",
        month: "long",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit"
    });
}

function setStatusClassAQI(element, className){
    element.classList.remove(
        "aqi-status-baik",
        "aqi-status-sedang",
        "aqi-status-sensitif",
        "aqi-status-tidak-sehat",
        "aqi-status-sangat-tidak-sehat",
        "aqi-status-berbahaya"
    );

    element.classList.add(className);
}

function isiDataAQI(dataApi){

    if(!dataApi || dataApi.status !== "success"){
        document.getElementById("aqiMiniValue").innerText = "-";
        document.getElementById("aqiMiniStatus").innerText = "Gagal";

        document.getElementById("aqiPopupValue").innerText = "-";
        document.getElementById("aqiPopupStatus").innerText = "Data gagal dimuat";

        return;
    }

    var data = dataApi.data;

var pollution = data.current && data.current.pollution
    ? data.current.pollution
    : {};

var weather = data.current && data.current.weather
    ? data.current.weather
    : {};

var aqi = pollution.aqius || 0;
var kategori = getKategoriAQI(aqi);

document.getElementById("aqiMiniValue").innerText = aqi;
document.getElementById("aqiMiniStatus").innerText = kategori.teks;

document.getElementById("aqiPopupTitle").innerText = AQI_JUDUL_POPUP;
document.getElementById("aqiPopupValue").innerText = aqi;
document.getElementById("aqiPopupStatus").innerText = kategori.teks;

document.getElementById("aqiLocation").innerText = AQI_NAMA_LOKASI;
    document.getElementById("aqiTemp").innerText = weather.tp ?? "-";
    document.getElementById("aqiHumidity").innerText = weather.hu ?? "-";
    document.getElementById("aqiPressure").innerText = weather.pr ?? "-";
    document.getElementById("aqiUpdated").innerText = formatTanggalAQI(pollution.ts);

    setStatusClassAQI(
        document.getElementById("aqiMiniStatus"),
        kategori.className
    );

    setStatusClassAQI(
        document.getElementById("aqiPopupStatus"),
        kategori.className
    );
}

function ambilDataAQI(){

    var url = "https://api.airvisual.com/v2/nearest_city" +
              "?lat=" + AQI_LAT +
              "&lon=" + AQI_LON +
              "&key=" + IQAIR_API_KEY;

    fetch(url)
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            isiDataAQI(data);
        })
        .catch(function(error){
            console.error("Gagal mengambil data AQI:", error);

            document.getElementById("aqiMiniValue").innerText = "-";
            document.getElementById("aqiMiniStatus").innerText = "Gagal";

            document.getElementById("aqiPopupValue").innerText = "-";
            document.getElementById("aqiPopupStatus").innerText = "Data gagal dimuat";
        });
}

/* klik AQI dan klik luar untuk tutup */
function aktifkanPopupAQI(){

    var miniBox = document.getElementById("aqiMiniBox");
    var popupBox = document.getElementById("aqiPopupBox");

    if(!miniBox || !popupBox){
        return;
    }

    /* klik box kecil AQI = buka popup */
    miniBox.addEventListener("click", function(e){
        e.stopPropagation();
        popupBox.style.display = "block";
    });

    /* klik popup = tutup popup */
    popupBox.addEventListener("click", function(e){
        e.stopPropagation();
        popupBox.style.display = "none";
    });

    /* klik di mana saja selain box/popup = tutup popup */
    document.addEventListener("click", function(){
        popupBox.style.display = "none";
    });
}

    /* =======================
       MAP BARU
    ======================= */
    function initMap(){
        var mapElement = document.getElementById("mapPneu");

        if(!mapElement){
            return;
        }

        map = L.map("mapPneu", {
            zoomControl: true
        }).setView([-7.9, 112.6], 10);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "Leaflet"
        }).addTo(map);

        aktifkanPopupAQI();
        ambilDataAQI();

        fetch("<?= base_url('assets/peta/pneumonia.geojson') ?>")
            .then(function(res){
                return res.json();
            })
            .then(function(data){
                geoJsonData = data;
                renderGeoJson();
            });

        setTimeout(function(){
            map.invalidateSize();
        }, 300);
    }

    function renderGeoJson(){
        var dataFinal = buildDataFinal();

        if(geoLayer){
            map.removeLayer(geoLayer);
        }

        geoLayer = L.geoJSON(geoJsonData, {

            style: function(feature){

                var nama = getNamaGeo(feature);
                var key = fixKey(nama);
                var item = dataFinal[key];

                var kategori = item ? item.kategori : "rendah";
                var warna = item ? warnaKategori(kategori) : "#d9d9d9";

                return {
                    color: "#23a39a",
                    weight: 2,
                    fillColor: warna,
                    fillOpacity: item ? 0.75 : 0.55
                };
            },

            onEachFeature: function(feature, layer){

                var nama = getNamaGeo(feature);
                var key = fixKey(nama);
                var item = dataFinal[key];

                var total = item ? item.total : 0;
                var kategori = item ? item.kategori : "rendah";

                var statusData = item ? "" : `<br><span class="popup-empty">Data tidak ditemukan</span>`;

                var isiPopup = `
                    <div class="popup-informasi" onclick="showDetailWilayah('${key}', decodeURIComponent('${encodeURIComponent(nama)}'))">
                        <b>Informasi :</b><br>
                        <span>Desa : ${nama}</span><br>
                        <span>Jumlah Kasus : ${total}</span><br>
                        <span>
                            Tingkat Kasus :
                            <b class="popup-${kategori}">${textKategori(kategori)}</b>
                        </span>
                        ${statusData}
                        <hr>
                        <small>Klik untuk selengkapnya...</small>
                    </div>
                `;

                layer.bindPopup(isiPopup, {
                    closeButton: true,
                    className: "popup-info-custom"
                });

                layer.bindTooltip(nama, {
                    permanent: true,
                    direction: "center",
                    className: "label-desa"
                });

                layer.on("click", function(){
                    layer.openPopup();
                });

                layer.on("mouseover", function(){
                    layer.setStyle({
                        weight: 4,
                        fillOpacity: 0.85
                    });
                });

                layer.on("mouseout", function(){
                    geoLayer.resetStyle(layer);
                });
            }

        }).addTo(map);

        map.fitBounds(geoLayer.getBounds());
    }

    window.showDetailWilayah = function(key, namaWilayah){

        var item = currentDataFinal[key];

        if(!item){
            item = {
                nama: namaWilayah,
                total: 0,
                kasusBaru: 0,
                kategori: "rendah"
            };
        }

        var tahun = document.getElementById("filterTahun").value || "2025";
        var bulan = document.getElementById("filterBulan").value || "";

        document.getElementById("mapPage").style.display = "none";
        document.getElementById("detailPage").style.display = "block";

        document.getElementById("detailTitleHeader").innerText = "Peta Sebaran Kasus " + tahun;
        document.getElementById("detailWilayah").innerText = "Kecamatan " + namaWilayah;
        document.getElementById("detailTotal").innerText = item.total + " kasus";

        if(bulan){
            document.getElementById("detailBulanLabel").innerText = "Kasus Baru (" + namaBulan(bulan) + " " + tahun + ")";
        }else{
            document.getElementById("detailBulanLabel").innerText = "Kasus Baru (Semua Bulan " + tahun + ")";
        }

        document.getElementById("detailKasusBaru").innerText = item.kasusBaru + " kasus";

        var badge = document.getElementById("detailKategori");
        badge.innerText = textKategori(item.kategori);
        badge.className = "badge-risk " + item.kategori;

        renderRankingChart();
    }

    window.backToMap = function(){
        document.getElementById("detailPage").style.display = "none";
        document.getElementById("mapPage").style.display = "block";

        setTimeout(function(){
            map.invalidateSize();
        }, 300);
    }

    function renderRankingChart(){
        var chart = document.getElementById("rankingChart");

        var ranking = Object.values(currentDataFinal)
            .sort(function(a, b){
                return b.total - a.total;
            })
            .slice(0, 10);

        if(ranking.length === 0){
            chart.innerHTML = `
                <div class="empty-chart">
                    Tidak ada data yang sesuai filter
                </div>
            `;
            return;
        }

        var max = ranking[0].total || 1;
        var html = "";

        ranking.forEach(function(item){

            var width = (item.total / max) * 100;
            var kategori = item.kategori;

            html += `
                <div class="rank-row">
                    <div class="rank-name">${item.nama.toUpperCase()}</div>

                    <div class="rank-bar-area">
                        <div class="rank-bar ${kategori}" style="width:${width}%;">
                            <span>${item.total}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        chart.innerHTML = html;
    }

    document.getElementById("filterTahun").addEventListener("change", function(){
        renderGeoJson();
    });

    document.getElementById("btnFilter").addEventListener("click", function(){
        renderGeoJson();
    });

    document.getElementById("btnReset").addEventListener("click", function(){
        document.getElementById("filterBulan").value = "";
        document.getElementById("filterTahun").value = "2025";
        document.getElementById("filterJk").value = "";

        renderGeoJson();
    });

    initMap();

});
</script>


<?php
/* RINGKASAN DATA PNEUMONIA  */
$conn = mysqli_connect("localhost","root","","sigap_db");

$dataRingkasan = [];

$tertinggi = [
    'kelurahan' => '-',
    'total' => 0
];

$rataRata = 0;
$diAtasRata = 0;

$queryRingkasan = mysqli_query($conn, "

    SELECT 
        wilayah.kelurahan,
        COUNT(pasien.id_pasien) as total

    FROM pasien

    JOIN wilayah 
        ON wilayah.id_wilayah = pasien.id_wilayah

    GROUP BY wilayah.id_wilayah

    ORDER BY total DESC

");

if($queryRingkasan){

    while($r = mysqli_fetch_assoc($queryRingkasan)){
        $dataRingkasan[] = $r;
    }

    if(count($dataRingkasan) > 0){

        $totalKasus = array_sum(
            array_column($dataRingkasan, 'total')
        );

        $rataRata = round(
            $totalKasus / count($dataRingkasan)
        );

        $tertinggi = $dataRingkasan[0];

        foreach($dataRingkasan as $d){

            if($d['total'] > $rataRata){
                $diAtasRata++;
            }

        }

    }

}
?>

<section class="container mt-5 mb-5">

    <div class="ringkasan-box">

        <div class="ringkasan-content">

            <div class="ringkasan-text">

                <h2>Ringkasan Data</h2>

                <p>
                    Kasus pneumonia tertinggi terjadi di Desa 
                    <span class="highlight-red">
                        <?= $tertinggi['kelurahan'] ?>
                    </span>

                    dengan total

                    <span class="highlight-red">
                        <?= $tertinggi['total'] ?> kasus
                    </span>
                </p>

                <p>
                    Terdapat 
                    <span class="highlight-blue">
                        <?= $diAtasRata ?>
                    </span>

                    desa dengan kasus di atas rata-rata
                </p>

                <p>
                    Rata-rata kasus pneumonia tiap desa adalah 
                    <span class="highlight-red">
                        <?= $rataRata ?> kasus
                    </span>
                </p>

            </div>

            <div class="ringkasan-image">

                <img 
                    src="<?= base_url('img/city.png') ?>" 
                    alt=""
                >

            </div>

        </div>

    </div>

</section>

<style>
/* ========================= CARD UTAMA ========================= */
.section-card{
    background:#eaf9fb;
    padding:18px;
    border-radius:16px;
    width:100%;
    font-family:'Poppins', Arial, sans-serif;
}

.section-block{
    background:#eaf9fb;
    border-radius:16px;
}

/* ========================= HEADER MAP ========================= */
.section-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:22px;
}

.section-header h5{
    font-size:24px;
    font-weight:800;
    color:#0d3440;
    margin:0 0 8px;
}

.section-header .sub{
    font-size:15px;
    color:#60727d;
    margin:0;
}

/* ========================= CARD MAP ========================= */
.inner-card{
    background:#ffffff;
    width:100%;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 2px 9px rgba(0,0,0,0.08);
}

/* ========================= FILTER ========================= */
.filter-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:12px;
    padding:16px 20px 12px;
    background:#ffffff;
}

.filter-left{
    display:flex;
    align-items:flex-end;
    gap:18px;
    flex-wrap:wrap;
}

.filter-group{
    display:flex;
    flex-direction:column;
}

.filter-group label{
    font-size:14px;
    color:#111;
    margin-bottom:8px;
}

.filter-group select{
    width:155px;
    height:40px;
    border:1px solid #b8d0df;
    border-radius:10px;
    padding:0 12px;
    font-size:14px;
    background:#fff;
    outline:none;
}

.filter-right{
    display:flex;
    gap:10px;
    align-items:center;
}

.btn-filter{
    border:none;
    background:#08b7c9;
    color:#fff;
    height:42px;
    padding:0 22px;
    border-radius:10px;
    font-size:16px;
    font-weight:800;
    box-shadow:0 2px 7px rgba(0,0,0,0.22);
    cursor:pointer;
}

.btn-reset{
    border:none;
    background:#ffffff;
    color:#000;
    height:42px;
    padding:0 22px;
    border-radius:10px;
    font-size:16px;
    font-weight:800;
    box-shadow:0 2px 7px rgba(0,0,0,0.22);
    cursor:pointer;
}

/* ========================= MAP ========================= */
.map-wrapper{
    position:relative;
    width:100%;
    border-radius:0;
    overflow:hidden;
}

#mapPneu{
    width:100%;
    height:510px !important;
    border-radius:0;
}

/* ========================= LABEL WILAYAH ========================= */
.label-desa{
    background:rgba(65,65,65,0.88);
    color:white;
    border:none;
    padding:5px 9px;
    font-size:12px;
    font-weight:700;
    border-radius:6px;
    box-shadow:0 2px 6px rgba(0,0,0,0.35);
}

/* ========================= KETERANGAN DI DALAM MAP ========================= */
.map-legend-box{
    position:absolute;
    left:14px;
    bottom:14px;
    width:175px;

    background:#ffffff;
    padding:12px 14px 8px;

    border-radius:8px;
    box-shadow:0 2px 8px rgba(0,0,0,0.25);
    z-index:999;
}

.map-legend-box h6{
    font-size:14px;
    font-weight:800;
    color:#000;
    margin:0 0 10px;
}

.legend-item{
    display:flex;
    align-items:center;
    gap:9px;
    margin-bottom:10px;
    font-size:11px;
    color:#000;
}

.legend-color{
    width:21px;
    height:21px;
    display:inline-block;
}

.legend-tinggi{
    background:#ff0000;
}

.legend-sedang{
    background:#ffff00;
}

.legend-rendah{
    background:#00ff00;
}

/* ========================= AIR QUALITY INDEX BOX ========================= */
.aqi-mini-box{
    position:absolute;
    left:203px;
    bottom:14px;
    width:125px;

    background:#ffffff;
    border-radius:10px;
    padding:10px 12px;

    box-shadow:0 4px 14px rgba(0,0,0,0.25);
    z-index:1000;

    cursor:pointer;
    font-family:'Poppins', Arial, sans-serif;
}

.aqi-mini-main{
    font-size:20px;
    font-weight:800;
    color:#111827;
    line-height:1.1;
}

.aqi-mini-icon{
    color:#1976d2;
    font-weight:900;
}

.aqi-mini-status{
    margin-top:5px;
    display:inline-block;

    padding:4px 8px;
    border-radius:6px;

    font-size:12px;
    font-weight:700;

    background:#fef3c7;
    color:#f59e0b;
}

/* POPUP DETAIL */
.aqi-popup-box{
    display:none;

    position:absolute;
    left:250px;
    bottom:14px;
    width:360px;

    background:#ffffff;
    border-radius:12px;
    padding:10px;

    box-shadow:0 8px 25px rgba(0,0,0,0.28);
    z-index:1002;

    font-family:'Poppins', Arial, sans-serif;
    cursor:pointer;
}

.aqi-popup-title{
    font-size:13px;
    font-weight:800;
    color:#111827;
    margin:0 0 8px 4px;
}

.aqi-popup-card{
    background:#f8fafc;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:14px 16px;

    box-shadow:inset 0 2px 8px rgba(0,0,0,0.08);
}

.aqi-popup-main{
    font-size:24px;
    font-weight:900;
    color:#111827;
    line-height:1.1;
}

.aqi-popup-icon{
    color:#1976d2;
    font-weight:900;
}

.aqi-popup-status{
    display:inline-block;

    margin-top:6px;
    padding:5px 10px;
    border-radius:6px;

    font-size:12px;
    font-weight:800;

    background:#fef3c7;
    color:#f59e0b;
}

.aqi-popup-info{
    margin-top:16px;
}

.aqi-popup-info p{
    margin:0 0 9px;
    font-size:12px;
    color:#111827;
}

.aqi-index-list{
    margin-top:18px;
}

.aqi-index-list b{
    display:block;
    margin-bottom:9px;
    font-size:12px;
    color:#111827;
}

.aqi-index-list p{
    margin:0 0 7px;
    font-size:11px;
    font-weight:600;
}

.aqi-good{
    color:#16a34a;
}

.aqi-moderate{
    color:#f59e0b;
}

.aqi-sensitive{
    color:#f97316;
}

.aqi-unhealthy{
    color:#dc2626;
}

.aqi-very{
    color:#9333ea;
}

.aqi-hazard{
    color:#4c1d95;
}

/* WARNA STATUS DINAMIS */
.aqi-status-baik{
    background:#dcfce7 !important;
    color:#16a34a !important;
}

.aqi-status-sedang{
    background:#fef3c7 !important;
    color:#f59e0b !important;
}

.aqi-status-sensitif{
    background:#ffedd5 !important;
    color:#f97316 !important;
}

.aqi-status-tidak-sehat{
    background:#fee2e2 !important;
    color:#dc2626 !important;
}

.aqi-status-sangat-tidak-sehat{
    background:#f3e8ff !important;
    color:#9333ea !important;
}

.aqi-status-berbahaya{
    background:#ede9fe !important;
    color:#4c1d95 !important;
}

/* RESPONSIVE */
@media(max-width:768px){

    .aqi-mini-box{
        left:12px;
        bottom:165px;
        width:118px;
        padding:9px 11px;
    }

    .aqi-mini-main{
        font-size:18px;
    }

    .aqi-popup-box{
        left:12px;
        bottom:165px;
        width:285px;
    }

    .aqi-popup-main{
        font-size:22px;
    }
}

/* ========================= POPUP ========================= */
.popup-informasi{
    min-width:160px;
    font-size:12px;
    line-height:1.5;
    cursor:pointer;
}

.popup-informasi b{
    color:#000;
}

.popup-informasi hr{
    margin:8px -8px 4px;
    border:0;
    border-top:1px solid #ddd;
}

.popup-informasi small{
    display:block;
    text-align:center;
    color:#aaa;
    font-size:10px;
}

.popup-tinggi{
    color:red !important;
}

.popup-sedang{
    color:#d77b00 !important;
}

.popup-rendah{
    color:green !important;
}

.popup-empty{
    color:#d62828;
    font-weight:800;
}

.leaflet-popup-content-wrapper{
    border-radius:8px;
}

.leaflet-popup-content{
    margin:9px 11px;
}

/* ========================= DETAIL PAGE MODERN ========================= */
.detail-card{
    background:#ffffff;
    border:none;
    border-radius:18px;
    padding:24px;
    box-shadow:none;
    width:100%;
    margin:0 auto;
}

.detail-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
    padding:0 2px;
}

.detail-header h5{
    font-size:20px;
    font-weight:700;
    margin:0;
    color:#111827;
}

.detail-inner{
    background:#f8fafc;
    border-radius:18px;
    padding:34px 42px 42px;
    box-shadow:none;
    border:1px solid #eef2f7;
}

.detail-top{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:30px;
    margin-bottom:34px;
}

.detail-top h3{
    font-size:24px;
    font-weight:700;
    margin:0 0 18px;
    color:#111827;
}

.detail-label{
    font-size:17px;
    font-weight:400;
    margin:12px 0 4px;
    color:#374151;
    line-height:1.3;
}

.detail-top h4{
    font-size:18px;
    font-weight:700;
    margin:0 0 8px;
    color:#111827;
}

.badge-risk{
    padding:7px 16px;
    border-radius:10px;
    font-size:16px;
    font-weight:600;
    line-height:1;
    white-space:nowrap;
}

.badge-risk.tinggi{
    background:#fee2e2;
    color:#dc2626;
}

.badge-risk.sedang{
    background:#fef3c7;
    color:#b45309;
}

.badge-risk.rendah{
    background:#dcfce7;
    color:#15803d;
}

.chart-title{
    margin-top:22px;
    margin-bottom:22px;
    font-size:22px;
    font-weight:700;
    color:#111827;
}

/* ========================= CHART BATANG DETAIL ========================= */
.ranking-chart{
    width:72%;
    min-width:560px;
}

.rank-row{
    display:flex;
    align-items:center;
    margin-bottom:7px;
}

.rank-name{
    width:165px;
    text-align:right;
    padding-right:18px;
    letter-spacing:3px;
    font-size:13px;
    font-weight:700;
    color:#6b7280;
}

.rank-bar-area{
    flex:1;
    height:32px;
    border-top:1px solid #d9dee7;
    position:relative;
}

.rank-bar{
    height:23px;
    margin-top:4px;
    color:#ffffff;
    font-weight:700;
    text-align:center;
    line-height:23px;
    min-width:26px;
    border-radius:0 3px 3px 0;
}

.rank-bar.tinggi{
    background:#8b0000;
}

.rank-bar.sedang{
    background:#e76f51;
}

.rank-bar.rendah{
    background:#16a34a;
}

.rank-bar span{
    font-size:13px;
}

.empty-chart{
    padding:18px 30px;
    font-size:16px;
    font-weight:600;
    color:#6b7280;
}

.detail-footer{
    display:flex;
    justify-content:flex-end;
    margin-top:14px;
}

.btn-kembali{
    background:#08b7c9;
    color:#ffffff;
    border:none;
    border-radius:10px;
    padding:9px 42px;
    font-size:16px;
    font-weight:700;
    box-shadow:none;
    cursor:pointer;
}

.btn-kembali:hover{
    background:#079bad;
}

/* ========================= RESPONSIVE ========================= */
@media(max-width:768px){

    .section-card{
        padding:12px;
    }

    .section-header{
        flex-direction:column;
        gap:12px;
    }

    .section-header h5{
        font-size:22px;
    }

    .section-header .sub{
        font-size:14px;
    }

    .filter-wrapper{
        flex-direction:column;
        align-items:flex-start;
    }

    .filter-left{
        width:100%;
        gap:8px;
    }

    .filter-group label{
        font-size:13px;
        margin-bottom:6px;
    }

    .filter-group select{
        width:115px;
        height:34px;
        font-size:13px;
    }

    .filter-right{
        width:100%;
        justify-content:flex-end;
    }

    .btn-filter,
    .btn-reset{
        height:36px;
        font-size:14px;
        padding:0 16px;
    }

    #mapPneu{
        height:330px !important;
    }

    .map-legend-box{
        width:155px;
        padding:10px 12px 6px;
    }

    .map-legend-box h6{
        font-size:13px;
    }

    .legend-item{
        font-size:10px;
        margin-bottom:8px;
    }

    .legend-color{
        width:19px;
        height:19px;
    }

    .label-desa{
        font-size:10px;
        padding:3px 6px;
    }

    .popup-informasi{
        min-width:150px;
        font-size:12px;
    }

    .detail-card{
        padding:14px;
    }

    .detail-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .detail-header h5{
        font-size:18px;
    }

    .detail-inner{
        padding:24px 18px 32px;
    }

    .detail-top{
        flex-direction:column;
        gap:16px;
        margin-bottom:26px;
    }

    .detail-top h3{
        font-size:21px;
    }

    .detail-label{
        font-size:15px;
    }

    .detail-top h4{
        font-size:17px;
    }

    .badge-risk{
        font-size:14px;
        padding:7px 14px;
    }

    .chart-title{
        font-size:19px;
    }

    .ranking-chart{
        width:100%;
        min-width:100%;
    }

    .rank-name{
        width:115px;
        font-size:11px;
        letter-spacing:2px;
        padding-right:10px;
    }

    .rank-bar-area{
        height:30px;
    }

    .rank-bar{
        height:22px;
        line-height:22px;
    }

    .btn-kembali{
        width:100%;
        padding:10px 20px;
    }
    
}

.footer-maskot{
    width:250px !important;
}

*{
    font-family:'Poppins', sans-serif;
}
</style>

<style>
.label-desa{
    background: rgba(0,0,0,0.6);
    color: white;
    border: none;
    padding: 2px 6px;
    font-size: 11px;
    border-radius: 6px;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const footerDesc = document.querySelector(".footer-desc");

    if(footerDesc){

        footerDesc.insertAdjacentHTML("afterend", `
        
            <div class="cynex-info mt-4">

                <h3 style="
                    color:#fff;
                    font-weight:700;
                    font-size:2rem;
                    margin-bottom:12px;
                    line-height:1;
                ">
                    CYNEX
                </h3>

                <p style="
                    color:#E8FFFF;
                    font-size:1.1rem;
                    line-height:1.8;
                    margin-bottom:0;
                ">
                    Clinical System for Next Experience
                </p>

            </div>

        `);

    }

});
</script>
<!-- FLOATING CHAT BUTTON -->
<div id="chatbot-toggle">
    <i class="fa-solid fa-comment-medical"></i>
</div>

<!-- CHAT POPUP -->
<div id="chatbot-popup">
    <div class="chat-popup-header">
        <span>CYBOT</span>
        <button id="close-chatbot">
            ✕
        </button>
    </div>
    <iframe
        src="<?= base_url('chat-pneumonia') ?>"
        frameborder="0">
    </iframe>
</div>

<style>
/* =========================
   FLOATING CHATBOT
========================= */
/* FLOATING BUTTON */
#chatbot-toggle{
    position:fixed;
    bottom:20px;
    right:20px;
    width:65px;
    height:65px;
    border-radius:50%;
    background:linear-gradient(135deg,#0B5B61,#14919B);
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:30px;
    cursor:pointer;
    z-index:99999;
    box-shadow:0 5px 20px rgba(0,0,0,0.25);
    animation:pulse 1.8s infinite;
    transition:0.3s;
}
/* HOVER */
#chatbot-toggle:hover{
    transform:scale(1.08);
}
@keyframes pulse {
    0%{
        transform:scale(1);
        box-shadow:0 0 0 0 rgba(20,145,155,0.6);
    }
    70%{
        transform:scale(1.05);
        box-shadow:0 0 0 18px rgba(20,145,155,0);
    }
    100%{
        transform:scale(1);
        box-shadow:0 0 0 0 rgba(20,145,155,0);
    }
}
/* POPUP */
#chatbot-popup{
    position:fixed;
    bottom:95px;
    right:20px;
    width:420px;
    height:650px;
    background:white;
    border-radius:20px;
    overflow:hidden;
    display:none;
    flex-direction:column;
    z-index:99999;
    box-shadow:0 10px 30px rgba(0,0,0,0.25);
    animation:fadeInUp 0.3s ease;
}

/* HEADER */
.chat-popup-header{
    background:linear-gradient(135deg,#0B5B61,#14919B);
    color:white;
    padding:15px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-weight:600;
}

/* CLOSE BUTTON */
#close-chatbot{
    border:none;
    background:none;
    color:white;
    font-size:18px;
    cursor:pointer;
}
/* IFRAME */
#chatbot-popup iframe{
    width:100%;
    height:100%;
}
@keyframes fadeInUp{

    from{
        opacity:0;
        transform:translateY(20px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}
</style>
<script>
const chatbotToggle =
document.getElementById('chatbot-toggle');
const chatbotPopup =
document.getElementById('chatbot-popup');
const closeChatbot =
document.getElementById('close-chatbot');
// OPEN
chatbotToggle.addEventListener('click', () => {

    chatbotPopup.style.display = 'flex';

});
// CLOSE
closeChatbot.addEventListener('click', () => {

    chatbotPopup.style.display = 'none';

});
</script>
<?= $this->include('layout/footer') ?>