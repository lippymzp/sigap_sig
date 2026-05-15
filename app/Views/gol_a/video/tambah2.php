<?= $this->extend('layout/dashboard_layout_admin'); ?>
<?= $this->section('content'); ?>

<style>

body{
    background:#f3f3f3;
    font-family:'Poppins',sans-serif;
}

/* ================= BOX ================= */

.content-box{
    background:#fff;
    border-radius:22px;
    padding:18px 26px 24px;
    max-width:900px;
    margin:12px auto;
    box-shadow:0 3px 10px rgba(0,0,0,.05);
}

/* ================= STEP ================= */

.stepper{
    display:flex;
    justify-content:center;
    align-items:flex-start;
    margin-bottom:28px;
}

.step{
    text-align:center;
    min-width:160px;
}

.circle{
    width:38px;
    height:38px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    font-weight:700;
    margin:auto;
}

.circle.active{
    background:#14bccd;
    color:#fff;
}

.circle.inactive{
    background:#fff;
    border:2px solid #14bccd;
    color:#14bccd;
}

.label{
    margin-top:10px;
    font-size:13px;
    font-weight:600;
    color:#111;
}

.step-line{
    width:260px;
    border-top:2px dashed #14bccd;
    margin:18px 18px 0;
}

/* ================= GRID ================= */

.upload-grid{
    display:grid;
    grid-template-columns:340px 1fr;
    gap:26px;
    align-items:start;
}

/* ================= VIDEO ================= */

.video-card{
    width:100%;
}

.video-thumb{
    width:100%;
    height:190px;
    border-radius:18px;
    overflow:hidden;
    position:relative;
    background:#ddd;
}

.video-thumb video{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
    border-radius:18px;
    background:#000;
}

.video-overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        to top,
        rgba(0,0,0,.35),
        rgba(0,0,0,.02)
    );
    pointer-events:none;
}

.video-duration{
    position:absolute;
    right:10px;
    bottom:10px;
    background:rgba(0,0,0,.45);
    color:#fff;
    font-size:12px;
    font-weight:600;
    padding:4px 8px;
    border-radius:8px;
    z-index:2;
}

/* ================= FORM ================= */

.form-group{
    margin-bottom:16px;
}

.form-label{
    display:block;
    font-size:14px;
    font-weight:700;
    color:#111;
    margin-bottom:8px;
}

.form-control{
    width:100%;
    border:1.5px solid #dddddd;
    border-radius:18px;
    padding:14px 20px;
    font-size:15px;
    font-family:'Poppins',sans-serif;
    outline:none;
    background:#fff;
    transition:.2s;
    box-sizing:border-box;
}

.form-control:focus{
    border-color:#14bccd;
}

.form-control::placeholder{
    color:#a8a8a8;
}

textarea.form-control{
    height:150px;
    resize:none;
}

/* ================= VISIBILITY ================= */

.visibility-wrapper{
    position:relative;
}

.visibility-box{
    height:60px;
    border:1.5px solid #dddddd;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 20px;
    cursor:pointer;
    background:#fff;
}

.visibility-left{
    display:flex;
    align-items:center;
    gap:12px;
}

.visibility-left svg{
    width:24px;
    height:24px;
}

.visibility-text{
    font-size:15px;
    color:#a5a5a5;
}

.visibility-arrow{
    transition:.25s;
}

.visibility-menu{
    position:absolute;
    right:0;
    top:72px;
    width:140px;
    background:#f6f6f6;
    border-radius:16px;
    padding:6px 0;
    display:none;
    z-index:10;
    box-shadow:0 6px 18px rgba(0,0,0,.08);
}

.visibility-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 16px;
    font-size:15px;
    cursor:pointer;
}

.visibility-item:hover{
    background:#efefef;
}

.radio-circle{
    width:14px;
    height:14px;
    border-radius:50%;
    border:2px solid #bdbdbd;
}

.radio-circle.active{
    border-color:#14bccd;
    background:#14bccd;
}

/* ================= BUTTON ================= */

.btn-area{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:18px;
    margin-top:26px;
}

.btn-back,
.btn-upload{
    height:58px;
    border-radius:32px;
    border:none;
    font-size:16px;
    font-weight:700;
    font-family:'Poppins',sans-serif;
    cursor:pointer;
    transition:.2s;
}

.btn-back{
    width:48%;
    background:#fff;
    border:1.5px solid #d9d9d9;
    color:#111;
}

.btn-upload{
    width:52%;
    background:#14bccd;
    color:#fff;
    box-shadow:0 3px 8px rgba(0,0,0,.08);
}

.btn-upload:hover{
    opacity:.96;
}

.btn-back:hover{
    background:#f7f7f7;
}

/* ================= RESPONSIVE ================= */

@media(max-width:950px){

    .upload-grid{
        grid-template-columns:1fr;
    }

    .video-thumb{
        height:220px;
    }

    .step-line{
        width:100px;
    }

    .btn-area{
        flex-direction:column;
    }

    .btn-back,
    .btn-upload{
        width:100%;
    }
}

</style>

<div class="content-box">

    <!-- STEP -->
    <div class="stepper">

        <div class="step">
            <div class="circle active">1</div>
            <div class="label">Unggah video</div>
        </div>

        <div class="step-line"></div>

        <div class="step">
            <div class="circle active">2</div>
            <div class="label">Tambahkan detail</div>
        </div>

    </div>

    <form action="<?= base_url('video/simpanDetail') ?>" method="post">

        <div class="upload-grid">

            <!-- LEFT -->
            <div class="video-card">

                <div class="video-thumb">

                    <video
    id="videoPreview"
    muted
    autoplay
    loop
    playsinline
    preload="auto"
>
    <?php
$file_video = $video['file_video'] ?? session()->get('video_temp') ?? '';
?>

<source
    src="<?= base_url('uploads/video/' . $file_video); ?>"
    type="video/mp4"
>
</video>

                    <div class="video-overlay"></div>

                    <div class="video-duration" id="videoDuration">
                        00:00
                    </div>

                </div>

                <input
                    type="hidden"
                    name="file_video"
                    value="<?= $video['file_video'] ?? session()->get('video_temp'); ?>"
                >

            </div>

            <!-- RIGHT -->
            <div>

                <!-- JUDUL -->
                <div class="form-group">

                    <label class="form-label">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul_video"
                        class="form-control"
                        placeholder="Buat judul video"
                        value="<?= $video['judul_video'] ?? '' ?>"
                        required
                    >

                </div>

                <!-- DESKRIPSI -->
                <div class="form-group">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi_video"
                        class="form-control"
                        placeholder="Tambahkan deskripsi video"
                    ><?= $video['deskripsi_video'] ?? '' ?></textarea>

                </div>

                <!-- VISIBILITY -->
                <div class="form-group">

                    <label class="form-label">
                        Visibilitas
                    </label>

                    <div class="visibility-wrapper">

                        <div class="visibility-box" id="visibilityBox">

                            <div class="visibility-left">

                                <svg fill="none" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke="#333" stroke-width="2"/>
                                    <path d="M12 7V12L15 15" stroke="#333" stroke-width="2" stroke-linecap="round"/>
                                </svg>

                                <div
                                    class="visibility-text"
                                    id="selectedVisibility"
                                >
                                    Publish
                                </div>

                            </div>

                            <svg
                                class="visibility-arrow"
                                id="arrowIcon"
                                width="26"
                                height="26"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M6 9L12 15L18 9"
                                    stroke="#333"
                                    stroke-width="2.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>

                        </div>

                        <div class="visibility-menu" id="visibilityMenu">

                            <div
                                class="visibility-item"
                                onclick="selectVisibility('Draft')"
                            >
                                Draft
                                <div class="radio-circle" id="draftCircle"></div>
                            </div>

                            <div
                                class="visibility-item"
                                onclick="selectVisibility('Publish')"
                            >
                                Publish
                                <div class="radio-circle active" id="publishCircle"></div>
                            </div>

                        </div>

                        <input
                            type="hidden"
                            name="status_video"
                            id="statusVideo"
                            value="publish"
                        >

                    </div>

                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="btn-area">

            <button
                type="button"
                class="btn-back"
                onclick="window.history.back()"
            >
                Kembali
            </button>

            <button
                type="submit"
                class="btn-upload"
            >
                Unggah
            </button>

        </div>

    </form>

</div>

<script>

const video =
document.getElementById('videoPreview');

const durationText =
document.getElementById('videoDuration');


// ================= FORCE LOAD VIDEO =================

video.load();

video.onloadedmetadata = function(){

    const totalSeconds =
    Math.floor(video.duration);

    const minutes =
    Math.floor(totalSeconds / 60);

    const seconds =
    totalSeconds % 60;

    durationText.innerText =
    `${String(minutes).padStart(2,'0')}:${String(seconds).padStart(2,'0')}`;

    // AUTO PLAY
    video.play();

};


// ================= DEBUG =================

video.onerror = function(){

    console.log('VIDEO GAGAL DIMUAT');

};



// ================= VISIBILITY =================

const visibilityBox =
document.getElementById('visibilityBox');

const visibilityMenu =
document.getElementById('visibilityMenu');

const selectedVisibility =
document.getElementById('selectedVisibility');

const statusVideo =
document.getElementById('statusVideo');

const draftCircle =
document.getElementById('draftCircle');

const publishCircle =
document.getElementById('publishCircle');

const arrowIcon =
document.getElementById('arrowIcon');


// TOGGLE MENU

visibilityBox.addEventListener('click', function(){

    if(
        visibilityMenu.style.display === 'block'
    ){

        visibilityMenu.style.display = 'none';

        arrowIcon.style.transform =
        'rotate(0deg)';

    }else{

        visibilityMenu.style.display = 'block';

        arrowIcon.style.transform =
        'rotate(180deg)';
    }

});


// SELECT VISIBILITY

function selectVisibility(value){

    selectedVisibility.innerText = value;

    statusVideo.value =
    value.toLowerCase();

    draftCircle.classList.remove('active');
    publishCircle.classList.remove('active');

    if(value === 'Draft'){

        draftCircle.classList.add('active');

    }else{

        publishCircle.classList.add('active');
    }

    visibilityMenu.style.display = 'none';

    arrowIcon.style.transform =
    'rotate(0deg)';
}


// CLOSE OUTSIDE

document.addEventListener('click', function(e){

    if(
        !visibilityBox.contains(e.target) &&
        !visibilityMenu.contains(e.target)
    ){

        visibilityMenu.style.display = 'none';

        arrowIcon.style.transform =
        'rotate(0deg)';
    }

});

</script>

<?= $this->endSection(); ?>