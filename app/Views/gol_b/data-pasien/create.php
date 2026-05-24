<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

.card-summary{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
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
                    <input 
                        type="text"
                        name="provinsi"
                        class="form-control custom-input"
                        id="provinsi"
                        value="Jawa Timur"
                        placeholder="Masukkan Provinsi">
                </div>

                <div class="col-md-6">
                    <label>Kabupaten</label>
                    <input 
                        type="text"
                        name="kabupaten"
                        class="form-control custom-input"
                        id="kabupaten"
                        value="Jember"
                        placeholder="Masukkan Kabupaten">
                </div>

                <div class="col-md-6">
                    <label>Kecamatan</label>
                    <input 
                        type="text"
                        name="kecamatan"
                        class="form-control custom-input"
                        id="kecamatan"
                        value="Kaliwates"
                        placeholder="Masukkan Kecamatan">
                </div>

                <div class="col-md-6">
                    <label>Desa</label>
                    <select name="desa" class="form-control custom-input" id="desa">

                        <option value="2001">Jemberkidul</option>
                        <option value="2002">Tegalbesar</option>
                        <option value="2003">Kaliwates</option>
                        <option value="2004">Kebonagung</option>
                        <option value="2005">Sempusari</option>
                        <option value="2006">Mangli</option>
                        <option value="2007">Kepatihan</option>

                    </select>
                </div>

                <div class="col-md-6 d-flex gap-2">
                    <input type="text" class="form-control custom-input" placeholder="RT" id="rt" name="rt">
                    <input type="text" class="form-control custom-input" placeholder="RW" id="rw" name="rw">
                </div>

                <div class="col-md-6 d-flex gap-2">
                    <input type="text" class="form-control custom-input" id="lat" name="lat" readonly> 
                    <input type="text" class="form-control custom-input" id="lng" name="lng" readonly>
                </div>

                <div class="col-md-12">
                    <textarea class="form-control custom-input" placeholder="Alamat lengkap" id="alamat" name="alamat"></textarea>
                </div>

            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="button" class="btn-next" onclick="nextStep(2)">Lanjut →</button>
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

                    "2001": { lat: -8.1698, lng: 113.7021 }, // Jemberkidul
                    "2002": { lat: -8.1840, lng: 113.7150 }, // Tegalbesar
                    "2003": { lat: -8.1685, lng: 113.7038 }, // Kaliwates
                    "2004": { lat: -8.1720, lng: 113.6980 }, // Kebonagung
                    "2005": { lat: -8.1612, lng: 113.6945 }, // Sempusari
                    "2006": { lat: -8.1764, lng: 113.7102 }, // Mangli
                    "2007": { lat: -8.1588, lng: 113.7067 }  // Kepatihan

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
            <input 
                type="text"
                name="nik"
                class="form-control custom-input"
                placeholder="Masukkan 16 digit NIK"
                id="nik">
                </div>

                <div class="col-md-6">
                    <label>No RM</label>
                    <input 
                        type="text"
                        name="no_rm"
                        class="form-control custom-input"
                        placeholder="Masukkan No RM"
                        id="no_rm">
                </div>
                <div class="col-md-6">
                    <label>Nama Pasien</label>
                    <input name="nama_pasien" type="text" class="form-control custom-input" placeholder="Nama sesuai KTP" id="nama">
                </div>

                <div class="col-md-6">
                <label>Tanggal Lahir</label>
                <input 
                    name="tgl_lahir"
                    type="date"
                    class="form-control custom-input"
                    id="tgl_lahir">
                </div>

                <div class="col-md-6">
                    <label>Tanggal Kunjungan</label>
                    <input 
                        name="tgl_kunjungan"
                        type="date"
                        class="form-control custom-input"
                        id="tanggal">
                </div>

                <div class="col-md-6">
                    <label>Jenis Kelamin</label><br>
                    <input type="radio" name="jenis_kelamin" value="1"> Laki-laki
                    <input type="radio" name="jenis_kelamin" value="2"> Perempuan
                </div>

                <div class="col-md-6">
                    <label>Usia</label>
                    <input name="umur" type="number" class="form-control custom-input" placeholder="Usia otomatis" id="usia" readonly>
                    <small id="labelUsia" class="text-muted mt-1 d-block"></small>
                </div>
                <div class="col-md-6">
                <label>Status Akhir</label>
                <select name="status_akhir" id="status_akhir" class="form-control">
                    <option value="">Pilih Status</option>
                    <option value="Pengobatan Lengkap">Pengobatan Lengkap</option>
                    <option value="Sembuh">Sembuh</option>
                    <option value="Meninggal">Meninggal</option>
                    <option value="Putus Berobat">Putus Berobat</option>
                    <option value="Pindah">Pindah</option>
                </select>
                </div>
                <div class="col-md-12">
                    <label>Catatan Klinis</label>
                    <textarea name="ctt_klinis" class="form-control custom-input" placeholder="Masukkan catatan..." id="catatan"></textarea>
                </div>

            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn-next" onclick="prevStep(1)">← Kembali</button>
                <button type="button" class="btn-next" onclick="nextStep(3)">Lanjut →</button>
            </div>

        </div>

    </div>

</div>

</div>

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
        <div class="text-center py-4">
            <canvas id="usiaChart" height="180"></canvas>

            <p class="text-muted mb-0">
                Kategori usia pasien otomatis
            </p>

        </div>

    </div>

    <!-- KANAN (SUMMARY + FORM) -->
    <div class="col-md-8">

        <div class="card-summary">

            <h6 class="fw-bold mb-3">Ringkasan Laporan Kasus</h6>

            <!-- DATA -->
        <div class="row mb-2">
            <div class="col-4 text-muted">NIK</div>
            <div class="col-1 text-center">:</div>
            <div class="col-7 fw-semibold" id="sumNik">-</div>
        </div>
        <div class="row mb-2">
            <div class="col-4 text-muted">No RM</div>
            <div class="col-1 text-center">:</div>
            <div class="col-7 fw-semibold" id="sumRM">-</div>
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
        <div class="col-7 fw-semibold" id="sumLahir">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Tanggal Kunjungan</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumTanggal">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Usia</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumUsia">-</div>
    </div>

    <div class="row mb-2">
        <div class="col-4 text-muted">Status</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumStatus">-</div>
    </div>

    <div class="row mb-3">
        <div class="col-4 text-muted">Catatan</div>
        <div class="col-1 text-center">:</div>
        <div class="col-7 fw-semibold" id="sumCatatan">-</div>
    </div>

    <!-- CHECK -->
    <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" id="confirm">
        <label class="form-check-label">
            Saya mengonfirmasi data benar
        </label>
    </div>

</div>

            <!-- FORM SUBMIT -->
            <form id="formPasien" action="<?= base_url('tbc/store') ?>" method="post" onsubmit="return submitData()">

                <input type="hidden" name="provinsi" id="formProvinsi">
                <input type="hidden" name="kabupaten" id="formKabupaten">
                <input type="hidden" name="kecamatan" id="formKecamatan">
                <input type="hidden" name="desa" id="formDesa">
                <input type="hidden" name="rt" id="formRT">
                <input type="hidden" name="rw" id="formRW">
                <input type="hidden" name="alamat" id="formAlamat">
                <input type="hidden" name="lat" id="formLat">
                <input type="hidden" name="id_wilayah" id="formWilayah">
                <input type="hidden" name="id_petugas" id="formPetugas" value="3">

                <input type="hidden" name="nama_pasien" id="formNama">
                <input type="hidden" name="tgl_kunjungan" id="formTanggal">
                <input type="hidden" name="tanggal_lahir" id="formLahir">
                <input type="hidden" name="umur" id="formUsia">
                <input type="hidden" id="formStatus" name="status_akhir">
                <input type="hidden" name="ctt_klinis" id="formCatatan">
                <input type="hidden" name="jenis_kelamin" id="formJK">
                <input type="hidden" name="nik" id="formNik">
                <input type="hidden" name="no_rm" id="formRM">

                <div class="d-flex justify-content-between align-items-center mt-4">


                    <div class="d-flex justify-content-end gap-3 mt-4 w-100">
    <button type="button" class="btn-next" onclick="prevStep(2)">← ubah data</button>
    <button type="submit" class="btn-next">Simpan</button>
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

    // VALIDASI STEP 1
    if(step === 2){

        let kosong = [];

        if(document.getElementById('rt').value.trim() == ''){
            kosong.push('RT');
        }

        if(document.getElementById('rw').value.trim() == ''){
            kosong.push('RW');
        }

        if(document.getElementById('alamat').value.trim() == ''){
            kosong.push('Alamat Lengkap');
        }

        if(kosong.length > 0){

            document.getElementById('popupGagalText').innerText =
            'Kolom ' + kosong.join(', ') + ' wajib diisi';

            document.getElementById('popupGagal').style.display = 'flex';

            return;
        }

    }
    // VALIDASI STEP 2
    if(step === 3){

    let kosong = [];

        if(document.getElementById('nik').value.trim() == ''){
            kosong.push('NIK');
        }

        if(document.getElementById('nik').value.length != 16){
            kosong.push('NIK harus 16 digit');
        }

        if(document.getElementById('no_rm').value.trim() == ''){
            kosong.push('No RM');
        }

        if(document.getElementById('nama').value.trim() == ''){
            kosong.push('Nama Pasien');
        }

        if(document.getElementById('tgl_lahir').value.trim() == ''){
            kosong.push('Tanggal Lahir');
        }

        if(document.getElementById('tanggal').value.trim() == ''){
            kosong.push('Tanggal Kunjungan');
        }

        if(document.getElementById('usia').value.trim() == ''){
            kosong.push('Usia');
        }

        if(document.getElementById('status_akhir').value.trim() == ''){
            kosong.push('Status Akhir');
        }

        if(document.getElementById('catatan').value.trim() == ''){
            kosong.push('Catatan Klinis');
        }

        if(!document.querySelector('input[name="jenis_kelamin"]:checked')){
            kosong.push('Jenis Kelamin');
        }

        if(kosong.length > 0){

            document.getElementById('popupGagalText').innerText =
            'Kolom ' + kosong.join(', ') + ' wajib diisi';

            document.getElementById('popupGagal').style.display = 'flex';

            return false;;
        }

        if(!document.querySelector('input[name="jenis_kelamin"]:checked')){
            alert('Pilih jenis kelamin');
            return false;;
        }

    }

    // PINDAH STEP
    document.getElementById('step1').style.display='none';
    document.getElementById('step2').style.display='none';
    document.getElementById('step3').style.display='none';

    document.getElementById('step'+step).style.display='block';

    // UPDATE NAV
    document.getElementById('stepNav1').classList.remove('active');
    document.getElementById('stepNav2').classList.remove('active');
    document.getElementById('stepNav3').classList.remove('active');

    document.getElementById('stepNav'+step).classList.add('active');

    // AUTO ISI RINGKASAN
    if(step === 3){
        let nik = document.getElementById('nik').value;
        let rm = document.getElementById('no_rm').value;
        let nama = document.getElementById('nama').value;
        let prov = document.getElementById('provinsi').value;
        let kab = document.getElementById('kabupaten').value;
        let kec = document.getElementById('kecamatan').value;
        let desa = document.getElementById('desa').options[document.getElementById('desa').selectedIndex].text;
        let rt = document.getElementById('rt').value;
        let rw = document.getElementById('rw').value;
        let alamat = document.getElementById('alamat').value;

        let tanggalLahir = document.getElementById('tgl_lahir').value;
        let tanggal = document.getElementById('tanggal').value;
        let usia = document.getElementById('usia').value;
        let status = document.getElementById('status_akhir').value;
        let catatan = document.getElementById('catatan').value;

        let jk = document.querySelector('input[name="jenis_kelamin"]:checked');
        jk = jk ? (jk.value == '1' ? 'Laki-laki' : 'Perempuan') : '-';
        document.getElementById('sumNik').innerText = nik;
        document.getElementById('sumRM').innerText = rm;
        document.getElementById('sumNama').innerText = nama;

        document.getElementById('sumAlamat').innerText =
            prov + ', ' + kab + ', ' + kec + ', ' + desa +
            ' RT ' + rt + ' RW ' + rw + ' - ' + alamat;

        document.getElementById('sumJK').innerText = jk;
        document.getElementById('sumLahir').innerText = tanggalLahir;
        let usiaEl = document.getElementById('usia');
        let usiaLabel = usiaEl.dataset.label || usiaEl.value + ' tahun';
        document.getElementById('sumUsia').innerText = usiaLabel;
        document.getElementById('sumStatus').innerText = status;
        document.getElementById('sumTanggal').innerText = tanggal;
        document.getElementById('sumCatatan').innerText = catatan;

        setTimeout(() => {
        usiaChart.resize();
        usiaChart.update();
    }, 100);
    }

}

// ===== SUBMIT =====
function submitData(){
    if(!document.getElementById('confirm').checked){
        document.getElementById('popupGagalText').innerText = 'Silakan centang konfirmasi data terlebih dahulu';
        document.getElementById('popupGagal').style.display = 'flex';
        return false;
    }

    // STEP 1
    document.getElementById('formProvinsi').value = document.getElementById('provinsi').value;
    document.getElementById('formKabupaten').value = document.getElementById('kabupaten').value;
    document.getElementById('formKecamatan').value = document.getElementById('kecamatan').value;
    document.getElementById('formDesa').value = document.getElementById('desa').value;
    document.getElementById('formRT').value = document.getElementById('rt').value;
    document.getElementById('formRW').value = document.getElementById('rw').value;
    document.getElementById('formAlamat').value = document.getElementById('alamat').value;
    document.getElementById('formLat').value = document.getElementById('lat').value;
    document.getElementById('formWilayah').value = document.getElementById('desa').value;

    // STEP 2
    document.getElementById('formNik').value = document.getElementById('nik').value;
    document.getElementById('formRM').value = document.getElementById('no_rm').value;
    document.getElementById('formNama').value = document.getElementById('nama').value;
    document.getElementById('formTanggal').value = document.getElementById('tanggal').value;
    document.getElementById('formLahir').value = document.getElementById('tgl_lahir').value;
    document.getElementById('formUsia').value = document.getElementById('usia').value;
    document.getElementById('formStatus').value = document.getElementById('status_akhir').value;
    document.getElementById('formCatatan').value = document.getElementById('catatan').value;

    let jk = document.querySelector('input[name="jenis_kelamin"]:checked');
    document.getElementById('formJK').value = jk ? jk.value : '';

    // SUBMIT LANGSUNG TANPA POPUP DULU
    document.getElementById('formPasien').submit();
    return false; // cegah double submit
}
        function closePopup(){
            document.getElementById('popupSuccess').style.display = 'none';
        }
        document.getElementById('tgl_lahir').addEventListener('change', function(){

    let lahir = new Date(this.value);
    let today = new Date();

    let tahun = today.getFullYear() - lahir.getFullYear();
    let bulan = today.getMonth() - lahir.getMonth();

    if(today.getDate() < lahir.getDate()) bulan--;
    if(bulan < 0){ tahun--; bulan += 12; }

    let totalBulan = (tahun * 12) + bulan;
    let labelUsia, nilaiUsia;

    if(totalBulan === 0){
        labelUsia = 'Kurang dari 1 bulan';
        nilaiUsia = 0;
    } else if(totalBulan < 12){
        labelUsia = totalBulan + ' bulan';
        nilaiUsia = 0;
    } else {
        labelUsia = tahun + ' tahun';
        nilaiUsia = tahun;
    }

    if(totalBulan < 12){
    // tampilkan teks bulan langsung di input
    document.getElementById('usia').removeAttribute('type');
    document.getElementById('usia').setAttribute('type', 'text');
    document.getElementById('usia').value = labelUsia; // "2 bulan"
} else {
    document.getElementById('usia').setAttribute('type', 'number');
    document.getElementById('usia').value = tahun;
}
document.getElementById('usia').dataset.label = labelUsia;
document.getElementById('labelUsia').innerText = ''; // sembunyikan label bawah


    // update chart step 3
    let dataBar = [0,0,0,0,0];
    if(totalBulan < 12 || tahun <= 4)   dataBar = [1,0,0,0,0];
    else if(tahun <= 9)                  dataBar = [0,1,0,0,0];
    else if(tahun <= 18)                 dataBar = [0,0,1,0,0];
    else if(tahun <= 59)                 dataBar = [0,0,0,1,0];
    else                                 dataBar = [0,0,0,0,1];

    usiaChart.data.datasets[0].data = dataBar;
    usiaChart.update();
});

function closePopupGagal(){
    document.getElementById('popupGagal').style.display = 'none';
}

// ===== INISIALISASI CHART USIA =====
const ctxUsia = document.getElementById('usiaChart');

const usiaChart = new Chart(ctxUsia, {
    type: 'bar',
    data: {
        labels: ['Balita\n(0-4)', 'Anak-anak\n(5-9)', 'Remaja\n(10-18)', 'Dewasa\n(19-59)', 'Lansia\n(60+)'],
        datasets: [{
            data: [0,0,0,0,0],
            backgroundColor: ['#7ED7C1','#65B741','#FFD166','#3AA6B9','#2F4858'],
            borderRadius: 12
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});
</script>
    
<!-- POPUP GAGAL -->
<div class="popup" id="popupGagal">

    <div class="popup-box">

        <div style="
            width:80px;
            height:80px;
            background:#ffeaea;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            font-size:40px;
            color:#ff4d4f;
            margin-bottom:15px;
        ">
            ✕
        </div>

        <h3 style="font-weight:700;">Gagal</h3>

        <p id="popupGagalText">
            Data belum lengkap
        </p>

        <button class="btn-next" onclick="closePopupGagal()">
            OK
        </button>

    </div>

</div>
<?= $this->endSection() ?>