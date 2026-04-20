<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP - Profil</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', system-ui, -apple-system, sans-serif;
        }

        * {
            font-family: 'Poppins', system-ui, -apple-system, sans-serif;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            background: #f8fafc;
            color: #2c3e50;
            padding: 20px 0;
            border-right: 1px solid #e9ecef;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
            padding: 0 20px;
        }

        .logo img {
            max-width: 140px;
        }

        .menu-label {
            font-size: 12px;
            color: #6c757d;
            padding: 10px 20px 6px 20px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #2c3e50;
            text-decoration: none;
            font-size: 14.5px;
            font-weight: 400;
            transition: all 0.25s ease;
        }

        .sidebar a:hover {
            background: #e9f5f3;
            color: #00c4b4;
        }

        .sidebar a.active {
            background: #00c4b4;
            color: white;
            border-radius: 8px;
            margin: 0 10px;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 196, 180, 0.25);
        }

        .sidebar a i {
            width: 24px;
            margin-right: 12px;
            font-size: 16px;
        }

        /* ===== MAIN ===== */
        .main-content {
            flex: 1;
            padding: 30px;
        }

        .profile-card {
            background: white;
            max-width: 520px;
            margin: auto;
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .avatar-box {
            text-align: center;
            margin-bottom: 25px;
        }

        .avatar-box img {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #e0f2f1;
        }

        .btn-upload {
            margin-top: 12px;
            border-radius: 20px;
        }

        h5 {
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            <img src="/assets/img/logo_nama.svg" alt="Logo SIGAP">
            <!-- Jika tidak ada file logo, bisa pakai teks -->
            <!-- <h5 class="fw-bold text-success mb-0">SIGAP</h5> -->
        </div>

<div class="menu-label">HOME</div>
        <a href="http://localhost:8080/dbd/dashboard" class="active">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>

        <div class="menu-label">MENU UTAMA</div>
        <a href="http://localhost:8080/dbd/input_data">
            <i class="fa-regular fa-clipboard"></i> Input Data Pasien
        </a>
        <a href="http://localhost:8080/dbd/hasil">
            <i class="fa-regular fa-folder"></i> Hasil Data Pasien
        </a>
        <a href="http://localhost:8080/dbd/skrining">
            <i class="fa-regular fa-file-lines"></i> Skrining
        </a>
        <a href="http://localhost:8080/dbd/peta">
            <i class="fa-solid fa-map-location-dot"></i> Peta Sebaran
        </a>
        <a href="http://localhost:8080/dbd/export">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Export Data
        </a>

        <div class="menu-label">INFORMASI</div>
        <a href="http://localhost:8080/dbd/berita">
            <i class="fa-regular fa-newspaper"></i> Edit Berita
        </a>
        <a href="http://localhost:8080/dbd/funfact">
            <i class="fa-regular fa-user"></i> Edit Funfact
        </a>

    </div>

    <!-- MAIN -->
    <div class="main-content">
        <div class="profile-card">

            <!-- FOTO PROFIL -->
            <div class="avatar-box">
                <img id="previewFoto" src="https://i.ibb.co.com/0jZ7Z7Z/male-avatar.png" alt="Foto Profil">

                <input type="file" id="uploadFoto" accept="image/*" style="display:none" onchange="previewImage(event)">

                <div>
                    <button class="btn btn-outline-info btn-sm btn-upload"
                        onclick="document.getElementById('uploadFoto').click()">
                        <i class="fa fa-camera me-1"></i> Tambah Foto
                    </button>
                </div>
            </div>

            <h5 class="fw-bold mb-4">Kepala Puskesmas</h5>

            <input class="form-control mb-3" value="agustiarifin123@gmail.com" readonly>
            <input class="form-control mb-3" value="********" readonly>

            <button class="btn btn-info w-100">Ubah Kata Sandi</button>

        </div>
    </div>

</div>

<!-- SCRIPT PREVIEW FOTO -->
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewFoto').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>