// ===========================
// MAP INIT
// ===========================

var map = L.map('map', {
    zoomControl:true
}).setView([-8.168, 113.702], 13);


// ===========================
// BASEMAP
// ===========================

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);



// ===========================
// WARNA TIAP KELURAHAN
// ===========================

function getColor(nama){

    switch(nama){

        case "Patrang": return "#6f2cff";
        case "Slawu": return "#ff2d8f";
        case "Gebang": return "#ff7f50";
        case "Baratan": return "#00b894";
        case "Bintoro": return "#f1c40f";
        case "Banjarsengon": return "#9b59b6";
        case "Jember Lor": return "#3498db";
        case "Jumerto": return "#e74c3c";

        default: return "#6f2cff";

    }

}



// ===========================
// LOAD GEOJSON KELURAHAN
// ===========================

fetch("data/kelurahan_patrang.geojson")

.then(res => res.json())

.then(data => {

    var kelurahan = L.geoJSON(data, {

        style:function(feature){

            return{

                color:"#ffffff",
                weight:2,

                fillColor:getColor(feature.properties.NAMOBJ),

                fillOpacity:0.6

            }

        },

        onEachFeature:function(feature, layer){

            layer.on({

                mouseover:function(e){

                    e.target.setStyle({
                        weight:3,
                        fillOpacity:0.9
                    });

                },

                mouseout:function(e){

                    kelurahan.resetStyle(e.target);

                }

            });


            layer.bindPopup(`

                <div style="
                    font-family:Segoe UI;
                    font-size:14px;
                    line-height:1.5;
                ">

                <b style="color:#6f2cff;font-size:15px">

                Kelurahan ${feature.properties.NAMOBJ}

                </b>

                <br>

                Kecamatan Patrang  
                Kabupaten Jember

                </div>

            `);

        }

    }).addTo(map);

    map.fitBounds(kelurahan.getBounds());

});



// ===========================
// DATA KASUS INFLUENZA
// ===========================

var kasusInfluenza = [

{
    id:1,
    nama:"Puskesmas Patrang",
    lat:-8.1538,
    lng:113.7071,
    kasus:25
},

{
    id:2,
    nama:"Kelurahan Slawu",
    lat:-8.1492,
    lng:113.6958,
    kasus:14
},

{
    id:3,
    nama:"Kelurahan Jember Lor",
    lat:-8.1587,
    lng:113.7185,
    kasus:18
}

];



// ===========================
// ICON MARKER
// ===========================

var iconKasus = L.icon({

    iconUrl:"https://cdn-icons-png.flaticon.com/512/2966/2966488.png",

    iconSize:[36,36],
    iconAnchor:[18,36],
    popupAnchor:[0,-30]

});



// ===========================
// MARKER KASUS
// ===========================

kasusInfluenza.forEach(data => {

    var marker = L.marker([data.lat, data.lng],{
        icon:iconKasus
    }).addTo(map);


    marker.bindPopup(`

    <div style="
        font-family:Segoe UI;
        width:200px;
    ">

    <h6 style="
        color:#ff2d8f;
        margin-bottom:6px;
        font-weight:600;
    ">

        ${data.nama}

    </h6>

    <div style="font-size:14px">

        <b>Kasus Influenza :</b><br>
        ${data.kasus} orang

    </div>

    <br>

    <a href="detail_kasus.php?id=${data.id}"
       class="btn btn-sm btn-primary"
       style="
       background:#6f2cff;
       border:none;
       width:100%;
       ">

       Lihat Detail

    </a>

    </div>

    `);

});



// ===========================
// LEGENDA
// ===========================

var legend = L.control({position:"bottomright"});

legend.onAdd = function(){

    var div = L.DomUtil.create("div","legend");

    div.innerHTML = `

    <h6 style="
        color:#6f2cff;
        font-weight:700;
        margin-bottom:8px;
    ">
    Peta Influenza
    </h6>

    <div style="margin-bottom:5px">
        <span style="
            background:#6f2cff;
            width:18px;
            height:18px;
            display:inline-block;
            margin-right:6px;
            border-radius:4px;
        ">
        </span>

        Wilayah Kelurahan Patrang
    </div>

    <div>
        📍 Lokasi Kasus Influenza
    </div>

    `;

    return div;

};

legend.addTo(map);

// js lidna
document.addEventListener("DOMContentLoaded", function () {
    const scrollContainer = document.getElementById('artikel-scroll');

    if (!scrollContainer) return;

    const scrollAmount = 320;

    setInterval(() => {
        let maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;

        if (scrollContainer.scrollLeft >= maxScrollLeft) {
            scrollContainer.scrollTo({
                left: 0,
                behavior: 'smooth'
            });
        } else {
            scrollContainer.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }
    }, 9000);
});

document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('chartTbc');

    if (!ctx) {
        console.log("Canvas tidak ditemukan");
        return;
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Jember Kidul',
                'Kaliwates',
                'Kebon Agung',
                'Kepatihan',
                'Mangli',
                'Sempusari',
                'Tegal Besar'
            ],
            datasets: [
                {
                    label: 'Dewasa',
                    data: [65, 30, 40, 20, 15, 10, 70],
                    backgroundColor: '#3b82f6'
                },
                {
                    label: 'Anak-anak',
                    data: [90, 70, 75, 85, 25, 20, 95],
                    backgroundColor: '#5eead4'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

});