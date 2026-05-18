<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<div class="iklan-form-wrap">

    <div class="left-box">
        <h3>Edit Iklan</h3>

        <label>Preview</label>

        <img
            id="previewImage"
            src="<?= base_url('uploads/iklan/' . $iklan['gambar']) ?>"
            class="preview-banner">

        <div class="upload-box">
            <h5>UNGGAH GAMBAR</h5>

            <label for="gambar" class="upload-area">
                <i class="fa-solid fa-upload"></i>
                <span>KLIK UNTUK UNGGAH</span>
                <small>PNG, JPG, WEBP (max 5mb)</small>
            </label>
        </div>
    </div>

    <div class="right-box">
        <form action="<?= base_url('superadmin/iklan/update/' . $iklan['id_iklan']) ?>"
              method="post"
              enctype="multipart/form-data">

            <input type="file"
                   name="gambar"
                   id="gambar"
                   hidden
                   onchange="previewBanner(event)">

            <div class="form-group">
                <label>Judul</label>
                <input type="text"
                       name="judul"
                       value="<?= esc($iklan['judul']) ?>"
                       required>
            </div>

            <div class="form-group radio-group">
                <label>Status</label>

                <div class="radio-wrap">
                    <label>
                        <input type="radio"
                               name="status"
                               value="aktif"
                               <?= $iklan['status'] == 'aktif' ? 'checked' : '' ?>>
                        <span class="aktif">Aktif</span>
                    </label>

                    <label>
                        <input type="radio"
                               name="status"
                               value="nonaktif"
                               <?= $iklan['status'] == 'nonaktif' ? 'checked' : '' ?>>
                        <span class="nonaktif">Tidak Aktif</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Urutan</label>
                <select name="urutan" required>
                    <?php for($i=1; $i<=10; $i++): ?>
                        <option value="<?= $i ?>"
                            <?= $iklan['urutan'] == $i ? 'selected' : '' ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="5"><?= esc($iklan['deskripsi']) ?></textarea>
            </div>

            <div class="btn-wrap">
                <a href="<?= base_url('superadmin/iklan') ?>" class="btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-save">
                    <i class="fa-regular fa-floppy-disk"></i>
                    Simpan
                </button>
            </div>

        </form>
    </div>

</div>

<style>
.iklan-form-wrap{
    display:flex;
    gap:30px;
    padding:25px;
}

.left-box{
    width:35%;
    background:#F2FCFC;
    padding:25px;
    border-radius:22px;
}

.right-box{
    width:65%;
    background:#F2FCFC;
    padding:30px;
    border-radius:22px;
}

.left-box h3{
    font-weight:700;
    margin-bottom:20px;
}

.preview-banner{
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:18px;
    margin-bottom:25px;
}

.upload-box{
    background:white;
    border-radius:18px;
    padding:30px;
    text-align:center;
}

.upload-area{
    border:2px dashed #ccc;
    border-radius:16px;
    padding:45px 20px;
    cursor:pointer;
    display:block;
}

.upload-area i{
    font-size:32px;
    color:#16C7D5;
    margin-bottom:10px;
}

.form-group{
    margin-bottom:24px;
}

.form-group label{
    font-weight:600;
    display:block;
    margin-bottom:10px;
}

.form-group input,
.form-group textarea,
.form-group select{
    width:100%;
    border:1px solid #d9e4e4;
    border-radius:12px;
    padding:14px 16px;
    background:white;
}

.radio-wrap{
    display:flex;
    gap:30px;
}

.aktif{
    color:green;
    font-weight:600;
}

.nonaktif{
    color:red;
    font-weight:600;
}

.btn-wrap{
    display:flex;
    justify-content:flex-end;
    gap:14px;
    margin-top:40px;
}

.btn-cancel{
    background:#A9A9A9;
    color:white;
    padding:12px 30px;
    border-radius:12px;
    text-decoration:none;
}

.btn-save{
    background:#16C7D5;
    color:white;
    border:none;
    padding:12px 30px;
    border-radius:12px;
}
</style>

<script>
function previewBanner(event){
    const input = event.target;
    const preview = document.getElementById('previewImage');

    if(input.files && input.files[0]){
        preview.src = URL.createObjectURL(input.files[0]);
    }
}
</script>

<?= $this->endSection() ?>