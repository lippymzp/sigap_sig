<?= $this->extend('layout/dashboard_superadmin') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body, input, button, select, textarea {
    font-family: 'Poppins', sans-serif;
}

/* Header */
.header-user {
    display: flex;
    align-items: center;
    gap: 15px;
    background: linear-gradient(90deg, #26c6da, #4dd0e1);
    color: white;
    padding: 20px 25px;
    border-radius: 12px;
    margin-bottom: 25px;
    font-weight: 600;
}

.header-icon img {
    width: 40px;
    height: 40px;
}

/* Form container */
.form-container {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    margin-top: 20px;
}

/* Grid form 2 kolom */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* Form group */
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group label {
    font-size: 14px;
    margin-bottom: 5px;
    color: #555;
}

.required::after {
    content: " *";
    color: red;
    font-weight: bold;
}

/* Input */
.form-group input,
.form-group select {
    padding: 12px 15px;
    border-radius: 12px;
    border: 1px solid #ddd;
    outline: none;
    transition: all 0.2s;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #26c6da;
    box-shadow: 0 0 6px rgba(38,198,218,0.3);
}

/* Kelurahan + tombol Tambah Posyandu */
.kelurahan-container {
    display: flex;
    gap: 10px;
    align-items: center;
}

.kelurahan-container input {
    flex: 1;
    padding: 12px 15px;
    border-radius: 12px;
    border: 1px solid #ddd;
}

.kelurahan-container input:focus {
    border-color: #26c6da;
    box-shadow: 0 0 6px rgba(38,198,218,0.3);
}

.kelurahan-container button {
    background: #26c6da;
    color: white;
    border: none;
    padding: 12px 18px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}

.kelurahan-container button:hover {
    background: #00acc1;
}

/* Tombol aksi full width kiri & kanan */
.form-action {
    display: grid;
    grid-template-columns: 1fr 1fr; /* 2 tombol */
    gap: 15px;
    margin-top: 30px;
}

.btn-back {
    background: #fff;
    color: #333;
    border: 1px solid #ccc;
    padding: 12px 25px;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}

.btn-back, .btn-save {
    width: 100%; /* full width masing-masing kolom */
    padding: 14px 0;
    border-radius: 25px;
    font-weight: 600;
    font-size: 16px;
}

.btn-back:hover {
    background-color: #f0f0f0;
}

.btn-save {
    background: #26c6da;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}

.btn-save:hover {
    background: #00acc1;
}

.kelurahan-container {
    display: flex;
    gap: 10px;
    align-items: center;
}

.kelurahan-container input {
    flex: 1;
    padding: 12px 15px;
    border-radius: 12px;
    border: 1px solid #ddd;
    outline: none;
}

.kelurahan-container input:focus {
    border-color: #26c6da;
    box-shadow: 0 0 6px rgba(38,198,218,0.3);
}

.kelurahan-container button {
    background: #26c6da;
    color: white;
    border: none;
    padding: 12px 15px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}

.kelurahan-container button:hover {
    background: #00acc1;
}

/* Card Daftar Kelurahan */
.kelurahan-card {
    display: flex;
    gap: 10px;
    align-items: center;
    padding: 12px 15px;
    border-radius: 12px;
    width: 100%; /* full width */
}

/* Input + tombol tambah kelurahan */
.kelurahan-input-wrapper {
    display: flex;
    flex: 2; /* ambil space lebih besar */
}

.kelurahan-input-wrapper input {
    flex: 1;
    padding: 12px 15px;
    border-radius: 12px 0 0 12px;
    border: 1px solid #ddd;
    outline: none;
}

.kelurahan-input-wrapper input:focus {
    border-color: #26c6da;
    box-shadow: 0 0 6px rgba(38,198,218,0.3);
}

.kelurahan-input-wrapper .btn-tambah-kelurahan {
    background: #26c6da;
    color: white;
    border: none;
    padding: 12px 15px;
    border-radius: 0 12px 12px 0;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}

.kelurahan-input-wrapper .btn-tambah-kelurahan:hover {
    background: #00acc1;
}

/* Tombol Tambah Posyandu di sebelah kanan */
.btn-tambah-posyandu {
    flex: 1; /* ambil space sebanding */
    background: #26c6da;
    color: white;
    border: none;
    padding: 12px 18px;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s;
}

.btn-tambah-posyandu:hover {
    background: #00acc1;
}
</style>

<div class="header-user">
    <div class="header-icon">
        <img src="/img/icon_breadcrumb.svg">
    </div>
    <div>
        <h5>Manajemen Puskesmas</h5>
        <small>Tambah data puskesmas dengan benar</small>
    </div>
</div>

<div class="form-container">
    <form action="/superadmin/puskesmas/store" method="post">

        <div class="form-grid">
            <div class="form-group">
                <label class="required">Nama Puskesmas</label>
                <input type="text" name="nama_puskesmas" placeholder="Masukkan nama puskesmas" required>
            </div>

            <div class="form-group">
                <label class="required">Nomor Telepon</label>
                <input type="text" name="no_telpon_puskesmas" placeholder="Masukkan nomor telepon" required>
            </div>

            <div class="form-group">
                <label class="required">Email Puskesmas</label>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label class="required">Kecamatan</label>
                <input type="text" name="kecamatan" placeholder="Masukkan kecamatan" required>
            </div>

            <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" name="kode_pos" placeholder="Masukkan kode pos">
            </div>

             <div class="form-group">
                <label class="required">Alamat Lengkap</label>
                  <input type="text" name="alamat" placeholder="Masukkan alamat lengkap" required>
            </div>

            <div class="form-group">
                <label>Latitude (lintang)</label>
                <input type="text" name="latitude" placeholder="Latitude (lintang)">
            </div>

            <div class="form-group">
                <label>Longitude (bujur)</label>
                <input type="text" name="longitude" placeholder="Longitude (bujur)">
            </div>
        </div>
<div class="form-group">
         <label>Daftar Kelurahan</label>
    <div class="kelurahan-card">
        <!-- Input + tombol tambah kelurahan -->
        <div class="kelurahan-input-wrapper">
            <input type="text" name="kelurahan[]" placeholder="Masukkan nama kelurahan 1">
            <button type="button" class="btn-tambah-kelurahan"><i class="bi bi-plus"></i></button>
        </div>

        <!-- Tombol Tambah Posyandu -->
        <button type="button" class="btn-tambah-posyandu">Tambah Posyandu</button>
    </div>
</div>


        <!-- Tombol aksi -->
        <div class="form-action">
            <a href="/superadmin/puskesmas"><button type="button" class="btn-back">Batal</button></a>
            <button type="submit" class="btn-save">Simpan</button>
        </div>
    </form>
</div>

<script>
// Tambah input kelurahan baru
document.querySelectorAll('.btn-tambah-kelurahan').forEach(btn => {
    btn.addEventListener('click', function() {
        const wrapper = this.parentElement.parentElement; // kelurahan-container
        const newWrapper = this.parentElement.cloneNode(true); // clone input + tombol
        newWrapper.querySelector('input').value = ''; // kosongkan input baru
        wrapper.insertBefore(newWrapper, this.parentElement.nextSibling);
    });
});

// Tombol tambah posyandu bisa dihubungkan ke action nyata
document.querySelectorAll('.btn-tambah-posyandu').forEach(btn => {
    btn.addEventListener('click', function() {
        alert('Fungsi Tambah Posyandu bisa ditempatkan di sini'); 
    });
});
</script>

<?= $this->endSection() ?>