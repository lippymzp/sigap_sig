<?= $this->extend('layout/dashboard_layout_kepala') ?>

<?= $this->section('style') ?>
<style>
    /* Pastikan peta memiliki z-index yang benar agar popup berada di atas */
    #map { 
        height: 500px; 
        width: 100%; 
        border-radius: 12px;
        z-index: 1; /* Penting agar tidak tertutup elemen lain */
    }

    /* Memastikan popup Leaflet memiliki pointer-events */
    .leaflet-popup {
        z-index: 1000;
    }

    .section-card {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="section-card">
    <div class="section-block">
        <h5 class="fw-bold mb-3">Peta Interaktif Penyebaran</h5>
        <div class="inner-card">
            <div id="map"></div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
document.addEventListener("DOMContentLoaded", function(){

    function fixNama(nama){
        return (nama || "").toLowerCase().trim().replace(/\s+/g, " ");
    }

    // Inisialisasi Map
    var map = L.map('map').setView([-8.1, 113.5], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    fetch("<?= base_url('assets/peta/db.geojson') ?>")
    .then(res => res.json())
    .then(data => {
        L.geoJSON(data, {
            style: function(feature) {
                return {
                    fillColor: "#11b5b9",
                    weight: 1,
                    opacity: 1,
                    color: 'white',
                    fillOpacity: 0.6
                };
            },
            onEachFeature: function(feature, layer){
                var nama = feature.properties.NAMOBJ;
                
                // Gunakan template literal dan pastikan link valid
                var popupContent = `
                    <div style="min-width: 150px;">
                        <b style="font-size: 14px;">Kelurahan: ${nama}</b><br>
                        <hr style="margin: 5px 0;">
                        <a href="<?= base_url('detail_peta') ?>?desa=${encodeURIComponent(nama)}" 
                           style="color: #11b5b9; font-weight: bold; text-decoration: none;">
                           <i class="fa fa-search me-1"></i> Lihat Detail
                        </a>
                    </div>
                `;

                layer.bindPopup(popupContent, {
                    closeButton: true,
                    autoPan: true
                });

                // Efek hover agar user tahu area tersebut bisa diklik
                layer.on({
                    mouseover: function (e) {
                        var l = e.target;
                        l.setStyle({ fillOpacity: 0.8, weight: 2 });
                    },
                    mouseout: function (e) {
                        var l = e.target;
                        l.setStyle({ fillOpacity: 0.6, weight: 1 });
                    }
                });
            }
        }).addTo(map);
    })
    .catch(err => console.error("Gagal memuat GeoJSON:", err));
});
</script>
<?= $this->endSection() ?>