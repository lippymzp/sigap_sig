<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php $tahun = $tahun ?? date('Y'); ?>

<style>
* {
    font-family: 'Poppins', sans-serif;
}



/* CARD */
.custom-card {
    border-radius: 20px;
    background: #F4F8FA;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

/* SEARCH */
.search-icon {
    background: #20B8BE;
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 10px 0 0 10px;

    display: flex;
    align-items: center;
    justify-content: center;
}

.search-icon i {
    color: white;
    font-size: 16px;
}

.search-input {
    border-radius: 0 10px 10px 0;
    border: none;
    background: #EEF5F7;
    padding: 12px;
    width: 250px;
    height: 45px;
}

.filter-btn {
    border: 2px solid #20B8BE;
    background: white;
    width: 45px;
    height: 45px;
    border-radius: 10px;
    color: #20B8BE;
    transition: all 0.2s ease;
    /* 🔥 biar halus */
}

/* 🔥 INI YANG KAMU BUTUH */
.filter-btn:hover {
    background: #169fa5;
    color: white;
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(32, 184, 190, 0.4);
}

/* BIAR ICON IKUT PUTIH */
.filter-btn i {
    font-size: 16px;
}

.filter-btn:hover i {
    color: white;
}

/* ================= PERIODE (FIXED) ================= */
.periode {
    font-size: 16px;
    /* samain sama teks lain */
    display: flex;
    align-items: center;
    gap: 8px;
}

.periode a {
    text-decoration: none;
    font-size: 40px;
    /* panah agak gede dikit */
    color: #20B8BE;
    font-weight: bold;
    transition: 0.1s;
}

/* hover halus tanpa kotak */
.periode a:hover {
    color: #169fa5;
    transform: scale(1.2);
}

/* ================= TABLE ================= */

.table-wrapper {
    overflow-x: auto;
    border-radius: 15px;
}

.custom-table {
    width: 100%;
    min-width: 1200px;
    border-collapse: collapse;
    background: white;
    overflow: hidden;
    border-radius: 15px;
}

/* HEADER */
.custom-table thead th {
    background: #11C5CC;
    color: white;
    font-size: 14px;
    font-weight: 600;
    padding: 14px 10px;
    text-align: center;
    border: 1px solid #dfe6e9;
}

/* BODY */
.custom-table tbody td {
    padding: 14px 10px;
    border: 1px solid #e5e5e5;
    font-size: 14px;
    color: #555;
    text-align: center;
    vertical-align: middle;
    background: white;
}

/* ZEBRA */
.custom-table tbody tr:nth-child(even) {
    background: #fafafa;
}

/* HOVER */
.custom-table tbody tr:hover td {
    background: #f4ffff;
}

/* KOLOM ALAMAT */
.td-alamat {
    max-width: 220px;
    white-space: normal;
    line-height: 1.5;
    font-size: 13px;
}

/* EXPORT BUTTON (DALAM CARD) */
.btn-export {
    background: #20B8BE;
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 500;

    text-decoration: none !important;
    /* 🔥 hilangin garis */
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-export:hover {
    color: white;
    text-decoration: none !important;
    background: #169fa5;
}

/* ================= ACTION BUTTON ================= */

.action-btn {
    width: 34px;
    height: 34px;
    border: none;
    border-radius: 6px;
    color: white;
    margin: 0 2px;
    transition: 0.2s;
}

.btn-detail {
    background: #003BFF;
}

.btn-edit {
    background: #FFD500;
    color: #333;
}

.btn-hapus {
    background: #FF1E1E;
}

.action-btn:hover {
    transform: scale(1.08);
    opacity: 0.9;
}

/* MODAL FILTER */
.modal-filter {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.modal-content {
    background: white;
    padding: 25px;
    border-radius: 15px;
    width: 400px;
}

.filter-input {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 10px;
    border: none;
    background: #EEF5F7;
}

.btn-terapkan {
    background: #20B8BE;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 500;
    transition: 0.2s;
}

.btn-terapkan:hover {
    background: #169fa5;
}

/* ================= PAGINATION ================= */

.pagination-data {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
}

.pagination-data .pagination {
    margin-bottom: 0;
}

.pagination-data .page-link {
    font-size: 11px;
    padding: 5px 10px;
    color: #555;
}

.pagination-data .page-item.active .page-link {
    background: #e5e7eb;
    border-color: #dee2e6;
    color: #333;
}

/* ================= MODAL EDIT ================= */

.modal-edit {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);

    justify-content: center;
    align-items: flex-start;
    padding-top: 40px;
    overflow-y: auto;
    z-index: 9999;
}

.modal-edit-content {

    width: 420px;
    max-width: 95%;

    background: #fff;

    border-radius: 18px;

    padding: 26px;

    box-shadow:
        0 10px 30px rgba(0, 0, 0, 0.12);

    animation: modalFade .2s ease;
    max-height:90vh;
overflow-y:auto;
}

/* HEADER */

.modal-edit-header {

    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 18px;
}

.modal-edit-header h3 {

    margin: 0;

    font-size: 18px;
    font-weight: 700;

    color: #17354d;
}

.modal-close {

    border: none;
    background: none;

    font-size: 22px;

    cursor: pointer;

    color: #17354d;
}

/* FORM */

.modal-edit label {

    font-size: 14px;
    font-weight: 500;

    margin-bottom: 5px;

    color: #333;
}

.modal-edit .form-control {

    border-radius: 12px;

    border: 1px solid #d9e2e7;

    background: #f8fbfc;

    min-height: 42px;

    font-size: 14px;

    margin-bottom: 14px;

    box-shadow: none;
}

.modal-edit textarea.form-control {

    min-height: 80px;
}

/* RT RW */

.modal-edit .row {

    display: flex;
    gap: 12px;
}

.modal-edit .col {

    flex: 1;
}

/* BUTTON */

.btn-simpan-edit {

    width: 100%;

    height: 44px;

    border: none;

    border-radius: 12px;

    background: #18c3cf;

    color: #fff;

    font-weight: 600;

    margin-top: 8px;

    transition: .2s;
}

.btn-simpan-edit:hover {

    background: #11aeb9;
}

/* ANIMATION */

@keyframes modalFade {

    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ================= POPUP ================= */

.popup {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 999999;
}

.popup.show {
    display: flex;
}

.popup-box {
    background: #fff;
    width: 260px;
    border-radius: 6px;
    padding: 34px 28px 30px;
    text-align: center;
}

.popup-icon {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #ffb84d;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    font-size: 22px;
    font-weight: 700;
}

.popup-title {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 8px;
}

.popup-text {
    font-size: 13px;
    color: #777;
    margin-bottom: 16px;
}

.btn-popup-primary {
    width: 100%;
    height: 31px;
    border: none;
    background: #00b9c5;
    color: #fff;
    border-radius: 5px;
    margin-bottom: 8px;
}

.btn-popup-secondary {
    width: 100%;
    height: 31px;
    border: none;
    background: #eee;
    border-radius: 5px;
}
</style>


<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div></div>

    <div class="periode">

        <span>Periode :</span>

        <a href="<?= base_url('index.php/pneumonia/hasil/' . ($tahun - 1)) ?>">
            ‹
        </a>

        <span><?= $tahun ?></span>

        <a href="<?= base_url('index.php/pneumonia/hasil/' . ($tahun + 1)) ?>">
            ›
        </a>

    </div>
</div>

<div class="custom-card">

    <!-- SEARCH + FILTER -->
    <div class="d-flex align-items-center gap-2 mb-3">
        <div class="search-icon">
            <i class="fa fa-search"></i>
        </div>
        <input type="text" id="searchInput" class="search-input" placeholder="Ketik untuk mencari...">
        <button class="filter-btn" onclick="openFilter()">
            <i class="fa fa-filter"></i>
        </button>
    </div>

    <!-- TABLE -->
    <div class="table-wrapper">

        <table class="table custom-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Alamat</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Rentang Usia</th>
                    <th>Diagnosa</th>
                    <th>Mendapatkan Antibiotik</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="table-body">

                <?php if(!empty($data)): ?>

                <?php $no=1; foreach($data as $d): ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td class="td-alamat">
                        <?= $d['wilayah'] ?? '-' ?>
                        RT <?= $d['rt'] ?? '-' ?> /
                        RW <?= $d['rw'] ?? '-' ?>
                    </td>
                    <td>
                        <?= $d['nama_pasien'] ?? '-' ?>
                    </td>

                    <td>
                        <?= $d['jenis_kelamin'] ?? '-' ?>
                    </td>
                    <td>
                        <?= $d['rentang_umur'] ?? '-' ?>
                    </td>

                    <td>
                        <?= $d['ctt_klinis'] ?? '-' ?>
                    </td>
                    <td>
                        <?= $d['antibiotik'] ?? '-' ?>
                    </td>

                    <td>
                        <?= !empty($d['tgl_kunjungan']) 
    ? date('d F Y', strtotime($d['tgl_kunjungan'])) 
    : '-' ?>
                    </td>

                    <td>

                        <!-- EDIT -->
                        <button class="action-btn btn-edit" data-id="<?= $d['id_pasien'] ?>"
                            data-id_wilayah="<?= $d['id_wilayah'] ?>" data-nama="<?= $d['nama_pasien'] ?>"
                            data-jk="<?= $d['jenis_kelamin'] ?>" data-rentang_umur="<?= $d['rentang_umur'] ?>"
                            data-diagnosa="<?= $d['ctt_klinis'] ?>" data-antibiotik="<?= $d['antibiotik'] ?>"
                            data-tanggal="<?= date('Y-m-d', strtotime($d['tgl_kunjungan'])) ?>"
                            data-kelurahan="<?= $d['kelurahan'] ?>" data-rt="<?= $d['rt'] ?>" data-rw="<?= $d['rw'] ?>"
                            onclick="openEditModal(this)">

                            <i class="fa fa-pen"></i>

                        </button>

                        <!-- HAPUS -->
                        <button class="action-btn btn-hapus" onclick="hapusPasien(<?= $d['id_pasien'] ?>)">
                            <i class="fa fa-trash"></i>
                        </button>

                    </td>

                </tr>

                <?php endforeach; ?>

                <?php else: ?>

                <tr>
                    <td colspan="8">Belum ada data</td>
                </tr>

                <?php endif; ?>

            </tbody>
            <!-- ================= MODAL EDIT ================= -->

            <div class="modal-edit" id="modalEdit">

                <div class="modal-edit-content">

                    <div class="modal-edit-header">

                        <h5>Edit Data Pasien</h5>

                        <button class="modal-close" onclick="closeEditModal()">
                            &times;
                        </button>

                    </div>

                    <form action="<?= base_url('pneumonia/updatepasien') ?>" method="post">

                        <input type="hidden" name="id_pasien" id="edit_id">
                        <input type="hidden" name="id_wilayah" id="edit_id_wilayah">

                        <div class="mb-3">
                            <label>Kelurahan</label>

                            <select name="kelurahan" id="edit_kelurahan" class="form-control">

                                <option value="Klompangan">Klompangan</option>
                                <option value="Mangaran">Mangaran</option>
                                <option value="Pancakarya">Pancakarya</option>
                                <option value="Rowoindah">Rowoindah</option>
                                <option value="Sukamakmur">Sukamakmur</option>
                                <option value="Wirowongso">Wirowongso</option>

                            </select>
                        </div>

                        <div class="row d-flex">

                            <div class="col">
                                <label>RT</label>
                                <input type="text" name="rt" id="edit_rt" class="form-control">
                            </div>

                            <div class="col">
                                <label>RW</label>
                                <input type="text" name="rw" id="edit_rw" class="form-control">
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" id="edit_nama" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Jenis Kelamin</label>

                            <select name="jenis_kelamin" id="edit_jk" class="form-control">

                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Rentang Usia</label>

                            <select name="rentang_umur" id="edit_rentang_umur" class="form-control">

                                <option value="0-12 Bulan">0-12 Bulan</option>
                                <option value="1-5 Tahun">1-5 Tahun</option>
                                <option value="6-11 Tahun">6-11 Tahun</option>
                                <option value="12-16 Tahun">12-16 Tahun</option>
                                <option value="17-25 Tahun">17-25 Tahun</option>
                                <option value="26-35 Tahun">26-35 Tahun</option>
                                <option value="36-45 Tahun">36-45 Tahun</option>
                                <option value="46-55 Tahun">46-55 Tahun</option>
                                <option value="56-65 Tahun">56-65 Tahun</option>
                                <option value=">65 Tahun">>65 Tahun</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Diagnosa</label>

                            <select name="ctt_klinis" id="edit_diagnosa" class="form-control">

                                <option value="Pneumonia">Pneumonia</option>
                                <option value="Bronkopneumonia">Bronkopneumonia</option>
                                <option value="Pneumonia Berat">Pneumonia Berat</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Antibiotik</label>

                            <select name="antibiotik" id="edit_antibiotik" class="form-control">

                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                                <option value="-">-</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Kunjungan</label>

                            <input type="date" name="tgl_kunjungan" id="edit_tanggal" class="form-control">
                        </div>

                        <div class="text-end">

                            <button type="submit" class="btn-simpan-edit">

                                Simpan Perubahan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </table>
    </div>
    <?php
$queryParams = $_GET;

function pageUrlData($page, $queryParams)
{
    $queryParams['page_data'] = $page;
    return current_url() . '?' . http_build_query($queryParams);
}
?>

    <div class="pagination-data">
        <nav>
            <ul class="pagination pagination-sm">
                <?php $prevPage = max(1, $currentPage - 1); ?>
                <!-- PREVIOUS -->
                <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ($currentPage <= 1)
                        ? '#'
                        : pageUrlData($prevPage, $queryParams) ?>">
                        Previous
                    </a>
                </li>
                <!-- NOMOR HALAMAN -->
                <?php if ($totalPages <= 5) : ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= pageUrlData($i, $queryParams) ?>">
                        <?= $i ?>
                    </a>
                </li>
                <?php endfor; ?>
                <?php else : ?>
                <?php if ($currentPage <= 3) : ?>
                <?php for ($i = 1; $i <= 3; $i++) : ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= pageUrlData($i, $queryParams) ?>">
                        <?= $i ?>
                    </a>
                </li>
                <?php endfor; ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= pageUrlData($totalPages, $queryParams) ?>">
                        <?= $totalPages ?>
                    </a>
                </li>
                <?php elseif ($currentPage >= $totalPages - 2) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= pageUrlData(1, $queryParams) ?>">
                        1
                    </a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <?php for ($i = $totalPages - 2; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= pageUrlData($i, $queryParams) ?>">
                        <?= $i ?>
                    </a>
                </li>
                <?php endfor; ?>
                <?php else : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= pageUrlData(1, $queryParams) ?>">
                        1
                    </a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <?php for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) : ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= pageUrlData($i, $queryParams) ?>">
                        <?= $i ?>
                    </a>
                </li>
                <?php endfor; ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= pageUrlData($totalPages, $queryParams) ?>">
                        <?= $totalPages ?>
                    </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
                <?php $nextPage = min($totalPages, $currentPage + 1); ?>

                <!-- NEXT -->
                <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">

                    <a class="page-link" href="<?= ($currentPage >= $totalPages)
                        ? '#'
                        : pageUrlData($nextPage, $queryParams) ?>">

                        Next

                    </a>

                </li>

            </ul>
        </nav>
    </div>
    <!-- EXPORT BUTTON (DALAM CARD KANAN BAWAH) -->
    <div class="d-flex justify-content-end mt-3">
        <a href="<?= base_url('index.php/' . $penyakit . '/export_hasil_data_pasien') ?>" class="btn-export">
            <i class="fa fa-download"></i> Export Data
        </a>
    </div>

</div>

<!-- MODAL FILTER -->
<div id="filterModal" class="modal-filter">
    <div class="modal-content">

        <div class="d-flex justify-content-between mb-3">
            <h5>Filter Hasil Data Pasien</h5>
            <span onclick="closeFilter()" style="cursor:pointer;">✖</span>
        </div>

        <label>Bulan</label>
        <select id="filterBulan" class="filter-input">
            <option value="">Semua</option>
            <option value="january">Januari</option>
            <option value="february">Februari</option>
            <option value="march">Maret</option>
            <option value="april">April</option>
            <option value="may">Mei</option>
            <option value="june">Juni</option>
            <option value="july">Juli</option>
            <option value="august">Agustus</option>
            <option value="september">September</option>
            <option value="october">Oktober</option>
            <option value="november">November</option>
            <option value="december">Desember</option>
        </select>

        <label>Kelurahan</label>
        <select id="filterKelurahan" class="filter-input">
            <option value="">Semua</option>
            <option>Ajung</option>
            <option>Klompangan</option>
            <option>Mangaran</option>
            <option>Pancakarya</option>
            <option>Rowoindah</option>
            <option>Sukamakmur</option>
            <option>Wirowongso</option>
        </select>

        <div class="d-flex justify-content-between mt-4">
            <button onclick="resetFilter()" class="btn btn-secondary">Reset</button>
            <button onclick="applyFilter()" class="btn-terapkan">Terapkan</button>
        </div>

    </div>
</div>

<!-- JAVASCRIPT -->
<script>
let currentTahun = <?= $tahun ?>;

// =====================
// GANTI TAHUN
// =====================
function gantiTahun(tahun) {
    currentTahun = tahun;
    document.getElementById('tahun-text').innerText = tahun;
    loadData();
}

// =====================
// MODAL FILTER
// =====================
function openFilter() {
    document.getElementById('filterModal').style.display = 'flex';
}

function closeFilter() {
    document.getElementById('filterModal').style.display = 'none';
}

function resetFilter() {

    document.getElementById('filterBulan').value = "";

    document.getElementById('filterKelurahan').value = "";

    document.getElementById('filterUrut').value = "";

    let rows =
        document.querySelectorAll('#table-body tr');

    rows.forEach(row => {

        row.style.display = '';
    });

    closeFilter();
}

function applyFilter() {

    let bulan =
        document.getElementById('filterBulan')
        .value
        .toLowerCase();

    let kelurahan =
        document.getElementById('filterKelurahan')
        .value
        .toLowerCase();

    let rows =
        document.querySelectorAll('#table-body tr');

    rows.forEach(row => {

        let alamat =
            row.cells[1].innerText.toLowerCase();

        let tanggal =
            row.cells[7].innerText.toLowerCase();

        let cocokKelurahan =
            kelurahan === "" ||
            alamat.includes(kelurahan);

        let cocokBulan =
            bulan === "" ||
            tanggal.includes(bulan);

        if (cocokKelurahan && cocokBulan) {

            row.style.display = '';

        } else {

            row.style.display = 'none';
        }
    });

    closeFilter();
}

// =====================
// LOAD DATA DARI DATABASE
// =====================
document.getElementById('searchInput')
    .addEventListener('keyup', function() {

        let keyword = this.value.toLowerCase();

        let rows = document.querySelectorAll('#table-body tr');

        rows.forEach(row => {

            let text = row.innerText.toLowerCase();

            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });

// =====================
// SEARCH REALTIME
// =====================
document.getElementById('searchInput').addEventListener('keyup', loadData);

function openEditModal(button) {

    document.getElementById('modalEdit').style.display = 'flex';

    document.getElementById('edit_nama').value =
        button.dataset.nama;
    document.getElementById('edit_id').value =
        button.dataset.id;

    document.getElementById('edit_id_wilayah').value =
        button.dataset.id_wilayah;

    document.getElementById('edit_jk').value =
        button.dataset.jk;

    document.getElementById('edit_rentang_umur').value =
        button.dataset.rentang_umur;

    document.getElementById('edit_diagnosa').value =
        button.dataset.diagnosa;

    document.getElementById('edit_antibiotik').value =
        button.dataset.antibiotik;

    document.getElementById('edit_tanggal').value =
        button.dataset.tanggal;
    document.getElementById('edit_kelurahan').value =
        button.dataset.kelurahan;

    document.getElementById('edit_rt').value =
        button.dataset.rt;

    document.getElementById('edit_rw').value =
        button.dataset.rw;
}

function closeEditModal() {

    document.getElementById('modalEdit').style.display = 'none';
}

let idPasienHapus = null;

function hapusPasien(id) {

    let popup =
        document.getElementById('popupHapus');

    popup.style.display = 'flex';

    popup.setAttribute('data-id', id);
}

function closePopupHapus() {

    document.getElementById('popupHapus')
        .style.display = 'none';
}

function confirmHapus() {

    let popup =
        document.getElementById('popupHapus');

    let id =
        popup.getAttribute('data-id');

    window.location.href =
        "<?= base_url('pneumonia/hapuspasien/') ?>" + id;
}
</script>

<!-- POPUP HAPUS -->
<div class="popup" id="popupHapus">
    <div class="popup-box">
        <div class="popup-icon warning-icon">!</div>
        <div class="popup-title">
            Hapus Data Pasien?
        </div>
        <div class="popup-text">
            Data yang dihapus tidak dapat dikembalikan
        </div>
        <button type="button" class="btn-popup-primary" onclick="confirmHapus()">
            Ya, Hapus
        </button>

        <button type="button" class="btn-popup-secondary" onclick="closePopupHapus()">
            Batal
        </button>
    </div>
</div>

<?= $this->endSection() ?>