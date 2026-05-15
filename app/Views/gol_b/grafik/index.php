<?= $this->extend('layout/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

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
        <div style="height:500px;">

            <canvas id="grafikPasien"></canvas>

        </div>

        <!-- FOOTER -->
        <div class="mt-3 text-muted small">

            Diperbarui pada:
            <?= date('d-m-Y') ?>

        </div>

    </div>

</div>


 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const grafikData = <?= isset($grafik) ? $grafik : '{}' ?>;

const wilayah = <?= isset($wilayah) ? $wilayah : '[]' ?>;


const ctx =
document.getElementById('grafikPasien');

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

// ================= CHART =================

const chart = new Chart(ctx, {

    type: 'bar',

    data: {

        labels:  getLabels(),

        datasets: [

            {

                label: 'Laki-laki',

                data: ambilData('laki'),

                backgroundColor: '#3AA6B9',

                borderRadius: 8

            },

            {

                label: 'Perempuan',

                data: ambilData('perempuan'),

                backgroundColor: '#6EDCD9',

                borderRadius: 8

            }

        ]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                position: 'bottom'

            }

        },

        scales: {

            y: {

                beginAtZero: true,

                ticks: {

                    precision: 0

                }

            }

        }

    }

});

// ================= FILTER UMUR =================

document
.getElementById('filterKategori')
.addEventListener('change', function(){

    kategoriAktif = this.value;

    chart.data.datasets[0].data =
    ambilData('laki');

    chart.data.datasets[1].data =
    ambilData('perempuan');
    chart.data.labels = getLabels();
    chart.update();

});

// ================= FILTER BULAN =================

document
.getElementById('filterWaktu')
.addEventListener('change', function(){

    bulanAktif = this.value;

    chart.data.datasets[0].data =
    ambilData('laki');

    chart.data.datasets[1].data =
    ambilData('perempuan');

    chart.update();

});
    // ================= FILTER WILAYAH =================

document
.getElementById('filterWilayah')
.addEventListener('change', function(){

    wilayahAktif = this.value;

    chart.data.datasets[0].data =
    ambilData('laki');

    chart.data.datasets[1].data =
    ambilData('perempuan');

    chart.update();

});

</script>

<?= $this->endSection() ?>