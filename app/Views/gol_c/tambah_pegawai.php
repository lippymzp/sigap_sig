<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>

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

    <form action="<?= base_url('index.php/pneumonia/pegawai/simpan') ?>" method="post">
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
                        <option value="3">Admin</option>
                        <option value="4">Superadmin</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                <label class="form-label">Instansi</label>

                <input 
                    type="text" 
                    class="form-control" 
                    value="Puskesmas Ajung" 
                    readonly
                >

                <input 
                    type="hidden" 
                    name="id_instansi" 
                    value="3"
                >
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
                    <input type="text" name="password" class="form-control" placeholder="Masukkan Password">
                </div>

            </div>

            <button type="submit" class="btn-simpan">Simpan</button>
        </div>

        <a href="<?= base_url('index.php/pneumonia/pegawai') ?>" class="btn-kembali">
            Kembali
        </a>

    </form>

</div>

<?= $this->endSection() ?>