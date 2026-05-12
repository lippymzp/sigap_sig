<?php echo $this->extend('layout/dashboard_layout_kepala'); ?>

<?= $this->section('style'); ?>
<style>
/* ===============================
    HALAMAN PELAPORAN KADER (DAFTAR - VERTIKAL)
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
.search-group { display: flex; gap: 12px; align-items: center; }

.search-box { display: flex; align-items: center; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; background: #fff; height: 42px;}
.search-box button.search-icon { background: #00b8c0; color: #fff; border: none; padding: 0 16px; font-size: 16px; height: 100%; display: flex; align-items: center; justify-content: center; cursor: pointer; }
.search-box input { border: none; outline: none; width: 200px; padding: 0 16px; font-size: 14px; height: 100%; }

.filter-btn { background: #fff; border: 1px solid #00b8c0; color: #00b8c0; border-radius: 8px; padding: 0 14px; height: 42px; font-size: 16px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; }
.filter-btn:hover { background: #f0fcfc; }

.export-btn { background: #00b8c0; border: 1px solid #00b8c0; color: #fff; border-radius: 8px; padding: 0 16px; height: 42px; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 8px; cursor: pointer; transition: 0.2s; }
.export-btn:hover { background: #009ea6; }

.right-toolbar { display: flex; align-items: center; gap: 15px; flex-wrap: nowrap; }

.rekap-select { border: 1px solid #d1e3e8; background-color: #f7f9fb; color: #4a7d8c; border-radius: 8px; padding: 8px 36px 8px 16px; font-weight: 500; font-size: 14px; cursor: pointer; appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234a7d8c' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; outline: none; height: 42px; }

.periode-control { display: flex; align-items: center; gap: 10px; font-size: 15px; white-space: nowrap; height: 42px;}
.periode-control span { font-weight: 500; color: #004d61; }
.periode-control a { color: #00b8c0; font-size: 14px; text-decoration: none; padding: 0 5px; display: flex; align-items: center; }
.periode-control b { font-weight: 700; color: #000; }

/* TABLE LOGIC */
.table-wrap { overflow-x: auto; width: 100%; border-radius: 8px; border: 1px solid #eee; }
table { width: 100%; border-collapse: separate; border-spacing: 0; text-align: center; }

th, td { padding: 14px; font-size: 14px; border-bottom: 1px solid #eee; border-right: 1px solid #eee; }
thead th { background: #e8f9f9; font-weight: 600; color: #333; border-top: 1px solid #eee; }
tbody td { background: #fff; color: #555; vertical-align: middle; }

th:last-child, td:last-child { border-right: none; }

.status-check { color: #20c997; font-size: 18px; }
.status-cross { color: #ff6b6b; font-size: 18px; }

/* PAGINATION SECTION */
.bottom-section { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
#pageInfo { font-size: 14px; color: #666; font-weight: 500; }
.pagination-box { display: flex; gap: 8px; }
.pagination-box button { border: 1px solid #00b8c0; background: #fff; color: #00b8c0; padding: 6px 16px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: 0.2s; }
.pagination-box button:hover:not(:disabled) { background: #00b8c0; color: #fff; }
.pagination-box button:disabled { border-color: #ddd; color: #aaa; cursor: not-allowed; background: #fafafa; }
</style>
<?= $this->endSection(); ?>


<?= $this->section('content'); ?>
<?php 
// Menangkap parameter GET untuk mempertahankan pilihan user
$tahunAktif = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); 
$searchParam = isset($_GET['search']) ? $_GET['search'] : '';
$puskesmasParam = isset($_GET['puskesmas']) ? $_GET['puskesmas'] : '';
$kelurahanParam = isset($_GET['kelurahan']) ? $_GET['kelurahan'] : '';
$posyanduParam = isset($_GET['posyandu']) ? $_GET['posyandu'] : '';
$bulanParam = isset($_GET['bulan']) ? $_GET['bulan'] : '';
?>

<div class="content-body">
    
    <div class="info-banner">
        <div class="info-icon"><i class="fa-solid fa-file-lines"></i></div>
        <div>
            <h4>Pelaporan Kader</h4>
            <p>Menampilkan Riwayat Pelaporan Jentik Nyamuk</p>
        </div>
    </div>

    <div class="page-box">
        
        <div class="toolbar">
            <div class="search-group">
                <div class="search-box">
                    <button class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" id="searchInput" placeholder="Cari posyandu..." value="<?= esc($searchParam) ?>">
                </div>
                
                <button class="filter-btn" data-bs-toggle="modal" data-bs-target="#filterModal" title="Filter Data">
                    <i class="fa-solid fa-filter"></i>
                </button>

                <button class="export-btn" onclick="exportToExcel('tabelDaftar')">
                    <i class="fa-solid fa-file-excel"></i> Export
                </button>
            </div>

            <div class="right-toolbar">
                <select class="form-select rekap-select" onchange="window.location.href=this.value;">
                    <option value="<?= base_url('pelaporan-kader') ?>">Rekap Laporan</option>
                    <option value="<?= base_url('pelaporan-kader/daftar') ?>" selected>Daftar Laporan</option>
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
            <table id="tabelDaftar">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Bulan</th>
                        <th width="20%">Pos Posyandu</th>
                        <?php if(!empty($listMinggu)): ?>
                            <?php foreach($listMinggu as $minggu): ?>
                                <th><?= $minggu ?></th>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <th>Status Minggu</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php if(!empty($listCatleya)): ?>
                        <?php $no = 1; foreach($listCatleya as $posyandu): ?>
                        <tr class="data-row">
                            <td><?= $no++ ?></td>
                            <td><?= $bulanAktif ?? '-' ?></td>
                            <td class="fw-medium text-start">Catleya <?= $posyandu ?></td>
                            
                            <?php if(!empty($listMinggu)): ?>
                                <?php foreach($listMinggu as $minggu): ?>
                                    <td>
                                        <?php 
                                            // Normalisasi key posyandu
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
                                            <a href="<?= base_url('pelaporan-kader/view/' . $idLaporan) ?>">
                                                <i class="fa-solid fa-circle-check status-check"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('pelaporan-kader/input?bulan='.($bulanAktif ?? '').'&minggu='.$minggu.'&posyandu='.$posyandu) ?>">
                                                <i class="fa-solid fa-circle-xmark status-cross"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <td>-</td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="empty-row">
                            <td colspan="100%" class="text-center py-4 text-muted">
                                Data pelaporan tidak ditemukan atau silakan pilih Kelurahan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="bottom-section">
            <div id="pageInfo">Menampilkan 0 data</div>
            <div class="pagination-box">
                <button id="btnPrev" onclick="prevPage()" disabled>Previous</button>
                <button id="btnNext" onclick="nextPage()" disabled>Next</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title">Filter Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('pelaporan-kader/daftar') ?>" method="get">
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
                        <select name="kelurahan" id="kelurahanSelect" class="form-select">
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
                        <select name="posyandu" id="posyanduSelect" class="form-select">
                            <option value="">Pilih pos posyandu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2 fw-semibold">Bulan</label>
                        <select name="bulan" class="form-select">
                            <option value="">Pilih bulan</option>
                            <?php 
                            foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $b): 
                            ?>
                                <option value="<?= $b ?>" <?= ($bulanParam == $b) ? 'selected' : '' ?>><?= $b ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between mt-2">
                    <a href="<?= base_url('pelaporan-kader/daftar') ?>" class="btn btn-outline-danger">Reset</a>
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
    // 1. FUNGSI GANTI TAHUN
    function gantiTahun(offset) {
        const urlParams = new URLSearchParams(window.location.search);
        let currentYear = parseInt(document.getElementById('yearText').innerText);
        urlParams.set('tahun', currentYear + offset);
        window.location.search = urlParams.toString();
    }

    // 2. LOGIKA DROPDOWN POSYANDU BERDASARKAN KELURAHAN
    const dataPosyandu = {
        'Sumbersari': ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35'],
        'Wirolegi': ['36','36 A','37','38','39','40','41','42','43','44','44A','45','46','47','48','49','50','51','52','53','54'],
        'Karangrejo': ['75','76','77','78','78A','79','80','81','82','83','84','85','86','87','88','88A','89','90','91','92','92A','93','94','95','95A','95B'],
        'Tegalgede': ['68','69','70','71','72','73','74','74A','74B'],
        'Antirogo': ['55','56','57','58','58A','59','60','61','62','63','64','65','65A','66','67']
    };

    const kelurahanSelect = document.getElementById('kelurahanSelect');
    const posyanduSelect = document.getElementById('posyanduSelect');
    const selectedPosyanduParam = "<?= esc($posyanduParam) ?>"; 

    function populatePosyandu() {
        const kelurahanTerpilih = kelurahanSelect.value;
        posyanduSelect.innerHTML = '<option value="">Pilih pos posyandu</option>';
        if(kelurahanTerpilih !== "" && dataPosyandu[kelurahanTerpilih]) {
            dataPosyandu[kelurahanTerpilih].forEach(function(item) {
                let namaPosyandu = 'Catleya ' + item;
                let option = document.createElement('option');
                option.value = namaPosyandu;
                option.text = namaPosyandu;
                if(namaPosyandu === selectedPosyanduParam) {
                    option.selected = true;
                }
                posyanduSelect.appendChild(option);
            });
        }
    }
    kelurahanSelect.addEventListener('change', populatePosyandu);
    window.addEventListener('load', populatePosyandu);


    // 3. FUNGSI PAGINATION & SEARCH REAL-TIME
    let currentPage = 1;
    const rowsPerPage = 10;
    let allRows = [];
    let filteredRows = [];

    function initPagination() {
        allRows = Array.from(document.querySelectorAll('.data-row'));
        if(allRows.length === 0) return; // Jika tabel kosong
        filteredRows = [...allRows];
        renderTable();
    }

    function renderTable() {
        // Sembunyikan semua baris
        allRows.forEach(row => row.style.display = 'none');
        
        // Hitung index awal & akhir
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        
        // Tampilkan hanya baris di halaman aktif
        filteredRows.slice(start, end).forEach(row => row.style.display = '');
        
        // Update Teks Informasi Bawah
        const infoText = document.getElementById('pageInfo');
        if(filteredRows.length === 0) {
            infoText.innerText = 'Menampilkan 0 data';
        } else {
            infoText.innerText = `Menampilkan ${start + 1}-${Math.min(end, filteredRows.length)} dari ${filteredRows.length} data`;
        }
        
        // Update Tombol Prev/Next
        document.getElementById('btnPrev').disabled = currentPage === 1;
        document.getElementById('btnNext').disabled = end >= filteredRows.length;
    }

    function prevPage() { if(currentPage > 1) { currentPage--; renderTable(); } }
    function nextPage() { if((currentPage * rowsPerPage) < filteredRows.length) { currentPage++; renderTable(); } }

    document.getElementById('searchInput').addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();
        filteredRows = allRows.filter(row => row.innerText.toLowerCase().includes(keyword));
        currentPage = 1; // Reset ke halaman pertama setiap kali mencari
        renderTable();
    });

    // Jalankan Pagination saat halaman dimuat
    window.onload = initPagination;


    // 4. FUNGSI EXPORT EXCEL
    function exportToExcel(tableID, filename = 'Data_Laporan_Kader.xls') {
        let table = document.getElementById(tableID).cloneNode(true);

        // Penting: Kembalikan display semua baris yang disembunyikan oleh pagination agar ikut ter-export
        table.querySelectorAll('tr').forEach(tr => tr.style.display = '');

        table.querySelectorAll('tbody td').forEach(td => {
            if (td.querySelector('.fa-circle-check')) {
                td.innerHTML = '<span style="color: #008000; font-weight: bold;">Selesai</span>';
            } else if (td.querySelector('.fa-circle-xmark')) {
                td.innerHTML = '<span style="color: #ff0000;">Belum</span>';
            }
        });

        table.style.borderCollapse = 'collapse';
        table.style.fontFamily = 'Arial, sans-serif';
        table.style.fontSize = '11pt';
        table.style.width = '100%';

        table.querySelectorAll('th, td').forEach((cell, index) => {
            cell.style.border = '1px solid #000000';
            cell.style.padding = '8px';
            cell.style.verticalAlign = 'middle';

            if (cell.tagName.toLowerCase() === 'th') {
                cell.style.backgroundColor = '#4cc7c3';
                cell.style.color = '#ffffff';
                cell.style.fontWeight = 'bold';
                cell.style.textAlign = 'center';
            } else {
                cell.style.textAlign = (index === 2) ? 'left' : 'center';
            }
        });

        let html = `
            <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                  xmlns:x="urn:schemas-microsoft-com:office:excel" 
                  xmlns="http://www.w3.org/TR/REC-html40">
            <head><meta charset="UTF-8"></head>
            <body>${table.outerHTML}</body>
            </html>
        `;

        let blob = new Blob([html], { type: 'application/vnd.ms-excel' });
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