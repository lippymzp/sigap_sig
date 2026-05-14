
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Grafik Pneumonia</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    background: #dcdcdc;
    font-family: Poppins, sans-serif;
}

/* NAVBAR */
.navbar-custom{
    background: white;
    padding: 20px 30px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.logo-title{
    display: flex;
    align-items: center;
    gap: 15px;
}

.logo-title h2{
    color: #11c5cf;
    font-weight: 700;
}

.login-btn{
    background: #11c5cf;
    color: white;

    border: none;
    border-radius: 12px;

    padding: 10px 25px;
}

/* CARD */
.card-box{
    background: #eef4f4;

    border-radius: 25px;

    padding: 25px;

    margin-top: 40px;

    box-shadow: 0 5px 10px rgba(0,0,0,0.15);
}

.card-header-custom{
    font-size: 35px;
    font-weight: 700;

    margin-bottom: 30px;
}

/* FILTER */

.filter-wrapper{
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

/* DROPDOWN */
.dropdown-custom{
    position: relative;
    z-index: 1000;
}

/* BUTTON */
.dropdown-btn{
    width: 200px;

    background: #15c7cf;
    color: white;

    border: none;
    border-radius: 12px;

    padding: 12px 18px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    font-size: 14px;
    font-weight: 500;

    cursor: pointer;

    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* MENU */
.dropdown-menu-custom{
    position: absolute;
    top: 60px;
    left: 0;

    width: 220px;

    background: white;

    border-radius: 18px;

    padding: 15px 0;

    box-shadow: 0 5px 15px rgba(0,0,0,0.2);

    display: none;

    z-index: 9999;
}

/* ITEM */
.dropdown-menu-custom div{
    padding: 10px 20px;

    color: #666;

    cursor: pointer;

    transition: 0.2s;
}

.dropdown-menu-custom div:hover{
    background: #eefefe;
    color: #11c5cf;
}

/* SHOW */
.dropdown-custom.active .dropdown-menu-custom{
    display: block;
}

canvas{
    width: 100% !important;
    height: 500px !important;
}

.chart-wrapper{
    position: relative;
    z-index: 1;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar-custom">

    <div class="logo-title">
    <a href="<?= base_url('/') ?>" class="brand-wrapper">

        <img src="<?= base_url('img/logo_sigap.png') ?>" 
             alt="SIGAP"
             class="brand-logo"
             width="60">

    </a>

        <h2>
            Grafik Pneumonia
        </h2>

    </div>

    <a href="<?= base_url('login') ?>" class="login-btn text-decoration-none"
        width="60">
    Login
    </a>


</div>

<div class="container">

    <!-- CARD 1 -->
    <div class="card-box">

        <div class="card-header-custom">
            Kasus Umum
        </div>

    <!-- FILTER -->
    <div class="filter-wrapper">

        <!-- WILAYAH -->
        <div class="dropdown-custom">

            <button class="dropdown-btn">
                Semua Wilayah
                <span>›</span>
            </button>

            <div class="dropdown-menu-custom">

                <div>Ajung</div>
                <div>Wirowongso</div>
                <div>Rowo indah</div>
                <div>Sukamakmur</div>
                <div>Klompangan</div>
                <div>Mangaran</div>
                <div>Pancakarya</div>
                <div>Pasien Luar Wilayah</div>
                <div>All</div>

            </div>

        </div>

        <!-- BULAN -->
        <div class="dropdown-custom">

            <button class="dropdown-btn">
                Bulan
                <span>›</span>
            </button>

            <div class="dropdown-menu-custom">

               <div>Januari</div>
                <div>Februari</div>
                <div>Maret</div>
                <div>April</div>
                <div>Mei</div>
                <div>Juni</div>
                <div>Juli</div>
                <div>Agustus</div>
                <div>September</div>
                <div>Oktober</div>
                <div>November</div>
                <div>Desember</div>
                <div>All</div>

            </div>

        </div>

        <!-- TAHUN -->
        <div class="dropdown-custom">

            <button class="dropdown-btn">
                Tahun
                <span>›</span>
            </button>

            <div class="dropdown-menu-custom">

                <div>2023</div>
                <div>2024</div>
                <div>2025</div>
                <div>All</div>

            </div>

        </div>

    </div>

    <!-- CHART -->
    <div class="chart-wrapper">
        <canvas id="chart1"></canvas>
    </div>

</div>

<!-- CARD 2 -->
<div class="card-box">

    <div class="card-header-custom">
        Kasus Berdasarkan Wilayah dan Status Pengobatan
    </div>

    <!-- CHART -->
    <div class="chart-wrapper">
        <canvas id="chart2"></canvas>
    </div>

</div>

</div>

<script>

/* =========================
   DROPDOWN
========================= */

const dropdowns = document.querySelectorAll(".dropdown-custom");

dropdowns.forEach(dropdown => {

    const btn = dropdown.querySelector(".dropdown-btn");

    btn.addEventListener("click", () => {

        document.querySelectorAll(".dropdown-custom")
        .forEach(d => {

            if(d !== dropdown){
                d.classList.remove("active");
            }

        });

        dropdown.classList.toggle("active");

    });

});

/* TUTUP DROPDOWN */
document.addEventListener("click", (e) => {

    if(!e.target.closest(".dropdown-custom")){
        dropdowns.forEach(d => d.classList.remove("active"));
    }

});


/* =========================
   DATA DUMMY
========================= */

const dummyData = {

    all: {
        laki: [270,140,60,100,90,75,65,90,100,120,150,90],
        wanita: [240,120,80,60,75,45,40,85,160,120,120,60]
    },

    ajung: {
        laki: [30,20,10,15,12,10,8,14,18,20,25,15],
        wanita: [25,18,12,10,10,8,6,12,16,15,14,10]
    },

    klompangan: {
        laki: [40,25,15,20,18,15,12,20,24,28,30,22],
        wanita: [30,20,14,15,12,10,8,16,20,22,24,18]
    },

    mangaran: {
        laki: [20,15,8,12,10,9,7,10,14,16,18,11],
        wanita: [18,12,10,9,8,7,5,8,12,13,12,9]
    },

    pancakarya: {
        laki: [25,18,9,14,13,11,10,15,19,22,24,16],
        wanita: [20,16,11,10,10,8,7,11,15,18,17,12]
    },

    usia_anak: {
        laki: [80,70,60,50,45,40,38,42,50,55,60,58],
        wanita: [70,60,55,45,40,35,32,38,45,50,52,50]
    },

    usia_dewasa: {
        laki: [120,110,100,90,88,82,80,84,95,100,110,108],
        wanita: [100,95,90,80,78,70,68,72,80,90,95,92]
    },

    januari: {
        laki: [40],
        wanita: [35]
    },

    februari: {
        laki: [35],
        wanita: [30]
    }

};


/* =========================
   CHART 1
========================= */

const ctx = document.getElementById('chart1');

const chart1 = new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Jan','Feb','Mar','Apr',
            'Mei','Jun','Jul','Ags',
            'Sep','Okt','Nov','Des'
        ],

        datasets: [

            {
                label: 'Laki-laki',
                data: dummyData.all.laki,
                backgroundColor: '#166d70'
            },

            {
                label: 'Wanita',
                data: dummyData.all.wanita,
                backgroundColor: '#a9d4d3'
            }

        ]

    },

    options: {
        responsive: true,
        maintainAspectRatio: false
    }

});


/* =========================
   FILTER WILAYAH
========================= */

const wilayahItems = document.querySelectorAll(
    ".dropdown-custom:first-child .dropdown-menu-custom div"
);

wilayahItems.forEach(item => {

    item.addEventListener("click", () => {

        /* UBAH NAMA BUTTON */
        document.querySelector(
            ".dropdown-custom:first-child .dropdown-btn"
        ).innerHTML = `
            ${item.innerText}
            <span>›</span>
        `;

        const text = item.innerText.toLowerCase();

        let key = "all";

        if(text.includes("ajung")){
            key = "ajung";
        }

        else if(text.includes("klompangan")){
            key = "klompangan";
        }

        else if(text.includes("mangaran")){
            key = "mangaran";
        }

        else if(text.includes("pancakarya")){
            key = "pancakarya";
        }

        chart1.data.datasets[0].data =
        dummyData[key].laki;

        chart1.data.datasets[1].data =
        dummyData[key].wanita;

        chart1.update();

        /* TUTUP DROPDOWN */
        document.querySelector(
            ".dropdown-custom:first-child"
        ).classList.remove("active");

    });
    /* =========================
   FILTER USIA
========================= */

const usiaItems = document.querySelectorAll(
    ".dropdown-custom:nth-child(2) .dropdown-menu-custom div"
);

usiaItems.forEach(item => {

    item.addEventListener("click", () => {

        document.querySelector(
            ".dropdown-custom:nth-child(2) .dropdown-btn"
        ).innerHTML = `
            ${item.innerText}
            <span>›</span>
        `;

        let key = "all";

        const text = item.innerText.toLowerCase();

        if(text.includes("1 - 4")){
            key = "usia_anak";
        }

        else if(text.includes("19 - 59")){
            key = "usia_dewasa";
        }

        chart1.data.datasets[0].data =
        dummyData[key].laki;

        chart1.data.datasets[1].data =
        dummyData[key].wanita;

        chart1.update();

        document.querySelector(
            ".dropdown-custom:nth-child(2)"
        ).classList.remove("active");

    });

});


/* =========================
   FILTER BULAN
========================= */

const bulanItems = document.querySelectorAll(
    ".dropdown-custom:nth-child(3) .dropdown-menu-custom div"
);

bulanItems.forEach(item => {

    item.addEventListener("click", () => {

        document.querySelector(
            ".dropdown-custom:nth-child(3) .dropdown-btn"
        ).innerHTML = `
            ${item.innerText}
            <span>›</span>
        `;

        const text = item.innerText.toLowerCase();

        if(dummyData[text]){

            chart1.data.labels = [item.innerText];

            chart1.data.datasets[0].data =
            dummyData[text].laki;

            chart1.data.datasets[1].data =
            dummyData[text].wanita;

        } else {

            chart1.data.labels = [
                'Jan','Feb','Mar','Apr',
                'Mei','Jun','Jul','Ags',
                'Sep','Okt','Nov','Des'
            ];

            chart1.data.datasets[0].data =
            dummyData.all.laki;

            chart1.data.datasets[1].data =
            dummyData.all.wanita;

        }

        chart1.update();

        document.querySelector(
            ".dropdown-custom:nth-child(3)"
        ).classList.remove("active");

    });

});

});


/* =========================
   CHART 2
========================= */

new Chart(document.getElementById('chart2'), {

    type: 'bar',

    data: {

        labels: [
            'Pasien Luar Wilayah',
            'Mangaran',
            'Pancakarya',
            'Klompangan',
            'Sukamakmur',
            'Rowo Indah',
            'Wirowongso',
            'Ajung'
        ],

        datasets: [

            {
                label: 'Laki-laki',
                data: [4,16,29,14,12,4,13,19],
                backgroundColor: '#166d70'
            },

            {
                label: 'Perempuan',
                data: [3,12,11,11,12,7,16,20],
                backgroundColor: '#8be0d1'
            }

        ]

    },

    options:{
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false
    }

});

</script>

</body>
</html>

















<!-- INI YG DARI LANDING -->
<script>

<?php

$conn = mysqli_connect("localhost","root","","sigap_db");

$dataPneumonia = [];

$query = mysqli_query($conn,"SELECT * FROM pasien");

while($row = mysqli_fetch_assoc($query)){

    $tahun   = $row['tahun'];
    $wilayah = $row['wilayah'];
    $bulan   = $row['bulan'];

    if(!isset($dataPneumonia[$tahun])){
        $dataPneumonia[$tahun] = [];
    }

    if(!isset($dataPneumonia[$tahun][$wilayah])){
        $dataPneumonia[$tahun][$wilayah] = [];
    }

    if(!isset($dataPneumonia[$tahun][$wilayah][$bulan])){
        $dataPneumonia[$tahun][$wilayah][$bulan] = [
            'laki' => 0,
            'wanita' => 0
        ];
    }

    if($row['jenis_kelamin'] == 'Laki-laki'){
        $dataPneumonia[$tahun][$wilayah][$bulan]['laki']
        = $row['jumlah_kasus'];
    }

    if($row['jenis_kelamin'] == 'Wanita'){
        $dataPneumonia[$tahun][$wilayah][$bulan]['wanita']
        = $row['jumlah_kasus'];
    }
}

?>

const dataPneumonia = <?= json_encode($dataPneumonia); ?>;

/* FILTER */
const wilayah = document.getElementById('filterWilayah');
const bulan   = document.getElementById('filterBulan');
const tahun   = document.getElementById('filterTahun');

/* LIST BULAN */
const bulanList = [
    'Januari','Februari','Maret','April',
    'Mei','Juni','Juli','Agustus',
    'September','Oktober','November','Desember'
];

/* CHART */
const chart = new Chart(document.getElementById('chartKasus'), {

    type: 'bar',

    data: {
        labels: [],
        datasets: [
            {
                label: 'Laki-laki',
                data: [],
                backgroundColor:'#16a085'
            },
            {
                label: 'Wanita',
                data: [],
                backgroundColor:'#a8d5d5'
            }
        ]
    },

    options: {
        responsive:true,
        maintainAspectRatio:false,
        scales:{
            y:{
                beginAtZero:true
            }
        }
    }

});

/* UPDATE CHART */
function updateChart(){

    let labels = [];
    let laki = [];
    let wanita = [];

    if(bulan.value === 'All'){

        labels = bulanList;

        bulanList.forEach(b => {

            let data = dataPneumonia[tahun.value]?.[wilayah.value]?.[b];

            laki.push(data ? data.laki : 0);
            wanita.push(data ? data.wanita : 0);

        });

    } else {

        let data = dataPneumonia[tahun.value]?.[wilayah.value]?.[bulan.value];

        labels = [bulan.value];

        laki = [data ? data.laki : 0];
        wanita = [data ? data.wanita : 0];

    }

    chart.data.labels = labels;
    chart.data.datasets[0].data = laki;
    chart.data.datasets[1].data = wanita;

    chart.update();

}

wilayah.addEventListener('change', updateChart);
bulan.addEventListener('change', updateChart);
tahun.addEventListener('change', updateChart);

updateChart();

</script>