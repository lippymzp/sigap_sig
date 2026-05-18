<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
*{
    box-sizing:border-box;
}

/* =========================
   WRAPPER UTAMA
========================= */
.section-card{
    background:#eaf7f7;
    max-width:1120px;
    margin:24px auto 0;
    padding:24px 28px 32px;
    border-radius:18px;
    min-height:560px;
    overflow:hidden;
}

.section-card h4{
    display:none;
}

.form-box{
    background:transparent;
    padding:0;
    border-radius:0;
}

/* =========================
   STEP HEADER ATAS
========================= */
.step-progress{
    display:flex;
    justify-content:center;
    align-items:flex-start;
    gap:34px;
    max-width:720px;
    margin:0 auto 16px;
    padding-bottom:14px;
    border-bottom:1px solid #d5e2e2;
}

.step-item{
    width:160px;
    text-align:center;
    font-size:11px;
    color:#b0b0b0;
    font-weight:500;
}

.step-item .bar{
    height:8px;
    width:100%;
    border-radius:10px;
    background:#cfcfcf;
    margin:0 auto 6px;
}

.step-item.active{
    color:#111;
    font-weight:700;
}

.step-item.active .bar{
    background:#009fc4;
}

/* =========================
   GLOBAL INPUT & BUTTON
========================= */
.step-title-text{
    margin:16px 0 22px 28px;
    font-size:15px;
    font-weight:500;
    color:#222;
}

.custom-input{
    border:1px solid #cfd8d8;
    border-radius:7px;
    background:#fff;
    height:32px;
    font-size:11px;
    padding:5px 10px;
    box-shadow:0 2px 4px rgba(0,0,0,0.14);
}

textarea.custom-input{
    height:58px;
    resize:none;
}

.btn-next{
    background:#00aeb8;
    color:white;
    border:none;
    padding:7px 18px;
    border-radius:16px;
    font-size:12px;
    font-weight:600;
    box-shadow:0 2px 4px rgba(0,0,0,0.18);
}

.btn-next:hover{
    background:#009aa3;
    color:white;
}

/* =========================
   SIDE STEP MENU
========================= */
.step-side-menu{
    padding-left:20px;
    padding-top:0;
}

.step-side-item{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:12px;
    color:#a0a0a0;
    margin-bottom:22px;
    white-space:nowrap;
}

.step-side-item.active{
    color:#111;
    font-weight:700;
}

.step-check{
    width:20px;
    height:20px;
    border-radius:50%;
    background:#5ebf83;
    color:#fff;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    font-size:11px;
    font-weight:700;
}

.step-side-number{
    width:20px;
    height:20px;
    border-radius:50%;
    background:#4f72c9;
    color:#fff;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    font-size:12px;
    font-weight:700;
    flex-shrink:0;
}

.step-side-number.muted{
    background:transparent;
    border:1px solid #7f8c8d;
    color:#7f8c8d;
}

/* =========================
   STEP 1
========================= */
.step1-layout{
    display:grid;
    grid-template-columns:130px minmax(360px, 1fr) minmax(360px, 1fr);
    gap:28px;
    align-items:start;
}

.step1-form-area{
    padding-top:0;
}

.step1-heading{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:14px;
    font-weight:700;
    margin-bottom:10px;
}

.form-label-small{
    font-size:12px;
    font-weight:650;
    color:#222;
    margin-bottom:4px;
}

.row-form{
    margin-bottom:9px;
}

.rt-rw-row{
    display:flex;
    gap:28px;
    margin-bottom:9px;
}

.rt-rw-box{
    width:70px;
}

.map-area{
    padding-top:0;
    margin-top:4px;
}

#mapPreview{
    width:100%;
    max-width:100%;
    height:230px !important;
    border-radius:0;
    overflow:hidden;
}

.coordinate-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:22px;
    margin-top:24px;
}

.coordinate-row label{
    font-size:11px;
    font-weight:500;
    margin-bottom:5px;
}

.coordinate-row input{
    height:28px;
}

.btn-step1-wrapper{
    display:flex;
    justify-content:flex-end;
    margin-top:86px;
}

/* =========================
   STEP 2
========================= */
.step2-layout{
    display:grid;
    grid-template-columns:170px 1fr;
    gap:30px;
    align-items:start;
}

.step2-card{
    background:rgba(255,255,255,0.58);
    border-radius:12px;
    padding:24px 30px;
    min-height:360px;
}

.step2-title{
    display:flex;
    align-items:center;
    gap:7px;
    font-size:14px;
    font-weight:700;
    margin-bottom:12px;
}

.step2-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:14px 36px;
}

.step2-field label{
    font-size:12px;
    font-weight:700;
    color:#111;
    margin-bottom:5px;
}

.step2-field input,
.step2-field select{
    height:29px;
    font-size:11px;
    border:1px solid #d5d5d5;
    border-radius:6px;
    padding:4px 9px;
    background:#fff;
}

.radio-small{
    display:flex;
    align-items:center;
    gap:7px;
    font-size:12px;
    margin-bottom:4px;
}

.radio-small input{
    width:15px;
    height:15px;
}

.antibiotik-note{
    font-size:10px;
    color:red;
    font-weight:600;
}

.btn-step2-wrapper{
    display:flex;
    justify-content:flex-end;
    margin-top:48px;
}

/* =========================
   STEP 3
========================= */
.step3-layout{
    display:grid;
    grid-template-columns:170px 1fr;
    gap:30px;
    align-items:start;
}

.step3-card{
    background:rgba(255,255,255,0.58);
    border-radius:12px;
    padding:24px 30px;
    min-height:360px;
}

.step3-content{
    display:grid;
    grid-template-columns:1fr 300px;
    gap:28px;
}

.step3-title{
    font-size:13px;
    font-weight:700;
    margin-bottom:16px;
}

.summary-row{
    display:grid;
    grid-template-columns:105px 10px 1fr;
    gap:5px;
    font-size:11px;
    margin-bottom:8px;
    line-height:1.25;
}

.summary-label{
    font-weight:700;
    color:#111;
}

.summary-colon{
    font-weight:700;
}

.summary-value{
    color:#111;
}

.preview-title{
    font-size:13px;
    font-weight:700;
    margin-bottom:10px;
}

#summaryMap{
    width:100%;
    height:175px;
    border-radius:2px;
    overflow:hidden;
}

.confirm-row{
    display:flex;
    align-items:flex-start;
    gap:8px;
    margin-top:18px;
    font-size:11px;
    line-height:1.3;
}

.confirm-row input{
    width:16px;
    height:16px;
    margin-top:1px;
}

.step3-actions{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-top:22px;
}

.step3-left-actions{
    display:flex;
    gap:24px;
    align-items:center;
}

.link-action{
    border:none;
    background:transparent;
    color:#4f72c9;
    font-size:12px;
    font-weight:600;
    padding:0;
}

.link-action:hover{
    text-decoration:underline;
}

.btn-save-step3{
    min-width:120px;
}

/* =========================
   POPUP SUCCESS & WARNING
========================= */
.popup{
    position:fixed !important;
    inset:0 !important;
    background:rgba(0,0,0,0.55) !important;
    display:none !important;
    justify-content:center !important;
    align-items:center !important;
    z-index:999999 !important;
}

.popup.show{
    display:flex !important;
}

.popup-box{
    background:#fff;
    width:260px;
    border-radius:6px;
    padding:34px 28px 30px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.22);
}

.popup-icon{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#58bd7b;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 14px;
    font-size:23px;
    font-weight:700;
}

.warning-icon{
    background:#ffb84d;
    font-size:22px;
}

.popup-title{
    font-size:15px;
    font-weight:700;
    color:#111;
    margin-bottom:8px;
}

.popup-text{
    font-size:13px;
    color:#777;
    line-height:1.35;
    margin-bottom:16px;
}

.btn-popup-primary{
    width:100%;
    height:27px;
    border:none;
    background:#00b9c5;
    color:#fff;
    border-radius:5px;
    font-size:12px;
    font-weight:500;
    margin-bottom:0;
    box-shadow:0 2px 4px rgba(0,0,0,0.18);
}

.btn-popup-secondary{
    width:100%;
    height:31px;
    border:none;
    background:#fff;
    color:#777;
    border-radius:0 0 5px 5px;
    font-size:12px;
    box-shadow:0 2px 4px rgba(0,0,0,0.18);
}

/* =========================
   RESPONSIVE
========================= */
@media(max-width:992px){
    .section-card{
        margin:12px;
        padding:20px;
        max-width:calc(100% - 24px);
    }

    .step-progress{
        gap:12px;
    }

    .step-item{
        width:120px;
        font-size:10px;
    }

    .step1-layout,
    .step2-layout,
    .step3-layout{
        grid-template-columns:1fr;
    }

    .step-side-menu{
        display:none;
    }

    .step2-grid,
    .step3-content{
        grid-template-columns:1fr;
    }

    .map-area{
        padding-top:0;
    }

    .btn-step1-wrapper{
        margin-top:28px;
    }
}

    /* garis vertikal step kiri */
.step-side-menu{
    position: relative;
}

.step-side-item{
    position: relative;
    z-index: 2;
}

/* garis sambung antar nomor step */
.step-side-item:not(:last-child)::after{
    content: "";
    position: absolute;
    left: 9px;
    top: 20px;
    width: 1.5px;
    height: 22px;
    background: #b9c7c7;        
    z-index: 1;

}

html,
body{
    overflow-x:hidden;
}

.step1-form-area,
.map-area{
    min-width:0;
    max-width:100%;
}

.map-area{
    width:100%;
}

.coordinate-row input{
    width:100%;
    max-width:100%;
}

.btn-step1-wrapper{
    margin-top:58px;
}

}


</style>

<div class="section-card">

    <h4>Input Data Pasien</h4>

    <!-- STEP HEADER -->
    <div class="step-progress">

        <div class="step-item active" id="stepNav1">
            <div class="bar"></div>
            <span>Step 1 : Lokasi Kasus</span>
        </div>

        <div class="step-item" id="stepNav2">
            <div class="bar"></div>
            <span>Step 2 : Data Klinis</span>
        </div>

        <div class="step-item" id="stepNav3">
            <div class="bar"></div>
            <span>Step 3 : Ringkasan & Kirim</span>
        </div>

    </div>

    <div class="form-box">

        <!-- ================= STEP 1 ================= -->
        <div id="step1">

            <div class="step-title-text">
                Mohon lengkapi detail kasus Pneumonia baru
            </div>

            <div class="step1-layout">

                <!-- KIRI -->
                <div class="step-side-menu">

                    <div class="step-side-item active">
                        <span class="step-side-number">1</span>
                        <span>Data Lokasi</span>
                    </div>

                    <div class="step-side-item">
                        <span class="step-side-number muted">2</span>
                        <span>Data Klinis</span>
                    </div>

                    <div class="step-side-item">
                        <span class="step-side-number muted">3</span>
                        <span>Ringkasan & Kirim</span>
                    </div>

                </div>

                <!-- TENGAH FORM -->
                 <div class="step1-form-area">
                     <div class="step1-heading">
                          <span class="step-side-number">1</span>
                           <span>Data Lokasi</span>
                        </div>
                         <div class="row-form">
                            <label class="form-label-small">Pilih Provinsi</label>
                            <select name="provinsi" class="form-control custom-input" id="provinsi">
                                <option>Jawa Timur</option>
                            </select>
                        </div>

                    <div class="row-form">
                        <label class="form-label-small">Pilih Kabupaten</label>
                        <select name="kabupaten" class="form-control custom-input" id="kabupaten">
                            <option>Jember</option>
                        </select>
                    </div>

                    <div class="row-form">
                        <label class="form-label-small">Pilih Kecamatan</label>
                        <select name="kecamatan" class="form-control custom-input" id="kecamatan">
                            <option>Ajung</option>
                        </select>
                    </div>

                    <div class="row-form">
                        <label class="form-label-small">Pilih Kelurahan</label>
                        <select name="desa" class="form-control custom-input" id="desa">
                            <option value="">Pilih Desa/Kelurahan</option>
                            <option>Klompangan</option>
                            <option>Mangaran</option>
                            <option>Pancakarya</option>
                            <option>Rowoindah</option>
                            <option>Sukamakmur</option>
                            <option>Wirowongso</option>
                        </select>
                    </div>

                    <div class="rt-rw-row">
                        <div class="rt-rw-box">
                            <label class="form-label-small">RT</label>
                            <input type="text" class="form-control custom-input" id="rt" name="rt">
                        </div>

                        <div class="rt-rw-box">
                            <label class="form-label-small">RW</label>
                            <input type="text" class="form-control custom-input" id="rw" name="rw">
                        </div>
                    </div>

                    <div class="row-form">
                        <label class="form-label-small">Alamat Lengkap</label>
                        <textarea class="form-control custom-input" placeholder="Alamat Lengkap" id="alamat" name="alamat"></textarea>
                    </div>

                </div>

                <!-- KANAN MAP -->
                <div class="map-area">

                    <div id="mapPreview"></div>

                    <div class="coordinate-row">
                        <div>
                            <label>Latitude</label>
                            <input type="text" class="form-control custom-input" id="lat" name="lat">
                        </div>

                        <div>
                            <label>Longitude</label>
                            <input type="text" class="form-control custom-input" id="lng" name="lng">
                        </div>
                    </div>

                    <div class="btn-step1-wrapper">
                        <button type="button" class="btn-next" onclick="validasiStep1()">
                        Lanjut ke Data Klinis
                    </button>
                    </div>

                </div>
    
            </div>

        </div>

        <!-- ================= STEP 2 ================= -->
        <div id="step2" style="display:none">

            <div class="step-title-text">
                Mohon lengkapi detail kasus pneumonia
            </div>

            <div class="step2-layout">

                <!-- KIRI -->
                <div class="step-side-menu">

                    <div class="step-side-item">
                        <span class="step-check">✓</span>
                        <span>Summary Overview</span>
                    </div>

                    <div class="step-side-item active">
                        <span class="step-side-number">2</span>
                        <span>Step 2: Data Klinis</span>
                    </div>

                    <div class="step-side-item">
                        <span class="step-side-number muted">3</span>
                        <span>Ringkasan & Kirim</span>
                    </div>

                </div>

                <!-- FORM KLINIS -->
                <div class="step2-card">

                    <div class="step2-title">
                        <span class="step-side-number">2</span>
                        <span>Data Klinis</span>
                    </div>

                    <div class="step2-grid">

                        <div class="step2-field">
                            <label>Nama</label>
                            <input name="nama" type="text" class="form-control" placeholder="Nama sesuai KTP" id="nama">
                        </div>

                        <div class="step2-field">
                            <label>Tanggal Input</label>
                            <input name="tanggal" type="date" class="form-control" id="tanggal">
                        </div>

                        <div class="step2-field">
                            <label>Jenis kelamin</label>

                            <div class="radio-small">
                                <input type="radio" name="jk" value="Laki-laki" id="jkLaki">
                                <label for="jkLaki" style="font-weight:400;margin:0;">Laki-laki</label>
                            </div>

                            <div class="radio-small">
                                <input type="radio" name="jk" value="Perempuan" id="jkPerempuan">
                                <label for="jkPerempuan" style="font-weight:400;margin:0;">Perempuan</label>
                            </div>
                        </div>

                        <div class="step2-field">
                            <label>Usia</label>
                            <select name="usia" class="form-control" id="usia">
                                <option value="">Pilih Usia</option>
                                <option value="0-5 Tahun">0-5 Tahun</option>
                                <option value="6-11 Tahun">6-11 Tahun</option>
                                <option value="12-16 Tahun">12-16 Tahun</option>
                                <option value="17-25 Tahun">17-25 Tahun</option>
                                <option value="26-35 Tahun">26-35 Tahun</option>
                                <option value="36-45 Tahun">36-45 Tahun</option>
                                <option value="46-55 Tahun">46-55 Tahun</option>
                                <option value="56-65 Tahun">56-65 Tahun</option>
                                <option value=">65 Tahun">>65 Tahun</option>
                            </select>
                        </div>

                        <div class="step2-field">
                            <label>Diagnosa</label>
                            <select name="diagnosa" class="form-control" id="diagnosa">
                                <option value="">Pilih Diagnosa</option>
                                <option value="Pneumonia">Pneumonia</option>
                                <option value="Bronkopneumonia">Bronkopneumonia</option>
                                <option value="Pneumonia Berat">Pneumonia Berat</option>
                            </select>
                        </div>

                        <div></div>

                        <div class="step2-field">
                            <label>
                                Mendapatkan Antibiotik
                                <span class="antibiotik-note">*Khusus Pasien Balita dan Anak</span>
                            </label>

                            <div class="radio-small">
                                <input type="radio" name="antibiotik" value="Ya" id="antibiotikYa">
                                <label for="antibiotikYa" style="font-weight:400;margin:0;">Ya</label>
                            </div>

                            <div class="radio-small">
                                <input type="radio" name="antibiotik" value="Tidak" id="antibiotikTidak">
                                <label for="antibiotikTidak" style="font-weight:400;margin:0;">Tidak</label>
                            </div>

                            <div class="radio-small">
                                <input type="radio" name="antibiotik" value="-" id="antibiotikKosong">
                                <label for="antibiotikKosong" style="font-weight:400;margin:0;">-</label>
                            </div>
                        </div>

                    </div>

                    <div class="btn-step2-wrapper">
                        <button type="button" class="btn-next" onclick="validasiStep2()">
                        Lanjut ke Ringkasan
                    </button>
                    </div>

                </div>

            </div>

        </div>

        <!-- ================= STEP 3 ================= -->
        <div id="step3" style="display:none">

            <div class="step-title-text">
                Mohon lengkapi detail kasus pneumonia baru untuk pemetaan
            </div>

            <div class="step3-layout">

                <!-- KIRI -->
                <div class="step-side-menu">

                    <div class="step-side-item">
                        <span class="step-check">✓</span>
                        <span>Summary Overview</span>
                    </div>

                    <div class="step-side-item">
                        <span class="step-check">✓</span>
                        <span>Step 2: Data Klinis</span>
                    </div>

                    <div class="step-side-item active">
                        <span class="step-side-number">3</span>
                        <span>Ringkasan & Kirim</span>
                    </div>

                </div>

                <!-- CARD RINGKASAN -->
                <div class="step3-card">

                    <div class="step3-content">

                        <div>
                            <div class="step3-title">Ringkasan Laporan Kasus</div>

                            <div class="summary-row">
                                <div class="summary-label">Alamat Lengkap</div>
                                <div class="summary-colon">:</div>
                                <div class="summary-value" id="sumAlamat">-</div>
                            </div>

                            <div class="summary-row">
                                <div class="summary-label">Nama</div>
                                <div class="summary-colon">:</div>
                                <div class="summary-value" id="sumNama">-</div>
                            </div>

                            <div class="summary-row">
                                <div class="summary-label">Jenis Kelamin</div>
                                <div class="summary-colon">:</div>
                                <div class="summary-value" id="sumJK">-</div>
                            </div>

                            <div class="summary-row">
                                <div class="summary-label">Usia</div>
                                <div class="summary-colon">:</div>
                                <div class="summary-value" id="sumUsia">-</div>
                            </div>

                            <div class="summary-row">
                                <div class="summary-label">Tanggal Input</div>
                                <div class="summary-colon">:</div>
                                <div class="summary-value" id="sumTanggal">-</div>
                            </div>

                            <div class="summary-row">
                                <div class="summary-label">Diagnosa</div>
                                <div class="summary-colon">:</div>
                                <div class="summary-value" id="sumDiagnosa">-</div>
                            </div>

                            <div class="summary-row">
                                <div class="summary-label">Mendapatkan Antibiotik</div>
                                <div class="summary-colon">:</div>
                                <div class="summary-value" id="sumAntibiotik">-</div>
                            </div>
                        </div>

                        <div>
                            <div class="preview-title">Preview Peta</div>
                            <div id="summaryMap"></div>
                        </div>

                    </div>

                    <form action="<?= base_url('pneumonia/simpandatapasien') ?>" 
                          method="post" 
                          onsubmit="return submitData()">

                        <div class="confirm-row">
                            <input type="checkbox" id="confirm">
                            <label for="confirm">
                                Saya mengonfirmasi bahwa data yang dimasukkan sudah benar dan akurat
                            </label>
                        </div>

                        <input type="hidden" name="provinsi" id="formProvinsi">
                        <input type="hidden" name="kabupaten" id="formKabupaten">
                        <input type="hidden" name="kecamatan" id="formKecamatan">
                        <input type="hidden" name="desa" id="formDesa">
                        <input type="hidden" name="rt" id="formRT">
                        <input type="hidden" name="rw" id="formRW">
                        <input type="hidden" name="alamat" id="formAlamat">
                        <input type="hidden" name="lat" id="formLat">
                        <input type="hidden" name="lng" id="formLng">

                        <input type="hidden" name="nama" id="formNama">
                        <input type="hidden" name="tanggal" id="formTanggal">
                        <input type="hidden" name="jenis_kelamin" id="formJK">
                        <input type="hidden" name="usia" id="formUsia">
                        <input type="hidden" name="diagnosa" id="formDiagnosa">
                        <input type="hidden" name="antibiotik" id="formAntibiotik">
                        <input type="hidden" name="catatan" id="formCatatan">

                        <div class="step3-actions">

                            <button type="button" class="link-action" onclick="prevStep(2)">
                                📝 Ubah Data
                            </button>

                            <button type="submit" class="btn-next btn-save-step3">
                                Simpan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- POPUP SUCCESS -->
<div class="popup" id="popupSuccess">
    <div class="popup-box">

        <div class="popup-icon">✓</div>

        <div class="popup-title">
            Input Data Kasus Berhasil
        </div>

        <div class="popup-text">
            Data berhasil disimpan,<br>
            dan memperbarui peta<br>
            serta grafik
        </div>

        <button type="button" class="btn-popup-primary" onclick="lihatDetail()">
            Lihat Detail
        </button>

        <button type="button" class="btn-popup-secondary" onclick="closePopup()">
            Selesai
        </button>

    </div>
</div>

<!-- POPUP WARNING CHECKBOX -->
<div class="popup" id="popupWarning">
    <div class="popup-box">

        <div class="popup-icon warning-icon">!</div>

        <div class="popup-title">
            Konfirmasi Belum Dicentang
        </div>

        <div class="popup-text">
            Silakan centang konfirmasi<br>
            bahwa data yang dimasukkan<br>
            sudah benar dan akurat
        </div>

        <button type="button" class="btn-popup-primary" onclick="closeWarning()">
            Mengerti
        </button>

    </div>
</div>

<script>
var map;
var marker;
var summaryMap;
var summaryMarker;

var koordinatDesa = {
    "Sumbersari": { lat: -8.1725, lng: 113.7033 },
    "Antirogo": { lat: -8.1570, lng: 113.6905 },
    "Karangrejo": { lat: -8.1652, lng: 113.6801 },
    "Wirolegi": { lat: -8.1498, lng: 113.7050 },
    "Tegal gede": { lat: -8.1801, lng: 113.6955 }
};

document.addEventListener("DOMContentLoaded", function(){

    map = L.map('mapPreview').setView([-8.1725, 113.7033], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    marker = L.marker([-8.1725, 113.7033]).addTo(map);

    document.getElementById("lat").value = "-8.1725";
    document.getElementById("lng").value = "113.7033";

    setTimeout(function(){
        map.invalidateSize();
    }, 300);

    document.getElementById("desa").addEventListener("change", function(){

        var desa = this.value;

        if(koordinatDesa[desa]){
            var lat = koordinatDesa[desa].lat;
            var lng = koordinatDesa[desa].lng;

            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;

            map.setView([lat, lng], 15);
            marker.setLatLng([lat, lng]);
        }
    });

    map.on('click', function(e){

        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        document.getElementById("lat").value = lat.toFixed(6);
        document.getElementById("lng").value = lng.toFixed(6);

        marker.setLatLng([lat, lng]);
        map.setView([lat, lng], 17);
    });

    document.getElementById("lat").addEventListener("input", updateMap);
    document.getElementById("lng").addEventListener("input", updateMap);

    function updateMap(){
        var lat = parseFloat(document.getElementById("lat").value);
        var lng = parseFloat(document.getElementById("lng").value);

        if(!isNaN(lat) && !isNaN(lng)){
            map.setView([lat, lng], 17);
            marker.setLatLng([lat, lng]);
        }
    }
});

function nextStep(step){

    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step3').style.display = 'none';

    document.getElementById('step' + step).style.display = 'block';

    document.getElementById('stepNav1').classList.remove('active');
    document.getElementById('stepNav2').classList.remove('active');
    document.getElementById('stepNav3').classList.remove('active');

    document.getElementById('stepNav' + step).classList.add('active');

    if(step === 1){
        setTimeout(function(){
            map.invalidateSize();
        }, 200);
    }

    if(step === 3){
        isiRingkasan();

        setTimeout(function(){
            initSummaryMap();
        }, 250);
    }
}

function prevStep(step){
    nextStep(step);
}

function showWarningMessage(judul, pesan){
    const title = document.querySelector('#popupWarning .popup-title');
    const text = document.querySelector('#popupWarning .popup-text');

    if(title){
        title.innerText = judul;
    }

    if(text){
        text.innerHTML = pesan;
    }

    openWarning();
}

function validasiStep1(){

    let desa = document.getElementById('desa').value.trim();
    let rt = document.getElementById('rt').value.trim();
    let rw = document.getElementById('rw').value.trim();
    let alamat = document.getElementById('alamat').value.trim();
    let lat = document.getElementById('lat').value.trim();
    let lng = document.getElementById('lng').value.trim();

    if(desa === ""){
        showWarningMessage(
            "Data Lokasi Belum Lengkap",
            "Silakan pilih desa/kelurahan terlebih dahulu"
        );
        return false;
    }

    if(rt === ""){
        showWarningMessage(
            "Data Lokasi Belum Lengkap",
            "Silakan isi RT terlebih dahulu"
        );
        return false;
    }

    if(rw === ""){
        showWarningMessage(
            "Data Lokasi Belum Lengkap",
            "Silakan isi RW terlebih dahulu"
        );
        return false;
    }

    if(alamat === ""){
        showWarningMessage(
            "Data Lokasi Belum Lengkap",
            "Silakan isi alamat lengkap terlebih dahulu"
        );
        return false;
    }

    if(lat === "" || lng === ""){
        showWarningMessage(
            "Data Lokasi Belum Lengkap",
            "Silakan isi latitude dan longitude terlebih dahulu"
        );
        return false;
    }

    nextStep(2);
}

function validasiStep2(){

    let nama = document.getElementById('nama').value.trim();
    let tanggal = document.getElementById('tanggal').value.trim();
    let usia = document.getElementById('usia').value.trim();
    let diagnosa = document.getElementById('diagnosa').value.trim();

    let jk = document.querySelector('input[name="jk"]:checked');
    let antibiotik = document.querySelector('input[name="antibiotik"]:checked');

    if(nama === ""){
        showWarningMessage(
            "Data Klinis Belum Lengkap",
            "Silakan isi nama pasien terlebih dahulu"
        );
        return false;
    }

    if(tanggal === ""){
        showWarningMessage(
            "Data Klinis Belum Lengkap",
            "Silakan isi tanggal input terlebih dahulu"
        );
        return false;
    }

    if(!jk){
        showWarningMessage(
            "Data Klinis Belum Lengkap",
            "Silakan pilih jenis kelamin terlebih dahulu"
        );
        return false;
    }

    if(usia === ""){
        showWarningMessage(
            "Data Klinis Belum Lengkap",
            "Silakan pilih usia terlebih dahulu"
        );
        return false;
    }

    if(diagnosa === ""){
        showWarningMessage(
            "Data Klinis Belum Lengkap",
            "Silakan pilih diagnosa terlebih dahulu"
        );
        return false;
    }

    if(!antibiotik){
        showWarningMessage(
            "Data Klinis Belum Lengkap",
            "Silakan pilih status antibiotik terlebih dahulu"
        );
        return false;
    }

    nextStep(3);
}


function isiRingkasan(){

    let prov = document.getElementById('provinsi').value || '-';
    let kab = document.getElementById('kabupaten').value || '-';
    let kec = document.getElementById('kecamatan').value || '-';
    let desa = document.getElementById('desa').value || '-';
    let rt = document.getElementById('rt').value || '-';
    let rw = document.getElementById('rw').value || '-';
    let alamat = document.getElementById('alamat').value || '-';

    let nama = document.getElementById('nama').value || '-';
    let tanggal = document.getElementById('tanggal').value || '-';
    let usia = document.getElementById('usia').value || '-';
    let diagnosa = document.getElementById('diagnosa').value || '-';

    let jk = document.querySelector('input[name="jk"]:checked');
    jk = jk ? jk.value : '-';

    let antibiotik = document.querySelector('input[name="antibiotik"]:checked');
    antibiotik = antibiotik ? antibiotik.value : '-';

    document.getElementById('sumAlamat').innerText =
        prov + ', ' + kab + ', ' + kec + ', ' + desa +
        ', RT ' + rt + ', RW ' + rw + ', ' + alamat;

    document.getElementById('sumNama').innerText = nama;
    document.getElementById('sumJK').innerText = jk;
    document.getElementById('sumUsia').innerText = usia;
    document.getElementById('sumTanggal').innerText = tanggal;
    document.getElementById('sumDiagnosa').innerText = diagnosa;
    document.getElementById('sumAntibiotik').innerText = antibiotik;
}

function initSummaryMap(){

    let lat = parseFloat(document.getElementById('lat').value);
    let lng = parseFloat(document.getElementById('lng').value);

    if(isNaN(lat) || isNaN(lng)){
        lat = -8.1725;
        lng = 113.7033;
    }

    if(!summaryMap){
        summaryMap = L.map('summaryMap', {
            zoomControl: false,
            attributionControl: false
        }).setView([lat, lng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(summaryMap);

        summaryMarker = L.marker([lat, lng]).addTo(summaryMap);
    } else {
        summaryMap.setView([lat, lng], 14);
        summaryMarker.setLatLng([lat, lng]);
    }

    setTimeout(function(){
        summaryMap.invalidateSize();
    }, 200);
}

function submitData(){

   if(!document.getElementById('confirm').checked){
    showWarningMessage(
        "Konfirmasi Belum Dicentang",
        "Silakan centang konfirmasi<br>bahwa data yang dimasukkan<br>sudah benar dan akurat"
    );
    return false;
}

    document.getElementById('formProvinsi').value = document.getElementById('provinsi').value;
    document.getElementById('formKabupaten').value = document.getElementById('kabupaten').value;
    document.getElementById('formKecamatan').value = document.getElementById('kecamatan').value;
    document.getElementById('formDesa').value = document.getElementById('desa').value;
    document.getElementById('formRT').value = document.getElementById('rt').value;
    document.getElementById('formRW').value = document.getElementById('rw').value;
    document.getElementById('formAlamat').value = document.getElementById('alamat').value;
    document.getElementById('formLat').value = document.getElementById('lat').value;
    document.getElementById('formLng').value = document.getElementById('lng').value;

    document.getElementById('formNama').value = document.getElementById('nama').value;
    document.getElementById('formTanggal').value = document.getElementById('tanggal').value;
    document.getElementById('formUsia').value = document.getElementById('usia').value;
    document.getElementById('formDiagnosa').value = document.getElementById('diagnosa').value;

    let jk = document.querySelector('input[name="jk"]:checked');
    document.getElementById('formJK').value = jk ? jk.value : '';

    let antibiotik = document.querySelector('input[name="antibiotik"]:checked');
    document.getElementById('formAntibiotik').value = antibiotik ? antibiotik.value : '';

    document.getElementById('formCatatan').value = '';

    return true;
}

function openPopup(){
    const popup = document.getElementById('popupSuccess');
    if(popup){
        popup.classList.add('show');
    }
}

function closePopup(){
    const popup = document.getElementById('popupSuccess');

    if(popup){
        popup.classList.remove('show');
    }

    window.history.replaceState({}, document.title, "<?= base_url('pneumonia/input_data') ?>");
}

function openWarning(){
    const warning = document.getElementById('popupWarning');
    if(warning){
        warning.classList.add('show');
    }
}

function closeWarning(){
    const warning = document.getElementById('popupWarning');
    if(warning){
        warning.classList.remove('show');
    }
}

function lihatDetail(){
    window.location.href = "<?= base_url('pneumonia/hasil') ?>";
}

window.addEventListener("load", function(){
    const params = new URLSearchParams(window.location.search);

    if(params.get("success") === "1"){
        openPopup();
    }
});

</script>

<?= $this->endSection() ?>