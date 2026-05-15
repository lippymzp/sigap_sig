<!DOCTYPE html>
<html>

<head>
    <title>RESPIORA - Skrining</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    body {
        background: #f5f6fa;
        font-family: 'Segoe UI', sans-serif;
    }

    /* HEADER */
    .navbar {
        background: white;
        border-bottom: 1px solid #ddd;
        padding: 15px 40px;
    }

    .logo {
        font-weight: bold;
        color: #2b5cff;
        font-size: 20px;
    }

    /* STEP */
    .step-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px 0;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 120px;
        text-align: center;
    }

    .step-item small {
        margin-top: 8px;
        font-size: 12px;
        color: #333;
    }

    .step {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: 1px solid #081F5C;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        text-align: center;
    }

    .step.active {
        background: #081F5C;
        color: white;
        border: none;
    }

    .step-line {
        width: 150px;
        height: 2px;
        border-top: 1px dashed #cbd5e1;
        /* 🔥 jadi titik-titik */
        position: relative;
        top: -12px;
        /* 🔥 ini yang bikin naik */
        margin: 0 -40px;
    }

    .step-item small {
        white-space: nowrap;
        /* 🔥 biar ga turun baris */
        font-size: 12px;
    }

    /* CARD */
    .form-card {
        background: #eef1f7;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #081F5C;
    }

    /* LABEL */
    .form-label {
        font-size: 13px;
        font-weight: 500;
        color: #444;
    }

    /* INPUT */
    .form-control {
        height: 42px;
        font-size: 14px;
        border-radius: 10px;
    }

    /* ICON INPUT */
    .input-group-text {
        background: white;
        border-radius: 10px 0 0 10px;
        border-right: none;
    }

    .input-group .form-control {
        border-left: none;
    }

    /* BUTTON */
    .btn-next {
        background: #081F5C;
        color: white;
        height: 50px;
        border-radius: 12px;
        font-weight: 500;
    }

    .btn-next:hover {
        background: #5E5E5E;
        /* sama kayak Iya */
        color: white;
    }

    /* FOOTER */
    footer {
        background: #081F5C;
        color: white;
        padding: 50px;
        margin-top: 60px;
    }

    #tanggal_skrining {
        background: #081F5C4D;
        /* warna background */
        color: #081F5CB2;
        /* warna teks */
        font-weight: 600;
        border: 1px solid #081F5C4D;
    }
    </style>
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar d-flex justify-content-between align-items-center">
        <div class="logo">RESPRIORA</div>

        <div>
            <a class="me-4 text-dark">Beranda</a>
            <a class="me-4 text-dark">Tentang Kami</a>
            <a class="me-4 text-dark">Layanan</a>
            <a class="me-4 text-dark">Kontak</a>
            <button class="btn btn-primary">Login</button>
        </div>
    </nav>

    <!-- STEP -->
    <div class="step-container">

        <div class="step-item">
            <div class="step active">1</div>
            <small>Informasi Umum</small>
        </div>

        <div class="step-line"></div>

        <div class="step-item">
            <div class="step">2</div>
            <small>Informasi Gejala Klinis</small>
        </div>

        <div class="step-line"></div>

        <div class="step-item">
            <div class="step">3</div>
            <small>Informasi Faktor Risiko & Riwayat</small>
        </div>

    </div>

    <!-- FORM -->
    <div class="container" style="max-width: 1000px;">
        <div class="form-card">

            <h5 class="fw-bold">Informasi Umum</h5>
            <p class="text-muted">Lengkapi beberapa info dasar sebelum dimulai</p>

            <form method="post" action="/skrining-tbc/step2">

                <div class="row">

                    <!-- KIRI -->
                    <div class="col-md-6">

                        <label class="form-label">Nomor Induk Kependudukan</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                            <input type="text" name="nik" class="form-control" maxlength="16" placeholder="Masukkan NIK"
                                required>
                        </div>

                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                        </div>

                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control mb-3" required>
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>

                        <label class="form-label">Tanggal Lahir</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
                        </div>

                        <label class="form-label">Kategori Usia</label>
                        <select id="kategori_usia" name="kategori_usia" class="form-control mb-3" readonly>
                            <option value="">-- Pilih --</option>
                            <option value="0-14 tahun">0–14 tahun</option>
                            <option value="15-59 tahun">15–59 tahun</option>
                            <option value="60+ tahun">60+ tahun</option>
                        </select>

                    </div>

                    <!-- KANAN -->
                    <div class="col-md-6">

                        <label class="form-label">Provinsi</label>
                        <select name="provinsi" class="form-control mb-3" required>
                            <option>-- Pilih --</option>
                        </select>

                        <label class="form-label">Kabupaten</label>
                        <select name="kabupaten" class="form-control mb-3" required>
                            <option>-- Pilih --</option>
                        </select>

                        <label class="form-label">Kecamatan</label>
                        <select name="kecamatan" class="form-control mb-3" required>
                            <option>-- Pilih --</option>
                        </select>
                        <input type="hidden" name="provinsi_text">
                        <input type="hidden" name="kabupaten_text">
                        <input type="hidden" name="kecamatan_text">
                        <input type="hidden" name="kelurahan_text">

                        <label class="form-label">Kelurahan</label>
                        <select name="kelurahan" class="form-control mb-3" required>
                            <option>-- Pilih --</option>
                        </select>

                        <label class="form-label">Kode Pos</label>
                        <input type="text" name="kode_pos" placeholder="-" class="form-control mb-3" readonly>

                        </select>

                        <label class="form-label">Tanggal Skrining</label>
                        <input type="text" name="tanggal_skrining" id="tanggal_skrining" class="form-control mb-3"
                            readonly>

                    </div>
                </div>

                <!-- BUTTON -->
                <button class="btn btn-next w-100 mt-3">
                    Selanjutnya
                </button>

            </form>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center">
        <h5>RESPRIORA</h5>
        <p>Platform deteksi dini TBC</p>
    </footer>

    <!-- 🔥 SCRIPT AUTO USIA -->
    <script>
    document.getElementById("tanggal_lahir").addEventListener("change", function() {

        let tgl = new Date(this.value);
        let today = new Date();

        let umur = today.getFullYear() - tgl.getFullYear();

        let kategori = "";

        if (umur <= 14) {
            kategori = "0-14 tahun";
        } else if (umur <= 59) {
            kategori = "15-59 tahun";
        } else {
            kategori = "60+ tahun";
        }

        document.getElementById("kategori_usia").value = kategori;
    });
    </script>

    <script>
    // LOAD PROVINSI
    fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
        .then(res => res.json())
        .then(data => {
            let provinsi = document.querySelector("[name=provinsi]");

            data.forEach(item => {
                provinsi.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });
        });


    // SAAT PILIH PROVINSI → LOAD KABUPATEN
    document.querySelector("[name=provinsi]").addEventListener("change", function() {
        let id = this.value;

        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${id}.json`)
            .then(res => res.json())
            .then(data => {

                let kabupaten = document.querySelector("[name=kabupaten]");
                kabupaten.innerHTML = '<option>-- Pilih Kabupaten --</option>';

                data.forEach(item => {
                    kabupaten.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });

            });
    });


    // SAAT PILIH KABUPATEN → LOAD KECAMATAN
    document.querySelector("[name=kabupaten]").addEventListener("change", function() {
        let id = this.value;

        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${id}.json`)
            .then(res => res.json())
            .then(data => {

                let kecamatan = document.querySelector("[name=kecamatan]");
                kecamatan.innerHTML = '<option>-- Pilih Kecamatan --</option>';

                data.forEach(item => {
                    kecamatan.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                });

            });
    });


    // SAAT PILIH KECAMATAN → LOAD KELURAHAN
    document.querySelector("[name=kecamatan]").addEventListener("change", function() {
        let id = this.value;

        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${id}.json`)
            .then(res => res.json())
            .then(data => {

                let kelurahan = document.querySelector("[name=kelurahan]");
                kelurahan.innerHTML = '<option>-- Pilih Kelurahan --</option>';

                data.forEach(item => {
                    kelurahan.innerHTML += `<option value="${item.name}">${item.name}</option>`;
                });

            });
    });
    </script>

    <script>
    // 🔥 NORMALIZE TEXT
    function clean(text) {
        return text.toLowerCase()
            .replace('kabupaten ', '')
            .replace('kota ', '')
            .replace(/\s+/g, ' ')
            .trim();
    }

    // 🔥 EVENT SAAT PILIH KELURAHAN
    document.querySelector("[name=kelurahan]").addEventListener("change", function() {

        let kel = clean(this.value);
        let kec = clean(document.querySelector("[name=kecamatan] option:checked").text);
        let kab = clean(document.querySelector("[name=kabupaten] option:checked").text);

        console.log("KIRIM:", kel, kec, kab); // debug

        fetch(`/getKodePos?kelurahan=${kel}&kecamatan=${kec}&kabupaten=${kab}`)
            .then(res => res.json())
            .then(data => {

                console.log("HASIL:", data); // debug

                document.querySelector("[name=kode_pos]").value = data.kodepos;

            })
            .catch(err => {
                console.error("ERROR:", err);
                document.querySelector("[name=kode_pos]").value = "-";
            });

    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {

        let today = new Date();

        let hari = String(today.getDate()).padStart(2, '0');
        let bulan = String(today.getMonth() + 1).padStart(2, '0');
        let tahun = today.getFullYear();

        let format = hari + '/' + bulan + '/' + tahun;

        document.querySelector("[name=tanggal_skrining]").value = format;
    });
    </script>
    <script>
    document.querySelector("[name=provinsi]").addEventListener("change", function() {
        document.querySelector("[name=provinsi_text]").value = this.options[this.selectedIndex].text;
    });

    document.querySelector("[name=kabupaten]").addEventListener("change", function() {
        document.querySelector("[name=kabupaten_text]").value = this.options[this.selectedIndex].text;
    });

    document.querySelector("[name=kecamatan]").addEventListener("change", function() {
        document.querySelector("[name=kecamatan_text]").value = this.options[this.selectedIndex].text;
    });

    document.querySelector("[name=kelurahan]").addEventListener("change", function() {
        document.querySelector("[name=kelurahan_text]").value = this.value;
    });
    </script>
</body>

</html>