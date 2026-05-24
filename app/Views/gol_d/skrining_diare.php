<?= $this->include('layout/header') ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
body,
section,
div,
form,
input,
select,
button,
label,
h1,h2,h3,h4,h5,h6,
p,
span{
    font-family:'Poppins', sans-serif !important;
}

/* STEP */
.step-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:20px;
    margin-bottom:35px;
}

.step-item{
    text-align:center;
}

.step-circle{
    width:45px;
    height:45px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    background:#d9f7f5;
    color:#00cfc8;
    margin:auto;
}

.step-active .step-circle{
    background:#14d8d4;
    color:white;
}

.step-title{
    margin-top:8px;
    font-size:14px;
    font-weight:500;
}

.step-line{
    width:70px;
    height:2px;
    background:#dbeeee;
}

/* CARD */
.skrining-card{
    border:2px solid #00c9cf;
    border-radius:20px;
    padding:50px;
    background:white;
    box-shadow:0 12px 35px rgba(0,0,0,0.06);
}

/* TYPO */
.skrining-title{
    font-size:24px;
    font-weight:700;
    color:#17233c;
    margin-bottom:6px;
}

.skrining-sub{
    color:#555;
    font-size:16px;
    margin-bottom:40px;
}

/* FORM */
.form-label{
    font-size:15px;
    font-weight:500;
    color:#111;
    margin-bottom:8px;
}

.modern-input{
    height:46px;
    border-radius:12px;
    border:1px solid #d6dce3;
    padding:0 14px;
    font-size:15px;
    box-shadow:none !important;
}

.modern-input:focus{
    border-color:#14d8d4;
    box-shadow:0 0 0 0.15rem rgba(20,216,212,0.15) !important;
}

/* BUTTON */
.btn-next{
    width:100%;
    background:#00BBC2;
    color:white;
    border:none;
    height:52px;
    border-radius:12px;
    font-weight:700;
    font-size:18px;
    transition:.3s;
}

.btn-next:hover{
    background:#444;
    color:white;
}

/* MOBILE */
@media(max-width:768px){
    .skrining-card{
        padding:25px;
    }

    .step-line{
        width:35px;
    }

    .skrining-title{
        font-size:20px;
    }
}
</style>

<section class="container mt-5 mb-5">

<!-- STEP -->
<div class="step-wrapper">

    <div class="step-item step-active">
        <div class="step-circle">1</div>
        <div class="step-title">Informasi Umum</div>
    </div>

    <div class="step-line"></div>

    <div class="step-item">
        <div class="step-circle">2</div>
        <div class="step-title">Pertanyaan Skrining</div>
    </div>

</div>

<form action="<?= base_url('skrining-diare-step2') ?>" method="post" id="formSkrining">

<div class="skrining-card">

    <h3 class="skrining-title">Informasi Umum</h3>
    <p class="skrining-sub">Lengkapi beberapa info dasar sebelum Skrining dimulai</p>

    <div class="row g-4">

        <!-- KIRI -->
        <div class="col-md-6">

            <label class="form-label">NIK</label>
          <input
    name="nik"
    class="form-control modern-input"
    placeholder="Masukkan Nomor Induk Kependudukan"
    required
>

            <label class="form-label mt-3">Nama Lengkap</label>
            <input name="nama" class="form-control modern-input">

            <label class="form-label mt-3">Jenis Kelamin</label>
            <select name="jk" class="form-control modern-input">
                <option>-- Pilih --</option>
                <option>Laki-laki</option>
                <option>Perempuan</option>
            </select>

            <label class="form-label mt-3">Tanggal Lahir</label>
           <input type="date" id="tgl_lahir" name="tgl" class="form-control modern-input">

            <label class="form-label mt-3">Kategori Usia</label>
            <input
    type="text"
    id="kategori_usia"
    class="form-control modern-input"
    placeholder="Otomatis sesuai tanggal lahir"
    readonly
>

<input type="hidden" id="usia" name="usia">

            <label class="form-label mt-3">Nomor Telepon</label>
          <input
    name="hp"
    class="form-control modern-input"
    placeholder="Masukkan Nomor Telepon"
>

        </div>

        <!-- KANAN -->
        <div class="col-md-6">

            <label class="form-label">Provinsi</label>
            <select name="prov" id="provinsi" class="form-control modern-input" required></select>
                <option>Pilih Provinsi</option>
            </select>

            <label class="form-label mt-3">Kabupaten</label>
          <select name="kab" id="kabupaten" class="form-control modern-input" required></select>
                <option></option>
            </select>

            <label class="form-label mt-3">Kecamatan</label>
         <select name="kec" id="kecamatan" class="form-control modern-input" required></select>
                <option></option>
            </select>

            <label class="form-label mt-3">Kelurahan</label>
           <select name="kel" id="kelurahan" class="form-control modern-input" required></select>
                <option></option>
            </select>
<input type="hidden" name="prov_nama" id="provinsi_nama">
<input type="hidden" name="kab_nama" id="kabupaten_nama">
<input type="hidden" name="kec_nama" id="kecamatan_nama">
            <label class="form-label mt-3">RT/RW</label>
         <input
    name="kodepos"
    id="rt_rw"
    class="form-control modern-input"
    placeholder="Masukkan RT/RW"
>

            <label class="form-label mt-3">Tanggal Skrining</label>
            <input 
                value="<?= date('d-m-Y') ?>"
                class="form-control modern-input"
                readonly
            >

        </div>

    </div>

    <div class="mt-5">
        <button class="btn-next">
            Selanjutnya
        </button>
    </div>

</div>

</form>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const API = "https://www.emsifa.com/api-wilayah-indonesia/api";

// PROVINSI
fetch(`${API}/provinces.json`)
.then(res => res.json())
.then(data => {
    let prov = document.getElementById('provinsi');
    prov.innerHTML = `<option value="">Pilih Provinsi</option>`;

    data.forEach(d => {
        prov.innerHTML += `<option value="${d.id}" data-name="${d.name}">${d.name}</option>`;
    });
});

// KABUPATEN
document.getElementById('provinsi').addEventListener('change', function(){
    fetch(`${API}/regencies/${this.value}.json`)
    .then(res => res.json())
    .then(data => {
        let kab = document.getElementById('kabupaten');
        kab.innerHTML = `<option value="">Pilih Kabupaten</option>`;

        data.forEach(d => {
            kab.innerHTML += `<option value="${d.id}" data-name="${d.name}">${d.name}</option>`;
        });
    });

    document.getElementById('provinsi_nama').value =
        this.options[this.selectedIndex].dataset.name || '';
});

// KECAMATAN
document.getElementById('kabupaten').addEventListener('change', function(){
    fetch(`${API}/districts/${this.value}.json`)
    .then(res => res.json())
    .then(data => {
        let kec = document.getElementById('kecamatan');
        kec.innerHTML = `<option value="">Pilih Kecamatan</option>`;

        data.forEach(d => {
            kec.innerHTML += `<option value="${d.id}" data-name="${d.name}">${d.name}</option>`;
        });
    });

    document.getElementById('kabupaten_nama').value =
        this.options[this.selectedIndex].dataset.name || '';
});

// KELURAHAN
document.getElementById('kecamatan').addEventListener('change', function(){
    fetch(`${API}/villages/${this.value}.json`)
    .then(res => res.json())
    .then(data => {
        let kel = document.getElementById('kelurahan');
        kel.innerHTML = `<option value="">Pilih Kelurahan</option>`;

        data.forEach(d => {
            kel.innerHTML += `<option value="${d.name}">${d.name}</option>`;
        });
    });

    document.getElementById('kecamatan_nama').value =
        this.options[this.selectedIndex].dataset.name || '';
});

// AUTO USIA
document.getElementById('tgl_lahir').addEventListener('change', function(){
    const tgl = new Date(this.value);
    const now = new Date();

    let umur = now.getFullYear() - tgl.getFullYear();
    let bulan = now.getMonth() - tgl.getMonth();

    if (bulan < 0 || (bulan === 0 && now.getDate() < tgl.getDate())) {
        umur--;
    }

    let kategori =
        umur <= 6 ? 'Bayi dan Anak Pra-sekolah' :
        umur <= 18 ? 'Sekolah dan Remaja' :
        umur <= 59 ? 'Dewasa' :
        'Lansia';

    document.getElementById('kategori_usia').value = kategori;
    document.getElementById('usia').value = umur;
});

// LIMIT NIK
document.querySelector('[name="nik"]').addEventListener('input', function(){
    this.value = this.value.replace(/\D/g, '').slice(0,16);
});

// VALIDASI
document.getElementById('formSkrining').addEventListener('submit', function(e){

    let wajib = [
        'nik','nama','jk','tgl','usia','hp','prov','kab','kec','kel','kodepos'
    ];

    for(let n of wajib){
        let field = document.querySelector(`[name="${n}"]`);

        if(!field || field.value.trim() === "" || field.value.includes("Pilih")){
            e.preventDefault();

            Swal.fire({
                icon:'info',
                title:'Lengkapi data dulu 🌟',
                text:'Semua informasi wajib diisi sebelum lanjut skrining',
                confirmButtonColor:'#00BBC2'
            });

            field.focus();
            return;
        }
    }
});
</script>
<?= $this->include('layout/footer') ?>