<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* ========================= */
/* HALAMAN UTAMA */
/* ========================= */

$routes->get('/', 'Home::index');
$routes->get('/logout', 'Auth::logout');
$routes->get('/kontak', 'Home::kontak');
$routes->get('/pneumonia', 'Home::pneumonia');
$routes->get('/dbd', 'Home::dbd');
$routes->get('/tbc', 'Home::tbc');
$routes->get('/diare', 'Home::diare');
$routes->get('/skrining', 'Home::skrining');

/* ========================= */
/* SKRINING Pneumonia */
/* ========================= */
$routes->get('/skriningpneumonia', 'Home::skriningpneumonia');
$routes->match(['get', 'post'], '/skriningpneumonia/skriningpneumonia2', 'Home::skriningpneumonia2');
$routes->match(['get', 'post'], '/skriningpneumonia/skriningpneumonia3', 'Home::skriningpneumonia3');

/* ========================= */
/* SKRINING DBD */
/* ========================= */

$routes->get('/skriningdbd', 'Dbd::skriningdbd');
$routes->match(['get', 'post'], '/skriningdbd/skriningdbd2', 'Dbd::skriningdbd2');
$routes->match(['get', 'post'], '/skriningdbd/skriningdbd3', 'Dbd::skriningdbd3');
$routes->get('/dbd/rekap_skrining', 'Dbd::rekap_skrining');
/* PROFIL dan Logut */
/* ========================= */

$routes->get('/profil_kepala', 'Profile::profil_kepala');
$routes->get('/profil_admin', 'Profile2::profil_admin');
$routes->post('uploadFoto', 'Profile2::uploadFoto');
$routes->post('updateProfil', 'Profile2::updateProfil');
$routes->get('/profil_kader', 'Profile3::profil_kader');
$routes->post('profil/update_foto', 'Profile3::update_foto');
$routes->post('profil/update_sandi', 'Profile3::update_sandi');
/* ========================= */
/* DIARE */
/* ========================= */

$routes->get('/skrining-diare', 'Home::skrining_diare');
$routes->get('/diare-detail', 'Home::diare_detail');
$routes->get('/diare', 'Diare::index');
$routes->get('skrining-diare', 'Diare::skrining');
$routes->post('hasil-diare', 'Diare::hasil');
$routes->get('pdf-diare', 'Diare::pdf');
$routes->post('skrining-diare-step2', 'Diare::step2');

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
$routes->get('dbd/dashboard', 'Dashboard::dbd');
$routes->get('dbd/input_data', 'Dbd::inputData');
$routes->get('dbd/hasil', 'Dbd::hasil_data');
$routes->get('data_kepala/hasil', 'Dbd::hasil_data_kepala');
$routes->post('dbd/simpan', 'dbd::simpan');
$routes->get('dbd/export', 'Dbd::export');
$routes->get('tbc/dashboard', 'Dashboard::tbc');
$routes->get('pneumonia/dashboard', 'Dashboard::pneumonia');
$routes->get('diare/dashboard', 'Dashboard::diare');
$routes->get('diare/input_data', 'Diare::inputData');
$routes->get('diare/hasil', 'Diare::hasil_data');
$routes->post('diare/simpan', 'diare::simpan');
$routes->get('/diare/export', 'Diare::export');
$routes->get('/kader/dashboard', 'dbd::dashboard');
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

$routes->get('/dashboard_kepala', 'Kepala::dashboard');
$routes->get('/dashboard_kepala', 'Kepala::dashboard');
$routes->get('/export_kepala', 'Kepala::export');


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

$routes->get('dbd/export-hasil-data-pasien/pdf', 'Dbd::export_pdf_pasien');
$routes->get('dbd/export-hasil-data-pasien/excel', 'Dbd::export_excel_pasien');

$routes->get('tbc/hasil', 'AdminTbc\Pasien::index');

$routes->get('tbc/input_data', 'AdminTbc\Pasien::create');

$routes->post('tbc/store', 'AdminTbc\Pasien::store');

$routes->get('tbc/edit/(:num)', 'AdminTbc\Pasien::edit/$1');

$routes->post('tbc/update/(:num)', 'AdminTbc\Pasien::update/$1');

$routes->get('tbc/delete/(:num)', 'AdminTbc\Pasien::delete/$1');

// ================= Video DBD =================
$routes->get('/video/kelola_video', 'VideoDbd::index');
$routes->get('/video', 'VideoDbd::index');
$routes->get('/video/publish', 'VideoDbd::publish');
$routes->get('/video/draft', 'VideoDbd::draft');
$routes->get('/video/tambah2', 'VideoDbd::tambah2');
$routes->post('video/simpanDetail', 'VideoDbd::simpanDetail');

$routes->get('/video/view/(:num)', 'VideoDbd::view/$1');

$routes->get('/video/tambah1', 'VideoDbd::tambah');
$routes->post('/video/simpan', 'VideoDbd::simpan');

$routes->get('/video/tambah2/(:num)', 'VideoDbd::edit/$1');
$routes->post('/video/update/(:num)', 'VideoDbd::update/$1');

$routes->get('/video/delete/(:num)', 'VideoDbd::delete/$1');