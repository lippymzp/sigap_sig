<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<?php
$grafik = isset($grafik) ? $grafik : [];
$dbd = isset($dbd) ? $dbd : [];

$detailDesa = isset($detailDesa)
    ? $detailDesa
    : [];

$desaTertinggi = isset($desaTertinggi)
    ? $desaTertinggi
    : '-';

$tahunSekarang = date('Y');

?>
<style>
.custom-modal {
    display: none;
    position: fixed;
    z-index: 99999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.45);
    justify-content: center;
    align-items: center;
}

.custom-modal-content {
    background: #fff;
    width: 85%;
    max-width: 760px;
    border-radius: 20px;
    padding: 30px 35px;
    position: relative;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    max-height: 90vh;
    overflow-y: auto;
}

.close-modal {
    position: absolute;
    right: 25px;
    top: 12px;
    font-size: 30px;
    cursor: pointer;
    font-weight: bold;
    color: #444;
}

.close-modal:hover { color: #000; }

.modal-title {
    font-size: 20px;
    font-weight: 700;
    color: #222;
    margin-bottom: 18px;
}

.info-box {
    background: #f8f8f8;
    border-radius: 18px;
    padding: 25px 30px;
    border: 1px solid #e2e2e2;
}

.info-box h4 {
    font-size: 16px;
    margin: 0 0 14px 0;
    color: #222;
    font-weight: 700;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14.5px;
    color: #333;
}

.info-table tr td {
    padding: 6px 0;
    vertical-align: top;
    line-height: 1.6;
}

.info-table tr td.label {
    width: 45%;
    color: #2b2b2b;
}

.info-table tr td.colon {
    width: 18px;
    text-align: center;
    color: #555;
}

.info-table tr td.value {
    color: #111;
    font-weight: 500;
}

.info-table tr.sub td.label {
    padding-left: 28px;
    color: #444;
    font-weight: 400;
}

.kategori-tinggi { color: #dc3545; font-weight: 600; }
.kategori-sedang { color: #d39e00; font-weight: 600; }
.kategori-rendah { color: #28a745; font-weight: 600; }
</style>

<!-- WELCOME -->
<div class="welcome-box">
    <div class="welcome-text">
        <h5>Selamat datang kembali,</h5>
        <h3>Anda masuk sebagai ADMIN</h3>
        <p>Puskesmas Sumbersari, Jember</p>
    </div>

    <div class="welcome-icon">
        <img src="<?= base_url('img/World_Map.png') ?>"
             alt="map"
             style="width:280px; height:auto;">
    </div>
</div>

<!-- STAT -->
<div class="stat-row">
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-chart-column"></i></div>
        <div class="stat-info">
            <h3 class="red">20</h3>
            <p>Total Kasus Aktif Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="fa-solid fa-arrow-up"></i>
            <i class="fa-solid fa-arrow-down"></i>
        </div>
        <div class="stat-info">
            <h3 class="green">2</h3>
            <p>Kasus Baru Hari Ini</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-map"></i></div>
        <div class="stat-info">
            <h3 class="blue">6</h3>
            <p>Kelurahan Terdampak</p>
        </div>
    </div>
</div>

<!-- MAP -->
<div class="section-card">
    <div class="section-block">
        <div class="section-header">
            <div>
                <h5>Peta Interaktif Penyebaran</h5>
                <p class="sub">Visualisasi kepadatan kasus berdasarkan koordinat wilayah</p>
            </div>
            <div class="filter">
                <span>Periode:</span>
                <select id="periodeMap" onchange="updateMap()">
                    <?php for($t = 2024; $t <= $tahunSekarang; $t++): ?>
                        <option value="<?= $t ?>" <?= ($t == $tahunSekarang ? 'selected' : '') ?>>
                            <?= $t ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="inner-card">
            <div id="map"></div>

            <!-- =================== MODAL DETAIL DESA =================== -->
            <div id="detailModal" class="custom-modal">
                <div class="custom-modal-content">

                    <span class="close-modal" onclick="closeDetailModal()">&times;</span>

                    <div class="modal-title">
                        Peta Sebaran Kasus <span id="modalTahun"><?= $tahunSekarang ?></span>
                    </div>

                    <div class="info-box">
                        <h4>Informasi :</h4>

                        <table class="info-table">
                            <tr>
                                <td class="label">Nama Daerah</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalNama">-</td>
                            </tr>
                            <tr>
                                <td class="label">Jumlah Penduduk</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalPenduduk">-</td>
                            </tr>
                            <tr>
                                <td class="label">Jumlah Kasus</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalKasus">-</td>
                            </tr>
                            <tr>
                                <td class="label">Kategori Kasus</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalKategori">-</td>
                            </tr>

                            <tr>
                                <td class="label">Rentang usia</td>
                                <td class="colon">:</td>
                                <td class="value"></td>
                            </tr>
                            <tr class="sub">
                                <td class="label">Anak-anak</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalAnak">0</td>
                            </tr>
                            <tr class="sub">
                                <td class="label">Dewasa</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalDewasa">0</td>
                            </tr>
                            <tr class="sub">
                                <td class="label">Lansia</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalLansia">0</td>
                            </tr>

                            <tr>
                                <td class="label">Rentang usia dengan kasus tertinggi</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalUsiaTertinggi">-</td>
                            </tr>
                            <tr>
                                <td class="label">Desa dengan kasus tertinggi</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalDesaTertinggi">-</td>
                            </tr>

                            <tr>
                                <td class="label">Jenis kelamin terinfeksi</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalJkTotal">0</td>
                            </tr>
                            <tr class="sub">
                                <td class="label">Laki-laki</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalLaki">0</td>
                            </tr>
                            <tr class="sub">
                                <td class="label">Perempuan</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalPerempuan">0</td>
                            </tr>

                            <tr>
                                <td class="label">Rumah Diperiksa</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalRumahPeriksa">0</td>
                            </tr>
                            <tr>
                                <td class="label">Rumah Positive Jentik</td>
                                <td class="colon">:</td>
                                <td class="value" id="modalRumahJentik">0</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- =================== END MODAL =================== -->

            <script>
               
            /* 🔥 FIX NAMA */
            function fixNama(nama){
                return (nama || "")
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9]/g, "");
            }

            /* 🔥 ALIAS */
            var aliasDesa = {
    "kemuningsarilor": "kemuning sari lor",
    "tegalgede": "tegalgede",
    "tegalgedei": "tegalgede"
};
        
           var dataDBD = <?= json_encode(isset($dbd) ? $dbd : []) ?>;

var detailDesa = <?= json_encode(
    isset($detailDesa) ? $detailDesa : []
) ?>;

var desaTertinggi = <?= json_encode(
    isset($desaTertinggi) ? $desaTertinggi : '-'
) ?>;
            var tahunSekarang = <?= json_encode($tahunSekarang) ?>;

            var dataFinal = {};

            /* 🔥 OLAH DATA UNTUK WARNA PETA */
            dataDBD.forEach(item => {
                var desa = fixNama(item.desa);
                if(aliasDesa[desa]) desa = aliasDesa[desa];

                if(!dataFinal[desa]){
                    dataFinal[desa] = { total: 0, jumlah: 0 };
                }
                dataFinal[desa].total += parseInt(item.kasus);
                dataFinal[desa].jumlah++;
            });

            /* 🔥 KATEGORI */
            for(var key in dataFinal){
                var rata = dataFinal[key].total / dataFinal[key].jumlah;
                if(rata >= 20) dataFinal[key].kategori = "tinggi";
                else if(rata >= 10) dataFinal[key].kategori = "sedang";
                else dataFinal[key].kategori = "rendah";
            }

            document.addEventListener("DOMContentLoaded", function() {

                /* 🔥 INIT MAP */
                var map = L.map('map').setView([-8.1, 113.5], 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                /* 🔥 GEOJSON */
                fetch("<?= base_url('assets/peta/db.geojson') ?>")
                .then(res => res.json())
                .then(data => {

                    var geo = L.geoJSON(data, {

                        style: function(feature){
                            var nama = fixNama(feature.properties.NAMOBJ);
                            if(aliasDesa[nama]) nama = aliasDesa[nama];

                            var item = dataFinal[nama];
                            var warna = "#cccccc";

                            if(item){
                                if(item.kategori == "tinggi") warna = "#dc3545";
                                else if(item.kategori == "sedang") warna = "#ffc107";
                                else if(item.kategori == "rendah") warna = "#28a745";
                            }

                            return {
                                color: "#00CED1",
                                weight: 2,
                                fillColor: warna,
                                fillOpacity: 0.7
                            };
                        },

                        onEachFeature: function(feature, layer){
                            var namaAsli = feature.properties.NAMOBJ || "Kelurahan";
                            var namaFix  = fixNama(namaAsli);
                            if(aliasDesa[namaFix]) namaFix = aliasDesa[namaFix];

                            var item = dataFinal[namaFix];

                            var isi = "<div style='min-width:220px;'>";
                            isi += "<b>Kelurahan: " + namaAsli + "</b>";

                            if(item){
                                isi += "<br>Total Kasus: " + item.total;
                                isi += "<br>Kategori: " + item.kategori;

                                isi += `
                                    <br><br>
                                    <button
                                        onclick="showDetailPopup('${namaFix}','${namaAsli}')"
                                        style="
                                            background:#00CED1;
                                            color:white;
                                            border:none;
                                            padding:8px 14px;
                                            border-radius:8px;
                                            cursor:pointer;
                                            font-weight:600;
                                        ">
                                        Selengkapnya
                                    </button>
                                `;
                            } else {
                                isi += "<br><span style='color:red'>Data tidak ditemukan</span>";
                            }

                            isi += "</div>";
                            layer.bindPopup(isi);

                            layer.bindTooltip(namaAsli, {
                                permanent: true,
                                direction: "center",
                                className: "label-desa"
                            });

                            layer.on({
                                mouseover: function(e){
                                    e.target.setStyle({ weight: 3, color: '#000' });
                                },
                                mouseout: function(e){
                                    geo.resetStyle(e.target);
                                }
                            });
                        }

                    }).addTo(map);

                    map.fitBounds(geo.getBounds());
                });
            });

            /* 🔥 TAMPILKAN MODAL DETAIL — AMBIL DARI DATABASE */
            function showDetailPopup(namaFix, namaAsli){

                // ambil detail desa dari data yang sudah dipassing dari controller
        var d = detailDesa[namaFix] 
     || detailDesa[namaAsli.toLowerCase().replace(/\s/g,'')] 
     || {};

if(!d){
    // fallback cari manual
    for(let key in detailDesa){
        if(key.includes(namaFix) || namaFix.includes(key)){
            d = detailDesa[key];
            break;
        }
    }
}

d = d || {};

                // fallback nilai default kalau data kosong
                var kategori   = d.kategori   || '-';
                var kategoriCls = '';
                if(kategori.toLowerCase() === 'tinggi') kategoriCls = 'kategori-tinggi';
                else if(kategori.toLowerCase() === 'sedang') kategoriCls = 'kategori-sedang';
                else if(kategori.toLowerCase() === 'rendah') kategoriCls = 'kategori-rendah';

                document.getElementById("modalTahun").innerText        = tahunSekarang;
                document.getElementById("modalNama").innerText         = namaAsli;
                document.getElementById("modalPenduduk").innerText     = d.jumlah_penduduk ?? 0;
                document.getElementById("modalKasus").innerText        = d.jumlah_kasus    ?? 0;

                var elKat = document.getElementById("modalKategori");
                elKat.innerText = (kategori.charAt(0).toUpperCase() + kategori.slice(1));
                elKat.className = 'value ' + kategoriCls;

                document.getElementById("modalAnak").innerText         = d.anak    ?? 0;
                document.getElementById("modalDewasa").innerText       = d.dewasa  ?? 0;
                document.getElementById("modalLansia").innerText       = d.lansia  ?? 0;

                document.getElementById("modalUsiaTertinggi").innerText = d.usia_tertinggi || '-';
                document.getElementById("modalDesaTertinggi").innerText = desaTertinggi    || '-';

                var lk = parseInt(d.laki ?? 0);
                var pr = parseInt(d.perempuan ?? 0);
                var jkUnik = (lk > 0 ? 1 : 0) + (pr > 0 ? 1 : 0);

                document.getElementById("modalJkTotal").innerText      = jkUnik;
                document.getElementById("modalLaki").innerText         = lk;
                document.getElementById("modalPerempuan").innerText    = pr;

                document.getElementById("modalRumahPeriksa").innerText = d.rumah_diperiksa ?? 0;
                document.getElementById("modalRumahJentik").innerText  = d.rumah_positif ?? 0;

                document.getElementById("detailModal").style.display = "flex";
            }

            function closeDetailModal(){
                document.getElementById("detailModal").style.display = "none";
            }

            // klik di luar modal untuk menutup
            window.addEventListener('click', function(e){
                var modal = document.getElementById('detailModal');
                if(e.target === modal) closeDetailModal();
            });
            </script>
        </div>
    </div>

    <!-- 🔥 STYLE LABEL -->
    <style>
    .label-desa{
        background: rgba(0,0,0,0.6);
        color: white;
        border: none;
        padding: 2px 6px;
        font-size: 11px;
        border-radius: 6px;
    }
    </style>
</div>

<!-- GRAFIK -->
<section id="grafik" class="container mt-5" data-aos="fade-up">

    <h4 class="text-teal mb-3 fw-bold">Grafik DBD</h4>

    <form method="get">
        <div class="row mb-3">
            <div class="col-md-3">
                <select name="usia" class="form-control shadow-sm" onchange="this.form.submit()">
                    <option value="">Semua Usia</option>
                    <option value="anak"    <?= request()->getGet('usia')=='anak'    ? 'selected' : '' ?>>0-14</option>
                    <option value="remaja"  <?= request()->getGet('usia')=='remaja'  ? 'selected' : '' ?>>15-24</option>
                    <option value="dewasa"  <?= request()->getGet('usia')=='dewasa'  ? 'selected' : '' ?>>25-59</option>
                    <option value="lansia"  <?= request()->getGet('usia')=='lansia'  ? 'selected' : '' ?>>60+</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="jk" class="form-control shadow-sm" onchange="this.form.submit()">
                    <option value="">Semua Gender</option>
                    <option value="L" <?= request()->getGet('jk')=='L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= request()->getGet('jk')=='P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="bulan" class="form-control shadow-sm" onchange="this.form.submit()">
                    <option value="">Semua Bulan</option>
                    <?php
                    $bulanList = [
                        1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',
                        5=>'Mei',6=>'Jun',7=>'Jul',8=>'Ags',
                        9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
                    ];
                    foreach($bulanList as $key => $val): ?>
                        <option value="<?= $key ?>" <?= request()->getGet('bulan') == $key ? 'selected' : '' ?>>
                            <?= $val ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <select name="tahun" class="form-control shadow-sm" onchange="this.form.submit()">
                    <option value="">Semua Tahun</option>
                    <?php for($t = 2020; $t <= date('Y'); $t++): ?>
                        <option value="<?= $t ?>" <?= request()->getGet('tahun') == $t ? 'selected' : '' ?>>
                            <?= $t ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-9">
            <div class="p-3 shadow-sm bg-white" style="border-radius:15px;">
                <canvas id="chartDBD"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function(){
        const dataGrafik = <?= json_encode($grafik) ?>;

        let labels = [];
        let totalKasus = [];

        dataGrafik.forEach(function(item){
    labels.push(item.desa);
    totalKasus.push(item.kasus);
});

        new Chart(document.getElementById('chartDBD'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Kasus',
                    data: totalKasus,
                    backgroundColor: '#00BBC2'
                }]
            }
        });
    });
    </script>
</section>

<!-- ARTIKEL -->
<section id="artikel" class="artikel-section my-5">
    <div class="artikel-header">
        <h2 class="section-title">Berita, Artikel & Majalah Kesehatan</h2>
    </div>

    <div id="artikel-scroll" class="artikel-scroll">
        <?php if (!empty($artikels)): ?>
            <?php foreach ($artikels as $artikel): ?>
                <div class="card-artikel">
                    <img src="<?= base_url('img/artikel/' . (string)$artikel['gambar']) ?>" class="artikel-img" alt="<?= esc((string)$artikel['judul']) ?>" />

                    <div class="artikel-action">
                        <a href="<?= base_url('admin/artikel/edit/' . $artikel['id']) ?>">
                            <img src="<?= base_url('img/edit.png') ?>">
                        </a>
                        <form action="<?= base_url('admin/artikel/delete/' . $artikel['id']) ?>" method="post">
                            <button type="submit">
                                <img src="<?= base_url('img/hapus.png') ?>">
                            </button>
                        </form>
                    </div>

                    <div class="artikel-content">
                        <small><?= date('l, d M Y', strtotime($artikel['tanggal_terbit'])) ?></small>
                        <h5><?= esc((string)$artikel['judul']) ?></h5>
                        <?php $preview = character_limiter(strip_tags($artikel['isi']), 150, '...'); ?>
                        <p><?= $preview ?></p>
                        <a href="<?= base_url('admin/artikel/' . $artikel['slug']) ?>" class="custom-link">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-muted">Belum ada artikel yang ditambahkan.</div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>