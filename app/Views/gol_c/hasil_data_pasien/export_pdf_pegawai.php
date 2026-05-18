<?php

$path = FCPATH . 'img/logo_jember.png';

$type = pathinfo($path, PATHINFO_EXTENSION);

$imageData = file_get_contents($path);

$logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

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

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>
        Data Pegawai
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

        .kop-text h2,
        .kop-text h3,
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

        .data-table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        .data-table th,
        .data-table td{
            border:1px solid #000;
            padding:8px;
            font-size:14px;
        }

        .data-table th{
            background:#EAF4F4;
            text-align:center;
        }

        .center{
            text-align:center;
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
            font-size:14px;
            margin-top:80px;
            font-weight:bold;
            text-decoration:underline;
        }

    </style>
</head>

<body>

    <!-- =========================
         KOP SURAT
    ========================== -->

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

    <!-- =========================
         JUDUL
    ========================== -->

    <div class="judul">

        <h3>
            DATA PEGAWAI PUSKESMAS AJUNG
        </h3>

        <p>
            Dicetak pada
            <?= date('d') ?>
            <?= $bulanIndonesia[date('n')] ?>
            <?= date('Y H:i') ?>
        </p>

    </div>

    <!-- =========================
         TABEL
    ========================== -->

    <table class="data-table">

        <thead>

            <tr>

                <th width="5%">
                    No
                </th>

                <th>
                    NIP
                </th>

                <th>
                    Nama Pegawai
                </th>

                <th>
                    Instansi
                </th>

                <th>
                    Nomor HP
                </th>

            </tr>

        </thead>

        <tbody>

            <?php if(!empty($data)): ?>

                <?php $no = 1; ?>

                <?php foreach($data as $d): ?>

                    <tr>

                        <td class="center">
                            <?= $no++ ?>
                        </td>

                        <td>
                            <?= esc($d['nip']) ?>
                        </td>

                        <td>
                            <?= esc($d['nama_petugas']) ?>
                        </td>

                        <td>
                            <?= esc($d['nama_instansi']) ?>
                        </td>

                        <td>
                            <?= esc($d['no_telp']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="5" class="center">
                        Data pegawai tidak tersedia
                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

    <!-- =========================
         TANDA TANGAN
    ========================== -->

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