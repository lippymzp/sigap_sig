<?= $this->include('layout/header') ?>

<style>
:root{
    --primary:#11D6D2;
    --primary-dark:#00BFC6;
    --bg:#F7FAFC;
    --text:#1F2937;
    --muted:#6B7280;
    --card:#FFFFFF;
}

/* GLOBAL */
body{
    background:var(--bg);
    font-family:'Poppins', sans-serif;
    overflow-x:hidden;
}

/* HERO */
.kontak-header{
    background: linear-gradient(90deg, #08C8D1 0%, #6CE5E8 100%);
    padding: 70px 0;
    margin-top: -10px;
}

.kontak-breadcrumb{
    color: rgba(255,255,255,0.9);
    font-size:14px;
    margin-bottom:10px;
    letter-spacing:0.3px;
}

.kontak-breadcrumb span{
    margin:0 8px;
}

.kontak-title{
    font-size:48px;
    font-weight:700;
    color:white;
}

/* SECTION */
.kontak-section{
    padding:90px 0;
}

/* LABEL */
.info-badge{
    display:inline-block;
    padding:8px 18px;
    border-radius:30px;
    background:white;
    color:var(--primary-dark);
    font-size:13px;
    font-weight:600;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
    margin-bottom:20px;
}

/* TITLE */
.section-title{
    font-size:42px;
    font-weight:700;
    color:var(--primary-dark);
    margin-bottom:20px;
}

/* DESC */
.section-desc{
    max-width:700px;
    margin:auto;
    color:var(--muted);
    line-height:1.9;
    font-size:16px;
}

/* CONTACT CARD */
.contact-card{
    background:var(--card);
    border:none;
    border-radius:22px;
    padding:40px 25px;
    box-shadow:0 12px 30px rgba(0,0,0,0.06);
    transition:0.3s;
    height:100%;
}

.contact-card:hover{
    transform:translateY(-10px);
    box-shadow:0 18px 40px rgba(17,214,210,0.15);
}

/* ICON */
.contact-icon{
    width:65px;
    height:65px;
    margin:auto;
    border-radius:50%;
    background:rgba(17,214,210,0.12);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    margin-bottom:20px;
}

/* TITLE CARD */
.contact-card h5{
    font-size:20px;
    font-weight:700;
    color:var(--text);
    margin-bottom:15px;
}

/* TEXT CARD */
.contact-card p{
    color:var(--muted);
    line-height:1.8;
    font-size:15px;
    margin:0;
}

/* RESPONSIVE */
@media(max-width:991px){

    .kontak-title{
        font-size:36px;
    }

    .section-title{
        font-size:32px;
    }

}

@media(max-width:768px){

    .kontak-header{
        padding:50px 0;
    }

    .kontak-title{
        font-size:30px;
    }

    .section-title{
        font-size:28px;
    }

    .contact-card{
        padding:30px 20px;
    }

}
</style>

<!-- HERO -->
<section class="kontak-header text-center">

    <div class="container">

        <div class="kontak-breadcrumb">
            Beranda <span>›</span> Kontak
        </div>

        <h1 class="kontak-title">
            Kontak
        </h1>

    </div>

</section>

<!-- CONTENT -->
<section class="kontak-section">

    <div class="container text-center">

        <div class="info-badge">
            • INFO KONTAK •
        </div>

        <h2 class="section-title">
            Hubungi Kami
        </h2>

        <p class="section-desc">
            Tim kami siap membantu menjawab pertanyaan Anda seputar layanan dan
            informasi kesehatan. Jangan ragu untuk menghubungi kami melalui
            formulir atau kontak yang tersedia.
        </p>

        <div class="row mt-5 g-4">

            <!-- LOKASI -->
            <div class="col-lg-4 col-md-6">

                <div class="contact-card">

                    <div class="contact-icon">
                        📍
                    </div>

                    <h5>Lokasi</h5>

                    <p>
                        Jl. Mastrip, Krajan Timur, Sumbersari,  
                        Kec. Sumbersari, Kabupaten Jember,  
                        Jawa Timur 68121
                    </p>

                </div>

            </div>

            <!-- EMAIL -->
            <div class="col-lg-4 col-md-6">

                <div class="contact-card">

                    <div class="contact-icon">
                        ✉️
                    </div>

                    <h5>Alamat Email</h5>

                    <p>
                        medixatechnology@gmail.com
                    </p>

                </div>

            </div>

            <!-- SOSMED -->
            <div class="col-lg-4 col-md-12">

                <div class="contact-card">

                    <div class="contact-icon">
                        📷
                    </div>

                    <h5>Media Sosial</h5>

                    <p>
                        sigap.co.id
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>