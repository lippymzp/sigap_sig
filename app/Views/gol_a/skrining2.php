<?= $this->include('layout/header') ?>
<!DOCTYPE html>
<html>
<head>
<title>Pertanyaan Skrining</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
.step.active {
    background: #009B9F;
    color: white;
}
.step.inactive {
    background: #00BBC2;
    color: white;
}
.step-line {
    width: 500px;
    border-top: 2px dashed #00BBC2;
    margin: 0 10px;
    transform: translateY(-20px);
}
* {
    font-family: 'Poppins', sans-serif;
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

/* OPSI */
.opsi-group {
    display: flex;
    justify-content: center;
    gap: 50px;
    margin-top: 8px;
}
.opsi {
    border-radius: 15px;
    padding: 10px 50px;
    font-size: 15px;
    cursor: pointer;
    background: #fafafa;
    color: #555;
    border: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
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
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn-kirim {
    background: #00BBC2;
    color: white;
    border-radius: 12px;
    height: 50px;
    font-weight: 500;
}

/* PROGRESS */
#progressText {
    color: black;
    font-weight: 500;
    margin-bottom: 15px;
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
.pertanyaan label {
    display: block;
    text-align: center;
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 15px;
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
<p class="mb-2">Sesuaikan dengan kondisi gejala yang dialami</p>

<!-- PROGRESS -->
<p id="progressText"></p>
<div class="progress" style="height: 10px; border-radius: 10px;">
    <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%; background:#00BBC2;"></div>
</div>

<form method="post" action="/skriningdbd/skriningdbd3">

<!-- DATA HIDDEN -->
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
<input type="hidden" name="rt_rw" value="<?= $rt_rw ?? '' ?>">

<div class="container mt-4">

<?php 
$pertanyaan = [
    "Apakah Anda berjenis kelamin Laki-laki?",
    "Apakah usia Anda saat ini di atas 20 tahun?",
    "Apakah Anda sedang mengalami demam saat ini?",
    "Apakah demam tersebut sudah berlangsung lebih dari 5 hari?",
    "Apakah Anda merasakan sakit kepala yang mengganggu?",
    "Apakah otot atau sendi Anda terasa nyeri/pegal-pegal?",
    "Apakah muncul bintik merah atau ruam pada kulit Anda?",
    "Apakah Anda merasa mual atau sempat muntah-muntah?"
];
?>

<?php foreach($pertanyaan as $index => $text): ?>
<div class="pertanyaan step-form" data-step="<?= $index+1 ?>" style="display:none;">
    
    <label class="text-center w-100 d-block">
        <b><?= $text ?></b>
    </label>

    <div class="opsi-group">
        <button type="button" class="opsi" data-value="1">Iya</button>
        <button type="button" class="opsi" data-value="0">Tidak</button>
        <input type="hidden" name="p<?= $index+1 ?>" value="">
    </div>

</div>
<?php endforeach; ?>

<div class="d-flex gap-4 mt-5">
    <button type="button" id="btnPrev" class="btn btn-kembali flex-fill">Kembali</button>
    <button type="button" id="btnNext" class="btn btn-kirim flex-fill">Selanjutnya</button>
</div>

</div>
</form>
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

<div class="col-md-4 text-center">
    <h6>Media Sosial</h6>
    <p>@username</p>
</div>

<div class="col-md-4 text-end">
    <h6>Informasi Kontak</h6>
    <p>Email: email@company.com</p>
    <p>Lokasi: Jember, Jawa Timur</p>
</div>

</div>

<hr>

<p class="text-center">Hak Cipta © 2026 SIGAP</p>

</div>
</div>

<!-- SCRIPT OPSI -->
<script>
document.querySelectorAll('.opsi-group').forEach(group => {
    const buttons = group.querySelectorAll('.opsi');
    const input = group.querySelector('input');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            input.value = btn.getAttribute('data-value');
        });
    });
});
</script>

<!-- SCRIPT STEP -->
<script>
let currentStep = 1;

const steps = document.querySelectorAll('.step-form');
const totalStep = steps.length;

const btnNext = document.getElementById('btnNext');
const btnPrev = document.getElementById('btnPrev');
const progressText = document.getElementById('progressText');

function showStep(step) {
    steps.forEach(s => s.style.display = 'none');
    document.querySelector(`[data-step="${step}"]`).style.display = 'block';

    btnPrev.style.display = step === 1 ? 'none' : 'block';
    btnNext.textContent = (step === totalStep) ? 'Kirim' : 'Selanjutnya';

    progressText.textContent = step + " dari " + totalStep;

    let percent = (step / totalStep) * 100;
    document.getElementById('progressBar').style.width = percent + '%';
}

showStep(currentStep);

btnNext.addEventListener('click', function() {
    const input = document.querySelector(`[data-step="${currentStep}"] input`);

    if (input.value === "") {
        alert("Silakan pilih jawaban terlebih dahulu!");
        return;
    }

    if (currentStep < totalStep) {
        currentStep++;
        showStep(currentStep);
    } else {
        document.querySelector('form').submit();
    }
});

btnPrev.addEventListener('click', function() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
});

</script>

</body>
</html>