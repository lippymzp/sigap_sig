<?= $this->include('layout/header_a') ?>
<!DOCTYPE html>
<html>
<head>
<title>Pertanyaan Skrining</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<h5><b>Informasi Lingkungan</b></h5>
<p class="mb-2">Sesuaikan dengan kondisi lingkungan rumah anda</p>

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
<input type="hidden" name="provinsi_nama"  value="<?= $provinsi_nama ?? '' ?>">
<input type="hidden" name="kabupaten_nama" value="<?= $kabupaten_nama ?? '' ?>">
<input type="hidden" name="kecamatan_nama" value="<?= $kecamatan_nama ?? '' ?>">
<input type="hidden" name="rt_rw" value="<?= $rt_rw ?? '' ?>">

<div class="container mt-4">

<?php

$pertanyaan = [
    "Apakah Anda menguras TPA (Tempat Penampungan Air)?",
    
    "Apakah Anda menutup rapat-rapat TPA (Tempat Penampungan Air) yang berada di dalam rumah?",
    
    "Apakah Anda menutup rapat-rapat TPA (Tempat Penampungan Air) yang berada di luar rumah?",
    
    "Apakah Anda mengubur barang bekas yang dapat menampung air hujan?",
    
    "Apakah Anda membuang barang bekas yang dapat menampung air hujan?",
    
    "Apakah Anda mendaur ulang barang bekas yang dapat menampung air hujan?",
    
    "Apakah Anda menaburkan larvasida (obat pembunuh jentik) seperti abate pada tempat penampungan yang sulit dibersihkan?",
    
    "Apakah Anda menaburkan larvasida (obat pembunuh jentik) seperti abate sesuai dengan aturan pakai?",
    
    "Apakah Anda menggunakan obat nyamuk atau anti nyamuk?",
    
    "Apakah Anda menanam tanaman pengusir nyamuk seperti serai wangi, lavender, dll?",
    
    "Apakah Anda mengatur pencahayaan dan ventilasi di dalam rumah?",
    
    "Apakah Anda rutin (minimal 1 minggu sekali) mengecek dan memantau keberadaan jentik di rumah Anda?",
    
    "Apakah talang air dan saluran pembuangan rutin dibersihkan?",
    
    "Apakah tidak hanya orang-orang tertentu dalam keluarga Anda yang melakukan kegiatan 3M Plus (Menguras, Menutup, Mendaur ulang)?",
    
    "Apakah semua anggota keluarga Anda tidak menggantungkan baju di rumah?"
];


?>

<?php foreach($pertanyaan as $index => $text): ?>
<div class="pertanyaan step-form" data-step="<?= $index+1 ?>" style="display:none;">

    <label class="text-center w-100 d-block">
        <b><?= $text ?></b>
    </label>

 <?php
$nomor = $index + 1;
?>

<div class="opsi-group">

    <button type="button" class="opsi" data-value="1">Iya</button>
    <button type="button" class="opsi" data-value="0">Tidak</button>

    <input type="hidden" name="p<?= $nomor ?>" value="">

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
</div>
</footer>
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
let currentGroup = 1;
const questionPerPage = 3;

const steps = document.querySelectorAll('.step-form');
const totalGroup = Math.ceil(steps.length / questionPerPage);

const btnNext = document.getElementById('btnNext');
const btnPrev = document.getElementById('btnPrev');
const progressText = document.getElementById('progressText');

function showGroup(group) {
    steps.forEach((step, index) => {
        step.style.display = 'none';

        const start = (group - 1) * questionPerPage;
        const end = start + questionPerPage;

        if (index >= start && index < end) {
            step.style.display = 'block';
        }
    });

    btnPrev.style.display = group === 1 ? 'none' : 'block';
    btnNext.textContent = (group === totalGroup) ? 'Kirim' : 'Selanjutnya';

    progressText.textContent = group + " dari " + totalGroup;

    let percent = (group / totalGroup) * 100;
    document.getElementById('progressBar').style.width = percent + '%';
}

showGroup(currentGroup);

btnNext.addEventListener('click', function () {
    const start = (currentGroup - 1) * questionPerPage;
    const end = start + questionPerPage;

    let valid = true;

    for (let i = start; i < end && i < steps.length; i++) {
        const input = steps[i].querySelector('input');
        if (input.value === "") {
            valid = false;
            break;
        }
    }

    if (!valid) {
        Swal.fire({
    icon: 'warning',
    title: 'Yah, belum lengkap 🚀✨',
    text: 'Jawab semua pertanyaan dulu ya sebelum lanjut',
    confirmButtonText: 'Oke siap!',
    confirmButtonColor: '#00BBC2',
    background: '#ffffff',
    color: '#2c3e50',
    iconColor: '#00BBC2',
    backdrop: 'rgba(0,187,194,0.15)',
    customClass: {
        popup: 'rounded-4 shadow-lg'
    },
    showClass: {
        popup: 'animate__animated animate__fadeInUp animate__faster'
    },
    hideClass: {
        popup: 'animate__animated animate__fadeOutDown animate__faster'
    }
});
    return;
    }

    if (currentGroup < totalGroup) {
        currentGroup++;
        showGroup(currentGroup);
    } else {

    Swal.fire({
        icon: 'question',
        title: 'Yakin sudah sesuai? 🤔🌿',
        text: 'Pastikan jawaban kamu sesuai kondisi lingkungan saat ini yaa 🚀✨',
        showCancelButton: true,
        confirmButtonText: 'Iya, kirim 👍',
        cancelButtonText: 'Cek lagi 👀',
        confirmButtonColor: '#00BBC2',
        cancelButtonColor: '#6c757d',
        background: '#ffffff',
        color: '#2c3e50',
        iconColor: '#00BBC2',
        backdrop: 'rgba(0,187,194,0.15)',
        customClass: {
            popup: 'rounded-4 shadow-lg'
        },
        showClass: {
            popup: 'animate__animated animate__zoomIn'
        },
        hideClass: {
            popup: 'animate__animated animate__zoomOut'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('form').submit();
        }
    });

}
});

btnPrev.addEventListener('click', function () {
    if (currentGroup > 1) {
        currentGroup--;
        showGroup(currentGroup);
    }
});
</script>

</body>
</html>
<?= $this->include('layout/footer') ?>