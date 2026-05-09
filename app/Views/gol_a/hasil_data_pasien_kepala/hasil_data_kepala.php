<?= $this->extend('layout/dashboard_layout_kepala') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php $tahun = $tahun ?? date('Y'); ?>

<style>
* { font-family: 'Poppins', sans-serif; }

/* CARD */
.custom-card {
    border-radius: 20px;
    background: #F4F8FA;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

/* SEARCH */
.search-icon {
    background: #20B8BE;
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 10px 0 0 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.search-icon i {
    color: white;
    font-size: 16px;
}

.search-input {
    border-radius: 0 10px 10px 0;
    border: none;
    background: #EEF5F7;
    padding: 12px;
    width: 250px;
    height: 45px;
}

.filter-btn {
    border: 2px solid #20B8BE;
    background: white;
    width: 45px;
    height: 45px;
    border-radius: 10px;
    color: #20B8BE;
    transition: all 0.2s ease;
}

.filter-btn:hover {
    background: #169fa5;
    color: white;
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(32,184,190,0.4);
}

.filter-btn i {
    font-size: 16px;
}

.filter-btn:hover i {
    color: white;
}

/* ================= PERIODE ================= */
.periode {
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.periode a {
    text-decoration: none;
    font-size: 40px;
    color: #20B8BE;
    font-weight: bold;
    transition: 0.1s;
}

.periode a:hover {
    color: #169fa5;
    transform: scale(1.2);
}

/* TABLE */
.custom-table thead th {
    background: #DDF8F9;
    color: #2b2b2b;
    font-weight: 600;
    border: none;
    padding: 15px;
}

.custom-table tbody tr {
    background: #EAF4F6;
}

.custom-table tbody tr:nth-child(even) {
    background: #F4FAFB;
}

.custom-table td {
    padding: 12px;
}

/* EXPORT BUTTON */
.btn-export {
    background: #20B8BE;
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 500;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-export:hover {
    color: white;
    background: #169fa5;
}

/* MODAL FILTER */
.modal-filter {
    display: none;
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.3);
    justify-content:center;
    align-items:center;
    z-index:999;
}

.modal-content {
    background:white;
    padding:25px;
    border-radius:15px;
    width:400px;
}

.filter-input {
    width:100%;
    margin-bottom:10px;
    padding:10px;
    border-radius:10px;
    border:none;
    background:#EEF5F7;
}

.btn-terapkan {
    background: #20B8BE; 
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 500;
    transition: 0.2s;
}

.btn-terapkan:hover {
    background: #169fa5;
}

</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0" style="color: #2b2b2b; font-weight: 600;">Hasil Data Pasien</h4>
    </div> 

    </div>

<div class="custom-card">

    <div class="d-flex align-items-center gap-2 mb-3">
        <div class="search-icon">
            <i class="fa fa-search"></i>
        </div>
        <input type="text" id="searchInput" class="search-input" placeholder="Cari Kecamatan atau Desa...">
        <button class="filter-btn" onclick="openFilter()">
            <i class="fa fa-filter"></i>
        </button>
    </div>

    <table class="table text-center align-middle custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Jumlah Kasus</th>
            </tr>
        </thead>

        <tbody id="table-body">
            </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3">
        <a href="<?= base_url('kepala/export_hasil_data_kepala') ?>" class="btn-export">
            <i class="fa fa-download"></i> Export Data
        </a>
    </div>

</div>

<div id="filterModal" class="modal-filter">
    <div class="modal-content">

        <div class="d-flex justify-content-between mb-3">
            <h5>Filter Data Pasien</h5>
            <span onclick="closeFilter()" style="cursor:pointer; font-size: 18px;">✖</span>
        </div>

        <label>Jenis Kelamin</label>
        <select id="filterJK" class="filter-input">
            <option value="">Semua</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label>Kecamatan</label>
        <select id="filterKecamatan" class="filter-input">
            <option value="">Semua</option>
            </select>

        <div class="d-flex justify-content-between mt-4">
            <button onclick="resetFilter()" class="btn btn-secondary" style="border-radius: 10px;">Reset</button>
            <button onclick="closeFilter()" class="btn btn-secondary" style="border-radius: 10px;">Batal</button>
            <button onclick="applyFilter()" class="btn-terapkan">Terapkan</button>
        </div>

    </div>
</div>

<script>
// Ambil data langsung dari variabel PHP yang dipassing oleh Controller
let rawData = <?= json_encode($pasien ?? []) ?>;

// Setup dropdown kecamatan agar dinamis
function setupFilterKecamatan() {
    let select = document.getElementById('filterKecamatan');
    let kecamatanList = [...new Set(rawData.map(item => item.kecamatan))];
    
    kecamatanList.forEach(kec => {
        if(kec) {
            let option = document.createElement('option');
            option.value = kec;
            option.text = kec;
            select.appendChild(option);
        }
    });
}

// =====================
// MODAL FILTER
// =====================
function openFilter(){
    document.getElementById('filterModal').style.display = 'flex';
}

function closeFilter(){
    document.getElementById('filterModal').style.display = 'none';
}

function resetFilter(){
    document.getElementById('filterJK').value = "";
    document.getElementById('filterKecamatan').value = "";
    document.getElementById('searchInput').value = "";
    loadData();
}

function applyFilter(){
    closeFilter();
    loadData();
}

// =====================
// LOAD & FILTER DATA
// =====================
function loadData(){
    let keyword = document.getElementById('searchInput').value.toLowerCase();
    let jk = document.getElementById('filterJK').value;
    let kecamatan = document.getElementById('filterKecamatan').value;

    // Filter array bawaan PHP
    let filteredData = rawData.filter(d => {
        let matchSearch = (d.kecamatan && d.kecamatan.toLowerCase().includes(keyword)) || 
                          (d.desa && d.desa.toLowerCase().includes(keyword));
        let matchJK = jk === "" || d.jk === jk;
        let matchKecamatan = kecamatan === "" || d.kecamatan === kecamatan;

        return matchSearch && matchJK && matchKecamatan;
    });

    // Render ke tabel
    let tbody = document.getElementById('table-body');
    tbody.innerHTML = "";

    if(filteredData.length === 0){
        tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4">Belum ada data</td></tr>`;
        return;
    }

    let no = 1;
    filteredData.forEach(d => {
        tbody.innerHTML += `
            <tr>
                <td>${no++}</td>
                <td>${d.kecamatan}</td>
                <td>${d.desa}</td>
                <td>${d.jk}</td>
                <td>${d.usia}</td>
                <td>1</td>
            </tr>
        `;
    });
}

// =====================
// EVENT LISTENER
// =====================
document.getElementById('searchInput').addEventListener('keyup', loadData);

// Eksekusi saat halaman pertama dimuat
window.onload = function() {
    setupFilterKecamatan();
    loadData();
};
</script>

<?= $this->endSection() ?>