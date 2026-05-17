<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<style>
.form-card{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 4px 18px rgba(0,0,0,0.08);
}

.custom-input{
    border-radius:12px;
    padding:12px;
}

.preview-img{
    width:220px;
    border-radius:14px;
    margin-bottom:15px;
}

.btn-save{
    background:#12c7cf;
    color:white;
    border:none;
    padding:12px 30px;
    border-radius:12px;
    font-weight:700;
}
</style>

<div class="container-fluid">

    <h2 class="fw-bold mb-4">Edit Funfact</h2>

    <div class="form-card">

        <form action="<?= base_url('admind/funfact/update/'.$funfact['id_funfact']) ?>" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Judul Funfact</label>
                <input type="text"
                       name="judul_funfact"
                       class="form-control custom-input"
                       value="<?= esc($funfact['judul_funfact']) ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi_funfact"
                          class="form-control custom-input"
                          rows="3"
                          required><?= esc($funfact['deskripsi_funfact']) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Isi Lengkap Funfact</label>
                <textarea name="isi_funfact"
                          class="form-control custom-input"
                          rows="10"
                          required><?= esc($funfact['isi_funfact']) ?></textarea>
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                <img src="<?= base_url('uploads/funfact/'.$funfact['gambar_funfact']) ?>" class="preview-img">
            </div>

            <div class="mb-4">
                <label>Ganti Gambar (opsional)</label>
                <input type="file" name="gambar_funfact" class="form-control custom-input">
            </div>

            <button type="submit" class="btn-save">
                Update Funfact
            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>