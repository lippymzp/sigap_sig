<?= $this->extend('layout/dashboard_layout_admin'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
.main {
    padding: 25px;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 20px;
}

.banner-wrapper {
    background: #EAF7F7;
    border-radius: 20px;
    padding: 30px;
    padding-bottom: 18px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}

.top-filter {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
}

.search-input {
    flex: 1;
    border-radius: 14px;
    min-height: 52px;
    border: 1px solid #ddd;
    padding: 12px 18px;
}

.sort-select {
    width: 180px;
    border-radius: 14px;
    border: 1px solid #ddd;
}

.summary-box {
    background: #11C5CC;
    color: white;
    border-radius: 14px;
    padding: 18px;
    text-align: center;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
}

.banner-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
    margin-top: 8px;
}

.status-tabs {
    display: flex;
    gap: 10px;
}

.tab-btn {
    border: none;
    padding: 9px 22px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    min-width: 110px;
}

.tab-active {
    background: #11C5CC;
    color: white;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.tab-inactive {
    background: white;
    border: 1px solid #DADADA;
    color: #333;
}

.btn-add {
    background: #F4B740;
    color: white;
    border: none;
    padding: 10px 22px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 42px;
}

.table-wrapper {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    margin-top: 10px;
}

.table {
    margin-bottom: 0;
}

.table thead {
    background: #F8F8F8;
}

.table th {
    font-weight: 600;
    padding: 14px;
    font-size: 15px;
}

.table td {
    vertical-align: middle;
    padding: 12px 14px;
    font-size: 14px;
}

.status-badge {
    background: #DFF7E3;
    color: #1C8B3C;
    padding: 6px 16px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    display: inline-block;
    min-width: 70px;
    text-align: center;
}
.status-draft {
    background: #FDE2E2;
    color: #C0392B;
}
.table td:first-child {
    width: 60px;
}

.table td:nth-child(2) {
    min-width: 250px;
}
.table td:nth-child(4) {
    width: 300px;
    max-width: 300px;
}
.table td:nth-child(3) {
    width: 150px;
    text-align: center;
}

.table td:nth-child(6) {
    width: 140px;
    text-align: center;
}
.table {
    width: 100%;
    table-layout: fixed;
}
</style>
  <div class="main">

    <div class="page-title">
        Manajemen Banner
    </div>

    <div class="banner-wrapper">

        <!-- SEARCH + SORT -->
        <div class="top-filter">
            <input
                type="text"
                class="form-control search-input"
                placeholder="Cari banner disini"
            >

            <select class="form-select sort-select">
                <option>Urutkan</option>
            </select>
        </div>

        <!-- SUMMARY -->
        <div class="summary-box">
    <div style="font-size: 22px; font-weight: 700;">
        2 Banner Telah Diunggah
    </div>

    <div style="
        margin-top: 10px;
        font-size: 14px;
        display: flex;
        justify-content: center;
        gap: 30px;
        opacity: 0.95;
    ">
        <span>● 1 Banner telah diunggah</span>
        <span>● 1 Banner di draft</span>
    </div>
</div>

        <!-- ACTIONS -->
        <div class="banner-actions">

            <div class="status-tabs">
                <button class="tab-btn tab-active">
                    Terunggah
                </button>

                <button class="tab-btn tab-inactive">
                    Draft
                </button>
            </div>

            <a
                href="<?= base_url('unggah_banner'); ?>"
                class="btn-add"
            >
                + Tambah Banner
            </a>

        </div>

        <!-- TABLE -->
        <div class="table-wrapper">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Banner</th>
                        <th>Preview</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Wujudkan Lingkungan Bebas Jentik</td>
                        <td style="width:120px;">
                         <img
                            src="<?= base_url('img/banner1.png'); ?>"
                            style="
                                width: 90px;
                                height: 55px;
                                object-fit: cover;
                                border-radius: 8px;
                            "
                        >
                        </td>
                        <td>
                            Periksa tempat penampungan air secara rutin
                            agar tidak menjadi sarang nyamuk.
                        </td>
                        <td>
                            <span class="status-badge">
                                Aktif
                            </span>
                        </td>
                        <td style="min-width:190px;">
    <div style="display:flex; gap:8px; align-items:center;">

        <a href="#"
           style="
               width:38px;
               height:38px;
               background:#2F80ED;
               border-radius:8px;
               display:flex;
               align-items:center;
               justify-content:center;
               color:white;
               text-decoration:none;
           ">
            <i class="fas fa-eye"></i>
        </a>

        <a href="#"
           style="
               width:38px;
               height:38px;
               background:#F2C94C;
               border-radius:8px;
               display:flex;
               align-items:center;
               justify-content:center;
               color:white;
               text-decoration:none;
           ">
            <i class="fas fa-pen"></i>
        </a>

        <a href="#"
           style="
               width:38px;
               height:38px;
               background:#EB5757;
               border-radius:8px;
               display:flex;
               align-items:center;
               justify-content:center;
               color:white;
               text-decoration:none;
           ">
            <i class="fas fa-trash"></i>
        </a>

    </div>
</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>
