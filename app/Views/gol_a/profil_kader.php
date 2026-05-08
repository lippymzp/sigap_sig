<?= $this->extend('layout/dashboard_layout_kader'); ?>
<?= $this->section('content'); ?>

<style>
    /* --- STYLE HALAMAN PROFIL SESUAI DESAIN --- */
    .page-wrapper { 
        background-color: #F8FBFA; 
        padding: 40px 20px; 
        min-height: 100vh; 
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }
    
    .profile-card {
        background: #FFFFFF;
        width: 100%;
        max-width: 650px; 
        border-radius: 20px;
        padding: 50px 40px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    /* --- AVATAR & BADGE EDIT --- */
    .avatar-wrapper {
        position: relative;
        width: 130px;
        height: 130px;
        margin: 0 auto 15px auto;
    }
    .avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #EAF5F5; 
    }
    .edit-badge {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #00BBC2; 
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 3px solid #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        transition: transform 0.2s ease;
        box-shadow: 0 4px 6px rgba(0, 187, 194, 0.3);
    }
    .edit-badge:hover {
        transform: scale(1.1);
    }

    /* --- TOMBOL SIMPAN FOTO (MUNCUL OTOMATIS) --- */
    .btn-simpan-foto {
        display: none; /* Disembunyikan sebelum foto dipilih */
        background-color: #00BBC2;
        color: #FFFFFF;
        border: none;
        border-radius: 20px;
        padding: 8px 25px;
        font-weight: bold;
        font-size: 13px;
        margin: 0 auto;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 4px 6px rgba(0, 187, 194, 0.2);
    }
    .btn-simpan-foto:hover {
        background-color: #009ca2;
        transform: translateY(-2px);
    }

    /* --- TEXT NAMA & FORM --- */
    .profile-name {
        font-weight: 800;
        color: #3B4863; 
        font-size: 20px;
        margin-top: 10px;
        margin-bottom: 35px;
        text-align: center;
    }

    .form-group-custom {
        margin-bottom: 20px;
        text-align: left;
    }
    .form-label-custom {
        font-weight: 700;
        color: #333;
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
    }
    .form-input-custom {
        background-color: #FFFFFF;
        border: 1px solid #E0E0E0;
        border-radius: 8px;
        padding: 12px 15px;
        width: 100%;
        font-size: 14px;
        color: #333;
        outline: none;
        transition: all 0.3s;
    }
    .form-input-custom:focus {
        border-color: #00BBC2;
        box-shadow: 0 0 0 3px rgba(0, 187, 194, 0.1);
    }

    /* --- TOMBOL UBAH KATA SANDI --- */
    .btn-ubah-sandi {
        background-color: #00BBC2;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        padding: 14px;
        width: 100%;
        font-weight: 700;
        font-size: 14px;
        margin-top: 10px;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-ubah-sandi:hover {
        background-color: #009ca2;
    }
</style>

<div class="page-wrapper">
    <div class="profile-card">

        <?php if (session()->getFlashdata('success')) : ?>
            <div id="alertSuccess" style="background-color: #D4EDDA; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: bold; font-size: 13px; text-align: center;">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form id="formFoto" action="<?= base_url('profil/update_foto') ?>" method="POST" enctype="multipart/form-data">
            <div class="avatar-wrapper">
                
                <?php 
                    $fotoUrl = !empty($profil['foto_profil']) 
                                ? base_url('uploads/profil/' . $profil['foto_profil']) 
                                : 'https://i.ibb.co.com/0jZ7Z7Z/male-avatar.png'; 
                ?>
                <img id="previewFoto" class="avatar-img" src="<?= $fotoUrl ?>" alt="Foto Profil">
                
                <div class="edit-badge" onclick="document.getElementById('uploadFoto').click()">
                    <i class="fa-solid fa-camera" style="font-size: 14px;"></i>
                </div>

                <input type="file" name="foto_profil" id="uploadFoto" accept="image/*" style="display:none" onchange="previewImage(event)">
            </div>
            
            <div class="text-center">
                <button type="submit" id="btnSimpanFoto" class="btn-simpan-foto">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Simpan Foto
                </button>
            </div>
        </form>

        <div class="profile-name">Kader</div>

        <form action="<?= base_url('profil/update_sandi') ?>" method="POST">
            <div class="form-group-custom">
                <label class="form-label-custom">Email</label>
                <input type="email" class="form-input-custom" value="aguskurniawan17@gmail.com" readonly style="background-color: #F8F9FA;">
            </div>

            <div class="form-group-custom">
                <label class="form-label-custom">Password</label>
                <input type="password" name="password_baru" class="form-input-custom" placeholder="******" required>
            </div>

            <button type="submit" class="btn-ubah-sandi">Ubah Kata Sandi</button>
        </form>

    </div>
</div>

<script>
    // Menghilangkan pesan sukses setelah 3 detik
    setTimeout(function() {
        var alert = document.getElementById('alertSuccess');
        if(alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(function() { alert.style.display = 'none'; }, 500);
        }
    }, 3000);

    // Fungsi untuk mempratinjau gambar dan memunculkan tombol simpan
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                // 1. Ganti gambar yang tampil di layar
                document.getElementById('previewFoto').src = reader.result;
                
                // 2. Munculkan tombol "Simpan Foto"
                document.getElementById('btnSimpanFoto').style.display = 'inline-block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<?= $this->endSection(); ?>