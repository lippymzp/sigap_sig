<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
*{
    font-family:'Poppins',sans-serif;
}

.page-wrap{
    padding:25px;
    background:#f7fafa;
    min-height:100vh;
}

.topbar-title{
    font-size:38px;
    font-weight:700;
    color:#1e1e1e;
}

.search-box{
    background:white;
    border-radius:12px;
    padding:14px 18px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    border:1px solid #ddd;
}

.search-box input{
    border:none;
    outline:none;
    width:100%;
}

.overview-card{
    background:#14c7cd;
    color:white;
    border-radius:14px;
    padding:20px;
    margin-top:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.overview-title{
    font-size:42px;
    font-weight:800;
}

.filter-tabs{
    display:flex;
    gap:15px;
    margin:20px 0;
}

.filter-btn{
    padding:10px 28px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    background:#efefef;
    color:#333;
    transition:.3s;
}

.filter-btn.active{
    background:#14c7cd;
    color:white;
}

.news-card{
    background:white;
    border-radius:16px;
    padding:18px;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:18px;
}

.news-left{
    display:flex;
    gap:18px;
    align-items:center;
    flex:1;
}

.news-thumb{
    width:160px;
    height:95px;
    border-radius:12px;
    object-fit:cover;
    background:#eee;
}

.news-title{
    font-size:22px;
    font-weight:700;
    margin-bottom:8px;
    color:#222;
}

.news-desc{
    color:#666;
    font-size:14px;
    max-width:700px;
    line-height:1.5;
}

.news-date{
    color:#999;
    font-size:13px;
    margin-top:8px;
}

.action-box{
    display:flex;
    gap:10px;
    align-items:center;
}

.btn-icon{
    width:42px;
    height:42px;
    border:none;
    border-radius:10px;
    color:white;
    font-size:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
}

.btn-view{ background:#3f51ff; }
.btn-edit{ background:#ffc107; }
.btn-delete{ background:#ff3b30; }
.btn-publish{ background:#17c0eb; }

.add-btn{
    background:#ffd54f;
    border:none;
    padding:10px 22px;
    border-radius:10px;
    font-weight:700;
}
</style>

<div class="page-wrap">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="topbar-title">Kelola Berita</h1>

        <a href="<?= base_url('admind/berita/tambah') ?>"
           class="add-btn text-decoration-none text-dark">
            Tambah Berita
        </a>
    </div>

    <div class="search-box mt-4">
        <input type="text" placeholder="Cari berita disini">
    </div>

    <div class="overview-card">
        <div class="overview-title">
            <?= count($berita) ?> Berita Telah Dibuat
        </div>
    </div>

    <div class="filter-tabs">
        <a href="<?= base_url('admind/berita?tab=publish') ?>"
           class="filter-btn <?= ($tab ?? 'publish') == 'publish' ? 'active' : '' ?>">
            Terunggah
        </a>

        <a href="<?= base_url('admind/berita?tab=draft') ?>"
           class="filter-btn <?= ($tab ?? 'publish') == 'draft' ? 'active' : '' ?>">
            Draft
        </a>
    </div>

    <?php foreach($berita as $b): ?>

    <?php
        $gambar = !empty($b['gambar_berita'])
            ? base_url('uploads/berita/' . $b['gambar_berita'])
            : base_url('img/no-image.png');

        $tanggal = (!empty($b['tanggal_berita']) && strtotime($b['tanggal_berita']))
            ? date('d M Y', strtotime($b['tanggal_berita']))
            : '-';
    ?>

    <div class="news-card">

        <div class="news-left">
            <img src="<?= $gambar ?>" class="news-thumb">

            <div>
                <div class="news-title">
                    <?= esc($b['judul_berita']) ?>
                </div>

                <div class="news-desc">
                    <?= word_limiter(strip_tags($b['deskripsi_berita']), 20) ?>
                </div>

                <div class="news-date">
                    <?= $tanggal ?>
                </div>
            </div>
        </div>

        <div class="action-box">

            <a href="<?= base_url('berita/detail/' . $b['id_berita']) ?>" class="btn-icon btn-view">
                <i class="fas fa-eye"></i>
            </a>

            <a href="<?= base_url('admind/berita/edit/' . $b['id_berita']) ?>" class="btn-icon btn-edit">
                <i class="fas fa-pen"></i>
            </a>

            <button onclick="hapusBerita(<?= $b['id_berita'] ?>)" class="btn-icon btn-delete">
                <i class="fas fa-trash"></i>
            </button>

            <?php if($b['status_berita'] == 'draft'): ?>
                <button onclick="publishBerita(<?= $b['id_berita'] ?>)" class="btn-icon btn-publish">
                    <i class="fas fa-arrow-up"></i>
                </button>
            <?php endif; ?>

        </div>

    </div>
    <?php endforeach; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function hapusBerita(id){
    Swal.fire({
        title:'Hapus berita?',
        text:'Data akan dihapus permanen',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Ya',
        cancelButtonText:'Batal'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href = "<?= base_url('admind/berita/hapus/') ?>" + id;
        }
    });
}

function publishBerita(id){
    Swal.fire({
        title:'Unggah berita?',
        text:'Berita akan tampil di landing page',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Ya',
        cancelButtonText:'Batal'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href = "<?= base_url('admind/berita/publish/') ?>" + id;
        }
    });
}
</script>

<?= $this->endSection() ?>