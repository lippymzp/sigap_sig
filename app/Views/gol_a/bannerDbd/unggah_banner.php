<?= $this->extend('layout/dashboard_layout_admin'); ?>
<?= $this->section('content'); ?>

<?php

$isEdit = isset($banner);

$bannerData = $banner ?? [];

?>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

body{
    background:#f4f4f4;
    font-family:'Poppins',sans-serif;
}

.main{
    padding:30px;
}

.page-title{
    font-size:30px;
    font-weight:800;
    color:#111;
    margin-bottom:24px;
}

.upload-wrapper{
    max-width:900px;
    margin:auto;
    background:#EAF7F7;
    border-radius:24px;
    padding:35px;
    box-shadow:0 5px 18px rgba(0,0,0,.05);
}

.step-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:120px;
    position:relative;
    margin-bottom:35px;
}

.step-wrapper::before{
    content:'';
    position:absolute;
    width:300px;
    border-top:2px dashed #8ED9DD;
    top:18px;
    z-index:1;
}

.step-item{
    text-align:center;
    position:relative;
    z-index:2;
}

.step-number{
    width:40px;
    height:40px;
    border-radius:12px;
    background:#10BCCD;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto auto 8px;
    font-weight:700;
}

.step-number.inactive{
    background:#fff;
    border:2px solid #8ED9DD;
    color:#10BCCD;
}

.step-text{
    font-size:13px;
    font-weight:600;
}

.content-box{
    background:#fff;
    border-radius:20px;
    padding:35px;
}

.upload-area{
    border:2px dashed #D8D8D8;
    border-radius:18px;
    padding:50px 25px;
    text-align:center;
    cursor:pointer;
    transition:.3s;
}

.upload-area:hover{
    background:#fafafa;
}

.upload-title{
    font-size:24px;
    font-weight:800;
    margin-bottom:20px;
}

.upload-icon{
    width:75px;
    height:75px;
    border-radius:20px;
    background:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 20px;
    font-size:30px;
    color:#10BCCD;
    box-shadow:0 5px 18px rgba(0,0,0,.08);
}

.upload-text{
    max-width:600px;
    margin:auto;
    font-size:13px;
    line-height:1.8;
    color:#888;
}

.preview-container{
    display:flex;
    justify-content:center;
    align-items:center;
    margin-bottom:25px;
}

.preview-image{
    width:100%;
    max-width:420px;
    height:240px;
    object-fit:cover;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
}

.form-group{
    margin-bottom:20px;
}

.form-label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:700;
}

.form-control{
    width:100%;
    border:1px solid #DADADA;
    border-radius:14px;
    padding:14px 16px;
    font-size:14px;
    outline:none;
    transition:.2s;
}

.form-control:focus{
    border-color:#10BCCD;
    box-shadow:0 0 0 3px rgba(16,188,205,.12);
}

textarea.form-control{
    resize:none;
    min-height:140px;
}

.bottom-actions{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:20px;
    margin-top:32px;
    width:100%;
}

.btn-custom{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    height:54px;
    min-width:220px;
    padding:0 28px;
    border-radius:50px;
    font-size:15px;
    font-weight:700;
    line-height:1;
    box-sizing:border-box;
    border:2px solid transparent;
    cursor:pointer;
    transition:.2s;
}

.btn-custom:hover{
    transform:translateY(-2px);
}

.btn-cancel{
    background:#fff;
    border:1px solid #DADADA;
    color:#333;
}

.btn-upload{
    background:#19BFD3;
    color:#fff;
    box-shadow:0 6px 16px rgba(25,191,211,.25);
}

.btn-draft{
    background:#fff;
    border:1.5px solid #EF5350;
    color:#E53935;
}

.hidden{
    display:none;
}

@media(max-width:768px){

    .step-wrapper{
        gap:60px;
    }

    .step-wrapper::before{
        width:180px;
    }

    .upload-wrapper{
        padding:20px;
    }

    .content-box{
        padding:20px;
    }

    .preview-image{
        height:200px;
    }

    .bottom-actions{
        flex-direction:column;
    }

    .btn-custom{
        width:100%;
        min-width:100%;
    }
}

</style>

<div class="main">

    <div class="page-title">
        <?= $isEdit ? 'Edit Banner' : 'Unggah Banner'; ?>
    </div>

    <div class="upload-wrapper">

        <form
            action="<?= $isEdit
                ? base_url('/bannerDbd/update/' . ($bannerData['id_manajemen_banner'] ?? ''))
                : base_url('/bannerDbd/simpan'); ?>"
            method="post"
            enctype="multipart/form-data"
        >

            <!-- STEP -->
            <div class="step-wrapper">

                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-text">
                        Unggah Foto
                    </div>
                </div>

                <div class="step-item">

                    <div
                        class="step-number <?= $isEdit ? '' : 'inactive'; ?>"
                        id="step2Number"
                    >
                        2
                    </div>

                    <div class="step-text">
                        Tambahkan Detail
                    </div>

                </div>

            </div>

            <div class="content-box">

                <!-- STEP 1 -->
                <div
                    id="step1"
                    class="<?= $isEdit ? 'hidden' : ''; ?>"
                >

                    <input
                        type="file"
                        name="gambar"
                        id="bannerInput"
                        accept="image/png,image/jpeg,image/jpg"
                        hidden
                    >

                    <div
                        class="upload-area"
                        onclick="document.getElementById('bannerInput').click()"
                    >

                        <!-- PREVIEW -->
                        <div
                            id="previewStep1"
                            class="preview-container <?= $isEdit ? '' : 'hidden'; ?>"
                        >

                            <img
                                id="previewImageStep1"
                                class="preview-image"
                                src="<?= $isEdit
                                ? base_url(
                                    'uploads/banner/' .
                                    ($bannerData['gambar'] ?? '')
                                )
                                : ''; ?>"
                            >

                        </div>

                        <!-- DEFAULT -->
                        <div
                            id="defaultUploadContent"
                            style="<?= $isEdit ? 'display:none;' : ''; ?>"
                        >

                            <div class="upload-title">
                                Unggah Foto Banner
                            </div>

                            <div class="upload-icon">
                                <i class="fas fa-upload"></i>
                            </div>

                            <div class="upload-text">
                                Gunakan gambar resolusi tinggi agar banner
                                terlihat tajam dan profesional di semua perangkat.
                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="bottom-actions">

                        <button
                            type="button"
                            class="btn-custom btn-cancel"
                            onclick="history.back()"
                        >
                            Batal
                        </button>

                        <button
                            type="button"
                            class="btn-custom btn-upload"
                            id="nextStepBtn"
                        >
                            Lanjut
                        </button>

                    </div>

                </div>

                <!-- STEP 2 -->
                <div
                    id="step2"
                    class="<?= $isEdit ? '' : 'hidden'; ?>"
                >

                    <!-- PREVIEW -->
                    <div class="preview-container">

                        <img
                            id="previewImage"
                            class="preview-image"
                            src="<?= $isEdit
                            ? base_url(
                                'uploads/banner/' .
                                ($bannerData['gambar'] ?? '')
                            )
                            : ''; ?>"
                        >

                    </div>

                    <!-- JUDUL -->
                    <div class="form-group">

                        <label class="form-label">
                            Judul Banner
                        </label>

                        <input
                            type="text"
                            name="judul_banner"
                            class="form-control"
                            placeholder="Masukkan judul banner"
                            value="<?= $isEdit
                            ? esc($bannerData['judul_banner'] ?? '')
                            : ''; ?>"
                            required
                        >

                    </div>

                    <!-- DESKRIPSI -->
                    <div class="form-group">

                        <label class="form-label">
                            Deskripsi Banner
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            placeholder="Masukkan deskripsi banner"
                        ><?= $isEdit
                        ? esc($bannerData['deskripsi'] ?? '')
                        : ''; ?></textarea>

                    </div>

                    <!-- BUTTON -->
                    <div class="bottom-actions">

                        <button
                            type="button"
                            class="btn-custom btn-cancel"
                            onclick="
                            document.getElementById('step2').classList.add('hidden');
                            document.getElementById('step1').classList.remove('hidden');
                            "
                        >
                            Kembali
                        </button>

                        <button
                            type="submit"
                            class="btn-custom btn-draft"
                            onclick="
                            document.querySelector('[name=status_banner]').value='tidak aktif'
                            "
                        >
                            Draft
                        </button>

                        <button
                            type="submit"
                            class="btn-custom btn-upload"
                            onclick="
                            document.querySelector('[name=status_banner]').value='aktif'
                            "
                        >
                            <?= $isEdit ? 'Update Banner' : 'Unggah'; ?>
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

<script>

const bannerInput =
document.getElementById('bannerInput');

/*
|--------------------------------------------------------------------------
| PREVIEW IMAGE
|--------------------------------------------------------------------------
*/
bannerInput.addEventListener('change', function(){

    const file =
    this.files[0];

    if(file){

        const imageURL =
        URL.createObjectURL(file);

        // STEP 1
        document
        .getElementById('previewImageStep1')
        .src = imageURL;

        // STEP 2
        document
        .getElementById('previewImage')
        .src = imageURL;

        // SHOW PREVIEW
        document
        .getElementById('previewStep1')
        .classList.remove('hidden');

        // HIDE DEFAULT
        document
        .getElementById('defaultUploadContent')
        .style.display = 'none';
    }

});

/*
|--------------------------------------------------------------------------
| NEXT STEP
|--------------------------------------------------------------------------
*/
document
.getElementById('nextStepBtn')
.addEventListener('click', function(){

    const file =
    bannerInput.files[0];

    if(!file){

        alert('Silakan pilih gambar terlebih dahulu');
        return;
    }

    // HIDE STEP 1
    document
    .getElementById('step1')
    .classList.add('hidden');

    // SHOW STEP 2
    document
    .getElementById('step2')
    .classList.remove('hidden');

    // ACTIVE STEP 2
    document
    .getElementById('step2Number')
    .classList.remove('inactive');

});

</script>

<?= $this->endSection(); ?>