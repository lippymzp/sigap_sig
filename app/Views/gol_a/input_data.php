<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>

/* ===== STEP HEADER ===== */
/* ===== STEP FIGMA FIX ===== */
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

/* ===== POPUP ===== */
.popup{
    position:fixed;
    top:0;left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    display:none;
    justify-content:center;
    align-items:center;
}
.popup-box{
    background:white;
    padding:25px;
    border-radius:15px;
    width:320px;
    text-align:center;
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

            <div class="text-end mt-4">
                <button class="btn-next" onclick="nextStep(2)">Lanjut →</button>
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
                    <label>Nama Pasien</label>
                    <input name="nama" type="text" class="form-control custom-input" placeholder="Nama sesuai KTP" id="nama">
                </div>

                <div class="col-md-6">
                    <label>Tanggal Kunjungan</label>
                    <input name="tanggal" type="date" class="form-control custom-input" id="tanggal">
                </div>

                <div class="col-md-6">
                    <label>Jenis Kelamin</label><br>
                    <input type="radio" name="jk" value="Laki-laki"> Laki-laki<br>
                    <input type="radio" name="jk" value="Perempuan"> Perempuan
                </div>

                <div class="col-md-6">
                    <label>Usia</label>
                    <input name="usia" type="number" class="form-control custom-input" placeholder="Usia" id="usia">
                </div>

                <div class="col-md-12">
                    <label>Catatan Klinis</label>
                    <textarea name="catatan" class="form-control custom-input" placeholder="Masukkan catatan..." id="catatan"></textarea>
                </div>

            </div>

            <div class="text-end mt-4">
                <button class="btn-next" onclick="nextStep(3)">Lanjut →</button>
            </div>

        </div>

    </div>

</div>

</div>

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

            <img src="<?= base_url('img/chart.png') ?>" 
                 class="img-fluid rounded"
                 style="height:180px; object-fit:cover;">

        </div>

    </div>

    <!-- KANAN (SUMMARY + FORM) -->
    <div class="col-md-8">

        <div class="card-summary">

            <h6 class="fw-bold mb-3">Ringkasan Laporan Kasus</h6>

            <!-- DATA -->
            <div class="summary-item d-flex justify-content-between mb-2">
                <span>Alamat</span>
                <b id="sumAlamat">-</b>
            </div>

            <div class="summary-item d-flex justify-content-between mb-2">
                <span>Jenis Kelamin</span>
                <b id="sumJK">-</b>
            </div>

            <div class="summary-item d-flex justify-content-between mb-2">
                <span>Usia</span>
                <b id="sumUsia">-</b>
            </div>

            <div class="summary-item d-flex justify-content-between mb-2">
                <span>Tanggal</span>
                <b id="sumTanggal">-</b>
            </div>

            <div class="summary-item d-flex justify-content-between mb-3">
                <span>Catatan</span>
                <b id="sumCatatan">-</b>
            </div>

            <!-- CHECK -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirm">
                <label class="form-check-label">
                    Saya mengonfirmasi data benar
                </label>
            </div>

            <!-- FORM SUBMIT -->
            <form action="<?= base_url('dbd/simpandatapasien') ?>" method="post" onsubmit="return submitData()">

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
                <input type="hidden" name="jk" id="formJK">
                <input type="hidden" name="usia" id="formUsia">
                <input type="hidden" name="catatan" id="formCatatan">
                <input type="hidden" name="no_rm" id="formRM">

                <div class="d-flex justify-content-between align-items-center mt-4">

                    <div>
                        <a href="#" class="link-action d-block">💾 Simpan Draft</a>
                        <a href="#" class="link-action d-block">✏️ Ubah Data</a>
                    </div>

                    <button type="submit" class="btn-save">
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</div>

<!-- POPUP -->
<div class="popup" id="popupSuccess">
<div class="popup-box">
<h5>Berhasil</h5>
<p>Data berhasil disimpan</p>
<button class="btn-next" onclick="closePopup()">OK</button>
</div>
</div>

<script>

function nextStep(step){

    // pindah step
    document.getElementById('step1').style.display='none';
    document.getElementById('step2').style.display='none';
    document.getElementById('step3').style.display='none';

    document.getElementById('step'+step).style.display='block';

    // update nav
    document.getElementById('stepNav1').classList.remove('active');
    document.getElementById('stepNav2').classList.remove('active');
    document.getElementById('stepNav3').classList.remove('active');

    document.getElementById('stepNav'+step).classList.add('active');

    // ===== AUTO ISI STEP 3 =====
    if(step === 3){

        let prov = document.getElementById('provinsi').value;
        let kab = document.getElementById('kabupaten').value;
        let kec = document.getElementById('kecamatan').value;
        let desa = document.getElementById('desa').value;
        let rt = document.getElementById('rt').value;
        let rw = document.getElementById('rw').value;
        let alamat = document.getElementById('alamat').value;

        let tanggal = document.getElementById('tanggal').value;
        let usia = document.getElementById('usia').value;
        let catatan = document.getElementById('catatan').value;

        let jk = document.querySelector('input[name="jk"]:checked');
        jk = jk ? jk.value : '-';

        document.getElementById('sumAlamat').innerText =
            prov + ', ' + kab + ', ' + kec + ', ' + desa +
            ' RT ' + rt + ' RW ' + rw + ' - ' + alamat;

        document.getElementById('sumJK').innerText = jk;
        document.getElementById('sumUsia').innerText = usia;
        document.getElementById('sumTanggal').innerText = tanggal;
        document.getElementById('sumCatatan').innerText = catatan;
    }
}


// ===== SUBMIT =====
function submitData(){

    // STEP 1
    document.getElementById('formProvinsi').value = document.getElementById('provinsi').value;
    document.getElementById('formKabupaten').value = document.getElementById('kabupaten').value;
    document.getElementById('formKecamatan').value = document.getElementById('kecamatan').value;
    document.getElementById('formDesa').value = document.getElementById('desa').value;
    document.getElementById('formRT').value = document.getElementById('rt').value;
    document.getElementById('formRW').value = document.getElementById('rw').value;
    document.getElementById('formAlamat').value = document.getElementById('alamat').value;
    document.getElementById('formLat').value = document.getElementById('lat').value;
    document.getElementById('formLng').value = document.getElementById('lng').value;

    // STEP 2
    document.getElementById('formNama').value = document.getElementById('nama').value;
    document.getElementById('formTanggal').value = document.getElementById('tanggal').value;
    document.getElementById('formUsia').value = document.getElementById('usia').value;
    document.getElementById('formCatatan').value = document.getElementById('catatan').value;

    let jk = document.querySelector('input[name="jk"]:checked');
    document.getElementById('formJK').value = jk ? jk.value : '';

    // popup
    document.getElementById('popupSuccess').style.display = 'flex';

    setTimeout(() => {
        document.querySelector('form').submit();
    }, 1200);

    return false;
}

</script>


<?= $this->endSection() ?>