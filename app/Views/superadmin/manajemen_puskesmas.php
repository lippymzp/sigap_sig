<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- STYLE -->
    <style>

        body, input, button, select, textarea {
    font-family: 'Poppins', sans-serif;
}

        /* header */
.header-user {
    display: flex;
    align-items: center;
    gap: 15px;
    background:  linear-gradient(90deg, #26c6da, #4dd0e1);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 600;
}

.header-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

/* Container Pagination */
.pagination {
    display: flex;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
    padding: 0;
}

/* Kotak per halaman */
.pagination .page-item {
    border-right: 1px solid #dee2e6;
}

.pagination .page-item:last-child {
    border-right: none;
}

.pagination .page-link {
    padding: 8px 16px;
    color: #4a5568; /* text gelap abu */
    text-decoration: none;
    background: #fff;
    border: none;
    font-size: 14px;
    display: block;
    transition: all 0.2s;
}

/* Hover effect */
.pagination .page-link:hover {
    background: #e0f2f1; /* hijau muda saat hover */
    color: #00cec9;
}

/* Saat Aktif (Halaman yang dipilih) */
.pagination .page-item.active .page-link {
    background: #b2dfdb; /* hijau muda sesuai UI */
    color: #00cec9;
    font-weight: 600;
}

/* Tombol utama */
.btn-navy {
    background: #26c6da; /* hijau utama */
    color: white;
}

.btn-navy:hover {
    background: #00acc1; /* hijau lebih gelap saat hover */
    color: white;
}

/* Icon search */
.search-icon {
    background: #26c6da;
    color: white;
}

.input-group-text {
    border-right: none;
}

.form-control {
    border-left: none;
}

/* Modal Styling */
.modal-hapus {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.25);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal-box {
    background: #fff;
    padding: 35px 30px;
    border-radius: 20px;
    text-align: center;
    width: 380px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    animation: popIn 0.3s ease;
}

.modal-box .icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 5px solid #e53935;
    color: #e53935;
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}

.btn-batal {
    background: #e0e0e0;
    color: #333;
    border: 1px solid #c2c2c2;
    padding: 8px 22px;
    border-radius: 8px !important;
    margin-right: 10px;
}

.btn-batal:hover {
    background: #d5d5d5;
}

.btn-hapus {
    background: #e53935;
    color: white;
    border: 1px solid #d32f2f;
    padding: 8px 22px;
    border-radius: 8px;
    margin-left: 10px;
}

@keyframes popIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
    </style>
<div class="container-fluid">

    <!-- HEADER -->
 <div class="header-user">
        <div class="header-icon">
        <img src="/img/icon_breadcrumb.svg" alt="Icon User">
    </div>
    <div>
        <h5>Manajemen Puskesmas</h5>
        <small>Menampilkan puskesmas</small>
    </div>
</div>

<!-- ALERT SUKSES -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- CARD -->
<div class="card shadow-sm" style="border-radius:10px;">
    <div class="card-body">

        <!-- SEARCH + TAMBAH DATA -->
        <div class="d-flex justify-content-between mb-3">
            <form method="get" action="/superadmin-user" style="max-width:500px;">
                <div class="input-group">
                    <span class="input-group-text search-icon">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="keyword" class="form-control" placeholder="Ketik untuk mencari..." value="<?= $keyword ?? '' ?>">
                </div>
            </form>

            <a href="/superadmin-user/create" class="btn btn-navy">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Puskesmas</th>
                        <th>Kecamatan</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users) && count($users) > 0): ?>
                        <?php $no = ($currentPage ?? 1 - 1) * ($perPage ?? 10) + 1; ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($user['nama_puskesmas']) ?></td>
                                <td><?= esc($user['kecamatan']) ?></td>
                                <td><?= esc($user['telepon']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td class="text-center">
                                    <a href="/superadmin-user/view/<?= $user['id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-search"></i></a>
                                    <a href="/superadmin-user/edit/<?= $user['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <a href="/superadmin-user/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted" style="font-size: 14px;">
                Menampilkan <?= count($users ?? []) ?> dari <?= $pager->getTotal() ?? 0 ?> data
            </div>
            <div>
<?= $pager->links() ?>            </div>
        </div>

    </div>
</div>

    <?= $this->endSection() ?>