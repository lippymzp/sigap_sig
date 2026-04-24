<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIGAP - Profil</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    background:#f8f9fa;
    font-family:'Poppins',sans-serif;
}

.wrapper{
    display:flex;
    min-height:100vh;
}

/* ================= SIDEBAR ================= */

.sidebar{
    width:260px;
    background:#f8fafc;
    border-right:1px solid #e9ecef;
    transition:0.3s;
}

.wrapper.hide .sidebar{
    margin-left:-260px;
}

.logo{
    text-align:center;
    padding:20px;
}

.logo img{
    max-width:140px;
}

.menu-label{
    font-size:12px;
    color:#6c757d;
    padding:10px 20px;
    font-weight:600;
}

.sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #2c3e50;
            text-decoration: none;
            font-size: 14.5px;
            font-weight: 400;
            transition: all 0.25s ease;
        }

        .sidebar a:hover {
            background: #e9f5f3;
            color: #00c4b4;
        }

        .sidebar a.active {
            background: #00c4b4;
            color: white;
            border-radius: 8px;
            margin: 0 10px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 196, 180, 0.25);
        }

        .sidebar a i {
            width: 24px;
            margin-right: 12px;
            font-size: 16px;
        }

/* ================= TOPBAR ================= */

.topbar{
    position:fixed;
    top:0;
    left:260px;
    right:0;
    height:70px;
    background:#fff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
    border-bottom:1px solid #e9ecef;
    transition:0.3s;
    z-index:1000;
}

.wrapper.hide .topbar{
    left:0;
}

.topbar-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.menu-toggle{
    font-size:20px;
    cursor:pointer;
}

.topbar-title{
    font-size:22px;
    font-weight:600;
}

.admin-box{
    display:flex;
    align-items:center;
    gap:15px;
}

.avatar-circle{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#00cfd1;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
}

/* ================= MAIN ================= */

.main-content{
    flex:1;
    margin-left:auto;
    margin-top:auto;
    padding:30px;
    transition:0.3s;
}

.wrapper.hide .main-content{
    margin-left:0;
}

.profile-card {
    background:white;
    max-width:560px;
    margin:60px auto;
    margin-top:60px;
    padding:40px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.avatar-box img{
    width:130px;
    height:130px;
    border-radius:50%;
    border:5px solid #e0f2f1;
    margin-bottom:15px;
}
.btn-upload{
    margin-top:15px;
}

</style>
</head>

<body>

<div class="wrapper" id="wrapper">

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">

<div class="logo">
<img src="/assets/img/logo_nama.svg">
</div>

<div class="menu-label">HOME</div>
        <a href="http://localhost:8080/dbd/dashboard" class="active">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>
        <a href="http://localhost:8080/dbd/input_data">
            <i class="fa-regular fa-clipboard"></i> Input Data Pasien
        </a>
        <a href="http://localhost:8080/dbd/hasil">
            <i class="fa-regular fa-folder"></i> Hasil Data Pasien
        </a>
        <a href="http://localhost:8080/dbd/skrining">
            <i class="fa-regular fa-file-lines"></i> Skrining
        </a>
        <a href="http://localhost:8080/dbd/peta">
            <i class="fa-solid fa-map-location-dot"></i> Peta Sebaran
        </a>
        <a href="http://localhost:8080/dbd/export">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Export Data
        </a>

        <div class="menu-label">INFORMASI</div>
        <a href="http://localhost:8080/dbd/berita">
            <i class="fa-regular fa-newspaper"></i> Edit Berita
        </a>
        <a href="http://localhost:8080/dbd/funfact">
            <i class="fa-regular fa-user"></i> Edit Funfact
        </a>

    </div>

<!-- ================= TOPBAR ================= -->
<div class="topbar">

<div class="topbar-left">
<i class="fa-solid fa-bars menu-toggle" id="toggleSidebar"></i>

<div class="topbar-title">
<?= $title ?? 'Data Skrining'; ?>
</div>
</div>

<div class="admin-box">

<div class="text-end">
<b>Profil</b><br>
<small>Admin</small>
</div>

<div class="dropdown">
<div class="avatar-circle" data-bs-toggle="dropdown">
<i class="fa-regular fa-user"></i>
</div>

<ul class="dropdown-menu dropdown-menu-end">
<li><a class="dropdown-item" href="<?= base_url('profil_admin') ?>">
                        <i class="fa-regular fa-user me-2"></i> Profile
                    </a></li>
<li><a class="dropdown-item" href="<?= base_url('logout') ?>">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                    </a></li>
</ul>

</div>
</div>
</div>
<!-- BOOTSTRAP JS (WAJIB) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Data Skrining</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CONTENT -->
    <div class="flex-grow-1 p-4">

    <!-- SEARCH -->
    <input type="text" id="searchInput" class="form-control mb-3"
        placeholder="Cari nama pasien atau NIK">

    <!-- FILTER -->
        <div class="mb-3 d-flex justify-content-center">
        <button class="btn btn-info btn-sm me-2 filter-btn" data-filter="semua">Semua</button>
        <button class="btn btn-outline-danger btn-sm me-2 filter-btn" data-filter="tinggi">Risiko Tinggi</button>
        <button class="btn btn-outline-warning btn-sm me-2 filter-btn" data-filter="sedang">Risiko Sedang</button>
        <button class="btn btn-outline-success btn-sm filter-btn" data-filter="rendah">Risiko Rendah</button>
    </div>

        <!-- OVERVIEW -->
        <div class="card bg-info text-white mb-4">
            <div class="card-body">
                <h5>
                    <?= isset($skrining) ? count($skrining) : 0 ?> Skrining Hari Ini 
                    dari <?= $total ?? 0 ?> Total Skrining
                </h5>
                <small>
                    <?= $tinggi ?? 0 ?> Risiko Tinggi • 
                    <?= $sedang ?? 0 ?> Risiko Sedang • 
                    <?= $rendah ?? 0 ?> Risiko Rendah
                </small>
            </div>
        </div>

        <!-- TABLE -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($skrining)): ?>
                            <?php $no=1; foreach($skrining as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['umur'] ?></td>
                                <td><?= $row['jenis_kelamin'] ?></td>
                                <td><?= $row['kecamatan'] ?></td>
                                <td><?= $row['kelurahan'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td>
                                    <span class="badge bg-<?= 
                                        $row['risiko']=='tinggi' ? 'danger' : 
                                        ($row['risiko']=='sedang' ? 'warning text-dark' : 'success') ?>">
                                        <?= ucfirst($row['risiko']) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Data belum ada</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script>
const searchInput = document.getElementById("searchInput");
const rows = document.querySelectorAll(".data-row");
const filterButtons = document.querySelectorAll(".filter-btn");

let currentFilter = "semua";

// FILTER BUTTON
filterButtons.forEach(btn => {
    btn.addEventListener("click", function() {
        currentFilter = this.dataset.filter;

        // reset style
        filterButtons.forEach(b => {
            b.classList.remove("btn-info");
            b.classList.add("btn-outline-secondary");
        });

        this.classList.remove("btn-outline-secondary");
        this.classList.add("btn-info");

        applyFilter();
    });
});

// SEARCH (REALTIME)
searchInput.addEventListener("input", applyFilter);

// FUNCTION UTAMA
function applyFilter() {
    const keyword = searchInput.value.toLowerCase();

    rows.forEach(row => {
        const nama = row.children[1].innerText.toLowerCase();
        const umur = row.children[2].innerText.toLowerCase();
        const kecamatan = row.children[4].innerText.toLowerCase();
        const kelurahan = row.children[5].innerText.toLowerCase();
        const risiko = row.dataset.risiko;

        // SEARCH ke beberapa kolom (biar keren 🔥)
        const matchSearch =
            nama.includes(keyword) ||
            umur.includes(keyword) ||
            kecamatan.includes(keyword) ||
            kelurahan.includes(keyword);

        const matchFilter =
            currentFilter === "semua" || risiko === currentFilter;

        if (matchSearch && matchFilter) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>
</body>
</html>