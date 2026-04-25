<?= $this->extend('layout/dashboard_layout'); ?>

<?= $this->section('content'); ?>

<div class="profile-card">

    <!-- FOTO PROFIL -->
    <div class="avatar-box text-center">
        <img id="previewFoto" src="https://i.ibb.co.com/0jZ7Z7Z/male-avatar.png"
            style="width:130px;height:130px;border-radius:50%;border:5px solid #e0f2f1;">

        <input type="file" id="uploadFoto" accept="image/*"
            style="display:none" onchange="previewImage(event)">

        <div>
            <button class="btn btn-outline-info btn-sm mt-3 mb-4"
                onclick="document.getElementById('uploadFoto').click()">
                <i class="fa fa-camera me-1"></i> Tambah Foto
            </button>
        </div>
    </div>

    <h5 class="fw-bold text-center mb-4">Admin</h5>

    <input class="form-control mb-3" value="admin@gmail.com" readonly>
    <input class="form-control mb-3" value="********" readonly>

    <button class="btn btn-info w-100">Ubah Kata Sandi</button>

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