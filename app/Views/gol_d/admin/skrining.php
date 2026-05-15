<?= $this->extend('layout/dashboarddsing') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">

        <h4 class="fw-bold mb-4">Data Skrining Diare</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>JK</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Tanggal</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
<?php $no=1; foreach($skrining as $row): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nik'] ?></td>
    <td><?= $row['nama_pasien_skrining'] ?></td>
    <td><?= $row['usia'] ?></td>
    <td><?= $row['jenis_kelamin'] ?></td>
    <td><?= $row['no_hp'] ?></td>
    <td><?= $row['tanggal'] ?></td>
    <td><?= $row['hasil'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
        </table>

    </div>
</div>

<?= $this->endSection() ?>