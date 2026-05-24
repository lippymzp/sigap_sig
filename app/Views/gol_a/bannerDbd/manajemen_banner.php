<?= $this->extend('layout/dashboard_layout_admin'); ?>
<?= $this->section('content'); ?>

<?php
$banner = $banner ?? [];
$publish = $publish ?? 0;
$draft = $draft ?? 0;
?>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

.main{
    padding:25px;
    background:#f5f5f5;
    min-height:100vh;
}

.page-title{
    font-size:34px;
    font-weight:800;
    color:#111;
    margin-bottom:22px;
}

/* WRAPPER */

.banner-wrapper{
    background:#eef8f8;
    border-radius:16px;
    padding:20px;
    box-shadow:0 2px 8px rgba(0,0,0,.06);
}

/* SEARCH */

.top-filter{
    display:flex;
    gap:12px;
    margin-bottom:18px;
}

.search-input{
    flex:1;
    height:42px;
    border-radius:8px;
    border:1px solid #ccc;
    padding:0 15px;
    font-size:14px;
}

.sort-select{
    width:140px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:14px;
}

/* SUMMARY */

.summary-box{
    background:linear-gradient(90deg,#08c2cc,#9adfe3);
    border-radius:10px;
    padding:16px;
    text-align:center;
    color:#fff;
    margin-bottom:18px;
    box-shadow:0 2px 6px rgba(0,0,0,.08);
}

.summary-box h3{
    margin:0;
    font-size:18px;
    font-weight:700;
}

.summary-info{
    margin-top:8px;
    font-size:13px;
    display:flex;
    justify-content:center;
    gap:25px;
}

/* ACTION */

.banner-actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.status-tabs{
    display:flex;
    gap:10px;
}

.tab-btn{
    min-width:120px;
    height:36px;
    border:none;
    border-radius:8px;
    font-size:14px;
    font-weight:600;
}

.tab-active{
    background:#10c4cc;
    color:#fff;
}

.tab-inactive{
    background:#fff;
    border:1px solid #ccc;
}

.btn-add{
    background:#f2c94c;
    color:#fff;
    text-decoration:none;
    height:38px;
    padding:0 18px;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
    font-weight:600;
}

/* TABLE */

.table-wrapper{
    background:#fff;
    border-radius:12px;
    overflow:hidden;
    border:1px solid #ddd;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table thead{
    background:#edf2f2;
}

.table th{
    padding:14px 10px;
    font-size:14px;
    font-weight:700;
    color:#666;
    text-align:center;
}

.table td{
    padding:12px 10px;
    font-size:13px;
    border-top:1px solid #eee;
    vertical-align:middle;
    text-align:center;
}

/* IMAGE */

.banner-img{
    width:95px;
    height:55px;
    object-fit:cover;
    border-radius:6px;
}

/* STATUS */

.status-badge{
    padding:5px 12px;
    border-radius:7px;
    font-size:12px;
    font-weight:700;
    display:inline-block;
}

.publish{
    background:#dff5df;
    color:#228b22;
    border:1px solid #86c786;
}

.draft{
    background:#ffe1e1;
    color:#d62828;
    border:1px solid #ff9b9b;
}

/* ACTION BUTTON */

.action-box{
    display:flex;
    justify-content:center;
    gap:6px;
}

.icon-btn{
    width:28px;
    height:28px;
    border-radius:5px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    text-decoration:none;
    font-size:12px;
}

.view-btn{
    background:#2140ff;
}

.edit-btn{
    background:#f2c94c;
}

.delete-btn{
    background:#ff2d2d;
}

.empty-text{
    padding:30px;
    text-align:center;
    color:#888;
}

</style>
<?php if (session()->getFlashdata('success')): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "<?= esc((string) session()->getFlashdata('success')) ?>",
    confirmButtonText: 'OK'
});
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: "<?= esc((string) session()->getFlashdata('error')) ?>",
    confirmButtonText: 'OK'
});
</script>
<?php endif; ?>

<div class="main">

    <div class="banner-wrapper">

        <!-- SEARCH -->
        <div class="top-filter">

                <form method="get" action="<?= base_url('bannerDbd/manajemen_banner') ?>" style="display: flex; gap: 10px; width: 100%;">

                    <input
                        type="text"
                        name="search"
                        id="searchBanner"
                        class="search-input"
                        placeholder="Cari banner disini"
                        value="<?= esc((string)($_GET['search'] ?? '')) ?>"
                    >

                    <select
                        name="sort"
                        class="sort-select"
                        onchange="this.form.submit()"
                    >
                        <option value="">Urutkan</option>

                        <option value="terbaru" <?= ($_GET['sort'] ?? '') == 'terbaru' ? 'selected' : '' ?>>
                            Terbaru
                        </option>

                        <option value="terlama" <?= ($_GET['sort'] ?? '') == 'terlama' ? 'selected' : '' ?>>
                            Terlama
                        </option>

                        <option value="aktif" <?= ($_GET['sort'] ?? '') == 'aktif' ? 'selected' : '' ?>>
                            Status Aktif
                        </option>

                        <option value="draft" <?= ($_GET['sort'] ?? '') == 'draft' ? 'selected' : '' ?>>
                            Status Draft
                        </option>
                    </select>

                </form>

            </div>

        <!-- SUMMARY -->
        <div class="summary-box">

            <h3>
                <?= (int) count((array)$banner); ?> Banner Telah Diunggah
            </h3>

            <div class="summary-info">

                <span>
                    ● <?= (int)($publish ?? 0); ?> Banner telah diunggah
                </span>

                <span>
                    ● <?= (int)($draft ?? 0); ?> Banner di draft
                </span>

            </div>

        </div>

        <!-- ACTION -->
        <div class="banner-actions">

            <div class="status-tabs">

            <button 
                class="tab-btn tab-active filter-btn"
                data-filter="all"
            >
                Semua
            </button>

            <button 
                class="tab-btn tab-inactive filter-btn"
                data-filter="draft"
            >
                Draft
            </button>

            <button 
                class="tab-btn tab-inactive filter-btn"
                data-filter="publish"
            >
                Terunggah
            </button>

            </div>

            <a
                href="<?= base_url('/bannerDbd/unggah_banner'); ?>"
                class="btn-add"
            >
                Tambah Banner
            </a>

        </div>

        <!-- TABLE -->
        <div class="table-wrapper">

            <table class="table">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Judul Banner</th>
                        <th>Preview Gambar</th>
                        <th>Deskripsi</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php if(!empty($banner)) : ?>

                    <?php $no = 1; ?>

                    <?php foreach($banner as $b) : ?>

                    <tr class="banner-row"
                        data-status="<?= strtolower((string)($b['status_banner'] ?? 'draft')); ?>">

                        <!-- NO -->
                        <td>
                            <?= $no++; ?>
                        </td>

                        <!-- JUDUL -->
                        <td class="banner-title">

                            <?= esc((string)($b['judul_banner'] ?? '')); ?>

                        </td>

                        <!-- IMAGE -->
                        <td>

                            <img
                                src="<?= base_url('uploads/banner/' . (string)($b['gambar'] ?? '')); ?>"
                                class="banner-img"
                            >

                        </td>

                        <!-- DESKRIPSI -->
                        <td>

                           <?= esc(substr((string) (($b['deskripsi'] ?? '') ?: ''), 0, 50)) ?>...

                        </td>

                        <!-- URUTAN -->
                         <td>

                        <form
                            action="<?= base_url('bannerDbd/updateUrutan/' . $b['id_manajemen_banner']); ?>"
                            method="post"
                        >

                            <select
                                name="urutan"
                                class="form-control"
                                onchange="this.form.submit()"
                                style="
                                    width:80px;
                                    margin:auto;
                                    text-align:center;
                                "
                            >

                                <?php for($i=1; $i<=4; $i++) : ?>

                                    <option
                                        value="<?= $i; ?>"
                                        <?= ($b['urutan'] == $i) ? 'selected' : ''; ?>
                                    >
                                        <?= $i; ?>
                                    </option>

                                <?php endfor; ?>

                            </select>

                        </form>

                        </td>

                        <!-- STATUS -->
                        <td>

                            <?php
                            $status = strtolower((string)($b['status_banner'] ?? 'draft'));
                            ?>

                            <?php if($status == 'publish') : ?>

                                <span class="status-badge publish">
                                    Aktif
                                </span>

                            <?php else : ?>

                                <span class="status-badge draft">
                                    Tidak Aktif
                                </span>

                            <?php endif; ?>

                        </td>

                        <!-- AKSI -->
                        <td>

                            <div class="action-box">

                                <!-- VIEW -->
                                <a
                                    href="<?= base_url('bannerDbd/preview/' . $b['id_manajemen_banner']); ?>"
                                    target="_blank"
                                    class="icon-btn view-btn"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- EDIT -->
                               <a
                                    href="<?= base_url('bannerDbd/edit/' . $b['id_manajemen_banner']); ?>"
                                    class="icon-btn edit-btn"
                                    onclick="confirmEdit(event, '<?= base_url('bannerDbd/edit/' . $b['id_manajemen_banner']); ?>')"
                                >
                                    <i class="fas fa-pen"></i>
                                </a>

                                <!-- DELETE -->
                                <a
                                    href="<?= base_url('bannerDbd/delete/' . $b['id_manajemen_banner']); ?>"
                                    onclick="confirmDelete(event, '<?= base_url('bannerDbd/delete/' . $b['id_manajemen_banner']); ?>')"
                                    class="icon-btn delete-btn"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>

                        <td colspan="7" class="empty-text">
                            Tidak ada data banner
                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

const searchInput =
document.getElementById('searchBanner');

searchInput.addEventListener('keyup', function(){

    let keyword =
    this.value.toLowerCase();

    let rows =
    document.querySelectorAll('.banner-row');

    rows.forEach(function(row){

        let title =
        row.querySelector('.banner-title')
        .innerText
        .toLowerCase();

        if(title.includes(keyword)){

            row.style.display = '';

        }else{

            row.style.display = 'none';
        }

    });

});

const filterButtons =
document.querySelectorAll('.filter-btn');

filterButtons.forEach(function(btn){

    btn.addEventListener('click', function(){

        let filter =
        this.dataset.filter;

        document
        .querySelectorAll('.filter-btn')
        .forEach(function(b){

            b.classList.remove('tab-active');
            b.classList.add('tab-inactive');

        });

        this.classList.remove('tab-inactive');
        this.classList.add('tab-active');

        let rows =
        document.querySelectorAll('.banner-row');

        rows.forEach(function(row){

            let status =
            row.dataset.status;

            if(filter === 'all'){

                row.style.display = '';

            }else{

                if(status === filter){

                    row.style.display = '';

                }else{

                    row.style.display = 'none';
                }

            }

        });

    });

});
function confirmDelete(event, url) {
    event.preventDefault();

    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
function confirmEdit(event, url) {
    event.preventDefault();

    Swal.fire({
        title: 'Edit banner ini?',
        text: "Anda akan masuk ke halaman edit banner",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#11bccd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Edit!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection(); ?>