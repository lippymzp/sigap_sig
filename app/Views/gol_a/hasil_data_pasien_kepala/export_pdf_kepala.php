<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export PDF Data Pasien (Kepala)</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .sub {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background: #00BBC2; /* Menyesuaikan warna Kepala */
            color: #fff;
            padding: 8px;
            border: 1px solid #009fa5;
        }

        table td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .center {
            text-align: center;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

<h2>REKAPITULASI DATA PASIEN DBD</h2>
<div class="sub">
    Hasil Export Berdasarkan Filter Kepala
</div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="20%">Kecamatan</th>
            <th width="20%">Desa</th>
            <th width="20%">Jenis Kelamin</th>
            <th width="15%">Usia</th>
            <th width="20%">Jumlah Kasus</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; ?>
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $d) : ?>
            <tr>
                <td class="center"><?= $no++ ?></td>
                <td><?= esc((string) ($d['kecamatan'] ?? '-')) ?></td>
                <td><?= esc((string) ($d['desa'] ?? '-')) ?></td>
                <td class="center"><?= esc((string) ($d['jk'] ?? '-')) ?></td>
                <td class="center"><?= esc((string) ($d['usia'] ?? '-')) ?></td>
                <td class="center">1</td> </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" class="center">Data tidak tersedia untuk periode/filter ini</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="footer">
    <p>Dicetak pada: <?= date('d-m-Y H:i') ?></p>
</div>

</body>
</html>