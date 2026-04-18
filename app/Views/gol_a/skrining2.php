<!DOCTYPE html>
<html>
<head>
<title>Pertanyaan Skrining</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


<style>
body {
    background: #ffffff;
}

/* STEP */
.step-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
}
.step {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 6px;
    font-weight: 600;
}
.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 150px;
}

.step-item p {
    margin-top: 8px;
    font-size: 14px;
}
/* STEP AKTIF (ISI WARNA) */
.step.active {
    background: #009B9F;
    color: white;
    border: none;
}

/* STEP BELUM AKTIF (HANYA GARIS) */
.step.inactive {
    background: #00BBC2;
    color: white;
    border: none;
}
.step-line {
    display: inline-block;
    width: 500px;
    border-top: 2px dashed #00BBC2;
    margin: 0 10px;
    transform: translateY(-20px);
}

/* CARD */
.card-custom {
    border-radius: 15px;
    border: 2px solid #00BBC2;
    background: #f1f3f5;
    padding: 30px;
    max-width: 900px;
    margin: auto;
}

/* PERTANYAAN */
.pertanyaan {
    margin-bottom: 20px;
}

/* OPSI BUTTON */
.opsi-group {
    display: flex;
    gap: 50px;
    margin-top: 8px;
}

.opsi {
    border-radius: 15px;
    padding: 10px 50px; /* lebih besar */
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    background:rgb(250, 250, 250);
    color: #555;
    min-width: 90px; /* biar konsisten */
    text-align: center;
    border: none !important;  /* 🔥 hilangkan garis */
    outline: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1); /* 🔥 shadow */
}

/* aktif */
.opsi.active {
    background: #00BBC2;
    color: white;
}

/* BUTTON */
.btn-kembali {
    border: 2px solid #00BBC2;
    color: #00BBC2;
    border-radius: 12px;
    height: 50px;
    min-width: 160px;
    font-weight: 500;
    display: flex;              /* ini kunci */
    align-items: center;        /* vertical center */
    justify-content: center;    /* horizontal center */
}

.btn-kirim {
    background: #00BBC2;
    color: white;
    border-radius: 12px;
    height: 50px;
    min-width: 160px;
    font-weight: 500;
}
/* FOOTER */
.footer {
    background: #00BBC2;
    color: white;
    padding: 40px 0;
    margin-top: 120px;
}
.footer a {
    color: white;
    text-decoration: none;
}
.logo-footer {
    width: 60px;
    height: 60px;
    background: red;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
</style>
</head>

<body>

<!-- STEP -->
<div class="step-wrapper mb-5">

    <div class="step-item">
        <span class="step inactive">1</span>
        <p>Informasi Umum</p>
    </div>

    <div class="step-line"></div>

    <div class="step-item">
        <span class="step active">2</span>
        <p>Pertanyaan Skrining</p>
    </div>

</div>

<!-- CARD -->
<div class="card-custom">

<h5><b>Informasi Gejala Klinis</b></h5>
<p class="mb-4">Sesuaikan dengan kondisi gejala yang dialami</p>

<form method="post" action="/skrining3/skriningdbd3">
    
<input type="hidden" name="nik" value="<?= $nik ?? '' ?>">
<input type="hidden" name="nama" value="<?= $nama ?? '' ?>">
<input type="hidden" name="jenis_kelamin" value="<?= $jenis_kelamin ?? '' ?>">
<input type="hidden" name="tanggal_lahir" value="<?= $tanggal_lahir ?? '' ?>">
<input type="hidden" name="kategori_usia" value="<?= $kategori_usia ?? '' ?>">
<input type="hidden" name="telepon" value="<?= $telepon ?? '' ?>">
<input type="hidden" name="provinsi" value="<?= $provinsi ?? '' ?>">
<input type="hidden" name="kabupaten" value="<?= $kabupaten ?? '' ?>">
<input type="hidden" name="kecamatan" value="<?= $kecamatan ?? '' ?>">
<input type="hidden" name="kelurahan" value="<?= $kelurahan ?? '' ?>">
<input type="hidden" name="kode_pos" value="<?= $kode_pos ?? '' ?>">
<div class="container mt-5">
<?php for($i=1; $i<=7; $i++): ?>
<div class="pertanyaan">

    <label><b>Pertanyaan <?= $i ?></b></label>

    <div class="opsi-group">
        <button type="button" class="opsi" data-value="1">Iya</button>
        <button type="button" class="opsi" data-value="0">Tidak</button>

        <input type="hidden" name="p<?= $i ?>" value="">
    </div>

</div>
<?php endfor; ?>

<div class="d-flex gap-4 mt-5">
    <a href="/skrining" class="btn btn-kembali flex-fill">Kembali</a>
    <button class="btn btn-kirim flex-fill">Kirim</button>
</div>
</div>

</form>

</div>
</div>

<!-- FOOTER -->
<div class="footer">
<div class="container">
<div class="row">

<div class="col-md-4">
<div class="logo-footer">LOGO</div>
<p class="mt-3"><b>SIGAP</b><br>
Sistem Informasi, Geografis Analisis & Pemantauan</p>
<a href="#">Tentang Kami</a>
</div>

<div class="col-md-4">
<h6>Media Sosial</h6>
<p>@username</p>
</div>

<div class="col-md-4">
<h6>Informasi Kontak</h6>
<p>Email: email@company.com</p>
<p>Lokasi: Jember, Jawa Timur</p>
</div>

</div>
<hr>
<p class="text-center">Hak Cipta © 2026 SIGAP</p>
</div>
</div>

<!-- SCRIPT -->
<script>
document.querySelectorAll('.opsi-group').forEach(group => {

    const buttons = group.querySelectorAll('.opsi');
    const input = group.querySelector('input');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {

            buttons.forEach(b => b.classList.remove('active'));

            btn.classList.add('active');

            // 🔥 ambil angka (1 / 0)
            input.value = btn.getAttribute('data-value');
        });
    });

});
</script>
<script>
document.querySelector('form').addEventListener('submit', function(e) {

    let valid = true;

    document.querySelectorAll('.opsi-group input').forEach(input => {
        if (input.value === "") {
            valid = false;
        }
    });

    if (!valid) {
        e.preventDefault();
        alert("Semua pertanyaan harus diisi!");
    }

});
</script>

</body>
</html>