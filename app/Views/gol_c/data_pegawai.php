<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>

<?= $this->section('content') ?>

<style>
.pegawai-page{
    padding: 10px 5px;
    font-family: 'Poppins', sans-serif;
}

.search-box{
    position: relative;
    margin-bottom: 12px;
}

.search-box input{
    width: 100%;
    height: 45px;
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    padding: 0 15px 0 50px;
    font-size: 13px;
    color: #555;
    outline: none;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.12);
}

.search-box i{
    position: absolute;
    top: 50%;
    left: 18px;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 18px;
}

.pegawai-toolbar{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.pegawai-tab{
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-tab{
    border: none;
    padding: 7px 24px;
    border-radius: 20px;
    font-size: 12px;
    background: #e5e5e5;
    color: #8a8a8a;
    text-decoration: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.12);
}

.btn-tab.active{
    background: #36cfd0;
    color: #fff;
}

.btn-tambah{
    background: #f28c00;
    color: #fff;
    border-radius: 20px;
    padding: 7px 18px;
    font-size: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-tambah:hover{
    background: #df8000;
    color: #fff;
}

.table-responsive{
    background: #fff;
    border: 1px solid #e6edf2;
    overflow-x: auto;
}

.table-pegawai{
    width: 100%;
    background: #fff;
    border-collapse: collapse;
    font-size: 13px;
    color: #666;
    margin-bottom: 0;
}

.table-pegawai thead tr{
    border-bottom: 3px solid #e9eef2;
}

.table-pegawai thead th{
    background: #fff;
    color: #222;
    font-weight: 500;
    text-align: center;
    vertical-align: middle;
    padding: 17px 12px;
    border: none;
    white-space: nowrap;
}

.table-pegawai tbody tr{
    border-bottom: 2px solid #e9eef2;
}

.table-pegawai tbody td{
    height: 52px;
    padding: 14px 12px;
    border: none;
    vertical-align: middle;
    color: #666;
}

.table-pegawai .col-no{
    width: 60px;
    text-align: center;
}

.table-pegawai .col-nama{
    min-width: 180px;
}

.table-pegawai .col-nip{
    min-width: 190px;
    text-align: center;
}

.table-pegawai .col-jabatan{
    min-width: 140px;
    text-align: center;
}

.table-pegawai .col-instansi{
    min-width: 190px;
    text-align: center;
}

.table-pegawai .col-email{
    min-width: 210px;
    text-align: center;
}

.table-pegawai .col-telepon{
    min-width: 150px;
    text-align: center;
}

/* kolom aksi */
.table-pegawai .col-aksi{
    width: 110px;
    min-width: 110px;
    text-align: center;
    white-space: nowrap;
}

/* isi tombol aksi */
.aksi-wrapper{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    flex-wrap: nowrap;
}

/* tombol aksi */
.aksi-btn{
    width: 30px;
    height: 30px;
    min-width: 30px;
    min-height: 30px;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
    font-size: 13px;
    margin: 0;
    flex-shrink: 0;
}

.aksi-edit{
    background: #f5e600;
}

.aksi-hapus{
    background: #ff0d0d;
}

.aksi-btn:hover{
    color: #fff;
    opacity: 0.85;
}

.pagination-pegawai{
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
}

.pagination-pegawai .pagination{
    margin-bottom: 0;
}

.pagination-pegawai .page-link{
    font-size: 11px;
    padding: 5px 10px;
    color: #555;
}

.pagination-pegawai .page-item.active .page-link{
    background: #e5e7eb;
    border-color: #dee2e6;
    color: #333;
}

/* ========================= */
/* POP UP SWEETALERT CRUD */
/* ========================= */

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

<?php
$jabatanList = [
    1 => 'Kepala',
    2 => 'Kader',
    3 => 'Admin',
    4 => 'Superadmin'
];

$instansiList = [
    1 => 'Puskesmas Sumbersari',
    2 => 'Puskesmas Kaliwates',
    3 => 'Puskesmas Ajung',
    4 => 'Puskesmas Panti',
    5 => 'Dinas Kesehatan',
    6 => 'Politeknik Negeri Jember'
];
?>

<div class="pegawai-page">

    <form method="get" action="<?= base_url('index.php/pneumonia/pegawai') ?>">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input 
                type="text" 
                name="keyword"
                value="<?= esc($keyword ?? '') ?>"
                placeholder="Cari nama atau NIP"
            >
        </div>
    </form>

    <div class="pegawai-toolbar">
        <div class="pegawai-tab">
            <a href="<?= base_url('index.php/pneumonia/pegawai') ?>" class="btn-tab active">
                Pegawai
            </a>
        </div>

        <a href="<?= base_url('index.php/pneumonia/pegawai/tambah') ?>" 
           class="btn-tambah btn-tambah-confirm">
            <i class="fa-solid fa-circle-plus"></i> Tambah
        </a>
    </div>

    <div class="table-responsive">
        <table class="table-pegawai">
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-nama">Nama</th>
                    <th class="col-nip">NIP</th>
                    <th class="col-jabatan">Role</th>
                    <th class="col-instansi">Instansi</th>
                    <th class="col-email">Email</th>
                    <th class="col-telepon">No Telepon</th>
                    <th class="col-aksi">Aksi</th>
                </tr>
            </thead>

        <tbody>
    <?php if (!empty($petugas)) : ?>
        <?php $no = 1 + (10 * (($currentPage ?? 1) - 1)); ?>

        <?php foreach ($petugas as $row) : ?>
            <tr>
                <td class="col-no"><?= $no++ ?></td>

                <td class="col-nama">
                    <?= esc($row['nama_petugas']) ?>
                </td>

                <td class="col-nip">
                    <?= esc($row['NIP']) ?>
                </td>

                <td class="col-jabatan">
                    <?= esc($jabatanList[$row['id_jabatan']] ?? '-') ?>
                </td>

                <td class="col-instansi">
                    <?= esc($instansiList[$row['id_instansi']] ?? '-') ?>
                </td>

                <td class="col-email">
                    <?= esc($row['email']) ?>
                </td>

                <td class="col-telepon">
                    <?= esc($row['no_telp']) ?>
                </td>

                <td class="col-aksi">
                    <div class="aksi-wrapper">
                        <a href="<?= base_url('index.php/pneumonia/pegawai/edit/' . $row['id_petugas']) ?>" 
                        class="aksi-btn aksi-edit btn-edit-confirm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <a href="<?= base_url('index.php/pneumonia/pegawai/hapus/' . $row['id_petugas']) ?>"
                        class="aksi-btn aksi-hapus btn-hapus-confirm">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php
        $sisaBaris = 10 - count($petugas);
        if ($sisaBaris > 0) :
            for ($i = 1; $i <= $sisaBaris; $i++) :
        ?>
            <tr>
                <td class="col-no"></td>
                <td class="col-nama"></td>
                <td class="col-nip"></td>
                <td class="col-jabatan"></td>
                <td class="col-instansi"></td>
                <td class="col-email"></td>
                <td class="col-telepon"></td>
                <td class="col-aksi"></td>
            </tr>
        <?php
            endfor;
        endif;
        ?>

    <?php else : ?>

        <?php for ($i = 1; $i <= 10; $i++) : ?>
            <tr>
                <td class="col-no"></td>
                <td class="col-nama"></td>
                <td class="col-nip"></td>
                <td class="col-jabatan"></td>
                <td class="col-instansi"></td>
                <td class="col-email"></td>
                <td class="col-telepon"></td>
                <td class="col-aksi"></td>
            </tr>
        <?php endfor; ?>

    <?php endif; ?>
</tbody>
        </table>
    </div>

<?php
$totalPages  = $pager->getPageCount('petugas');
$currentPage = $pager->getCurrentPage('petugas');

$queryParams = $_GET;

function pageUrlPegawai($page, $queryParams)
{
    $queryParams['page_petugas'] = $page;
    return current_url() . '?' . http_build_query($queryParams);
}
?>

<div class="pagination-pegawai">
    <nav>
        <ul class="pagination pagination-sm">

            <?php $prevPage = max(1, $currentPage - 1); ?>

            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= ($currentPage <= 1) ? '#' : pageUrlPegawai($prevPage, $queryParams) ?>">
                    Previous
                </a>
            </li>

            <?php if ($totalPages <= 5) : ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= pageUrlPegawai($i, $queryParams) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

            <?php else : ?>

                <?php if ($currentPage <= 3) : ?>

                    <?php for ($i = 1; $i <= 3; $i++) : ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= pageUrlPegawai($i, $queryParams) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="<?= pageUrlPegawai($totalPages, $queryParams) ?>">
                            <?= $totalPages ?>
                        </a>
                    </li>

                <?php elseif ($currentPage >= $totalPages - 2) : ?>

                    <li class="page-item">
                        <a class="page-link" href="<?= pageUrlPegawai(1, $queryParams) ?>">
                            1
                        </a>
                    </li>

                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>

                    <?php for ($i = $totalPages - 2; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= pageUrlPegawai($i, $queryParams) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                <?php else : ?>

                    <li class="page-item">
                        <a class="page-link" href="<?= pageUrlPegawai(1, $queryParams) ?>">
                            1
                        </a>
                    </li>

                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>

                    <?php for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) : ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="<?= pageUrlPegawai($i, $queryParams) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="<?= pageUrlPegawai($totalPages, $queryParams) ?>">
                            <?= $totalPages ?>
                        </a>
                    </li>

                <?php endif; ?>

            <?php endif; ?>

            <?php $nextPage = min($totalPages, $currentPage + 1); ?>

            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= ($currentPage >= $totalPages) ? '#' : pageUrlPegawai($nextPage, $queryParams) ?>">
                    Next
                </a>
            </li>

        </ul>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".btn-tambah-confirm").forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();

            const url = this.getAttribute("href");

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

    document.querySelectorAll(".btn-edit-confirm").forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();

            const url = this.getAttribute("href");

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

    document.querySelectorAll(".btn-hapus-confirm").forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();

            const url = this.getAttribute("href");

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