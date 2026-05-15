<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<div class="container-fluid p-4">

    <h1 class="fw-bold mb-4">Edit Berita</h1>

    <div class="card shadow border-0 rounded-4 p-4">

        <form action="<?= base_url('admind/berita/update/' . $berita['id_berita']) ?>" 
              method="post" 
              enctype="multipart/form-data">

            <input type="hidden" 
                   name="gambar_lama" 
                   value="<?= $berita['gambar_berita'] ?>">

            <div class="mb-3">
                <label>Judul Berita</label>
                <input type="text"
                       name="judul_berita"
                       class="form-control"
                       value="<?= $berita['judul_berita'] ?>">
            </div>

            <div class="mb-3">
                <label>Isi Berita</label>
                <textarea name="isi_berita"
                          rows="8"
                          class="form-control"><?= $berita['isi_berita'] ?></textarea>
            </div>

            <div class="mb-3">
                <label>Thumbnail Baru</label>
                <input type="file" 
                       name="gambar_berita" 
                       class="form-control">

                <img src="<?= base_url('uploads/berita/' . $berita['gambar_berita']) ?>"
                     width="200"
                     class="mt-3 rounded">
            </div>

            <div class="mb-3">
                <label>Ringkasan</label>
                <textarea name="deskripsi_berita"
                          rows="3"
                          class="form-control"><?= $berita['deskripsi_berita'] ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Penulis</label>
                    <input type="text"
                           name="penulis"
                           class="form-control"
                           value="<?= $berita['penulis'] ?>">
                </div>

                <div class="col-md-6">
                    <label>Tanggal</label>
                    <input type="date"
                           name="tanggal_berita"
                           class="form-control"
                           value="<?= date('Y-m-d', strtotime($berita['tanggal_berita'])) ?>">
                </div>
            </div>

            <button class="btn btn-warning mt-4">
                Update Berita
            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>