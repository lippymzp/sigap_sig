<?php
$layout = $layout ?? 'layout/dashboard_layout_admin';
?>
<?= $this->extend($layout) ?>
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
    flex-wrap: wrap;
}

.tab-filter button {
    padding: 10px 25px;
    border: none;
    background: transparent;
    color: #20B8BE;
    cursor: pointer;
    transition: 0.2s;
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

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    margin-bottom: 8px;
    font-weight: 600;
    display: block;
}

.form-select {
    border-radius: 12px;
    padding: 10px;
    border: 1px solid #d6e4e5;
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

    background: #20B8BE;
    color: white;
}

.btn-export:hover {
    background: #169fa5;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
}

@media(max-width:768px){

    .tab-filter{
        width:100%;
    }

    .tab-filter button{
        flex:1;
        font-size:13px;
        padding:10px;
    }

    .export-card{
        padding:20px;
    }

    .d-flex.justify-content-end{
        flex-direction:column;
    }

    .btn-export{
        width:100%;
        justify-content:center;
    }
}
</style>

<!-- TAB -->
<div class="tab-filter mb-3">
    <button onclick="setMode('bulanan')" id="bulanan" class="active">
        BULANAN
    </button>

    <button onclick="setMode('triwulan')" id="triwulan">
        TRIWULAN
    </button>

    <button onclick="setMode('semester')" id="semester">
        SEMESTER
    </button>

    <button onclick="setMode('tahunan')" id="tahunan">
        TAHUNAN
    </button>
</div>

<div class="export-card">

    <!-- JANGKA WAKTU -->
    <div class="form-group" id="groupWaktu">
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
            <option value="semua">
                Semua Kelurahan
            </option>
            <option value="Sumbersari">
                Sumbersari
            </option>
            <option value="Antirogo">
                Antirogo
            </option>
            <option value="Tegalgede">
                Tegalgede
            </option>
            <option value="Karangrejo">
                Karangrejo
            </option>
            <option value="Wirolegi">
                Wirolegi
            </option>
        </select>
    </div>

    <!-- BUTTON -->
    <div class="d-flex justify-content-end mt-4 gap-3">

        <button onclick="exportData('excel')" class="btn-export">
            <i class="fas fa-file-excel"></i>
            Export Excel
        </button>

        <button onclick="exportData('pdf')" class="btn-export">
            <i class="fas fa-file-pdf"></i>
            Export PDF
        </button>

    </div>

</div>

<script>

let mode = 'bulanan';

// ======================
// SET MODE
// ======================
function setMode(m) {

    mode = m;

    // REMOVE ACTIVE
    document.querySelectorAll('.tab-filter button')
    .forEach(btn => btn.classList.remove('active'));

    // ACTIVE BUTTON
    document.getElementById(m)
    .classList.add('active');

    // ======================
    // SHOW / HIDE WAKTU
    // ======================

    if (mode === 'tahunan') {

        document.getElementById('groupWaktu')
        .style.display = 'none';

    } else {

        document.getElementById('groupWaktu')
        .style.display = 'block';
    }

    loadWaktu();
}

// ======================
// LOAD WAKTU
// ======================
function loadWaktu() {

    let select = document.getElementById('waktu');

    select.innerHTML = '';

    // DEFAULT
    select.innerHTML = `
        <option value="">
            -pilih waktu-
        </option>
    `;

    // ======================
    // BULANAN
    // ======================
    if (mode === 'bulanan') {

        let bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        bulan.forEach((b,i)=>{

            select.innerHTML += `
                <option value="${i+1}">
                    ${b}
                </option>
            `;
        });
    }

    // ======================
    // TRIWULAN
    // ======================
    else if (mode === 'triwulan') {

        select.innerHTML += `
            <option value="1">
                Q1 (Januari - Maret)
            </option>

            <option value="2">
                Q2 (April - Juni)
            </option>

            <option value="3">
                Q3 (Juli - September)
            </option>

            <option value="4">
                Q4 (Oktober - Desember)
            </option>
        `;
    }

    // ======================
    // SEMESTER
    // ======================
    else if (mode === 'semester') {

        select.innerHTML += `
            <option value="1">
                Semester 1 (Januari - Juni)
            </option>

            <option value="2">
                Semester 2 (Juli - Desember)
            </option>
        `;
    }

    // ======================
    // TAHUNAN
    // ======================
    else {

        select.innerHTML = '';
    }
}

// ======================
// LOAD TAHUN
// ======================
fetch("<?= base_url('dbd/get-tahun-list') ?>")

.then(res => res.json())

.then(data => {

    let t = document.getElementById('tahun');

    t.innerHTML = `
        <option value="">
            -pilih tahun-
        </option>
    `;

    data.forEach(d => {

        t.innerHTML += `
            <option value="${d.tahun}">
                ${d.tahun}
            </option>
        `;
    });

});

// ======================
// EXPORT
// ======================
function exportData(type) {

    let tahun = document.getElementById('tahun').value;
    let waktu = document.getElementById('waktu').value;
    let kel = document.getElementById('kelurahan').value;

    let url =
    `<?= base_url('dbd/export-hasil-data-pasien') ?>?type=${type}&mode=${mode}&tahun=${tahun}&waktu=${waktu}&kelurahan=${kel}`;

    window.location.href = url;
}

// ======================
// INIT
// ======================
loadWaktu();

</script>

<?= $this->endSection() ?>