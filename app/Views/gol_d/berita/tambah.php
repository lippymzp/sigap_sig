<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-4">

    <h1 class="fw-bold mb-4">Unggah Berita</h1>

    <div class="card shadow border-0 rounded-4 p-4">

        <form action="<?= base_url('admind/berita/simpan') ?>" 
              method="post" 
              enctype="multipart/form-data">

            <div class="mb-3">
                <label class="fw-semibold">Judul Berita</label>
                <input type="text" name="judul_berita" class="form-control">
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Isi Berita</label>
                <textarea name="isi_berita" rows="8" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Thumbnail</label>
                <input type="file" name="gambar_berita" class="form-control">
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Ringkasan</label>
                <textarea name="deskripsi_berita" rows="3" class="form-control"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Penulis</label>
                    <input type="text" name="penulis" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_berita" class="form-control">
                </div>
            </div>

            <button type="submit"
            name="action"
            value="draft"
            class="btn btn-secondary">
        Simpan Draft
    </button>

    <button type="submit"
            name="action"
            value="publish"
            class="btn btn-info">
        Unggah
    </button>

</form>

    </div>

</div>

<?= $this->endSection() ?>