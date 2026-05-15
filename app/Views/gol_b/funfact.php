<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<style>
.popup-overlay{
position:fixed;
top:0;left:0;
width:100%;height:100%;
background:rgba(0,0,0,0.4);
display:flex;
justify-content:center;
align-items:center;
z-index:9999;
}

.popup-box{
background:#fff;
padding:25px;
border-radius:16px;
width:320px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.icon{
width:60px;height:60px;
border-radius:50%;
margin:auto;
display:flex;
align-items:center;
justify-content:center;
margin-bottom:10px;
font-size:22px;
}

.success{background:#d4f5e9;color:#16a34a;}
.error{background:#ffe5e5;color:#dc2626;}

.btn-main{
display:block;
background:#20c4cc;
color:#fff;
padding:10px;
border-radius:8px;
margin-top:10px;
text-decoration:none;
font-weight:600;
}

.btn-second{
background:#eee;
border:none;
padding:8px;
border-radius:8px;
margin-top:8px;
width:100%;
}
</style>

<?php
$total   = $total ?? 0;
$publish = $publish ?? 0;
$draft   = $draft ?? 0;
$arsip   = $arsip ?? 0;
$status  = $status ?? 'Publish';
$funfact  = $funfact ?? [];
?>

<div class="card border-0 shadow-sm p-4 rounded-4">

<!-- SEARCH -->
<input type="text"
class="form-control mb-3"
placeholder="Cari funfact disini"
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

<div style="height:1px;background:#ececec;margin-bottom:18px;"></div>

<!-- HEADER -->
<div class="p-4 text-center text-white rounded-4 mb-4"
style="background:#17c3cf;box-shadow:0 6px 14px rgba(0,0,0,0.10);">

<h1 class="fw-bold">
<?= $total ?> Funfact Telah Dibuat
</h1>

<small>
• <?= $publish ?> Funfact telah di unggah
&nbsp;&nbsp;
• <?= $draft ?> Funfact di draft
</small>

</div>

<!-- FILTER -->
<div class="d-flex justify-content-between mb-4">

<div>

<a href="<?= base_url('tbc/funfact?status=Publish') ?>"
class="btn px-4 <?= (!isset($_GET['status']) || $_GET['status']=='Publish') ? 'text-white' : 'btn-light' ?>"
style="<?= (!isset($_GET['status']) || $_GET['status']=='Publish')
? 'background:#17c3cf; box-shadow:0 3px 8px rgba(0,0,0,0.08);'
: 'box-shadow:0 3px 8px rgba(0,0,0,0.08);' ?>">
Terunggah
</a>

<a href="<?= base_url('tbc/funfact?status=Draft') ?>"
class="btn px-4 <?= (isset($_GET['status']) && $_GET['status']=='Draft') ? 'text-white' : 'btn-light' ?>"
style="<?= (isset($_GET['status']) && $_GET['status']=='Draft')
? 'background:#17c3cf; box-shadow:0 3px 8px rgba(0,0,0,0.08);'
: 'box-shadow:0 3px 8px rgba(0,0,0,0.08);' ?>">
Draft
</a>

</div>

<a href="<?= base_url('tbc/funfact/create') ?>"
class="btn btn-warning fw-bold"
style="box-shadow:0 4px 10px rgba(0,0,0,0.10);">
Tambah Funfact
</a>

</div>

<!-- DATA -->
<?php if(!empty($funfact)): ?>
<?php foreach($funfact as $row): ?>

<div class="card border-0 shadow-sm rounded-4 px-3 py-3 mb-3"
style="background:#eef8f8;">

<div class="row align-items-center">

<!-- FOTO -->
<div class="col-md-2">
<img src="<?= base_url('uploads/funfact/' . ($row['gambar_funfact'] ?: 'default.jpg')) ?>"
style="width:120px;height:85px;object-fit:cover;border-radius:16px;">
</div>

<!-- ISI -->
<div class="col-md-7">

<h5 class="fw-bold mb-1" style="font-size:17px;">
<?= $row['judul_funfact'] ?>
</h5>

<p class="text-muted mb-2" style="font-size:12px;">
<?= esc(substr(strip_tags((string)($row['deskripsi_funfact'] ?? '')), 0, 120)) ?>...
</p>

<small style="font-size:11px;color:#9c9c9c;">
<?= date('d M Y', strtotime($row['tanggal_funfact'])) ?>
</small>

</div>

<!-- ✅ PINDAH KE SINI (KANAN) -->
<div class="col-md-3 d-flex flex-column justify-content-center"
style="align-items:flex-end; padding-right:15px;">

<!-- ICON (HARUS ROW) -->
<div style="
display:flex;
flex-direction:row;
gap:6px;
margin-bottom:8px;
justify-content:flex-end;
width:100%;
">

<a href="<?= base_url('tbc/funfact/detail/'.$row['id_funfact']) ?>"
class="btn btn-sm text-white"
style="width:34px;height:34px;background:#2457ff;border-radius:6px;display:flex;align-items:center;justify-content:center;">
<img src="<?= base_url('assets/icon/lihat.png') ?>" width="16">
</a>

<a href="<?= base_url('tbc/funfact/edit/'.$row['id_funfact']) ?>"
class="btn btn-sm"
style="width:34px;height:34px;background:#f7c400;border-radius:6px;display:flex;align-items:center;justify-content:center;">
<img src="<?= base_url('assets/icon/edit.png') ?>" width="16">
</a>

<button type="button"
onclick="hapusFunfact(<?= $row['id_funfact'] ?>)"
class="btn btn-sm text-white"
style="width:34px;height:34px;background:#ef3e4a;border-radius:6px;display:flex;align-items:center;justify-content:center;">
<img src="<?= base_url('assets/icon/hapus.png') ?>" width="16">
</button>

<?php if($row['status_funfact']=='Draft'): ?>
<button type="button"
onclick="publishFunfact(<?= $row['id_funfact'] ?>)"
class="btn btn-sm text-white"
style="width:34px;height:34px;background:#12bfe0;border-radius:6px;display:flex;align-items:center;justify-content:center;">
<img src="<?= base_url('assets/icon/upload.png') ?>" width="16">
</button>
<?php else: ?>
<button type="button"
onclick="draftFunfact(<?= $row['id_funfact'] ?>)"
class="btn btn-sm text-white"
style="width:34px;height:34px;background:#12bfe0;border-radius:6px;display:flex;align-items:center;justify-content:center;">
<img src="<?= base_url('assets/icon/arsip.png') ?>" width="16">
</button>
<?php endif; ?>

</div>

<!-- STATUS -->
<div style="
font-size:12px;
font-weight:600;
color:#17c3cf;
text-align:right;
width:100%;
">
<?= ($row['status_funfact']=='Draft')
? 'Tersimpan di Draft'
: 'Sudah Terunggah' ?>
</div>

</div>

</div>

</div>

<?php endforeach; ?>
<?php else: ?>

<div class="text-center py-5">
<h3>Belum ada funfact</h3>
</div>

<?php endif; ?>

</div>

<!-- SCRIPT -->
<script>
function hapusFunfact(id){
    document.getElementById('popupHapus').style.display='flex';
    document.getElementById('btnYaHapus').href =
    '<?= base_url('tbc/funfact/hapus/') ?>'+id;
}

function draftFunfact(id){
    document.getElementById('popupDraft').style.display='flex';
    document.getElementById('btnYaDraft').href =
    '<?= base_url('tbc/funfact/arsip/') ?>'+id;
}

function publishFunfact(id){
    document.getElementById('popupPublish').style.display='flex';
    document.getElementById('btnYaPublish').href =
    '<?= base_url('tbc/funfact/publish/') ?>'+id;
}

function tutupPopupPublish(){
    document.getElementById('popupPublish').style.display='none';
}
</script>
</script>
<div id="popupHapus" style="
display:none;
position:fixed;
top:0;left:0;width:100%;height:100%;
background:rgba(0,0,0,0.35);
display:none;
justify-content:center;
align-items:center;
z-index:999;
">

<div style="
background:#fff;
padding:30px 25px;
border-radius:18px;
width:320px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,0.15);
">

<!-- ICON -->
<div style="
width:55px;
height:55px;
background:#ffe5e5;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
margin:0 auto 15px;
">
<img src="<?= base_url('assets/icon/hapus.png') ?>" width="24">
</div>

<h5 style="font-weight:700;margin-bottom:8px;">
Hapus Funfact
</h5>

<p style="font-size:14px;color:#777;line-height:1.5;">
Apakah Anda yakin ingin menghapus funfact ini?
</p>

<div style="margin-top:20px;">

<a id="btnYaHapus" href="#"
style="
display:block;
background:#17c3cf;
color:#fff;
padding:10px;
border-radius:8px;
text-decoration:none;
font-weight:600;
margin-bottom:8px;
">
Ya
</a>

<button onclick="document.getElementById('popupHapus').style.display='none'"
style="
background:#f1f1f1;
border:none;
width:100%;
padding:10px;
border-radius:8px;
font-weight:500;
">
Tidak
</button>

</div>

</div>
</div>
<div id="popupDraft" style="
display:none;
position:fixed;
top:0;left:0;width:100%;height:100%;
background:rgba(0,0,0,0.35);
justify-content:center;
align-items:center;
z-index:999;
">

<div style="
background:#fff;
padding:30px 25px;
border-radius:18px;
width:320px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,0.15);
">

<!-- ICON -->
<div style="
width:55px;
height:55px;
background:#dff6fa;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
margin:0 auto 15px;
">
<img src="<?= base_url('assets/icon/upload.png') ?>" width="22">
</div>

<h5 style="font-weight:700;margin-bottom:8px;">
Arsipkan
</h5>

<p style="font-size:14px;color:#777;line-height:1.5;">
Apakah Anda yakin ingin mengarsipkan funfact?
</p>

<div style="margin-top:20px;">

<a id="btnYaDraft" href="#"
style="
display:block;
background:#17c3cf;
color:#fff;
padding:10px;
border-radius:8px;
text-decoration:none;
font-weight:600;
margin-bottom:8px;
">
Ya
</a>

<button onclick="document.getElementById('popupDraft').style.display='none'"
style="
background:#f1f1f1;
border:none;
width:100%;
padding:10px;
border-radius:8px;
font-weight:500;
">
Tidak
</button>

</div>

</div>
</div>

<div id="popupPublish" style="
display:none;
position:fixed;
top:0;left:0;
width:100%;height:100%;
background:rgba(0,0,0,0.4);
justify-content:center;
align-items:center;
z-index:9999;
">

<div style="
background:#fff;
padding:30px;
border-radius:16px;
width:320px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
">

<div style="
width:60px;height:60px;
margin:auto;
border-radius:50%;
background:#e6f7fb;
display:flex;
align-items:center;
justify-content:center;
font-size:22px;
margin-bottom:12px;
">
⬆️
</div>

<h5 style="margin-bottom:10px;">Unggah Funfact</h5>

<p style="color:#666;font-size:14px;">
Apakah Anda yakin ingin mengunggah funfact ini?
</p>

<div style="display:flex;gap:10px;margin-top:15px;">
<a id="btnYaPublish"
class="btn"
style="flex:1;background:#11c5d8;color:#fff;border-radius:8px;">
Ya
</a>

<button onclick="tutupPopupPublish()"
class="btn"
style="flex:1;background:#eee;border-radius:8px;">
Tidak
</button>
</div>

</div>
</div>
<?php if(session()->getFlashdata('success') == 'unggah'): ?>

<div class="popup-overlay">
<div class="popup-box">

<div class="icon success">✔</div>

<h5>Unggah Funfact Berhasil</h5>
<p>Funfact berhasil diunggah</p>

<a href="<?= base_url('tbc/funfact/detail/'.session()->getFlashdata('last_id')) ?>" class="btn-main">
Lihat Tampilan
</a>

<button onclick="this.closest('.popup-overlay').remove()" class="btn-second">
Selesai
</button>

</div>
</div>

<?php endif; ?>
<?php if(session()->getFlashdata('error') == 'gagal'): ?>

<div class="popup-overlay">
<div class="popup-box">

<div class="icon error">✖</div>

<h5>Unggah Funfact Gagal</h5>
<p>Mohon lengkapi semua data</p>

<a href="<?= base_url('tbc/funfact/create') ?>" class="btn-main">
Lengkapi Data
</a>

</div>
</div>

<?php endif; ?>

<?= $this->endSection() ?>