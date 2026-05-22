<?php $this->setVar('penyakit', 'tbc'); ?>
<?= $this->include('layout/header') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">


<style>

:root{
    --primary:#40EDD0;
    --dark:#00CED1;
    --medium:#48D1CC;

    --bg:#F4FEFD;
    --card:#FFFFFF;
    --accent:#2CCFC0;
    --border:#B8ECE8;

    --text-dark:#1F3A3A;
    --text-light:#6B8A8A;
}

/* GLOBAL */
body{
    background:var(--bg);
    color:var(--text-dark);
    font-family:'Poppins',sans-serif;
}

/* WRAPPER */
.form-wrapper{
    padding:60px 20px;
}

/* STEP */
.step-wrapper{
    position:relative;
    margin-bottom:50px;
}

.step-gap{
    gap:140px;
}

.step-line{
    position:absolute;
    top:18px;
    left:50%;
    transform:translateX(-50%);
    width:240px;
    border-top:2px dashed var(--border);
}

.step-item{
    position:relative;
    z-index:2;
}

.step-box{
    width:42px;
    height:42px;
    border-radius:14px;
    border:2px solid var(--dark);
    display:flex;
    align-items:center;
    justify-content:center;
    background:white;
    color:var(--dark);
    font-weight:700;
    margin:auto;
    transition:.3s;
}

.step-item.active .step-box{
    background:linear-gradient(
        135deg,
        var(--dark),
        var(--primary)
    );
    border:none;
    color:white;
    box-shadow:0 8px 20px rgba(0,206,209,.25);
}

.step-item small{
    margin-top:10px;
    display:block;
    color:var(--text-light);
    font-size:13px;
}

/* FORM BOX */
.form-box{
    max-width:1100px;
    margin:auto;
    background:white;
    border-radius:28px;
    padding:45px;
    border:1px solid var(--border);
    box-shadow:0 10px 35px rgba(0,0,0,.05);
}

.form-box h5{
    font-size:30px;
    font-weight:800;
    margin-bottom:8px;
}

.form-box small{
    color:var(--text-light);
    font-size:14px;
}

/* LABEL */
label{
    font-size:14px;
    font-weight:600;
    margin-bottom:8px;
    color:var(--text-dark);
}

/* INPUT */
.form-control,
.form-select{
    border-radius:14px;
    border:1px solid #d8efed;
    padding:14px 16px;
    height:52px;
    font-size:14px;
    box-shadow:none !important;
    transition:.25s;
}

.form-control:focus,
.form-select:focus{
    border-color:var(--dark);
    box-shadow:0 0 0 4px rgba(0,206,209,.12) !important;
}

/* RT RW */
.input-rt{
    text-align:center;
    font-weight:600;
}

/* INPUT TANGGAL */
.input-tanggal{
    background:#eefdfc;
    color:var(--dark);
    font-weight:700;
}

/* BUTTON */
.btn-next{
    width:100%;
    margin-top:35px;
    padding:16px;
    border:none;
    border-radius:18px;
    background:linear-gradient(
        135deg,
        var(--dark),
        var(--primary)
    );
    color:white;
    font-size:16px;
    font-weight:700;
    transition:.25s;
    box-shadow:0 10px 24px rgba(0,206,209,.25);
}

.btn-next:hover{
    transform:translateY(-2px);
}

/* MOBILE */
@media(max-width:768px){

    .form-box{
        padding:30px 20px;
    }

    .step-gap{
        gap:60px;
    }

    .step-line{
        width:120px;
    }

    .form-box h5{
        font-size:24px;
    }
}

</style>


<div class="form-wrapper">

    <!-- STEP -->
    <div class="step-wrapper text-center">

        <div class="step-line"></div>

        <div class="d-flex justify-content-center step-gap">

            <!-- STEP 1 -->
            <div class="step-item active">
                <div class="step-box">1</div>
                <small>Informasi Umum</small>
            </div>

            <!-- STEP 2 -->
            <div class="step-item">
                <div class="step-box">2</div>
                <small>Pertanyaan Skrining</small>
            </div>

        </div>

    </div> <!-- TUTUP STEP -->

<div class="form-box">

    <h5><b>Informasi Umum</b></h5>
    <small>Lengkapi beberapa info dasar sebelum Skrining dimulai</small>

    <form method="post" action="/skrining-tbc/step2">

                <div class="row mt-4">

                    <!-- KIRI -->
                    <div class="col-md-6">
        <label>Nomor Induk Kependudukan</label>
        <input 
            type="text"
            name="nik"
            class="form-control mb-3" 
            placeholder="Masukkan Nomor Induk Kependudukan"
        >

        <label>Nama Lengkap</label>
        <input 
            type="text"
            name="nama"
            class="form-control mb-3" 
            placeholder="Masukkan Nama Lengkap"
        >

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select mb-3" required>

            <option value="" selected disabled>
                -- Pilih Jenis Kelamin --
            </option>

            <option value="Perempuan">Perempuan</option>
            <option value="Laki-laki">Laki-laki</option>

        </select>

        <label>Tanggal Lahir</label>
<input 
    type="date"
    name="tanggal_lahir"
    id="tanggal_lahir"
    class="form-control mb-3"
>

<label>Usia</label>
<input 
    type="text"
    name="usia"
    id="usia"
    class="form-control mb-3" 
    placeholder="Usia otomatis"
    readonly
>

<script>
document.getElementById('tanggal_lahir').addEventListener('change', function () {

    const tanggalLahir = new Date(this.value);
    const hariIni = new Date();

    let tahun = hariIni.getFullYear() - tanggalLahir.getFullYear();
    let bulan = hariIni.getMonth() - tanggalLahir.getMonth();

    // Kalau tanggal sekarang belum melewati tanggal lahir
    if (bulan < 0) {
        tahun--;
        bulan += 12;
    }

    // Kalau hari sekarang lebih kecil dari hari lahir
    if (hariIni.getDate() < tanggalLahir.getDate()) {
        bulan--;

        if (bulan < 0) {
            tahun--;
            bulan += 12;
        }
    }

    document.getElementById('usia').value = 
        `${tahun} tahun ${bulan} bulan`;
});
</script>

        <label>Nomor Telepon</label>
        <input 
            type="text"
            name="telepon"
            class="form-control mb-3" 
            placeholder="Masukkan Nomor Telepon"
        >

            </div>

            <!-- KANAN -->
            <div class="col-md-6">

                <label>Provinsi</label>
                <select id="provinsi" name="provinsi" class="form-select mb-3">
                    <option value="">-- Pilih Provinsi --</option>
                    <?php foreach($provinsi as $p): ?>
                        <option value="<?= $p['prov_name'] ?>" data-id="<?= $p['prov_id'] ?>">
                            <?= $p['prov_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Kabupaten</label>
                <select id="kabupaten" name="kabupaten" class="form-select mb-3">
                    <option value="">-- Pilih Kabupaten --</option>
                    
                </select>

                <label>Kecamatan</label>
                <select id="kecamatan" name="kecamatan" class="form-select mb-3">
                    <option value="">-- Pilih Kecamatan --</option>
                </select>

                <label>Kelurahan</label>
                <select id="kelurahan" name="kelurahan" class="form-select mb-3">
                    <option value="">-- Pilih Kelurahan --</option>
                </select>

                <div class="mb-3">

                    <label class="mb-2 d-block">RT / RW</label>
                    <div class="d-flex align-items-center gap-3">
                        <input type="text" name="rt" class="form-control input-rt" placeholder="RT">
                        <span>/</span>
                        <input type="text" name="rw" class="form-control input-rt" placeholder="RW">
                    </div>

                </div>

                <label>Tanggal Skrining</label>
                    <input 
                        type="text"
                        name="tanggal_skrining"
                        class="form-control input-tanggal" 
                        value="<?= date('d-m-Y') ?>" 
                        readonly
                    >

            </div>

        </div>

            <button type="submit" class="btn-next">
                Selanjutnya
            </button>

    </form>

</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){

    document.getElementById('provinsi').addEventListener('change', function(){
        const provId = this.options[this.selectedIndex].dataset.id;

        document.getElementById('kabupaten').innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
        document.getElementById('kecamatan').innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        document.getElementById('kelurahan').innerHTML  = '<option value="">-- Pilih Kelurahan --</option>';

        if(!provId) return;

        fetch(`/wilayah/kabupaten/${provId}`)
            .then(r => r.json())
            .then(data => {
                data.forEach(item => {
                    document.getElementById('kabupaten').innerHTML +=
                        `<option value="${item.city_name}" data-id="${item.city_id}">${item.city_name}</option>`;
                });
            });
    });

    document.getElementById('kabupaten').addEventListener('change', function(){
        const cityId = this.options[this.selectedIndex].dataset.id;

        document.getElementById('kecamatan').innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        document.getElementById('kelurahan').innerHTML  = '<option value="">-- Pilih Kelurahan --</option>';

        if(!cityId) return;

        fetch(`/wilayah/kecamatan/${cityId}`)
            .then(r => r.json())
            .then(data => {
                data.forEach(item => {
                    document.getElementById('kecamatan').innerHTML +=
                        `<option value="${item.dis_name}" data-id="${item.dis_id}">${item.dis_name}</option>`;
                });
            });
    });

    document.getElementById('kecamatan').addEventListener('change', function(){
        const disId = this.options[this.selectedIndex].dataset.id;

        document.getElementById('kelurahan').innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

        if(!disId) return;

        fetch(`/wilayah/kelurahan/${disId}`)
            .then(r => r.json())
            .then(data => {
                data.forEach(item => {
                    document.getElementById('kelurahan').innerHTML +=
                        `<option value="${item.subdis_name}">${item.subdis_name}</option>`;
                });
            });
    });

});
</script>

<?= $this->include('layout/footer') ?>