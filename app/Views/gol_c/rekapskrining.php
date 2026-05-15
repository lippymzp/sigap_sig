<?php $pagerLinks = $pagerLinks ?? ''; ?>
<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>
<?= $this->section('content') ?>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f5f7fb;
    font-family:'Poppins',sans-serif;
}

/* CARD */
.custom-card{
    background:white;
    border-radius:20px;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
}

/* OVERVIEW */
.overview-card{
    background: linear-gradient(135deg,#00BBC2,#009aa0);
    border-radius:18px;
    padding:25px;
    margin-bottom:20px;
    color:white;
}

.overview-title{
    font-size:14px;
    opacity:0.9;
}

.overview-total{
    font-size:38px;
    font-weight:700;
    line-height:1.2;
    margin-top:8px;
}

.overview-info{
    display:flex;
    gap:20px;
    margin-top:15px;
    flex-wrap:wrap;
    font-size:15px;
}

/* TOPBAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    gap:15px;
    flex-wrap:wrap;
}

.search-box{
    position:relative;
    width:350px;
}

.search-box input{
    padding-left:45px;
    border-radius:10px;
    height:45px;
    border:1px solid #dbe2ea;
}

.search-box i{
    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
    color:#00BBC2;
}

/* DROPDOWN */
.filter-group{
    display:flex;
    gap:10px;
}

.filter-group select{
    border-radius:10px;
    height:45px;
    min-width:160px;
    border:1px solid #dbe2ea;
}

/* TABLE */
.table{
    border-radius:18px;
    overflow:hidden;
    border:1px solid #e5e7eb;
    border-collapse:collapse;
    background:white;
}

.table thead th{
    background:white;
    color:#374151;
    border-bottom:2px solid #e5e7eb;
    padding:18px;
    text-align:center;
    font-weight:700;
    font-size:14px;
    white-space:nowrap;
}

.table tbody td{
    padding:16px;
    vertical-align:middle;
    font-size:14px;
    color:#374151;
}

.table th,
.table td{
    border:1px solid #eef1f5;
}

.table tbody tr:hover{
    background:#f9fbfc;
    transition:0.2s;
}

/* BADGE */
.badge-custom{
    padding:10px 15px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
    display:inline-block;
}

/* BERISIKO */
.badge-buruk{
    background:#ffe3e3;
    color:#d90429;
}

/* TIDAK BERISIKO */
.badge-baik{
    background:#dcfce7;
    color:#15803d;
    border:1px solid #bbf7d0;
}

/* PAGINATION */
.pagination-custom{
    margin-top:25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:15px;
}

#infoData{
    font-size:14px;
    color:#6b7280;
    font-weight:500;
}

/* STYLE PAGINATION CI4 */
/* PAGINATION */
.pagination{
    margin:0;
    gap:6px;
    flex-wrap:wrap;
    align-items:center;
}

.page-item{
    list-style:none;
}

.page-item .page-link{
    border:none !important;
    background:transparent !important;
    color:#6b7280;
    font-weight:600;
    min-width:auto;
    height:auto;
    padding:8px 14px;
    border-radius:10px;
    box-shadow:none !important;
    transition:0.2s ease;
}

.page-item .page-link:hover{
    background:#e6f9fa !important;
    color:#00BBC2;
}

.page-item.active .page-link{
    background:#00BBC2 !important;
    color:white !important;
}

.page-item.disabled .page-link{
    background:transparent !important;
    color:#c0c4cc !important;
}

/* RESPONSIVE */
@media(max-width:768px){

    .topbar{
        flex-direction:column;
        align-items:stretch;
    }

    .search-box{
        width:100%;
    }

    .filter-group{
        width:100%;
        flex-direction:column;
    }

    .pagination-custom{
        flex-direction:column;
        align-items:center;
    }

    .overview-total{
        font-size:28px;
    }

}

</style>

<div class="custom-card">

    <!-- OVERVIEW -->
    <div class="overview-card">

        <div class="overview-title">
            TODAY'S OVERVIEW
        </div>

        <div class="overview-total">
            <?= $skriningHariIni ?> Skrining Hari Ini
            dari <?= $totalSkrining ?> Total Skrining
        </div>

        <div class="overview-info">

            <div>
                ● <?= $berisiko ?> Berisiko
            </div>

            <div style="color:#d1fae5;">
                ● <?= $tdkberisiko ?> Tidak Berisiko
            </div>

        </div>

    </div>

    <!-- TOPBAR -->
    <div class="topbar">

        <!-- SEARCH -->
        <div class="search-box">
            <i class="bi bi-search"></i>

            <input type="text"
                   id="searchInput"
                   class="form-control"
                   placeholder="Cari data pasien">
        </div>

        <!-- FILTER -->
        <div class="filter-group">

            <select id="sortData" class="form-select">
                <option value="">Urutkan</option>
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>

            <div class="dropdown">

                <button class="form-select text-start"
                        type="button"
                        data-bs-toggle="dropdown"
                        style="height:45px; min-width:220px;">

                    <i class="bi bi-funnel"></i> Filter
                </button>

                <ul class="dropdown-menu p-3"
                    style="width:300px; border-radius:15px;">

                    <li>
                        <label class="dropdown-item">
                            <input type="checkbox"
                                   class="filter-check"
                                   value="semua">
                            Tampilkan semua
                        </label>
                    </li>

                    <li>
                        <label class="dropdown-item">
                            <input type="checkbox"
                                   class="filter-check"
                                   value="hariini">
                            Hari ini
                        </label>
                    </li>

                    <li>
                        <label class="dropdown-item">
                            <input type="checkbox"
                                   class="filter-check"
                                   value="Berisiko">
                            Berisiko
                        </label>
                    </li>

                    <li>
                        <label class="dropdown-item">
                            <input type="checkbox"
                                   class="filter-check"
                                   value="Tidak Berisiko">
                            Tidak Berisiko
                        </label>
                    </li>

                    <li>
                        <label class="dropdown-item">
                            <input type="checkbox"
                                   class="filter-check"
                                   value="perempuan">
                            Perempuan
                        </label>
                    </li>

                    <li>
                        <label class="dropdown-item">
                            <input type="checkbox"
                                   class="filter-check"
                                   value="lakilaki">
                            Laki-laki
                        </label>
                    </li>

                    <li>
                        <label class="dropdown-item">
                            <input type="checkbox"
                                   class="filter-check"
                                   value="anak">
                            Anak-anak (0-19 tahun)
                        </label>
                    </li>

                    <li>
                        <label class="dropdown-item">
                            <input type="checkbox"
                                   class="filter-check"
                                   value="dewasa">
                            Dewasa (>19 tahun)
                        </label>
                    </li>

                </ul>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-responsive">

        <table class="table align-middle">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>

            <?php $no=1; foreach(($skrining ?? []) as $row): ?>

            <tr class="data-row"

                data-risiko="<?= $row['hasil'] ?>"
                data-gender="<?= strtolower($row['jenis_kelamin']) ?>"
                data-tanggal="<?= date('Y-m-d', strtotime($row['tanggal'])) ?>"
                data-usia="<?= $row['usia'] ?>">

                <td><?= $no++ ?></td>

                <td><?= $row['nama_pasien_skrining'] ?></td>

                <td><?= $row['usia'] ?></td>

                <td><?= $row['jenis_kelamin'] ?></td>

                <td><?= $row['no_hp'] ?></td>

                <td>
                    <?= $row['kelurahan'].', '.$row['kecamatan'].', '.$row['kabupaten'] ?>
                </td>

                <td><?= $row['tanggal'] ?></td>

                <td>

                    <?php if(strpos($row['hasil'],'Berisiko') !== false && strpos($row['hasil'],'Tidak') === false): ?>

                        <span class="badge-custom badge-buruk">
                            <?= $row['hasil'] ?>
                        </span>

                    <?php else: ?>

                        <span class="badge-custom badge-baik">
                            <?= $row['hasil'] ?>
                        </span>

                    <?php endif; ?>

                </td>

            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="pagination-custom">

        <div id="infoData">
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

        // RISIKO
        let risikoList = ['Berisiko','Tidak Berisiko'];
        let filterRisiko = activeFilters.filter(f => risikoList.includes(f));

        if(filterRisiko.length > 0){

            let cocokRisiko = false;

            if(
                filterRisiko.includes('Berisiko') &&
                risiko.includes('Berisiko') &&
                !risiko.includes('Tidak')
            ){
                cocokRisiko = true;
            }

            if(
                filterRisiko.includes('Tidak Berisiko') &&
                risiko.includes('Tidak Berisiko')
            ){
                cocokRisiko = true;
            }

            if(!cocokRisiko){
                show = false;
            }
        }

        // GENDER
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

        // UMUR
        let umurFilter = activeFilters.filter(f =>
            ['anak','dewasa'].includes(f)
        );

        if(umurFilter.length > 0){

            let matchUmur =
                (umurFilter.includes('anak') && usia <= 19) ||
                (umurFilter.includes('dewasa') && usia > 19);

            if(!matchUmur){
                show = false;
            }
        }

        // HARI INI
        if(activeFilters.includes('hariini') && tanggal !== today){
            show = false;
        }

        // TAMPILKAN SEMUA
        if(activeFilters.includes('semua')){
            show = true;
        }

        if(activeFilters.length === 0){
            show = true;
        }

        row.style.display = show ? "" : "none";

    });

    updateInfoData();
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

    updateInfoData();

});

// SORT
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

    updateInfoData();

});

function updateInfoData() {

    let visibleRows = 0;

    document.querySelectorAll(".data-row").forEach(row => {

        if(row.style.display !== "none"){
            visibleRows++;
        }

    });

    const infoData = document.getElementById("infoData");

    if(visibleRows > 0){

        infoData.innerHTML =
            `Menampilkan ${visibleRows} data`;

    } else {

        infoData.innerHTML =
            `Data tidak ditemukan`;

    }
}

updateInfoData();

</script>

<?= $this->endSection() ?>