<?= $this->include('layout/header') ?>

<style>
body{
    background:#f4f4f4;
    font-family:'Poppins',sans-serif;
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
</style>

<div class="container kalkulator-wrap">
<div class="row g-4">

<div class="col-md-5">
<div class="panel">

<form action="<?= base_url('diare/hitung-air') ?>" method="post">

<h5>Jenis Kelamin</h5>

<select class="form-control mb-3" name="jk">
    <option>Laki-laki</option>
    <option>Perempuan</option>
</select>

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

<label class="mt-3">Tingkat Aktivitas</label>
<input type="range" name="aktivitas" class="form-range" min="0" max="100">

<label class="mt-3">Kondisi</label>
<select class="form-control mb-4" name="kondisi">
    <option value="normal">Normal</option>
    <option value="ringan">Diare Ringan</option>
    <option value="sedang">Diare Sedang</option>
    <option value="berat">Diare Berat</option>
</select>

<button class="btn-calc">
    💧 Hitung Sekarang
</button>

</form>

</div>
</div>

<div class="col-md-7">

<div class="result">
    <h4>Estimasi Total Kebutuhan Air</h4>

    <div class="big-number">
        <?= $hasil ?? '0.0' ?>
        <span style="font-size:36px;">Liter</span>
    </div>

    <div class="mt-4 p-3 rounded" style="background:rgba(255,255,255,.15)">
        <h5>Rekomendasi Tambahan</h5>
        <p>Minumlah secara berkala sepanjang hari tanpa menunggu haus.</p>
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

<?= $this->include('layout/footer') ?>