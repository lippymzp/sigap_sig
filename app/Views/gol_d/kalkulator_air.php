<?= $this->include('layout/header') ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

*,
*::before,
*::after{
    font-family:'Poppins',sans-serif !important;
}

body{
    background:#f4f4f4;
    font-family:'Poppins',sans-serif !important;
}

input,
select,
button,
textarea,
label,
option,
.form-control,
.form-select,
.btn{
    font-family:'Poppins',sans-serif !important;
}

.kalkulator-wrap{
    max-width:1200px;
    margin:40px auto;
}

.panel{
    background:#eaf2f2;
    border-radius:25px;
    padding:30px;
}

.result{
    background:#12BCC7;
    color:white;
    border-radius:25px;
    padding:30px;
}

.big-number{
    font-size:72px;
    font-weight:800;
}

.btn-calc{
    background:#12BCC7;
    color:white;
    border:none;
    width:100%;
    padding:16px;
    border-radius:16px;
    font-weight:700;
}
.mode-switch{
    display:flex;
    gap:10px;
}

.mode-btn{
    flex:1;
    border:none;
    padding:14px;
    border-radius:14px;
    font-weight:700;
    background:#dbeeee;
    color:#0f3b3f;
    transition:.3s;
}

.mode-btn.active{
    background:#12BCC7;
    color:white;
}
</style>

<div class="container kalkulator-wrap">
<div class="row g-4">

<div class="col-md-5">
<div class="panel">
<div class="mode-switch mb-4">
   <button
type="button"
class="mode-btn <?= (($mode ?? 'who') === 'who') ? 'active' : '' ?>"
onclick="showMode('who')">  
        💧 Rehidrasi WHO
    </button>

   <button
type="button"
class="mode-btn <?= (($mode ?? 'who') === 'normal') ? 'active' : '' ?>"
onclick="showMode('normal')">
        🥤 Air Harian
    </button>
</div>
<form action="<?= base_url('diare/hitung-air') ?>" method="post">
    <input type="hidden" name="mode" id="mode" value="who">



<div class="row">
    <div class="col-6">
        <label>Usia</label>
        <input type="number" class="form-control" name="usia">
    </div>

    <div class="col-6">
        <label>Berat</label>
        <input type="number" class="form-control" name="berat">
    </div>
</div>

  <div id="whoForm" style="<?= (($mode ?? 'who') === 'normal') ? 'display:none;' : '' ?>">

    <h4 class="mb-4">Kalkulator Rehidrasi WHO</h4>

    <label>Berat Badan (kg)</label>
    <input
        type="number"
        step="0.1"
        class="form-control mb-3"
        name="berat"
    >

    <label>Tingkat Dehidrasi</label>
    <select class="form-control mb-4" name="dehidrasi">
        <option value="">Pilih Tingkat Dehidrasi</option>
        <option value="3">Ringan (3%)</option>
        <option value="6">Sedang (6%)</option>
        <option value="9">Berat (9%)</option>
    </select>

</div>

<div id="normalForm" style="<?= (($mode ?? 'who') === 'normal') ? 'display:block;' : 'display:none;' ?>">

    <h4 class="mb-4">Kebutuhan Air Harian</h4>

    <label>Jenis Kelamin</label>
    <select class="form-control mb-3" name="jk">
        <option>Laki-laki</option>
        <option>Perempuan</option>
    </select>

    <label>Usia</label>
    <input type="number" class="form-control mb-3" name="usia">

    <label>Berat Badan (kg)</label>
    <input type="number" step="0.1" class="form-control mb-3" name="berat_normal">

    <label>Tingkat Aktivitas</label>
    <input type="range" name="aktivitas" class="form-range" min="0" max="100">

</div>
   <button class="btn-calc">
    Hitung Sekarang
</button>


</form>

</div>
</div>

<div class="col-md-7">

<div class="result">
    <h4>Estimasi Total Kebutuhan Air</h4>

    <div class="big-number">
    <?= isset($hasil) ? $hasil : '--' ?>
     <?php if(($mode ?? 'who') === 'who'): ?>

<div class="mt-4 p-3 rounded" style="background:rgba(255,255,255,.15)">
    <h5>Rincian Perhitungan WHO</h5>

    <p>Bolus: <?= $bolus ?? 0 ?> mL</p>
    <p>Defisit Cairan: <?= $defisit ?? 0 ?> mL</p>
    <p>Maintenance: <?= $maintenance ?? 0 ?> mL/jam</p>
    <p><b>Laju Infus: <?= $perjam ?? 0 ?> mL/jam</b></p>
</div>

<?php else: ?>

<div class="mt-4 p-3 rounded" style="background:rgba(255,255,255,.15)">
    <h5>Rincian Kebutuhan Air Harian</h5>
    <p>Perhitungan berdasarkan berat badan & aktivitas harian.</p>
</div>

<?php endif; ?>
   <?= isset($hasil) ? '<span style="font-size:10px;">mL</span>' : '' ?>
    </div>

    <div class="mt-4 p-3 rounded" style="background:rgba(255,255,255,.15)">
        <h5>Rekomendasi Tambahan</h5>
    <p>
<?php if(($perjam ?? 0) > 0): ?>
    Berikan cairan sesuai laju infus yang dihitung dan evaluasi kondisi pasien secara berkala.
<?php else: ?>
    Masukkan data pasien untuk menghitung kebutuhan rehidrasi.
<?php endif; ?>
</p>
    </div>
</div>

<div class="panel mt-4">
    <h4>Tips Menjaga Dehidrasi</h4>

    <ul>
        <li>Bawa botol minum kemanapun Anda pergi</li>
        <li>Set pengingat minum 1–2 jam sekali</li>
        <li>Konsumsi buah tinggi air</li>
    </ul>

    <a href="<?= base_url('diare') ?>" class="btn btn-info text-white mt-3">
        Kembali
    </a>
</div>

</div>

</div>
</div>
<script>
function showMode(mode){

    document.getElementById('mode').value = mode;

    const who = document.getElementById('whoForm');
    const normal = document.getElementById('normalForm');
    const buttons = document.querySelectorAll('.mode-btn');

    buttons.forEach(btn => btn.classList.remove('active'));

    if(mode === 'who'){
        who.style.display = 'block';
        normal.style.display = 'none';
        buttons[0].classList.add('active');
    }else{
        who.style.display = 'none';
        normal.style.display = 'block';
        buttons[1].classList.add('active');
    }
}
</script>
<?= $this->include('layout/footer') ?>