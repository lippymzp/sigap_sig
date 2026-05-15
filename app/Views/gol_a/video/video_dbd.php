<?= $this->include('layout/header') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* ================= BODY ================= */

body{
    background:#f3f5f7;
    font-family:'Poppins',sans-serif;
}

/* ================= MAIN WRAPPER ================= */

.video-detail-wrapper{
    margin-top:40px;
}

/* ================= LEFT CONTENT ================= */

.main-video-card{
    background:#fff;
    border-radius:24px;
    padding:18px;
    box-shadow:0 4px 20px rgba(0,0,0,0.06);
}

/* ================= VIDEO ================= */

.main-video{
    width:100%;
    border-radius:22px;
    overflow:hidden;
    background:#000;
}

.main-video video{
    width:100%;
    height:520px;
    object-fit:cover;
    display:block;
}

/* ================= TITLE ================= */

.video-title{
    font-size:28px;
    font-weight:700;
    color:#111;
    margin-top:22px;
    margin-bottom:12px;
}

/* ================= DESC ================= */

.video-desc{
    background:#f5f5f5;
    padding:18px;
    border-radius:16px;
    color:#555;
    line-height:1.8;
    font-size:15px;
}

/* ================= ACTION BUTTON ================= */

.video-action{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin:18px 0;
}

.action-btn{
    border:none;
    background:#f1f1f1;
    padding:10px 18px;
    border-radius:12px;
    font-size:14px;
    font-weight:600;
    color:#444;
    transition:.3s;
}

.action-btn:hover{
    background:#00BBC2;
    color:#fff;
}

/* ================= SIDEBAR ================= */

.sidebar-video{
    display:flex;
    flex-direction:column;
    gap:16px;
}

/* ================= REKOMENDASI CARD ================= */

.rekomendasi-item{
    display:flex;
    gap:12px;
    background:#fff;
    padding:10px;
    border-radius:18px;
    text-decoration:none;
    transition:.3s;
    box-shadow:0 3px 12px rgba(0,0,0,0.05);
}

.rekomendasi-item:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 18px rgba(0,0,0,0.08);
}

/* ================= THUMBNAIL ================= */

.rekomendasi-thumb{
    width:170px;
    height:95px;
    border-radius:14px;
    overflow:hidden;
    flex-shrink:0;
    background:#000;
}

.rekomendasi-thumb video{
    width:100%;
    height:100%;
    object-fit:cover;
    pointer-events:none;
}

/* ================= TEXT ================= */

.rekomendasi-content{
    flex:1;
}

.rekomendasi-content h6{
    font-size:14px;
    font-weight:700;
    color:#222;
    line-height:1.5;
    margin-bottom:6px;
}

.rekomendasi-content p{
    font-size:12px;
    color:#777;
    margin:0;
    line-height:1.6;
}

/* ================= SHARE POPUP ================= */

.share-popup{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.45);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
}

.share-popup.active{
    display:flex;
}

.share-box{
    width:350px;
    background:#fff;
    border-radius:20px;
    padding:20px;
    animation:popupShow .25s ease;
}

@keyframes popupShow{

    from{
        transform:scale(.8);
        opacity:0;
    }

    to{
        transform:scale(1);
        opacity:1;
    }

}

.share-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.share-header h5{
    margin:0;
    font-weight:700;
}

.share-header button{
    border:none;
    background:none;
    font-size:20px;
    cursor:pointer;
}

.share-links{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.share-links a,
.share-links button{
    border:none;
    text-decoration:none;
    padding:14px;
    border-radius:14px;
    font-weight:600;
    text-align:center;
    transition:.25s ease;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    box-shadow:0 6px 15px rgba(0,0,0,0.12);
}

.share-links a:hover,
.share-links button:hover{
    transform:translateY(-2px);
    filter:brightness(1.05);
}

.whatsapp{
    background:linear-gradient(135deg,#25D366,#1ebe5d);
}

.facebook{
    background:linear-gradient(135deg,#1877F2,#145bd1);
}

.telegram{
    background:linear-gradient(135deg,#229ED9,#1a86b8);
}

.copy-btn{
    background:linear-gradient(135deg,#333,#111);
}

/* ================= SHARE ITEM ================= */

.share-item{
    display:flex;
    align-items:center;
    gap:12px;
    border:none;
    text-decoration:none;
    padding:14px;
    border-radius:14px;
    font-weight:600;
    font-size:15px;
    transition:.3s;
    color:#fff !important;
}

.share-item i{
    font-size:20px;
}

/* ================= RESPONSIVE ================= */

@media(max-width:991px){

    .main-video video{
        height:280px;
    }

    .sidebar-video{
        margin-top:25px;
    }

}

/* ================= COPY TOAST ================= */

.copy-toast{
    position:fixed;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%) scale(.8);

    background:rgba(20,20,20,0.95);
    color:#fff;

    padding:18px 28px;
    border-radius:18px;

    display:flex;
    align-items:center;
    gap:12px;

    font-size:15px;
    font-weight:600;

    box-shadow:0 10px 30px rgba(0,0,0,0.25);

    opacity:0;
    visibility:hidden;

    transition:.3s ease;

    z-index:999999;

    backdrop-filter:blur(10px);
}

.copy-toast i{
    color:#00d26a;
    font-size:22px;
}

.copy-toast.show{
    opacity:1;
    visibility:visible;
    transform:translate(-50%, -50%) scale(1);
}

</style>

<div class="container video-detail-wrapper">

    <div class="row g-4">

        <!-- ================= VIDEO UTAMA ================= -->

        <div class="col-lg-9">

            <div class="main-video-card">

                <div class="main-video">

                    <video controls autoplay>

                        <source src="<?= base_url('uploads/video/' . ($video['file_video'] ?? '')) ?>" type="video/mp4">

                        Browser tidak mendukung video.

                    </video>

                </div>

                <h2 class="video-title">
                    <?= esc($video['judul_video'] ?? '') ?>
                </h2>

                <div class="video-action">

                    <!-- DOWNLOAD -->

                    <a href="<?= base_url('uploads/video/' . ($video['file_video'] ?? '')) ?>"
                       download
                       class="action-btn text-decoration-none">

                        ⬇ Download

                    </a>

                    <!-- BAGIKAN -->

                    <button class="action-btn"
                            onclick="openSharePopup()">

                        ↗ Bagikan

                    </button>

                </div>

                <div class="video-desc">
                    <?= esc($video['deskripsi_video'] ?? '') ?>
                </div>

            </div>

        </div>

        <!-- ================= SIDEBAR ================= -->

        <div class="col-lg-3">

            <div class="sidebar-video">

                <?php if(!empty($rekomendasi)) : ?>

                    <?php foreach($rekomendasi as $r) : ?>

                        <a href="<?= base_url('video/video_dbd/' . ($r['id_video'] ?? '')) ?>"
                           class="rekomendasi-item">

                            <div class="rekomendasi-thumb">

                                <video muted>

                                    <source src="<?= base_url('uploads/video/' . ($r['file_video'] ?? '')) ?>" type="video/mp4">

                                </video>

                            </div>

                            <div class="rekomendasi-content">

                                <h6>
                                    <?= esc($r['judul_video'] ?? '') ?>
                                </h6>

                                <p>
                                    <?= substr(strip_tags($r['deskripsi_video'] ?? ''), 0, 55) ?>...
                                </p>

                            </div>

                        </a>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </div>

        <!-- ================= SHARE POPUP ================= -->

        <div class="share-popup" id="sharePopup">

            <div class="share-box">

                <div class="share-header">

                    <h5>Bagikan Video</h5>

                    <button onclick="closeSharePopup()">
                        ✕
                    </button>

                </div>

                <div class="share-links">

                    <a id="waShare" target="_blank" class="share-item whatsapp">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                    </a>

                    <a id="fbShare" target="_blank" class="share-item facebook">
                        <i class="fab fa-facebook-f"></i>
                        Facebook
                    </a>

                    <a id="tgShare" target="_blank" class="share-item telegram">
                        <i class="fab fa-telegram-plane"></i>
                        Telegram
                    </a>

                    <button onclick="copyVideoLink()" class="share-item copy-btn">
                        <i class="fas fa-link"></i>
                        Copy Link
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ================= TOAST COPY ================= -->

<div class="copy-toast" id="copyToast">

    <i class="fas fa-check-circle"></i>
    Link berhasil disalin

</div>

<script>

function openSharePopup(){

    const popup = document.getElementById('sharePopup');

    popup.classList.add('active');

    const currentUrl = window.location.href;

    document.getElementById('waShare').href =
        `https://wa.me/?text=${encodeURIComponent(currentUrl)}`;

    document.getElementById('fbShare').href =
        `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;

    document.getElementById('tgShare').href =
        `https://t.me/share/url?url=${encodeURIComponent(currentUrl)}`;
}

function closeSharePopup(){

    document.getElementById('sharePopup')
            .classList.remove('active');
}

function copyVideoLink(){

    navigator.clipboard.writeText(window.location.href);

    const toast = document.getElementById('copyToast');

    toast.classList.add('show');

    setTimeout(() => {

        toast.classList.remove('show');

    }, 2500);
}

window.onclick = function(e){

    const popup = document.getElementById('sharePopup');

    if(e.target === popup){

        popup.classList.remove('active');
    }
}

</script>