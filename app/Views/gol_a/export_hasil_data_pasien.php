<?php helper('url'); ?>

<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

* {
    font-family: 'Poppins', sans-serif;
}

/* TITLE */
.page-title {
    font-size: 22px;
    font-weight: 600;
}

/* FILTER CARD */
.filter-card {
    background: #DCE7EA;
    border-radius: 25px;
    padding: 30px;
}

/* LABEL */
.filter-label {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 6px;
}

/* INPUT */
.filter-input {
    background: #F1F4F6;
    border: none;
    border-radius: 20px;
    padding: 12px 15px;
    width: 100%;
    outline: none;
}

/* BUTTON */
.btn-export {
    background: #20B8BE;
    color: white;
    border-radius: 12px;
    padding: 12px 35px;
    border: none;
    font-weight: 500;
    box-shadow: 0 5px 12px rgba(0,0,0,0.15);
    transition: 0.2s;
}

.btn-export:hover {
    background: #179ca1;
}

/* CARD */
.custom-card {
    border-radius: 25px;
    background: #F3F7F9;
    padding: 25px;
}

/* TABLE */
.custom-table {
    border-collapse: separate !important;
    border-spacing: 0;
    overflow: hidden;
    border-radius: 20px;
}

/* HEADER */
.custom-table thead tr {
    background: #20B8BE !important;
    color: white;
}

.custom-table th {
    padding: 14px;
    font-weight: 500;
    border-right: 1px solid rgba(255,255,255,0.2);
}

/* BODY */
.custom-table tbody tr {
    background: #E3EBEF !important;
}

.custom-table td {
    padding: 14px;
    border-right: 1px solid #D0D9DE;
    border-top: 1px solid #D0D9DE;
}

.custom-table tbody tr:hover {
    background: #D9E3E8 !important;
}

/* AKSI BUTTON */
.aksi-btn {
    width: 30px;
    height: 30px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 2px;
    text-decoration: none;
}

.btn-detail { background: #3b5bfd; color: white; }
.btn-edit   { background: #ffd84d; color: black; }
.btn-hapus  { background: #ff3b3b; color: white; }

</style>

<!-- TITLE -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="page-title">Export Hasil Data Pasien</div>
</div>

<!-- FILTER -->
<div class="filter-card mb-4">
    <div class="row mb-3">

        <div class="col-md-4">
            <div class="filter-label">Rentang Tanggal</div>
            <input type="text" class="filter-input" value="01 Jan 2025 - 31 Mar 2025">
        </div>

        <div class="col-md-4">
            <div class="filter-label">Wilayah Kelurahan</div>
            <select class="filter-input">
                <option>Sumbersari</option>
            </select>
        </div>

        <div class="col-md-4">
            <div class="filter-label">Fasilitas Kesehatan</div>
            <select class="filter-input">
                <option>Puskesmas Sumbersari</option>
            </select>
        </div>

    </div>

    <div class="text-center mt-4">
    <a href="<?= base_url('dbd/export-hasil-data-pasien/pdf') ?>" 
       class="btn-export me-3">
       Export PDF Data Pasien
    </a>

    <a href="<?= base_url('dbd/export-hasil-data-pasien/excel') ?>" 
       class="btn-export">
       Export Excel Data Pasien
    </a>
</div>
</div>

<!-- TABLE -->
<div class="custom-card">
    <h5 class="mb-3">Preview Struktur Data</h5>

    <table class="table text-center align-middle custom-table">

        <thead>
            <tr>
                <th>No.</th>
                <th>Kec.</th>
                <th>Kelurahan</th>
                <th>Jumlah Kasus Baru</th>
                <th>Total Kasus</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($data)): ?>
            <?php $no=1; foreach($data as $d): ?>
            <tr>
                <td><?= $no++ ?>.</td>
                <td><?= $d['kecamatan'] ?></td>
                <td><?= $d['desa'] ?></td>
                <td><?= $d['kasus_baru'] ?></td>
                <td><?= $d['total_kasus'] ?></td>
                <td>
                    <a href="#" class="aksi-btn btn-detail">
                        <i class="fa fa-search"></i>
                    </a>

                    <a href="#" class="aksi-btn btn-edit">
                        <i class="fa fa-pencil"></i>
                    </a>

                    <a href="#" class="aksi-btn btn-hapus"
                       onclick="return confirm('Yakin hapus data?')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Belum ada data</td>
            </tr>
        <?php endif; ?>
        </tbody>

    </table>
</div>

<?= $this->endSection() ?>