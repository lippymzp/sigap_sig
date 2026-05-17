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

    <form action="<?= base_url('index.php/superadmin/manajemen_admin/simpan') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-box">
            <div class="row">

                <div class="col-md-6 mb-4">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_petugas" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">NIP</label>
                    <input type="text" name="NIP" class="form-control" placeholder="Masukkan Nomor Induk Pegawai">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Role</label>
                    <select name="id_jabatan" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="1">Kepala</option>
                        <option value="2">Kader</option>
                        <option value="3">Admin</option>
                        <option value="4">Superadmin</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Instansi</label>
                    <select name="id_instansi" class="form-control" required>
                        <option value="">Pilih Instansi</option>
                        <option value="1">Puskesmas Sumbersari</option>
                        <option value="2">Puskesmas Kaliwates</option>
                        <option value="3">Puskesmas Ajung</option>
                        <option value="4">Puskesmas Panti</option>
                        <option value="5">Dinas Kesehatan</option>
                        <option value="6">Politeknik Negeri Jember</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="no_telp" class="form-control" placeholder="Masukkan Nomor Telepon">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Password</label>
                    <input type="text"
                            name="password"
                            class="form-control"
                            placeholder="Kosongkan jika tidak diubah">
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