<?= $this->extend('layout/dashboard_layout_kader') ?>
<?= $this->section('content') ?>

<style>
    /* --- STYLE DASAR --- */
    .page-wrapper { background-color: #E6F4F1; padding: 20px; border-radius: 15px; min-height: 100vh; }
    .banner-top { background-color: #51C2B8; border-radius: 15px; padding: 20px 25px; color: white; display: flex; align-items: center; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .banner-icon { background: rgba(255, 255, 255, 0.2); padding: 12px 15px; border-radius: 10px; margin-right: 20px; font-size: 24px; display: flex; align-items: center; justify-content: center; }
    .banner-text h4 { margin: 0; font-weight: 700; font-size: 18px; }
    .banner-text p { margin: 0; font-size: 13px; opacity: 0.9; margin-top: 3px; }
    .form-card { background: #FFFFFF; border-radius: 15px; padding: 40px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); }
    .form-label { font-weight: 700; color: #333; font-size: 14px; margin-bottom: 5px; display: block; }
    .form-sublabel { font-size: 11px; color: #888; margin-bottom: 10px; display: block; font-weight: normal; }
    
    .form-input { background-color: #F4F6F8; border: 1px solid #EAEFEF; border-radius: 10px; padding: 12px 18px; width: 100%; font-size: 14px; color: #333; margin-bottom: 20px; outline: none; transition: all 0.3s; appearance: none; }
    .form-input:focus { border-color: #00CED1; background-color: #FFF; }
    .input-icon-wrap { position: relative; margin-bottom: 20px; }
    .input-icon-wrap .form-input { margin-bottom: 0; padding-right: 40px; }
    .input-icon-wrap i { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #555; pointer-events: none; }

    /* --- STYLE POPUP KALENDER KUSTOM --- */
    .calendar-popup { position: absolute; top: 100%; left: 0; width: 100%; max-width: 340px; background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 1000; padding: 20px; margin-top: 5px; border: 1px solid #eee; display: none; }
    .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .calendar-header button { background: #F4F6F8; border: none; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #333; font-weight: bold; font-size: 14px; transition: 0.2s; }
    .calendar-header button:hover { background: #EAEFEF; color: #00CED1; }
    .calendar-header button.disabled-btn { opacity: 0.3; pointer-events: none; }
    .calendar-title { font-weight: bold; font-size: 16px; color: #333; display: flex; align-items: center; gap: 5px; }
    .header-clickable { cursor: pointer; padding: 4px 8px; border-radius: 6px; transition: 0.2s; display: inline-block; }
    .header-clickable:hover { background: #E6F4F1; color: #00CED1 !important; }
    .calendar-table { width: 100%; border-collapse: separate; border-spacing: 0 5px; }
    .calendar-table th { font-size: 12px; color: #888; padding-bottom: 10px; font-weight: 600; text-align: center; }
    .calendar-table td { text-align: center; padding: 10px 0; cursor: pointer; font-size: 14px; color: #333; transition: 0.2s; }
    .calendar-table td.muted { color: #ccc; }
    .calendar-table td.disabled-day { color: #E0E0E0 !important; cursor: not-allowed !important; background-color: transparent !important; }
    .calendar-table tr.week-row { border-radius: 10px; transition: background 0.2s; }
    .calendar-table tr.week-row td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .calendar-table tr.week-row td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
    .calendar-table tr.week-row:hover { background-color: #F0FCFC; }
    .calendar-table tr.selected-week { background-color: #E6F4F1; }
    .calendar-table td.selected-day { background-color: #00CED1 !important; color: white !important; font-weight: bold; border-radius: 8px !important; }
    .grid-view { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; padding: 10px 0; }
    .grid-item { text-align: center; padding: 12px 0; background: #F4F6F8; border-radius: 8px; cursor: pointer; font-size: 13px; font-weight: 600; color: #333; transition: 0.2s; }
    .grid-item:hover { background: #00CED1; color: white; }
    .grid-item.active { background: #00CED1; color: white; }
    .grid-item.disabled-grid { background: #FFF; color: #E0E0E0; cursor: not-allowed; }

    /* --- STYLE COUNTER & WARNING --- */
    .counter-container { display: flex; align-items: center; margin-bottom: 5px; }
    .btn-counter { background: #FFF; border: 2px solid #555; border-radius: 8px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 16px; cursor: pointer; color: #333; transition: 0.2s; flex-shrink: 0; }
    .btn-counter:hover { background: #F0F0F0; }
    .counter-input { background-color: #F4F6F8; border: 1px solid #EAEFEF; border-radius: 10px; height: 40px; flex: 1; margin: 0 10px; text-align: center; font-weight: bold; font-size: 16px; outline: none; min-width: 0; }
    .counter-input::-webkit-outer-spin-button, .counter-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    .warning-text { color: #DC3545; font-size: 11px; margin-top: 5px; margin-bottom: 15px; display: none; align-items: center; gap: 5px; }

    /* --- STYLE UPLOAD AREA & PREVIEW --- */
    .upload-area { position: relative; border: 2px dashed #D0D0D0; border-radius: 15px; padding: 40px 20px; text-align: center; background-color: #FAFAFA; margin-bottom: 30px; transition: 0.3s; min-height: 250px; display: flex; flex-direction: column; justify-content: center; overflow: hidden; }
    .upload-area.has-files { border-color: #D0D0D0; background-color: #FAFAFA; padding: 30px 20px; }
    .upload-default { cursor: pointer; }
    .upload-default h5 { font-weight: bold; color: #000; margin-bottom: 20px; }
    .upload-icon-circle { width: 80px; height: 80px; background: linear-gradient(135deg, #E0F7F6, #C1F0ED); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; box-shadow: 0 8px 15px rgba(0, 206, 209, 0.2); transition: 0.3s; }
    .upload-default:hover .upload-icon-circle { transform: scale(1.05); }
    .upload-icon-circle i { font-size: 30px; color: #00CED1; }
    .upload-default p { color: #A0A0A0; font-size: 12px; margin: 0; }
    
    .upload-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 10; border-radius: 13px; }
    .upload-options-box { background: #D5F0ED; border-radius: 20px; padding: 30px 50px; display: flex; gap: 40px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .option-btn { display: flex; flex-direction: column; align-items: center; gap: 12px; cursor: pointer; }
    .option-icon { width: 65px; height: 65px; background: #FFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #333; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: 0.2s; }
    .option-btn:hover .option-icon { transform: scale(1.1); color: #00CED1; }
    .option-btn span { font-size: 13px; font-weight: bold; color: #333; }

    .preview-container { display: none; width: 100%; }
    .preview-header { font-weight: bold; font-size: 18px; text-align: center; margin-bottom: 25px; color: #000; }
    .preview-grid { display: flex; flex-wrap: wrap; gap: 15px; align-items: center; justify-content: center; }
    .preview-item { position: relative; width: 200px; height: 130px; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .preview-item img { width: 100%; height: 100%; object-fit: cover; }
    .btn-remove { position: absolute; top: 8px; right: 8px; background: #000; color: #FFF; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; cursor: pointer; border: none; transition: 0.2s; }
    .btn-remove:hover { background: #DC3545; transform: scale(1.1); }
    .btn-add-more { width: 50px; height: 50px; border-radius: 50%; border: 2px solid #000; background: transparent; display: flex; align-items: center; justify-content: center; font-size: 24px; cursor: pointer; color: #000; transition: 0.2s; }
    .btn-add-more:hover { background: #E6F4F1; border-color: #00CED1; color: #00CED1; }

    /* --- STYLE MODAL KAMERA LIVE --- */
    .camera-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; display: none; flex-direction: column; justify-content: center; align-items: center; }
    .camera-container { position: relative; width: 100%; max-width: 500px; padding: 20px; }
    #liveCamera { width: 100%; border-radius: 15px; background: #222; transform: scaleX(-1); }
    .camera-controls { display: flex; justify-content: space-around; width: 100%; max-width: 500px; margin-top: 20px; flex-wrap: wrap; gap: 10px; }
    .btn-close-cam { background: #DC3545; color: white; border: none; padding: 12px 25px; border-radius: 30px; font-weight: bold; font-size: 16px; cursor: pointer; }
    .btn-snap-cam { background: #00CED1; color: white; border: none; padding: 12px 25px; border-radius: 30px; font-weight: bold; font-size: 16px; cursor: pointer; }

    /* --- ACTION BUTTONS --- */
    .action-buttons { display: flex; gap: 15px; }
    .btn-batal { flex: 1; background: #FFF; border: 1px solid #D0D0D0; color: #333; border-radius: 25px; padding: 12px; font-weight: bold; transition: 0.3s; text-decoration: none; text-align: center;}
    .btn-batal:hover { background: #F5F5F5; border-color: #B0B0B0; }
    .btn-kirim { flex: 1; background: #00CED1; border: 1px solid #00CED1; color: #FFF; border-radius: 25px; padding: 12px; font-weight: bold; transition: 0.3s; cursor: pointer; }
    .btn-kirim:hover { background: #00B3B5; }
    .btn-kirim:disabled { background: #A0EBEB; border-color: #A0EBEB; cursor: not-allowed; }

    /* --- RESPONSIVE MOBILE FIXES --- */
    @media (max-width: 768px) {
        .page-wrapper { padding: 10px; }
        .banner-top { flex-direction: column; text-align: center; padding: 20px 15px; gap: 10px; }
        .banner-icon { margin-right: 0; width: 50px; height: 50px; }
        .form-card { padding: 20px; }
        .calendar-popup { max-width: 100%; padding: 15px; left: 50%; transform: translateX(-50%); width: calc(100% - 20px); }
        .upload-options-box { flex-direction: column; gap: 20px; padding: 20px; }
        .preview-item { width: 140px; height: 100px; }
        .action-buttons { flex-direction: column; gap: 10px; }
        .btn-batal, .btn-kirim { width: 100%; }
        .row.mt-4 > div { margin-bottom: 15px; }
    }
</style>

<div class="page-wrapper">
    <div class="banner-top">
        <div class="banner-icon"><i class="fa-solid fa-pen-to-square"></i></div>
        <div class="banner-text">
            <h4>Edit Pelaporan Kader</h4>
            <p>Silahkan perbarui data dengan benar</p>
        </div>
    </div>

    <div class="form-card">
        <form action="<?= base_url('dbd/update_pelaporan/' . $laporan['id_laporan']) ?>" method="POST" enctype="multipart/form-data">
            
            <label class="form-label">Periode Pemeriksaan Jentik</label>
            <div class="input-icon-wrap" id="periodeContainer">
                <input type="text" name="periode" id="periode_input" class="form-input" value="<?= $laporan['periode_lengkap'] ?>" readonly style="cursor: pointer;" required>
                <i class="fa-regular fa-calendar" style="cursor: pointer;"></i>
                <div id="calendarPopup" class="calendar-popup">
                    <div class="calendar-header">
                        <button type="button" id="prevMonth">&#10094;</button>
                        <div class="calendar-title">
                            <span id="monthSelectBtn" class="header-clickable">April</span>
                            <span id="yearSelectBtn" class="header-clickable" style="color: #333;">2026</span>
                        </div>
                        <button type="button" id="nextMonth">&#10095;</button>
                    </div>
                    <table class="calendar-table" id="daysView">
                        <thead><tr><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th><th>Su</th></tr></thead>
                        <tbody id="calendarBody"></tbody>
                    </table>
                    <div id="monthsView" class="grid-view" style="display: none;"></div>
                    <div id="yearsView" class="grid-view" style="display: none;"></div>
                </div>
            </div>

            <label class="form-label">Wilayah Kerja Puskesmas</label>
            <div class="input-icon-wrap">
                <select name="id_puskesmas" class="form-input" required>
                    <option value="1" <?= $laporan['id_puskesmas'] == 1 ? 'selected' : '' ?>>PKM Sumbersari</option>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>

            <label class="form-label">Kelurahan</label>
            <div class="input-icon-wrap">
                <select name="id_kelurahan" id="kelurahanSelect" class="form-input" required>
                    <option value="1" <?= $laporan['id_kelurahan'] == 1 ? 'selected' : '' ?>>Sumbersari</option>
                    <option value="2" <?= $laporan['id_kelurahan'] == 2 ? 'selected' : '' ?>>Wirolegi</option>
                    <option value="3" <?= $laporan['id_kelurahan'] == 3 ? 'selected' : '' ?>>Antirogo</option>
                    <option value="4" <?= $laporan['id_kelurahan'] == 4 ? 'selected' : '' ?>>Tegal Gede</option>
                    <option value="5" <?= $laporan['id_kelurahan'] == 5 ? 'selected' : '' ?>>Karangrejo</option>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>

            <label class="form-label">Pos Posyandu</label>
            <div class="input-icon-wrap">
                <select name="id_posyandu" id="posyanduSelect" class="form-input" required>
                    </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <label class="form-label">Jumlah Rumah/KK yang Diperiksa</label>
                    <span class="form-sublabel">Sebutkan Jumlah Rumah / KK yang diperiksa</span>
                    <div class="counter-container mb-3">
                        <button type="button" class="btn-counter" onclick="decrement('diperiksa')"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" id="diperiksa" name="diperiksa" class="counter-input" value="<?= $laporan['diperiksa'] ?>" min="0" oninput="validateJentik()" required>
                        <button type="button" class="btn-counter" onclick="increment('diperiksa')"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jumlah Rumah/KK yang Positif Jentik</label>
                    <span class="form-sublabel">Sebutkan Jumlah Rumah / KK yang positif jentik</span>
                    <div class="counter-container">
                        <button type="button" class="btn-counter" onclick="decrement('positif')"><i class="fa-solid fa-minus"></i></button>
                        <input type="number" id="positif" name="positif" class="counter-input" value="<?= $laporan['positif'] ?>" min="0" oninput="validateJentik()" required>
                        <button type="button" class="btn-counter" onclick="increment('positif')"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div id="warningPositif" class="warning-text">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Jumlah rumah yang positif jentik tidak boleh melebihi jumlah rumah yang diperiksa
                    </div>
                </div>
            </div>

            <label class="form-label mt-2">Bagian yang Positif</label>
            <input type="text" name="bagian" class="form-input" value="<?= $laporan['bagian'] ?>" placeholder="(Sebutkan, contoh : kamar mandi, vas bunga, dll)">

            <label class="form-label mt-2">Upload Gambar saat Pemeriksaan Jentik</label>
            <div class="upload-area" id="uploadArea">
                <div id="uploadDefault" class="upload-default" onclick="showUploadOverlay()">
                    <h5>Unggah foto di sini</h5>
                    <div class="upload-icon-circle"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
                    <p>Format yang didukung: JPG, JPEG, PNG.</p>
                </div>
                <div class="upload-overlay" id="uploadOverlay">
                    <div class="upload-options-box">
                        <div class="option-btn" onclick="triggerFileInput('file', event)">
                            <div class="option-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
                            <span>Upload</span>
                        </div>
                        <div class="option-btn" onclick="triggerFileInput('camera', event)">
                            <div class="option-icon"><i class="fa-solid fa-camera"></i></div>
                            <span>Pindai</span>
                        </div>
                    </div>
                </div>
                <div class="preview-container" id="previewContainer">
                    <div class="preview-header" id="previewTitle">Foto berhasil diunggah!</div>
                    <div class="preview-grid" id="previewGrid"></div>
                </div>
            </div>

            <input type="file" id="inputFile" multiple accept=".jpg, .jpeg, .png" style="display: none;" onchange="handleFileSelect(this)">
            <input type="file" name="foto[]" id="realSubmitInput" multiple style="display: none;">
            
            <div id="keepPhotosContainer"></div>

            <div class="action-buttons">
                <a href="<?= base_url('dbd/pelaporan') ?>" class="btn-batal">Batal</a>
                <button type="submit" id="btnKirim" class="btn-kirim">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<div id="cameraModal" class="camera-modal">
    <div class="camera-container">
        <video id="liveCamera" autoplay playsinline></video>
    </div>
    <div class="camera-controls">
        <button type="button" class="btn-close-cam" onclick="closeCamera()"><i class="fa-solid fa-xmark"></i> Batal</button>
        <button type="button" class="btn-snap-cam" onclick="takeSnapshot()"><i class="fa-solid fa-camera"></i> Ambil Foto</button>
    </div>
</div>
<canvas id="cameraCanvas" style="display:none;"></canvas>

<script>
    /* ----- 1. LOGIKA DINAMIS POS POSYANDU BERDASARKAN ID_KELURAHAN ----- */
    const posyanduData = {
        "1": ["CATLEYA 01", "CATLEYA 02", "CATLEYA 03", "CATLEYA 04", "CATLEYA 05", "CATLEYA 06", "CATLEYA 07", "CATLEYA 08", "CATLEYA 09", "CATLEYA 10", "CATLEYA 11", "CATLEYA 12", "CATLEYA 13", "CATLEYA 14", "CATLEYA 15", "CATLEYA 16", "CATLEYA 17", "CATLEYA 18", "CATLEYA 19", "CATLEYA 20", "CATLEYA 21", "CATLEYA 22", "CATLEYA 23", "CATLEYA 24", "CATLEYA 25", "CATLEYA 26", "CATLEYA 27", "CATLEYA 28", "CATLEYA 29", "CATLEYA 30", "CATLEYA 31", "CATLEYA 32", "CATLEYA 33", "CATLEYA 34", "CATLEYA 35"],
        "2": ["CATLEYA 36", "CATLEYA 36A (BAYANGAN)", "CATLEYA 37", "CATLEYA 38", "CATLEYA 39", "CATLEYA 40", "CATLEYA 41", "CATLEYA 42", "CATLEYA 43", "CATLEYA 44", "CATLEYA 44A", "CATLEYA 45", "CATLEYA 46", "CATLEYA 47", "CATLEYA 48", "CATLEYA 49", "CATLEYA 50", "CATLEYA 51", "CATLEYA 52", "CATLEYA 53", "CATLEYA 54"],
        "3": ["CATLEYA 55", "CATLEYA 56", "CATLEYA 57", "CATLEYA 58", "CATLEYA 58A (BAYANGAN)", "CATLEYA 59", "CATLEYA 60", "CATLEYA 61", "CATLEYA 62", "CATLEYA 63", "CATLEYA 64", "CATLEYA 65", "CATLEYA 65A (BAYANGAN)", "CATLEYA 66", "CATLEYA 67"],
        "4": ["CATLEYA 68", "CATLEYA 69", "CATLEYA 70", "CATLEYA 71", "CATLEYA 72", "CATLEYA 73", "CATLEYA 74", "CATLEYA 74A", "CATLEYA 74B"],
        "5": ["CATLEYA 75", "CATLEYA 76", "CATLEYA 77", "CATLEYA 78", "CATLEYA 78A (BAYANGAN)", "CATLEYA 79", "CATLEYA 80", "CATLEYA 81", "CATLEYA 82", "CATLEYA 83", "CATLEYA 84", "CATLEYA 85", "CATLEYA 86", "CATLEYA 87", "CATLEYA 88", "CATLEYA 88A (BAYANGAN)", "CATLEYA 89", "CATLEYA 90", "CATLEYA 91", "CATLEYA 92", "CATLEYA 92A (BAYANGAN)", "CATLEYA 93", "CATLEYA 94", "CATLEYA 95", "CATLEYA 95A", "CATLEYA 95B (BAYANGAN)"]
    };

    const savedPosyanduId = "<?= $laporan['id_posyandu'] ?>";
    function loadPosyandu(kelId) {
        const select = document.getElementById('posyanduSelect');
        select.innerHTML = '<option value="" disabled selected>Pilih pos posyandu</option>';
        if (posyanduData[kelId]) {
            posyanduData[kelId].forEach(name => {
                let idMatch = name.match(/CATLEYA\s([0-9A-Z]+)/);
                let id = idMatch ? idMatch[1] : name;
                let opt = document.createElement('option');
                opt.value = id; opt.text = name;
                if(id === savedPosyanduId) opt.selected = true;
                select.appendChild(opt);
            });
        }
    }
    document.getElementById('kelurahanSelect').addEventListener('change', function() { loadPosyandu(this.value); });
    loadPosyandu(document.getElementById('kelurahanSelect').value);

    /* ----- 2. LOGIKA UPLOAD & KAMERA LIVE ----- */
    let keepPhotos = <?= !empty($laporan['foto']) ? $laporan['foto'] : '[]' ?>; // Foto dari DB
    let newPhotos = []; // Foto baru
    let videoStream = null;

    document.addEventListener("DOMContentLoaded", function() {
        if (keepPhotos && keepPhotos.length > 0) renderFullGallery();
    });

    function showUploadOverlay() { document.getElementById('uploadOverlay').style.display = 'flex'; }
    document.getElementById('uploadOverlay').onclick = function(e) { if(e.target === this) { this.style.display = 'none'; } };

    function triggerFileInput(type, e) {
        e.stopPropagation();
        document.getElementById('uploadOverlay').style.display = 'none';
        if (type === 'file') { document.getElementById('inputFile').click(); } 
        else { openCamera(); }
    }

    function handleFileSelect(inputElement) {
        if (inputElement.files && inputElement.files.length > 0) {
            for (let i = 0; i < inputElement.files.length; i++) { newPhotos.push(inputElement.files[i]); }
            inputElement.value = ""; renderFullGallery();
        }
    }

    function openCamera() {
        const modal = document.getElementById('cameraModal');
        const video = document.getElementById('liveCamera');
        modal.style.display = 'flex';
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
            .then(function(stream) { videoStream = stream; video.srcObject = stream; })
            .catch(function(err) { alert("Gagal mengakses kamera."); closeCamera(); });
        } else { alert("Browser tidak mendukung kamera."); closeCamera(); }
    }

    function closeCamera() {
        document.getElementById('cameraModal').style.display = 'none';
        if (videoStream) { videoStream.getTracks().forEach(track => track.stop()); }
    }

    function takeSnapshot() {
        const video = document.getElementById('liveCamera');
        const canvas = document.getElementById('cameraCanvas');
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth; canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        canvas.toBlob(function(blob) {
            const fileName = "Kamera_" + new Date().getTime() + ".jpg";
            const file = new File([blob], fileName, { type: "image/jpeg" });
            newPhotos.push(file); renderFullGallery(); closeCamera();
        }, 'image/jpeg', 0.9);
    }

    function removeOld(index) { keepPhotos.splice(index, 1); renderFullGallery(); }
    function removeNew(index) { newPhotos.splice(index, 1); renderFullGallery(); }

    function renderFullGallery() {
        const defaultState = document.getElementById('uploadDefault'); 
        const previewState = document.getElementById('previewContainer');
        const previewGrid = document.getElementById('previewGrid'); 
        const uploadArea = document.getElementById('uploadArea');
        const keepContainer = document.getElementById('keepPhotosContainer');

        if (keepPhotos.length === 0 && newPhotos.length === 0) {
            defaultState.style.display = 'block'; previewState.style.display = 'none'; uploadArea.classList.remove('has-files');
            keepContainer.innerHTML = '';
        } else {
            defaultState.style.display = 'none'; previewState.style.display = 'block'; uploadArea.classList.add('has-files');
            let total = keepPhotos.length + newPhotos.length;
            document.getElementById('previewTitle').innerText = total + " foto berhasil diunggah!";
            
            previewGrid.innerHTML = ''; keepContainer.innerHTML = '';
            
            // Tampilkan foto lama
            keepPhotos.forEach((foto, index) => {
                let div = document.createElement('div'); div.className = 'preview-item';
                div.innerHTML = `<img src="<?= base_url('uploads/pelaporan/') ?>/${foto}"><div style="position:absolute; bottom:0; width:100%; background:rgba(0,0,0,0.5); color:white; font-size:10px; text-align:center;">Foto Lama</div><button type="button" class="btn-remove" onclick="removeOld(${index})"><i class="fa-solid fa-xmark"></i></button>`;
                previewGrid.appendChild(div);
                keepContainer.innerHTML += `<input type="hidden" name="keep_photos[]" value="${foto}">`;
            });

            // Tampilkan foto baru
            newPhotos.forEach((file, index) => {
                let url = URL.createObjectURL(file);
                let div = document.createElement('div'); div.className = 'preview-item';
                div.innerHTML = `<img src="${url}"><button type="button" class="btn-remove" onclick="removeNew(${index})"><i class="fa-solid fa-xmark"></i></button>`;
                previewGrid.appendChild(div);
            });

            let addBtn = document.createElement('button'); addBtn.type = 'button'; addBtn.className = 'btn-add-more';
            addBtn.innerHTML = '<i class="fa-solid fa-plus"></i>'; addBtn.onclick = function(e) { e.stopPropagation(); showUploadOverlay(); };
            previewGrid.appendChild(addBtn);
        }
        syncDataTransfer();
    }

    function syncDataTransfer() {
        let dt = new DataTransfer(); newPhotos.forEach(file => dt.items.add(file));
        document.getElementById('realSubmitInput').files = dt.files;
    }

    /* ----- 3. LOGIKA COUNTER & VALIDASI JENTIK ----- */
    // Pastikan tombol dipicu saat halaman pertama kali diload agar pengecekan aktif
    window.onload = function() { validateJentik(); }

    function validateJentik() {
        var diperiksa = parseInt(document.getElementById('diperiksa').value, 10) || 0;
        var positif = parseInt(document.getElementById('positif').value, 10) || 0;
        var warningMsg = document.getElementById('warningPositif');
        var btnKirim = document.getElementById('btnKirim');
        if (positif > diperiksa) { warningMsg.style.display = 'flex'; btnKirim.disabled = true; } 
        else { warningMsg.style.display = 'none'; btnKirim.disabled = false; }
    }
    function decrement(id) { var input = document.getElementById(id); var value = parseInt(input.value, 10) || 0; if (value > 0) { input.value = value - 1; validateJentik(); } }
    function increment(id) { var input = document.getElementById(id); var value = parseInt(input.value, 10) || 0; input.value = value + 1; validateJentik(); }

    /* ----- 4. LOGIKA KALENDER MINGGUAN KUSTOM ----- */
    let currentDate = new Date(); let activeMonth = currentDate.getMonth(); let activeYear = currentDate.getFullYear();
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const shortMonths = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"];
    let todayLimit = new Date(); todayLimit.setHours(0, 0, 0, 0); let selectedGlobal = null; 
    let prevBtn = document.getElementById('prevMonth'); let nextBtn = document.getElementById('nextMonth');

    function renderCalendar(month, year) {
        document.getElementById('daysView').style.display = 'table'; document.getElementById('monthsView').style.display = 'none'; document.getElementById('yearsView').style.display = 'none';
        prevBtn.style.visibility = 'visible'; nextBtn.style.visibility = 'visible';
        prevBtn.onclick = function(e) { e.stopPropagation(); activeMonth--; if(activeMonth < 0) { activeMonth = 11; activeYear--; } renderCalendar(activeMonth, activeYear); };
        nextBtn.onclick = function(e) { e.stopPropagation(); activeMonth++; if(activeMonth > 11) { activeMonth = 0; activeYear++; } renderCalendar(activeMonth, activeYear); };
        if (year === todayLimit.getFullYear() && month === todayLimit.getMonth()) { nextBtn.classList.add('disabled-btn'); } else { nextBtn.classList.remove('disabled-btn'); }
        document.getElementById('monthSelectBtn').innerText = monthNames[month]; document.getElementById('yearSelectBtn').innerText = year;

        let tbody = document.getElementById('calendarBody'); tbody.innerHTML = '';
        let firstDay = new Date(year, month, 1).getDay(); let offset = firstDay === 0 ? 6 : firstDay - 1; 
        let daysInMonth = new Date(year, month + 1, 0).getDate(); let daysInPrevMonth = new Date(year, month, 0).getDate();
        let dateCount = 1; let nextMonthDate = 1;

        for (let i = 0; i < 6; i++) {
            let row = document.createElement('tr'); row.className = 'week-row';
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement('td'); let cellDay = 0, cellMonth = month, cellYear = year;
                if (i === 0 && j < offset) { cell.innerText = daysInPrevMonth - offset + j + 1; cell.className = 'muted'; cellMonth = month - 1; if(cellMonth < 0) { cellMonth = 11; cellYear--; } cellDay = parseInt(cell.innerText); } 
                else if (dateCount > daysInMonth) { cell.innerText = nextMonthDate; cell.className = 'muted'; cellMonth = month + 1; if(cellMonth > 11) { cellMonth = 0; cellYear++; } cellDay = nextMonthDate; nextMonthDate++; } 
                else { cell.innerText = dateCount; cellDay = dateCount; dateCount++; }

                let currentCellDate = new Date(cellYear, cellMonth, cellDay);
                if (currentCellDate > todayLimit) { cell.classList.add('disabled-day'); } 
                else {
                    if (selectedGlobal && cellYear === selectedGlobal.year && cellMonth === selectedGlobal.month && cellDay === selectedGlobal.day) { row.classList.add('selected-week'); cell.classList.add('selected-day'); }
                    cell.onclick = function(e) { e.stopPropagation(); selectedGlobal = { year: cellYear, month: cellMonth, day: cellDay }; processWeekSelection(cellYear, cellMonth, cellDay); renderCalendar(activeMonth, activeYear); };
                }
                row.appendChild(cell);
            }
            tbody.appendChild(row); if (dateCount > daysInMonth && nextMonthDate > 1) break; 
        }
    }

    function showMonthsView() {
        document.getElementById('daysView').style.display = 'none'; document.getElementById('yearsView').style.display = 'none';
        let monthsView = document.getElementById('monthsView'); monthsView.style.display = 'grid'; monthsView.innerHTML = '';
        prevBtn.style.visibility = 'hidden'; nextBtn.style.visibility = 'hidden';
        for(let i=0; i<12; i++) {
            let div = document.createElement('div'); div.className = 'grid-item'; div.innerText = shortMonths[i];
            if (activeYear === todayLimit.getFullYear() && i > todayLimit.getMonth()) { div.classList.add('disabled-grid'); } 
            else { if(i === activeMonth) div.classList.add('active'); div.onclick = function(e) { e.stopPropagation(); activeMonth = i; renderCalendar(activeMonth, activeYear); } }
            monthsView.appendChild(div);
        }
    }

    function showYearsView(startYear) {
        document.getElementById('daysView').style.display = 'none'; document.getElementById('monthsView').style.display = 'none';
        let yearsView = document.getElementById('yearsView'); yearsView.style.display = 'grid'; yearsView.innerHTML = '';
        prevBtn.style.visibility = 'visible'; nextBtn.style.visibility = 'visible'; prevBtn.classList.remove('disabled-btn');
        if(startYear + 11 >= todayLimit.getFullYear()) { nextBtn.classList.add('disabled-btn'); } else { nextBtn.classList.remove('disabled-btn'); }
        prevBtn.onclick = function(e) { e.stopPropagation(); showYearsView(startYear - 12); }; nextBtn.onclick = function(e) { e.stopPropagation(); showYearsView(startYear + 12); };
        for(let i = 0; i < 12; i++) {
            let y = startYear + i; let div = document.createElement('div'); div.className = 'grid-item'; div.innerText = y;
            if (y > todayLimit.getFullYear()) { div.classList.add('disabled-grid'); } 
            else {
                if(y === activeYear) div.classList.add('active');
                div.onclick = function(e) { e.stopPropagation(); activeYear = y; if(activeYear === todayLimit.getFullYear() && activeMonth > todayLimit.getMonth()) { activeMonth = todayLimit.getMonth(); } showMonthsView(); }
            }
            yearsView.appendChild(div);
        }
    }

    document.getElementById('monthSelectBtn').onclick = function(e) { e.stopPropagation(); showMonthsView(); };
    document.getElementById('yearSelectBtn').onclick = function(e) { e.stopPropagation(); showYearsView(activeYear - 4); };

    function processWeekSelection(year, month, day) {
        let selectedDate = new Date(year, month, day); let dayOfWeek = selectedDate.getDay(); 
        let diffToMonday = selectedDate.getDate() - dayOfWeek + (dayOfWeek === 0 ? -6 : 1); let monday = new Date(selectedDate.setDate(diffToMonday));
        let sunday = new Date(monday); sunday.setDate(monday.getDate() + 6);
        let firstDayOfMonth = new Date(year, month, 1); let firstDayWeekday = firstDayOfMonth.getDay();
        let offset = (firstDayWeekday === 0 ? 6 : firstDayWeekday - 1); let weekOfMonth = Math.ceil((day + offset) / 7);

        let startD = monday.getDate(); let endD = sunday.getDate(); let startM = monthNames[monday.getMonth()]; let endM = monthNames[sunday.getMonth()]; let endY = sunday.getFullYear();
        let dateStr = (startM === endM) ? `${startD}-${endD} ${startM} ${endY}` : `${startD} ${startM} - ${endD} ${endM} ${endY}`;
        document.getElementById('periode_input').value = `Minggu ke-${weekOfMonth} (${dateStr})`;
        setTimeout(() => { document.getElementById('calendarPopup').style.display = 'none'; }, 150);
    }

    document.getElementById('periodeContainer').onclick = function(e) {
        e.stopPropagation(); let cal = document.getElementById('calendarPopup');
        if (cal.style.display === 'block') { cal.style.display = 'none'; } else { cal.style.display = 'block'; renderCalendar(activeMonth, activeYear); }
    };

    document.addEventListener('click', function(e) {
        let container = document.getElementById('periodeContainer');
        if (!container.contains(e.target)) { document.getElementById('calendarPopup').style.display = 'none'; }
    });

</script>

<?= $this->endSection() ?>