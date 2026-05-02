<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<?php /** @var array $berita */ ?>
<?php $berita = $berita ?? []; ?>

<?php
$mode = $_GET['mode'] ?? '';

$url = trim((string)($berita['url_berita'] ?? ''));
$isLink = false;

if ($mode == 'link') {
    $isLink = true;
} elseif ($mode == 'tulis') {
    $isLink = false;
} elseif ($url !== '' && filter_var($url, FILTER_VALIDATE_URL)) {
    $isLink = true;
}
?>

<style>
.tab-box{
    display:flex;
    justify-content:center;
    gap:14px;
    margin-bottom:22px;
}
.tab-btn{
    width:240px;
    height:40px;
    border-radius:8px;
    border:1px solid #d8d8d8;
    background:#fff;
    font-weight:600;
    cursor:pointer;
}
.tab-active{
    background:#11c5d8;
    color:#fff;
    border:none;
}
.form-wrap{
    background:#edf7f7;
    padding:30px;
    border-radius:18px;
}
.form-head{
    padding-bottom:16px;
    margin-bottom:24px;
    border-bottom:1px solid #d9e3e3;
}
.form-head h4{
    margin:0;
    font-weight:700;
}
.form-head small{
    color:#777;
}
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
.editor-box {
    width:100%;
    height:220px;
    border:1px solid #18bfd1;
    border-top:none;
    border-radius:0 0 10px 10px;
    padding:14px;
    background:#fff;
    overflow-y:auto;
}

.editor-box * {
    margin:0 !important;
}
.side-card{
    background:#fff;
    border-radius:12px;
    padding:15px;
    margin-bottom:20px;
}
.bottom-btn{
    margin-top:20px;
    display:flex;
    gap:12px;
    flex-wrap:wrap;
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
.upload-box{
    border:2px dashed #bbb;
    padding:35px;
    border-radius:10px;
    text-align:center;
}
</style>

<!-- TAB -->
<div class="tab-box">

<button type="button"
class="tab-btn <?= !$isLink ? 'tab-active' : '' ?>"
onclick="window.location.href='<?= base_url('tbc/berita/edit/'.$berita['id_berita'].'?mode=tulis') ?>'">
Tulis Berita
</button>

<button type="button"
class="tab-btn <?= $isLink ? 'tab-active' : '' ?>"
onclick="window.location.href='<?= base_url('tbc/berita/edit/'.$berita['id_berita'].'?mode=link') ?>'">
Kutip Berita Luar
</button>

</div>

<form action="<?= base_url('tbc/berita/update/' . $berita['id_berita']) ?>"
method="post"
enctype="multipart/form-data">

<div class="form-wrap">

<?php if ($isLink): ?>

<!-- MODE LINK -->
<div class="form-head">
<h4>Detail Informasi Berita</h4>
<small>Lengkapi data berita SIG untuk dipublikasikan.</small>
</div>

<label class="fw-bold">Judul Berita</label>
<input type="text"
name="judul"
class="form-control"
value="<?= esc((string)($berita['judul_berita'] ?? '')) ?>">

<label class="fw-bold">Link Berita</label>
<input type="text"
name="isi"
class="form-control"
value="<?= filter_var($url, FILTER_VALIDATE_URL) ? esc($url) : '' ?>">

<div class="bottom-btn">

<a href="<?= base_url('tbc/berita') ?>"
class="btn-cancel">
Batal
</a>

<button type="submit"
class="btn-main">
💾 Simpan Perubahan
</button>

</div>

<?php else: ?>

<!-- MODE TULIS -->
<div class="row">

<!-- KIRI -->
<div class="col-md-8">

<div class="form-head">
<h4>Edit Informasi Berita</h4>
<small>Perbarui data berita SIG.</small>
</div>

<label class="fw-bold">Judul Berita</label>
<input type="text"
name="judul"
class="form-control"
value="<?= esc((string)($berita['judul_berita'] ?? '')) ?>">

<label class="fw-bold">Isi Berita</label>

<div class="toolbar">
B &nbsp; I &nbsp; U &nbsp; ☰ &nbsp; 🔗 &nbsp; 🖼
</div>

<div id="editor"
class="editor-box"
contenteditable="true"><?= $berita['isi_berita'] ?? $berita['deskripsi_berita'] ?? '' ?></div>

<input type="hidden" name="isi" id="isiHidden">

<label class="fw-bold">Ringkasan</label>
<input type="text"
name="ringkasan"
class="form-control"
value="<?= esc(strip_tags((string)($berita['deskripsi_berita'] ?? ''))) ?>">

<!-- 🔥 FIX: TAMBAH ROW -->
<div class="row">

<div class="col-md-6">
<label class="fw-bold">Penulis</label>
<input type="text"
name="penulis"
class="form-control"
value="<?= esc((string)($berita['penulis'] ?? 'Admin')) ?>">
</div>

<div class="col-md-6">
<label class="fw-bold">Tanggal</label>
<input type="date"
name="tanggal"
class="form-control"
value="<?= esc((string)($berita['tanggal_berita'] ?? '')) ?>">
</div>

</div>
<!-- 🔥 END FIX -->

<div class="bottom-btn">

<a href="<?= base_url('tbc/berita') ?>"
class="btn-cancel">
Batal
</a>

<button type="submit"
class="btn-main">
💾 Simpan Perubahan
</button>

</div>

</div>

<!-- KANAN -->
<div class="col-md-4">

<div class="side-card">

<img id="previewThumb"
src="<?= base_url('uploads/berita/' . (!empty($berita['gambar_berita']) ? $berita['gambar_berita'] : 'default.jpg')) ?>"
style="width:100%;height:190px;object-fit:cover;border-radius:10px;">

<p class="mt-3 fw-bold small mb-1">
Thumbnail Saat Ini
</p>

<small class="text-muted">
Gambar berita yang tersimpan
</small>

</div>

<div class="side-card text-center">

<h6 class="fw-bold mb-3">
GANTI THUMBNAIL
</h6>

<label class="upload-box"
for="gambarInput"
style="cursor:pointer;">

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

</div>

<?php endif; ?>

</div>
</form>

<script>
    document.querySelector('form').onsubmit = function(){
    document.getElementById('isiHidden').value =
    document.getElementById('editor').innerHTML;
}
const gambarInput = document.getElementById('gambarInput');

if(gambarInput){
    gambarInput.onchange = function(e){

        let file = e.target.files[0];
        if(!file) return;

        let reader = new FileReader();

        reader.onload = function(ev){

            document.getElementById('previewThumb').src = ev.target.result;

            document.getElementById('previewArea').innerHTML =
            `<img src="${ev.target.result}" style="width:100%;height:160px;object-fit:cover;border-radius:12px;">`;

        }

        reader.readAsDataURL(file);
    }
}
</script>

<?= $this->endSection() ?>