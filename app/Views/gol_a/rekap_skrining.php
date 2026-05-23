<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php 
$pagerLinks = $pagerLinks ?? '';

$current_sort = $current_sort ?? '';
$current_filter = $current_filter ?? [];
$current_search = $current_search ?? '';
?>

<style>
    body {
        background: #f5f7fb;
        font-family: 'Poppins', sans-serif;
    }

    /* CARD */
    .custom-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* TOPBAR FORM */
    .topbar-form {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 15px;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        width: 320px;
    }

    .search-box input {
        padding-left: 40px;
        border-radius: 10px;
        height: 40px;
        font-size: 14px;
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #00BBC2;
    }

    /* DROPDOWN & FILTER */
    .filter-group {
        display: flex;
        gap: 10px;
    }

    .filter-group select,
    .filter-group .btn-filter {
        border-radius: 10px;
        height: 40px;
        font-size: 14px;
        min-width: 140px;
    }

    /* OPTIMASI UKURAN TABEL */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    .table {
        margin-bottom: 0;
        font-size: 13.5px;
        border-collapse: collapse;
    }

    .table thead {
        background: linear-gradient(135deg, #00BBC2, #009aa0);
    }

    .table thead th {
        background: linear-gradient(135deg, #00BBC2, #009aa0) !important;
        color: white !important;
        border: none;
        padding: 12px 10px;
        text-align: center;
        font-weight: 600;
        letter-spacing: 0.3px;
        font-size: 13.5px;
    }

    .table th,
    .table td {
        border: 1px solid #e5e7eb !important;
        padding: 10px 12px;
    }

    .table tbody tr:hover {
        background-color: #f9fafb;
    }

    .col-alamat {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .col-aksi {
        width: 110px !important;
        white-space: nowrap !important;
        text-align: center;
    }

    /* BADGE */
    .badge-custom {
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 12px;
        display: inline-block;
        font-weight: 500;
    }

    .badge-buruk { background: #fee2e2; color: #dc2626; }
    .badge-cukup { background: #fef3c7; color: #d97706; }
    .badge-baik { background: #d1fae5; color: #059669; }

    /* BUTTON AKSI */
    .aksi-btn {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 6px;
        color: white;
        margin: 0 3px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-detail { background: #0284c7; }
    .btn-detail:hover { background: #0369a1; }
    .btn-hapus { background: #ef4444; }
    .btn-hapus:hover { background: #dc2626; }

    /* PAGINATION STYLE */
    .pagination-custom { font-size: 14px; }
    .pagination-custom ul, .pagination-custom .pages {
        display: flex; gap: 6px; flex-wrap: wrap; justify-content: center; align-items: center; list-style: none; padding: 0; margin: 0;
    }
    .pagination-custom ul li a, .pagination-custom ul li span, .pagination-custom .pages a, .pagination-custom .pages span {
        display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; border: 1px solid #d1d5db; background: #fff; color: #374151; font-weight: 500; text-decoration: none; transition: all 0.25s ease;
    }
    .pagination-custom ul li a:hover, .pagination-custom .pages a:hover {
        background: #00BBC2; color: white; border-color: #00BBC2; transform: translateY(-1px);
    }
    .pagination-custom ul li.active span, .pagination-custom ul li.active a, .pagination-custom .pages .active {
        background: linear-gradient(135deg, #00BBC2, #009aa0) !important; color: white !important; border: none;
    }

    .modal { z-index: 99999 !important; }
    .modal-backdrop { z-index: 99998 !important; }
</style>

<div class="custom-card">
    <form action="<?= base_url('dbd/rekap_skrining') ?>" method="get" id="filterForm" class="topbar-form">
        
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Cari nama atau NIK..." value="<?= esc($current_search ?? '') ?>">
        </div>

        <div class="filter-group">
            <select name="sort" id="sortData" class="form-select" onchange="submitFilterForm()">
                <option value="">Urutkan Nama</option>
                <option value="asc" <?= ($current_sort === 'asc') ? 'selected' : '' ?>>Ascending (A-Z)</option>
                <option value="desc" <?= ($current_sort === 'desc') ? 'selected' : '' ?>>Descending (Z-A)</option>
            </select>

            <div class="dropdown">
                <button class="btn btn-outline-secondary text-start btn-filter dropdown-toggle d-flex align-items-center justify-content-between" type="button" data-bs-toggle="dropdown" style="min-width:180px;">
                    <span><i class="bi bi-funnel me-2"></i>Filter Data</span>
                </button>

                <ul class="dropdown-menu p-3" style="width:280px; border-radius:12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                    <li>
                        <label class="dropdown-item py-1">
                            <input type="checkbox" class="filter-check" id="checkSemua" onclick="resetSemuaFilter(this)"> Clear / Tampilkan Semua
                        </label>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <label class="dropdown-item py-1">
                            <input type="checkbox" name="filter[]" class="filter-item-check" value="hariini" <?= in_array('hariini', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Hari ini
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item py-1">
                            <input type="checkbox" name="filter[]" class="filter-item-check" value="baik" <?= in_array('baik', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Lingkungan Baik
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item py-1">
                            <input type="checkbox" name="filter[]" class="filter-item-check" value="cukup" <?= in_array('cukup', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Lingkungan Cukup
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item py-1">
                            <input type="checkbox" name="filter[]" class="filter-item-check" value="buruk" <?= in_array('buruk', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Lingkungan Buruk
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item py-1">
                            <input type="checkbox" name="filter[]" class="filter-item-check" value="perempuan" <?= in_array('perempuan', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Perempuan
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item py-1">
                            <input type="checkbox" name="filter[]" class="filter-item-check" value="lakilaki" <?= in_array('lakilaki', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Laki-laki
                        </label>  
                    </li>
                    <li>
                        <li>
                    <label class="dropdown-item py-1">
                        <input type="checkbox" name="filter[]" class="filter-item-check" value="bayi_anak" <?= in_array('bayi_anak', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Bayi dan Anak Pra-sekolah (0–6 Tahun)
                    </label>
                </li>

                <li>
                    <label class="dropdown-item py-1">
                        <input type="checkbox" name="filter[]" class="filter-item-check" value="remaja" <?= in_array('remaja', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Anak Sekolah dan Remaja (>6–18 Tahun)
                    </label>
                </li>

                <li>
                    <label class="dropdown-item py-1">
                        <input type="checkbox" name="filter[]" class="filter-item-check" value="dewasa" <?= in_array('dewasa', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Dewasa (>18–59 Tahun)
                    </label>
                </li>

                <li>
                    <label class="dropdown-item py-1">
                        <input type="checkbox" name="filter[]" class="filter-item-check" value="lansia" <?= in_array('lansia', $current_filter) ? 'checked' : '' ?> onchange="submitFilterForm()"> Lansia (≥60 Tahun)
                    </label>
                </li>
                    </li>
                </ul>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th style="width: 50px;">No.</th>
                    <th>Nama</th>
                    <th style="width: 80px;">Umur</th>
                    <th style="width: 130px;">Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th style="width: 120px;">Tanggal</th>
                    <th style="width: 200px;">Hasil</th>
                    <th class="col-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $page = request()->getVar('page') ?? 1;
                $no = 1 + (($page - 1) * 10); 
                foreach(($skrining ?? []) as $row): 
                ?>
                    <tr class="data-row">
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="fw-medium"><?= esc((string) ($row['nama_pasien_skrining'] ?? '')) ?></td>
                        <td class="text-center"><?= esc((string) ($row['usia'] ?? '0')) ?> Th</td>

                        <td class="text-center">
                        <?= esc((string) ($row['jenis_kelamin'] ?? '')) ?>
                        </td>
                        <td class="col-alamat" title="<?= esc($row['kelurahan'].', '.$row['kecamatan'].', '.$row['kabupaten']) ?>">
                            <?= esc($row['kelurahan'].', '.$row['kecamatan']) ?>
                        </td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                        <td class="text-center">
                            <?php if(strpos($row['hasil'],'Buruk') !== false): ?>
                                <span class="badge-custom badge-buruk"><i class="bi bi-exclamation-triangle-fill me-1"></i> <?= esc((string) ($row['hasil'] ?? '-')) ?></span>
                            <?php elseif(strpos($row['hasil'],'Cukup') !== false): ?> 
                                <span class="badge-custom badge-cukup"><i class="bi bi-info-circle-fill me-1"></i> <?= esc((string) ($row['hasil'] ?? '-')) ?></span>
                            <?php else: ?>
                                <span class="badge-custom badge-baik"><i class="bi bi-check-circle-fill me-1"></i> <?= esc((string) ($row['hasil'] ?? '-')) ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="col-aksi">
                            <button class="aksi-btn btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal<?= $row['id_skrining'] ?>" title="Detail">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="aksi-btn btn-hapus" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $row['id_skrining'] ?>" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if(empty($skrining)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Tidak ada data skrining yang cocok dengan filter.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination-custom mt-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="text-muted" style="font-size: 13.5px;">
            Menampilkan <b><?= count($skrining ?? []) ?></b> data di halaman ini
        </div>
        <div class="pages">
            <?= $pagerLinks ?>
        </div>
    </div>
</div>

<?php foreach(($skrining ?? []) as $row): ?>
    <div class="modal fade" id="detailModal<?= $row['id_skrining'] ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px; overflow:hidden;">
                <div class="modal-header" style="background: linear-gradient(135deg, #00BBC2, #009aa0); color:white;">
                    <h5 class="modal-title fs-6"><i class="bi bi-file-earmark-medical me-2"></i>Detail Hasil Skrining</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" style="font-size: 14px;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-1">NIK</label>
                            <div class="form-control bg-light"><?= esc((string) ($row['nik'] ?? '-')) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-1">Nama Pasien</label>
                            <div class="form-control bg-light"><?= esc((string) ($row['nama_pasien_skrining'] ?? '')) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-1">Jenis Kelamin</label>
                            <div class="form-control bg-light"><?= esc((string) ($row['jenis_kelamin'] ?? '')) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-1">Usia</label>
                            <div class="form-control bg-light"><?= esc((string) ($row['usia'] ?? '0')) ?>Tahun</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-1">Tanggal Lahir</label>
                            <div class="form-control bg-light"><?= !empty($row['tanggal_lahir']) ? date('d-m-Y', strtotime($row['tanggal_lahir'])) : '-' ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-1">No HP</label>
                            <div class="form-control bg-light"><?= esc((string) ($row['no_hp'] ?? '-')) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold text-muted mb-1">Tanggal Skrining</label>
                            <div class="form-control bg-light"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></div>
                        </div>
                        <div class="col-12">
                            <label class="fw-bold text-muted mb-1">Alamat Wilayah</label>
                            <div class="form-control bg-light">
                                <?= esc((string) ($row['kelurahan'] ?? '-')) ?>,
                                KEC. <?= esc((string) ($row['kecamatan'] ?? '-')) ?>,
                                <?= esc((string) ($row['kabupaten'] ?? '-')) ?>

                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="fw-bold text-muted mb-2">Kesimpulan Hasil</label>
                            <?php if(strpos($row['hasil'],'Buruk') !== false): ?>
                                <div class="alert alert-danger d-flex align-items-center mb-0"><i class="bi bi-exclamation-octagon-fill fs-5 me-2"></i> <b><?= esc((string) ($row['hasil'] ?? '-')) ?></b></div>
                            <?php elseif(strpos($row['hasil'],'Cukup') !== false): ?>
                                <div class="alert alert-warning d-flex align-items-center mb-0"><i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> <b><?= esc((string) ($row['hasil'] ?? '-')) ?></b></div>
                            <?php else: ?>
                                <div class="alert alert-success d-flex align-items-center mb-0"><i class="bi bi-check-circle-fill fs-5 me-2"></i> <b><?= esc((string) ($row['hasil'] ?? '-')) ?></b></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary px-4" style="border-radius:8px;" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusModal<?= $row['id_skrining'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:16px;">
                <div class="modal-header">
                    <h5 class="modal-title fs-6 text-danger"><i class="bi bi-trash-fill me-2"></i>Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="font-size: 14px;">
                    Apakah Anda yakin ingin menghapus data skrining atas nama <b><?= esc((string) ($row['nama_pasien_skrining'] ?? ''))?></b>? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" style="border-radius:8px;" data-bs-dismiss="modal">Batal</button>
                    <form action="<?= base_url('dbd/hapus_skrining/'.$row['id_skrining']) ?>" method="post">
    <?= csrf_field() ?>
    <button type="submit" class="btn btn-danger">
        Hapus Data
    </button>
</form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    // Submit form otomatis ketika filter diubah
    function submitFilterForm() {
        document.getElementById("filterForm").submit();
    }

    // Debounce input pencarian agar tidak langsung submit di setiap ketukan keyboard
    let searchTimeout;
    document.getElementById("searchInput").addEventListener("keyup", function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            submitFilterForm();
        }, 700); // submit otomatis setelah 0.7 detik berhenti mengetik
    });

    // Menghapus semua centang filter
    function resetSemuaFilter(source) {
        if(source.checked) {
            document.querySelectorAll(".filter-item-check").forEach(item => {
                item.checked = false;
            });
            submitFilterForm();
        }
    }
</script>

<?= $this->endSection() ?>