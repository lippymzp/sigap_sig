<?= $this->extend('layout/dashboard_layout_kepala') ?>
<?= $this->section('content') ?>

<?php
$desa = $_GET['desa'] ?? '-';
?>

<style>
/* 🔥 STYLE TABEL */
.table-info-custom {
    width: 100%;
    border-collapse: collapse;
}

.label-col {
    width: 260px;
    font-weight: 500;
}

.colon-col {
    width: 10px;
}

.value-col {
    font-weight: 400;
}

.spacer-row td {
    height: 12px;
}

/* 🔥 INI YANG BIKIN MENJOROK */
.sub-label {
    padding-left: 30px;
    color: #555;
    font-size: 14px;
}

/* 🔥 CARD BIAR MIRIP FIGMA */
.info-card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
</style>

<div class="section-block" style="margin-top: 40px;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0" style="font-weight: bold;">Peta Sebaran Kasus 2025</h5>
        <div style="font-weight: bold; font-size: 14px;">
            Periode :
            <span style="color: #00CED1; cursor: pointer; margin: 0 5px;">&lt;</span>
            2025
            <span style="color: #00CED1; cursor: pointer; margin: 0 5px;">&gt;</span>
        </div>
    </div>

    <div class="info-card">
        <h6 style="font-weight: bold; margin-bottom: 20px;">Informasi :</h6>

        <table class="table-info-custom">

            <tr>
                <td class="label-col">Nama Daerah</td>
                <td class="colon-col">:</td>
                <td class="value-col"><?= $desa ?></td>
            </tr>

            <tr>
                <td class="label-col">Jumlah Penduduk</td>
                <td class="colon-col">:</td>
                <td class="value-col">2900</td>
            </tr>

            <tr>
                <td class="label-col">Jumlah Kasus</td>
                <td class="colon-col">:</td>
                <td class="value-col">6</td>
            </tr>

            <tr>
                <td class="label-col">Kategori Kasus</td>
                <td class="colon-col">:</td>
                <td class="value-col">Tinggi</td>
            </tr>

            <tr class="spacer-row"><td colspan="3"></td></tr>

            <tr>
                <td class="label-col">Rentang usia</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="label-col sub-label">Anak-anak</td>
                <td>:</td>
                <td>1</td>
            </tr>

            <tr>
                <td class="label-col sub-label">Dewasa</td>
                <td>:</td>
                <td>5</td>
            </tr>

            <tr>
                <td class="label-col sub-label">Lansia</td>
                <td>:</td>
                <td>0</td>
            </tr>

            <tr class="spacer-row"><td colspan="3"></td></tr>

            <tr>
                <td class="label-col">Rentang usia dengan kasus tertinggi</td>
                <td>:</td>
                <td>Dewasa (18th-59th)</td>
            </tr>

            <tr>
                <td class="label-col">Desa dengan kasus tertinggi</td>
                <td>:</td>
                <td>Patrang</td>
            </tr>

            <tr class="spacer-row"><td colspan="3"></td></tr>

            <tr>
                <td class="label-col">Jenis kelamin terinfeksi</td>
                <td></td>
                <td>2</td>
            </tr>

            <tr>
                <td class="label-col sub-label">Laki-laki</td>
                <td>:</td>
                <td>4</td>
            </tr>

            <tr>
                <td class="label-col sub-label">Perempuan</td>
                <td>:</td>
                <td>2</td>
            </tr>

            <tr class="spacer-row"><td colspan="3"></td></tr>

            <tr>
                <td class="label-col">Rumah Diperiksa</td>
                <td>:</td>
                <td>1200</td>
            </tr>

            <tr>
                <td class="label-col">Rumah Positive Jentik</td>
                <td>:</td>
                <td>5</td>
            </tr>

            <tr>
                <td class="label-col">Presentase</td>
                <td>:</td>
                <td>x%</td>
            </tr>

        </table>
    </div>

</div>

<?= $this->endSection() ?>