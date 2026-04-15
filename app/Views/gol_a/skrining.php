<?= $this->include('layout/header') ?>

<section class="container mt-5" style="max-width:700px">

<div class="card p-4 shadow">

<h4 class="text-center mb-4 text-teal">Skrining Pneumonia</h4>

<form>

<!-- NAMA -->
<div class="mb-3">
<label>Nama</label>
<input type="text" class="form-control" placeholder="Masukkan nama">
</div>

<!-- UMUR -->
<div class="mb-3">
<label>Umur</label>
<input type="number" class="form-control">
</div>

<!-- GEJALA -->
<div class="mb-3">
<label>Apakah mengalami batuk?</label>
<select class="form-control">
<option>Ya</option>
<option>Tidak</option>
</select>
</div>

<div class="mb-3">
<label>Apakah mengalami sesak napas?</label>
<select class="form-control">
<option>Ya</option>
<option>Tidak</option>
</select>
</div>

<div class="mb-3">
<label>Apakah mengalami demam?</label>
<select class="form-control">
<option>Ya</option>
<option>Tidak</option>
</select>
</div>

<!-- BUTTON -->
<button class="btn btn-teal w-100 mt-3">
    Cek Hasil
</button>

</form>

</div>

</section>

<?= $this->include('layout/footer') ?>