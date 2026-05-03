<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.tab-filter {
    display: flex;
    gap: 10px;
    border: 1px solid #20B8BE;
    border-radius: 12px;
    overflow: hidden;
    width: fit-content;
}
.tab-filter button {
    padding: 10px 25px;
    border: none;
    background: transparent;
    color: #20B8BE;
    cursor: pointer;
}
.tab-filter button.active {
    background: #20B8BE;
    color: white;
}

.export-card {
    background: #ECF8F8;
    border-radius: 20px;
    padding: 30px;
    margin-top: 20px;
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

/* EXCEL */
.btn-export {
    background: #20B8BE;
    color: white;
}

.btn-export:hover {
    background: #169fa5;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
}


</style>

<div class="page-title mb-3">Eksport Data Pasien</div>

<!-- TAB -->
<div class="tab-filter mb-3">
    <button onclick="setMode('bulanan')" id="bulanan" class="active">BULANAN</button>
    <button onclick="setMode('triwulan')" id="triwulan">TRIWULAN</button>
    <button onclick="setMode('semester')" id="semester">SEMESTER</button>
    <button onclick="setMode('tahunan')" id="tahunan">TAHUNAN</button>
</div>

<div class="export-card">

    <!-- JANGKA WAKTU -->
    <div class="form-group">
        <label>Jangka Waktu</label>
        <select id="waktu" class="form-select"></select>
    </div>

    <!-- TAHUN -->
    <div class="form-group">
        <label>Tahun</label>
        <select id="tahun" class="form-select"></select>
    </div>

    <!-- KELURAHAN -->
    <div class="form-group">
        <label>Kelurahan</label>
        <select id="kelurahan" class="form-select">
            <option value="">Semua Kelurahan</option>
            <option>Sumbersari</option>
            <option>Antirogo</option>
            <option>Tegalgede</option>
            <option>Karangrejo</option>
            <option>Wirolegi</option>
        </select>
    </div>

    <!-- BUTTON -->
    <div class="d-flex justify-content-end mt-4 gap-3">
        <button onclick="exportData('excel')" class="btn-export">
            <i class="fas fa-file-excel"></i> Export Excel
        </button>

        <button onclick="exportData('pdf')" class="btn-export">
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
    let kel = document.getElementById('kelurahan').value;

    let url = `<?= base_url('dbd/export-hasil-data-pasien') ?>?type=${type}&mode=${mode}&tahun=${tahun}&waktu=${waktu}&kelurahan=${kel}`;
    window.location.href = url;
}

// init
loadWaktu();
</script>

<?= $this->endSection() ?>