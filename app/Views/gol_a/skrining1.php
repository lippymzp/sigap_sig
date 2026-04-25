<?= $this->include('layout/header') ?>
<div class="container mt-5">

<!-- STEP -->
<div class="step-wrapper mb-5">

    <div class="step-item">
        <span class="step active">1</span>
        <p>Informasi Umum</p>
    </div>

    <div class="step-line"></div>

    <div class="step-item">
        <span class="step inactive">2</span>
        <p>Pertanyaan Skrining</p>
    </div>

</div>

<!-- CARD -->
<div class="card-custom">

<h4><b>Informasi Umum</b></h4>
<p class="mb-5">Lengkapi beberapa info dasar sebelum Skrining dimulai</p>

<form method="post" action="/skriningdbd/skriningdbd2" id="formSkrining">

<div class="row gy-4">

<!-- KIRI -->
<div class="col-md-6">

<div class="mb-3">
<label>NIK</label>
<input type="text" name="nik" class="form-control">
</div>

<div class="mb-3">
<label>Nama Lengkap</label>
<input type="text" name="nama" class="form-control">
</div>

<div class="mb-3">
<label>Jenis Kelamin</label>
<select name="jenis_kelamin" class="form-select">
<option>-- Pilih --</option>
<option>Laki-laki</option>
<option>Perempuan</option>
</select>
</div>

<div class="mb-3">
<label>Tanggal Lahir</label>
<input type="date" id="tgl_lahir" name="tanggal_lahir" class="form-control">
</div>

<div class="mb-3">
<label>Kategori Usia</label>
<input type="text" id="kategori_usia" name="kategori_usia" class="form-control" readonly>
</div>

<div class="mb-3">
<label>Nomor Telepon</label>
<input type="text" name="telepon" class="form-control">
</div>

</div>

<!-- KANAN -->
<div class="col-md-6">

<label>Provinsi</label>
<select name="provinsi" id="provinsi" class="form-select"></select>
<div class="mb-3">

<label>Kabupaten</label>
<select name="kabupaten" id="kabupaten" class="form-select"></select>
</div>

<div class="mb-3">
<label>Kecamatan</label>
<select name="kecamatan" id="kecamatan" class="form-select"></select>
</div>

<div class="mb-3">
<label>Kelurahan</label>
<select name="kelurahan" id="kelurahan" class="form-select"></select>
</div>

<div class="mb-3">
<label>RT/RW</label>
<input type="text" name="rt_rw" id="rt_rw" class="form-control">
</div>

<div class="mb-3">
<label>Tanggal Skrining</label>
<input type="text" name="tanggal_skrining" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
</div>

</div>

</div>

<button class="btn btn-next w-100 mt-5">Selanjutnya</button>

</form>
</div>
</div>

<!-- FOOTER -->
<div class="footer">
<div class="container">
<div class="row">

<div class="col-md-4">
<div class="logo-footer">LOGO</div>
<p class="mt-3"><b>SIGAP</b><br>
Sistem Informasi, Geografis Analisis & Pemantauan</p>
<a href="#">Tentang Kami</a>
</div>

<div class="col-md-4">
<h6>Media Sosial</h6>
<p>@username</p>
</div>

<div class="col-md-4">
<h6>Informasi Kontak</h6>
<p>Email: email@company.com</p>
<p>Lokasi: Jember, Jawa Timur</p>
</div>

</div>
<hr>
<p class="text-center">Hak Cipta © 2026 SIGAP</p>
</div>
</div>

<!-- SCRIPT -->
<script>

// API wilayah Indonesia
const API = "https://www.emsifa.com/api-wilayah-indonesia/api";

// LOAD PROVINSI
fetch(`${API}/provinces.json`)
.then(res => res.json())
.then(data => {
    let prov = document.getElementById('provinsi');
    prov.innerHTML = `<option>Pilih Provinsi</option>`;
    data.forEach(d => {
        prov.innerHTML += `<option value="${d.id}">${d.name}</option>`;
    });
});

// LOAD KABUPATEN
document.getElementById('provinsi').addEventListener('change', function(){
    fetch(`${API}/regencies/${this.value}.json`)
    .then(res => res.json())
    .then(data => {
        let kab = document.getElementById('kabupaten');
        kab.innerHTML = `<option>Pilih Kabupaten</option>`;
        data.forEach(d => {
            kab.innerHTML += `<option value="${d.id}">${d.name}</option>`;
        });
    });
});

// LOAD KECAMATAN
document.getElementById('kabupaten').addEventListener('change', function(){
    fetch(`${API}/districts/${this.value}.json`)
    .then(res => res.json())
    .then(data => {
        let kec = document.getElementById('kecamatan');
        kec.innerHTML = `<option>Pilih Kecamatan</option>`;
        data.forEach(d => {
            kec.innerHTML += `<option value="${d.id}">${d.name}</option>`;
        });
    });
});

// LOAD KELURAHAN
document.getElementById('kecamatan').addEventListener('change', function(){
    fetch(`${API}/villages/${this.value}.json`)
    .then(res => res.json())
    .then(data => {
        let kel = document.getElementById('kelurahan');
        kel.innerHTML = `<option>Pilih Kelurahan</option>`;
        data.forEach(d => {
            kel.innerHTML += `<option value="${d.name}">${d.name}</option>`;
        });
    });
});

// AUTO KODE POS (dummy)
document.getElementById('kelurahan').addEventListener('change', function(){
    document.getElementById('kode_pos').value = " ";
});

// KATEGORI USIA
document.getElementById('tgl_lahir').addEventListener('change', function(){
    let umur = new Date().getFullYear() - new Date(this.value).getFullYear();
    let kategori = umur <= 12 ? "Anak" :
                   umur <= 17 ? "Remaja" :
                   umur <= 59 ? "Dewasa" : "Lansia";
    document.getElementById('kategori_usia').value = kategori;
});

// LIMIT NIK 16 DIGIT
document.querySelector('[name="nik"]').oninput = function(){
    this.value = this.value.replace(/\D/g, '').slice(0,16);
}
document.getElementById('formSkrining').addEventListener('submit', function(e){

    let requiredFields = [
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'kategori_usia',
        'telepon',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'rt_rw'
    ];

    for (let name of requiredFields) {
        let field = document.querySelector(`[name="${name}"]`);

        if (!field || field.value.trim() === "" || field.value === "-- Pilih --" || field.value.includes("Pilih")) {
            alert("Semua data wajib diisi sebelum melanjutkan!");
            field.focus();
            e.preventDefault();
            return;
        }
    }

});

</script>
<?= $this->include('layout/footer') ?>
