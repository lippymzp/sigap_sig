<?= $this->extend('layout/dashboarddsing') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
body{
    background:#f7fbfb;
    font-family:'Poppins',sans-serif;
}

.section-card{
    background:#ffffff;
    border-radius:18px;
    padding:24px;
    box-shadow:0 6px 30px rgba(0,0,0,0.04);
}

.main-title{
    font-size:42px;
    font-weight:700;
    color:#1d1d1d;
    margin-bottom:20px;
}

.form-wrapper{
    background:#eaf6f6;
    border-radius:28px;
    padding:35px;
    min-height:720px;
}

.progress-wrap{
    display:flex;
    justify-content:center;
    gap:24px;
    margin-bottom:30px;
}

.progress-step{
    width:260px;
    text-align:center;
}

.progress-bar-mini{
    width:100%;
    height:10px;
    border-radius:30px;
    background:#bdbdbd;
    margin-bottom:8px;
}

.progress-step.active .progress-bar-mini{
    background:#009fc5;
    box-shadow:0 0 10px rgba(0,159,197,.25);
}

.progress-step span{
    font-size:14px;
    font-weight:600;
    color:#8d8d8d;
}

.progress-step.active span{
    color:#111;
}

.subtitle{
    font-size:32px;
    font-weight:600;
    color:#1a1a1a;
    margin-bottom:18px;
}

.description{
    font-size:18px;
    color:#333;
    margin-bottom:26px;
}

.step-card{
    background:#f7fbfb;
    border-radius:24px;
    padding:26px;
    box-shadow:0 6px 24px rgba(0,0,0,.04);
}

.step-left{
    background:#eef7f7;
    border-radius:20px;
    padding:20px;
}

.step-label{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:20px;
    font-weight:600;
    color:#888;
}

.step-label.active{
    color:#111;
}

.step-circle{
    width:32px;
    height:32px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#d4d4d4;
    color:#fff;
    font-size:14px;
    font-weight:700;
}

.step-label.active .step-circle{
    background:#1b8be0;
}

.step-label.done .step-circle{
    background:#35b86a;
}

.form-label{
    font-size:14px;
    font-weight:600;
    color:#333;
    margin-bottom:6px;
}

.custom-input{
    height:50px;
    border-radius:12px;
    border:2px solid #dfe7e7;
    background:#fff;
    font-size:14px;
    padding:0 16px;
    box-shadow:none !important;
}

textarea.custom-input{
    height:92px;
    padding-top:14px;
    resize:none;
}

.map-box{
    border-radius:18px;
    overflow:hidden;
    border:2px solid #dceaea;
    height:310px;
}

#mapPreview{
    width:100%;
    height:100%;
}

.btn-next{
    background:linear-gradient(135deg,#00c6cf,#009dc3);
    color:#fff;
    border:none;
    height:50px;
    padding:0 28px;
    border-radius:30px;
    font-weight:700;
    transition:.25s;
}

.btn-next:hover{
    transform:translateY(-2px);
}

.summary-box{
    background:#fff;
    border-radius:24px;
    padding:28px;
    box-shadow:0 8px 30px rgba(0,0,0,.05);
}

.summary-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
    font-size:15px;
}

.summary-row span{
    color:#777;
}

.summary-row b{
    color:#111;
}

.link-action{
    text-decoration:none;
    font-weight:600;
    color:#2a73ff;
    display:block;
    margin-bottom:8px;
}

.btn-save{
    background:linear-gradient(135deg,#00c6cf,#009dc3);
    color:white;
    border:none;
    height:52px;
    padding:0 40px;
    border-radius:30px;
    font-weight:700;
}

.popup{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.45);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
}

.popup-box{
    background:white;
    width:360px;
    border-radius:22px;
    padding:30px;
    text-align:center;
}

.chart-box{
    background:#fff;
    border-radius:20px;
    padding:18px;
    text-align:center;
    box-shadow:0 6px 20px rgba(0,0,0,.05);
}

hr.soft{
    border:none;
    border-top:2px solid #dceaea;
    margin:22px 0;
}
</style>

<div class="section-card">

<h2 class="main-title">Input Data Pasien</h2>

<div class="form-wrapper">

<!-- PROGRESS -->
<div class="progress-wrap">
    <div class="progress-step active" id="stepNav1">
        <div class="progress-bar-mini"></div>
        <span>Step 1 : Lokasi Kasus</span>
    </div>

    <div class="progress-step" id="stepNav2">
        <div class="progress-bar-mini"></div>
        <span>Step 2 : Data Klinis</span>
    </div>

    <div class="progress-step" id="stepNav3">
        <div class="progress-bar-mini"></div>
        <span>Step 3 : Ringkasan & Kirim</span>
    </div>
</div>

<!-- STEP 1 -->
<div id="step1">

<h3 class="subtitle">Step 1 : Lokasi Kasus</h3>

<p class="description">
Mohon lengkapi detail kasus diare baru untuk pemetaan
</p>

<hr class="soft">

<div class="row g-4">

    <!-- LEFT -->
    <div class="col-md-7">

        <div class="step-card">

            <h5 class="fw-bold mb-4">📍 Data Lokasi</h5>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Pilih Provinsi</label>
                    <select class="form-control custom-input" id="provinsi">
                        <option>Jawa Timur</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pilih Kabupaten</label>
                    <select class="form-control custom-input" id="kabupaten">
                        <option>Jember</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pilih Kecamatan</label>
                    <select class="form-control custom-input" id="kecamatan">
                        <option>Panti</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pilih Desa</label>
                    <select class="form-control custom-input" id="desa">
                        <option>Serut</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">RT</label>
                    <input type="text" class="form-control custom-input" id="rt">
                </div>

                <div class="col-md-3">
                    <label class="form-label">RW</label>
                    <input type="text" class="form-control custom-input" id="rw">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Latitude</label>
                    <input type="text" class="form-control custom-input" id="lat">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Longitude</label>
                    <input type="text" class="form-control custom-input" id="lng">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control custom-input" id="alamat"></textarea>
                </div>

            </div>

            <div class="text-end mt-4">
                <button class="btn-next" onclick="nextStep(2)">
                    Lanjut ke Data Klinis →
                </button>
            </div>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="col-md-5">

        <div class="step-card">

            <h5 class="fw-bold mb-3 text-center">Preview Lokasi</h5>

            <div class="map-box">
                <div id="mapPreview"></div>
            </div>

            <small class="text-muted d-block text-center mt-3">
                Klik peta untuk memilih koordinat
            </small>

        </div>

    </div>

</div>

</div>
<!-- STEP 2 -->
<div id="step2" style="display:none;">

<h3 class="subtitle">Step 2 : Data Klinis</h3>

<p class="description">
Mohon lengkapi detail klinis pasien diare
</p>

<hr class="soft">

<div class="row g-4">

    <!-- SIDEBAR STEP -->
    <div class="col-md-4">

        <div class="step-left">

            <div class="step-label done">
                <div class="step-circle">✓</div>
                <span>Step 1 : Lokasi</span>
            </div>

            <div class="step-label active">
                <div class="step-circle">2</div>
                <span>Step 2 : Data Klinis</span>
            </div>

            <div class="step-label">
                <div class="step-circle">3</div>
                <span>Ringkasan & Kirim</span>
            </div>

        </div>

    </div>

    <!-- FORM -->
    <div class="col-md-8">

        <div class="summary-box">

            <h5 class="fw-bold mb-4">🩺 Data Klinis Pasien</h5>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">No. RM</label>
                    <input type="text" class="form-control custom-input" id="norm">
                </div>

                <div class="col-md-6">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control custom-input" id="nik" placeholder="16 digit NIK">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control custom-input" id="nama" placeholder="Nama sesuai KTP">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin</label>

                    <div class="d-flex gap-4 mt-2">
                        <label>
                            <input type="radio" name="jk" value="Laki-laki">
                            Laki-laki
                        </label>

                        <label>
                            <input type="radio" name="jk" value="Perempuan">
                            Perempuan
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control custom-input" id="tgl_lahir">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Kunjungan</label>
                    <input type="date" class="form-control custom-input" id="tanggal">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai Sakit</label>
                    <input type="date" class="form-control custom-input" id="tgl_sakit">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Diagnosa Diare</label>
                    <select class="form-control custom-input" id="diagnosa">
                        <option value="">Pilih Diagnosa</option>
                        <option>Akut</option>
                        <option>Kronis</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Derajat Dehidrasi</label>
                    <select class="form-control custom-input" id="dehidrasi">
                        <option value="">Pilih Derajat</option>
                        <option>Tanpa Dehidrasi</option>
                        <option>Dehidrasi Ringan</option>
                        <option>Dehidrasi Sedang</option>
                        <option>Dehidrasi Berat</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Oralit</label>
                    <input type="number" class="form-control custom-input" id="oralit">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Zinc</label>
                    <input type="number" class="form-control custom-input" id="zinc">
                </div>

                <div class="col-md-2">
                    <label class="form-label">RL</label>
                    <input type="number" class="form-control custom-input" id="rl">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Antibiotik</label>
                    <select class="form-control custom-input" id="antibiotik">
                        <option>Tidak</option>
                        <option>Ya</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status Kematian</label>
                    <select class="form-control custom-input" id="kematian">
                        <option>Tidak</option>
                        <option>Ya</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Konseling</label>
                    <select class="form-control custom-input" id="konseling">
                        <option>Tidak</option>
                        <option>Ya</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Catatan Klinis</label>
                    <textarea class="form-control custom-input" id="catatan"></textarea>
                </div>

            </div>

            <div class="d-flex justify-content-between mt-4">
                <button class="btn-next" onclick="nextStep(1)">
                    ← Kembali
                </button>

                <button class="btn-next" onclick="nextStep(3)">
                    Lanjut ke Ringkasan →
                </button>
            </div>

        </div>

    </div>

</div>

</div>
<!-- STEP 3 -->
<div id="step3" style="display:none;">

<h3 class="subtitle">Step 3 : Ringkasan & Kirim</h3>

<p class="description">
Periksa kembali data pasien sebelum disimpan
</p>

<hr class="soft">

<div class="row g-4">

    <!-- LEFT -->
    <div class="col-md-4">

        <div class="step-left mb-3">

            <div class="step-label done">
                <div class="step-circle">✓</div>
                <span>Step 1 : Lokasi</span>
            </div>

            <div class="step-label done">
                <div class="step-circle">✓</div>
                <span>Step 2 : Data Klinis</span>
            </div>

            <div class="step-label active">
                <div class="step-circle">3</div>
                <span>Ringkasan & Kirim</span>
            </div>

        </div>

        <div class="chart-box">
            <h6 class="fw-bold mb-3">Kelompok Usia Terbanyak</h6>
            <img src="<?= base_url('img/chart.png') ?>"
                 class="img-fluid rounded">
        </div>

    </div>

    <!-- RIGHT -->
    <div class="col-md-8">

        <div class="summary-box">

            <h5 class="fw-bold mb-4">Ringkasan Laporan Kasus</h5>

            <div class="summary-row">
                <span>No RM</span>
                <b id="sumNorm">-</b>
            </div>

            <div class="summary-row">
                <span>NIK</span>
                <b id="sumNik">-</b>
            </div>

            <div class="summary-row">
                <span>Nama</span>
                <b id="sumNama">-</b>
            </div>

            <div class="summary-row">
                <span>Jenis Kelamin</span>
                <b id="sumJK">-</b>
            </div>

            <div class="summary-row">
                <span>Tanggal Lahir</span>
                <b id="sumLahir">-</b>
            </div>

            <div class="summary-row">
                <span>Tanggal Kunjungan</span>
                <b id="sumTanggal">-</b>
            </div>

            <div class="summary-row">
                <span>Tanggal Sakit</span>
                <b id="sumSakit">-</b>
            </div>

            <div class="summary-row">
                <span>Alamat</span>
                <b id="sumAlamat">-</b>
            </div>

            <div class="summary-row">
                <span>Diagnosa</span>
                <b id="sumDiagnosa">-</b>
            </div>

            <div class="summary-row">
                <span>Dehidrasi</span>
                <b id="sumDehidrasi">-</b>
            </div>

            <div class="summary-row">
                <span>Oralit</span>
                <b id="sumOralit">-</b>
            </div>

            <div class="summary-row">
                <span>Zinc</span>
                <b id="sumZinc">-</b>
            </div>

            <div class="summary-row">
                <span>RL</span>
                <b id="sumRL">-</b>
            </div>

            <div class="summary-row">
                <span>Antibiotik</span>
                <b id="sumAntibiotik">-</b>
            </div>

            <div class="summary-row">
                <span>Catatan</span>
                <b id="sumCatatan">-</b>
            </div>

            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" id="confirm">
                <label class="form-check-label">
                    Saya mengonfirmasi bahwa data sudah benar
                </label>
            </div>

            <form action="<?= base_url('diare/simpan') ?>" method="post" onsubmit="return submitData()">

                <input type="hidden" name="nama_pasien" id="formNama">
                <input type="hidden" name="desa" id="formDesa">
                <input type="hidden" name="tanggal_kunjungan" id="formTanggal">
                <input type="hidden" name="diagnosis" id="formDiagnosis">
                <input type="hidden" name="jenis_kelamin" id="formJK">

                <div class="d-flex justify-content-between align-items-center mt-4">

                    <div>
                        <a href="#" class="link-action" onclick="nextStep(2)">✏️ Ubah Data</a>
                        <a href="#" class="link-action">💾 Simpan Draft</a>
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

</div>
</div>

<!-- POPUP -->
<div class="popup" id="popupSuccess">
    <div class="popup-box">
        <h4 class="fw-bold">Berhasil</h4>
        <p>Data berhasil disimpan.</p>
        <button class="btn-next" onclick="closePopup()">OK</button>
    </div>
</div>

<script>
function nextStep(step){

    ['step1','step2','step3'].forEach(id=>{
        document.getElementById(id).style.display='none';
    });

    ['stepNav1','stepNav2','stepNav3'].forEach(id=>{
        document.getElementById(id).classList.remove('active');
    });

    document.getElementById('step'+step).style.display='block';
    document.getElementById('stepNav'+step).classList.add('active');

    if(step===3){

        let prov = document.getElementById('provinsi').value;
        let kab = document.getElementById('kabupaten').value;
        let kec = document.getElementById('kecamatan').value;
        let desa = document.getElementById('desa').value;
        let rt = document.getElementById('rt').value;
        let rw = document.getElementById('rw').value;
        let alamat = document.getElementById('alamat').value;

        let jk = document.querySelector('input[name="jk"]:checked');
        jk = jk ? jk.value : '-';

        document.getElementById('sumNorm').innerText = document.getElementById('norm').value;
        document.getElementById('sumNik').innerText = document.getElementById('nik').value;
        document.getElementById('sumNama').innerText = document.getElementById('nama').value;
        document.getElementById('sumJK').innerText = jk;
        document.getElementById('sumLahir').innerText = document.getElementById('tgl_lahir').value;
        document.getElementById('sumTanggal').innerText = document.getElementById('tanggal').value;
        document.getElementById('sumSakit').innerText = document.getElementById('tgl_sakit').value;
        document.getElementById('sumDiagnosa').innerText = document.getElementById('diagnosa').value;
        document.getElementById('sumDehidrasi').innerText = document.getElementById('dehidrasi').value;
        document.getElementById('sumOralit').innerText = document.getElementById('oralit').value;
        document.getElementById('sumZinc').innerText = document.getElementById('zinc').value;
        document.getElementById('sumRL').innerText = document.getElementById('rl').value;
        document.getElementById('sumAntibiotik').innerText = document.getElementById('antibiotik').value;
        document.getElementById('sumCatatan').innerText = document.getElementById('catatan').value;

        document.getElementById('sumAlamat').innerText =
            prov+', '+kab+', '+kec+', '+desa+' RT '+rt+' RW '+rw+' - '+alamat;
    }
}

function submitData(){

    if(!document.getElementById('confirm').checked){
        alert('Centang konfirmasi dulu bro');
        return false;
    }

    document.getElementById('formNama').value = document.getElementById('nama').value;
    document.getElementById('formDesa').value = document.getElementById('desa').value;
    document.getElementById('formTanggal').value = document.getElementById('tanggal').value;
    document.getElementById('formDiagnosis').value = document.getElementById('diagnosa').value;

    let jk = document.querySelector('input[name="jk"]:checked');
    document.getElementById('formJK').value = jk ? jk.value : '';

    document.getElementById('popupSuccess').style.display='flex';

    setTimeout(()=>{
        document.querySelector('form').submit();
    },1000);

    return false;
}

function closePopup(){
    document.getElementById('popupSuccess').style.display='none';
}

const map = L.map('mapPreview').setView([-8.1727, 113.7009], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

let selectedMarker = null;

function fixNama(nama){
    return (nama || "")
        .toLowerCase()
        .trim()
        .replace(/\s+/g, " ")
        .replace(/[^a-z0-9 ]/g, "");
}

fetch("<?= base_url('assets/peta/panti_6_desa.geojson') ?>")
.then(res => res.json())
.then(data => {

    const geoLayer = L.geoJSON(data, {

        style: function(feature){
            return {
                color:"#00CED1",
                weight:2,
                fillColor:"#bdf6f2",
                fillOpacity:0.65
            };
        },

        onEachFeature: function(feature, layer){

            const namaDesa = feature.properties.NAMOBJ || '';

            layer.bindPopup(`
                <b>Desa:</b> ${namaDesa}<br>
                Klik area ini untuk memilih lokasi
            `);

            layer.on('click', function(e){

                const center = layer.getBounds().getCenter();

                if(selectedMarker){
                    map.removeLayer(selectedMarker);
                }

                selectedMarker = L.marker(center).addTo(map);

                document.getElementById('lat').value =
                    center.lat.toFixed(6);

                document.getElementById('lng').value =
                    center.lng.toFixed(6);

                document.getElementById('desa').value = namaDesa;

                map.fitBounds(layer.getBounds());

            });

            layer.on('mouseover', function(){
                layer.setStyle({
                    fillColor:'#00c4c7',
                    fillOpacity:0.85
                });
            });

            layer.on('mouseout', function(){
                geoLayer.resetStyle(layer);
            });

        }

    }).addTo(map);

    map.fitBounds(geoLayer.getBounds());

});
map.on('click',function(e){

    const lat = e.latlng.lat.toFixed(6);
    const lng = e.latlng.lng.toFixed(6);

    marker.setLatLng(e.latlng);

    document.getElementById('lat').value=lat;
    document.getElementById('lng').value=lng;
});
</script>

<?= $this->endSection() ?>