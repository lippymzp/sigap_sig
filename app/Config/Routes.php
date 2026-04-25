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
/* SKRINING DBD */
/* ========================= */

$routes->get('/skriningdbd', 'Home::skriningdbd');
$routes->match(['get', 'post'], '/skriningdbd/skriningdbd2', 'Home::skriningdbd2');
$routes->match(['get', 'post'], '/skriningdbd/skriningdbd3', 'Home::skriningdbd3');
$routes->get('/rekap_skrining', 'Home::rekap_skrining');
/* ========================= */
/* PROFIL dan Logut */
/* ========================= */

$routes->get('/profil_kepala', 'Profile::profil_kepala');
$routes->get('/profil_admin', 'Profile2::profil_admin');
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
$routes->post('dbd/simpan', 'dbd::simpan');
$routes->get('dbd/export', 'Dbd::export');
$routes->get('tbc/dashboard', 'Dashboard::tbc');
$routes->get('pneumonia/dashboard', 'Dashboard::pneumonia');
$routes->get('diare/dashboard', 'Dashboard::diare');
$routes->get('diare/input_data', 'Diare::inputData');
$routes->get('diare/hasil', 'Diare::hasil_data');
$routes->post('diare/simpan', 'diare::simpan');
$routes->get('/diare/export', 'Diare::export');

/* ========================= */
/* DASHBOARD KEPALA */
/* ========================= */

$routes->get('/dashboard_kepala', 'Kepala::dashboard');
$routes->get('/dashboard_kepala', 'Kepala::dashboard');
$routes->get('/export_kepala', 'Kepala::export');

/* ========================= */
/* FUNFACT TBC */
/* ========================= */

$routes->get('tbc/funfact', 'Dashboard::funfact');

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

