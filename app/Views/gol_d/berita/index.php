<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
*{
    font-family:'Poppins',sans-serif;
}

.page-wrap{
    padding:20px;
    background:#f5f5f5;
    min-height:100vh;
}

.header-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.page-title{
    font-size:28px;
    font-weight:800;
    color:#1b1b1b;
}

.add-btn{
    background:#f7d348;
    color:#fff;
    padding:12px 24px;
    border-radius:10px;
    font-weight:600;
    text-decoration:none;
    box-shadow:0 4px 10px rgba(0,0,0,.12);
}

.search-box{
    background:#fff;
    border-radius:12px;
    padding:14px 20px;
    display:flex;
    align-items:center;
    gap:14px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    margin-bottom:20px;
}

.search-box input{
    border:none;
    outline:none;
    width:100%;
    font-size:15px;
}

.search-btn{
    background:none;
    border:none;
    font-size:20px;
    color:#888;
}

.overview-card{
    background:#14c8d0;
    border-radius:14px;
    padding:22px 30px;
    color:white;
    box-shadow:0 6px 16px rgba(0,0,0,.08);
    margin-bottom:20px;
}

.overview-title{
    font-size:32px;
    font-weight:800;
}

.overview-info{
    margin-top:8px;
    font-size:15px;
    opacity:.95;
}

.tabs-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.tabs{
    display:flex;
    gap:14px;
}

.tab-btn{
    padding:10px 35px;
    border-radius:10px;
    text-decoration:none;
    background:#efefef;
    color:#222;
    font-weight:600;
    box-shadow:0 3px 8px rgba(0,0,0,.08);
}

.tab-btn.active{
    background:#14c8d0;
    color:white;
}

.news-card{
    background:#eaf8f8;
    border-radius:14px;
    padding:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
    margin-bottom:18px;
}

.news-left{
    display:flex;
    gap:18px;
    align-items:center;
    flex:1;
}

.news-thumb{
    width:170px;
    height:95px;
    object-fit:cover;
    border-radius:12px;
}

.news-title{
    font-size:18px;
    font-weight:700;
    color:#1b1b1b;
    margin-bottom:8px;
}

.news-desc{
    color:#777;
    font-size:14px;
    line-height:1.5;
    max-width:650px;
}

.news-date{
    font-size:12px;
    color:#999;
    margin-top:8px;
}

.action-box{
    display:flex;
    gap:10px;
    align-items:center;
}

.icon-btn{
    width:44px;
    height:44px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    text-decoration:none;
    font-size:17px;
}

.view-btn{ background:#243bff; }
.edit-btn{ background:#f2e500; color:#222; }
.delete-btn{ background:#ff1f1f; }
.publish-btn{ background:#0096c7; }

.status-text{
    color:#14c8d0;
    font-weight:700;
    margin-left:12px;
}

.empty-box{
    background:white;
    padding:40px;
    border-radius:14px;
    text-align:center;
    color:#888;
}
</style>

<div class="page-wrap">

    <div class="header-row">
        <div class="page-title">Kelola Berita</div>

        <a href="<?= base_url('admind/berita/tambah') ?>" class="add-btn">
            Tambah Berita
        </a>
    </div>

    <form method="get" action="<?= base_url('admind/berita') ?>">
        <input type="hidden" name="tab" value="<?= $tab ?>">
        <div class="search-box">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>

            <input
                type="text"
                name="keyword"
                placeholder="Cari berita disini"
                value="<?= esc($keyword ?? '') ?>">
        </div>
    </form>

    <div class="overview-card">
        <div class="overview-title">
            <?= $totalPublish + $totalDraft ?> Berita Telah Dibuat
        </div>

        <div class="overview-info">
            ● <?= $totalPublish ?> Berita telah di unggah
            &nbsp;&nbsp;&nbsp;
            ● <?= $totalDraft ?> Berita di draft
        </div>
    </div>

    <div class="tabs-row">
        <div class="tabs">
            <a href="<?= base_url('admind/berita?tab=publish') ?>"
               class="tab-btn <?= $tab == 'publish' ? 'active' : '' ?>">
                Terunggah
            </a>

            <a href="<?= base_url('admind/berita?tab=draft') ?>"
               class="tab-btn <?= $tab == 'draft' ? 'active' : '' ?>">
                Draft
            </a>
        </div>
    </div>

    <?php if(empty($berita)): ?>
        <div class="empty-box">
            Tidak ada berita ditemukan
        </div>
    <?php endif; ?>

    <?php foreach($berita as $b): ?>

    <?php
        $gambar = !empty($b['gambar_berita'])
            ? base_url('uploads/berita/' . $b['gambar_berita'])
            : base_url('img/no-image.png');
    ?>

    <div class="news-card">

        <div class="news-left">
            <img src="<?= $gambar ?>" class="news-thumb">

            <div>
                <div class="news-title">
                    <?= esc($b['judul_berita']) ?>
                </div>

                <div class="news-desc">
                    <?= word_limiter(strip_tags($b['deskripsi_berita']), 18) ?>
                </div>

                <div class="news-date">
                    <?= date('d M Y', strtotime($b['tanggal_berita'])) ?>
                </div>
            </div>
        </div>

        <div class="action-box">

            <a href="<?= base_url('admind/berita/detail/'.$b['id_berita']) ?>"
   class="icon-btn view-btn">
    🔍
</a>

            <a href="<?= base_url('admind/berita/edit/' . $b['id_berita']) ?>" class="icon-btn edit-btn">
                <i class="fas fa-pen"></i>
            </a>

            <button onclick="hapusBerita(<?= $b['id_berita'] ?>)" class="icon-btn delete-btn border-0">
                <i class="fas fa-trash"></i>
            </button>

            <?php if($b['status_berita'] == 'draft'): ?>
                <button onclick="publishBerita(<?= $b['id_berita'] ?>)" class="icon-btn publish-btn border-0">
                    <i class="fas fa-arrow-down"></i>
                </button>
            <?php else: ?>
                <span class="status-text">Telah Diunggah</span>
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
        text:'Berita akan dipublish',
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