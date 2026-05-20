
<?php $this->setVar('penyakit', 'tbc'); ?>
<?= $this->include('layout/header') ?>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
       html {
        scroll-behavior: smooth;
    }

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
    body {
        background: var(--bg);
        color: var(--text-dark);
        font-family: 'Poppins', sans-serif !important;

    }

        /* ========================================
            NAVBAR
        ======================================== */

        .navbar-custom{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            z-index:999;

            background:rgba(255,255,255,0.94);
            backdrop-filter:blur(14px);

            padding:16px 0;

            box-shadow:
            0 10px 30px rgba(0,0,0,0.05);
        }

        .navbar-brand img{
            height:68px;
        }

        /* ========================================
            HERO
        ======================================== */

        .hero-detail{
            position:relative;
            padding:180px 0 110px;

            background:linear-gradient(
                135deg,
                #11C0D0 0%,
                #74D6DF 100%
            );

            overflow:hidden;
        }

        .hero-detail::before{
            content:'';

            position:absolute;
            width:620px;
            height:620px;

            border-radius:50%;

            background:rgba(255,255,255,0.07);

            top:-250px;
            right:-120px;
        }

        .hero-detail::after{
            content:'';

            position:absolute;
            width:320px;
            height:320px;

            border-radius:50%;

            background:rgba(255,255,255,0.05);

            bottom:-120px;
            left:-90px;
        }

        .hero-content{
            position:relative;
            z-index:2;
        }

        /* ========================================
            BREADCRUMB
        ======================================== */

        .breadcrumb-custom{
            display:inline-flex;
            align-items:center;
            gap:12px;

            background:rgba(255,255,255,0.16);
            border:1px solid rgba(255,255,255,0.2);

            padding:14px 24px;
            border-radius:50px;

            margin-bottom:30px;

            backdrop-filter:blur(10px);
        }

        .breadcrumb-custom a,
        .breadcrumb-custom span{
            color:white;
            text-decoration:none;
            font-size:15px;
            font-weight:600;
        }

        .breadcrumb-custom i{
            color:white;
            font-size:13px;
            opacity:0.9;
        }

        /* ========================================
            HERO TITLE
        ======================================== */

        .badge-detail{
            display:inline-flex;
            align-items:center;
            gap:10px;

            background:rgba(255,255,255,0.16);
            border:1px solid rgba(255,255,255,0.2);

            padding:12px 22px;
            border-radius:50px;

            color:white;
            font-weight:600;
            margin-bottom:30px;
        }

        .hero-content h1{
            color:white;

            font-size:52px;
            font-weight:800;
            line-height:1.18;

            max-width:920px;

            margin-bottom:30px;
        }

        .hero-meta{
            display:flex;
            align-items:center;
            gap:28px;
            flex-wrap:wrap;
        }

        .hero-meta span{
            color:white;
            font-size:16px;
            display:flex;
            align-items:center;
            gap:10px;

            opacity:0.96;
        }

        /* ========================================
            CONTENT
        ======================================== */

        .content-section{
            position:relative;
            margin-top:-70px;
            padding-bottom:100px;
            z-index:5;
        }

        .detail-card{
    background:white;

    border-radius:36px;

    overflow:hidden;

    box-shadow:
    0 25px 60px rgba(0,0,0,0.08);

    border:1px solid rgba(0,0,0,0.03);

    width:80%;
    margin:auto;
}

        .detail-image{
            width:100%;
            height:430px;
            overflow:hidden;
            position:relative;
        }

        .detail-image::after{
            content:'';

            position:absolute;
            inset:0;

            background:linear-gradient(
                to top,
                rgba(0,0,0,0.2),
                transparent
            );
        }

        .detail-image img{
            width:100%;
            height:100%;
            object-fit:cover;
            transition:0.5s ease;
        }

        .detail-card:hover .detail-image img{
            transform:scale(1.04);
        }

        .detail-body{
            padding:45px 50px;
        }

        .detail-body h3{
            font-size:42px;
            font-weight:800;
            color:#0B8B97;

            margin-bottom:28px;
        }

        .detail-body p{
            font-size:18px;
            line-height:2.1;
            color:#5b6668;

            margin-bottom:24px;
        }

        /* ========================================
            INFO BOX
        ======================================== */

        .info-highlight{
            margin-top:10px;
            margin-bottom:55px;

            background:linear-gradient(
                135deg,
                #E8FAFB 0%,
                #D9F4F6 100%
            );

            border-left:6px solid #11C0D0;

            padding:28px 30px;
            border-radius:22px;
        }

        .info-highlight h5{
            color:#0898A5;
            font-size:24px;
            font-weight:800;
            margin-bottom:12px;
        }

        .info-highlight p{
            margin:0;
            color:#5e6a6d;
            font-size:16px;
            line-height:1.9;
        }

        /* ========================================
            BUTTON
        ======================================== */

        .btn-source{
            display:inline-flex;
            align-items:center;
            gap:16px;

            background:linear-gradient(
                135deg,
                #13C1D1 0%,
                #0FA8B8 100%
            );

            color:white;
            text-decoration:none;

            padding:18px 32px;
            border-radius:60px;

            font-weight:700;
            font-size:16px;

            transition:0.35s;

            margin-top:40px;

            box-shadow:
            0 15px 30px rgba(0,0,0,0.12);
        }

        .btn-source:hover{
            color:white;
            transform:translateY(-5px);

            box-shadow:
            0 20px 35px rgba(0,0,0,0.16);
        }

        .btn-back{
            position:fixed;
            left:28px;
            bottom:28px;

            width:68px;
            height:68px;

            border-radius:50%;

            background:linear-gradient(
                135deg,
                #13C1D1 0%,
                #0FA8B8 100%
            );

            display:flex;
            align-items:center;
            justify-content:center;

            color:white;
            font-size:24px;

            text-decoration:none;

            z-index:999;

            box-shadow:
            0 12px 28px rgba(0,0,0,0.18);

            transition:0.35s;
        }

        .btn-back:hover{
            color:white;
            transform:translateY(-5px) scale(1.05);
        }

        /* ========================================
            RESPONSIVE
        ======================================== */

        @media(max-width:992px){

            .hero-detail{
                padding:150px 0 90px;
            }

            .hero-content h1{
                font-size:42px;
            }

            .detail-image{
                height:320px;
            }

            .detail-body{
                padding:35px 28px;
            }

            .detail-body h3{
                font-size:30px;
            }

            .detail-body p{
                font-size:16px;
            }

            .breadcrumb-custom{
                flex-wrap:wrap;
                gap:8px;
            }
        }
    </style>



    <!-- ========================================
        NAVBAR
    ========================================= -->

    <nav class="navbar navbar-expand-lg navbar-custom">

        <div class="container">

            <a class="navbar-brand" href="#">
                <img src="<?= base_url('img/logo_sigap.png') ?>" alt="">
            </a>

        </div>

    </nav>


    <!-- ========================================
        HERO
    ========================================= -->

    <section class="hero-detail">

        <div class="container">

            <div class="hero-content">

                <div class="breadcrumb-custom">

                    <a href="<?= base_url('/') ?>">
                        Portal
                    </a>

                    <i class="fas fa-chevron-right"></i>

                    <a href="<?= base_url('tbc') ?>">
                        Tuberkulosis
                    </a>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        Detail Artikel
                    </span>

                </div>

                <div class="badge-detail">
                    <i class="fas fa-book-medical"></i>
                    Artikel Edukasi Kesehatan
                </div>

                <h1>
                    <?= esc($funfact['judul_funfact']) ?>
                </h1>

                <div class="hero-meta">

                    <span>
                        <i class="fas fa-calendar-alt"></i>
                        <?= date('d F Y', strtotime($funfact['tanggal_funfact'])) ?>
                    </span>

                    <span>
                        <i class="fas fa-lungs"></i>
                        Tuberkulosis
                    </span>

                </div>

            </div>

        </div>

    </section>


    <!-- ========================================
        CONTENT
    ========================================= -->

    <section class="content-section">

        <div class="container">

            <div class="detail-card">

                <div class="detail-image">

                    <img src="<?= base_url('img/' . $funfact['gambar_funfact']) ?>" alt="">

                </div>

                <div class="detail-body">

                    <div class="info-highlight">

                        <h5>
                            Edukasi Kesehatan
                        </h5>

                        <p>
                            Informasi berikut disusun untuk meningkatkan pemahaman masyarakat mengenai tuberkulosis, mulai dari gejala, faktor risiko, hingga langkah pencegahan yang dapat dilakukan sejak dini.
                        </p>

                    </div>

                    <h3>
                        Informasi Lengkap
                    </h3>

                    <p>
                        <?= nl2br($funfact['deskripsi_funfact']) ?>
                    </p>

                    <?php if(!empty($funfact['url'])): ?>

                        <a href="<?= esc($funfact['url']) ?>" target="_blank" class="btn-source">
                            Kunjungi Sumber Artikel
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </section>


    <!-- ========================================
        BACK BUTTON
    ========================================= -->

    <a href="<?= base_url('tbc') ?>" class="btn-back">
        <i class="fas fa-arrow-left"></i>
    </a>

<?= $this->include('layout/footer') ?>