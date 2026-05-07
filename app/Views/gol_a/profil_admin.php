<?= $this->extend('layout/dashboard_layout_admin'); ?>

<?= $this->section('content'); ?>

<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>

        <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>
    </div>

<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>

        <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>
    </div>

<?php endif; ?>

<style>
.profile-card{
    background:white;
    border-radius:12px;
    padding:60px 40px;
    min-height:650px;
}

.preview-foto{
    width:130px;
    height:130px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid #e0f2f1;
}

.nama-admin{
    color:#2F467E;
}

.form-wrapper{
    max-width:520px;
    margin:auto;
}

.label-form{
    font-size:18px;
    display:block;
    text-align:left;
    width:100%;
}

.input-form{
    height:45px;
    border-radius:8px;
    font-size:17px;
}

.btn-simpan{
    background:#00BBC2;
    color:white;
    height:50px;
    border-radius:8px;
    font-size:17px;
    font-weight:600;
    border:none;
}

.btn-simpan:hover{
    background:#00BBC2;
    color:white;
}

.btn-kembali{
    background:#D9D9D9;
    color:#555;
    border-radius:8px;
    padding:8px 25px;
    font-weight:600;
    border:none;
}

.btn-kembali:hover{
    background:#D9D9D9;
    color:#555;
}
</style>

<?php
$foto = (!empty($petugas['foto_profil']))
    ? base_url('uploads/profil/' . $petugas['foto_profil'])
    : 'https://i.ibb.co.com/0jZ7Z7Z/male-avatar.png';

$passBintang = str_repeat('*', strlen($petugas['password']));
?>

<div class="profile-card">

    <!-- FOTO PROFIL -->
    <div class="avatar-box text-center">

        <!-- FORM FOTO -->
        <form action="<?= base_url('uploadFoto') ?>"
            method="post"
            enctype="multipart/form-data">

            <img id="previewFoto"
                src="<?= $foto ?>"
                class="preview-foto">

            <input type="file"
                name="foto"
                id="uploadFoto"
                accept="image/*"
                style="display:none"
                onchange="previewImage(event); this.form.submit()">

        </form>

    </div>

    <!-- NAMA -->
    <h4 class="fw-bold text-center mt-3 mb-5 nama-admin">
        <?= $petugas['nama_petugas']; ?>
    </h4>

    <!-- FORM UPDATE -->
    <form action="<?= base_url('updateProfil') ?>" method="post">

        <div class="form-wrapper">

            <!-- EMAIL -->
            <label class="fw-bold mb-2 label-form">
                Email
            </label>

            <input class="form-control mb-3 input-form"
                type="email"
                name="email"
                value="<?= $petugas['email']; ?>">

            <!-- PASSWORD -->
            <label class="fw-bold mb-2 label-form">
                Password
            </label>

            <input class="form-control mb-4 input-form"
                type="text"
                name="password"
                value="<?= $passBintang; ?>">

            <!-- BUTTON SIMPAN -->
            <button type="submit"
                class="btn w-100 btn-simpan">

                Ubah Kata Sandi

            </button>

            <!-- BUTTON KEMBALI -->
            <div class="d-flex justify-content-end mt-3">

                <a href="<?= base_url('dbd/dashboard') ?>"
                    class="btn btn-kembali">

                    Kembali

                </a>

            </div>

        </div>

    </form>

</div>

<script>
function previewImage(event)
{
    const reader = new FileReader();

    reader.onload = function(){
        document.getElementById('previewFoto').src = reader.result;
    };

    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?= $this->endSection(); ?>