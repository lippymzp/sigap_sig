<?php helper('text'); ?>

<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>
<?= $this->section('content') ?>

<!-- WELCOME -->
<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai ADMIN</h3>
        <p>Puskesmas Ajung, Jember</p>
    </div>

    <div class="welcome-icon">
        <i class="fa-solid fa-map"></i>
    </div>
</div>

<!-- STAT -->
<div class="stat-row">

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-chart-column"></i>
        </div>
        <div class="stat-info">
           <h3 class="red"><?= $totalKasus ?></h3>
            <p>Total Kasus Aktif Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-arrow-up"></i>
            <i class="fa-solid fa-arrow-down"></i>
        </div>
        <div class="stat-info">
            <h3 class="green"><?= $kasusBaru ?></h3>
            <p>Kasus Baru Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-map"></i>
        </div>
        <div class="stat-info">
            <h3 class="blue"><?= $kelurahanTerdampak ?></h3>
            <p>Kelurahan Terdampak</p>
        </div>
    </div>

</div>

<!-- =====================================================================
     PETA - QUERY DATA DENGAN POINT PREVALENCE RATE
     Rumus: PPR = (Jumlah Penderita / Jumlah Penduduk) x 100.000
     Data Penduduk Kecamatan Ajung (Dinas Kependudukan Kab. Jember):
       - SUKAMAKMUR  : 12.351
       - MANGARAN    : 14.255  (nama di DB: Manggaran)
       - PANCAKARYA  : 12.899
       - AJUNG       : 19.339
       - KLOMPANGAN  : 11.201
       - WIROWONGSO  : 11.142
       - ROWOINDAH   : 5.935
     Threshold warna (per 100.000 penduduk):
       Tinggi  : PPR >= 200
       Sedang  : PPR >= 50
       Rendah  : PPR <  50
===================================================================== -->
<?php
$db = \Config\Database::connect();

/* ============================================================
   DATA PENDUDUK PER KELURAHAN (Sumber: Dinas Dukcapil Jember)
   Key = nama kelurahan dinormalisasi (lowercase, tanpa spasi extra)
============================================================ */
$populasiPenduduk = [
    'sukamakmur'  => 12351,
    'suka makmur' => 12351,
    'mangaran'    => 14255,
    'manggaran'   => 14255,
    'pancakarya'  => 12899,
    'ajung'       => 19339,
    'klompangan'  => 11201,
    'klompongan'  => 11201,
    'wirowongso'  => 11142,
    'rowoindah'   => 5935,
    'rowo indah'  => 5935,
];

/* ============================================================
   QUERY DATA PASIEN PNEUMONIA (id_penyakit = 3) DARI DB
   Ambil semua kolom yang dibutuhkan untuk filter JS
============================================================ */
$builder = $db->table('pasien p');
$builder->select("
    w.kelurahan as desa,
    p.jenis_kelamin,
    p.umur,
    p.tgl_kunjungan,
    COUNT(p.id_pasien) as kasus
");
$builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');
$builder->where('p.id_penyakit', 3);
$builder->groupBy("
    w.kelurahan,
    p.jenis_kelamin,
    MONTH(p.tgl_kunjungan),
    YEAR(p.tgl_kunjungan)
");
$pneumonia = $builder->get()->getResultArray();

/* ============================================================
   BUAT DAFTAR TAHUN TERSEDIA
============================================================ */
$tahunList = [];
foreach ($pneumonia as $item) {
    if (!empty($item['tgl_kunjungan'])) {
        $tahunData = date('Y', strtotime($item['tgl_kunjungan']));
        if ($tahunData == '2025' || $tahunData == '2026') {
            $tahunList[] = $tahunData;
        }
    }
}
$tahunList = array_unique($tahunList);
$tahunList = array_unique(array_merge(['2026', '2025'], $tahunList));
rsort($tahunList);
if(empty($tahunList)){
    $tahunList = [2026, 2025];
}
?>

<!-- MAP -->
<div class="section-card" id="petaSebaran">

    <!-- =========================
        HALAMAN MAP
    ========================== -->
    <div id="mapPage">

        <div class="section-block">

            <div class="section-header">
                <div>
                    <h5>Peta Interaktif Penyebaran</h5>
                    <p class="sub">Visualisasi kepadatan kasus berdasarkan wilayah (Point Prevalence Rate per 100.000 penduduk)</p>
                </div>
            </div>

            <div class="inner-card">

                <!-- FILTER -->
                <div class="filter-wrapper">

                    <div class="filter-left">

                        <div class="filter-group">
                            <label>Pilih Bulan</label>
                            <select id="filterBulan">
                                <option value="">All</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Periode</label>
                            <select id="filterTahun">
                                <option value="">All</option>
                                <?php foreach($tahunList as $tahun): ?>
                                    <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Jenis Kelamin</label>
                            <select id="filterJk">
                                <option value="">All</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                    </div>

                    <div class="filter-right">
                        <button type="button" id="btnFilter" class="btn-filter">Filter</button>
                        <button type="button" id="btnReset" class="btn-reset">Reset</button>
                    </div>

                </div>

                <!-- MAP -->
                <div class="map-wrapper">

                    <div id="map"></div>

                    <!-- KETERANGAN -->
                    <div class="map-legend-box">
                        <h6>Keterangan PPR:</h6>

                        <div class="legend-item">
                            <span class="legend-color legend-tinggi"></span>
                            <div>
                                <b>Risiko Tinggi</b>
                                <div style="font-size:10px;color:#666;" id="legendTinggiVal">33% tertinggi</div>
                            </div>
                        </div>

                        <div class="legend-item">
                            <span class="legend-color legend-sedang"></span>
                            <div>
                                <b>Risiko Sedang</b>
                                <div style="font-size:10px;color:#666;" id="legendSedangVal">33% tengah</div>
                            </div>
                        </div>

                        <div class="legend-item">
                            <span class="legend-color legend-rendah"></span>
                            <div>
                                <b>Risiko Rendah</b>
                                <div style="font-size:10px;color:#666;" id="legendRendahVal">33% terendah</div>
                            </div>
                        </div>

                        <div class="legend-item">
                            <span class="legend-color" style="background:#d9d9d9;"></span>
                            <div>
                                <b>Tidak Ada Data</b>
                            </div>
                        </div>
                        <div style="font-size:9px;color:#888;margin-top:6px;line-height:1.4;">
                            *Klasifikasi Quantile<br>berdasarkan data lokal<br>(Jenks Natural Breaks)
                        </div>
                    </div>

                    <!-- BOX MINI AIR QUALITY -->
                    <div class="aqi-mini-box" id="aqiMiniBox">
                        <div class="aqi-mini-main">
                            <span class="aqi-mini-icon">AQI</span> :
                            <span id="aqiMiniValue">...</span>
                        </div>
                        <div class="aqi-mini-status" id="aqiMiniStatus">
                            Memuat...
                        </div>
                    </div>

                    <!-- POPUP DETAIL AIR QUALITY -->
                    <div class="aqi-popup-box" id="aqiPopupBox">
                        <div class="aqi-popup-title" id="aqiPopupTitle">
                            Kualitas Udara Kecamatan Ajung
                        </div>

                        <div class="aqi-popup-card">

                            <div class="aqi-popup-main">
                                <span class="aqi-popup-icon">AQI</span> :
                                <span id="aqiPopupValue">...</span>
                            </div>

                            <span class="aqi-popup-status" id="aqiPopupStatus">
                                Memuat...
                            </span>

                            <div class="aqi-popup-info">
                                <p>📍 <span id="aqiLocation">Kecamatan Ajung, Kabupaten Jember, Jawa Timur, Indonesia</span></p>
                                <p>🌡 Suhu : <span id="aqiTemp">-</span>°C</p>
                                <p>💧 Kelembaban : <span id="aqiHumidity">-</span>%</p>
                                <p>🌬 Tekanan : <span id="aqiPressure">-</span> hPa</p>
                                <p>⏱ Diperbarui : <span id="aqiUpdated">-</span></p>
                            </div>

                            <div class="aqi-index-list">
                                <b>Indeks Kualitas Udara (AQI)</b>

                                <p class="aqi-good">0 - 50 : Baik</p>
                                <p class="aqi-moderate">51 - 100 : Sedang</p>
                                <p class="aqi-sensitive">101 - 150 : Tidak Sehat (Sensitif)</p>
                                <p class="aqi-unhealthy">151 - 200 : Tidak Sehat</p>
                                <p class="aqi-very">201 - 300 : Sangat Tidak Sehat</p>
                                <p class="aqi-hazard">301+ : Berbahaya</p>
                            </div>

                        </div>
                    </div>
                    <!-- END AIR QUALITY -->

                </div>

            </div>

        </div>

    </div>


    <!-- =========================
        HALAMAN DETAIL
    ========================== -->
    <div id="detailPage" style="display:none;">

        <div class="detail-card">

            <div class="detail-header">
                <h5 id="detailTitleHeader">Peta Sebaran Kasus 2025</h5>

                <div class="detail-period">
                    <span>Periode :</span>

                    <button
                        type="button"
                        class="period-btn"
                        onclick="changeDetailYear(1)"
                    >
                        ‹
                    </button>

                    <b id="detailYear">
                        <?= !empty($tahunList[0]) ? $tahunList[0] : '2025' ?>
                    </b>

                    <button
                        type="button"
                        class="period-btn"
                        onclick="changeDetailYear(-1)"
                    >
                        ›
                    </button>
                </div>
            </div>

            <div class="detail-inner">

                <div class="detail-top">
                    <div>
                        <h3 id="detailWilayah">Kecamatan Ajung</h3>

                        <p class="detail-label">Total Kasus</p>
                        <h4 id="detailTotal">0 kasus</h4>

                        <p class="detail-label">Jumlah Penduduk</p>
                        <h4 id="detailPenduduk">- jiwa</h4>

                        <p class="detail-label">Point Prevalence Rate</p>
                        <h4 id="detailPPR" style="color:#0aa9b5;">0 per 100.000</h4>

                        <p class="detail-label" id="detailBulanLabel">Kasus Baru</p>
                        <h4 id="detailKasusBaru">0 kasus</h4>
                    </div>

                    <span id="detailKategori" class="badge-risk rendah">Rendah</span>
                </div>

                <h4 class="chart-title">10 Wilayah dengan PPR Tertinggi</h4>

                <div id="rankingChart" class="ranking-chart"></div>

            </div>

            <div class="detail-footer">
                <button type="button" class="btn-kembali" onclick="backToMap()">Kembali</button>
            </div>

        </div>

    </div>

</div>


<!-- SCRIPT MAP DENGAN POINT PREVALENCE RATE -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ============================================================
       DATA PENDUDUK PER DESA (dari Dinas Dukcapil Jember)
       Key = nama desa lowercase tanpa spasi (setelah normalisasi)
    ============================================================ */
    var POPULASI = {
        "sukamakmur"  : 12351,
        "mangaran"    : 14255,
        "manggaran"   : 14255,
        "pancakarya"  : 12899,
        "ajung"       : 19339,
        "klompangan"  : 11201,
        "klompongan"  : 11201,
        "wirowongso"  : 11142,
        "rowoindah"   : 5935
    };

    /* Konstanta PPR (k = 100.000) */
    var K_PPR = 100000;

    /*
     * THRESHOLD DINAMIS - Quantile 3 Kelas (Natural Breaks sederhana)
     * Referensi metode: Supratiknyo & Siwiendrayanti, HIGEIA Journal 2024;
     *                   Spatial Modeling of Risk Factors Pneumonia, NIH/PMC 2025
     * Threshold TIDAK dipatok angka tetap, melainkan dihitung otomatis
     * dari distribusi nilai PPR seluruh desa pada saat filter diterapkan.
     * - 33% nilai PPR tertinggi  → Tinggi  (merah)
     * - 33% nilai PPR tengah     → Sedang  (kuning)
     * - 33% nilai PPR terendah   → Rendah  (hijau)
     */
    var _thresholdTinggi = null;
    var _thresholdSedang = null;

    function hitungThresholdQuantile(dataFinal){
        var nilaiPPR = [];
        for(var k in dataFinal){
            if(dataFinal[k].ppr !== null && dataFinal[k].ppr > 0){
                nilaiPPR.push(dataFinal[k].ppr);
            }
        }
        if(nilaiPPR.length === 0){
            _thresholdTinggi = null;
            _thresholdSedang = null;
            return;
        }
        nilaiPPR.sort(function(a, b){ return a - b; });
        var n = nilaiPPR.length;
        /* Potong di 33% dan 66% dari distribusi */
        var idx33 = Math.floor(n * 0.33);
        var idx66 = Math.floor(n * 0.66);
        _thresholdSedang = nilaiPPR[idx33];
        _thresholdTinggi = nilaiPPR[idx66];
        /* Jika semua nilai sama (hanya 1 desa), beri sedikit spread */
        if(_thresholdSedang === _thresholdTinggi){
            _thresholdSedang = _thresholdTinggi * 0.5;
        }
    }

    var dataPneu = <?= json_encode($pneumonia ?? []) ?>;

    var map;
    var geoLayer;
    var geoJsonData;
    var currentDataFinal = {};
    var availableYears = <?= json_encode(array_values($tahunList)) ?>;
    availableYears = Array.from(
        new Set(
            availableYears.concat(["2026", "2025"]).map(String)
        )
    ).sort(function(a, b){
        return parseInt(b) - parseInt(a);
    });

    var selectedYearIndex = 0;
    var selectedDetailYear = availableYears.length > 0 ? parseInt(availableYears[0]) : 2025;
    var selectedDetailKey = "";
    var selectedDetailNama = "";

    /* ============================================================
       FUNGSI NORMALISASI NAMA
    ============================================================ */
    function fixNama(nama){
        return (nama || "")
            .toString()
            .toLowerCase()
            .trim()
            .replace(/desa/g, "")
            .replace(/kelurahan/g, "")
            .replace(/kecamatan/g, "")
            .replace(/\./g, "")
            .replace(/-/g, " ")
            .replace(/_/g, " ")
            .replace(/\s+/g, " ")
            .replace(/[^a-z0-9 ]/g, "")
            .trim();
    }

    function fixKey(nama){
        var key = fixNama(nama).replace(/\s+/g, "");

        var alias = {
            "klompongan"   : "klompangan",
            "klomplangan"  : "klompangan",
            "rowoindah"    : "rowoindah",
            "pancakarya"   : "pancakarya",
            "sukamakmur"   : "sukamakmur",
            "wirowongso"   : "wirowongso",
            "mangaran"     : "manggaran",
            "manggaran"    : "manggaran",
            "ajung"        : "ajung"
        };

        if(alias[key]){
            return alias[key];
        }

        return key;
    }

    /* ============================================================
       FUNGSI AMBIL NILAI DARI ITEM DATA
    ============================================================ */
    function getDesa(item){
        return item.desa
            || item.DESA
            || item.kelurahan
            || item.KELURAHAN
            || item.wilayah
            || item.WILAYAH
            || item.nama_desa
            || item.NAMA_DESA
            || item.nama_kelurahan
            || item.NAMA_KELURAHAN
            || item.nama_wilayah
            || item.NAMA_WILAYAH
            || item.NAMOBJ
            || item.namobj
            || item.WADMKD
            || item.wadmkd
            || "";
    }

    function getKasus(item){
        var nilai = item.kasus
            || item.KASUS
            || item.jumlah_kasus
            || item.JUMLAH_KASUS
            || item.total_kasus
            || item.TOTAL_KASUS
            || item.total
            || item.TOTAL
            || item.jumlah
            || item.JUMLAH
            || item.nilai
            || item.NILAI
            || 0;

        nilai = nilai.toString().replace(/[^0-9]/g, "");
        return parseInt(nilai || 0);
    }

    function getTahun(item){
        if(item.tgl_kunjungan){
            return item.tgl_kunjungan.toString().substring(0,4);
        }
        return "";
    }

    function getBulan(item){
        if(item.tgl_kunjungan){
            return parseInt(item.tgl_kunjungan.toString().substring(5,7));
        }
        return "";
    }

    function getJk(item){
        return item.jenis_kelamin
            || item.JENIS_KELAMIN
            || item.jk
            || item.JK
            || item.gender
            || item.GENDER
            || item.kelamin
            || item.KELAMIN
            || "";
    }

    function namaBulan(angka){
        var bulan = {
            "1":"Januari","2":"Februari","3":"Maret","4":"April",
            "5":"Mei","6":"Juni","7":"Juli","8":"Agustus",
            "9":"September","10":"Oktober","11":"November","12":"Desember"
        };
        return bulan[angka] || "Semua Bulan";
    }

    function getWaktuSaatIni(){
        var tanggalSekarang = new Date();
        var bulanSekarang = tanggalSekarang.getMonth() + 1;
        var tahunSekarang = tanggalSekarang.getFullYear();
        return {
            bulan: bulanSekarang,
            tahun: tahunSekarang,
            label: namaBulan(bulanSekarang) + " " + tahunSekarang
        };
    }

    /* ============================================================
       FUNGSI HITUNG PPR
       PPR = (Jumlah Penderita / Jumlah Penduduk) x 100.000
    ============================================================ */
    function hitungPPR(totalKasus, keyDesa){
        var populasi = POPULASI[keyDesa];
        if(!populasi || populasi <= 0){
            return null; /* populasi tidak diketahui */
        }
        return (totalKasus / populasi) * K_PPR;
    }

    /* ============================================================
       FUNGSI KATEGORI BERDASARKAN PPR
    ============================================================ */
    function kategoriDariPPR(ppr){
        if(ppr === null){
            return "nodata";
        }
        if(ppr === 0){
            return "rendah";
        }
        if(_thresholdTinggi !== null && ppr >= _thresholdTinggi){
            return "tinggi";
        }else if(_thresholdSedang !== null && ppr >= _thresholdSedang){
            return "sedang";
        }else{
            return "rendah";
        }
    }

    function warnaKategori(kategori){
        if(kategori === "tinggi")  return "#ff3131";
        if(kategori === "sedang")  return "#ffcc00";
        if(kategori === "rendah")  return "#42a447";
        return "#d9d9d9"; /* nodata */
    }

    function textKategori(kategori){
        if(kategori === "tinggi")  return "Tinggi";
        if(kategori === "sedang")  return "Sedang";
        if(kategori === "rendah")  return "Rendah";
        return "Tidak Ada Data";
    }

    /* ============================================================
       BUILD DATA FINAL DENGAN PPR
    ============================================================ */
    function buildDataFinal(){
        var bulan  = document.getElementById("filterBulan").value;
        var tahun  = document.getElementById("filterTahun").value;
        var jk     = document.getElementById("filterJk").value;

        var hasil = {};

        dataPneu.forEach(function(item){

            var itemTahun  = getTahun(item).toString();
            var itemBulan  = getBulan(item).toString();
            var itemJk     = getJk(item).toString().toLowerCase().trim();
            var filterJkLc = jk.toString().toLowerCase().trim();

            if(tahun && itemTahun && itemTahun !== tahun) return;
            if(bulan && itemBulan && itemBulan !== bulan) return;
            if(jk && itemJk && itemJk !== filterJkLc) return;

            var desaAsli = getDesa(item);
            var desaKey  = fixKey(desaAsli);
            if(!desaKey) return;

            if(!hasil[desaKey]){
                hasil[desaKey] = {
                    nama     : desaAsli,
                    total    : 0,
                    kasusBaru: 0,
                    ppr      : 0,
                    kategori : "rendah",
                    populasi : POPULASI[desaKey] || null
                };
            }

            hasil[desaKey].total     += getKasus(item);
            hasil[desaKey].kasusBaru += getKasus(item);
        });

        /* Hitung PPR dulu semua, lalu hitung threshold quantile, baru kategori */
        /* Langkah 1: hitung semua nilai PPR */
        for(var key in hasil){
            var ppr = hitungPPR(hasil[key].total, key);
            hasil[key].ppr      = ppr;
            hasil[key].populasi = POPULASI[key] || null;
        }
        /* Langkah 2: hitung threshold quantile dari distribusi PPR aktual */
        hitungThresholdQuantile(hasil);
        /* Langkah 3: tentukan kategori berdasarkan threshold dinamis */
        for(var key in hasil){
            hasil[key].kategori = kategoriDariPPR(hasil[key].ppr);
        }

        currentDataFinal = hasil;
        return hasil;
    }

    function getNamaGeo(feature){
        return feature.properties.NAMOBJ
            || feature.properties.namobj
            || feature.properties.nama
            || feature.properties.name
            || feature.properties.DESA
            || feature.properties.desa
            || feature.properties.WADMKD
            || feature.properties.wadmkd
            || feature.properties.KELURAHAN
            || feature.properties.kelurahan
            || "Wilayah";
    }

    /* ============================================================
       AIR QUALITY INDEX - IQAIR API
    ============================================================ */
    var IQAIR_API_KEY  = "d1160a02-9aa4-4404-86cd-4514f1e18d18";
    var AQI_LAT        = -8.1739;
    var AQI_LON        = 113.6473;
    var AQI_NAMA_LOKASI  = "Kecamatan Ajung, Kabupaten Jember, Jawa Timur, Indonesia";
    var AQI_JUDUL_POPUP  = "Kualitas Udara Kecamatan Ajung";

    function getKategoriAQI(aqi){
        aqi = parseInt(aqi || 0);
        if(aqi <= 50)  return { teks: "Baik",                   className: "aqi-status-baik" };
        if(aqi <= 100) return { teks: "Sedang",                 className: "aqi-status-sedang" };
        if(aqi <= 150) return { teks: "Tidak Sehat (Sensitif)", className: "aqi-status-sensitif" };
        if(aqi <= 200) return { teks: "Tidak Sehat",            className: "aqi-status-tidak-sehat" };
        if(aqi <= 300) return { teks: "Sangat Tidak Sehat",     className: "aqi-status-sangat-tidak-sehat" };
        return { teks: "Berbahaya", className: "aqi-status-berbahaya" };
    }

    function formatTanggalAQI(tanggalApi){
        if(!tanggalApi) return "-";
        var tanggal = new Date(tanggalApi);
        if(isNaN(tanggal.getTime())) return tanggalApi;
        return tanggal.toLocaleString("id-ID", {
            day:"2-digit", month:"long", year:"numeric", hour:"2-digit", minute:"2-digit"
        });
    }

    function setStatusClassAQI(element, className){
        element.classList.remove(
            "aqi-status-baik","aqi-status-sedang","aqi-status-sensitif",
            "aqi-status-tidak-sehat","aqi-status-sangat-tidak-sehat","aqi-status-berbahaya"
        );
        element.classList.add(className);
    }

    function isiDataAQI(dataApi){
        if(!dataApi || dataApi.status !== "success"){
            document.getElementById("aqiMiniValue").innerText  = "-";
            document.getElementById("aqiMiniStatus").innerText = "Gagal";
            document.getElementById("aqiPopupValue").innerText  = "-";
            document.getElementById("aqiPopupStatus").innerText = "Data gagal dimuat";
            return;
        }
        var data      = dataApi.data;
        var pollution = data.current && data.current.pollution ? data.current.pollution : {};
        var weather   = data.current && data.current.weather   ? data.current.weather   : {};
        var aqi       = pollution.aqius || 0;
        var kategori  = getKategoriAQI(aqi);

        document.getElementById("aqiMiniValue").innerText   = aqi;
        document.getElementById("aqiMiniStatus").innerText  = kategori.teks;
        document.getElementById("aqiPopupTitle").innerText  = AQI_JUDUL_POPUP;
        document.getElementById("aqiPopupValue").innerText  = aqi;
        document.getElementById("aqiPopupStatus").innerText = kategori.teks;
        document.getElementById("aqiLocation").innerText    = AQI_NAMA_LOKASI;
        document.getElementById("aqiTemp").innerText        = weather.tp  ?? "-";
        document.getElementById("aqiHumidity").innerText    = weather.hu  ?? "-";
        document.getElementById("aqiPressure").innerText    = weather.pr  ?? "-";
        document.getElementById("aqiUpdated").innerText     = formatTanggalAQI(pollution.ts);

        setStatusClassAQI(document.getElementById("aqiMiniStatus"),  kategori.className);
        setStatusClassAQI(document.getElementById("aqiPopupStatus"), kategori.className);
    }

    function ambilDataAQI(){
        var url = "https://api.airvisual.com/v2/nearest_city" +
                  "?lat=" + AQI_LAT + "&lon=" + AQI_LON + "&key=" + IQAIR_API_KEY;
        fetch(url)
            .then(function(response){ return response.json(); })
            .then(function(data){ isiDataAQI(data); })
            .catch(function(error){
                console.error("Gagal mengambil data AQI:", error);
                document.getElementById("aqiMiniValue").innerText   = "-";
                document.getElementById("aqiMiniStatus").innerText  = "Gagal";
                document.getElementById("aqiPopupValue").innerText  = "-";
                document.getElementById("aqiPopupStatus").innerText = "Data gagal dimuat";
            });
    }

    function aktifkanPopupAQI(){
        var miniBox  = document.getElementById("aqiMiniBox");
        var popupBox = document.getElementById("aqiPopupBox");
        if(!miniBox || !popupBox) return;
        miniBox.addEventListener("click", function(e){
            e.stopPropagation();
            popupBox.style.display = "block";
        });
        popupBox.addEventListener("click", function(e){
            e.stopPropagation();
            popupBox.style.display = "none";
        });
        document.addEventListener("click", function(){
            popupBox.style.display = "none";
        });
    }

    /* ============================================================
       INISIALISASI MAP
    ============================================================ */
    function initMap(){
        var mapElement = document.getElementById("map");
        if(!mapElement) return;

        map = L.map("map", { zoomControl: true }).setView([-7.9, 112.6], 10);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "Leaflet"
        }).addTo(map);

        aktifkanPopupAQI();
        ambilDataAQI();

        fetch("<?= base_url('assets/peta/pneumonia.geojson') ?>")
            .then(function(res){ return res.json(); })
            .then(function(data){
                geoJsonData = data;
                renderGeoJson();
            });

        setTimeout(function(){ map.invalidateSize(); }, 300);
    }

    /* ============================================================
       RENDER GEOJSON DENGAN WARNA BERDASARKAN PPR
    ============================================================ */
    /* Update teks legend kotak kiri bawah peta setelah threshold dihitung */
    function updateLegendText(){
        var elT = document.getElementById("legendTinggiVal");
        var elS = document.getElementById("legendSedangVal");
        var elR = document.getElementById("legendRendahVal");
        if(!elT || !elS || !elR) return;

        if(_thresholdTinggi === null){
            elT.innerText = "Tidak ada data";
            elS.innerText = "-";
            elR.innerText = "-";
            return;
        }
        elT.innerText = "PPR ≥ " + _thresholdTinggi.toFixed(1) + " /100rb";
        elS.innerText = "PPR " + _thresholdSedang.toFixed(1) + "–" + (_thresholdTinggi - 0.1).toFixed(1) + " /100rb";
        elR.innerText = "PPR < " + _thresholdSedang.toFixed(1) + " /100rb";
    }

    function renderGeoJson(){
        var dataFinal = buildDataFinal();

        /* Update teks threshold di legend setelah quantile dihitung */
        updateLegendText();

        if(geoLayer){
            map.removeLayer(geoLayer);
        }

        geoLayer = L.geoJSON(geoJsonData, {

            style: function(feature){
                var nama     = getNamaGeo(feature);
                var key      = fixKey(nama);
                var item     = dataFinal[key];

                var kategori = item ? item.kategori : "nodata";
                var warna    = warnaKategori(kategori);

                return {
                    color       : "#23a39a",
                    weight      : 2,
                    fillColor   : warna,
                    fillOpacity : item ? 0.75 : 0.55
                };
            },

            onEachFeature: function(feature, layer){
                var nama     = getNamaGeo(feature);
                var key      = fixKey(nama);
                var item     = dataFinal[key];

                var total    = item ? item.total    : 0;
                var ppr      = item ? item.ppr      : null;
                var kategori = item ? item.kategori : "nodata";
                var populasi = item ? item.populasi : (POPULASI[key] || null);

                var pprTeks  = (ppr !== null) ? ppr.toFixed(2) + " / 100.000" : "Tidak tersedia";
                var popTeks  = populasi ? populasi.toLocaleString("id-ID") + " jiwa" : "Data tidak tersedia";

                var statusData = (!item || !POPULASI[key])
                    ? '<br><span class="popup-empty">Data populasi tidak tersedia</span>'
                    : '';

                var isiPopup = `
                    <div class="popup-informasi" onclick="showDetailWilayah('${key}', decodeURIComponent('${encodeURIComponent(nama)}'))">
                        <b>Informasi Epidemiologi :</b><br>
                        <span>Desa : <b>${nama}</b></span><br>
                        <span>Jumlah Kasus : <b>${total}</b></span><br>
                        <span>Jumlah Penduduk : <b>${popTeks}</b></span><br>
                        <span>PPR : <b style="color:#0aa9b5;">${pprTeks}</b></span><br>
                        <span>
                            Tingkat Risiko :
                            <b class="popup-${kategori}">${textKategori(kategori)}</b>
                        </span>
                        ${statusData}
                        <hr>
                        <small>Klik untuk selengkapnya...</small>
                    </div>
                `;

                layer.bindPopup(isiPopup, {
                    closeButton: true,
                    className: "popup-info-custom"
                });

                layer.bindTooltip(nama, {
                    permanent: true,
                    direction: "center",
                    className: "label-desa"
                });

                layer.on("click", function(){ layer.openPopup(); });

                layer.on("mouseover", function(){
                    layer.setStyle({ weight: 4, fillOpacity: 0.85 });
                });

                layer.on("mouseout", function(){
                    geoLayer.resetStyle(layer);
                });
            }

        }).addTo(map);

        map.fitBounds(geoLayer.getBounds());
    }

    /* ============================================================
       HITUNG KASUS BARU BULAN INI (UNTUK DETAIL WILAYAH)
    ============================================================ */
    function hitungKasusBaruTerkiniWilayah(keyWilayah){
        var waktuSaatIni = getWaktuSaatIni();
        var jk           = document.getElementById("filterJk").value;
        var filterJkLc   = jk.toString().toLowerCase().trim();
        var totalKasusBaru = 0;

        dataPneu.forEach(function(item){
            var desaKey   = fixKey(getDesa(item));
            var itemTahun = getTahun(item).toString();
            var itemBulan = getBulan(item).toString();
            var itemJk    = getJk(item).toString().toLowerCase().trim();

            if(desaKey !== keyWilayah) return;
            if(itemTahun !== waktuSaatIni.tahun.toString()) return;
            if(itemBulan !== waktuSaatIni.bulan.toString()) return;
            if(jk && itemJk !== filterJkLc) return;

            totalKasusBaru += getKasus(item);
        });

        return totalKasusBaru;
    }

    /* ============================================================
       BUILD DATA DETAIL BERDASARKAN TAHUN (DENGAN PPR)
    ============================================================ */
    function buildDataDetailByYear(tahunDetail){
        var bulan    = document.getElementById("filterBulan").value;
        var jk       = document.getElementById("filterJk").value;
        var hasil    = {};

        dataPneu.forEach(function(item){
            var itemTahun  = getTahun(item).toString();
            var itemBulan  = getBulan(item).toString();
            var itemJk     = getJk(item).toString().toLowerCase().trim();
            var filterJkLc = jk.toString().toLowerCase().trim();

            if(itemTahun !== tahunDetail.toString()) return;
            if(bulan && itemBulan !== bulan)          return;
            if(jk && itemJk !== filterJkLc)           return;

            var desaAsli = getDesa(item);
            var desaKey  = fixKey(desaAsli);

            if(!hasil[desaKey]){
                hasil[desaKey] = {
                    nama    : desaAsli,
                    total   : 0,
                    kasusBaru: 0,
                    ppr     : 0,
                    kategori: "rendah",
                    populasi: POPULASI[desaKey] || null
                };
            }

            hasil[desaKey].total     += getKasus(item);
            hasil[desaKey].kasusBaru += getKasus(item);
        });

        /* Hitung PPR dulu semua, lalu threshold quantile, baru kategori */
        for(var key in hasil){
            var ppr = hitungPPR(hasil[key].total, key);
            hasil[key].ppr      = ppr;
            hasil[key].populasi = POPULASI[key] || null;
        }
        hitungThresholdQuantile(hasil);
        for(var key in hasil){
            hasil[key].kategori = kategoriDariPPR(hasil[key].ppr);
        }

        return hasil;
    }

    /* ============================================================
       TAMPILKAN HALAMAN DETAIL WILAYAH
    ============================================================ */
    window.showDetailWilayah = function(key, namaWilayah){
        selectedDetailKey  = key;
        selectedDetailNama = namaWilayah;

        var tahun = document.getElementById("filterTahun").value || availableYears[0] || "2025";
        selectedDetailYear  = parseInt(tahun);
        selectedYearIndex   = availableYears.indexOf(selectedDetailYear.toString());
        if(selectedYearIndex < 0) selectedYearIndex = 0;

        currentDataFinal = buildDataDetailByYear(selectedDetailYear);

        var item = currentDataFinal[key] || {
            nama: namaWilayah, total: 0, kasusBaru: 0, ppr: null,
            kategori: "nodata", populasi: POPULASI[key] || null
        };

        document.getElementById("mapPage").style.display    = "none";
        document.getElementById("detailPage").style.display = "block";

        document.getElementById("detailTitleHeader").innerText = "Peta Sebaran Kasus " + selectedDetailYear;
        document.getElementById("detailYear").innerText        = selectedDetailYear;
        document.getElementById("detailWilayah").innerText     = "Kelurahan " + namaWilayah;
        document.getElementById("detailTotal").innerText       = item.total + " kasus";

        var populasiTeks = item.populasi
            ? item.populasi.toLocaleString("id-ID") + " jiwa"
            : "Data tidak tersedia";
        document.getElementById("detailPenduduk").innerText = populasiTeks;

        var pprTeks = (item.ppr !== null && item.ppr !== undefined)
            ? item.ppr.toFixed(2) + " / 100.000 penduduk"
            : "Tidak tersedia";
        document.getElementById("detailPPR").innerText = pprTeks;

        var waktuSaatIni    = getWaktuSaatIni();
        var kasusBaruTerkini = hitungKasusBaruTerkiniWilayah(key);

        document.getElementById("detailBulanLabel").innerText =
            "Kasus Baru (" + waktuSaatIni.label + ")";
        document.getElementById("detailKasusBaru").innerText  =
            kasusBaruTerkini + " kasus";

        var badge = document.getElementById("detailKategori");
        badge.innerText  = textKategori(item.kategori);
        badge.className  = "badge-risk " + item.kategori;

        renderRankingChart();
    };

    window.backToMap = function(){
        document.getElementById("detailPage").style.display = "none";
        document.getElementById("mapPage").style.display    = "block";
        setTimeout(function(){ map.invalidateSize(); }, 300);
    };

    window.changeDetailYear = function(step){
        selectedYearIndex += step;
        if(selectedYearIndex < 0)                          selectedYearIndex = 0;
        if(selectedYearIndex >= availableYears.length)     selectedYearIndex = availableYears.length - 1;

        selectedDetailYear = parseInt(availableYears[selectedYearIndex]);

        document.getElementById("detailYear").innerText        = selectedDetailYear;
        document.getElementById("detailTitleHeader").innerText = "Peta Sebaran Kasus " + selectedDetailYear;

        currentDataFinal = buildDataDetailByYear(selectedDetailYear);

        var item = currentDataFinal[selectedDetailKey] || {
            nama: selectedDetailNama, total: 0, kasusBaru: 0, ppr: null,
            kategori: "nodata", populasi: POPULASI[selectedDetailKey] || null
        };

        document.getElementById("detailTotal").innerText = item.total + " kasus";

        var populasiTeks = item.populasi
            ? item.populasi.toLocaleString("id-ID") + " jiwa"
            : "Data tidak tersedia";
        document.getElementById("detailPenduduk").innerText = populasiTeks;

        var pprTeks = (item.ppr !== null && item.ppr !== undefined)
            ? item.ppr.toFixed(2) + " / 100.000 penduduk"
            : "Tidak tersedia";
        document.getElementById("detailPPR").innerText = pprTeks;

        var waktuSaatIni     = getWaktuSaatIni();
        var kasusBaruTerkini = hitungKasusBaruTerkiniWilayah(selectedDetailKey);

        document.getElementById("detailBulanLabel").innerText =
            "Kasus Baru (" + waktuSaatIni.label + ")";
        document.getElementById("detailKasusBaru").innerText  =
            kasusBaruTerkini + " kasus";

        var badge = document.getElementById("detailKategori");
        badge.innerText = textKategori(item.kategori);
        badge.className = "badge-risk " + item.kategori;

        renderRankingChart();
    };

    /* ============================================================
       RENDER RANKING CHART BERDASARKAN PPR
    ============================================================ */
    function renderRankingChart(){
        var chart = document.getElementById("rankingChart");

        var ranking = Object.values(currentDataFinal)
            .filter(function(a){ return a.ppr !== null; })
            .sort(function(a, b){ return b.ppr - a.ppr; })
            .slice(0, 10);

        if(ranking.length === 0){
            chart.innerHTML = '<div class="empty-chart">Tidak ada data yang sesuai filter</div>';
            return;
        }

        var maxPPR = ranking[0].ppr || 1;
        var html   = "";

        ranking.forEach(function(item){
            var width    = (item.ppr / maxPPR) * 100;
            var kategori = item.kategori;
            var pprLabel = item.ppr.toFixed(1);
            var barClass = (kategori === "nodata") ? "rendah" : kategori;

            html += `
                <div class="rank-row">
                    <div class="rank-name">${item.nama.toUpperCase()}</div>
                    <div class="rank-bar-area">
                        <div class="rank-bar ${barClass}" style="width:${width}%;">
                            <span>${pprLabel}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        chart.innerHTML = html;
    }

    /* ============================================================
       EVENT LISTENER FILTER
    ============================================================ */
    document.getElementById("filterTahun").addEventListener("change", function(){
        renderGeoJson();
    });

    document.getElementById("btnFilter").addEventListener("click", function(){
        renderGeoJson();
    });

    document.getElementById("btnReset").addEventListener("click", function(){
        document.getElementById("filterBulan").value = "";
        document.getElementById("filterTahun").value = "";
        document.getElementById("filterJk").value    = "";
        renderGeoJson();
    });

    initMap();

});
</script>


<style>
/* ========================= CARD UTAMA ========================= */
.section-card{
    background:#eaf9fb;
    padding:18px;
    border-radius:16px;
    width:100%;
    font-family:'Poppins', Arial, sans-serif;
}

#petaSebaran{
    scroll-margin-top:95px;
}

.section-block{
    background:#eaf9fb;
    border-radius:16px;
}

/* ========================= HEADER MAP ========================= */
.section-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:22px;
}

.section-header h5{
    font-size:24px;
    font-weight:800;
    color:#0d3440;
    margin:0 0 8px;
}

.section-header .sub{
    font-size:15px;
    color:#60727d;
    margin:0;
}

/* ========================= CARD MAP ========================= */
.inner-card{
    background:#ffffff;
    width:100%;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 2px 9px rgba(0,0,0,0.08);
}

/* ========================= FILTER ========================= */
.filter-wrapper{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:12px;
    padding:16px 20px 12px;
    background:#ffffff;
}

.filter-left{
    display:flex;
    align-items:flex-end;
    gap:18px;
    flex-wrap:wrap;
}

.filter-group{
    display:flex;
    flex-direction:column;
}

.filter-group label{
    font-size:14px;
    color:#111;
    margin-bottom:8px;
}

.filter-group select{
    width:155px;
    height:40px;
    border:1px solid #b8d0df;
    border-radius:10px;
    padding:0 12px;
    font-size:14px;
    background:#fff;
    outline:none;
}

.filter-right{
    display:flex;
    gap:10px;
    align-items:center;
}

.btn-filter{
    border:none;
    background:#08b7c9;
    color:#fff;
    height:42px;
    padding:0 22px;
    border-radius:10px;
    font-size:16px;
    font-weight:800;
    box-shadow:0 2px 7px rgba(0,0,0,0.22);
    cursor:pointer;
}

.btn-reset{
    border:none;
    background:#ffffff;
    color:#000;
    height:42px;
    padding:0 22px;
    border-radius:10px;
    font-size:16px;
    font-weight:800;
    box-shadow:0 2px 7px rgba(0,0,0,0.22);
    cursor:pointer;
}

/* ========================= MAP ========================= */
.map-wrapper{
    position:relative;
    width:100%;
    border-radius:0;
    overflow:hidden;
}

#map{
    width:100%;
    height:510px !important;
    border-radius:0;
}

/* ========================= LABEL WILAYAH ========================= */
.label-desa{
    background:rgba(65,65,65,0.88);
    color:white;
    border:none;
    padding:5px 9px;
    font-size:12px;
    font-weight:700;
    border-radius:6px;
    box-shadow:0 2px 6px rgba(0,0,0,0.35);
}

/* ========================= KETERANGAN DI DALAM MAP ========================= */
.map-legend-box{
    position:absolute;
    left:14px;
    bottom:14px;
    width:195px;

    background:#ffffff;
    padding:12px 14px 10px;

    border-radius:8px;
    box-shadow:0 2px 8px rgba(0,0,0,0.25);
    z-index:999;
}

.map-legend-box h6{
    font-size:14px;
    font-weight:800;
    color:#000;
    margin:0 0 10px;
}

.legend-item{
    display:flex;
    align-items:center;
    gap:9px;
    margin-bottom:10px;
    font-size:11px;
    color:#000;
}

.legend-color{
    width:21px;
    height:21px;
    display:inline-block;
    flex-shrink:0;
}

.legend-tinggi{ background:#ff3131; }
.legend-sedang{ background:#ffcc00; }
.legend-rendah{ background:#42a447; }

/* ========================= AIR QUALITY INDEX BOX ========================= */
.aqi-mini-box{
    position:absolute;
    left:223px;
    bottom:14px;
    width:125px;

    background:#ffffff;
    border-radius:10px;
    padding:10px 12px;

    box-shadow:0 4px 14px rgba(0,0,0,0.25);
    z-index:1000;

    cursor:pointer;
    font-family:'Poppins', Arial, sans-serif;
}

.aqi-mini-main{
    font-size:20px;
    font-weight:800;
    color:#111827;
    line-height:1.1;
}

.aqi-mini-icon{
    color:#1976d2;
    font-weight:900;
}

.aqi-mini-status{
    margin-top:5px;
    display:inline-block;

    padding:4px 8px;
    border-radius:6px;

    font-size:12px;
    font-weight:700;

    background:#dcfce7;
    color:#16a34a;
}

.aqi-popup-box{
    display:none;

    position:absolute;
    left:223px;
    bottom:14px;
    width:360px;

    background:#ffffff;
    border-radius:12px;
    padding:12px;

    box-shadow:0 8px 25px rgba(0,0,0,0.28);
    z-index:1002;

    font-family:'Poppins', Arial, sans-serif;
    cursor:pointer;
}

.aqi-popup-title{
    font-size:13px;
    font-weight:800;
    color:#111827;
    margin:0 0 8px 4px;
}

.aqi-popup-card{
    background:#f8fafc;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:14px 16px;

    box-shadow:inset 0 2px 8px rgba(0,0,0,0.08);
}

.aqi-popup-main{
    font-size:24px;
    font-weight:900;
    color:#111827;
    line-height:1.1;
}

.aqi-popup-icon{
    color:#1976d2;
    font-weight:900;
}

.aqi-popup-status{
    display:inline-block;

    margin-top:6px;
    padding:5px 10px;
    border-radius:6px;

    font-size:12px;
    font-weight:800;

    background:#dcfce7;
    color:#16a34a;
}

.aqi-popup-info{
    margin-top:16px;
}

.aqi-popup-info p{
    margin:0 0 9px;
    font-size:12px;
    color:#111827;
    line-height:1.5;
}

.aqi-index-list{
    margin-top:18px;
}

.aqi-index-list b{
    display:block;
    margin-bottom:9px;
    font-size:12px;
    color:#111827;
}

.aqi-index-list p{
    margin:0 0 7px;
    font-size:11px;
    font-weight:600;
}

.aqi-good{ color:#16a34a; }
.aqi-moderate{ color:#f59e0b; }
.aqi-sensitive{ color:#f97316; }
.aqi-unhealthy{ color:#dc2626; }
.aqi-very{ color:#9333ea; }
.aqi-hazard{ color:#4c1d95; }

.aqi-status-baik{ background:#dcfce7 !important; color:#16a34a !important; }
.aqi-status-sedang{ background:#fef3c7 !important; color:#f59e0b !important; }
.aqi-status-sensitif{ background:#ffedd5 !important; color:#f97316 !important; }
.aqi-status-tidak-sehat{ background:#fee2e2 !important; color:#dc2626 !important; }
.aqi-status-sangat-tidak-sehat{ background:#f3e8ff !important; color:#9333ea !important; }
.aqi-status-berbahaya{ background:#ede9fe !important; color:#4c1d95 !important; }

/* ========================= POPUP ========================= */
.popup-informasi{
    min-width:180px;
    font-size:12px;
    line-height:1.7;
    cursor:pointer;
}

.popup-informasi b{ color:#000; }

.popup-informasi hr{
    margin:8px -8px 4px;
    border:0;
    border-top:1px solid #ddd;
}

.popup-informasi small{
    display:block;
    text-align:center;
    color:#aaa;
    font-size:10px;
}

.popup-tinggi{ color:red !important; }
.popup-sedang{ color:#b07d00 !important; }
.popup-rendah{ color:green !important; }
.popup-nodata{ color:#888 !important; }

.popup-empty{
    color:#d62828;
    font-weight:800;
}

.leaflet-popup-content-wrapper{ border-radius:8px; }
.leaflet-popup-content{ margin:9px 11px; }

/* ========================= DETAIL PAGE ========================= */
.detail-card{
    background:#ffffff;
    border:none;
    border-radius:18px;
    padding:24px;
    box-shadow:none;
    width:100%;
    margin:0 auto;
}

.detail-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:18px;
    padding:0 2px;
}

.detail-header h5{
    font-size:20px;
    font-weight:700;
    margin:0;
    color:#111827;
}

.detail-period{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:17px;
    color:#111827;
}

.detail-period span{ font-weight:400; }
.detail-period b{ font-size:18px; font-weight:700; }

.period-btn{
    border:none;
    background:transparent;
    color:#0891a5;
    font-size:24px;
    line-height:1;
    font-weight:800;
    cursor:pointer;
    padding:0 4px;
}

.detail-inner{
    background:#f8fafc;
    border-radius:18px;
    padding:34px 42px 42px;
    box-shadow:none;
    border:1px solid #eef2f7;
}

.detail-top{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:30px;
    margin-bottom:34px;
}

.detail-top h3{
    font-size:24px;
    font-weight:700;
    margin:0 0 18px;
    color:#111827;
}

.detail-label{
    font-size:17px;
    font-weight:400;
    margin:12px 0 4px;
    color:#374151;
    line-height:1.3;
}

.detail-top h4{
    font-size:18px;
    font-weight:700;
    margin:0 0 8px;
    color:#111827;
}

.badge-risk{
    padding:7px 16px;
    border-radius:10px;
    font-size:16px;
    font-weight:600;
    line-height:1;
    white-space:nowrap;
}

.badge-risk.tinggi{ background:#fee2e2; color:#dc2626; }
.badge-risk.sedang{ background:#fef9c3; color:#b45309; }
.badge-risk.rendah{ background:#dcfce7; color:#15803d; }
.badge-risk.nodata{ background:#f3f4f6; color:#6b7280; }

.chart-title{
    margin-top:22px;
    margin-bottom:22px;
    font-size:22px;
    font-weight:700;
    color:#111827;
}

/* ========================= CHART BATANG DETAIL ========================= */
.ranking-chart{
    width:72%;
    min-width:560px;
}

.rank-row{
    display:flex;
    align-items:center;
    margin-bottom:7px;
}

.rank-name{
    width:165px;
    text-align:right;
    padding-right:18px;
    letter-spacing:3px;
    font-size:13px;
    font-weight:700;
    color:#6b7280;
}

.rank-bar-area{
    flex:1;
    height:32px;
    border-top:1px solid #d9dee7;
    position:relative;
}

.rank-bar{
    height:23px;
    margin-top:4px;
    color:#ffffff;
    font-weight:700;
    text-align:center;
    line-height:23px;
    min-width:26px;
    border-radius:0 3px 3px 0;
}

.rank-bar.tinggi{ background:#8b0000; }
.rank-bar.sedang{ background:#e76f51; }
.rank-bar.rendah{ background:#16a34a; }
.rank-bar span{ font-size:13px; }

.empty-chart{
    padding:18px 30px;
    font-size:16px;
    font-weight:600;
    color:#6b7280;
}

.detail-footer{
    display:flex;
    justify-content:flex-end;
    margin-top:14px;
}

.btn-kembali{
    background:#08b7c9;
    color:#ffffff;
    border:none;
    border-radius:10px;
    padding:9px 42px;
    font-size:16px;
    font-weight:700;
    box-shadow:none;
    cursor:pointer;
}

.btn-kembali:hover{ background:#079bad; }

/* ========================= RESPONSIVE ========================= */
@media(max-width:768px){

    .section-card{ padding:12px; }

    .section-header{ flex-direction:column; gap:12px; }
    .section-header h5{ font-size:22px; }
    .section-header .sub{ font-size:14px; }

    .filter-wrapper{ flex-direction:column; align-items:flex-start; }
    .filter-left{ width:100%; gap:8px; }
    .filter-group label{ font-size:13px; margin-bottom:6px; }
    .filter-group select{ width:115px; height:34px; font-size:13px; }
    .filter-right{ width:100%; justify-content:flex-end; }
    .btn-filter, .btn-reset{ height:36px; font-size:14px; padding:0 16px; }

    #map{ height:330px !important; }

    .map-legend-box{ width:165px; padding:10px 12px 6px; }
    .map-legend-box h6{ font-size:13px; }
    .legend-item{ font-size:10px; margin-bottom:8px; }
    .legend-color{ width:19px; height:19px; }
    .label-desa{ font-size:10px; padding:3px 6px; }
    .popup-informasi{ min-width:160px; font-size:12px; }

    .detail-card{ padding:14px; }
    .detail-header{ flex-direction:column; align-items:flex-start; gap:10px; }
    .detail-header h5{ font-size:18px; }
    .detail-period{ font-size:15px; }
    .detail-inner{ padding:24px 18px 32px; }
    .detail-top{ flex-direction:column; gap:16px; margin-bottom:26px; }
    .detail-top h3{ font-size:21px; }
    .detail-label{ font-size:15px; }
    .detail-top h4{ font-size:17px; }
    .badge-risk{ font-size:14px; padding:7px 14px; }
    .chart-title{ font-size:19px; }
    .ranking-chart{ width:100%; min-width:100%; }
    .rank-name{ width:115px; font-size:11px; letter-spacing:2px; padding-right:10px; }
    .rank-bar-area{ height:30px; }
    .rank-bar{ height:22px; line-height:22px; }
    .btn-kembali{ width:100%; padding:10px 20px; }

}

.label-desa{
    background: rgba(0,0,0,0.6);
    color: white;
    border: none;
    padding: 2px 6px;
    font-size: 11px;
    border-radius: 6px;
}
</style>


   <!-- CHART -->
<div class="section-block" id="grafik">

    <div class="section-header">
        <div>
            <h5>Grafik Interaktif Penyebaran</h5>
            <p class="sub">Visualisasi kepadatan kasus berdasarkan grafik</p>
        </div>
    </div>

    <div class="chart-frame">

        <iframe
            src="<?= base_url('grafik_pneumonia?embed=1') ?>"
            frameborder="0">
        </iframe>
    </div>
</div>

    <p class="update-text">Diperbarui pada: 11-4-2025</p>

<!-- ARTIKEL -->
<section id="artikel" class="mt-4">

    <div id="artikel-scroll" class="artikel-scroll">
        <?php if (!empty($artikels)): ?>
            <?php foreach ($artikels as $artikel): ?>
                <div class="card-artikel">

                    <img src="<?= base_url('img/artikel/' . $artikel['gambar']) ?>" class="artikel-img" alt="<?= esc($artikel['judul']) ?>" />

                    <div class="artikel-action">
                        <a href="<?= base_url('admin/artikel/edit/' . $artikel['id']) ?>">
                            <img src="<?= base_url('img/edit.png') ?>">
                        </a>

                        <form action="<?= base_url('admin/artikel/delete/' . $artikel['id']) ?>" method="post">
                            <button type="submit">
                                <img src="<?= base_url('img/hapus.png') ?>">
                            </button>
                        </form>
                    </div>

                    <div class="artikel-content">
                        <small><?= date('l, d M Y', strtotime($artikel['tanggal_terbit'])) ?></small>

                        <h5><?= esc($artikel['judul']) ?></h5>

                        <?php
                        $preview = character_limiter(strip_tags($artikel['isi']), 150, '...');
                        ?>

                        <p><?= $preview ?></p>

                        <a href="<?= base_url('admin/artikel/' . $artikel['slug']) ?>" class="custom-link">
                            Baca Selengkapnya →
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>

        <?php endif; ?>
    </div>
</section>
<section id="artikelSection" class="mt-5" data-aos="fade-up">

<div class="berita-header">

    <h2>Berita Pneumonia</h2>

    <p>
        Informasi dan Edukasi tentang Pencegahan serta Penanganan pneumonia di Masyarakat
    </p>

</div>

<?php
$db = \Config\Database::connect();

$queryBerita = $db->query("
    SELECT *
    FROM berita
    WHERE id_penyakit = 3
    ORDER BY tanggal_berita DESC
");

$totalBerita = $queryBerita->getNumRows();
?>

<div class="news-slider-admin">

    <button class="slide-btn prev-btn">
        &#10094;
    </button>

    <div class="news-track">

        <?php if($totalBerita > 0): ?>

            <?php foreach($queryBerita->getResultArray() as $berita): ?>

                <?php
                $gambar = trim((string)($berita['gambar_berita'] ?? ''));

                $gambarFix = base_url('uploads/berita/default.jpeg');

                if ($gambar !== '' && strtolower($gambar) !== 'null') {

                    if (filter_var($gambar, FILTER_VALIDATE_URL)) {

                        $gambarFix = $gambar;

                    } else {

                        $pathFile = FCPATH . 'uploads/berita/' . $gambar;

                        if (file_exists($pathFile)) {

                            $gambarFix = base_url('uploads/berita/' . $gambar);
                        }
                    }
                }

                $urlBerita = !empty($berita['url_berita'])
                    ? $berita['url_berita']
                    : '#';
                ?>

                <div class="news-card">

                    <img
                        src="<?= $gambarFix ?>"
                        alt="<?= $berita['judul_berita'] ?>"
                    >

                    <div class="news-content">

                        <span class="news-badge">
                            Pneumonia
                        </span>

                        <h5>
                            <?= $berita['judul_berita'] ?>
                        </h5>

                        <p>
                            <?= substr(strip_tags($berita['deskripsi_berita']),0,100) ?>...
                        </p>

                        <?php
                        $urlBerita = base_url('beritapneumonia/viewUser/' . $berita['id_berita'] . '?from=admin');
                        ?>

                        <a
                            href="<?= $urlBerita ?>"
                            class="news-link"
                        >
                            Baca Selengkapnya
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="news-card">
                <img src="<?= base_url('uploads/berita/default.jpeg') ?>" alt="">
                <div class="news-content">
                    <span class="news-badge">Informasi</span>
                    <h5>Belum Ada Berita Pneumonia</h5>
                    <p>Saat ini belum tersedia artikel atau berita terbaru mengenai pneumonia.</p>
                    <a href="#" class="news-link">Nantikan Update</a>
                </div>
            </div>

            <div class="news-card">
                <img src="<?= base_url('uploads/berita/default.jpeg') ?>" alt="">
                <div class="news-content">
                    <span class="news-badge">Edukasi</span>
                    <h5>Informasi Akan Segera Ditambahkan</h5>
                    <p>Tim kami sedang menyiapkan informasi kesehatan pneumonia terbaru.</p>
                    <a href="#" class="news-link">Segera Hadir</a>
                </div>
            </div>

            <div class="news-card">
                <img src="<?= base_url('uploads/berita/default.jpeg') ?>" alt="">
                <div class="news-content">
                    <span class="news-badge">Kesehatan</span>
                    <h5>Tetap Jaga Kesehatan Paru-Paru</h5>
                    <p>Hindari asap rokok dan jaga daya tahan tubuh untuk mencegah pneumonia.</p>
                    <a href="#" class="news-link">Pelajari</a>
                </div>
            </div>

        <?php endif; ?>

    </div>

    <button class="slide-btn next-btn">
        &#10095;
    </button>

</div>

</section>
<style>
.news-slider-admin{ position:relative; width:100%; overflow:hidden; margin-top:20px; }
.news-track{ display:flex; gap:20px; overflow-x:auto; scroll-behavior:smooth; padding:10px 5px; scrollbar-width:none; }
.news-track::-webkit-scrollbar{ display:none; }
.news-card{ min-width:320px; max-width:320px; background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 4px 14px rgba(0,0,0,0.08); transition:0.3s; flex-shrink:0; }
.news-card:hover{ transform:translateY(-5px); }
.news-card img{ width:100%; height:180px; object-fit:cover; display:block; }
.news-content{ padding:18px; }
.news-badge{ display:inline-block; background:#dff7f8; color:#13aab5; font-size:12px; font-weight:700; padding:6px 12px; border-radius:6px; margin-bottom:12px; }
.news-content h5{ font-size:20px; font-weight:700; margin-bottom:10px; color:#173b4d; }
.news-content p{ font-size:14px; color:#6c757d; line-height:1.6; margin-bottom:14px; }
.news-link{ text-decoration:none; color:#11b7c4; font-weight:700; }
.slide-btn{ position:absolute; top:40%; transform:translateY(-50%); width:38px; height:38px; border:none; border-radius:50%; background:#12b8c5; color:white; font-size:18px; font-weight:bold; cursor:pointer; z-index:10; }
.prev-btn{ left:0; }
.next-btn{ right:0; }

/* =========================
   FUNFACT
========================= */
.funfact-section{
    margin-top:60px;
    margin-bottom:80px;
    margin-left:0px;
}

.funfact-header h2{
    font-size:30px;
    font-weight:800;
    color:#111;
    margin-bottom:5px;
}

.funfact-header p{
    color:#7d7d7d;
    font-size:17px;
    line-height:1.7;
    max-width:720px;
}

.funfact-link{ text-decoration:none; }

.funfact-card{
    position:relative;
    margin:70px auto 0;
    max-width:700px;
    background:linear-gradient(90deg,#12c7d3,#007b84);
    border-radius:30px;
    padding:55px 40px 35px;
    transition:.3s ease;
    box-shadow:0 12px 30px rgba(0,0,0,0.12);
}

.funfact-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 40px rgba(0,0,0,0.16);
}

.funfact-icon{
    position:absolute;
    top:-55px;
    left:50%;
    transform:translateX(-50%);
    width:110px;
    height:110px;
    background:#12bcc8;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:48px;
    box-shadow:0 10px 24px rgba(0,0,0,0.14);
}

.funfact-content{ display:flex; align-items:center; justify-content:space-between; gap:30px; }
.funfact-text{ flex:1; }
.funfact-text h3{ color:white; font-size:32px; font-weight:800; margin-bottom:18px; }
.funfact-text p { color:white; font-size:20px; line-height:1.8; }
.funfact-image img{ width:220px; border-radius:18px; object-fit:cover; }

/* =========================
   HEADER BERITA
========================= */
.berita-header{ margin-bottom:40px; }
.berita-header h2{ font-size:30px; font-weight:800; color:#111; margin-bottom:5px; }
.berita-header p { color:#7d7d7d; font-size:17px; line-height:1.7; max-width:720px; }

/* =========================
   GRAFIK
========================= */
#grafik{
    margin-top:40px;
    background:#eaf9fb;
    border-radius:18px;
    padding:24px;
}

#grafik .section-header{ margin-bottom:18px; }
#grafik .section-header h5{ font-size:28px; font-weight:800; color:#0d3440; margin-bottom:6px; }
#grafik .section-header .sub{ font-size:14px; color:#60727d; }

.chart-frame{
    width:100%;
    height:720px;
    overflow:hidden;
    border-radius:18px;
    background:#ffffff;
    padding:18px;
    box-shadow:0 4px 14px rgba(0,0,0,0.08);
}

.chart-frame iframe{
    width:100%;
    height:100%;
    border:none;
    border-radius:14px;
    background:transparent;
}

#artikelSection{ margin-left:0px; margin-right:0px; }
</style>

<!-- FUNFACT -->
<?php if(!empty($funfact)): ?>

<section class="funfact-section">

    <div class="funfact-header">

        <h2>Funfact</h2>

        <p>
            Informasi dan Edukasi tentang Pencegahan serta Penanganan pneumonia di Masyarakat berdasarkan sumber terpercaya
        </p>

    </div>

    <a
        href="<?= base_url('pneumonia/funfact/detail/' . $funfact['id_funfact']) ?>"
        class="funfact-link"
    >

        <div class="funfact-card">

            <div class="funfact-icon">
                <i class="bi bi-lungs-fill"></i>
            </div>

            <div class="funfact-content">

                <div class="funfact-text">

                    <h3>
                        <?= esc($funfact['judul_funfact']) ?>
                    </h3>

                    <p>
                        <?= character_limiter(strip_tags($funfact['deskripsi_funfact']), 120) ?>
                    </p>

                </div>

                <div class="funfact-image">

                    <img
                        src="<?= base_url('uploads/funfact/' . $funfact['gambar_funfact']) ?>"
                        alt="Funfact"
                    >

                </div>

            </div>

        </div>

    </a>

</section>

<?php endif; ?>

<?= $this->endSection() ?>