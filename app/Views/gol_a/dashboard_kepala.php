<?php
$tahunMap = $tahunMap ?? [
    2020 => '2020',
    2021 => '2021',
    2022 => '2022',
    2023 => '2023',
    2024 => '2024',
    2025 => '2025',
];
?>

<?= $this->extend('layout/dashboard_layout_kepala'); ?>

<?= $this->section('style'); ?>
<style>
/* --- STYLE MODAL DETAIL --- */
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

.info-table tr td.label { width: 45%; color: #2b2b2b; }
.info-table tr td.colon { width: 18px; text-align: center; }
.info-table tr td.value { color: #111; font-weight: 500; }
.info-table tr.sub td.label { padding-left: 28px; color: #444; }

.kategori-tinggi { color: #dc3545; font-weight: 600; }
.kategori-sedang { color: #d39e00; font-weight: 600; }
.kategori-rendah { color: #28a745; font-weight: 600; }

/* --- STYLE MAP LABEL --- */
.label-desa {
    background: rgba(0,0,0,0.6);
    color: white;
    border: none;
    padding: 2px 6px;
    font-size: 11px;
    border-radius: 6px;
}

/* --- SLIDE TOGGLE STYLING --- */
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
.btn-toggle.active { color: #fff; }
.slide-indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 33.33%; /* Diubah ke 33.33% karena ada 3 tombol */
    height: 100%;
    background: #00BBC2;
    border-radius: 30px;
    z-index: 1;
    transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

/* --- FILTER DESAIN --- */
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
    color: #000;
    font-size: 14px;
    margin-bottom: 8px;
    display: block;
}
.filter-rect {
    background: #ffffff;
    border-radius: 12px;
    padding: 6px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
    width: 100%;
}
.pill-select-wrapper {
    position: relative;
    width: 100%;
}
.pill-select {
    background-color: #00BBC2;
    color: white;
    border-radius: 6px;
    border: none;
    padding: 8px 30px 8px 12px;
    font-weight: bold;
    width: 100%;
    appearance: none;
    cursor: pointer;
    font-size: 13px;
}
.arrow-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    font-size: 12px;
    pointer-events: none;
}

#chartWrapper canvas {
    width: 100% !important;
    height: 100% !important;
}

/* ================= RESPONSIVE FIX GLOBAL ================= */

/* ===== TABLET ===== */
@media (max-width: 1024px) {
    .welcome-box { flex-direction: column; align-items: flex-start; gap: 20px; padding: 25px; }
    .welcome-icon img { width: 220px !important; }
    .stat-row { display: flex; flex-wrap: wrap; gap: 16px; }
    .stat-card { flex: 1 1 calc(50% - 16px); min-width: 250px; }
    .section-header { flex-direction: column; align-items: flex-start; gap: 15px; }
    .filter-row { gap: 12px; }
    .filter-col { flex: 1 1 calc(50% - 12px); max-width: unset; }
}

/* ===== MOBILE ===== */
@media (max-width: 768px) {
    .welcome-box { padding: 20px; border-radius: 20px; }
    .welcome-text h3 { font-size: 22px; line-height: 1.4; }
    .welcome-text h5 { font-size: 15px; }
    .welcome-text p { font-size: 14px; }
    .welcome-icon { width: 100%; text-align: center; }
    .welcome-icon img { width: 180px !important; }
    .stat-row { flex-direction: column; }
    .stat-card { width: 100%; min-width: unset; }
    .slide-toggle-container { max-width: 100%; height: 42px; }
    .btn-toggle { font-size: 13px; }
    .filter-col { flex: 1 1 100%; min-width: 100%; }
    #chartWrapper { height: 300px !important; }
    .custom-modal-content { width: 95%; padding: 20px; border-radius: 16px; }
    .modal-title { font-size: 18px; }
    .info-box { padding: 18px; }
    .info-table { font-size: 13px; }
    .info-table tr td.label { width: 42%; }
}

/* ===== SMALL MOBILE ===== */
@media (max-width: 480px) {
    .welcome-text h3 { font-size: 18px; }
    .modal-title { font-size: 16px; }
    .info-table { font-size: 12px; }
}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai Kepala Puskesmas</h3>
        <p>Puskesmas Sumbersari, Jember</p>
    </div>
    <div class="welcome-icon">
        <img src="<?= base_url('img/World_Map.png') ?>" 
             alt="map"
             style="width:280px; height:auto;">
    </div>
</div>

<?php
    $dbStat = \Config\Database::connect();
    
    $hariIni = date('Y-m-d');

    $idPetugas  = session()->get('id_petugas');
    $idPenyakit = session()->get('id_penyakit');

    $totalKasus = $dbStat->table('pasien')
        ->where('DATE(tgl_kunjungan)', $hariIni)
        ->where('id_petugas', $idPetugas)
        ->where('id_penyakit', $idPenyakit)
        ->countAllResults();

    $hariIni = date('Y-m-d');
    $kasusHariIni = $dbStat->table('pasien')
        ->where('DATE(tgl_kunjungan)', $hariIni)
        ->where('id_petugas', $idPetugas)
        ->where('id_penyakit', $idPenyakit)
        ->countAllResults();

    // 3. Kelurahan Terdampak
    $idPetugas  = session()->get('id_petugas');
        $idPenyakit = session()->get('id_penyakit');

        $kelurahanTerdampak = $dbStat->table('pasien')
            ->select('id_wilayah')
            ->where('id_petugas', $idPetugas)
            ->where('id_penyakit', $idPenyakit)
            ->distinct()
            ->countAllResults();
?>

<div class="stat-row">
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-chart-column"></i></div>
        <div class="stat-info">
            <h3 class="red"><?= $totalKasus; ?></h3>
            <p>Total Kasus Aktif Hari Ini</p>
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

<div id="peta-sebaran" class="section-card">
    <div class="section-block">
        <div class="section-header">
            <div>
                <h5>Peta Interaktif Penyebaran</h5>
                <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
            </div>

            <div class="filter">
                <span>Periode:</span>
                <select id="periodeMap" onchange="updateMap()">
                    <?php for($t = 2024; $t <= date('Y'); $t++): ?>
                        <option value="<?= $t ?>" <?= ($t == $tahunMap ? 'selected' : '') ?>>
                            <?= $t ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="inner-card">
            <div id="map" style="height: 400px; width: 100%; z-index: 1;"></div>
        </div> 
    </div> 
</div> 

<div id="detailModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close-modal" onclick="closeDetailModal()">&times;</span>
        <div class="modal-title">
            Peta Sebaran Kasus <span id="modalTahun"><?= $tahunMap ?></span>
        </div>

        <div class="info-box">
            <h4>Informasi :</h4>
            <table class="info-table">
                <tr>
                    <td class="label">Nama Daerah</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalNama">-</td>
                </tr>
                <tr>
                    <td class="label">Jumlah Penduduk</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalPenduduk">-</td>
                </tr>
                <tr>
                    <td class="label">Jumlah Kasus</td>
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
                <tr>
                    <td class="label">Kategori Kasus</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalKategori">-</td>
                </tr>

                <tr>
                    <td class="label">Rentang usia</td>
                    <td class="colon">:</td>
                    <td class="value"></td>
                </tr>
                <tr class="sub">
                    <td class="label">Anak-anak</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalAnak">0</td>
                </tr>
                <tr class="sub">
                    <td class="label">Dewasa</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalDewasa">0</td>
                </tr>
                <tr class="sub">
                    <td class="label">Lansia</td>
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
                    <td class="label">Jenis kelamin terinfeksi</td>
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
                    <td class="label">Rumah Diperiksa</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalRumahPeriksa">0</td>
                </tr>
                <tr>
                    <td class="label">Rumah Positive Jentik</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalRumahJentik">0</td>
                </tr>
                <tr class="sub">
                    <td class="label">ABJ</td>
                    <td class="colon">:</td>
                    <td class="value" id="modalAbj">0%</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<section id="grafik" class="container mt-5 mb-5 p-0" data-aos="fade-up">
    <h4 id="titleGrafik" class="text-teal mb-4 fw-bold">Grafik Kasus DBD</h4>

    <div class="bg-white shadow-sm" style="border-radius: 30px; border: 1px solid #eee; padding: 40px 30px;">
        
        <div class="d-flex justify-content-center mb-5">
            <div class="slide-toggle-container">
                <div id="slideIndicator" class="slide-indicator"></div>
                <button type="button" class="btn-toggle active" id="tabKasus" onclick="switchTab('kasus')">KASUS</button>
                <button type="button" class="btn-toggle" id="tabMortalitas" onclick="switchTab('mortalitas')">MORTALITAS</button>
                <button type="button" class="btn-toggle" id="tabABJ" onclick="switchTab('abj')">ABJ</button>
            </div>
        </div>

        <form method="get" id="filterForm">
            <input type="hidden" name="tab" id="activeTabInput" value="<?= $_GET['tab'] ?? 'kasus' ?>">
            <input type="hidden" name="tahun_map" value="<?= $_GET['tahun_map'] ?? '' ?>">

            <div id="wrapperKasus" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'kasus' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="wilayah" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Antirogo" <?= request()->getGet('wilayah') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                    <option value="Sumbersari" <?= request()->getGet('wilayah') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                    <option value="Karangrejo" <?= request()->getGet('wilayah') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                    <option value="Tegalgede" <?= request()->getGet('wilayah') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                    <option value="Wirolegi" <?= request()->getGet('wilayah') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">USIA</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="usia" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="anak" <?= request()->getGet('usia') == 'anak' ? 'selected' : '' ?>>0-14</option>
                                    <option value="remaja" <?= request()->getGet('usia') == 'remaja' ? 'selected' : '' ?>>15-24</option>
                                    <option value="dewasa" <?= request()->getGet('usia') == 'dewasa' ? 'selected' : '' ?>>25-59</option>
                                    <option value="lansia" <?= request()->getGet('usia') == 'lansia' ? 'selected' : '' ?>>60+</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">JENIS KELAMIN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="jk" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="L" <?= request()->getGet('jk') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= request()->getGet('jk') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">BULAN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="bulan" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php 
                                    $bulanList = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                                    foreach($bulanList as $k => $v): ?>
                                        <option value="<?= $k ?>" <?= request()->getGet('bulan') == $k ? 'selected' : '' ?>><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="tahun" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                        <option value="<?= $t ?>" <?= request()->getGet('tahun') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                    <?php endfor; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="wrapperMortalitas" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'mortalitas' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="wilayah_mort" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Antirogo" <?= request()->getGet('wilayah_mort') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                    <option value="Sumbersari" <?= request()->getGet('wilayah_mort') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                    <option value="Karangrejo" <?= request()->getGet('wilayah_mort') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                    <option value="Tegalgede" <?= request()->getGet('wilayah_mort') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                    <option value="Wirolegi" <?= request()->getGet('wilayah_mort') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">JENIS KELAMIN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="jk_mort" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="L" <?= request()->getGet('jk_mort') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= request()->getGet('jk_mort') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="tahun_mort" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                        <option value="<?= $t ?>" <?= request()->getGet('tahun_mort') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                    <?php endfor; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="wrapperABJ" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'abj' ? 'block' : 'none' ?>;">
                <div class="filter-row">
                    <div class="filter-col">
                        <label class="filter-label">WILAYAH</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="wilayah_abj" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Antirogo" <?= request()->getGet('wilayah_abj') == 'Antirogo' ? 'selected' : '' ?>>Antirogo</option>
                                    <option value="Sumbersari" <?= request()->getGet('wilayah_abj') == 'Sumbersari' ? 'selected' : '' ?>>Sumbersari</option>
                                    <option value="Karangrejo" <?= request()->getGet('wilayah_abj') == 'Karangrejo' ? 'selected' : '' ?>>Karangrejo</option>
                                    <option value="Tegalgede" <?= request()->getGet('wilayah_abj') == 'Tegalgede' ? 'selected' : '' ?>>Tegal Gede</option>
                                    <option value="Wirolegi" <?= request()->getGet('wilayah_abj') == 'Wirolegi' ? 'selected' : '' ?>>Wirolegi</option>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">BULAN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="bulan_abj" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php foreach($bulanList as $k => $v): ?>
                                        <option value="<?= $k ?>" <?= request()->getGet('bulan_abj') == $k ? 'selected' : '' ?>><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">TAHUN</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="tahun_abj" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <?php for($t=2024; $t<=date('Y'); $t++): ?>
                                        <option value="<?= $t ?>" <?= request()->getGet('tahun_abj') == $t ? 'selected' : '' ?>><?= $t ?></option>
                                    <?php endfor; ?>
                                </select>
                                <i class="fa-solid fa-chevron-right arrow-icon"></i>
                            </div>
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
    
    // ================= DATA GRAFIK ABJ =================
    $builderABJ = $db->table('rekap_pelaporan_kader'); 
    $reqBulanABJ = $_GET['bulan_abj'] ?? '';
    $reqTahunABJ = $_GET['tahun_abj'] ?? '';
    $reqWilayahABJ = $_GET['wilayah_abj'] ?? '';
    $bulanMap = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];
    if (!empty($reqBulanABJ) && isset($bulanMap[$reqBulanABJ])) { $builderABJ->where('bulan', $bulanMap[$reqBulanABJ]); }
    if (!empty($reqTahunABJ)) { $builderABJ->like('periode_lengkap', $reqTahunABJ); }
    $builderABJ->select('id_kelurahan, minggu, AVG(abj) as avg_abj');
    $builderABJ->groupBy('id_kelurahan, minggu');
    $rawDB_ABJ = $builderABJ->get()->getResultArray();
    
    $kelMap = [1 => 'Sumbersari', 2 => 'Wirolegi', 3 => 'Antirogo', 4 => 'Tegalgede', 5 => 'Karangrejo'];
    $dataFinalABJ = [];
    foreach ($kelMap as $id => $nama) { $dataFinalABJ[$nama] = [null, null, null, null]; }
    foreach ($rawDB_ABJ as $row) {
        $namaKel = $kelMap[$row['id_kelurahan']] ?? '';
        if ($namaKel && preg_match('/(\d+)/', $row['minggu'], $matches)) {
            $idx = intval($matches[1]) - 1;
            if ($idx >= 0 && $idx <= 3) { $dataFinalABJ[$namaKel][$idx] = round($row['avg_abj'], 2); }
        }
    }
    if (!empty($reqWilayahABJ)) { foreach ($dataFinalABJ as $nama => $val) { if ($nama !== $reqWilayahABJ) unset($dataFinalABJ[$nama]); } }

    // ================= DATA GRAFIK MORTALITAS =================
    $builderMort = $db->table('pasien');
    $builderMort->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah');
    $builderMort->where('pasien.status_akhir', 'Meninggal');
    
    $reqWilayahMort = $_GET['wilayah_mort'] ?? '';
    $reqTahunMort = $_GET['tahun_mort'] ?? '';
    $reqJkMort = $_GET['jk_mort'] ?? '';

    if (!empty($reqTahunMort)) { 
        $builderMort->where('YEAR(pasien.tgl_kunjungan)', $reqTahunMort); 
    }
    if (!empty($reqJkMort)) { 
        $builderMort->where('pasien.jenis_kelamin', $reqJkMort == 'L' ? 'Laki-laki' : 'Perempuan'); 
    }
    
    $builderMort->select('wilayah.kelurahan, MONTH(pasien.tgl_kunjungan) as bulan, COUNT(pasien.id_pasien) as total_meninggal');
    $builderMort->groupBy('wilayah.kelurahan, MONTH(pasien.tgl_kunjungan)');
    $rawDB_Mort = $builderMort->get()->getResultArray();

    $kelMapMort = ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegalgede', 'Karangrejo'];
    $dataFinalMort = [];
    
    foreach ($kelMapMort as $nama) { 
        $dataFinalMort[$nama] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; 
    }

    foreach ($rawDB_Mort as $row) {
        $namaKel = ucwords(strtolower(trim($row['kelurahan'])));
        if ($namaKel == 'Tegal Gede') $namaKel = 'Tegalgede';

        if (in_array($namaKel, $kelMapMort)) {
            $blnIdx = intval($row['bulan']) - 1; 
            if ($blnIdx >= 0 && $blnIdx <= 11) { 
                $dataFinalMort[$namaKel][$blnIdx] = (int)$row['total_meninggal']; 
            }
        }
    }

    if (!empty($reqWilayahMort)) { 
        foreach ($dataFinalMort as $nama => $val) { 
            if ($nama !== $reqWilayahMort) unset($dataFinalMort[$nama]); 
        } 
    }
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// --- DATA DARI CONTROLLER ---
var dataDBD = <?= json_encode($dbd ?? []) ?>;
var detailDesa = <?= json_encode($detailDesa ?? []) ?>;
var desaTertinggi = <?= json_encode($desaTertinggi ?? '-') ?>;
var tahunSekarang = <?= json_encode($tahunMap) ?>;
const colorMapping = { 'Antirogo': '#1f4e5b', 'Sumbersari': '#00BBC2', 'Karangrejo': '#b2dfdb', 'Tegalgede': '#5cb85c', 'Wirolegi': '#4fc3f7' };

// --- SCRIPT UPDATE URL MAP ---
function updateMap(){
    let tahun = document.getElementById("periodeMap").value;
    let url = new URL(window.location.href);
    url.searchParams.set('tahun_map', tahun);
    window.location.href = url.toString();
}

// --- SCRIPT SLIDE TAB KASUS VS MORTALITAS VS ABJ ---
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

    // Reset Class & Display
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
        title.innerText = 'Grafik Kasus DBD';
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
    } else {
        title.innerText = 'Grafik Angka Bebas Jentik (ABJ)';
        indicator.style.transform = 'translateX(200%)';
        tabABJ.classList.add('active');
        wrapABJ.style.display = 'block';
        chartA.style.display = 'block';
    }
}

// --- SCRIPT MODAL DETAIL ---
function showDetailPopup(namaFix, namaAsli){
    var d = detailDesa[namaFix] 
         || detailDesa[namaAsli.toLowerCase().replace(/\s/g,'')] 
         || {};

    if(!d || Object.keys(d).length === 0){
        for(let key in detailDesa){
            if(key.includes(namaFix) || namaFix.includes(key)){
                d = detailDesa[key]; break;
            }
        }
    }
    d = d || {};

    var kategori   = d.kategori   || '-';
    var kategoriCls = '';
    if(kategori.toLowerCase() === 'tinggi') kategoriCls = 'kategori-tinggi';
    else if(kategori.toLowerCase() === 'sedang') kategoriCls = 'kategori-sedang';
    else if(kategori.toLowerCase() === 'rendah') kategoriCls = 'kategori-rendah';

    document.getElementById("modalTahun").innerText        = tahunSekarang;
    document.getElementById("modalNama").innerText         = d.nama || namaAsli;
    document.getElementById("modalPenduduk").innerText     = d.jumlah_penduduk ?? 0;
    document.getElementById("modalKasus").innerText        = d.jumlah_kasus    ?? 0;
    document.getElementById("modalSembuh").innerText       = d.sembuh ?? 0;
    document.getElementById("modalMeninggal").innerText    = d.meninggal ?? 0;

    var elKat = document.getElementById("modalKategori");
    elKat.innerText = (kategori.charAt(0).toUpperCase() + kategori.slice(1));
    elKat.className = 'value ' + kategoriCls;

    document.getElementById("modalAnak").innerText         = d.anak    ?? 0;
    document.getElementById("modalDewasa").innerText       = d.dewasa  ?? 0;
    document.getElementById("modalLansia").innerText       = d.lansia  ?? 0;
    document.getElementById("modalUsiaTertinggi").innerText = d.usia_tertinggi || '-';
    document.getElementById("modalDesaTertinggi").innerText = desaTertinggi || '-';

    var lk = parseInt(d.laki ?? 0);
    var pr = parseInt(d.perempuan ?? 0);
    document.getElementById("modalJkTotal").innerText      = (lk > 0 ? 1 : 0) + (pr > 0 ? 1 : 0);
    document.getElementById("modalLaki").innerText         = lk;
    document.getElementById("modalPerempuan").innerText    = pr;
    document.getElementById("modalRumahPeriksa").innerText = d.rumah_diperiksa ?? 0;
    
    let rmhJentikEl = document.getElementById("modalRumahJentik");
    if(rmhJentikEl) rmhJentikEl.innerText  = d.rumah_positif ?? d.rumah_jentik ?? 0; 
    
    let abjEl = document.getElementById('modalAbj');
    if(abjEl) abjEl.innerText = (d.abj ?? 0) + '%';

    document.getElementById("detailModal").style.display = "flex";
}

function closeDetailModal(){
    document.getElementById("detailModal").style.display = "none";
}

// --- SCRIPT INISIALISASI PETA ---
function fixNama(nama){
    return (nama || "").toLowerCase().trim().replace(/[^a-z0-9]/g, "");
}

var aliasDesa = { "kemuningsarilor": "kemuning sari lor", "tegalgede": "tegalgede", "tegalgedei": "tegalgede" };
var dataFinal = {};

/* OLAH DATA UNTUK PETA (Total Kasus) */
dataDBD.forEach(item => {
    var desa = fixNama(item.desa);
    if(aliasDesa[desa]) desa = aliasDesa[desa];

    if(!dataFinal[desa]){
        dataFinal[desa] = { total: 0, jumlah: 0 };
    }
    dataFinal[desa].total += parseInt(item.kasus);
    dataFinal[desa].jumlah++;
});

/* =========================
   KATEGORI RISIKO DBD
========================= */
for (var key in detailDesa) {
    let d = detailDesa[key];
    let kasus = parseInt(d.jumlah_kasus ?? 0);
    let penduduk = parseInt(d.jumlah_penduduk ?? 0);
    let meninggal = parseInt(d.meninggal ?? 0);
    let abj = parseFloat(d.abj ?? 0);

    let ir = 0;
    if (penduduk > 0) { ir = (kasus / penduduk) * 100000; }

    let cfr = 0;
    if (kasus > 0) { cfr = (meninggal / kasus) * 100; }

    let indikatorBaik = 0;
    if (ir <= 10) indikatorBaik++;
    if (cfr < 1) indikatorBaik++;
    if (abj >= 95) indikatorBaik++;

    if (indikatorBaik === 3) {
        detailDesa[key].kategori = "rendah"; // hijau
    } else if (indikatorBaik >= 1) {
        detailDesa[key].kategori = "sedang"; // kuning
    } else {
        detailDesa[key].kategori = "tinggi"; // merah
    }
    detailDesa[key].ir = ir.toFixed(2);
    detailDesa[key].cfr = cfr.toFixed(2);
}

document.addEventListener("DOMContentLoaded", function() {

    // --- LOGIKA HIGHLIGHT SIDEBAR ---
    const navLinks = document.querySelectorAll('.sidebar-menu a');
    const sections = [document.getElementById('peta-sebaran'), document.getElementById('grafik')];

    window.addEventListener('scroll', () => {
        let current = "";
        sections.forEach(section => {
            if (section) {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active'); 
            if (link.getAttribute('href').includes(current)) {
                link.classList.add('active');
            }
        });
    });

    // --- LOGIKA AUTO SCROLL FILTER ---
    const urlParams = new URLSearchParams(window.location.search);
    const hasFilter = urlParams.has('wilayah') || urlParams.has('tab') || urlParams.has('wilayah_mort');

    if (hasFilter) {
        const grafikSection = document.getElementById('grafik');
        if (grafikSection) { grafikSection.scrollIntoView({ behavior: 'auto', block: 'start' }); }
    }

    // Init Map
    var map = L.map('map').setView([-8.1, 113.5], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    fetch("<?= base_url('assets/peta/db.geojson') ?>")
    .then(res => res.json())
    .then(data => {
        var geo = L.geoJSON(data, {
            style: function(feature){
                var nama = fixNama(feature.properties.NAMOBJ);
                if(aliasDesa[nama]){ nama = aliasDesa[nama]; }
                
                var detail = detailDesa[nama] || {};
                var warna = "#cccccc";

                if(detail.kategori == "tinggi"){ warna = "#dc3545"; }
                else if(detail.kategori == "sedang"){ warna = "#ffc107"; }
                else if(detail.kategori == "rendah"){ warna = "#28a745"; }

                return { color: "#00CED1", weight: 2, fillColor: warna, fillOpacity: 0.7 };
            },
            onEachFeature: function(feature, layer){
                var namaAsli = feature.properties.NAMOBJ || "Kelurahan";
                var namaFix  = fixNama(namaAsli);
                if(aliasDesa[namaFix]){ namaFix = aliasDesa[namaFix]; }
                var item = dataFinal[namaFix];
                
                var isi = "<div style='min-width:220px;'><b>Kelurahan: " + namaAsli + "</b>";
                if(item){
                    var detail = detailDesa[namaFix] || {};
                    var kategori = detail.kategori || '-';
                    isi += "<br>Total Kasus: " + item.total;
                    isi += "<br>Kategori: " + kategori;
                    isi += `<br><br><button onclick="showDetailPopup('${namaFix}','${namaAsli}')" 
                            style="background:#00CED1; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer; font-weight:600; width:100%;">
                            Selengkapnya</button>`;
                } else {
                    isi += "<br><span style='color:red'>Data tidak ditemukan</span>";
                }
                isi += "</div>";

                layer.bindPopup(isi);
                layer.bindTooltip(namaAsli, { permanent: true, direction: "center", className: "label-desa" });

                layer.on({
                    mouseover: function(e){ e.target.setStyle({ weight: 3, color: '#000' }); },
                    mouseout: function(e){ geo.resetStyle(e.target); }
                });
            }
        }).addTo(map);

        map.fitBounds(geo.getBounds());
    });

    // Init Sliding Tab
    switchTab("<?= $_GET['tab'] ?? 'kasus' ?>");

    // ================= 1. GRAFIK KASUS =================
    const dataGrafikKasus = <?= json_encode($grafik ?? []) ?>;
    let labelsKasus = []; let totalKasus = [];
    dataGrafikKasus.forEach(item => { 
        labelsKasus.push(item.kelurahan || item.desa); 
        totalKasus.push(item.total || item.kasus); 
    });
    
    new Chart(document.getElementById('chartKasus').getContext('2d'), {
        type: 'bar', 
        data: { labels: labelsKasus, datasets: [{ label: 'Total Kasus', data: totalKasus, backgroundColor: '#00BBC2', borderRadius: 8 }] },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // ================= 2. GRAFIK MORTALITAS =================
    const rawDataMort = <?= json_encode($dataFinalMort) ?>;
    let datasetsMort = [];
    
    for (const kelurahan in rawDataMort) {
        datasetsMort.push({ 
            label: kelurahan, 
            data: rawDataMort[kelurahan], 
            borderColor: colorMapping[kelurahan] || '#333', 
            backgroundColor: colorMapping[kelurahan] || '#333', 
            fill: false, tension: 0, pointRadius: 4, pointHoverRadius: 6, borderWidth: 2, spanGaps: true 
        });
    }

    new Chart(document.getElementById('chartMortalitas').getContext('2d'), {
        type: 'line', 
        data: { 
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], 
            datasets: datasetsMort 
        },
        options: { 
            responsive: true, maintainAspectRatio: false, 
            plugins: { legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } } },
            scales: { 
                y: { min: 0, ticks: { stepSize: 1 }, grid: { borderDash: [5, 5] } }, 
                x: { grid: { display: false } } 
            }
        }
    });

    // ================= 3. GRAFIK ABJ =================
    const rawDataABJ = <?= json_encode($dataFinalABJ) ?>;
    let datasetsABJ = [];
    
    for (const kelurahan in rawDataABJ) {
        datasetsABJ.push({ 
            label: kelurahan, 
            data: rawDataABJ[kelurahan], 
            borderColor: colorMapping[kelurahan] || '#333', 
            backgroundColor: colorMapping[kelurahan] || '#333', 
            fill: false, tension: 0.2, pointRadius: 4, borderWidth: 2, spanGaps: true 
        });
    }

    new Chart(document.getElementById('chartABJ').getContext('2d'), {
        type: 'line', 
        data: { labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'], datasets: datasetsABJ },
        options: { 
            responsive: true, maintainAspectRatio: false,
            scales: { y: { min: 0, max: 100, ticks: { callback: function(v) { return v + '%'; } } } }
        }
    });

});
</script>
<?= $this->endSection(); ?>