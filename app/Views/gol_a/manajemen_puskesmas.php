<?= $this->extend('layout/dashboard_layout_admin') ?>
<?= $this->section('content') ?>

<style>
    /* --- STYLE DASAR --- */
    .page-wrapper { background-color: #E6F4F1; padding: 20px; border-radius: 15px; min-height: 100vh; }
    
    /* --- BANNER HEADER (Sesuai Desain Gambar) --- */
    .banner-top { background-color: #00BBC2; border-radius: 15px; padding: 25px 30px; color: white; display: flex; align-items: center; margin-bottom: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .banner-icon { 
        background: rgba(255, 255, 255, 0.25); 
        width: 65px; 
        height: 65px; 
        border-radius: 15px; 
        margin-right: 25px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        flex-shrink: 0;
    }
    .banner-text h4 { margin: 0; font-weight: 700; font-size: 20px; }
    .banner-text p { margin: 0; font-size: 14px; opacity: 0.95; margin-top: 5px; }

    /* --- KOTAK DATA UTAMA --- */
    .data-card { background: #FFFFFF; border-radius: 15px; padding: 35px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }

    /* --- TOOLBAR PENCARIAN & TOMBOL --- */
    .toolbar-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px; }
    .toolbar-left { display: flex; gap: 12px; align-items: center; }
    
    /* Search Bar Sesuai Desain */
    .search-group { display: flex; border: 1px solid #00BBC2; border-radius: 8px; overflow: hidden; background: white; }
    .search-icon { background-color: #00BBC2; color: white; padding: 10px 18px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
    .search-input { border: none; padding: 10px 15px; outline: none; width: 250px; font-size: 14px; color: #555; }
    .search-input::placeholder { color: #A0A0A0; }
    
    /* Tombol Filter */
    .btn-filter { border: 1px solid #00BBC2; background: transparent; color: #00BBC2; padding: 0 16px; height: 42px; border-radius: 8px; font-size: 18px; cursor: pointer; transition: 0.2s; display: flex; align-items: center; justify-content: center; }
    .btn-filter:hover { background: #00BBC2; color: white; }
    .btn-filter.active-filter { background: #FF9800; border-color: #FF9800; color: white; box-shadow: 0 4px 10px rgba(255, 152, 0, 0.3); }
    
    .toolbar-right { display: flex; align-items: center; }
    .btn-add { background-color: #00BBC2; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: 0.2s; font-size: 14px; box-shadow: 0 4px 6px rgba(0, 187, 194, 0.2); }
    .btn-add:hover { background-color: #009ca2; color: white; transform: translateY(-2px); }

    /* --- TABEL DATA --- */
    .table-responsive { overflow-x: auto; margin-bottom: 20px; }
    .table-custom { width: 100%; border-collapse: separate; border-spacing: 0; }
    .table-custom th { background-color: #E2F5F4; color: #333; font-weight: 700; font-size: 14px; padding: 15px 15px; border-bottom: none; text-align: left; }
    .table-custom th:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
    .table-custom th:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
    .table-custom th.text-center { text-align: center; }
    .table-custom td { padding: 18px 15px; font-size: 13.5px; color: #555; border-bottom: 1px solid #F0F0F0; vertical-align: middle; }
    .table-custom td.text-center { text-align: center; }
    .table-custom tr:hover td { background-color: #FAFAFA; }
    
    /* --- TOMBOL AKSI TABEL (Sesuai Gambar) --- */
    .action-buttons { display: flex; gap: 8px; justify-content: center; }
    .btn-action { width: 32px; height: 32px; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; border: none; cursor: pointer; transition: 0.2s; font-size: 14px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .btn-action:hover { transform: scale(1.1); color: white; }
    .btn-view { background-color: #0000FF; } /* Biru Detail */
    .btn-edit { background-color: #FFD700; color: #fff; } /* Kuning Edit */
    .btn-delete { background-color: #FF0000; } /* Merah Hapus */

    /* --- PAGINASI (Sesuai Gambar) --- */
    .card-footer-custom { display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #888; margin-top: 25px; padding-top: 15px; border-top: 1px solid #F0F0F0; }
    .pagination-custom { display: flex; gap: 5px; list-style: none; padding: 0; margin: 0; }
    .pagination-custom li a, .pagination-custom li span { padding: 6px 14px; border: 1px solid #E0E0E0; border-radius: 6px; color: #555; text-decoration: none; background: white; transition: 0.2s; font-weight: 500; font-size: 13px; }
    .pagination-custom li a:hover { background-color: #F0F0F0; border-color: #D0D0D0; }
    .pagination-custom li.active span { background-color: #EAEFEF; font-weight: bold; color: #333; border-color: #EAEFEF; }

    /* =========================================
       STYLE MODAL (SAMA DENGAN RIWAYAT JENTIK)
       ========================================= */
    .modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(2px);
        z-index: 9999; display: none; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease;
    }
    .modal-overlay.show { opacity: 1; display: flex; }
    
    .filter-modal {
        background: #FFFFFF; width: 100%; max-width: 450px;
        border-radius: 20px; padding: 35px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        transform: translateY(-20px); transition: transform 0.3s ease;
    }
    .modal-overlay.show .filter-modal { transform: translateY(0); }
    
    .filter-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .filter-header h5 { margin: 0; font-weight: 800; font-size: 18px; color: #111; }
    .btn-close-modal { background: transparent; border: none; font-size: 20px; color: #333; cursor: pointer; transition: 0.2s; }
    .btn-close-modal:hover { color: #DC3545; transform: scale(1.1); }

    .filter-body .form-label { font-weight: 700; color: #333; font-size: 13px; margin-bottom: 8px; display: block; }
    .filter-body .form-input { background-color: #F4F6F8; border: 1px solid #EAEFEF; border-radius: 10px; padding: 12px 18px; width: 100%; font-size: 13px; color: #555; outline: none; margin-bottom: 20px; }
    .filter-body .form-input:focus { border-color: #00BBC2; background-color: #FFF; }

    .filter-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 10px; }
    .btn-modal { padding: 10px 25px; border-radius: 25px; font-weight: bold; font-size: 14px; border: none; cursor: pointer; transition: 0.2s; text-align: center; }
    .btn-modal-reset { background-color: #FFC107; color: #333; }
    .btn-modal-batal { background-color: #DC3545; color: #FFF; }
    .btn-modal-terapkan { background-color: #00BBC2; color: #FFF; }
    .btn-modal-abu { background-color: #E0E0E0; color: #333; }
</style>

<div class="page-wrapper">

    <?php if (session()->getFlashdata('success')) : ?>
        <div id="alertSuccess" style="background-color: #D4EDDA; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: bold; transition: opacity 0.5s ease;">
            <i class="fa-solid fa-circle-check me-2"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="banner-top">
        <div class="banner-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="36" height="36">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
        </div>
        <div class="banner-text">
            <h4>Manajemen Puskesmas</h4>
            <p>Menampilkan puskesmas</p>
        </div>
    </div>

    <div class="data-card">
        
        <div class="toolbar-container">
            <div class="toolbar-left">
                <div class="search-group">
                    <div class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <input type="text" id="searchInput" class="search-input" placeholder="Ketik untuk mencari..." onkeyup="handleSearch()">
                </div>
                <button type="button" class="btn-filter btn-filter-icon" onclick="openFilterModal()" title="Filter Data">
                    <i class="fa-solid fa-filter"></i>
                </button>
            </div>
            
            <div class="toolbar-right">
                <a href="<?= base_url('dbd/admin/manajemen_puskesmas/tambah') ?>" class="btn-add">
                    <i class="fa-solid fa-circle-plus"></i> Tambah Data
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-custom" id="dataTable">
                <thead>
                    <tr>
                        <th width="8%" class="text-center">No</th>
                        <th width="32%">Nama Puskesmas</th>
                        <th width="45%">Alamat</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Asumsi data array puskesmas dikirim dari controller
                    if (!empty($puskesmas) && is_array($puskesmas)) : 
                        $no = 1;
                        foreach ($puskesmas as $row) : 
                    ?>
                        <tr class="data-row" data-wilayah="<?= strtolower(esc($row['kecamatan'] ?? '')) ?>">
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= esc($row['nama_instansi']) ?></td>
                            <td><?= esc($row['alamat'] ?? 'Sumbersari, Jember') ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('manajemen_puskesmas/detail/'.$row['id_instansi']) ?>" class="btn-action btn-view" title="Detail"><i class="fa-solid fa-file-contract"></i></a>
                                    <a href="<?= base_url('manajemen_puskesmas/edit/'.$row['id_instansi']) ?>" class="btn-action btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                    <button type="button" class="btn-action btn-delete" onclick="openDeleteModal('<?= base_url('manajemen_puskesmas/hapus/'.$row['id_instansi']) ?>')" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php 
                        endforeach;
                    else : 
                    ?>
                        <tr class="data-row" data-wilayah="sumbersari">
                            <td class="text-center">1</td>
                            <td>Sumbersari</td>
                            <td>Sumbersari, Jember</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn-action btn-view" title="Detail"><i class="fa-solid fa-file-contract"></i></a>
                                    <a href="#" class="btn-action btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                    <button type="button" class="btn-action btn-delete" onclick="openDeleteModal('#')" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    
                    <tr id="noResultRow" style="display: none;">
                        <td colspan="4" class="text-center" style="padding: 40px; color: #888;">Tidak ada data puskesmas yang sesuai dengan filter atau pencarian Anda.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer-custom">
            <div id="paginationInfo">Menampilkan 0 dari 0 data puskesmas</div>
            <ul class="pagination-custom" id="paginationControls"></ul>
        </div>
    </div>
</div>

<div id="modalDeleteOverlay" class="modal-overlay">
    <div class="filter-modal" style="text-align: center;">
        <i class="fa-solid fa-triangle-exclamation" style="font-size: 65px; color: #DC3545; margin-bottom: 20px;"></i>
        <h4 style="font-weight: 800; color: #333; margin-bottom: 10px;">Konfirmasi Hapus</h4>
        <p style="font-size: 14px; color: #666; margin-bottom: 30px; line-height: 1.5;">Apakah Anda yakin ingin menghapus data puskesmas ini? Data tidak dapat dikembalikan.</p>
        
        <div style="display: flex; gap: 15px; justify-content: center;">
            <button type="button" class="btn-modal btn-modal-abu" onclick="closeDeleteModal()">Batal</button>
            <a href="#" id="btnConfirmDelete" class="btn-modal btn-modal-batal">Ya, Hapus</a>
        </div>
    </div>
</div>

<div id="modalFilterOverlay" class="modal-overlay">
    <div class="filter-modal">
        <div class="filter-header">
            <h5>Filter Puskesmas</h5>
            <button type="button" class="btn-close-modal" onclick="closeFilterModal()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="filter-body">
            <label class="form-label">Kecamatan / Wilayah</label>
            <select class="form-input" id="filterWilayah">
                <option value="" selected>Semua Wilayah</option>
                <option value="sumbersari">Sumbersari</option>
                <option value="kaliwates">Kaliwates</option>
                <option value="ajung">Ajung</option>
                <option value="panti">Panti</option>
            </select>
        </div>
        <div class="filter-footer">
            <button type="button" class="btn-modal btn-modal-reset" onclick="resetFilter()">Reset</button>
            <div style="display: flex; gap: 10px;">
                <button type="button" class="btn-modal btn-modal-batal" onclick="closeFilterModal()">Batal</button>
                <button type="button" class="btn-modal btn-modal-terapkan" onclick="applyModalFilter()">Terapkan</button>
            </div>
        </div>
    </div>
</div>

<script>
    /* =========================================
       1. STATE GLOBAL & INISIALISASI
       ========================================= */
    let filterSearchText = ""; 
    let filterWilayahVal = ""; 
    const rowsPerPage = 10; 
    let currentPage = 1; 
    let tableRowsValid = []; 

    document.addEventListener("DOMContentLoaded", function() {
        // Hilangkan alert otomatis
        let alertBox = document.getElementById('alertSuccess');
        if (alertBox) {
            setTimeout(function() {
                alertBox.style.opacity = '0';
                setTimeout(function() { alertBox.style.display = 'none'; }, 500); 
            }, 3000); 
        }
        
        applyMasterFilter(); 
    });

    /* =========================================
       2. LOGIKA MASTER FILTER & PENCARIAN
       ========================================= */
    function applyMasterFilter() {
        let table = document.getElementById("dataTable");
        let tbody = table.querySelector("tbody");
        let allDataRows = Array.from(tbody.querySelectorAll("tr.data-row"));
        
        tableRowsValid = []; 

        allDataRows.forEach(row => {
            let rowText = row.innerText.toLowerCase();
            let rowWilayah = row.getAttribute('data-wilayah') || "";

            let matchSearch = rowText.includes(filterSearchText);
            let matchWilayah = (filterWilayahVal === "" || rowWilayah.includes(filterWilayahVal));

            if (matchSearch && matchWilayah) { 
                tableRowsValid.push(row); 
            } else { 
                row.style.display = "none"; 
            }
        });

        // Tampilkan baris kosong jika data tidak ditemukan
        let noResultRow = document.getElementById('noResultRow');
        if (tableRowsValid.length === 0) { 
            noResultRow.style.display = ""; 
        } else { 
            noResultRow.style.display = "none"; 
        }

        displayPage(1); 
    }

    /* =========================================
       3. LOGIKA PAGINASI 
       ========================================= */
    function displayPage(page) {
        currentPage = page;
        let totalRows = tableRowsValid.length;
        let totalPages = Math.ceil(totalRows / rowsPerPage);

        if (totalRows === 0) {
            document.getElementById('paginationInfo').innerText = "Menampilkan 0 dari 0 data puskesmas";
            document.getElementById('paginationControls').innerHTML = "";
            return;
        }

        if (currentPage < 1) currentPage = 1; 
        if (currentPage > totalPages) currentPage = totalPages;
        
        let start = (currentPage - 1) * rowsPerPage; 
        let end = start + rowsPerPage;

        // Sembunyikan semua valid baris dulu
        for (let i = 0; i < totalRows; i++) { 
            tableRowsValid[i].style.display = "none"; 
        }
        
        // Tampilkan hanya yang sesuai halaman
        for (let i = start; i < end && i < totalRows; i++) {
            tableRowsValid[i].cells[0].innerText = i + 1; // Update nomor urut
            tableRowsValid[i].style.display = "";
        }

        let endDisplay = (end > totalRows) ? totalRows : end;
        document.getElementById('paginationInfo').innerText = `Menampilkan ${start + 1} sampai ${endDisplay} dari total ${totalRows} data puskesmas`;
        
        renderPaginationControls(totalPages);
    }

    function renderPaginationControls(totalPages) {
        let controls = document.getElementById('paginationControls'); 
        controls.innerHTML = "";
        
        // Tombol Previous
        let liPrev = document.createElement('li');
        if (currentPage > 1) {
            liPrev.innerHTML = `<a href="#" onclick="event.preventDefault(); displayPage(${currentPage - 1})">Previous</a>`;
        } else {
            liPrev.innerHTML = `<span style="color: #ccc;">Previous</span>`;
        }
        controls.appendChild(liPrev);

        // Angka Halaman
        let maxVisibleButtons = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisibleButtons / 2));
        let endPage = Math.min(totalPages, startPage + maxVisibleButtons - 1);
        if (endPage - startPage + 1 < maxVisibleButtons) { startPage = Math.max(1, endPage - maxVisibleButtons + 1); }

        for (let i = startPage; i <= endPage; i++) {
            let li = document.createElement('li');
            if (i === currentPage) { 
                li.className = "active"; li.innerHTML = `<span>${i}</span>`; 
            } else { 
                li.innerHTML = `<a href="#" onclick="event.preventDefault(); displayPage(${i})">${i}</a>`; 
            }
            controls.appendChild(li);
        }

        // Tombol Next
        let liNext = document.createElement('li');
        if (currentPage < totalPages) {
            liNext.innerHTML = `<a href="#" onclick="event.preventDefault(); displayPage(${currentPage + 1})">Next</a>`;
        } else {
            liNext.innerHTML = `<span style="color: #ccc;">Next</span>`;
        }
        controls.appendChild(liNext);
    }

    /* =========================================
       4. TRIGGER EVENT (Search, Filter, Modal)
       ========================================= */
    function handleSearch() { 
        filterSearchText = document.getElementById("searchInput").value.toLowerCase(); 
        applyMasterFilter(); 
    }

    // Modal Filter
    const modalFilterOverlay = document.getElementById('modalFilterOverlay');
    function openFilterModal() { modalFilterOverlay.classList.add('show'); }
    function closeFilterModal() { modalFilterOverlay.classList.remove('show'); }
    modalFilterOverlay.addEventListener('click', function(e) { if (e.target === this) closeFilterModal(); });

    function applyModalFilter() {
        filterWilayahVal = document.getElementById('filterWilayah').value.toLowerCase();
        
        let isFilterActive = (filterWilayahVal !== "");
        let btnFilterIcon = document.querySelector('.btn-filter-icon');
        if (isFilterActive) { btnFilterIcon.classList.add('active-filter'); } else { btnFilterIcon.classList.remove('active-filter'); }
        
        applyMasterFilter(); 
        closeFilterModal();
    }

    function resetFilter() {
        document.getElementById('filterWilayah').value = "";
        filterWilayahVal = ""; 
        document.querySelector('.btn-filter-icon').classList.remove('active-filter');
        
        applyMasterFilter(); 
        closeFilterModal();
    }

    // Modal Hapus
    const modalDeleteOverlay = document.getElementById('modalDeleteOverlay');
    function openDeleteModal(deleteUrl) {
        document.getElementById('btnConfirmDelete').href = deleteUrl; 
        modalDeleteOverlay.classList.add('show');
    }
    function closeDeleteModal() { modalDeleteOverlay.classList.remove('show'); }
    modalDeleteOverlay.addEventListener('click', function(e) { if (e.target === this) closeDeleteModal(); });

</script>

<?= $this->endSection() ?>