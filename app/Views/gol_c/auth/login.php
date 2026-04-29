<!DOCTYPE html>
<html>
<head>
    <title>Login SIGAP</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        <h2 class="title text-center">MASUK</h2>
        <br>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success text-center">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/login-process') ?>" method="post">

            <input type="hidden" name="penyakit" value="<?= session('penyakit') ?? '' ?>">

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <div class="mb-2">
                <label>Kata Sandi</label>

                <div class="position-relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="login_password"
                        class="form-control pe-5" 
                        placeholder="Masukkan kata sandi"
                        required
                    >

                    <i class="bi bi-eye eye-icon" id="toggleLoginPassword"></i>
                </div>
            </div>

            <div class="text-end mb-3">
                <a href="<?= base_url('/forgot') ?>">Lupa Kata Sandi</a>
            </div>

            <!-- ERROR -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-teal w-100">
                Masuk
            </button>

        </form>

    </div>

    <!-- KANAN -->
    <div class="right-panel">
        <img src="<?= base_url('img/login_1.png') ?>" width="450">
    </div>

</div>

<script>
const input = document.getElementById("login_password");
const icon = document.getElementById("toggleLoginPassword");

icon.addEventListener("click", function () {
    const isHidden = input.type === "password";

    input.type = isHidden ? "text" : "password";

    icon.classList.toggle("bi-eye");
    icon.classList.toggle("bi-eye-slash");
});
</script>

</body>
</html>