<?= $this->extend('layout/dashboard_layout_kepala') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.tab-filter {
    display: flex;
    gap: 10px;
    border: 1px solid #00BBC2; /* Warna khas Kepala */
    border-radius: 12px;
    overflow: hidden;
    width: fit-content;
}
.tab-filter button {
    padding: 10px 25px;
    border: none;
    background: transparent;
    color: #00BBC2;
    cursor: pointer;
    font-weight: 600;
}
.tab-filter button.active {
    background: #00BBC2;
    color: white;
}

.export-card {
    background: #F4F8FA;
    border-radius: 20px;
    padding: 30px;
    margin-top: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.btn-export {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 10px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

/* WARNA BUTTON EXCEL & PDF */
.btn-export-excel {
    background: #00BBC2;
    color: white;
}
.btn-export-excel:hover {
    background: #009fa5;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
}

.btn-export-pdf {
    background: #e74c3c;
    color: white;
}
.btn-export-pdf:hover {
    background: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0" style="color: #2b2b2b; font-weight: 600;">Eksport Data Pasien</h4>
</div>

<div class="tab-filter mb-3">
    <button onclick="setMode('bulanan')" id="bulanan" class="active">BULANAN</button>
    <button onclick="setMode('triwulan')" id="triwulan">TRIWULAN</button>
    <button onclick="setMode('semester')" id="semester">SEMESTER</button>
    <button onclick="setMode('tahunan')" id="tahunan">TAHUNAN</button>
</div>

<div class="export-card">

    <div class="form-group mb-3">
        <label class="fw-bold mb-2">Jangka Waktu</label>
        <select id="waktu" class="form-select"></select>
    </div>

    <div class="form-group mb-3">
        <label class="fw-bold mb-2">Tahun</label>
        <select id="tahun" class="form-select"></select>
    </div>

    <div class="form-group mb-4">
        <label class="fw-bold mb-2">Kecamatan</label>
        <select id="kecamatan" class="form-select">
            <option value="">Semua Kecamatan</option>
            <option value="Sumbersari">Sumbersari</option>
            <option value="Patrang">Patrang</option>
            <option value="Kaliwates">Kaliwates</option>
        </select>
    </div>

    <div class="d-flex justify-content-end mt-4 gap-3">
        <button onclick="exportData('excel')" class="btn-export btn-export-excel">
            <i class="fas fa-file-excel"></i> Export Excel
        </button>

        <button onclick="exportData('pdf')" class="btn-export btn-export-pdf">
            <i class="fas fa-file-pdf"></i> Export PDF
        </button>
    </div>

</div>

<script>
let mode = 'bulanan';

function setMode(m) {
    mode = m;

    document.querySelectorAll('.tab-filter button').forEach(btn => btn.classList.remove('active'));
    document.getElementById(m).classList.add('active');

    loadWaktu();
}

function loadWaktu() {
    let select = document.getElementById('waktu');
    select.innerHTML = '';

    if (mode === 'bulanan') {
        let bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        bulan.forEach((b,i)=>{
            select.innerHTML += `<option value="${i+1}">${b}</option>`;
        });
    }
    else if (mode === 'triwulan') {
        ['Q1','Q2','Q3','Q4'].forEach((q,i)=>{
            select.innerHTML += `<option value="${i+1}">${q}</option>`;
        });
    }
    else if (mode === 'semester') {
        select.innerHTML = `
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
        `;
    }
    else {
        select.innerHTML = `<option value="">Semua Tahun</option>`;
    }
}

// LOAD TAHUN
fetch("<?= base_url('dbd/get-tahun-list') ?>")
.then(res=>res.json())
.then(data=>{
    let t = document.getElementById('tahun');
    data.forEach(d=>{
        t.innerHTML += `<option value="${d.tahun}">${d.tahun}</option>`;
    });
});

function exportData(type) {
    let tahun = document.getElementById('tahun').value;
    let waktu = document.getElementById('waktu').value;
    let kec = document.getElementById('kecamatan').value;

    // Pastikan URL controller mengarah ke fungsi export khusus kepala
    let url = `<?= base_url('dbd/export-hasil-data-kepala') ?>?type=${type}&mode=${mode}&tahun=${tahun}&waktu=${waktu}&kecamatan=${kec}`;
    window.location.href = url;
}

// init
loadWaktu();
</script>

<?= $this->endSection() ?>