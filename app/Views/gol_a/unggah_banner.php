<?= $this->extend('layout/dashboard_layout_admin'); ?>
<?= $this->section('content'); ?>

<style>
.main {
    padding: 25px;
}

.page-title {
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 25px;
}

.step-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 170px;
    margin-bottom: 18px;
    position: relative;
}
.upload-wrapper {
    background: #EAF7F7;
    border-radius: 18px;
    padding: 32px;
    width: 1050px;
    margin: 0 auto;
    min-height: 560px;
}
.step-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 220px;
    margin-bottom: 28px;
    position: relative;
}

.step-item {
    text-align: center;
    position: relative;
}

.step-number {
    width: 38px;
    height: 38px;
    background: #11C5CC;
    color: white;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-bottom: 10px;
}

.step-text {
    font-size: 14px;
    font-weight: 600;
}

.upload-box h3 {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 14px;
}
.upload-box {
    background: #FAFAFA;
    border: 2px dashed #DADADA;
    border-radius: 14px;
    padding: 30px 28px;
    text-align: center;
    margin-bottom: 16px;
}
.upload-icon {
    width: 46px;
    height: 46px;
    background: white;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px auto;
    font-size: 20px;
    color: #11C5CC;
}

.form-control {
    border-radius: 10px;
    min-height: 42px;
    margin-bottom: 14px;
    font-size: 13px;
}

textarea.form-control {
    min-height: 140px;
}
.bottom-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 15px;
}

.btn-cancel {
    flex: 1;
    background: white;
    border: 1px solid #DADADA;
    font-weight: 600;
}
.btn-upload {
    flex: 1;
    background: #11C5CC;
    color: white;
    border: none;
    font-weight: 600;
}
.step-wrapper::before {
    content: "";
    position: absolute;
    top: 18px;
    width: 500px;
    height: 2px;
    border-top: 2px dashed #9EDFE2;
    z-index: 0;
}
.step-item {
    text-align: center;
    position: relative;
    z-index: 2;
}

.step-number.inactive {
    background: white;
    border: 2px solid #9EDFE2;
    color: #11C5CC;
}
.btn-cancel,
.btn-upload {
    width: 360px;
    height: 56px;
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    margin: 0;
    font-size: 14px;
    font-weight: 600;
}
.upload-box p {
    color: #B5B5B5;
    font-size: 11px;
    max-width: 500px;
    margin: auto;
    line-height: 1.5;
}
button {
    appearance: none;
    -webkit-appearance: none;
}
</style>

<div class="main">

    <div class="page-title">
        Unggah Banner
    </div>

    <div class="upload-wrapper">

        <div class="step-wrapper">

            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-text">Unggah Foto</div>
            </div>

            <div class="step-item">
                <div class="step-number inactive">2</div>
                <div class="step-text">Tambahkan Detail</div>
            </div>

        </div>

        <div class="upload-box">

    <h3>Unggah foto untuk banner di sini</h3>

    <div class="upload-icon">
        <i class="fas fa-upload"></i>
    </div>

    <p>
        Untuk hasil terbaik, gunakan foto resolusi minimal
        Full HD 1080p dan format JPG atau PNG agar tampilan
        tetap tajam dan profesional.
    </p>

</div>
<div class="bottom-actions">

    <button class="btn-cancel">
        Batal
    </button>

    <button class="btn-upload">
        Unggah
    </button>

</div>

    </div>
</div>

<?= $this->endSection(); ?>