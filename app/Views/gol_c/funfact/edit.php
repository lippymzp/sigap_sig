<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>
<?= $this->section('content') ?>

<?php $funfact = $funfact ?? []; ?>

<style>
.tab-box{display:flex;justify-content:center;gap:14px;margin-bottom:22px;}
.tab-btn{width:240px;height:40px;border-radius:8px;border:1px solid #d8d8d8;background:#fff;font-weight:600;}
.tab-active{background:#11c5d8;color:#fff;border:none;}

.form-wrap{background:#edf7f7;padding:30px;border-radius:18px;}

.form-head{padding-bottom:16px;margin-bottom:24px;border-bottom:1px solid #d9e3e3;}
.form-head h4{margin:0;font-weight:700;}

.form-control{
    border-radius:10px;
    border:1px solid #18bfd1;
    margin-bottom:18px;
}

.toolbar{
    background:#11c5d8;
    color:#fff;
    padding:8px 15px;
    border-radius:10px 10px 0 0;
}

.editor-box{
    width:100%;
    min-height:220px;
    max-height:400px;
    overflow-y:auto;
    border:1px solid #18bfd1;
    border-top:none;
    border-radius:0 0 10px 10px;
    padding:14px;
    margin-bottom:18px;
    background:#fff;
}

.editor-box *{line-height:1.6;}
.editor-box p{margin-bottom:10px;}
.editor-box h2{margin-bottom:10px;}

.side-card{
    background:#fff;
    border-radius:12px;
    padding:15px;
    margin-bottom:20px;
}

.upload-box{
    border:2px dashed #bbb;
    padding:35px;
    border-radius:10px;
    text-align:center;
}

.bottom-btn{
    margin-top:20px;
    display:flex;
    gap:12px;
}

.btn-main{
    background:#11c5d8;
    color:#fff;
    border:none;
    padding:12px 22px;
    border-radius:10px;
    font-weight:600;
}

.btn-cancel{
    background:#fff;
    border:none;
    padding:12px 22px;
    border-radius:10px;
}
</style>

<?php
$mode = $_GET['mode'] ?? '';
$isLink = ($mode == 'link');
?>

<!-- TAB -->
<div class="tab-box">

<button type="button"
class="tab-btn <?= !$isLink ? 'tab-active' : '' ?>"
onclick="window.location.href='<?= base_url('pneumonia/funfact/edit/'.$funfact['id_funfact'].'?mode=tulis') ?>'">
Tulis Funfact
</button>

<button type="button"
class="tab-btn <?= $isLink ? 'tab-active' : '' ?>"
onclick="window.location.href='<?= base_url('pneumonia/funfact/edit/'.$funfact['id_funfact'].'?mode=link') ?>'">
Kutip Funfact Luar
</button>

</div>

<form method="POST"
action="<?= base_url('pneumonia/funfact/update/'.$funfact['id_funfact']) ?>"
enctype="multipart/form-data">

<div class="form-wrap">
<?php if($isLink): ?>

<!-- MODE KUTIP -->

<div class="form-head">
<h4>Edit Informasi Funfact</h4>
<small>Perbarui data funfact SIG.</small>
</div>

<label class="fw-bold">Judul Funfact</label>
<input type="text" name="judul"
value="<?= esc($funfact['judul_funfact'] ?? '') ?>"
class="form-control">

<label class="fw-bold">Link Funfact</label>
<input type="text" name="isi"
value="<?= esc($funfact['url'] ?? '') ?>"
class="form-control"
placeholder="https://...">

<div class="bottom-btn">
<a href="<?= base_url('pneumonia/funfact') ?>" class="btn-cancel">Batal</a>
<button type="submit" class="btn-main">💾 Simpan Perubahan</button>
</div>

<?php else: ?>

<div class="row">


<!-- ================= KIRI ================= -->
<div class="col-md-8">

<div class="form-head">
<h4>Edit Informasi Funfact</h4>
<small>Perbarui data funfact SIG.</small>
</div>

<label class="fw-bold">Judul Funfact</label>
<input type="text" name="judul"
value="<?= esc($funfact['judul_funfact'] ?? '') ?>"
class="form-control">

<label class="fw-bold">Isi Funfact</label>

<div class="toolbar">
B &nbsp; I &nbsp; U &nbsp; ☰ &nbsp; 🔗 &nbsp; 🖼
</div>

<div id="editor" class="editor-box" contenteditable="true">
<?= $funfact['deskripsi_funfact'] ?? '' ?>
</div>

<input type="hidden" name="isi" id="isiHidden">

<label class="fw-bold">Ringkasan</label>
<input type="text"
name="ringkasan"
value="<?= esc(strip_tags($funfact['deskripsi_funfact'] ?? '')) ?>"
class="form-control">

<div class="row">

<div class="col-md-6">
<label class="fw-bold">Penulis</label>
<input type="text" class="form-control" value="Admin">
</div>

<div class="col-md-6">
<label class="fw-bold">Tanggal</label>
<input type="date" name="tanggal"
value="<?= esc($funfact['tanggal_funfact'] ?? '') ?>"
class="form-control">
</div>

</div>

<div class="bottom-btn">

<a href="<?= base_url('pneumonia/funfact') ?>" class="btn-cancel">
Batal
</a>

<button type="submit" class="btn-main">
💾 Simpan Perubahan
</button>

</div>
<?php endif; ?>
</div>
<!-- ================= END KIRI ================= -->


<!-- ================= KANAN ================= -->
 <?php if(!$isLink): ?>
<div class="col-md-4">

<div class="side-card">

<img id="previewThumb"
src="<?= base_url('uploads/funfact/'.($funfact['gambar_funfact'] ?? 'default.jpg')) ?>"
style="width:100%;height:190px;object-fit:cover;border-radius:10px;">

<p class="mt-3 fw-bold small mb-1">
Thumbnail Saat Ini
</p>

<small class="text-muted">
Gambar funfact yang tersimpan
</small>

</div>

<div class="side-card text-center">

<h6 class="fw-bold mb-3">
GANTI THUMBNAIL
</h6>

<label class="upload-box" for="gambarInput">

<div id="previewArea">
📤 <br><br>
Klik Untuk Ganti Gambar
</div>

</label>

<input type="file"
name="gambar"
id="gambarInput"
accept="image/*"
style="display:none;">

</div>

</div>
<?php endif; ?>
<!-- ================= END KANAN ================= -->

</div>
</div>
</form>

<script>
/* SIMPAN ISI EDITOR */
document.querySelector('form').onsubmit = function(){
    document.getElementById('isiHidden').value =
        document.getElementById('editor').innerHTML;
};

/* PREVIEW GAMBAR */
document.getElementById('gambarInput').onchange = function(e){
    let file = e.target.files[0];
    if(!file) return;

    let reader = new FileReader();
    reader.onload = function(ev){
        document.getElementById('previewThumb').src = ev.target.result;

        document.getElementById('previewArea').innerHTML =
        `<img src="${ev.target.result}"
        style="width:100%;height:160px;object-fit:cover;border-radius:12px;">`;
    }
    reader.readAsDataURL(file);
};
</script>

<?= $this->endSection() ?>