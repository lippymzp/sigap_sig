<?= $this->include('layout/header') ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body{
    font-family:'Poppins',sans-serif;
    background:#f6f8fb;
}

.step-wrapper{
    display:flex;
    align-items:center;
    justify-content:center;
    max-width:900px;
    margin:40px auto 50px;
}

.step-item{
    text-align:center;
    width:140px;
}

.step-circle{
    width:38px;
    height:38px;
    margin:auto;
    border-radius:10px;
    background:#10c4cf;
    color:#fff;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 8px 20px rgba(16,196,207,.25);
}

.step-title{
    margin-top:12px;
    font-size:15px;
    font-weight:500;
    color:#111827;
}

.step-line{
    flex:1;
    height:2px;
    border-top:2px dashed #10c4cf;
    margin:0 35px;
}

.screening-card{
    max-width:920px;
    margin:auto;
    background:#fff;
    border:2px solid #10c4cf;
    border-radius:22px;
    padding:45px 50px;
    box-shadow:0 15px 40px rgba(0,0,0,.06);
}

.screening-title{
    font-size:18px;
    font-weight:700;
    color:#111827;
    margin-bottom:6px;
}

.screening-subtitle{
    font-size:14px;
    color:#6b7280;
    margin-bottom:12px;
}

.counter{
    font-size:15px;
    font-weight:600;
    margin-bottom:16px;
    color:#111827;
}

.progress{
    height:10px;
    border-radius:50px;
    background:#edf1f5;
    overflow:hidden;
    margin-bottom:40px;
}

.progress-bar{
    background:linear-gradient(90deg,#14c5d0,#13b7c2);
    border-radius:50px;
}

.question-block{
    text-align:center;
    margin-bottom:38px;
}

.question-text{
    font-size:17px;
    font-weight:600;
    color:#111827;
    line-height:1.5;
    margin-bottom:18px;
}

.answer-group{
    display:flex;
    justify-content:center;
    gap:18px;
}

.answer-group input{
    display:none;
}

.answer-btn{
    min-width:125px;
    padding:11px 20px;
    border-radius:16px;
    background:#fff;
    border:1px solid #eef2f7;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
    font-size:15px;
    font-weight:500;
    color:#374151;
    cursor:pointer;
    transition:.25s ease;
}

.answer-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 18px rgba(0,0,0,.10);
}

input:checked + .answer-btn{
    background:linear-gradient(135deg,#10c4cf,#0ea5b2);
    color:white;
    border-color:transparent;
    box-shadow:0 10px 20px rgba(16,196,207,.35);
}

.next-btn{
    width:100%;
    border:none;
    padding:15px;
    border-radius:16px;
    background:linear-gradient(135deg,#10c4cf,#0ea5b2);
    color:white;
    font-size:16px;
    font-weight:600;
    transition:.25s;
    margin-top:20px;
}

.next-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 20px rgba(16,196,207,.28);
}

@media(max-width:768px){
    .screening-card{
        padding:30px 20px;
    }

    .answer-group{
        flex-direction:column;
        align-items:center;
    }

    .answer-btn{
        width:100%;
        max-width:220px;
    }
}
</style>

<section class="container">

<div class="step-wrapper">
    <div class="step-item">
        <div class="step-circle">1</div>
        <div class="step-title">Informasi Umum</div>
    </div>

    <div class="step-line"></div>

    <div class="step-item">
        <div class="step-circle">2</div>
        <div class="step-title">Pertanyaan Skrining</div>
    </div>
</div>

<form action="<?= base_url('skrining-diare-step4') ?>" method="post">

<div class="screening-card">

    <div class="screening-title">Informasi Gejala Klinis</div>
    <div class="screening-subtitle">Sesuaikan dengan kondisi gejala yang dialami</div>

    <div class="counter">6 dari 10</div>

    <div class="progress">
        <div class="progress-bar" style="width:66%"></div>
    </div>

<?php
$pertanyaan = [
    "Apakah bibir Anda kering?",
    "Apakah Tugor menurun?",
    "Apakah Nadi Anda cepat?",
    "Apakah Mata Anda cekung?",
    "Apakah Nafas Anda terasa cepat?"
];
?>

<?php foreach($pertanyaan as $i => $p): ?>
<div class="question-block">

    <div class="question-text"><?= $p ?></div>

    <div class="answer-group">
        <input type="radio" id="ya<?= $i+5 ?>" name="q<?= $i+5 ?>" value="1" required>
        <label for="ya<?= $i+5 ?>" class="answer-btn">Iya</label>

        <input type="radio" id="tidak<?= $i+5 ?>" name="q<?= $i+5 ?>" value="0">
        <label for="tidak<?= $i+5 ?>" class="answer-btn">Tidak</label>
    </div>

</div>
<?php endforeach; ?>

<button class="next-btn">Selanjutnya</button>

</div>
</form>

</section>

<?= $this->include('layout/footer') ?>