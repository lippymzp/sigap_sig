<?php
$banner = $banner ?? ['gambar' => '', 'judul_banner' => '', 'deskripsi' => ''];
?>

<style>

/* HERO SECTION */
.hero-banner{
    position: relative;
    width: 100%;
    height: 420px;
    background: url("<?= base_url('uploads/banner/'.$banner['gambar']) ?>") center/cover no-repeat;
    display: flex;
    align-items: center;
    border-radius: 0 0 40px 40px;
    overflow: hidden;
}

/* overlay gelap biar teks kebaca */
.hero-banner::before{
    content:"";
    position:absolute;
    inset:0;
}

/* content */
.hero-content{
    position: relative;
    color: #fff;
    padding: 60px;
    max-width: 600px;
    z-index: 2;
}

.hero-content h1{
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 12px;
}

.hero-content p{
    font-size: 16px;
    opacity: 0.9;
    line-height: 1.5;
    margin-bottom: 20px;
}

/* button */
.btn-hero{
    display: inline-block;
    padding: 12px 22px;
    background: #1fb6c9;
    color: #fff;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-hero:hover{
    background: #1595a3;
    transform: translateY(-2px);
}

</style>

<div class="hero-banner">

    <div class="hero-content">
        <h1><?= esc($banner['judul_banner']) ?></h1>

        <p>
            <?= esc($banner['deskripsi']) ?>
        </p>

        <a href="#" class="btn-hero">
            Pelajari selengkapnya
        </a>
    </div>

</div>