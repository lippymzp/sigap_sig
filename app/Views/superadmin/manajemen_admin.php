<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<style>

.admin-page{
    padding:20px 28px;
    font-family:'Poppins',sans-serif;
}

/* =========================
TITLE
========================= */

.page-title{
    display:flex;
    align-items:center;
    gap:14px;

    font-size:34px;
    font-weight:700;

    color:#111;

    margin-bottom:25px;
}

.page-title i{
    font-size:22px;
}

/* =========================
SEARCH
========================= */

.search-box{
    position:relative;
    margin-bottom:18px;
}

.search-box input{
    width:100%;
    height:52px;

    border:none;
    border-radius:10px;

    background:white;

    padding:0 18px 0 55px;

    font-size:14px;

    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

.search-box i{
    position:absolute;
    left:18px;
    top:50%;
    transform:translateY(-50%);
    color:#999;
}

/* =========================
TOP BAR
========================= */

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:15px;
}

.btn-tab{
    background:#23C6D3;
    color:white;

    border:none;
    border-radius:20px;

    padding:7px 24px;

    font-size:13px;
    font-weight:500;
}

.btn-tambah{
    background:#F39A00;
    color:white;

    border:none;
    border-radius:20px;

    padding:8px 20px;

    text-decoration:none;

    display:flex;
    align-items:center;
    gap:8px;

    font-size:13px;
    font-weight:500;
}

.btn-tambah:hover{
    color:white;
}

/* =========================
TABLE
========================= */

.table-card{
    background:white;
    border-radius:10px;
    overflow:hidden;

    box-shadow:0 4px 12px rgba(0,0,0,0.05);
}

.table-admin{
    width:100%;
    border-collapse:collapse;
}

.table-admin thead{
    background:white;
}

.table-admin th{
    padding:18px 14px;

    font-size:13px;
    font-weight:600;

    color:#222;

    border-bottom:2px solid #E9EEF2;

    text-align:center;
}

.table-admin td{
    padding:18px 14px;

    font-size:13px;
    color:#666;

    border-bottom:1px solid #EEF2F5;

    text-align:center;
}

/* =========================
AKSI
========================= */

.aksi-group{
    display:flex;
    justify-content:center;
    gap:8px;
}

.btn-aksi{
    width:30px;
    height:30px;

    border-radius:5px;

    display:flex;
    align-items:center;
    justify-content:center;

    color:white;
    text-decoration:none;

    font-size:12px;
}

.btn-edit{
    background:#E8D400;
}

.btn-hapus{
    background:#FF1D1D;
}

/* =========================
SWEET ALERT
========================= */

.popup-crud {
    width: 300px !important;
    border-radius: 8px !important;
    padding: 28px 30px 32px !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.25) !important;
}

.popup-crud .swal2-title {
    font-size: 20px !important;
    font-weight: 700 !important;
    color: #111 !important;
    padding: 0 !important;
    margin-bottom: 12px !important;
}

.popup-crud .swal2-html-container {
    font-size: 15px !important;
    color: #666 !important;
    line-height: 1.5 !important;
    margin: 0 0 22px !important;
}

.popup-crud .swal2-actions {
    width: 100% !important;
    margin: 0 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 12px !important;
}

.popup-icon-tambah,
.popup-icon-edit,
.popup-icon-hapus,
.popup-icon-sukses,
.popup-icon-error {
    width: 45px !important;
    height: 45px !important;
    border-radius: 50% !important;
    color: #fff !important;
    border: none !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 5px auto 14px !important;
}

.popup-icon-tambah {
    background: #f28c00 !important;
}

.popup-icon-edit {
    background: #f5e600 !important;
}

.popup-icon-hapus,
.popup-icon-error {
    background: #ff4b4b !important;
}

.popup-icon-sukses {
    background: #59bd83 !important;
}

.popup-icon-tambah i,
.popup-icon-edit i,
.popup-icon-hapus i,
.popup-icon-sukses i,
.popup-icon-error i {
    font-size: 22px !important;
}

.btn-popup-ya {
    width: 230px !important;
    height: 30px !important;
    border-radius: 6px !important;
    background: #08b9c5 !important;
    color: #fff !important;
    border: none !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    padding: 0 !important;
    box-shadow: 0 3px 5px rgba(0,0,0,0.22) !important;
}

.btn-popup-tidak {
    width: 230px !important;
    height: 30px !important;
    border-radius: 6px !important;
    background: #ffffff !important;
    color: #666 !important;
    border: none !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    padding: 0 !important;
    box-shadow: 0 3px 5px rgba(0,0,0,0.22) !important;
}

.btn-popup-ya:hover {
    background: #07a8b3 !important;
}

.btn-popup-tidak:hover {
    background: #f8f8f8 !important;
}

</style>

<div class="admin-page">

    <form method="get"
          action="<?= base_url('index.php/superadmin/manajemen_admin') ?>">

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="keyword"
                value="<?= esc($keyword ?? '') ?>"
                placeholder="Cari nama atau NIP">
        </div>

    </form>

    <div class="top-bar">

        <button class="btn-tab">
            Pegawai
        </button>

        <a href="<?= base_url('index.php/superadmin/manajemen_admin/tambah') ?>"
           class="btn-tambah btn-tambah-confirm">

            <i class="fa-solid fa-circle-plus"></i>
            Tambah

        </a>

    </div>

    <div class="table-card">

        <table class="table-admin">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Role</th>
                    <th>Instansi</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <?php
                $jabatanList = [
                    1 => 'Kepala',
                    2 => 'Kader',
                    3 => 'Admin',
                    4 => 'Superadmin'
                ];
                ?>

                <?php $no = 1; ?>

                <?php foreach($petugas as $p): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= esc($p['nama_petugas']) ?></td>

                        <td><?= esc($p['NIP']) ?></td>

                        <td>
                            <?= esc($jabatanList[$p['id_jabatan']] ?? '-') ?>
                        </td>

                        <td>
                            <?= esc($p['nama_instansi']) ?>
                        </td>

                        <td><?= esc($p['email']) ?></td>

                        <td><?= esc($p['no_telp']) ?></td>

                        <td>

                            <div class="aksi-group">

                                <a href="<?= base_url('index.php/superadmin/manajemen_admin/edit/' . $p['id_petugas']) ?>"
                                   class="btn-aksi btn-edit btn-edit-confirm">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <a href="<?= base_url('index.php/superadmin/manajemen_admin/hapus/' . $p['id_petugas']) ?>"
                                   class="btn-aksi btn-hapus btn-hapus-confirm">

                                    <i class="fa-solid fa-trash"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.addEventListener("DOMContentLoaded", function(){

    // =========================
    // TAMBAH
    // =========================

    document.querySelectorAll('.btn-tambah-confirm')
    .forEach(btn => {

        btn.addEventListener('click', function(e){

            e.preventDefault();

            let url = this.href;

            Swal.fire({
                iconHtml: '<i class="fa-solid fa-plus"></i>',
                title: "Tambah Data",
                html: "Apakah Anda Yakin<br>Ingin Menambah Data?",
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                buttonsStyling: false,
                customClass: {
                    popup: "popup-crud",
                    icon: "popup-icon-tambah",
                    confirmButton: "btn-popup-ya",
                    cancelButton: "btn-popup-tidak"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

    // =========================
    // EDIT
    // =========================

    document.querySelectorAll('.btn-edit-confirm')
    .forEach(btn => {

        btn.addEventListener('click', function(e){

            e.preventDefault();

            let url = this.href;

            Swal.fire({
                iconHtml: '<i class="fa-solid fa-pen"></i>',
                title: "Edit Data",
                html: "Apakah Anda Yakin<br>Ingin Mengedit Data Ini?",
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                buttonsStyling: false,
                customClass: {
                    popup: "popup-crud",
                    icon: "popup-icon-edit",
                    confirmButton: "btn-popup-ya",
                    cancelButton: "btn-popup-tidak"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

    // =========================
    // HAPUS
    // =========================

    document.querySelectorAll('.btn-hapus-confirm')
    .forEach(btn => {

        btn.addEventListener('click', function(e){

            e.preventDefault();

            let url = this.href;

            Swal.fire({
                iconHtml: '<i class="fa-solid fa-trash"></i>',
                title: "Hapus Data",
                html: "Apakah Anda Yakin<br>Ingin Menghapus Data Ini?",
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                buttonsStyling: false,
                customClass: {
                    popup: "popup-crud",
                    icon: "popup-icon-hapus",
                    confirmButton: "btn-popup-ya",
                    cancelButton: "btn-popup-tidak"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });

});

</script>

<?php if (session()->getFlashdata('success')) : ?>
<script>
Swal.fire({
    iconHtml: '<i class="fa-solid fa-check"></i>',
    title: "Berhasil",
    html: "<?= session()->getFlashdata('success') ?>",
    confirmButtonText: "Selesai",
    buttonsStyling: false,
    customClass: {
        popup: "popup-crud",
        icon: "popup-icon-sukses",
        confirmButton: "btn-popup-ya"
    }
});
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
<script>
Swal.fire({
    iconHtml: '<i class="fa-solid fa-xmark"></i>',
    title: "Gagal",
    html: "<?= session()->getFlashdata('error') ?>",
    confirmButtonText: "Selesai",
    buttonsStyling: false,
    customClass: {
        popup: "popup-crud",
        icon: "popup-icon-error",
        confirmButton: "btn-popup-ya"
    }
});
</script>
<?php endif; ?>

<?= $this->endSection() ?>