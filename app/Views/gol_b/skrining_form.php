<?php $this->setVar('penyakit', 'tbc'); ?>
<?= $this->include('layout/header') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<title>Skrining</title>

<style>

:root {
    --primary: #40EDD0;
    --dark: #00CED1;
    --medium: #48D1CC;

    --bg: #F4FEFD;
    --card: #E0F7F6;
    --accent: #2CCFC0;
    --border: #B8ECE8;

    --text-dark: #1F3A3A;
    --text-light: #6B8A8A;
}

/* GLOBAL */
body{
    margin:0;
        font-family: 'Poppins', sans-serif !important;
    background:var(--bg);
    color:var(--text-dark);
}

/* WRAPPER */
.wrapper{
    padding:60px 20px;
}

/* STEP */
.step-wrapper{
    position:relative;
    width:fit-content;
    margin:auto;
}

.step-line{
    position:absolute;
    top:17px;
    left:50%;
    width:240px;
    border-top:2px dashed var(--border);
    transform:translateX(-50%);
}

.step-flex{
    display:flex;
    gap:150px;
}

.step-item{
    text-align:center;
    z-index:2;
    position:relative;
}

.step-box{
    width:40px;
    height:40px;
    border-radius:12px;
    border:2px solid var(--dark);
    display:flex;
    align-items:center;
    justify-content:center;
    background:white;
    color:var(--dark);
    font-weight:700;
    margin:auto;
    transition:.3s;
}

.step-item.active .step-box{
    background:linear-gradient(135deg,var(--dark),var(--primary));
    color:white;
    border:none;
    box-shadow:0 8px 20px rgba(0,206,209,.25);
}

.step-item small{
    font-size:13px;
    margin-top:10px;
    display:block;
    color:var(--text-light);
}

/* FORM */
.form-box{
    max-width:850px;
    margin:50px auto;
    background:white;
    border-radius:24px;
    padding:45px;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
    border:1px solid var(--border);
}

h3{
    font-size:30px;
    font-weight:800;
    margin-bottom:10px;
}

.desc{
    font-size:14px;
    color:var(--text-light);
    margin-bottom:35px;
}

/* PROGRESS */
.progress{
    height:14px;
    border-radius:30px;
    background:#e9f8f7;
    overflow:hidden;
}

.progress-bar{
    background:linear-gradient(
        90deg,
        var(--dark),
        var(--primary)
    );
    border-radius:30px;
}

/* QUESTION */
.question{
    margin:70px 0;
    font-size:28px;
    line-height:1.5;
    font-weight:700;
    min-height:120px;
    text-align:center;
}

/* ANSWER BUTTON */
.answer-btn{
    width:100%;
    background:white;
    border:2px solid var(--border);
    color:var(--text-dark);
    padding:18px;
    border-radius:16px;
    margin-bottom:20px;
    font-weight:700;
    transition:.25s;
    font-size:16px;
}

.answer-btn:hover{
    background:var(--dark);
    color:white;
    transform:translateY(-2px);
}

.answer-btn.active{
    background:linear-gradient(
        135deg,
        var(--dark),
        var(--primary)
    );
    color:white;
    border:none;
    box-shadow:0 8px 20px rgba(0,206,209,.25);
}

/* BOTTOM */
.bottom-nav{
    max-width:850px;
    margin:30px auto 0;
    display:flex;
    justify-content:space-between;
    gap:20px;
}

.btn-nav{
    flex:1;
    padding:15px;
    border-radius:16px;
    border:none;
    font-weight:700;
    transition:.25s;
}

.prev{
    background:white;
    border:2px solid var(--border);
    color:var(--dark);
}

.prev:hover{
    background:#f1fdfc;
}

.next{
    background:linear-gradient(
        135deg,
        var(--dark),
        var(--primary)
    );
    color:white;
    box-shadow:0 8px 20px rgba(0,206,209,.25);
}

.next:hover{
    transform:translateY(-2px);
}

/* MOBILE */
@media(max-width:768px){

    .step-flex{
        gap:70px;
    }

    .step-line{
        width:120px;
    }

    .form-box{
        padding:30px 20px;
    }

    .question{
        font-size:22px;
    }
}

</style>
</head>

<body>


<div class="wrapper">

    <!-- STEP -->
    <div class="step-wrapper">

        <div class="step-line"></div>

        <div class="step-flex">

            <div class="step-item">
                <div class="step-box">1</div>
                <small>Informasi Umum</small>
            </div>

            <div class="step-item active">
                <div class="step-box">2</div>
                <small>Pertanyaan Skrining</small>
            </div>

        </div>

    </div>

    <!-- FORM -->
    <div class="form-box">

    <form method="post" action="/skrining-tbc/proses" id="formSkrining">    

        <h3>Informasi Gejala Klinis</h3>

        <div class="desc">
            Sesuaikan dengan kondisi gejala yang dialami
        </div>

        <!-- TEXT -->
        <div id="progressText">
            Pertanyaan 1 dari 13
        </div>

        <!-- PROGRESS -->
        <div class="progress mt-2">
            <div class="progress-bar" id="progressBar" style="width:8%"></div>
        </div>

        <!-- QUESTION -->
            <div class="question" id="questionText"></div>

            <!-- HIDDEN INPUT -->
            <input
                type="hidden"
                name="jawaban"
                id="jawabanInput"
            >

            <!-- ANSWER -->
            <div class="jawaban-group">

                <button
                    type="button"
                    class="answer-btn"
                    id="btnIya"
                    onclick="jawab(1)"
                >
                    Iya
                </button>

                <button
                    type="button"
                    class="answer-btn"
                    id="btnTidak"
                    onclick="jawab(0)"
                >
                    Tidak
                </button>

            </div>

    </div>

    <div id="hiddenJawaban"></div>

</form>

    <!-- BOTTOM -->
    <div class="bottom-nav">

        <button class="btn-nav prev" onclick="prevQuestion()">
            Previous
        </button>

        <button class="btn-nav next" onclick="nextQuestion()">
            Next
        </button>

    </div>

</div>

<script>

const pertanyaan = [

"Apakah Anda mengalami batuk dan berdahak terus-menerus selama dua minggu?",

"Apakah Anda mengalami batuk bercampur darah?",

"Apakah Anda mengalami demam yang berlangsung selama 2 minggu?",

"Apakah Anda sering berkeringat pada malam hari tanpa aktivitas fisik?",

"Apakah Anda mengalami penurunan berat badan tanpa sebab yang jelas dalam waktu selama 2 bulan?",

"Apakah Anda memiliki kondisi yang melemahkan sistem imun, seperti pembesaran kelenjar getah bening, HIV/AIDS, dan diabetes melitus?",

"Apakah Anda mengalami sesak napas?",

"Apakah Anda mengalami penurunan nafsu makan dalam beberapa minggu terakhir?",

"Apakah Anda sering merasa lelah atau tidak bertenaga?",

"Apakah terdapat benjolan yang muncul di sekitar ketiak dan leher?",

"Apakah Anda mengalami nyeri pada dada?",

];

let index = 0;

function tampilPertanyaan(){

    document.getElementById("questionText").innerHTML =
        pertanyaan[index];

    document.getElementById("progressText").innerHTML =
        `Pertanyaan ${index + 1} dari ${pertanyaan.length}`;

    let persen =
        ((index + 1) / pertanyaan.length) * 100;

    document.getElementById("progressBar").style.width =
        persen + "%";

    // RESET ACTIVE
    document
        .getElementById("btnIya")
        .classList.remove("active");

    document
        .getElementById("btnTidak")
        .classList.remove("active");
}

function nextQuestion(){

    // kalau belum jawab
    if(jawaban[index] === undefined){

        alert("Silakan pilih jawaban terlebih dahulu!");

        return;
    }

    // lanjut pertanyaan
    if(index < pertanyaan.length - 1){

        index++;

        tampilPertanyaan();

    }else{

        // kirim jawaban ke backend
        document.getElementById("jawabanInput").value =
            JSON.stringify(jawaban);

        document.getElementById("formSkrining").submit();
    }
}

function prevQuestion(){

    if(index > 0){
        index--;
        tampilPertanyaan();
    }
}

let jawaban = [];

function jawab(nilai){

    // simpan jawaban
    jawaban[index] = nilai;

    // reset
    document
        .getElementById("btnIya")
        .classList.remove("active");

    document
        .getElementById("btnTidak")
        .classList.remove("active");

    // active
    if(nilai == 1){

        document
            .getElementById("btnIya")
            .classList.add("active");

    }else{

        document
            .getElementById("btnTidak")
            .classList.add("active");
    }
}

tampilPertanyaan();

</script>

</body>
</html>

<?= $this->include('layout/footer') ?>