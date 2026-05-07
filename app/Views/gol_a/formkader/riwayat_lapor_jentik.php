<?= $this->extend('layout/dashboard_layout_kader') ?>
<?= $this->section('content') ?>

<style>
    /* --- STYLE DASAR --- */
    .page-wrapper { background-color: #E6F4F1; padding: 20px; border-radius: 15px; min-height: 100vh; }
    
    .banner-top { background-color: #51C2B8; border-radius: 15px; padding: 20px 25px; color: white; display: flex; align-items: center; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .banner-icon { background: rgba(255, 255, 255, 0.2); padding: 12px 15px; border-radius: 10px; margin-right: 20px; font-size: 24px; display: flex; align-items: center; justify-content: center; }
    .banner-text h4 { margin: 0; font-weight: 700; font-size: 18px; }
    .banner-text p { margin: 0; font-size: 13px; opacity: 0.9; margin-top: 3px; }

    .data-card { background: #FFFFFF; border-radius: 15px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); }

    /* --- TOOLBAR PENCARIAN & TOMBOL --- */
    .toolbar-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px; }
    .toolbar-left { display: flex; gap: 10px; }
    .search-group { display: flex; border: 2px solid #00CED1; border-radius: 8px; overflow: hidden; background: white; }
    .search-icon { background-color: #00CED1; color: white; padding: 8px 15px; display: flex; align-items: center; cursor: pointer; transition: 0.2s; }
    .search-icon:hover { background-color: #00B3B5; }
    .search-input { border: none; padding: 8px 15px; outline: none; width: 250px; font-size: 14px; }
    
    .btn-filter { border: 2px solid #00CED1; background: transparent; color: #00CED1; padding: 8px 15px; border-radius: 8px; font-size: 18px; cursor: pointer; transition: 0.2s; }
    .btn-filter:hover { background: #00CED1; color: white; }
    .btn-filter.active-filter { background: #FF9800; border-color: #FF9800; color: white; box-shadow: 0 4px 10px rgba(255, 152, 0, 0.3); }
    .btn-filter.active-filter:hover { background: #F57C00; border-color: #F57C00; }
    
    .toolbar-right { display: flex; align-items: center; gap: 20px; }
    .periode-text { font-weight: bold; font-size: 14px; display: flex; align-items: center; gap: 8px; }
    .periode-nav { color: #00CED1; cursor: pointer; padding: 0 5px; user-select: none; transition: 0.2s; font-size: 16px; }
    .periode-nav:hover { transform: scale(1.2); color: #00B3B5; }
    .periode-nav.disabled { color: #CCC; cursor: not-allowed; transform: none; }
    
    .btn-add { background-color: #00CED1; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: 0.2s; }
    .btn-add:hover { background-color: #00B3B5; color: white; }

    /* --- TABEL --- */
    .table-custom { width: 100%; border-collapse: separate; border-spacing: 0; margin-bottom: 20px; }
    .table-custom th { background-color: #E2F5F4; color: #333; font-weight: 700; font-size: 13px; padding: 15px 10px; border-bottom: 2px solid #fff; text-align: left; }
    .table-custom th.text-center { text-align: center; }
    .table-custom td { padding: 15px 10px; font-size: 13px; color: #555; border-bottom: 1px solid #F0F0F0; vertical-align: middle; }
    .table-custom td.text-center { text-align: center; }
    
    .action-buttons { display: flex; gap: 8px; justify-content: center; }
    .btn-action { width: 32px; height: 32px; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; border: none; cursor: pointer; transition: 0.2s; }
    .btn-action:hover { transform: scale(1.1); }
    .btn-view { background-color: #0000FF; }
    .btn-edit { background-color: #FFD700; color: #333; }
    .btn-delete { background-color: #FF0000; }

    .card-footer-custom { display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #888; margin-top: 20px; }
    .pagination-custom { display: flex; gap: 5px; list-style: none; padding: 0; margin: 0; }
    .pagination-custom li a, .pagination-custom li span { padding: 6px 12px; border: 1px solid #E0E0E0; border-radius: 4px; color: #555; text-decoration: none; background: white; transition: 0.2s; }
    .pagination-custom li a:hover { background-color: #00CED1; color: white; border-color: #00CED1; }
    .pagination-custom li.active span { background-color: #E0E0E0; font-weight: bold; }

    /* =========================================
       STYLE MODAL (BERLAKU UNTUK FILTER & HAPUS)
       ========================================= */
    .modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(2px);
        z-index: 9999; display: none; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease;
    }
    .modal-overlay.show { opacity: 1; display: flex; }
    
    .filter-modal {
        background: #FFFFFF; width: 100%; max-width: 500px;
        border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        transform: translateY(-20px); transition: transform 0.3s ease;
        max-height: 90vh; display: flex; flex-direction: column;
    }
    .modal-overlay.show .filter-modal { transform: translateY(0); }

    .filter-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .filter-header h5 { margin: 0; font-weight: 800; font-size: 18px; color: #111; }
    .btn-close-modal { background: transparent; border: none; font-size: 20px; color: #333; cursor: pointer; transition: 0.2s; }
    .btn-close-modal:hover { color: #DC3545; transform: scale(1.1); }

    .filter-body { overflow-y: auto; padding-right: 5px; }
    .filter-body .form-label { font-weight: 700; color: #333; font-size: 13px; margin-bottom: 8px; display: block; }
    .filter-body .input-icon-wrap { position: relative; margin-bottom: 20px; }
    .filter-body .form-input { background-color: #F4F6F8; border: 1px solid #F4F6F8; border-radius: 10px; padding: 12px 18px; width: 100%; font-size: 13px; color: #555; outline: none; appearance: none; }
    .filter-body .form-input:focus { border-color: #00CED1; background-color: #FFF; }
    .filter-body .input-icon-wrap .form-input { padding-right: 40px; }
    .filter-body .input-icon-wrap i { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #555; pointer-events: none; }

    .filter-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
    .filter-footer-right { display: flex; gap: 10px; }
    
    .btn-modal { padding: 10px 25px; border-radius: 25px; font-weight: bold; font-size: 14px; border: none; cursor: pointer; transition: 0.2s; text-decoration: none; text-align: center; }
    .btn-modal-reset { background-color: #FFC107; color: #333; }
    .btn-modal-reset:hover { background-color: #E0A800; }
    .btn-modal-batal { background-color: #DC3545; color: #FFF; }
    .btn-modal-batal:hover { background-color: #C82333; }
    .btn-modal-terapkan { background-color: #00CED1; color: #FFF; }
    .btn-modal-terapkan:hover { background-color: #00B3B5; }
    .btn-modal-abu { background-color: #E0E0E0; color: #333; }
    .btn-modal-abu:hover { background-color: #CFCFCF; }

    /* =========================================
       STYLE KALENDER (DI TENGAH LAYAR)
       ========================================= */
    .calendar-overlay-fixed { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(2px); z-index: 100000; display: none; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; }
    .calendar-overlay-fixed.show { opacity: 1; display: flex; }
    .calendar-popup-fixed { background: #fff; width: 100%; max-width: 320px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); padding: 20px; transform: scale(0.95); transition: transform 0.3s ease; }
    .calendar-overlay-fixed.show .calendar-popup-fixed { transform: scale(1); }
    .calendar-header-custom { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .calendar-header-custom button { background: #F4F6F8; border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #333; font-weight: bold; font-size: 12px; transition: 0.2s; }
    .calendar-header-custom button:hover { background: #EAEFEF; color: #00CED1; }
    .calendar-header-custom button.disabled-btn { opacity: 0.3; pointer-events: none; }
    .calendar-title-custom { font-weight: bold; font-size: 15px; color: #333; display: flex; align-items: center; gap: 5px; }
    .header-clickable { cursor: pointer; padding: 4px 8px; border-radius: 6px; transition: 0.2s; display: inline-block; }
    .header-clickable:hover { background: #E6F4F1; color: #00CED1 !important; }
    .calendar-table { width: 100%; border-collapse: separate; border-spacing: 0 4px; }
    .calendar-table th { font-size: 12px; color: #888; padding-bottom: 8px; font-weight: 600; text-align: center; }
    .calendar-table td { text-align: center; padding: 8px 0; cursor: pointer; font-size: 13px; color: #333; transition: 0.2s; }
    .calendar-table td.muted { color: #ccc; }
    .calendar-table td.disabled-day { color: #E0E0E0 !important; cursor: not-allowed !important; background-color: transparent !important; }
    .calendar-table tr.week-row { border-radius: 8px; transition: background 0.2s; }
    .calendar-table tr.week-row:hover { background-color: #F0FCFC; }
    .calendar-table tr.selected-week { background-color: #E6F4F1; }
    .calendar-table td.selected-day { background-color: #00CED1 !important; color: white !important; font-weight: bold; border-radius: 6px !important; }
    .grid-view { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; padding: 10px 0; }
    .grid-item { text-align: center; padding: 10px 0; background: #F4F6F8; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 600; color: #333; transition: 0.2s; }
    .grid-item:hover { background: #00CED1; color: white; }
    .grid-item.active { background: #00CED1; color: white; }
    .grid-item.disabled-grid { background: #FFF; color: #E0E0E0; cursor: not-allowed; }
</style>

<div class="page-wrapper">

    <div class="banner-top">
        <div class="banner-icon"><i class="fa-solid fa-shield-medical"></i></div>
        <div class="banner-text">
            <h4>Pelaporan Kader</h4>
            <p>Menampilkan riwayat pelaporan jentik</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div id="alertSuccess" style="background-color: #D4EDDA; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: bold; transition: opacity 0.5s ease;">
            <i class="fa-solid fa-circle-check"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="data-card">
        
        <div class="toolbar-container">
            <div class="toolbar-left">
                <div class="search-group">
                    <div class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <input type="text" id="searchInput" class="search-input" placeholder="Ketik untuk mencari..." onkeyup="handleSearch()">
                </div>
                <button class="btn-filter btn-filter-icon" onclick="openFilterModal()"><i class="fa-solid fa-filter"></i></button>
            </div>
            
            <div class="toolbar-right">
                <div class="periode-text">
                    Periode : 
                    <span class="periode-nav" id="prevPeriodeBtn" onclick="changePeriodeYear(-1)">&lt;</span> 
                    <span id="periodeYearDisplay">...</span> 
                    <span class="periode-nav" id="nextPeriodeBtn" onclick="changePeriodeYear(1)">&gt;</span>
                </div>
                <a href="<?= base_url('formkader/formulir_tambah_data') ?>" class="btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-custom" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Minggu Ke-</th>
                        <th>Puskesmas</th>
                        <th>Kelurahan</th>
                        <th>Pos Posyandu</th>
                        <th class="text-center">Angka Bebas<br>Jentik (ABJ)</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($pelaporan) && is_array($pelaporan)) : 
                        $no = 1;
                        foreach ($pelaporan as $row) : 
                            $tahunData = date('Y');
                            if (preg_match('/\d{4}/', $row['periode_lengkap'], $matches)) {
                                $tahunData = $matches[0];
                            }
                    ?>
                        <tr class="data-row" 
                            data-tahun="<?= $tahunData ?>" 
                            data-bulan="<?= strtolower(esc($row['bulan'])) ?>" 
                            data-minggu="<?= strtolower(esc($row['minggu'])) ?>" 
                            data-abj="<?= round($row['abj']) ?>">
                            
                            <td><?= $no++ ?></td>
                            <td><?= esc($row['bulan']) ?></td>
                            <td><?= esc($row['minggu']) ?></td>
                            <td><?= esc($row['nama_puskesmas']) ?></td> 
                            <td><?= esc($row['nama_kelurahan']) ?></td> 
                            <td><?= esc($row['nama_posyandu']) ?></td>  
                            <td class="text-center"><?= round($row['abj']) ?>%</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('dbd/detail_pelaporan/'.$row['id_laporan']) ?>" class="btn-action btn-view" title="Detail"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                                    <a href="<?= base_url('dbd/edit_pelaporan/'.$row['id_laporan']) ?>" class="btn-action btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                    <button type="button" class="btn-action btn-delete" onclick="openDeleteModal('<?= base_url('dbd/hapus_pelaporan/'.$row['id_laporan']) ?>')" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php 
                        endforeach;
                    else : 
                    ?>
                        <tr id="emptyDbRow" class="empty-row">
                            <td colspan="8" class="text-center" style="padding: 30px;">Belum ada riwayat pelaporan jentik di database.</td>
                        </tr>
                    <?php endif; ?>
                    
                    <tr id="noResultRow" class="empty-row" style="display: none;">
                        <td colspan="8" class="text-center" style="padding: 30px;">Tidak ada data yang sesuai dengan filter atau pencarian Anda.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer-custom">
            <div id="paginationInfo">Menampilkan hasil 0 dari 0 data</div>
            <ul class="pagination-custom" id="paginationControls"></ul>
        </div>
    </div>
</div>

<div id="modalDeleteOverlay" class="modal-overlay">
    <div class="filter-modal" style="max-width: 400px; text-align: center; padding: 40px 30px;">
        <i class="fa-solid fa-triangle-exclamation" style="font-size: 65px; color: #DC3545; margin-bottom: 20px;"></i>
        <h4 style="font-weight: 800; color: #333; margin-bottom: 10px;">Konfirmasi Hapus</h4>
        <p style="font-size: 14px; color: #666; margin-bottom: 30px; line-height: 1.5;">Apakah Anda yakin ingin menghapus data pelaporan jentik ini? Data beserta fotonya tidak dapat dikembalikan.</p>
        
        <div style="display: flex; gap: 15px; justify-content: center;">
            <button type="button" class="btn-modal btn-modal-abu" onclick="closeDeleteModal()" style="flex: 1;">Batal</button>
            <a href="#" id="btnConfirmDelete" class="btn-modal btn-modal-batal" style="flex: 1;">Ya, Hapus</a>
        </div>
    </div>
</div>

<div id="modalFilterOverlay" class="modal-overlay">
    <div class="filter-modal">
        <div class="filter-header">
            <h5>Filter Pelaporan Kader</h5>
            <button type="button" class="btn-close-modal" onclick="closeFilterModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="filter-body">
            <label class="form-label">Bulan</label>
            <div class="input-icon-wrap">
                <select class="form-input" id="filterBulan">
                    <option value="" selected>Semua Bulan</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <label class="form-label">Minggu ke-</label>
            <div class="input-icon-wrap" id="periodeContainerFilter" onclick="openCalendar()">
                <input type="text" class="form-input" id="filterMinggu" placeholder="Pilih minggu yang ingin ditampilkan (Opsional)" readonly style="cursor: pointer;">
                <i class="fa-regular fa-calendar" style="cursor: pointer;"></i>
            </div>
            <label class="form-label">Urutkan Berdasarkan</label>
            <div class="input-icon-wrap">
                <select class="form-input" id="filterUrutan">
                    <option value="" selected>Terbaru Disimpan (Default)</option>
                    <option value="tertinggi">ABJ Tertinggi</option>
                    <option value="terendah">ABJ Terendah</option>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
        <div class="filter-footer">
            <button type="button" class="btn-modal btn-modal-reset" onclick="resetFilter()">Reset</button>
            <div class="filter-footer-right">
                <button type="button" class="btn-modal btn-modal-batal" onclick="closeFilterModal()">Batal</button>
                <button type="button" class="btn-modal btn-modal-terapkan" onclick="applyModalFilter()">Terapkan</button>
            </div>
        </div>
    </div>
</div>

<div id="calendarOverlayFixed" class="calendar-overlay-fixed">
    <div class="calendar-popup-fixed">
        <div class="calendar-header-custom">
            <button type="button" id="prevMonthF">&#10094;</button>
            <div class="calendar-title-custom">
                <span id="monthSelectBtnF" class="header-clickable">April</span>
                <span id="yearSelectBtnF" class="header-clickable" style="color: #333;">2026</span>
            </div>
            <button type="button" id="nextMonthF">&#10095;</button>
        </div>
        <table class="calendar-table" id="daysViewF">
            <thead><tr><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th><th>Su</th></tr></thead>
            <tbody id="calendarBodyF"></tbody>
        </table>
        <div id="monthsViewF" class="grid-view" style="display: none;"></div>
        <div id="yearsViewF" class="grid-view" style="display: none;"></div>
    </div>
</div>

<script>
    /* =========================================
       0. INISIALISASI & STATE GLOBAL
       ========================================= */
    const currentRealYear = new Date().getFullYear(); 
    let currentDataYear = currentRealYear; 
    let filterSearchText = ""; let filterBulanVal = ""; let filterMingguVal = ""; let filterSortVal = "";
    const rowsPerPage = 10; let currentPage = 1; let tableRowsValid = []; 

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('periodeYearDisplay').innerText = currentDataYear;
        updatePeriodeNavUI();
        applyMasterFilter(); 

        let alertBox = document.getElementById('alertSuccess');
        if (alertBox) {
            setTimeout(function() {
                alertBox.style.opacity = '0';
                setTimeout(function() { alertBox.style.display = 'none'; }, 500); 
            }, 3000); 
        }
    });

    /* =========================================
       1. LOGIKA MODAL KONFIRMASI HAPUS BARU
       ========================================= */
    const modalDeleteOverlay = document.getElementById('modalDeleteOverlay');
    
    function openDeleteModal(deleteUrl) {
        document.getElementById('btnConfirmDelete').href = deleteUrl; // Pasang URL hapus ke tombol merah
        modalDeleteOverlay.classList.add('show'); // Munculkan pop-up
    }
    
    function closeDeleteModal() {
        modalDeleteOverlay.classList.remove('show');
    }
    
    // Klik di luar kotak modal untuk menutup
    modalDeleteOverlay.addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    /* =========================================
       2. LOGIKA MASTER FILTER & PENYORTIRAN
       ========================================= */
    function applyMasterFilter() {
        let table = document.getElementById("dataTable");
        let tbody = table.querySelector("tbody");
        let allDataRows = Array.from(tbody.querySelectorAll("tr.data-row"));
        
        tableRowsValid = []; 

        allDataRows.forEach(row => {
            let rowText = row.innerText.toLowerCase();
            let rowYear = parseInt(row.getAttribute('data-tahun'));
            let rowBulan = row.getAttribute('data-bulan'); 
            let rowMingguText = row.getAttribute('data-minggu'); 

            let matchSearch = rowText.includes(filterSearchText);
            let matchYear = (rowYear === currentDataYear);
            let matchBulan = (filterBulanVal === "" || rowBulan === filterBulanVal);
            let matchMinggu = true;
            if (filterMingguVal !== "") {
                let keywordMinggu = filterMingguVal.split('(')[0].trim().toLowerCase(); 
                matchMinggu = (rowMingguText === keywordMinggu);
            }

            if (matchSearch && matchYear && matchBulan && matchMinggu) { tableRowsValid.push(row); } 
            else { row.style.display = "none"; }
        });

        if (filterSortVal === "tertinggi") {
            tableRowsValid.sort((a, b) => parseFloat(b.getAttribute('data-abj')) - parseFloat(a.getAttribute('data-abj')));
        } else if (filterSortVal === "terendah") {
            tableRowsValid.sort((a, b) => parseFloat(a.getAttribute('data-abj')) - parseFloat(b.getAttribute('data-abj')));
        } else {
            tableRowsValid.sort((a, b) => {
                let indexA = allDataRows.indexOf(a); let indexB = allDataRows.indexOf(b); return indexA - indexB;
            });
        }

        tableRowsValid.forEach(row => tbody.appendChild(row));
        allDataRows.forEach(row => { if (!tableRowsValid.includes(row)) tbody.appendChild(row); });

        let noResultRow = document.getElementById('noResultRow');
        let emptyDbRow = document.getElementById('emptyDbRow');
        
        if (tableRowsValid.length === 0) { if (!emptyDbRow) noResultRow.style.display = ""; } 
        else { if(noResultRow) noResultRow.style.display = "none"; }

        displayPage(1); 
    }

    /* =========================================
       3. LOGIKA PAGINATION (PER 10 DATA)
       ========================================= */
    function displayPage(page) {
        currentPage = page;
        let totalRows = tableRowsValid.length;
        let totalPages = Math.ceil(totalRows / rowsPerPage);

        if (totalRows === 0) {
            document.getElementById('paginationInfo').innerText = "Menampilkan hasil 0 dari 0 data laporan";
            document.getElementById('paginationControls').innerHTML = "";
            return;
        }

        if (currentPage < 1) currentPage = 1; if (currentPage > totalPages) currentPage = totalPages;
        let start = (currentPage - 1) * rowsPerPage; let end = start + rowsPerPage;

        for (let i = 0; i < totalRows; i++) { tableRowsValid[i].style.display = "none"; }
        for (let i = start; i < end && i < totalRows; i++) {
            tableRowsValid[i].cells[0].innerText = i + 1;
            tableRowsValid[i].style.display = "";
        }

        let endDisplay = (end > totalRows) ? totalRows : end;
        document.getElementById('paginationInfo').innerText = `Menampilkan hasil ${start + 1} sampai ${endDisplay} dari total ${totalRows} data laporan`;
        renderPaginationControls(totalPages);
    }

    function renderPaginationControls(totalPages) {
        let controls = document.getElementById('paginationControls'); controls.innerHTML = "";
        if (currentPage > 1) {
            let liPrev = document.createElement('li');
            liPrev.innerHTML = `<a href="#" onclick="event.preventDefault(); displayPage(${currentPage - 1})">Previous</a>`;
            controls.appendChild(liPrev);
        }

        let maxVisibleButtons = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisibleButtons / 2));
        let endPage = Math.min(totalPages, startPage + maxVisibleButtons - 1);
        if (endPage - startPage + 1 < maxVisibleButtons) { startPage = Math.max(1, endPage - maxVisibleButtons + 1); }

        for (let i = startPage; i <= endPage; i++) {
            let li = document.createElement('li');
            if (i === currentPage) { li.className = "active"; li.innerHTML = `<span>${i}</span>`; } 
            else { li.innerHTML = `<a href="#" onclick="event.preventDefault(); displayPage(${i})">${i}</a>`; }
            controls.appendChild(li);
        }

        if (currentPage < totalPages) {
            let liNext = document.createElement('li');
            liNext.innerHTML = `<a href="#" onclick="event.preventDefault(); displayPage(${currentPage + 1})">Next</a>`;
            controls.appendChild(liNext);
        }
    }

    /* =========================================
       4. TRIGGER DARI HALAMAN & FILTER
       ========================================= */
    function handleSearch() { filterSearchText = document.getElementById("searchInput").value.toLowerCase(); applyMasterFilter(); }

    function changePeriodeYear(direction) {
        if (direction > 0 && currentDataYear >= currentRealYear) { return; }
        currentDataYear += direction;
        document.getElementById('periodeYearDisplay').innerText = currentDataYear; updatePeriodeNavUI(); applyMasterFilter(); 
    }

    function updatePeriodeNavUI() {
        const nextBtn = document.getElementById('nextPeriodeBtn');
        if (currentDataYear >= currentRealYear) { nextBtn.classList.add('disabled'); } else { nextBtn.classList.remove('disabled'); }
    }

    const modalFilterOverlay = document.getElementById('modalFilterOverlay');
    function openFilterModal() { modalFilterOverlay.classList.add('show'); }
    function closeFilterModal() { modalFilterOverlay.classList.remove('show'); }
    modalFilterOverlay.addEventListener('click', function(e) { if (e.target === this) closeFilterModal(); });

    function applyModalFilter() {
        filterBulanVal = document.getElementById('filterBulan').value.toLowerCase();
        filterMingguVal = document.getElementById('filterMinggu').value.toLowerCase();
        filterSortVal = document.getElementById('filterUrutan').value;
        
        let isFilterActive = (filterBulanVal !== "" || filterMingguVal !== "" || filterSortVal !== "");
        let btnFilterIcon = document.querySelector('.btn-filter-icon');
        if (isFilterActive) { btnFilterIcon.classList.add('active-filter'); } else { btnFilterIcon.classList.remove('active-filter'); }
        
        applyMasterFilter(); closeFilterModal();
    }

    function resetFilter() {
        document.getElementById('filterBulan').value = ""; document.getElementById('filterMinggu').value = ""; document.getElementById('filterUrutan').value = "";
        filterBulanVal = ""; filterMingguVal = ""; filterSortVal = "";
        document.querySelector('.btn-filter-icon').classList.remove('active-filter');
        applyMasterFilter(); closeFilterModal();
    }

    /* =========================================
       5. KALENDER MINGGUAN KUSTOM (FILTER)
       ========================================= */
    const calendarOverlay = document.getElementById('calendarOverlayFixed');
    function openCalendar() { calendarOverlay.classList.add('show'); renderCalendarF(activeMonthF, activeYearF); }
    function closeCalendar() { calendarOverlay.classList.remove('show'); }
    calendarOverlay.addEventListener('click', function(e) { if (e.target === this) closeCalendar(); });

    let currentDateF = new Date(); let activeMonthF = currentDateF.getMonth(); let activeYearF = currentDateF.getFullYear();
    const monthNamesF = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const shortMonthsF = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"];
    let todayLimitF = new Date(); todayLimitF.setHours(0, 0, 0, 0);
    let prevBtnF = document.getElementById('prevMonthF'); let nextBtnF = document.getElementById('nextMonthF');

    function renderCalendarF(month, year) {
        document.getElementById('daysViewF').style.display = 'table'; document.getElementById('monthsViewF').style.display = 'none'; document.getElementById('yearsViewF').style.display = 'none';
        prevBtnF.style.visibility = 'visible'; nextBtnF.style.visibility = 'visible';
        prevBtnF.onclick = function(e) { e.stopPropagation(); activeMonthF--; if(activeMonthF < 0) { activeMonthF = 11; activeYearF--; } renderCalendarF(activeMonthF, activeYearF); };
        nextBtnF.onclick = function(e) { e.stopPropagation(); activeMonthF++; if(activeMonthF > 11) { activeMonthF = 0; activeYearF++; } renderCalendarF(activeMonthF, activeYearF); };
        if (year === todayLimitF.getFullYear() && month === todayLimitF.getMonth()) { nextBtnF.classList.add('disabled-btn'); } else { nextBtnF.classList.remove('disabled-btn'); }

        document.getElementById('monthSelectBtnF').innerText = monthNamesF[month]; document.getElementById('yearSelectBtnF').innerText = year;
        let tbody = document.getElementById('calendarBodyF'); tbody.innerHTML = '';
        let firstDay = new Date(year, month, 1).getDay(); let offset = firstDay === 0 ? 6 : firstDay - 1; 
        let daysInMonth = new Date(year, month + 1, 0).getDate(); let daysInPrevMonth = new Date(year, month, 0).getDate();
        let dateCount = 1; let nextMonthDate = 1;

        for (let i = 0; i < 6; i++) {
            let row = document.createElement('tr'); row.className = 'week-row';
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement('td'); let cellDay = 0, cellMonth = month, cellYear = year;
                if (i === 0 && j < offset) { cell.innerText = daysInPrevMonth - offset + j + 1; cell.className = 'muted'; cellMonth = month - 1; if(cellMonth < 0) { cellMonth = 11; cellYear--; } cellDay = parseInt(cell.innerText); } 
                else if (dateCount > daysInMonth) { cell.innerText = nextMonthDate; cell.className = 'muted'; cellMonth = month + 1; if(cellMonth > 11) { cellMonth = 0; cellYear++; } cellDay = nextMonthDate; nextMonthDate++; } 
                else { cell.innerText = dateCount; cellDay = dateCount; dateCount++; }

                let currentCellDate = new Date(cellYear, cellMonth, cellDay);
                if (currentCellDate > todayLimitF) { cell.classList.add('disabled-day'); } 
                else { cell.onclick = function(e) { e.stopPropagation(); processWeekSelectionF(cellYear, cellMonth, cellDay); }; }
                row.appendChild(cell);
            }
            tbody.appendChild(row); if (dateCount > daysInMonth && nextMonthDate > 1) break; 
        }
    }

    function showMonthsViewF() {
        document.getElementById('daysViewF').style.display = 'none'; document.getElementById('yearsViewF').style.display = 'none';
        let monthsView = document.getElementById('monthsViewF'); monthsView.style.display = 'grid'; monthsView.innerHTML = '';
        prevBtnF.style.visibility = 'hidden'; nextBtnF.style.visibility = 'hidden';
        for(let i=0; i<12; i++) {
            let div = document.createElement('div'); div.className = 'grid-item'; div.innerText = shortMonthsF[i];
            if (activeYearF === todayLimitF.getFullYear() && i > todayLimitF.getMonth()) { div.classList.add('disabled-grid'); } 
            else { if(i === activeMonthF) div.classList.add('active'); div.onclick = function(e) { e.stopPropagation(); activeMonthF = i; renderCalendarF(activeMonthF, activeYearF); } }
            monthsView.appendChild(div);
        }
    }

    function showYearsViewF(startYear) {
        document.getElementById('daysViewF').style.display = 'none'; document.getElementById('monthsViewF').style.display = 'none';
        let yearsView = document.getElementById('yearsViewF'); yearsView.style.display = 'grid'; yearsView.innerHTML = '';
        prevBtnF.style.visibility = 'visible'; nextBtnF.style.visibility = 'visible'; prevBtnF.classList.remove('disabled-btn');
        if(startYear + 11 >= todayLimitF.getFullYear()) { nextBtnF.classList.add('disabled-btn'); } else { nextBtnF.classList.remove('disabled-btn'); }
        prevBtnF.onclick = function(e) { e.stopPropagation(); showYearsViewF(startYear - 12); }; nextBtnF.onclick = function(e) { e.stopPropagation(); showYearsViewF(startYear + 12); };
        for(let i = 0; i < 12; i++) {
            let y = startYear + i; let div = document.createElement('div'); div.className = 'grid-item'; div.innerText = y;
            if (y > todayLimitF.getFullYear()) { div.classList.add('disabled-grid'); } 
            else {
                if(y === activeYearF) div.classList.add('active');
                div.onclick = function(e) { e.stopPropagation(); activeYearF = y; if(activeYearF === todayLimitF.getFullYear() && activeMonthF > todayLimitF.getMonth()) { activeMonthF = todayLimitF.getMonth(); } showMonthsViewF(); }
            }
            yearsView.appendChild(div);
        }
    }

    document.getElementById('monthSelectBtnF').onclick = function(e) { e.stopPropagation(); showMonthsViewF(); };
    document.getElementById('yearSelectBtnF').onclick = function(e) { e.stopPropagation(); showYearsViewF(activeYearF - 4); };

    function processWeekSelectionF(year, month, day) {
        let selectedDate = new Date(year, month, day); let dayOfWeek = selectedDate.getDay(); 
        let diffToMonday = selectedDate.getDate() - dayOfWeek + (dayOfWeek === 0 ? -6 : 1); let monday = new Date(selectedDate.setDate(diffToMonday));
        let sunday = new Date(monday); sunday.setDate(monday.getDate() + 6);
        let firstDayOfMonth = new Date(year, month, 1); let firstDayWeekday = firstDayOfMonth.getDay();
        let offset = (firstDayWeekday === 0 ? 6 : firstDayWeekday - 1); let weekOfMonth = Math.ceil((day + offset) / 7);
        let startD = monday.getDate(); let endD = sunday.getDate(); let startM = monthNamesF[monday.getMonth()]; let endM = monthNamesF[sunday.getMonth()]; let endY = sunday.getFullYear();
        let dateStr = (startM === endM) ? `${startD}-${endD} ${startM} ${endY}` : `${startD} ${startM} - ${endD} ${endM} ${endY}`;
        
        document.getElementById('filterMinggu').value = `Minggu ke-${weekOfMonth} (${dateStr})`;
        closeCalendar();
    }
</script>

<?= $this->endSection() ?>