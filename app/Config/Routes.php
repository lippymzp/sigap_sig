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

$routes->get('/skrining1', 'Home::skrining1');
$routes->post('/skrining2', 'Home::skrining2');
$routes->post('/skrining3', 'Home::skrining3');
$routes->post('/hasil', 'Home::hasil');


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
$routes->get('/otp', 'Auth::otp');
$routes->get('/reset', 'Auth::reset');

//dashboard
$routes->get('dbd/dashboard', 'Dashboard::dbd');
$routes->get('tbc/dashboard', 'Dashboard::tbc');
$routes->get('pneumonia/dashboard', 'Dashboard::pneumonia');
$routes->get('diare/dashboard', 'Dashboard::diare');