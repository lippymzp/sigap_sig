<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-body p-4">

            <form action="<?= base_url('tbc/store') ?>" method="post">
                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            No RM
                        </label>

                        <input type="text"
                               name="no_rm"
                               class="form-control rounded-3">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nama Pasien
                        </label>

                        <input type="text"
                               name="nama_pasien"
                               class="form-control rounded-3">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Jenis Kelamin
                        </label>

                        <select name="jenis_kelamin"
                                class="form-select rounded-3">

                            <option value="1">
                                Laki-laki
                            </option>

                            <option value="2">
                                Perempuan
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Umur
                        </label>

                        <input type="number"
                               name="umur"
                               class="form-control rounded-3">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tanggal Kunjungan
                        </label>

                        <input type="date"
                               name="tgl_kunjungan"
                               class="form-control rounded-3">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            ID Wilayah
                        </label>

                        <input type="text"
                               name="id_wilayah"
                               class="form-control rounded-3">

                    </div>

                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            Catatan Klinis
                        </label>

                        <textarea name="ctt_klinis"
                                  rows="4"
                                  class="form-control rounded-3"></textarea>

                    </div>

                </div>

                <button type="submit"
                        class="btn text-white px-4 rounded-3"
                        style="background:#00CED1;">

                    Simpan Data

                </button>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>