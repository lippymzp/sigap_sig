<?php /** @var array $berita */ ?>

<?= $this->extend('layout/dashboard_layout'); ?>
<?= $this->section('content'); ?>

<style>
/* WRAPPER */
.berita-wrapper {
    padding: 20px;
    background: #f8f8f8;
    min-height: 100vh;
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
    margin-bottom: 20px;
}

.search-box input {
    width: 100%;
    padding: 12px 18px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    background: #fff;
}

/* SUMMARY BOX */
.summary-box {
    background: #13c5d3;
    border-radius: 8px;
    padding: 18px;
    color: white;
    margin-bottom: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

.summary-box h2 {
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    text-align: center;
}

.summary-box p {
    margin: 8px 0 0;
    font-size: 13px;
}

/* FILTER BUTTON */
.filter-tabs {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

.left-tabs {
    display: flex;
    gap: 10px;
}

.tab-btn {
    padding: 8px 24px;
    border: none;
    border-radius: 7px;
    font-size: 13px;
    cursor: pointer;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.08);
}

.tab-btn.active {
    background: #18c4c9;
    color: white;
    font-weight: 600;
    transform: scale(1.05);
    transition: 0.2s;
}

.add-btn {
    background: #ffd84d;
    color: #555;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    text-decoration: none;
    font-weight: 600;
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
}

.card-left {
    display: flex;
    gap: 15px;
    align-items: center;
}

.card-left img {
    width: 120px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
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
    max-width: 450px;
}

.card-info small {
    font-size: 12px;
    color: #999;
}

/* ACTION */
.card-right {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.action-icons {
    display: flex;
    gap: 10px;
}

.icon-btn {
    width: 34px;
    height: 34px;
    border-radius: 6px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: white;
    font-size: 15px;
    font-weight: bold;
}

.view {
    background: #204dff;
}

.status {
    background: #e7d900;
    color: #000;
}

.delete {
    background: #ff1f1f;
}

.upload-status {
    font-size: 13px;
    font-weight: 600;
    color: #14b514;
}

.summary-info {
    display: flex;
    justify-content: center;
    gap: 25px;
    margin-top: 10px;
    font-weight: 600;
}

.summary-info span {
    background: rgba(255,255,255,0.2);
    padding: 6px 12px;
    border-radius: 20px;
}
</style>

<!-- Tambahkan ini di <head> agar icon Font Awesome muncul -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="berita-wrapper">

    <div class="page-title">Kelola Berita</div>

    <!-- SEARCH -->
    <div class="search-box">
    <input type="text" id="searchInput" placeholder="Cari berita disini">
    </div>

    <!-- SUMMARY -->
    <div class="summary-box">
    <h2><?= !empty($berita) ? count($berita) : 0; ?> Berita Telah Dibuat</h2>

    <p class="summary-info">
        <span>🟢 <?= $publish ?? 0; ?> Berita telah diunggah
        &nbsp;&nbsp;
        <span>🟡 <?= $draft ?? 0; ?> Berita di draft
    </p>
</div>

<!-- FILTER -->
<?php $uri = service('uri')->getSegment(2); ?>
<div class="filter-tabs">
<div class="left-tabs">

<a href="/berita"
   class="tab-btn <?= ($uri == null) ? 'active' : '' ?>">
    Semua
</a>

<a href="/berita/publish"
   class="tab-btn <?= ($uri == 'publish') ? 'active' : '' ?>">
    Terunggah
</a>

<a href="/berita/draft"
   class="tab-btn <?= ($uri == 'draft') ? 'active' : '' ?>">
    Draft
</a>

</div>

        <a href="/berita/tambah" class="add-btn">
            Tambah Berita
        </a>
    </div>


    <!-- LIST BERITA -->
    <?php if (!empty($berita)) : ?>
        <?php foreach ($berita as $b): ?>
        <div class="card-berita" data-search="<?= strtolower(($b['judul_berita'] ?? '') . ' ' . ($b['deskripsi_berita'] ?? '')) ?>">

            <!-- LEFT -->
            <div class="card-left">

                <img src="/uploads/<?= $b['gambar_berita'] ?? 'default.jpg'; ?>" alt="Berita">

                <div class="card-info">

                    <h4><?= $b['judul_berita'] ?? '' ?></h4>

                    <p>
                        <?= $b['deskripsi_berita'] ?? '', 0, 120 ?>...
                    </p>

                    <small><?= $b['tanggal_berita'] ?? '' ?></small>

                    <div class="upload-status">
                    <?php 
                        $status = strtolower(trim($b['status_berita'] ?? 'draft'));
                        ?>

                        <div class="upload-status">
                            Status: <?= $status ?>
                        </div>
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div>

                <div class="action-icons">

                                <!-- VIEW -->
                <a href="/berita/view/<?= $b['id_berita']; ?>" class="icon-btn view">
                    <i class="fas fa-eye"></i>
                </a>

                <!-- EDIT -->
                <a href="/berita/edit/<?= $b['id_berita']; ?>" class="icon-btn status">
                    <i class="fas fa-pen"></i>
                </a>

                <!-- DELETE -->
                <a href="/berita/delete/<?= $b['id_berita']; ?>"
                class="icon-btn delete"
                onclick="return confirm('Hapus berita ini?')">
                    <i class="fas fa-trash"></i>
                </a>


                </div>

            </div>

        </div>


        <?php endforeach; ?>
    <?php else : ?>
        <p>Tidak ada data berita.</p>
    <?php endif; ?>

</div>
<script>
window.onload = function () {

const input = document.getElementById("searchInput");

input.addEventListener("input", function () {

let keyword = this.value.toLowerCase().trim();

document.querySelectorAll(".card-berita").forEach(function (item) {

    let data = item.getAttribute("data-search") || "";

    if (data.includes(keyword)) {
        item.style.display = "flex";
    } else {
        item.style.display = "none";
    }
    let found = false;

document.querySelectorAll(".card-berita").forEach(function (item) {
    let data = item.getAttribute("data-search") || "";

    if (data.includes(keyword)) {
        item.style.display = "flex";
        found = true;
    } else {
        item.style.display = "none";
    }
});

if (!found) {
    console.log("Tidak ada hasil");
}
    });

});

};

</script>

<?= $this->endSection(); ?>