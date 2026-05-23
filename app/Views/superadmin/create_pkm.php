<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body,
    input,
    button,
    select,
    textarea {
        font-family: 'Poppins', sans-serif;
    }

    /* Header puskesmas */
    .header-puskesmas,
    .header-posyandu {
        display: flex;
        align-items: center;
        gap: 15px;
        background: linear-gradient(90deg, #26c6da, #4dd0e1);
        color: white;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .header-icon img {
        width: 40px;
        height: 40px;
    }

    /* Form container */
    .form-container-create {
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        margin-top: 20px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Grid form 2 kolom */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* 3 kolom pertama */
        gap: 15px;
        margin-bottom: 5px;
    }

    /* Untuk row 2 & 3, bisa gunakan nested grid atau buat class tambahan */
    .row-2,
    .row-3 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* 2 kolom */
        gap: 15px;
    }

    /* Form group */
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    .required::after {
        content: " *";
        color: red;
        font-weight: bold;
    }

    /* Input */
    .form-group input,
    .form-group select {
        padding: 8px 12px;
        border-radius: 12px;
        font-size: 14px;
        border: 1px solid #ddd;
        outline: none;
        transition: all 0.2s;
        background-color: #f2f4f7;
        /* abu-abu muda */
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #26c6da;
        box-shadow: 0 0 6px rgba(38, 198, 218, 0.3);
    }

    /* Kelurahan + tombol Tambah Posyandu */
    .kelurahan-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .kelurahan-container input {
        flex: 1;
        padding: 12px 15px;
        border-radius: 12px;
        border: 1px solid #ddd;
    }

    .kelurahan-container input:focus {
        border-color: #26c6da;
        box-shadow: 0 0 6px rgba(38, 198, 218, 0.3);
    }

    .kelurahan-container button {
        background: #26c6da;
        color: white;
        border: none;
        padding: 12px 18px;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .kelurahan-container button:hover {
        background: #00acc1;
    }

    /* Tombol aksi full width kiri & kanan */
    .form-action {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* 2 tombol */
        gap: 15px;
        margin-top: 30px;
    }

    .btn-back {
        background: #fff;
        color: #333;
        border: 1px solid #ccc;
        padding: 12px 25px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-back,
    .btn-save {
        width: 100%;
        /* full width masing-masing kolom */
        padding: 14px 0;
        border-radius: 25px;
        font-weight: 600;
        font-size: 15px;
        height: 48px;
    }

    .btn-back:hover {
        background-color: #f0f0f0;
    }

    .btn-save {
        background: #26c6da;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-save:hover {
        background: #00acc1;
    }

    .kelurahan-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .kelurahan-wrapper {
        width: 600px !important;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .kelurahan-container input {
        flex: 1;
        padding: 12px 15px;
        border-radius: 12px;
        border: 1px solid #ddd;
        outline: none;
    }

    .kelurahan-container input:focus {
        border-color: #26c6da;
        box-shadow: 0 0 6px rgba(38, 198, 218, 0.3);
    }

    .kelurahan-container button {
        background: #26c6da;
        color: white;
        border: none;
        padding: 12px 15px;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .kelurahan-container button:hover {
        background: #00acc1;
    }

    /* Card Daftar Kelurahan */
    .kelurahan-card {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 15px;
        border-radius: 12px;
        width: 100%;
        /* full width */
    }

    /* Input + tombol tambah kelurahan */
    .kelurahan-input-wrapper {
        display: flex;
        flex: 2;
        /* ambil space lebih besar */
    }

    .kelurahan-input-wrapper input {
        flex: 1;
        padding: 12px 15px;
        border-radius: 12px 0 0 12px;
        border: 1px solid #ddd;
        outline: none;
    }

    .kelurahan-input-wrapper input:focus {
        border-color: #26c6da;
        box-shadow: 0 0 6px rgba(38, 198, 218, 0.3);
    }

    .kelurahan-input-wrapper .btn-tambah-kelurahan {
        background: transparent;
        color: #555;
        border: none;
        padding: 0px 10px;
        border-radius: 0 12px 12px 0;
        cursor: pointer;
        font-weight: 500;
        font-size: 1.2rem;
        transition: all 0.2s;
    }

    .kelurahan-input-wrapper .btn-tambah-kelurahan:hover {
        background: #00acc1;
    }

    /* Tombol Tambah Posyandu di sebelah kanan */
    .btn-tambah-posyandu {
        width: 400px !important;
        background: #26c6da;
        color: white;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
        padding: 8px 12px;
        font-size: 16px;
        border: 1px solid #ddd;
        outline: none;
        transition: all 0.2s;
    }

    .btn-tambah-posyandu:hover {
        background: #00acc1;
    }

    .kelurahan-wrapper input {
        width: 400px;
        flex: unset;
        padding: 8px 12px;
        border-radius: 12px;
        font-size: 14px;
        border: 1px solid #ddd;
        outline: none;
        transition: all 0.2s;
        background-color: #f2f4f7;
        /* abu-abu muda */
    }

    .kelurahan-input-wrapper .btn-tambah-kelurahan:disabled {
        cursor: not-allowed;
        color: #ccc;
    }

    .kelurahan-input-wrapper .btn-tambah-kelurahan.active {
        color: black;
        /* sudah bisa diklik */
    }

    .btn-tambah-posyandu:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .kelurahan-wrapper .btn-tambah-kelurahan {
        background: transparent;
        border: none;
        color: #555;
        font-size: 1.2rem;
        cursor: pointer;
    }

    .kelurahan-wrapper .btn-tambah-kelurahan.active {
        color: black;
    }

    /* Card Posyandu */
    .posyandu-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
    }

    .posyandu-card {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .posyandu-card input {
        flex: 1;
        padding: 12px 15px;
        border-radius: 12px;
        border: 1px solid #ddd;
    }

    .posyandu-card button {
        background: #ff4d4f;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .posyandu-card button:hover {
        background: #d9363e;
    }

    .form-container-posyandu .header-posyandu {
        display: flex;
        /* tetap tampil */
    }

    .form-container-create.hidden .header-puskesmas {
        display: none;
        /* sembunyikan */
    }

    .form-container-posyandu {
        background: #fff;
        width: 100%;
        margin: auto;
        box-shadow: none;
    }

    .form-grid-posyandu {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .form-grid-posyandu .full-width {
        grid-column: 1 / -1;
        /* buat posyandu full width */
    }

    .form-grid-posyandu input {
        width: 100%;
        padding: 12px;
        border-radius: 12px;
        border: 1px solid #ccc;
    }

    #posyandu-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    #posyandu-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .posyandu-row {
        display: flex;
        gap: 10px;
    }

    .posyandu-row input {
        flex: 1;
        padding: 12px 15px;
        border-radius: 12px;
        border: 1px solid #ddd;
        background-color: #f2f4f7;
    }

    .posyandu-row button.btn-tambah-posyandu {
        padding: 0 12px;
        border-radius: 12px;
        background: #26c6da;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: 500;
    }

    .posyandu-row button.btn-tambah-posyandu:hover {
        background: #00acc1;
    }

    .posyandu-card {
        display: flex;
        gap: 10px;
    }

    .posyandu-card input {
        flex: 1;
        padding: 12px;
        border-radius: 12px;
        border: 1px solid #ccc;
    }

    .posyandu-card button.btn-tambah-posyandu {
        padding: 0 12px;
        border-radius: 50%;
        background: #26c6da;
        color: white;
        border: none;
        cursor: pointer;
    }

    .form-action {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-back,
    .btn-save {
        padding: 14px 0;
        border-radius: 25px;
        font-weight: 600;
        font-size: 16px;
    }

    .btn-back {
        background: #fff;
        border: 1px solid #ccc;
    }

    .btn-save {
        background: #00acc1;
        color: white;
        border: none;
    }

    .posyandu-card button {
        background: #ff4d4f;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 12px;
        cursor: pointer;
    }

    .posyandu-item {
        position: relative;
        width: 445px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;

    }

    .posyandu-item input {
        width: 445px;
        padding: 8px 12px;
        border-radius: 12px;
        font-size: 14px;
        border: 1px solid #ddd;
        outline: none;
        transition: all 0.2s;
        background-color: #ebf8fc;
        /* abu-abu muda */
    }

    .input-posyandu {
        width: 400px;
        padding: 8px 12px;
        border-radius: 12px;
        font-size: 14px;
        border: 1px solid #ddd;
        outline: none;
        transition: all 0.2s;
        background-color: #ebf8fc;
        /* abu-abu muda */
    }

    .btn-plus-pos {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);

        border: none;
        background: transparent;

        color: #26c6da;
        font-size: 24px;
        cursor: pointer;
    }

    .input-group-text {
        font-size: 14px;
    }

    /* =========================
MODAL NOTIF POSYANDU
========================= */
    .modal-posyandu {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.15);

        display: none;
        justify-content: center;
        align-items: center;

        z-index: 9999;
    }

    .modal-posyandu-box {
        width: 290px;
        background: white;
        border-radius: 8px;
        padding: 22px 20px;
        text-align: center;

        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .icon-success {
        width: 42px;
        height: 42px;
        margin: auto;
        margin-bottom: 14px;

        background: #39c97a;
        border-radius: 50%;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-success i {
        color: white;
        font-size: 20px;
    }

    .modal-posyandu-title {
        font-size: 16px;
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .modal-posyandu-subtitle {
        font-size: 13px;
        color: #888;
        margin-bottom: 18px;
    }

    .btn-lihat-detail {
        width: 100%;
        border: none;
        background: #26c6da;
        color: white;

        padding: 9px 0;
        border-radius: 4px;

        font-size: 13px;
        font-weight: 500;

        margin-bottom: 10px;
        transition: .2s;
    }

    .btn-lihat-detail:hover {
        background: #00acc1;
        transform: translateY(-2px);
        box-shadow:
            0 8px 18px rgba(0, 0, 0, 0.18),
            0 3px 8px rgba(38, 198, 218, 0.35);
    }

    .btn-selesai {
        width: 100%;
        border: none;
        background: #eaecec;
        color: white;

        padding: 9px 0;
        border-radius: 4px;

        font-size: 13px;
        font-weight: 500;

        margin-bottom: 10px;
        transition: .2s;
    }

    /* HOVER SELESAI */
    .btn-selesai:hover {
        background: #dfdfdf;

        transform: translateY(-2px);

        box-shadow:
            0 8px 18px rgba(0, 0, 0, 0.15),
            0 3px 8px rgba(0, 0, 0, 0.10);
    }

    /* =========================
MODAL NOTIF PUSKESMAS
========================= */
    .modal-puskesmas {
        position: fixed;
        top: 0;
        left: 0;

        width: 100%;
        height: 100vh;

        background: rgba(238, 244, 244, 0.75);

        display: none;
        justify-content: center;
        align-items: center;

        z-index: 99999;

        backdrop-filter: blur(2px);
    }

    .modal-puskesmas-box {
        width: 255px;

        background: #fff;

        border-radius: 8px;

        padding: 34px 24px 18px;

        text-align: center;

        box-shadow:
            0 8px 20px rgba(0, 0, 0, 0.16),
            0 2px 5px rgba(0, 0, 0, 0.08);
    }

    /* ICON */
    .icon-success-puskesmas {
        width: 42px;
        height: 42px;

        margin: auto;
        margin-bottom: 16px;

        background: #59c57b;

        border-radius: 50%;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-success-puskesmas i {
        color: white;
        font-size: 22px;
        font-weight: bold;
    }

    /* TITLE */
    .modal-puskesmas-title {
        font-size: 16px;
        font-weight: 700;

        color: #1f1f1f;

        line-height: 1.45;

        margin-bottom: 10px;
    }

    /* SUBTITLE */
    .modal-puskesmas-subtitle {
        font-size: 13px;
        color: #8f8f8f;

        margin-bottom: 20px;
    }

    /* BUTTON LIHAT DETAIL */
    .btn-detail-puskesmas {
        width: 100%;

        height: 30px;

        border: none;

        border-radius: 5px;

        background: #16c2cf;

        color: white;

        font-size: 13px;
        font-weight: 500;

        margin-bottom: 10px;

        transition: all .25s ease;

        box-shadow:
            0 3px 6px rgba(0, 0, 0, 0.12);
    }

    .btn-detail-puskesmas:hover {
        background: #00acc1;

        transform: translateY(-2px);

        box-shadow:
            0 8px 18px rgba(0, 0, 0, 0.18),
            0 3px 8px rgba(38, 198, 218, 0.35);
    }

    /* BUTTON SELESAI */
    .btn-selesai-puskesmas {
        width: 100%;

        height: 30px;

        border: none;

        border-radius: 5px;

        background: #f4f4f4;

        color: #7b7b7b;

        font-size: 13px;
        font-weight: 500;

        transition: all .25s ease;

        box-shadow:
            0 3px 6px rgba(0, 0, 0, 0.10);
    }

    .btn-selesai-puskesmas:hover {
        background: #ebebeb;

        transform: translateY(-2px);

        box-shadow:
            0 8px 18px rgba(0, 0, 0, 0.15),
            0 3px 8px rgba(0, 0, 0, 0.10);
    }
</style>

<div class="header-puskesmas">
    <div class="header-icon"><img src="/img/icon_breadcrumb.svg"></div>
    <div>
        <h5>Manajemen Puskesmas</h5>
        <small>Tambah data puskesmas dengan benar</small>
    </div>
</div>

<div class="form-container-create">
    <form action="/superadmin/puskesmas/store" method="post">
        <div class="form-grid">
            <div class="form-group">
                <label class="required">Nama Puskesmas</label>
                <input
                    type="text"
                    name="nama_puskesmas"
                    class="form-control"
                    placeholder="Masukkan nama puskesmas"
                    value="<?= old('nama_puskesmas') ?>"
                    required>
            </div>
            <div class="form-group">
                <label class="required">Nomor Telepon Puskesmas</label>
                <div class="input-group">
                    <span class="input-group-text"> (+62) </span>
                    <input type="text" class="form-control" name="no_telpon_puskesmas" id="no_telpon_puskesmas" placeholder="8xxxxxxxxxx" value="<?= old('no_telpon_puskesmas') ?>" maxlength="13" oninput="formatNoTelpon(this)" required>
                </div>
            </div>
            <div class="form-group">
                <label class="required">Email Puskesmas</label>
                <input type="email" name="email_puskesmas" placeholder="Masukkan email" value="<?= old('email_puskesmas') ?>">
            </div>
        </div>

        <div class="row-2">
            <div class="form-group">
                <label class="required">Kecamatan</label>
                <select
                    name="kecamatan"
                    id="kecamatan"
                    class="form-control"
                    required>
                    <option value="">-- Pilih Kecamatan --</option>
                    <option value="Ajung">Ajung</option>
                    <option value="Ambulu">Ambulu</option>
                    <option value="Arjasa">Arjasa</option>
                    <option value="Balung">Balung</option>
                    <option value="Bangsalsari">Bangsalsari</option>
                    <option value="Gumukmas">Gumukmas</option>
                    <option value="Jelbuk">Jelbuk</option>
                    <option value="Jenggawah">Jenggawah</option>
                    <option value="Jombang">Jombang</option>
                    <option value="Kalisat">Kalisat</option>
                    <option value="Kaliwates">Kaliwates</option>
                    <option value="Kencong">Kencong</option>
                    <option value="Ledokombo">Ledokombo</option>
                    <option value="Mayang">Mayang</option>
                    <option value="Mumbulsari">Mumbulsari</option>
                    <option value="Pakusari">Pakusari</option>
                    <option value="Panti">Panti</option>
                    <option value="Patrang">Patrang</option>
                    <option value="Puger">Puger</option>
                    <option value="Rambipuji">Rambipuji</option>
                    <option value="Semboro">Semboro</option>
                    <option value="Silo">Silo</option>
                    <option value="Sukorambi">Sukorambi</option>
                    <option value="Sukowono">Sukowono</option>
                    <option value="Sumberbaru">Sumberbaru</option>
                    <option value="Sumbersari">Sumbersari</option>
                    <option value="Tanggul">Tanggul</option>
                    <option value="Tempurejo">Tempurejo</option>
                    <option value="Umbulsari">Umbulsari</option>
                    <option value="Wuluhan">Wuluhan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" id="kode_pos" name="kode_pos" value="<?= old('kode_pos') ?>" placeholder="Masukkan kode pos">
            </div>
        </div>

        <div class="form-group full-width">
            <label class="required">Alamat Lengkap</label>
            <input type="text" id="alamat" name="alamat" value="<?= old('alamat') ?>" placeholder="Masukkan alamat lengkap">
        </div>

        <div class="row-2">
            <div class="form-group">
                <label>Latitude (lintang)</label>
                <input type="text" id="latitude" name="latitude" value="<?= old('latitude') ?>" readonly>
            </div>
            <div class="form-group">
                <label>Longitude (bujur)</label>
                <input type="text" id="longitude" name="longitude" value="<?= old('longitude') ?>" readonly>
            </div>
        </div>

        <!-- Kelurahan + Posyandu -->
        <div class="form-group">
            <label>Daftar Kelurahan & Posyandu</label>
            <div id="kelurahan-container">
                <div class="kelurahan-wrapper mb-2">
                    <input type="text"
                        id="input-kelurahan"
                        placeholder="Masukkan nama kelurahan">
                    <button type="button"
                        id="btn-tambah-kelurahan"
                        class="btn-tambah-kelurahan">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
            <!-- HASIL KELURAHAN -->
            <div id="hasil-kelurahan"></div>
        </div>
        <div id="hidden-input-container"></div>
        <div class="form-action">
            <a href="/superadmin/puskesmas"><button type="button" class="btn-back">Batal</button></a>
            <button type="submit" class="btn-save">Simpan</button>
        </div>
    </form>

</div>

<script>
    // ===============================
    // AUTO KODE POS DARI KECAMATAN
    // ===============================

    const kodePosMap = {

        "Ajung": "68175",
        "Ambulu": "68172",
        "Arjasa": "68191",
        "Balung": "68161",
        "Bangsalsari": "68154",
        "Gumukmas": "68165",
        "Jelbuk": "68192",
        "Jenggawah": "68171",
        "Jombang": "68168",
        "Kalisat": "68193",
        "Kaliwates": "68131",
        "Kencong": "68167",
        "Ledokombo": "68195",
        "Mayang": "68182",
        "Mumbulsari": "68174",
        "Pakusari": "68181",
        "Panti": "68153",
        "Patrang": "68111",
        "Puger": "68164",
        "Rambipuji": "68152",
        "Semboro": "68157",
        "Silo": "68184",
        "Sukorambi": "68151",
        "Sukowono": "68194",
        "Sumberbaru": "68159",
        "Sumbersari": "68121",
        "Tanggul": "68155",
        "Tempurejo": "68173",
        "Umbulsari": "68162",
        "Wuluhan": "68163"

    };

    document
        .getElementById('kecamatan')
        .addEventListener('change', function() {

            const kecamatan = this.value;

            document.getElementById('kode_pos').value =
                kodePosMap[kecamatan] || '';

        });

    // ===============================
    // AUTO LATITUDE LONGITUDE
    // ===============================

    const alamatInput =
        document.getElementById('alamat');

    const kecamatanInput =
        document.getElementById('kecamatan');

    const latInput =
        document.getElementById('latitude');

    const lngInput =
        document.getElementById('longitude');

    // ===============================
    // FUNCTION AMBIL KOORDINAT
    // ===============================
    async function ambilKoordinat() {

        const alamat =
            alamatInput.value.trim();

        const kecamatan =
            kecamatanInput.value.trim();

        // ===========================
        // kalau kecamatan kosong
        // ===========================
        if (kecamatan == '') {

            latInput.value = '';
            lngInput.value = '';

            return;
        }

        // ===========================
        // query default kecamatan
        // ===========================
        let query =
            kecamatan + ', Jember, Jawa Timur';

        // ===========================
        // kalau alamat diisi
        // pakai alamat + kecamatan
        // ===========================
        if (alamat != '') {

            query =
                alamat + ', ' +
                kecamatan +
                ', Jember';

        }

        try {

            const response = await fetch(
                'https://nominatim.openstreetmap.org/search?format=json&q=' +
                encodeURIComponent(query)
            );

            const data = await response.json();

            if (data.length > 0) {

                latInput.value = data[0].lat;

                lngInput.value = data[0].lon;

            } else {

                latInput.value = '';
                lngInput.value = '';

            }

        } catch (error) {

            console.log('Gagal ambil koordinat');

        }

    }

    // ===============================
    // SAAT KECAMATAN DIGANTI
    // ===============================
    kecamatanInput.addEventListener(
        'change',
        function() {

            ambilKoordinat();

        });

    // ===============================
    // SAAT ALAMAT DIKETIK
    // ===============================
    alamatInput.addEventListener(
        'keyup',
        function() {

            clearTimeout(window.delayGeo);

            window.delayGeo = setTimeout(() => {

                ambilKoordinat();

            }, 300);

            // ===============================
            // AUTO LOAD KOORDINAT SAAT HALAMAN DIBUKA
            // ===============================
            window.addEventListener('load', function() {

                ambilKoordinat();

            });

        });

    // ===============================
    // STATE SEMENTARA
    // ===============================
    let daftarKelurahan = [];
    let currentKelurahanIndex = null;
    // ===============================
    // TAMBAH KELURAHAN
    // ===============================
    document
        .getElementById('btn-tambah-kelurahan')
        .addEventListener('click', function() {
            const inputKel = document.getElementById('input-kelurahan');
            const namaKel = inputKel.value.trim();
            if (namaKel == '') {
                alert('Kelurahan wajib diisi');
                return;
            }
            daftarKelurahan.push({
                nama_kelurahan: namaKel,
                posyandu: []
            });
            inputKel.value = '';
            renderKelurahan();
        });

    // ===============================
    // RENDER KELURAHAN
    // ===============================
    function renderKelurahan() {

        const hasil =
            document.getElementById('hasil-kelurahan');

        const hidden =
            document.getElementById('hidden-input-container');

        hasil.innerHTML = '';
        hidden.innerHTML = '';

        daftarKelurahan.forEach((item, index) => {

            hasil.innerHTML += `
        
        <div class="d-flex justify-content-between align-items-center mt-2">

            <input
                type="text"
                class="form-control"
                value="${item.nama_kelurahan}"
                onchange="editKelurahan(${index}, this.value)">

            <button
                type="button"
                class="btn-tambah-posyandu ms-2"
                onclick="bukaPosyandu(${index})">

                Tambah Pos Posyandu

            </button>

        </div>
        
        `;

            // =========================
            // HIDDEN INPUT KELURAHAN
            // =========================
            hidden.innerHTML += `
      
        <input
            type="hidden"
            name="kelurahan[]"
            value="${item.nama_kelurahan}">
        
        `;

            // =========================
            // HIDDEN INPUT POSYANDU
            // =========================
            item.posyandu.forEach(pos => {

                hidden.innerHTML += `
            
            <input
                type="hidden"
                name="posyandu[${index}][]"
                value="${pos}">
          
            `;

            });

        });

    }

    // =========================
    // EDIT KELURAHAN
    // =========================
    function editKelurahan(index, value) {

        daftarKelurahan[index].nama_kelurahan = value;

        document.querySelectorAll(
            'input[name="kelurahan[]"]'
        )[index].value = value;

    }

    // ===============================
    // BUKA FORM POSYANDU
    // ===============================
    function bukaPosyandu(index) {

        currentKelurahanIndex = index;

        // sembunyikan create
        document.querySelector(
            '.form-container-create'
        ).style.display = 'none';

        document.querySelector(
            '.header-posyandu'
        ).style.display = 'flex';

        document.querySelector(
            '.header-puskesmas'
        ).style.display = 'none';

        // tampilkan posyandu
        document.querySelector(
            '.form-container-posyandu'
        ).style.display = 'block';

        // =========================
        // AMBIL NAMA PUSKESMAS
        // =========================
        const namaPuskesmas =
            document.querySelector(
                '[name="nama_puskesmas"]'
            ).value;

        // isi otomatis
        document.getElementById(
            'posyandu-puskesmas'
        ).value = namaPuskesmas;

        document.getElementById(
                'posyandu-kelurahan'
            ).value =
            daftarKelurahan[index].nama_kelurahan;

        // =========================
        // JIKA POSYANDU MASIH KOSONG
        // =========================
        if (
            daftarKelurahan[
                currentKelurahanIndex
            ].posyandu.length === 0
        ) {

            daftarKelurahan[
                currentKelurahanIndex
            ].posyandu.push('');

        }

        // render input posyandu
        renderPosyandu();

    }

    // ===============================
    // RENDER POSYANDU
    // ===============================
    function renderPosyandu() {
        const list = document.getElementById('list-posyandu');
        list.innerHTML = '';
        daftarKelurahan[currentKelurahanIndex]
            .posyandu
            .forEach((item, i) => {
                list.innerHTML += `
        <div class="posyandu-item">
            <input
                type="text"
                class="form-control input-posyandu"
                placeholder="Masukkan nama posyandu"
                value="${item}"
                onkeyup="updatePos(${i}, this.value)">

            <button
                type="button"
                class="btn-plus-pos"
                onclick="tambahInputPosyandu()">
                <i class="bi bi-plus-circle-fill"></i>
            </button>
        </div>

        `;
            });
    }

    // TAMBAH INPUT POSYANDU
    function tambahInputPosyandu() {
        daftarKelurahan[currentKelurahanIndex]
            .posyandu
            .push('');
        renderPosyandu();
        renderHiddenInput();
    }

    function updatePos(index, value) {
        daftarKelurahan[currentKelurahanIndex]
            .posyandu[index] = value;
        renderHiddenInput();
    }

    function kembaliCreate() {

        // hapus input kosong yang BELUM disimpan
        daftarKelurahan[currentKelurahanIndex].posyandu =
            daftarKelurahan[currentKelurahanIndex]
            .posyandu
            .filter(pos => pos.trim() !== '');

        // render ulang
        renderPosyandu();

        // tutup halaman posyandu
        document.querySelector('.form-container-posyandu')
            .style.display = 'none';

        // tampilkan halaman create
        document.querySelector('.form-container-create')
            .style.display = 'block';

        // tampilkan header puskesmas
        document.querySelector('.header-puskesmas')
            .style.display = 'flex';
    }

    function simpanPosyandu() {
        renderKelurahan();
        renderHiddenInput();
        // tampilkan modal notif
        document.getElementById('modal-posyandu')
            .style.display = 'flex';
        // kembaliCreate();
    }

    // ===============================
    // LIHAT DETAIL
    // kembali ke form posyandu
    // ===============================
    function lihatDetailPosyandu() {

        document.getElementById('modal-posyandu')
            .style.display = 'none';

        // tetap di form posyandu
        document.querySelector('.form-container-posyandu')
            .style.display = 'block';

    }

    // ===============================
    // SELESAI
    // kembali ke form create
    // ===============================
    function selesaiPosyandu() {

        document.getElementById('modal-posyandu')
            .style.display = 'none';

        kembaliCreate();

    }

    // ===============================
    // SUBMIT FORM PUSKESMAS
    // ===============================
    document.querySelector('form').addEventListener('submit', function() {
        renderHiddenInput();
        // biarkan form submit normal ke controller
        // controller akan simpan data ke database

    });

    // ===============================
    // LIHAT DETAIL
    // arah ke view
    // ===============================
    //function lihatDetailPuskesmas(){
    //window.location.href =
    //"/superadmin/puskesmas/view/<?= $id_puskesmas ?? 1 ?>";}


    // ===============================
    // SELESAI
    // kembali ke tabel puskesmas
    // ===============================
    function selesaiPuskesmas() {

        window.location.href =
            "/superadmin/puskesmas";

    }

    function formatNoTelpon(input) {

        // hanya angka
        let value = input.value.replace(/[^0-9]/g, '');

        // jika angka pertama 0
        if (value.startsWith('0')) {

            alert('Nomor tidak boleh diawali angka 0');

            value = value.substring(1);

        }

        // tampilkan kembali
        input.value = value;
    }

    function renderHiddenInput() {
        console.log(daftarKelurahan);
        const hidden =
            document.getElementById('hidden-input-container');

        hidden.innerHTML = '';

        daftarKelurahan.forEach((item, index) => {

            hidden.innerHTML += `
            <input
                type="hidden"
                name="kelurahan[]"
                value="${item.nama_kelurahan}">
        `;

            item.posyandu.forEach(pos => {

                hidden.innerHTML += `
                <input
                    type="hidden"
                    name="posyandu[${index}][]"
                    value="${pos}">
            `;

            });

        });

    }
</script>

<div class="form-container-posyandu" style="display:none;">
    <div class="header-posyandu">
        <div class="header-icon">
            <img src="/img/icon_breadcrumb.svg">
        </div>
        <div>
            <h5>Manajemen Puskesmas</h5>
            <small>Tambah data posyandu dengan benar</small>
        </div>
    </div>
    <div class="form-container-create">
        <div class="row-2">
            <div class="form-group">
                <label>Nama Puskesmas</label>
                <input
                    type="text"
                    id="posyandu-puskesmas"
                    readonly>
            </div>

            <div class="form-group">
                <label>Kelurahan</label>
                <input
                    type="text"
                    id="posyandu-kelurahan"
                    readonly>
            </div>

        </div>
        <div class="form-group">
            <label>Daftar Pos Posyandu</label>
            <div id="list-posyandu"></div>
        </div>

        <div class="form-action">
            <button
                type="button"
                class="btn-back"
                onclick="kembaliCreate()">
                Batal
            </button>

            <button
                type="button"
                class="btn-save"
                onclick="simpanPosyandu()">
                Simpan
            </button>

        </div>
    </div>
</div>

<!-- =========================
MODAL NOTIF POSYANDU
========================= -->
<div class="modal-posyandu" id="modal-posyandu">

    <div class="modal-posyandu-box">

        <div class="icon-success">
            <i class="bi bi-check-lg"></i>
        </div>

        <div class="modal-posyandu-title">
            Input Data Pos Posyandu<br>
            Berhasil
        </div>

        <div class="modal-posyandu-subtitle">
            Data berhasil disimpan
        </div>

        <button
            type="button"
            class="btn-lihat-detail"
            onclick="lihatDetailPosyandu()">

            Lihat Detail

        </button>

        <button
            type="button"
            class="btn-selesai"
            onclick="selesaiPosyandu()">

            Selesai

        </button>

    </div>

</div>

<?= $this->endSection() ?>