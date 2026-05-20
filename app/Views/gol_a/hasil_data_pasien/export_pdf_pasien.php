<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export PDF Data Pasien</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .sub {
            text-align: center;
            margin-bottom: 15px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #2c3e50;
            color: #fff;
            padding: 6px;
        }

        table td {
            border: 1px solid #ddd;
            padding: 5px;
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>DATA PASIEN DBD</h2>
<div class="sub">
    Hasil Export Data Pasien DBD <br>
    Dicetak pada :
    <?= date('d-m-Y') ?>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Tgl Pemeriksaan</th>
            <th>JK</th>
            <th>Usia</th>
            <th>Catatan Klinis</th>
            <th>Alamat Lengkap</th>
            <th>Status Akhir</th>
            <th>Tindak Lanjut</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; ?>
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $d) : ?>
    <tr>
        <td class="center"><?= $no++ ?></td>

        <td>
            <?= esc((string) ($d['nik'] ?? '')) ?>
        </td>

        <td>
            <?= esc((string) ($d['nama_pasien'] ?? '')) ?>
        </td>

        <td class="center">
            <?= esc((string) ($d['tgl_kunjungan'] ?? '')) ?>
        </td>

        <td class="center">
            <?= esc((string) ($d['jenis_kelamin'] ?? '')) ?>
        </td>

        <td class="center">
            <?= esc((string) ($d['umur'] ?? '')) ?>
        </td>

        <td>
            <?= esc((string) ($d['ctt_klinis'] ?? '')) ?>
        </td>

        <td>
            <?= esc(
                ($d['alamat_lengkap'] ?? '') .

                ', RT ' . ($d['rt'] ?? '-') .
                '/RW ' . ($d['rw'] ?? '-') .

                ', Kel. ' . ($d['kelurahan'] ?? '-') .

                ', Kec. ' . ($d['kecamatan'] ?? '-') .

                ', ' . ($d['kabupaten'] ?? '-') .

                ', ' . ($d['provinsi'] ?? '-')
            ) ?>
        </td>

        <td>
            <?= esc((string) ($d['status_akhir'] ?? '')) ?>
        </td>
        <td>
            <?= esc((string) ($d['tindak_lanjut'] ?? '')) ?>
        </td>
    </tr>
<?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="9" class="center">Data tidak tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>