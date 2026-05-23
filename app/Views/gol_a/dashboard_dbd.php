<?= $this->extend('layout/dashboard_layout_admin') ?>
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
.info-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
}

.info-table tr {
    background: #fff;
}

.info-table td {
    padding: 9px 10px;
    vertical-align: middle;
    line-height: 1.5;
}

.info-table td.label {
    width: 42%;
    color: #374151;
    font-weight: 500;
}

.info-table td.colon {
    width: 20px;
    text-align: center;
    color: #6b7280;
}

.info-table td.value {
    color: #111827;
    font-weight: 700;
}

.info-table tr.sub td.label {
    padding-left: 34px;
    color: #4b5563;
    font-weight: 400;
}

.info-table tr.section-row td {
    padding-top: 14px;
    font-weight: 800;
    color: #111827;
    border-top: 1px solid #e5e7eb;
}

.info-table tr.highlight-row td {
    background: #e8ffff;
    font-weight: 800;
}

.custom-modal-content {
    max-width: 820px;
}

.modal-title {
    padding-right: 40px;
}
/* ================= GRAFIK ================= */

/* Toggle KASUS / MORTALITAS / ABJ */
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


/* Canvas Chart Responsive */
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

.info-table tr.important-row td {
    background: #f0fdfa;
    font-weight: 800;
    color: #0f172a;
    padding-top: 12px;
    padding-bottom: 12px;
    border-top: 1px solid #ffffff;
    border-bottom: 1px solid #ffffff;
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

#detailModal .info-table {
    width: 100%;
    border-collapse: collapse !important;
    border-spacing: 0 !important;
    font-size: 14.5px;
    color: #333;
}

#detailModal .info-table tr {
    background: transparent !important;
}

#detailModal .info-table tr td {
    padding: 6px 0 !important;
    vertical-align: top;
    line-height: 1.6;
}

#detailModal .info-table tr td.label {
    width: 45%;
    color: #2b2b2b;
    font-weight: 400;
}

#detailModal .info-table tr td.colon {
    width: 18px;
    text-align: center;
    color: #555;
}

#detailModal .info-table tr td.value {
    color: #111;
    font-weight: 600;
}

#detailModal .info-table tr.sub td.label {
    padding-left: 28px !important;
    color: #444;
    font-weight: 400;
}

#detailModal .info-table tr.important-row td {
    background: #f0fdfa !important;
    font-weight: 900 !important;
    color: #0f172a !important;
    padding-top: 12px !important;
    padding-bottom: 12px !important;
    border-top: 1px solid #99f6e4 !important;
    border-bottom: 1px solid #99f6e4 !important;
}

#detailModal .info-table tr.important-row td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

#detailModal .info-table tr.important-row td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

#detailModal .info-table tr.important-row .value {
    font-size: 16px !important;
    font-weight: 900 !important;
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
        <h3>Anda masuk sebagai ADMIN</h3>
        <p>Puskesmas Sumbersari, Jember</p>
    </div>

    <div class="welcome-icon">
        <img src="<?= base_url('img/World_Map.png') ?>"
             alt="map"
             style="width:280px; height:auto;">
    </div>

<?php
    $db = \Config\Database::connect();

    $idPetugas  = session()->get('id_petugas');
    $idPenyakit = session()->get('id_penyakit');

    $builder = $db->table('pasien')
    ->where('id_petugas', $idPetugas)
    ->where('id_penyakit', $idPenyakit);
    $desa_diizinkan = [
        'sumbersari',
        'wirolegi',
        'antirogo',
        'tegalgede',
        'karangrejo'
    ];

// Total kasus
$totalKasus = $db->table('pasien')
    ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
    ->where('pasien.id_penyakit', 1)
    ->whereIn(
        'LOWER(REPLACE(wilayah.kelurahan," ",""))',
        $desa_diizinkan
    )
    ->countAllResults();

// Kasus hari ini
$kasusHariIni = $db->table('pasien')
    ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
    ->where('pasien.id_penyakit', 1)
    ->where('DATE(pasien.tgl_kunjungan)', date('Y-m-d'))
    ->whereIn(
        'LOWER(REPLACE(wilayah.kelurahan," ",""))',
        $desa_diizinkan
    )
    ->countAllResults();

// Kelurahan terdampak
$kelurahanTerdampak = $db->table('pasien')
    ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
    ->select('COUNT(DISTINCT wilayah.kelurahan) as total')
    ->where('pasien.id_penyakit', 1)
    ->whereIn(
        'LOWER(REPLACE(wilayah.kelurahan," ",""))',
        $desa_diizinkan
    )
    ->get()
    ->getRow()
    ->total;
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
                <h5>Peta Interaktif Penyebaran</h5>
                <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
                        </div>
<div class="filter" style="display:flex; gap:10px; align-items:center;">

    <span>Periode:</span>

    <!-- FILTER BULAN -->
   <select id="bulanMap" onchange="updateMap()">
    <option value="">Semua Bulan</option>

    <?php
    $bulanDipilih = $_GET['bulan_map'] ?? '';
    $namaBulan = [
        1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
        5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
        9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
    ];

    foreach($namaBulan as $id => $nama):
    ?>
        <option value="<?= $id ?>" <?= ($bulanDipilih == $id ? 'selected' : '') ?>>
            <?= $nama ?>
        </option>
    <?php endforeach; ?>
</select>

    <!-- FILTER TAHUN -->
<?php $tahunMapDipilih = $_GET['tahun_map'] ?? $tahunSekarang; ?>


                <select id="periodeMap" onchange="updateMap()">
                    <?php for($t = 2024; $t <= $tahunSekarang; $t++): ?>
                        <option value="<?= $t ?>" <?= ($t == $tahunMapDipilih ? 'selected' : '') ?>><?= $t ?></option>
                            <?= $t ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="inner-card">

    <div class="map-wrapper">
        <div id="map"></div>
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
            <div style="
                margin-top:30px;
                margin-bottom:30px;
                padding-bottom: 30px;
                padding-right:30px;
                text-align:right;
            ">
    <button onclick="openPendudukModal()"
        style="
            background:#00BBC2;
            color:white;
            border:none;
            padding:12px 18px;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
        ">
        <i class="fa-solid fa-users"></i>
        Data Penduduk
    </button>
</div>

<div id="pendudukModal" class="custom-modal">
    <div class="custom-modal-content" style="max-width:900px;">
        <span class="close-modal" onclick="closePendudukModal()">&times;</span>

        <div class="modal-title">
            Manajemen Data Penduduk
</div>

<table class="table table-hover">
        <div id="formTambah" style="display:none; margin-bottom:25px; border: 1px solid #00BBC2; padding: 20px; border-radius: 15px;">
            <h5 id="formTitle">Update Data Penduduk</h5>
            <form id="pendudukForm" action="<?= base_url('simpan-penduduk') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id_penduduk" id="id_penduduk">
                
                <div class="row">
    <div class="col-md-4">
        <label>Kelurahan</label>
        <input type="text" name="kelurahan" id="kelurahan" class="form-control" readonly>
    </div>
    <div class="col-md-3">
        <label>Laki-laki</label>
        <input type="number" name="laki" id="input_laki" class="form-control" oninput="hitungTotalManual()">
    </div>
    <div class="col-md-3">
        <label>Perempuan</label>
        <input type="number" name="perempuan" id="input_perempuan" class="form-control" oninput="hitungTotalManual()">
    </div>
    <div class="col-md-2">
        <label>Total</label>
        <input type="text" id="display_total" class="form-control" readonly>
    </div>
</div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" style="background:#00BBC2; border:none;">Update Data</button>
                    <button type="button" onclick="showTambahForm()" class="btn btn-secondary">Batal</button>
                </div>
            </form>
        </div>

       <table class="table table-hover">
    <thead>
        <tr>
            <th>Kelurahan</th>
            <th>Laki-laki</th>
            <th>Perempuan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $list_kelurahan = ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo'];
        $penduduk = isset($penduduk) && is_array($penduduk) ? $penduduk : [];
        foreach($list_kelurahan as $nama_kel): 
            $jml_laki = 0;
            $jml_perempuan = 0;
            
            // Mencari data di variabel $penduduk yang dikirim dari controller
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
            <td>
                <button type="button" class="btn btn-warning btn-sm" 
                    onclick="editPenduduk('<?= $nama_kel ?>', <?= $jml_laki ?>, <?= $jml_perempuan ?>)">
                    <i class="fa-solid fa-pen"></i> Update
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>            
        <!-- isi modal kamu taruh di sini -->
    </div>
</div>

<div id="detailModal" class="custom-modal">
    <div class="custom-modal-content">
        <span class="close-modal" onclick="closeDetailModal()">&times;</span>

        <div class="modal-title">
            Detail Wilayah Sebaran Kasus <span id="modalTahun"><?= $tahunSekarang ?></span>
        </div>

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
            <script>
            function closeFormPenduduk(){
            document.getElementById("formTambah").style.display = "none";
        } 
            //FIX NAMA 
            function fixNama(nama){
                return (nama || "")
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9]/g, "");
            }

            /*ALIAS */
            var aliasDesa = {
            "kemuningsarilor": "kemuning sari lor",
            "tegalgede": "tegalgede",
            "tegalgedei": "tegalgede"
};
        
           var dataDBD = <?= json_encode(isset($dbd) ? $dbd : []) ?>;

            var detailDesa = <?= json_encode(
                isset($detailDesa) ? $detailDesa : []
            ) ?>;

            var desaTertinggi = <?= json_encode(
                isset($desaTertinggi) ? $desaTertinggi : '-'
            ) ?>;
            var tahunSekarang = <?= json_encode($tahunSekarang) ?>;

            var dataFinal = {};

            /* OLAH DATA UNTUK WARNA PETA */
            dataDBD.forEach(item => {
                var desa = fixNama(item.desa);
                if(aliasDesa[desa]) desa = aliasDesa[desa];

                if(!dataFinal[desa]){
                    dataFinal[desa] = { total: 0, jumlah: 0 };
                }
                dataFinal[desa].total += parseInt(item.kasus);
                dataFinal[desa].jumlah++;
            });


/* =========================================
   KATEGORI RISIKO DBD (WAJIB 3 INDIKATOR)
========================================= */
for (var key in detailDesa) {

    let d = detailDesa[key];

    let kasus = parseInt(d.jumlah_kasus ?? 0);
    let penduduk = parseInt(d.jumlah_penduduk ?? 0);
    let meninggal = parseInt(d.meninggal ?? 0);
    let abj = parseFloat(d.abj ?? 0);
    let rumahDiperiksa = parseInt(d.rumah_diperiksa ?? 0);

    // default
    let ir = 0;
    let cfr = 0;

    if (
    kasus === 0 ||
    penduduk === 0 ||
    rumahDiperiksa === 0 ||
    abj === 0
) {

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
        } 
        else if (indikatorBaik === 1 || indikatorBaik === 2) {
            detailDesa[key].kategori = "sedang";
        } 
        else {
            detailDesa[key].kategori = "tinggi";
        }
    }

    detailDesa[key].ir = ir.toFixed(2);
    detailDesa[key].cfr = cfr.toFixed(2);
}


            document.addEventListener("DOMContentLoaded", function() {

                /* 🔥 INIT MAP */
                var map = L.map('map').setView([-8.1, 113.5], 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                /* 🔥 GEOJSON */
                fetch("<?= base_url('assets/peta/db.geojson') ?>")
                .then(res => res.json())
                .then(data => {

                    var geo = L.geoJSON(data, {

                       style: function(feature){

                        var nama = fixNama(feature.properties.NAMOBJ);

                        if(aliasDesa[nama]) nama = aliasDesa[nama];

                        var detail = detailDesa[nama] || {};
                        var warna = "#cccccc";

                        if(detail.kategori == "tinggi"){
                            warna = "#dc3545";
                        }
                        else if(detail.kategori == "sedang"){
                            warna = "#ffc107";
                        }
                        else if(detail.kategori == "rendah"){
                            warna = "#28a745";
    }
                            return {
                                color: "#00CED1",
                                weight: 2,
                                fillColor: warna,
                                fillOpacity: 0.7
                            };
                        },

                        onEachFeature: function(feature, layer){
                            var namaAsli = feature.properties.NAMOBJ || "Kelurahan";
                            var namaFix  = fixNama(namaAsli);
                            if(aliasDesa[namaFix]) namaFix = aliasDesa[namaFix];

                            var item = dataFinal[namaFix];

                            var isi = "<div style='min-width:220px;'>";
                            isi += "<b>Kelurahan: " + namaAsli + "</b>";

                            if(item || detailDesa[namaFix]){
                                var detail = detailDesa[namaFix] || {};
                                var kategori = detail.kategori || '-';

                                var totalKasusPopup = detail.jumlah_kasus ?? (item ? item.total : 0);
                                var abjWilayah = detail.abj ?? 0;

                                isi += "<br>Total Kasus: " + totalKasusPopup;
                                isi += "<br>ABJ Wilayah: " + abjWilayah + "%";
                                isi += "<br>Kategori: " + kategori;

                                isi += `
                                    <br><br>
                                    <button
                                        onclick="showDetailPopup('${namaFix}','${namaAsli}')"
                                        style="
                                            background:#00CED1;
                                            color:white;
                                            border:none;
                                            padding:8px 14px;
                                            border-radius:8px;
                                            cursor:pointer;
                                            font-weight:600;
                                        ">
                                        Selengkapnya
                                    </button>
                                `;
                            }

                            isi += "</div>";
                            layer.bindPopup(isi);

                            layer.bindTooltip(namaAsli, {
                                permanent: true,
                                direction: "center",
                                className: "label-desa"
                            });

                            layer.on({
                                mouseover: function(e){
                                    e.target.setStyle({ weight: 3, color: '#000' });
                                },
                                mouseout: function(e){
                                    geo.resetStyle(e.target);
                                }
                            });
                        }

                    }).addTo(map);

                    map.fitBounds(geo.getBounds());
                });
            });

            /* 🔥 TAMPILKAN MODAL DETAIL — AMBIL DARI DATABASE */
            function formatNamaDaerah(nama) {
    const key = fixNama(nama);

    const namaMap = {
        sumbersari: 'Sumbersari',
        wirolegi: 'Wirolegi',
        antirogo: 'Antirogo',
        tegalgede: 'Tegal Gede',
        karangrejo: 'Karangrejo'
    };

    return namaMap[key] || nama;
}

function showDetailPopup(namaFix, namaAsli) {
    let d = detailDesa[namaFix]
        || detailDesa[fixNama(namaAsli)]
        || {};

    if (!d) {
        for (let key in detailDesa) {
            if (key.includes(namaFix) || namaFix.includes(key)) {
                d = detailDesa[key];
                break;
            }
        }
    }

    d = d || {};

    const kategori = d.kategori || '-';
    let kategoriCls = '';

    if (kategori.toLowerCase() === 'tinggi') {
        kategoriCls = 'kategori-tinggi';
    } else if (kategori.toLowerCase() === 'sedang') {
        kategoriCls = 'kategori-sedang';
    } else if (kategori.toLowerCase() === 'rendah') {
        kategoriCls = 'kategori-rendah';
    }

    const tahunPeta = document.getElementById("periodeMap")
        ? document.getElementById("periodeMap").value
        : tahunSekarang;

    document.getElementById("modalTahun").innerText = tahunPeta;
    document.getElementById("modalNama").innerText = formatNamaDaerah(namaAsli);

    document.getElementById("modalPenduduk").innerText = d.jumlah_penduduk ?? 0;
    document.getElementById("modalKasus").innerText = d.jumlah_kasus ?? 0;
    document.getElementById("modalSembuh").innerText = d.sembuh ?? 0;
    document.getElementById("modalMeninggal").innerText = d.meninggal ?? 0;

    const elKat = document.getElementById("modalKategori");
    elKat.innerText = kategori !== '-'
        ? kategori.charAt(0).toUpperCase() + kategori.slice(1)
        : '-';
    elKat.className = 'value ' + kategoriCls;

    document.getElementById("modalAnak").innerText = d.anak ?? 0;
    document.getElementById("modalRemaja").innerText = d.remaja ?? 0;
    document.getElementById("modalDewasa").innerText = d.dewasa ?? 0;
    document.getElementById("modalLansia").innerText = d.lansia ?? 0;

    document.getElementById("modalUsiaTertinggi").innerText = d.usia_tertinggi || '-';
    document.getElementById("modalDesaTertinggi").innerText = formatNamaDaerah(desaTertinggi || '-');

    const lk = parseInt(d.laki ?? 0);
    const pr = parseInt(d.perempuan ?? 0);
    const jkUnik = (lk > 0 ? 1 : 0) + (pr > 0 ? 1 : 0);

    document.getElementById("modalJkTotal").innerText = jkUnik;
    document.getElementById("modalLaki").innerText = lk;
    document.getElementById("modalPerempuan").innerText = pr;

    document.getElementById("modalRumahPeriksa").innerText = d.rumah_diperiksa ?? 0;
    document.getElementById("modalRumahJentik").innerText = d.rumah_jentik ?? 0;
    document.getElementById("modalAbj").innerText = (d.abj ?? 0) + '%';

    document.getElementById("detailModal").style.display = "flex";
}
    function closeDetailModal() {
    const modal = document.getElementById("detailModal");

    if (modal) {
        modal.style.display = "none";
    }
}
            // klik di luar modal untuk menutup
            window.addEventListener('click', function(e){
                var modal = document.getElementById('detailModal');
                if(e.target === modal) closeDetailModal();
            });
            </script>
        </div>
    </div>

    <style>
    .label-desa{
        background: rgba(0,0,0,0.6);
        color: white;
        border: none;
        padding: 2px 6px;
        font-size: 11px;
        border-radius: 6px;
    }
    </style>
</div>

<section id="grafik" class="container mt-5 mb-5 p-0">

    <h4 id="titleGrafik" class="text-dark mb-4 fw-bold">Grafik Kasus DBD</h4>

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
                            </div>
                        </div>
                    </div>
                    <div class="filter-col">
                        <label class="filter-label">USIA</label>
                        <div class="filter-rect">
                            <div class="pill-select-wrapper">
                                <select name="usia" class="pill-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="anak" <?= request()->getGet('usia') == 'anak' ? 'selected' : '' ?>>Bayi dan Anak Pra-sekolah (0–6 Tahun)</</option>
                                    <option value="remaja" <?= request()->getGet('usia') == 'remaja' ? 'selected' : '' ?>>Anak Sekolah dan Remaja (>6–18 Tahun)</option>
                                    <option value="dewasa" <?= request()->getGet('usia') == 'dewasa' ? 'selected' : '' ?>>Dewasa (>18–59 Tahun)</option>
                                    <option value="lansia" <?= request()->getGet('usia') == 'lansia' ? 'selected' : '' ?>>Lansia (≥60 Tahun)</option>
                                </select>
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

<style>

.funfact-section{
    padding-top: 40px;
}
.section-title{
    text-align: center;
    margin-bottom: 30px;
}

.section-title h2{
    font-size: 32px;
    margin-bottom: 10px;
}

.section-title p{
    color: #64748b;
}
.berita-track{
    display: flex;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    gap: 20px;
    overflow-x: auto;
    overflow-y: hidden;
    scroll-behavior: smooth;
    padding: 10px 5px;
    scrollbar-width: none;
}

.berita-item{
    min-width: 290px;
    max-width: 290px;
    background: linear-gradient(135deg,#0097A7,#00B8C8);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    flex-shrink: 0;
    transition: .3s ease;
}

.berita-item:hover{
    transform: translateY(-5px);
}

.berita-item img{
    width: 100%;
    height: 170px;
    object-fit: cover;
}

.berita-content{
    padding: 18px;
}

.berita-content h5{
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #fff;

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.berita-content p{
    font-size: 14px;
    line-height: 1.6;
    color: #fff;
    margin-bottom: 16px;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.berita-link:hover{
    color: #0284c7;
}

.berita-btn{
    display: inline-flex;
    align-items: center;
    gap: 6px;
    width: fit-content;
    padding: 8px 16px;
    background: white;
    color: #0097A7;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: .3s ease;
}

.berita-btn:hover{
    background: #e6ffff;
    color: #007b87;
    transform: translateX(3px);
}

/* ================= RESPONSIVE FIX GLOBAL ================= */

/* ===== TABLET ===== */
@media (max-width: 1024px) {

    .welcome-box {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        padding: 25px;
    }

    .welcome-icon img {
        width: 220px !important;
    }

    .stat-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .stat-card {
        flex: 1 1 calc(50% - 16px);
        min-width: 250px;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .filter-row {
        gap: 12px;
    }

    .filter-col {
    flex: 1;
    min-width: 160px;
    max-width: 200px;
}

.pill-select {
    white-space: normal;
    height: auto;
    min-height: 42px;
    line-height: 1.3;
}
    .funfact-card {
        min-width: 85%;
        max-width: 85%;
    }

    .funfact-body img {
        width: 180px;
        height: 130px;
    }
}


/* ===== MOBILE ===== */
@media (max-width: 768px) {

    .welcome-box {
        padding: 20px;
        border-radius: 20px;
    }

    .welcome-text h3 {
        font-size: 22px;
        line-height: 1.4;
    }

    .welcome-text h5 {
        font-size: 15px;
    }

    .welcome-text p {
        font-size: 14px;
    }

    .welcome-icon {
        width: 100%;
        text-align: center;
    }

    .welcome-icon img {
        width: 180px !important;
    }

    .stat-row {
        flex-direction: column;
    }

    .stat-card {
        width: 100%;
        min-width: unset;
    }

    .slide-toggle-container {
        max-width: 100%;
        height: 42px;
    }

    .btn-toggle {
        font-size: 13px;
    }

    .filter-col {
        flex: 1 1 100%;
        min-width: 100%;
    }

    #chartWrapper {
        height: 300px !important;
    }

    .custom-modal-content {
        width: 95%;
        padding: 20px;
        border-radius: 16px;
    }

    .modal-title {
        font-size: 18px;
    }

    .info-box {
        padding: 18px;
    }

    .info-table {
        font-size: 13px;
    }

    .info-table tr td.label {
        width: 42%;
    }

    .section-title h2 {
        font-size: 28px;
    }

    .section-title p {
        font-size: 14px;
    }

    .berita-item{
        min-width: 240px;
        max-width: 240px;
    }

    .berita-item img{
        height: 140px;
    }

    .berita-content{
        padding: 14px;
    }

    .berita-content h5{
        font-size: 15px;
    }

    .berita-content p{
        font-size: 12px;
    }

    .funfact-card {
        min-width: 95%;
        max-width: 95%;
    }

    .funfact-body {
        flex-direction: column;
        text-align: center;
    }

    .funfact-text {
        flex: 1;
        color: white;
        line-height: 1.6;
        font-size: 13px;
        margin-bottom: 16px;
    }

    .funfact-body img {
        width: 100%;
        height: 200px;
    }

    .funfact-inner {
        padding: 35px 20px 20px;
    }
}
@media (max-width: 768px){

.berita-card{
    min-width: 95%;
    flex-direction: column;
    text-align: center;
    gap: 20px;
}

.berita-content{
    padding: 12px;
}

.berita-content h3{
    font-size: 0.88rem;
}

.berita-card img{
    width: 100%;
    height: 200px;
}
}


/* ===== SMALL MOBILE ===== */
@media (max-width: 480px) {

    .section-title h2 {
        font-size: 24px;
    }

    .berita-content h3 {
        font-size: 18px;
    }

    .funfact-inner h3 {
        font-size: 16px;
    }

    .funfact-icon {
        width: 50px;
        height: 50px;
        font-size: 18px;
    }

    .welcome-text h3 {
        font-size: 18px;
    }

    .modal-title {
        font-size: 16px;
    }

    .info-table {
        font-size: 12px;
    }
}

</style>
<section class="berita-section container mt-5">

    <div class="mb-4">
    <h4 id="titleBerita" class="text-dark fw-bold">Berita</h4>
        <p>Informasi dan Edukasi tentang Pencegahan serta Penanganan DBD</p>
    </div>

    <div class="berita-wrapper">

        <div id="beritaTrack" class="berita-track">

            <?php if(!empty($berita)) : ?>
                <?php foreach($berita as $b) : ?>

                    <div class="berita-item">

                        <img src="<?= !empty($b['gambar_berita'])
                            ? base_url('uploads/berita/' . $b['gambar_berita'])
                            : base_url('img/default.png') ?>">

                        <div class="berita-content">

                            <h5>
                                <?= esc((string) ($b['judul_berita'] ?? '')) ?>
                            </h5>

                            <p>
                                <?= substr(strip_tags((string)($b['isi_berita'] ?? '')), 0, 100) ?>...
                            </p>
                            <br>
                            <a href="<?= base_url('berita/view_user/' . $b['id_berita']) ?>" class="berita-btn">
                                Baca Selengkapnya →
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>
            <?php else : ?>

                <p>Belum ada berita.</p>

            <?php endif; ?>

        </div>

    </div>

</section>


<style>

.funfact-section{
    margin-top: 50px;
    padding: 0 20px;
}

.funfact-scroll{
    display: flex;
    gap: 18px;
    overflow-x: auto;
    overflow-y: hidden;
    scroll-behavior: smooth;
    flex-wrap: nowrap;
    padding-bottom: 10px;
}

.funfact-scroll::-webkit-scrollbar{
    display: none;
}

.funfact-card{
    min-width: 420px;
    max-width: 420px;
    flex-shrink: 0;
    margin-top: 20px;
    position: relative;
}

.funfact-icon{
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #00BBC2;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 22px;
    margin: auto;
    position: relative;
    z-index: 2;
}

.funfact-inner{
    margin-top: -25px;
    background: linear-gradient(135deg,#0097A7,#00B8C8);
    border-radius: 20px;
    padding: 45px 25px 25px;
}

.funfact-inner h3{
    text-align: center;
    color: white;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 18px;
}

.funfact-body{
    display: flex;
    align-items: center;
    gap: 16px;
}

.funfact-text{
    flex: 1;
    color: white;
    line-height: 1.6;
    font-size: 13px;
}

.funfact-body img{
    width: 170px;
    height: 130px;
    border-radius: 16px;
    object-fit: cover;
    flex-shrink: 0;
}
.funfact-text-wrapper{
    display: flex;
    flex-direction: column;
}
.funfact-btn{
    display: inline-flex;
    align-items: center;
    gap: 6px;
    width: fit-content;
    padding: 8px 16px;
    background: white;
    color: #0097A7;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: .3s ease;
}

.funfact-btn:hover{
    background: #e6ffff;
    color: #007b87;
    transform: translateX(3px);
}

/* ================= TABLET ================= */

@media (max-width: 768px){

    .funfact-card{
        min-width: 300px;
        max-width: 300px;
    }

    .funfact-body{
        flex-direction: column;
        align-items: flex-start;
    }

    .funfact-body img{
        width: 100%;
        height: 160px;
    }

    .funfact-inner{
        padding: 40px 18px 18px;
    }

    .funfact-inner h3{
        font-size: 16px;
    }

    .funfact-text{
        font-size: 12px;
    }
}

/* ================= MOBILE ================= */

@media (max-width: 480px){

    .funfact-section{
        padding: 0 10px;
    }

    .funfact-card{
        min-width: 260px;
        max-width: 260px;
    }

    .funfact-icon{
        width: 50px;
        height: 50px;
        font-size: 18px;
    }

    .funfact-inner{
        border-radius: 16px;
    }

    .funfact-body img{
        height: 140px;
    }

    .funfact-inner h3{
        font-size: 15px;
    }

    .funfact-text{
        font-size: 11px;
    }
}

</style>
<?php $funfact = $funfact ?? []; ?>
</div>
<section class="funfact-section">

    <div class="mb-4">
    <h4 id="titleFunfact" class="text-dark fw-bold">Funfact</h4>
        <p>Informasi dan Edukasi Berdasarkan Sumber Terpercaya</p>
    </div>

    <div class="funfact-scroll">

    <?php foreach($funfact as $f): ?>

    <div class="funfact-card">

        <div class="funfact-icon">
            <i class="fa-solid fa-lightbulb"></i>
        </div>

        <div class="funfact-inner">

            <h3><?= esc((string)$f['judul_funfact']) ?></h3>

            <div class="funfact-body">
            <div class="funfact-text-wrapper">
                <div class="funfact-text">
                    <?= character_limiter(strip_tags((string)$f['isi_funfact']), 180) ?>
                </div>
                <br>
                <a href="<?= base_url('berita/funfact_user/' . $f['id_funfact']) ?>" class="funfact-btn">
                            Baca Selengkapnya →
                </a>
            </div>
                <img src="<?= base_url('uploads/funfact/' . $f['gambar_funfact']) ?>">
                

            </div>

        </div>

    </div>

    <?php endforeach; ?>

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

    // ================= DATA GRAFIK MORTALITAS =================
    $builderMort = $db->table('pasien');
    $builderMort->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah');
    $builderMort->where('pasien.id_penyakit', 1);
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
function updateMap(){
    let tahun = document.getElementById("periodeMap").value;
    let bulan = document.getElementById("bulanMap").value;
    let url = new URL(window.location.href);

    url.searchParams.set('tahun_map', tahun);
    url.searchParams.set('bulan_map', bulan);
    window.location.href = url.toString();
}

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

document.addEventListener("DOMContentLoaded", function() {

   // --- LOGIKA AUTO SCROLL SETELAH REFRESH/FILTER ---
const urlParams = new URLSearchParams(window.location.search);

const hasFilter =
    urlParams.has('wilayah') ||
    urlParams.has('usia') ||
    urlParams.has('jk') ||
    urlParams.has('bulan') ||
    urlParams.has('tahun') ||
    urlParams.has('tab') ||
    urlParams.has('wilayah_abj') ||
    urlParams.has('bulan_abj') ||
    urlParams.has('tahun_abj') ||
    urlParams.has('wilayah_mort') ||
    urlParams.has('tahun_mort') ||
    urlParams.has('jk_mort');

// cek apakah cuma filter map
const hanyaFilterMap =
    (urlParams.has('tahun_map') || urlParams.has('bulan_map')) &&
    !hasFilter;

// AUTO SCROLL hanya untuk grafik
if (hasFilter && !hanyaFilterMap) {
    const grafikSection = document.getElementById('grafik');

    if (grafikSection) {
        grafikSection.scrollIntoView({
            behavior: 'auto',
            block: 'start'
        });
    }
}
// ================= GRAFIK KASUS =================
const ctxKasus = document.getElementById('chartKasus').getContext('2d');

const grafik = <?= json_encode($grafik) ?>;

const labels = grafik.map(item => item.wilayah);

const dataAnak = grafik.map(item => item.anak);
const dataRemaja = grafik.map(item => item.remaja);
const dataDewasa = grafik.map(item => item.dewasa);
const dataLansia = grafik.map(item => item.lansia);

const usiaFilter = "<?= request()->getGet('usia') ?>";

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
        data: dataAnak,
        backgroundColor: '#0F766E'
    });

} else if (usiaFilter === 'remaja') {

    datasetsKasus.push({
        label: labelUsiaKasus.remaja,
        data: dataRemaja,
        backgroundColor: '#06B6D4'
    });

} else if (usiaFilter === 'dewasa') {

    datasetsKasus.push({
        label: labelUsiaKasus.dewasa,
        data: dataDewasa,
        backgroundColor: '#7DD3FC'
    });

} else if (usiaFilter === 'lansia') {

    datasetsKasus.push({
        label: labelUsiaKasus.lansia,
        data: dataLansia,
        backgroundColor: '#14B8A6'
    });

} else {

    datasetsKasus = [
        {
            label: labelUsiaKasus.anak,
            data: dataAnak,
            backgroundColor: '#0F766E'
        },
        {
            label: labelUsiaKasus.remaja,
            data: dataRemaja,
            backgroundColor: '#06B6D4'
        },
        {
            label: labelUsiaKasus.dewasa,
            data: dataDewasa,
            backgroundColor: '#7DD3FC'
        },
        {
            label: labelUsiaKasus.lansia,
            data: dataLansia,
            backgroundColor: '#14B8A6'
        }
    ];

}

new Chart(ctxKasus, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: datasetsKasus
    },
    options: {
    responsive: true,
    maintainAspectRatio: false,

    plugins: {
        legend: {
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
        y: {
            beginAtZero: true,
            grid: {
                color: 'rgba(0,0,0,0.05)',
                drawBorder: false
            },
            ticks: {
                padding: 10
            }
        },

        x: {
            grid: {
                display: false
            },
            ticks: {
                padding: 8
            }
        }
    },

    animation: {
        duration: 1200,
        easing: 'easeOutQuart'
    }

    }
});



    // --- GRAFIK MORTALITAS ---
    const rawDataMort = <?= json_encode($dataFinalMort) ?>;
    const colorMapping = { 'Antirogo': '#1f4e5b', 'Sumbersari': '#00BBC2', 'Karangrejo': '#b2dfdb', 'Tegalgede': '#5cb85c', 'Wirolegi': '#4fc3f7' };
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

    // --- GRAFIK ABJ ---
    const rawDataABJ = <?= json_encode($dataFinalABJ) ?>;
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
function openPendudukModal(){
    document.getElementById("pendudukModal").style.display="flex";
}

function closePendudukModal(){
    document.getElementById("pendudukModal").style.display="none";
}

window.onclick=function(e){

    let modalPenduduk=document.getElementById("pendudukModal");

    if(e.target===modalPenduduk){
        closePendudukModal();
    }
}
function showTambahForm(){

    let form=document.getElementById("formTambah");

    if(form.style.display=="none"){
        form.style.display="block";
    }else{
        form.style.display="none";
    }

}
function hitungTotalManual() {
    let l = parseInt(document.getElementById('input_laki').value) || 0;
    let p = parseInt(document.getElementById('input_perempuan').value) || 0;
    document.getElementById('display_total').value = l + p;
}

function editPenduduk(kelurahan, laki, perempuan) {
    document.getElementById("formTambah").style.display = "block";
    document.getElementById("kelurahan").value = kelurahan; // Input readonly
    document.getElementById("input_laki").value = laki;
    document.getElementById("input_perempuan").value = perempuan;
    hitungTotalManual();
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