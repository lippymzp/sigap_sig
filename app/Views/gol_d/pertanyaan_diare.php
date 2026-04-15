<?= $this->include('layout/header') ?>

<section class="container mt-5">

<!-- ================= STEP ================= -->
<div class="step-wrapper">

    <div class="step-item step-done">
        <div class="step-circle">1</div>
        <div class="step-title">Informasi Umum</div>
    </div>

    <div class="step-line"></div>

    <div class="step-item step-active">
        <div class="step-circle">2</div>
        <div class="step-title">Pertanyaan Skrining</div>
    </div>

</div>

<form action="<?= base_url('hasil-diare') ?>" method="post">

<div class="card border-0 shadow-lg p-4" style="border-radius:20px;">

<h5 class="fw-bold mb-2">Gejala Klinis Diare</h5>
<p class="text-muted mb-4">Pilih kondisi yang sesuai dengan gejala Anda</p>

<?php
$pertanyaan = [
"Apakah Anda BAB lebih dari 3 kali sehari?",
"Apakah tinja Anda cair atau encer?",
"Apakah Anda mengalami nyeri perut?",
"Apakah terdapat darah/lendir pada tinja?",
"Apakah Anda mengalami mual atau muntah?",
"Apakah tubuh terasa lemas atau dehidrasi?",
"Apakah Anda mengalami demam?",
"Apakah Anda mengonsumsi makanan tidak higienis?",
"Apakah Anda minum air yang tidak matang?",
"Apakah ada orang sekitar Anda mengalami diare?"
];
?>

<?php foreach($pertanyaan as $i => $p): ?>
<div class="question-card mb-3 p-3">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div class="question-text">
            <?= $p ?>
        </div>

        <div class="toggle-group">

            <input type="radio" id="ya<?= $i ?>" name="q<?= $i ?>" value="1" required hidden>
            <label for="ya<?= $i ?>" class="btn-toggle yes">Ya</label>

            <input type="radio" id="tidak<?= $i ?>" name="q<?= $i ?>" value="0" hidden>
            <label for="tidak<?= $i ?>" class="btn-toggle no">Tidak</label>

        </div>

    </div>

</div>
<?php endforeach; ?>

<!-- BUTTON -->
<div class="d-flex gap-3 mt-4">
    <a href="<?= base_url('skrining-diare') ?>" class="btn btn-outline-secondary w-50">
        ← Kembali
    </a>
    <button class="btn btn-teal w-50 fw-semibold">
        Kirim →
    </button>
</div>

</div>
</form>

</section>

<?= $this->include('layout/footer') ?>