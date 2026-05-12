<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>

<?= $this->section('content') ?>

<style>
.pegawai-page{
    padding: 10px 5px;
    font-family: 'Poppins', sans-serif;
}

/* SEARCH */
.search-box{
    position: relative;
    margin-bottom: 12px;
}

.search-box input{
    width: 100%;
    height: 45px;
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    padding: 0 15px 0 50px;
    font-size: 13px;
    color: #555;
    outline: none;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.12);
}

.search-box i{
    position: absolute;
    top: 50%;
    left: 18px;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 18px;
}

/* TOOLBAR */
.pegawai-toolbar{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.pegawai-tab{
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-tab{
    border: none;
    padding: 7px 24px;
    border-radius: 20px;
    font-size: 12px;
    background: #e5e5e5;
    color: #8a8a8a;
    box-shadow: 0 2px 4px rgba(0,0,0,0.12);
}

.btn-tab.active{
    background: #36cfd0;
    color: #fff;
}

.btn-tambah{
    background: #f28c00;
    color: #fff;
    border-radius: 20px;
    padding: 7px 18px;
    font-size: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-tambah:hover{
    background: #df8000;
    color: #fff;
}

/* TABLE */
.table-responsive{
    background: #fff;
    border: 1px solid #e6edf2;
    overflow-x: auto;
}

.table-pegawai{
    width: 100%;
    background: #fff;
    border-collapse: collapse;
    font-size: 13px;
    color: #666;
    margin-bottom: 0;
}

/* HEADER TABEL */
.table-pegawai thead tr{
    border-bottom: 3px solid #e9eef2;
}

.table-pegawai thead th{
    background: #fff;
    color: #222;
    font-weight: 500;
    text-align: center;
    vertical-align: middle;
    padding: 17px 12px;
    border: none;
    white-space: nowrap;
}

/* BODY TABEL */
.table-pegawai tbody tr{
    border-bottom: 2px solid #e9eef2;
}

.table-pegawai tbody td{
    height: 52px;
    padding: 14px 12px;
    border: none;
    vertical-align: middle;
    color: #666;
}

/* KOLOM */
.table-pegawai .col-no{
    width: 60px;
    text-align: center;
}

.table-pegawai .col-nama{
    min-width: 180px;
}

.table-pegawai .col-nip{
    min-width: 190px;
    text-align: center;
}

.table-pegawai .col-pangkat{
    min-width: 150px;
    text-align: center;
}

.table-pegawai .col-jabatan{
    min-width: 160px;
    text-align: center;
}

.table-pegawai .col-email{
    min-width: 210px;
    text-align: center;
}

.table-pegawai .col-telepon{
    min-width: 150px;
    text-align: center;
}

.table-pegawai .col-aksi{
    width: 100px;
    text-align: center;
}

/* TOMBOL AKSI */
.aksi-btn{
    width: 30px;
    height: 30px;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
    font-size: 13px;
    margin: 0 3px;
}

.aksi-edit{
    background: #f5e600;
}

.aksi-hapus{
    background: #ff0d0d;
}

.aksi-btn:hover{
    color: #fff;
    opacity: 0.85;
}

/* PAGINATION */
.pagination-pegawai{
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
}

.pagination-pegawai .pagination{
    margin-bottom: 0;
}

.pagination-pegawai .page-link{
    font-size: 11px;
    padding: 5px 10px;
    color: #555;
}

.pagination-pegawai .page-item.active .page-link{
    background: #e5e7eb;
    border-color: #dee2e6;
    color: #333;
}
</style>

<div class="pegawai-page">

    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Cari nama atau NIP">
    </div>

    <div class="pegawai-toolbar">
        <div class="pegawai-tab">
            <button type="button" class="btn-tab active">Pegawai</button>
            <button type="button" class="btn-tab">Admin</button>
        </div>

        <a href="<?= base_url('index.php/pneumonia/pegawai/tambah') ?>" class="btn-tambah">
            <i class="fa-solid fa-circle-plus"></i> Tambah
        </a>
    </div>

    <div class="table-responsive">
        <table class="table-pegawai">
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-nama">Nama</th>
                    <th class="col-nip">NIP</th>
                    <th class="col-pangkat">Pangkat/Gol</th>
                    <th class="col-jabatan">Jabatan</th>
                    <th class="col-email">Email</th>
                    <th class="col-telepon">No Telepon</th>
                    <th class="col-aksi">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="col-no">1</td>
                    <td class="col-nama"></td>
                    <td class="col-nip"></td>
                    <td class="col-pangkat"></td>
                    <td class="col-jabatan"></td>
                    <td class="col-email"></td>
                    <td class="col-telepon"></td>
                    <td class="col-aksi"></td>
                </tr>

                <tr>
                    <td class="col-no">2</td>
                    <td class="col-nama"></td>
                    <td class="col-nip"></td>
                    <td class="col-pangkat"></td>
                    <td class="col-jabatan"></td>
                    <td class="col-email"></td>
                    <td class="col-telepon"></td>
                    <td class="col-aksi"></td>
                </tr>

                <tr>
                    <td class="col-no">3</td>
                    <td class="col-nama"></td>
                    <td class="col-nip"></td>
                    <td class="col-pangkat"></td>
                    <td class="col-jabatan"></td>
                    <td class="col-email"></td>
                    <td class="col-telepon"></td>
                    <td class="col-aksi"></td>
                </tr>

                <tr>
                    <td class="col-no">4</td>
                    <td class="col-nama"></td>
                    <td class="col-nip"></td>
                    <td class="col-pangkat"></td>
                    <td class="col-jabatan"></td>
                    <td class="col-email"></td>
                    <td class="col-telepon"></td>
                    <td class="col-aksi"></td>
                </tr>

                <tr>
                    <td class="col-no">5</td>
                    <td class="col-nama"></td>
                    <td class="col-nip"></td>
                    <td class="col-pangkat"></td>
                    <td class="col-jabatan"></td>
                    <td class="col-email"></td>
                    <td class="col-telepon"></td>
                    <td class="col-aksi"></td>
                </tr>

                <tr>
                    <td class="col-no">6</td>
                    <td class="col-nama"></td>
                    <td class="col-nip"></td>
                    <td class="col-pangkat"></td>
                    <td class="col-jabatan"></td>
                    <td class="col-email"></td>
                    <td class="col-telepon"></td>
                    <td class="col-aksi"></td>
                </tr>

                <tr>
                    <td class="col-no">7</td>
                    <td class="col-nama"></td>
                    <td class="col-nip"></td>
                    <td class="col-pangkat"></td>
                    <td class="col-jabatan"></td>
                    <td class="col-email"></td>
                    <td class="col-telepon"></td>
                    <td class="col-aksi"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pagination-pegawai">
        <nav>
            <ul class="pagination pagination-sm">
                <li class="page-item disabled">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

</div>

<?= $this->endSection() ?>