<?php echo $this->extend('layout/dashboard_layout_admin'); ?>

<?= $this->section('style'); ?>
<style>
/* ===============================
   HALAMAN PELAPORAN KADER (DAFTAR)
================================= */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
}

.content-body {
    background: #e6f6f5;
    padding: 30px;
    min-height: 100vh;
}

.page-box {
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}

/* BANNER HEADER (DI LUAR CARD) */
.info-banner {
    background: #4cc7c3;
    border-radius: 16px;
    padding: 20px 24px;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 24px;
}
.info-icon {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}
.info-text h4 {
    margin: 0 0 5px 0;
    font-size: 20px;
    font-weight: 700;
}
.info-text p {
    margin: 0;
    font-size: 14px;
    opacity: 0.9;
}

/* ===============================
   KONTROL ATAS
================================= */
.controls-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center; /* Sejajar semua */
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

/* KIRI: Search, Filter, Export */
.controls-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-box {
    position: relative;
    width: 220px;
}
.search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
}
.search-box input {
    width: 100%;
    padding: 10px 15px 10px 40px;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    font-size: 14px;
    background: #f8f9fa;
    height: 42px;
}

.btn-filter-outline {
    background: #fff;
    border: 1px solid #e0e0e0;
    padding: 0 16px;
    border-radius: 10px;
    color: #555;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    height: 42px;
    transition: all 0.3s;
}
.btn-filter-outline:hover {
    background: #f1f1f1;
}

.btn-export {
    background-color: #00b8c0;
    color: white;
    border-radius: 10px;
    padding: 0 18px;
    border: none;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    height: 42px;
}

/* KANAN: Dropdown View & Periode */
.controls-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.dropdown-view {
    min-width: 160px;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    padding: 0 12px;
    font-size: 14px;
    background-color: #fff;
    height: 42px;
}

.period-control {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    padding: 0 15px;
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    font-size: 14px;
    height: 42px;
}
.period-btn {
    border: none;
    background: none;
    color: #00b8c0;
    cursor: pointer;
    font-weight: bold;
    padding: 0 5px;
}

/* ===============================
   TABEL
================================= */
.table-responsive {
    border-radius: 12px;
    border: 1px solid #eee;
    overflow-x: auto;
    background: #fff;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 14px;
    text-align: center;
    border: 1px solid #eee;
    font-size: 14px;
}
th {
    background: #f8f9fa;
    font-weight: 600;
    color: #333;
}
.status-check { color: #20c997; font-size: 18px; }
.status-cross { color: #ff6b6b; font-size: 18px; }
</style>
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<div class="content-body">
    
    <div class="info-banner">
        <div class="info-icon">
            <i class="fa-solid fa-file-lines"></i>
        </div>
        <div class="info-text">
            <h4>Pelaporan Kader</h4>
            <p>Menampilkan Riwayat Pelaporan Jentik Nyamuk</p>
        </div>
    </div>

    <div class="page-box">
        
        <div class="controls-wrapper">
            
            <div class="controls-left">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Cari data...">
                </div>

                <button class="btn-filter-outline" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>

                <button class="btn-export" onclick="exportToExcel('tabelDaftar')">
                    <i class="fa-solid fa-file-excel"></i> Export Laporan
                </button>
            </div>

            <div class="controls-right">
                <select class="form-select dropdown-view" onchange="window.location.href=this.value;">
                    <option value="<?= base_url('dbd/pelaporan-kader/admin') ?>">Rekap Laporan</option>
                    <option value="<?= base_url('dbd/pelaporan-kader/daftar/admin') ?>" selected>Daftar Laporan</option>
                </select>

                <div class="period-control">
                    <span class="fw-medium">Periode:</span>
                    <button class="period-btn" onclick="gantiTahun(-1)"><i class="fa-solid fa-chevron-left"></i></button>
                    <span id="yearText" class="fw-bold"><?= isset($tahunAktif) ? $tahunAktif : date('Y') ?></span>
                    <button class="period-btn" onclick="gantiTahun(1)"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="tabelDaftar">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Minggu Ke-</th>
                        <?php if(!empty($listCatleya)): ?>
                            <?php foreach($listCatleya as $posyandu): ?>
                                <th>Catleya <?= $posyandu ?></th>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <th>Posyandu</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($listMinggu)): ?>
                        <?php $no = 1; foreach($listMinggu as $minggu): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $bulanAktif ?? '-' ?></td>
                            <td><?= $minggu ?></td>
                            <?php if(!empty($listCatleya)): ?>
                                <?php foreach($listCatleya as $posyandu): ?>
                                    <td>
                                        <?php 
                                            // LOGIKA BARU: Normalisasi key posyandu agar aman dicari (tanpa dan dengan 0 di depan)
                                            $posWithoutZero = ltrim($posyandu, '0');
                                            $posWithZero = str_pad($posWithoutZero, 2, "0", STR_PAD_LEFT);

                                            $idLaporan = null;
                                            
                                            if (isset($dataLaporan[$minggu][$posyandu])) {
                                                $idLaporan = $dataLaporan[$minggu][$posyandu];
                                            } elseif (isset($dataLaporan[$minggu][$posWithZero])) {
                                                $idLaporan = $dataLaporan[$minggu][$posWithZero];
                                            } elseif (isset($dataLaporan[$minggu][$posWithoutZero])) {
                                                $idLaporan = $dataLaporan[$minggu][$posWithoutZero];
                                            }
                                        ?>

                                        <?php if ($idLaporan): ?>
                                            <a href="<?= base_url('dbd/view_laporan_kader/admin/' . $idLaporan) ?>">
                                                <i class="fa-solid fa-circle-check status-check"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('pelaporan-kader/input?bulan='.($bulanAktif ?? '').'&minggu='.$minggu.'&posyandu='.$posyandu) ?>">
                                                <i class="fa-solid fa-circle-xmark status-cross"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="100%">Tidak ada data minggu di bulan ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; padding: 10px; border: none;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title fw-bold">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('dbd/pelaporan-kader/daftar/admin') ?>" method="get">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelurahan</label>
                        <select name="kelurahan" id="kelurahanSelect" class="form-select" style="background-color: #f8f9fa;">
                            <option value="">Semua Kelurahan</option>
                            <option value="Sumbersari">Sumbersari</option>
                            <option value="Wirolegi">Wirolegi</option>
                            <option value="Karangrejo">Karangrejo</option>
                            <option value="Tegalgede">Tegalgede</option>
                            <option value="Antirogo">Antirogo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Posyandu</label>
                        <select name="posyandu" id="posyanduSelect" class="form-select" style="background-color: #f8f9fa;">
                            <option value="">Semua Posyandu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Bulan</label>
                        <select name="bulan" class="form-select" style="background-color: #f8f9fa;">
                            <option value="">Semua Bulan</option>
                            <?php 
                            $bAktif = isset($bulanAktif) ? $bulanAktif : '';
                            foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $b): 
                            ?>
                                <option value="<?= $b ?>" <?= ($bAktif == $b) ? 'selected' : '' ?>><option value="<?= $b ?>" <?= ($bAktif == $b) ? 'selected' : '' ?>><?= $b ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: none;">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn" style="background-color: #00b8c0; color: white; border-radius: 8px;">Terapkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // 1. DATA POSYANDU & LOGIKA DROPDOWN KELURAHAN
    const dataPosyandu = {
        'Sumbersari': ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35'],
        'Wirolegi': ['36','36A','37','38','39','40','41','42','43','44','44A','45','46','47','48','49','50','51','52','53','54'],
        'Karangrejo': ['75','76','77','78','78A','79','80','81','82','83','84','85','86','87','88','88A','89','90','91','92','92A','93','94','95','95A','95B'],
        'Tegalgede': ['68','69','70','71','72','73','74','74A','74B'],
        'Antirogo': ['55','56','57','58','58A','59','60','61','62','63','64','65','65A','66','67']
    };

    document.getElementById('kelurahanSelect').addEventListener('change', function() {
        const posyanduSelect = document.getElementById('posyanduSelect');
        const kelurahanTerpilih = this.value;
        posyanduSelect.innerHTML = '<option value="">Semua Posyandu</option>';
        if(kelurahanTerpilih !== "" && dataPosyandu[kelurahanTerpilih]) {
            dataPosyandu[kelurahanTerpilih].forEach(function(item) {
                let option = document.createElement('option');
                option.value = item;
                option.text = 'Catleya ' + item;
                posyanduSelect.appendChild(option);
            });
        }
    });

    // 2. FUNGSI GANTI TAHUN
    function gantiTahun(offset) {
        const urlParams = new URLSearchParams(window.location.search);
        let currentYear = parseInt(document.getElementById('yearText').innerText);
        urlParams.set('tahun', currentYear + offset);
        window.location.search = urlParams.toString();
    }

    // 3. FUNGSI PENCARIAN REAL-TIME
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();
        document.querySelectorAll('tbody tr').forEach(function(row) {
            row.style.display = row.innerText.toLowerCase().includes(keyword) ? '' : 'none';
        });
    });

    // 4. FUNGSI EXPORT EXCEL
    function exportToExcel(tableID, filename = 'Data_Laporan_Kader.xls') {
        let table = document.getElementById(tableID).cloneNode(true);
        table.querySelectorAll('.fa-circle-check').forEach(el => el.parentNode.innerText = 'Selesai');
        table.querySelectorAll('.fa-circle-xmark').forEach(el => el.parentNode.innerText = 'Belum');
        let html = table.outerHTML;
        let blob = new Blob(['\ufeff', html], { type: 'application/vnd.ms-excel' });
        let url = URL.createObjectURL(blob);
        let a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
</script>
<?= $this->endSection(); ?>