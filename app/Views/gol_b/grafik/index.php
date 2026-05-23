<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid pb-5">

    <div class="card border-0 shadow-sm rounded-4 p-4"
         style="background:#EEF5F5;">

        <!-- HEADER -->
        <div class="mb-4">

            <h2 class="fw-bold mb-1">
                Grafik Interaktif Penyebaran
            </h2>

            <p class="text-muted mb-0">
                Visualisasi Kepadatan Kasus berdasarkan grafik
            </p>

        </div>

        <!-- FILTER -->
        <div class="d-flex flex-wrap gap-3 justify-content-end mb-4">

            <!-- FILTER WILAYAH -->
            <select id="filterWilayah" class="form-select rounded-pill" style="width:220px;">

                <option value="Semua Wilayah"> Semua Wilayah </option>
                <option value="Jemberkidul"> Jemberkidul </option>
                <option value="Tegalbesar"> Tegalbesar </option>
                <option value="Kaliwates"> Kaliwates </option>
                <option value="Kebonagung"> Kebonagung </option>
                <option value="Sempusari"> Sempusari </option>
                <option value="Mangli"> Mangli </option>
                <option value="Kepatihan"> Kepatihan </option>
                <option value="Lainnya"> Lainnya </option>

            </select>

            <!-- FILTER KATEGORI UMUR -->
            <select id="filterKategori"
                    class="form-select rounded-pill"
                    style="width:240px;">

                <option value="Semua" selected>
                    Semua Kategori
                </option>

                <option value="Balita">
                    0 - 4 Tahun (Balita)
                </option>

                <option value="Anak-anak">
                    5 - 9 Tahun (Anak-anak)
                </option>

                <option value="Remaja">
                    10 - 18 Tahun (Remaja)
                </option>

                <option value="Dewasa">
                    19 - 59 Tahun (Dewasa)
                </option>

                <option value="Lansia">
                    60+ Tahun (Lansia)
                </option>

            </select>

            <!-- FILTER BULAN -->
<select id="filterWaktu"
        class="form-select rounded-pill"
        style="width:220px;">

    <option value="Semua" selected>
        Semua Bulan
    </option>

    <option value="01">Januari</option>
    <option value="02">Februari</option>
    <option value="03">Maret</option>
    <option value="04">April</option>
    <option value="05">Mei</option>
    <option value="06">Juni</option>
    <option value="07">Juli</option>
    <option value="08">Agustus</option>
    <option value="09">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>

</select>

<!-- FILTER TAHUN -->
<input type="number"
       id="filterTahun"
       class="form-control rounded-pill"
       value="<?= date('Y') ?>"
       placeholder="Tahun"
       style="width:180px;">
        </div>

        <!-- CHART -->
        <div class="mt-4">

            <div class="row">
        </div>

        <div class="card border-0 rounded-4 p-4 text-center">
    <!-- TOMBOL -->
    <div class="d-flex justify-content-center mb-4">

        <div class="grafik-tabs">

            <button class="tab-btn active"
        onclick="gantiGrafik('status', this)">

    STATUS PASIEN

</button>

<button class="tab-btn"
        onclick="gantiGrafik('jk', this)">

    JENIS KELAMIN

</button>

<button class="tab-btn"
        onclick="gantiGrafik('umur', this)">

    KATEGORI UMUR

</button>
        </div>

    </div>

    <!-- GRAFIK -->
    <div style="height:400px;">

        <canvas id="mainChart"></canvas>

    </div>

</div>

        </div>

        <!-- FOOTER -->
        <div class="mt-3 text-muted small">

            Diperbarui pada:
            <?= date('d-m-Y') ?>

        </div>

    </div>

</div>

<style>

.grafik-tabs{
    display:flex;
    justify-content:center;
    margin-bottom:30px;
}

.tab-btn{

    padding:12px 28px;
    border:1px solid #20C9C3;
    background:white !important;
    color:#20C9C3 !important;

    font-weight:600;
    font-size:13px;

    cursor:pointer;
    transition:0.3s;

    min-width:170px;

}

.tab-btn:first-child{
    border-radius:30px 0 0 30px;
}

.tab-btn:last-child{
    border-radius:0 30px 30px 0;
}

.tab-btn.active{

    background:#20C9C3 !important;
    color:white !important;
    border:1px solid #20C9C3 !important;

}

.tab-btn:not(.active){

    background:white !important;
    color:#20C9C3 !important;

}

</style>

 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const grafikData = <?= isset($grafik) ? $grafik : '{}' ?>;

const wilayah = <?= isset($wilayah) ? $wilayah : '[]' ?>;


let kategoriAktif = 'Semua';
let bulanAktif = 'Semua';
let wilayahAktif = 'Semua Wilayah';

// ================= AMBIL DATA =================

function ambilData(gender){

    let hasil = [];

    getLabels().forEach(w => {

        // ===== FILTER WILAYAH =====
        if(
            wilayahAktif != 'Semua Wilayah'
            &&
            w != wilayahAktif
        ){

            hasil.push(0);
            return;

        }

        let total = 0;

        // ===== SEMUA BULAN =====
        if(bulanAktif == 'Semua'){

            Object.keys(grafikData).forEach(b => {

                // semua kategori
                if(kategoriAktif == 'Semua'){

                    total +=
                    grafikData[b][gender]['Balita'][w];

                    total +=
                    grafikData[b][gender]['Anak-anak'][w];

                    total +=
                    grafikData[b][gender]['Remaja'][w];

                    total +=
                    grafikData[b][gender]['Dewasa'][w];

                    total +=
                    grafikData[b][gender]['Lansia'][w];

                }

                // kategori tertentu
                else {

                    total +=
                    grafikData[b]
                    [gender]
                    [kategoriAktif]
                    [w];

                }

            });

        }

        // ===== BULAN TERTENTU =====
        // ===== BULAN TERTENTU =====
else {

    // semua kategori
    if(kategoriAktif == 'Semua'){

        total += grafikData[bulanAktif]?.[gender]?.['Balita']?.[w] || 0;

        total += grafikData[bulanAktif]?.[gender]?.['Anak-anak']?.[w] || 0;

        total += grafikData[bulanAktif]?.[gender]?.['Remaja']?.[w] || 0;

        total += grafikData[bulanAktif]?.[gender]?.['Dewasa']?.[w] || 0;

        total += grafikData[bulanAktif]?.[gender]?.['Lansia']?.[w] || 0;

    }

    // kategori tertentu
    else {

        total =
        grafikData[bulanAktif]?.[gender]?.[kategoriAktif]?.[w] || 0;

    }

}

        hasil.push(total);

    });

    return hasil;

}

function getLabels(){

    if(wilayahAktif == 'Semua Wilayah'){

        return wilayah;

    }

    return [wilayahAktif];

}


// ============================
// CHART STATUS
// ============================

function hitungStatus(statusCari){

    let total = 0;

    Object.keys(grafikData).forEach(bulan => {

        ['laki','perempuan'].forEach(gender => {

            ['Balita','Anak-anak','Remaja','Dewasa','Lansia']
            .forEach(kategori => {

                Object.keys(
                    grafikData[bulan][gender][kategori]
                ).forEach(w => {

                    let jumlah =
                    grafikData[bulan][gender][kategori][w] || 0;

                    // sementara mapping sederhana
                    if(statusCari == 'Sembuh'){
                        total += jumlah;
                    }

                });

            });

        });

    });

    return total;

}

// ============================
// CHART UMUR
// ============================

const umurLabels = [
    'Balita',
    'Anak-anak',
    'Remaja',
    'Dewasa',
    'Lansia'
];

function hitungUmur(){

    let hasil = [];

    umurLabels.forEach(kategori => {

        let total = 0;

        Object.keys(grafikData).forEach(bulan => {

            total += grafikData[bulan]['laki']?.[kategori]?.['Jemberkidul'] || 0;
            total += grafikData[bulan]['perempuan']?.[kategori]?.['Jemberkidul'] || 0;

            total += grafikData[bulan]['laki']?.[kategori]?.['Tegalbesar'] || 0;
            total += grafikData[bulan]['perempuan']?.[kategori]?.['Tegalbesar'] || 0;

            total += grafikData[bulan]['laki']?.[kategori]?.['Kaliwates'] || 0;
            total += grafikData[bulan]['perempuan']?.[kategori]?.['Kaliwates'] || 0;

            total += grafikData[bulan]['laki']?.[kategori]?.['Kebonagung'] || 0;
            total += grafikData[bulan]['perempuan']?.[kategori]?.['Kebonagung'] || 0;

            total += grafikData[bulan]['laki']?.[kategori]?.['Sempusari'] || 0;
            total += grafikData[bulan]['perempuan']?.[kategori]?.['Sempusari'] || 0;

            total += grafikData[bulan]['laki']?.[kategori]?.['Mangli'] || 0;
            total += grafikData[bulan]['perempuan']?.[kategori]?.['Mangli'] || 0;

            total += grafikData[bulan]['laki']?.[kategori]?.['Kepatihan'] || 0;
            total += grafikData[bulan]['perempuan']?.[kategori]?.['Kepatihan'] || 0;

            total += grafikData[bulan]['laki']?.[kategori]?.['Lainnya'] || 0;
            total += grafikData[bulan]['perempuan']?.[kategori]?.['Lainnya'] || 0;

        });

        hasil.push(total);

    });

    return hasil;
}

// ================= FILTER BULAN =================

document
.getElementById('filterWaktu')
.addEventListener('change', function(){

    bulanAktif = this.value;

    chartJK.data.datasets[0].data =
    ambilData('laki');

    chartJK.data.datasets[1].data =
    ambilData('perempuan');

    chartJK.update();

});
    // ================= FILTER WILAYAH =================

document
.getElementById('filterWilayah')
.addEventListener('change', function(){

    wilayahAktif = this.value;

    buatChartStatus();

});

const ctx = document.getElementById('mainChart');

let mainChart;

function buatChartStatus(){

    if(mainChart){
        mainChart.destroy();
    }

    mainChart = new Chart(ctx, {

        type:'bar',

        data:{

            labels:[
                'Jemberkidul',
                'Tegalbesar',
                'Kaliwates',
                'Kebonagung',
                'Sempusari',
                'Mangli',
                'Kepatihan'
            ],

            datasets:[

                {
                    label:'Sembuh',
                    data:[
                        <?= $status_sembuh_jemberkidul ?? 0 ?>,
                        <?= $status_sembuh_tegalbesar ?? 0 ?>,
                        <?= $status_sembuh_kaliwates ?? 0 ?>,
                        <?= $status_sembuh_kebonagung ?? 0 ?>,
                        <?= $status_sembuh_sempusari ?? 0 ?>,
                        <?= $status_sembuh_mangli ?? 0 ?>,
                        <?= $status_sembuh_kepatihan ?? 0 ?>
                    ],
                    backgroundColor:'#0B5D4B'
                },

                {
                    label:'Pengobatan',
                    data:[
                        <?= $status_pengobatan_jemberkidul ?? 0 ?>,
                        <?= $status_pengobatan_tegalbesar ?? 0 ?>,
                        <?= $status_pengobatan_kaliwates ?? 0 ?>,
                        <?= $status_pengobatan_kebonagung ?? 0 ?>,
                        <?= $status_pengobatan_sempusari ?? 0 ?>,
                        <?= $status_pengobatan_mangli ?? 0 ?>,
                        <?= $status_pengobatan_kepatihan ?? 0 ?>
                    ],
                    backgroundColor:'#B7E4D7'
                },

                {
                    label:'Meninggal',
                    data:[
                        <?= $status_meninggal_jemberkidul ?? 0 ?>,
                        <?= $status_meninggal_tegalbesar ?? 0 ?>,
                        <?= $status_meninggal_kaliwates ?? 0 ?>,
                        <?= $status_meninggal_kebonagung ?? 0 ?>,
                        <?= $status_meninggal_sempusari ?? 0 ?>,
                        <?= $status_meninggal_mangli ?? 0 ?>,
                        <?= $status_meninggal_kepatihan ?? 0 ?>
                    ],
                    backgroundColor:'#F4A300'
                }

            ]
        },

        options:{
            responsive:true,
            maintainAspectRatio:false,
            indexAxis:'y'
        }

    });

}

function buatChartJK(){

    if(mainChart){
        mainChart.destroy();
    }

   mainChart = new Chart(ctx, {

    type:'bar',

    data:{

        labels:[
            'Jemberkidul',
            'Tegalbesar',
            'Kaliwates',
            'Kebonagung',
            'Sempusari',
            'Mangli',
            'Kepatihan',
            'Lainnya'
        ],

        datasets:[

            {
                label:'Laki-laki',

                data:[

                    <?= $jk_laki_jemberkidul ?? 0 ?>,
                    <?= $jk_laki_tegalbesar ?? 0 ?>,
                    <?= $jk_laki_kaliwates ?? 0 ?>,
                    <?= $jk_laki_kebonagung ?? 0 ?>,
                    <?= $jk_laki_sempusari ?? 0 ?>,
                    <?= $jk_laki_mangli ?? 0 ?>,
                    <?= $jk_laki_kepatihan ?? 0 ?>,
                    <?= $jk_laki_lainnya ?? 0 ?>

                ],

                backgroundColor:'#20C9C3'

            },

            {
                label:'Perempuan',

                data:[

                    <?= $jk_perempuan_jemberkidul ?? 0 ?>,
                    <?= $jk_perempuan_tegalbesar ?? 0 ?>,
                    <?= $jk_perempuan_kaliwates ?? 0 ?>,
                    <?= $jk_perempuan_kebonagung ?? 0 ?>,
                    <?= $jk_perempuan_sempusari ?? 0 ?>,
                    <?= $jk_perempuan_mangli ?? 0 ?>,
                    <?= $jk_perempuan_kepatihan ?? 0 ?>,
                    <?= $jk_perempuan_lainnya ?? 0 ?>

                ],

                backgroundColor:'#B7E4D7'

            }

        ]

    },

    options:{
        responsive:true,
        maintainAspectRatio:false
    }

});

}

function buatChartUmur(){

    if(mainChart){
        mainChart.destroy();
    }

    mainChart = new Chart(ctx, {

        type:'line',

        data:{
            labels:[
                'Balita',
                'Anak-anak',
                'Remaja',
                'Dewasa',
                'Lansia'
            ],

            datasets:[{
                label:'Kategori Umur',
                data:[

                <?= $jumlah_balita ?? 0 ?>,
                <?= $jumlah_anak ?? 0 ?>,
                <?= $jumlah_remaja ?? 0 ?>,
                <?= $jumlah_dewasa ?? 0 ?>,
                <?= $jumlah_lansia ?? 0 ?>

                ],
                borderColor:'#20C9C3',
                backgroundColor:'#20C9C3'
            }]
        }

    });

}

function gantiGrafik(tipe, el){

    document
    .querySelectorAll('.tab-btn')
    .forEach(btn => {

        btn.classList.remove('active');

    });

    el.classList.add('active');

    if(tipe == 'status'){
        buatChartStatus();
    }

    if(tipe == 'jk'){
        buatChartJK();
    }

    if(tipe == 'umur'){
        buatChartUmur();
    }

}
buatChartStatus();
</script>

<?= $this->endSection() ?>