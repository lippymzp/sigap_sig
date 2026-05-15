<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="card shadow-sm" style="border-radius:15px; border:none;">
        <div class="card-body p-4">
            <h4 class="card-title fw-bold mb-4 text-center">Edit Profil Sistem</h4>
            
            <form action="<?= base_url('profil_sistem/update') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label class="fw-bold">Nama Sistem</label>
                    <input type="text" name="nama_sistem" class="form-control" value="<?= $profil_sistem['nama_sistem'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Definisi</label>
                    <textarea name="definisi" class="form-control" rows="4" required><?= $profil_sistem['definisi'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Visi</label>
                    <textarea name="isi_visi" class="form-control" rows="4" required><?= $profil_sistem['isi_visi'] ?? '' ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="fw-bold">Misi</label>
                    <textarea name="isi_misi" class="form-control" rows="5" required><?= $profil_sistem['isi_misi'] ?? '' ?></textarea>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4 me-2"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    <a href="<?= base_url('profil_sistem') ?>" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>