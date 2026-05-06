<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>

<?php if (!empty($pasien)): ?>

<div class="container-fluid">

    <!-- CARD -->
    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-body p-4">

            <form action="<?= base_url('tbc/update/' . $pasien['id_pasien']) ?>" method="post">
                <div class="row">

                    <!-- NO RM -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            No RM
                        </label>

                        <input type="text"
                               name="no_rm"
                               class="form-control rounded-3"
                               value="<?= $pasien['no_rm'] ?>">

                    </div>

                    <!-- NAMA PASIEN -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Nama Pasien
                        </label>

                        <input type="text"
                               name="nama_pasien"
                               class="form-control rounded-3"
                               value="<?= $pasien['nama_pasien'] ?>">

                    </div>

                    <!-- JENIS KELAMIN -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Jenis Kelamin
                        </label>

                        <select name="jenis_kelamin"
                                class="form-select rounded-3">

                            <option value="1"
                                <?= $pasien['jenis_kelamin'] == 1 ? 'selected' : '' ?>>
                                Perempuan
                            </option>

                            <option value="2"
                                <?= $pasien['jenis_kelamin'] == 2 ? 'selected' : '' ?>>
                                Laki-laki
                            </option>

                        </select>

                    </div>

                    <!-- UMUR -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Umur
                        </label>

                        <input type="number"
                               name="umur"
                               class="form-control rounded-3"
                               value="<?= $pasien['umur'] ?>">

                    </div>

                    <!-- TANGGAL KUNJUNGAN -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            Tanggal Kunjungan
                        </label>

                        <input type="date"
                               name="tgl_kunjungan"
                               class="form-control rounded-3"
                               value="<?= date('Y-m-d', strtotime($pasien['tgl_kunjungan'])) ?>">

                    </div>

                    <!-- ID WILAYAH -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label fw-semibold">
                            ID Wilayah
                        </label>

                        <input type="text"
                               name="id_wilayah"
                               class="form-control rounded-3"
                               value="<?= $pasien['id_wilayah'] ?>">

                    </div>

                    <!-- CATATAN KLINIS -->
                    <div class="col-md-12 mb-4">

                        <label class="form-label fw-semibold">
                            Catatan Klinis
                        </label>

                        <textarea name="ctt_klinis"
                                  rows="5"
                                  class="form-control rounded-3"><?= $pasien['ctt_klinis'] ?></textarea>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2">

                    <button type="submit"
                            class="btn text-white px-4 rounded-3"
                            style="background:#00CED1;">

                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Update Data

                    </button>

                    <a href="<?= base_url('tbc/hasil') ?>"
                       class="btn btn-secondary rounded-3 px-4">

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php endif; ?>

<?= $this->endSection() ?>