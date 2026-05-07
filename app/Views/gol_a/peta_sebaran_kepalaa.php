<?= $this->extend('layout/dashboard_layout_kepala') ?>
<?= $this->section('content') ?>

<div class="section-card">

    <div class="section-block">
        <h5>Peta Interaktif Penyebaran</h5>
        <div id="map" style="height:400px;"></div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

    function fixNama(nama){
        return (nama || "").toLowerCase().trim().replace(/\s+/g, " ");
    }

    var map = L.map('map').setView([-8.1,113.5], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
    .addTo(map);

    fetch("<?= base_url('assets/peta/db.geojson') ?>")
    .then(res => res.json())
    .then(data => {

        L.geoJSON(data, {

            onEachFeature: function(feature, layer){

                var nama = feature.properties.NAMOBJ;

                layer.bindPopup("<b>"+nama+"</b><br><a href='<?= base_url('detail_peta') ?>?desa="+nama+"'>Lihat Detail</a>");

            }

        }).addTo(map);

    });

});
</script>

<?= $this->endSection() ?>