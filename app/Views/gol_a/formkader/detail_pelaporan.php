<?= $this->extend('layout/dashboard_layout_kader') ?>
<?= $this->section('content') ?>

<style>
    .page-wrapper { background-color: #E6F4F1; padding: 20px; border-radius: 15px; min-height: 100vh; }
    .banner-top { background-color: #51C2B8; border-radius: 15px; padding: 20px 25px; color: white; display: flex; align-items: center; margin-bottom: 20px; }
    .banner-icon { background: rgba(255, 255, 255, 0.2); padding: 12px 15px; border-radius: 10px; margin-right: 20px; font-size: 24px; }
    .banner-text h4 { margin: 0; font-weight: 700; font-size: 18px; }
    
    .form-card { background: #FFFFFF; border-radius: 15px; padding: 40px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); }
    .form-label { font-weight: 700; color: #333; font-size: 14px; margin-bottom: 5px; display: block; }
    
    /* Style input khusus mode lihat (View Only) */
    .view-input { background-color: #F8F9FA; border: 1px solid #EAEFEF; border-radius: 10px; padding: 12px 18px; width: 100%; font-size: 14px; color: #555; margin-bottom: 20px; outline: none; cursor: default; }
    
    /* Gallery Preview */
    .preview-grid { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 10px; }
    .preview-item { width: 180px; height: 120px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd; }
    .preview-item img { width: 100%; height: 100%; object-fit: cover; }

    .btn-kembali { background-color: #00CED1; color: white; border: none; padding: 12px 30px; border-radius: 25px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; transition: 0.3s; }
    .btn-kembali:hover { background-color: #00B3B5; color: white; transform: translateY(-2px); }

    .abj-badge { display: inline-block; padding: 5px 15px; border-radius: 20px; background-color: #E6F4F1; color: #00CED1; font-weight: 800; font-size: 16px; margin-left: 10px; }
</style>

<div class="page-wrapper">
    <div class="banner-top">
        <div class="banner-icon"><i class="fa-solid fa-file-lines"></i></div>
        <div class="banner-text">
            <h4>Detail Pelaporan Jentik</h4>
            <p>Informasi hasil pemeriksaan yang telah disimpan</p>
        </div>
    </div>

    <div class="form-card">
        <div class="row">
            <div class="col-md-12 text-end mb-4">
                <span class="form-label d-inline">Angka Bebas Jentik (ABJ) : </span>
                <span class="abj-badge"><?= round($laporan['abj']) ?>%</span>
            </div>
        </div>

        <label class="form-label">Periode Pemeriksaan Jentik</label>
        <div class="view-input"><?= $laporan['periode_lengkap'] ?></div>

        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Puskesmas</label>
                <div class="view-input"><?= $laporan['nama_puskesmas'] ?></div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Kelurahan</label>
                <div class="view-input"><?= $laporan['nama_kelurahan'] ?></div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Pos Posyandu</label>
                <div class="view-input"><?= $laporan['nama_posyandu'] ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Jumlah Rumah yang Diperiksa</label>
                <div class="view-input" style="font-weight: bold; font-size: 16px;"><?= $laporan['diperiksa'] ?></div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jumlah Rumah Positif Jentik</label>
                <div class="view-input" style="font-weight: bold; font-size: 16px; color: <?= ($laporan['positif'] > 0) ? '#DC3545' : '#555' ?>;">
                    <?= $laporan['positif'] ?>
                </div>
            </div>
        </div>

        <label class="form-label">Bagian yang Positif</label>
        <div class="view-input"><?= !empty($laporan['bagian']) ? $laporan['bagian'] : '-' ?></div>

        <label class="form-label">Foto Pemeriksaan Jentik</label>
        <div class="preview-grid mb-4">
            <?php 
            $fotos = json_decode($laporan['foto'], true);
            if (!empty($fotos) && is_array($fotos)) :
                foreach ($fotos as $f) :
            ?>
                <div class="preview-item">
                    <img src="<?= base_url('uploads/pelaporan/' . $f) ?>" alt="Foto Jentik">
                </div>
            <?php 
                endforeach;
            else :
            ?>
                <p style="color: #888; font-style: italic;">Tidak ada foto yang diunggah.</p>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?= base_url('dbd/pelaporan') ?>" class="btn-kembali">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Riwayat
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>