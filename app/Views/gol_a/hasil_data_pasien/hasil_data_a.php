<?php
$layout = $layout ?? 'layout/dashboard_layout_admin';
?>
<?= $this->extend($layout) ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php $tahun = $tahun ?? date('Y'); ?>

<style>
* { font-family: 'Poppins', sans-serif; }

.custom-card{
    border-radius:20px;
    background:#F4F8FA;
    padding:20px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

.search-icon{
    background:#20B8BE;
    color:white;
    width:45px;
    height:45px;
    border-radius:10px 0 0 10px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.search-input{
    border-radius:0 10px 10px 0;
    border:none;
    background:#EEF5F7;
    padding:12px;
    width:250px;
    height:45px;
}

.filter-btn{
    border:2px solid #20B8BE;
    background:white;
    width:45px;
    height:45px;
    border-radius:10px;
    color:#20B8BE;
    transition:0.2s;
}

.filter-btn:hover{
    background:#169fa5;
    color:white;
    transform:scale(1.05);
}

.periode{
    font-size:16px;
    display:flex;
    align-items:center;
    gap:8px;
}

.periode a{
    text-decoration:none;
    font-size:40px;
    color:#20B8BE;
    font-weight:bold;
}

.periode a:hover{
    color:#169fa5;
    transform:scale(1.2);
}

.custom-table thead th{
    background:#DDF8F9;
    color:#2b2b2b;
    font-weight:600;
    border:1px solid #BCEAEB;
}

.custom-table tbody tr{
    background:#EAF4F6;
}

.custom-table tbody tr:nth-child(even){
    background:#F4FAFB;
}

.btn-export{
    background:#20B8BE;
    color:white;
    padding:10px 20px;
    border-radius:10px;
    font-weight:500;
    text-decoration:none !important;
    display:inline-flex;
    align-items:center;
    gap:8px;
}

.btn-export:hover{
    background:#169fa5;
    color:white;
}

.modal-filter{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.3);
    justify-content:center;
    align-items:center;
    z-index:999;
}

.modal-content{
    background:white;
    padding:25px;
    border-radius:15px;
    width:400px;
}

.filter-input{
    width:100%;
    margin-bottom:10px;
    padding:10px;
    border-radius:10px;
    border:none;
    background:#EEF5F7;
}

.btn-terapkan{
    background:#20B8BE;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:10px;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div></div>

    <div class="periode">
        <span>Periode :</span>

        <a href="#"
        onclick="gantiTahun(<?= $tahun > 2020 ? $tahun - 1 : 2020 ?>)">‹</a>

        <span id="tahun-text"><?= $tahun ?></span>

        <a href="#"
        onclick="gantiTahun(<?= $tahun < date('Y') ? $tahun + 1 : date('Y') ?>)">›</a>
    </div>
</div>

<div class="custom-card">

    <div class="d-flex align-items-center gap-2 mb-3">
        <div class="search-icon">
            <i class="fa fa-search"></i>
        </div>

        <input type="text"
        id="searchInput"
        class="search-input"
        placeholder="Ketik untuk mencari...">

        <button class="filter-btn" onclick="openFilter()">
            <i class="fa fa-filter"></i>
        </button>
    </div>

    <div class="table-responsive">
    <table class="table text-center align-middle custom-table table-bordered">

        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Bulan</th>
                <th rowspan="2">Kelurahan</th>

                <th colspan="4">Rentang Usia</th>

                <th colspan="2">Jenis Kelamin</th>

                <th rowspan="2">Jumlah Kasus</th>
                <th rowspan="2">Jumlah Kematian</th>
                <th rowspan="2">Aksi</th>
            </tr>

            <tr>
                <th>Bayi & Anak Pra-sekolah</th>
                <th>Sekolah & Remaja</th>
                <th>Dewasa</th>
                <th>Lansia</th>

                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>

        <tbody id="table-body">

        <?php if(!empty($data)): ?>
            <?php $no = 1; foreach($data as $d): ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['bulan'] ?></td>
                <td><?= $d['kelurahan'] ?></td>

                <td><?= $d['bayi_anak_prasekolah'] ?? 0 ?></td>
                <td><?= $d['sekolah_dan_remaja'] ?? 0 ?></td>
                <td><?= $d['dewasa'] ?? 0 ?></td>
                <td><?= $d['lansia'] ?? 0 ?></td>

                <td><?= $d['laki'] ?? 0 ?></td>
                <td><?= $d['perempuan'] ?? 0 ?></td>

                <td><b><?= $d['jumlah'] ?></b></td>

                <td><?= $d['jumlah_kematian'] ?? 0 ?></td>

                <td>
                    <a href="<?= base_url('dbd/detail-pasien') ?>?bulan=<?= $d['bulan_angka'] ?>&kelurahan=<?= $d['kelurahan'] ?>&tahun=<?= $tahun ?>"
                    class="btn btn-sm text-white"
                    style="background:#20B8BE; border-radius:8px;">
                        <i class="fa fa-eye"></i> Detail
                    </a>
                </td>
            </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="12">Belum ada data</td>
            </tr>

        <?php endif; ?>

        </tbody>

    </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <a href="<?= base_url('dbd/export-hasil-data-pasien') ?>" class="btn-export">
            <i class="fa fa-download"></i> Export Data
        </a>
    </div>

</div>

<div id="filterModal" class="modal-filter">
    <div class="modal-content">

        <div class="d-flex justify-content-between mb-3">
            <h5>Filter Hasil Data Pasien</h5>
            <span onclick="closeFilter()" style="cursor:pointer;">✖</span>
        </div>

        <label>Bulan</label>
        <select id="filterBulan" class="filter-input">
            <option value="">Semua</option>
            <option>Januari</option>
            <option>Februari</option>
            <option>Maret</option>
            <option>April</option>
            <option>Mei</option>
            <option>Juni</option>
            <option>Juli</option>
            <option>Agustus</option>
            <option>September</option>
            <option>Oktober</option>
            <option>November</option>
            <option>Desember</option>
        </select>

        <label>Kelurahan</label>
        <select id="filterKelurahan" class="filter-input">
            <option value="">Semua</option>
            <option>Sumbersari</option>
            <option>Antirogo</option>
            <option>Tegalgede</option>
            <option>Wirolegi</option>
            <option>Karangrejo</option>
        </select>

        <label>Urutkan</label>
        <select id="filterUrut" class="filter-input">
            <option value="">Default</option>
            <option value="asc">Terendah (Kasus Sedikit)</option>
            <option value="desc">Tertinggi (Kasus Banyak)</option>
        </select>

        <div class="d-flex justify-content-between mt-4">
            <button onclick="resetFilter()" class="btn btn-secondary">Reset</button>
            <button onclick="closeFilter()" class="btn btn-secondary">Batal</button>
            <button onclick="applyFilter()" class="btn-terapkan">Terapkan</button>
        </div>

    </div>
</div>

<script>
let currentTahun = <?= $tahun ?>;

function gantiTahun(tahun){
    currentTahun = tahun;
    document.getElementById('tahun-text').innerText = tahun;
    loadData();
}

// ===================================
// KONTROL AKTIVITAS MODAL FILTER
// ===================================
function openFilter(){
    document.getElementById('filterModal').style.display = 'flex';
}

function closeFilter(){
    document.getElementById('filterModal').style.display = 'none';
}

function resetFilter(){
    document.getElementById('filterBulan').value = "";
    document.getElementById('filterKelurahan').value = "";
    document.getElementById('filterUrut').value = "";
    loadData();
}

function applyFilter(){
    closeFilter();
    loadData();
}

// ===================================
// LOGIKA AMBIL & PILAH (FILTER/SORT) DATA 
// ===================================
function loadData(){

    let keyword = document.getElementById('searchInput').value.toLowerCase();
    let bulan = document.getElementById('filterBulan').value;
    let kelurahan = document.getElementById('filterKelurahan').value;
    let urut = document.getElementById('filterUrut').value;

    fetch(`<?= base_url('dbd/get-data-pasien-by-tahun') ?>?tahun=${currentTahun}`)
    .then(res => res.json())
    .then(data => {

        // 1. FILTERING DATA (Bulan, Kelurahan, & Kotak Pencarian)
        data = data.filter(d => {
            return (
                (bulan === "" || d.bulan === bulan) &&
                (kelurahan === "" || d.kelurahan === kelurahan) &&
                (
                    d.bulan.toLowerCase().includes(keyword) ||
                    d.kelurahan.toLowerCase().includes(keyword)
                )
            );
        });

        // 2. SORTING DATA (Berdasarkan jumlah kasus)
        if(urut === "asc"){
            data.sort((a,b)=> a.jumlah - b.jumlah);
        } else if(urut === "desc"){
            data.sort((a,b)=> b.jumlah - a.jumlah);
        }

        // 3. RENDER DATA KE DALAM BODY TABEL
        let tbody = document.getElementById('table-body');
        tbody.innerHTML = "";

        if(data.length === 0){
            tbody.innerHTML = `<tr><td colspan="12">Belum ada data</td></tr>`;
            return;
        }

        let no = 1;

        data.forEach(d => {
            tbody.innerHTML += `
            <tr>
                <td>${no++}</td>
                <td>${d.bulan}</td>
                <td>${d.kelurahan}</td>

                <td>${d.bayi_anak_prasekolah ?? 0}</td>
                <td>${d.sekolah_dan_remaja ?? 0}</td>
                <td>${d.dewasa ?? 0}</td>
                <td>${d.lansia ?? 0}</td>

                <td>${d.laki ?? 0}</td>
                <td>${d.perempuan ?? 0}</td>

                <td><b>${d.jumlah}</b></td>

                <td>${d.meninggal ?? 0}</td>

                <td>
                    <a href="<?= base_url('dbd/detail-pasien') ?>?bulan=${d.bulan_angka}&kelurahan=${d.kelurahan}&tahun=${currentTahun}"
                    class="btn btn-sm text-white"
                    style="background:#20B8BE; border-radius:8px;">
                        <i class="fa fa-eye"></i> Detail
                    </a>
                </td>
            </tr>
            `;
        });

    });
}

document.getElementById('searchInput').addEventListener('keyup', loadData);

window.onload = loadData;
</script>

<?= $this->endSection() ?>