<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-body p-4">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h3 class="fw-bold mb-1"
                        style="color:#1F3A3A;">

                        Hasil Data Pasien

                    </h3>

                    <small style="color:#6B8A8A;">
                        Data pasien yang telah diinput
                    </small>

                </div>

                <a href="<?= base_url('tbc/input_data') ?>"
                   class="btn text-white rounded-3 px-4"
                   style="background:#2CCFC0;">

                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Pasien

                </a>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table align-middle">

                    <thead style="background:#E0F7F6;">

                        <tr>

                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Tanggal Kunjungan</th>
                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach($pasien ?? [] as $p): ?>

                        <tr>

                            <!-- NO RM -->
                            <td>
                                <?= $p['no_rm']; ?>
                            </td>

                            <!-- NAMA -->
                            <td>

                                <strong style="color:#1F3A3A;">
                                    <?= $p['nama_pasien']; ?>
                                </strong>

                            </td>

                            <!-- JK -->
                            <td>

                                <?= $p['jenis_kelamin'] == 1 
                                    ? 'Perempuan' 
                                    : 'Laki-laki'; ?>

                            </td>

                            <!-- UMUR -->
                            <td>

                                <?= $p['umur']; ?> Tahun

                            </td>

                            <!-- TANGGAL -->
                            <td>

                                <?= date('d-m-Y', strtotime($p['tgl_kunjungan'])) ?>

                            </td>

                            <!-- AKSI -->
                            <td class="text-center">

                                <!-- EDIT -->
                                 <a href="<?= base_url('tbc/edit/' . $p['id_pasien']) ?>"
                                class="btn btn-warning btn-sm rounded-3">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <!-- HAPUS -->
                                <button type="button"
                                        class="btn btn-danger btn-sm rounded-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#hapusModal<?= $p['id_pasien'] ?>">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </td>

                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade"
                             id="hapusModal<?= $p['id_pasien'] ?>"
                             tabindex="-1">

                            <div class="modal-dialog modal-dialog-centered"
                            style="max-width:320px;">

                                 <div class="modal-content border-0 rounded-4 shadow-lg">

                                   <div class="modal-body text-center p-3">

                                        <!-- ICON -->
                                        <div class="mb-3">

                                            <div class="rounded-circle
                                                        d-inline-flex
                                                        justify-content-center
                                                        align-items-center"
                                                 style="
                                                width:55px;
                                                height:55px;
                                                 background:#ffebee;">

                                                <i class="fa-solid fa-trash"
                                                   style="
                                                   font-size:22px;
                                                   color:#ef4444;"></i>

                                            </div>

                                        </div>

                                        <!-- TITLE -->
                                        <h4 class="fw-bold mb-2">

                                            Hapus Data

                                        </h3>

                                        <!-- TEXT -->
                                        <p class="text-muted mb-4">

                                            Apakah Anda yakin ingin
                                            menghapus data pasien ini?

                                        </p>

                                        <!-- BUTTON -->
                                        <div class="d-grid gap-2">

                                            <a href="<?= base_url('tbc/delete/' . $p['id_pasien']) ?>"
                                               class="btn text-white rounded-3 py-2"
                                               style="background:#00CED1;">

                                                Ya

                                            </a>

                                            <button type="button"
                                                    class="btn btn-light rounded-3 py-2"
                                                    data-bs-dismiss="modal">

                                                Tidak

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>