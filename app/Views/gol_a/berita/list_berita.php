<?php /** @var array $berita */ ?>
<?= $this->include('layout/header') ?>
<?php
$status = $_GET ['status'] ?? '';
$keyword = $keyword ?? '';
?>

<title>List Berita</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#f5f7fa;
}

/* WRAPPER */
.berita-wrapper {
    padding: 20px;
    background: #f8f8f8;
    min-height: 100vh;
    max-width: 1100px;
    margin: 0 auto;
}

/* TITLE */
.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #222;
    margin-bottom: 20px;
}

/* SEARCH */
.search-box {
    position: relative;
    margin-bottom: 20px;
}
.search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    font-size: 14px;
}
.search-box input {
    width: 100%;
    padding: 12px 18px 12px 42px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    background: #fff;
}

/* FILTER BUTTON */
.filter-tabs {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

.tab-btn {
    padding: 8px 24px;
    border: none;
    border-radius: 7px;
    font-size: 13px;
    cursor: pointer;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.08);

    color: #333;
    text-decoration: none;
    transition: 0.2s;
}

.tab-btn.active {
    background: #18c4c9;
    color: #fff !important;
    font-weight: 600;
    transform: scale(1.05);
}

/* CARD */
.card-berita {
    background: #eef9fb;
    padding: 14px;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 10px;
    border: 1px solid #d8eef2;
    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    width: 100%;
}
.card-berita:hover{
    transform:translateY(-3px);
}
.card-left {
    display:flex;
    flex:1;
    gap:18px;
    padding:18px;
}

.card-left img {
    width: 120px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink:0;
}
/* INFO */
.card-info{
    flex:1;
}
.card-info h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #111;
}

.card-info p {
    font-size: 13px;
    color: #777;
    margin: 6px 0;
    max-width: 100%;
}

.card-info small {
    display:block;
    margin-bottom:12px;
    color:#999;
    font-size:12px;
}

.upload-status {
    display:inline-block;
    background:#e8f9fa;
    color:#00aab0;
    padding:7px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
}
/* EMPTY */
.empty-data{
    text-align:center;
    padding:50px 20px;
    color:#777;
    font-size:15px;
}

/* RESPONSIVE */
@media(max-width:768px){

    .card-berita{
        flex-direction:column;
    }

    .card-left{
        flex-direction:column;
    }
    .card-left img{
        width:100%;
        height:220px;
    }

    .card-info h4{
        font-size:20px;
    }
}
</style>

<div class="berita-wrapper">

    <div class="page-title">Berita DBD</div>

    <!-- SEARCH -->
    <form method="get" action="<?= current_url(); ?>">

        <input type="hidden"
               name="status"
               value="<?= esc(is_string($status) ? $status : 'publish') ?>">

        <div class="search-box">

            <i class="fa fa-search"></i>

            <input type="text"
                   id="searchInput"
                   name="keyword"
                   class="search-input"
                   placeholder="Cari berita disini"
                   value="<?= esc($keyword ?? '') ?>">

        </div>

    </form>


    <!-- LIST BERITA -->
    <?php if (!empty($berita)) : ?>
        <?php foreach ($berita as $b): ?>

        <a href="<?= base_url('berita/view_user/' . $b['id_berita']) ?>" 
        style="text-decoration:none; color:inherit;">

        <div class="card-berita" 
            data-search="<?= strtolower(($b['judul_berita'] ?? '') . ' ' . ($b['deskripsi_berita'] ?? '')) ?>">

            <!-- LEFT -->
            <div class="card-left">

                <img src="/uploads/<?= $b['gambar_berita'] ?? 'default.jpg'; ?>" alt="Berita">

                <div class="card-info">

                    <h4><?= $b['judul_berita'] ?? '' ?></h4>

                    <p>
                        <?= substr(strip_tags($b['isi_berita'] ?? ''), 0, 120) ?>...
                    </p>

                    <p>
                        <?= substr(strip_tags($b['deskripsi_berita'] ?? ''), 0, 120) ?>...
                    </p>

                    <small><?= $b['tanggal_berita'] ?? '' ?></small>

                    <div class="upload-status">

                    <?php 
                    $statusBerita = strtolower(trim($b['status_berita'] ?? 'draft'));
                    ?>

                    <div class="upload-status">
                        Status: <?= $statusBerita ?>
                    </div>
                    </div>
                </div>
            </div>
            </div>
</a>

        <?php endforeach; ?>
    <?php else : ?>
        <p>Tidak ada data berita.</p>
    <?php endif; ?>

</div>


<script>
const input = document.getElementById("searchInput");

input.addEventListener("input", function () {

    let keyword = this.value.toLowerCase().trim();

    document.querySelectorAll(".card-berita")
    .forEach(function (item) {

        let data = item.getAttribute("data-search");

        if (data.includes(keyword)) {

            item.style.display = "flex";

        } else {

            item.style.display = "none";
        }

    });

});

</script>