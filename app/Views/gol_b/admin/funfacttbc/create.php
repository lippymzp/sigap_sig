<?= $this->extend('layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="header-card mb-4 d-flex align-items-center">

    <!-- ICON BOX -->
    <div class="me-3"
         style="width:65px; height:65px;
                background: rgba(255,255,255,0.15);
                border-radius:18px;
                display:flex;
                align-items:center;
                justify-content:center;">

        <i class="bi bi-shield-plus text-white" style="font-size:30px;"></i>
    </div>

    <!-- TEXT -->
    <div>
        <h4 class="mb-1">Artikel</h4>
        <small>Input data artikel</small>
    </div>

</div>

<div class="card p-4 shadow-sm border-0">

<form action="<?= base_url('admin/artikel/simpan') ?>" 
      method="post"
      enctype="multipart/form-data">

<div class="row">

<div class="col-md-8">
    <label class="form-label">Judul Artikel</label>
    <input type="text" 
       name="judul_artikel"
       value="<?= old('judul_artikel') ?>"
       class="form-control">

    <label class="form-label">Gambar Artikel</label>
    <input type="file" name="gambar_artikel" class="form-control mb-3">

    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi_artikel"
            id="deskripsi"
            class="form-control"><?= old('deskripsi_artikel') ?></textarea>
</div>

<div class="col-md-4">
    <label class="form-label">Tanggal Dibuat</label>
    <input type="date" name="tanggal_artikel" class="form-control mb-3">

    <label class="form-label">Status Artikel</label>
        <select name="status_artikel" class="form-select">
            <option value="">Pilih Status</option>
            <option value="Publish">Publish</option>
            <option value="Unpublish">Unpublish</option>
        </select>
</div>

</div>

<div class="text-end mt-4">
    <a href="<?= base_url('admin/artikel') ?>" class="btn btn-secondary me-2">
        Kembali
    </a>
    <button class="btn btn-primary">Simpan</button>
</div>

</form>
</div>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('deskripsi');
</script>

<?= $this->endSection() ?>