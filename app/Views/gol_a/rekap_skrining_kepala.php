'pagerLinks' => $pager->makeLinks($page, $perPage, $total, 'default_full'),
<?= $this->extend('layout/dashboard_layout_kepala') ?>
<?= $this->section('content') ?>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<?php 
$pagerLinks = $pagerLinks ?? '';
?>
<style>
body {
    background: #f5f7fb;
    font-family: 'Poppins', sans-serif;
}

/* CARD */
.custom-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* TOPBAR */
.topbar-form {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    gap: 15px;
    flex-wrap: wrap;
}

.search-box {
    position: relative;
    width: 320px;
}

.search-box input {
    padding-left: 40px;
    border-radius: 10px;
    height: 40px;
    font-size: 14px;
}

.search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #00BBC2;
}

/* FILTER */
.filter-group {
    display: flex;
    gap: 10px;
}

.filter-group select,
.filter-group .btn-filter {
    border-radius: 10px;
    height: 40px;
    font-size: 14px;
    min-width: 140px;
}

/* TABLE */
.table-responsive {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.table {
    margin-bottom: 0;
    font-size: 13.5px;
    border-collapse: collapse;
}

.table thead {
    background: linear-gradient(135deg, #00BBC2, #009aa0);
}

.table thead th {
    background: linear-gradient(135deg, #00BBC2, #009aa0) !important;
    color: white !important;
    border: none;
    padding: 12px 10px;
    text-align: center;
    font-weight: 600;
    font-size: 13.5px;
}

.table th,
.table td {
    border: 1px solid #e5e7eb !important;
    padding: 10px 12px;
}

.table tbody tr:hover {
    background-color: #f9fafb;
}

/* BADGE */
.badge-custom {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.badge-buruk {
    background: #fee2e2;
    color: #dc2626;
}

.badge-cukup {
    background: #fef3c7;
    color: #d97706;
}

.badge-baik {
    background: #d1fae5;
    color: #059669;
}

/* BUTTON */
.aksi-btn {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 6px;
    color: white;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.btn-detail {
    background: #0284c7;
}

/* PAGINATION */
.pagination-custom {
    font-size: 14px;
}

.pagination-custom .pages {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

.pagination-custom .pages a,
.pagination-custom .pages span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    background: #fff;
    color: #374151;
    font-weight: 500;
    text-decoration: none;
}

.pagination-custom .pages .active {
    background: linear-gradient(135deg, #00BBC2, #009aa0);
    color: white !important;
    border: none;
}
.badge-custom{
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    white-space: nowrap;
}
</style>
</style>

   <div class="custom-card">

<div class="topbar-form">

    <!-- SEARCH -->
    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" id="searchInput"
            class="form-control"
            placeholder="Cari data pasien">
    </div>
<script>


</script>

    <!-- FILTER -->
    <div class="filter-group">

        <select id="sortData" class="form-select">
            <option value="">Urutkan</option>
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>

        <div class="dropdown">
   
<button class="btn btn-outline-secondary text-start btn-filter dropdown-toggle d-flex align-items-center justify-content-between"
        type="button"
        data-bs-toggle="dropdown"
        style="height:45px; min-width:220px;">
        
    <i class="bi bi-funnel"></i> Filter
</button>

<ul class="dropdown-menu p-3"
    style="width:300px; border-radius:15px;">

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="semua">
 Tampilkan semua
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="hariini">
 Hari ini
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="baik">
 Lingkungan Baik
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="cukup">
 Lingkungan Cukup
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="buruk">
 Lingkungan Buruk
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="perempuan">
 Perempuan
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="lakilaki">
 Laki-laki
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="bayi_anak">
 Bayi dan Anak Pra-sekolah (0–6 Tahun)
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="remaja">
 Anak Sekolah dan Remaja (>6–18 Tahun)
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="dewasa">
 Dewasa (>18–59 Tahun)
</label>
</li>

<li>
<label class="dropdown-item">
<input type="checkbox" class="filter-check" value="lansia">
 Lansia (≥60 Tahun)
</label>
</li>

</ul>
</div>

    </div>
</div>

<!-- TABLE -->
<div class="table-responsive">
<table class="table align-middle table-hover">

<thead>
<tr>
<th style="width:50px;">No.</th>
<th>Nama</th>
<th style="width:80px;">Umur</th>
<th style="width:120px;">Jenis Kelamin</th>
<th>Alamat</th>
<th style="width:120px;">Tanggal</th>
<th style="width:260px;">Hasil</th>
<th style="width:80px;">Detail</th>
</tr>
</thead>

<tbody>

<?php $no = 1 + (($page ?? 1) - 1) * 10; ?>

<?php foreach(($skrining ?? []) as $row): ?>

<tr class="data-row"


data-risiko="<?=
strpos($row['hasil'], 'Buruk') !== false ? 'buruk' :
(strpos($row['hasil'], 'Cukup') !== false ? 'cukup' : 'baik')
?>"

data-gender="<?= strtolower($row['jenis_kelamin']) ?>"

data-tanggal="<?= date('Y-m-d', strtotime($row['tanggal'])) ?>"

data-usia="<?= $row['usia'] ?>"
>

<td><?= $no++ ?></td>

<td><?= $row['nama_pasien_skrining'] ?></td>

<td><?= $row['usia'] ?></td>

<td><?= $row['jenis_kelamin'] ?></td>

<td>
<?= 
$row['kelurahan'].', '.$row['kecamatan'].', '.$row['kabupaten']
?>
</td>

<td><?= $row['tanggal'] ?></td>

<td>
<?php if(strpos($row['hasil'],'Buruk') !== false): ?>

    <span class="badge-custom badge-buruk">
        <?= $row['hasil'] ?>
    </span>

<?php elseif(strpos($row['hasil'],'Cukup') !== false): ?>

    <span class="badge-custom badge-cukup">
        <?= $row['hasil'] ?>
    </span>

<?php else: ?>

    <span class="badge-custom badge-baik">
        <?= $row['hasil'] ?>
    </span>

<?php endif; ?>
</td>

<td class="text-center align-middle">

<button class="aksi-btn btn-detail"
        data-bs-toggle="modal"
        data-bs-target="#detailModal<?= $row['id_skrining'] ?>">
    <i class="bi bi-eye"></i>
</button>

</tr>
<!-- MODAL DETAIL -->
<div class="modal fade"
     id="detailModal<?= $row['id_skrining'] ?>"
     tabindex="-1">

<div class="modal-dialog modal-lg modal-dialog-centered">

<div class="modal-content"
     style="border-radius:20px; overflow:hidden;">

<!-- HEADER -->
<div class="modal-header"
     style="background:#00BBC2; color:white;">

    <h5 class="modal-title">
        Detail Hasil Skrining
    </h5>

    <button type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal"></button>
</div>

<!-- BODY -->
<div class="modal-body p-4">

<div class="row g-3">
    <div class="col-md-6">
        <label class="fw-bold">NIK</label>
        <div class="form-control">
            <?= $row['nik'] ?? '-' ?>
        </div>
    </div>

    <div class="col-md-6">
        <label class="fw-bold">Nama Pasien</label>
        <div class="form-control">
            <?= $row['nama_pasien_skrining'] ?>
        </div>
    </div>

    <div class="col-md-6">
        <label class="fw-bold">Jenis Kelamin</label>
        <div class="form-control">
            <?= $row['jenis_kelamin'] ?>
        </div>
    </div>

    <div class="col-md-6">
        <label class="fw-bold">Usia</label>
        <div class="form-control">
            <?= $row['usia'] ?>
        </div>
    </div>

    <div class="col-md-6">
        <label class="fw-bold">Tanggal Lahir</label>
        <div class="form-control">
            <?= $row['tanggal_lahir'] ?? '-' ?>
        </div>
    </div>

    <div class="col-md-6">
    <label class="fw-bold">No HP</label>
    <div class="form-control">
        <?= $row['no_hp'] ?? '-' ?>
    </div>
    </div>

    <div class="col-md-6">
        <label class="fw-bold">Tanggal Skrining</label>
        <div class="form-control">
            <?= date('d-m-Y', strtotime($row['tanggal'])) ?>
        </div>
    </div>

    <div class="col-12">
        <label class="fw-bold">Alamat</label>
        <div class="form-control">
            <?= $row['kelurahan'] ?>,
            <?= $row['kecamatan'] ?>,
            <?= $row['kabupaten'] ?>
        </div>
    </div>

    <div class="col-12">
        <label class="fw-bold">Hasil Skrining</label>

        <?php if(strpos($row['hasil'],'Buruk') !== false): ?>

            <div class="alert alert-danger mb-0">
                <?= $row['hasil'] ?>
            </div>

        <?php elseif(strpos($row['hasil'],'Cukup') !== false): ?>

            <div class="alert alert-warning mb-0">
                <?= $row['hasil'] ?>
            </div>

        <?php else: ?>

            <div class="alert alert-success mb-0">
                <?= $row['hasil'] ?>
            </div>

        <?php endif; ?>
    </div>

</div>
</div>

<!-- FOOTER -->
<div class="modal-footer">

<button type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal">
    Tutup
</button>

</div>
</div>
</div>
</div>


</div>
</div>
</div>
</div>

<?php endforeach; ?>

</tbody>
</table>
</div>

<!-- PAGINATION -->
<div class="pagination-custom">

<div>
Menampilkan <?= count($skrining ?? []) ?> data
</div>

<div class="pages">
    <?= $pagerLinks ?>
</div>

</div>

</div>


<script>

// FILTER
const checks = document.querySelectorAll(".filter-check");
const rows = document.querySelectorAll(".data-row");

checks.forEach(check => {
    check.addEventListener("change", applyFilter);
});

function applyFilter(){

    let activeFilters = [];

    checks.forEach(c => {
        if(c.checked){
            activeFilters.push(c.value);
        }
    });

    rows.forEach(row => {

        const risiko = row.dataset.risiko;
        const gender = row.dataset.gender;
        const tanggal = row.dataset.tanggal;
        const usia = parseInt(row.dataset.usia);

        const today = new Date().toISOString().split('T')[0];

        let show = true;

        // ===== RISIKO (BAIK / CUKUP / BURUK) =====
        let risikoList = ['baik','cukup','buruk'];
        let filterRisiko = activeFilters.filter(f => risikoList.includes(f));

        if(filterRisiko.length > 0){
            if(!filterRisiko.includes(risiko)){
                show = false;
            }
        }

        // ===== GENDER =====
        let genderFilter = activeFilters.filter(f => 
            ['perempuan','lakilaki'].includes(f)
        );

        if(genderFilter.length > 0){
            let matchGender =
                (genderFilter.includes('perempuan') && gender.includes('perempuan')) ||
                (genderFilter.includes('lakilaki') && gender.includes('laki'));

            if(!matchGender){
                show = false;
            }
        }

        // ===== UMUR =====
let umurFilter = activeFilters.filter(f =>
    ['bayi_anak','remaja','dewasa','lansia'].includes(f)
);

if(umurFilter.length > 0){

    let matchUmur =
        (umurFilter.includes('bayi_anak') && usia >= 0 && usia <= 6) ||
        (umurFilter.includes('remaja') && usia > 6 && usia <= 18) ||
        (umurFilter.includes('dewasa') && usia > 18 && usia <= 59) ||
        (umurFilter.includes('lansia') && usia >= 60);

    if(!matchUmur){
        show = false;
    }
}

        // ===== HARI INI =====
        if(activeFilters.includes('hariini') && tanggal !== today){
            show = false;
        }

        // ===== TAMPIL SEMUA =====
        if(activeFilters.includes('semua')){
            show = true;
        }

        // ===== kalau tidak filter apa-apa =====
        if(activeFilters.length === 0){
            show = true;
        }

        row.style.display = show ? "" : "none";
    });
}

// SEARCH
const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", function(){

    let keyword = this.value.toLowerCase();

    document.querySelectorAll(".data-row").forEach(row => {

        let text = row.innerText.toLowerCase();

        if(text.includes(keyword)){
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});


// SORTING
const sortData = document.getElementById("sortData");

sortData.addEventListener("change", function(){

    let value = this.value;

    let tbody = document.querySelector("tbody");

    let rowsArray = Array.from(document.querySelectorAll(".data-row"));

    rowsArray.sort((a,b)=>{

        let namaA = a.children[1].innerText.toLowerCase();
        let namaB = b.children[1].innerText.toLowerCase();

        if(value === "asc"){
            return namaA.localeCompare(namaB);
        }

        if(value === "desc"){
            return namaB.localeCompare(namaA);
        }

    });

    rowsArray.forEach(row=>{
        tbody.appendChild(row);
    });

});

</script>

<?= $this->endSection() ?>