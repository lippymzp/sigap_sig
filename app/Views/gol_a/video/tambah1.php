<?= $this->extend('layout/dashboard_layout_admin'); ?>
<?= $this->section('content'); ?>

<style>

body{
    background:#efefef;
    font-family:'Poppins',sans-serif;
}

/* ================= WRAPPER ================= */

.upload-wrapper{
    background:#f7f7f7;
    border-radius:20px;
    padding:16px 22px 20px;
    max-width:900px;
    margin:10px auto;
    box-shadow:0 3px 10px rgba(0,0,0,.05);
}

/* ================= STEP ================= */

.stepper{
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:18px;
}

.step-item{
    display:flex;
    flex-direction:column;
    align-items:center;
    font-size:12px;
    font-weight:500;
    color:#111;
}

.circle{
    width:34px;
    height:34px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
    font-weight:700;
    margin-bottom:6px;
}

.circle.active{
    background:#16bccd;
    color:#fff;
}

.circle.inactive{
    border:2px solid #16bccd;
    background:#fff;
    color:#16bccd;
}

.line{
    width:260px;
    border-top:2px dashed #16bccd;
    margin:0 14px;
    margin-bottom:26px;
}

/* ================= UPLOAD BOX ================= */

.upload-box{
    border:2px dashed #d0d0d0;
    border-radius:20px;
    background:#fafafa;
    min-height:340px;
    padding:22px 22px 18px;
    width:100%;
    position:relative;
}

/* ================= BEFORE ================= */

#beforeUpload{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    min-height:260px;
    cursor:pointer;
}

.upload-title{
    font-size:28px;
    font-weight:800;
    color:#000;
    margin-bottom:16px;
}

.upload-icon{
    width:125px;
    height:125px;
    border-radius:50%;
    background:linear-gradient(to bottom,#eaf9fb,#c9eef2);
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:20px;
    box-shadow:0 0 22px rgba(0,188,212,.22);
    border:2px solid rgba(255,255,255,.6);
}

.upload-icon svg{
    width:54px;
    height:54px;
    fill:#16bccd;
}

.upload-desc{
    font-size:14px;
    line-height:1.7;
    color:#a3a3a3;
    text-align:center;
    max-width:560px;
    font-weight:500;
}

/* ================= INPUT ================= */

input[type="file"]{
    display:none;
}

/* ================= UPLOADING ================= */

#uploading{
    width:100%;
}

/* ================= PREVIEW ================= */

.preview-box{
    width:100%;
    max-width:560px;
    height:280px;
    margin:auto;
    border-radius:18px;
    overflow:hidden;
    position:relative;
    background:#000;
}

.preview-box video{
    width:100%;
    height:100%;
    object-fit:cover;
    border-radius:18px;
}

/* ================= TEXT ================= */

.success-text{
    position:absolute;
    top:14px;
    left:50%;
    transform:translateX(-50%);
    z-index:5;
    font-size:20px;
    font-weight:800;
    color:#fff;
    width:100%;
    text-align:center;
}

/* ================= PROGRESS CIRCLE ================= */

.progress-circle{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    width:100px;
    height:100px;
    border-radius:50%;
    background:rgba(255,255,255,.25);
    border:3px solid rgba(255,255,255,.8);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:4;
    backdrop-filter:blur(4px);
}

.progress-circle span{
    width:78px;
    height:78px;
    border-radius:50%;
    background:rgba(255,255,255,.18);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    font-weight:700;
    color:#16bccd;
}

/* ================= FILE INFO ================= */

.file-info{
    margin-top:18px;
}

.file-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:14px;
}

.file-left{
    display:flex;
    align-items:center;
    gap:12px;
    flex:1;
    min-width:0;
}

.file-icon{
    width:46px;
    height:46px;
    border-radius:12px;
    background:#e8fbfd;
    border:2px solid #d7f4f8;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    box-shadow:0 2px 6px rgba(0,0,0,.06);
}

.file-text{
    min-width:0;
}

.file-name{
    font-size:15px;
    font-weight:700;
    color:#111;
    line-height:1.2;
    margin-bottom:3px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.file-meta{
    font-size:13px;
    color:#9c9c9c;
}

.remove-btn{
    width:38px;
    height:38px;
    border-radius:50%;
    background:#fff;
    border:1px solid #e3e3e3;
    color:#a0a0a0;
    font-size:24px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    flex-shrink:0;
    transition:.2s;
}

.remove-btn:hover{
    background:#f5f5f5;
}

/* ================= PROGRESS ================= */

.progress-wrap{
    width:100%;
    height:6px;
    background:#e8e8e8;
    border-radius:20px;
    overflow:hidden;
    margin-top:12px;
}

#progressBar{
    width:0%;
    height:100%;
    background:#16bccd;
    border-radius:20px;
    transition:.3s;
}

/* ================= BUTTON ================= */

.btn-area{
    display:flex;
    gap:16px;
    margin-top:22px;
}

.btn-cancel,
.btn-upload{
    flex:1;
    height:54px;
    border-radius:30px;
    font-size:16px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    box-sizing:border-box;
    padding:0;
    margin:0;
    line-height:1;
    appearance:none;
    -webkit-appearance:none;
    cursor:pointer;
    transition:.2s;
}

.btn-cancel{
    border:1.5px solid #d3d3d3;
    background:#fff;
    color:#000;
}

.btn-upload{
    border:1.5px solid transparent;
    background:#16bccd;
    color:#fff;
    box-shadow:0 2px 6px rgba(0,0,0,.08);
}

.btn-upload:hover{
    opacity:.95;
}

</style>

<div class="upload-wrapper">

    <!-- STEP -->
    <div class="stepper">

        <div class="step-item">
            <div class="circle active">1</div>
            <div>Unggah video</div>
        </div>

        <div class="line"></div>

        <div class="step-item">
            <div class="circle inactive">2</div>
            <div>Tambahkan detail</div>
        </div>

    </div>

    <!-- FORM -->
    <form id="uploadForm" enctype="multipart/form-data">

        <!-- BOX -->
        <div class="upload-box">

            <!-- BEFORE -->
            <label for="videoUpload" id="beforeUpload">

                <div class="upload-title">
                    Unggah Video di Sini
                </div>

                <div class="upload-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M5 20h14v-2H5v2zm7-18l-5.5 5.5 1.42 1.42L11 6.84V16h2V6.84l3.08 3.08 1.42-1.42L12 2z"/>
                    </svg>
                </div>

                <div class="upload-desc">
                    Untuk hasil terbaik, unggahan video sebaiknya minimal beresolusi 1080p (1920 x 1080 piksel) dalam format MP4.
                </div>

            </label>

            <!-- UPLOADING -->
            <div id="uploading" style="display:none;">

                <div class="preview-box">

                    <div class="success-text" id="uploadStatus">
                        Sedang mengunggah video!
                    </div>

                    <video
                        id="previewVideo"
                        autoplay
                        muted
                        loop
                        playsinline
                    ></video>

                    <div class="progress-circle">
                        <span id="progressPercent">0%</span>
                    </div>

                </div>

                <!-- FILE -->
                <div class="file-info">

                    <div class="file-top">

                        <div class="file-left">

                            <div class="file-icon">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">

                                    <path
                                        d="M15 10.5V13.5L20 16.5V7.5L15 10.5Z"
                                        stroke="#16bccd"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />

                                    <rect
                                        x="3"
                                        y="6"
                                        width="12"
                                        height="12"
                                        rx="2"
                                        stroke="#16bccd"
                                        stroke-width="2"
                                    />

                                </svg>

                            </div>

                            <div class="file-text">

                                <div class="file-name" id="fileName">
                                    video.mp4
                                </div>

                                <div class="file-meta" id="fileMeta">
                                    MP4 • 0 MB • Menunggu upload
                                </div>

                            </div>

                        </div>

                        <div class="remove-btn" id="removeBtn">
                            ×
                        </div>

                    </div>

                    <!-- PROGRESS -->
                    <div class="progress-wrap">
                        <div id="progressBar"></div>
                    </div>

                </div>

            </div>

        </div>

        <!-- INPUT -->
        <input
            type="file"
            id="videoUpload"
            name="file_video"
            accept="video/mp4"
            required
        >

        <!-- BUTTON -->
        <div class="btn-area">

            <button
                type="button"
                class="btn-cancel"
                onclick="history.back()"
            >
                Batal
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

const form = document.getElementById('uploadForm');
const input = document.getElementById('videoUpload');

const beforeUpload = document.getElementById('beforeUpload');
const uploading = document.getElementById('uploading');

const preview = document.getElementById('previewVideo');

const fileName = document.getElementById('fileName');
const fileMeta = document.getElementById('fileMeta');

const progressBar = document.getElementById('progressBar');
const progressPercent = document.getElementById('progressPercent');

const removeBtn = document.getElementById('removeBtn');


// ================= LOAD VIDEO SAAT KEMBALI =================

window.addEventListener('load', function(){

    const savedVideo =
    sessionStorage.getItem('preview_video');

    const savedName =
    sessionStorage.getItem('preview_name');

    const savedMeta =
    sessionStorage.getItem('preview_meta');

    if(savedVideo){

        preview.src = savedVideo;

        beforeUpload.style.display = 'none';
        uploading.style.display = 'block';

        fileName.innerText =
        savedName || 'video.mp4';

        fileMeta.innerText =
        savedMeta || 'MP4 • Upload selesai';

        progressBar.style.width = '100%';

        progressPercent.innerHTML = '✓';

        document.getElementById('uploadStatus').innerText =
        'Video berhasil diunggah!';
    }

});


// ================= PILIH VIDEO =================

input.addEventListener('change', function(){

    const file = this.files[0];

    if(file){

        const videoURL =
        URL.createObjectURL(file);

        const fileSize =
        (file.size / (1024 * 1024)).toFixed(0);

        preview.src = videoURL;

        preview.load();

        fileName.innerText =
        file.name;

        fileMeta.innerText =
        `MP4 • ${fileSize} MB • Menunggu upload`;

        beforeUpload.style.display = 'none';
        uploading.style.display = 'block';

        progressBar.style.width = '0%';

        progressPercent.innerText = '0%';

        document.getElementById('uploadStatus').innerText =
        'Siap diunggah';

        // SIMPAN PREVIEW
        sessionStorage.setItem(
            'preview_video',
            videoURL
        );

        sessionStorage.setItem(
            'preview_name',
            file.name
        );

        sessionStorage.setItem(
            'preview_meta',
            `MP4 • ${fileSize} MB • Menunggu upload`
        );
    }

});


// ================= HAPUS VIDEO =================

removeBtn.addEventListener('click', function(){

    input.value = "";

    preview.src = "";

    beforeUpload.style.display = 'flex';
    uploading.style.display = 'none';

    sessionStorage.removeItem('preview_video');
    sessionStorage.removeItem('preview_name');
    sessionStorage.removeItem('preview_meta');

});


// ================= UPLOAD =================

form.addEventListener('submit', function(e){

    e.preventDefault();

    const file = input.files[0];

    if(!file){

        alert('Pilih video terlebih dahulu!');
        return;
    }

    let formData = new FormData();

    formData.append('file_video', file);

    let xhr = new XMLHttpRequest();

    xhr.open(
        "POST",
        "<?= base_url('video/simpan') ?>",
        true
    );

    let startTime = Date.now();

    xhr.upload.onprogress = function(e){

        if(e.lengthComputable){

            let percent =
            Math.round((e.loaded / e.total) * 100);

            progressBar.style.width =
            percent + "%";

            progressPercent.innerText =
            percent + "%";

            const totalMB =
            (e.total / (1024 * 1024)).toFixed(0);

            const elapsed =
            (Date.now() - startTime) / 1000;

            const speed =
            e.loaded / elapsed;

            let remaining =
            (e.total - e.loaded) / speed;

            remaining =
            Math.max(1, Math.round(remaining));

            fileMeta.innerText =
            `MP4 • ${totalMB} MB • Tersisa ${remaining} detik`;

            document.getElementById('uploadStatus').innerText =
            'Sedang mengunggah video!';

            if(percent >= 100){

                progressPercent.innerHTML = '✓';

                fileMeta.innerText =
                `MP4 • ${totalMB} MB • Upload selesai`;

                document.getElementById('uploadStatus').innerText =
                'Video berhasil diunggah!';

                sessionStorage.setItem(
                    'preview_meta',
                    `MP4 • ${totalMB} MB • Upload selesai`
                );
            }
        }

    };

    xhr.onload = function(){

        if(xhr.status == 200){

            setTimeout(() => {

                window.location.href =
                "<?= base_url('video/tambah2') ?>";

            }, 1000);

        }else{

            alert('Upload gagal!');
        }

    };

    xhr.send(formData);

});

</script>

<?= $this->endSection(); ?>