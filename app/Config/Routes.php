<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* ========================= */
/* HALAMAN UTAMA */
/* ========================= */

$routes->get('/', 'Home::index');
$routes->get('tbc', 'LandingTbc::index');
$routes->get('/logout', 'Auth::logout');
$routes->get('/kontak', 'Home::kontak');
$routes->get('/pneumonia', 'Home::pneumonia');
$routes->get('/tbc', 'Home::tbc');
$routes->get('/skrining', 'Home::skrining');
$routes->get('/grafik_pneumonia', 'Home::grafikPneumonia');

// ===============================================
// ROUTE Landingpage DBD dan Dasboard
// ===============================================
$routes->get('/dbd', 'LandingpageDbd::index');
$routes->post('chagoo/send', 'Chagoo::send');
$routes->get('/dbd/dashboard/admin', 'DashboardadminDbd::index');
$routes->post('simpan-penduduk', 'DashboardadminDbd::simpanPenduduk');
$routes->get('hapus-penduduk/(:num)', 'DashboardadminDbd::hapusPenduduk/$1');
$routes->get('edit-penduduk/(:num)', 'DashboardadminDbd::editPenduduk/$1');

// ===============================================
// Landingpage TBC 
// ===============================================
$routes->get('tbc/detail-funfact/(:num)', 'LandingTbc::detailFunfact/$1');

/* ========================= */
/* SKRINING Pneumonia */
/* ========================= */
$routes->get('/skriningpneumonia', 'Pneumonia::skriningpneumonia');
$routes->match(['get', 'post'], '/skriningpneumonia/skriningpneumonia2', 'Pneumonia::skriningpneumonia2');
$routes->match(['get', 'post'], '/skriningpneumonia/skriningpneumonia3', 'Pneumonia::skriningpneumonia3');
$routes->get('/chat-pneumonia', 'ChatPneumonia::index');
$routes->post('/chat-pneumonia/send', 'ChatPneumonia::send');

$routes->get('/pneumonia/rekapskrining/admin', 'Pneumonia::rekapskrining');
/* ========================= */
/* SKRINING DBD */
/* ========================= */
$routes->get('/skriningdbd', 'Dbd::skriningdbd');
$routes->match(['get', 'post'], '/skriningdbd/skriningdbd2', 'Dbd::skriningdbd2');
$routes->match(['get', 'post'], '/skriningdbd/skriningdbd3', 'Dbd::skriningdbd3');
$routes->get('/dbd/rekap_skrining', 'Dbd::rekap_skrining');
$routes->get('dbd/hapus_skrining/(:num)', 'Dbd::hapus_skrining/$1');

/* ========================= */
/* PROFIL dan Logut */
/* ========================= */
$routes->get('/profil_kepala', 'Profile::profil_kepala');
$routes->post('uploadFoto_kepala', 'Profile::uploadFoto');
$routes->post('updateProfil_kepala', 'Profile::updateProfil');
$routes->get('/profil_admin', 'Profile2::profil_admin');
$routes->post('uploadFoto_admin', 'Profile2::uploadFoto');
$routes->post('updateProfil_admin', 'Profile2::updateProfil');
$routes->get('/profil_kader', 'Profile3::profil_kader');
$routes->post('uploadFoto_kader', 'Profile3::uploadFoto');
$routes->post('updateProfil_kader', 'Profile3::updateProfil');

/* ========================= */
/* PROFIL dan Logut Pneumonia*/
/* ========================= */
$routes->get('pneumonia/profil_admin', 'Profile_admin_pneumonia::profil_admin');
$routes->post('pneumonia/uploadFoto_admin', 'Profile_admin_pneumonia::uploadFoto');
$routes->post('pneumonia/updateProfil_admin', 'Profile_admin_pneumonia::updateProfil');

/* ========================= */
/* EKSPORT DATA PASIEN PNEUMONIA */
/* ========================= */
$routes->get('pneumonia/get-data-pasien-by-tahun', 'pneumonia::get_data_pasien_by_tahun');
$routes->get('pneumonia/export_hasil_data_pasien', 'pneumonia::export_hasil_data_pasien');
$routes->get('pneumonia/get-tahun-list', 'pneumonia::get_tahun_list');
$routes->get('pneumonia/export-hasil-data-pasien/pdf', 'pneumonia::export_pdf_pasien');
$routes->get('pneumonia/export-hasil-data-pasien/excel', 'pneumonia::export_excel_pasien');
$routes->get('pneumonia/preview-export', 'Pneumonia::preview_export');

/* ========================= */
/* ADMIN GRAFIK PNEUMONIA */
/* ========================= */
$routes->get('pneumonia/grafik', 'Pneumonia::grafik');

// ===========================
// BERITA PNEUMONIA ADMIN
// ===========================

$routes->get('beritapneumonia/admin', 'BeritaPneumonia::index');

$routes->get('beritapneumonia/admin/tambah', 'BeritaPneumonia::tambah');
$routes->post('beritapneumonia/admin/simpan', 'BeritaPneumonia::simpan');

$routes->get('beritapneumonia/admin/edit/(:num)', 'BeritaPneumonia::edit/$1');
$routes->post('beritapneumonia/admin/update/(:num)', 'BeritaPneumonia::update/$1');

$routes->get('beritapneumonia/admin/delete/(:num)', 'BeritaPneumonia::delete/$1');

$routes->get('beritapneumonia/admin/view/(:num)', 'BeritaPneumonia::view/$1');

$routes->get(
    'beritapneumonia/viewUser/(:num)', 'BeritaPneumonia::viewUser/$1'
);

$routes->get('beritapneumonia/admin/publish', 'BeritaPneumonia::publish');
$routes->get('beritapneumonia/admin/draft', 'BeritaPneumonia::draft');

$routes->post(
    'beritapneumonia/admin/upload-editor-image',
    'BeritaPneumonia::uploadEditorImage'
);

/* ========================= */
/* FUNFACT PNEUMONIA */
/* ========================= */

$routes->get('pneumonia/funfact', 'FunfactPneumonia::index');
$routes->get('pneumonia/funfact/create', 'FunfactPneumonia::create');

$routes->post('pneumonia/funfact/simpan', 'FunfactPneumonia::simpan');
$routes->post('pneumonia/funfact/kutip', 'FunfactPneumonia::simpanKutip');

$routes->get('pneumonia/funfact/detail/(:num)', 'FunfactPneumonia::detail/$1');
$routes->get('pneumonia/funfact/edit/(:num)', 'FunfactPneumonia::edit/$1');
$routes->post('pneumonia/funfact/update/(:num)', 'FunfactPneumonia::update/$1');

$routes->get('pneumonia/funfact/hapus/(:num)', 'FunfactPneumonia::hapus/$1');
$routes->get('pneumonia/funfact/arsip/(:num)', 'FunfactPneumonia::arsip/$1');
$routes->get('pneumonia/funfact/publish/(:num)', 'FunfactPneumonia::publish/$1');

$routes->get('pneumonia-funfact', 'FunfactPneumoniaLanding::index');

/* ========================= */
/* DIARE */
/* ========================= */

$routes->get('/diare-detail', 'Home::diare_detail');
$routes->get('/diare', 'Diare::index');

/* ========================= */
/* LOGIN */
/* ========================= */

$routes->get('/login', 'Auth::login');
$routes->post('/login-process', 'Auth::prosesLogin');
$routes->get('/forgot', 'Auth::forgot');
$routes->post('/forgot-process', 'Auth::prosesForgot');
$routes->get('/reset', 'Auth::reset');
$routes->post('/reset-process', 'Auth::prosesReset');
$routes->get('/otp-login', 'Auth::otpLogin');
$routes->post('/otp-login', 'Auth::verifyOtpLogin');
$routes->get('/otp-reset', 'Auth::otpReset');
$routes->post('/otp-reset', 'Auth::verifyOtpReset');

/* ========================= */
/* DASHBOARD */
/* ========================= */

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('dbd/dashboard/admin', 'Dashboard::dbd');
$routes->get('dbd/input_data', 'Dbd::inputData');
$routes->get('dbd/hasil', 'Dbd::hasil_data');
$routes->get('data_kepala/hasil', 'Dbd::hasil_data_kepala');
$routes->post('dbd/simpan', 'dbd::simpan');
$routes->get('dbd/export', 'Dbd::export');
$routes->get('tbc/dashboard', 'Dashboard::tbc');
$routes->get('tbc/dashboard/admin', 'Dashboard::tbc');
$routes->get('pneumonia/dashboard/admin', 'Dashboard::pneumonia');
$routes->get('pneumonia/input_data', 'pneumonia::inputData');
$routes->get('pneumonia/hasil', 'pneumonia::hasil_data');
$routes->post('pneumonia/simpandatapasien', 'pneumonia::simpandatapasien');
$routes->get('pneumonia/export', 'pneumonia::export');

$routes->get('diare/dashboardd/', 'Dashboard::diare');

$routes->get('diare/input_d', 'Diare::inputData');
$routes->get('diare/hasil_d', 'Diare::hasil_data');
$routes->get('pneumonia/pegawai', 'Pegawai::index');
$routes->get('pneumonia/pegawai/tambah', 'Pegawai::tambah');
$routes->post('pneumonia/pegawai/simpan', 'Pegawai::simpan');
$routes->get('pneumonia/pegawai/edit/(:num)', 'Pegawai::edit/$1');
$routes->post('pneumonia/pegawai/update/(:num)', 'Pegawai::update/$1');
$routes->get('pneumonia/pegawai/hapus/(:num)', 'Pegawai::hapus/$1');
$routes->post('diare/simpan', 'diare::simpan');
$routes->get('/diare/export', 'Diare::export');
$routes->get('dbd/dashboard/kader', 'dbd::dashboard');
$routes->get('cekdb', 'Home::cekdb');
$routes->get('peta_sebaran', 'dbd::peta');
$routes->get('dashboard', 'Kepala::dashboard');
$routes->get('peta_sebaran/kepala', 'Kepala::peta_sebaran');
$routes->get('detail_peta', 'Kepala::detail_peta');
$routes->get('kepala/pelaporan_kader', 'Kepala::pelaporan_kader');
$routes->get('/kepala/daftar_laporan', 'Kepala::daftar_laporan');
$routes->get('pelaporan-kader', 'Kepala::pelaporan_kader');
$routes->get('pelaporan-kader/daftar', 'Kepala::daftar_laporan');
$routes->get('pelaporan-kader/delete/(:num)', 'Kepala::delete_laporan/$1');


/* ========================= */
/* DASHBOARD KEPALA */
/* ========================= */

$routes->get('dbd/dashboard/kepala', 'Kepala::dashboard');
$routes->get('/export_kepala', 'Kepala::export');
$routes->get('dashboard', 'Kepala::dashboard');
$routes->get('peta_sebaran/kepala', 'Kepala::peta_sebaran');
$routes->get('detail_peta', 'Kepala::detail_peta');
$routes->get('kepala/pelaporan_kader', 'Kepala::pelaporan_kader');
$routes->get('/kepala/daftar_laporan', 'Kepala::daftar_laporan');
$routes->get('pelaporan-kader', 'Kepala::pelaporan_kader');
$routes->get('pelaporan-kader/daftar', 'Kepala::daftar_laporan');
$routes->get('pelaporan-kader/delete/(:num)', 'Kepala::delete_laporan/$1');
$routes->get('hasil_data_kepala/hasil', 'Kepala::hasil_data_kepala');
$routes->get('kepala/view_laporan/(:num)', 'Kepala::view_laporan/$1');

// ==========================================
// ROUTES UNTUK HASIL DATA KEPALA
// ==========================================
$routes->get('kepala/export_hasil_data_kepala', 'Kepala::export_hasil_data_kepala');

// Tambahkan juga ini agar fungsi AJAX/Fetch untuk filter tahun tidak error (jika digunakan)
$routes->get('kepala/get_data_pasien_by_tahun', 'Kepala::get_data_pasien_by_tahun');
$routes->get('kepala/get_tahun_list', 'Kepala::get_tahun_list');

// ===============================================
// ROUTE MANAJEMEN USER KEPALA
// ===============================================

$routes->get('kepala/manajemen_user', 'Kepala::manajemen_user');
$routes->get('kepala/form_user', 'Kepala::form_user');
$routes->get('kepala/form_user/(:num)/edit', 'Kepala::form_user/$1/edit');
$routes->post('kepala/simpan_user', 'Kepala::simpan_user');
$routes->post('kepala/update_user/(:num)', 'Kepala::update_user/$1');
$routes->get('kepala/hapus_user/(:num)', 'Kepala::hapus_user/$1');
$routes->get('kepala/view_user/(:num)', 'Kepala::view_user/$1');

// ROUTES MANAJEMEN PUSKESMAS
// ==========================================
$routes->get('dbd/admin/manajemen_puskesmas', 'Dbd::manajemen_pkm');
$routes->get('dbd/admin/manajemen_puskesmas/tambah', 'Dbd::tambah_manajemen_pkm');
$routes->post('dbd/admin/manajemen_puskesmas/simpan', 'Dbd::simpan_manajemen_pkm');
$routes->get('dbd/admin/manajemen_puskesmas/detail/(:num)', 'Dbd::detail_manajemen_pkm/$1');
$routes->get('dbd/admin/manajemen_puskesmas/edit/(:num)', 'Dbd::edit_manajemen_pkm/$1');
$routes->post('dbd/admin/manajemen_puskesmas/update/(:num)', 'Dbd::update_manajemen_pkm/$1');
$routes->get('dbd/admin/manajemen_puskesmas/hapus/(:num)', 'Dbd::hapus_manajemen_pkm/$1');

// ===============================================
// ROUTE REKAP SKRINING KEPALA
// ===============================================

$routes->get('kepala/rekap_skrining', 'Kepala::rekap_skrining');
$routes->get('kepala/hapus_skrining/(:num)', 'Kepala::hapus_skrining/$1');

/* ========================= */
/* BERITA TBC */
/* ========================= */

$routes->get('tbc/berita', 'AdminTbc\BeritaTbc::index');
$routes->get('tbc/berita/create', 'AdminTbc\BeritaTbc::create');

$routes->post('tbc/berita/simpan', 'AdminTbc\BeritaTbc::simpan');
$routes->post('tbc/berita/kutip', 'AdminTbc\BeritaTbc::simpanKutip');

$routes->get('tbc/berita/detail/(:num)', 'AdminTbc\BeritaTbc::detail/$1');
$routes->get('tbc/berita/edit/(:num)', 'AdminTbc\BeritaTbc::edit/$1');
$routes->post('tbc/berita/update/(:num)', 'AdminTbc\BeritaTbc::update/$1');

$routes->get('tbc/berita/hapus/(:num)', 'AdminTbc\BeritaTbc::hapus/$1');
$routes->get('tbc/berita/arsip/(:num)', 'AdminTbc\BeritaTbc::arsip/$1');
$routes->get('tbc/berita/publish/(:num)', 'AdminTbc\BeritaTbc::publish/$1');
$routes->get('tbc/berita/detail/(:num)', 'AdminTbc\BeritaTbc::detail/$1');

/* ========================= */
/* FUNFACT TBC */
/* ========================= */

$routes->get('tbc/funfact', 'AdminTbc\FunfactTbc::index');
$routes->get('tbc/funfact/create', 'AdminTbc\FunfactTbc::create');

$routes->post('tbc/funfact/simpan', 'AdminTbc\FunfactTbc::simpan');
$routes->post('tbc/funfact/kutip', 'AdminTbc\FunfactTbc::simpanKutip');

$routes->get('tbc/funfact/detail/(:num)', 'AdminTbc\FunfactTbc::detail/$1');
$routes->get('tbc/funfact/edit/(:num)', 'AdminTbc\FunfactTbc::edit/$1');
$routes->post('tbc/funfact/update/(:num)', 'AdminTbc\FunfactTbc::update/$1');

$routes->get('tbc/funfact/hapus/(:num)', 'AdminTbc\FunfactTbc::hapus/$1');
$routes->get('tbc/funfact/arsip/(:num)', 'AdminTbc\FunfactTbc::arsip/$1');
$routes->get('tbc/funfact/publish/(:num)', 'AdminTbc\FunfactTbc::publish/$1');

/* ========================= */
/* ARTIKEL ADMIN */
/* ========================= */

$routes->get('admin/artikel', 'Admin\Artikel::index');
$routes->get('admin/artikel/tambah', 'Admin\Artikel::create');
$routes->post('admin/artikel/simpan', 'Admin\Artikel::store');

$routes->get('admin/artikel/edit/(:num)', 'Admin\Artikel::edit/$1');
$routes->post('admin/artikel/update/(:num)', 'Admin\Artikel::update/$1');

$routes->get('admin/artikel/delete/(:num)', 'Admin\Artikel::delete/$1');
$routes->get('admin/artikel/toggle/(:num)', 'Admin\Artikel::toggle/$1');

$routes->get('admin/artikel/(:num)', 'Admin\Artikel::show/$1');

/* ========================= */
/* INPUT DATA PASIEN */
/* ========================= */
$routes->post('dbd/simpandatapasien', 'Dbd::simpandatapasien');


// ================= PSN KADER =================
$routes->get('formkader/riwayat_lapor_jentik', 'Dbd::riwayat_jentik');
$routes->get('formkader/formulir_tambah_data', 'Dbd::tambah_pelaporan');
$routes->post('dbd/simpanpsn', 'Dbd::simpanpsn');
$routes->get('dbd/pelaporan', 'Dbd::riwayat_jentik');
$routes->get('dbd/hapus_pelaporan/(:num)', 'Dbd::hapus_pelaporan/$1');
$routes->get('dbd/detail_pelaporan/(:num)', 'Dbd::detail_pelaporan/$1');
$routes->get('dbd/edit_pelaporan/(:num)', 'Dbd::edit_pelaporan/$1');
$routes->post('dbd/update_pelaporan/(:num)', 'Dbd::update_pelaporan/$1');
$routes->get('formkader/rekap', 'Dbd::rekappsn');
$routes->get('formkader/detail/(:any)', 'Dbd::detailpsn/$1');
$routes->get('dbd/exportrekappsn', 'Dbd::exportrekappsn');

// ================= EXPORT HASIL DATA PASIEN =================
$routes->get('dbd/get-data-pasien-by-tahun', 'Dbd::get_data_pasien_by_tahun');
$routes->get('dbd/export-hasil-data-pasien', 'Dbd::export_hasil_data_pasien');

$routes->get('dbd/get-tahun-list', 'Dbd::get_tahun_list');

// ================= Berita DBD =================
$routes->get('/berita/tambah', 'BeritaDbd::tambah');
$routes->post('/berita/simpan', 'BeritaDbd::simpan');
$routes->get('/berita/kelola_berita', 'BeritaDbd::index');
$routes->get('detail/(:num)', 'BeritaDbd::detail/$1');
$routes->get('/berita/edit/(:num)', 'BeritaDbd::edit/$1');
$routes->post('/berita/update/(:num)', 'BeritaDbd::update/$1');
$routes->get('/berita/delete/(:num)', 'BeritaDbd::delete/$1');
$routes->get('/berita', 'BeritaDbd::index');
$routes->get('/berita/publish', 'BeritaDbd::publish');
$routes->get('/berita/draft', 'BeritaDbd::draft');
$routes->get('/berita/view_berita/(:num)', 'BeritaDbd::view/$1');
$routes->get('berita/view_berita/(:any)', 'BeritaDbd::view/$1');
$routes->get('berita/list_berita', 'LandingpageDbd::list_berita');
$routes->get('/berita/view_user/(:num)', 'BeritaDbd::viewUser/$1');
$routes->post('berita/upload-editor-image', 'BeritaDbd::uploadEditorImage');

$routes->get('dbd/export-hasil-data-pasien/pdf', 'Dbd::export_pdf_pasien');
$routes->get('dbd/export-hasil-data-pasien/excel', 'Dbd::export_excel_pasien');

$routes->get('tbc/hasil', 'AdminTbc\Pasien::index');

$routes->get('tbc/input_data', 'AdminTbc\Pasien::create');

$routes->post('tbc/store', 'AdminTbc\Pasien::store');

$routes->get('tbc/edit/(:num)', 'AdminTbc\Pasien::edit/$1');

$routes->post('tbc/update/(:num)', 'AdminTbc\Pasien::update/$1');

$routes->get('tbc/delete/(:num)', 'AdminTbc\Pasien::delete/$1');

$routes->get('tbc/grafik', 'AdminTbc\Pasien::grafik');
$routes->get('tbc/create', 'AdminTbc\Pasien::create');

/* ========================= */
/* Landing Page TBC */
/* ========================= */
$routes->get('/tbc-detail', 'Home::tbc_detail');


// ========================================
// SKRINING TBC
// ========================================

$routes->get('/skrining-tbc', 'AdminTbc\Dashboard::step1');

$routes->post('/skrining-tbc/step2', 'AdminTbc\Dashboard::step2');

$routes->post('/skrining-tbc/proses', 'AdminTbc\Dashboard::proses');


// ========================================
// HASIL
// ========================================

$routes->get('/hasil', function () {
    return view('gol_b/hasil');
});


// ========================================
// CETAK PDF
// ========================================

$routes->get(
    '/dashboard/cetak/(:num)',
    'AdminTbc\Dashboard::cetak/$1'
);


// ========================================
// UTILITY
// ========================================

$routes->get(
    '/getKodePos',
    'AdminTbc\Dashboard::getKodePos'
);


// ========================================
// WILAYAH
// ========================================

$routes->get('wilayah/kabupaten/(:num)', 'AdminTbc\Wilayah::kabupaten/$1');

$routes->get('wilayah/kecamatan/(:num)', 'AdminTbc\Wilayah::kecamatan/$1');

$routes->get('wilayah/kelurahan/(:num)', 'AdminTbc\Wilayah::kelurahan/$1');

// ================= Video DBD =================
$routes->get('/video/kelola_video', 'VideoDbd::index');
$routes->get('/video', 'VideoDbd::index');
$routes->get('/video/publish', 'VideoDbd::publish');
$routes->get('/video/draft', 'VideoDbd::draft');
$routes->get('/video/tambah2', 'VideoDbd::tambah2');
$routes->post('video/simpanDetail', 'VideoDbd::simpanDetail');

$routes->get('/video/video_dbd/(:num)', 'VideoDbd::view/$1');

$routes->get('/video/tambah1', 'VideoDbd::tambah1');
$routes->post('/video/simpan', 'VideoDbd::simpan');

$routes->get('/video/tambah1/(:num)', 'VideoDbd::edit/$1');
$routes->post('/video/update/(:num)', 'VideoDbd::update/$1');

$routes->get('/video/delete/(:num)', 'VideoDbd::delete/$1');
$routes->get('VideoDbd/view/(:num)', 'VideoDbd::view/$1');
$routes->get('/video/list_video', 'LandingpageDbd::list_video');
$routes->get('/video/video_dbd/(:num)', 'LandingpageDbd::list_video/$1');

// ================= Manajemen Banner DBD =================
$routes->get('/bannerDbd', 'ManajemenBanner::index');
$routes->get('/bannerDbd/manajemen_banner', 'ManajemenBanner::index');
$routes->get('/bannerDbd/unggah_banner', 'ManajemenBanner::unggah');
$routes->post('/bannerDbd/simpan', 'ManajemenBanner::simpan');
$routes->get('bannerDbd/edit/(:num)','ManajemenBanner::edit/$1');
$routes->post('bannerDbd/update/(:num)','ManajemenBanner::update/$1');
$routes->get('bannerDbd/delete/(:num)','ManajemenBanner::delete/$1');
$routes->get('bannerDbd/preview/(:num)', 'ManajemenBanner::preview/$1');
$routes->post('bannerDbd/updateUrutan/(:num)','ManajemenBanner::updateUrutan/$1');

// ================= MANEJEMEN USER =================
$routes->get('/manajemen-user', 'ManajemenUser::index');

$routes->get('/manajemen-user/tambah', 'ManajemenUser::form');
$routes->post('/manajemen-user/simpan', 'ManajemenUser::simpan');

$routes->get('/manajemen-user/edit/(:num)', 'ManajemenUser::form/$1/edit');
$routes->post('/manajemen-user/update/(:num)', 'ManajemenUser::update/$1');

$routes->get('/manajemen-user/view/(:num)', 'ManajemenUser::form/$1/view');

$routes->get('/manajemen-user/hapus/(:num)', 'ManajemenUser::hapus/$1');

// ================= FUNFACT =================
$routes->get('funfact', 'dbd::funfact');
$routes->get('dbd/unggahfunfact', 'dbd::unggahfunfact');
$routes->get('dbd/unggahfunfact/(:num)', 'dbd::unggahfunfact/$1');
$routes->post('funfact/simpan', 'dbd::simpanFunfact');
$routes->get('funfact/edit/(:num)', 'dbd::editFunfact/$1');
$routes->post('funfact/update/(:num)', 'dbd::updateFunfact/$1');
$routes->get('funfact/hapus/(:num)', 'dbd::hapusFunfact/$1');
$routes->get('funfact/upload/(:num)', 'dbd::uploadFunfact/$1');
$routes->get('funfact/simpan-draft/(:num)', 'Funfact::simpanDraft/$1');
$routes->get('funfact/view/(:num)', 'dbd::view/$1');;

$routes->get('berita/funfact_user/(:num)', 'dbd::Funfactview/$1');

// PROFIL SISTEM
$routes->get('superadmin/profil_sistem', 'SuperAdmin::profil_sistem');
$routes->get('superadmin/profil', 'SuperAdmin::profil');
$routes->get('superadmin/profil_sistem/edit', 'SuperAdmin::edit');
$routes->post('superadmin/profil_sistem/update', 'SuperAdmin::update');

$routes->get('tentang-kami', 'SuperAdmin::tentang_kami');

// ================= PELAPORAN KADER DI ADMIN =================
$routes->get('dbd/pelaporan-kader/admin', 'Dbd::pelaporan_kader');
$routes->get('dbd/pelaporan-kader/daftar/admin', 'Dbd::daftar_laporan');
$routes->get('pelaporan-kader/delete/(:num)', 'Dbd::delete_laporan/$1');
$routes->get('hasil_data_kepala/hasil', 'Dbd::hasil_data_kepala');
$routes->get('dbd/view_laporan_kader/admin/(:num)', 'Dbd::view_laporan/$1');
$routes->get('dbd/view_laporan/(:num)', 'Dbd::view_laporan/$1');

// ================= MANEJEMEN USER =================
$routes->get('/manajemen_user', 'ManajemenUser::index');
$routes->get('/manajemen_user/tambah', 'ManajemenUser::form');
$routes->post('/manajemen_user/simpan', 'ManajemenUser::simpan');
$routes->get('/manajemen_user/edit/(:num)', 'ManajemenUser::form/$1/edit');
$routes->post('/manajemen_user/update/(:num)', 'ManajemenUser::update/$1');
$routes->get('/manajemen_user/view/(:num)', 'ManajemenUser::form/$1/view');
$routes->get('/manajemen_user/hapus/(:num)', 'ManajemenUser::hapus/$1');
$routes->post('ai/chat', 'AI::chat');

$routes->get('tentangkamiDBD', 'Dashboard::tentangkamiDBD');
$routes->get('skrining-diare', 'Diare::skrining');
$routes->post('skrining-diare-step2', 'Diare::step2');
$routes->post('skrining-diare-step3', 'Diare::step3');
$routes->post('skrining-diare-step4', 'Diare::step4');
$routes->post('skrining-diare-hasil', 'Diare::hasil');
$routes->get('skrining-diare-pdf', 'Diare::pdf');
$routes->get('pdf-diare', 'Diare::pdf');
$routes->get('diare/kalkulator-air', 'Diare::kalkulatorAir');
$routes->post('diare/hitung-air', 'Diare::hitungAir');
$routes->get('admind/skrining', 'AdminD::skrining');

$routes->get('admind/funfact', 'AdminD::funfact');
$routes->get('admind/profil', 'AdminD::profil');
$routes->get('admind/export', 'AdminD::export');


$routes->get('admind/berita', 'AdminD::berita');
$routes->get('admind/berita/tambah', 'AdminD::tambahBerita');
$routes->post('admind/berita/simpan', 'AdminD::simpanBerita');
$routes->get('admind/berita/edit/(:num)', 'AdminD::editBerita/$1');
$routes->post('admind/berita/update/(:num)', 'AdminD::updateBerita/$1');
$routes->get('admind/berita/hapus/(:num)', 'AdminD::hapusBerita/$1');
$routes->get('admind/berita/publish/(:num)', 'AdminD::publishBerita/$1');

$routes->get('admind/berita/edit/(:num)', 'AdminD::editBerita/$1');
$routes->post('admind/berita/update/(:num)', 'AdminD::updateBerita/$1');

$routes->get('/berita/(:num)', 'Diare::detailBerita/$1');
$routes->get('admind/berita/detail/(:num)', 'AdminD::detailBerita/$1');

//super admin iki
$routes->get('/superadmin', 'SuperAdmin::dashboard');
$routes->get('/superadmin/iklan', 'SuperAdmin::iklan');
$routes->get('/superadmin/admin', 'SuperAdmin::admin');
$routes->get('/superadmin/puskesmas', 'SuperAdmin::puskesmas');
$routes->get('/superadmin/profil', 'SuperAdmin::profil');

$routes->get('/superadmin/iklan', 'SuperAdmin::iklan');
$routes->post('/superadmin/iklan/simpan', 'SuperAdmin::simpanIklan');
$routes->get('/superadmin/iklan/hapus/(:num)', 'SuperAdmin::hapusIklan/$1');
$routes->post('/superadmin/iklan/update/(:num)', 'SuperAdmin::updateIklan/$1');


$routes->get('/superadmin/iklan/edit/(:num)', 'SuperAdmin::formEditIklan/$1');

$routes->get('/superadmin/iklan/tambah', 'SuperAdmin::formTambahIklan');

$routes->get('superadmin', 'SuperAdmin::dashboard');
$routes->get('superadmin/manajemen-iklan', 'SuperAdmin::manajemenIklan');
$routes->get('superadmin/iklan/tambah', 'SuperAdmin::formTambahIklan');
$routes->post('superadmin/iklan/simpan', 'SuperAdmin::simpanIklan');
$routes->get('superadmin/iklan/edit/(:num)', 'SuperAdmin::editIklan/$1');

$routes->post('superadmin/iklan/update/(:num)', 'SuperAdmin::updateIklan/$1');

$routes->get('superadmin/iklan/hapus/(:num)', 'SuperAdmin::hapusIklan/$1');


//
$routes->get('/admind/funfact', 'diare::funfact');
$routes->get('admind/funfact', 'AdminD::funfact');
$routes->get('admind/funfact/tambah', 'AdminD::tambahFunfact');
$routes->post('admind/funfact/simpan', 'AdminD::simpanFunfact');
$routes->get('admind/funfact/edit/(:num)', 'AdminD::editFunfact/$1');
$routes->post('admind/funfact/update/(:num)', 'AdminD::updateFunfact/$1');
$routes->get('admind/funfact/hapus/(:num)', 'AdminD::hapusFunfact/$1');
$routes->get('admind/funfact/publish/(:num)', 'AdminD::publishFunfact/$1');
$routes->get('admind/funfact/draft/(:num)', 'AdminD::draftFunfact/$1');
$routes->get('diare-detail/(:num)', 'Home::diare_detail/$1');

$routes->get('admind/funfact/draft/(:num)', 'AdminD::draftFunfact/$1');

$routes->get('admind/funfact/publish/(:num)', 'AdminD::publishFunfact/$1');
$routes->get('/diare-detail', 'Home::diare_detail');
$routes->get('/diare', 'Diare::index');
// Superadmin Manajemen Admin
$routes->get(
    'superadmin/manajemen_admin',
    'superadmin::manajemen_admin'
);

$routes->get(
    'superadmin/manajemen_admin/tambah',
    'superadmin::manajemen_admin_tambah'
);

$routes->post(
    'superadmin/manajemen_admin/simpan',
    'superadmin::manajemen_admin_simpan'
);

$routes->get(
    'superadmin/manajemen_admin/edit/(:num)',
    'superadmin::manajemen_admin_edit/$1'
);

$routes->post(
    'superadmin/manajemen_admin/update/(:num)',
    'superadmin::manajemen_admin_update/$1'
);

$routes->get(
    'superadmin/manajemen_admin/hapus/(:num)',
    'superadmin::manajemen_admin_hapus/$1'
);
