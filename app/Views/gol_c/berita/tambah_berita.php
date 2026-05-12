<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<?php
$beritapneumonia = $beritapneumonia ?? [];
$newId = session()->getFlashdata('new_id');
?>

<style>
:root {
    --main: #00BBC2;
    --main-hover: #009ca3;
    --soft-bg: #eef7f6;
}

/* CARD */
.card-box {
    background: var(--soft-bg);
    border-radius: 15px;
    padding: 25px;
    position: relative;
    z-index: 1;
}

/* INPUT */
.form-control {
    border-radius: 10px;
    border: 1px solid var(--main);
}

/* TOOLBAR */
.toolbar-custom {
    background: var(--main);
    padding: 8px;
    border-radius: 10px 10px 0 0;
}

.toolbar-custom button {
    background: transparent;
    border: none;
    color: white;
    margin-right: 10px;
    font-weight: bold;
    cursor: pointer;
}

/* EDITOR */
#editor {
    min-height: 150px;
    padding: 10px;
    background: white;
    border: 1px solid var(--main);
    border-top: none;
    border-radius: 0 0 10px 10px;
}

/* BUTTON */
.btn-main {
    background: var(--main);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
}

.btn-main:hover {
    background: var(--main-hover);
}

.btn-draft {
    background: #e6f7f8;
    color: var(--main);
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
}
.btn-back {
    padding: 10px 40px;
    border-radius: 30px;
    border: 1.5px solid #00bcd4;
    background: #fff;
    color: #00bcd4;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: 0.25s ease;
}

.btn-back:hover {
    background: #00bcd4;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 188, 212, 0.25);
}

.btn-back:active {
    transform: scale(0.97);
}

/* TAB */
.tab-btn {
    background: #eee;
    border-radius: 8px;
    padding: 6px 16px;
    border: none;
}

.tab-btn.active {
    background: var(--main);
    color: white;
}

.popup-success {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: 0.25s ease;
}

.popup-success.show {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

.popup-box {
    width: 360px;
    background: white;
    border-radius: 18px;
    padding: 28px 22px;
    text-align: center;
    transform: translateY(20px) scale(0.95);
    transition: 0.3s ease;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}

.popup-success.show .popup-box {
    transform: translateY(0) scale(1);
}

/* ICON CIRCLE */
.popup-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 15px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    color: white;
}

/* STATUS VARIANT */
.popup-icon.publish {
    background: linear-gradient(135deg, #00c9a7, #00b894);
}

.popup-icon.draft {
    background: linear-gradient(135deg, #fdcb6e, #e17055);
}

/* TEXT */
.modal-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 5px;
}

.modal-desc {
    font-size: 13px;
    color: #666;
    margin-bottom: 18px;
}

/* BUTTON */
.popup-btn {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 10px;
    background: #00BBC2;
    color: white;
    font-weight: 600;
    cursor: pointer;
}

.popup-btn:hover {
    background: #009ca3;
}

.popup-icon.error {
    background: linear-gradient(135deg, #ff7675, #d63031);
}

.popup-btn.error {
    background: #d63031;
}

.popup-btn.error:hover {
    background: #c0392b;
}
.toolbar-modern {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-bottom: none;
    background: #00BBC2;
    border-radius: 10px 10px 0 0;
}

.select-style {
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 4px 8px;
    font-size: 13px;
    background: white;
}

.toolbar-modern button {
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 6px 8px;
    border-radius: 6px;
}

.toolbar-modern button:hover {
    background: #00BBC2;
}

.divider {
    width: 1px;
    height: 20px;
    background: #ccc;
}
.error-text{
    color:#e74c3c;
    font-size:12px;
    margin-top:5px;
    display:none;
}
.modal-box {
    width: 360px;
    background: white;
    border-radius: 18px;
    padding: 28px 22px;
    text-align: center;
    transform: scale(0.9);
    transition: 0.3s ease;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}

.popup-success.show .modal-box {
    transform: scale(1);
}
.modal-btn,
.modal-link{
    display:block;
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    background:#00BBC2;
    color:white;
    text-decoration:none;
    text-align:center;
    cursor:pointer;
    margin-top:10px;
}

.modal-link{
    background:#eee;
    color:#333;
}

.modal-icon{
    width:70px;
    height:70px;
    border-radius:50%;
    margin:0 auto 15px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    color:white;
    background:#00c896;
}
</style>

<div class="container py-4" style="max-width: 1100px;">

    <!-- TAB -->
    <div class="text-center mb-4">
        <button type="button" id="tabTulis" class="tab-btn active" onclick="switchTab('tulis')">
            Tulis Berita
        </button>

        <button type="button"
            id="tabKutip"
            class="tab-btn"
            onclick="switchTab('kutip'); console.log('KUTIP CLICKED')">
             Kutip Berita Luar
        </button>
    </div>

    <!-- CARD -->
    <div class="card-box">

        <h6 class="fw-semibold">Detail Informasi Berita</h6>
        <small class="text-muted">
            Lengkapi data berita SIG untuk dipublikasikan.
        </small>

        <form id="formBerita"
        action="<?= !empty($berita['id_berita'] ?? null) 
            ? base_url('/berita/update/'.($berita['id_berita'] ?? '')) 
            : base_url('/berita/simpan') ?>"
            method="post"
            enctype="multipart/form-data">
        
        <!-- ===================== -->
        <!-- MODE TULIS BERITA -->
        <!-- ===================== -->
        <div id="formTulis">
            <div class="row mt-4">

                <!-- LEFT -->
                <div class="col-md-8">

                    <div class="mb-3">
                        <label>Judul Berita</label>
                        <input type="text"
                               name="judul_berita"
                               class="form-control"
                               placeholder="Masukkan judul berita utama..."
                               value="<?= $berita['judul_berita'] ?? '' ?>"
                               required>
                        <div class="error-text">
                            Judul Berita wajib diisi
                        </div>
                        </div>

                    <!-- EDITOR -->
                    <div class="mb-3">
                        <label>Isi Berita</label>

                        <!-- TOOLBAR -->
                    <div class="toolbar-modern">

                    <select class="select-style" onchange="changeFont(this.value)">
                        <option value="">Font</option>
                        <option value='Arial'>Arial</option>
                        <option value='Georgia'>Georgia</option>
                        <option value='Times New Roman'>Times</option>
                    </select>

                    <select class="select-style" onchange="changeFontSize(this.value)">
                        <option value="3">Normal</option>
                        <option value="2">Small</option>
                        <option value="5">Large</option>
                    </select>

                    <div class="divider"></div>

                    <button type="button" onclick="formatText('bold')"><b>B</b></button>
                    <button type="button" onclick="formatText('italic')"><i>I</i></button>
                    <button type="button" onclick="formatText('underline')"><u>U</u></button>
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


                    <div class="divider"></div>

                    <button type="button" onclick="formatText('insertOrderedList')">
                        <i class="fa-solid fa-list-ol"></i>
                    </button>

                    <button type="button" onclick="formatText('insertUnorderedList')">
                        <i class="fa-solid fa-list-ul"></i>
                    </button>

                    <button type="button" onclick="triggerImageUpload()" title="Upload Gambar">
                    <i class="fa-solid fa-image"></i></button>
                    <input type="file" id="uploadImageEditor" accept="image/*" multiple hidden>

                    <button type="button" onclick="insertLink()">🔗</button>
                    </div>

                        <div id="editor" contenteditable="true">
                        <?= $berita['isi_berita'] ?? '' ?>
                        </div>

                        <textarea name="isi_berita"
                        placeholder="Masukkan isi berita..."
                        id="hiddenInput"
                        hidden required><?= $beritapneumonia['isi_berita'] ?? '' ?></textarea>
                    </div>
                    <div class="error-text" id="editorError">
                            Isi berita wajib diisi
                    </div>

                    <div class="mb-3">
                        <label>Ringkasan / Deskripsi Berita</label>
                        <input type="text"
                               name="deskripsi_berita"
                               class="form-control"
                               placeholder="Masukkan deskripsi berita..."
                               value="<?= $beritapneumonia['deskripsi_berita'] ?? '' ?>"
                               required>
                        <div class="error-text">
                            Judul Berita wajib diisi
                        </div>
                        </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Penulis</label>
                            <input type="text"
                                name="penulis"
                                class="form-control"
                                value="<?= $beritapneumonia['penulis'] ?? '' ?>"
                                required>
                        <div class="error-text">
                                Penulis wajib diisi
                        </div>
                        </div>

                        <div class="col-md-6">
                            <label>Tanggal</label>
                            <input type="datetime-local"
                                   name="tanggal_berita"
                                   class="form-control"
                                   value="<?= isset($beritapneumonia['tanggal_berita']) 
                                    ? date('Y-m-d\TH:i', strtotime($beritapneumonia['tanggal_berita'])) : '' ?>"
                                   required>
                            <div class="error-text">
                                Tanggal unggah wajib diisi
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-md-4">
                    <div class="bg-white p-3 rounded-3 text-center">
                        <b>UNGGAH THUMBNAIL</b><br><br>

                    <div class="bg-white p-3 rounded-3 mb-3 text-center">
                    <img id="previewImg"
                        src="<?= !empty($beritapneumonia['gambar_berita']) 
                            ? '/uploads/berita/'.$beritapneumonia['gambar_berita'] 
                            : 'https://via.placeholder.com/250x140' ?>"
                             class="img-fluid rounded mb-2"
                             style="max-height:150px; object-fit:cover;">
                        <div class="error-text">
                                Gambar wajib diisi
                        </div>
                            </div>

                    <input type="file"
                        name="gambar_berita"
                        id="inputGambar"
                        class="form-control"
                        accept="image/*"
                        <?= isset($beritapneumonia) ? '' : 'required' ?>>

                    <input type="hidden" name="gambar_lama" value="<?= $beritapneumonia['gambar_berita'] ?? '' ?>">

                    <?php if (!empty($beritapneumonia['gambar_berita'])): ?>
                        <img src="/uploads/berita/<?= $beritapneumonia['gambar_berita']; ?>" width="150" style="margin-top:10px;">
                    <?php endif; ?>
                    </div>
                </div>
                <!-- BUTTON -->
<div class="d-flex justify-content-between mt-4">

<button type="button"
        class="btn-back"
        onclick="window.location.href='<?= base_url('berita') ?>'">
    Batal
</button>

<div class="d-flex gap-2">

    <button type="button"
            onclick="submitWithStatus('draft')"
            class="btn-draft">
        Simpan Draft
    </button>

    <button type="button"
            onclick="submitWithStatus('publish')"
            class="btn-main">
        Unggah
    </button>

</div>

</div>
</div> <!-- col-md-4 -->

</div> <!-- row -->
</div> <!-- formTulis -->

<!-- ===================== -->
<!-- MODE KUTIP BERITA -->
<!-- ===================== -->
<div id="formKutip" style="display:none;">

<div class="row mt-4">

    <div class="d-flex justify-content-center">

        <div style="width:700px;">

            <div class="mb-3">
                <label>Judul Berita</label>

                <input type="text"
                       name="judul_berita1"
                       class="form-control"
                       value="<?= $beritapneumonia['judul_berita'] ?? '' ?>">

                <div class="error-text">
                    Judul berita wajib diisi
                </div>
            </div>

            <div class="mb-3">

                <label>Link Berita</label>

                <input type="url"
                       name="url_berita"
                       class="form-control"
                       placeholder="https://..."
                       value="<?= $beritapneumonia['url_berita'] ?? '' ?>">

                <div class="error-text">
                    Link berita wajib diisi
                </div>

            </div>

        </div>

    </div>

</div>

<!-- BUTTON -->
<div class="d-flex justify-content-between mt-4">

    <button type="button"
            class="btn-back"
            onclick="window.location.href='<?= base_url('berita') ?>'">
        Batal
    </button>

    <div class="d-flex gap-2">

        <button type="button"
                onclick="submitWithStatus('draft')"
                class="btn-draft">
            Simpan Draft
        </button>

        <button type="button"
                onclick="submitWithStatus('publish')"
                class="btn-main">
            Unggah
        </button>

    </div>

</div>

</div>

        </form>
    </div>

    <!-- SUCCESS MODAL -->

<?php $isEditUpload = $isEditUpload ?? false; ?>
<div class="popup-success" id="successModal">

    <div class="modal-box">

        <div class="modal-icon success-icon">
            <i class="fa fa-check"></i>
        </div>

        <div class="modal-title" id="successTitle">
            <?= $isEditUpload
                ? 'Update berita Berhasil'
                : 'Unggah berita Berhasil' ?>
        </div>

        <div class="modal-desc" id="successDesc">
            <?= $isEditUpload
                ? 'berita berhasil diperbarui'
                : 'berita berhasil diunggah' ?>
        </div>

<button class="modal-btn lihat-btn"
        data-id="<?= session()->getFlashdata('new_id') ?>">
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

<div class="popup-success" id="draftModal">

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

<div class="popup-success" id="errorModal">

    <div class="modal-box">

        <div class="modal-icon error-icon">
            <i class="fa fa-times"></i>
        </div>

        <div class="modal-title">
            Data Belum Lengkap
        </div>

        <div class="modal-desc">
            berita gagal diunggah, mohon lengkapi semua kolom
        </div>

        <button class="modal-btn"
                id="closeErrorModal">
            Lengkapi Data
        </button>

    </div>

</div>

<!-- MODAL SIMPAN PERUBAHAN -->

<div class="popup-success" id="editConfirmModal">

    <div class="modal-box">

        <div class="modal-icon success-icon">
            <i class="fa fa-pen"></i>
        </div>

        <div class="modal-title">
            Edit berita
        </div>

        <div class="modal-desc">
            Apakah Anda ingin mengubah berita ini?
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
<div class="popup-success" id="cancelConfirmModal">

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
// Ambil Flashdata dari Session CodeIgniter
// Ini adalah kunci agar popup muncul setelah halaman reload
const showSuccess = <?= json_encode(session()->getFlashdata('success')) ?>;
const showDraft = <?= json_encode(session()->getFlashdata('draft')) ?>;
const newId = <?= json_encode(session()->getFlashdata('new_id')) ?>;

let savedRange = null;
let pendingStatus = "";

// =======================
// DOM READY (Logika Utama)
// =======================
document.addEventListener("DOMContentLoaded", function () {
    
    // 1. Cek apakah ada flashdata untuk menampilkan popup
    if (showSuccess) {
        showPopup("successModal");
    } else if (showDraft) {
        showPopup("draftModal");
    }

    // 2. Event Listener untuk tombol "Lihat Tampilan"
    document.querySelectorAll(".lihat-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            // Gunakan ID dari flashdata jika atribut data-id kosong
            const id = this.getAttribute("data-id") || newId;

            if (!id) {
                alert("ID berita tidak tersedia");
                return;
            }
            window.location.href = "<?= base_url('berita/view_berita/') ?>" + id;
        });
    });

    // 3. Event Listener tombol tutup/selesai
    document.getElementById("closeErrorModal")?.addEventListener("click", () => closePopup("errorModal"));
    
    document.getElementById("selesaiBtn")?.addEventListener("click", function (e) {
        e.preventDefault();
        window.location.href = "<?= base_url('berita') ?>";
    });

    document.getElementById("draftOkBtn")?.addEventListener("click", function () {
        // Karena data sudah tersimpan (refresh), arahkan saja ke list
        window.location.href = "<?= base_url('berita') ?>";
    });

    // 4. Inisialisasi Mode Tab (Kutip atau Tulis)
    <?php if (!empty($berita['url_berita'])): ?>
        switchTab("kutip");
    <?php else: ?>
        switchTab("tulis");
    <?php endif; ?>
});

// =======================
// FUNGSI POPUP
// =======================
function showPopup(id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.add("show");
}

function closePopup(id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.remove("show");
}

// =======================
// EDITOR LOGIC
// =======================
const editor = document.getElementById("editor");

if (editor) {
    editor.addEventListener("mouseup", saveSelection);
    editor.addEventListener("keyup", saveSelection);
}

function saveSelection() {
    const sel = window.getSelection();
    if (sel.rangeCount > 0) {
        savedRange = sel.getRangeAt(0);
    }
}

function formatText(cmd, value = null) {
    if (!editor) return;
    editor.focus();
    document.execCommand(cmd, false, value);
}

function changeFont(font) { formatText("fontName", font); }
function changeFontSize(size) { formatText("fontSize", size); }

function insertLink() {
    let url = prompt("Masukkan URL");
    if (url) formatText("createLink", url);
}

// =======================
// SUBMIT LOGIC
// =======================
function submitWithStatus(status) {
    const form = document.getElementById("formBerita");
    const hidden = document.getElementById("hiddenInput");

    if (!form) return;

    // Sync isi editor ke hidden textarea
    if (hidden && editor) {
        hidden.value = editor.innerHTML;
    }

    // Validasi sederhana sebelum kirim
    const isTulis = document.getElementById("formTulis")?.style.display !== "none";
    if (isTulis) {
        const judul = document.querySelector("input[name='judul_berita']")?.value.trim();
        if (!judul || editor.innerHTML.trim() === "") {
            showPopup("errorModal");
            return;
        }
    }

    // Tambah/Update input status_berita
    let statusInput = form.querySelector("input[name='status_berita']");
    if (!statusInput) {
        statusInput = document.createElement("input");
        statusInput.type = "hidden";
        statusInput.name = "status_berita";
        form.appendChild(statusInput);
    }
    statusInput.value = status;

    // Kirim data (Halaman akan reload/refresh)
    form.submit();
}

// =======================
// TAB & IMAGE PREVIEW
// =======================
function switchTab(mode) {
    const formTulis = document.getElementById("formTulis");
    const formKutip = document.getElementById("formKutip");
    const tabTulis = document.getElementById("tabTulis");
    const tabKutip = document.getElementById("tabKutip");

    if (mode === "tulis") {
        formTulis.style.display = "block";
        formKutip.style.display = "none";
        tabTulis?.classList.add("active");
        tabKutip?.classList.remove("active");
    } else {
        formTulis.style.display = "none";
        formKutip.style.display = "block";
        tabTulis?.classList.remove("active");
        tabKutip?.classList.add("active");
    }
}

// Thumbnail Preview
const inputGambar = document.getElementById("inputGambar");
if (inputGambar) {
    inputGambar.addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (ev) => document.getElementById("previewImg").src = ev.target.result;
            reader.readAsDataURL(file);
        }
    });
}

// Upload Gambar Editor
function triggerImageUpload() { document.getElementById("uploadImageEditor").click(); }
const uploadInput = document.getElementById("uploadImageEditor");
if (uploadInput) {
    uploadInput.addEventListener("change", function () {
        const file = this.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append("image", file);

        fetch("<?= base_url('berita/upload-editor-image') ?>", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(result => {
            if (result.status === "success") {
                insertImageToEditor(result.url);
            } else {
                alert(result.message || "Upload gagal");
            }
        })
        .catch(() => alert("Upload error"));
        this.value = "";
    });
}

function insertImageToEditor(src) {
    if (!editor) return;
    editor.focus();
    const img = document.createElement("img");
    img.src = src;
    img.style.width = "50%";
    img.style.display = "block";
    img.style.margin = "10px auto";

    const sel = window.getSelection();
    if (savedRange) {
        sel.removeAllRanges();
        sel.addRange(savedRange);
        savedRange.insertNode(img);
    } else {
        editor.appendChild(img);
    }
}
</script>

<?= $this->endSection() ?>