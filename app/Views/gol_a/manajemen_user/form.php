<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashdata('error')): ?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">

    <?= session()->getFlashdata('error') ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>

<?php endif; ?>

<?php
$isView = ($mode == 'view');
?>

<style>

.form-card{
    background:white;
    border-radius:30px;
    padding:40px;
}

.custom-input{
    height:55px;
    border-radius:14px;
    border:none;
    background:#F5F7FA;
}

.btn-simpan{
    background:#00C5CC;
    color:white;
    border:none;
    height:55px;
    border-radius:40px;
    font-weight:700;
}

.btn-batal{
    background:white;
    border:1px solid #ddd;
    height:55px;
    border-radius:40px;
    font-weight:700;
}

</style>

<div class="container-fluid">

<div class="form-card">

<form method="post"
action="<?= ($mode == 'edit')
    ? base_url('manajemen-user/update/'.$user['id_petugas'])
    : base_url('manajemen-user/simpan') ?>">

<div class="row g-4">

<div class="col-md-6">
    <label class="fw-bold mb-2">Nama Lengkap</label>

    <input type="text"
        name="nama_petugas"
        class="form-control custom-input"
        placeholder="Masukkan nama lengkap"
        value="<?= $user['nama_petugas'] ?? '' ?>"
        <?= $isView ? 'readonly' : '' ?>>
</div>

<div class="col-md-6">
    <label class="fw-bold mb-2">NIP Petugas</label>

    <input type="text"
       name="nip"
       class="form-control custom-input"
       placeholder="Masukkan NIP"
       value="<?= $user['NIP'] ?? '' ?>"
       <?= $isView ? 'readonly' : '' ?>>
</div>

<div class="col-md-6">
    <label class="fw-bold mb-2">Email</label>

    <input type="email"
       name="email"
       class="form-control custom-input"
       placeholder="Masukkan email"
       value="<?= $user['email'] ?? '' ?>"
       <?= $isView ? 'readonly' : '' ?>>
</div>

<div class="col-md-6">
    <label class="fw-bold mb-2">Nomor Telepon</label>

    <input type="text"
           name="no_telp"
           class="form-control custom-input"
           placeholder="Masukkan nomor telepon"
           value="<?= $user['no_telp'] ?? '' ?>"
           <?= $isView ? 'readonly' : '' ?>>
</div>

<div class="col-md-6">
    <label class="fw-bold mb-2">Jabatan</label>

    <select name="id_jabatan"
        class="form-control custom-input"
        <?= $isView ? 'disabled' : '' ?>>

        <option value="">Pilih Jabatan</option>

        <?php foreach($jabatan as $j): ?>

        <option value="<?= $j['id_jabatan'] ?>"
            <?= isset($user) && $user['id_jabatan'] == $j['id_jabatan']
                ? 'selected' : '' ?>>

            <?= ucfirst($j['nama_jabatan']) ?>

        </option>

        <?php endforeach; ?>

    </select>
</div>

<div class="col-md-6">
    <label class="fw-bold mb-2">Instansi</label>

    <select name="id_instansi"
            class="form-control custom-input"
            <?= $isView ? 'disabled' : '' ?>>

        <option value="">Pilih Instansi</option>

        <?php foreach($instansi as $i): ?>

        <option value="<?= $i['id_instansi'] ?>"
            <?= isset($user) && $user['id_instansi'] == $i['id_instansi']
                ? 'selected' : '' ?>>

            <?= $i['nama_instansi'] ?>

        </option>

        <?php endforeach; ?>

    </select>
</div>

<div class="col-md-6">
    <label class="fw-bold mb-2">Kata Sandi</label>

    <input type="password"
       name="password"
       class="form-control custom-input"
       placeholder="Masukkan kata sandi"
       <?= $isView ? 'readonly' : '' ?>>
</div>

<div class="col-md-6">
    <label class="fw-bold mb-2">Konfirmasi Kata Sandi</label>

    <input type="password"
       name="konfirmasi_password"
       class="form-control custom-input"
       placeholder="Masukkan konfirmasi kata sandi"
       <?= $isView ? 'readonly' : '' ?>>
</div>

</div>

<div class="row mt-5">

<div class="col-md-6">
    <a href="<?= base_url('manajemen-user') ?>"
       class="btn btn-batal w-100">

       <?= $isView ? 'Kembali' : 'Batal' ?>

    </a>
</div>

<?php if(!$isView): ?>

<div class="col-md-6">
    <button type="submit"
            class="btn btn-simpan w-100">
        Simpan
    </button>
</div>

<?php endif; ?>

</div>

</form>

</div>

</div>

<?= $this->endSection() ?>