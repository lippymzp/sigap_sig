<?php helper('text'); ?>

<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>
<?= $this->section('content') ?>

<!-- =========================
     HALAMAN PETA SEBARAN
========================== -->
<div class="peta-page">

    <!-- FILTER ATAS -->
    <div class="peta-filter-card">

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

    <?php
    $tahunList = $tahunList ?? [];
    $tahunList = array_unique(array_merge(['2026', '2025'], $tahunList));
    rsort($tahunList);
    ?>

    <select id="filterTahun">
        <?php foreach($tahunList as $tahun): ?>
            <option value="<?= $tahun ?>" <?= ($tahun == date('Y')) ? 'selected' : '' ?>>
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

            <div class="filter-group">
                <label>Kategori</label>
                <select id="filterKategori">
                    <option value="">All</option>
                    <option value="rendah">Risiko Rendah</option>
                    <option value="sedang">Risiko Sedang</option>
                    <option value="tinggi">Risiko Tinggi</option>
                </select>
            </div>

        </div>

        <div class="filter-right">
            <button type="button" id="btnFilter" class="btn-filter">
                <i class="fa-solid fa-filter"></i>
                Filter
            </button>

            <button type="button" id="btnReset" class="btn-reset">
                <i class="fa-solid fa-rotate-right"></i>
                Reset
            </button>
        </div>

    </div>

    <!-- CARD MAP -->
    <div class="peta-map-card">

        <div class="peta-map-title">
            Peta Sebaran Kasus <span id="judulTahunPeta">2025</span>
        </div>

        <div class="map-wrapper">
            <div id="map"></div>

            <!-- INFO BOX KANAN ATAS -->
            <div class="map-info-box">
                <h5>Pneumonia - Ajung</h5>
                <p>Persebaran Penyakit Pneumonia Kab.Jember</p>
            </div>

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
        </div>

    </div>

    <!-- CARD BAWAH -->
    <div class="peta-bottom-grid">

        <!-- CARD AQI -->
        <div class="peta-info-card aqi-detail-card">

            <div class="aqi-big-row">
                <span class="aqi-big-label">AQI</span>
                <span class="aqi-big-separator">:</span>
                <span id="aqiMiniValue" class="aqi-big-value">...</span>
                <span id="aqiMiniStatus" class="aqi-big-status">Memuat...</span>
            </div>

            <div class="aqi-detail-info">
                <span id="aqiLocation">Kecamatan Ajung, Kabupaten Jember, Jawa Timur, Indonesia</span>
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

        <!-- CARD RINGKASAN -->
        <div class="peta-info-card summary-card">

            <div class="summary-top">
                <div>
                    <h5>Kecamatan Ajung</h5>

                    <p>Total Kasus</p>
                    <h4 id="summaryTotalKasus">0 kasus</h4>

                    <p>Kasus Baru (<span id="summaryBulanTahun">-</span>)</p>
                    <h4 id="summaryKasusBaru">0 kasus</h4>
                </div>

                <span id="summaryKategori" class="badge-risk rendah">
                    Rendah
                </span>
            </div>

            <h6 class="summary-chart-title">
                10 Wilayah dengan Kasus Tertinggi
            </h6>

            <div id="summaryRankingChart" class="summary-ranking-chart"></div>

        </div>

    </div>

    <p class="update-text">
        Diperbarui pada: <?= date('d-m-Y') ?>
    </p>

    <!-- TOMBOL KEMBALI -->
    <div class="peta-footer-action">
        <a href="<?= base_url('index.php/pneumonia/dashboard/admin') ?>" class="btn-kembali-page">
            Kembali
        </a>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    var dataPneu = <?= json_encode($pneumonia ?? []) ?>;

    var map;
    var geoLayer;
    var geoJsonData;
    var currentDataFinal = {};

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

    var K_PREVALENSI = 100;

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
            "sukamakmur": "sukamakmur",
            "wirowongso": "wirowongso",
            "mangaran": "manggaran",
            "ajung": "ajung"
        };

        return alias[key] || key;
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
        if(item.tgl_kunjungan){
            return item.tgl_kunjungan.toString().substring(0,4);
        }

        return "";
    }

    function getBulan(item){
        if(item.tgl_kunjungan){
            return parseInt(
                item.tgl_kunjungan.toString().substring(5,7)
            );
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

    return bulan[angka] || "-";
}

    function getBulanTahunAktif(){
    var bulanFilter = document.getElementById("filterBulan").value;
    var tahunFilter = document.getElementById("filterTahun").value;

    var tanggalSekarang = new Date();

    var bulanAktif = bulanFilter
        ? parseInt(bulanFilter)
        : (tanggalSekarang.getMonth() + 1);

    var tahunAktif = tahunFilter
        ? tahunFilter
        : tanggalSekarang.getFullYear();

    return {
        bulan: bulanAktif,
        tahun: tahunAktif,
        label: namaBulan(bulanAktif) + " " + tahunAktif
    };
}

    function hitungPrevalensi(totalKasus, keyDesa){
        var populasi = POPULASI[keyDesa];

        if(!populasi || populasi <= 0){
            return null;
        }

        return (totalKasus / populasi) * K_PREVALENSI;
    }

    function kategoriDariPrevalensi(prev, totalKasus){
        if(prev === null){
            return "nodata";
        }

        if(totalKasus === 0){
            return "nodata";
        }

        if(prev >= 0.90){
            return "tinggi";
        }else if(prev >= 0.40){
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

        if(kategori === "rendah"){
            return "#42a447";
        }

        return "#d9d9d9";
    }

    function textKategori(kategori){
        if(kategori === "tinggi"){
            return "Tinggi";
        }

        if(kategori === "sedang"){
            return "Sedang";
        }

        if(kategori === "rendah"){
            return "Rendah";
        }

        return "Tidak Ada Data";
    }

    function buildDataFinal(){
        var bulan = document.getElementById("filterBulan").value;
        var tahun = document.getElementById("filterTahun").value;
        var jk = document.getElementById("filterJk").value;
        var kategoriFilter = document.getElementById("filterKategori").value;

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
                    prevalensi: 0,
                    populasi: POPULASI[desaKey] || null,
                    kategori: "rendah"
                };
            }

            var jumlahKasus = getKasus(item);

            hasil[desaKey].total += jumlahKasus;
            hasil[desaKey].kasusBaru += jumlahKasus;
        });

        for(var key in hasil){
            var prevalensi = hitungPrevalensi(hasil[key].total, key);

            hasil[key].prevalensi = prevalensi;
            hasil[key].populasi = POPULASI[key] || null;
            hasil[key].kategori = kategoriDariPrevalensi(prevalensi, hasil[key].total);
        }

        if(kategoriFilter){
            for(var k in hasil){
                if(hasil[k].kategori !== kategoriFilter){
                    delete hasil[k];
                }
            }
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
            return { teks: "Baik", className: "aqi-status-baik" };
        }
        if(aqi <= 100){
            return { teks: "Sedang", className: "aqi-status-sedang" };
        }
        if(aqi <= 150){
            return { teks: "Tidak Sehat (Sensitif)", className: "aqi-status-sensitif" };
        }
        if(aqi <= 200){
            return { teks: "Tidak Sehat", className: "aqi-status-tidak-sehat" };
        }
        if(aqi <= 300){
            return { teks: "Sangat Tidak Sehat", className: "aqi-status-sangat-tidak-sehat" };
        }

        return { teks: "Berbahaya", className: "aqi-status-berbahaya" };
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
        if(!element){
            return;
        }

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

    function setText(id, value){
        var el = document.getElementById(id);

        if(el){
            el.innerText = value;
        }
    }

    function isiDataAQI(dataApi){

        if(!dataApi || dataApi.status !== "success"){
            setText("aqiMiniValue", "-");
            setText("aqiMiniStatus", "Gagal");
            return;
        }

        var data = dataApi.data;

        var pollution = data.current && data.current.pollution
            ? data.current.pollution : {};

        var weather = data.current && data.current.weather
            ? data.current.weather : {};

        var aqi = pollution.aqius || 0;
        var kategori = getKategoriAQI(aqi);

        setText("aqiMiniValue", aqi);
        setText("aqiMiniStatus", kategori.teks);
        setText("aqiLocation", AQI_NAMA_LOKASI);
        setText("aqiTemp", weather.tp ?? "-");
        setText("aqiHumidity", weather.hu ?? "-");
        setText("aqiPressure", weather.pr ?? "-");
        setText("aqiUpdated", formatTanggalAQI(pollution.ts));

        setStatusClassAQI(
            document.getElementById("aqiMiniStatus"),
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
                setText("aqiMiniValue", "-");
                setText("aqiMiniStatus", "Gagal");
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
                    color: "#176b35",
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
                var kategori = item ? item.kategori : "nodata";
                var prevalensi = item ? item.prevalensi : null;
                var populasi = item ? item.populasi : (POPULASI[key] || null);

                var prevalensiTeks = (prevalensi !== null && prevalensi !== undefined)
                    ? prevalensi.toFixed(2) + "%"
                    : "Tidak tersedia";

                var populasiTeks = populasi
                    ? populasi.toLocaleString("id-ID") + " jiwa"
                    : "Data tidak tersedia";

                var statusData = item ? "" : `<br><span class="popup-empty">Data tidak ditemukan</span>`;

                var isiPopup = `
                    <div class="popup-informasi">
                        <b>Informasi Epidemiologi :</b><br>
                        <span>Desa : <b>${nama}</b></span><br>
                        <span>Jumlah Kasus : <b>${total}</b></span><br>
                        <span>Jumlah Penduduk : <b>${populasiTeks}</b></span><br>
                        <span>Prevalensi : <b style="color:#0aa9b5;">${prevalensiTeks}</b></span><br>
                        <span>
                            Tingkat Risiko :
                            <b class="popup-${kategori}">${textKategori(kategori)}</b>
                        </span>
                        ${statusData}
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

        updateSummaryCard();
    }

function hitungKasusBaruAktif(){

    var tanggalSekarang = new Date();
    var bulanSekarang = (tanggalSekarang.getMonth() + 1).toString();
    var tahunSekarang = tanggalSekarang.getFullYear().toString();

    var jk = document.getElementById("filterJk").value;
    var filterJk = jk.toString().toLowerCase().trim();

    var totalKasusBaru = 0;

    dataPneu.forEach(function(item){

        var itemTahun = getTahun(item).toString();
        var itemBulan = getBulan(item).toString();
        var itemJk = getJk(item).toString().toLowerCase().trim();

        // Kasus baru hanya berdasarkan bulan dan tahun saat ini
        if(itemTahun !== tahunSekarang){
            return;
        }

        if(itemBulan !== bulanSekarang){
            return;
        }

        // Kasus baru hanya berubah jika filter jenis kelamin dipilih
        if(jk && itemJk !== filterJk){
            return;
        }

        totalKasusBaru += getKasus(item);
    });

    return totalKasusBaru;
}

    function updateSummaryCard(){

        var ranking = Object.values(currentDataFinal)
        .sort(function(a, b){
            return (b.prevalensi || 0) - (a.prevalensi || 0);
        });

        var totalSemua = 0;

        ranking.forEach(function(item){
            totalSemua += parseInt(item.total || 0);
        });

        var totalPopulasiAjung = 0;

        for(var keyPop in POPULASI){
            if(["mangaran","klompongan"].includes(keyPop)){
                continue;
            }
            totalPopulasiAjung += POPULASI[keyPop];
        }

        var prevalensiAjung = totalPopulasiAjung > 0
            ? (totalSemua / totalPopulasiAjung) * K_PREVALENSI
            : null;

        var kategori = kategoriDariPrevalensi(prevalensiAjung, totalSemua);
        var kasusBaruAktif = hitungKasusBaruAktif();

        setText("summaryTotalKasus", totalSemua + " kasus");
        setText("summaryKasusBaru", kasusBaruAktif + " kasus");

        var waktuAktif = getBulanTahunAktif();

        var tanggalSekarang = new Date();
        var bulanSekarang = tanggalSekarang.getMonth() + 1;
        var tahunSekarang = tanggalSekarang.getFullYear();

        if(document.getElementById("summaryBulanTahun")){
            document.getElementById("summaryBulanTahun").innerText =
                namaBulan(bulanSekarang) + " " + tahunSekarang;
        }

        if(document.getElementById("judulTahunPeta")){
            document.getElementById("judulTahunPeta").innerText =
                waktuAktif.tahun;
        }

        var badge = document.getElementById("summaryKategori");

        if(badge){
            badge.innerText = textKategori(kategori);
            badge.className = "badge-risk " + kategori;
        }

        renderSummaryRankingChart(ranking);
    }

    function renderSummaryRankingChart(ranking){

        var chart = document.getElementById("summaryRankingChart");

        ranking = ranking.slice(0, 10);

        if(!chart){
            return;
        }

        if(ranking.length === 0){
            chart.innerHTML = `
                <div class="empty-chart">
                    Tidak ada data yang sesuai filter
                </div>
            `;
            return;
        }

        var max = ranking[0].prevalensi || 1;
        var html = "";

        ranking.forEach(function(item){

            var width = ((item.prevalensi || 0) / max) * 100;
            var kategori = item.kategori;

            html += `
                <div class="summary-rank-row">
                    <div class="summary-rank-name">
                        ${item.nama.toUpperCase()}
                    </div>

                    <div class="summary-rank-bar-area">
                        <div class="summary-rank-bar ${kategori}" style="width:${width}%;">
                            <span>${(item.prevalensi || 0).toFixed(2)}%</span>
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
    document.getElementById("filterTahun").value = new Date().getFullYear().toString();
    document.getElementById("filterJk").value = "";
    document.getElementById("filterKategori").value = "";

    renderGeoJson();
    });

    initMap();

});
</script>

<style>
/* =========================
   HALAMAN PETA SEBARAN
========================= */
.peta-page,
.peta-page-wrapper{
    width:100%;
    max-width:none;
    margin:0;
    font-family:'Poppins', Arial, sans-serif;
}

.peta-filter-card,
.peta-map-card,
.peta-bottom-grid,
.peta-info-card{
    width:100%;
    box-sizing:border-box;
}

/* =========================
   FILTER ATAS
========================= */
.peta-filter-card{
    background:#eaf9fb;
    border-radius:18px;
    padding:22px 55px;
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:24px;
    margin-bottom:28px;
}

.filter-left{
    display:grid;
    grid-template-columns:170px 170px 190px 190px;
    gap:28px;
    align-items:end;
}

.filter-group{
    display:flex;
    flex-direction:column;
}

.filter-group label{
    font-size:12px;
    font-weight:600;
    color:#111827;
    margin-bottom:7px;
}

.filter-group select{
    width:100%;
    height:30px;
    border:1px solid #b8d0df;
    border-radius:5px;
    padding:0 10px;
    font-size:12px;
    background:#ffffff;
    color:#111827;
    outline:none;
}

.filter-right{
    display:flex;
    gap:18px;
    align-items:center;
}

.btn-filter,
.btn-reset{
    height:30px;
    min-width:95px;
    border:none;
    border-radius:6px;
    font-size:12px;
    font-weight:700;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
}

.btn-filter{
    background:#08b7c9;
    color:#ffffff;
}

.btn-reset{
    background:#ffffff;
    color:#111827;
}

/* =========================
   MAP CARD
========================= */
.peta-map-card{
    background:#eaf9fb;
    border:1px solid #b8dfe3;
    border-radius:18px;
    padding:18px 28px 26px;
}

.peta-map-title{
    font-size:15px;
    font-weight:800;
    color:#111827;
    margin-bottom:18px;
}

.map-wrapper{
    position:relative;
    width:100%;
    height:435px;
    border-radius:0;
    overflow:hidden;
    isolation:isolate;
}

#map{
    width:100%;
    height:510px !important;
    border-radius:0;
}

/* =========================
   INFO BOX MAP KANAN
========================= */
.map-info-box{
    position:absolute;
    top:28px;
    right:38px;
    width:260px;
    background:#ffffff;
    padding:18px 20px;
    z-index:999;
    box-shadow:0 3px 12px rgba(0,0,0,0.12);
}

.map-info-box h5{
    margin:0 0 6px;
    font-size:20px;
    font-weight:700;
    color:#333333;
}

.map-info-box p{
    margin:0;
    font-size:12px;
    color:#444444;
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
   LEGEND DI MAP
========================= */
.map-legend-box{
    position:absolute;
    right:42px;
    bottom:42px;
    width:115px;
    z-index:999;
    background:#ffffff;
    padding:10px 12px 8px;
    box-shadow:0 2px 8px rgba(0,0,0,0.18);
}

.map-legend-box h6{
    font-size:10px;
    font-weight:800;
    color:#000;
    margin:0 0 8px;
}

.legend-item{
    display:flex;
    align-items:center;
    gap:6px;
    margin-bottom:7px;
    font-size:8px;
    color:#000;
}

.legend-color{
    width:15px;
    height:15px;
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
   CARD BAWAH
========================= */
.peta-bottom-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:26px;
    margin-top:28px;
}

.peta-info-card{
    background:#eaf9fb;
    border:1px solid #b8dfe3;
    border-radius:18px;
    padding:34px 42px;
    min-height:350px;
}

/* =========================
   AQI CARD
========================= */
.aqi-big-row{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:24px;
}

.aqi-big-label{
    color:#1976d2;
    font-size:34px;
    font-weight:900;
}

.aqi-big-separator,
.aqi-big-value{
    font-size:34px;
    font-weight:900;
    color:#111827;
}

.aqi-big-status{
    margin-left:18px;
    display:inline-block;
    padding:6px 18px;
    border-radius:5px;
    font-size:12px;
    font-weight:800;
    background:#fef3c7;
    color:#f59e0b;
}

.aqi-detail-info{
    margin-bottom:36px;
}

.aqi-detail-info p{
    margin:0 0 8px;
    font-size:13px;
    color:#111827;
}

.aqi-index-list b{
    display:block;
    margin-bottom:14px;
    font-size:13px;
    color:#111827;
}

.aqi-index-list p{
    margin:0 0 5px;
    font-size:12px;
    font-weight:600;
}

.aqi-good{ color:#16a34a; }
.aqi-moderate{ color:#f59e0b; }
.aqi-sensitive{ color:#f97316; }
.aqi-unhealthy{ color:#dc2626; }
.aqi-very{ color:#9333ea; }
.aqi-hazard{ color:#4c1d95; }

/* STATUS AQI */
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
   SUMMARY CARD
========================= */
.summary-card{
    padding:42px 42px 34px;
}

.summary-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:28px;
}

.summary-top h5{
    font-size:16px;
    font-weight:800;
    margin:0 0 10px;
    color:#111827;
}

.summary-top p{
    margin:0 0 4px;
    font-size:13px;
    color:#111827;
}

.summary-top h4{
    margin:0 0 12px;
    font-size:15px;
    font-weight:800;
    color:#111827;
}

.badge-risk{
    padding:5px 17px;
    border-radius:5px;
    font-size:12px;
    font-weight:700;
}

.badge-risk.tinggi{
    background:#ffb3b3;
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

.badge-risk.nodata{
    background:#f3f4f6;
    color:#6b7280;
}

.summary-chart-title{
    font-size:15px;
    font-weight:800;
    color:#111827;
    margin:0 0 16px;
}

.summary-ranking-chart{
    width:100%;
    max-width:390px;
}

.summary-rank-row{
    display:flex;
    align-items:center;
    height:24px;
}

.summary-rank-name{
    width:110px;
    text-align:right;
    padding-right:13px;
    letter-spacing:2px;
    font-size:9px;
    font-weight:700;
    color:#6b7280;
}

.summary-rank-bar-area{
    flex:1;
    height:22px;
    border-top:1px solid #d9dee7;
    position:relative;
}

.summary-rank-bar{
    height:18px;
    margin-top:3px;
    min-width:22px;
    color:white;
    font-size:10px;
    font-weight:700;
    line-height:18px;
    text-align:center;
}

.summary-rank-bar.tinggi{
    background:#8b0000;
}

.summary-rank-bar.sedang{
    background:#e76f51;
}

.summary-rank-bar.rendah{
    background:#16a34a;
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

.popup-tinggi{ color:red !important; }
.popup-sedang{ color:#d77b00 !important; }
.popup-rendah{ color:green !important; }
.popup-nodata{ color:#888 !important; }

.popup-empty{
    color:#d62828;
    font-weight:800;
}

/* =========================
   TOMBOL KEMBALI
========================= */
.update-text{
    margin:20px 0 0 6px;
    font-size:12px;
    color:#555;
}

.peta-footer-action{
    display:flex;
    justify-content:flex-end;
    margin-top:14px;
}

.btn-kembali-page{
    background:#08b7c9;
    color:#ffffff;
    text-decoration:none;
    border:none;
    border-radius:8px;
    padding:9px 42px;
    font-size:14px;
    font-weight:700;
    cursor:pointer;
}

.btn-kembali-page:hover{
    background:#079bad;
    color:#ffffff;
}

/* =========================
   RESPONSIVE
========================= */
@media(max-width:992px){

    .peta-filter-card{
        padding:18px;
        flex-direction:column;
        align-items:flex-start;
    }

    .filter-left{
        grid-template-columns:1fr 1fr;
        width:100%;
        gap:14px;
    }

    .filter-right{
        width:100%;
        justify-content:flex-end;
    }

    .peta-bottom-grid{
        grid-template-columns:1fr;
    }

    .map-info-box{
        width:220px;
        right:20px;
    }
}

@media(max-width:768px){

    .filter-left{
        grid-template-columns:1fr;
    }

    .map-wrapper,
    #map{
        height:330px !important;
    }

    .peta-map-card,
    .peta-info-card{
        padding:18px;
    }

    .map-info-box{
        display:none;
    }

    .map-legend-box{
        right:16px;
        bottom:16px;
    }
}
</style>

<?= $this->endSection() ?>
