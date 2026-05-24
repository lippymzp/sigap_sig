<?= $this->extend('layout/dashboarddsing') ?>

<?= $this->section('content') ?>

<!-- WELCOME -->
<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai ADMIN</h3>
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
            <h3 class="red"><?= count($diare ?? []) ?></h3>
            <p>Total Kasus Aktif Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-arrow-up"></i>
            <i class="fa-solid fa-arrow-down"></i>
        </div>
        <div class="stat-info">
         <h3 class="green">
<?= count(array_filter($diare ?? [], function($d){
    if(empty($d['tanggal_kunjungan'])) return false;

    return date('Y-m-d', strtotime($d['tanggal_kunjungan'])) === date('Y-m-d');
})) ?>
</h3>
            <p>Kasus Baru Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-map"></i>
        </div>
        <div class="stat-info">
          <h3 class="blue">
<?= count(array_unique(array_column($diare ?? [], 'desa'))) ?>
</h3>
            <p>Kelurahan Terdampak</p>
        </div>
    </div>

</div>
<section id="grafik" class="container mt-5">

<h4 class="text-teal mb-3 fw-bold">Grafik Diare</h4>

<div class="row mb-3">

<div class="col-md-4">
<select id="filterDesa" class="form-control shadow-sm">
<option value="">Semua Desa</option>
</select>
</div>

<div class="col-md-4">
<select id="filterDiagnosis" class="form-control shadow-sm">
<option value="">Semua Diagnosis</option>
</select>
</div>

<div class="col-md-4">
<select id="filterTahun" class="form-control shadow-sm">
<option value="">Semua Tahun</option>
</select>
</div>

</div>

<div class="row">

<div class="col-md-9">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<canvas id="chartDiare"></canvas>
</div>
</div>

<div class="col-md-3">
<div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
<h6>Keterangan Grafik</h6>
<p><span style="color:#219ebc">■</span> Kasus Diare</p>
</div>
</div>

</div>

</section>
<section id="peta" class="container mt-5">

<h4 class="text-teal mb-3 fw-bold">Peta Persebaran Penyakit</h4>

<div id="mapDiare" style="height:400px; border-radius:15px;"></div>

<div class="mt-3 d-flex gap-2">
<span class="badge bg-success">Rendah</span>
<span class="badge bg-warning text-dark">Sedang</span>
<span class="badge bg-danger">Tinggi</span>
</div>

</section>
<section class="container mt-5">

<div class="ringkasan-box">

<h4 class="fw-bold mb-3">Ringkasan Data</h4>

<p id="ringkasan1">Memuat data...</p>
<p id="ringkasan2">Memuat data...</p>
<p id="ringkasan3">Memuat data...</p>
<p id="ringkasan4">Memuat data...</p>

</div>

</section>
<section class="container mt-5">

<h4 class="fw-bold mb-4">
Berita Kesehatan Diare
</h4>

<div class="row">

<?php foreach(($berita ?? []) as $b): ?>

<div class="col-md-4 mb-4">

<div class="card shadow-sm border-0 rounded-4 h-100">

<img src="<?= base_url('uploads/berita/' . $b['gambar_berita']) ?>"
style="height:220px; object-fit:cover;"
class="card-img-top">

<div class="card-body">

<h5><?= esc($b['judul_berita']) ?></h5>

<p>
<?= word_limiter(strip_tags($b['deskripsi_berita']), 20) ?>
</p>

<small class="text-muted">
<?= date('d M Y', strtotime($b['tanggal_berita'])) ?>
</small>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
function fixNama(nama){
    return (nama || "")
        .toLowerCase()
        .trim()
        .replace(/\s+/g, " ")
        .replace(/[^a-z0-9 ]/g, "");
}

var aliasDesa = {
    "kemuningsarilor": "kemuning sari lor"
};

var dataDiare = <?= json_encode($diare ?? []) ?>;

var desaTertinggi = '-';
var kasusTertinggi = 0;
var totalSemuaKasus = 0;
var jumlahDesa = 0;
var desaDiAtasRata = 0;
var rataKasus = 0;

document.addEventListener("DOMContentLoaded", function(){

    const filterDesa = document.getElementById('filterDesa');
    const filterDiagnosis = document.getElementById('filterDiagnosis');
    const filterTahun = document.getElementById('filterTahun');

    let chartDiare;
    let map = L.map('mapDiare').setView([-8.1,113.5], 12);
    let geoLayer;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
        .addTo(map);

    function populateFilters(){
    let desaSet = new Set();
    let diagnosisSet = new Set();
    let tahunSet = new Set();

    dataDiare.forEach(item => {
        if(item.desa){
            desaSet.add(item.desa.trim());
        }

        if(item.diagnosis){
            let diag = item.diagnosis.trim().toUpperCase();
            diagnosisSet.add(diag);
        }

        if(
            item.tanggal_kunjungan &&
            item.tanggal_kunjungan !== '0000-00-00'
        ){
            tahunSet.add(item.tanggal_kunjungan.substring(0,4));
        }
    });

    desaSet.forEach(d=>{
        filterDesa.innerHTML += `<option value="${d}">${d}</option>`;
    });

    diagnosisSet.forEach(d=>{
        filterDiagnosis.innerHTML += `<option value="${d}">${d}</option>`;
    });

    tahunSet.forEach(t=>{
        filterTahun.innerHTML += `<option value="${t}">${t}</option>`;
    });
}

    function renderChart(filteredData){
    let bulanan = {};

    filteredData.forEach(item => {

        if(
            !item.tanggal_kunjungan ||
            item.tanggal_kunjungan === '0000-00-00'
        ){
            return;
        }

        let bulan = new Date(item.tanggal_kunjungan + "T00:00:00")
            .toLocaleString('id-ID', { month:'short' });

        if(!bulanan[bulan]){
            bulanan[bulan] = 0;
        }

        bulanan[bulan]++;
    });

    if(chartDiare){
        chartDiare.destroy();
    }

    chartDiare = new Chart(document.getElementById('chartDiare'), {
        type:'bar',
        data:{
            labels:Object.keys(bulanan),
            datasets:[{
                label:'Kasus Diare',
                data:Object.values(bulanan),
                backgroundColor:'#219ebc'
            }]
        }
    });
}

    function buildMap(filteredData){

        let finalData = {};

        filteredData.forEach(item => {
            let desa = fixNama(item.desa);

if(aliasDesa[desa]){
    desa = aliasDesa[desa];
}

            if(!finalData[desa]){
                finalData[desa] = 0;
            }

            finalData[desa]++;
        });

        if(geoLayer){
            map.removeLayer(geoLayer);
        }

        fetch("<?= base_url('assets/peta/panti_6_desa.geojson') ?>")
        .then(res => res.json())
        .then(data => {
let totals = Object.values(finalData)
    .sort((a,b) => a - b);

let batasSedang = 0;
let batasTinggi = 0;

if(totals.length > 0){
    batasSedang = totals[Math.floor(totals.length / 3)];
    batasTinggi = totals[Math.floor((totals.length * 2) / 3)];
}
            geoLayer = L.geoJSON(data,{
                style:function(feature){

    let nama = fixNama(feature.properties.NAMOBJ);

    if(aliasDesa[nama]){
        nama = aliasDesa[nama];
    }

    let total = finalData[nama] || 0;

    let warna = "#28a745"; // hijau

    if(total > batasTinggi){
    warna = "#dc3545"; // merah
}
else if(total >= batasSedang){
    warna = "#ffc107"; // kuning
}

    return {
        color:"#00CED1",
        weight:2,
        fillColor:warna,
        fillOpacity:0.7
    };
}
            }).addTo(map);

            map.fitBounds(geoLayer.getBounds());
        });
    }

    function applyFilters(){

        let desa = filterDesa.value;
        let diagnosis = filterDiagnosis.value;
        let tahun = filterTahun.value;

        let filtered = dataDiare.filter(item => {

            let cocokDesa = !desa || item.desa === desa;
            let cocokDiagnosis = !diagnosis || item.diagnosis === diagnosis;
            let cocokTahun = !tahun || item.tanggal_kunjungan.startsWith(tahun);

            return cocokDesa && cocokDiagnosis && cocokTahun;
        });

        renderChart(filtered);
        buildMap(filtered);
    }

    let dataFinal = {};

    dataDiare.forEach(item => {
        let desa = item.desa || '-';

        if(!dataFinal[desa]){
            dataFinal[desa] = 0;
        }

        dataFinal[desa]++;
    });

    jumlahDesa = Object.keys(dataFinal).length;

    Object.entries(dataFinal).forEach(([desa,total]) => {
        totalSemuaKasus += total;

        if(total > kasusTertinggi){
            kasusTertinggi = total;
            desaTertinggi = desa;
        }
    });

    rataKasus = jumlahDesa > 0
        ? Math.round(totalSemuaKasus / jumlahDesa)
        : 0;

    Object.values(dataFinal).forEach(total => {
        if(total > rataKasus){
            desaDiAtasRata++;
        }
    });

    document.getElementById('ringkasan1').innerHTML =
        `Kasus tertinggi di <b>${desaTertinggi}</b> sebanyak ${kasusTertinggi}`;

    document.getElementById('ringkasan2').innerHTML =
        `Ada <b>${desaDiAtasRata}</b> desa di atas rata-rata`;

    document.getElementById('ringkasan3').innerHTML =
        `Rata-rata kasus ${rataKasus}`;

    document.getElementById('ringkasan4').innerHTML =
        `Total kasus ${totalSemuaKasus}`;

    filterDesa.addEventListener('change', applyFilters);
    filterDiagnosis.addEventListener('change', applyFilters);
    filterTahun.addEventListener('change', applyFilters);

    populateFilters();
    renderChart(dataDiare);
    buildMap(dataDiare);
});
</script>
<?= $this->endSection() ?>