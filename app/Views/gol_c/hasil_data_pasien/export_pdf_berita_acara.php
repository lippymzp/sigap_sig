<?php

$bulanIndonesia = [
    1 => 'Januari',
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

$path = FCPATH . 'img/logo_jember.png';

$type = pathinfo($path, PATHINFO_EXTENSION);

$imageData = file_get_contents($path);

$logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>
        Berita Acara Pneumonia
    </title>

    <style>

        body{
            font-family:"Times New Roman", serif;
            font-size:14px;
            color:#000;
            margin:30px;
        }

        .kop{
            width:100%;
            border-bottom:3px double #000;
            padding-bottom:10px;
            margin-bottom:25px;
        }

        .kop-table{
            width:100%;
        }

        .logo{
            width:90px;
        }

        .kop-text{
            text-align:center;
            padding-right:80px;
        }

        .kop-text h3,
        .kop-text h2,
        .kop-text p{
            margin:0;
        }

        .judul{
            text-align:center;
            margin-top:20px;
            margin-bottom:25px;
        }

        .judul h3{
            margin:0;
            text-transform:uppercase;
        }

        .judul p{
            margin-top:8px;
        }

        .isi{
            text-align:justify;
            line-height:1.7;
        }

        .rekap-table{
            width:100%;
            border-collapse:collapse;
            margin-top:25px;
        }

        .rekap-table th,
        .rekap-table td{
            border:1px solid #000;
            padding:6px;
            text-align:center;
            font-size:14px;
        }

        .rekap-table th{
            background:#f1f1f1;
        }

        .ttd{
            width:100%;
            margin-top:70px;
        }

        .ttd td{
            width:50%;
            text-align:center;
            vertical-align:top;
        }

        .nama-ttd{
            margin-top:80px;
            font-weight:bold;
            text-decoration:underline;
        }

    </style>
</head>

<body>

    <!-- KOP -->
    <div class="kop">

        <table class="kop-table">

            <tr>

                <td width="15%">
                    <img
                        src="<?= $logo ?>"
                        class="logo"
                    >
                </td>

                <td class="kop-text">

                    <h3>PEMERINTAH KABUPATEN JEMBER</h3>
                    <h2>DINAS KESEHATAN</h2>
                    <h2>UPT PUSKESMAS AJUNG</h2>

                    <p>
                        Jl. Curah Kates No.100 Klompangan Ajung 68175
                    </p>

                    <p>
                        Email : puskesmasajung@gmail.com
                    </p>

                </td>

            </tr>

        </table>

    </div>

    <!-- JUDUL -->
    <div class="judul">

        <h3>
            BERITA ACARA REKAPITULASI
            DATA KASUS PENYAKIT PNEUMONIA
        </h3>

        <p>
            NOMOR :____/BA-PNEU/<?= date('Y') ?>
        </p>

    </div>

    <!-- ISI -->
    <div style="margin-top:25px; line-height:1.7; font-size:14px;">

        <p style="text-align:justify;">

            Pada hari ini,
            <?= date('d') ?>
            bulan
            <?= $bulanIndonesia[date('n')] ?>
            tahun
            <?= date('Y') ?>,
            telah dilakukan rekapitulasi data kasus penyakit Pneumonia
            berdasarkan data pasien yang tercatat pada sistem SIGAP
            Puskesmas Ajung.

        </p>

        <p>
            Kami yang bertandatangan di bawah ini:
        </p>

        <table
            style="
                border:none;
                width:100%;
                margin-top:10px;
                margin-bottom:20px;
                font-size:14px;
            "
        >

            <tr>

                <td width="30">
                    1.
                </td>

                <td width="120">
                    Nama
                </td>

                <td>
                    :
                </td>

                <td>
                    ____________________
                </td>

            </tr>

            <tr>

                <td></td>

                <td>
                    NIP
                </td>

                <td>
                    :
                </td>

                <td>
                    ____________________
                </td>

            </tr>

            <tr>

                <td></td>

                <td>
                    Jabatan
                </td>

                <td>
                    :
                </td>

                <td>
                    Petugas Surveilans / Pengelola Data
                </td>

            </tr>

            <tr>

                <td style="padding-top:10px;">
                    2.
                </td>

                <td style="padding-top:10px;">
                    Nama
                </td>

                <td style="padding-top:10px;">
                    :
                </td>

                <td style="padding-top:10px;">
                    ____________________
                </td>

            </tr>

            <tr>

                <td></td>

                <td>
                    NIP
                </td>

                <td>
                    :
                </td>

                <td>
                    ____________________
                </td>

            </tr>

            <tr>

                <td></td>

                <td>
                    Jabatan
                </td>

                <td>
                    :
                </td>

                <td>
                    Kepala Bidang / Pimpinan Unit
                </td>

            </tr>

        </table>

        <p>
            Menyatakan bahwa hasil rekapitulasi data kasus Pneumonia
            adalah sebagai berikut:
        </p>

    </div>

    <!-- TABEL -->
    <table class="rekap-table">

        <thead>

            <tr>

                <th rowspan="2" style="width:40px;">
                    No
                </th>
            
                <th rowspan="2">
                    Kelurahan
                </th>

                <th colspan="2">
                    Rentang Usia Tertinggi
                </th>

                <th colspan="2">
                    Jenis Kelamin Tertinggi
                </th>

                <th rowspan="2">
                    Jumlah Kasus
                </th>

            </tr>

            <tr>

                <th>
                    Anak-anak
                </th>

                <th>
                    Dewasa
                </th>

                <th>
                    Laki-laki
                </th>

                <th>
                    Perempuan
                </th>

            </tr>

        </thead>

        <tbody>

            <?php $no = 1; ?>
            <?php foreach($data as $d): ?>

                <tr>

                    <td>
                        <?= $no++ ?>
                    </td>

                    <td>
                        <?= esc($d['kelurahan']) ?>
                    </td>

                    <td>
                        <?= esc($d['anak']) ?>
                    </td>

                    <td>
                        <?= esc($d['dewasa']) ?>
                    </td>

                    <td>
                        <?= esc($d['laki']) ?>
                    </td>

                    <td>
                        <?= esc($d['perempuan']) ?>
                    </td>

                    <td>
                        <?= esc($d['total']) ?>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <!-- BAWAH TABEL -->
    <div
        style="
            margin-top:45px;
            font-size:14px;
            line-height:1.8;
        "
    >

        <p>
            Demikian Berita Acara ini dibuat untuk dipergunakan
            sebagaimana mestinya.
        </p>

    </div>

    <!-- TTD -->
    <table
        style="
            width:100%;
            font-size:14px;
            margin-top:40px;
            border:none;
        "
    >

        <tr>

            <td
                style="
                    width:50%;
                    text-align:center;
                    border:none;
                "
            >

                Mengetahui/Menyetujui
                <br>

                <strong>
                    Kepala Bidang / Pimpinan Unit
                </strong>

                <div style="margin-top:90px;">

                    <strong>
                        (................................)
                    </strong>

                    <br>

                    NIP.

                </div>

            </td>

            <td
                style="
                    width:50%;
                    text-align:center;
                    border:none;
                "
            >

                Jember,
                <?= date('d') ?>
                <?= $bulanIndonesia[date('n')] ?>
                <?= date('Y') ?>

                <br>

                <strong>
                    Petugas Pelapor
                </strong>

                <div style="margin-top:90px;">

                    <strong>
                        (................................)
                    </strong>

                    <br>

                    NIP.

                </div>

            </td>

        </tr>

    </table>

</body>
</html>