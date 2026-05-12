<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<style>
    /* --- STYLE DASAR --- */
    .page-wrapper { background-color: #E6F4F1; padding: 20px; border-radius: 15px; min-height: 100vh; }
    
    /* --- BANNER HEADER --- */
    .banner-top { background-color: #00BBC2; border-radius: 15px; padding: 25px 30px; color: white; display: flex; align-items: center; margin-bottom: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .banner-icon { 
        background: rgba(255, 255, 255, 0.25); 
        width: 65px; 
        height: 65px; 
        border-radius: 15px; 
        margin-right: 25px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        flex-shrink: 0;
    }
    .banner-text h4 { margin: 0; font-weight: 700; font-size: 20px; }
    .banner-text p { margin: 0; font-size: 14px; opacity: 0.95; margin-top: 5px; }

    /* --- KARTU FORM --- */
    .form-card { background: #FFFFFF; border-radius: 15px; padding: 45px 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); max-width: 850px; margin: 0 auto; }
    
    /* --- STYLE ISIAN (DESAIN BERSIH) --- */
    .form-label-custom { 
        font-weight: 600; 
        color: #333; 
        font-size: 14px; 
        margin-bottom: 8px; 
        display: block; 
    }
    
    .form-input-custom { 
        background-color: #FFFFFF; 
        border: 1px solid #00BBC2; 
        border-radius: 6px; 
        padding: 12px 15px; 
        width: 100%; 
        font-size: 14px; 
        color: #333; 
        margin-bottom: 25px; 
        outline: none; 
        transition: all 0.3s; 
    }
    
    .form-input-custom::placeholder { color: #A0A0A0; font-size: 13px; }
    .form-input-custom:focus { box-shadow: 0 0 0 3px rgba(0, 187, 194, 0.15); border-color: #009ca2; }
    textarea.form-input-custom { min-height: 100px; resize: vertical; }

    /* --- STYLE DINAMIS (KELURAHAN & POSYANDU) --- */
    .dynamic-box {
        border: 1px dashed #00BBC2;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 20px;
        background: #FAFAFA;
        position: relative;
    }
    
    .dynamic-box-title { font-weight: 700; color: #00BBC2; font-size: 15px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
    
    .btn-add-sub { background: #E6F4F1; color: #00BBC2; border: 1px solid #00BBC2; border-radius: 6px; padding: 8px 15px; font-size: 13px; font-weight: 600; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; gap: 6px; }
    .btn-add-sub:hover { background: #00BBC2; color: #FFF; }
    
    .btn-remove-box { position: absolute; top: 15px; right: 20px; color: #DC3545; background: none; border: none; font-size: 18px; cursor: pointer; transition: 0.2s; }
    .btn-remove-box:hover { transform: scale(1.2); }

    .posyandu-row { display: flex; gap: 10px; align-items: flex-start; margin-bottom: 15px; }
    .posyandu-row .form-input-custom { margin-bottom: 0; }
    .btn-remove-pos { color: #FFF; background: #DC3545; border: none; border-radius: 6px; cursor: pointer; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 16px; transition: 0.2s; flex-shrink: 0; }
    .btn-remove-pos:hover { background: #C82333; }

    /* --- TOMBOL AKSI --- */
    .action-buttons { display: flex; gap: 15px; margin-top: 20px; justify-content: flex-end; }
    .btn-batal { background: #FFF; border: 1px solid #00BBC2; color: #00BBC2; border-radius: 6px; padding: 10px 25px; font-weight: 600; transition: 0.3s; text-decoration: none; font-size: 14px; }
    .btn-batal:hover { background: #E6F4F1; color: #009ca2; }
    .btn-simpan { background-color: #00BBC2; border: 1px solid #00BBC2; color: #FFF; border-radius: 6px; padding: 10px 25px; font-weight: 600; transition: 0.3s; cursor: pointer; font-size: 14px; box-shadow: 0 2px 5px rgba(0, 187, 194, 0.2); }
    .btn-simpan:hover { background-color: #009ca2; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0, 187, 194, 0.3); }
</style>

<div class="page-wrapper">
    <div class="banner-top">
        <div class="banner-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="34" height="34">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
        </div>
        <div class="banner-text">
            <h4>Tambah Data Puskesmas</h4>
            <p>Silahkan lengkapi isian data puskesmas dan cakupan wilayahnya di bawah ini</p>
        </div>
    </div>

    <div class="form-card">
        <form action="<?= base_url('dbd/admin/manajemen_puskesmas/simpan') ?>" method="POST">
            <?= csrf_field() ?>

            <label class="form-label-custom">Nama Puskesmas <span class="text-danger">*</span></label>
            <input type="text" name="nama_instansi" class="form-input-custom" placeholder="Ketik Nama Puskesmas..." required>

            <div class="row">
                <div class="col-md-4">
                    <label class="form-label-custom">Nomor Telepon</label>
                    <input type="text" name="telepon" class="form-input-custom" placeholder="Contoh: 0331-XXXXXX">
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Kecamatan <span class="text-danger">*</span></label>
                    <input type="text" name="kecamatan" class="form-input-custom" placeholder="Ketik Kecamatan..." required>
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-input-custom" placeholder="Ketik Kode Pos...">
                </div>
            </div>

            <label class="form-label-custom">Alamat Lengkap <span class="text-danger">*</span></label>
            <textarea name="alamat" class="form-input-custom" placeholder="Ketik Alamat Lengkap..." required></textarea>

            <hr style="border-top: 2px dashed #EEE; margin: 35px 0 25px;">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h5 style="font-weight: 700; color: #333; margin: 0;">Wilayah Cakupan</h5>
                    <p style="font-size: 13px; color: #888; margin: 0;">Tambahkan kelurahan dan pos posyandu yang dibawahi.</p>
                </div>
                <button type="button" class="btn-add-sub" onclick="tambahKelurahan()">
                    <i class="fa-solid fa-plus"></i> Tambah Kelurahan
                </button>
            </div>

            <div id="kelurahanContainer"></div>

            <hr style="border-top: 1px solid #EEE; margin: 30px 0 20px;">
            <div class="action-buttons">
                <a href="<?= base_url('manajemen_puskesmas') ?>" class="btn-batal">Batal</a>
                <button type="submit" class="btn-simpan">Tambah Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Penomoran unik untuk elemen dinamis
    let kelIndex = 0;
    let posIndex = 0;

    // FUNGSI 1: MENAMBAH KOTAK KELURAHAN
    function tambahKelurahan() {
        const container = document.getElementById('kelurahanContainer');
        const box = document.createElement('div');
        box.className = 'dynamic-box';
        box.id = `kel_box_${kelIndex}`;
        
        box.innerHTML = `
            <button type="button" class="btn-remove-box" onclick="hapusElemen('kel_box_${kelIndex}')" title="Hapus Kelurahan">
                <i class="fa-solid fa-xmark"></i>
            </button>
            
            <div class="dynamic-box-title">
                <i class="fa-solid fa-map"></i> Data Kelurahan
            </div>
            
            <label class="form-label-custom">Nama Kelurahan <span class="text-danger">*</span></label>
            <input type="text" name="kelurahan[${kelIndex}][nama]" class="form-input-custom" placeholder="Ketik Nama Kelurahan..." required>
            
            <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
                <label class="form-label-custom mb-0">Daftar Pos Posyandu</label>
                <button type="button" class="btn-add-sub" onclick="tambahPosyandu(${kelIndex})">
                    <i class="fa-solid fa-plus"></i> Pos Posyandu
                </button>
            </div>
            
            <div id="posyanduContainer_${kelIndex}"></div>
        `;
        
        container.appendChild(box);
        
        // Otomatis buat 1 input posyandu saat kelurahan baru ditambahkan
        tambahPosyandu(kelIndex);
        
        kelIndex++;
    }

    // FUNGSI 2: MENAMBAH INPUT POSYANDU
    function tambahPosyandu(kIndex) {
        const container = document.getElementById(`posyanduContainer_${kIndex}`);
        const row = document.createElement('div');
        row.className = 'posyandu-row';
        
        const currentPosId = `pos_row_${posIndex}`;
        row.id = currentPosId;
        
        row.innerHTML = `
            <input type="text" name="kelurahan[${kIndex}][posyandu][]" class="form-input-custom" placeholder="Ketik Nama Pos Posyandu (Contoh: Catleya 01)..." required>
            <button type="button" class="btn-remove-pos" onclick="hapusElemen('${currentPosId}')" title="Hapus Posyandu">
                <i class="fa-solid fa-trash"></i>
            </button>
        `;
        
        container.appendChild(row);
        posIndex++;
    }

    // FUNGSI 3: MENGHAPUS ELEMEN
    function hapusElemen(elementId) {
        const el = document.getElementById(elementId);
        if (el) { el.remove(); }
    }

    // Saat halaman dimuat, otomatis munculkan 1 kotak kelurahan
    document.addEventListener("DOMContentLoaded", function() {
        tambahKelurahan();
    });
</script>

<?= $this->endSection() ?>