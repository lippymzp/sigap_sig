<!DOCTYPE html>
<html>
<head>
    <title>OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #11a7a7;
            font-family: 'Segoe UI';
        }

        .card-custom {
            background: #ffffff;
            border-radius: 30px;
            padding: 50px;
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        .text-teal {
            color: #0f7f8c;
            font-weight: bold;
        }

        .otp-box {
            width: 70px;
            height: 70px;
            border: 2px solid #1fb5b5;
            border-radius: 10px;
            font-size: 28px;
            text-align: center;
        }

        .btn-teal {
            background: #1fb5b5;
            color: white;
            border-radius: 10px;
            padding: 12px;
            border: none;
        }
    </style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center vh-100">

    <div class="card-custom">

        <h2 class="text-teal mb-3">VERIFIKASI OTP</h2>
        <p>Masukkan kode OTP yang dikirim ke email Anda</p>

        <div class="d-flex justify-content-center gap-3 my-4">
            <input class="otp-box">
            <input class="otp-box">
            <input class="otp-box">
            <input class="otp-box">
        </div>

        <p>Belum menerima kode? <a href="#">Kirim Ulang</a></p>

        <button type="button"
            onclick="window.location.href='<?= base_url('/reset') ?>'"
            class="btn btn-teal w-100 mt-3">
            Verifikasi
        </button>

    </div>

</div>

</body>
</html>