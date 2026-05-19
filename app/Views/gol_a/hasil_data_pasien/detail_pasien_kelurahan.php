<?php
$layout = $layout ?? 'layout/dashboard_layout_admin';
$kelurahan = $kelurahan ?? '-';
$nama_bulan = $nama_bulan ?? '-';
$tahun = $tahun ?? date('Y');
?>

<?= $this->extend($layout) ?>
<?= $this->section('content') ?>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
* {
    font-family: 'Poppins', sans-serif;
}

.custom-card {
    border-radius: 20px;
    background: #F4F8FA;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.custom-table thead th {
    background: #DDF8F9;
    color: #2b2b2b;
    font-weight: 600;
    border: 1px solid #BCEAEB;
}

.custom-table tbody tr {
    background: #EAF4F6;
}

.custom-table tbody tr:nth-child(even) {
    background: #F4FAFB;
}

.btn-back {
    border: 2px solid #20B8BE;
    background: white;
    color: #20B8BE;
    border-radius: 10px;
    padding: 8px 15px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.2s;
}

.btn-back:hover {
    background: #20B8BE;
    color: white;
}

.btn-action {
    border-radius: 6px;
    border: 1px solid #ddd;
}

.modal-content {
    border-radius: 15px;
}

.form-control,
.form-select {
    border-radius: 8px;
    background: #f8fafb;
}

.badge-status {
    border-radius: 6px;
    min-width: 80px;
    padding: 8px;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 style="color:#2c3e50; font-weight:600;">
        Data Pasien Kelurahan <?= esc($kelurahan) ?>
        (<?= esc($nama_bulan) ?> <?= esc($tahun) ?>)
    </h4>

    <a href="<?= base_url('dbd/hasil') ?>" class="btn-back">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>

<?php if (session()->getFlashdata('success')) : ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?= session()->getFlashdata('success') ?>',
    confirmButtonColor: '#20B8BE'
});
</script>
<?php endif; ?>

<div class="custom-card">
    <div class="table-responsive">
        <table class="table text-center align-middle custom-table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Pasien</th>
                    <th>JK</th>
                    <th>Usia</th>
                    <th>Tgl Kunjungan</th>
                    <th>Catatan Klinis</th>
                    <th>Alamat Lengkap</th>
                    <th>Status Akhir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($data_pasien)): ?>
                <?php $no = 1; ?>
                <?php foreach($data_pasien as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc((string)($p['nik'] ?? '')) ?></td>
                    <td class="text-start"><<?= esc((string)($p['nama_pasien'] ?? '')) ?></td>
                    <td><?= esc($p['jenis_kelamin']) ?></td>
                    <td>
                        <?php 
                        if (!empty($p['tgl_lahir'])) {
                            $lahir = new DateTime($p['tgl_lahir']);
                            $today = new DateTime('today');
                            $diff = $lahir->diff($today);
                            if ($diff->y < 1) {
                                $bulan = ($diff->m > 0) ? $diff->m : 1;
                                echo esc($bulan) . ' Bulan';
                            } else {
                                echo esc($diff->y) . ' Tahun';
                            }
                        } else {
                            echo esc($p['umur']) . ' Thn';
                        }
                        ?>
                    </td>
                    <td><?= !empty($p['tgl_kunjungan']) ? date('d-m-Y', strtotime($p['tgl_kunjungan'])) : '-' ?></td>
                    <td><?= esc($p['ctt_klinis']) ?></td>
                    <td class="text-start">
                        <?= esc($p['alamat_lengkap']) ?>,
                        RT <?= esc($p['rt']) ?>/RW <?= esc($p['rw']) ?>, 
                        Kel. <?= esc($p['kelurahan'] ?? '-') ?>, Kec. <?= esc($p['kecamatan'] ?? '-') ?>, <?= esc($p['kabupaten'] ?? '-') ?>, <?= esc($p['provinsi'] ?? '-') ?>
                    </td>
                    <td>
                        <span class="badge badge-status <?= $p['status_akhir'] == 'Meninggal' ? 'bg-danger' : 'bg-success' ?>">
                            <?= esc($p['status_akhir']) ?>
                        </span>
                    </td>
                    <td>
                        <?php 
                        // 1. Ambil id_jabatan dari session login
                        $session_jabatan = session()->get('id_jabatan'); 
                        ?>

                        <div class="btn-group gap-1">
                            <button
                                class="btn btn-sm btn-light text-primary btn-action"
                                title="Detail Informasi"
                                onclick='openModalRead(<?= json_encode($p, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                <i class="fa fa-eye"></i>
                            </button>

                            <?php if ($session_jabatan == 1 || $session_jabatan == 2 || $session_jabatan == 4) : ?>
                                <button class="btn btn-sm btn-secondary disabled" style="border-radius: 8px; opacity: 0.6; cursor: not-allowed;" title="Anda tidak memiliki akses">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-secondary disabled" style="border-radius: 8px; opacity: 0.6; cursor: not-allowed;" title="Anda tidak memiliki akses">
                                    <i class="fa fa-trash"></i>
                                </button>
                            <?php else : ?>
                                <button class="btn btn-sm text-white" 
                                        style="background: #20B8BE; border-radius: 8px;"
                                        onclick="openModalUpdate(<?= htmlspecialchars(json_encode($p)) ?>)">
                                    <i class="fa fa-edit"></i>
                                </button>
                                
                                <button class="btn btn-sm text-white" 
                                        style="background: #e74c3c; border-radius: 8px;"
                                        onclick="konfirmasiHapus('<?= base_url('dbd/delete-pasien/' . $p['id_pasien']) ?>')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Tidak ditemukan rincian data kunjungan pasien untuk wilayah ini.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalRead" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content p-3">
            <div class="modal-header border-0 pb-2">
                <h5 class="modal-title fw-bold" style="color:#2c3e50;">
                    <i class="fa fa-user-circle text-info"></i> Rincian Informasi Pasien
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-0">
                <table class="table table-striped table-bordered text-start mb-0" style="font-size:14px;">
                    <tr><th width="35%">NIK</th><td id="r_nik"></td></tr>
                    <tr><th>Nama Pasien</th><td id="r_nama"></td></tr>
                    <tr><th>Jenis Kelamin</th><td id="r_jk"></td></tr>
                    <tr><th>Tanggal Lahir</th><td id="r_tgl_lahir"></td></tr>
                    <tr><th>Usia Saat Ini</th><td id="r_umur"></td></tr>
                    <tr><th>Tanggal Pemeriksaan</th><td id="r_tgl_kunjungan"></td></tr>
                    <tr><th>Alamat Lengkap</th><td id="r_alamat"></td></tr>
                    <tr><th>RT / RW</th><td id="r_rtrw"></td></tr>
                    <tr><th>Kelurahan</th><td id="r_kel"></td></tr>
                    <tr><th>Kecamatan</th><td id="r_kec"></td></tr>
                    <tr><th>Kabupaten</th><td id="r_kab"></td></tr>
                    <tr><th>Provinsi</th><td id="r_prov"></td></tr>
                    <tr><th>Koordinat (Lat/Lng)</th><td id="r_koordinat"></td></tr>
                    <tr><th>Catatan Klinis</th><td id="r_ctt"></td></tr>
                    <tr><th>Status Akhir</th><td id="r_status"></td></tr>
                    <tr><th>Tindak Lanjut</th><td id="r_tindak"></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-3">
            <form id="formUpdate" method="POST" action="">
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-2">
                    <h5 class="modal-title fw-bold" style="color:#2c3e50;">
                        <i class="fa fa-edit text-warning"></i> Perbarui Data Pasien
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-0 text-start" style="font-size:14px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label fw-bold">NIK (Maks 16 Digit)</label>
                                <input type="text" name="nik" id="u_nik" class="form-control form-control-sm" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Nama Pasien</label>
                                <input type="text" name="nama_pasien" id="u_nama" class="form-control form-control-sm" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="u_jk" class="form-select form-select-sm">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="u_tgl_lahir" class="form-control form-control-sm" onchange="hitungUsiaOtomatis()" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Usia Otomatis (Berdasarkan Hari Ini)</label>
                                <input type="text" id="u_umur_display" class="form-control form-control-sm" readonly style="background: #e9ecef; font-weight: bold;">
                                <input type="hidden" name="umur" id="u_umur_hidden">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Tanggal Pemeriksaan</label>
                                <input type="date" name="tgl_kunjungan" id="u_tgl_kunjungan" class="form-control form-control-sm" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Catatan Klinis</label>
                                <input type="text" name="ctt_klinis" id="u_ctt" class="form-control form-control-sm" required placeholder="Ketik indikasi klinis medis bebas...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label fw-bold">Provinsi</label>
                                <select name="provinsi" id="u_provinsi" class="form-select form-select-sm" required>
                                    <option value="">- Pilih Provinsi -</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Kabupaten</label>
                                <select name="kabupaten" id="u_kabupaten" class="form-select form-select-sm" required disabled>
                                    <option value="">- Pilih Kabupaten -</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Kecamatan</label>
                                <select name="kecamatan" id="u_kecamatan" class="form-select form-select-sm" required disabled>
                                    <option value="">- Pilih Kecamatan -</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Kelurahan</label>
                                <select name="kelurahan" id="u_kelurahan" class="form-select form-select-sm" onchange="setKoordinatOtomatis(this.value)" required disabled>
                                    <option value="">- Pilih Kelurahan -</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label class="form-label fw-bold">Latitude</label>
                                    <input type="text" name="latitude" id="u_lat" class="form-control form-control-sm" readonly style="background: #e9ecef;">
                                </div>
                                <div class="col-6 mb-2">
                                    <label class="form-label fw-bold">Longitude</label>
                                    <input type="text" name="longitude" id="u_lng" class="form-control form-control-sm" readonly style="background: #e9ecef;">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold">Alamat Lengkap Jalan</label>
                                <textarea name="alamat_lengkap" id="u_alamat" class="form-control form-control-sm" rows="1"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label class="form-label fw-bold">RT</label>
                                    <input type="text" name="rt" id="u_rt" class="form-control form-control-sm">
                                </div>
                                <div class="col-6 mb-2">
                                    <label class="form-label fw-bold">RW</label>
                                    <input type="text" name="rw" id="u_rw" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-6 mb-2">
                            <label class="form-label fw-bold">Status Akhir</label>
                            <select name="status_akhir" id="u_status" class="form-select form-select-sm">
                                <option value="Sembuh">Sembuh</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label fw-bold">Tindak Lanjut</label>
                            <select name="tindak_lanjut" id="u_tindak" class="form-select form-select-sm">
                                <option value="PSN 3M Plus">PSN 3M Plus</option>
                                <option value="Fogging">Fogging</option>
                                <option value="Penyuluhan">Penyuluhan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-1">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" style="border-radius:8px;">Batal</button>
                    <button type="button" onclick="konfirmasiSimpan()" class="btn btn-sm text-white" style="background:#20B8BE; border-radius:8px; padding: 6px 15px;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
var koordinatDesa = {
    "Sumbersari": { lat: -8.1725, lng: 113.7033 },
    "Antirogo": { lat: -8.1570, lng: 113.6905 },
    "Karangrejo": { lat: -8.1652, lng: 113.6801 },
    "Wirolegi": { lat: -8.1498, lng: 113.7050 },
    "Tegalgede": { lat: -8.1801, lng: 113.6955 },
    "Tegal gede": { lat: -8.1801, lng: 113.6955 }
};

function openModalRead(data){
    document.getElementById('r_nik').innerText = data.nik ?? '-';
    document.getElementById('r_nama').innerText = data.nama_pasien ?? '-';
    document.getElementById('r_jk').innerText = data.jenis_kelamin ?? '-';
    
    if (data.tgl_lahir) {
        let birth = new Date(data.tgl_lahir);
        let now = new Date();
        let diffTime = Math.abs(now - birth);
        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        let diffMonths = Math.floor(diffDays / 30.41);
        let diffYears = Math.floor(diffDays / 365.25);

        document.getElementById('r_tgl_lahir').innerText = data.tgl_lahir.split('-').reverse().join('-');
        if (diffYears < 1) {
            document.getElementById('r_umur').innerText = (diffMonths > 0 ? diffMonths : 1) + ' Bulan';
        } else {
            document.getElementById('r_umur').innerText = diffYears + ' Tahun';
        }
    } else {
        document.getElementById('r_tgl_lahir').innerText = '-';
        document.getElementById('r_umur').innerText = (data.umur ?? '0') + ' Tahun';
    }

    document.getElementById('r_tgl_kunjungan').innerText = data.tgl_kunjungan ? data.tgl_kunjungan.split('-').reverse().join('-') : '-';
    document.getElementById('r_alamat').innerText = data.alamat_lengkap ?? '-';
    document.getElementById('r_rtrw').innerText = 'RT ' + (data.rt ?? '-') + ' / RW ' + (data.rw ?? '-');
    document.getElementById('r_kel').innerText = data.kelurahan ?? '-';
    document.getElementById('r_kec').innerText = data.kecamatan ?? '-';
    document.getElementById('r_kab').innerText = data.kabupaten ?? '-';
    document.getElementById('r_prov').innerText = data.provinsi ?? '-';
    document.getElementById('r_koordinat').innerText = `Lat: ${data.latitude ?? '-'}, Lng: ${data.longitude ?? '-'}`;
    document.getElementById('r_ctt').innerText = data.ctt_klinis ?? '-';
    document.getElementById('r_status').innerText = data.status_akhir ?? '-';
    document.getElementById('r_tindak').innerText = data.tindak_lanjut ?? '-';

    let myModal = new bootstrap.Modal(document.getElementById('modalRead'));
    myModal.show();
}

function hitungUsiaOtomatis() {
    let birthInput = document.getElementById('u_tgl_lahir').value;
    if (!birthInput) return;

    let birthDate = new Date(birthInput);
    let today = new Date(); // Menyesuaikan dengan tanggal hari ini (TODAY)

    let diffTime = today - birthDate;
    if (diffTime < 0) {
        document.getElementById('u_umur_display').value = "0 Bulan";
        document.getElementById('u_umur_hidden').value = 0;
        return;
    }

    let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    let diffMonths = Math.floor(diffDays / 30.41);
    let diffYears = Math.floor(diffDays / 365.25);

    if (diffYears < 1) {
        let m = diffMonths > 0 ? diffMonths : 1;
        document.getElementById('u_umur_display').value = m + " Bulan";
        document.getElementById('u_umur_hidden').value = 0; 
    } else {
        document.getElementById('u_umur_display').value = diffYears + " Tahun";
        document.getElementById('u_umur_hidden').value = diffYears;
    }
}

function setKoordinatOtomatis(kelurahanName) {
    if (!kelurahanName) return;
    let key = kelurahanName.trim();
    let latField = document.getElementById('u_lat');
    let lngField = document.getElementById('u_lng');

    if (koordinatDesa[key]) {
        latField.value = koordinatDesa[key].lat;
        lngField.value = koordinatDesa[key].lng;
    } else {
        latField.value = "-8.1725"; // Default fallback
        lngField.value = "113.7033";
    }
}

// FUNGSI LOAD API WILAYAH BERANTAI INDONESIA
async function loadApiWilayah(provSel = '', kabSel = '', kecSel = '', kelSel = '') {
    const provDropdown = document.getElementById('u_provinsi');
    const kabDropdown = document.getElementById('u_kabupaten');
    const kecDropdown = document.getElementById('u_kecamatan');
    const kelDropdown = document.getElementById('u_kelurahan');

    // 1. Ambil Semua Provinsi
    let resProv = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
    let provinces = await resProv.json();
    provDropdown.innerHTML = '<option value="">- Pilih Provinsi -</option>';
    let activeProvId = '';

    provinces.forEach(p => {
        let selected = (provSel.toUpperCase() === p.name.toUpperCase()) ? 'selected' : '';
        if (selected) activeProvId = p.id;
        provDropdown.innerHTML += `<option value="${p.name}" data-id="${p.id}" ${selected}>${p.name}</option>`;
    });

    // 2. Ambil Kabupaten
    const fetchKabupaten = async (provId, kabName) => {
        if (!provId) return;
        let res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`);
        let regencies = await res.json();
        kabDropdown.innerHTML = '<option value="">- Pilih Kabupaten -</option>';
        kabDropdown.disabled = false;
        let activeKabId = '';
        regencies.forEach(k => {
            let cleanKabName = kabName.toUpperCase().replace('KABUPATEN ', '').replace('KOTA ', '');
            let cleanApiKab = k.name.toUpperCase().replace('KABUPATEN ', '').replace('KOTA ', '');
            let selected = (cleanKabName === cleanApiKab) ? 'selected' : '';
            if (selected) activeKabId = k.id;
            kabDropdown.innerHTML += `<option value="${k.name}" data-id="${k.id}" ${selected}>${k.name}</option>`;
        });
        return activeKabId;
    };

    // 3. Ambil Kecamatan
    const fetchKecamatan = async (kabId, kecName) => {
        if (!kabId) return;
        let res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`);
        let districts = await res.json();
        kecDropdown.innerHTML = '<option value="">- Pilih Kecamatan -</option>';
        kecDropdown.disabled = false;
        let activeKecId = '';
        districts.forEach(kc => {
            let selected = (kecName.toUpperCase() === kc.name.toUpperCase()) ? 'selected' : '';
            if (selected) activeKecId = kc.id;
            kecDropdown.innerHTML += `<option value="${kc.name}" data-id="${kc.id}" ${selected}>${kc.name}</option>`;
        });
        return activeKecId;
    };

    // 4. Ambil Kelurahan
    const fetchKelurahan = async (kecId, kelName) => {
        if (!kecId) return;
        let res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`);
        let villages = await res.json();
        kelDropdown.innerHTML = '<option value="">- Pilih Kelurahan -</option>';
        kelDropdown.disabled = false;
        villages.forEach(vl => {
            let selected = (kelName.toUpperCase().replace(' ', '') === vl.name.toUpperCase().replace(' ', '')) ? 'selected' : '';
            kelDropdown.innerHTML += `<option value="${vl.name}" ${selected}>${vl.name}</option>`;
        });
    };

    // Alur inisialisasi awal saat modal diedit
    if (activeProvId) {
        let kabId = await fetchKabupaten(activeProvId, kabSel);
        if (kabId) {
            let kecId = await fetchKecamatan(kabId, kecSel);
            if (kecId) {
                await fetchKelurahan(kecId, kelSel);
            }
        }
    }

    // Handler Interaksi Perubahan Dropdown oleh User
    provDropdown.onchange = async function() {
        let opt = this.options[this.selectedIndex];
        let pid = opt.getAttribute('data-id');
        kabDropdown.innerHTML = '<option value="">- Pilih Kabupaten -</option>';
        kecDropdown.innerHTML = '<option value="">- Pilih Kecamatan -</option>';
        kelDropdown.innerHTML = '<option value="">- Pilih Kelurahan -</option>';
        kabDropdown.disabled = true; kecDropdown.disabled = true; kelDropdown.disabled = true;
        if (pid) await fetchKabupaten(pid, '');
    };

    kabDropdown.onchange = async function() {
        let opt = this.options[this.selectedIndex];
        let kid = opt.getAttribute('data-id');
        kecDropdown.innerHTML = '<option value="">- Pilih Kecamatan -</option>';
        kelDropdown.innerHTML = '<option value="">- Pilih Kelurahan -</option>';
        kecDropdown.disabled = true; kelDropdown.disabled = true;
        if (kid) await fetchKecamatan(kid, '');
    };

    kecDropdown.onchange = async function() {
        let opt = this.options[this.selectedIndex];
        let kcid = opt.getAttribute('data-id');
        kelDropdown.innerHTML = '<option value="">- Pilih Kelurahan -</option>';
        kelDropdown.disabled = true;
        if (kcid) await fetchKelurahan(kcid, '');
    };
}

function openModalUpdate(data){
    document.getElementById('formUpdate').action = `<?= base_url('dbd/update-pasien') ?>/${data.id_pasien}`;

    document.getElementById('u_nik').value = data.nik ?? '';
    document.getElementById('u_nama').value = data.nama_pasien ?? '';
    document.getElementById('u_jk').value = data.jenis_kelamin ?? 'Laki-laki';
    
    document.getElementById('u_tgl_lahir').value = data.tgl_lahir ?? '';
    document.getElementById('u_tgl_kunjungan').value = data.tgl_kunjungan ?? '';
    
    document.getElementById('u_ctt').value = data.ctt_klinis ?? '';
    document.getElementById('u_alamat').value = data.alamat_lengkap ?? '';
    document.getElementById('u_rt').value = data.rt ?? '';
    document.getElementById('u_rw').value = data.rw ?? '';
    document.getElementById('u_status').value = data.status_akhir ?? 'Sembuh';
    document.getElementById('u_tindak').value = data.tindak_lanjut ?? 'PSN 3M Plus';

    document.getElementById('u_lat').value = data.latitude ?? '0.0';
    document.getElementById('u_lng').value = data.longitude ?? '0.0';

    // Panggil Kalkulasi Usia & Pemuatan Data API Alamat Berantai
    hitungUsiaOtomatis();
    loadApiWilayah(data.provinsi ?? '', data.kabupaten ?? '', data.kecamatan ?? '', data.kelurahan ?? '');

    let myModal = new bootstrap.Modal(document.getElementById('modalUpdate'));
    myModal.show();
}

function konfirmasiHapus(urlDelete){
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data pasien yang dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak, Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        reverseButtons: true
    }).then((result) => {
        if(result.isConfirmed){
            window.location.href = urlDelete;
        }
    });
}

function konfirmasiSimpan(){
    let form = document.getElementById('formUpdate');
    let nikValue = document.getElementById('u_nik').value;

    if (nikValue.length !== 16) {
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Validasi',
            text: 'Format NIK tidak valid! Harus tepat berjumlah 16 digit angka.',
            confirmButtonColor: '#dc3545'
        });
        return;
    }

    if(!form.checkValidity()){
        form.reportValidity();
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Menyimpan',
        text: 'Apakah Anda yakin ingin menyimpan perubahan data pasien ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Tidak, Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        reverseButtons: true
    }).then((result) => {
        if(result.isConfirmed){
            form.submit();
        }
    });
}
</script>

<?= $this->endSection() ?>