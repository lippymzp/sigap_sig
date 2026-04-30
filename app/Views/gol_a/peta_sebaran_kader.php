<?= $this->extend('layout/dashboard_layout_kader') ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="section-card">

    <div class="section-block">
        <div class="section-header">
            <div>
                <h5>Peta Interaktif Penyebaran</h5>
                <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
            </div>
            <div class="filter">
                <span>Periode:</span>
                <select>
                    <option>2025</option>
                </select>
            </div>
        </div>

        <div class="inner-card">
            <div id="map"></div>
        </div>
    </div>

    <div class="section-block" style="margin-top: 40px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0" style="font-weight: bold;">Peta Sebaran Kasus 2025</h5>
            <div style="font-weight: bold; font-size: 14px;">
                Periode : 
                <span style="color: #00CED1; cursor: pointer; margin: 0 5px;">&lt;</span> 
                2025 
                <span style="color: #00CED1; cursor: pointer; margin: 0 5px;">&gt;</span>
            </div>
        </div>

        <div class="info-card">
            <h6 style="font-weight: bold; margin-bottom: 20px;">Informasi :</h6>
            
            <table class="table-info-custom">
                <tr>
                    <td class="label-col">Nama Daerah</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">Sumbersari</td>
                </tr>
                <tr>
                    <td class="label-col">Jumlah Penduduk</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">2900</td>
                </tr>
                <tr>
                    <td class="label-col">Jumlah Kasus</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">6</td>
                </tr>
                <tr>
                    <td class="label-col">Kategori Kasus</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">Tinggi</td>
                </tr>
                
                <tr><td colspan="3" class="spacer-row"></td></tr>

                <tr>
                    <td class="label-col">Rentang usia</td>
                    <td class="colon-col"></td>
                    <td class="value-col"></td>
                </tr>
                <tr>
                    <td class="label-col sub-label">Anak-anak</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">1</td>
                </tr>
                <tr>
                    <td class="label-col sub-label">Dewasa</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">5</td>
                </tr>
                <tr>
                    <td class="label-col sub-label">Lansia</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">0</td>
                </tr>

                <tr><td colspan="3" class="spacer-row"></td></tr>

                <tr>
                    <td class="label-col">Rentang usia dengan kasus tertinggi</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">Dewasa (18th-59th)</td>
                </tr>
                <tr>
                    <td class="label-col">Desa dengan kasus tertinggi</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">Patrang</td>
                </tr>
                
                <tr><td colspan="3" class="spacer-row"></td></tr>

                <tr>
                    <td class="label-col">Jenis kelamin terinfeksi</td>
                    <td class="colon-col"></td>
                    <td class="value-col">2</td>
                </tr>
                <tr>
                    <td class="label-col sub-label">Laki-laki</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">4</td>
                </tr>
                <tr>
                    <td class="label-col sub-label">Perempuan</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">2</td>
                </tr>

                <tr><td colspan="3" class="spacer-row"></td></tr>

                <tr>
                    <td class="label-col">Rumah Diperiksa</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">1200</td>
                </tr>
                <tr>
                    <td class="label-col">Rumah Positive Jentik</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">5</td>
                </tr>
                <tr>
                    <td class="label-col">Presentase</td>
                    <td class="colon-col">:</td>
                    <td class="value-col">x%</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section-block" style="margin-top: 40px;">
        
        <div class="filter-wrapper">
            <div class="filter-group">
                <div class="filter-item">
                    <label>JENIS KELAMIN</label>
                    <select><option>All</option></select>
                </div>
                <div class="filter-item">
                    <label>BULAN</label>
                    <select><option>All</option></select>
                </div>
                <div class="filter-item">
                    <label>TAHUN</label>
                    <select><option>All</option></select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="inner-card shadow-sm">
                    <h6 class="chart-title">Kasus Berdasarkan Umur</h6>
                    <div class="chart-container">
                        <canvas id="chartUmur"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="inner-card shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="chart-title">Kasus Berdasarkan Wilayah dan Status Pengobatan</h6>
                    </div>
                    <div class="chart-container" style="height: 400px;">
                        <canvas id="chartWilayahStatus"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    /* =======================================
       LOGIKA PETA (MAP)
       ======================================= */
    function fixNama(nama){
        return (nama || "").toLowerCase().trim().replace(/\s+/g, " ").replace(/[^a-z0-9 ]/g, "");
    }

    var aliasDesa = { "kemuningsarilor": "kemuning sari lor" };
    var dataDBD = <?= json_encode($dbd ?? []) ?>;
    var dataFinal = {};

    dataDBD.forEach(item => {
        var desa = fixNama(item.desa);
        if(aliasDesa[desa]) desa = aliasDesa[desa];

        if(!dataFinal[desa]){
            dataFinal[desa] = { total: 0, jumlah: 0 };
        }
        dataFinal[desa].total += parseInt(item.kasus);
        dataFinal[desa].jumlah++;
    });

    for(var key in dataFinal){
        var rata = dataFinal[key].total / dataFinal[key].jumlah;
        if(rata >= 20) dataFinal[key].kategori = "tinggi";
        else if(rata >= 10) dataFinal[key].kategori = "sedang";
        else dataFinal[key].kategori = "rendah";
    }

    var map = L.map('map').setView([-8.1,113.5], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    fetch("<?= base_url('assets/peta/db.geojson') ?>")
    .then(res => res.json())
    .then(data => {
        var geo = L.geoJSON(data, {
            style: function(feature){
                var nama = fixNama(feature.properties.NAMOBJ);
                if(aliasDesa[nama]) nama = aliasDesa[nama];
                var item = dataFinal[nama];
                var warna = "#cccccc";

                if(item){
                    if(item.kategori == "tinggi") warna = "#dc3545";
                    else if(item.kategori == "sedang") warna = "#ffc107";
                    else if(item.kategori == "rendah") warna = "#28a745";
                }
                return { color: "#00CED1", weight: 2, fillColor: warna, fillOpacity: 0.7 };
            },
            onEachFeature: function(feature, layer){
                var namaAsli = feature.properties.NAMOBJ || "Kelurahan";
                var namaFix  = fixNama(namaAsli);
                if(aliasDesa[namaFix]) namaFix = aliasDesa[namaFix];

                var item = dataFinal[namaFix];
                var isi = "<b>Kelurahan: " + namaAsli + "</b>";

                if(item){
                    isi += "<br>Total Kasus: " + item.total;
                    isi += "<br>Kategori: " + item.kategori;
                } else {
                    isi += "<br><span style='color:red'>Data tidak ditemukan</span>";
                }

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

    /* =======================================
       LOGIKA GRAFIK (CHART.JS)
       ======================================= */
    const ctxUmur = document.getElementById('chartUmur').getContext('2d');
    new Chart(ctxUmur, {
        type: 'bar',
        data: {
            labels: ['< 1 th', '1 < 5 th', '5-9 th', '10-18 th', '19-59 th', '> 60 th'],
            datasets: [
                { label: 'Laki-Laki', data: [65, 8, 90, 81, 56, 55], backgroundColor: '#1B5E62', borderRadius: 5 },
                { label: 'Perempuan', data: [21, 48, 40, 19, 96, 27], backgroundColor: '#86C4C8', borderRadius: 5 }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            scales: { y: { beginAtZero: true, max: 100, grid: { display: false } }, x: { grid: { display: false } } },
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } }
        }
    });

    const ctxWilayah = document.getElementById('chartWilayahStatus').getContext('2d');
    new Chart(ctxWilayah, {
        type: 'bar',
        data: {
            labels: ['Ajung', 'Wirolegi', 'Rowo Indah', 'Sukamekar', 'Klampangan', 'Pancakarya', 'Mangaran', 'Pasien Luar'],
            datasets: [
                { label: 'Sembuh', data: [65, 48, 40, 19, 96, 27, 45, 2], backgroundColor: '#86C4C8' },
                { label: 'Pengobatan', data: [21, 1, 90, 81, 4, 55, 87, 0], backgroundColor: '#1B5E62' },
                { label: 'Meninggal', data: [1, 2, 4, 1, 56, 2, 0, 6], backgroundColor: '#FFB84D' }
            ]
        },
        options: {
            indexAxis: 'y', responsive: true, maintainAspectRatio: false,
            scales: { x: { stacked: true, max: 100 }, y: { stacked: true, grid: { display: false } } },
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } }
        }
    });
});
</script>

<style>
/* Style Peta */
.label-desa { background: rgba(0,0,0,0.6); color: white; border: none; padding: 2px 6px; font-size: 11px; border-radius: 6px; }

/* Style Card Informasi Baru (Menggunakan Table) */
.info-card {
    background: #FAFAFA;
    border-radius: 15px;
    padding: 30px;
    border: 1px solid #E0E0E0;
    color: #333;
    box-shadow: 0 4px 6px rgba(0,0,0,0.02);
}

.table-info-custom {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.table-info-custom td {
    padding: 6px 0;
    vertical-align: top;
}

.table-info-custom .label-col {
    width: 250px; 
    color: #444;
}

.table-info-custom .colon-col {
    width: 20px; 
    font-weight: bold;
    text-align: center;
}

.table-info-custom .value-col {
    color: #333;
}

.table-info-custom .sub-label {
    padding-left: 40px; 
}

.table-info-custom .spacer-row {
    height: 15px; 
}

/* Style Filter Grafik */
.filter-wrapper { display: flex; gap: 15px; margin-bottom: 20px; }
.filter-group { display: flex; gap: 15px; background: transparent; }
.filter-item { display: flex; flex-direction: column; }
.filter-item label { font-size: 10px; font-weight: bold; color: #444; margin-bottom: 4px; margin-left: 5px; }
.filter-item select { padding: 5px 15px; border-radius: 20px; border: 2px solid #00CED1; background: #00CED1; color: white; font-size: 12px; min-width: 100px; outline: none; }

/* Style Card Grafik */
.chart-title { font-weight: bold; color: #333; margin-bottom: 15px; font-size: 14px; }
.inner-card { background: #ffffff; padding: 20px; border-radius: 15px; border: 1px solid #eee; }
.chart-container { position: relative; height: 300px; width: 100%; }
</style>

<?= $this->endSection() ?>