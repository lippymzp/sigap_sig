<?= $this->extend('layout/dashboard_layout_admin'); ?>

<?= $this->section('style'); ?>

<style>

body{
    background:#f4f7f7;
    font-family:'Poppins', sans-serif;
}

/* PAGE TITLE */

.page-title{
    font-size:58px;
    font-weight:800;
    color:#000;
    margin-bottom:30px;
    line-height:1;
}

/* WRAPPER */

.upload-wrapper{
    background:#edf6f6;
    border-radius:38px;
    padding:40px 42px 35px;
    box-shadow:none;
    border:1px solid #e4eeee;
}

/* HEADER */

.label-title{
    font-size:28px;
    font-weight:800;
    color:#111;
    margin-bottom:4px;
}

.label-sub{
    color:#8f8f8f;
    font-size:16px;
    margin-bottom:16px;
    font-weight:500;
}

.upload-wrapper hr{
    border-color:#dce5e5;
    opacity:1;
    margin:0;
}

/* LABEL */

.form-label-custom{
    font-size:18px;
    font-weight:700;
    margin-bottom:12px;
    color:#111;
}

/* INPUT */

.input-custom{
    border:2px solid #29c7d3;
    border-radius:18px;
    height:54px;
    padding:14px 20px;
    width:100%;
    outline:none;
    font-size:16px;
    background:#fff;
    transition:0.3s;
    color:#444;
    font-weight:500;
}

.input-custom:focus{
    border-color:#17c9d8;
    box-shadow:none;
}

.input-custom::placeholder{
    color:#c7c7c7;
}

/* ERROR */

.input-error{
    border:2px solid #ff4f4f !important;
    background:#fff5f5 !important;
}

.error-text{
    color:#ff4f4f;
    font-size:14px;
    margin-top:8px;
    font-weight:600;
    display:none;
}

/* HILANGKAN VALIDASI BAWAAN */

input:invalid,
textarea:invalid{
    box-shadow:none !important;
    outline:none !important;
}

/* EDITOR */

.editor-box{
    border:2px solid #29c7d3;
    border-radius:22px;
    overflow:hidden;
    background:white;
}

.editor-error{
    border:2px solid #ff4f4f !important;
}

/* TOOLBAR */

.editor-toolbar{
    background:#16bcc7;
    padding:10px 12px;
    display:flex;
    align-items:center;
    gap:4px;
    flex-wrap:nowrap;
    overflow-x:auto;
    overflow-y:hidden;
    scrollbar-width:none;
    -ms-overflow-style:none;
}

.editor-toolbar::-webkit-scrollbar{
    display:none;
}

/* PEMBATAS TOOLBAR */

.toolbar-divider{
    width:1px;
    min-width:1px;
    height:22px;
    background:rgba(255,255,255,0.45);
    margin:0 2px;
    flex-shrink:0;
}

/* SELECT FONT & SIZE */

.toolbar-select{
    height:28px;
    padding:0 8px;
    border:none;
    border-radius:6px;
    outline:none;
    background:#fff;
    font-size:11px;
    font-weight:600;
    color:#222;
    cursor:pointer;
    min-width:74px;
    max-width:74px;
    appearance:none;
    flex-shrink:0;
}

.toolbar-size{
    min-width:52px;
    max-width:52px;
}

/* TOOLBAR BUTTON */

.toolbar-btn{
    border:none;
    background:transparent;
    font-size:13px;
    color:#000;
    width:28px;
    min-width:28px;
    height:28px;
    border-radius:6px;
    cursor:pointer;
    transition:0.2s;
    font-weight:600;
    flex-shrink:0;
}

.toolbar-btn:hover{
    background:rgba(255,255,255,0.35);
}

.toolbar-btn.active{
    background:white;
}

/* CONTENT */

.editor-content{
    font-family:'Poppins', sans-serif !important;
    min-height:260px;
    padding:22px;
    outline:none;
    font-size:17px;
    color:#444;
    font-weight:500;
    line-height:1.8;
    word-break:break-word;
}

.editor-content p{
    margin-bottom:14px;
}

.editor-content:empty::before{
    content:attr(placeholder);
    color:#cfcfcf;
    pointer-events:none;
    display:block;
}

/* IMAGE EDITOR */

.editor-content img,
.editor-image{
    max-width:100%;
    min-width:120px;
    width:300px;
    height:auto !important;
    border-radius:12px;
    margin:20px auto;
    display:block;
    cursor:grab;
    user-select:none;
    position:relative;
}

.editor-content img.selected-image,
.editor-image.selected-image{
    outline:3px solid #18c4d1;
}

/* TEXTAREA */

.textarea-custom{
    border:2px solid #29c7d3;
    border-radius:18px;
    padding:16px 22px;
    width:100%;
    outline:none;
    font-size:17px;
    background:white;
    transition:0.3s;
    resize:none;
    height:54px;
    min-height:54px;
    overflow:hidden;
    font-weight:500;
}

.textarea-custom:focus{
    border-color:#17c9d8;
    box-shadow:none;
}

/* COUNTER */

.counter-text{
    text-align:right;
    color:#c6c6c6;
    margin-top:10px;
    margin-bottom:25px;
    font-size:14px;
    font-weight:600;
}

/* RIGHT SIDE */

.upload-side{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    gap:40px;
    height:100%;
}

/* BOX */

.upload-box{
    background:#fff;
    border-radius:22px;
    padding:24px 20px;
    text-align:center;
    width:100%;
    max-width:300px;
}

/* BOX TITLE */

.upload-title{
    font-size:17px;
    font-weight:800;
    margin-bottom:20px;
    color:#111;
}

/* AREA */

.upload-area{
    border:2px dashed #a9a9a9;
    width:100%;
    height:220px;
    display:flex;
    justify-content:center;
    align-items:center;
    cursor:pointer;
    transition:0.3s;
    overflow:hidden;
    background:#fff;
    position:relative;
    text-align:center;
}

.upload-area:hover{
    border-color:#18c4d1;
}

.upload-area-error{
    border:2px dashed #ff4f4f !important;
    background:#fff5f5 !important;
}

/* PREVIEW */

.preview-image{
    width:100%;
    height:100%;
    object-fit:contain;
    display:none;
    padding:10px;
    background:#fff;
}

/* ICON */

.upload-icon{
    width:52px;
    height:52px;
    border:2px solid #29c7d3;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto auto 14px;
    color:#16bcc7;
    font-size:24px;
}

/* TEXT */

.upload-click{
    font-size:15px;
    font-weight:800;
    color:#222;
    margin-bottom:4px;
}

.upload-note{
    font-size:12px;
    color:#b7b7b7;
    font-weight:500;
}

/* ACTION BUTTON AREA */

.custom-action{
    margin-top:40px;
    padding-top:25px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
    flex-wrap:nowrap;
    width:100%;
}

.button-wrapper{
    display:flex;
    align-items:center;
    gap:12px;
    margin-left:auto;
    flex-wrap:nowrap;
}

/* BUTTON DASAR */

.cancel-btn,
.draft-btn,
.upload-btn{
    height:42px !important;
    min-width:auto;
    padding:0 22px;
    border-radius:999px !important;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:14px !important;
    font-weight:700 !important;
    white-space:nowrap;
    transition:all .25s ease;
}

/* BATAL */

.cancel-btn{
    background:#fff !important;
    border:2px solid #d6d6d6 !important;
    color:#000 !important;
    text-decoration:none;
}

.cancel-btn:hover{
    background:#f3f3f3 !important;
}

/* DRAFT */

.draft-btn{
    background:#fff !important;
    border:2px solid #ef4b3f !important;
    color:#ef4b3f !important;
}

.draft-btn:hover{
    background:#fff3f2 !important;
}

/* UPLOAD */

.upload-btn{
    background:#27b9c2 !important;
    border:none !important;
    color:#fff !important;
    box-shadow:none !important;
}

.upload-btn:hover{
    background:#179ea7 !important;
}

/* ICON */

.draft-btn i,
.upload-btn i{
    font-size:13px;
}

/* MODAL */

.custom-modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.18);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:99999 !important;
}

.modal-box{
    width:370px;
    background:white;
    border-radius:18px;
    padding:34px 28px 24px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.12);
}

.modal-icon{
    width:54px;
    height:54px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    margin:auto auto 18px;
    font-size:24px;
}

.success-icon{
    background:#57bf87;
}

.error-icon{
    background:#ff4f4f;
}

.modal-title{
    font-size:22px;
    font-weight:800;
    color:#111;
    margin-bottom:6px;
}

.modal-desc{
    font-size:16px;
    color:#666;
    margin-bottom:18px;
    line-height:1.5;
}

.modal-btn{
    width:100%;
    border:none;
    background:#16c4d2;
    color:white;
    height:50px;
    border-radius:12px;
    font-size:16px;
    font-weight:700;
}

.modal-btn:hover{
    background:#0db6c4;
}

.modal-link{
    margin-top:12px;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    color:#666;
    font-size:16px;
    font-weight:600;
    background:white;
    border:1px solid #dcdcdc;
    border-radius:10px;
    width:120px;
    height:46px;
}

/* WARNING UPLOAD */

.error-upload{
    display:none;
    margin-top:14px;
    background:#fff1f1;
    border:1px solid #ffb3b3;
    color:#ff4f4f;
    padding:12px 14px;
    border-radius:12px;
    font-size:14px;
    font-weight:700;
    text-align:center;
}

/* RESPONSIVE */

@media(max-width:992px){

    .page-title{
        font-size:42px;
    }

    .upload-wrapper{
        padding:25px;
    }

    .upload-side{
        margin-top:35px;
    }

    .custom-action{
        flex-direction:row;
        flex-wrap:wrap;
        align-items:center;
        gap:10px;
    }

    .button-wrapper{
        flex-direction:row;
        flex-wrap:wrap;
        width:auto;
        gap:10px;
    }

    .editor-toolbar{
        gap:4px;
        padding:8px 10px;
        flex-wrap:nowrap;
        overflow-x:auto;
    }

    .toolbar-select{
        min-width:70px;
        max-width:70px;
        font-size:10px;
        height:26px;
    }

    .toolbar-size{
        min-width:48px;
        max-width:48px;
    }

    .toolbar-btn{
        width:26px;
        min-width:26px;
        height:26px;
        font-size:12px;
    }

    .toolbar-divider{
        height:20px;
    }

    .editor-content{
        font-size:15px;
    }
}

/* ================= FIX FOOTER FINAL ================= */

html,
body {
    overflow-x: hidden;
}

.content-wrapper {
    width: 100%;
    overflow: hidden;
}


.row {
    margin-left: 0 !important;
    margin-right: 0 !important;
}

/* hanya atur upload-side, jangan paksa col-lg-4 */
.col-lg-4{
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.upload-side {
    width: 100%;
    max-width: 320px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 30px;
    height: 100%;
    margin: 0 auto;
    position: relative;
}


</style>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">

    <div class="upload-wrapper">

        <div class="label-title">
            Detail Informasi Funfact
        </div>

        <div class="label-sub">
            Lengkapi data funfact SIG untuk dipublikasikan.
        </div>

 <!-- STATUS -->

<form action="<?= isset($f)
    ? site_url('funfact/update/'.$f['id_funfact'])
    : site_url('funfact/simpan') ?>"
      
      method="post"
      enctype="multipart/form-data"
      id="funfactForm"
      novalidate>

<input type="hidden"
       name="status_funfact"
       id="status_funfact"
       value="<?= isset($f) ? $f['status_funfact'] : 'upload' ?>">

<input type="hidden" name="id_funfact" value="<?= $f['id_funfact'] ?? '' ?>">

            <div class="row mt-5 align-items-start">

                <div class="col-lg-8 pe-lg-5">

                    <!-- JUDUL -->

                    <div class="mb-4">

                        <label class="form-label-custom">
                            Judul Funfact
                        </label>

                        <input type="text"
       name="judul_funfact"
       class="input-custom"
       placeholder="Masukkan judul funfact utama..."
       value="<?= $f['judul_funfact'] ?? '' ?>"
       required>

                        <div class="error-text">
                            Judul funfact wajib diisi
                        </div>

                    </div>

                    <!-- ISI -->

                    <div class="mb-4">

                        <label class="form-label-custom">
                            Isi Funfact
                        </label>

                        <div class="editor-box" id="editorBox">

                            <div class="editor-toolbar">

                            <select class="toolbar-select"
                            onchange="changeFont(this.value)">

                        <option value="Poppins">Poppins</option>
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Courier New">Courier New</option>

                    </select>

                    <select class="toolbar-select toolbar-size"
                    onchange="changeFontSize(this.value)">

                <option value="2">10</option>
                <option value="3" selected>12</option>
                <option value="4">14</option>
                <option value="5">18</option>
                <option value="6">24</option>
                <option value="7">32</option>

            </select>
            <div class="toolbar-divider"></div>
                                <button type="button"
                                        class="toolbar-btn"
                                        onclick="formatText('bold', this)">
                                    <i class="fa-solid fa-bold"></i>
                                </button>

                                <button type="button"
                                        class="toolbar-btn"
                                        onclick="formatText('italic', this)">
                                    <i class="fa fa-italic"></i>
                                </button>

                                <button type="button"
                                        class="toolbar-btn"
                                        onclick="formatText('underline', this)">
                                    <i class="fa fa-underline"></i>
                                </button>

                                <div class="toolbar-divider"></div>

                                                    <button type="button"
                                class="toolbar-btn"
                                onclick="formatText('justifyLeft', this)">
                            <i class="fa fa-align-left"></i>
                        </button>

                            <button type="button"
                                    class="toolbar-btn"
                                    onclick="formatText('justifyCenter', this)">
                                <i class="fa fa-align-center"></i>
                            </button>

                            <button type="button"
                                    class="toolbar-btn"
                                    onclick="formatText('justifyRight', this)">
                                <i class="fa fa-align-right"></i>
                            </button>

                            <button type="button"
                                    class="toolbar-btn"
                                    onclick="formatText('justifyFull', this)">
                                <i class="fa fa-align-justify"></i>
                            </button>

                            <div class="toolbar-divider"></div>

                                <button type="button"
                                        class="toolbar-btn"
                                        onclick="formatText('insertUnorderedList', this)">
                                    <i class="fa fa-list"></i>
                                </button>

                                <button type="button"
                            class="toolbar-btn"
                            onclick="formatText('insertOrderedList', this)">
                        <i class="fa fa-list-ol"></i>
                    </button>

                        <div class="toolbar-divider"></div>

                                <button type="button"
                                        class="toolbar-btn"
                                        onclick="addLink(this)">
                                    <i class="fa fa-link"></i>
                                </button>

                                <button type="button"
                                        class="toolbar-btn"
                                        onclick="document.getElementById('editorImageInput').click()">
                                    <i class="fa fa-image"></i>
                                </button>

                                <input type="file"
                                       id="editorImageInput"
                                       accept="image/*"
                                       multiple
                                       hidden>
                            
                            </div>

                            <div id="editor"
     class="editor-content"
     contenteditable="true"
     placeholder="Masukkan isi funfact..."
     onkeyup="syncEditor()"
     onclick="syncEditor()"><?= html_entity_decode($f['isi_funfact'] ?? '') ?></div>

                           <textarea name="isi_funfact"
          id="hiddenTextarea"
          hidden
          required><?= html_entity_decode($f['isi_funfact'] ?? '') ?></textarea>

                        </div>

                        <div class="error-text" id="editorError">
                            Isi funfact wajib diisi
                        </div>

                    </div>

                    <!-- RINGKASAN -->

                    <div class="mb-4">

                        <label class="form-label-custom">
                            Ringkasan / Deskripsi Singkat
                        </label>

                        <textarea name="deskripsi_funfact"
          maxlength="200"
          class="textarea-custom"
          id="deskripsi"
          placeholder="Masukkan ringkasan funfact..."
          required><?= $f['deskripsi_funfact'] ?? '' ?></textarea>

                        <div class="counter-text">
                            <span id="counter">0</span>/200
                        </div>

                        <div class="error-text">
                            Ringkasan wajib diisi
                        </div>

                    </div>

                    <!-- LINK -->

                    <div class="mb-4">

                        <label class="form-label-custom">
                            Link Sumber
                        </label>

                        <input type="text"
       name="url"
       class="input-custom"
       placeholder="https://..."
       value="<?= $f['url'] ?? '' ?>"
       required>

                        <div class="error-text">
                            Link sumber wajib diisi
                        </div>

                    </div>

                    <!-- PENULIS -->

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label-custom">
                                Penulis
                            </label>

                            <input type="text"
       name="penulis"
       class="input-custom"
       value="<?= $f['penulis'] ?? '' ?>"
       required>

                            <div class="error-text">
                                Penulis wajib diisi
                            </div>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label-custom">
                                Tanggal Unggah
                            </label>

                            <input type="datetime-local"
       name="tanggal_funfact"
       id="tanggal_funfact"
       class="input-custom"
       value="<?= isset($f['tanggal_funfact']) 
            ? date('Y-m-d\TH:i', strtotime($f['tanggal_funfact'])) 
            : '' ?>"
       required>

                            <div class="error-text">
                                Tanggal unggah wajib diisi
                            </div>

                        </div>

                    </div>

                    <!-- ACTION -->

                    <div class="action-row custom-action">

                       <a href="<?= site_url('funfact') ?>"
   class="cancel-btn"
   id="cancelButton">
    Batal
</a>

                        <div class="button-wrapper">

                            <button type="button"
                                    class="btn draft-btn"
                                    id="draftButton">

                                <i class="fa fa-save me-2"></i>

                                Simpan Draft

                            </button>

                          <button type="button" class="btn upload-btn" id="submitButton">

   <?php if(isset($f) && $f['status_funfact'] == 'upload') : ?>

    <i class="fa fa-pen me-2"></i>
    Simpan Perubahan

<?php else : ?>

    <i class="fa fa-arrow-up me-2"></i>
    Unggah

<?php endif; ?>

</button>

                        </div>

                    </div>

                </div>

 <!-- RIGHT -->
<div class="col-lg-4">

    <div class="upload-side">

        <div class="upload-box">

            <div class="upload-title">
                UNGGAH GAMBAR
            </div>

            <div class="upload-area" id="gambarArea">

                <input
                    type="file"
                    id="gambarInput"
                    name="gambar_funfact"
                    accept=".png,.jpg,.jpeg,.webp"
                    hidden
                >

                <img
                    id="previewImage"
                    class="preview-image"
                    src="<?= !empty($f['gambar_funfact']) ? base_url('uploads/funfact/'.$f['gambar_funfact']) : '' ?>"
                    style="<?= !empty($f['gambar_funfact']) ? 'display:block;' : 'display:none;' ?>"
                >

                <div
                    id="uploadContent"
                    style="<?= !empty($f['gambar_funfact']) ? 'display:none;' : '' ?>"
                >

                    <div class="upload-icon">
                        <i class="fa fa-upload"></i>
                    </div>

                    <div class="upload-click">
                        KLIK UNTUK UNGGAH
                    </div>

                    <div class="upload-note">
                        PNG, JPG, atau WEBP (maks 5mb)
                    </div>

                </div>

            </div>

            <div class="error-upload" id="gambarError">
                <i class="fa fa-circle-exclamation me-1"></i>
                Gambar wajib diunggah
            </div>

        </div>

    </div>

</div>

<?php
$isEditUpload = isset($f) && $f['status_funfact'] == 'upload';
?>

<!-- SUCCESS MODAL -->

<div class="custom-modal" id="successModal">

    <div class="modal-box">

        <div class="modal-icon success-icon">
            <i class="fa fa-check"></i>
        </div>

        <div class="modal-title" id="successTitle">
            <?= $isEditUpload
                ? 'Update Funfact Berhasil'
                : 'Unggah Funfact Berhasil' ?>
        </div>

        <div class="modal-desc" id="successDesc">
            <?= $isEditUpload
                ? 'Funfact berhasil diperbarui'
                : 'Funfact berhasil diunggah' ?>
        </div>

 <button class="modal-btn"
        id="lihatTampilanBtn">
    Lihat Tampilan
</button>

<a href="#"
   class="modal-link"
   id="selesaiBtn">
    Selesai
</a>

    </div>

</div>

<!-- DRAFT MODAL -->

<div class="custom-modal" id="draftModal">

    <div class="modal-box">

        <div class="modal-icon success-icon">
            <i class="fa fa-check"></i>
        </div>

        <div class="modal-title">
            Berhasil
        </div>

        <div class="modal-desc">
            Data berhasil disimpan di draft
        </div>

        <button class="modal-btn"
                id="draftOkBtn">
            Oke
        </button>

    </div>

</div>

<!-- ERROR MODAL -->

<div class="custom-modal" id="errorModal">

    <div class="modal-box">

        <div class="modal-icon error-icon">
            <i class="fa fa-times"></i>
        </div>

        <div class="modal-title">
            Data Belum Lengkap
        </div>

        <div class="modal-desc">
            Funfact gagal diunggah, mohon lengkapi semua kolom
        </div>

        <button class="modal-btn"
                id="closeErrorModal">
            Lengkapi Data
        </button>

    </div>

</div>

<!-- MODAL SIMPAN PERUBAHAN -->

<div class="custom-modal" id="editConfirmModal">

    <div class="modal-box">

        <div class="modal-icon success-icon">
            <i class="fa fa-pen"></i>
        </div>

        <div class="modal-title">
            Edit Funfact
        </div>

        <div class="modal-desc">
            Apakah Anda ingin mengubah funfact ini?
        </div>

        <button type="button"
                class="modal-btn"
                id="confirmSubmitBtn">
            Ya
        </button>

        <button type="button"
                class="modal-link"
                id="closeSubmitModal">
            Tidak
        </button>

    </div>

</div>

<!-- MODAL BATAL -->
<div class="custom-modal" id="cancelConfirmModal">

    <div class="modal-box">

        <div class="modal-icon error-icon">
            <i class="fa fa-exclamation"></i>
        </div>

        <div class="modal-title">
            Konfirmasi
        </div>

        <div class="modal-desc">
            Apakah Anda yakin ingin mengurungkan perubahan ini?
        </div>

        <button type="button"
                class="modal-btn"
                id="confirmCancelBtn">
            Ya
        </button>

        <button type="button"
                class="modal-link"
                id="closeCancelModal">
            Tidak
        </button>

    </div>

</div>

<script>

let isSubmitConfirmed = false;

const submitBtn = document.getElementById('submitButton');

if(submitBtn){
    submitBtn.addEventListener('click', function(){

        syncEditor();

        // ⬇️ WAJIB: set status ke upload dulu
        document.getElementById('status_funfact').value = 'upload';

        if(!validateForm()){
            document.getElementById('errorModal').style.display = 'flex';
            return;
        }

        <?php if(isset($f) && $f['status_funfact'] == 'upload') : ?> 
            document.getElementById('editConfirmModal').style.display = 'flex';
<?php else : ?>

    clearLocalStorage();

    // munculkan popup berhasil
    document.getElementById('successModal').style.display = 'flex';

// simpan status modal
sessionStorage.setItem('showSuccessUploadModal', 'true');

<?php endif; ?>

    });
}

const form = document.getElementById('funfactForm');

const STORAGE_KEY = 'funfact_autosave';

/* =========================
SYNC EDITOR
========================= */

function syncEditor()
{
    document.getElementById('hiddenTextarea').value =
    document.getElementById('editor').innerHTML;

    saveFormToLocal();
}

/* =========================
AUTO SAVE
========================= */

function saveFormToLocal()
{
    const data = {

        judul :
        document.querySelector('[name="judul_funfact"]').value,

        isi :
        document.getElementById('editor').innerHTML,

        deskripsi :
        document.getElementById('deskripsi').value,

        url :
        document.querySelector('[name="url"]').value,

        penulis :
        document.querySelector('[name="penulis"]').value,

        tanggal :
        document.getElementById('tanggal_funfact').value
    };

    localStorage.setItem(
        STORAGE_KEY,
        JSON.stringify(data)
    );
}

function changeFont(font)
{
    document.execCommand('fontName', false, font);

    syncEditor();

    document.getElementById('editor').focus();
}

function changeFontSize(size)
{
    document.execCommand('fontSize', false, size);

    syncEditor();

    document.getElementById('editor').focus();
}

/* =========================
LOAD AUTO SAVE
========================= */

window.addEventListener('load', function(){

    // JIKA MODE EDIT -> jangan load localStorage
    <?php if(!isset($f)) : ?>

    const saved = localStorage.getItem(STORAGE_KEY);

    if(saved){

        const data = JSON.parse(saved);

        document.querySelector('[name="judul_funfact"]').value =
            data.judul || '';

        document.getElementById('editor').innerHTML =
            data.isi || '';

        document.getElementById('deskripsi').value =
            data.deskripsi || '';

        document.querySelector('[name="url"]').value =
            data.url || '';

        document.querySelector('[name="penulis"]').value =
            data.penulis || '';

        document.getElementById('tanggal_funfact').value =
            data.tanggal || '';

        syncEditor();
    }

    <?php endif; ?>

});

/* =========================
CLEAR AUTO SAVE
========================= */

function clearLocalStorage()
{
    localStorage.removeItem(STORAGE_KEY);
}

/* =========================
EDITOR INPUT
========================= */

document.getElementById('editor')
.addEventListener('input', function(){

    syncEditor();

    removeEditorError();

});

let selectedImage = null;

document.addEventListener('click', function(e){

    if(e.target.classList.contains('editor-image'))
    {
        selectedImage = e.target;

        document.querySelectorAll('.editor-image')
        .forEach(img => {

            img.style.outline = 'none';

        });

        selectedImage.style.outline =
        '3px solid #18c4d1';
    }
});

/* =========================
ZOOM IMAGE
========================= */

document.addEventListener('keydown', function(e){

    if(
        (e.key === 'Backspace' || e.key === 'Delete')
        && selectedImage
    ){
        e.preventDefault();

        selectedImage.remove();

        selectedImage = null;

        syncEditor();
    }

});

/* =========================
FORMAT
========================= */

function formatText(command, button = null)
{
    document.execCommand(command, false, null);

    document.getElementById('editor').focus();

    syncEditor();

    if(button)
    {
        button.classList.toggle('active');
    }
}

function addLink(button = null)
{
    const url = prompt('Masukkan link:');

    if(url && url.trim() !== '')
    {
        document.execCommand(
            'createLink',
            false,
            url
        );

        syncEditor();

        if(button)
        {
            button.classList.toggle('active');
        }
    }
}

function checkEditorPlaceholder() {

    const editor = document.getElementById('editor');

    if(editor.innerHTML === '<br>' || editor.innerHTML === '&nbsp;'){
        editor.innerHTML = '';
    }
}

document.getElementById('editor').addEventListener('input', checkEditorPlaceholder);

window.addEventListener('load', checkEditorPlaceholder);

/* =========================
UPLOAD IMAGE EDITOR
========================= */

document.getElementById('editorImageInput')
.addEventListener('change', function () {

    const files = this.files;

    if (!files.length) return;

    Array.from(files).forEach(file => {

        const reader = new FileReader();

        reader.onload = function (e) {

            const img = document.createElement('img');

            img.src = e.target.result;

            img.classList.add('editor-image');
            img.setAttribute('data-base64', e.target.result);

            img.style.width = '300px';
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
            img.style.borderRadius = '12px';
            img.style.display = 'block';
            img.style.margin = '20px auto';
            img.style.cursor = 'pointer';

            // supaya gambar bisa dipilih
            img.addEventListener('click', function () {

    document.querySelectorAll('.editor-image')
    .forEach(el => {
        el.classList.remove('selected-image');
    });

    img.classList.add('selected-image');

    selectedImage = img;

    enableImageResize(img);

});

            document.getElementById('editor')
            .appendChild(img);
            enableImageResize(img);

            syncEditor();

        };

        reader.readAsDataURL(file);

    });

    // RESET INPUT BIAR BISA UPLOAD LAGI
    this.value = '';

});

/* =========================
DELETE IMAGE
========================= */

document.addEventListener('keydown', function(e){

    if(
        (e.key === 'Backspace' || e.key === 'Delete')
        && selectedImage
    ){
        e.preventDefault();

        selectedImage.remove();

        selectedImage = null;

        syncEditor();
    }

});

/* =========================
RESIZE IMAGE
========================= */

function enableImageResize(img)
{
    // hapus interact sebelumnya
    interact(img).unset();

    // resize image
    interact(img).resizable({

        edges: {
            left: true,
            right: true,
            bottom: true,
            top: true
        },

        listeners: {
            move(event) {

                let target = event.target;

                let width = event.rect.width;
                let height = event.rect.height;

                target.style.width = width + 'px';
                target.style.height = height + 'px';

                syncEditor();
            }
        },

        modifiers: [
            interact.modifiers.restrictSize({
                min: {
                    width: 120,
                    height: 80
                }
            })
        ],

        inertia: true
    });

    // pilih gambar
    img.addEventListener('click', function () {

        document.querySelectorAll('.editor-image')
        .forEach(el => {
            el.classList.remove('selected-image');
        });

        img.classList.add('selected-image');

        selectedImage = img;
    });
}

/* =========================
COUNTER
========================= */

const deskripsi =
document.getElementById('deskripsi');

document.getElementById('counter').innerText =
deskripsi.value.length;

deskripsi.addEventListener('input', function(){

    document.getElementById('counter').innerText =
    this.value.length;

    removeFieldError(this);

    saveFormToLocal();

});

/* =========================
PREVIEW GAMBAR
========================= */

document.getElementById('gambarInput')
.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file)
    {
        const reader = new FileReader();

        reader.onload = function(event){

            document.getElementById('previewImage').src =
            event.target.result;

            document.getElementById('previewImage').style.display =
            'block';

            document.getElementById('uploadContent').style.display =
            'none';

            document.getElementById('gambarError')
            .style.display = 'none';

            document.getElementById('gambarArea')
            .classList.remove('upload-area-error');
        }

        reader.readAsDataURL(file);
    }

});

/* =========================
CLICK AREA GAMBAR
========================= */

document.getElementById('gambarArea')
.addEventListener('click', function(){

    document.getElementById('gambarInput').click();

});

/* =========================
REMOVE ERROR
========================= */

function removeFieldError(field)
{
    if(field.value.trim() != '')
    {
        field.classList.remove('input-error');

        const error =
        field.parentElement.querySelector('.error-text');

        if(error)
        {
            error.style.display = 'none';
        }
    }
}

function removeEditorError()
{
    const isi =
    document.getElementById('editor').textContent.trim();

    if(isi != '')
    {
        document.getElementById('editorBox')
        .classList.remove('editor-error');

        document.getElementById('editorError')
        .style.display = 'none';
    }
}

/* =========================
REALTIME REMOVE ERROR
========================= */

document.querySelectorAll(
'.input-custom, .textarea-custom'
).forEach(field => {

    field.addEventListener('input', function(){

        removeFieldError(this);

        saveFormToLocal();

    });

});

/* =========================
VALIDASI
========================= */

function validateForm()
{
    syncEditor();

    let valid = true;

    const status =
    document.getElementById('status_funfact').value;

    document.querySelectorAll(
        '.input-custom, .textarea-custom'
    ).forEach(field => {

        const error =
        field.parentElement.querySelector('.error-text');

        field.classList.remove('input-error');

        if(error)
        {
            error.style.display = 'none';
        }

        /* =========================
           JIKA DRAFT
        ========================= */

        if(field.value.trim() == '' && status != 'draft')
{
    valid = false;

            field.classList.add('input-error');

            if(error)
            {
                error.style.display = 'block';
            }
        }

    });

    /* VALIDASI EDITOR */

    const isi =
    document.getElementById('editor').textContent.trim();

    document.getElementById('editorBox')
    .classList.remove('editor-error');

    document.getElementById('editorError')
    .style.display = 'none';

    if(isi == '' && status != 'draft')
    {
        valid = false;

        document.getElementById('editorBox')
        .classList.add('editor-error');

        document.getElementById('editorError')
        .style.display = 'block';
    }

    /* VALIDASI GAMBAR */

    const gambarInput =
    document.getElementById('gambarInput');

    const previewImage =
    document.getElementById('previewImage');

    const gambarArea =
    document.getElementById('gambarArea');

    const gambarError =
    document.getElementById('gambarError');

    gambarError.style.display = 'none';

    gambarArea.classList.remove('upload-area-error');

    let adaGambar = false;

    if(gambarInput.files.length > 0)
    {
        adaGambar = true;
    }

    if(
        previewImage.src &&
        previewImage.style.display != 'none'
    ){
        adaGambar = true;
    }

   if(!adaGambar && status != 'draft')
{
    valid = false;

    gambarError.style.display = 'block';

    gambarArea.classList.add('upload-area-error');
}

    return valid;
}


/* =========================
DRAFT
========================= */

const draftButton = document.getElementById('draftButton');

if(draftButton)
{
    draftButton.addEventListener('click', function(e){

        e.preventDefault();

        syncEditor();

        /* UBAH STATUS */
        document.getElementById('status_funfact').value = 'draft';

        /* HAPUS VALIDASI REQUIRED */
        document.querySelectorAll(
            '.input-custom, .textarea-custom'
        ).forEach(field => {

            field.removeAttribute('required');

        });

        const hiddenTextarea =
        document.getElementById('hiddenTextarea');

        if(hiddenTextarea)
        {
            hiddenTextarea.removeAttribute('required');
        }

        setTimeout(() => {

            clearLocalStorage();

            HTMLFormElement.prototype.submit.call(form);

        }, 100);

    });
}

/* =========================
MODAL
========================= */

const closeErrorModal =
document.getElementById('closeErrorModal');

if(closeErrorModal)
{
    closeErrorModal.onclick = function(e){

        e.preventDefault();

        e.stopPropagation();

        document.getElementById('errorModal')
        .style.display = 'none';

        const firstError =
        document.querySelector('.input-error');

        if(firstError)
        {
            firstError.focus();

            firstError.scrollIntoView({
                behavior:'smooth',
                block:'center'
            });
        }

        if(
            document.getElementById('editorError')
            .style.display == 'block'
        ){
            document.getElementById('editor')
            .focus();
        }

    };
}

    /* JIKA ERROR EDITOR */

    const editorError =
    document.getElementById('editorError');

    if(
        editorError.style.display == 'block'
    ){
        document.getElementById('editor')
        .scrollIntoView({
            behavior:'smooth',
            block:'center'
        });

        document.getElementById('editor')
        .focus();
    }

const confirmSubmitBtn =
document.getElementById('confirmSubmitBtn');

if(confirmSubmitBtn)
{
    confirmSubmitBtn.addEventListener('click', function(){

    syncEditor();
    clearLocalStorage();

    // tutup modal konfirmasi
    document.getElementById('editConfirmModal').style.display = 'none';

    // submit normal
    document.getElementById('funfactForm').submit();

});

}

/* =========================
DRAFT OK BUTTON
========================= */

const draftOkBtn =
document.getElementById('draftOkBtn');

if(draftOkBtn)
{
    draftOkBtn.addEventListener('click', function(){

        document.getElementById('draftModal')
        .style.display = 'none';

        clearLocalStorage();

        HTMLFormElement.prototype.submit.call(form);

    });
}

/* =========================
CLOSE SUBMIT MODAL
========================= */

const closeSubmitModal =
document.getElementById('closeSubmitModal');

if(closeSubmitModal)
{
    closeSubmitModal.addEventListener('click', function(){

        document.getElementById('editConfirmModal')
        .style.display = 'none';

    });
}

/* =========================
SUCCESS BUTTON
========================= */

const selesaiBtn =
document.getElementById('selesaiBtn');

if(selesaiBtn)
{
    selesaiBtn.addEventListener('click', function(e){

        e.preventDefault();

        // tutup modal
        document.getElementById('successModal').style.display = 'none';

        // hapus autosave
        clearLocalStorage();

        // reset form
        document.getElementById('funfactForm').reset();

        // kosongkan editor
        document.getElementById('editor').innerHTML = '';

        // kosongkan textarea hidden
        document.getElementById('hiddenTextarea').value = '';

        // reset gambar
        document.getElementById('previewImage').src = '';
        document.getElementById('previewImage').style.display = 'none';

        document.getElementById('uploadContent').style.display = 'block';

        document.getElementById('gambarInput').value = '';

        // kembali ke halaman funfact / terunggah
        window.location.href = "<?= site_url('funfact') ?>";

    });
}

const lihatTampilanBtn = document.getElementById('lihatTampilanBtn');

if (lihatTampilanBtn) {

    lihatTampilanBtn.addEventListener('click', function () {

        syncEditor();

        const form = document.getElementById('funfactForm');

        const inputRedirect = document.createElement('input');

        inputRedirect.type = 'hidden';
        inputRedirect.name = 'redirect_view';
        inputRedirect.value = '1';

        form.appendChild(inputRedirect);

        form.submit();

    });

}

/* =========================
CLICK OUTSIDE MODAL
========================= */

document.querySelectorAll('.custom-modal')
.forEach(modal => {

    modal.addEventListener('click', function(e){

        if(e.target === modal)
        {
            modal.style.display = 'none';
        }

    });

});

/* =========================
FIX MODAL BUTTON
========================= */

document.querySelectorAll(
'.modal-btn, .modal-link'
).forEach(btn => {

    btn.addEventListener('click', function(e){

        e.stopPropagation();

    });

});

/* =========================
CLOSE MODAL
========================= */

window.addEventListener('click', function(e){

    document.querySelectorAll('.custom-modal')
    .forEach(modal => {

        if(e.target === modal)
        {
            modal.style.display = 'none';
        }

    });

});

/* =========================
CANCEL BUTTON (BATAL)
========================= */

const cancelBtn = document.getElementById('cancelButton');

if(cancelBtn){

    cancelBtn.addEventListener('click', function(e){

        <?php if(isset($f)) : ?> 

        e.preventDefault();

        document.getElementById('cancelConfirmModal')
        .style.display = 'flex';

        <?php else : ?> 

        <?php endif; ?>

    });

}

/* =========================
KLIK YA (LANJUTKAN BATAL)
========================= */

const confirmCancelBtn = document.getElementById('confirmCancelBtn');

if(confirmCancelBtn){
    confirmCancelBtn.addEventListener('click', function(){
        sessionStorage.setItem('showSuccessModal', 'true');
        window.history.back();

    });
}

/* =========================
KLIK TIDAK (TUTUP MODAL)
========================= */

const closeCancelModal = document.getElementById('closeCancelModal');

if(closeCancelModal){
    closeCancelModal.addEventListener('click', function(){

        document.getElementById('cancelConfirmModal')
        .style.display = 'none';

    });
}

window.addEventListener('load', function(){

    const input = document.getElementById('tanggal_funfact');

    const now = new Date();

    const formatted =
        now.getFullYear() + '-' +
        String(now.getMonth()+1).padStart(2,'0') + '-' +
        String(now.getDate()).padStart(2,'0') + 'T' +
        String(now.getHours()).padStart(2,'0') + ':' +
        String(now.getMinutes()).padStart(2,'0');

    // set batas maksimal = sekarang
    input.max = formatted;

});

/* =========================
SHOW SUCCESS MODAL AFTER BACK
========================= */

window.addEventListener('pageshow', function(event){

    // cek apakah sebelumnya klik tombol back
    const showModal =
    sessionStorage.getItem('showSuccessUploadModal');

    if(showModal === 'true')
    {
        document.getElementById('successModal')
        .style.display = 'flex';

        // hapus agar tidak muncul terus
        sessionStorage.removeItem('showSuccessUploadModal');
    }

});

let isUploading = false;

</script>

<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

<?= $this->endSection() ?>