<?php echo $this->extend('layout/dashboard_layout_kepala'); ?>

<?= $this->section('style'); ?>
<style>
/* ===============================
    HALAMAN PELAPORAN KADER
================================= */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

body { font-family: 'Poppins', sans-serif; }
.content-body { background: #e6f6f5; padding: 30px; min-height: 100vh; }
.page-box { background: #fff; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }

/* HEADER INFO */
.info-banner { background: #4cc7c3; border-radius: 16px; padding: 20px 24px; color: #fff; display: flex; align-items: center; gap: 20px; margin-bottom: 24px; }
.info-icon { width: 50px; height: 50px; background: rgba(255,255,255,0.25); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
.info-banner h4 { margin: 0; font-weight: 700; font-size: 20px; }
.info-banner p { margin: 0; opacity: 0.9; font-size: 14px; margin-top: 4px; }

/* TOOLBAR */
.toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px; }
.search-group { display: flex; gap: 12px; }
.search-box { display: flex; align-items: center; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; background: #fff;}
.search-box button.search-icon { background: #00b8c0; color: #fff; border: none; padding: 10px 16px; font-size: 16px; height: 100%; display: flex; align-items: center; cursor: pointer; }
.search-box input { border: none; outline: none; width: 200px; padding: 10px 16px; font-size: 14px; }

.filter-btn { background: #fff; border: 1px solid #00b8c0; color: #00b8c0; border-radius: 8px; padding: 10px 14px; font-size: 16px; cursor: pointer; transition: 0.2s; }
.filter-btn:hover { background: #f0fcfc; }

.right-toolbar { display: flex; align-items: center; gap: 15px; flex-wrap: nowrap; }

.rekap-select { border: 1px solid #d1e3e8; background-color: #f7f9fb; color: #4a7d8c; border-radius: 8px; padding: 8px 36px 8px 16px; font-weight: 500; font-size: 14px; cursor: pointer; appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234a7d8c' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; outline: none; }

.periode-control { display: flex; align-items: center; gap: 10px; font-size: 15px; white-space: nowrap; }
.periode-control span { font-weight: 500; color: #004d61; }
.periode-control a { color: #00b8c0; font-size: 14px; text-decoration: none; padding: 0 5px; display: flex; align-items: center; }
.periode-control b { font-weight: 700; color: #000; }

/* TABLE */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: separate; border-spacing: 0; text-align: center; }
thead th { background: #e8f9f9; padding: 14px; font-size: 14px; font-weight: 600; color: #333; border-bottom: 1px solid #eee; }
tbody td { background: #fff; padding: 12px; font-size: 14px; color: #555; border-bottom: 1px solid #eee; vertical-align: middle; }

/* ACTION BUTTONS */
.action-buttons { display: flex; justify-content: center; gap: 6px; }
.btn-action { width: 32px; height: 32px; border: none; border-radius: 6px; color: #fff; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 13px; }
.btn-action.view { background: #1625d8; }
.btn-action.view:hover { opacity: 0.8; color: #fff;}

/* PAGINATION */
.bottom-section { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
.pagination-box { display: flex; gap: 6px; }
.pagination-box button { border: 1px solid #e0e0e0; background: #fff; padding: 6px 14px; border-radius: 6px; font-size: 13px; cursor: pointer; }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php 

// Menangkap parameter GET untuk mempertahankan pilihan user
$tahunAktif = isset($_GET['tahun']) ? (string)$_GET['tahun'] : date('Y'); 
$searchParam = isset($_GET['search']) ? (string)$_GET['search'] : '';
$puskesmasParam = isset($_GET['puskesmas']) ? (string)$_GET['puskesmas'] : '';
$kelurahanParam = isset($_GET['kelurahan']) ? (string)$_GET['kelurahan'] : '';
$posyanduParam = isset($_GET['posyandu']) ? (string)$_GET['posyandu'] : '';
$bulanParam = isset($_GET['bulan']) ? (string)$_GET['bulan'] : '';
?>

<div class="info-banner">
    <div class="info-icon"><i class="fa-solid fa-shield-heart"></i></div>
    <div>
        <h4>Pelaporan Kader</h4>
        <p>Menampilkan riwayat pelaporan jentik</p>
    </div>
</div>

<div class="page-box">
    <div class="toolbar">
        <div class="search-group">
            <form action="<?= base_url('pelaporan-kader') ?>" method="get" class="search-box">
                <input type="hidden" name="tahun" value="<?= $tahunAktif ?>">
                <?php if($puskesmasParam) echo "<input type='hidden' name='puskesmas' value='$puskesmasParam'>"; ?>
                <?php if($kelurahanParam) echo "<input type='hidden' name='kelurahan' value='$kelurahanParam'>"; ?>
                <?php if($posyanduParam) echo "<input type='hidden' name='posyandu' value='$posyanduParam'>"; ?>
                <?php if($bulanParam) echo "<input type='hidden' name='bulan' value='$bulanParam'>"; ?>
                
                <button type="submit" class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input type="text" name="search" placeholder="Ketik untuk mencari..." value="<?= esc($searchParam) ?>">
            </form>
            
            <button class="filter-btn" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fa-solid fa-filter"></i>
            </button>
        </div>

        <div class="right-toolbar">
            <select class="form-select rekap-select" onchange="window.location.href=this.value;">
                <option value="<?= base_url('pelaporan-kader') ?>">Rekap Laporan</option>
                <option value="<?= base_url('pelaporan-kader/daftar') ?>">Daftar Laporan</option>
            </select>
            
            <div class="periode-control">
                <span>Periode :</span>
                <a href="javascript:void(0)" onclick="gantiTahun(-1)"><i class="fa-solid fa-chevron-left"></i></a>
                <b id="yearText"><?= esc($tahunAktif) ?></b>
                <a href="javascript:void(0)" onclick="gantiTahun(1)"><i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </div> 

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Minggu Ke-</th>
                    <th>Puskesmas</th>
                    <th>Kelurahan</th>
                    <th>Pos Posyandu</th>
                    <th>Angka Bebas Jentik (ABJ)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if(!empty($pelaporan)): ?>
                    <?php foreach($pelaporan as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc((string)$row['bulan']) ?></td>
                        <td><?= esc((string)$row['minggu']) ?></td>
                        <td><?= esc((string)$row['id_puskesmas']) ?></td> 
                        <td><?= esc((string)$row['id_kelurahan']) ?></td> 
                        <td><?= esc((string)$row['id_posyandu']) ?></td> <td><?= isset($row['abj']) ? round($row['abj']) . '%' : '75%' ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('kepala/view_laporan/' . $row['id_laporan']) ?>" class="btn-action view">
                                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">Data pelaporan tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="filterModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title">Filter Pelaporan Kader</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('pelaporan-kader') ?>" method="get">
                <input type="hidden" name="tahun" value="<?= esc($tahunAktif) ?>">
                <?php if($searchParam) echo "<input type='hidden' name='search' value='".esc($searchParam)."'>"; ?>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="mb-2 fw-semibold">Puskesmas</label>
                        <select class="form-select" name="puskesmas">
                            <option value="">Pilih puskesmas</option>
                            <option value="Sumbersari" <?= ($puskesmasParam == 'Sumbersari') ? 'selected' : '' ?>>Sumbersari</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2 fw-semibold">Kelurahan</label>
                        <select class="form-select" name="kelurahan" id="kelurahanSelect">
                            <option value="">Pilih kelurahan</option>
                            <?php 
                            $listKelurahan = ['Antirogo', 'Karangrejo', 'Sumbersari', 'Tegalgede', 'Wirolegi'];
                            foreach($listKelurahan as $kel): ?>
                                <option value="<?= $kel ?>" <?= ($kelurahanParam == $kel) ? 'selected' : '' ?>><?= $kel ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2 fw-semibold">Pos Posyandu</label>
                        <select class="form-select" name="posyandu" id="posyanduSelect">
                            <option value="">Pilih pos posyandu</option>
                            </select>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2 fw-semibold">Bulan</label>
                        <select class="form-select" name="bulan">
                            <option value="">Pilih bulan</option>
                            <?php 
                            $listBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                            foreach($listBulan as $bln): ?>
                                <option value="<?= $bln ?>" <?= ($bulanParam == $bln) ? 'selected' : '' ?>><?= $bln ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between mt-2">
                    <a href="<?= base_url('pelaporan-kader') ?>" class="btn btn-outline-danger">Reset</a>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info text-white">Terapkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // FUNGSI GANTI TAHUN
    function gantiTahun(offset) {
        const urlParams = new URLSearchParams(window.location.search);
        let currentYear = parseInt(document.getElementById('yearText').innerText);
        let newYear = currentYear + offset;
        urlParams.set('tahun', newYear);
        window.location.search = urlParams.toString();
    }

    // LOGIKA DROPDOWN POSYANDU BERDASARKAN KELURAHAN
    const dataPosyandu = {
        'Sumbersari': ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35'],
        'Wirolegi': ['36','36 A','37','38','39','40','41','42','43','44','44A','45','46','47','48','49','50','51','52','53','54'],
        'Karangrejo': ['75','76','77','78','78A','79','80','81','82','83','84','85','86','87','88','88A','89','90','91','92','92A','93','94','95','95A','95B'],
        'Tegalgede': ['68','69','70','71','72','73','74','74A','74B'],
        'Antirogo': ['55','56','57','58','58A','59','60','61','62','63','64','65','65A','66','67']
    };

    const kelurahanSelect = document.getElementById('kelurahanSelect');
    const posyanduSelect = document.getElementById('posyanduSelect');
    const selectedPosyanduParam = "<?= esc($posyanduParam) ?>"; // Nilai posyandu dari PHP

    function populatePosyandu() {
        const kelurahanTerpilih = kelurahanSelect.value;
        posyanduSelect.innerHTML = '<option value="">Pilih pos posyandu</option>';
        
        if(kelurahanTerpilih !== "" && dataPosyandu[kelurahanTerpilih]) {
            dataPosyandu[kelurahanTerpilih].forEach(function(item) {
                let namaPosyandu = 'Catleya ' + item;
                let option = document.createElement('option');
                option.value = namaPosyandu;
                option.text = namaPosyandu;
                
                // Jika sesuai dengan data GET, otomatis set terpilih
                if(namaPosyandu === selectedPosyanduParam) {
                    option.selected = true;
                }
                
                posyanduSelect.appendChild(option);
            });
        }
    }

    // Jalankan saat kelurahan berubah
    kelurahanSelect.addEventListener('change', populatePosyandu);

    // Jalankan otomatis saat halaman diload (agar filter posyandu tidak kosong saat difilter)
    window.addEventListener('load', populatePosyandu);
</script>

<?= $this->endSection(); ?>