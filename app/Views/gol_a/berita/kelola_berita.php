<?php /** @var array $berita */ ?>

<?= $this->extend('layout/dashboard_layout_admin'); ?>

<?= $this->section('content'); ?>
<?php
$status = $_GET ['status'] ?? '';
$keyword = $keyword ?? '';
?>

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
.tab-btn:hover {
    background: #18c4c9;
    color: white;
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
/* ================= MODAL ================= */

.modal-overlay,
.notif-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-box,
.notif-box {
    width: 340px;
    background: white;
    border-radius: 18px;
    padding: 28px 24px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    animation: popupShow .25s ease;
}

@keyframes popupShow {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-icon,
.notif-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    margin: 0 auto 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 28px;
}

.modal-delete {
    background: #ff4d4f;
}

.modal-archive {
    background: #13c5d3;
}

.notif-success {
    background: #20bf55;
}

.notif-error {
    background: #ff4d4f;
}

.modal-title,
.notif-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 10px;
}

.modal-text,
.notif-text {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
}

.modal-btn,
.notif-btn {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
}

.btn-yes,
.notif-btn {
    background: #13c5d3;
    color: white;
}

.btn-no {
    background: #eee;
}
</style>

<!-- Tambahkan ini di <head> agar icon Font Awesome muncul -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="berita-wrapper">

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
<div class="filter-tabs">

    <div class="left-tabs">

        <a href="<?= site_url('berita'); ?>"
           class="tab-btn <?= empty($status) ? 'active' : '' ?>">
            Semua
        </a>

        <a href="<?= site_url('berita?status=publish'); ?>"
           class="tab-btn <?= ($status == 'publish') ? 'active' : '' ?>">
            Terunggah
        </a>

        <a href="<?= site_url('berita?status=draft'); ?>"
           class="tab-btn <?= ($status == 'draft') ? 'active' : '' ?>">
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

                <img src="/uploads/berita/<?= $b['gambar_berita'] ?? 'default.jpg'; ?>" alt="Berita">

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

            <!-- RIGHT -->
            <div>

                <div class="action-icons">

                                <!-- VIEW -->
                <a href="/berita/view_berita/<?= $b['id_berita']; ?>" class="icon-btn view">
                    <i class="fas fa-eye"></i>
                </a>

                <!-- EDIT -->
                <a href="/berita/edit/<?= $b['id_berita']; ?>" class="icon-btn status">
                    <i class="fas fa-pen"></i>
                </a>

                <!-- DELETE -->
                <a href="javascript:void(0)"
                onclick="openDeleteModal('/berita/delete/<?= $b['id_berita']; ?>')"
                class="icon-btn delete">

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

<!-- MODAL DELETE -->

<div class="modal-overlay" id="deleteModal">

    <div class="modal-box">

        <div class="modal-icon modal-delete">

            <i class="fa fa-trash"></i>

        </div>

        <div class="modal-title">

            Hapus Berita

        </div>

        <div class="modal-text">

            Apakah Anda Yakin<br>
            Ingin Menghapus<br>
            Berita Ini?

        </div>

        <a href="#"
           id="deleteLink"
           class="modal-btn btn-yes d-flex justify-content-center align-items-center text-decoration-none">

            Ya

        </a>

        <button class="modal-btn btn-no"
                onclick="closeDeleteModal()">

            Tidak

        </button>

    </div>

</div>

<!-- MODAL UNGGAH -->

<div class="modal-overlay" id="uploadModal">

    <div class="modal-box">

        <div class="modal-icon modal-archive">

            <i class="fa fa-arrow-up"></i>

        </div>

        <div class="modal-title">

            Unggah Berita

        </div>

        <div class="modal-text">

            Apakah Anda Ingin<br>
            Mengunggah<br>
            Berita ini?

        </div>

        <a href="#"
           id="uploadLink"
           class="modal-btn btn-yes d-flex justify-content-center align-items-center text-decoration-none">

            Ya

        </a>

        <button class="modal-btn btn-no"
                onclick="closeUploadModal()">

            Tidak

        </button>

    </div>

</div>

<!-- NOTIFIKASI SUCCESS -->

<?php if(session()->getFlashdata('success')) : ?>

<div class="notif-overlay" id="successNotif">

    <div class="notif-box">

        <div class="notif-icon notif-success">

            <i class="fa fa-check"></i>

        </div>

        <div class="notif-title">

            Berhasil

        </div>

        <div class="notif-text">

            <?= session()->getFlashdata('success'); ?>

        </div>

        <button class="notif-btn"
                onclick="closeSuccessNotif()">

            Oke

        </button>

    </div>

</div>

<?php endif; ?>

<!-- NOTIFIKASI ERROR -->

<?php if(session()->getFlashdata('error')) : ?>

<div class="notif-overlay" id="errorNotif">

    <div class="notif-box">

        <div class="notif-icon notif-error">

            <i class="fa fa-xmark"></i>

        </div>

        <div class="notif-title">

            Gagal

        </div>

        <div class="notif-text">

            <?= session()->getFlashdata('error'); ?>

        </div>

        <button class="notif-btn"
                onclick="closeErrorNotif()">

            Coba Lagi

        </button>

    </div>

</div>

<?php endif; ?>

<script>
window.onload = function () {

const input = document.getElementById("searchInput");

if (!input) return;

input.addEventListener("input", function () {

    let keyword = this.value.toLowerCase().trim();

    let found = false;

    document.querySelectorAll(".card-berita")
    .forEach(function (item) {

        let data =
            item.getAttribute("data-search") || "";

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

};

/* ================= DELETE ================= */

function openDeleteModal(link)
{
    document.getElementById('deleteModal')
    .style.display = 'flex';

    document.getElementById('deleteLink')
    .href = link;
}

function closeDeleteModal()
{
    document.getElementById('deleteModal')
    .style.display = 'none';
}

/* ================= UPLOAD ================= */

function openUploadModal(link)
{
    document.getElementById('uploadModal')
    .style.display = 'flex';

    document.getElementById('uploadLink')
    .href = link;
}

function closeUploadModal()
{
    document.getElementById('uploadModal')
    .style.display = 'none';
}

/* ================= NOTIF ================= */

function closeSuccessNotif()
{
    let el = document.getElementById('successNotif');

    if(el)
    {
        el.style.display = 'none';
    }
}

function closeErrorNotif()
{
    let el = document.getElementById('errorNotif');

    if(el)
    {
        el.style.display = 'none';
    }
}

/* ================= CLOSE MODAL ================= */

window.onclick = function(e)
{
    let editModal =
    document.getElementById('editModal');

    let deleteModal =
    document.getElementById('deleteModal');

    let uploadModal =
    document.getElementById('uploadModal');

    if(e.target == editModal)
    {
        closeEditModal();
    }

    if(e.target == deleteModal)
    {
        closeDeleteModal();
    }

    if(e.target == uploadModal)
    {
        closeUploadModal();
    }
}


</script>

<?= $this->endSection(); ?>