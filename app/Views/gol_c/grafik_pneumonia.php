<?php
$embed = isset($_GET['embed']);
?>

<?php if(!$embed): ?>
<?php $this->setVar('penyakit', 'pneumonia'); 
$this->setVar('custom_logo', 'pulmora.png');
$this->setVar('show_footer_maskot', true);
$this->setVar('footer_maskot', 'cynex.png');?>
<?= $this->include('layout/header') ?>
<?php endif; ?>


<?php
$db = \Config\Database::connect();
?>


<title>Grafik Pneumonia</title>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>

body{
    background:#f5f7fa;
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

/* CARD */
.card-box{
    background:white;
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
    height:400px; 
}

.button-wrapper{
    display:flex;
    justify-content:flex-end;

    margin-top:20px;
    margin-right:300px;
}

.btn-kembali{
    display:inline-block;
    padding:12px 28px;

    background:#14b8c4;
    color:white;

    text-decoration:none;
    font-weight:600;
    font-size:16px;

    border-radius:10px;

    transition:0.3s ease;
}

.btn-kembali:hover{
    background:#0f9aa5;
    color:white;

    transform:translateY(-2px);
}

</style>


<!-- NAVBAR -->


<?php

$query = $db->query("

    SELECT

        MONTH(tgl_kunjungan) as bulan,
        YEAR(tgl_kunjungan) as tahun,
        jenis_kelamin,
        COUNT(*) as jumlah

    FROM pasien

    WHERE id_penyakit = 3

    GROUP BY
        MONTH(tgl_kunjungan),
        YEAR(tgl_kunjungan),
        jenis_kelamin

");

$result = $query->getResultArray();

$data = [];

foreach($result as $row){

    $data[] = $row;

}

/* ===========================
   DATA GRAFIK WILAYAH
=========================== */

$queryWilayah = $db->query("

SELECT

    wilayah.kelurahan as nama_wilayah,
    pasien.jenis_kelamin,
    pasien.rentang_umur,
    MONTH(pasien.tgl_kunjungan) as bulan,
    YEAR(pasien.tgl_kunjungan) as tahun,
    COUNT(*) as jumlah

FROM pasien

JOIN wilayah
ON pasien.id_wilayah = wilayah.id_wilayah

WHERE pasien.id_penyakit = 3

GROUP BY
    wilayah.kelurahan,
    pasien.jenis_kelamin,
    pasien.rentang_umur,
    MONTH(pasien.tgl_kunjungan),
    YEAR(pasien.tgl_kunjungan)

");

$dataWilayah = $queryWilayah->getResultArray();

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
                <option value="2026">2026</option>

            </select>

        </div>

        <div class="chart-wrapper">
            <canvas id="chart1"></canvas>
        </div>

    </div>

    <!-- CARD 2 -->
    <div class="card-box">

        <div class="card-header-custom">
            Kasus Berdasarkan Wilayah dan Kategori Umur
        </div>

        <div class="filter-wrapper">

            <select id="filterBulan2" class="dropdown-btn">

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

            <select id="filterTahun2" class="dropdown-btn">

                <option value="All">Semua Tahun</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>

            </select>
            <select id="filterUmur2" class="dropdown-btn">

    <option value="">Pilih Usia</option>
    <option value="0-12 Bulan">< 0-12 Bulan</option>
    <option value="1-5 Tahun">1 - 5 tahun</option>
    <option value="6-11 Tahun">6 - 11 tahun</option>
    <option value="12-16 Tahun">12 - 16 tahun</option>
    <option value="17-25 Tahun">17 - 25 tahun</option>
    <option value="25-35 Tahun">26 - 35 tahun</option>
    <option value="36-45 Tahun">36 - 45 tahun</option>
    <option value="46-55 Tahun">46 - 55 tahun</option>
    <option value="56-65 Tahun">56 - 65 tahun</option>
    <option value=">65 Tahun">> 65 tahun</option>

</select>

            <select id="filterGender2" class="dropdown-btn">

                <option value="All">Semua Gender</option>

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
console.log(wilayahData);

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

    ,
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

                title:{
                    display:true,
                    text:'Jumlah',

                    color:'#333',

                    font:{
                        size:16,
                        family:'Poppins'
                    }
                },

                ticks:{
                    stepSize:10
                }

            }

        }

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
    'Mangaran',
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
        return '0-12 Bulan';
    }

    if(umur >= 1 && umur <= 5){
        return '1-5 Tahun';
    }

    if(umur >= 6 && umur <= 11){
        return '6-11 Tahun';
    }

    if(umur >= 12 && umur <= 16){
        return '12-16 Tahun';
    }

    if(umur >= 17 && umur <= 25){
        return '17-25 Tahun';
    }

    if(umur >= 26 && umur <= 35){
        return '26-35 Tahun';
    }

    if(umur >= 36 && umur <= 45){
        return '36-45 Tahun';
    }

    if(umur >= 46 && umur <= 55){
        return '46-55 Tahun';
    }

    if(umur >= 56 && umur <= 65){
        return '56-65 Tahun';
    }

    return '>65 Tahun';
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
        filterUmur2.value == ''
        || filterUmur2.value == 'All'
        || item.rentang_umur == filterUmur2.value;

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

<div class="button-wrapper">
    <a href="<?= base_url('pneumonia') ?>" class="btn-kembali">
        Kembali 
    </a>
</div>

<?php if(!$embed): ?>
<?= $this->include('layout/footer') ?>
<?php endif; ?>

