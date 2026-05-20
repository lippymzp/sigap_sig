<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body, input, button, select, textarea {
    font-family: 'Poppins', sans-serif;
}

/* Header puskesmas */
.header-puskesmas, 
.header-posyandu {
    display: flex;
    align-items: center;
    gap: 15px;
    background: linear-gradient(90deg, #26c6da, #4dd0e1);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 600;
}

.header-icon img {
    width: 40px;
    height: 40px;
}

/* Form container */
.form-container-create {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    margin-top: 20px;
    box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
}

/* Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 5px;
}

.row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.required::after {
    content: " *";
    color: red;
    font-weight: bold;
}

/* Input */
.form-group input,
.form-group select {
    padding: 8px 12px;
    border-radius: 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    outline: none;
    transition: all 0.2s;
    background-color: #f2f4f7;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #26c6da;
    box-shadow: 0 0 6px rgba(38,198,218,0.3);
}

/* readonly */
input[readonly],
select:disabled {
    cursor: not-allowed;
}

/* ACTION */
.form-action {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-top: 30px;
}

.btn-back,
.btn-save {
    width: 100%;
    padding: 14px 0;
    border-radius: 25px;
    font-weight: 600;
    font-size: 15px;
    height: 48px;
}

.btn-back {
    background: #fff;
    color: #333;
    border: 1px solid #ccc;
}

.btn-save {
    background: #00acc1;
    color: white;
    border: none;
    opacity: .6;
    cursor: not-allowed;
    pointer-events: none;
}

/* KELURAHAN */
.kelurahan-wrapper {
    width: 600px !important;
    display: flex;
    gap: 10px;
    align-items: center;
}

.kelurahan-wrapper input {
    width: 400px;
    padding: 8px 12px;
    border-radius: 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    background-color: #f2f4f7;
}

.btn-tambah-kelurahan {
    background: transparent;
    border: none;
    color: #555;
    font-size: 1.2rem;
}

/* POSYANDU BUTTON */
.btn-tambah-posyandu {
    width: 400px !important;
    background: #26c6da;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 8px 12px;
    font-size: 16px;
}

/* POSYANDU */
.posyandu-item{
    position: relative;
    width: 445px;
    margin-bottom: 12px;
}

.input-posyandu{
    width: 400px;
    padding: 8px 12px;
    border-radius: 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    background-color: #ebf8fc;
}

.btn-plus-pos{
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: transparent;
    color: #26c6da;
    font-size: 24px;
}

.input-group-text{
    font-size: 14px;
}
</style>

<!-- HEADER -->
<div class="header-puskesmas">
    <div class="header-icon">
        <img src="/img/icon_breadcrumb.svg">
    </div>

    <div>
        <h5>Manajemen Puskesmas</h5>
        <small>Detail data puskesmas</small>
    </div>
</div>

<!-- FORM -->
<div class="form-container-create">

<form>

    <div class="form-grid">

        <!-- PUSKESMAS -->
        <div class="form-group">

            <label class="required">Nama Puskesmas</label>

            <select class="form-control" disabled>

                <?php foreach($instansiList as $instansi): ?>

                    <option 
                        value="<?= $instansi['id_instansi'] ?>"
                        <?= $puskesmas['id_instansi'] == $instansi['id_instansi'] ? 'selected' : '' ?>>
                        <?= isset($puskesmas['id_instansi']) && $puskesmas['id_instansi'] == $instansi['id_instansi'] ? 'selected' : '' ?>
                        <?= $instansi['nama_instansi'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <!-- TELEPON -->
        <div class="form-group">

            <label class="required">Nomor Telepon Puskesmas</label>

            <div class="input-group">

                <span class="input-group-text">(+62)</span>

                <input 
                    type="text"
                    class="form-control"
                    value="<?= $puskesmas['no_telpon_puskesmas'] ?>"
                    readonly>

            </div>

        </div>

        <!-- EMAIL -->
        <div class="form-group">

            <label class="required">Email Puskesmas</label>

            <input 
                type="email"
                value="<?= $puskesmas['email_puskesmas'] ?>"
                readonly>

        </div>

    </div>

    <!-- ROW -->
    <div class="row-2">

        <div class="form-group">

            <label class="required">Kecamatan</label>

            <select class="form-control" disabled>

                <?php foreach($kecamatanList as $kec): ?>

                    <option
                        <?= $puskesmas['id_kecamatan'] == $kec['id_kecamatan'] ? 'selected' : '' ?>>

                        <?= $kec['nama_kecamatan'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="form-group">

            <label>Kode Pos</label>

            <input 
                type="text"
                value="<?= $puskesmas['kode_pos'] ?>"
                readonly>

        </div>

    </div>

    <!-- ALAMAT -->
    <div class="form-group full-width">

        <label class="required">Alamat Lengkap</label>

        <input 
            type="text"
            value="<?= $puskesmas['alamat'] ?>"
            readonly>

    </div>

    <!-- LAT LNG -->
    <div class="row-2">

        <div class="form-group">

            <label>Latitude (lintang)</label>

            <input 
                type="text"
                value="<?= $puskesmas['latitude'] ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Longitude (bujur)</label>

            <input 
                type="text"
                value="<?= $puskesmas['longitude'] ?>"
                readonly>

        </div>

    </div>

    <!-- KELURAHAN -->
    <div class="form-group">

        <label>Daftar Kelurahan & Posyandu</label>

        <div id="hasil-kelurahan">

            <?php if(!empty($kelurahanData)): ?>

                <?php foreach($kelurahanData as $index => $item): ?>

                    <div class="d-flex justify-content-between align-items-center mt-2">

                        <input
                            type="text"
                            class="form-control"
                            value="<?= $item['nama_kelurahan'] ?>"
                            readonly>

                        <?php if(!empty($item['posyandu'])): ?>

                            <button
                                type="button"
                                class="btn-tambah-posyandu ms-2"
                                onclick="bukaPosyandu(<?= $index ?>)">

                                Lihat Pos Posyandu

                            </button>

                        <?php else: ?>

                            <button
                                type="button"
                                class="btn-tambah-posyandu ms-2"
                                disabled
                                style="opacity:.5; cursor:not-allowed;">

                                Belum Ada Posyandu

                            </button>

                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="text-muted mt-2">
                    Belum ada data kelurahan
                </div>

            <?php endif; ?>

        </div>

    </div>

    <!-- BUTTON -->
    <div class="form-action">

        <a href="/superadmin/puskesmas">

            <button 
                type="button"
                class="btn-back">

                Batal

            </button>

        </a>

        <button 
            type="button"
            class="btn-save">

            Simpan

        </button>

    </div>

</form>

</div>

<!-- POSYANDU -->
<div class="form-container-posyandu" style="display:none;">

    <div class="header-posyandu">

        <div class="header-icon">
            <img src="/img/icon_breadcrumb.svg">
        </div>

        <div>
            <h5>Manajemen Puskesmas</h5>
            <small>Detail data posyandu</small>
        </div>

    </div>

    <div class="form-container-create">

        <div class="row-2">

            <div class="form-group">

                <label>Nama Puskesmas</label>

                <input
                    type="text"
                    id="posyandu-puskesmas"
                    readonly>

            </div>

            <div class="form-group">

                <label>Kelurahan</label>

                <input
                    type="text"
                    id="posyandu-kelurahan"
                    readonly>

            </div>

        </div>

        <div class="form-group">

            <label>Daftar Pos Posyandu</label>

            <div id="list-posyandu"></div>

        </div>

        <div class="form-action">

            <button
                type="button"
                class="btn-back"
                onclick="kembaliCreate()">

                Batal

            </button>

            <button
                type="button"
                class="btn-save">

                Simpan

            </button>

        </div>

    </div>

</div>

<script>

let daftarKelurahan = <?= json_encode($kelurahanData) ?>;
let currentKelurahanIndex = null;

function bukaPosyandu(index){

    currentKelurahanIndex = index;

    document.querySelector('.form-container-create')
    .style.display = 'none';

    document.querySelector('.header-puskesmas')
    .style.display = 'none';

    document.querySelector('.form-container-posyandu')
    .style.display = 'block';

    document.getElementById('posyandu-puskesmas').value =
        "<?= $puskesmas['nama_puskesmas'] ?>";

    document.getElementById('posyandu-kelurahan').value =
        daftarKelurahan[index].nama_kelurahan;

    renderPosyandu();
}

function renderPosyandu(){

    const list = document.getElementById('list-posyandu');

    list.innerHTML = '';

    // ambil data posyandu
    const posyanduList =
        daftarKelurahan[currentKelurahanIndex].posyandu || [];

    // kalau kosong
    if(posyanduList.length === 0){

        list.innerHTML = `

        <div class="posyandu-item">

            <input
                type="text"
                class="form-control input-posyandu"
                value="Belum ada posyandu"
                readonly>

        </div>

        `;

        return;
    }

    // kalau ada data
    posyanduList.forEach((item) => {

        list.innerHTML += `
        
        <div class="posyandu-item">

            <input
                type="text"
                class="form-control input-posyandu"
                value="${item}"
                readonly>

        </div>

        `;
    });
}

function kembaliCreate(){

    document.querySelector('.form-container-posyandu')
    .style.display = 'none';

    document.querySelector('.form-container-create')
    .style.display = 'block';

    document.querySelector('.header-puskesmas')
    .style.display = 'flex';
}
</script>

<?= $this->endSection() ?>