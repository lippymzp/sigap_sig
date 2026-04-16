document.addEventListener("DOMContentLoaded", function(){

/* ======================
   DATA DARI PHP
====================== */
var dataMap = window.dataMap || {};

/* ======================
   FUNCTION WARNA
====================== */
function getColorByKategori(kategori){

    if(kategori == "tinggi") return "#dc3545";   // merah
    if(kategori == "sedang") return "#ffc107";   // kuning
    if(kategori == "rendah") return "#28a745";   // hijau

    return "#20c997"; // default
}

/* ======================
   INIT MAP
====================== */
var map = L.map('mapDiare').setView([-8.1,113.5], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

/* ======================
   LOAD GEOJSON
====================== */
fetch(BASE_URL + "assets/peta/panti_6_desa.geojson")
.then(res => res.json())
.then(data => {

    var geo = L.geoJSON(data, {

        style: function(feature){

            var nama = (feature.properties.NAMOBJ || "").trim().toLowerCase();
            var item = dataMap[nama];

            return {
                color:"#ffffff",
                weight:2,
                fillColor: getColorByKategori(item ? item.kategori : null),
                fillOpacity:0.7
            };
        },

        onEachFeature: function(feature, layer){

            var nama = (feature.properties.NAMOBJ || "").trim();
            var item = dataMap[nama.toLowerCase()];

            var isi = "<b>Desa: " + nama + "</b>";

            if(item){
                isi += "<br>Kasus: " + item.kasus;
                isi += "<br>Kategori: " + item.kategori;
            }

            layer.bindPopup(isi);

            layer.on({
                mouseover:function(e){
                    e.target.setStyle({
                        weight:3,
                        fillOpacity:0.9
                    });
                },
                mouseout:function(e){
                    geo.resetStyle(e.target);
                }
            });

            layer.bindTooltip(nama, {
                permanent:true,
                direction:"center",
                className:"label-desa"
            });

        }

    }).addTo(map);

    map.fitBounds(geo.getBounds());

});

setTimeout(()=>map.invalidateSize(),300);

});