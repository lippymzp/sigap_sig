<?= $this->extend('layout/dashboard_layout_pneumonia_admin') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.export-wrapper{
    padding:20px;
}

.top-filter-card,
.export-card,
.preview-card{
    background:#EAF4F4;
    border-radius:22px;
    padding:24px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

.top-filter-card{
    margin-bottom:20px;
}

.filter-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.filter-box label{
    display:block;

    font-family:'Poppins', sans-serif;
    font-size:16px;
    font-weight:700;

    color:#111;

    margin-bottom:12px;
}

.custom-select{
    width:100%;
    height:46px;
    border:none;
    border-radius:12px;
    background:white;
    padding:0 15px;
    font-size:14px;
}

.export-content-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:20px;
    align-items:stretch;
}

.date-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
}

.preset-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:12px;
    margin-top:15px;
}

.preset-btn{

    width:100%;
    height:58px;

    border:none;
    border-radius:14px;

    background:white;
    color:#111;

    font-family:'Poppins', sans-serif;
    font-size:14px;
    font-weight:600;

    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;

    line-height:1.3;

    transition:0.3s;
}

.preset-btn:hover{
    background:#169fa5;
    color:white;
    transform:translateY(-2px);
}

.preset-btn.active{
    background:#20B8BE;
    color:white;
    font-weight:600;
}

.bottom-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
    margin-top:20px;
}

.small-card{
    min-height:250px;
}

.check-list{
    display:flex;
    flex-direction:column;
    gap:15px;
    margin-top:20px;
}

.check-item{
    background:white;
    border-radius:10px;
    font-weight:500;
    padding:12px;
    display:flex;
    gap:10px;
    align-items:center;
}

.file-grid{
    display:flex;

    justify-content:center;
    align-items:center;

    gap:20px;

    margin-top:20px;
}

.file-box{
    width:120px;
    height:140px;

    background:white;
    border-radius:18px;

    padding:20px;

    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;

    text-align:center;
}

.file-box i{
    font-size:42px;
}

.fa-file-excel{
    color:#1D6F42;
}

.fa-file-pdf{
    color:#E53935;
}

.file-box span{
    display:block;
    margin-top:10px;
    font-weight:600;
}

.action-btn{
    width:100%;
    margin-top:20px;
    border:none;
    border-radius:14px;
    background:linear-gradient(135deg,#14B8C8,#5FD7DE);

    color:#fff !important;

    height:46px;
    font-weight:600;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
}

.action-btn i{
    color:#fff !important;
}

.preview-card{
    height:100%;
    display:flex;
    flex-direction:column;
}

.preview-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.preview-btn{
    border:none;
    background:#DDF8F9;
    border-radius:10px;
    padding:8px 14px;
    font-size:12px;
}

.preview-body{

    flex:1;

    background:white;
    border-radius:16px;

    overflow:hidden;

    padding:15px;

    text-align:center;

    height:700px;
}

.preview-body img{
    width:100%;
    border-radius:10px;
}

.file-option input{
    display:none;
}

.file-option{
    cursor:pointer;
}

.file-option .file-box{
    transition:0.3s;
    border:2px solid transparent;
}

.file-option input:checked + .file-box{
    border:2px solid #20B8BE;
    background:#E8FFFF;
    transform:translateY(-3px);
    box-shadow:0 6px 14px rgba(0,0,0,0.1);
}

/* =========================
   TITLE STYLE GLOBAL
========================= */
.export-wrapper h3,
.export-wrapper h4,
.export-wrapper h5,
.filter-box label{

    font-family:'Poppins', sans-serif;
    font-weight:700;
    font-size:18px;
    color:#111;

}

/* =========================
   CONSISTENT TEXT STYLE
========================= */

.preset-btn,
.check-item,
.file-box span,
.action-btn,
.preview-btn,
.custom-select{

    font-family:'Poppins', sans-serif;
    font-size:15px;
    font-weight:500;
    color:#111;

}

.hidden-preview{
    display:none;
}
</style>

<div class="export-wrapper">

    <!-- TOP FILTER -->
    <div class="top-filter-card">

        <div class="filter-grid">

            <!-- KELURAHAN -->
            <div class="filter-box">
                <label>Wilayah Kelurahan</label>

                <select id="kelurahan" class="custom-select">
                    <option value="">Semua Kelurahan</option>
                    <option value="Ajung">Ajung</option>
                    <option value="Klompangan">Klompangan</option>
                    <option value="Mangaran">Mangaran</option>
                    <option value="Pancakarya">Pancakarya</option>
                    <option value="Rowoindah">Rowoindah</option>
                    <option value="Sukamakmur">Sukamakmur</option>
                    <option value="Wirowongso">Wirowongso</option>
                </select>
            </div>

            <!-- PUSKESMAS -->
            <div class="filter-box">
                <label>Fasilitas Kesehatan</label>

                <select class="custom-select">
                    <option>Puskesmas Ajung</option>
                </select>
            </div>

            <!-- PENYAKIT -->
            <div class="filter-box">
                <label>Jenis Penyakit</label>

                <select class="custom-select">
                    <option>Pneumonia</option>
                </select>
            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="export-content-grid">

        <!-- LEFT -->
        <div class="left-export">

            <!-- TANGGAL -->
            <div class="export-card">

                <h5>Rentang Tanggal</h5>

                <div class="date-grid">

                    <input type="date" id="startDate" class="custom-select">
                    <input type="date" id="endDate" class="custom-select">

                </div>

                <h5 class="mt-4">Preset Waktu</h5>

                <div class="preset-grid">

                    <button class="preset-btn" onclick="setPreset(7)">
                        7 Hari Terakhir
                    </button>

                    <button class="preset-btn" onclick="setPreset(30)">
                        30 Hari Terakhir
                    </button>

                    <button class="preset-btn" onclick="setPreset(90)">
                        3 Bulan Terakhir
                    </button>

                    <button class="preset-btn" onclick="setPreset(180)">
                        6 Bulan Terakhir
                    </button>

                    <button class="preset-btn" onclick="setPreset(365)">
                        1 Tahun Terakhir
                    </button>

                </div>

            </div>

            <!-- DATA + FILE -->
            <div class="bottom-grid">

                <!-- JENIS DATA -->
                <div class="export-card small-card">

                    <h5>Pilih Jenis Data</h5>

                    <div class="check-list">

                        <label class="check-item">
                            <input type="radio" name="jenisData" value="kasus" checked>
                            Data Kasus
                        </label>

                        <label class="check-item">
                            <input type="radio" name="jenisData" value="pegawai">
                            Data Pegawai
                        </label>

                    </div>

                </div>

                <!-- FORMAT -->
                <div class="export-card small-card">

                    <h5>Pilih Format File</h5>

                    <div class="file-grid">

                            <label class="file-option">

                                <input
                                    type="radio"
                                    name="fileType"
                                    value="excel"
                                >

                                <div class="file-box">
                                    <i class="fa-solid fa-file-excel"></i>
                                    <span>Excel</span>
                                </div>

                            </label>

                            <label class="file-option">

                                <input
                                    type="radio"
                                    name="fileType"
                                    value="pdf"
                                >

                                <div class="file-box">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    <span>PDF</span>
                                </div>

                            </label>
                        </div>

                    <button class="action-btn" onclick="downloadData()">
                        <i class="fa fa-download"></i>
                        Unduh Data
                    </button>

                    </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="preview-card" id="previewCard">

            <div class="preview-header">

                <h5>Preview Laporan</h5>

                <button
                    class="preview-btn"
                    onclick="window.open('<?= base_url('pneumonia/preview-export') ?>')"
                >
                    Preview Lengkap
                </button>

            </div>

            <div class="preview-body" id="previewBody">

                <iframe
                    id="pdfPreview"
                    src="<?= base_url('pneumonia/preview-export') ?>"
                    width="100%"
                    height="100%"
                    style="
                        border:none;
                        border-radius:12px;
                        background:white;
                    "
                ></iframe>

            </div>

        </div>

    </div>

</div>

<script>
function setPreset(days){

    document.querySelectorAll('.preset-btn')
    .forEach(btn => {
        btn.classList.remove('active');
    });

    event.target.classList.add('active');

    let end = new Date();
    let start = new Date();

    start.setDate(end.getDate() - days);

    let format = (date) => {
        return date.toISOString().split('T')[0];
    };

    document.getElementById('startDate').value = format(start);
    document.getElementById('endDate').value = format(end);
    updatePreview();
}

function updatePreview(){

    let previewBody =
    document.getElementById('previewBody');

    let kelurahan =
        document.getElementById('kelurahan').value;

    let startDate =
        document.getElementById('startDate').value;

    let endDate =
        document.getElementById('endDate').value;

    let jenisData =
        document.querySelector(
            'input[name=\"jenisData\"]:checked'
        ).value;

    let selectedFile =
        document.querySelector(
            'input[name=\"fileType\"]:checked'
        );

    let fileType =
        selectedFile
        ? selectedFile.value
        : '';

    let url =
    `<?= base_url('pneumonia/preview-export') ?>?kelurahan=${kelurahan}&startDate=${startDate}&endDate=${endDate}&jenisData=${jenisData}&fileType=${fileType}`;

    if(fileType !== 'pdf'){

        previewBody.innerHTML = `
            <div style="
                height:100%;
                display:flex;
                align-items:center;
                justify-content:center;
                font-family:Poppins,sans-serif;
                color:#999;
                font-size:15px;
            ">
                Pilih format PDF untuk melihat preview
            </div>
        `;

        return;
    }

    previewBody.innerHTML = `
        <iframe
            id="pdfPreview"
            src="${url}"
            width="100%"
            height="100%"
            style="
                border:none;
                border-radius:12px;
                background:white;
            "
        ></iframe>
    `;
}

document
.getElementById('kelurahan')
.addEventListener('change', updatePreview);

document
.getElementById('startDate')
.addEventListener('change', updatePreview);

document
.getElementById('endDate')
.addEventListener('change', updatePreview);

document
.querySelectorAll(
    'input[name="jenisData"], input[name="fileType"]'
)
.forEach(el => {

    el.addEventListener('change', () => {

        toggleTanggal();

        setTimeout(() => {

            updatePreview();

        }, 50);

    });

});

function downloadData(){

    let kelurahan = document.getElementById('kelurahan').value;

    let startDate = document.getElementById('startDate').value;
    let endDate = document.getElementById('endDate').value;

    let jenisData = document.querySelector('input[name="jenisData"]:checked').value;

    let selectedFile =
        document.querySelector(
            'input[name="fileType"]:checked'
        );

    if(!selectedFile){

        alert('Pilih format file terlebih dahulu');

        return;
    }

    let fileType = selectedFile.value;

    let url = `<?= base_url('pneumonia/export_hasil_data_pasien') ?>?kelurahan=${kelurahan}&startDate=${startDate}&endDate=${endDate}&jenisData=${jenisData}&fileType=${fileType}`;

    window.location.href = url;
}

function toggleTanggal(){

    let jenisData =
        document.querySelector(
            'input[name="jenisData"]:checked'
        ).value;

    let startDate =
        document.getElementById('startDate');

    let endDate =
        document.getElementById('endDate');

    let presetButtons =
        document.querySelectorAll('.preset-btn');

    let kelurahan =
        document.getElementById('kelurahan');

    if(jenisData === 'pegawai'){

        startDate.value = '';
        endDate.value = '';

        startDate.disabled = true;
        endDate.disabled = true;

        startDate.style.background = '#F4F4F4';
        endDate.style.background = '#F4F4F4';

        startDate.style.color = '#999';
        endDate.style.color = '#999';

        kelurahan.disabled = true;
        kelurahan.style.background = '#F4F4F4';
        kelurahan.style.color = '#999';
        kelurahan.style.cursor = 'not-allowed';

        startDate.style.cursor = 'not-allowed';
        endDate.style.cursor = 'not-allowed';

        startDate.style.opacity = '1';
        endDate.style.opacity = '1';

        presetButtons.forEach(btn => {
            btn.disabled = true;
            btn.style.opacity = '0.5';
            btn.style.cursor = 'not-allowed';
        });

    } else {

        startDate.disabled = false;
        endDate.disabled = false;

        startDate.style.background = '#fff';
        endDate.style.background = '#fff';

        startDate.style.color = '#000';
        endDate.style.color = '#000';

        kelurahan.disabled = false;
        kelurahan.style.background = '#fff';
        kelurahan.style.color = '#000';
        kelurahan.style.cursor = 'pointer';

        startDate.style.cursor = 'pointer';
        endDate.style.cursor = 'pointer';

        presetButtons.forEach(btn => {
            btn.disabled = false;
            btn.style.opacity = '1';
            btn.style.cursor = 'pointer';
        });
    }
}

toggleTanggal();
updatePreview();
</script>

<?= $this->endSection() ?>