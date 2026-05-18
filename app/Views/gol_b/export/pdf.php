<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <title>Export Excel</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        body{
            font-family:'Poppins', sans-serif;
            font-size:13px;
        }

        h1{
            font-size:26px;
            margin:0;
        }

        h2{
            font-size:18px;
            margin:0;
        }

        p{
            margin:0;
            font-size:13px;
        }

        table{
            border-collapse:collapse;
        }

        th{
            background:#d9edf7;
            font-weight:600;
            text-align:center;
        }

        td{
            vertical-align:middle;
        }

    </style>

</head>
<body>

<table width="100%">
    <tr>

        <td width="15%" align="center">
            <img src="<?= base_url('img/kop_surat.png') ?>" width="90">
        </td>

        <td align="center">

            <h2 style="margin:0;">
                PEMERINTAH KABUPATEN JEMBER
            </h2>

            <h2 style="margin:0;">
                DINAS KESEHATAN, PENGENDALIAN
            </h2>

            <h2 style="margin:0;">
                PENDUDUK DAN KELUARGA BERENCANA
            </h2>

            <h1 style="margin:0;">
                UPTD PUSKESMAS KALIWATES
            </h1>

            <p style="margin:0;">
                Jl. Basuki Rahmat No. 199,
                Tegal Besar, Kaliwates,
                Jember, Jawa Timur 68132
            </p>

            <p style="margin:0;">
                Telepon (0331) 321301
            </p>

        </td>

    </tr>
</table>

<hr>
<br>

<h3 align="center">
    DATA PASIEN
</h3>

<table border="1" cellpadding="8" cellspacing="0" width="100%">

<tr style="background:#d9edf7; font-weight:bold;">

    <th>No</th>
    <th>NIK</th>
    <th>No RM</th>
    <th>Alamat</th>
    <th>Nama Pasien</th>
    <th>Jenis Kelamin</th>
    <th>Umur</th>
    <th>Status</th>
    <th>Tanggal Lahir</th>
    <th>Tanggal Kunjungan</th>

</tr>

<?php $no = 1; ?>

<?php foreach($pasien ?? [] as $p): ?>

<tr>

    <td><?= $no++ ?></td>

    <td><?= $p['nik'] ?></td>

    <td><?= $p['no_rm'] ?></td>

    <td><?= $p['kelurahan'] ?></td>

    <td><?= $p['nama_pasien'] ?></td>

    <td>
        <?php

if($p['jenis_kelamin'] == '1'){

    echo 'Perempuan';

}

elseif($p['jenis_kelamin'] == '2'){

    echo 'Laki-laki';

}

else{

    echo $p['jenis_kelamin'];

}

?>
    </td>

    <td><?= $p['umur'] ?></td>

    <td><?= $p['status_akhir'] ?></td>

    <td><?= $p['tgl_lahir'] ? date('d-m-Y', strtotime($p['tgl_lahir'])) : '-' ?></td>

    <td><?= $p['tgl_kunjungan'] ? date('d-m-Y', strtotime($p['tgl_kunjungan'])) : '-' ?>
</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>