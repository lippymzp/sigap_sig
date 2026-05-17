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

    <h2 class="fw-bold mb-4">Tambah Funfact</h2>

    <div class="form-card">

        <form action="<?= base_url('admind/funfact/simpan') ?>" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Judul Funfact</label>
                <input type="text" name="judul_funfact" class="form-control custom-input" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi_funfact" class="form-control custom-input" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label>Isi Lengkap Funfact</label>
                <textarea name="isi_funfact" class="form-control custom-input" rows="10" required></textarea>
            </div>

            <div class="mb-4">
                <label>Upload Gambar</label>
                <input type="file" name="gambar_funfact" class="form-control custom-input" required>
            </div>

            <div class="d-flex gap-3 mt-4">
    <button type="submit"
            name="status_funfact"
            value="publish"
            class="btn btn-info">
        Upload Funfact
    </button>

    <button type="submit"
            name="status_funfact"
            value="draft"
            class="btn btn-secondary">
        Simpan Draft
    </button>
</div>
        </form>

    </div>

</div>

<?= $this->endSection() ?>