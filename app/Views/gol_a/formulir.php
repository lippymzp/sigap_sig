<!DOCTYPE html>
<html>
<head>
<title>LAPORAN PSN 2026 PKM SUMBERSARI</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f8f9fa;
}

/* CARD */
.card-custom {
    border-radius: 15px;
    border: 2px solid #00BBC2;
    background: #ffffff;
    padding: 30px;
    margin-top: 40px;
}

/* TITLE */
.title {
    color: #00BBC2;
    font-weight: bold;
}

/* INPUT */
.form-control, .form-select {
    border-radius: 10px;
    height: 45px;
}

/* LABEL */
label {
    font-weight: 500;
    margin-bottom: 5px;
}

/* REQUIRED */
.required::after {
    content: " *";
    color: red;
}

/* BUTTON */
.btn-submit {
    background: #00BBC2;
    color: white;
    border-radius: 10px;
    height: 50px;
    font-weight: bold;
}

/* UPLOAD */
.upload-box {
    border: 2px dashed #00BBC2;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
}

</style>
</head>

<body>

<div class="container">

<div class="card-custom">

<h4 class="title">LAPORAN PSN 2026 PKM SUMBERSARI</h4>
<p class="mb-5">Pemberantasan Sarang Nyamuk</p>

<form method="post" action="/formkader/simpan" enctype="multipart/form-data">

<!--TANGGAL INPUT -->
<!-- KELURAHAN -->
<div class="mb-3">
<label class="required">Tanggal Input</label>
<input type="text" name="tanggalinput" class="form-control" value="<?= date('Y-m-d') ?>" readonly>

<!-- KELURAHAN -->
<div class="mb-3">
<label class="required">Kelurahan</label>
<select name="kelurahan" class="form-select" required>
<option value="">-- Pilih --</option>
<option>Sumbersari</option>
<option>Wirolegi</option>
<option>Antirogo</option>
<option>Tegal Gede</option>
<option>Karangrejo</option>
</select>
</div>

<!-- POSYANDU -->
<div class="mb-3">
<label class="required">Pos Posyandu</label>
<select name="posyandu" class="form-select" required>

<option value="">-- Pilih --</option>

<?php for($i=1; $i<=95; $i++): ?>
<option>CATLEYA <?= $i ?></option>
<?php endfor; ?>

<option>CATLEYA 36A (BAYANGAN)</option>
<option>CATLEYA 58A (BAYANGAN)</option>
<option>CATLEYA 65A (BAYANGAN)</option>
<option>CATLEYA 78A (BAYANGAN)</option>
<option>CATLEYA 88A (BAYANGAN)</option>
<option>CATLEYA 92A (BAYANGAN)</option>
<option>CATLEYA 95A</option>
<option>CATLEYA 95B (BAYANGAN)</option>

</select>
</div>

<!-- JUMLAH DIPERIKSA -->
<div class="mb-3">
<label class="required">Yang Diperiksa (Jumlah Rumah / KK)</label>
<input type="number" name="diperiksa" class="form-control" required>
</div>

<!-- POSITIF -->
<div class="mb-3">
<label class="required">Jumlah Yang Positif Jentik</label>
<input type="number" name="positif" class="form-control" required>
</div>

<!-- BAGIAN POSITIF -->
<div class="mb-3">
<label>Bagian Yang Positif</label>
<textarea name="bagian" class="form-control" rows="3"
placeholder="Contoh: kamar mandi, vas bunga"></textarea>
</div>

<!-- UPLOAD FOTO -->
<div class="mb-3">
<label>Upload Foto</label>

<div class="upload-box" onclick="document.getElementById('foto').click()">
Klik untuk upload / ambil foto
</div>

<input type="file" name="foto" id="foto" class="form-control mt-2"
accept="image/*" capture="environment">
</div>

<!-- BUTTON -->
<button class="btn btn-submit w-100 mt-3">Kirim Laporan</button>

</form>

</div>
</div>

</body>
</html>