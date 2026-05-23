<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

    <?php

    $petugas = $petugas ?? [];
    $start = $start ?? 0;
    $end = $end ?? 0;
    $total = $total ?? 0;
    $pager = $pager ?? null;
    $jabatan_list = $jabatan_list ?? [];
    $selected_jabatan = $selected_jabatan ?? '';
    $keyword = $keyword ?? '';

    ?>

<?php if(session()->getFlashdata('success')): ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">

    <?= session()->getFlashdata('success') ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>

<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">

    <?= session()->getFlashdata('error') ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>

<?php endif; ?>

<style>

.page-title{
    font-size:48px;
    font-weight:800;
    color:#111;
}

.user-card{
    background:white;
    border-radius:30px;
    padding:30px;
}

.btn-tambah{
    background:#00BBC2;
    color:white;
    border:none;
    padding:14px 30px;
    border-radius:14px;
    font-weight:600;
}

.btn-tambah:hover{
    background: #169fa5;
    color: white;
    box-shadow: 0 4px 10px rgba(32,184,190,0.4);
}

.table thead{
    background:#DFF5F5;
}

.table th{
    padding:18px;
}

.table td{
    padding:18px;
    vertical-align:middle;
}

.action-btn{
    width:38px;
    height:38px;
    border:none;
    border-radius:8px;
    color:white;
}

.btn-view{
    background:#001BFF;
}

.btn-edit{
    background:#FFE500;
    color:black;
}

.btn-delete{
    background:red;
}

.search-box{
    display:flex;
    align-items:center;
    border-radius:14px;
    overflow:hidden;
    border:1px solid #ddd;
    background:white;
    height:45px;
}

.btn-ok {
    background: #00BBC2;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 500;
    transition: 0.2s;
}

.btn-ok:hover {
    background: #169fa5;
    transform: translateY(-1px);
}

.search-box input{
    border:none;
    outline:none;
    padding:0 12px;
    width:260px;
    height:100%;
}

.search-box button{
    border:none;
    background:#00BBC2;
    color:white;
    width:55px;
    height:100%;
    display:flex;
    align-items:center;
    justify-content:center;
}

.filter-btn{
    width:45px;
    height:45px;
    border-radius:10px;
    border:2px solid #00BBC2;
    background:white;
    color:#20B8BE;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:0.2s;
}

.filter-btn:hover{
    background:#169fa5;
    color:white;
    transform:scale(1.05);
}

.filter-btn i {
    font-size: 16px;
    color: #20B8BE;
}

.filter-btn:hover i {
    color: white;
}

.filter-modal{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.filter-modal.active{
    display:flex;
}

.filter-box{
    background:white;
    padding:25px;
    border-radius:15px;
    width:350px;
}

/* PAGINATION */
.pagination{
    gap:8px;
    margin:0;
}

.pagination li{
    list-style:none;
}

.pagination .page-link{

    min-width:42px;
    height:42px;

    display:flex;
    align-items:center;
    justify-content:center;

    padding:0 16px;

    border:none !important;
    border-radius:12px !important;

    background:#F5F5F5;
    color:#555 !important;

    font-weight:600;
    font-size:14px;

    transition:0.2s ease;
}

.pagination .page-link:hover{
    background:#00BBC2;
    color:white !important;
    transform:translateY(-2px);
}

.pagination .active .page-link{
    background:#00BBC2 !important;
    color:white !important;
    box-shadow:0 4px 10px rgba(0,187,194,0.3);
}

.pagination .disabled .page-link{
    background:#EEEEEE;
    color:#AAA !important;
}

/* DELETE MODAL */
.delete-modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.5);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
}

.delete-box{
    width:90%;
    max-width:400px;
    background:#fff;
    border-radius:18px;
    padding:30px;
    text-align:center;
    animation:popup .2s ease;
}

@keyframes popup{
    from{
        transform:scale(.8);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}

.delete-icon{
    width:80px;
    height:80px;
    background:#ffe5e5;
    color:#ff1717;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    font-size:35px;
    margin-bottom:18px;
}

.delete-box h3{
    margin-bottom:10px;
    font-size:28px;
    font-weight:700;
}

.delete-box p{
    color:#666;
    margin-bottom:25px;
}

.delete-actions{
    display:flex;
    gap:12px;
}

.btn-cancel,
.btn-confirm-delete{
    flex:1;
    height:48px;
    border:none;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    font-weight:700;
    cursor:pointer;
}

.btn-cancel{
    background:#e5e5e5;
    color:#333;
}

.btn-confirm-delete{
    background:#ff1717;
    color:#fff;
}

</style>

<div class="container-fluid">

<div class="user-card">

<div class="d-flex justify-content-between align-items-center mb-4">

    <!-- LEFT: SEARCH + FILTER -->
    <form method="get" id="filterForm" class="d-flex align-items-center gap-2">

        <!-- SEARCH -->
        <div class="search-box">

            <button type="submit">
                <i class="fa fa-search"></i>
            </button>

            <input type="text"
                name="keyword"
                placeholder="Ketik untuk mencari..."
                value="<?= $keyword ?? '' ?>">

        </div>

        <!-- FILTER BUTTON (SAMA KAYA STYLE KAMU DI HASIL DATA) -->
        <button type="button" class="filter-btn" onclick="openFilter()">
            <i class="fa fa-filter"></i>
        </button>

    </form>

    <!-- RIGHT: BUTTON TETAP (TIDAK DIUBAH) -->
    <a href="<?= base_url('manajemen-user/tambah') ?>" class="btn btn-tambah">
        + Tambah Data
    </a>

</div>

<div class="table-responsive">

<table class="table">

<thead>
<tr>
    <th>No</th>
    <th>Nama Lengkap</th>
    <th>Email</th>
    <th>Jabatan</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php $no = 1; ?>
<?php foreach($petugas as $p): ?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['nama_petugas'] ?></td>
    <td><?= $p['email'] ?></td>
    <td><?= ucfirst($p['nama_jabatan']) ?></td>

    <td class="d-flex gap-2">

        <a href="<?= base_url('manajemen-user/view/'.$p['id_petugas']) ?>"
            class="btn action-btn btn-view">
            <i class="fa fa-eye"></i>
        </a>

        <a href="<?= base_url('manajemen-user/edit/'.$p['id_petugas']) ?>"
           class="btn action-btn btn-edit">
            <i class="fa fa-pencil"></i>
        </a>

        <button
            type="button"
            class="btn action-btn btn-delete"
            onclick="openDeleteModal(
                '<?= base_url('manajemen-user/hapus/'.$p['id_petugas']) ?>'
            )"
        >
            <i class="fa fa-trash"></i>
        </button>

    </td>
</tr>

<?php endforeach; ?>

</tbody>

</table>

<div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">

    <!-- INFO DATA -->
    <div style="color:#777;">
        Menampilkan <?= $start ?> sampai <?= $end ?> dari <?= $total ?> data user
    </div>

    <!-- PAGINATION -->
    <?php if ($pager): ?>
        <?= $pager->links() ?>
    <?php endif; ?>

</div>

<!-- DELETE MODAL -->
<div class="delete-modal" id="deleteModal">

    <div class="delete-box">

        <div class="delete-icon">
            <i class="fa fa-trash"></i>
        </div>

        <h3>Konfirmasi Hapus</h3>

        <p>
            Apakah yakin ingin menghapus data ini?
        </p>

        <div class="delete-actions">

            <button
                type="button"
                class="btn-cancel"
                onclick="closeDeleteModal()"
            >
                Batal
            </button>

            <a
                href="#"
                id="deleteLink"
                class="btn-confirm-delete"
            >
                Hapus
            </a>

        </div>

    </div>

</div>

<div id="filterModal" class="filter-modal">

    <div class="filter-box">

        <h5 class="mb-3">Filter Jabatan</h5>

        <select id="jabatanSelect" class="form-control">

            <option value="">Semua Jabatan</option>

            <?php foreach($jabatan_list as $j): ?>
                <option value="<?= $j['id_jabatan'] ?>"
                    <?= ($selected_jabatan == $j['id_jabatan']) ? 'selected' : '' ?>>
                    <?= $j['nama_jabatan'] ?>
                </option>
            <?php endforeach; ?>

        </select>

        <div class="d-flex justify-content-end gap-2 mt-3">

            <button class="btn btn-secondary" onclick="closeFilter()">
                Cancel
            </button>

            <button class="btn-ok" onclick="applyFilter()">
                OK
            </button>

        </div>

    </div>

</div>

</div>
</div>
</div>

</table>


<script>
    const input = document.querySelector('input[name="keyword"]');

    if(input){
        input.addEventListener('keyup', function(e){
            if(e.key === 'Enter'){
                this.form.submit();
            }
        });
    }
</script>

<script>
function openFilter(){
    document.getElementById('filterModal').classList.add('active');
}

function closeFilter(){
    document.getElementById('filterModal').classList.remove('active');
}

function applyFilter(){
    let jabatan = document.getElementById('jabatanSelect').value;

    let form = document.getElementById('filterForm');

    let input = document.querySelector('input[name="jabatan"]');

    if(!input){
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'jabatan';
        form.appendChild(input);
    }

    input.value = jabatan;

    form.submit();
}
</script>
<!-- DELETE MODAL -->
<div class="delete-modal" id="deleteModal">

    <div class="delete-box">

        <div class="delete-icon">
            <i class="fa fa-trash"></i>
        </div>

        <h3>Konfirmasi Hapus</h3>

        <p>
            Apakah yakin ingin menghapus data ini?
        </p>

        <div class="delete-actions">

            <button
                type="button"
                class="btn-cancel"
                onclick="closeDeleteModal()"
            >
                Batal
            </button>

            <a
                href="#"
                id="deleteLink"
                class="btn-confirm-delete"
            >
                Hapus
            </a>

        </div>

    </div>

</div>
<script>

// OPEN MODAL
function openDeleteModal(link){

    document.getElementById('deleteModal')
    .style.display = 'flex';

    document.getElementById('deleteLink')
    .href = link;
}


// CLOSE MODAL
function closeDeleteModal(){

    document.getElementById('deleteModal')
    .style.display = 'none';
}


// CLOSE SAAT KLIK BACKGROUND
window.addEventListener('click', function(e){

    const modal =
    document.getElementById('deleteModal');

    if(e.target === modal){

        closeDeleteModal();
    }

});

</script>
<?= $this->endSection() ?>