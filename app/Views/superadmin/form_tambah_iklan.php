<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<div class="iklan-form-wrap">

    <div class="iklan-left">
        <h3>Tambah Iklan</h3>

        <label class="fw-bold mb-2">Preview</label>

        <img id="previewBanner"
             src="<?= base_url('img/default-banner.png') ?>"
             class="banner-preview">

        <div class="upload-box">
            <h5>UNGGAH GAMBAR</h5>

            <label for="gambar" class="upload-area">
                <i class="fa-solid fa-upload"></i>
                <span>KLIK UNTUK UNGGAH</span>
                <small>PNG/JPG/WEBP (maks 5mb)</small>
            </label>
        </div>
    </div>

    <div class="iklan-right">
        <form action="<?= base_url('superadmin/iklan/simpan') ?>"
              method="post"
              enctype="multipart/form-data">

            <?= csrf_field() ?>

            <input type="file"
                   name="gambar"
                   id="gambar"
                   accept="image/*"
                   hidden
                   onchange="previewImage(event)">

            <div class="form-group">
                <label>Judul</label>
                <input type="text"
                       name="judul"
                       class="form-control"
                       placeholder="Masukkan Judul"
                       required>
            </div>

            <div class="form-group">
                <label>Status</label>

                <div class="status-wrap">
                    <label>
                        <input type="radio"
                               name="status"
                               value="aktif"
                               checked>
                        <span class="aktif">Aktif</span>
                    </label>

                    <label>
                        <input type="radio"
                               name="status"
                               value="nonaktif">
                        <span class="nonaktif">Tidak Aktif</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Urutan</label>

                <select name="urutan" class="form-control" required>
                    <?php for($i=1; $i<=10; $i++): ?>
                        <option value="<?= $i ?>">
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>

                <textarea name="deskripsi"
                          class="form-control"
                          rows="5"
                          placeholder="Masukkan Deskripsi"
                          required></textarea>
            </div>

            <div class="btn-wrap">
                <a href="<?= base_url('superadmin/manajemen-iklan') ?>"
                   class="btn-cancel">
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
    display:grid;
    grid-template-columns: 420px 1fr;
    gap:28px;
    padding:20px;
}

.iklan-left,
.iklan-right{
    background:#F4FEFD;
    border-radius:22px;
    padding:24px;
}

.iklan-left h3{
    font-weight:700;
    margin-bottom:20px;
}

.banner-preview{
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:16px;
    margin-bottom:30px;
}

.upload-box{
    background:white;
    border-radius:20px;
    padding:35px;
    text-align:center;
}

.upload-area{
    border:2px dashed #ccc;
    border-radius:14px;
    padding:50px 20px;
    cursor:pointer;
    display:block;
}

.upload-area i{
    font-size:32px;
    color:#17C8D3;
    margin-bottom:15px;
}

.upload-area span{
    display:block;
    font-weight:700;
}

.upload-area small{
    color:#888;
}

.form-group{
    margin-bottom:24px;
}

.form-group label{
    font-weight:700;
    margin-bottom:10px;
}

.form-control{
    border-radius:14px;
    min-height:52px;
}

textarea.form-control{
    min-height:140px;
}

.status-wrap{
    display:flex;
    gap:30px;
    margin-top:10px;
}

.status-wrap label{
    display:flex;
    align-items:center;
    gap:10px;
}

.aktif{
    color:#31A43A;
    font-weight:600;
}

.nonaktif{
    color:#E53935;
    font-weight:600;
}

.btn-wrap{
    display:flex;
    justify-content:flex-end;
    gap:14px;
    margin-top:30px;
}

.btn-cancel{
    background:#A9A9A9;
    color:white;
    padding:12px 28px;
    border-radius:12px;
    text-decoration:none;
}

.btn-save{
    border:none;
    background:#14C6D1;
    color:white;
    padding:12px 28px;
    border-radius:12px;
    font-weight:600;
}

@media(max-width:992px){
    .iklan-form-wrap{
        grid-template-columns:1fr;
    }
}
</style>

<script>
function previewImage(event){
    const reader = new FileReader();

    reader.onload = function(){
        document.getElementById('previewBanner').src = reader.result;
    }

    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?= $this->endSection() ?>