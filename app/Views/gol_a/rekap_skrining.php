<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

    <!-- CONTENT -->
    <div class="flex-grow-1 p-4">

    <!-- SEARCH -->
    <input type="text" id="searchInput" class="form-control mb-3"
        placeholder="Cari nama pasien atau NIK">

    <!-- FILTER -->
        <div class="mb-3 d-flex justify-content-center">
        <button class="btn btn-info btn-sm me-2 filter-btn" data-filter="semua">Kategori Lingkungan</button>
        <button class="btn btn-outline-danger btn-sm me-2 filter-btn" data-filter="tinggi">Buruk</button>
        <button class="btn btn-outline-warning btn-sm me-2 filter-btn" data-filter="sedang">Cukup</button>
        <button class="btn btn-outline-success btn-sm filter-btn" data-filter="rendah">Baik</button>
    </div>

        <!-- OVERVIEW -->
        <div class="card bg-info text-white mb-4">
            <div class="card-body">
                <h5>
                    <?= isset($skrining) ? count($skrining) : 0 ?> Skrining Hari Ini 
                    dari <?= $total ?? 0 ?> Total Skrining
                </h5>
                <small>
                    <?= $tinggi ?? 0 ?> Risiko Tinggi • 
                    <?= $sedang ?? 0 ?> Risiko Sedang • 
                    <?= $rendah ?? 0 ?> Risiko Rendah
                </small>
            </div>
        </div>

        <!-- TABLE -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Hasil</th>
                                                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($skrining)): ?>
                            <?php $no=1; foreach($skrining as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_pasien_skrining'] ?></td>
                                <td><?= $row['usia'] ?></td>
                                <td><?= $row['jenis_kelamin'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
<td>
    <span class="badge bg-<?=
        strpos($row['hasil'], 'Buruk') !== false ? 'danger' :
        (strpos($row['hasil'], 'Cukup') !== false ? 'warning text-dark' : 'success')
    ?>">
        <?= $row['hasil'] ?>
    </span>
</td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Data belum ada</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script>
const searchInput = document.getElementById("searchInput");
const rows = document.querySelectorAll(".data-row");
const filterButtons = document.querySelectorAll(".filter-btn");

let currentFilter = "semua";

// FILTER BUTTON
filterButtons.forEach(btn => {
    btn.addEventListener("click", function() {
        currentFilter = this.dataset.filter;

        // reset style
        filterButtons.forEach(b => {
            b.classList.remove("btn-info");
            b.classList.add("btn-outline-secondary");
        });

        this.classList.remove("btn-outline-secondary");
        this.classList.add("btn-info");

        applyFilter();
    });
});

// SEARCH (REALTIME)
searchInput.addEventListener("input", applyFilter);

// FUNCTION UTAMA
function applyFilter() {
    const keyword = searchInput.value.toLowerCase();

    rows.forEach(row => {
        const nama = row.children[1].innerText.toLowerCase();
        const umur = row.children[2].innerText.toLowerCase();
        const kecamatan = row.children[4].innerText.toLowerCase();
        const kelurahan = row.children[5].innerText.toLowerCase();
        const risiko = row.dataset.risiko;

        // SEARCH ke beberapa kolom (biar keren 🔥)
        const matchSearch =
            nama.includes(keyword) ||
            umur.includes(keyword) ||
            kecamatan.includes(keyword) ||
            kelurahan.includes(keyword);

        const matchFilter =
            currentFilter === "semua" || risiko === currentFilter;

        if (matchSearch && matchFilter) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>
</body>
</html>
<?= $this->endSection() ?>