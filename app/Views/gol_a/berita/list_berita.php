<?php
/** @var array $semuaData */
?>

<?= $this->include('layout/header_a') ?>

<?php
$keyword  = $keyword ?? '';
$kategori = $kategori ?? '';
?>

<title>List Berita</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>
/* ====== (CSS kamu tetap aku pertahankan, tidak aku ubah karena sudah bagus) ====== */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f5f5f5;
}

.berita-wrapper{
    max-width:1280px;
    margin:auto;
    padding-bottom:60px;
}

.hero-section{
    background:linear-gradient(90deg,#19bcc2,#9fd8d3);
    padding:38px 20px;
    text-align:center;
    color:#fff;
}

.hero-section h2{
    font-size:28px;
    font-weight:700;
    margin-bottom:6px;
}

.hero-section p{
    font-size:14px;
    opacity:.95;
    margin-bottom:14px;
}

.breadcrumb{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    font-size:13px;
}

.top-filter{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    padding:28px 20px;
}

.search-box{
    position:relative;
    width:700px;
    display:flex;
    align-items:center;
    background:#fff;
    border-radius:14px;
    box-shadow:0 6px 18px rgba(25,188,194,.25);
    padding:0 12px;
    transition:.3s;
    border:1px solid #19bcc2;;
}

.search-box:focus-within{
    border:1px solid #19bcc2;
    box-shadow:0 6px 20px rgba(25,188,194,.25);
}

.search-box i{
    color:#19bcc2;
    font-size:15px;
    margin-right:10px;
}

.search-box input{
    flex:1;
    height:46px;
    border:none;
    outline:none;
    font-size:14px;
    background:transparent;
    color:#333;
}

.search-box input::placeholder{
    color:#aaa;
}

/* tombol clear */
.clear-btn{
    background:transparent;
    border:none;
    cursor:pointer;
    color:#999;
    font-size:14px;
    padding:6px;
    transition:.2s;
}

.clear-btn:hover{
    color:#ff4d4d;
    transform:scale(1.1);
}

.filter-select{
    width:220px;
    height:42px;
    border:1px solid #d8d8d8;
    border-radius:8px;
    padding:0 14px;
    font-size:13px;
    color:#666;
    outline:none;
    background:#fff;
    box-shadow:0 2px 6px rgba(0,0,0,.08);
}

.berita-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:34px;
    padding:0 20px;
}

.berita-link{
    text-decoration:none;
    color:inherit;
}

.berita-card{
    background:#eef6f6;
    border:1px solid #bccccc;
    border-radius:10px;
    padding:14px;
    box-shadow:0 3px 8px rgba(0,0,0,.12);
    transition:.25s;
}

.berita-card:hover{
    transform:translateY(-4px);
}

.berita-image{
    width:100%;
    height:165px;
    overflow:hidden;
    border-radius:10px;
    margin-bottom:12px;
    background:#ddd;
}

.berita-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.berita-title{
    font-size:14px;
    font-weight:700;
    color:#222;
    line-height:1.5;
    margin-bottom:6px;
    min-height:42px;
}

.berita-date{
    font-size:10px;
    color:#999;
    margin-bottom:12px;
}

.berita-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:120px;
    height:28px;
    border-radius:999px;
    border:1px solid #19bcc2;
    background:#dff7f6;
    color:#19bcc2;
    font-size:11px;
    font-weight:600;
}

.empty-data{
    grid-column:1/-1;
    background:#fff;
    border-radius:12px;
    padding:60px;
    text-align:center;
    color:#777;
}

@media(max-width:992px){
    .berita-grid{grid-template-columns:repeat(2,1fr);}
}

@media(max-width:768px){
    .top-filter{flex-direction:column;align-items:stretch;}
    .search-box{width:100%;}
    .filter-select{width:100%;}
    .berita-grid{grid-template-columns:1fr;}
}
</style>

<div class="berita-wrapper">

    <!-- HERO -->
    <div class="hero-section">
        <h2>Berita Kesehatan dan Funfact DBD</h2>
        <p>Temukan berita kesehatan dan artikel terbaik</p>

        <div class="breadcrumb">
            <span>Beranda</span>
            <span>›</span>
            <span>Berita</span>
        </div>
    </div>

    <!-- FILTER -->
    <form method="GET">

        <div class="top-filter">

            <!-- SEARCH -->
            <div class="search-box">

                <i class="fa fa-search"></i>

                <input type="text"
                    name="keyword"
                    placeholder="Cari berita atau funfact..."
                    value="<?= esc($keyword) ?>">

                <?php if(!empty($keyword)) : ?>
                    <button type="button" class="clear-btn" onclick="window.location.href='<?= current_url() ?>'">
                        <i class="fa fa-times"></i>
                    </button>
                <?php endif; ?>

            </div>

            <!-- KATEGORI -->
            <select name="kategori"
                    class="filter-select"
                    onchange="this.form.submit()">

                <option value="">Semua Kategori</option>

                <option value="Berita Kesehatan"
                    <?= ($kategori == 'Berita Kesehatan') ? 'selected' : '' ?>>
                    Berita Kesehatan
                </option>

                <option value="Funfact DBD"
                    <?= ($kategori == 'Funfact DBD') ? 'selected' : '' ?>>
                    Funfact DBD
                </option>

            </select>

        </div>

    </form>

    <!-- GRID -->
    <div class="berita-grid">

        <?php if (!empty($semuaData)) : ?>

            <?php foreach ($semuaData as $item) : ?>

                <?php
                $isBerita = $item['tipe'] == 'berita';

                if ($isBerita) {
                    $judul   = $item['judul_berita'] ?? '';
                    $tanggal = $item['tanggal_berita'] ?? '';
                    $gambar  = $item['gambar_berita'] ?? 'default.jpg';
                    $kategoriItem = 'Berita Kesehatan';
                    $link = base_url('berita/view_user/' . $item['id_berita']);
                    $path = 'uploads/berita/';
                } else {
                    $judul   = $item['judul_funfact'] ?? '';
                    $tanggal = $item['tanggal_funfact'] ?? '';
                    $gambar  = $item['gambar_funfact'] ?? 'default.jpg';
                    $kategoriItem = 'Funfact DBD';
                    $link = base_url('berita/funfact_user/' . $item['id_funfact']);
                    $path = 'uploads/funfact/';
                }
                ?>

                <a href="<?= $link ?>" class="berita-link">

                    <div class="berita-card">

                        <div class="berita-image">
                            <img src="<?= base_url($path . $gambar) ?>"
                                 alt="<?= esc($judul) ?>">
                        </div>

                        <div class="berita-title">
                            <?= esc($judul) ?>
                        </div>

                        <div class="berita-date">
                            <?= esc($tanggal ?: '-') ?>
                        </div>

                        <div class="berita-badge">
                            <?= esc($kategoriItem) ?>
                        </div>

                    </div>

                </a>

            <?php endforeach; ?>

        <?php else : ?>

            <div class="empty-data">
                Tidak ada data tersedia.
            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->include('layout/footer_a') ?>