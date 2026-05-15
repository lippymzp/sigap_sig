<?php
$embed = isset($_GET['embed']);
?>

<?php if(!$embed): ?>


<?php endif; ?>

<?php
$conn = mysqli_connect("localhost","root","","sigap_db");
?>


<title>Grafik Pneumonia</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    background:#dcdcdc;
    font-family:Poppins, sans-serif;
}

/* NAVBAR */
.navbar-custom{
    background:white;
    padding:18px 30px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.logo-title{
    display:flex;
    align-items:center;
    gap:15px;
}

.logo-title h2{
    color:#12bec8;
    font-weight:700;
    margin:0;
}

.login-btn{
    background:#12bec8;
    color:white;
    padding:10px 24px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
}

/* CARD */
.card-box{
    background:#eef4f4;
    border-radius:25px;
    padding:30px;
    margin-top:40px;
    margin-bottom:40px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* TITLE */
.card-header-custom{
    font-size:38px;
    font-weight:700;
    margin-bottom:25px;
}

/* FILTER */
.filter-wrapper{
    display:flex;
    gap:18px;
    flex-wrap:wrap;
    margin-bottom:30px;
}


/* DROPDOWN */
.dropdown-btn{

    width:180px;

    background:#14b8c4;
    color:white;

    border:none;
    border-radius:8px;

    padding:10px 15px;

    font-size:14px;
    font-weight:500;

    outline:none;
    cursor:pointer;

    box-shadow:0 4px 10px rgba(0,0,0,0.25);

    transition:0.3s;
}
/* OPTION */
.dropdown-btn option{

    background:#f3f3f3;
    color:#666;

    padding:10px;
}

/* OPTION SELECTED */
.dropdown-btn option:checked{
    background:#14b8c4;
    color:white;
}

/* CHART */
.chart-wrapper{
    position:relative;
    width:100%;
    height:620px;
}


</style>


<!-- NAVBAR -->
<?php if(!$embed): ?>

<!-- NAVBAR -->
<div class="navbar-custom">

    <div class="logo-title">

        <img src="<?= base_url('img/logo_sigap.png') ?>" width="60">

        <h2>Grafik Pneumonia</h2>

    </div>

    <a href="<?= base_url('login') ?>" class="login-btn">
        Login
    </a>

</div>
<?php endif; ?>

<?php

$query = mysqli_query($conn, "

    SELECT

        MONTH(tgl_kunjungan) as bulan,
        YEAR(tgl_kunjungan) as tahun,
        jenis_kelamin,
        COUNT(*) as jumlah

    FROM pasien

    GROUP BY
        MONTH(tgl_kunjungan),
        YEAR(tgl_kunjungan),
        jenis_kelamin

");

$data = [];

while($row = mysqli_fetch_assoc($query)){

    $data[] = $row;

}

/* ===========================
   DATA GRAFIK WILAYAH
=========================== */

$queryWilayah = mysqli_query($conn, "

SELECT

    wilayah.kelurahan as nama_wilayah,
    pasien.jenis_kelamin,
    pasien.umur,
    MONTH(pasien.tgl_kunjungan) as bulan,
    YEAR(pasien.tgl_kunjungan) as tahun,
    COUNT(*) as jumlah

FROM pasien

JOIN wilayah
ON pasien.id_wilayah = wilayah.id_wilayah

GROUP BY
    wilayah.kelurahan,
    pasien.jenis_kelamin,
    pasien.umur,
    MONTH(pasien.tgl_kunjungan),
    YEAR(pasien.tgl_kunjungan)

");
$dataWilayah = [];

while($row = mysqli_fetch_assoc($queryWilayah)){

    $dataWilayah[] = $row;

}

?>

<div class="container">

    <!-- CARD 1 -->
    <div class="card-box">

        <div class="card-header-custom">
            Kasus Umum
        </div>

        <div class="filter-wrapper">

            <select id="filterGender" class="dropdown-btn">

                <option value="All">Semua Gender</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>

            </select>

            <select id="filterBulan" class="dropdown-btn">

                <option value="All">Semua Bulan</option>

                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>

            </select>

            <select id="filterTahun" class="dropdown-btn">

                <option value="All">Semua Tahun</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>

            </select>

        </div>

        <div class="chart-wrapper">
            <canvas id="chart1"></canvas>
        </div>

    </div>

    <!-- CARD 2 -->
    <div class="card-box">

        <div class="card-header-custom">
            Kasus Berdasarkan Wilayah dan kategori Umur
        </div>

        <div class="filter-wrapper">

            <select id="filterBulan2" class="dropdown-btn">

                <option value="All">All Bulan</option>

                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>

            </select>

            <select id="filterTahun2" class="dropdown-btn">

                <option value="All">All Tahun</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>

            </select>
            <select id="filterUmur2" class="dropdown-btn">

    <option value="All">All Usia</option>

    <option value="Bayi">< 1 tahun</option>

    <option value="Balita">1 - 4 tahun</option>

    <option value="Anak">5 - 9 tahun</option>

    <option value="Remaja">10 - 18 tahun</option>

    <option value="Dewasa">19 - 59 tahun</option>

    <option value="Lansia">≥ 60 tahun</option>

    <option value="Semua">Semua usia</option>

    <option value="All">All Usia</option>

</select>

            <select id="filterGender2" class="dropdown-btn">

                <option value="All">All Gender</option>

                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>

            </select>

        </div>

        <div class="chart-wrapper">
            <canvas id="chart2"></canvas>
        </div>

    </div>

</div>

<script>

const pasienData = <?= json_encode($data); ?>;
const wilayahData = <?= json_encode($dataWilayah); ?>;

/* ===========================
   CHART 1
=========================== */

const filterGender = document.getElementById('filterGender');
const filterBulan = document.getElementById('filterBulan');
const filterTahun = document.getElementById('filterTahun');

const chart1 = new Chart(document.getElementById('chart1'), {

    type:'bar',

    data:{
        labels:[
            'Jan','Feb','Mar','Apr',
            'Mei','Jun','Jul','Ags',
            'Sep','Okt','Nov','Des'
        ],

        datasets:[

            {
                label:'Laki-laki',
                data:[0,0,0,0,0,0,0,0,0,0,0,0],
                backgroundColor:'#166d75',
                borderRadius:6
            },

            {
                label:'Perempuan',
                data:[0,0,0,0,0,0,0,0,0,0,0,0],
                backgroundColor:'#abd6d6',
                borderRadius:6
            }

        ]
    }

});

function updateChart1(){

    let laki = Array(12).fill(0);
    let perempuan = Array(12).fill(0);

    pasienData.forEach(item => {

        let cocokGender =
            filterGender.value == 'All'
            || item.jenis_kelamin == filterGender.value;

        let cocokBulan =
            filterBulan.value == 'All'
            || item.bulan == filterBulan.value;

        let cocokTahun =
            filterTahun.value == 'All'
            || item.tahun == filterTahun.value;

        if(cocokGender && cocokBulan && cocokTahun){

            let index = item.bulan - 1;

            if(item.jenis_kelamin == 'Laki-laki'){

                laki[index] += parseInt(item.jumlah);

            }else{

                perempuan[index] += parseInt(item.jumlah);

            }

        }

    });

    chart1.data.datasets[0].data = laki;
    chart1.data.datasets[1].data = perempuan;

    chart1.update();

}

filterGender.addEventListener('change', updateChart1);
filterBulan.addEventListener('change', updateChart1);
filterTahun.addEventListener('change', updateChart1);

updateChart1();

/* ===========================
   CHART 2
=========================== */

const filterBulan2 = document.getElementById('filterBulan2');
const filterTahun2 = document.getElementById('filterTahun2');
const filterUmur2 = document.getElementById('filterUmur2');
const filterGender2 = document.getElementById('filterGender2');

const wilayahLabels = [
    'Ajung',
    'Wirowongso',
    'Rowo Indah',
    'Suka Makmur',
    'Klompangan',
    'Pancakarya',
    'Manggaran',
    'Pasien Luar Wilayah',
];

const chart2 = new Chart(document.getElementById('chart2'), {

    type:'bar',

    data:{
        labels:wilayahLabels,

        datasets:[

            {
                label:'Laki-laki',
                data:[0,0,0,0,0],
                backgroundColor:'#166d75',
                borderRadius:8
            },

            {
                label:'Perempuan',
                data:[0,0,0,0,0],
                backgroundColor:'#8be0d1',
                borderRadius:8
            }

        ]
    },

    options:{

        indexAxis:'y',

        responsive:true,
        maintainAspectRatio:false

    }

});

function kategoriUmur(umur){

    umur = parseInt(umur);

    if(umur < 1){
        return 'Bayi';
    }

    if(umur >= 1 && umur <= 4){
        return 'Balita';
    }

    if(umur >= 5 && umur <= 9){
        return 'Anak';
    }

    if(umur >= 10 && umur <= 18){
        return 'Remaja';
    }

    if(umur >= 19 && umur <= 59){
        return 'Dewasa';
    }

    return 'Lansia';

}

function updateChart2(){

    let laki = Array(wilayahLabels.length).fill(0);
    let perempuan = Array(wilayahLabels.length).fill(0);

    wilayahData.forEach(item => {

        let cocokBulan =
            filterBulan2.value == 'All'
            || item.bulan == filterBulan2.value;

        let cocokTahun =
            filterTahun2.value == 'All'
            || item.tahun == filterTahun2.value;

        let cocokGender =
            filterGender2.value == 'All'
            || item.jenis_kelamin == filterGender2.value;

        let cocokUmur =
            filterUmur2.value == 'All'
            || kategoriUmur(item.umur) == filterUmur2.value;

        if(
            cocokBulan &&
            cocokTahun &&
            cocokGender &&
            cocokUmur
        ){

            let index = wilayahLabels.indexOf(item.nama_wilayah);

            if(index !== -1){

                if(item.jenis_kelamin == 'Laki-laki'){

                    laki[index] += parseInt(item.jumlah);

                }else{

                    perempuan[index] += parseInt(item.jumlah);

                }

            }

        }

    });

    chart2.data.datasets[0].data = laki;
    chart2.data.datasets[1].data = perempuan;

    chart2.update();

}

filterBulan2.addEventListener('change', updateChart2);
filterTahun2.addEventListener('change', updateChart2);
filterUmur2.addEventListener('change', updateChart2);
filterGender2.addEventListener('change', updateChart2);

updateChart2();

</script>
<?php if(!$embed): ?>

<?php endif; ?>
