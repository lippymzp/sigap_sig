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

<!-- MAP -->
<div class="section-card">

    <!-- =========================
        HALAMAN MAP
    ========================== -->
    <div id="mapPage">

        <div class="section-block">

            <div class="section-header">
                <div>
                    <h5>Peta Interaktif Penyebaran</h5>
                    <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
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

        <option value="">
            Semua Tahun
        </option>

        <?php
        $tahunList = [];

        foreach($pneumonia as $item){

            if(!empty($item['tgl_kunjungan'])){

                $tahun =
                    date(
                        'Y',
                        strtotime(
                            $item['tgl_kunjungan']
                        )
                    );

                $tahunList[] = $tahun;
            }
        }

        $tahunList =
            array_unique($tahunList);

        rsort($tahunList);

        foreach($tahunList as $tahun):
        ?>

            <option value="<?= $tahun ?>">
                <?= $tahun ?>
            </option>

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
                        <button type="button" id="btnFilter" class="btn-filter">
                            Filter
                        </button>

                        <button type="button" id="btnReset" class="btn-reset">
                            Reset
                        </button>
                    </div>

                </div>

                <!-- MAP -->
 <div class="map-wrapper">
    <div id="map"></div>

    <!-- KETERANGAN -->
    <div class="map-legend-box">
        <h6>Keterangan:</h6>

        <div class="legend-item">
            <span class="legend-color legend-tinggi"></span>
            <b>Risiko Tinggi</b>
        </div>

        <div class="legend-item">
            <span class="legend-color legend-sedang"></span>
            <b>Risiko Sedang</b>
        </div>

        <div class="legend-item">
            <span class="legend-color legend-rendah"></span>
            <b>Risiko Rendah</b>
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

                    <button type="button" class="period-btn" onclick="changeDetailYear(-1)">
                        ‹
                    </button>

                    <b id="detailYear">2025</b>

                    <button type="button" class="period-btn" onclick="changeDetailYear(1)">
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

                        <p class="detail-label" id="detailBulanLabel">Kasus Baru (Juni 2025)</p>
                        <h4 id="detailKasusBaru">0 kasus</h4>
                    </div>

                    <span id="detailKategori" class="badge-risk rendah">Rendah</span>
                </div>

                <h4 class="chart-title">10 Wilayah dengan Kasus Tertinggi</h4>

                <div id="rankingChart" class="ranking-chart"></div>

            </div>

            <div class="detail-footer">
                <button type="button" class="btn-kembali" onclick="backToMap()">
                    Kembali
                </button>
            </div>

        </div>

    </div>

</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

    var dataPneu = <?= json_encode($pneumonia ?? []) ?>;

    var map;
    var geoLayer;
    var geoJsonData;
    var currentDataFinal = {};
    var selectedDetailYear = 2025;

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
            "klompongan": "klompangan",
            "klomplangan": "klompangan",
            "rowoindah": "rowoindah",
            "pancakarya": "pancakarya",
            "pancakarya": "pancakarya",
            "sukamakmur": "sukamakmur",
            "wirowongso": "wirowongso",
            "mangaran": "manggaran",
            "ajung": "ajung"
        };

        if(alias[key]){
            return alias[key];
        }

        return key;
    }

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
        var tahun = item.tahun
            || item.TAHUN
            || item.periode
            || item.PERIODE
            || item.year
            || item.YEAR
            || "";

        if(!tahun){
            var tanggal = item.tanggal
                || item.TANGGAL
                || item.tgl
                || item.TGL
                || item.created_at
                || item.date
                || "";

            if(tanggal){
                tahun = tanggal.toString().substring(0, 4);
            }
        }

        return tahun;
    }

    function getBulan(item){
        var bulan = item.bulan
            || item.BULAN
            || item.month
            || item.MONTH
            || "";

        if(!bulan){
            var tanggal = item.tanggal
                || item.TANGGAL
                || item.tgl
                || item.TGL
                || item.created_at
                || item.date
                || "";

            if(tanggal){
                bulan = parseInt(tanggal.toString().substring(5, 7));
            }
        }

        return bulan;
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
            "1":"Januari",
            "2":"Februari",
            "3":"Maret",
            "4":"April",
            "5":"Mei",
            "6":"Juni",
            "7":"Juli",
            "8":"Agustus",
            "9":"September",
            "10":"Oktober",
            "11":"November",
            "12":"Desember"
        };

        return bulan[angka] || "Juni";
    }

    function kategoriKasus(total){
        if(total >= 45){
            return "tinggi";
        }else if(total >= 25){
            return "sedang";
        }else{
            return "rendah";
        }
    }

    function warnaKategori(kategori){
        if(kategori === "tinggi"){
            return "#ff3131";
        }

        if(kategori === "sedang"){
            return "#ffff00";
        }

        return "#42a447";
    }

    function textKategori(kategori){
        if(kategori === "tinggi"){
            return "Tinggi";
        }

        if(kategori === "sedang"){
            return "Sedang";
        }

        return "Rendah";
    }

    function buildDataFinal(){
        var bulan = document.getElementById("filterBulan").value;
        var tahun = document.getElementById("filterTahun").value;
        var jk = document.getElementById("filterJk").value;

        var hasil = {};

        dataPneu.forEach(function(item){

            var itemTahun = getTahun(item).toString();
            var itemBulan = getBulan(item).toString();
            var itemJk = getJk(item).toString().toLowerCase().trim();
            var filterJk = jk.toString().toLowerCase().trim();

            if(tahun && itemTahun && itemTahun !== tahun){
                return;
            }

            if(bulan && itemBulan && itemBulan !== bulan){
                return;
            }

            if(jk && itemJk && itemJk !== filterJk){
                return;
            }

            var desaAsli = getDesa(item);
            var desaKey = fixKey(desaAsli);

            if(!desaKey){
                return;
            }

            if(!hasil[desaKey]){
                hasil[desaKey] = {
                    nama: desaAsli,
                    total: 0,
                    kasusBaru: 0,
                    kategori: "rendah"
                };
            }

            var jumlahKasus = getKasus(item);

            hasil[desaKey].total += jumlahKasus;
            hasil[desaKey].kasusBaru += jumlahKasus;

        });

        for(var key in hasil){
            hasil[key].kategori = kategoriKasus(hasil[key].total);
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

/* =======================
   AIR QUALITY INDEX - IQAIR API
======================= */

var IQAIR_API_KEY = "d1160a02-9aa4-4404-86cd-4514f1e18d18";

var AQI_LAT = -8.1739;
var AQI_LON = 113.6473;

var AQI_NAMA_LOKASI = "Kecamatan Ajung, Kabupaten Jember, Jawa Timur, Indonesia";
var AQI_JUDUL_POPUP = "Kualitas Udara Kecamatan Ajung";

function getKategoriAQI(aqi){
    aqi = parseInt(aqi || 0);

    if(aqi <= 50){
        return {
            teks: "Baik",
            className: "aqi-status-baik"
        };
    }

    if(aqi <= 100){
        return {
            teks: "Sedang",
            className: "aqi-status-sedang"
        };
    }

    if(aqi <= 150){
        return {
            teks: "Tidak Sehat (Sensitif)",
            className: "aqi-status-sensitif"
        };
    }

    if(aqi <= 200){
        return {
            teks: "Tidak Sehat",
            className: "aqi-status-tidak-sehat"
        };
    }

    if(aqi <= 300){
        return {
            teks: "Sangat Tidak Sehat",
            className: "aqi-status-sangat-tidak-sehat"
        };
    }

    return {
        teks: "Berbahaya",
        className: "aqi-status-berbahaya"
    };
}

function formatTanggalAQI(tanggalApi){
    if(!tanggalApi){
        return "-";
    }

    var tanggal = new Date(tanggalApi);

    if(isNaN(tanggal.getTime())){
        return tanggalApi;
    }

    return tanggal.toLocaleString("id-ID", {
        day: "2-digit",
        month: "long",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit"
    });
}

function setStatusClassAQI(element, className){
    element.classList.remove(
        "aqi-status-baik",
        "aqi-status-sedang",
        "aqi-status-sensitif",
        "aqi-status-tidak-sehat",
        "aqi-status-sangat-tidak-sehat",
        "aqi-status-berbahaya"
    );

    element.classList.add(className);
}

function isiDataAQI(dataApi){

    if(!dataApi || dataApi.status !== "success"){
        document.getElementById("aqiMiniValue").innerText = "-";
        document.getElementById("aqiMiniStatus").innerText = "Gagal";

        document.getElementById("aqiPopupValue").innerText = "-";
        document.getElementById("aqiPopupStatus").innerText = "Data gagal dimuat";

        return;
    }

    var data = dataApi.data;

    var pollution = data.current && data.current.pollution
        ? data.current.pollution
        : {};

    var weather = data.current && data.current.weather
        ? data.current.weather
        : {};

    var aqi = pollution.aqius || 0;
    var kategori = getKategoriAQI(aqi);

    document.getElementById("aqiMiniValue").innerText = aqi;
    document.getElementById("aqiMiniStatus").innerText = kategori.teks;

    document.getElementById("aqiPopupTitle").innerText = AQI_JUDUL_POPUP;
    document.getElementById("aqiPopupValue").innerText = aqi;
    document.getElementById("aqiPopupStatus").innerText = kategori.teks;

    document.getElementById("aqiLocation").innerText = AQI_NAMA_LOKASI;
    document.getElementById("aqiTemp").innerText = weather.tp ?? "-";
    document.getElementById("aqiHumidity").innerText = weather.hu ?? "-";
    document.getElementById("aqiPressure").innerText = weather.pr ?? "-";
    document.getElementById("aqiUpdated").innerText = formatTanggalAQI(pollution.ts);

    setStatusClassAQI(
        document.getElementById("aqiMiniStatus"),
        kategori.className
    );

    setStatusClassAQI(
        document.getElementById("aqiPopupStatus"),
        kategori.className
    );
}

function ambilDataAQI(){

    var url = "https://api.airvisual.com/v2/nearest_city" +
              "?lat=" + AQI_LAT +
              "&lon=" + AQI_LON +
              "&key=" + IQAIR_API_KEY;

    fetch(url)
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            isiDataAQI(data);
        })
        .catch(function(error){
            console.error("Gagal mengambil data AQI:", error);

            document.getElementById("aqiMiniValue").innerText = "-";
            document.getElementById("aqiMiniStatus").innerText = "Gagal";

            document.getElementById("aqiPopupValue").innerText = "-";
            document.getElementById("aqiPopupStatus").innerText = "Data gagal dimuat";
        });
}

function aktifkanPopupAQI(){

    var miniBox = document.getElementById("aqiMiniBox");
    var popupBox = document.getElementById("aqiPopupBox");

    if(!miniBox || !popupBox){
        return;
    }

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

    function initMap(){
        var mapElement = document.getElementById("map");

        if(!mapElement){
            return;
        }

        map = L.map("map", {
            zoomControl: true
        }).setView([-7.9, 112.6], 10);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "Leaflet"
        }).addTo(map);

aktifkanPopupAQI();
ambilDataAQI();

        fetch("<?= base_url('assets/peta/pneumonia.geojson') ?>")
            .then(function(res){
                return res.json();
            })
            .then(function(data){
                geoJsonData = data;
                renderGeoJson();
            });

        setTimeout(function(){
            map.invalidateSize();
        }, 300);
    }

    function renderGeoJson(){
        var dataFinal = buildDataFinal();

        if(geoLayer){
            map.removeLayer(geoLayer);
        }

        geoLayer = L.geoJSON(geoJsonData, {

            style: function(feature){

                var nama = getNamaGeo(feature);
                var key = fixKey(nama);
                var item = dataFinal[key];

                var kategori = item ? item.kategori : "rendah";
                var warna = item ? warnaKategori(kategori) : "#d9d9d9";

                return {
                    color: "#23a39a",
                    weight: 2,
                    fillColor: warna,
                    fillOpacity: item ? 0.75 : 0.55
                };
            },

            onEachFeature: function(feature, layer){

                var nama = getNamaGeo(feature);
                var key = fixKey(nama);
                var item = dataFinal[key];

                var total = item ? item.total : 0;
                var kategori = item ? item.kategori : "rendah";
                var statusData = item ? "" : `<br><span class="popup-empty">Data tidak ditemukan</span>`;

                var isiPopup = `
                    <div class="popup-informasi" onclick="showDetailWilayah('${key}', decodeURIComponent('${encodeURIComponent(nama)}'))">
                        <b>Informasi :</b><br>
                        <span>Desa : ${nama}</span><br>
                        <span>Jumlah Kasus : ${total}</span><br>
                        <span>
                            Tingkat Kasus :
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

                layer.on("click", function(){
                    layer.openPopup();
                });

                layer.on("mouseover", function(){
                    layer.setStyle({
                        weight: 4,
                        fillOpacity: 0.85
                    });
                });

                layer.on("mouseout", function(){
                    geoLayer.resetStyle(layer);
                });
            }

        }).addTo(map);

        map.fitBounds(geoLayer.getBounds());
    }

    window.showDetailWilayah = function(key, namaWilayah){

        var item = currentDataFinal[key];

        if(!item){
            item = {
                nama: namaWilayah,
                total: 0,
                kasusBaru: 0,
                kategori: "rendah"
            };
        }

        var tahun = document.getElementById("filterTahun").value || "2025";
        var bulan = document.getElementById("filterBulan").value || "6";

        selectedDetailYear = parseInt(tahun);

        document.getElementById("mapPage").style.display = "none";
        document.getElementById("detailPage").style.display = "block";

        document.getElementById("detailTitleHeader").innerText = "Peta Sebaran Kasus " + selectedDetailYear;
        document.getElementById("detailYear").innerText = selectedDetailYear;
        document.getElementById("detailWilayah").innerText = "Kecamatan " + namaWilayah;
        document.getElementById("detailTotal").innerText = item.total + " kasus";
        document.getElementById("detailBulanLabel").innerText = "Kasus Baru (" + namaBulan(bulan) + " " + selectedDetailYear + ")";
        document.getElementById("detailKasusBaru").innerText = item.kasusBaru + " kasus";

        var badge = document.getElementById("detailKategori");
        badge.innerText = textKategori(item.kategori);
        badge.className = "badge-risk " + item.kategori;

        renderRankingChart();
    }

    window.backToMap = function(){
        document.getElementById("detailPage").style.display = "none";
        document.getElementById("mapPage").style.display = "block";

        setTimeout(function(){
            map.invalidateSize();
        }, 300);
    }

    window.changeDetailYear = function(step){
        selectedDetailYear += step;

        document.getElementById("detailYear").innerText = selectedDetailYear;
        document.getElementById("detailTitleHeader").innerText = "Peta Sebaran Kasus " + selectedDetailYear;
    }

    function renderRankingChart(){

        var chart = document.getElementById("rankingChart");

        var ranking = Object.values(currentDataFinal)
            .sort(function(a, b){
                return b.total - a.total;
            })
            .slice(0, 10);

        if(ranking.length === 0){
            chart.innerHTML = `
                <div class="empty-chart">
                    Tidak ada data yang sesuai filter
                </div>
            `;
            return;
        }

        var max = ranking[0].total || 1;
        var html = "";

        ranking.forEach(function(item){

            var width = (item.total / max) * 100;
            var kategori = item.kategori;

            html += `
                <div class="rank-row">
                    <div class="rank-name">${item.nama.toUpperCase()}</div>

                    <div class="rank-bar-area">
                        <div class="rank-bar ${kategori}" style="width:${width}%;">
                            <span>${item.total}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        chart.innerHTML = html;
    }

    document.getElementById("filterTahun").addEventListener("change", function(){
        renderGeoJson();
    });

    document.getElementById("btnFilter").addEventListener("click", function(){
        renderGeoJson();
    });

    document.getElementById("btnReset").addEventListener("click", function(){
        document.getElementById("filterBulan").value = "";
        document.getElementById("filterTahun").value = "2025";
        document.getElementById("filterJk").value = "";

        renderGeoJson();
    });

    initMap();

});
</script>


<style>
/* =========================
   CARD UTAMA
========================= */
.section-card{
    background:#eaf9fb;
    padding:18px;
    border-radius:16px;
    width:100%;
    font-family:'Poppins', Arial, sans-serif;
}

.section-block{
    background:#eaf9fb;
    border-radius:16px;
}

/* =========================
   HEADER MAP
========================= */
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

/* =========================
   CARD MAP
========================= */
.inner-card{
    background:#ffffff;
    width:100%;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 2px 9px rgba(0,0,0,0.08);
}

/* =========================
   FILTER
========================= */
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

/* =========================
   MAP
========================= */
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

/* =========================
   LABEL WILAYAH
========================= */
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

/* =========================
   KETERANGAN DI DALAM MAP
========================= */
.map-legend-box{
    position:absolute;
    left:14px;
    bottom:14px;
    width:175px;

    background:#ffffff;
    padding:12px 14px 8px;

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
}

.legend-tinggi{
    background:#ff0000;
}

.legend-sedang{
    background:#ffff00;
}

.legend-rendah{
    background:#00ff00;
}

/* =========================
   AIR QUALITY INDEX
========================= */
.aqi-mini-box{
    position:absolute;
    left:203px;
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
    left:203px;
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

.aqi-good{
    color:#16a34a;
}

.aqi-moderate{
    color:#f59e0b;
}

.aqi-sensitive{
    color:#f97316;
}

.aqi-unhealthy{
    color:#dc2626;
}

.aqi-very{
    color:#9333ea;
}

.aqi-hazard{
    color:#4c1d95;
}

/* WARNA STATUS AQI */
.aqi-status-baik{
    background:#dcfce7 !important;
    color:#16a34a !important;
}

.aqi-status-sedang{
    background:#fef3c7 !important;
    color:#f59e0b !important;
}

.aqi-status-sensitif{
    background:#ffedd5 !important;
    color:#f97316 !important;
}

.aqi-status-tidak-sehat{
    background:#fee2e2 !important;
    color:#dc2626 !important;
}

.aqi-status-sangat-tidak-sehat{
    background:#f3e8ff !important;
    color:#9333ea !important;
}

.aqi-status-berbahaya{
    background:#ede9fe !important;
    color:#4c1d95 !important;
}

/* =========================
   POPUP
========================= */
.popup-informasi{
    min-width:160px;
    font-size:12px;
    line-height:1.5;
    cursor:pointer;
}

.popup-informasi b{
    color:#000;
}

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

.popup-tinggi{
    color:red !important;
}

.popup-sedang{
    color:#d77b00 !important;
}

.popup-rendah{
    color:green !important;
}

.popup-empty{
    color:#d62828;
    font-weight:800;
}

.leaflet-popup-content-wrapper{
    border-radius:8px;
}

.leaflet-popup-content{
    margin:9px 11px;
}

/* =====================================================
   DETAIL PAGE MODERN
===================================================== */
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

.detail-period span{
    font-weight:400;
}

.detail-period b{
    font-size:18px;
    font-weight:700;
}

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

.badge-risk.tinggi{
    background:#fee2e2;
    color:#dc2626;
}

.badge-risk.sedang{
    background:#fef3c7;
    color:#b45309;
}

.badge-risk.rendah{
    background:#dcfce7;
    color:#15803d;
}

.chart-title{
    margin-top:22px;
    margin-bottom:22px;
    font-size:22px;
    font-weight:700;
    color:#111827;
}

/* =========================
   CHART BATANG DETAIL
========================= */
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

.rank-bar.tinggi{
    background:#8b0000;
}

.rank-bar.sedang{
    background:#e76f51;
}

.rank-bar.rendah{
    background:#16a34a;
}

.rank-bar span{
    font-size:13px;
}

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

.btn-kembali:hover{
    background:#079bad;
}

/* =========================
   RESPONSIVE
========================= */
@media(max-width:768px){

    .section-card{
        padding:12px;
    }

    .section-header{
        flex-direction:column;
        gap:12px;
    }

    .section-header h5{
        font-size:22px;
    }

    .section-header .sub{
        font-size:14px;
    }

    .filter-wrapper{
        flex-direction:column;
        align-items:flex-start;
    }

    .filter-left{
        width:100%;
        gap:8px;
    }

    .filter-group label{
        font-size:13px;
        margin-bottom:6px;
    }

    .filter-group select{
        width:115px;
        height:34px;
        font-size:13px;
    }

    .filter-right{
        width:100%;
        justify-content:flex-end;
    }

    .btn-filter,
    .btn-reset{
        height:36px;
        font-size:14px;
        padding:0 16px;
    }

    #map{
        height:330px !important;
    }

    .map-legend-box{
        width:155px;
        padding:10px 12px 6px;
    }

    .map-legend-box h6{
        font-size:13px;
    }

    .legend-item{
        font-size:10px;
        margin-bottom:8px;
    }

    .legend-color{
        width:19px;
        height:19px;
    }

    .label-desa{
        font-size:10px;
        padding:3px 6px;
    }

    .popup-informasi{
        min-width:150px;
        font-size:12px;
    }

    .detail-card{
        padding:14px;
    }

    .detail-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .detail-header h5{
        font-size:18px;
    }

    .detail-period{
        font-size:15px;
    }

    .detail-inner{
        padding:24px 18px 32px;
    }

    .detail-top{
        flex-direction:column;
        gap:16px;
        margin-bottom:26px;
    }

    .detail-top h3{
        font-size:21px;
    }

    .detail-label{
        font-size:15px;
    }

    .detail-top h4{
        font-size:17px;
    }

    .badge-risk{
        font-size:14px;
        padding:7px 14px;
    }

    .chart-title{
        font-size:19px;
    }

    .ranking-chart{
        width:100%;
        min-width:100%;
    }

    .rank-name{
        width:115px;
        font-size:11px;
        letter-spacing:2px;
        padding-right:10px;
    }

    .rank-bar-area{
        height:30px;
    }

    .rank-bar{
        height:22px;
        line-height:22px;
    }

    .btn-kembali{
        width:100%;
        padding:10px 20px;
    }
}
/* =========================
   GRAFIK INTERAKTIF DETAIL
========================= */
.chart-frame{
    width:100%;
    height:1000px;
    overflow:hidden;
    border-radius:18px;
    background:#eaf9fb;
    padding:0;
}

.chart-frame iframe{
    width:100%;
    height:100%;
    border:none;
    border-radius:18px;
    background:transparent;
}

</style>

   <!-- CHART -->
<div class="section-block" id="grafik">

    <div class="section-header">
        <div>
            <h5>Grafik Interaktif Penyebaran</h5>
            <p class="sub">Visualisasi kepadatan kasus berdasarkan grafik</p>
        </div>

        <div class="filter-group">
            <select>
                <option>Semua Wilayah Desa</option>
            </select>

            <select>
                <option>Semua Kategori</option>
            </select>

            <select>
                <option>7 Hari Terbaru</option>
            </select>
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

</div>
</div>

<!-- ARTIKEL -->
<section id="artikel" class="artikel-section my-5">
    <div class="artikel-header">
        <h2 class="section-title">Berita, Artikel & Majalah Kesehatan</h2>
    </div>

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
            <div class="text-muted">Belum ada artikel yang ditambahkan.</div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>