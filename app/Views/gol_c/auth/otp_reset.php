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

        <form method="post" action="<?= base_url('/otp-reset') ?>">
    
            <div class="d-flex justify-content-center gap-3 my-4">
                <input maxlength="1" class="otp-box otp-input" type="text">
                <input maxlength="1" class="otp-box otp-input" type="text">
                <input maxlength="1" class="otp-box otp-input" type="text">
                <input maxlength="1" class="otp-box otp-input" type="text">
                <input maxlength="1" class="otp-box otp-input" type="text">
                <input maxlength="1" class="otp-box otp-input" type="text">
            </div>

            <input type="hidden" name="otp" id="otp-final">

            <button type="submit" class="btn btn-teal w-100 mt-3">
                Verifikasi
            </button>

        </form>

    </div>

</div>

<script>
const inputs = document.querySelectorAll('.otp-input');

inputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
        const value = e.target.value;

        // hanya angka
        if (!/^[0-9]$/.test(value)) {
            e.target.value = '';
            return;
        }

        // pindah ke kanan
        if (value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }

        updateOTP();
    });

    input.addEventListener('keydown', (e) => {
        // backspace pindah ke kiri
        if (e.key === "Backspace" && !input.value && index > 0) {
            inputs[index - 1].focus();
        }
    });
});

function updateOTP() {
    let otp = "";
    inputs.forEach(i => otp += i.value);
    document.getElementById('otp-final').value = otp;
}
</script>

</body>
</html>