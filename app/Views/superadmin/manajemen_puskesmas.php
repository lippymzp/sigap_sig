<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- STYLE -->
    <style>

        body, input, button, select, textarea {
    font-family: 'Poppins', sans-serif;
}

        /* header */
.header-user {
    display: flex;
    align-items: center;
    gap: 15px;
    background:  linear-gradient(90deg, #26c6da, #4dd0e1);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 600;
}

.header-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

/* Container Pagination */
.pagination {
    display: flex;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
    padding: 0;
}

/* Kotak per halaman */
.pagination .page-item {
    border-right: 1px solid #dee2e6;
}

.pagination .page-item:last-child {
    border-right: none;
}

.pagination .page-link {
    padding: 8px 16px;
    color: #4a5568; /* text gelap abu */
    text-decoration: none;
    background: #fff;
    border: none;
    font-size: 14px;
    display: block;
    transition: all 0.2s;
}

/* Hover effect */
.pagination .page-link:hover {
    background: #e0f2f1; /* hijau muda saat hover */
    color: #00cec9;
}

/* Saat Aktif (Halaman yang dipilih) */
.pagination .page-item.active .page-link {
    background: #b2dfdb; /* hijau muda sesuai UI */
    color: #00cec9;
    font-weight: 600;
}

/* Tombol utama */
.btn-navy {
    background: #26c6da; /* hijau utama */
    color: white;
}

.btn-navy:hover {
    background: #00acc1; /* hijau lebih gelap saat hover */
    color: white;
}

/* Icon search */
.search-icon {
    background: #26c6da;
    color: white;
}

.input-group-text {
    border-right: none;
}

.form-control {
    border-left: none;
}

/* Modal Styling */
.modal-hapus {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.25);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal-box {
    background: #fff;
    padding: 35px 30px;
    border-radius: 20px;
    text-align: center;
    width: 380px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    animation: popIn 0.3s ease;
}

.modal-box .icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 5px solid #e53935;
    color: #e53935;
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}

.btn-batal {
    background: #e0e0e0;
    color: #333;
    border: 1px solid #c2c2c2;
    padding: 8px 22px;
    border-radius: 8px !important;
    margin-right: 10px;
}

.btn-batal:hover {
    background: #d5d5d5;
}

.btn-hapus {
    background: #e53935;
    color: white;
    border: 1px solid #d32f2f;
    padding: 8px 22px;
    border-radius: 8px;
    margin-left: 10px;
}

/* =========================
MODAL NOTIF PUSKESMAS
========================= */
.modal-puskesmas{
    position: fixed;
    top: 0;
    left: 0;

    width: 100%;
    height: 100vh;

    background: rgba(238,244,244,0.75);

    display: none;
    justify-content: center;
    align-items: center;

    z-index: 99999;

    backdrop-filter: blur(2px);
}

.modal-puskesmas-box{
    width: 255px;

    background: #fff;

    border-radius: 8px;

    padding: 34px 24px 18px;

    text-align: center;

    box-shadow:
        0 8px 20px rgba(0,0,0,0.16),
        0 2px 5px rgba(0,0,0,0.08);
}

/* ICON */
.icon-success-puskesmas{
    width: 42px;
    height: 42px;

    margin: auto;
    margin-bottom: 16px;

    background: #59c57b;

    border-radius: 50%;

    display: flex;
    justify-content: center;
    align-items: center;
}

.icon-success-puskesmas i{
    color: white;
    font-size: 22px;
    font-weight: bold;
}

/* TITLE */
.modal-puskesmas-title{
    font-size: 16px;
    font-weight: 700;

    color: #1f1f1f;

    line-height: 1.45;

    margin-bottom: 10px;
}

/* SUBTITLE */
.modal-puskesmas-subtitle{
    font-size: 13px;
    color: #8f8f8f;

    margin-bottom: 20px;
}

/* BUTTON LIHAT DETAIL */
.btn-detail-puskesmas{
    width: 100%;

    height: 30px;

    border: none;

    border-radius: 5px;

    background: #16c2cf;

    color: white;

    font-size: 13px;
    font-weight: 500;

    margin-bottom: 10px;

    transition: all .25s ease;

    box-shadow:
        0 3px 6px rgba(0,0,0,0.12);
}

.btn-detail-puskesmas:hover{
    background: #00acc1;

    transform: translateY(-2px);

    box-shadow:
        0 8px 18px rgba(0,0,0,0.18),
        0 3px 8px rgba(38,198,218,0.35);
}

/* BUTTON SELESAI */
.btn-selesai-puskesmas{
    width: 100%;

    height: 30px;

    border: none;

    border-radius: 5px;

    background: #f4f4f4;

    color: #7b7b7b;

    font-size: 13px;
    font-weight: 500;

    transition: all .25s ease;

    box-shadow:
        0 3px 6px rgba(0,0,0,0.10);
}

.btn-selesai-puskesmas:hover{
    background: #ebebeb;

    transform: translateY(-2px);

    box-shadow:
        0 8px 18px rgba(0,0,0,0.15),
        0 3px 8px rgba(0,0,0,0.10);
}

.pagination{
    display:flex;
    gap:6px;
}

.page-link{
    padding:8px 14px;
    border-radius:8px;
    background:#f1f5f9;
    color:#333;
    text-decoration:none;
    font-size:14px;
    border:none;
}

.page-link:hover{
    background:#26c6da;
    color:white;
}

.page-link.active{
    background:#26c6da;
    color:white;
}

.table-wrapper{
    overflow-x: auto;
    width: 100%;
}

.table{
    min-width: 900px;
}

th:last-child,
td:last-child{
    width: 140px;
    min-width: 140px;
    max-width: 140px;
    white-space: nowrap;
    text-align: center;
}

/* HEADER TABEL RATA TENGAH */
.table thead th{
    text-align: center;
    vertical-align: middle;
}

/* ISI TABEL JANGAN TURUN */
.table td{
    white-space: nowrap;
    vertical-align: middle;
}
@keyframes popIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
    </style>
<div class="container-fluid">

    <!-- HEADER -->
 <div class="header-user">
        <div class="header-icon">
        <img src="/img/icon_breadcrumb.svg" alt="Icon User">
    </div>
    <div>
        <h5>Manajemen Puskesmas</h5>
        <small>Menampilkan puskesmas</small>
    </div>
</div>

<!-- ALERT SUKSES 
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>-->

<!-- CARD -->
<div class="card shadow-sm" style="border-radius:10px;">
    <div class="card-body">

        <!-- SEARCH + TAMBAH DATA -->
        <div class="d-flex justify-content-between mb-3">
            <form method="get" action="/superadmin/puskesmas" style="max-width:500px;">
                <div class="input-group">
                    <span class="input-group-text search-icon">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Ketik untuk mencari..."
                        value="<?= $keyword ?? '' ?>">
                    <button type="submit" class="btn btn-navy">
                        Cari
                    </button>
                </div>
            </form>

            <a href="/superadmin/puskesmas/create" class="btn btn-navy">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>

        <?php if(session()->getFlashdata('success')): ?>

        <div class="modal-puskesmas" id="modal-puskesmas"
        style="display:flex;">

            <div class="modal-puskesmas-box">

                <div class="icon-success-puskesmas">
                    <i class="bi bi-check-lg"></i>
                </div>

                <div class="modal-puskesmas-title">
                    Input Data Puskesmas<br>
                    Berhasil
                </div>

                <div class="modal-puskesmas-subtitle">
                    Data berhasil disimpan
                </div>

                <button
                    type="button"
                    class="btn-detail-puskesmas"
                    onclick="window.location.href='/superadmin/puskesmas/view/<?= session()->getFlashdata('id_puskesmas') ?>'">

                    Lihat Detail

                </button>

                <button
                    type="button"
                    class="btn-selesai-puskesmas"
                    onclick="document.getElementById('modal-puskesmas').style.display='none'">

                    Selesai

                </button>

            </div>

        </div>

        <?php endif; ?>
        <!-- =========================
        MODAL DELETE BERHASIL
        ========================= -->
        <?php if(session()->getFlashdata('success_delete')): ?>

        <div class="modal-puskesmas"
        id="modal-delete-success"
        style="display:flex;">

            <div class="modal-puskesmas-box">

                <div
                    class="icon-success-puskesmas"
                    style="background:#ef5350;">

                    <i class="bi bi-trash"></i>

                </div>

                <div class="modal-puskesmas-title">
                    Hapus Data Puskesmas<br>
                    Berhasil
                </div>

                <div class="modal-puskesmas-subtitle">
                    Data berhasil dihapus
                </div>

                <button
                    type="button"
                    class="btn-selesai-puskesmas"
                    onclick="document.getElementById('modal-delete-success').style.display='none'">

                    Selesai

                </button>

            </div>

        </div>

        <?php endif; ?>
        <!-- TABLE -->
        <div class="table-wrapper">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Puskesmas</th>
                        <th>Kecamatan</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users) && count($users) > 0): ?>
                        <?php $no = (($currentPage ?? 1) - 1) * ($perPage ?? 5) + 1;?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($user['nama_puskesmas']) ?></td>
                                <td><?= esc($user['nama_kecamatan']) ?></td>                                
                                <td><?= esc($user['no_telpon_puskesmas']) ?></td>
                                <td><?= esc($user['email_puskesmas']) ?></td>
                                <td class="text-center">
                                    <a href="/superadmin/puskesmas/view/<?= $user['id_manajemen_puskesmas'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-search"></i></a>
                                    <a href="/superadmin/puskesmas/edit/<?= $user['id_manajemen_puskesmas'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <!-- <a href="/superadmin/puskesmas/delete/<?= $user['id_manajemen_puskesmas'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a> -->
                                     <a href="#" class="btn btn-sm btn-danger" onclick="showDeleteModal(<?= $user['id_manajemen_puskesmas'] ?>)"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted" style="font-size: 14px;">
                <!--Menampilkan <?= count($users ?? []) ?> dari <?= count($users ?? []) ?> data-->
                Menampilkan <?= count($users ?? []) ?> dari <?= $totalData ?> data
            </div>
        <div class="pagination">

            <!-- PREV -->
            <?php if($currentPage > 1): ?>

                <a class="page-link"
                href="?page=<?= $currentPage - 1 ?>&keyword=<?= $keyword ?>">
                    Prev
                </a>

            <?php endif; ?>

            <!-- ANGKA -->
            <?php for($i = 1; $i <= $totalPage; $i++): ?>

                <a
                    class="page-link <?= $i == $currentPage ? 'active' : '' ?>"
                    href="?page=<?= $i ?>&keyword=<?= $keyword ?>">

                    <?= $i ?>

                </a>

            <?php endfor; ?>

            <!-- NEXT -->
            <?php if($currentPage < $totalPage): ?>

                <a class="page-link"
                href="?page=<?= $currentPage + 1 ?>&keyword=<?= $keyword ?>">
                    Next
                </a>

            <?php endif; ?>

        </div>
        </div>

    </div>
</div>
<!-- =========================
MODAL DELETE PUSKESMAS
========================= -->
<div class="modal-puskesmas" id="modal-delete-puskesmas">

    <div class="modal-puskesmas-box">

        <!-- ICON -->
        <div
            class="icon-success-puskesmas"
            style="background:#ef5350;">

            <i class="bi bi-trash"></i>

        </div>

        <!-- TITLE -->
        <div class="modal-puskesmas-title">
            Hapus Data Puskesmas
        </div>

        <!-- SUBTITLE -->
        <div class="modal-puskesmas-subtitle">
            Yakin ingin menghapus data ini?
        </div>

        <!-- BUTTON HAPUS -->
        <button
            type="button"
            class="btn-detail-puskesmas"
            id="btn-confirm-delete"
            style="background:#ef5350;">

            Ya, Hapus

        </button>

        <!-- BUTTON BATAL -->
        <button
            type="button"
            class="btn-selesai-puskesmas"
            onclick="closeDeleteModal()">

            Batal

        </button>

    </div>

</div>

<script>

// ===============================
// SHOW MODAL DELETE
// ===============================
function showDeleteModal(id){

    document.getElementById(
        'modal-delete-puskesmas'
    ).style.display = 'flex';

    document.getElementById(
        'btn-confirm-delete'
    ).onclick = function(){

        window.location.href =
        "/superadmin/puskesmas/delete/" + id;

    };

}

// ===============================
// CLOSE MODAL
// ===============================
function closeDeleteModal(){

    document.getElementById(
        'modal-delete-puskesmas'
    ).style.display = 'none';

}

</script>

<?= $this->endSection() ?>