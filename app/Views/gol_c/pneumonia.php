<?php $this->setVar('penyakit', 'pneumonia'); ?>
<?php 
$this->setVar('custom_logo', 'pulmora.png');
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
    height: 450px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    padding: 40px 20px;
    color: white;

    background: 
    linear-gradient(
        to right,
        rgba(0, 206, 209, 0.9) 5%,   /* Menggunakan Dark Turquoise #00CED1 */
        rgba(0, 206, 209, 0.3) 35%,
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

        const href = this.getAttribute("href");

        if(href && href.startsWith("#")){
            e.preventDefault();

            const target = document.querySelector(href);

            if(target){

                let offset = 90;

                /* khusus skrining agar tampil di tengah */
                if(href === "#skriningSection"){
                    offset = 220;
                }

                const posisiTarget =
                    target.getBoundingClientRect().top +
                    window.pageYOffset -
                    offset;

                window.scrollTo({
                    top: posisiTarget,
                    behavior: "smooth"
                });

                history.pushState(null, null, href);
            }
        }

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
$db = \Config\Database::connect();

$queryBerita = $db->query("
    SELECT *
    FROM berita
    WHERE id_penyakit = 3
    ORDER BY tanggal_berita DESC
");

$beritaList = $queryBerita->getResultArray();

$totalBerita = count($beritaList);
?>

<div class="news-slider">

    <button class="slide-btn prev-btn">
        &#10094;
    </button>

    <div class="news-track">

        <?php if($totalBerita > 0): ?>

            <?php foreach($beritaList as $berita): ?>

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

            <?php endforeach; ?>

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

    <a href="<?= base_url('pneumonia/skrining') ?>"
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

$db = \Config\Database::connect();

$bulanLabels = [
    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

$laki = array_fill(0, 12, 0);
$wanita = array_fill(0, 12, 0);

$db = \Config\Database::connect();

$query = $db->query("
    SELECT 
        YEAR(tgl_kunjungan) as tahun,
        MONTH(tgl_kunjungan) as bulan,
        jenis_kelamin,
        COUNT(*) as total

    FROM pasien

    WHERE id_penyakit = 3

    GROUP BY 
        YEAR(tgl_kunjungan),
        MONTH(tgl_kunjungan),
        jenis_kelamin

    ORDER BY 
        YEAR(tgl_kunjungan),
        MONTH(tgl_kunjungan)
");

$result = $query->getResultArray();

foreach($result as $row){

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
                label: 'Perempuan',
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

            title: {
                display: true,
                text: 'Jumlah',

                color: '#333',

                font: {
                    size: 16,
                    family: 'Poppins'
                }
            },

            ticks: {
                stepSize: 10
            }

        }

    }

}
});
</script>


</script>

<!-- =====================================================================
     PETA - QUERY DATA DENGAN POINT PREVALENCE RATE
     Rumus: PPR = (Jumlah Penderita / Jumlah Penduduk) x 100.000
     Data Penduduk Kecamatan Ajung (Dinas Kependudukan Kab. Jember):
       - SUKAMAKMUR  : 12.351
       - MANGARAN    : 14.255  (nama di DB: Manggaran)
       - PANCAKARYA  : 12.899
       - AJUNG       : 19.339
       - KLOMPANGAN  : 11.201
       - WIROWONGSO  : 11.142
       - ROWOINDAH   : 5.935
     Threshold warna (per 100.000 penduduk):
       Tinggi  : PPR >= 200
       Sedang  : PPR >= 50
       Rendah  : PPR <  50
===================================================================== -->
<?php
$db = \Config\Database::connect();

/* ============================================================
   DATA PENDUDUK PER KELURAHAN (Sumber: Dinas Dukcapil Jember)
   Key = nama kelurahan dinormalisasi (lowercase, tanpa spasi extra)
============================================================ */
$populasiPenduduk = [
    'sukamakmur'  => 12351,
    'sukamakmur'  => 12351,
    'suka makmur' => 12351,
    'mangaran'    => 14255,
    'manggaran'   => 14255,
    'pancakarya'  => 12899,
    'ajung'       => 19339,
    'klompangan'  => 11201,
    'klompongan'  => 11201,
    'wirowongso'  => 11142,
    'rowoindah'   => 5935,
    'rowo indah'  => 5935,
];

/* ============================================================
   QUERY DATA PASIEN PNEUMONIA (id_penyakit = 3) DARI DB
   Ambil semua kolom yang dibutuhkan untuk filter JS
============================================================ */
$builder = $db->table('pasien p');
$builder->select("
    w.kelurahan as desa,
    p.jenis_kelamin,
    p.umur,
    p.tgl_kunjungan,
    COUNT(p.id_pasien) as kasus
");
$builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');
$builder->where('p.id_penyakit', 3);
$builder->groupBy("
    w.kelurahan,
    p.jenis_kelamin,
    MONTH(p.tgl_kunjungan),
    YEAR(p.tgl_kunjungan)
");
$pneumonia = $builder->get()->getResultArray();

/* ============================================================
   BUAT DAFTAR TAHUN TERSEDIA
============================================================ */
$tahunList = [];
foreach ($pneumonia as $item) {
    if (!empty($item['tgl_kunjungan'])) {
        $tahunData = date('Y', strtotime($item['tgl_kunjungan']));
        if ($tahunData == '2025' || $tahunData == '2026') {
            $tahunList[] = $tahunData;
        }
    }
}
$tahunList = array_unique($tahunList);
$tahunList = array_unique(array_merge(['2026', '2025'], $tahunList));
rsort($tahunList);
if(empty($tahunList)){
    $tahunList = [2026, 2025];
}
?>

<section id="mapSection" class="container mt-5" data-aos="fade-up">

    <div class="section-card">

        <!-- ========================= HALAMAN MAP ========================== -->
        <div id="mapPage">

            <div class="section-block">

                <div class="section-header">
                    <div>
                        <h5>Peta Interaktif Penyebaran</h5>
                        <p class="sub">Visualisasi kepadatan kasus berdasarkan wilayah (Point Prevalence Rate per 100.000 penduduk)</p>
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
                                    <option value="">All</option>
                                    <?php foreach($tahunList as $tahun): ?>
                                        <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                    <?php endforeach; ?>
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

                        <div id="map"></div>

                        <!-- KETERANGAN -->
                        <div class="map-legend-box">
                            <h6>Keterangan PPR:</h6>

                            <div class="legend-item">
                                <span class="legend-color legend-tinggi"></span>
                                <div>
                                    <b>Risiko Tinggi</b>
                                    <div style="font-size:10px;color:#666;" id="legendTinggiVal">33% tertinggi</div>
                                </div>
                            </div>

                            <div class="legend-item">
                                <span class="legend-color legend-sedang"></span>
                                <div>
                                    <b>Risiko Sedang</b>
                                    <div style="font-size:10px;color:#666;" id="legendSedangVal">33% tengah</div>
                                </div>
                            </div>

                            <div class="legend-item">
                                <span class="legend-color legend-rendah"></span>
                                <div>
                                    <b>Risiko Rendah</b>
                                    <div style="font-size:10px;color:#666;" id="legendRendahVal">33% terendah</div>
                                </div>
                            </div>

                            <div class="legend-item">
                                <span class="legend-color" style="background:#d9d9d9;"></span>
                                <div>
                                    <b>Tidak Ada Data</b>
                                </div>
                            </div>
                            <div style="font-size:9px;color:#888;margin-top:6px;line-height:1.4;">
                                *Klasifikasi Quantile<br>berdasarkan data lokal<br>(Jenks Natural Breaks)
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
                                Kualitas Udara Kecamatan Ajung
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
                                    <p>📍 <span id="aqiLocation">Kecamatan Ajung, Kabupaten Jember, Jawa Timur, Indonesia</span></p>
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

                    <div class="detail-period">
                        <span>Periode :</span>

                        <button
                            type="button"
                            class="period-btn"
                            onclick="changeDetailYear(1)"
                        >
                            ‹
                        </button>

                        <b id="detailYear">
                            <?= !empty($tahunList[0]) ? $tahunList[0] : '2025' ?>
                        </b>

                        <button
                            type="button"
                            class="period-btn"
                            onclick="changeDetailYear(-1)"
                        >
                            ›
                        </button>
                    </div>
                </div>

                <div class="detail-inner">

                    <div class="detail-top">
                        <div>
                            <h3 id="detailWilayah">Kecamatan Ajung</h3>

                            <p class="detail-label">Total Kasus</p>
                            <h4 id="detailTotal">0 kasus</h4>

                            <p class="detail-label">Jumlah Penduduk</p>
                            <h4 id="detailPenduduk">- jiwa</h4>

                            <p class="detail-label">Prevalensi</p>
                            <h4 id="detailPPR" style="color:#0aa9b5;">0%</h4>

                            <p class="detail-label" id="detailBulanLabel">Kasus Baru</p>
                            <h4 id="detailKasusBaru">0 kasus</h4>
                        </div>

                        <span id="detailKategori" class="badge-risk rendah">Rendah</span>
                    </div>

                    <h4 class="chart-title">10 Wilayah dengan Prevalensi Tertinggi</h4>

                    <div id="rankingChart" class="ranking-chart"></div>

                </div>

                <div class="detail-footer">
                    <button type="button" class="btn-kembali" onclick="backToMap()">Kembali</button>
                </div>

            </div>

        </div>

    </div>

</section>


<!-- SCRIPT MAP DENGAN POINT PREVALENCE RATE -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ============================================================
       DATA PENDUDUK PER DESA (dari Dinas Dukcapil Jember)
       Key = nama desa lowercase tanpa spasi (setelah normalisasi)
    ============================================================ */
    var POPULASI = {
        "sukamakmur"  : 12351,
        "mangaran"    : 14255,
        "manggaran"   : 14255,
        "pancakarya"  : 12899,
        "ajung"       : 19339,
        "klompangan"  : 11201,
        "klompongan"  : 11201,
        "wirowongso"  : 11142,
        "rowoindah"   : 5935
    };

    /* Konstanta Prevalensi biasa (persen) */
    var K_PREVALENSI = 100;

    /*
     * THRESHOLD DINAMIS - Quantile 3 Kelas (Natural Breaks sederhana)
     * Referensi metode: Supratiknyo & Siwiendrayanti, HIGEIA Journal 2024;
     *                   Spatial Modeling of Risk Factors Pneumonia, NIH/PMC 2025
     * Threshold TIDAK dipatok angka tetap, melainkan dihitung otomatis
     * dari distribusi nilai PPR seluruh desa pada saat filter diterapkan.
     * - 33% nilai PPR tertinggi  → Tinggi  (merah)
     * - 33% nilai PPR tengah     → Sedang  (kuning)
     * - 33% nilai PPR terendah   → Rendah  (hijau)
     */
    var _thresholdTinggi = null;
    var _thresholdSedang = null;

    function hitungThresholdQuantile(dataFinal){
        var nilaiPPR = [];
        for(var k in dataFinal){
            if(dataFinal[k].ppr !== null && dataFinal[k].ppr > 0){
                nilaiPPR.push(dataFinal[k].ppr);
            }
        }
        if(nilaiPPR.length === 0){
            _thresholdTinggi = null;
            _thresholdSedang = null;
            return;
        }
        nilaiPPR.sort(function(a, b){ return a - b; });
        var n = nilaiPPR.length;
        /* Potong di 33% dan 66% dari distribusi */
        var idx33 = Math.floor(n * 0.33);
        var idx66 = Math.floor(n * 0.66);
        _thresholdSedang = nilaiPPR[idx33];
        _thresholdTinggi = nilaiPPR[idx66];
        /* Jika semua nilai sama (hanya 1 desa), beri sedikit spread */
        if(_thresholdSedang === _thresholdTinggi){
            _thresholdSedang = _thresholdTinggi * 0.5;
        }
    }

    var dataPneu = <?= json_encode($pneumonia ?? []) ?>;

    var map;
    var geoLayer;
    var geoJsonData;
    var currentDataFinal = {};
    var availableYears = <?= json_encode(array_values($tahunList)) ?>;
    availableYears = Array.from(
        new Set(
            availableYears.concat(["2026", "2025"]).map(String)
        )
    ).sort(function(a, b){
        return parseInt(b) - parseInt(a);
    });

    var selectedYearIndex = 0;
    var selectedDetailYear = availableYears.length > 0 ? parseInt(availableYears[0]) : 2025;
    var selectedDetailKey = "";
    var selectedDetailNama = "";

    /* ============================================================
       FUNGSI NORMALISASI NAMA
    ============================================================ */
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
            "klompongan"   : "klompangan",
            "klomplangan"  : "klompangan",
            "rowoindah"    : "rowoindah",
            "pancakarya"   : "pancakarya",
            "sukamakmur"   : "sukamakmur",
            "wirowongso"   : "wirowongso",
            "mangaran"     : "manggaran",
            "manggaran"    : "manggaran",
            "ajung"        : "ajung"
        };

        if(alias[key]){
            return alias[key];
        }

        return key;
    }

    /* ============================================================
       FUNGSI AMBIL NILAI DARI ITEM DATA
    ============================================================ */
    function getDesa(item){
        return item.desa
            || item.DESA
            || item.kelurahan
            || item.KELURAHAN
            || item.wilayah
            || item.WILAYAH
            || item.nama_desa
            || item.NAMA_DESA
            || item.nama_kelurahan
            || item.NAMA_KELURAHAN
            || item.nama_wilayah
            || item.NAMA_WILAYAH
            || item.NAMOBJ
            || item.namobj
            || item.WADMKD
            || item.wadmkd
            || "";
    }

    function getKasus(item){
        var nilai = item.kasus
            || item.KASUS
            || item.jumlah_kasus
            || item.JUMLAH_KASUS
            || item.total_kasus
            || item.TOTAL_KASUS
            || item.total
            || item.TOTAL
            || item.jumlah
            || item.JUMLAH
            || item.nilai
            || item.NILAI
            || 0;

        nilai = nilai.toString().replace(/[^0-9]/g, "");
        return parseInt(nilai || 0);
    }

    function getTahun(item){
        if(item.tgl_kunjungan){
            return item.tgl_kunjungan.toString().substring(0,4);
        }
        return "";
    }

    function getBulan(item){
        if(item.tgl_kunjungan){
            return parseInt(item.tgl_kunjungan.toString().substring(5,7));
        }
        return "";
    }

    function getJk(item){
        return item.jenis_kelamin
            || item.JENIS_KELAMIN
            || item.jk
            || item.JK
            || item.gender
            || item.GENDER
            || item.kelamin
            || item.KELAMIN
            || "";
    }

    function namaBulan(angka){
        var bulan = {
            "1":"Januari","2":"Februari","3":"Maret","4":"April",
            "5":"Mei","6":"Juni","7":"Juli","8":"Agustus",
            "9":"September","10":"Oktober","11":"November","12":"Desember"
        };
        return bulan[angka] || "Semua Bulan";
    }

    function getWaktuSaatIni(){
        var tanggalSekarang = new Date();
        var bulanSekarang = tanggalSekarang.getMonth() + 1;
        var tahunSekarang = tanggalSekarang.getFullYear();
        return {
            bulan: bulanSekarang,
            tahun: tahunSekarang,
            label: namaBulan(bulanSekarang) + " " + tahunSekarang
        };
    }

    /* ============================================================
       FUNGSI HITUNG PPR
       PPR = (Jumlah Penderita / Jumlah Penduduk) x 100.000
    ============================================================ */
    function hitungPrevalensi(totalKasus, keyDesa){
        var populasi = POPULASI[keyDesa];

        if(!populasi || populasi <= 0){
            return null;
        }

        return (totalKasus / populasi) * K_PREVALENSI;
    }

    /* ============================================================
       FUNGSI KATEGORI BERDASARKAN PPR
    ============================================================ */
    function kategoriDariPrevalensi(prev, totalKasus){
        if(prev === null){
            return "nodata";
        }

        if(totalKasus === 0){
            return "nodata";
        }

        if(prev >= 0.90){
            return "tinggi";
        }else if(prev >= 0.40){
            return "sedang";
        }else{
            return "rendah";
        }
    }

    function warnaKategori(kategori){
        if(kategori === "tinggi")  return "#ff3131";
        if(kategori === "sedang")  return "#ffcc00";
        if(kategori === "rendah")  return "#42a447";
        return "#d9d9d9"; /* nodata */
    }

    function textKategori(kategori){
        if(kategori === "tinggi")  return "Tinggi";
        if(kategori === "sedang")  return "Sedang";
        if(kategori === "rendah")  return "Rendah";
        return "Tidak Ada Data";
    }

    /* ============================================================
       BUILD DATA FINAL DENGAN PPR
    ============================================================ */
    function buildDataFinal(){
        var bulan  = document.getElementById("filterBulan").value;
        var tahun  = document.getElementById("filterTahun").value;
        var jk     = document.getElementById("filterJk").value;

        var hasil = {};

        dataPneu.forEach(function(item){

            var itemTahun  = getTahun(item).toString();
            var itemBulan  = getBulan(item).toString();
            var itemJk     = getJk(item).toString().toLowerCase().trim();
            var filterJkLc = jk.toString().toLowerCase().trim();

            if(tahun && itemTahun && itemTahun !== tahun) return;
            if(bulan && itemBulan && itemBulan !== bulan) return;
            if(jk && itemJk && itemJk !== filterJkLc) return;

            var desaAsli = getDesa(item);
            var desaKey  = fixKey(desaAsli);
            if(!desaKey) return;

            if(!hasil[desaKey]){
                hasil[desaKey] = {
                    nama     : desaAsli,
                    total    : 0,
                    kasusBaru: 0,
                    ppr      : 0,
                    kategori : "rendah",
                    populasi : POPULASI[desaKey] || null
                };
            }

            hasil[desaKey].total     += getKasus(item);
            hasil[desaKey].kasusBaru += getKasus(item);
        });

        /* Hitung PPR dulu semua, lalu hitung threshold quantile, baru kategori */
        /* Langkah 1: hitung semua nilai PPR */
        for(var key in hasil){
            var prevalensi = hitungPrevalensi(hasil[key].total, key);

            hasil[key].ppr      = prevalensi;
            hasil[key].populasi = POPULASI[key] || null;
            hasil[key].kategori = kategoriDariPrevalensi(prevalensi, hasil[key].total);
        }

        currentDataFinal = hasil;
        return hasil;
    }

    function getNamaGeo(feature){
        return feature.properties.NAMOBJ
            || feature.properties.namobj
            || feature.properties.nama
            || feature.properties.name
            || feature.properties.DESA
            || feature.properties.desa
            || feature.properties.WADMKD
            || feature.properties.wadmkd
            || feature.properties.KELURAHAN
            || feature.properties.kelurahan
            || "Wilayah";
    }

    /* ============================================================
       AIR QUALITY INDEX - IQAIR API
    ============================================================ */
    var IQAIR_API_KEY  = "d1160a02-9aa4-4404-86cd-4514f1e18d18";
    var AQI_LAT        = -8.1739;
    var AQI_LON        = 113.6473;
    var AQI_NAMA_LOKASI  = "Kecamatan Ajung, Kabupaten Jember, Jawa Timur, Indonesia";
    var AQI_JUDUL_POPUP  = "Kualitas Udara Kecamatan Ajung";

    function getKategoriAQI(aqi){
        aqi = parseInt(aqi || 0);
        if(aqi <= 50)  return { teks: "Baik",                   className: "aqi-status-baik" };
        if(aqi <= 100) return { teks: "Sedang",                 className: "aqi-status-sedang" };
        if(aqi <= 150) return { teks: "Tidak Sehat (Sensitif)", className: "aqi-status-sensitif" };
        if(aqi <= 200) return { teks: "Tidak Sehat",            className: "aqi-status-tidak-sehat" };
        if(aqi <= 300) return { teks: "Sangat Tidak Sehat",     className: "aqi-status-sangat-tidak-sehat" };
        return { teks: "Berbahaya", className: "aqi-status-berbahaya" };
    }

    function formatTanggalAQI(tanggalApi){
        if(!tanggalApi) return "-";
        var tanggal = new Date(tanggalApi);
        if(isNaN(tanggal.getTime())) return tanggalApi;
        return tanggal.toLocaleString("id-ID", {
            day:"2-digit", month:"long", year:"numeric", hour:"2-digit", minute:"2-digit"
        });
    }

    function setStatusClassAQI(element, className){
        element.classList.remove(
            "aqi-status-baik","aqi-status-sedang","aqi-status-sensitif",
            "aqi-status-tidak-sehat","aqi-status-sangat-tidak-sehat","aqi-status-berbahaya"
        );
        element.classList.add(className);
    }

    function isiDataAQI(dataApi){
        if(!dataApi || dataApi.status !== "success"){
            document.getElementById("aqiMiniValue").innerText  = "-";
            document.getElementById("aqiMiniStatus").innerText = "Gagal";
            document.getElementById("aqiPopupValue").innerText  = "-";
            document.getElementById("aqiPopupStatus").innerText = "Data gagal dimuat";
            return;
        }
        var data      = dataApi.data;
        var pollution = data.current && data.current.pollution ? data.current.pollution : {};
        var weather   = data.current && data.current.weather   ? data.current.weather   : {};
        var aqi       = pollution.aqius || 0;
        var kategori  = getKategoriAQI(aqi);

        document.getElementById("aqiMiniValue").innerText   = aqi;
        document.getElementById("aqiMiniStatus").innerText  = kategori.teks;
        document.getElementById("aqiPopupTitle").innerText  = AQI_JUDUL_POPUP;
        document.getElementById("aqiPopupValue").innerText  = aqi;
        document.getElementById("aqiPopupStatus").innerText = kategori.teks;
        document.getElementById("aqiLocation").innerText    = AQI_NAMA_LOKASI;
        document.getElementById("aqiTemp").innerText        = weather.tp  ?? "-";
        document.getElementById("aqiHumidity").innerText    = weather.hu  ?? "-";
        document.getElementById("aqiPressure").innerText    = weather.pr  ?? "-";
        document.getElementById("aqiUpdated").innerText     = formatTanggalAQI(pollution.ts);

        setStatusClassAQI(document.getElementById("aqiMiniStatus"),  kategori.className);
        setStatusClassAQI(document.getElementById("aqiPopupStatus"), kategori.className);
    }

    function ambilDataAQI(){
        var url = "https://api.airvisual.com/v2/nearest_city" +
                  "?lat=" + AQI_LAT + "&lon=" + AQI_LON + "&key=" + IQAIR_API_KEY;
        fetch(url)
            .then(function(response){ return response.json(); })
            .then(function(data){ isiDataAQI(data); })
            .catch(function(error){
                console.error("Gagal mengambil data AQI:", error);
                document.getElementById("aqiMiniValue").innerText   = "-";
                document.getElementById("aqiMiniStatus").innerText  = "Gagal";
                document.getElementById("aqiPopupValue").innerText  = "-";
                document.getElementById("aqiPopupStatus").innerText = "Data gagal dimuat";
            });
    }

    function aktifkanPopupAQI(){
        var miniBox  = document.getElementById("aqiMiniBox");
        var popupBox = document.getElementById("aqiPopupBox");
        if(!miniBox || !popupBox) return;
        miniBox.addEventListener("click", function(e){
            e.stopPropagation();
            popupBox.style.display = "block";
        });
        popupBox.addEventListener("click", function(e){
            e.stopPropagation();
            popupBox.style.display = "none";
        });
        document.addEventListener("click", function(){
            popupBox.style.display = "none";
        });
    }

    /* ============================================================
       INISIALISASI MAP
    ============================================================ */
    function initMap(){
        var mapElement = document.getElementById("map");
        if(!mapElement) return;

        map = L.map("map", { zoomControl: true }).setView([-7.9, 112.6], 10);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "Leaflet"
        }).addTo(map);

        aktifkanPopupAQI();
        ambilDataAQI();

        fetch("<?= base_url('assets/peta/pneumonia.geojson') ?>")
            .then(function(res){ return res.json(); })
            .then(function(data){
                geoJsonData = data;
                renderGeoJson();
            });

        setTimeout(function(){ map.invalidateSize(); }, 300);
    }

    /* ============================================================
       RENDER GEOJSON DENGAN WARNA BERDASARKAN PPR
    ============================================================ */
    /* Update teks legend kotak kiri bawah peta setelah threshold dihitung */
    function updateLegendText(){
        var elT = document.getElementById("legendTinggiVal");
        var elS = document.getElementById("legendSedangVal");
        var elR = document.getElementById("legendRendahVal");
        if(!elT || !elS || !elR) return;

        if(_thresholdTinggi === null){
            elT.innerText = "Tidak ada data";
            elS.innerText = "-";
            elR.innerText = "-";
            return;
        }
        elT.innerText = "PPR ≥ " + _thresholdTinggi.toFixed(1) + " /100rb";
        elS.innerText = "PPR " + _thresholdSedang.toFixed(1) + "–" + (_thresholdTinggi - 0.1).toFixed(1) + " /100rb";
        elR.innerText = "PPR < " + _thresholdSedang.toFixed(1) + " /100rb";
    }

    function renderGeoJson(){
        var dataFinal = buildDataFinal();

        /* Update teks threshold di legend setelah quantile dihitung */
        updateLegendText();

        if(geoLayer){
            map.removeLayer(geoLayer);
        }

        geoLayer = L.geoJSON(geoJsonData, {

            style: function(feature){
                var nama     = getNamaGeo(feature);
                var key      = fixKey(nama);
                var item     = dataFinal[key];

                var kategori = item ? item.kategori : "nodata";
                var warna    = warnaKategori(kategori);

                return {
                    color       : "#23a39a",
                    weight      : 2,
                    fillColor   : warna,
                    fillOpacity : item ? 0.75 : 0.55
                };
            },

            onEachFeature: function(feature, layer){
                var nama     = getNamaGeo(feature);
                var key      = fixKey(nama);
                var item     = dataFinal[key];

                var total    = item ? item.total    : 0;
                var ppr      = item ? item.ppr      : null;
                var kategori = item ? item.kategori : "nodata";
                var populasi = item ? item.populasi : (POPULASI[key] || null);

                var pprTeks  = (ppr !== null) ? ppr.toFixed(2) + "%" : "Tidak tersedia";
                var popTeks  = populasi ? populasi.toLocaleString("id-ID") + " jiwa" : "Data tidak tersedia";

                var statusData = (!item || !POPULASI[key])
                    ? '<br><span class="popup-empty">Data populasi tidak tersedia</span>'
                    : '';

                var isiPopup = `
                    <div class="popup-informasi" onclick="showDetailWilayah('${key}', decodeURIComponent('${encodeURIComponent(nama)}'))">
                        <b>Informasi Epidemiologi :</b><br>
                        <span>Desa : <b>${nama}</b></span><br>
                        <span>Jumlah Kasus : <b>${total}</b></span><br>
                        <span>Jumlah Penduduk : <b>${popTeks}</b></span><br>
                        <span>Prevalensi : <b style="color:#0aa9b5;">${pprTeks}</b></span><br>
                        <span>
                            Tingkat Risiko :
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

                layer.on("click", function(){ layer.openPopup(); });

                layer.on("mouseover", function(){
                    layer.setStyle({ weight: 4, fillOpacity: 0.85 });
                });

                layer.on("mouseout", function(){
                    geoLayer.resetStyle(layer);
                });
            }

        }).addTo(map);

        map.fitBounds(geoLayer.getBounds());
    }

    /* ============================================================
       HITUNG KASUS BARU BULAN INI (UNTUK DETAIL WILAYAH)
    ============================================================ */
    function hitungKasusBaruTerkiniWilayah(keyWilayah){
        var waktuSaatIni = getWaktuSaatIni();
        var jk           = document.getElementById("filterJk").value;
        var filterJkLc   = jk.toString().toLowerCase().trim();
        var totalKasusBaru = 0;

        dataPneu.forEach(function(item){
            var desaKey   = fixKey(getDesa(item));
            var itemTahun = getTahun(item).toString();
            var itemBulan = getBulan(item).toString();
            var itemJk    = getJk(item).toString().toLowerCase().trim();

            if(desaKey !== keyWilayah) return;
            if(itemTahun !== waktuSaatIni.tahun.toString()) return;
            if(itemBulan !== waktuSaatIni.bulan.toString()) return;
            if(jk && itemJk !== filterJkLc) return;

            totalKasusBaru += getKasus(item);
        });

        return totalKasusBaru;
    }

    /* ============================================================
       BUILD DATA DETAIL BERDASARKAN TAHUN (DENGAN PPR)
    ============================================================ */
    function buildDataDetailByYear(tahunDetail){
        var bulan    = document.getElementById("filterBulan").value;
        var jk       = document.getElementById("filterJk").value;
        var hasil    = {};

        dataPneu.forEach(function(item){
            var itemTahun  = getTahun(item).toString();
            var itemBulan  = getBulan(item).toString();
            var itemJk     = getJk(item).toString().toLowerCase().trim();
            var filterJkLc = jk.toString().toLowerCase().trim();

            if(itemTahun !== tahunDetail.toString()) return;
            if(bulan && itemBulan !== bulan)          return;
            if(jk && itemJk !== filterJkLc)           return;

            var desaAsli = getDesa(item);
            var desaKey  = fixKey(desaAsli);

            if(!hasil[desaKey]){
                hasil[desaKey] = {
                    nama    : desaAsli,
                    total   : 0,
                    kasusBaru: 0,
                    ppr     : 0,
                    kategori: "rendah",
                    populasi: POPULASI[desaKey] || null
                };
            }

            hasil[desaKey].total     += getKasus(item);
            hasil[desaKey].kasusBaru += getKasus(item);
        });

        /* Hitung PPR dulu semua, lalu threshold quantile, baru kategori */
        for(var key in hasil){
            var prevalensi = hitungPrevalensi(hasil[key].total, key);

            hasil[key].ppr      = prevalensi;
            hasil[key].populasi = POPULASI[key] || null;
            hasil[key].kategori = kategoriDariPrevalensi(prevalensi, hasil[key].total);
        }

        return hasil;
    }

    /* ============================================================
       TAMPILKAN HALAMAN DETAIL WILAYAH
    ============================================================ */
    window.showDetailWilayah = function(key, namaWilayah){
        selectedDetailKey  = key;
        selectedDetailNama = namaWilayah;

        var tahun = document.getElementById("filterTahun").value || availableYears[0] || "2025";
        selectedDetailYear  = parseInt(tahun);
        selectedYearIndex   = availableYears.indexOf(selectedDetailYear.toString());
        if(selectedYearIndex < 0) selectedYearIndex = 0;

        currentDataFinal = buildDataDetailByYear(selectedDetailYear);

        var item = currentDataFinal[key] || {
            nama: namaWilayah, total: 0, kasusBaru: 0, ppr: null,
            kategori: "nodata", populasi: POPULASI[key] || null
        };

        document.getElementById("mapPage").style.display    = "none";
        document.getElementById("detailPage").style.display = "block";

        document.getElementById("detailTitleHeader").innerText = "Peta Sebaran Kasus " + selectedDetailYear;
        document.getElementById("detailYear").innerText        = selectedDetailYear;
        document.getElementById("detailWilayah").innerText     = "Kelurahan " + namaWilayah;
        document.getElementById("detailTotal").innerText       = item.total + " kasus";

        var populasiTeks = item.populasi
            ? item.populasi.toLocaleString("id-ID") + " jiwa"
            : "Data tidak tersedia";
        document.getElementById("detailPenduduk").innerText = populasiTeks;

        var pprTeks = (item.ppr !== null && item.ppr !== undefined)
            ? item.ppr.toFixed(3) + "%"
            : "Tidak tersedia";
        document.getElementById("detailPPR").innerText = pprTeks;

        var waktuSaatIni    = getWaktuSaatIni();
        var kasusBaruTerkini = hitungKasusBaruTerkiniWilayah(key);

        document.getElementById("detailBulanLabel").innerText =
            "Kasus Baru (" + waktuSaatIni.label + ")";
        document.getElementById("detailKasusBaru").innerText  =
            kasusBaruTerkini + " kasus";

        var badge = document.getElementById("detailKategori");
        badge.innerText  = textKategori(item.kategori);
        badge.className  = "badge-risk " + item.kategori;

        renderRankingChart();
    };

    window.backToMap = function(){
        document.getElementById("detailPage").style.display = "none";
        document.getElementById("mapPage").style.display    = "block";
        setTimeout(function(){ map.invalidateSize(); }, 300);
    };

    window.changeDetailYear = function(step){
        selectedYearIndex += step;
        if(selectedYearIndex < 0)                          selectedYearIndex = 0;
        if(selectedYearIndex >= availableYears.length)     selectedYearIndex = availableYears.length - 1;

        selectedDetailYear = parseInt(availableYears[selectedYearIndex]);

        document.getElementById("detailYear").innerText        = selectedDetailYear;
        document.getElementById("detailTitleHeader").innerText = "Peta Sebaran Kasus " + selectedDetailYear;

        currentDataFinal = buildDataDetailByYear(selectedDetailYear);

        var item = currentDataFinal[selectedDetailKey] || {
            nama: selectedDetailNama, total: 0, kasusBaru: 0, ppr: null,
            kategori: "nodata", populasi: POPULASI[selectedDetailKey] || null
        };

        document.getElementById("detailTotal").innerText = item.total + " kasus";

        var populasiTeks = item.populasi
            ? item.populasi.toLocaleString("id-ID") + " jiwa"
            : "Data tidak tersedia";
        document.getElementById("detailPenduduk").innerText = populasiTeks;

        var pprTeks = (item.ppr !== null && item.ppr !== undefined)
            ? item.ppr.toFixed(3) + "%"
            : "Tidak tersedia";
        document.getElementById("detailPPR").innerText = pprTeks;

        var waktuSaatIni     = getWaktuSaatIni();
        var kasusBaruTerkini = hitungKasusBaruTerkiniWilayah(selectedDetailKey);

        document.getElementById("detailBulanLabel").innerText =
            "Kasus Baru (" + waktuSaatIni.label + ")";
        document.getElementById("detailKasusBaru").innerText  =
            kasusBaruTerkini + " kasus";

        var badge = document.getElementById("detailKategori");
        badge.innerText = textKategori(item.kategori);
        badge.className = "badge-risk " + item.kategori;

        renderRankingChart();
    };

    /* ============================================================
       RENDER RANKING CHART BERDASARKAN PPR
    ============================================================ */
    function renderRankingChart(){
        var chart = document.getElementById("rankingChart");

        var ranking = Object.values(currentDataFinal)
            .filter(function(a){ return a.ppr !== null; })
            .sort(function(a, b){ return b.ppr - a.ppr; })
            .slice(0, 10);

        if(ranking.length === 0){
            chart.innerHTML = '<div class="empty-chart">Tidak ada data yang sesuai filter</div>';
            return;
        }

        var maxPPR = ranking[0].ppr || 1;
        var html   = "";

        ranking.forEach(function(item){
            var width    = (item.ppr / maxPPR) * 100;
            var kategori = item.kategori;
            var pprLabel = item.ppr.toFixed(3) + "%";
            var barClass = (kategori === "nodata") ? "rendah" : kategori;

            html += `
                <div class="rank-row">
                    <div class="rank-name">${item.nama.toUpperCase()}</div>
                    <div class="rank-bar-area">
                        <div class="rank-bar ${barClass}" style="width:${width}%;">
                            <span>${pprLabel}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        chart.innerHTML = html;
    }

    /* ============================================================
       EVENT LISTENER FILTER
    ============================================================ */
    document.getElementById("filterTahun").addEventListener("change", function(){
        renderGeoJson();
    });

    document.getElementById("btnFilter").addEventListener("click", function(){
        renderGeoJson();
    });

    document.getElementById("btnReset").addEventListener("click", function(){
        document.getElementById("filterBulan").value = "";
        document.getElementById("filterTahun").value = "";
        document.getElementById("filterJk").value    = "";
        renderGeoJson();
    });

    initMap();

});
</script>


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

#map{
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
    width:195px;

    background:#ffffff;
    padding:12px 14px 10px;

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
    flex-shrink:0;
}

.legend-tinggi{ background:#ff3131; }
.legend-sedang{ background:#ffcc00; }
.legend-rendah{ background:#42a447; }

/* ========================= AIR QUALITY INDEX BOX ========================= */
.aqi-mini-box{
    position:absolute;
    left:223px;
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

    background:#dcfce7;
    color:#16a34a;
}

.aqi-popup-box{
    display:none;

    position:absolute;
    left:223px;
    bottom:14px;
    width:360px;

    background:#ffffff;
    border-radius:12px;
    padding:12px;

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

    background:#dcfce7;
    color:#16a34a;
}

.aqi-popup-info{
    margin-top:16px;
}

.aqi-popup-info p{
    margin:0 0 9px;
    font-size:12px;
    color:#111827;
    line-height:1.5;
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

.aqi-good{ color:#16a34a; }
.aqi-moderate{ color:#f59e0b; }
.aqi-sensitive{ color:#f97316; }
.aqi-unhealthy{ color:#dc2626; }
.aqi-very{ color:#9333ea; }
.aqi-hazard{ color:#4c1d95; }

.aqi-status-baik{ background:#dcfce7 !important; color:#16a34a !important; }
.aqi-status-sedang{ background:#fef3c7 !important; color:#f59e0b !important; }
.aqi-status-sensitif{ background:#ffedd5 !important; color:#f97316 !important; }
.aqi-status-tidak-sehat{ background:#fee2e2 !important; color:#dc2626 !important; }
.aqi-status-sangat-tidak-sehat{ background:#f3e8ff !important; color:#9333ea !important; }
.aqi-status-berbahaya{ background:#ede9fe !important; color:#4c1d95 !important; }

/* ========================= POPUP ========================= */
.popup-informasi{
    min-width:180px;
    font-size:12px;
    line-height:1.7;
    cursor:pointer;
}

.popup-informasi b{ color:#000; }

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

.popup-tinggi{ color:red !important; }
.popup-sedang{ color:#b07d00 !important; }
.popup-rendah{ color:green !important; }
.popup-nodata{ color:#888 !important; }

.popup-empty{
    color:#d62828;
    font-weight:800;
}

.leaflet-popup-content-wrapper{ border-radius:8px; }
.leaflet-popup-content{ margin:9px 11px; }

/* ========================= DETAIL PAGE ========================= */
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

.detail-period{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:17px;
    color:#111827;
}

.detail-period span{ font-weight:400; }
.detail-period b{ font-size:18px; font-weight:700; }

.period-btn{
    border:none;
    background:transparent;
    color:#0891a5;
    font-size:24px;
    line-height:1;
    font-weight:800;
    cursor:pointer;
    padding:0 4px;
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

.badge-risk.tinggi{ background:#fee2e2; color:#dc2626; }
.badge-risk.sedang{ background:#fef9c3; color:#b45309; }
.badge-risk.rendah{ background:#dcfce7; color:#15803d; }
.badge-risk.nodata{ background:#f3f4f6; color:#6b7280; }

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

.rank-bar.tinggi{ background:#8b0000; }
.rank-bar.sedang{ background:#e76f51; }
.rank-bar.rendah{ background:#16a34a; }
.rank-bar span{ font-size:13px; }

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

.btn-kembali:hover{ background:#079bad; }

/* ========================= RESPONSIVE ========================= */
@media(max-width:768px){

    .section-card{ padding:12px; }

    .section-header{ flex-direction:column; gap:12px; }
    .section-header h5{ font-size:22px; }
    .section-header .sub{ font-size:14px; }

    .filter-wrapper{ flex-direction:column; align-items:flex-start; }
    .filter-left{ width:100%; gap:8px; }
    .filter-group label{ font-size:13px; margin-bottom:6px; }
    .filter-group select{ width:115px; height:34px; font-size:13px; }
    .filter-right{ width:100%; justify-content:flex-end; }
    .btn-filter, .btn-reset{ height:36px; font-size:14px; padding:0 16px; }

    #map{ height:330px !important; }

    .map-legend-box{ width:165px; padding:10px 12px 6px; }
    .map-legend-box h6{ font-size:13px; }
    .legend-item{ font-size:10px; margin-bottom:8px; }
    .legend-color{ width:19px; height:19px; }
    .label-desa{ font-size:10px; padding:3px 6px; }
    .popup-informasi{ min-width:160px; font-size:12px; }

    .detail-card{ padding:14px; }
    .detail-header{ flex-direction:column; align-items:flex-start; gap:10px; }
    .detail-header h5{ font-size:18px; }
    .detail-period{ font-size:15px; }
    .detail-inner{ padding:24px 18px 32px; }
    .detail-top{ flex-direction:column; gap:16px; margin-bottom:26px; }
    .detail-top h3{ font-size:21px; }
    .detail-label{ font-size:15px; }
    .detail-top h4{ font-size:17px; }
    .badge-risk{ font-size:14px; padding:7px 14px; }
    .chart-title{ font-size:19px; }
    .ranking-chart{ width:100%; min-width:100%; }
    .rank-name{ width:115px; font-size:11px; letter-spacing:2px; padding-right:10px; }
    .rank-bar-area{ height:30px; }
    .rank-bar{ height:22px; line-height:22px; }
    .btn-kembali{ width:100%; padding:10px 20px; }

}

.footer-maskot{ width:250px !important; }
*{ font-family:'Poppins', sans-serif; }
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


<?php
/* RINGKASAN DATA PNEUMONIA */
$db = \Config\Database::connect();

$dataRingkasan = [];

$tertinggi = [
    'kelurahan' => '-',
    'total' => 0
];

$rataRata = 0;
$diAtasRata = 0;
$totalKasus = 0;

$queryRingkasan = $db->query("
    SELECT
        w.kelurahan,
        p.id_pasien
    FROM pasien p
    INNER JOIN wilayah w
        ON p.id_wilayah = w.id_wilayah
    WHERE p.id_penyakit = 3
");

if($queryRingkasan){

    $rows = $queryRingkasan->getResultArray();

    $hasil = [];

    foreach($rows as $r){

        $desa = $r['kelurahan'];

        if(!isset($hasil[$desa])){
            $hasil[$desa] = 0;
        }

        $hasil[$desa] += 1;
    }

    foreach($hasil as $desa => $jumlah){

        $dataRingkasan[] = [
            'kelurahan' => $desa,
            'total' => $jumlah
        ];
    }

    usort($dataRingkasan, function($a, $b){
        return $b['total'] - $a['total'];
    });

    if(!empty($dataRingkasan)){

        $tertinggi = $dataRingkasan[0];

        $totalKasus = array_sum(
            array_column($dataRingkasan, 'total')
        );

        $rataRata = round(
            $totalKasus / count($dataRingkasan)
        );

        foreach($dataRingkasan as $d){

            if($d['total'] >= 45){
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
                Total seluruh kasus pneumonia adalah
                <span class="highlight-red">
                 <?= $totalKasus ?> kasus
                </span>
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
    <img src="<?= base_url('img/pneu_chat.png') ?>" alt="chatbot">
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
    width:75px;
    height:75px;
    border-radius:50%;
    background:rgb(46, 138, 224);
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

#chatbot-toggle img{
    width: 64px !important;
    height: 64px !important;

    max-width: 54px;
    max-height: 54px;

    object-fit: contain;
    display: block;
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
    bottom:20px;
    right:90px;
    width: 360px;
    height:540px;
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
    background:linear-gradient(135deg,#00CED1,#40EDD0);
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