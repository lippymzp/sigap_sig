<?= $this->include('layout/header') ?>
<!DOCTYPE html>
<html>
<head>
<title>Hasil Skrining</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    background: #ffffff;
}

/* CARD */
.card-custom {
    border-radius: 15px;
    border: 2px solid #00BBC2;
    background: #f1f3f5;
    padding: 40px;
    max-width: 1000px;
    margin: 40px auto;
}

/* TITLE */
.section-title {
    font-weight: bold;
    margin: 25px 0 15px;
}

/* BOX */
.data-box {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

/* HASIL */
.hasil-box {
    background: #00BBC2;
    color: white;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    font-weight: bold;
    font-size: 18px;
}

/* TABLE */
.table th {
    background: #00BBC2;
    color: white;
}
.badge {
    padding: 8px 15px;
    font-size: 14px;
}

/* TIPS */
.tips-box {
    border-radius: 12px;
    overflow: hidden;
    margin-top: 10px;
}

.tips-header {
    background: #00BBC2;
    color: white;
    padding: 10px 15px;
    font-weight: bold;
}

.tips-content {
    background: #cfe8f3;
    padding: 15px;
}

.tips-content ul {
    margin: 0;
    padding-left: 20px;
}

.form-control[readonly] {
    background-color: #f8f9fa;
    border-radius: 10px;
}

/* FOOTER */
.footer-text {
    text-align: center;
    margin-top: 30px;
    color: gray;
    font-size: 14px;
}
.btn-custom {
    height: 55px;
    border-radius: 12px;
    font-weight: 600;
}


.btn-wrapper {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 40px;
}

.btn-kembali, .btn-selesai, .btn-cetak {
    width: 160px;
    height: 50px;
    border-radius: 10px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

/* warna */
.btn-kembali {
    background: white;
    border: 2px solid #00BBC2;
    color: #00BBC2;
}

.btn-selesai {
    background: #00BBC2;
    color: white;
}

.btn-cetak {
    width: 200px;
    height: 50px;
    background: #555;
    color: white;
    border-radius: 10px;
    font-weight: 600;
    
}
@media print {
    .btn-wrapper, .btn-cetak {
        display: none;
    }
}
.btn-cetak-full {
    width: 100%;                 /* full lebar */
    height: 50px;
    background: #00BBC2;         /* warna tosca */
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 16px;
}

.btn-cetak-full:hover {
    opacity: 0.9;
}
/* TABLE ROUNDED */
.table {
    border-radius: 12px;
    overflow: hidden;
}

/* HEADER */
.table thead tr th:first-child {
    border-top-left-radius: 12px;
}

.table thead tr th:last-child {
    border-top-right-radius: 12px;
}

/* FOOTER (baris terakhir) */
.table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

.table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}
/* BUTTON STYLE */ 
.btn-kembali { 
    background: white; 
    color: #00BBC2; 
    box-shadow: 0 2px 8px rgba(0,0,0,0.1); } 

.btn-selesai { 
    background: #00BBC2; 
    color: white; 
    box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

/* SPACING BIAR NGGAK RAPET */
.section-title {
    margin-top: 35px;
}

.data-box {
    margin-bottom: 25px;
}

.table {
    margin-bottom: 25px;
}

.hasil-box {
    margin-bottom: 15px;
}

.tips-box {
    margin-top: 20px;
    margin-bottom: 30px;
}

.cetak-wrapper {
    margin-top: 20px;
}
* {
    font-family: 'Poppins', sans-serif;
}


</style>
</head>

<body>
// ================== LOGIC C4.5 ==================
<?php
$hasil = "Tidak Terindikasi";
$alasan = "";

// ROOT: DEMAM
if ($p3 == 0) {

    // Demam = No
    if ($p5 == 0) {
        $hasil = "Tidak Terindikasi";
        $alasan = "Tidak demam dan tidak sakit kepala";
    } else {
        if ($p2 == 0) {
            $hasil = "Tidak Terindikasi";
            $alasan = "Tidak demam dan usia ≤ 20";
        } else {

            if ($p6 == 0) {
                if ($p1 == 0) {
                    $hasil = "Tidak Terindikasi";
                    $alasan = "Tidak demam, tidak nyeri otot, bukan laki-laki";
                } else {
                    if ($p8 == 1) {
                        $hasil = "Terindikasi";
                        $alasan = "Tidak demam, laki-laki, muntah";
                    } else {
                        $hasil = "Tidak Terindikasi";
                        $alasan = "Tidak demam, tanpa muntah";
                    }
                }
            } else {
                if ($p8 == 1) {
                    $hasil = "Terindikasi";
                    $alasan = "Tidak demam tapi ada nyeri otot dan muntah";
                } else {
                    if ($p1 == 0 && $p7 == 1) {
                        $hasil = "Terindikasi";
                        $alasan = "Tidak demam, nyeri otot, ruam";
                    } else {
                        $hasil = "Tidak Terindikasi";
                        $alasan = "Gejala tidak cukup kuat";
                    }
                }
            }
        }
    }

} else {

    // Demam = Yes

    // RULE KUAT
    if ($p6 == 1 && $p5 == 0) {
        $hasil = "Terindikasi";
        $alasan = "Demam + nyeri otot tanpa sakit kepala";
    }

    elseif ($p6 == 1) {
        $hasil = "Terindikasi";
        $alasan = "Demam + nyeri otot";
    }

    elseif ($p5 == 0) {

        if ($p8 == 0) {
            if ($p7 == 0) {
                $hasil = "Tidak Terindikasi";
                $alasan = "Demam tanpa gejala lain";
            } else {
                if ($p2 == 1) {
                    $hasil = "Terindikasi";
                    $alasan = "Demam + ruam + usia >20";
                } else {
                    $hasil = "Tidak Terindikasi";
                    $alasan = "Demam + ruam tapi usia ≤20";
                }
            }
        }

        else {
            if ($p7 == 1) {
                $hasil = "Terindikasi";
                $alasan = "Demam + muntah + ruam";
            } else {
                if ($p4 == 1 && $p2 == 0) {
                    $hasil = "Terindikasi";
                    $alasan = "Demam lama >5 hari pada usia ≤20";
                } else {
                    $hasil = "Tidak Terindikasi";
                    $alasan = "Gejala belum cukup kuat";
                }
            }
        }

    }

    else {
        // Sakit kepala = yes

        if ($p2 == 0) {
            if ($p7 == 1) {
                $hasil = "Terindikasi";
                $alasan = "Demam + sakit kepala + ruam";
            } else {
                if ($p1 == 0 && $p4 == 1) {
                    $hasil = "Terindikasi";
                    $alasan = "Demam lama >5 hari";
                } else {
                    $hasil = "Tidak Terindikasi";
                    $alasan = "Gejala belum kuat";
                }
            }
        }

        else {
            // umur >20

            if ($p4 == 1) {
                $hasil = "Terindikasi";
                $alasan = "Demam lama >5 hari";
            } else {
                if ($p8 == 1) {
                    $hasil = "Terindikasi";
                    $alasan = "Demam + muntah";
                } else {
                    $hasil = "Terindikasi";
                    $alasan = "Demam + sakit kepala usia >20";
                }
            }
        }
    }
}
?>


<div class="card-custom">

<!-- JUDUL -->
<h4 class="text-center mb-4">
    <b>Hasil Skrining Kesehatan Anda</b>
</h4>

<!-- INFORMASI UMUM -->
<div class="section-title">Informasi Umum</div>


<div class="data-box">
<div class="row g-3">

<div class="col-md-6">
    <label>Nama Lengkap</label>
    <input type="text" class="form-control" value="<?= $nama ?>" readonly>

    <label class="mt-3">Nomor Induk Kependudukan</label>
    <input type="text" class="form-control" value="<?= $nik ?>" readonly>

    <label class="mt-3">Jenis Kelamin</label>
    <input type="text" class="form-control" value="<?= $jenis_kelamin ?>" readonly>

    <label class="mt-3">Tanggal Lahir</label>
    <input type="text" class="form-control" value="<?= $tanggal_lahir ?>" readonly>

    <label class="mt-3">Kategori Usia</label>
    <input type="text" class="form-control" value="<?= $kategori_usia ?>" readonly>
</div>

<div class="col-md-6">
    <label>Tanggal Skrining</label>
    <input type="text" 
       class="form-control text-white" 
       style="background:#00BBC2;" 
       value="<?= date('d-m-Y') ?>" 
       readonly>

    <label class="mt-3">Provinsi</label>
    <input type="text" class="form-control" value="<?= $provinsi ?>" readonly>

    <label class="mt-3">Kabupaten</label>
    <input type="text" class="form-control" value="<?= $kabupaten ?>" readonly>

    <label class="mt-3">Kecamatan</label>
    <input type="text" class="form-control" value="<?= $kecamatan ?>" readonly>

    <label class="mt-3">Kelurahan</label>
    <input type="text" class="form-control" value="<?= $kelurahan ?>" readonly>

    <label class="mt-3">RT/RW</label>
    <input type="text" class="form-control" value="<?= $rt_rw ?>" readonly>
</div>

</div>
</div>

<!-- RINCIAN JAWABAN -->
<div class="section-title">Rincian Jawaban</div>

<table class="table table-bordered">
<thead>
<tr>
    <th class="text-center">No</th>
    <th class="text-start">Pertanyaan</th>
    <th class="text-center">Jawaban</th>
</tr>
</thead>
<tbody>

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

<?php foreach($pertanyaan as $i => $text): ?>
<tr>
    <td class="text-center"><?= $i+1 ?></td>
    <td class="text-start"><?= $text ?></td>
    <td class="text-center">
        <?php if((${"p".($i+1)} ?? 0) == 1): ?>
            <span class="badge bg-success">Ya</span>
        <?php else: ?>
            <span class="badge bg-danger">Tidak</span>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

<!-- HASIL -->
<div class="section-title">Hasil</div>

<div class="hasil-box">
    <?= $hasil ?>
</div>

<p class="text-center mt-2 text-muted">
    <?= $alasan ?>
</p>

<!-- REKOMENDASI -->
<div class="section-title">Rekomendasi</div>

<!-- TIPS -->

<div class="tips-box">
    <div class="tips-header">
        📚 Tips Kesehatan
    </div>

    <div class="tips-content">
        <ul>
            <li>Konsumsi makanan bergizi seimbang setiap hari</li>
            <li>Rutin berolahraga minimal 30 menit</li>
            <li>Istirahat yang cukup</li>
            <li>Jaga kebersihan lingkungan dan ventilasi rumah</li>
        </ul>
    </div>
</div>

<!-- BUTTON -->

<!-- CETAK (SENDIRI DI ATAS) -->
<div class="cetak-wrapper">
    <button onclick="window.print()" class="btn-cetak-full">
        🖨️ Cetak Hasil
    </button>
</div>

<!-- KEMBALI & SELESAI (DI BAWAH) -->
<div class="btn-wrapper">

    <a href="/skrining" class="btn btn-kembali">
        Kembali
    </a>

    <a href="/skrining" class="btn btn-selesai">
        Selesai
    </a>

</div>
<!-- FOOTER -->
<div class="footer-text">
    Halaman 1 dari 1 <br>
    Laporan ini dihasilkan otomatis dari SIGAP
</div>

</div>

</div>

</div>

</body>
</html>
<?= $this->include('layout/footer') ?>