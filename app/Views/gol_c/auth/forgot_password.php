<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #11a7a7;
            font-family: 'Segoe UI';
        }

        .card-custom {
            background: #ffffff;
            border-radius: 30px;
            padding: 150px;
            max-width: 1000px;
            width: 100%;
        }

        .text-teal {
            color: #0f7f8c;
            font-weight: bold;
        }

        .custom-input {
            border: 2px solid #1fb5b5;
            border-radius: 10px;
            padding: 12px;
        }

        .btn-teal {
            background: #1fb5b5;
            color: white;
            border-radius: 10px;
            padding: 12px;
            border: none;
        }

        .btn-teal:hover {
            background: #169999;
        }
    </style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center vh-100">

    <div class="card-custom">
        <div class="row align-items-center">

            <!-- KIRI GAMBAR -->
            <div class="col-md-5 text-center">
                <img src="<?= base_url('assets/img/forgot.png') ?>" class="img-fluid">
            </div>

            <!-- KANAN FORM -->
            <div class="col-md-7">
                <h2 class="text-teal mb-3">LUPA KATA SANDI?</h2>
                <p>Masukkan alamat email yang terkait dengan akun Anda</p>

                <input type="email" class="form-control custom-input mb-4" placeholder="Masukkan email anda">

                <button type="button"
                    onclick="window.location.href='<?= base_url('/otp') ?>'"
                    class="btn btn-teal w-100">
                    Lanjut
                </button>
            </div>

        </div>
    </div>

</div>

</body>
</html>