<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php 
$profil = $profil ?? []; 
$filosofi = $filosofi ?? []; 
?>

<style>
/* ==========================================================================
   🎨 CUSTOM THEME MANAGEMENT (COMPACT VERSION)
   ========================================================================== */
.main-wrapper-profil {
    max-width: 850px;
    margin: 5px auto; 
    padding: 0 10px;
}

.top-jumbotron-header {
    background: linear-gradient(135deg, #00BBC2 0%, #00d2da 100%);
    border-radius: 15px;
    padding: 15px 20px; 
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px; 
    color: #ffffff;
    box-shadow: 0 4px 15px rgba(0, 187, 194, 0.15);
}

.top-jumbotron-header .icon-box {
    background: rgba(255, 255, 255, 0.2);
    width: 48px;  
    height: 48px; 
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    backdrop-filter: blur(4px);
}

.top-jumbotron-header .text-box h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 0.3px;
}

.top-jumbotron-header .text-box p {
    margin: 2px 0 0 0;
    font-size: 12px;
    opacity: 0.9;
}

.card-profil {
    background: #ffffff;
    border-radius: 15px;
    padding: 15px 20px; 
}

.section-header {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    gap: 8px;
    margin-top: 15px; 
    margin-bottom: 8px;  
    font-size: 15px;
    font-weight: 600;
    color: #374151;
    width: auto; 
}

.section-header i {
    color: #00BBC2;
    font-size: 16px;
}

.custom-editor-container {
    border: 1px solid #00BBC2;
    border-radius: 16px;
    overflow: hidden;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 8px rgba(0, 187, 194, 0.05);
}

.custom-editor-container .ql-toolbar.ql-snow {
    background: #00BBC2 !important;
    border: none !important;
    padding: 6px 12px !important; 
    order: 1;
}

.custom-editor-container .ql-snow .ql-stroke { stroke: #111827 !important; }
.custom-editor-container .ql-snow .ql-fill { fill: #111827 !important; }
.custom-editor-container .ql-snow .ql-picker { color: #111827 !important; }

.inner-judul-input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #e5e7eb;
    padding: 10px 15px; 
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    outline: none;
    box-sizing: border-box;
    order: 2;
}
.inner-judul-input::placeholder { color: #9ca3af; }

.custom-editor-container .ql-container.ql-snow {
    border: none !important;
    background: #ffffff;
    order: 3;
    font-family: inherit;
}

.custom-editor-container .ql-editor {
    min-height: 100px; 
    font-size: 14px;
    color: #4b5563;
    padding: 12px 15px;
}
.custom-editor-container .ql-editor.ql-blank::before {
    color: #9ca3af;
    font-style: normal;
    left: 15px;
}

.filosofi-item {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: #fafafa;
    position: relative;
}

.action-wrapper-logo {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
    margin-bottom: 15px; 
}

.btn-tambah-logo {
    background-color: #00BBC2;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 6px 16px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 187, 194, 0.2);
    transition: background .2s;
}
.btn-tambah-logo:hover { background-color: #009fa5; }

.btn-hapus-filosofi {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 500;
    cursor: pointer;
    z-index: 10;
    transition: background 0.2s;
}
.btn-hapus-filosofi:hover { background: #dc2626; }

.maskot-section-under-box {
    padding: 2px;
    margin-bottom: 10px; 
}

.maskot-preview-inline-bottom {
    width: 95px;            
    height: 95px;           
    background-color: #ffffff;
    border: 2px dashed #cbd5e1; 
    border-radius: 10px;
    display: flex;
    align-items: center;         
    justify-content: center;     
    overflow: hidden;
    padding: 8px;
    transition: all 0.25s ease-in-out;
}

.maskot-preview-inline-bottom:hover {
    border-color: #00BBC2;      
    background-color: #f8fafc;  
    box-shadow: 0 4px 12px rgba(0, 187, 194, 0.12);
}

.maskot-preview-inline-bottom img {
    width: 100%;
    height: 100%;
    object-fit: contain;    
}

.no-img-inline-text {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 11px;
    color: #94a3b8;
    line-height: 1.3;
    font-weight: 500;
}

.upload-box {
    display: block;
    width: 100%;
    border: 2px dashed #d1d5db;
    border-radius: 16px;
    background: #f9fafb;
    padding: 20px; 
    text-align: left;
    transition: .3s;
}

.footer-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 30px; 
}
.btn-batal {
    background: #ffffff;
    color: #374151;
    border: 1px solid #d1d5db;
    padding: 8px 30px;
    border-radius: 10px;
    font-weight: 500;
    text-decoration: none;
    font-size: 14px;
}
.btn-simpan {
    background: #00BBC2;
    color: white;
    border: none;
    padding: 8px 30px;
    border-radius: 10px;
    font-weight: 500;
    font-size: 14px;
    box-shadow: 0 2px 6px rgba(0, 187, 194, 0.2);
}
.btn-simpan:hover { background-color: #009fa5; }

.logo-section-under-box {
    padding: 2px;
}

.logo-preview-inline-bottom {
    width: 95px;            
    height: 95px;           
    background-color: #ffffff;
    border: 2px dashed #cbd5e1; 
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 8px;
    transition: all 0.25s ease-in-out;
}

.logo-preview-inline-bottom:hover {
    border-color: #00BBC2;      
    background-color: #f8fafc;  
    box-shadow: 0 4px 12px rgba(0, 187, 194, 0.12);
}

.filosofi-preview-box {
    width: 80px;
    height: 80px;
    background-color: #ffffff;
    border: 2px dashed #cbd5e1;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 4px;
    cursor: pointer;
    transition: all 0.2s ease;
}
.filosofi-preview-box:hover {
    border-color: #00BBC2;
    background-color: #f1f5f9;
}
.filosofi-preview-box img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
</style>

<div class="main-wrapper-profil">
    <div class="top-jumbotron-header">
        <div class="icon-box">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div class="text-box">
            <h4>Edit Profil Sistem</h4>
            <p>Menampilkan edit profil sistem</p>
        </div>
    </div>

    <form id="formProfil" action="<?= base_url('superadmin/profil_sistem/update') ?>" method="post" enctype="multipart/form-data">
        <div class="card-profil">

            <div class="section-header">
                <i class="fa-regular fa-circle-user"></i> <span>Profil</span>
            </div>
            <div class="custom-editor-container">
                <input type="text" name="judul_profil" class="inner-judul-input" placeholder="Tambahkan Judul" value="<?= htmlspecialchars($profil['profil'] ?? '') ?>">
                <div id="profil_editor" class="editor"><?= $profil['deskripsi_profil'] ?? '' ?></div>
            </div>
            <input type="hidden" name="profil" id="profil">

            <div class="logo-section-under-box mt-3">
                <label class="form-label font-size-12 fw-bold text-muted mb-2 d-block">Logo Aplikasi (Format .PNG):</label>
                <div class="logo-preview-inline-bottom" id="logoPreviewInline" onclick="triggerLogoUpload();" style="cursor: pointer;" title="Klik untuk memilih/mengubah gambar logo (.png)">
                    <?php if(!empty($profil['logo'])): ?>
                        <img src="<?= base_url('uploads/profil_sistem/'.$profil['logo']) ?>" alt="Logo" id="imgPreviewInline" style="width:100%; height:100%; object-fit:contain;">
                    <?php else: ?>
                        <div class="no-img-inline-text" id="noImgTextInline">
                            <i class="fa-solid fa-cloud-arrow-up text-muted mb-2" style="font-size: 20px;"></i>
                            <span>Klik untuk Pilih Gambar (.PNG)</span>
                        </div>
                    <?php endif; ?>
                </div>
                <input type="file" name="logo" id="logo" accept="image/png" style="display: none;">
            </div>

            <div class="section-header">
                <i class="fa-solid fa-tags"></i> <span>Tagline</span>
            </div>
            <div class="custom-editor-container">
                <div id="tagline_editor" class="editor"><?= $profil['tagline'] ?? '' ?></div>
            </div>
            <input type="hidden" name="tagline" id="tagline">

            <div class="section-header">
                <i class="fa-regular fa-eye"></i> <span>Visi</span>
            </div>
            <div class="custom-editor-container">
                <div id="visi_editor" class="editor"><?= $profil['isi_visi'] ?? '' ?></div>
            </div>
            <input type="hidden" name="visi" id="visi">

            <div class="section-header">
                <i class="fa-solid fa-bullseye"></i> <span>Misi</span>
            </div>
            <div class="custom-editor-container">
                <div id="misi_editor" class="editor"><?= $profil['isi_misi'] ?? '' ?></div>
            </div>
            <input type="hidden" name="misi" id="misi">

            <div class="section-header">
                <i class="fa-solid fa-ban"></i> <span>Filosofi Logo</span>
            </div>

            <div id="filosofi-container">
                <?php 
                if(!empty($filosofi)): 
                    foreach($filosofi as $index => $item): 
                        // Sterilkan data dari sisa tag HTML kotor agar dibaca mulus oleh Quill Editor bawaan
                        $deskripsiBersih = isset($item['deskripsi_logo']) ? html_entity_decode(strip_tags($item['deskripsi_logo'])) : '';
                ?>
                <div class="filosofi-item">
                    <button type="button" class="btn-hapus-filosofi" onclick="hapusFilosofiItem(this)"><i class="fa-solid fa-trash-can"></i> Hapus</button>

                    <div class="custom-editor-container" style="width: calc(100% - 80px);">
                        <input type="text" name="judul_logo[]" class="inner-judul-input" placeholder="Tambahkan Judul" value="<?= htmlspecialchars($item['nama_logo'] ?? '') ?>">
                        <div class="editor filosofi-editor"><?= htmlspecialchars(trim($deskripsiBersih)) ?></div>
                    </div>
                    <input type="hidden" name="deskripsi_logo[]" class="deskripsi-hidden" value="<?= htmlspecialchars(trim($deskripsiBersih)) ?>">
                    <input type="hidden" name="gambar_lama[]" class="gambar-lama-hidden" value="<?= htmlspecialchars($item['komponen_logo'] ?? '') ?>">
                    
                    <div class="mt-3 d-flex align-items-center gap-3">
                        <div class="filosofi-preview-box" onclick="triggerFilosofiUpload(this);" title="Klik untuk mengubah gambar komponen logo">
                            <?php if(!empty($item['komponen_logo'])): ?>
                                <img src="<?= base_url('uploads/profil_sistem/'.$item['komponen_logo']) ?>" alt="Komponen Logo">
                            <?php else: ?>
                                <div class="no-img-inline-text">
                                    <i class="fa-solid fa-image text-muted mb-1" style="font-size: 14px;"></i>
                                    <span style="font-size:9px;">Pilih Gambar</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form-label font-size-12 text-muted fw-bold mb-1">Gambar Komponen Logo:</label>
                            <input type="file" name="gambar_logo[]" class="form-control file-filosofi-input" accept="image/*" style="max-width: 250px; font-size:12px;" onchange="previewFilosofiImage(this)">
                            <?php if(!empty($item['komponen_logo'])): ?>
                                <small class="text-muted d-block mt-1">File aktif: <strong class="nama-file-text"><?= $item['komponen_logo'] ?></strong></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php 
                    endforeach; 
                else: 
                ?>
                <div class="filosofi-item">
                    <div class="custom-editor-container">
                        <input type="text" name="judul_logo[]" class="inner-judul-input" placeholder="Tambahkan Judul">
                        <div class="editor filosofi-editor"></div>
                    </div>
                    <input type="hidden" name="deskripsi_logo[]" class="deskripsi-hidden">
                    <input type="hidden" name="gambar_lama[]" class="gambar-lama-hidden" value="">
                    
                    <div class="mt-3 d-flex align-items-center gap-3">
                        <div class="filosofi-preview-box" onclick="triggerFilosofiUpload(this);">
                            <div class="no-img-inline-text">
                                <i class="fa-solid fa-image text-muted mb-1" style="font-size: 14px;"></i>
                                <span style="font-size:9px;">Pilih Gambar</span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form-label font-size-12 text-muted fw-bold mb-1">Gambar Komponen Logo:</label>
                            <input type="file" name="gambar_logo[]" class="form-control file-filosofi-input" accept="image/*" style="max-width: 250px; font-size:12px;" onchange="previewFilosofiImage(this)">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="action-wrapper-logo">
                <button type="button" id="tambahLogo" class="btn-tambah-logo">Tambah logo</button>
            </div>

            <div class="section-header">
                <i class="fa-solid fa-shapes"></i> <span>Maskot</span>
            </div>

            <div class="upload-box">
                <div class="maskot-section-under-box mt-1">
                    <label class="form-label font-size-12 fw-bold text-muted mb-2 d-block">Maskot Sistem (Format .PNG/.JPG/.JPEG):</label>
                    <div class="maskot-preview-inline-bottom" id="maskotPreviewInline" onclick="triggerMaskotUpload();" style="cursor: pointer;" title="Klik untuk memilih/mengubah gambar maskot">
                        <?php if(!empty($profil['maskot'])): ?>
                            <img src="<?= base_url('uploads/profil_sistem/'.$profil['maskot']) ?>" alt="Maskot" id="imgMaskotPreviewInline">
                        <?php else: ?>
                            <div class="no-img-inline-text" id="noMaskotTextInline">
                                <i class="fa-solid fa-cloud-arrow-up text-muted mb-2" style="font-size: 20px;"></i>
                                <span>Klik untuk Pilih Maskot</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <input type="file" name="maskot" id="maskot" accept="image/png, image/jpeg, image/jpg" style="display: none;">
                </div>
            </div>

            <div class="footer-actions">
                <a href="<?= base_url('dashboard') ?>" class="btn-batal">Batal</a>
                <button type="submit" class="btn-simpan">Simpan</button>
            </div>

        </div>
    </form>
</div>

<div class="modal fade" id="modalHapusFilosofi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusFilosofiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <div class="modal-body text-center p-4">
                <div class="mb-3 text-danger" style="font-size: 50px;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h5 class="modal-title fw-bold text-dark mb-2" id="modalHapusFilosofiLabel">Konfirmasi Hapus</h5>
                <p class="text-muted font-size-13 mb-4">Apakah Anda yakin ingin menghapus komponen filosofi logo ini? Tindakan ini tidak dapat dibatalkan.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn text-white px-4" style="background-color: #ef4444; border-radius: 8px; font-size: 14px; font-weight: 500;" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" id="btnKonfirmasiHapusYa" class="btn text-white px-4" style="background-color: #22c55e; border-radius: 8px; font-size: 14px; font-weight: 500;">Iya</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const customToolbarOptions = [
    ['bold', 'italic', 'underline'],
    ['link', 'image']
];

function initStandardEditor(id, placeholderText) {
    return new Quill(id, {
        theme: 'snow',
        placeholder: placeholderText,
        modules: { toolbar: customToolbarOptions }
    });
}

const profilEditor  = initStandardEditor('#profil_editor', 'Tulis deskripsi aplikasi...');
const taglineEditor = initStandardEditor('#tagline_editor', 'Tulis tagline aplikasi...');
const visiEditor    = initStandardEditor('#visi_editor', 'Tulis visi aplikasi...');
const misiEditor    = initStandardEditor('#misi_editor', 'Tulis misi aplikasi...');

function attachQuillToFilosofi(element) {
    new Quill(element, {
        theme: 'snow',
        placeholder: 'Tulis deskripsi logo...',
        modules: { toolbar: customToolbarOptions }
    });
}

// Inisialisasi awal editor filosofi yang di-load dari database
document.querySelectorAll('.filosofi-editor').forEach((el) => {
    attachQuillToFilosofi(el);
});

// Aksi ketika klik tombol "+ Tambah Logo" dinamis
document.getElementById('tambahLogo').addEventListener('click', function(){
    let container = document.getElementById('filosofi-container');

    let html = `
    <div class="filosofi-item">
        <button type="button" class="btn-hapus-filosofi" onclick="hapusFilosofiItem(this)"><i class="fa-solid fa-trash-can"></i> Hapus</button>
        
        <div class="custom-editor-container" style="width: calc(100% - 80px);">
            <input type="text" name="judul_logo[]" class="inner-judul-input" placeholder="Tambahkan Judul">
            <div class="editor filosofi-editor"></div>
        </div>
        <input type="hidden" name="deskripsi_logo[]" class="deskripsi-hidden">
        <input type="hidden" name="gambar_lama[]" class="gambar-lama-hidden" value="">

        <div class="mt-3 d-flex align-items-center gap-3">
            <div class="filosofi-preview-box" onclick="triggerFilosofiUpload(this);">
                <div class="no-img-inline-text">
                    <i class="fa-solid fa-image text-muted mb-1" style="font-size: 14px;"></i>
                    <span style="font-size:9px;">Pilih Gambar</span>
                </div>
            </div>
            <div class="flex-grow-1">
                <label class="form-label font-size-12 text-muted fw-bold mb-1">Gambar Komponen Logo:</label>
                <input type="file" name="gambar_logo[]" class="form-control file-filosofi-input" accept="image/*" style="max-width: 250px; font-size:12px;" onchange="previewFilosofiImage(this)">
            </div>
        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);
    let newEditorElement = container.lastElementChild.querySelector('.filosofi-editor');
    attachQuillToFilosofi(newEditorElement);
});

// Variabel global pelacak baris yang akan dihapus modal
let itemYangAkanDihapus = null;

function hapusFilosofiItem(button) {
    itemYangAkanDihapus = button.closest('.filosofi-item');
    const modalElement = document.getElementById('modalHapusFilosofi');
    const instanceModal = new bootstrap.Modal(modalElement);
    instanceModal.show();
}

document.getElementById('btnKonfirmasiHapusYa').addEventListener('click', function() {
    if (itemYangAkanDihapus) {
        itemYangAkanDihapus.remove();
        itemYangAkanDihapus = null;
    }
    const modalElement = document.getElementById('modalHapusFilosofi');
    const instanceModal = bootstrap.Modal.getInstance(modalElement);
    if (instanceModal) {
        instanceModal.hide();
    }
});

function triggerFilosofiUpload(previewBox) {
    const parent = previewBox.closest('.filosofi-item');
    const fileInput = parent.querySelector('.file-filosofi-input');
    if (fileInput) { fileInput.click(); }
}

function previewFilosofiImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        const parent = input.closest('.filosofi-item');
        const previewBox = parent.querySelector('.filosofi-preview-box');
        const textNamaFile = parent.querySelector('.nama-file-text');

        reader.onload = function(e) {
            previewBox.innerHTML = `<img src="${e.target.result}" alt="Preview Komponen Logo">`;
            if (textNamaFile) {
                textNamaFile.textContent = file.name;
            }
        };
        reader.readAsDataURL(file);
    }
}

// SINKRONISASI DATA QUILL SECARA SANGAT AMAN & PRESISI SEBELUM FORM SUBMIT
document.getElementById('formProfil').addEventListener('submit', function(e){
    if(document.querySelector('#profil')) {
        document.querySelector('#profil').value = profilEditor.root.innerHTML;
    }
    if(document.querySelector('#tagline')) {
        document.querySelector('#tagline').value = taglineEditor.root.innerHTML;
    }
    if(document.querySelector('#visi')) {
        document.querySelector('#visi').value = visiEditor.root.innerHTML;
    }
    if(document.querySelector('#misi')) {
        document.querySelector('#misi').value = misiEditor.root.innerHTML;
    }

    // Mengikat teks editor berdasarkan elemen DOM aktif secara mandiri (anti indeks tertukar)
    document.querySelectorAll('.filosofi-item').forEach((item) => {
        let inputHidden = item.querySelector('.deskripsi-hidden');
        let editorContainer = item.querySelector('.filosofi-editor');
        if(editorContainer && inputHidden){
            let quillInstance = Quill.find(editorContainer);
            if(quillInstance){
                // 🛠️ MENGAMBIL FORMAT BERSIH TEKS MURNI (TANPA TAG HTML <p> / <span>)
                let textMurni = quillInstance.root.innerText.trim();
                inputHidden.value = textMurni;
            }
        }
    });
});

/* ==========================================================================
   🖼 *INTERAKTIF LOGO UTAMA FUNCTIONS*
   ========================================================================== */
function triggerLogoUpload() {
    const fileInput = document.getElementById('logo');
    if (fileInput) { fileInput.click(); }
}

if(document.getElementById('logo')) {
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.type !== "image/png") {
                alert("Format file salah! Harap pilih gambar dengan format khusus .PNG");
                this.value = ""; 
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                const middleBox = document.getElementById('logoPreviewInline');
                if (middleBox) { middleBox.innerHTML = `<img src="${event.target.result}" alt="Preview Logo" id="imgPreviewInline" style="width:100%; height:100%; object-fit:contain;">`; }
            };
            reader.readAsDataURL(file);
        }
    });
}

/* ==========================================================================
   🎭 *INTERAKTIF MASKOT FUNCTIONS*
   ========================================================================== */
function triggerMaskotUpload() {
    const maskotInput = document.getElementById('maskot');
    if (maskotInput) { maskotInput.click(); }
}

if(document.getElementById('maskot')) {
    document.getElementById('maskot').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const validTypes = ["image/png", "image/jpeg", "image/jpg"];
            if (!validTypes.includes(file.type)) {
                alert("Format file salah! Harap pilih gambar berformat .PNG, .JPG, atau .JPEG");
                this.value = ""; 
                return;
            }

            const reader = new FileReader();
            reader.onload = function(event) {
                const maskotBox = document.getElementById('maskotPreviewInline');
                if (maskotBox) {
                    maskotBox.innerHTML = `<img src="${event.target.result}" alt="Preview Maskot" id="imgMaskotPreviewInline" style="width:100%; height:100%; object-fit:contain;">`;
                }
            };
            reader.readAsDataURL(file);
        }
    });
}
</script>

<?= $this->endSection() ?>