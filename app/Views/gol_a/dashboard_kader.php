<?= $this->extend('layout/dashboard_layout_kader') ?>
<?= $this->section('content') ?>

<style>
/* --- STYLE MAP LABEL --- */
.label-desa{
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
.btn-toggle.active {
    color: #fff;
}
.slide-indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 50%;
    height: 100%;
    background: #00BBC2;
    border-radius: 30px;
    z-index: 1;
    transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

/* --- FILTER DESAIN BARU --- */
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
    text-align: left;
}
.filter-label {
    font-weight: 900;
    color: #000;
    font-size: 14px;
    margin-bottom: 8px;
    display: block;
    margin-left: 5px;
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
    text-align: left;
    font-size: 13px;
}
.pill-select option {
    background: white;
    color: #333;
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

/* --- CHART RESPONSIVENESS --- */
#chartWrapper canvas {
    width: 100% !important;
    height: 100% !important;
}

/* --- WIDGET STATISTIK KADER DESAIN BARU --- */
.kader-stat-card {
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0px 8px 18px rgba(0, 187, 194, 0.25);
    border: 1px solid rgba(0, 187, 194, 0.1);
    padding: 25px 20px;
    position: relative;
    min-height: 125px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s;
}
.kader-stat-card:hover {
    transform: translateY(-5px);
}
.kader-stat-icon {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    background-color: #bcf0f2;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.kader-stat-icon i {
    font-size: 24px;
    color: #215a6b;
}
.kader-stat-content {
    text-align: center;
    padding-left: 55px;
    width: 100%;
}
.kader-stat-number {
    font-size: 40px;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 8px;
}
.kader-stat-label {
    font-size: 15px;
    font-weight: 500;
    color: #222;
}

/* Specific text colors matching the image */
.text-red-custom { color: #E54B4B; }
.text-green-custom { color: #48B65A; }
.text-blue-custom { color: #1C559A; }
</style>

<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai KADER</h3>
        <p>Puskesmas Sumbersari, Jember</p>
    </div>
   <div class="welcome-icon">
        <img src="<?= base_url('img/World_Map.png') ?>" alt="map" style="width:280px; height:auto;">
    </div>
</div>

<?php
    $dbStat = \Config\Database::connect();
    
    // 1. Total Kasus Pasien
    $totalKasus = $dbStat->table('pasien')->countAllResults();

    // 2. Pasien Baru Hari Ini
    $hariIni = date('Y-m-d');
    $kasusHariIni = $dbStat->table('pasien')
                           ->where('DATE(tgl_kunjungan)', $hariIni)
                           ->countAllResults();

    // 3. Kelurahan Terdampak
    $kelurahanTerdampak = $dbStat->table('pasien')
                                 ->select('id_wilayah')
                                 ->distinct()
                                 ->countAllResults();
?>

<div class="row mb-4" style="margin-top: 20px;">
    <div class="col-md-4 mb-3">
        <div class="kader-stat-card">
            <div class="kader-stat-icon">
                <i class="fa-solid fa-chart-column"></i>
            </div>
            <div class="kader-stat-content">
                <div class="kader-stat-number text-red-custom"><?= $totalKasus; ?></div>
                <div class="kader-stat-label">Total Kasus Aktif Hari Ini</div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="kader-stat-card">
            <div class="kader-stat-icon">
                <i class="fa-solid fa-arrow-up" style="font-size: 18px;"></i>
                <i class="fa-solid fa-arrow-down" style="font-size: 18px; margin-left: 4px;"></i>
            </div>
            <div class="kader-stat-content">
                <div class="kader-stat-number text-green-custom"><?= $kasusHariIni; ?></div>
                <div class="kader-stat-label">Kasus Baru Hari Ini</div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="kader-stat-card">
            <div class="kader-stat-icon">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div class="kader-stat-content">
                <div class="kader-stat-number text-blue-custom"><?= $kelurahanTerdampak; ?></div>
                <div class="kader-stat-label">Kelurahan Terdampak</div>
            </div>
        </div>
    </div>
</div>

<div class="section-card">
    <div class="section-block">
        <div class="section-header">
            <div>
                <h5>Peta Interaktif Penyebaran</h5>
                <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
            </div>
            <div class="filter">
                <span>Periode:</span>
                <?php $tahunMap = $_GET['tahun_map'] ?? date('Y'); ?>
                <select id="periodeMap" onchange="updateMap()">
                    <?php for($t = 2024; $t <= date('Y'); $t++): ?>
                        <option value="<?= $t ?>" <?= ($t == $tahunMap ? 'selected' : '') ?>><?= $t ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="inner-card">
            <div id="map" style="height: 400px; z-index: 1;"></div>
        </div>
    </div>
</div>

<section id="grafik" class="container mt-5 mb-5 p-0">

    <h4 id="titleGrafik" class="text-dark mb-4 fw-bold">Grafik Kasus DBD</h4>

    <div class="bg-white shadow-sm" style="border-radius: 30px; border: 1px solid #eee; padding: 40px 30px;">
        
        <div class="d-flex justify-content-center mb-5">
            <div class="slide-toggle-container">
                <div id="slideIndicator" class="slide-indicator"></div>
                <button type="button" class="btn-toggle active" id="tabKasus" onclick="switchTab('kasus')">KASUS</button>
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
                <canvas id="chartABJ" style="display: <?= ($_GET['tab'] ?? 'kasus') == 'abj' ? 'block' : 'none' ?>;"></canvas>
            </div>

        </form>
    </div>
</section>

<?php
    $db = \Config\Database::connect();
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
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function updateMap(){
    let tahun = document.getElementById("periodeMap").value;
    let url = new URL(window.location.href);
    url.searchParams.set('tahun_map', tahun);
    window.location.href = url.toString();
}

function switchTab(type) {
    const indicator = document.getElementById('slideIndicator');
    const tabKasus = document.getElementById('tabKasus');
    const tabABJ = document.getElementById('tabABJ');
    const title = document.getElementById('titleGrafik');
    const input = document.getElementById('activeTabInput');
    const wrapKasus = document.getElementById('wrapperKasus');
    const wrapABJ = document.getElementById('wrapperABJ');
    const chartK = document.getElementById('chartKasus');
    const chartA = document.getElementById('chartABJ');

    input.value = type;
    title.innerText = type === 'kasus' ? 'Grafik Kasus DBD' : 'Grafik Angka Bebas Jentik (ABJ)';

    if (type === 'kasus') {
        indicator.style.transform = 'translateX(0%)';
        tabKasus.classList.add('active'); tabABJ.classList.remove('active');
        wrapKasus.style.display = 'block'; wrapABJ.style.display = 'none';
        chartK.style.display = 'block'; chartA.style.display = 'none';
    } else {
        indicator.style.transform = 'translateX(100%)';
        tabABJ.classList.add('active'); tabKasus.classList.remove('active');
        wrapABJ.style.display = 'block'; wrapKasus.style.display = 'none';
        chartA.style.display = 'block'; chartK.style.display = 'none';
    }
}

document.addEventListener("DOMContentLoaded", function() {

    // --- LOGIKA AUTO SCROLL SETELAH REFRESH/FILTER ---
    const urlParams = new URLSearchParams(window.location.search);
    const hasFilter = urlParams.has('wilayah') || urlParams.has('usia') || urlParams.has('jk') || 
                      urlParams.has('bulan') || urlParams.has('tahun') || urlParams.has('tab') ||
                      urlParams.has('wilayah_abj') || urlParams.has('bulan_abj') || urlParams.has('tahun_abj');

    if (hasFilter) {
        const grafikSection = document.getElementById('grafik');
        if (grafikSection) {
            grafikSection.scrollIntoView({ behavior: 'auto', block: 'start' });
        }
    }

    // --- INISIALISASI PETA ---
    function fixNama(nama){ return (nama || "").toLowerCase().trim().replace(/\s+/g, " ").replace(/[^a-z0-9 ]/g, ""); }
    var aliasDesa = { "kemuningsarilor": "kemuning sari lor" };
    var dataDBD = <?= json_encode($dbd ?? []) ?>;
    var dataFinalMap = {};
    dataDBD.forEach(item => {
        var desa = fixNama(item.desa); if(aliasDesa[desa]) desa = aliasDesa[desa];
        if(!dataFinalMap[desa]) dataFinalMap[desa] = { total: 0, jumlah: 0 };
        dataFinalMap[desa].total += parseInt(item.kasus); dataFinalMap[desa].jumlah++;
    });
    for(var key in dataFinalMap){
        var rata = dataFinalMap[key].total / dataFinalMap[key].jumlah;
        if(rata >= 20) dataFinalMap[key].kategori = "tinggi";
        else if(rata >= 10) dataFinalMap[key].kategori = "sedang";
        else dataFinalMap[key].kategori = "rendah";
    }
    var map = L.map('map').setView([-8.1,113.5], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    fetch("<?= base_url('assets/peta/db.geojson') ?>").then(res => res.json()).then(data => {
        var geo = L.geoJSON(data, {
            style: function(feature){
                var nama = fixNama(feature.properties.NAMOBJ); if(aliasDesa[nama]) nama = aliasDesa[nama];
                var item = dataFinalMap[nama]; var warna = "#cccccc";
                if(item){ if(item.kategori == "tinggi") warna = "#dc3545"; else if(item.kategori == "sedang") warna = "#ffc107"; else if(item.kategori == "rendah") warna = "#28a745"; }
                return { color: "#00CED1", weight: 2, fillColor: warna, fillOpacity: 0.7 };
            },
            onEachFeature: function(feature, layer){
                var namaAsli = feature.properties.NAMOBJ || "Kelurahan";
                var namaFix  = fixNama(namaAsli); if(aliasDesa[namaFix]) namaFix = aliasDesa[namaFix];
                var item = dataFinalMap[namaFix];
                var isi = "<b>Kelurahan: " + namaAsli + "</b>";
                if(item){ isi += "<br>Total Kasus: " + item.total + "<br>Kategori: " + item.kategori; } 
                else { isi += "<br><span style='color:red'>Data tidak ditemukan</span>"; }
                layer.bindPopup(isi); layer.bindTooltip(namaAsli, { permanent: true, direction: "center", className: "label-desa" });
                layer.on({ mouseover: function(e){ e.target.setStyle({ weight: 3, color: '#000' }); }, mouseout: function(e){ geo.resetStyle(e.target); } });
            }
        }).addTo(map); map.fitBounds(geo.getBounds());
    });

    // --- INISIALISASI SLIDING TAB ---
    const currentTab = "<?= $_GET['tab'] ?? 'kasus' ?>";
    switchTab(currentTab);

    // --- GRAFIK KASUS ---
    const dataGrafikKasus = <?= json_encode($grafik ?? []) ?>;
    let labelsKasus = []; let totalKasus = [];
    dataGrafikKasus.forEach(item => { labelsKasus.push(item.kelurahan); totalKasus.push(item.total); });
    new Chart(document.getElementById('chartKasus').getContext('2d'), {
        type: 'bar', data: { labels: labelsKasus, datasets: [{ label: 'Total Kasus', data: totalKasus, backgroundColor: '#00BBC2', borderRadius: 8 }] },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // --- GRAFIK ABJ ---
    const rawDataABJ = <?= json_encode($dataFinalABJ) ?>;
    const colorMapping = { 'Antirogo': '#1f4e5b', 'Sumbersari': '#00BBC2', 'Karangrejo': '#b2dfdb', 'Tegalgede': '#5cb85c', 'Wirolegi': '#4fc3f7' };
    let datasetsABJ = [];
    for (const kelurahan in rawDataABJ) {
        datasetsABJ.push({ label: kelurahan, data: rawDataABJ[kelurahan], borderColor: colorMapping[kelurahan] || '#333', backgroundColor: colorMapping[kelurahan] || '#333', fill: false, tension: 0.2, pointRadius: 4, pointHoverRadius: 6, borderWidth: 2, spanGaps: true });
    }
    new Chart(document.getElementById('chartABJ').getContext('2d'), {
        type: 'line', data: { labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'], datasets: datasetsABJ },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } } },
            scales: { y: { min: 0, max: 100, ticks: { stepSize: 25, callback: function(value) { return value + '%'; } }, grid: { borderDash: [5, 5] } }, x: { grid: { display: false } } }
        }
    });
});
</script>

<?= $this->endSection() ?>