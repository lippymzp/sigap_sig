<?php
$layout = $layout ?? 'layout/dashboard_layout_admin';
?>
<?= $this->extend($layout) ?>

<?= $this->section('style'); ?>
<style>
    /* Import font Poppins dari Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    /* Ubah font-family menjadi Poppins */
    .content-body { background: #e6f6f5; padding: 30px; font-family: 'Poppins', sans-serif; }
    
    /* Header Banner (Warna Tosca) */
    .header-banner { background: #48b8b4; color: white; border-radius: 12px; padding: 20px 25px; display: flex; align-items: center; gap: 15px; margin-bottom: 25px; box-shadow: 0 4px 10px rgba(72, 184, 180, 0.2); }
    .header-banner i { font-size: 28px; background: rgba(255,255,255,0.25); padding: 12px; border-radius: 10px; }

    /* Main Container Putih */
    .main-card { background: #fff; border-radius: 20px; padding: 35px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 20px; }
    
    .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .section-title { font-size: 18px; font-weight: 800; color: #333; margin: 0; }
    
    /* Box Abu-abu Terang */
    .grey-box { background: #f4f5f7; border-radius: 12px; padding: 20px 25px; margin-bottom: 20px; }
    .grey-box-title { font-size: 14px; font-weight: 800; color: #333; margin-bottom: 15px; }

    /* Garis Pemisah (Border) pada Periode & Lokasi */
    .info-grid { display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 0; }
    .info-item { padding: 0 20px; border-right: 1px solid #d1d5db; }
    .info-item:first-child { padding-left: 0; }
    .info-item:last-child { border-right: none; padding-right: 0; }
    
    .info-label { font-size: 13px; color: #333; margin-bottom: 8px; font-weight: 700; }
    .info-value { font-size: 14px; color: #111; font-weight: 500; line-height: 1.5; }

    /* Statistik Box Putih */
    .stat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .stat-card {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .stat-card-title { font-size: 13px; font-weight: 700; color: #333; margin: 0; }
    .stat-card-value { font-size: 40px; font-weight: 800; color: #111; line-height: 1; }

    /* ABJ Box Putih */
    .abj-card { background: #fff; border-radius: 10px; padding: 25px; text-align: center; margin-bottom: 15px; }
    .abj-title { font-size: 13px; font-weight: 800; color: #333; margin-bottom: 10px; }
    .abj-value { font-size: 42px; font-weight: 800; color: #e53e3e; line-height: 1; }
    
    /* Box Rekomendasi (Warna Kuning/Orange) */
    .rekomendasi-box { background: #ffedd5; border: 2px solid #f6ad55; border-radius: 8px; padding: 15px; text-align: center; }
    .rekomendasi-text { color: #c05621; font-size: 14px; font-weight: 600; margin: 0; }

    /* Galeri Images */
    .gallery-grid { display: flex; flex-wrap: wrap; gap: 15px; }
    .gallery-img { height: 220px; width: 320px; object-fit: cover; border-radius: 15px; border: 1px solid #ddd; }
    
    /* Text Status Keterlambatan */
    .text-late { color: #e53e3e; font-weight: 700; }
    .text-ontime { color: #38a169; font-weight: 700; }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="content-body">
    
    <div class="header-banner">
        <i class="fas fa-shield-alt"></i>
        <div>
            <h4 class="mb-1 fw-bold text-white">Data Hasil Pemeriksaan Jentik</h4>
            <div style="font-size: 14px; color: #e6f6f5;">Silahkan isi data dengan benar</div>
        </div>
    </div>

    <div class="main-card">
        
        <?php 
            /** @var array $laporan */
            
            // =========================================================================
            // MAPPING MANUAL SESUAI DENGAN REKAP KADER
            // =========================================================================
            $id_kelurahan = $laporan['id_kelurahan'] ?? '-';
            $nama_kelurahan = $id_kelurahan;

            // Logika persis seperti di rekap_kader.php
            if ($id_kelurahan == 1) {
                $nama_kelurahan = 'Sumbersari';
            } elseif ($id_kelurahan == 2) {
                $nama_kelurahan = 'Wirolegi';
            } elseif ($id_kelurahan == 3) {
                $nama_kelurahan = 'Antirogo';
            } elseif ($id_kelurahan == 4) {
                $nama_kelurahan = 'Tegalgede';
            } elseif ($id_kelurahan == 5) {
                $nama_kelurahan = 'Karangrejo';
            } else {
                $nama_kelurahan = $laporan['kelurahan'] ?? $id_kelurahan;
            }

            // Mapping nama puskesmas
            $id_puskesmas = $laporan['id_puskesmas'] ?? '-';
            $nama_puskesmas = ($id_puskesmas == 1) ? 'Sumbersari' : $id_puskesmas;
            // =========================================================================

            // LOGIKA KETERLAMBATAN
            $mingguNama = $laporan['minggu'] ?? '';
            $bulanNama  = $laporan['bulan'] ?? '';
            $createdAt  = $laporan['created_at'] ?? date('Y-m-d H:i:s'); 
            $tahun      = date('Y', strtotime($createdAt));

            $bulanAngka = ['Januari'=>1,'Februari'=>2,'Maret'=>3,'April'=>4,'Mei'=>5,'Juni'=>6,'Juli'=>7,'Agustus'=>8,'September'=>9,'Oktober'=>10,'November'=>11,'Desember'=>12];
            $m = $bulanAngka[$bulanNama] ?? date('n');

            $targetJumat = null;
            $mingguKe = 1;
            $jmlHari = cal_days_in_month(CAL_GREGORIAN, $m, $tahun);
            
            for ($d = 1; $d <= $jmlHari; $d++) {
                $dateStr = sprintf('%04d-%02d-%02d', $tahun, $m, $d);
                if (date('N', strtotime($dateStr)) == 5) { 
                    if ("Minggu ke-" . $mingguKe === $mingguNama) {
                        $targetJumat = $dateStr; 
                        break;
                    }
                    $mingguKe++;
                }
            }

            $tgl_upload_date = date('Y-m-d', strtotime($createdAt));

            // Format bulan Indonesia
            $tsUpload = strtotime($createdAt);
            $bulanIndo = [
                'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April',
                'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus',
                'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
            ];
            $tgl_upload_indo = date('d', $tsUpload) . ' ' . ($bulanIndo[date('F', $tsUpload)] ?? date('F', $tsUpload)) . ' ' . date('Y', $tsUpload);
            
            $statusText = '';
            $statusClass = '';

            if ($targetJumat) {
                $datetime_target = new DateTime($targetJumat);
                $datetime_upload = new DateTime($tgl_upload_date);
                
                $selisih = $datetime_target->diff($datetime_upload);
                $selisihHari = (int)$selisih->format('%R%a'); 

                if ($selisihHari > 0) {
                    $statusText = "(Terlambat $selisihHari Hari)";
                    $statusClass = "text-late";
                } else {
                    $statusText = "(Tepat Waktu)";
                    $statusClass = "text-ontime";
                }
            } else {
                $statusText = "(Periode Tidak Valid)";
                $statusClass = "text-muted";
            }
        ?>

        <div class="section-header">
            <h3 class="section-title">Periode Pemeriksaan Jentik</h3>
            <div style="font-size: 14px; color: #555;">
                Tanggal Pelaporan : <span class="<?= $statusClass ?>"><?= $tgl_upload_indo ?> <?= $statusText ?></span>
            </div>
        </div>

        <div class="grey-box">
            <div class="grey-box-title">Periode dan Lokasi</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Periode</div>
                    <div class="info-value">
                        <?= $laporan['minggu'] ?? '-' ?> (<?= $laporan['periode_lengkap'] ?? '-' ?>)
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Wilayah Kerja</div>
                    <div class="info-value">
                        Puskesmas: <?= $nama_puskesmas ?> <br>
                        Kelurahan: <?= $nama_kelurahan ?> <br>
                        Pos Posyandu : Catleya <?= $laporan['id_posyandu'] ?? '-' ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Bagian positif jentik</div>
                    <div class="info-value">
                        <?= !empty($laporan['bagian']) ? $laporan['bagian'] : '-' ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="grey-box">
            <div class="grey-box-title">Statistik Pemeriksaan</div>
            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-card-title">Jumlah Rumah Diperiksa</div>
                    <div class="stat-card-value"><?= $laporan['diperiksa'] ?? 0 ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-title">Jumlah Rumah Positif Jentik</div>
                    <div class="stat-card-value"><?= $laporan['positif'] ?? 0 ?></div>
                </div>
            </div>
        </div>

        <div class="grey-box">
            <div class="grey-box-title">Angka Bebas Jentik (ABJ)</div>
            <div class="abj-card">
                <div class="abj-title" style="<?= (isset($laporan['abj']) && $laporan['abj'] < 95) ? '' : 'color: #38a169;' ?>">Skor ABJ (%)</div>
                <div class="abj-value" style="<?= (isset($laporan['abj']) && $laporan['abj'] < 95) ? '' : 'color: #38a169;' ?>">
                    <?= isset($laporan['abj']) ? round($laporan['abj'], 1) : 0 ?>%
                </div>
            </div>
            
            <div class="grey-box-title mt-4">Rekomendasi</div>
            <?php if(isset($laporan['abj']) && $laporan['abj'] < 95): ?>
                <div class="rekomendasi-box">
                    <p class="rekomendasi-text">
                        ⚠️ Perhatian! ABJ < 95%. Risiko tinggi DBD.<br>
                        <span style="color: #dd6b20; font-weight: 500;">Segera tingkatkan kebersihan lingkungan, kegiatan PSM, dan lakukan abatisasi pada penampungan air.</span>
                    </p>
                </div>
            <?php else: ?>
                <div class="rekomendasi-box" style="background: #f0fff4; border-color: #48bb78;">
                    <p class="rekomendasi-text" style="color: #2f855a;">
                        ✅ ABJ Baik (≥ 95%). Lingkungan aman.<br>
                        <span style="font-weight: 500;">Pertahankan kebersihan lingkungan dan kegiatan PSM secara rutin.</span>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <div class="grey-box">
            <div class="grey-box-title">Galeri Pemeriksaan Jentik</div>
            <div class="gallery-grid">
                <?php 
                $fotosRaw = $laporan['foto'] ?? '';
                $fotos = json_decode((string) $fotosRaw, true);

                if (empty($fotos) || !is_array($fotos)) {
                    $fotos = [];
                    if (!empty($fotosRaw) && $fotosRaw !== 'null') {
                        $fotos = [(string) $fotosRaw];
                    }
                }

                if (!empty($fotos) && is_array($fotos)):
                    foreach($fotos as $f):
                        $f = trim((string) $f);
                        if ($f === '') continue;

                        $isPath = (strpos($f, 'uploads/') !== false) || (strpos($f, 'uploads\\') !== false);
                        $src = $isPath
                            ? base_url(str_replace('\\', '/', $f))
                            : base_url('uploads/pelaporan/' . $f);
                ?>
                        <img src="<?= $src ?>" class="gallery-img" alt="Foto Jentik">
                <?php
                    endforeach;
                else:
                ?>
                    <div class="w-100 text-center py-4" style="color: #999;">
                        <p style="font-style: italic;">Tidak ada foto yang diunggah.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>