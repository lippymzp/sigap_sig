<?= $this->extend('layout/dashboard_layout_kepala') ?>
<?= $this->section('content') ?>

<?php
$grafik = isset($grafik) ? $grafik : [];
$dbd = isset($dbd) ? $dbd : [];

$detailDesa = isset($detailDesa)
    ? $detailDesa
    : [];

$desaTertinggi = isset($desaTertinggi)
    ? $desaTertinggi
    : '-';

$tahunSekarang = date('Y');
$penduduk = $penduduk ?? [];
?>

<style>
.custom-modal {
    display: none;
    position: fixed;
    z-index: 99999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    justify-content: center;
    align-items: center;
}

.custom-modal-content {
    background: #fff;
    width: 85%;
    max-width: 760px;
    border-radius: 20px;
    padding: 30px 35px;
    position: relative;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    max-height: 90vh;
    overflow-y: auto;
}

.close-modal {
    position: absolute;
    right: 25px;
    top: 12px;
    font-size: 30px;
    cursor: pointer;
    font-weight: bold;
    color: #444;
}

.close-modal:hover { color: #000; }

.modal-title {
    font-size: 20px;
    font-weight: 700;
    color: #222;
    margin-bottom: 18px;
}

.info-box {
    background: #f8f8f8;
    border-radius: 18px;
    padding: 25px 30px;
    border: 1px solid #e2e2e2;
}

.info-box h4 {
    font-size: 16px;
    margin: 0 0 14px 0;
    color: #222;
    font-weight: 700;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14.5px;
    color: #333;
}

.info-table tr td {
    padding: 6px 0;
    vertical-align: top;
    line-height: 1.6;
}

.info-table tr td.label {
    width: 45%;
    color: #2b2b2b;
}

.info-table tr td.colon {
    width: 18px;
    text-align: center;
    color: #555;
}

.info-table tr td.value {
    color: #111;
    font-weight: 500;
}

.info-table tr.sub td.label {
    padding-left: 28px;
    color: #444;
    font-weight: 400;
}

/* ================= GRAFIK ================= */
.slide-toggle-container {
    position: relative;
    display: flex;
    background: #fff;
    border: 1px solid #00BBC2; 
    border-radius: 35px;
    width: 100%;
    max-width: 400px;
    height: 45px;
    overflow: hidden;
    margin: 0 auto;
}

.btn-toggle {
    flex: 1;
    z-index: 2;
    background: transparent;
    border: none;
    font-weight: 800;
    color: #00BBC2;
    cursor: pointer;
    transition: color 0.3s ease;
    font-size: 14px;
}

.btn-toggle.active {
    color: #fff;
}

.slide-indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 33.33%;
    height: 100%;
    background: #00BBC2;
    border-radius: 30px;
    z-index: 1;
    transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

#chartWrapper canvas {
    width: 100% !important;
    height: 100% !important;
}

.filter-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
}

.filter-col {
    flex: 1;
    min-width: 140px;
    max-width: 180px;
}

.filter-label {
    font-weight: 900;
    font-size: 14px;
    margin-bottom: 8px;
}

.filter-rect {
    background: #ffffff;
    border-radius: 12px;
    padding: 6px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
}

.pill-select {
    background-color: #00BBC2;
    color: white;
    border-radius: 6px;
    border: none;
    padding: 8px 30px 8px 12px;
    font-weight: bold;
    width: 100%;
}

.kategori-tinggi { color: #dc3545; font-weight: 600; }
.kategori-sedang { color: #d39e00; font-weight: 600; }
.kategori-rendah { color: #28a745; font-weight: 600; }

.label-desa{ 
    background: rgba(0,0,0,0.6); 
    color: white; 
    border: none; 
    padding: 2px 6px; 
    font-size: 11px; 
    border-radius: 6px; 
}
/* ================= GRAFIK STYLE ================= */
.slide-toggle-container {
    position: relative;
    display: flex;
    background: #fff;
    border: 1px solid #00BBC2; 
    border-radius: 35px;
    width: 100%;
    max-width: 400px;
    height: 45px;
    overflow: hidden;
    margin: 0 auto;
}

.btn-toggle {
    flex: 1;
    z-index: 2;
    background: transparent;
    border: none;
    font-weight: 800;
    color: #00BBC2;
    cursor: pointer;
    transition: color 0.3s ease;
    font-size: 14px;
}

.btn-toggle.active {
    color: #fff;
}

.slide-indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 33.33%;
    height: 100%;
    background: #00BBC2;
    border-radius: 30px;
    z-index: 1;
    transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

#chartWrapper canvas {
    width: 100% !important;
    height: 100% !important;
}

.filter-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
}

.filter-col {
    flex: 1;
    min-width: 140px;
    max-width: 180px;
}

.filter-label {
    font-weight: 900;
    font-size: 14px;
    margin-bottom: 8px;
}

.filter-rect {
    background: #ffffff;
    border-radius: 12px;
    padding: 6px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
}

.pill-select {
    background-color: #00BBC2;
    color: white;
    border-radius: 6px;
    border: none;
    padding: 8px 30px 8px 12px;
    font-weight: bold;
    width: 100%;
}
.info-table tr.important-row td {
    background: #f0fdfa;
    font-weight: 800;
    color: #0f172a;
    padding-top: 12px;
    padding-bottom: 12px;
    border-top: 1px solid #99f6e4;
    border-bottom: 1px solid #99f6e4;
}

.info-table tr.important-row td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.info-table tr.important-row td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

.info-table tr.important-row .value {
    font-size: 16px;
    font-weight: 900;
    text-transform: capitalize;
}
/* ================= LEGEND MAP ================= */
.map-wrapper{
    width: 100%;
    overflow: hidden;
    border-radius: 18px;
}

.legend-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:18px;
    margin-top:22px;
    flex-wrap:wrap;
}

.legend-item{
    display:flex;
    align-items:center;
    gap:10px;
    background:#ffffff;
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:10px 22px;
    font-size:15px;
    font-weight:600;
    color:#222;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
    transition:0.2s ease;
}

.legend-item:hover{
    transform:translateY(-2px);
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.legend-color{
    width:18px;
    height:18px;
    border-radius:5px;
    display:inline-block;
}

.tinggi{
    background:#dc3545;
}

.sedang{
    background:#ffc107;
}

.rendah{
    background:#28a745;
}
</style>

<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai KEPALA PUSKESMAS</h3>
        <p>Puskesmas Sumbersari, Jember</p>
    </div>

    <div class="welcome-icon">
        <img src="<?= base_url('img/World_Map.png') ?>" alt="map" style="width:280px; height:auto;">
    </div>

    <?php
    $db = \Config\Database::connect();
    $desa_diizinkan = ['sumbersari', 'wirolegi', 'antirogo', 'tegalgede', 'karangrejo'];

    // Total kasus dari database pasien
    $totalKasus = $db->table('pasien')
        ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
        ->where('pasien.id_penyakit', 1)
        ->whereIn('LOWER(REPLACE(wilayah.kelurahan," ",""))', $desa_diizinkan)
        ->countAllResults();

    // Kasus hari ini
    $kasusHariIni = $db->table('pasien')
        ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
        ->where('pasien.id_penyakit', 1)
        ->where('DATE(pasien.tgl_kunjungan)', date('Y-m-d'))
        ->whereIn('LOWER(REPLACE(wilayah.kelurahan," ",""))', $desa_diizinkan)
        ->countAllResults();

    // Kelurahan terdampak
    $kelurahanTerdampak = $db->table('pasien')
        ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
        ->select('COUNT(DISTINCT wilayah.kelurahan) as total')
        ->where('pasien.id_penyakit', 1)
        ->whereIn('LOWER(REPLACE(wilayah.kelurahan," ",""))', $desa_diizinkan)
        ->get()->getRow()->total;


    ?>
</div>

<div class="stat-row">
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-chart-column"></i></div>
        <div class="stat-info">
            <h3 class="red"><?= $totalKasus; ?></h3>
            <p>Total Kasus</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-arrow-up"></i>
            <i class="fa-solid fa-arrow-down"></i>
        </div>
        <div class="stat-info">
            <h3 class="green"><?= $kasusHariIni; ?></h3>
            <p>Kasus Baru Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-map"></i></div>
        <div class="stat-info">
            <h3 class="blue"><?= $kelurahanTerdampak; ?></h3>
            <p>Kelurahan Terdampak</p>
        </div>
    </div>
</div>

<div class="section-card">
    <div class="section-block">
        <div class="section-header">
            <div>
                <h5>Peta Interaktif Penyebaran & Hasil Pemantauan</h5>
                <p class="sub">Visualisasi kepadatan kasus serta Angka Bebas Jentik (ABJ) per wilayah</p>
            </div>
            <div class="filter" style="display:flex; gap:10px; align-items:center;">
                <span>Periode Peta:</span>
                <select id="bulanMap" onchange="updateMap()">
                    <option value="">Semua Bulan</option>
                    <?php
                    $bulanDipilih = $_GET['bulan_map'] ?? '';
                    $namaBulan = [
                        1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April',
                        5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus',
                        9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
                    ];
                    foreach($namaBulan as $id => $nama):
                    ?>
                        <option value="<?= $id ?>" <?= ($bulanDipilih == $id ? 'selected' : '') ?>><?= $nama ?></option>
                    <?php endforeach; ?>
                </select>

                <?php $tahunMapDipilih = $_GET['tahun_map'] ?? $tahunSekarang; ?>
                <select id="periodeMap" onchange="updateMap()">
                    <?php for($t = 2024; $t <= $tahunSekarang; $t++): ?>
                        <option value="<?= $t ?>" <?= ($t == $tahunMapDipilih ? 'selected' : '') ?>><?= $t ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="inner-card">

    <div class="map-wrapper">
        <div id="map" style="height: 450px; border-radius: 18px;"></div>
    </div>

    <!-- LEGEND -->
    <div class="legend-wrapper">

        <div class="legend-item">
            <span class="legend-color tinggi"></span>
            <span>Tinggi</span>
        </div>

        <div class="legend-item">
            <span class="legend-color sedang"></span>
            <span>Sedang</span>
        </div>

        <div class="legend-item">
            <span class="legend-color rendah"></span>
            <span>Rendah</span>
        </div>

    </div>

    <div style="margin-top:30px; margin-bottom:30px; padding-bottom: 30px; padding-right:30px; text-align:right;">
                <button onclick="openPendudukModal()" style="background:#00BBC2; color:white; border:none; padding:12px 18px; border-radius:10px; font-weight:600; cursor:pointer;">
                    <i class="fa-solid fa-users"></i> Lihat Data Penduduk Wilayah
                </button>
            </div>
        </div>
    </div>
</div>

<div id="pendudukModal" class="custom-modal">
    <div class="custom-modal-content" style="max-width:900px;">
        <span class="close-modal" onclick="closePendudukModal()">&times;</span>
        <div class="modal-title">Data Acuan Penduduk Wilayah</div>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kelurahan</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Total Kepadatan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $list_kelurahan = ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo'];
                foreach($list_kelurahan as $nama_kel): 
                    $jml_laki = 0;
                    $jml_perempuan = 0;
                    foreach($penduduk as $p) {
                        if($p['kelurahan'] == $nama_kel) {
                            if($p['jenis_kelamin'] == 'Laki-laki') $jml_laki = $p['total_penduduk'];
                            if($p['jenis_kelamin'] == 'Perempuan') $jml_perempuan = $p['total_penduduk'];
                        }
                    }
                ?>
                <tr>
                    <td><?= $nama_kel ?></td>
                    <td><?= $jml_laki ?></td>
                    <td><?= $jml_perempuan ?></td>
                    <td><strong><?= $jml_laki + $jml_perempuan ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>            
    </div>
</div>

<div id="detailModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close-modal" onclick="closeDetailModal()">&times;</span>
        <div class="modal-title">Detail Wilayah Sebaran Kasus <span id="modalTahun"><?= $tahunSekarang ?></span></div>

        <div class="info-box">
            <h4>Informasi Capaian Wilayah :</h4>
            <table class="info-table">
                <tr>
                    <td class="label">Nama Kelurahan</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalNama">-</td>
                </tr>
                <tr>
                    <td class="label">Jumlah Penduduk</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalPenduduk">-</td>
                </tr>
                <tr>
                    <td class="label">Jumlah Kasus Terdata</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalKasus">-</td>
                </tr>
                <tr class="sub">
                    <td class="label">Sembuh</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalSembuh">0</td>
                </tr>
                <tr class="sub">
                    <td class="label">Meninggal</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalMeninggal">0</td>
                </tr>
<tr class="important-row">
    <td class="label">Kategori Status Kerawanan</td>
    <td class="colon">:</td>
    <td class="value" id="modalKategori">-</td>
</tr>
                <tr>
                    <td class="label">Distribusi Rentang Usia Kasus</td>
                    <td class="colon">:</td>
                    <td class="value"></td>
                </tr>
                <tr class="sub">
                    <td class="label">Bayi & Anak-anak (0-6 Thn)</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalAnak">0</td>
                </tr>
                <tr class="sub">
                    <td class="label">Sekolah & Remaja (7-18 Thn)</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalRemaja">0</td>
                </tr>
                <tr class="sub">
                    <td class="label">Dewasa (19-59 Thn)</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalDewasa">0</td>
                </tr>
<tr class="sub">
    <td class="label">Lansia (>=60 Thn)</td>
    <td class="colon">:</td>
    <td class="value" id="modalLansia">0</td>
</tr>

<tr>
    <td class="label">Rentang usia dengan kasus tertinggi</td>
    <td class="colon">:</td>
    <td class="value" id="modalUsiaTertinggi">-</td>
</tr>

<tr>
    <td class="label">Desa dengan kasus tertinggi</td>
    <td class="colon">:</td>
    <td class="value" id="modalDesaTertinggi">-</td>
</tr>

<tr>
    <td class="label">Rentang Jenis Kelamin Kasus</td>
    <td class="colon">:</td>
    <td class="value" id="modalJkTotal">0</td>
</tr>
                <tr class="sub">
                    <td class="label">Laki-laki</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalLaki">0</td>
                </tr>
                <tr class="sub">
                    <td class="label">Perempuan</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalPerempuan">0</td>
                </tr>
                <tr>
                    <td class="label">Total Rumah Diperiksa (Kader)</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalRumahPeriksa">0</td>
                </tr>
                <tr>
                    <td class="label">Rumah Positif Jentik Nyamuk</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalRumahJentik">0</td>
                </tr>
                <tr class="sub" style="background:#e8ffff; font-weight:bold;">
                    <td class="label">Angka Bebas Jentik (ABJ) Target >=95%</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalAbj">0%</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<section id="grafik" class="container mt-5 mb-5 p-0">
    <h4 id="titleGrafik" class="text-dark mb-4 fw-bold">Grafik Kasus DBD</h4>

    <div class="bg-white shadow-sm" style="border-radius: 30px; border: 1px solid #eee; padding: 40px 30px;">
        
        <div class="d-flex justify-content-center mb-5">
            <div class="slide-toggle-container">
                <div id="slideIndicator" class="slide-indicator"></div>
<?php $tabAktif = $_GET['tab'] ?? 'kasus'; ?>

<button 
    type="button" 
    class="btn-toggle <?= $tabAktif == 'kasus' ? 'active' : '' ?>" 
    id="tabKasus" 
    onclick="switchTab('kasus')">
    KASUS
</button>

<button 
    type="button" 
    class="btn-toggle <?= $tabAktif == 'mortalitas' ? 'active' : '' ?>" 
    id="tabMortalitas" 
    onclick="switchTab('mortalitas')">
    MORTALITAS
</button>

<button 
    type="button" 
    class="btn-toggle <?= $tabAktif == 'abj' ? 'active' : '' ?>" 
    id="tabABJ" 
    onclick="switchTab('abj')">
    ABJ
</button>
            </div>
        </div>

        <form method="get" id="filterForm" action="<?= current_url() ?>#grafik">
            <input type="hidden" name="tab" id="activeTabInput" value="<?= $_GET['tab'] ?? 'kasus' ?>">
            <input type="hidden" name="tahun_map" value="<?= $_GET['tahun_map'] ?? '' ?>">

            <div id="wrapperKasus" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'kasus' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <select name="wilayah" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <option value="Antirogo" <?= request()->getGet('wilayah') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                <option value="Sumbersari" <?= request()->getGet('wilayah') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                <option value="Karangrejo" <?= request()->getGet('wilayah') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                <option value="Tegalgede" <?= request()->getGet('wilayah') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                <option value="Wirolegi" <?= request()->getGet('wilayah') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">USIA</label>
                        <div class="filter-rect">
                            <select name="usia" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <option value="anak" <?= request()->getGet('usia') == 'anak' ? 'selected' : '' ?>>Bayi dan Anak Pra-sekolah (0–6 Tahun)</option>
                                <option value="remaja" <?= request()->getGet('usia') == 'remaja' ? 'selected' : '' ?>>Anak Sekolah dan Remaja (>6–18 Tahun)</option>
                                <option value="dewasa" <?= request()->getGet('usia') == 'dewasa' ? 'selected' : '' ?>>Dewasa (>18–59 Tahun)</option>
                                <option value="lansia" <?= request()->getGet('usia') == 'lansia' ? 'selected' : '' ?>>Lansia (≥60 Tahun)</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">JENIS KELAMIN</label>
                        <div class="filter-rect">
                            <select name="jk" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <option value="L" <?= request()->getGet('jk') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= request()->getGet('jk') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">BULAN</label>
                        <div class="filter-rect">
                            <select name="bulan" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <?php $bulanList = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember']; ?>
                                <?php foreach($bulanList as $k => $v): ?>
                                    <option value="<?= $k ?>" <?= request()->getGet('bulan') == $k ? 'selected' : '' ?>><?= $v ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <select name="tahun" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                    <option value="<?= $t ?>" <?= request()->getGet('tahun') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div id="wrapperMortalitas" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'mortalitas' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <select name="wilayah_mort" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <option value="Antirogo" <?= request()->getGet('wilayah_mort') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                <option value="Sumbersari" <?= request()->getGet('wilayah_mort') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                <option value="Karangrejo" <?= request()->getGet('wilayah_mort') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                <option value="Tegalgede" <?= request()->getGet('wilayah_mort') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                <option value="Wirolegi" <?= request()->getGet('wilayah_mort') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">JENIS KELAMIN</label>
                        <div class="filter-rect">
                            <select name="jk_mort" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <option value="L" <?= request()->getGet('jk_mort') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= request()->getGet('jk_mort') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <select name="tahun_mort" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                    <option value="<?= $t ?>" <?= request()->getGet('tahun_mort') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div id="wrapperABJ" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'abj' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <select name="wilayah_abj" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <option value="Antirogo" <?= request()->getGet('wilayah_abj') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                <option value="Sumbersari" <?= request()->getGet('wilayah_abj') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                <option value="Karangrejo" <?= request()->getGet('wilayah_abj') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                <option value="Tegalgede" <?= request()->getGet('wilayah_abj') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                <option value="Wirolegi" <?= request()->getGet('wilayah_abj') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">BULAN</label>
                        <div class="filter-rect">
                            <select name="bulan_abj" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <?php foreach($bulanList as $k => $v): ?>
                                    <option value="<?= $k ?>" <?= request()->getGet('bulan_abj') == $k ? 'selected' : '' ?>><?= $v ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <select name="tahun_abj" class="pill-select" onchange="submitGrafikForm()">
                                <option value="">All</option>
                                <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                    <option value="<?= $t ?>" <?= request()->getGet('tahun_abj') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div id="chartWrapper" style="position: relative; height: 350px;">
                <canvas id="chartKasus" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'kasus' ? 'block' : 'none' ?>;"></canvas>
                <canvas id="chartMortalitas" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'mortalitas' ? 'block' : 'none' ?>;"></canvas>
                <canvas id="chartABJ" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'abj' ? 'block' : 'none' ?>;"></canvas>
            </div>
        </form>
    </div>
</section>
<?php
$db = \Config\Database::connect();

$reqBulanABJ   = $_GET['bulan_abj'] ?? '';
$reqTahunABJ   = $_GET['tahun_abj'] ?? '';
$reqWilayahABJ = $_GET['wilayah_abj'] ?? '';

$bulanMapABJ = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];

$labelKelurahanABJ = [
    'sumbersari' => 'Sumbersari',
    'wirolegi'   => 'Wirolegi',
    'antirogo'   => 'Antirogo',
    'tegalgede'  => 'Tegal Gede',
    'karangrejo' => 'Karangrejo'
];

$dataFinalABJ = [
    'Sumbersari' => [null, null, null, null],
    'Wirolegi'   => [null, null, null, null],
    'Antirogo'   => [null, null, null, null],
    'Tegal Gede' => [null, null, null, null],
    'Karangrejo' => [null, null, null, null]
];

$exprKelurahanABJ = "LOWER(REGEXP_REPLACE(TRIM(kelurahan), '[^a-zA-Z0-9]', ''))";

$builderABJTrend = $db->table('rekap_pelaporan_kader');

$builderABJTrend->select("
    $exprKelurahanABJ AS key_kelurahan,
    minggu,
    AVG(abj) AS avg_abj
", false);

$builderABJTrend->where(
    "$exprKelurahanABJ IN ('sumbersari', 'wirolegi', 'antirogo', 'tegalgede', 'karangrejo')",
    null,
    false
);

if (!empty($reqWilayahABJ)) {
    $keyWilayahABJ = preg_replace('/[^a-z0-9]/', '', strtolower($reqWilayahABJ));

    $builderABJTrend->where(
        "$exprKelurahanABJ = " . $db->escape($keyWilayahABJ),
        null,
        false
    );
}

if (!empty($reqBulanABJ) && isset($bulanMapABJ[(int)$reqBulanABJ])) {
    $builderABJTrend->where('bulan', $bulanMapABJ[(int)$reqBulanABJ]);
}

if (!empty($reqTahunABJ)) {
    $builderABJTrend->like('periode_lengkap', $reqTahunABJ);
}

$builderABJTrend->groupBy("$exprKelurahanABJ, minggu", false);

$rawABJTrend = $builderABJTrend->get()->getResultArray();

foreach ($rawABJTrend as $row) {
    $keyKelurahan = $row['key_kelurahan'] ?? '';
    $labelKel     = $labelKelurahanABJ[$keyKelurahan] ?? null;

    if (!$labelKel) {
        continue;
    }

    if (preg_match('/(\d+)/', (string) $row['minggu'], $matches)) {
        $indexMinggu = ((int) $matches[1]) - 1;

        if ($indexMinggu >= 0 && $indexMinggu <= 3) {
            $dataFinalABJ[$labelKel][$indexMinggu] = round((float) $row['avg_abj'], 2);
        }
    }
}

if (!empty($reqWilayahABJ)) {
    $keyWilayahABJ = preg_replace('/[^a-z0-9]/', '', strtolower($reqWilayahABJ));
    $labelFilterABJ = $labelKelurahanABJ[$keyWilayahABJ] ?? null;

    if ($labelFilterABJ && isset($dataFinalABJ[$labelFilterABJ])) {
        $dataFinalABJ = [
            $labelFilterABJ => $dataFinalABJ[$labelFilterABJ]
        ];
    }
}
?>
<script>
function openPendudukModal() { document.getElementById("pendudukModal").style.display = "flex"; }
function closePendudukModal() { document.getElementById("pendudukModal").style.display = "none"; }

function fixNama(nama){
    return (nama || "").toLowerCase().trim().replace(/[^a-z0-9]/g, "");
}

var aliasDesa = {
    "kemuningsarilor": "kemuning sari lor",
    "tegalgede": "tegalgede",
    "tegalgedei": "tegalgede"
};

var dataDBD = <?= json_encode(isset($dbd) ? $dbd : []) ?>;
var detailDesa = <?= json_encode(isset($detailDesa) ? $detailDesa : []) ?>;
var dataGrafikPHP = <?= json_encode(isset($grafik) ? $grafik : []) ?>; // Data grafik dari controller
var activeTabPHP = <?= json_encode($_GET['tab'] ?? 'kasus') ?>; // Mengambil tab aktif
var tahunSekarang = <?= json_encode($tahunSekarang) ?>;
var desaTertinggi = <?= json_encode($desaTertinggi ?? '-') ?>;
var dataFinal = {};

dataDBD.forEach(item => {
    var desa = fixNama(item.desa);
    if(aliasDesa[desa]) desa = aliasDesa[desa];

    if(!dataFinal[desa]){
        dataFinal[desa] = { total: 0, jumlah: 0 };
    }
    dataFinal[desa].total += parseInt(item.kasus || 0);
    dataFinal[desa].jumlah++;
});

/* HITUNG KATEGORI RISIKO KELURAHAN SECARA DINAMIS */
for (var key in detailDesa) {
    let d = detailDesa[key];
    let kasus = parseInt(d.jumlah_kasus ?? 0);
    let penduduk = parseInt(d.jumlah_penduduk ?? 0);
    let meninggal = parseInt(d.meninggal ?? 0);
    let abj = parseFloat(d.abj ?? 0);
    let rumahDiperiksa = parseInt(d.rumah_diperiksa ?? 0);

    let ir = 0;
    let cfr = 0;

    if (kasus === 0 || penduduk === 0 || rumahDiperiksa === 0 || abj === 0) {
        detailDesa[key].kategori = "Belum ada Data";
    } else {
        ir = (kasus / penduduk) * 100000;
        if (kasus > 0) {
            cfr = (meninggal / kasus) * 100;
        }

        let indikatorBaik = 0;
        if (ir <= 10) indikatorBaik++;
        if (cfr < 1) indikatorBaik++;
        if (abj >= 95) indikatorBaik++;

        if (indikatorBaik === 3) {
            detailDesa[key].kategori = "rendah";
        } else if (indikatorBaik === 1 || indikatorBaik === 2) {
            detailDesa[key].kategori = "sedang";
        } else {
            detailDesa[key].kategori = "tinggi";
        }
    }
    detailDesa[key].ir = ir.toFixed(2);
    detailDesa[key].cfr = cfr.toFixed(2);
}

document.addEventListener("DOMContentLoaded", function() {
    /* ==========================================
       1. INISIALISASI PETA LEAFLET
       ========================================== */
    var map = L.map('map').setView([-8.12, 113.72], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    /* MEMUAT BOUNDARY GEOJSON */
    fetch("<?= base_url('assets/peta/db.geojson') ?>")
    .then(res => res.json())
    .then(data => {
        var geo = L.geoJSON(data, {
            style: function(feature){
                var nama = fixNama(feature.properties.NAMOBJ);
                if(aliasDesa[nama]) nama = aliasDesa[nama];
                var detail = detailDesa[nama] || {};
                var warna = "#cccccc";

                if(detail.kategori == "tinggi") warna = "#dc3545";
                else if(detail.kategori == "sedang") warna = "#ffc107";
                else if(detail.kategori == "rendah") warna = "#28a745";

                return { color: "#00CED1", weight: 2, fillColor: warna, fillOpacity: 0.7 };
            },
            onEachFeature: function(feature, layer){
                var namaAsli = feature.properties.NAMOBJ || "Kelurahan";
                var namaFix  = fixNama(namaAsli);
                if(aliasDesa[namaFix]) namaFix = aliasDesa[namaFix];

                var item = dataFinal[namaFix];
                var isi = "<div style='min-width:220px;'><b>Kelurahan: " + namaAsli + "</b>";

                if(item || detailDesa[namaFix]){
                    var detail = detailDesa[namaFix] || {};
                    var kategori = detail.kategori || 'Belum ada Data';
                    isi += "<br>Total Kasus: " + (detail.jumlah_kasus ?? 0);
                    isi += "<br>ABJ Wilayah: " + (detail.abj ?? 0) + "%";
                    isi += "<br>Kategori: " + kategori;
                    isi += `<br><br><button onclick="showDetailPopup('${namaFix}','${namaAsli}')" style="background:#00BBC2; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer; font-weight:600; width:100%;">Selengkapnya</button>`;
                } else {
                    isi += "<br>Belum ada data pelaporan terintegrasi.";
                }
                isi += "</div>";
                layer.bindPopup(isi);
                layer.bindTooltip(namaAsli, { permanent: true, direction: "center", className: "label-desa" });
            }
        }).addTo(map);
        map.fitBounds(geo.getBounds());
    }).catch(err => console.error("Gagal memuat peta GeoJSON:", err));

/* ==========================================
   2. INISIALISASI CHART.JS (RENDERING GRAFIK)
   ========================================== */

var namaBulanLabel = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
var warnaDesa = {
    'Sumbersari' : '#00BBC2',
    'Wirolegi'   : '#3B82F6',
    'Antirogo'   : '#1E293B',
    'Tegal Gede' : '#22C55E',
    'Karangrejo' : '#A7F3D0'
};

// ---- TAB KASUS (Bar per wilayah) ----
if (true) {
    document.getElementById("titleGrafik").innerText = "Grafik Distribusi Kasus DBD Berdasarkan Kelompok Usia";

    var labelsKasus = [];
    var ds1 = [], ds2 = [], ds3 = [], ds4 = [];

    dataGrafikPHP.forEach(row => {
        labelsKasus.push(row.wilayah);
        ds1.push(parseInt(row.anak || 0));
        ds2.push(parseInt(row.remaja || 0));
        ds3.push(parseInt(row.dewasa || 0));
        ds4.push(parseInt(row.lansia || 0));
    });

    const usiaFilter = "<?= request()->getGet('usia') ?>";

    const warnaUsiaKasus = {
        anak: '#0F766E',
        remaja: '#06B6D4',
        dewasa: '#7DD3FC',
        lansia: '#14B8A6'
    };

    const labelUsiaKasus = {
        anak: 'Bayi dan Anak Pra-sekolah (0–6 Tahun)',
        remaja: 'Anak Sekolah dan Remaja (>6–18 Tahun)',
        dewasa: 'Dewasa (>18–59 Tahun)',
        lansia: 'Lansia (≥60 Tahun)'
    };

    let datasetsKasus = [];

    if (usiaFilter === 'anak') {
        datasetsKasus.push({
            label: labelUsiaKasus.anak,
            data: ds1,
            backgroundColor: warnaUsiaKasus.anak
        });

    } else if (usiaFilter === 'remaja') {
        datasetsKasus.push({
            label: labelUsiaKasus.remaja,
            data: ds2,
            backgroundColor: warnaUsiaKasus.remaja
        });

    } else if (usiaFilter === 'dewasa') {
        datasetsKasus.push({
            label: labelUsiaKasus.dewasa,
            data: ds3,
            backgroundColor: warnaUsiaKasus.dewasa
        });

    } else if (usiaFilter === 'lansia') {
        datasetsKasus.push({
            label: labelUsiaKasus.lansia,
            data: ds4,
            backgroundColor: warnaUsiaKasus.lansia
        });

    } else {
        datasetsKasus = [
            {
                label: labelUsiaKasus.anak,
                data: ds1,
                backgroundColor: warnaUsiaKasus.anak
            },
            {
                label: labelUsiaKasus.remaja,
                data: ds2,
                backgroundColor: warnaUsiaKasus.remaja
            },
            {
                label: labelUsiaKasus.dewasa,
                data: ds3,
                backgroundColor: warnaUsiaKasus.dewasa
            },
            {
                label: labelUsiaKasus.lansia,
                data: ds4,
                backgroundColor: warnaUsiaKasus.lansia
            }
        ];
    }

    new Chart(document.getElementById('chartKasus').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labelsKasus,
            datasets: datasetsKasus
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                        font: {
                            size: 13,
                            weight: '600'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    cornerRadius: 12,
                    padding: 12
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        padding: 8
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        padding: 10
                    }
                }
            },
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            }
        }
    });
}

// ---- TAB MORTALITAS (Line per bulan per wilayah) ----
// --- GRAFIK MORTALITAS ---
if (true) {
    const rawMort = <?= json_encode(isset($grafikMortalitas) ? $grafikMortalitas : []) ?>;

    const colorMapping = {
        'Antirogo': '#1f4e5b',
        'Sumbersari': '#00BBC2',
        'Karangrejo': '#b2dfdb',
        'Tegalgede': '#5cb85c',
        'Wirolegi': '#4fc3f7'
    };

    const dataFinalMort = {
        'Sumbersari': new Array(12).fill(0),
        'Wirolegi': new Array(12).fill(0),
        'Antirogo': new Array(12).fill(0),
        'Tegalgede': new Array(12).fill(0),
        'Karangrejo': new Array(12).fill(0)
    };

    rawMort.forEach(row => {
        let desa = row.wilayah || row.kelurahan || '';
        let bulan = parseInt(row.bulan_angka || row.bulan) - 1;
        let val = parseInt(row.meninggal || row.total_meninggal || 0);

        desa = desa.trim();

        if (desa.toLowerCase().replace(/\s/g, '') === 'tegalgede') {
            desa = 'Tegalgede';
        } else {
            desa = desa.charAt(0).toUpperCase() + desa.slice(1).toLowerCase();
        }

        if (dataFinalMort[desa] && bulan >= 0 && bulan <= 11) {
            dataFinalMort[desa][bulan] = val;
        }
    });

    let datasetsMort = [];

    for (const kelurahan in dataFinalMort) {
        datasetsMort.push({
            label: kelurahan,
            data: dataFinalMort[kelurahan],
            borderColor: colorMapping[kelurahan] || '#333',
            backgroundColor: colorMapping[kelurahan] || '#333',
            fill: false,
            tension: 0,
            pointRadius: 4,
            pointHoverRadius: 6,
            borderWidth: 2,
            spanGaps: true
        });
    }

    new Chart(document.getElementById('chartMortalitas').getContext('2d'), {
        type: 'line',
        data: {
            labels: [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            datasets: datasetsMort
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8
                    }
                }
            },
            scales: {
                y: {
                    min: 0,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        borderDash: [5, 5]
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}

// ---- TAB ABJ (Bar per wilayah) ----
// ---- TAB ABJ (Line Trend per Minggu) ----
if (true) {
    document.getElementById("titleGrafik").innerText = "Grafik Tren Angka Bebas Jentik (ABJ) per Minggu";

    const rawDataABJ = <?= json_encode($dataFinalABJ) ?>;

    const datasetsABJ = [];

    Object.keys(rawDataABJ).forEach(kelurahan => {
        datasetsABJ.push({
            label: kelurahan,
            data: rawDataABJ[kelurahan],
            borderColor: warnaDesa[kelurahan] || '#333',
            backgroundColor: warnaDesa[kelurahan] || '#333',
            fill: false,
            tension: 0.2,
            pointRadius: 5,
            pointHoverRadius: 7,
            borderWidth: 2,
            spanGaps: true
        });
    });

    new Chart(document.getElementById('chartABJ').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: datasetsABJ
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8,
                        padding: 18
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.raw;

                            if (value === null || value === undefined) {
                                return context.dataset.label + ': Tidak ada data';
                            }

                            return context.dataset.label + ': ' + value + '%';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    min: 0,
                    max: 100,
                    ticks: {
                        stepSize: 25,
                        callback: function(value) {
                            return value + '%';
                        }
                    },
                    grid: {
                        color: '#e5e5e5'
                    }
                }
            }
        }
    });
}
switchTab(activeTabPHP);
});

function showDetailPopup(namaFix, namaAsli){
    var d = detailDesa[namaFix] || {};
    var kategori = d.kategori || '-';
    var kategoriCls = '';
    
    if(kategori.toLowerCase() === 'tinggi') kategoriCls = 'kategori-tinggi';
    else if(kategori.toLowerCase() === 'sedang') kategoriCls = 'kategori-sedang';
    else if(kategori.toLowerCase() === 'rendah') kategoriCls = 'kategori-rendah';

    document.getElementById("modalNama").innerText = namaAsli;
    document.getElementById("modalPenduduk").innerText = d.jumlah_penduduk ?? 0;
    document.getElementById("modalKasus").innerText = d.jumlah_kasus ?? 0;
    document.getElementById("modalSembuh").innerText = d.sembuh ?? 0;
    document.getElementById("modalMeninggal").innerText = d.meninggal ?? 0;
    
    var elKat = document.getElementById("modalKategori");
    elKat.innerText = (kategori.charAt(0).toUpperCase() + kategori.slice(1));
    elKat.className = 'value ' + kategoriCls;

    document.getElementById("modalAnak").innerText = d.anak ?? 0;
    document.getElementById("modalRemaja").innerText = d.remaja ?? 0;
    document.getElementById("modalDewasa").innerText = d.dewasa ?? 0;
    document.getElementById("modalLansia").innerText = d.lansia ?? 0;
    document.getElementById("modalUsiaTertinggi").innerText = d.usia_tertinggi || '-';
document.getElementById("modalDesaTertinggi").innerText = desaTertinggi || '-';

    var lk = parseInt(d.laki ?? 0);
    var pr = parseInt(d.perempuan ?? 0);
    document.getElementById("modalJkTotal").innerText = (lk + pr);
    document.getElementById("modalLaki").innerText = lk;
    document.getElementById("modalPerempuan").innerText = pr;

    document.getElementById("modalRumahPeriksa").innerText = d.rumah_diperiksa ?? 0;
    document.getElementById("modalRumahJentik").innerText = d.rumah_positif ?? d.rumah_jentik ?? 0;
    document.getElementById('modalAbj').innerText = (d.abj ?? 0) + '%';

    document.getElementById("detailModal").style.display = "flex";
}

function closeDetailModal(){ document.getElementById("detailModal").style.display = "none"; }
function updateMap(){
    var b = document.getElementById("bulanMap").value;
    var t = document.getElementById("periodeMap").value;
    window.location.href = "?bulan_map=" + b + "&tahun_map=" + t;
}

/* LOGIKA DRIVEN GRAFIK SWITCH */
/* LOGIKA DRIVEN GRAFIK SWITCH */
function switchTab(type) {
    const indicator = document.getElementById('slideIndicator');
    const tabKasus = document.getElementById('tabKasus');
    const tabMortalitas = document.getElementById('tabMortalitas');
    const tabABJ = document.getElementById('tabABJ');
    const title = document.getElementById('titleGrafik');
    const input = document.getElementById('activeTabInput');

    const wrapKasus = document.getElementById('wrapperKasus');
    const wrapMortalitas = document.getElementById('wrapperMortalitas');
    const wrapABJ = document.getElementById('wrapperABJ');

    const chartK = document.getElementById('chartKasus');
    const chartM = document.getElementById('chartMortalitas');
    const chartA = document.getElementById('chartABJ');

    input.value = type;

    tabKasus.classList.remove('active');
    tabMortalitas.classList.remove('active');
    tabABJ.classList.remove('active');

    wrapKasus.style.display = 'none';
    wrapMortalitas.style.display = 'none';
    wrapABJ.style.display = 'none';

    chartK.style.display = 'none';
    chartM.style.display = 'none';
    chartA.style.display = 'none';

    if (type === 'kasus') {
        title.innerText = 'Grafik Distribusi Kasus DBD Berdasarkan Kelompok Usia';
        indicator.style.transform = 'translateX(0%)';
        tabKasus.classList.add('active');
        wrapKasus.style.display = 'block';
        chartK.style.display = 'block';
    } else if (type === 'mortalitas') {
        title.innerText = 'Grafik Kematian / Mortalitas DBD';
        indicator.style.transform = 'translateX(100%)';
        tabMortalitas.classList.add('active');
        wrapMortalitas.style.display = 'block';
        chartM.style.display = 'block';
    } else if (type === 'abj') {
        title.innerText = 'Grafik Tren Angka Bebas Jentik (ABJ) per Minggu';
        indicator.style.transform = 'translateX(200%)';
        tabABJ.classList.add('active');
        wrapABJ.style.display = 'block';
        chartA.style.display = 'block';
    }
}
function submitGrafikForm() {
    const form = document.getElementById("filterForm");
    const formData = new FormData(form);
    const params = new URLSearchParams();

    formData.forEach(function(value, key) {
        if (value !== null && value !== "") {
            params.append(key, value);
        }
    });

    window.location.href = "<?= current_url() ?>?" + params.toString() + "#grafik";
}
document.addEventListener("DOMContentLoaded", function(){

    const footerDesc = document.querySelector(".footer-desc");

    if(footerDesc){

        footerDesc.insertAdjacentHTML("afterend", `
        
            <div class="cynex-info mt-4">

                <h3 style="
                    color:#fff;
                    font-weight:700;
                    font-size:2rem;
                    margin-bottom:12px;
                    line-height:1;
                ">
                    AIGON
                </h3>

                <p style="
                    color:#E8FFFF;
                    font-size:1.1rem;
                    line-height:1.8;
                    margin-bottom:0;
                ">
                    Gerak Cepat, Solusi Tepat 
                </p>

            </div>

        `);

    }
});
</script>
<?= $this->endSection() ?>