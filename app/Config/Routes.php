<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/kontak', 'Home::kontak');
$routes->get('/pneumonia', 'Home::pneumonia');
$routes->get('/dbd', 'Home::dbd');
$routes->get('/tbc', 'Home::tbc');
$routes->get('/diare', 'Home::diare');
$routes->get('/skrining', 'Home::skrining');

/*skrining gol A */
$routes->get('/skriningdbd', 'Home::skriningdbd');
$routes->match(['get','post'], '/skriningdbd/skriningdbd2', 'Home::skriningdbd2');
$routes->match(['get','post'], '/skriningdbd/skriningdbd3', 'Home::skriningdbd3');

//profil gol A
$routes->get('/profil_kepala', 'Profile::profil_kepala');

//profil admin Gol A
$routes->get('/profil_admin', 'Profile2::profil_admin');

$routes->get('/skrining-diare', 'Home::skrining_diare');
$routes->get('/diare-detail', 'Home::diare_detail');
$routes->get('skrining-diare', 'Diare::skrining');
$routes->post('hasil-diare', 'Diare::hasil');
$routes->get('pdf-diare', 'Diare::pdf');
$routes->post('skrining-diare-step2', 'Diare::step2');

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/diare', 'Diare::index');

//Login
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

//dashboard
$routes->get('dbd/dashboard', 'Dashboard::dbd');
$routes->get('tbc/dashboard', 'Dashboard::tbc');
$routes->get('pneumonia/dashboard', 'Dashboard::pneumonia');
$routes->get('diare/dashboard', 'Dashboard::diare');
$routes->get('diare/input_data', 'Diare::inputData');
$routes->get('diare/hasil', 'Diare::hasil_data');
$routes->post('diare/simpan', 'diare::simpan');
$routes->get('/diare/export', 'Diare::export');