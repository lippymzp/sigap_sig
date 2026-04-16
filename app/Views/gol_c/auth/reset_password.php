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

        <h2 class="title text-center">PERBARUI KATA SANDI</h2>
        <br>

        <?php $success = session()->getFlashdata('success'); ?>
        <?php if($success): ?>
            <div class="alert alert-success text-center">
                <?= $success ?>
            </div>

            <script>
            setTimeout(() => {
                const alertBox = document.querySelector('.alert');
                if(alertBox){
                    alertBox.style.display = 'none';
                }
            }, 3000);
            </script>
        <?php endif; ?>

        <form action="<?= base_url('/reset-process') ?>" method="post">
            <!-- ERROR -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- PASSWORD BARU -->
            <div class="mb-3">
                <label>Kata Sandi Baru</label>

                <div class="position-relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="form-control pe-5"
                        placeholder="Masukkan kata sandi baru"
                        required
                    >

                    <i class="bi bi-eye eye-icon" id="togglePassword1"></i>
                </div>
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="mb-3">
                <label>Konfirmasi Kata Sandi</label>

                <div class="position-relative">
                    <input 
                        type="password" 
                        name="password_confirm" 
                        id="password_confirm"
                        class="form-control pe-5"
                        placeholder="Ulangi kata sandi"
                        required
                    >

                    <i class="bi bi-eye eye-icon" id="togglePassword2"></i>
                </div>
            </div>

            <br>

            <button type="submit" class="btn btn-teal w-100">
                Simpan
            </button>

        </form>

    </div>

    <!-- KANAN -->
    <div class="right-panel">
        <img src="<?= base_url('img/login_2.png') ?>" width="500">
    </div>

</div>

<script>
function setupToggle(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    icon.addEventListener("click", function () {
        const isHidden = input.type === "password";

        input.type = isHidden ? "text" : "password";

        // ganti icon dinamis
        icon.classList.toggle("bi-eye");
        icon.classList.toggle("bi-eye-slash");
    });
}

setupToggle("password", "togglePassword1");
setupToggle("password_confirm", "togglePassword2");
</script>

</body>
</html>