<?= $this->extend('layout/dashboard_layout_kader'); ?>

<?= $this->section('content'); ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<style>
    .profile-card{ background:white; border-radius:12px; padding:60px 40px; min-height:650px; }
    .preview-foto{ width:130px; height:130px; border-radius:50%; object-fit:cover; border:5px solid #e0f2f1; }
    .nama-admin{ color:#2F467E; }
    .form-wrapper{ max-width:520px; margin:auto; }
    .label-form{ font-size:18px; display:block; text-align:left; width:100%; }
    .input-form{ height:45px; border-radius:8px; font-size:17px; }
    .btn-simpan{ background:#00BBC2; color:white; height:50px; border-radius:8px; font-size:17px; font-weight:600; border:none; }
    .btn-simpan:hover{ background:#00BBC2; color:white; }
    .btn-kembali{ background:#D9D9D9; color:#555; border-radius:8px; padding:8px 25px; font-weight:600; border:none; }
    .btn-kembali:hover{ background:#D9D9D9; color:#555; }
</style>

<?php
/** * PENJELASAN PERBAIKAN:
 * Menggunakan operator ?? (null coalescing) untuk memastikan jika variabel $petugas
 * kosong atau key-nya tidak ada, aplikasi tidak akan ErrorException.
 */

$foto_nama = $petugas['foto_profil'] ?? '';
$foto = (!empty($foto_nama))
    ? base_url('uploads/profil/' . $foto_nama)
    : base_url('uploads/profil/default.png');

// Memastikan password tidak null sebelum di-repeat
$rawPassword = $petugas['password'] ?? '';
$passBintang = str_repeat('*', strlen($rawPassword));
?>

<div class="profile-card">

    <div class="avatar-box text-center">
        <form action="<?= base_url('uploadFoto_kader') ?>" method="post" enctype="multipart/form-data">
            <img id="previewFoto"
                src="<?= $foto ?>"
                class="preview-foto"
                onclick="document.getElementById('uploadFoto_kader').click()"
                style="cursor:pointer;"
                title="Klik untuk ubah foto">

            <input type="file"
                name="foto"
                id="uploadFoto_kader"
                accept="image/*"
                style="display:none"
                onchange="previewImage(event); this.form.submit()">
        </form>
    </div>

    <h4 class="fw-bold text-center mt-3 mb-5 nama-admin">
        <?= esc($petugas['nama_petugas'] ?? 'Nama Tidak Tersedia'); ?>
    </h4>

    <form action="<?= base_url('updateProfil_kader') ?>" method="post">
        <?= csrf_field(); ?> <div class="form-wrapper">

            <label class="fw-bold mb-2 label-form">Email</label>
            <input class="form-control mb-3 input-form"
                type="email"
                name="email"
                value="<?= esc($petugas['email'] ?? ''); ?>" 
                required>

            <label class="fw-bold mb-2 label-form">Password Baru (Opsional)</label>
            <input class="form-control mb-4 input-form"
                type="password" 
                name="password"
                placeholder="Masukkan password baru jika ingin mengubah">

            <small class="text-muted d-block mb-3">Password saat ini: <?= $passBintang; ?></small>

            <button type="submit" class="btn w-100 btn-simpan">
                Simpan Perubahan
            </button>

            <div class="d-flex justify-content-end mt-3">
                <a href="<?= base_url('dbd/dashboard/kader') ?>" class="btn btn-kembali">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewFoto').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?= $this->endSection(); ?>