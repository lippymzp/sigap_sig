<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<style>

.card-edit{
    border-radius:15px;
    padding:35px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
    background:white;
}

.preview-logo{
    width:140px;
    border-radius:10px;
    margin-bottom:10px;
}

</style>


<div class="container-fluid">

<div class="card-edit">

<h4 class="mb-4 fw-bold">Edit Profil Sistem</h4>

<form action="<?= base_url('profil_sistem/update') ?>"
method="post"
enctype="multipart/form-data">

<?= csrf_field() ?>

<input type="hidden"
name="id"
value="<?= $profil['id_profil_sistem'] ?? '' ?>">

<div class="row">

<!-- ================= KIRI ================= -->
<div class="col-md-8">

<!-- NAMA SISTEM -->
<div class="mb-3">
<label class="form-label">Nama Sistem</label>
<input type="text"
name="nama_sistem"
class="form-control"
required
value="<?= $profil['nama_sistem'] ?? '' ?>">
</div>

<!-- ALAMAT -->
<div class="mb-3">
<label class="form-label">Alamat</label>
<textarea name="alamat"
class="form-control"
rows="4"
required><?= $profil['alamat'] ?? '' ?></textarea>
</div>

<!-- EMAIL -->
<div class="mb-3">
<label class="form-label">Email</label>
<input type="email"
name="email"
class="form-control"
value="<?= $profil['email'] ?? '' ?>">
</div>

<!-- INSTAGRAM -->
<div class="mb-3">
<label class="form-label">Instagram</label>
<input type="text"
name="instagram"
class="form-control"
placeholder="@username"
value="<?= $profil['instagram'] ?? '' ?>">
</div>

</div>


<!-- ================= KANAN ================= -->
<div class="col-md-4 text-center">

<label class="form-label fw-bold">
Logo Sistem
</label>

<br>

<?php if(!empty($profil['logo'])) : ?>

<img src="<?= base_url('uploads/logo/'.$profil['logo']) ?>"
class="preview-logo"
id="previewLogo">

<?php else : ?>

<img src="<?= base_url('img/logo_default.png') ?>"
class="preview-logo"
id="previewLogo">

<?php endif; ?>


<input type="file"
name="logo"
class="form-control mt-2"
accept="image/*"
onchange="previewImage(event)">

<small class="text-muted">
Format: JPG / PNG
</small>

</div>

</div>

<hr>

<div class="d-flex gap-2">

<button class="btn btn-success px-4">
<i class="fa fa-save"></i> Simpan Perubahan
</button>

<a href="<?= base_url('profil_sistem') ?>"
class="btn btn-secondary">
Kembali
</a>

</div>

</form>

</div>
</div>


<!-- ================= PREVIEW IMAGE ================= -->
<script>
function previewImage(event){
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewLogo').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?= $this->endSection() ?>