<?php
$layout = $layout ?? 'layout/dashboard_layout_admin';
?>
<?= $this->extend($layout) ?>

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
    .preview-foto{ width:150px; height:150px; border-radius:50%; object-fit:cover; border:3px solid #e0f2f1; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .nama-admin{ color:#2F467E; }
    .form-wrapper{ max-width:520px; margin:auto; }
    .label-form{ font-size:18px; display:block; text-align:left; width:100%; }
    .input-form{ height:45px; border-radius:8px; font-size:17px; }
    .btn-simpan{ background:#00BBC2; color:white; height:50px; border-radius:8px; font-size:17px; font-weight:600; border:none; }
    .btn-simpan:hover{ background:#00a3a9; color:white; }
    .btn-kembali{ background:#D9D9D9; color:#555; border-radius:8px; padding:8px 25px; font-weight:600; border:none; }
    .btn-kembali:hover{ background:#c4c4c4; color:#555; }
    
    /* Style khusus untuk tombol Edit ala WA */
    .btn-edit-foto {
        background: white;
        border: 1px solid #d1d1d1;
        border-radius: 20px;
        padding: 5px 15px;
        font-weight: 600;
        color: #2b7a78;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transform: translateY(-20px);
    }
    .btn-edit-foto:hover { background: #f8f9fa; }
    .btn-edit-foto i { color: #2b7a78; margin-right: 5px; }
    
    /* Style Dropdown Menu */
    .dropdown-menu-custom {
        border-radius: 12px;
        border: 1px solid #eaeaea;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 8px 0;
        min-width: 180px;
    }
    .dropdown-menu-custom .dropdown-item {
        padding: 10px 20px;
        font-weight: 500;
        color: #444;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .dropdown-menu-custom .dropdown-item i { font-size: 18px; color: #666; width: 20px; text-align: center; }
    .dropdown-menu-custom .dropdown-item:hover { background-color: #f5f5f5; }
    .dropdown-menu-custom .dropdown-item.text-danger { color: #dc3545 !important; }
    .dropdown-menu-custom .dropdown-item.text-danger i { color: #dc3545; }
</style>

<?php
$foto_nama = $petugas['foto_profil'] ?? '';
$foto = (!empty($foto_nama))
    ? base_url('uploads/profil/' . $foto_nama)
    : base_url('uploads/profil/default.png');

$rawPassword = $petugas['password'] ?? '';
$passBintang = str_repeat('*', strlen($rawPassword));
?>

<div class="profile-card">

    <div class="avatar-box text-center">
        <img id="previewFoto" src="<?= $foto ?>" class="preview-foto mb-2">

        <form action="<?= base_url('uploadFoto_kader') ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="foto" id="uploadFoto_kader" accept="image/*" style="display:none" onchange="previewImage(event); this.form.submit()">
        </form>

        <div class="dropdown">
            <button class="btn btn-edit-foto" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-camera"></i> Edit
            </button>
            <ul class="dropdown-menu dropdown-menu-custom text-start">
                <li>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="document.getElementById('uploadFoto_kader').click()">
                        <i class="fa-regular fa-folder-open"></i> Unggah foto
                    </a>
                </li>
                
                <?php if(!empty($petugas['foto_profil'])): ?>
                <li>
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="konfirmasiHapus('<?= base_url('hapusFoto_kader') ?>')">
                        <i class="fa-regular fa-trash-can"></i> Hapus foto
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <h4 class="fw-bold text-center mt-3 mb-1 nama-admin text-capitalize">
        <?= esc($petugas['nama_petugas'] ?? 'Nama Tidak Tersedia'); ?>
    </h4>
    <h6 class="text-center text-secondary mb-5 text-uppercase" style="letter-spacing: 1px; font-weight: 600;">
        <?= esc($petugas['nama_jabatan'] ?? 'JABATAN TIDAK DIKETAHUI'); ?>
    </h6>

    <form action="<?= base_url('updateProfil_kader') ?>" method="post">
        <?= csrf_field(); ?> 
        <div class="form-wrapper">

            <label class="fw-bold mb-2 label-form">Email</label>
            <input class="form-control mb-3 input-form"
                type="email"
                name="email"
                value="<?= esc($petugas['email'] ?? ''); ?>" 
                required>

            <label class="fw-bold mb-2 label-form">Password Baru (Opsional)</label>
            <div class="position-relative mb-4">
                <input class="form-control input-form"
                    type="password" 
                    name="password"
                    id="passwordInput"
                    placeholder="Masukkan password baru jika ingin mengubah"
                    style="padding-right: 45px;">
                <span id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #666; z-index: 10;">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </span>
            </div>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewFoto').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

// JAVASCRIPT UNTUK SHOW/HIDE PASSWORD
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('passwordInput');
const eyeIcon = document.getElementById('eyeIcon');

togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    if (type === 'password') {
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    } else {
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }
});

// FUNGSI POP-UP KONFIRMASI SWEETALERT2
function konfirmasiHapus(urlHapus) {
    Swal.fire({
        title: 'Hapus Foto Profil?',
        text: "Apakah Anda yakin ingin menghapus foto profil ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754', // Warna Hijau (Success)
        cancelButtonColor: '#dc3545',  // Warna Merah (Danger)
        confirmButtonText: '<i class="fa-solid fa-check"></i> Iya',
        cancelButtonText: '<i class="fa-solid fa-xmark"></i> Tidak',
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika user menekan tombol 'Iya', arahkan ke url hapus foto
            window.location.href = urlHapus;
        }
    });
}
</script>

<?= $this->endSection(); ?>