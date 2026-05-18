<?= $this->include('layout/header') ?>
<div class="tentang-page">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
.tentang-page,
.tentang-page *{
    font-family:'Poppins', sans-serif !important;
}
/* =========================================
   ROOT
========================================= */

:root{
    --primary:#12D6D2;
    --dark:#014F4F;
    --bg:#F4FDFC;
    --text:#1B1B1B;
}

/* =========================================
   BODY
========================================= */

body{
    background:var(--bg);
    font-family:'Poppins',sans-serif;
    overflow-x:hidden;
}

/* =========================================
   HERO
========================================= */

.about-hero{
    background:linear-gradient(135deg,#12D6D2,#55E6E2);
    padding:70px 0;
    text-align:center;
    color:white;
}

.breadcrumb-custom{
    font-size:14px;
    margin-bottom:10px;
    opacity:0.9;
}

.about-title{
    font-size:3rem;
    font-weight:700;
}

/* =========================================
   ABOUT SECTION
========================================= */

.about-section{
    padding:90px 0 50px;
}

.logo-box{
    background: transparent;
    border-radius: 0;
    padding: 20px;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:320px;
    box-shadow: none;
}

.logo-box img{
    width:100%;
    max-width:320px;
    object-fit:contain;
    background: transparent;
}

.about-heading{
    color:var(--primary);
    font-size:3rem;
    font-weight:700;
    margin-bottom:20px;
}

.about-desc{
    color:#444;
    line-height:2;
    font-size:1.05rem;
}

.tagline{
    text-align:center;
    margin-top:70px;
}

.tagline h3{
    color:#00BBC2;
    font-weight:700;
    font-size:2rem;
}

/* =========================================
   FILOSOFI LOGO FIGMA FIX
========================================= */

.filosofi-section{
    padding:40px 0 90px;
}

.section-title{
    text-align:center;
    color:#11C5C8;
    font-size:42px;
    font-weight:700;
    margin-bottom:55px;
}

.filosofi-card{
    background:#fff;
    border-radius:14px;
    padding:18px 20px;
    border-left:6px solid #14CACA;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
    min-height:160px;
    height: 100%;
}

.filosofi-header{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:14px;
}

.icon-box{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#EAF9F9;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.icon-box img{
    width:18px;
    height:18px;
    object-fit: contain;
}

.filosofi-card h4{
    font-size:16px;
    font-weight:700;
    color:#111;
    margin:0;
}

.filosofi-card p{
    font-size:13px;
    line-height:1.7;
    color:#333;
    margin:0;
}

/* CARD WARNA */
.warna-card{
    display:flex;
    align-items:flex-start;
    gap:16px;
    position:relative;
}

.warna-kiri{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#63D7E9;
    border:2px solid #1A98C9;
    flex-shrink:0;
}

.warna-kanan{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#0896C7;
    flex-shrink:0;
}

.warna-content{
    flex:1;
}

@media(max-width:991px){
    .warna-card{
        flex-direction:column;
    }

    .warna-kanan{
        display:none;
    }
}

/* =========================================
   VISI MISI
========================================= */

.visi-misi{
    padding:80px 0;
}

.vm-box{
    background:white;
    padding:40px;
    border-radius:25px;
    box-shadow:0 10px 35px rgba(0,0,0,0.06);
    height:100%;
}

.vm-box h3{
    color:var(--primary);
    font-weight:700;
    margin-bottom:25px;
}

.vm-box p,
.vm-box li,
.vm-box div{
    line-height:2;
    color:#444;
}

/* =========================================
   MASKOT
========================================= */

.maskot-section{
    padding:80px 0;
}

.maskot-box{
    background:white;
    border-radius:30px;
    padding:40px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
}

.maskot-box img{
    width:100%;
    max-width:800px;
    height: auto;
}

.maskot-title{
    color:var(--primary);
    font-size:2.5rem;
    font-weight:700;
    margin-bottom:40px;
}

/* =========================================
   RESPONSIVE
========================================= */

@media(max-width:991px){

    .about-title{
        font-size:2.3rem;
    }

    .about-heading{
        font-size:2.2rem;
        margin-top:40px;
    }

    .section-title{
        font-size:2rem;
    }

}
</style>

<section class="about-hero">
    <div class="container">
        <div class="breadcrumb-custom">
            Beranda &nbsp; > &nbsp; <b>Tentang Kami</b>
        </div>
        <h1 class="about-title">Tentang Kami</h1>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="logo-box">
                    <?php if(!empty($profil['logo'])): ?>
                        <img src="<?= base_url('uploads/profil_sistem/' . $profil['logo']) ?>" alt="Logo">
                    <?php else: ?>
                        <img src="<?= base_url('img/sigap_logo.png') ?>" alt="Logo Default">
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <h2 class="about-heading">
                    Apa itu <?= htmlspecialchars($profil['profil'] ?? 'SIGAP') ?>
                </h2>
                <div class="about-desc">
                    <?= $profil['deskripsi_profil'] ?? 'Deskripsi belum diatur.' ?>
                </div>
            </div>
        </div>

        <?php if(!empty($profil['tagline'])): ?>
        <div class="tagline" data-aos="zoom-in">
            <h3>
                “<?= strip_tags(html_entity_decode($profil['tagline'])) ?>”
            </h3>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="filosofi-section">
    <div class="container">
        <h2 class="section-title">Filosofi Logo</h2>

        <div class="row g-4">
            <?php 
            if(!empty($filosofi)): 
                foreach($filosofi as $key => $row): 
            ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $key * 50 ?>">
                <div class="filosofi-card">
                    <div class="filosofi-header">
                        <div class="icon-box">
                            <?php if(!empty($row['komponen_logo'])): ?>
                                <img src="<?= base_url('uploads/profil_sistem/' . $row['komponen_logo']) ?>" alt="Icon Filosofi">
                            <?php else: ?>
                                <img src="<?= base_url('img/perisai.png') ?>" alt="Icon Default">
                            <?php endif; ?>
                        </div>
                        <h4><?= htmlspecialchars($row['nama_logo'] ?? '') ?></h4>
                    </div>
                    <p>
                        <?= isset($row['deskripsi_logo']) ? strip_tags(html_entity_decode($row['deskripsi_logo'])) : '' ?>
                    </p>
                </div>
            </div>
            <?php 
                endforeach; 
            else: 
            ?>
            <div class="col-12 text-center text-muted">
                <p>Belum ada data komponen filosofi logo.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="visi-misi">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Visi & Misi</h2>
        <div class="row g-4">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="vm-box">
                    <h3>Visi</h3>
                    <div>
                        <?= $profil['isi_visi'] ?? '<p class="text-muted">Visi belum diatur.</p>' ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="vm-box">
                    <h3>Misi</h3>
                    <div>
                        <?= $profil['isi_misi'] ?? '<p class="text-muted">Misi belum diatur.</p>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="maskot-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">
            Maskot Medixa Technology
        </h2>
        <div class="maskot-box" data-aos="zoom-in">
            <?php if(!empty($profil['maskot'])): ?>
                <img src="<?= base_url('uploads/profil_sistem/' . $profil['maskot']) ?>" alt="Maskot">
            <?php else: ?>
                <img src="<?= base_url('img/mascot.png') ?>" alt="Maskot Default">
            <?php endif; ?>
        </div>
    </div>
</section>
</div>
<?= $this->include('layout/footer') ?>