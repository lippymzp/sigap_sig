<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export PDF Hasil Data Pasien</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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
            font-size: 11px;
        }

        table td {
            border: 1px solid #ddd;
            padding: 5px;
            font-size: 10px;
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>HASIL DATA PASIEN DBD</h2>
<div class="sub">
    Export PDF Sistem Informasi DBD
</div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
            <th>Kasus Baru</th>
            <th>Total Kasus</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; ?>
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $p) : ?>
                <tr>
                    <td class="center"><?= $no++ ?></td>
                    <td><?= esc($p['kecamatan'] ?? '-') ?></td>
                    <td><?= esc($p['desa'] ?? '-') ?></td>
                    <td class="center">
                        <?= ($p['jenis_kelamin'] ?? 0) == 1 ? 'Perempuan' : 'Laki-laki' ?>
                    </td>
                    <td class="center"><?= esc($p['umur'] ?? '-') ?></td>
                    <td class="center"><?= esc($p['kasus_baru'] ?? 0) ?></td>
                    <td class="center"><?= esc($p['total_kasus'] ?? 0) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="7" class="center">Data tidak tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>