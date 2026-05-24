<?= $this->extend('layout/dashboard_layout_kepalatbc') ?>
<?= $this->section('content') ?>
<?php helper('text'); ?>

<!-- WELCOME -->
<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali!</h5>
        <h3>Anda masuk sebagai KEPALA PUSKESMAS</h3>
        <p>Puskesmas Kaliwates, Jember</p>
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
            <h3 class="blue"><?= $totalKasusAktif ?></h3>
            <p>Total Kasus</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-arrow-up"></i>
            <i class="fa-solid fa-arrow-down"></i>
        </div>
        <div class="stat-info">
            <h3 class="blue"><?= $kasusBulanIni ?></h3>
            <p>Kasus Baru Bulan Ini</p>
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

<div id="scroll-target"></div>

<style>
.section-header h5 {
    font-size: 1.55rem;
    font-weight: 700;
    color: #1f2e2e;
    margin-bottom: 0.25rem;
    line-height: 1.2;
}

.section-header .sub {
    font-size: 1rem;
    color: #555;
    margin-bottom: 1rem;
}

.section-block {
    margin-bottom: 2rem;
}

.content-section {
    margin-left: 1rem;  /* memberi jarak dari sidebar */
    margin-right: 2rem; /* bisa disesuaikan */
    margin-bottom: 2rem; /* jarak antar section */
}

.content-section .section-title {
    font-size: 1.55rem;
    font-weight: 700;
    color: #1f2e2e;
    margin-bottom: 0.25rem;
}

.content-section .section-sub {
    font-size: 1rem;
    color: #555;
    margin-bottom: 1rem;
}

.label-desa-no-bg{
    background:transparent !important;
    border:none !important;
}

.label-desa-no-bg span{
    display:block;
    text-align:center;
    white-space:nowrap;
    text-shadow:
        1px 1px 3px rgba(255,255,255,0.95),
        -1px -1px 3px rgba(255,255,255,0.95);
}
.leaflet-control-attribution {
    display: none !important;
}
</style>

<!-- MAP SECTION -->
<div class="section-block" id="peta-sebaran">
    <div class="section-header mb-3">
        <div>
            <h2 class="fw-bold mb-1">Peta Interaktif Penyebaran</h2>
            <p class="text-muted mb-0">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
        </div>
        <div class="filter">
            <span>Periode:</span>
            <select id="selectPeriode">
<?php for($i = 2023; $i<=2025; $i++): ?>
                        <option value="<?= $i ?>" <?= $i==date('Y')?'selected':'' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <div class="inner-card mb-5">
        <div id="map" style="height:400px; border-radius:15px;"></div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // const dataWilayah = <?= json_encode($wilayah ?? []) ?>;
    const dataWilayah = <?= json_encode($mapTbc ?? []) ?>;
    const allTbc = <?= json_encode($mapTbc ?? []) ?>;

    // Fungsi filter data by year
    function filterDataByYear(year){
        return allTbc.filter(item => parseInt(item.tahun) === parseInt(year))
                     .reduce((acc,item) => {
                         const key = item.kelurahan.trim();
                         acc[key] = {...item};
                         return acc;
                     }, {});
    }

    // =========================
    // INIT MAP
    // =========================
    const map = L.map('map',{minZoom:12,maxZoom:14}).setView([-8.1,113.5],12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    setTimeout(()=>map.invalidateSize(),200);

    // =========================
    // KOMPAS
    // =========================
    const CompassControl = L.Control.extend({
        options:{position:'topright'},
        onAdd:function(map){
            const c = L.DomUtil.create('div','leaflet-compass-control');
            c.style.width='70px';
            c.style.height='70px';
            c.style.backgroundImage='url("/assets/icon/kompas.svg")';
            c.style.backgroundSize='contain';
            c.style.backgroundRepeat='no-repeat';
            c.style.backgroundPosition='center';
            c.style.pointerEvents='none';
            c.style.display='flex';
            c.style.alignItems='center';
            c.style.justifyContent='center';
            return c;
        }
    });
    map.addControl(new CompassControl());

    // =========================
    // KOORDINAT MOUSE
    // =========================
    const coordDiv = L.control({position:'bottomleft'});
    coordDiv.onAdd = function(map){
        this._div = L.DomUtil.create('div','mouse-coords');
        Object.assign(this._div.style,{
            background:'rgba(255,255,255,0.85)',
            boxShadow:'0 2px 6px rgba(0,0,0,0.25)',
            padding:'6px 10px',
            borderRadius:'5px',
            fontSize:'13px',
            fontWeight:'600',
            lineHeight:'1.4',
            textAlign:'left'
        });
        this._div.innerHTML='Lat : -<br>Lng : -';
        return this._div;
    };
    coordDiv.addTo(map);

    map.on('mousemove',e=>{
        coordDiv._div.innerHTML=`Lat : ${e.latlng.lat.toFixed(5)}<br>Lng : ${e.latlng.lng.toFixed(5)}`;
    });
    map.on('mouseout',()=>{coordDiv._div.innerHTML='Lat : -<br>Lng : -';});

    // =========================
    // LEGEND
    // =========================
    const legend = L.control({position:'bottomright'});
    legend.onAdd=function(map){
        const div = L.DomUtil.create('div','info legend');
        Object.assign(div.style,{
            background:'rgba(255,255,255,0.9)',
            padding:'8px 12px',
            borderRadius:'6px',
            boxShadow:'0 2px 6px rgba(0,0,0,0.25)',
            fontSize:'13px',
            lineHeight:'1.5',
            fontWeight:'600'
        });
        const grades = ['Tidak Ada','Rendah','Sedang','Tinggi'];
        const colors = ['#999','#2a9d8f','#ff9800','#e63946'];
        div.innerHTML='<b>Kategori Kasus</b><br>';
        grades.forEach((g,i)=>{div.innerHTML+=`<i style="background:${colors[i]};width:18px;height:18px;display:inline-block;margin-right:6px;border-radius:3px;"></i> ${g}<br>`});
        return div;
    };
    legend.addTo(map);

    // =========================
    // RENDER MAP + MODAL REVISI
    // =========================
    let geoLayer = null;
    let labelLayer = L.layerGroup().addTo(map);
    function renderMap(filteredData) {
    if (geoLayer) geoLayer.remove();

    // NORMALISASI DATA AGAR NAMA WILAYAH MATCH
    const normalizedData = {};
    Object.keys(filteredData).forEach(key => {
        const normalizedKey = key.trim().replace(/\s+/g, '').toLowerCase();
        normalizedData[normalizedKey] = filteredData[key];
    });

    fetch("<?= base_url('assets/peta/tbc.geojson') ?>")
        .then(res => res.json())
        .then(data => {

            geoLayer = L.geoJSON(data, {

                style: function(feature) {
                    const namaWilayah = feature.properties.NAMOBJ
                        ?.trim().replace(/\s+/g, '').toLowerCase();

                    const item = normalizedData[namaWilayah] || {
                        kasus: 0,
                        kelurahan: feature.properties.NAMOBJ
                    };

                    const totalKasus = parseInt(item.kasus) || 0;
                    const values = Object.values(normalizedData).map(x => parseInt(x.kasus) || 0);
                    const minVal = values.length ? Math.min(...values) : 0;
                    const maxVal = values.length ? Math.max(...values) : 0;
                    const interval = (maxVal - minVal) / 3;

                    let tingkat, warna;
                    if (totalKasus === 0) {
                        tingkat = "Tidak Ada";
                        warna = "#999";
                    } else if (totalKasus <= minVal + interval) {
                        tingkat = "Rendah";
                        warna = "#2a9d8f";
                    } else if (totalKasus <= minVal + 2 * interval) {
                        tingkat = "Sedang";
                        warna = "#ff9800";
                    } else {
                        tingkat = "Tinggi";
                        warna = "#e63946";
                    }

                    return {
                        color: "#00bcd4",
                        weight: 2,
                        fillColor: warna,
                        fillOpacity: 0.55
                    };
                },

                onEachFeature: function(feature, layer) {

                    const namaWilayah = feature.properties.NAMOBJ
                        ?.trim().replace(/\s+/g, '').toLowerCase();

                    const item = normalizedData[namaWilayah] || {
                        kasus: 0,
                        kelurahan: feature.properties.NAMOBJ,
                        anak: 0,
                        dewasa: 0,
                        lansia: 0,
                        penduduk: 0
                    };

                    const totalKasus = parseInt(item.kasus) || 0;
                    const values = Object.values(normalizedData).map(x => parseInt(x.kasus) || 0);
                    const minVal = values.length ? Math.min(...values) : 0;
                    const maxVal = values.length ? Math.max(...values) : 0;
                    const interval = (maxVal - minVal) / 3;

                    let tingkat, warna;
                    if (totalKasus === 0) {
                        tingkat = "Tidak Ada";
                        warna = "#999";
                    } else if (totalKasus <= minVal + interval) {
                        tingkat = "Rendah";
                        warna = "#2a9d8f";
                    } else if (totalKasus <= minVal + 2 * interval) {
                        tingkat = "Sedang";
                        warna = "#ff9800";
                    } else {
                        tingkat = "Tinggi";
                        warna = "#e63946";
                    }

                    // LABEL WILAYAH
                    const latlng = layer.getBounds().getCenter();
                    L.marker(latlng, {
                        icon: L.divIcon({
                            className: 'label-desa-no-bg',
                            html: `
                                <span style="
                                    font-size:14px;
                                    color:#222;
                                    font-weight:600;
                                ">
                                    ${feature.properties.NAMOBJ}
                                </span>
                            `,
                            iconSize: [100,20]
                        }),
                        interactive:false
                    }).addTo(labelLayer);

                    // POPUP & MODAL
                    const isi = `
                        <div style="width:230px;font-family:Poppins,sans-serif;">
                            <div style="font-size:16px;font-weight:700;margin-bottom:8px;color:#222;">
                                Kelurahan: ${item.kelurahan}
                            </div>
                            <div style="font-size:13px;color:#444;margin-bottom:4px;">
                                Total Kasus: <b>${totalKasus}</b>
                            </div>
                            <div style="font-size:13px;color:#444;margin-bottom:14px;">
                                Kategori: <b style="color:${warna}">${tingkat}</b>
                            </div>
                            <button
                                type="button"
                                data-id="${namaWilayah}"
                                style="background:#14c7d4;color:white;border:none;padding:10px 18px;border-radius:10px;font-weight:600;cursor:pointer;width:100%;">
                                Selengkapnya
                            </button>
                        </div>
                    `;
                    layer.bindPopup(isi, { closeButton:false });

                    // hover events
                    // layer.on('mouseover', () => { layer.openPopup(); layer.setStyle({weight:3}); });
                    layer.on('mouseover', () => {layer.openPopup(); layer.setStyle({weight:3}); });
                    // HAPUS auto close popup
                    layer.on('mouseout', () => {layer.setStyle({weight:2,fillOpacity:0.55}); });

                    // BUTTON MODAL DETAIL
                    layer.on('popupopen', function(e) {

                    const popup = e.popup.getElement();

                    L.DomEvent.disableClickPropagation(popup);
                    L.DomEvent.disableScrollPropagation(popup);

                    const btn = popup.querySelector('button');
                    const idWilayah = btn.getAttribute('data-id');

                    btn.onclick = function(ev) {

                        ev.stopPropagation();

                        const itemData = normalizedData[idWilayah] || {
                            kasus: 0,
                            anak:0,
                            dewasa:0,
                            lansia:0,
                            penduduk:0,
                            kelurahan:'-'
                        };

                        document.getElementById('mdNama').innerText =
                            `: ${itemData.kelurahan}`;

                        document.getElementById('mdPenduduk').innerText =
                            `: ${itemData.penduduk}`;

                        document.getElementById('mdKasus').innerText =
                            `: ${itemData.kasus}`;

                        document.getElementById('mdAnak').innerText =
                            `: ${itemData.anak}`;

                        document.getElementById('mdDewasa').innerText =
                            `: ${itemData.dewasa}`;

                        document.getElementById('mdLansia').innerText =
                            `: ${itemData.lansia}`;

                        document.getElementById('modalTbc').style.display = 'block';
                    };

                    // POPUP BARU HILANG SAAT CURSOR KELUAR DARI POPUP
                    popup.addEventListener('mouseleave', () => {
                        layer.closePopup();
                    });

                });
                }

            }).addTo(map);

            map.fitBounds(geoLayer.getBounds());

        });
}
      

    // =========================
    // EVENT SELECT PERIODE
    // =========================
    const selectPeriode = document.getElementById('selectPeriode');
    selectPeriode.addEventListener('change', function(){
        renderMap(filterDataByYear(this.value));
    });

    // =========================
    // INITIAL RENDER
    // =========================
    renderMap(filterDataByYear(selectPeriode.value));
});
</script>
    </div>

    <!-- CHART -->

<div class="container-fluid pb-5">
    <div class="card border-0 shadow-sm rounded-4 p-4" style="background:#EEF5F5;">

        <div class="mb-4">
            <h2 class="fw-bold mb-1">Grafik Interaktif Penyebaran</h2>
            <p class="text-muted mb-0">Visualisasi Kepadatan Kasus berdasarkan grafik</p>
        </div>

        <div class="d-flex flex-wrap gap-3 justify-content-end mb-4">

            <select id="filterWilayah" class="form-select rounded-pill" style="width:220px;">
                <option value="Semua Wilayah">Semua Wilayah</option>
                <option value="Jemberkidul">Jemberkidul</option>
                <option value="Tegalbesar">Tegalbesar</option>
                <option value="Kaliwates">Kaliwates</option>
                <option value="Kebonagung">Kebonagung</option>
                <option value="Sempusari">Sempusari</option>
                <option value="Mangli">Mangli</option>
                <option value="Kepatihan">Kepatihan</option>
                <option value="Lainnya">Lainnya</option>
            </select>

            <select id="filterKategori" class="form-select rounded-pill" style="width:240px;">
                <option value="Semua" selected>Semua Kategori</option>
                <option value="Balita">0 - 4 Tahun (Balita)</option>
                <option value="Anak-anak">5 - 9 Tahun (Anak-anak)</option>
                <option value="Remaja">10 - 18 Tahun (Remaja)</option>
                <option value="Dewasa">19 - 59 Tahun (Dewasa)</option>
                <option value="Lansia">60+ Tahun (Lansia)</option>
            </select>

            <select id="filterWaktu" class="form-select rounded-pill" style="width:220px;">
                <option value="Semua" selected>Semua Bulan</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>

            <input type="number" id="filterTahun" class="form-control rounded-pill"
                   value="<?= date('Y') ?>" placeholder="Tahun" style="width:180px;">
                 
        </div>
        
        <div class="mt-4">
            <div class="card border-0 rounded-4 p-4 text-center">

                <div class="d-flex justify-content-center mb-4">
                    <div class="grafik-tabs">
                        <button class="tab-btn active" onclick="gantiGrafik('status', this)">STATUS PASIEN</button>
                        <button class="tab-btn" onclick="gantiGrafik('jk', this)">JENIS KELAMIN</button>
                        <button class="tab-btn" onclick="gantiGrafik('umur', this)">KATEGORI UMUR</button>
                    </div>
                </div>

                <div style="height:400px;">
                    <canvas id="mainChart">
                        <script>
const grafikData = <?= $grafik ?>;
const wilayah = <?= $wilayah ?>;
const bulanList = <?= $bulanList ?>;
const statusList = ['Pengobatan Lengkap','Sembuh','Meninggal','Putus Berobat','Pindah'];
const kategoriList = ['Balita','Anak-anak','Remaja','Dewasa','Lansia'];
const genderList = ['laki','perempuan'];

let kategoriAktif = 'Semua';
let bulanAktif = 'Semua';
let wilayahAktif = 'Semua Wilayah';

const ctx = document.getElementById('mainChart');
let mainChart;
// Ambil elemen filter
const filterWilayah = document.getElementById('filterWilayah');
const filterKategori = document.getElementById('filterKategori');
const filterBulan = document.getElementById('filterWaktu');
const filterTahun = document.getElementById('filterTahun');

// Update state filter
filterWilayah.addEventListener('change', () => {
    wilayahAktif = filterWilayah.value;
    gantiGrafik(getActiveChartType(), document.querySelector('.tab-btn.active'));
});

filterKategori.addEventListener('change', () => {
    kategoriAktif = filterKategori.value;
    gantiGrafik(getActiveChartType(), document.querySelector('.tab-btn.active'));
});

filterBulan.addEventListener('change', () => {
    bulanAktif = filterBulan.value;
    gantiGrafik(getActiveChartType(), document.querySelector('.tab-btn.active'));
});

filterTahun.addEventListener('input', () => {
    tahunAktif = filterTahun.value;
    gantiGrafik(getActiveChartType(), document.querySelector('.tab-btn.active'));
});

// Helper: ambil tipe chart aktif
function ambilDataStatus(statusCari) {
    let hasil = [];
    getLabels().forEach(w => {
        let total = 0;

        Object.keys(grafikData).forEach(bulan => {
            ['laki', 'perempuan'].forEach(gender => {
                ['Balita','Anak-anak','Remaja','Dewasa','Lansia'].forEach(kategori => {
                    total += grafikData[bulan][gender][kategori][w][statusCari] || 0;
                });
            });
        });

        hasil.push(total);
    });
    return hasil;
}
function getActiveChartType() {
    const activeBtn = document.querySelector('.tab-btn.active');
    if (!activeBtn) return 'status';
    if (activeBtn.textContent.includes('STATUS')) return 'status';
    if (activeBtn.textContent.includes('JENIS')) return 'jk';
    if (activeBtn.textContent.includes('KATEGORI')) return 'umur';
    return 'status';
}
// ====================== FUNGSI HITUNG TOTAL ======================
function hitungTotal({wilayah=null, kategori=null, gender=null, status=null}={}) {
    let total = 0;

    const bulanKeys = bulanList;

    bulanKeys.forEach(b => {
        (gender ? [gender] : genderList).forEach(g => {
            (kategori && kategori !== 'Semua' ? [kategori] : kategoriList).forEach(k => {
                const wilayahList = wilayah ? [wilayah] : (wilayahAktif !== 'Semua Wilayah' ? [wilayahAktif] : wilayah);
                (status ? [status] : statusList).forEach(s => {
                    wilayahList.forEach(wl => {
                        total += grafikData[b]?.[g]?.[k]?.[wl]?.[s] || 0;
                    });
                });
            });
        });
    });

    return total;
}

// ====================== BUAT CHART STATUS ======================
function buatChartStatus() {
    if(mainChart) mainChart.destroy();

   const labels = (wilayahAktif !== 'Semua Wilayah') ? [wilayahAktif] : ['Jemberkidul','Tegalbesar','Kaliwates','Kebonagung','Sempusari','Mangli','Kepatihan'];

    mainChart = new Chart(ctx, {
        type:'bar',
        data:{
            labels,
            datasets:[
                {label:'Pengobatan Lengkap', data: labels.map(w => hitungTotal({wilayah:w,status:'Pengobatan Lengkap'})), backgroundColor:'#B7E4D7'},
                {label:'Sembuh', data: labels.map(w => hitungTotal({wilayah:w,status:'Sembuh'})), backgroundColor:'#0B5D4B'},
                {label:'Meninggal', data: labels.map(w => hitungTotal({wilayah:w,status:'Meninggal'})), backgroundColor:'#F4A300'},
                {label:'Putus Berobat', data: labels.map(w => hitungTotal({wilayah:w,status:'Putus Berobat'})), backgroundColor:'#DC3545'},
                {label:'Pindah', data: labels.map(w => hitungTotal({wilayah:w,status:'Pindah'})), backgroundColor:'#6F42C1'}
            ]
        },
        options:{responsive:true, maintainAspectRatio:false,indexAxis:'y'}
    });
}

// ====================== BUAT CHART JK ======================
function buatChartJK(){
    if(mainChart) mainChart.destroy();

    const labels = wilayahAktif!=='Semua Wilayah'? [wilayahAktif]: wilayah;
    mainChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels,
            datasets:[
                {label:'Laki-laki', data: labels.map(w=>hitungTotal({wilayah:w,gender:'laki'})), backgroundColor:'#20C9C3'},
                {label:'Perempuan', data: labels.map(w=>hitungTotal({wilayah:w,gender:'perempuan'})), backgroundColor:'#B7E4D7'}
            ]
        },
        options:{responsive:true, maintainAspectRatio:false}
    });
}

// ====================== BUAT CHART UMUR ======================
function buatChartUmur(){
    if(mainChart) mainChart.destroy();

    const dataUmur = kategoriList.map(k=>{
        let total = 0;
        bulanList.forEach(b=>{
            genderList.forEach(g=>{
                (wilayahAktif!=='Semua Wilayah'? [wilayahAktif]: wilayah).forEach(w=>{
                    statusList.forEach(s=>{
                        total += grafikData[b]?.[g]?.[k]?.[w]?.[s] || 0;
                    });
                });
            });
        });
        return total;
    });

    mainChart = new Chart(ctx,{
        type:'line',
        data:{
            labels:['Balita (0-4)','Anak-anak (5-9)','Remaja (10-18)','Dewasa (19-59)','Lansia (60+)'],
            datasets:[{label:'Jumlah Pasien', data:dataUmur, borderColor:'#20C9C3', backgroundColor:'rgba(32,201,195,0.1)', fill:true, tension:0.3, pointRadius:6, pointBackgroundColor:'#20C9C3'}]
        },
        options:{responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true,ticks:{stepSize:1}}}}
    });
}

// ====================== TAB & FILTER ======================
function renderChart(){
    if(window.grafikAktif==='jk') buatChartJK();
    else if(window.grafikAktif==='umur') buatChartUmur();
    else buatChartStatus();
}

function gantiGrafik(tipe, el){
    window.grafikAktif = tipe;
    document.querySelectorAll('.tab-btn').forEach(btn=>btn.classList.remove('active'));
    el.classList.add('active');
    renderChart();
}

document.getElementById('filterWilayah').addEventListener('change', function() {
    wilayahAktif = this.value;
    renderChart();
});

document.getElementById('filterKategori').addEventListener('change', function() {
    kategoriAktif = this.value;
    renderChart();
});

document.getElementById('filterWaktu').addEventListener('change', function() {
    bulanAktif = this.value;
    renderChart();
});

document.getElementById('filterTahun').addEventListener('change', function() {
    tahunAktif = this.value;
    renderChart();
});

buatChartStatus();

</script>
                    </canvas>
                </div>

            </div>
        </div>

        <div class="mt-3 text-muted small">
            Diperbarui pada: <?= date('d-m-Y') ?>
        </div>

    </div>
</div>

<style>
.grafik-tabs { display:flex; justify-content:center; margin-bottom:30px; }
.tab-btn {
    padding:12px 28px;
    border:1px solid #20C9C3;
    background:white !important;
    color:#20C9C3 !important;
    font-weight:600;
    font-size:13px;
    cursor:pointer;
    transition:0.3s;
    min-width:170px;
}
.tab-btn:first-child { border-radius:30px 0 0 30px; }
.tab-btn:last-child  { border-radius:0 30px 30px 0; }
.tab-btn.active { background:#20C9C3 !important; color:white !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid pb-5">
<!-- SECTION BERITA -->
<div class="content-section">

<h2 class="fw-bold mb-1">Berita</h2>
<p class="text-muted mb-0">Informasi terkini seputar pencegahan, penanganan, dan edukasi penyakit TBC.</p>

<?php if (!empty($berita)) : ?>
    <div class="carousel-wrapper">

        <button class="nav-btn left" onclick="slide(-1)">‹</button>

        <div class="berita-slider" id="slider">

            <?php foreach ($berita as $b) : ?>
                <?php
                $link = !empty($b['url_berita'])
                    ? $b['url_berita']
                    : base_url('tbc/berita/detail/' . $b['id_berita']);
                ?>

                <div class="info-card berita-card">

                    <div class="info-text">
                        <h5><?= esc($b['judul_berita']) ?></h5>

                        <?php if (!empty($b['deskripsi_berita'])) : ?>
                            <p>
                                <?= substr(strip_tags($b['deskripsi_berita']), 0, 120) . '...' ?>
                            </p>
                        <?php endif; ?>

                        <small>
                            <?= !empty($b['tanggal_berita']) && $b['tanggal_berita'] != '0000-00-00'
                                ? date('d M Y', strtotime($b['tanggal_berita']))
                                : '-' ?>
                        </small>

<a href="<?= $link ?>" 
   class="read-more-btn" 
   <?= !empty($b['url_berita']) ? 'target="_blank"' : '' ?>>
   Baca Selengkapnya
</a>
                    </div>

                    <div class="info-image">
                        <?php if (!empty($b['gambar_berita'])) : ?>
                            <img src="<?= base_url('uploads/berita/' . $b['gambar_berita']) ?>">
                        <?php else : ?>
                            <img src="<?= base_url('img/default-news.png') ?>">
                        <?php endif; ?>
                    </div>

                </div>

            <?php endforeach ?>

        </div>

        <button class="nav-btn right" onclick="slide(1)">›</button>
        <div class="dots" id="dots"></div>

    </div>
<?php endif ?>

</div>

<!-- SECTION FUNFACT -->
<div class="content-section">

<h2 class="fw-bold mb-1">Funfact</h2>
<p class="text-muted mb-0">Fakta menarik dan edukasi singkat seputar penyakit TBC.
</p>
    <?php if (!empty($funfact)) : ?>

    <div class="carousel-wrapper">

<button class="nav-btn left" onclick="slideFunfact(-1)">‹</button>

<div class="funfact-slider" id="funfactSlider">
    <?php foreach ($funfact as $f) : ?>
        <div class="info-card funfact-card">
            <div class="info-text">
                <h5><?= esc($f['judul_funfact']) ?></h5>
                <p>
                    <?= !empty($f['deskripsi_funfact'])
                        ? substr(strip_tags($f['deskripsi_funfact']), 0, 120) . '...'
                        : '-' ?>
                </p>
                        <!-- Tombol Baca Selengkapnya -->
        <a href="<?= base_url('tbc/funfact/detail/' . $f['id_funfact']) ?>" class="btn-read-more">Baca Selengkapnya</a>
    </div>
            <div class="info-image">
                <img src="<?= base_url('uploads/funfact/' . $f['gambar_funfact']) ?>">
            </div>
        </div>
    <?php endforeach; ?>
</div>

<button class="nav-btn right" onclick="slideFunfact(1)">›</button>

<div class="funfact-dots" id="funfactDots"></div>

</div>

<?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmLogout(url) {

    Swal.fire({
        title: 'Apakah anda yakin keluar?',
        icon: 'warning',
        showCancelButton: true,

        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'

    }).then((result) => {

        if (result.isConfirmed) {
            window.location.href = url;
        }

    });

}
</script>

<style>

.berita-slider{
    display:flex;
    gap:25px;

    overflow-x:auto;    
    scroll-behavior:smooth;

    padding-top: 2rem;
    padding-bottom:15px;
}

.berita-slider::-webkit-scrollbar{
    height:8px;
}

.berita-slider::-webkit-scrollbar-thumb{
    background:#14c7d4;
    border-radius:20px;
}

.berita-card{
    min-width:850px;

    flex:0 0 auto;

    display:flex;
    flex-direction:row;

    align-items:center;
    justify-content:space-between;

    border-radius:25px;
    padding:35px;

    text-decoration:none;

    background:linear-gradient(135deg,#1ecad3,#14b8c4);

    color:white;
}

.berita-card .info-text{
    width:65%;
}

.berita-card .info-text h5{
    font-size:28px;
    font-weight:700;
    margin-bottom:18px;
    color:white;
}

.berita-card .info-text p{
    font-size:16px;
    line-height:1.8;
    color:white;
}

.berita-card .info-text small{
    font-size:15px;
    color:#eafcff;
}

.berita-card .info-image{
    width:30%;
    display:flex;
    justify-content:flex-end;
}

.berita-card .info-image img{
    width:220px;
    height:160px;

    object-fit:cover;

    border-radius:20px;
}

.carousel-wrapper{
    position:relative;
}

.nav-btn{
    position:absolute;
    top:50%;
    transform:translateY(-50%);

    width:45px;
    height:45px;

    border:none;
    border-radius:50%;

    background:white;
    color:#14b8c4;

    font-size:28px;
    font-weight:bold;

    box-shadow:0 5px 15px rgba(0,0,0,0.15);

    cursor:pointer;
    z-index:10;
}

.nav-btn.left{
    left:-20px;
}

.nav-btn.right{
    right:-20px;
}

.dots{
    margin-top:15px;
    text-align:center;
}

.dots span{
    display:inline-block;

    width:10px;
    height:10px;

    margin:0 5px;

    border-radius:50%;

    background:#cfd8dc;

    cursor:pointer;
}

.dots span.active{
    background:#14b8c4;
}

.funfact-dots{
    margin-top:15px;
    text-align:center;
}

.funfact-dots span{
    display:inline-block;

    width:10px;
    height:10px;

    margin:0 5px;

    border-radius:50%;

    background:#cfd8dc;
}

.funfact-dots span.active{
    background:#14b8c4;
}

.funfact-slider{
    display:flex;
    gap:25px;

    overflow-x:auto;
    scroll-behavior:smooth;

    padding-top: 2rem;
    padding-bottom:15px;
}

.funfact-slider::-webkit-scrollbar{
    height:8px;
}

.funfact-slider::-webkit-scrollbar-thumb{
    background:#14c7d4;
    border-radius:20px;
}

.funfact-card{
    min-width:850px;

    flex:0 0 auto;

    display:flex;
    justify-content:space-between;
    align-items:center;

    background:linear-gradient(135deg,#1ecad3,#14b8c4);

    border-radius:28px;

    padding:35px;

    color:white;
}

.funfact-card .info-text{
    width:70%;
}

.funfact-card .info-text h5{
    font-size:26px;
    font-weight:700;
    margin-bottom:18px;
    color:white;
}

.funfact-card .info-text p{
    font-size:17px;
    line-height:1.8;
    color:white;
}

.funfact-card .info-image{
    width:25%;
    display:flex;
    justify-content:flex-end;
}

.funfact-card .info-image img{
    width:230px;
    height:160px;

    object-fit:cover;

    border-radius:22px;
}

.btn-read-more {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 16px;
    background: white;
    color: #14b8c4;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: 0.3s;
}
.btn-read-more:hover {
    background: #14b8c4;
    color: white;
}

.read-more-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 16px;
    background: white;
    color: #14b8c4;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: 0.3s;
}

.read-more-btn:hover {
    background: #14b8c4;
    color: white;
}

</style>

<script>
document.addEventListener("DOMContentLoaded", function(){

    let index = 0;

    const slider = document.getElementById('slider');

    if(!slider) return;

    const total = slider.children.length;

    const dotsContainer = document.getElementById('dots');

    // BUAT DOTS
    for(let i = 0; i < total; i++){

        let dot = document.createElement('span');

        dot.onclick = () => goTo(i);

        dotsContainer.appendChild(dot);
    }

    updateDots();

    // BUTTON
    window.slide = function(dir){

        index += dir;

        if(index >= total) index = 0;
        if(index < 0) index = total - 1;

        updateSlide();
    }

    // DOT CLICK
    function goTo(i){

        index = i;

        updateSlide();
    }

    // UPDATE SLIDE
    function updateSlide(){

        slider.scrollTo({
            left: index * 875,
            behavior: 'smooth'
        });

        updateDots();
    }

    // UPDATE DOT
    function updateDots(){

        const dots = document.querySelectorAll('#dots span');

        dots.forEach((d, i) => {
            d.classList.toggle('active', i === index);
        });
    }

    // AUTO SLIDE
    setInterval(() => {

        slide(1);

    }, 4000);

});
</script>

<script>

let funfactIndex = 0;
let funfactInterval;

document.addEventListener("DOMContentLoaded", function(){

    const funfactSlider = document.getElementById("funfactSlider");
    const dotsContainer = document.getElementById("funfactDots");

    if(!funfactSlider || !dotsContainer) return;

    const cards = funfactSlider.querySelectorAll(".funfact-card");
    const total = cards.length;

    // BUAT DOTS
    dotsContainer.innerHTML = "";

    for(let i = 0; i < total; i++){

        const dot = document.createElement("span");

        if(i === 0){
            dot.classList.add("active");
        }

        dot.onclick = () => {
            funfactIndex = i;
            updateFunfact();
        };

        dotsContainer.appendChild(dot);
    }

    // UPDATE SLIDE
    function updateFunfact(){

        funfactSlider.scrollTo({
            left: funfactIndex * 875,
            behavior: "smooth"
        });

        const dots = dotsContainer.querySelectorAll("span");

        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === funfactIndex);
        });
    }

    // BUTTON
    window.slideFunfact = function(dir){

        funfactIndex += dir;

        if(funfactIndex >= total){
            funfactIndex = 0;
        }

        if(funfactIndex < 0){
            funfactIndex = total - 1;
        }

        updateFunfact();
    }

    // AUTO SLIDE
    funfactInterval = setInterval(() => {

        funfactIndex++;

        if(funfactIndex >= total){
            funfactIndex = 0;
        }

        updateFunfact();

    }, 3500);

});

</script>

<script>

let funfactIndex = 0;
let funfactInterval;

document.addEventListener("DOMContentLoaded", function(){

    const funfactSlider = document.getElementById("funfactSlider");
    const dotsContainer = document.getElementById("funfactDots");

    if(!funfactSlider || !dotsContainer) return;

    const cards = funfactSlider.querySelectorAll(".funfact-card");
    const total = cards.length;

    // BUAT DOTS
    dotsContainer.innerHTML = "";

    for(let i = 0; i < total; i++){

        const dot = document.createElement("span");

        if(i === 0){
            dot.classList.add("active");
        }

        dot.onclick = () => {
            funfactIndex = i;
            updateFunfact();
        };

        dotsContainer.appendChild(dot);
    }

    // UPDATE SLIDE
    function updateFunfact(){

        funfactSlider.scrollTo({
            left: funfactIndex * 875,
            behavior: "smooth"
        });

        const dots = dotsContainer.querySelectorAll("span");

        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === funfactIndex);
        });
    }

    // BUTTON
    window.slideFunfact = function(dir){

        funfactIndex += dir;

        if(funfactIndex >= total){
            funfactIndex = 0;
        }

        if(funfactIndex < 0){
            funfactIndex = total - 1;
        }

        updateFunfact();
    }

    // AUTO SLIDE
    funfactInterval = setInterval(() => {

        funfactIndex++;

        if(funfactIndex >= total){
            funfactIndex = 0;
        }

        updateFunfact();

    }, 3500);

});

</script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    // =========================
    // DATA DARI PHP
    // =========================
    const dataWilayah = <?= json_encode($wilayah ?? []) ?>;
    const allTbc = <?= json_encode($mapTbc ?? []) ?>;

    // =========================
    // FUNCTION FILTER DATA BERDASARKAN TAHUN
    // =========================
    function filterDataByYear(tahun) {

        return allTbc
            .filter(item => parseInt(item.tahun) === parseInt(tahun))
            .reduce((acc, item) => {

                const wilayah = item.kelurahan?.trim();

                acc[wilayah] = {
                    ...item
                };

                return acc;

            }, {});
    }

    // =========================
    // INIT MAP
    // =========================
    const map = L.map('map', {
        minZoom: 12,
        maxZoom: 14
    }).setView([-8.1, 113.5], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
        .addTo(map);

    setTimeout(() => map.invalidateSize(), 200);

    // =========================
    // LEGEND
    // =========================
    var legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {

        var div = L.DomUtil.create('div', 'info legend');

        div.style.background = 'rgba(255,255,255,0.9)';
        div.style.padding = '8px 12px';
        div.style.borderRadius = '6px';
        div.style.boxShadow = '0 2px 6px rgba(0,0,0,0.25)';
        div.style.fontSize = '13px';
        div.style.lineHeight = '1.5';
        div.style.fontWeight = '600';

        var grades = ['Tidak Ada', 'Rendah', 'Sedang', 'Tinggi'];
        var colors = ['#999', '#2a9d8f', '#ff9800', '#e63946'];

        div.innerHTML = '<b>Kategori Kasus</b><br>';

        for (var i = 0; i < grades.length; i++) {

            div.innerHTML +=
                `<i style="background:${colors[i]}; width:18px; height:18px; display:inline-block; margin-right:6px; border-radius:3px;"></i> ${grades[i]}<br>`;
        }

        return div;
    };

    legend.addTo(map);

    // =========================
    // RENDER MAP
    // =========================
    let geoLayer = null;
    let labelLayer = L.layerGroup().addTo(map);

    function renderMap(filteredData) {

        if (geoLayer) geoLayer.remove();
        labelLayer.clearLayers();
        const normalizedData = {};

        Object.keys(filteredData).forEach(key => {

            const normalizedKey =
                key.trim().replace(/\s+/g, '').toLowerCase();

            normalizedData[normalizedKey] = filteredData[key];
        });

        fetch("<?= base_url('assets/peta/tbc.geojson') ?>")
            .then(res => res.json())

            .then(data => {

                geoLayer = L.geoJSON(data, {

                    style: function(feature) {

                        const namaWilayah =
                            feature.properties.NAMOBJ
                            ?.trim()
                            .replace(/\s+/g, '')
                            .toLowerCase();

                        const item = normalizedData[namaWilayah] || {
                            kasus: 0,
                            kelurahan: feature.properties.NAMOBJ
                        };

                        const totalKasus =
                            parseInt(item.kasus) || 0;

                        const values =
                            Object.values(normalizedData)
                            .map(x => parseInt(x.kasus) || 0);

                        const minVal =
                            values.length ? Math.min(...values) : 0;

                        const maxVal =
                            values.length ? Math.max(...values) : 0;

                        const interval =
                            (maxVal - minVal) / 3;

                        let tingkat, warna;

                        if (totalKasus === 0) {

                            tingkat = "Tidak Ada";
                            warna = "#999";

                        } else if (totalKasus <= minVal + interval) {

                            tingkat = "Rendah";
                            warna = "#2a9d8f";

                        } else if (totalKasus <= minVal + 2 * interval) {

                            tingkat = "Sedang";
                            warna = "#ff9800";

                        } else {

                            tingkat = "Tinggi";
                            warna = "#e63946";
                        }

                        return {
                            color: "#00bcd4",
                            weight: 2,
                            fillColor: warna,
                            fillOpacity: 0.55
                        };
                    },

                    onEachFeature: function(feature, layer) {

                        const namaWilayah =
                            feature.properties.NAMOBJ
                            ?.trim()
                            .replace(/\s+/g, '')
                            .toLowerCase();

                        const item = normalizedData[namaWilayah] || {
                            kasus: 0,
                            kelurahan: feature.properties.NAMOBJ,
                            anak: 0,
                            dewasa: 0,
                            lansia: 0,
                            penduduk: 0
                        };

                        const totalKasus =
                            parseInt(item.kasus) || 0;

                        const values =
                            Object.values(normalizedData)
                            .map(x => parseInt(x.kasus) || 0);

                        const minVal =
                            values.length ? Math.min(...values) : 0;

                        const maxVal =
                            values.length ? Math.max(...values) : 0;

                        const interval =
                            (maxVal - minVal) / 3;

                        let tingkat, warna;

                        if (totalKasus === 0) {

                            tingkat = "Tidak Ada";
                            warna = "#999";

                        } else if (totalKasus <= minVal + interval) {

                            tingkat = "Rendah";
                            warna = "#2a9d8f";

                        } else if (totalKasus <= minVal + 2 * interval) {

                            tingkat = "Sedang";
                            warna = "#ff9800";

                        } else {

                            tingkat = "Tinggi";
                            warna = "#e63946";
                        }

                        const isi = `
                            <div style="width:230px;font-family:Poppins,sans-serif;">

                                <div style="font-size:16px;font-weight:700;margin-bottom:8px;color:#222;">
                                    Kelurahan: ${item.kelurahan}
                                </div>

                                <div style="font-size:13px;color:#444;margin-bottom:4px;">
                                    Total Kasus: <b>${totalKasus}</b>
                                </div>

                                <div style="font-size:13px;color:#444;margin-bottom:14px;">
                                    Kategori: <b style="color:${warna}">${tingkat}</b>
                                </div>

                                <button
                                    type="button"
                                    onclick="openModal(
                                        '${item.kelurahan}',
                                        '${item.kasus}',
                                        '${tingkat}',
                                        '${item.anak}',
                                        '${item.dewasa}',
                                        '${item.lansia}',
                                        '${item.penduduk}'
                                    )"

                                    style="background:#14c7d4;color:white;border:none;padding:10px 18px;border-radius:10px;font-weight:600;cursor:pointer;width:100%;">

                                    Selengkapnya

                                </button>

                            </div>
                        `;

                        layer.bindPopup(isi, {
                            closeButton:false
                        });

                        layer.on('popupopen', function(e) {

                            const popup = e.popup.getElement();

                            L.DomEvent.disableClickPropagation(popup);
                            L.DomEvent.disableScrollPropagation(popup);

                        });

                        layer.on('mouseover', () => {

                            layer.openPopup();

                            layer.setStyle({
                                weight:3
                            });

                        });

                        layer.on('mouseout', () => {

                        const popup = layer.getPopup();

                        if (!popup) return;

                        setTimeout(() => {

                            const popupEl = popup.getElement();

                            if (!popupEl || !popupEl.matches(':hover')) {

                                layer.closePopup();

                                layer.setStyle({
                                    weight:2,
                                    fillOpacity:0.55
                                });

                            }

                        }, 1000);

                    });

                    }

                }).addTo(map);

                map.fitBounds(geoLayer.getBounds());

            });
    }

    const selectPeriode =
        document.getElementById('selectPeriode');

    selectPeriode.addEventListener('change', function(){

        renderMap(filterDataByYear(this.value));

    });

    renderMap(filterDataByYear(selectPeriode.value));

});
</script>

<style>

.leaflet-popup-content-wrapper{
    pointer-events:auto !important;
}

.leaflet-popup-content{
    pointer-events:auto !important;
}

.leaflet-popup-tip-container{
    pointer-events:auto !important;
}

#map{
    overflow:hidden;
}

</style>

<!-- MODAL DETAIL -->
<div id="modalTbc" class="modal-tbc">

    <div class="modal-content-tbc">

        <span class="close-modal" onclick="closeModal()">
            &times;
        </span>

        <h2>Peta Sebaran Kasus <?= date('Y'); ?></h2>

        <div class="modal-body">

            <div class="detail-list">

                <div class="detail-title">
                    Informasi :
                </div>

                <div class="detail-row">
                    <span>Nama Daerah</span>
                    <p id="mdNama">: -</p>
                </div>

                <div class="detail-row">
                    <span>Jumlah Penduduk</span>
                    <p id="mdPenduduk">: 0</p>
                </div>

                <div class="detail-row">
                    <span>Jumlah Kasus</span>
                    <p id="mdKasus">: <?= $jumlahKasus ?? 0; ?></p>
                </div>

                <div class="detail-row">
                    <span>Kategori Kasus</span>
                    <p id="mdKategori">: -</p>
                </div>

                <div class="detail-row">
                    <span>Rentang usia</span>
                    <p>: </p>
                </div>

                <div class="detail-sub">

                    <div class="detail-row">
                        <span>Anak-anak</span>
                        <p id="mdAnak">: 0</p>
                    </div>

                    <div class="detail-row">
                        <span>Dewasa</span>
                        <p id="mdDewasa">: 0</p>
                    </div>

                    <div class="detail-row">
                        <span>Lansia</span>
                        <p id="mdLansia">: 0</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

.modal-tbc{
    display:none;

    position:fixed;
    z-index:9999;

    left:0;
    top:0;

    width:100%;
    height:100%;

    background:rgba(0,0,0,0.45);

    justify-content:center;
    align-items:center;

    padding:20px;
    box-sizing:border-box;
}

.modal-content-tbc{
    width:760px;
    background:#fff;
    border-radius:28px;
    padding:38px;
    position:relative;
    font-family:'Poppins',sans-serif;
    box-shadow:0 10px 35px rgba(0,0,0,0.12);

    max-height:90vh;
    overflow-y:auto;

}

.modal-content-tbc h2{
    font-size:24px;
    font-weight:700;
    color:#1f2937;
    margin-bottom:28px;
}

.close-modal{
    position:absolute;
    top:18px;
    right:24px;
    font-size:34px;
    font-weight:bold;
    cursor:pointer;
    color:#444;
}

.detail-list{
    border:1px solid #e5e7eb;
    border-radius:24px;
    padding:32px;
    background:#fafafa;
}

.detail-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:30px;
    color:#222;
}

.detail-row{
    display:flex;
    align-items:flex-start;
    margin-bottom:22px;
}

/* KIRI */
.detail-row span{
    width:380px;
    font-size:17px;
    color:#444;
    font-weight:500;
    line-height:1.7;
}

/* KANAN */
.detail-row p{
    margin:0;
    font-size:17px;
    color:#222;
    font-weight:600;
    line-height:1.7;
}

.detail-sub{
    margin-left:40px;
    margin-top:-8px;
    margin-bottom:22px;
}

.detail-sub .detail-row{
    margin-bottom:14px;
}

.detail-sub .detail-row span{
    width:340px;
    font-size:15px;
    color:#666;
    font-weight:400;
}

.detail-sub .detail-row p{
    font-size:15px;
    font-weight:500;
}

.leaflet-popup-content button{
    position:relative;
    z-index:99999;
    pointer-events:auto;
}

.leaflet-popup-content{
    pointer-events:auto !important;
}

.leaflet-popup{
    pointer-events:auto !important;
}

.leaflet-container{
    z-index:1;
}

.modal-tbc{
    z-index:999999 !important;
}

</style>

<script>

function openModal(
    nama,
    kasus,
    kategori,
    anak = 0,
    dewasa = 0,
    lansia = 0,
    penduduk = 0,
    laki = 0,
    perempuan = 0
){

    document.getElementById('modalTbc').style.display = 'flex';

    document.getElementById('mdNama').innerHTML =
        ': ' + nama;

    document.getElementById('mdKasus').innerHTML =
        ': ' + kasus;

    document.getElementById('mdPenduduk').innerHTML =
        ': ' + penduduk;

    document.getElementById('mdKategori').innerHTML =
        ': ' + kategori;

    document.getElementById('mdAnak').innerHTML =
        ': ' + anak;

    document.getElementById('mdDewasa').innerHTML =
        ': ' + dewasa;

    document.getElementById('mdLansia').innerHTML =
        ': ' + lansia;

    document.getElementById('mdLaki').innerHTML =
        ': ' + laki;

    document.getElementById('mdPerempuan').innerHTML =
        ': ' + perempuan;
}

window.openModal = openModal;

function closeModal(){

    document.getElementById('modalTbc').style.display = 'none';
}

window.onclick = function(e){

    const modal = document.getElementById('modalTbc');

    if(e.target == modal){
        closeModal();
    }
}

</script>

<?= $this->endSection() ?>