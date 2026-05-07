<?= $this->extend('layout/dashboard_layout_admin') ?>

<?= $this->section('content') ?>

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
    transition: 0.25s ease;
}

.popup-success.show {
    opacity: 1;
    visibility: visible;
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
.popup-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 5px;
}

.popup-desc {
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
        action="<?= isset($berita) 
            ? base_url('/berita/update/'.$berita['id_berita']) 
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
                               value="<?= $berita['judul_berita'] ?? '' ?>"
                               required>
                    </div>

                    <!-- EDITOR -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

                    <div class="divider"></div>

                    <button type="button" onclick="formatText('insertOrderedList')">
                        <i class="fa-solid fa-list-ol"></i>
                    </button>

                    <button type="button" onclick="formatText('insertUnorderedList')">
                        <i class="fa-solid fa-list-ul"></i>
                    </button>
                    <button type="button" onclick="triggerImageUpload()" title="Upload Gambar">
                    <i class="fa-solid fa-image"></i></button>
                    <input type="file" id="uploadImageEditor" accept="image/*" hidden>

                    <button type="button" onclick="insertLink()">🔗</button>

                    </div>

                        <div id="editor" contenteditable="true">
                        <?= $berita['deskripsi_berita'] ?? '' ?>
                        </div>

                        <textarea name="deskripsi_berita"
                        id="hiddenInput"
                        hidden required><?= $berita['deskripsi_berita'] ?? '' ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Penulis</label>
                            <input type="number"
                                name="id_petugas"
                                class="form-control"
                                value="<?= $berita['id_petugas'] ?? '' ?>"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label>Tanggal</label>
                            <input type="datetime-local"
                                   name="tanggal_berita"
                                   class="form-control"
                                   value="<?= isset($berita['tanggal_berita']) 
                                    ? date('Y-m-d\TH:i', strtotime($berita['tanggal_berita'])) : '' ?>"
                                   required>
                        </div>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-md-4">
                    <div class="bg-white p-3 rounded-3 text-center">
                        <b>UNGGAH THUMBNAIL</b><br><br>

                    <div class="bg-white p-3 rounded-3 mb-3 text-center">
                    <img id="previewImg"
                        src="<?= !empty($berita['gambar_berita']) 
                            ? '/uploads/'.$berita['gambar_berita'] 
                            : 'https://via.placeholder.com/250x140' ?>"
                             class="img-fluid rounded mb-2"
                             style="max-height:150px; object-fit:cover;">

                        <small class="text-muted">Preview Berita</small>
                    </div>

                    <input type="file"
                        name="gambar_berita"
                        id="inputGambar"
                        class="form-control"
                        accept="image/*"
                        <?= isset($berita) ? '' : 'required' ?>>

                    <input type="hidden" name="gambar_lama" value="<?= $berita['gambar_berita'] ?? '' ?>">

                    <?php if (!empty($berita['gambar_berita'])): ?>
                        <img src="/uploads/<?= $berita['gambar_berita']; ?>" width="150" style="margin-top:10px;">
                    <?php endif; ?>
                    </div>
                </div>
                <!-- BUTTON -->
            <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn-back"
            onclick="window.location.href='<?= base_url('berita') ?>'">
                Batal
            </button>

                <div class="d-flex gap-2">
                    <button type="button"
                            name="status_berita"
                            value="draft"
                            onclick="submitWithStatus('draft')"
                            class="btn-draft">
                        Simpan Draft
                    </button>

                    <button type="button"
                            name="status_berita"
                            value="publish"
                            onclick="submitWithStatus('publish')"
                            class="btn-main">
                        Unggah
                    </button>
                </div>
            </div>
            </div>
            </div>

            <!-- ===================== -->
            <!-- MODE KUTIP BERITA -->
            <!-- ===================== -->
            <div id="formKutip" style="display:none;">
            <div class="row mt-4">
                <div class="d-flex justify-content-center">
                    <div style="width: 700px;">
                    <div class="mb-3">
                        <label>Judul Berita</label>
                        <input type="text"
                               name="judul_berita1"
                               class="form-control"
                               value="<?= $berita['judul_berita'] ?? '' ?>"
                               required>
                    </div>

                <div class="mb-3">
                    <label>Link Berita</label>
                    <input type="url" name="url_berita" class="form-control" placeholder="https://..." required
                        value="<?= $berita['url_berita'] ?? '' ?>">
                </div>
                </div>
            </div>
            </div>

            <!-- BUTTON -->
            <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn-back"
            onclick="window.location.href='<?= base_url('berita') ?>'">
                Batal
            </button>

                <div class="d-flex gap-2">
                    <button type="button"
                            name="status_berita"
                            value="draft"
                            onclick="submitWithStatus('draft')"
                            class="btn-draft">
                        Simpan Draft
                    </button>

                    <button type="button"
                            name="status_berita"
                            value="publish"
                            onclick="submitWithStatus('publish')"
                            class="btn-main">
                        Unggah
                    </button>
                </div>
            </div>
            </div>

        </form>
    </div>
</div>

<!-- POPUP NOTIFIKASI -->
<div class="popup-success" id="popupSuccess">
    <div class="popup-box" onclick="event.stopPropagation()">

        <div id="popupIcon" class="popup-icon publish">
            ✓
        </div>

        <div class="popup-title" id="popupTitle">
            Berhasil
        </div>

        <div class="popup-desc" id="popupDesc">
            Berita berhasil disimpan
        </div>

        <button id="popupBtn" class="popup-btn" onclick="submitForm()">
            Lanjutkan
        </button>

    </div>
</div>

<script>
    let savedRange = null;

function saveSelection() {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        savedRange = selection.getRangeAt(0);
    }
}
const editor = document.getElementById("editor");

editor.addEventListener("mouseup", saveSelection);
editor.addEventListener("keyup", saveSelection);
editor.addEventListener("mouseout", saveSelection);
// BIU
function formatText(cmd, value = null) {
    let editor = document.getElementById("editor");
    editor.focus();
    document.execCommand(cmd, false, value);
}

// preview gambar
document.getElementById("inputGambar").addEventListener("change", function(e) {
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(ev) {
            document.getElementById("previewImg").src = ev.target.result;
        }

        reader.readAsDataURL(file);
    }
});

function switchTab(mode) {

let tulis = document.getElementById("formTulis");
let kutip = document.getElementById("formKutip");

let inputTulis = document.querySelector("#formTulis input[name='judul_berita']");
let inputKutip = document.querySelector("#formKutip input[name='judul_berita1']");

if (mode === "tulis") {
    tulis.style.display = "block";
    kutip.style.display = "none";

    if (inputTulis) inputTulis.disabled = false;
    if (inputKutip) inputKutip.disabled = true;

    document.getElementById("tabTulis").classList.add("active");
    document.getElementById("tabKutip").classList.remove("active");

} else {
    tulis.style.display = "none";
    kutip.style.display = "block";

    if (inputTulis) inputTulis.disabled = true;
    if (inputKutip) inputKutip.disabled = false;

    document.getElementById("tabTulis").classList.remove("active");
    document.getElementById("tabKutip").classList.add("active");
}
// disable semua input di mode tidak aktif
document.querySelectorAll("#formTulis input, #formTulis textarea").forEach(el => el.disabled = mode !== "tulis");
document.querySelectorAll("#formKutip input").forEach(el => el.disabled = mode !== "kutip");
}

// SUBMIT STATUS + SHOW POPUP
document.getElementById("popupSuccess").addEventListener("click", function () {
    this.classList.remove("show");
});

function submitWithStatus(status) {

let form = document.getElementById("formBerita");

// ambil isi editor
let isi = document.getElementById("editor").innerHTML.trim();
document.getElementById("hiddenInput").value = isi;

// =========================
// DETEKSI MODE (FIXED)
// =========================
let isTulis = document.getElementById("formTulis").offsetParent !== null;
let isKutip = document.getElementById("formKutip").offsetParent !== null;

// =========================
// VALIDASI TULIS
// =========================
if (isTulis) {

    let judul = form.querySelector("input[name='judul_berita']").value.trim();
    let penulis = form.querySelector("input[name='id_petugas']").value.trim();
    let tanggal = form.querySelector("input[name='tanggal_berita']").value.trim();
    let gambar = document.getElementById("inputGambar").files.length;

    let isEdit = <?= isset($berita) ? 'true' : 'false' ?>;

    if (!judul || !isi || !penulis || !tanggal || (!isEdit && gambar === 0)) {
        showError("Semua field wajib diisi!");
        return;
    }
}

// =========================
// VALIDASI KUTIP
// =========================
if (isKutip) {

    let judul = form.querySelector("#formKutip input[name='judul_berita1']").value.trim();
    let url = form.querySelector("#formKutip input[name='url_berita']").value.trim();

    if (!judul || !url) {
        showError("Judul dan link wajib diisi!");
        return;
    }
}

// =========================
// SET STATUS
// =========================
let old = document.querySelector("input[name='status_berita']");
if (old) old.remove();

let input = document.createElement("input");
input.type = "hidden";
input.name = "status_berita";
input.value = status;
form.appendChild(input);

// =========================
// POPUP
// =========================
let icon = document.getElementById("popupIcon");
let title = document.getElementById("popupTitle");
let desc = document.getElementById("popupDesc");
let btn = document.getElementById("popupBtn");

btn.onclick = function () {
    form.submit();
};

if (status === "publish") {
    icon.innerHTML = "🚀";
    icon.className = "popup-icon publish";
    title.innerText = "Berhasil Dipublish";
    desc.innerText = "Berita berhasil ditayangkan";
} else {
    icon.innerHTML = "💾";
    icon.className = "popup-icon draft";
    title.innerText = "Draft Tersimpan";
    desc.innerText = "Berita disimpan sebagai draft";
}

document.getElementById("popupSuccess").classList.add("show");
}

function changeFont(font) {
    let editor = document.getElementById("editor");
    editor.focus();
    document.execCommand("fontName", false, font);
}

function changeFontSize(size) {
    let editor = document.getElementById("editor");
    editor.focus();
    document.execCommand("fontSize", false, size);
}
function addQuote() {
    let editor = document.getElementById("editor");
    editor.focus();
    document.execCommand("formatBlock", false, "blockquote");
}
function insertLink() {
    let url = prompt("Masukkan URL:");
    if (url) formatText("createLink", url);
}
// klik button → buka file
function triggerImageUpload() {
    document.getElementById("uploadImageEditor").click();
}

// ketika file dipilih
// trigger klik file
function triggerImageUpload() {
    document.getElementById("uploadImageEditor").click();
}

// jalan saat file dipilih
document.getElementById("uploadImageEditor").addEventListener("change", function () {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (e) {
        insertImageToEditor(e.target.result);
    };

    reader.readAsDataURL(file);

    // reset input biar bisa upload file yang sama lagi
    this.value = "";
});

// masukin ke editor
function insertImageToEditor(src) {
    const editor = document.getElementById("editor");
    editor.focus();

    const img = document.createElement("img");
    img.src = src;
    img.style.maxWidth = "100%";
    img.style.display = "block";
    img.style.margin = "10px 0";

    const selection = window.getSelection();

    if (savedRange) {
        selection.removeAllRanges();
        selection.addRange(savedRange);

        savedRange.insertNode(img);

        // pindahin cursor
        savedRange.setStartAfter(img);
        savedRange.setEndAfter(img);
        selection.removeAllRanges();
        selection.addRange(savedRange);
    } else {
        editor.appendChild(img);
    }
}
</script>

<?= $this->endSection() ?>