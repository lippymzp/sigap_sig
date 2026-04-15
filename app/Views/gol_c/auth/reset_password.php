<!DOCTYPE html>
<html>
<head>
    <title>Login SIGAP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #11a7a7;
            font-family: 'Segoe UI', sans-serif;
        }

        .wrapper {
            display: flex;
            height: 100vh;
        }

        /* KIRI (CARD) */
        .left-panel {
            width: 50%;
            background: #ffffff;
            padding: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;

            border-top-right-radius: 40px;
            border-bottom-right-radius: 40px;
        }

        .title {
            color: #0f7f8c;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .form-control {
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

        .eye-icon {
            position: absolute;
            right: 15px;
            top: 12px;
            cursor: pointer;
        }

        /* KANAN */
        .right-panel {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right-panel img {
            max-width: 80%;
        }

        @media(max-width: 768px){
            .left-panel {
                width: 100%;
                border-radius: 0;
            }
            .right-panel {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- KIRI -->
    <div class="left-panel">

        <h2 class="title text-center">PERBARUI KATA SANDi</h2>
        <br>

        <form>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Masukkan email">
            </div>

            <div class="mb-2">
                <label>Kata Sandi</label>
                <div class="position-relative">
                    <input type="password" class="form-control" placeholder="Masukkan kata sandi">
                    <span class="eye-icon">👁️</span>
                </div>
            </div>

            <br><br>
            <button class="btn btn-teal w-100">Simpan</button>
            <br><br>
        </form>

    </div>

    <!-- KANAN -->
    <div class="right-panel">
        <img src="<?= base_url('assets/img/login.png') ?>">
    </div>

</div>

</body>
</html>