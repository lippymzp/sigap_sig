<?= $this->extend('layout/dashboard_layout_admin'); ?>

<?= $this->section('content'); ?>

<?php

$totalFunfact = $totalFunfact ?? 0;
$totalUpload  = $totalUpload ?? 0;
$totalDraft   = $totalDraft ?? 0;
$status       = $status ?? '';
$keyword      = $keyword ?? '';
$funfact      = $funfact ?? [];

?>

<style>

body{
    background:#f5f5f5;
    font-family:'Poppins', sans-serif;
}

/* CONTAINER */

.container-fluid{
    padding:25px 40px;
}

/* SEARCH */

.search-box{
    background:white;
    border:1px solid #cfcfcf;
    border-radius:14px;
    height:58px;
    display:flex;
    align-items:center;
    padding:0 18px;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
}

.search-input{
    border:none;
    outline:none;
    width:100%;
    font-size:16px;
    margin-left:14px;
    background:transparent;
}

/* STAT BOX */

.stat-box{
    background:#14c3cf;
    border-radius:12px;
    padding:20px 28px;
    color:white;
    margin-top:18px;
    margin-bottom:22px;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
}

.stat-title{
    font-size:34px;
    font-weight:700;
    text-align:center;
    line-height:1.2;
}

.stat-desc{
    margin-top:10px;
    font-size:14px;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
    text-align:center;
    flex-wrap:wrap;
}

/* FILTER */

.filter-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:15px;
}

.filter-left{
    display:flex;
    gap:16px;
    flex-wrap:wrap;
}

.filter-btn{
    width:170px;
    height:46px;
    border-radius:12px;
    border:1px solid #bdbdbd;
    background:white;
    font-size:16px;
    font-weight:600;
    text-decoration:none;
    display:flex;
    justify-content:center;
    align-items:center;
    color:#111;
    box-shadow:0 2px 6px rgba(0,0,0,0.06);
}

.filter-btn.active{
    background:#14c3cf;
    color:white;
    border:none;
}

.add-btn{
    background:#f4d44d;
    color:white;
    border:none;
    border-radius:12px;
    padding:10px 22px;
    font-size:16px;
    font-weight:600;
    text-decoration:none;
    box-shadow:0 2px 6px rgba(0,0,0,0.08);
}

.add-btn:hover{
    color:white;
}

/* CARD */

.funfact-card{
    background:#edf6f6;
    border:1px solid #c6d6d6;
    border-radius:12px;
    padding:14px 18px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:16px;
    box-shadow:0 2px 6px rgba(0,0,0,0.06);
    gap:16px;
    min-height:150px;
}

/* LEFT */

.card-left{
    display:flex;
    gap:16px;
    align-items:center;
    flex:1;
    min-width:0;
}

/* IMAGE */

.image-wrapper{
    width:150px;
    height:100px;
    background:white;
    border-radius:10px;
    overflow:hidden;
    flex-shrink:0;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:6px;
}

.card-image{
    width:100%;
    height:100%;
    object-fit:contain;
}

/* CONTENT */

.card-content{
    flex:1;
    min-width:0;
}

.card-title{
    font-size:17px;
    font-weight:700;
    color:#111;
    margin-bottom:6px;
    line-height:1.4;
}

.card-desc{
    color:#9a9a9a;
    font-size:13px;
    line-height:1.5;
    margin-bottom:18px;
}

.card-date{
    color:#a0a0a0;
    font-size:12px;
}

/* RIGHT */

.card-right{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:10px;
    flex-shrink:0;
}

/* ACTION */

.action-group{
    display:flex;
    gap:10px;
    align-items:center;
}

.icon-btn{
    width:42px;
    height:42px;
    border:none;
    border-radius:8px;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-size:17px;
    text-decoration:none;
    transition:0.2s;
    cursor:pointer;
}

.icon-btn:hover{
    transform:scale(1.04);
    color:white;
}

.view-btn{
    background:#1f28ff;
}

.edit-btn{
    background:#e7d000;
}

.delete-btn{
    background:#ff1d1d;
}

/* STATUS */

.status-upload{
    color:#14c3cf;
    font-size:15px;
    font-weight:700;
    text-align:center;
    white-space:nowrap;
}

/* EMPTY */

.empty-box{
    background:white;
    border-radius:18px;
    padding:50px;
    text-align:center;
    color:#888;
    font-size:18px;
}

/* MODAL */

.modal-overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.35);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.modal-box{
    width:280px;
    background:white;
    border-radius:16px;
    padding:24px 22px;
    text-align:center;
    box-shadow:0 5px 18px rgba(0,0,0,0.18);
    animation:zoomIn .2s ease;
}

@keyframes zoomIn{
    from{
        transform:scale(.8);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}

.modal-icon{
    width:56px;
    height:56px;
    border-radius:50%;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-size:26px;
    margin-bottom:14px;
}

.modal-delete{
    background:#ff4d4d;
}

.modal-archive{
    background:#14c3cf;
}

.modal-title{
    font-size:20px;
    font-weight:700;
    color:#111;
    margin-bottom:8px;
}

.modal-text{
    font-size:15px;
    color:#666;
    line-height:1.5;
    margin-bottom:18px;
}

.modal-btn{
    width:100%;
    border:none;
    height:42px;
    border-radius:10px;
    font-size:16px;
    font-weight:600;
    margin-bottom:10px;
    cursor:pointer;
}

.btn-yes{
    background:#14c3cf;
    color:white;
}

.btn-no{
    background:white;
    color:#666;
    border:1px solid #ddd;
}

/* NOTIFIKASI */

.notif-overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.35);
    display:flex;
    justify-content:center;
    align-items:center;
    z-index:99999;
}

.notif-box{
    width:360px;
    background:white;
    border-radius:18px;
    padding:35px;
    text-align:center;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

.notif-icon{
    width:70px;
    height:70px;
    border-radius:50%;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
    font-size:34px;
    margin-bottom:18px;
}

.notif-success{
    background:#4cc47c;
}

.notif-error{
    background:#ff4d4d;
}

.notif-title{
    font-size:20px;
    font-weight:700;
    margin-bottom:10px;
}

.notif-text{
    font-size:15px;
    color:#666;
    line-height:1.5;
    margin-bottom:20px;
}

.notif-btn{
    width:100%;
    height:48px;
    border:none;
    border-radius:12px;
    background:#14c3cf;
    color:white;
    font-size:17px;
    font-weight:600;
    margin-bottom:10px;
    cursor:pointer;
}

.notif-close{
    width:100%;
    height:46px;
    border:none;
    border-radius:12px;
    background:white;
    border:1px solid #ddd;
    color:#666;
    font-size:17px;
    cursor:pointer;
}

/* FIX MODAL EDIT */

.custom-modal{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.35);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:999999;
}

.custom-modal.active{
    display:flex;
}

.custom-modal .modal-box{
    width:370px;
    background:#fff;
    border-radius:22px;
    padding:34px 28px 24px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.18);
}

.custom-modal .modal-btn{
    width:100%;
    height:54px;
    border:none;
    border-radius:14px;
    background:#18c4d1;
    color:white;
    font-size:18px;
    font-weight:700;
    cursor:pointer;
}

.custom-modal .modal-link{
    width:100%;
    height:52px;
    border-radius:14px;
    border:1px solid #ddd;
    background:white;
    color:#666;
    font-size:18px;
    font-weight:700;
    margin-top:12px;
    cursor:pointer;
    display:flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
}

.custom-modal .modal-title{
    font-size:24px;
    font-weight:800;
    color:#111;
    margin-bottom:10px;
}

.custom-modal .modal-desc{
    font-size:16px;
    color:#666;
    line-height:1.6;
    margin-bottom:22px;
}

/* RESPONSIVE */

@media(max-width:768px){

    .funfact-card{
        flex-direction:column;
        align-items:flex-start;
    }

    .card-left{
        width:100%;
        flex-direction:column;
        align-items:flex-start;
    }

    .image-wrapper{
        width:100%;
        height:180px;
    }

    .card-right{
        width:100%;
        align-items:flex-start;
    }

    .action-group{
        width:100%;
    }
}

</style>

    <!-- SEARCH -->

    <form method="get" action="<?= current_url(); ?>">

        <input type="hidden"
               name="status"
               value="<?= esc($status ?? 'upload') ?>">

        <div class="search-box">

            <i class="fa fa-search fa-2x text-secondary"></i>

            <input type="text"
                   name="keyword"
                   class="search-input"
                   placeholder="Cari funfact disini"
                   value="<?= esc($keyword ?? '') ?>">

        </div>

    </form>

    <!-- STAT -->

    <div class="stat-box">

        <div class="stat-title">

            <?= $totalFunfact; ?> Funfact Telah Dibuat

        </div>

        <div class="stat-desc">

            <span>● <?= $totalUpload ?? 0; ?> Funfact telah diunggah</span>

            <span>● <?= $totalDraft ?? 0; ?> Funfact di draft</span>

        </div>

    </div>

    <!-- FILTER -->

    <div class="filter-row">

        <div class="filter-left">

            <a href="<?= site_url('funfact?status=upload'); ?>"
               class="filter-btn <?= ($status == 'upload' || empty($status)) ? 'active' : '' ?>">

                Terunggah

            </a>

            <a href="<?= site_url('funfact?status=draft'); ?>"
               class="filter-btn <?= ($status == 'draft') ? 'active' : '' ?>">

                Draft

            </a>

        </div>

        <a href="<?= base_url('dbd/unggahfunfact') ?>"
           class="add-btn">

            Tambah Funfact

        </a>

    </div>

<?php

$filteredFunfact = [];

foreach($funfact ?? [] as $f)
{
    if(empty($status))
    {
        if($f['status_funfact'] == 'upload')
        {
            $filteredFunfact[] = $f;
        }
    }
    else
    {
        if($f['status_funfact'] == $status)
        {
            $filteredFunfact[] = $f;
        }
    }
}

?>

<?php if(!empty($filteredFunfact)) : ?>

    <?php foreach($filteredFunfact as $f) : ?>

        <div class="funfact-card">

            <div class="card-left">

                <div class="image-wrapper">

                    <?php if(!empty($f['gambar_funfact'])) : ?>

                        <img src="<?= base_url('uploads/funfact/' . $f['gambar_funfact']) ?>"
                             class="card-image">

                    <?php else : ?>

                        <img src="https://via.placeholder.com/220x140"
                             class="card-image">

                    <?php endif; ?>

                </div>

                <div class="card-content">

                    <div class="card-title">

                        <?= ($f['judul_funfact']); ?>

                    </div>

                    <div class="card-desc">

                        <?= substr($f['deskripsi_funfact'], 0, 100) ?>

                    </div>

                    <div class="card-date">

   <?php if(!empty($f['tanggal_funfact']) && $f['tanggal_funfact'] != '0000-00-00 00:00:00') : ?>

    <?php
        date_default_timezone_set('Asia/Jakarta');

        $bulan = [
            1 => 'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        $tanggal = strtotime($f['tanggal_funfact']);

        if($tanggal !== false) {

            $hari   = date('d', $tanggal);
            $bulanId = $bulan[(int)date('m', $tanggal)];
            $tahun  = date('Y', $tanggal);
            $jam    = date('H:i', $tanggal);

            echo $hari . ' ' . $bulanId . ' ' . $tahun . ' • ' . $jam . ' WIB';
        }
    ?>

<?php else : ?>

    <span style="color:#bbb;">Tanggal belum diisi</span>

<?php endif; ?>

</div>

                </div>

            </div>

            <div class="card-right">

                <div class="action-group">

                  <!-- VIEW -->

<a href="<?= base_url('funfact/view/'.$f['id_funfact']) ?>"
   class="icon-btn view-btn">

    <i class="fa fa-eye"></i>

</a>


<!-- EDIT -->

<a href="<?= site_url('funfact/edit/' . $f['id_funfact']) ?>"
   class="icon-btn edit-btn">

    <i class="fa fa-pen"></i>

</a>

                    <!-- DELETE -->

                    <button type="button"
                            class="icon-btn delete-btn"
                            onclick="openDeleteModal('<?= site_url('funfact/hapus/' . $f['id_funfact']) ?>')">

                        <i class="fa fa-trash"></i>

                    </button>

                </div>

                <div class="status-upload">

                    <?= ($f['status_funfact'] == 'draft')
                        ? 'Draft'
                        : 'Telah Diunggah'; ?>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

<?php else : ?>

    <div class="empty-box">

        Belum ada data funfact

    </div>

<?php endif; ?>

</div>

<!-- MODAL DELETE -->

<div class="modal-overlay" id="deleteModal">

    <div class="modal-box">

        <div class="modal-icon modal-delete">

            <i class="fa fa-trash"></i>

        </div>

        <div class="modal-title">

            Hapus Funfact

        </div>

        <div class="modal-text">

            Apakah Anda Yakin<br>
            Ingin Menghapus<br>
            Funfact Ini?

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

            Unggah Funfact

        </div>

        <div class="modal-text">

            Apakah Anda Ingin<br>
            Mengunggah<br>
            Funfact ini?

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