<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="card border-0 shadow-sm p-4 rounded-4">

<!-- SEARCH -->
<input type="text"
class="form-control mb-3"
placeholder="Cari berita disini"

style="
height:46px;
border:none;
outline:none;
border-radius:8px;
box-shadow:0 2px 8px rgba(0,0,0,0.08);
padding-left:15px;
font-size:15px;
background:#fff;
margin-bottom:18px;
">

<!-- GARIS PEMBATAS -->
<div style="
height:1px;
background:#ececec;
margin-bottom:18px;
"></div>

<!-- HEADER -->
<div class="p-4 text-center text-white rounded-4 mb-4"
style="
background:#17c3cf;
box-shadow:0 6px 14px rgba(0,0,0,0.10);
">

<h1 class="fw-bold">
<?= $total ?> Berita Telah Dibuat
</h1>

<small>
• <?= $publish ?> Berita telah di unggah
&nbsp;&nbsp;
• <?= $draft ?> Berita di draft
</small>

</div>

<!-- FILTER -->
<div class="d-flex justify-content-between mb-4">

<div>

<a href="<?= base_url('tbc/berita?status=Publish') ?>"
class="btn px-4 <?= (!isset($_GET['status']) || $_GET['status']=='Publish') ? 'text-white' : 'btn-light' ?>"
style="<?= (!isset($_GET['status']) || $_GET['status']=='Publish')
? 'background:#17c3cf; box-shadow:0 3px 8px rgba(0,0,0,0.08);'
: 'box-shadow:0 3px 8px rgba(0,0,0,0.08);' ?>">
Terunggah
</a>

<a href="<?= base_url('tbc/berita?status=Draft') ?>"
class="btn px-4 <?= (isset($_GET['status']) && $_GET['status']=='Draft') ? 'text-white' : 'btn-light' ?>"
style="<?= (isset($_GET['status']) && $_GET['status']=='Draft')
? 'background:#17c3cf; box-shadow:0 3px 8px rgba(0,0,0,0.08);'
: 'box-shadow:0 3px 8px rgba(0,0,0,0.08);' ?>">
Draft
</a>

</div>

<a href="<?= base_url('tbc/berita/create') ?>"
class="btn btn-warning fw-bold"
style="box-shadow:0 4px 10px rgba(0,0,0,0.10);">
Tambah Berita
</a>

</div>

<!-- DATA -->
<?php if(!empty($berita)): ?>
<?php foreach($berita as $row): ?>

<div class="card border-0 shadow-sm rounded-4 px-3 py-3 mb-3"
style="background:#eef8f8;">

<div class="row align-items-center">

<!-- FOTO -->
<div class="col-md-2">

<img src="<?= base_url('uploads/berita/' . ($row['gambar_berita'] ?: 'default.jpg')) ?>"
style="
width:120px;
height:85px;
object-fit:cover;
border-radius:16px;
box-shadow:0 2px 6px rgba(0,0,0,.08);
">

</div>

<!-- ISI -->
<div class="col-md-7">

<h5 class="fw-bold mb-1" style="font-size:17px;">
<?= $row['judul_berita'] ?>
</h5>

<p class="text-muted mb-2"
style="font-size:12px; line-height:1.5; color:#7b7b7b;">

<?= substr(strip_tags($row['deskripsi_berita']),0,140) ?>...

</p>

<small style="font-size:11px;color:#9c9c9c;">
<?= date('d M Y', strtotime($row['tanggal_berita'])) ?>
</small>

</div>

<!-- TOMBOL -->
<div class="col-md-3 d-flex flex-column align-items-end justify-content-center">

<div style="
display:flex;
gap:6px;
margin-bottom:8px;
">

<a href="<?= base_url('tbc/berita/detail/'.$row['id_berita']) ?>"
class="btn btn-sm text-white"
style="
width:34px;
height:34px;
background:#2457ff;
border:none;
border-radius:6px;
display:flex;
align-items:center;
justify-content:center;
">
<img src="<?= base_url('assets/icon/lihat.png') ?>" width="16">
</a>

<a href="<?= base_url('tbc/berita/edit/'.$row['id_berita']) ?>"
class="btn btn-sm"
style="
width:34px;
height:34px;
background:#f7c400;
border:none;
border-radius:6px;
display:flex;
align-items:center;
justify-content:center;
">
<img src="<?= base_url('assets/icon/edit.png') ?>" width="16">
</a>

<!-- HAPUS -->
<button type="button"
onclick="hapusBerita(<?= $row['id_berita'] ?>)"
class="btn btn-sm text-white"
style="
width:34px;
height:34px;
background:#ef3e4a;
border:none;
border-radius:6px;
display:flex;
align-items:center;
justify-content:center;
">
<img src="<?= base_url('assets/icon/hapus.png') ?>" width="16">
</button>

<!-- DRAFT / PUBLISH -->
<?php if($row['status_berita']=='Draft'): ?>

<a href="<?= base_url('tbc/berita/publish/'.$row['id_berita']) ?>"
class="btn btn-sm text-white"
style="
width:34px;
height:34px;
background:#12bfe0;
border:none;
border-radius:6px;
display:flex;
align-items:center;
justify-content:center;
">
<img src="<?= base_url('assets/icon/upload.png') ?>" width="16">
</a>

<?php else: ?>

<button type="button"
onclick="draftBerita(<?= $row['id_berita'] ?>)"
class="btn btn-sm text-white"
style="
width:34px;
height:34px;
background:#12bfe0;
border:none;
border-radius:6px;
display:flex;
align-items:center;
justify-content:center;
">
<img src="<?= base_url('assets/icon/arsip.png') ?>" width="16">
</button>

<?php endif; ?>
</div>

<div style="
font-size:12px;
font-weight:600;
color:#17c3cf;
line-height:1;
">

<?= ($row['status_berita']=='Draft')
? 'Tersimpan di Draft'
: 'Sudah Terunggah' ?>

</div>

</div>

</div>
</div>

<?php endforeach; ?>
<?php else: ?>

<div class="text-center py-5">
<h3>Belum ada berita</h3>
</div>

<?php endif; ?>

</div>

<!-- POPUP HAPUS -->
<div id="popupHapus" style="
display:none;
position:fixed;
top:0;left:0;
width:100%;
height:100%;
background:rgba(0,0,0,.25);
z-index:9999;">

<div style="
width:320px;
background:#fff;
border-radius:10px;
padding:25px;
text-align:center;
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
box-shadow:0 10px 20px rgba(0,0,0,.15);">

<div style="
width:45px;
height:45px;
margin:auto;
background:#ff4d4d;
color:#fff;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:22px;">
🗑
</div>

<h5 class="mt-3 fw-bold">Hapus Berita</h5>

<p class="text-muted small">
Apakah Anda yakin ingin menghapus berita ini?
</p>

<a id="btnYaHapus"
class="btn w-100 text-white mb-2"
style="background:#17c3cf;">
Ya
</a>

<button onclick="tutupPopupHapus()"
class="btn btn-light w-100">
Tidak
</button>

</div>
</div>



<!-- POPUP DRAFT -->
<div id="popupDraft" style="
display:none;
position:fixed;
top:0;left:0;
width:100%;
height:100%;
background:rgba(0,0,0,.25);
z-index:9999;">

<div style="
width:320px;
background:#fff;
border-radius:10px;
padding:25px;
text-align:center;
position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
box-shadow:0 10px 20px rgba(0,0,0,.15);">

<div style="
width:45px;
height:45px;
margin:auto;
background:#0aa7c7;
color:#fff;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:22px;">
📥
</div>

<h5 class="mt-3 fw-bold">Simpan ke Draft</h5>

<p class="text-muted small">
Apakah Anda yakin ingin memindahkan berita ke Draft?
</p>

<a id="btnYaDraft"
class="btn w-100 text-white mb-2"
style="background:#17c3cf;">
Ya
</a>

<button onclick="tutupPopupDraft()"
class="btn btn-light w-100">
Tidak
</button>

</div>
</div>



<script>
function hapusBerita(id){
document.getElementById('popupHapus').style.display='block';
document.getElementById('btnYaHapus').href =
'<?= base_url('tbc/berita/hapus/') ?>'+id;
}

function tutupPopupHapus(){
document.getElementById('popupHapus').style.display='none';
}



function draftBerita(id){
document.getElementById('popupDraft').style.display='block';
document.getElementById('btnYaDraft').href =
'<?= base_url('tbc/berita/arsip/') ?>'+id;
}

function tutupPopupDraft(){
document.getElementById('popupDraft').style.display='none';
}
</script>

<?= $this->endSection() ?>