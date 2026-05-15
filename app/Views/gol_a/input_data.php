<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>

/* ===== STEP HEADER ===== */

/* ===== STEP FINAL FIX ===== */
.step-progress{
    position:relative;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:30px;
}

/* garis panjang */

/* item */
.step-item{
    position:relative;
    z-index:2;
    width:33%;
    text-align:center;
    font-size:14px;
    color:#999;
}

/* bar kecil */
.step-item .bar{
    height:6px;
    width:60%;
    margin:0 auto 8px auto;
    border-radius:10px;
    background:#ddd;
}

/* aktif */
.step-item.active{
    color:#00BBC2;
    font-weight:600;
}

.step-item.active .bar{
    background:#00BBC2;
    box-shadow:0 0 6px rgba(0,187,194,0.4);
}
/* ===== FORM ===== */
.form-box{
    background:#eef5f5;
    padding:30px;
    border-radius:20px;
}
.custom-input{
    border:none;
    border-radius:10px;
    background:#f7f7f7;
}

/* ===== BUTTON ===== */
.btn-next{
    background:#00BBC2;
    color:white;
    border:none;
    padding:10px 25px;
    border-radius:20px;
}

/* ===== SUMMARY ===== */
.summary-box{
    background:white;
    padding:20px;
    border-radius:15px;
}

/* =========================
   POPUP STYLE
========================= */
.popup{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.45);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:9999;
    animation:fadeIn 0.2s ease;
}

.popup-box{
    width:360px;
    background:#fff;
    border-radius:24px;
    padding:35px 30px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.12);
    animation:popupScale 0.25s ease;
}

/* ICON */
.popup-icon{
    width:80px;
    height:80px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 18px auto;
    font-size:38px;
    font-weight:bold;
}

/* BERHASIL */
.popup-success .popup-icon{
    background:#e9fff3;
    color:#00b96b;
}

/* GAGAL */
.popup-error .popup-icon{
    background:#ffeaea;
    color:#ff4d4f;
}

/* TITLE */
.popup-title{
    font-size:24px;
    font-weight:700;
    margin-bottom:8px;
    color:#1e293b;
}

/* TEXT */
.popup-text{
    color:#64748b;
    font-size:15px;
    margin-bottom:22px;
    line-height:1.5;
}

/* BUTTON */
.popup-btn{
    border:none;
    background:#00BBC2;
    color:white;
    padding:10px 28px;
    border-radius:14px;
    font-weight:600;
    transition:0.2s;
}

.popup-btn:hover{
    background:#00a5ab;
    transform:translateY(-1px);
}

/* ANIMATION */
@keyframes popupScale{
    from{
        transform:scale(0.8);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}

@keyframes fadeIn{
    from{
        opacity:0;
    }
    to{
        opacity:1;
    }
}

/* ===== BUTTON UBAH DATA ===== */
.btn-ubah-data{
    border:none;
    background:none;
    color:#7c8db5;
    font-weight:600;
    font-size:15px;
    display:flex;
    align-items:center;
    gap:6px;
    transition:0.2s;
}

.btn-ubah-data:hover{
    color:#00BBC2;
    transform:translateX(-2px);
}


</style>

<div class="section-card">

<h4 class="mb-4">Input Data Pasien</h4>

<!-- STEP HEADER -->
<div class="step-progress">

    <div class="progress-line"></div>

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
<!-- ================= STEP 1 ================= -->
<div id="step1">

<h5 class="mb-4">Step 1 : Lokasi Kasus</h5>

<div class="row g-4">

    <!-- KIRI -->
    <div class="col-md-7">

        <div class="card-summary">

            <h6 class="fw-bold mb-3">Data Lokasi</h6>

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Provinsi</label>
                    <select name="provinsi" class="form-control custom-input" id="provinsi">
                        <option>Jawa Timur</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Kabupaten</label>
                    <select name="kabupaten" class="form-control custom-input" id="kabupaten">
                        <option>Jember</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Kecamatan</label>
                    <select name="kecamatan" class="form-control custom-input" id="kecamatan">
                        <option>Sumbersari</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Desa</label>
                    <select name="desa" class="form-control custom-input" id="desa">
                        <option>Sumbersari</option>
                        <option>Antirogo</option>
                        <option>Karangrejo</option>
                        <option>Wirolegi</option>
                        <option>Tegal gede</option>
                    </select>
                </div>

                <div class="col-md-6 d-flex gap-2">
                    <input type="text" class="form-control custom-input" placeholder="RT" id="rt" name="rt">
                    <input type="text" class="form-control custom-input" placeholder="RW" id="rw" name="rw">
                </div>

                <div class="col-md-6 d-flex gap-2">
                    <input type="text" class="form-control custom-input" placeholder="Latitude" id="lat" name="lat">
                    <input type="text" class="form-control custom-input" placeholder="Longitude" id="lng" name="lng">
                </div>

                <div class="col-md-12">
                    <textarea class="form-control custom-input" placeholder="Alamat lengkap" id="alamat" name="alamat"></textarea>
                </div>

            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn-next" onclick="nextStep(2)">
                    Lanjut →
                </button>
            </div>

            

        </div>

    </div>

    <!-- KANAN (MAP PREVIEW STYLE FIGMA) -->
    <div class="col-md-5">

        <div class="card-summary text-center">

            <h6 class="fw-bold mb-3">Preview Lokasi</h6>

            <div id="mapPreview" style="height:200px; border-radius:10px;"></div>

            <small class="text-muted d-block mt-2">Lokasi akan tampil di peta</small>

        </div>

    </div>

</div>

            <script>
                function prevStep(step){
                document.getElementById('step1').style.display='none';
                document.getElementById('step2').style.display='none';
                document.getElementById('step3').style.display='none';
                document.getElementById('step'+step).style.display='block';
                document.getElementById('stepNav1').classList.remove('active');
                document.getElementById('stepNav2').classList.remove('active');
                document.getElementById('stepNav3').classList.remove('active');
                document.getElementById('stepNav'+step).classList.add('active');
}

                var map;
                var marker;

                // 🔥 DATA KOORDINAT DESA (DEFAULT)
                var koordinatDesa = {
                    "Sumbersari": { lat: -8.1725, lng: 113.7033 },
                    "Antirogo": { lat: -8.1570, lng: 113.6905 },
                    "Karangrejo": { lat: -8.1652, lng: 113.6801 },
                    "Wirolegi": { lat: -8.1498, lng: 113.7050 },
                    "Tegal gede": { lat: -8.1801, lng: 113.6955 }
                };

                document.addEventListener("DOMContentLoaded", function(){

                    // 🔥 INIT MAP
                    map = L.map('mapPreview').setView([-8.1725, 113.7033], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap'
                    }).addTo(map);

                    // 🔥 MARKER AWAL
                    marker = L.marker([-8.1725, 113.7033]).addTo(map);

                    // 🔥 FIX BUG MAP KOSONG (WAJIB kalau di step/tab)
                    setTimeout(() => {
                        map.invalidateSize();
                    }, 300);

                    // =========================================
                    // 🔥 DEFAULT SAAT LOAD
                    // =========================================
                    var defaultDesa = document.getElementById("desa").value;

                    if(koordinatDesa[defaultDesa]){
                        var lat = koordinatDesa[defaultDesa].lat;
                        var lng = koordinatDesa[defaultDesa].lng;

                        document.getElementById("lat").value = lat;
                        document.getElementById("lng").value = lng;

                        map.setView([lat, lng], 15);
                        marker.setLatLng([lat, lng]);
                    }

                    // =========================================
                    // 🔥 PILIH DESA → AUTO PINDAH MAP
                    // =========================================
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

                    // =========================================
                    // 🔥 KLIK PETA → AMBIL TITIK RUMAH (INI INTI)
                    // =========================================
                    map.on('click', function(e){

                        var lat = e.latlng.lat;
                        var lng = e.latlng.lng;

                        // isi input
                        document.getElementById("lat").value = lat.toFixed(6);
                        document.getElementById("lng").value = lng.toFixed(6);

                        // pindah marker
                        marker.setLatLng([lat, lng]);

                        // zoom ke titik
                        map.setView([lat, lng], 17);

                    });

                    // =========================================
                    // 🔥 MANUAL INPUT LAT LNG → MAP IKUT GERAK
                    // =========================================
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
                </script>

</div>

<!-- ================= STEP 2 ================= -->
<!-- ================= STEP 2 ================= -->
<div id="step2" style="display:none">

<h5 class="mb-4">Step 2 : Data Klinis</h5>

<div class="row g-4">

    <!-- KIRI (STEP INDICATOR STYLE FIGMA) -->
    <div class="col-md-4">

        <div class="card-summary">

            <div class="mb-3">
                <span class="badge bg-success">✔</span> Step 1 : Lokasi
            </div>

            <div class="mb-3 fw-bold text-primary">
                <span class="badge bg-primary">2</span> Step 2 : Data Klinis
            </div>

            <div class="text-muted">
                <span class="badge bg-light text-dark">3</span> Ringkasan & Kirim
            </div>

        </div>

    </div>

    <!-- KANAN (FORM) -->
    <div class="col-md-8">

        <div class="card-summary">

            <h6 class="fw-bold mb-3">Data Klinis</h6>

            <div class="row g-3">

                <div class="col-md-6">
                    <label>NIK</label>
                    <input name="nik" type="text" pattern="\d*" maxlength="16" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control custom-input" placeholder="Masukkan 16 digit NIK" id="nik" required>
                </div>

                <div class="col-md-6">
                    <label>Nama Pasien</label>
                    <input name="nama" type="text" class="form-control custom-input" placeholder="Nama sesuai KTP" id="nama" required>
                </div>

                <div class="col-md-6">
                    <label>Tanggal Lahir</label>
                    <input name="tgl_lahir" type="date" class="form-control custom-input" id="tgl_lahir" required>
                </div>

                <div class="col-md-6">
                    <label>Usia (Otomatis)</label>
                    <input name="usia" type="number" class="form-control custom-input" placeholder="Usia" id="usia" readonly>
                </div>

                <div class="col-md-6">
                    <label>Jenis Kelamin</label><br>
                    <input type="radio" name="jk" value="Laki-laki"> Laki-laki<br>
                    <input type="radio" name="jk" value="Perempuan"> Perempuan
                </div>

                <div class="col-md-6">
                    <label>Tanggal Pemeriksaan</label>
                    <input name="tanggal_pemeriksaan" type="date" class="form-control custom-input" id="tanggal_pemeriksaan" required>
                </div>

                <div class="col-md-6">
                    <label>Status Akhir</label>
                    <select name="status_akhir" class="form-control custom-input" id="status_akhir" required>
                        <option value="">Pilih Status</option>
                        <option value="Sembuh">Sembuh</option>
                        <option value="Meninggal">Meninggal</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Tindak Lanjut</label>
                    <select name="tindak_lanjut" class="form-control custom-input" id="tindak_lanjut" required>
                        <option value="">Pilih Tindak Lanjut</option>
                        <option value="Larvasidasi">Larvasidasi</option>
                        <option value="Fogging">Fogging</option>
                        <option value="3M">3M</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label>Catatan Klinis</label>
                    <textarea name="catatan" class="form-control custom-input" placeholder="Masukkan catatan..." id="catatan"></textarea>
                </div>

            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn-next" onclick="prevStep(1)">
                    ← Kembali
                </button>
                <button type="button" class="btn-next" onclick="nextStep(3)">
                    Lanjut →
                </button>

    </div> <!-- d-flex -->
    </div> <!-- card-summary -->
    </div> <!-- col-md-8 -->

    </div> <!-- row -->
    </div> <!-- step2 -->

<!-- ================= STEP 3 ================= -->
<!-- ================= STEP 3 ================= -->
<div id="step3" style="display:none">

<h5 class="mb-4">Step 3 : Ringkasan & Kirim</h5>

<div class="row g-4">

    <!-- KIRI (STEP INDICATOR) -->
    <div class="col-md-4">

        <div class="card-summary">

            <div class="mb-3">
                <span class="badge bg-success">✔</span> Step 1 : Lokasi
            </div>

            <div class="mb-3">
                <span class="badge bg-success">✔</span> Step 2 : Data Klinis
            </div>

            <div class="fw-bold text-primary">
                <span class="badge bg-primary">3</span> Ringkasan & Kirim
            </div>

        </div>

        <!-- OPTIONAL CHART -->
        <div class="card-summary text-center mt-3">
            <h6 class="fw-bold mb-3">Kelompok Usia</h6>
            <canvas id="usiaChart" height="180"></canvas>
        </div>

    </div>

    <!-- KANAN (SUMMARY + FORM) -->
    <div class="col-md-8">

        <div class="card-summary">

            <h6 class="fw-bold mb-3">Ringkasan Laporan Kasus</h6>

            <!-- DATA -->
            <div class="summary-box">

    <div class="row mb-2">
    <div class="col-4 text-muted">NIK</div>
    <div class="col-1 text-center">:</div>
    <div class="col-7 fw-semibold" id="sumNIK">-</div>
    </div>

    <div class="row mb-2">
    <div class="col-4 text-muted">Nama Pasien</div>
    <div class="col-1 text-center">:</div>
    <div class="col-7 fw-semibold" id="sumNama">-</div>
    </div>

            <div class="row mb-2 align-items-start">
        <div class="col-4 text-muted">Alamat</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumAlamat">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Jenis Kelamin</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumJK">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Tanggal Lahir</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumTglLahir">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Usia</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumUsia">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Tanggal Pemeriksaan</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumTanggal">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Status Akhir</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumStatus">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Tindak Lanjut</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumTindak">-</div>
    </div>

    <div class="row mb-3">
        <div class="col-4 text-muted">Catatan</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumCatatan">-</div>
    </div>

    <!-- CHECK -->
    <div class="form-check mt-3" style="padding-left: 2rem;">
    <input 
        class="form-check-input" 
        type="checkbox" 
        id="confirm"
        style="
            width: 22px;
            height: 22px;
            border: 2px solid #0d6efd;
            cursor: pointer;
            margin-top: 2px;
        "
    >
    <label 
        class="form-check-label fw-semibold" 
        for="confirm"
        style="
            font-size: 15px;
            margin-left: 8px;
            cursor: pointer;
        "
    >
        Saya mengonfirmasi data benar
    </label>
</div>

</div>

</div>


            <!-- FORM SUBMIT -->
            <form action="<?= base_url('dbd/simpandatapasien') ?>" 
                  method="post" 
                  onsubmit="return submitData()">

                <input type="hidden" name="provinsi" id="formProvinsi">
                <input type="hidden" name="kabupaten" id="formKabupaten">
                <input type="hidden" name="kecamatan" id="formKecamatan">
                <input type="hidden" name="desa" id="formDesa">
                <input type="hidden" name="rt" id="formRT">
                <input type="hidden" name="rw" id="formRW">
                <input type="hidden" name="alamat" id="formAlamat">
                <input type="hidden" name="lat" id="formLat">
                <input type="hidden" name="lng" id="formLng">

                <input type="hidden" name="nik" id="formNIK">
                <input type="hidden" name="nama" id="formNama">
                <input type="hidden" name="tgl_lahir" id="formTglLahir">
                <input type="hidden" name="tanggal_pemeriksaan" id="formTanggalPemeriksaan">
                <input type="hidden" name="jenis_kelamin" id="formJK">
                <input type="hidden" name="usia" id="formUsia">
                <input type="hidden" name="status_akhir" id="formStatus">
                <input type="hidden" name="tindak_lanjut" id="formTindak">
                <input type="hidden" name="catatan" id="formCatatan">

                    
                <div class="d-flex justify-content-end align-items-center gap-3 mt-4">

                <button 
                    type="button"
                    class="btn-ubah-data"
                    onclick="prevStep(1)"
                >
                    <i class="fa-regular fa-pen-to-square"></i>
                    Ubah Data
                </button>

                <button type="submit" class="btn-next">
                    Simpan
                </button>

            </div>

            </form>

        </div>
    </div>
</div>

</div> <!-- END STEP 3 -->

</div> <!-- END FORM BOX -->

</div> <!-- END SECTION CARD -->

<script>

function nextStep(step){

    // =========================
    // VALIDASI STEP 1
    // =========================
    if(step === 2){

        let kosong = [];

        if(document.getElementById('rt').value === ''){
            kosong.push('RT');
        }

        if(document.getElementById('rw').value === ''){
            kosong.push('RW');
        }

        if(document.getElementById('alamat').value === ''){
            kosong.push('Alamat');
        }

        if(document.getElementById('lat').value === ''){
            kosong.push('Latitude');
        }

        if(document.getElementById('lng').value === ''){
            kosong.push('Longitude');
        }

        if(kosong.length > 0){

            showPopupGagal(
                'Kolom ' + kosong.join(', ') + ' belum terisi. Silahkan dilengkapi.'
            );

            return;
        }
    }

    // =========================
    // VALIDASI STEP 2
    // =========================
    if(step === 3){

        let kosong = [];

        if(document.getElementById('nik').value === '' || document.getElementById('nik').value.length !== 16){
            kosong.push('NIK (harus 16 digit)');
        }

        if(document.getElementById('nama').value === ''){
            kosong.push('Nama Pasien');
        }

        if(document.getElementById('tgl_lahir').value === ''){
            kosong.push('Tanggal Lahir');
        }

        if(document.getElementById('tanggal_pemeriksaan').value === ''){
            kosong.push('Tanggal Pemeriksaan');
        }

        if(!document.querySelector('input[name="jk"]:checked')){
            kosong.push('Jenis Kelamin');
        }

        if(document.getElementById('usia').value === ''){
            kosong.push('Usia');
        }
        
        if(document.getElementById('status_akhir').value === ''){
            kosong.push('Status Akhir');
        }

        if(document.getElementById('tindak_lanjut').value === ''){
            kosong.push('Tindak Lanjut');
        }

        if(document.getElementById('catatan').value === ''){
            kosong.push('Catatan Klinis');
        }

        if(kosong.length > 0){

            showPopupGagal(
                'Kolom ' + kosong.join(', ') + ' belum terisi. Silahkan dilengkapi.'
            );

            return;
        }
    }

    // =========================
    // PINDAH STEP
    // =========================
    document.getElementById('step1').style.display='none';
    document.getElementById('step2').style.display='none';
    document.getElementById('step3').style.display='none';

    document.getElementById('step'+step).style.display='block';

    document.getElementById('stepNav1').classList.remove('active');
    document.getElementById('stepNav2').classList.remove('active');
    document.getElementById('stepNav3').classList.remove('active');

    document.getElementById('stepNav'+step).classList.add('active');

    // =========================
    // RINGKASAN STEP 3
    // =========================
    if(step === 3){

        let prov = document.getElementById('provinsi').value;
        let kab = document.getElementById('kabupaten').value;
        let kec = document.getElementById('kecamatan').value;
        let desa = document.getElementById('desa').value;
        let rt = document.getElementById('rt').value;
        let rw = document.getElementById('rw').value;
        let alamat = document.getElementById('alamat').value;

        let nik = document.getElementById('nik').value;
        let nama = document.getElementById('nama').value;
        let tgl_lahir = document.getElementById('tgl_lahir').value;
        let tanggal = document.getElementById('tanggal_pemeriksaan').value;
        let usia = document.getElementById('usia').value;
        let status = document.getElementById('status_akhir').value;
        let tindak = document.getElementById('tindak_lanjut').value;
        let catatan = document.getElementById('catatan').value;

        let jk = document.querySelector('input[name="jk"]:checked');
        jk = jk ? jk.value : '-';

        document.getElementById('sumAlamat').innerText =
            prov + ', ' + kab + ', ' + kec + ', ' + desa +
            ' RT ' + rt + ' RW ' + rw + ' - ' + alamat;

        document.getElementById('sumNIK').innerText = nik;
        document.getElementById('sumNama').innerText = nama;
        document.getElementById('sumTglLahir').innerText = tgl_lahir;
        document.getElementById('sumJK').innerText = jk;
        document.getElementById('sumUsia').innerText = usia;
        document.getElementById('sumTanggal').innerText = tanggal;
        document.getElementById('sumStatus').innerText = status;
        document.getElementById('sumTindak').innerText = tindak;
        document.getElementById('sumCatatan').innerText = catatan;
    }
}

document.getElementById('tgl_lahir').addEventListener('change', function() {
    let dob = new Date(this.value);
    let today = new Date();
    if (!isNaN(dob.getTime())) {
        let age = today.getFullYear() - dob.getFullYear();
        let m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        document.getElementById('usia').value = age;
    }
});

function prevStep(step){

    document.getElementById('step1').style.display='none';
    document.getElementById('step2').style.display='none';
    document.getElementById('step3').style.display='none';

    document.getElementById('step'+step).style.display='block';

    document.getElementById('stepNav1').classList.remove('active');
    document.getElementById('stepNav2').classList.remove('active');
    document.getElementById('stepNav3').classList.remove('active');

    document.getElementById('stepNav'+step).classList.add('active');
}

function submitData(){

    // VALIDASI CHECKBOX
    if(!document.getElementById('confirm').checked){

        showPopupGagal(
            'Silahkan centang konfirmasi data terlebih dahulu'
        );

        return false;
    }

    // STEP 1
    document.getElementById('formProvinsi').value =
        document.getElementById('provinsi').value;

    document.getElementById('formKabupaten').value =
        document.getElementById('kabupaten').value;

    document.getElementById('formKecamatan').value =
        document.getElementById('kecamatan').value;

    document.getElementById('formDesa').value =
        document.getElementById('desa').value;

    document.getElementById('formRT').value =
        document.getElementById('rt').value;

    document.getElementById('formRW').value =
        document.getElementById('rw').value;

    document.getElementById('formAlamat').value =
        document.getElementById('alamat').value;

    document.getElementById('formLat').value =
        document.getElementById('lat').value;

    document.getElementById('formLng').value =
        document.getElementById('lng').value;

    // STEP 2
    document.getElementById('formNIK').value =
        document.getElementById('nik').value;

    document.getElementById('formNama').value =
        document.getElementById('nama').value;

    document.getElementById('formTglLahir').value =
        document.getElementById('tgl_lahir').value;

    document.getElementById('formTanggalPemeriksaan').value =
        document.getElementById('tanggal_pemeriksaan').value;

    document.getElementById('formUsia').value =
        document.getElementById('usia').value;

    document.getElementById('formStatus').value =
        document.getElementById('status_akhir').value;

    document.getElementById('formTindak').value =
        document.getElementById('tindak_lanjut').value;

    document.getElementById('formCatatan').value =
        document.getElementById('catatan').value;

    let jk = document.querySelector('input[name="jk"]:checked');

    document.getElementById('formJK').value =
        jk ? jk.value : '';

    return true;
}

</script>

<!-- chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('usiaChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: <?= $labelChart ?>,

        datasets: [{

            label: 'Jumlah Pasien',

            data: <?= $totalChart ?>,

            borderRadius: 10,

            backgroundColor: [
                '#36A2EB',
                '#4BC0C0',
                '#0B4F6C',
                '#9BC4E2',
                '#00BCD4'
            ]
        }]
    },

    options: {

        responsive: true,

        plugins: {
            legend: {
                display: false
            }
        },

        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

<!-- pesan suskes atau gagal -->

<<div 
    class="popup popup-success" 
    id="popupSuccess"
    style="<?= session()->getFlashdata('success') ? 'display:flex;' : 'display:none;' ?>"
>

    <div class="popup-box">

        <div class="popup-icon">
            ✓
        </div>

        <div class="popup-title">
            Berhasil
        </div>

        <div class="popup-text">
            Data pasien berhasil disimpan
        </div>

        <button class="popup-btn" onclick="closePopupSuccess()">
            OK
        </button>

    </div>

</div>

<div 
    class="popup popup-error" 
    id="popupGagal"
    style="<?= session()->getFlashdata('error') ? 'display:flex;' : 'display:none;' ?>"
>

    <div class="popup-box">

        <div class="popup-icon">
            ✕
        </div>

        <div class="popup-title">
            Gagal
        </div>

        <div class="popup-text" id="popupGagalText">
            <?= session()->getFlashdata('error') ?? 'Data belum lengkap' ?>
        </div>

        <button class="popup-btn" onclick="closePopupGagal()">
            OK
        </button>

    </div>

</div>

<script>

function showPopupGagal(pesan){
    document.getElementById('popupGagalText').innerText = pesan;
    document.getElementById('popupGagal').style.display = 'flex';
}

function closePopupGagal(){
    document.getElementById('popupGagal').style.display = 'none';
}

function closePopupSuccess(){
    document.getElementById('popupSuccess').style.display = 'none';
}

</script>

<?= $this->endSection() ?>