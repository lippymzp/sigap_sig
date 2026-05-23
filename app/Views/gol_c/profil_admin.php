<?= $this->extend('layout/dashboard_layout_pneumonia_admin'); ?>

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

/* input email tidak bisa diedit */
.input-readonly{
    background-color:#e9ecef !important;
    color:#6c757d !important;
    cursor:not-allowed;
    pointer-events:none;
}

/* input password dengan icon mata */
.password-wrapper{
    position:relative;
}

.password-input{
    padding-right:45px;
}

.toggle-password{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    color:#6c757d;
    cursor:pointer;
    font-size:18px;
}

.toggle-password:hover{
    color:#00BBC2;
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
    : base_url('uploads/profil/default.png');

$passwordValue = $petugas['password'] ?? '';
?>

<div class="profile-card">

    <!-- FOTO PROFIL -->
    <div class="avatar-box text-center">

        <!-- FORM FOTO -->
        <form action="<?= base_url('uploadFoto_admin') ?>"
            method="post"
            enctype="multipart/form-data">

            <img id="previewFoto"
                src="<?= $foto ?>"
                class="preview-foto"
                onclick="document.getElementById('uploadFoto_admin').click()"
                style="cursor:pointer;">

            <input type="file"
                name="foto"
                id="uploadFoto_admin"
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
    <form action="<?= base_url('updateProfil_admin') ?>" method="post">

        <div class="form-wrapper">

            <!-- EMAIL -->
            <label class="fw-bold mb-2 label-form">
                Email
            </label>

            <input class="form-control mb-3 input-form input-readonly"
            type="email"
            name="email"
            value="<?= esc($petugas['email'] ?? '-'); ?>"
            readonly>

            <!-- PASSWORD -->
            <label class="fw-bold mb-2 label-form">
                Password
            </label>

            <div class="password-wrapper mb-4">

                <input class="form-control input-form password-input"
                    type="password"
                    name="password"
                    id="passwordInput"
                    value=""
                    placeholder="Masukkan password baru">

                <span class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </span>

            </div>

            <!-- BUTTON SIMPAN -->
            <button type="submit"
                class="btn w-100 btn-simpan">

                Ubah Kata Sandi

            </button>

            <!-- BUTTON KEMBALI -->
            <div class="d-flex justify-content-end mt-3">

                <a href="<?= base_url('pneumonia/dashboard/admin') ?>"
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

function togglePassword()
{
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');

    if(passwordInput.type === 'password'){
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }else{
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}
</script>

<?= $this->endSection(); ?>