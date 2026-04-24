<?= $this->extend('layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">Edit Artikel</h3>

        <form method="POST"
              action="<?= base_url('admin/artikel/update/'.$artikel['id_artikel']) ?>"
              enctype="multipart/form-data">

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Artikel</label>
                <input type="text"
                       name="judul_artikel"
                       value="<?= esc($artikel['judul_artikel']) ?>"
                       class="form-control">
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi_artikel"
                          id="deskripsi"
                          class="form-control"
                          rows="5"><?= $artikel['deskripsi_artikel'] ?></textarea>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status_artikel" class="form-select">
                    <option value="Publish"
                        <?= $artikel['status_artikel'] == 'Publish' ? 'selected' : '' ?>>
                        Publish
                    </option>
                    <option value="Unpublish"
                        <?= $artikel['status_artikel'] == 'Unpublish' ? 'selected' : '' ?>>
                        Unpublish
                    </option>
                </select>
            </div>

            <!-- Gambar Lama -->
            <?php if (!empty($artikel['gambar_artikel'])) : ?>
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="<?= base_url('uploads/artikel/'.$artikel['gambar_artikel']) ?>"
                         class="img-thumbnail"
                         width="200">
                </div>
            <?php endif; ?>

            <!-- Upload Baru -->
            <div class="mb-3">
                <label class="form-label">Ganti Gambar</label>
                <input type="file" name="gambar_artikel" class="form-control">
            </div>

            <!-- Button -->
            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

        </form>
    </div>
</div>

<?= $this->endSection() ?>