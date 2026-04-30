<?= $this->extend('layout/dashboard_layout_kader') ?>
<?= $this->section('content') ?>

<style>
    /* Mengatur latar belakang area konten agar sesuai desain (warna mint/cyan pucat) */
    .page-wrapper {
        background-color: #E6F4F1; 
        padding: 20px;
        border-radius: 15px;
        min-height: 100vh;
    }

    /* Banner Hijau Tosca di atas form */
    .banner-top {
        background-color: #00CED1; /* Sesuaikan dengan warna tosca di desain */
        border-radius: 15px;
        padding: 20px 25px;
        color: white;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .banner-icon {
        background: rgba(255, 255, 255, 0.2);
        padding: 12px 15px;
        border-radius: 10px;
        margin-right: 20px;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .banner-text h4 {
        margin: 0;
        font-weight: 700;
        font-size: 18px;
    }
    .banner-text p {
        margin: 0;
        font-size: 13px;
        opacity: 0.9;
        margin-top: 3px;
    }

    /* Card Putih Form */
    .form-card {
        background: #FFFFFF;
        border-radius: 15px;
        padding: 40px 35px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }

    /* Label Form */
    .form-label {
        font-weight: 700;
        color: #333333;
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
    }

    /* Input & Select Custom */
    .form-input {
        background-color: #F4F6F8;
        border: 1px solid #EAEFEF;
        border-radius: 10px;
        padding: 14px 18px;
        width: 100%;
        font-size: 14px;
        color: #555;
        margin-bottom: 20px;
        outline: none;
        transition: all 0.3s ease;
        appearance: none; /* Menghilangkan style default panah select bawaan browser di beberapa kasus */
    }
    
    /* Khusus untuk panah select agar lebih rapi */
    select.form-input {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 15px;
        padding-right: 40px;
    }

    .form-input::placeholder {
        color: #A9B2B2;
    }
    .form-input:focus {
        border-color: #51C2B8;
        background-color: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(81, 194, 184, 0.2);
    }

    /* Kotak Upload Foto */
    .upload-box {
        border: 2px dashed #BEE3E1;
        background-color: #F9FCFC;
        border-radius: 10px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        color: #666;
        font-size: 14px;
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }
    .upload-box:hover {
        background-color: #F0F9F9;
        border-color: #51C2B8;
    }

    /* Tombol Submit */
    .btn-submit {
        background-color: #38B2AC; /* Warna sesuai dengan desain aplikasi Anda */
        color: white;
        border-radius: 10px;
        padding: 15px;
        font-weight: bold;
        font-size: 15px;
        border: none;
        width: 100%;
        transition: background-color 0.3s;
    }
    .btn-submit:hover {
        background-color: #2C8E89;
    }
</style>

<div class="page-wrapper">

    <!-- HEADER BANNER -->
    <div class="banner-top">
        <div class="banner-icon">
            <i class="fa-solid fa-shield-medical"></i>
        </div>
        <div class="banner-text">
            <h4>Pelaporan Kader</h4>
            <p>Silahkan isi data dengan benar</p>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="form-card">
        <form method="post" action="<?= base_url('dbd/simpanpsn') ?>" enctype="multipart/form-data">
            
            <!-- Tanggal Input (Dibuat hidden agar tidak merusak desain, namun datanya tetap terkirim) -->
            <input type="hidden" name="tanggalinput" value="<?= date('Y-m-d') ?>">

            <!-- WILAYAH KERJA PUSKESMAS -->
            <label class="form-label">Wilayah Kerja Puskesmas</label>
            <select name="puskesmas" class="form-input" required>
                <option value="" disabled selected>Pilih puskesmas</option>
                <option value="Sumbersari">PKM Sumbersari</option>
            </select>

            <!-- KELURAHAN -->
            <label class="form-label">Kelurahan</label>
            <select name="kelurahan" class="form-input" required>
                <option value="" disabled selected>Pilih kelurahan</option>
                <option>Sumbersari</option>
                <option>Wirolegi</option>
                <option>Antirogo</option>
                <option>Tegal Gede</option>
                <option>Karangrejo</option>
            </select>

            <!-- POS POSYANDU -->
            <label class="form-label">Pos Posyandu</label>
            <select name="posyandu" class="form-input" required>
                <option value="" disabled selected>Pilih pos posyandu</option>
                
                <?php for($i=1; $i<=95; $i++): ?>
                    <option>CATLEYA <?= $i ?></option>
                <?php endfor; ?>
                
                <option>CATLEYA 36A (BAYANGAN)</option>
                <option>CATLEYA 58A (BAYANGAN)</option>
                <option>CATLEYA 65A (BAYANGAN)</option>
                <option>CATLEYA 78A (BAYANGAN)</option>
                <option>CATLEYA 88A (BAYANGAN)</option>
                <option>CATLEYA 92A (BAYANGAN)</option>
                <option>CATLEYA 95A</option>
                <option>CATLEYA 95B (BAYANGAN)</option>
            </select>

            <!-- JUMLAH DIPERIKSA -->
            <label class="form-label">Jumlah Rumah/KK yang Diperiksa</label>
            <input type="number" name="diperiksa" class="form-input" placeholder="Sebutkan Jumlah Rumah / KK yang diperiksa" required>

            <!-- JUMLAH POSITIF -->
            <label class="form-label">Jumlah Rumah/KK yang Positif Jentik</label>
            <input type="number" name="positif" class="form-input" placeholder="Sebutkan Jumlah Rumah / KK yang diperiksa" required>

            <!-- BAGIAN POSITIF -->
            <label class="form-label">Bagian yang Positif</label>
            <input type="text" name="bagian" class="form-input" placeholder="(Sebutkan, contoh : kamar mandi, vas bunga, dll)">

            <!-- UPLOAD FOTO (Sesuai Permintaan) -->
            <label class="form-label">Upload Foto Bukti</label>
            <div class="upload-box" onclick="document.getElementById('foto').click()">
                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 24px; color: #51C2B8; margin-bottom: 10px;"></i>
                <br>Klik di sini untuk upload / ambil foto
            </div>
            <!-- Input file disembunyikan, akan terpicu (trigger) saat kotak putus-putus diklik -->
            <input type="file" name="foto" id="foto" style="display: none;" accept="image/*" capture="environment">

            <!-- TOMBOL SUBMIT -->
            <button type="submit" class="btn-submit mt-2">Kirim Laporan</button>

        </form>
    </div>
</div>

<script>
    // Script kecil untuk mengubah teks pada kotak upload saat file telah dipilih
    document.getElementById('foto').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var uploadBox = document.querySelector('.upload-box');
        if(fileName) {
            uploadBox.innerHTML = '<i class="fa-solid fa-check-circle" style="font-size: 24px; color: #38B2AC; margin-bottom: 10px;"></i><br>File terpilih: <b>' + fileName + '</b>';
            uploadBox.style.borderColor = '#38B2AC';
        }
    });
</script>

<?= $this->endSection() ?>