<?= $this->include('layout/header') ?>

<section class="container mt-5">

<!-- ================= STEP MODERN ================= -->
<div class="step-wrapper">

    <div class="step-item step-active">
        <div class="step-circle">1</div>
        <div class="step-title">Informasi Umum</div>
    </div>

    <div class="step-line"></div>

    <div class="step-item">
        <div class="step-circle">2</div>
        <div class="step-title">Pertanyaan Skrining</div>
    </div>

</div>

<!-- ================= FORM ================= -->
<form action="<?= base_url('skrining-diare-step2') ?>" method="post">

<div class="card border-0 shadow-lg p-4" style="border-radius:20px;">

<h5 class="fw-bold mb-1">Informasi Umum</h5>
<p class="text-muted mb-4">Lengkapi data sebelum skrining dimulai</p>

<div class="row g-3">

<!-- KIRI -->
<div class="col-md-6">

<label class="form-label">NIK</label>
<input name="nik" class="form-control modern-input" placeholder="Masukkan NIK" required>

<label class="form-label mt-2">Nama Lengkap</label>
<input name="nama" class="form-control modern-input" placeholder="Masukkan Nama">

<label class="form-label mt-2">Jenis Kelamin</label>
<select name="jk" class="form-control modern-input">
<option value="">-- Pilih --</option>
<option>Laki-laki</option>
<option>Perempuan</option>
</select>

<label class="form-label mt-2">Tanggal Lahir</label>
<input type="date" name="tgl" class="form-control modern-input">

<label class="form-label mt-2">Kategori Usia</label>
<select name="usia" class="form-control modern-input">
<option value="">-- Pilih --</option>
<option>Anak</option>
<option>Dewasa</option>
<option>Lansia</option>
</select>

<label class="form-label mt-2">Nomor Telepon</label>
<input name="hp" class="form-control modern-input" placeholder="08xxxx">

</div>

<!-- KANAN -->
<div class="col-md-6">

<label class="form-label">Provinsi</label>
<input name="prov" class="form-control modern-input" placeholder="Provinsi">

<label class="form-label mt-2">Kabupaten</label>
<input name="kab" class="form-control modern-input" placeholder="Kabupaten">

<label class="form-label mt-2">Kecamatan</label>
<input name="kec" class="form-control modern-input" placeholder="Kecamatan">

<label class="form-label mt-2">Kelurahan</label>
<input name="kel" class="form-control modern-input" placeholder="Kelurahan">

<label class="form-label mt-2">Kode Pos</label>
<input name="kodepos" class="form-control modern-input" placeholder="Kode Pos">

<label class="form-label mt-2">Tanggal Skrining</label>
<input value="<?= date('Y-m-d') ?>" class="form-control modern-input" readonly>

</div>

</div>

<!-- BUTTON -->
<div class="mt-4">
<button class="btn btn-teal w-100 py-2 fw-semibold" style="border-radius:12px;">
    Lanjut ke Pertanyaan →
</button>
</div>

</div>
</form>

</section>

<?= $this->include('layout/footer') ?>