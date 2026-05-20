<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<style>
                                .badge-status{
                                    padding:8px 14px;
                                    border-radius:10px;
                                    font-size:14px;
                                    font-weight:600;
                                    display:inline-block;
                                    min-width:110px;
                                    text-align:center;
                                    box-shadow:0 2px 5px rgba(0,0,0,0.08);
                                }

                                .badge-sembuh{
                                    background:#198754;
                                    color:white;
                                }

                                .badge-meninggal{
                                    background:#dc3545;
                                    color:white;
                                }

                                .badge-pengobatan{
                                    background:#ffc107;
                                    color:#212529;
                                }

                                .search-box{
                                background:white;
                                border-radius:14px;
                                overflow:hidden;
                                border:1px solid #dfeaea;
                            }

                            .btn-search{
                                width:55px;
                                height:55px;
                                border:none;
                                background:#20C9C3;
                                color:white;
                                font-size:18px;
                            }

                            .search-input{
                                border:none !important;
                                box-shadow:none !important;
                                width:260px;
                                padding:14px;
                            }

                           .btn-filter{
                                width:55px;
                                height:55px;
                                border-radius:14px;
                                border:none;
                                background:#20C9C3;
                                color:white;
                                font-size:20px;

                                display:flex;
                                align-items:center;
                                justify-content:center;
                            }

                            .btn-filter:hover{
                                background:#18b4ae;
                            }
                            .custom-input{
                                height:55px;
                                border:none;
                                border-radius:14px;
                                background:#F4F8F8;
                            }
                            .btn-export{
                                 background:#20C9C3 !important;
                                    color:white !important;
                                    border:none;
                                    padding:14px 24px;
                                    border-radius:14px;
                                    text-decoration:none;
                                    font-weight:600;

                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    gap:10px;   
                                }
                                .btn-export i,
                                .btn-filter i{
                                    color:white !important;
                                }
                                .btn-export:hover{
                                    background:#18b4ae;
                                    color:white;
                                }

                                .status-card{
        padding:12px 20px;
        border-radius:14px;
        font-weight:600;
        color:white;
        box-shadow:0 4px 10px rgba(0,0,0,0.08);
    }

    .sembuh-card{
        background:#198754;
    }

    .pengobatan-card{
        background:#FFC107;
        color:#222;
    }

    .meninggal-card{
        background:#DC3545;
    }
</style>
<div class="container-fluid">

    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-body p-4">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold mb-1"
                        style="color:#1F3A3A;">

                        Data Pasien

                    </h3>

                    <small style="color:#6B8A8A;">
                        Data pasien yang telah diinput
                    </small>

                </div>

                <a href="<?= base_url('tbc/create') ?>"
                    class="btn text-white rounded-3 px-4"
                    style="background:#2CCFC0;">

                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Pasien

                </a>

            </div>
            <!-- SEARCH & FILTER -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <!-- SEARCH -->
                <div class="d-flex gap-2">

                    <div class="search-box d-flex align-items-center">

                        <button class="btn-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                        <input type="text"
                            class="form-control search-input"
                            placeholder="Ketik untuk mencari...">
                            

                    </div>

                    <!-- FILTER BUTTON -->
                    <button class="btn-filter"
                            data-bs-toggle="modal"
                            data-bs-target="#filterModal">

                        <i class="fa-solid fa-filter"></i>

                    </button>
                        <!-- EXPORT -->
                        <a href="<?= base_url('tbc/export-hasil-data-pasien') ?>"
                        class="btn-export">

                            <i class="fa-solid fa-file-export me-2"></i>
                            Export Data

                        </a>

                </div>

            </div>
            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table align-middle text-center">

                    <thead style="background:#E0F7F6;">

                        <tr>
                            <th>NIK</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Status</th>
                            <th>Tanggal Kunjungan</th>
                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach($pasien ?? [] as $p): ?>

                        <tr>

                            <!-- NIK -->
                            <td>
                                <?= $p['nik']; ?>
                            </td>

                            <!-- NO RM -->
                            <td>
                                <?= $p['no_rm']; ?>
                            </td>

                            <!-- NAMA -->
                            <td>

                                <strong style="color:#1F3A3A;">
                                    <?= $p['nama_pasien']; ?>
                                </strong>

                            </td>

                            <!-- JK -->
<td>

<?php

if($p['jenis_kelamin'] == '1'){

    echo 'Perempuan';

}

elseif($p['jenis_kelamin'] == '2'){

    echo 'Laki-laki';

}

else{

    echo $p['jenis_kelamin'];

}

?>

</td>

                            <!-- UMUR -->
                            <td>

                                <?= $p['umur']; ?> Th

                            </td>
                            
                            <!-- STATUS -->
                            <td>
                            <?php if($p['status_akhir'] == 'Sembuh'): ?>
                                <span class="badge-status badge-sembuh">Sembuh</span>

                            <?php elseif($p['status_akhir'] == 'Meninggal'): ?>
                                <span class="badge-status badge-meninggal">Meninggal</span>

                            <?php elseif($p['status_akhir'] == 'Pengobatan'): ?>
                                <span class="badge-status badge-pengobatan">Pengobatan</span>

                            <?php else: ?>
                                <span class="badge-status bg-secondary">Tidak Ada</span>
                            <?php endif; ?>
                            </td>
                            <!-- TANGGAL -->
                            <td>

                                <?= date('d-m-Y', strtotime($p['tgl_kunjungan'])) ?>

                            </td>

                            <!-- AKSI -->
                            <td class="text-center">

                                <!-- EDIT -->
                                 <a href="<?= base_url('tbc/edit/' . $p['id_pasien']) ?>"
                                class="btn btn-warning btn-sm rounded-3">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <!-- HAPUS -->
                                <button type="button"
                                        class="btn btn-danger btn-sm rounded-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#hapusModal<?= $p['id_pasien'] ?>">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </td>

                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade"
                             id="hapusModal<?= $p['id_pasien'] ?>"
                             tabindex="-1">

                            <div class="modal-dialog modal-dialog-centered"
                            style="max-width:320px;">

                                 <div class="modal-content border-0 rounded-4 shadow-lg">

                                   <div class="modal-body text-center p-3">

                                        <!-- ICON -->
                                        <div class="mb-3">

                                            <div class="rounded-circle
                                                        d-inline-flex
                                                        justify-content-center
                                                        align-items-center"
                                                 style="
                                                width:55px;
                                                height:55px;
                                                 background:#ffebee;">

                                                <i class="fa-solid fa-trash"
                                                   style="
                                                   font-size:22px;
                                                   color:#ef4444;"></i>

                                            </div>

                                        </div>

                                        <!-- TITLE -->
                                        <h4 class="fw-bold mb-2">

                                            Hapus Data

                                        </h3>

                                        <!-- TEXT -->
                                        <p class="text-muted mb-4">

                                            Apakah Anda yakin ingin
                                            menghapus data pasien ini?

                                        </p>

                                        <!-- BUTTON -->
                                        <div class="d-grid gap-2">

                                            <a href="<?= base_url('tbc/delete/' . $p['id_pasien']) ?>"
                                               class="btn text-white rounded-3 py-2"
                                               style="background:#00CED1;">

                                                Ya

                                            </a>

                                            <button type="button"
                                                    class="btn btn-light rounded-3 py-2"
                                                    data-bs-dismiss="modal">

                                                Tidak

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- MODAL FILTER -->
<div class="modal fade"
     id="filterModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 p-2">

            <!-- HEADER -->
            <div class="modal-header border-0">

                <h4 class="fw-bold">
                    Filter Hasil Data Pasien
                </h4>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- BULAN -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Bulan
                    </label>

                    <select class="form-select custom-input">

                        <option>Semua</option>
                        <option>Januari</option>
                        <option>Februari</option>
                        <option>Maret</option>
                        <option>April</option>
                        <option>Mei</option>
                        <option>Juni</option>
                        <option>Juli</option>
                        <option>Agustus</option>
                        <option>September</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Desember</option>

                    </select>

                </div>

                <!-- TAHUN -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Periode Tahun
                    </label>

                    <input type="number"
                           class="form-control custom-input"
                           placeholder="2026"
                           min="2020"
                           max="2100">

                </div>

                <!-- KELURAHAN -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Kelurahan
                    </label>

                    <select class="form-select custom-input">

                        <option>Semua</option>
                        <option>Jemberkidul</option>
                        <option>Sumbersari</option>

                    </select>

                </div>

                <!-- URUTKAN -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Urutkan
                    </label>

                    <select class="form-select custom-input">

                        <option>Default</option>
                        <option>Terbaru</option>
                        <option>Terlama</option>

                    </select>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0">

                <button class="btn btn-secondary rounded-3 px-4">

                    Reset

                </button>

                <button class="btn btn-secondary rounded-3 px-4"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <button class="btn text-white rounded-3 px-4"
                        style="background:#20C9C3;">

                    Terapkan

                </button>

            </div>

        </div>

    </div>

</div>
<?= $this->endSection() ?>