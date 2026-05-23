<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<style>
.page-title{
    font-size:38px;
    font-weight:700;
    color:#1c1c1c;
    margin-bottom:24px;
}

.data-wrapper{
    background:#eaf6f6;
    border-radius:28px;
    padding:28px;
    box-shadow:0 10px 30px rgba(0,0,0,.04);
}

.top-tools{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
    gap:20px;
    flex-wrap:wrap;
}

.search-box{
    flex:1;
    min-width:300px;
}

.search-input{
    height:52px;
    border-radius:16px;
    border:none;
    padding:0 18px;
    background:white;
    box-shadow:0 4px 16px rgba(0,0,0,.05);
    width:100%;
}

.btn-export{
    background:linear-gradient(135deg,#00c6cf,#009dc3);
    color:white;
    border:none;
    border-radius:16px;
    padding:14px 24px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 8px 18px rgba(0,198,207,.25);
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
    margin-bottom:24px;
}

.stat-card{
    background:white;
    border-radius:22px;
    padding:22px;
    box-shadow:0 6px 24px rgba(0,0,0,.05);
}

.stat-label{
    color:#888;
    font-size:14px;
    font-weight:600;
}

.stat-value{
    font-size:32px;
    font-weight:800;
    color:#111;
}

.table-card{
    background:white;
    border-radius:24px;
    padding:22px;
    box-shadow:0 8px 28px rgba(0,0,0,.05);
    overflow:hidden;
}

.custom-table{
    width:100%;
    border-collapse:collapse;
}

.custom-table th{
    background:#00b8c8;
    color:white;
    padding:16px;
    font-size:14px;
    font-weight:700;
}

.custom-table td{
    padding:14px;
    border-bottom:1px solid #edf3f3;
    font-size:14px;
}

.badge-jk{
    padding:7px 14px;
    border-radius:20px;
    font-weight:600;
    font-size:12px;
}

.badge-l{
    background:#dff4ff;
    color:#0077b6;
}

.badge-p{
    background:#ffe2ef;
    color:#d63384;
}

.badge-diagnosa{
    background:#e7fff1;
    color:#0f8b4c;
    padding:7px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:700;
}

.empty-box{
    text-align:center;
    padding:50px;
    color:#999;
    font-size:16px;
}

.action-btn{
    border:none;
    background:#f4f8f8;
    border-radius:12px;
    padding:8px 12px;
    cursor:pointer;
    margin-right:6px;
}

@media(max-width:992px){
    .stats-grid{
        grid-template-columns:1fr;
    }

    .custom-table{
        display:block;
        overflow-x:auto;
    }
}
</style>

<?php
$totalKasus = count($pasien);

$laki = count(array_filter($pasien, function($p){
    return strtolower($p['jk'] ?? '') == 'laki-laki';
}));

$perempuan = count(array_filter($pasien, function($p){
    return strtolower($p['jk'] ?? '') == 'perempuan';
}));
?>

<h2 class="page-title">Hasil Data Pasien</h2>

<div class="data-wrapper">

    <div class="top-tools">

        <div class="search-box">
            <input
                type="text"
                id="searchInput"
                class="search-input"
                placeholder="🔍 Cari nama pasien / kecamatan / desa..."
            >
        </div>

        <a href="<?= base_url('diare/export') ?>" class="btn-export">
            📤 Export Excel
        </a>

    </div>

    <!-- STATS -->
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Total Kasus Diare</div>
            <div class="stat-value"><?= $totalKasus ?></div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Pasien Laki-laki</div>
            <div class="stat-value"><?= $laki ?></div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Pasien Perempuan</div>
            <div class="stat-value"><?= $perempuan ?></div>
        </div>

    </div>

    <!-- TABLE -->
    <div class="table-card">

        <?php if(!empty($pasien)): ?>

        <table class="custom-table" id="dataTable">

            <thead>
                <tr>
                    <th>No</th>
                    <th>No RM</th>
                    <th>Nama</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>JK</th>
                    <th>Diagnosa</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                <?php $no=1; foreach($pasien as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($p['no_rm'] ?? '-') ?></td>
                    <td><?= esc($p['nama_pasien'] ?? '-') ?></td>
                    <td><?= esc($p['kecamatan'] ?? '-') ?></td>
                    <td><?= esc($p['desa'] ?? '-') ?></td>

                    <td>
                        <?php if(($p['jk'] ?? '') == 'Laki-laki'): ?>
                            <span class="badge-jk badge-l">Laki-laki</span>
                        <?php else: ?>
                            <span class="badge-jk badge-p">Perempuan</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <span class="badge-diagnosa">
                            <?= esc($p['diagnosis'] ?? '-') ?>
                        </span>
                    </td>

                    <td><?= esc($p['tanggal_kunjungan'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <?php else: ?>

        <div class="empty-box">
            Belum ada data pasien tersimpan.
        </div>

        <?php endif; ?>

    </div>

</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#dataTable tbody tr');

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>

<?= $this->endSection() ?>