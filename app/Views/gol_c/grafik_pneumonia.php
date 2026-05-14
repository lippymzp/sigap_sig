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
    background:#dcdcdc;
    font-family:Poppins,sans-serif;
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
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* TITLE */
.card-header-custom{
    font-size:40px;
    font-weight:700;
    margin-bottom:25px;
}

/* FILTER */
.filter-wrapper{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
    margin-bottom:30px;
}

/* DROPDOWN */
.dropdown-btn{
    min-width:200px;
    padding:12px 18px;

    border:none;
    border-radius:12px;

    background:#19c2cf;
    color:white;

    font-size:15px;
    outline:none;

    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.dropdown-btn option{
    color:black;
}

/* CHART */
.chart-wrapper{
    position:relative;
    width:100%;
    height:420px;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar-custom">

    <div class="logo-title">

        <img src="<?= base_url('img/logo_sigap.png') ?>"
             width="60">

        <h2>Grafik Pneumonia</h2>

    </div>

    <a href="<?= base_url('login') ?>"
       class="login-btn">
        Login
    </a>

</div>

<?php

$conn = mysqli_connect("localhost","root","","sigap_db");

/*
|--------------------------------------------------------------------------
| AMBIL DATA PASIEN
|--------------------------------------------------------------------------
*/

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

?>

<div class="container">

    <!-- CARD -->
    <div class="card-box">

        <div class="card-header-custom">
            Kasus Umum
        </div>

        <!-- FILTER -->
        <div class="filter-wrapper">

            <!-- GENDER -->
            <select id="filterGender" class="dropdown-btn">

                <option value="All">Semua Gender</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>

            </select>

            <!-- BULAN -->
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

            <!-- TAHUN -->
            <select id="filterTahun" class="dropdown-btn">

                <option value="All">Semua Tahun</option>

                <?php

                $tahun = mysqli_query($conn,"
                    SELECT DISTINCT YEAR(tgl_kunjungan) as tahun
                    FROM pasien
                    ORDER BY tahun DESC
                ");

                while($t = mysqli_fetch_assoc($tahun)) :
                ?>

                    <option value="<?= $t['tahun']; ?>">
                        <?= $t['tahun']; ?>
                        <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
                    </option>

                <?php endwhile; ?>

            </select>

        </div>

        <!-- CHART -->
        <div class="chart-wrapper">
            <canvas id="chart1"></canvas>
        </div>

    </div>

</div>

<script>

const pasienData = <?= json_encode($data); ?>;

const bulanNama = {
    1:'Jan',
    2:'Feb',
    3:'Mar',
    4:'Apr',
    5:'Mei',
    6:'Jun',
    7:'Jul',
    8:'Ags',
    9:'Sep',
    10:'Okt',
    11:'Nov',
    12:'Des'
};

const filterGender = document.getElementById('filterGender');
const filterBulan = document.getElementById('filterBulan');
const filterTahun = document.getElementById('filterTahun');

const chart = new Chart(document.getElementById('chart1'), {

    type:'bar',

    data:{
        labels:[],
        datasets:[

            {
                label:'Laki-laki',
                data:[],
                backgroundColor:'#166d75',
                borderRadius:6
            },

            {
                label:'Perempuan',
                data:[],
                backgroundColor:'#abd6d6',
                borderRadius:6
            }

        ]
    },

    options:{

        responsive:true,
        maintainAspectRatio:false,

        plugins:{
            legend:{
                position:'top'
            }
        },

        scales:{
            y:{
                beginAtZero:true,
                ticks:{
                    stepSize:1
                }
            }
        }

    }

});

function updateChart(){

    let labels = [];
    let laki = [];
    let perempuan = [];

    let dataFilter = pasienData.filter(item => {

        let cocokGender =
            filterGender.value == 'All'
            || item.jenis_kelamin == filterGender.value;

        let cocokBulan =
            filterBulan.value == 'All'
            || item.bulan == filterBulan.value;

        let cocokTahun =
            filterTahun.value == 'All'
            || item.tahun == filterTahun.value;

        return cocokGender && cocokBulan && cocokTahun;

    });

    let bulanSudah = [];

    dataFilter.forEach(item => {

        if(!bulanSudah.includes(item.bulan)){

            bulanSudah.push(item.bulan);

            labels.push(bulanNama[item.bulan]);

            laki.push(0);
            perempuan.push(0);

        }

    });

    dataFilter.forEach(item => {

        let index = bulanSudah.indexOf(item.bulan);

        if(item.jenis_kelamin == 'Laki-laki'){

            laki[index] = item.jumlah;

        }else{

            perempuan[index] = item.jumlah;

        }

    });

    chart.data.labels = labels;
    chart.data.datasets[0].data = laki;
    chart.data.datasets[1].data = perempuan;

    chart.update();

}

filterGender.addEventListener('change', updateChart);
filterBulan.addEventListener('change', updateChart);
filterTahun.addEventListener('change', updateChart);

updateChart();

</script>

</body>
</html>