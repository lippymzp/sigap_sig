<?= $this->extend('layout/dashboard_superadmin') ?>

<?= $this->section('content') ?>

<style>
.form-pegawai-page{
    padding: 35px 25px;
    font-family: 'Poppins', sans-serif;
}

.form-box{
    background: #eef4f8;
    border: 1px solid #20c7d2;
    border-radius: 10px;
    padding: 35px 45px;
    max-width: 900px;
    margin: 0 auto;
}

.form-label{
    font-size: 13px;
    font-weight: 500;
    color: #222;
}

.form-control{
    height: 45px;
    border-radius: 6px;
    font-size: 13px;
}

.btn-simpan{
    width: 100%;
    background: #08b9c5;
    color: #fff;
    border: none;
    border-radius: 7px;
    height: 48px;
    font-weight: 600;
    margin-top: 35px;
}

.btn-kembali{
    display: inline-block;
    background: #08b9c5;
    color: #fff;
    text-decoration: none;
    padding: 8px 55px;
    border-radius: 20px;
    font-size: 13px;
    margin-top: 35px;
}

.btn-kembali:hover,
.btn-simpan:hover{
    color: #fff;
    background: #07a8b3;
}
</style>

<div class="form-pegawai-page">

    <form action="<?= base_url('index.php/superadmin/manajemen_admin/update/' . $petugas['id_petugas']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-box">
            <div class="row">

                <div class="col-md-6 mb-4">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_petugas" class="form-control" value="<?= esc($petugas['nama_petugas']) ?>" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">NIP</label>
                    <input type="text" name="NIP" class="form-control" value="<?= esc($petugas['NIP']) ?>">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Role</label>
                    <select name="id_jabatan" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="1" <?= ($petugas['id_jabatan'] == 1) ? 'selected' : '' ?>>Kepala</option>
                        <option value="2" <?= ($petugas['id_jabatan'] == 2) ? 'selected' : '' ?>>Kader</option>
                        <option value="3" <?= ($petugas['id_jabatan'] == 3) ? 'selected' : '' ?>>Admin</option>
                        <option value="4" <?= ($petugas['id_jabatan'] == 4) ? 'selected' : '' ?>>Superadmin</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Instansi</label>
                    <select name="id_instansi" class="form-control" required>
                        <option value="">Pilih Instansi</option>
                        <option value="1" <?= ($petugas['id_instansi'] == 1) ? 'selected' : '' ?>>Puskesmas Sumbersari</option>
                        <option value="2" <?= ($petugas['id_instansi'] == 2) ? 'selected' : '' ?>>Puskesmas Kaliwates</option>
                        <option value="3" <?= ($petugas['id_instansi'] == 3) ? 'selected' : '' ?>>Puskesmas Ajung</option>
                        <option value="4" <?= ($petugas['id_instansi'] == 4) ? 'selected' : '' ?>>Puskesmas Panti</option>
                        <option value="5" <?= ($petugas['id_instansi'] == 5) ? 'selected' : '' ?>>Dinas Kesehatan</option>
                        <option value="6" <?= ($petugas['id_instansi'] == 6) ? 'selected' : '' ?>>Politeknik Negeri Jember</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Penyakit</label>

                    <select name="id_penyakit" class="form-control">

                        <option value="">Pilih Penyakit</option>

                        <?php foreach($penyakit as $p): ?>

                            <option 
                                value="<?= $p['id_penyakit']; ?>"

                                <?= ($petugas['id_penyakit'] == $p['id_penyakit'])
                                    ? 'selected'
                                    : ''; ?>
                            >
                                <?= $p['nama_penyakit']; ?>
                            </option>

                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc($petugas['email']) ?>">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="<?= esc($petugas['no_telp']) ?>">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" input 
                        type="text"
                        name="password"
                        class="form-control"
                        placeholder="Kosongkan jika tidak diubah"
                    >
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?= esc($petugas['alamat']) ?>">
                </div>

            </div>

            <button type="submit" class="btn-simpan">Simpan</button>
        </div>

        <a href="<?= base_url('index.php/superadmin/manajemen_admin') ?>" class="btn-kembali">
            Kembali
        </a>

    </form>

</div>

<?= $this->endSection() ?>